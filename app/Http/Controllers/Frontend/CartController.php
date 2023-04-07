<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Coupon;
use Auth;
use Cookie;
use Session;
use DB;
use Carbon\Carbon;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $data = array();
        $data['discount'] = 0;
        $formObj = new User();
        if (Auth::guard('user')->check()) {
            $formObj = User::find(Auth::guard('user')->user()->id);
        }

        $data['formObj'] = $formObj;
        $data['country'] = Country::AllCountry();

        $cartData = array();
        if(Cookie::has('cookiecart')){
            $cart_arr = unserialize(Cookie::get('cookiecart'));
            $cartData = Cart::with('Product','Product.category','Product.subcategory', 'size')->whereIn('id', $cart_arr)->get();
        }
        //dd($cartData);
        //dd($cartData[0]->size->name);
        $data['cartData'] = $cartData;
        //dd($data);
        return view('frontend.products.cart',$data);
    }
    public function cartQuantityUpdate(Request $request)
    {
        $cart_id = $request->cart_id;
        $quantity = $request->quantity;

        Cart::where('id', $cart_id)->update(['quantity' => $quantity]);

        $cart_arr = array();
        if(Cookie::has('cookiecart')){
            $cart_arr = unserialize(Cookie::get('cookiecart'));
        }
        $cartData =  $this->getCartData($cart_arr);
        return response(['status' => 200, "msg" => 'success', "cartData" => $cartData]);

    }
    public function cartDelete(Request $request)
    {
        $cart_id = $request->cart_id;
        Cart::where('id', $cart_id)->delete();
        if(Cookie::has('cookiecart')){
            $cart_arr = unserialize(Cookie::get('cookiecart'));
            $key = array_search($cart_id, $cart_arr);
            if (false !== $key) {
                unset($cart_arr[$key]);
            }
            $cookie = Cookie::forever('cookiecart', serialize($cart_arr));
            if(count($cart_arr) == 0){
                $cookie = Cookie::forget('cookiecart');
            }
        }
        $cartData =  $this->getCartData($cart_arr);
        return response(['status' => 200, "msg" => 'success', "cartData" => $cartData, "cart_count" => count($cart_arr)])->withCookie($cookie);

    }
    public function getCartData($cart_arr)
    {

        $cartData = array();
        $cartPrice = array();
        $discount = 0;
        $subtotal = 0;
        $total = 0;
        $hidden_cart_total = 0;
        $currency =  countryCurrency();

        $coupon_code = '';
        if(Cookie::has('coupon_discount')){
            $coupon_discount = unserialize(Cookie::get('coupon_discount'));
            $discount = $coupon_discount['discount'];
            $coupon_code = $coupon_discount['coupon_code'];
        }
        if(count($cart_arr) > 0){


            $cartData = Cart::with('Product')->whereIn('id', $cart_arr)->get();
            $shipping_charges =  $currency['shipping_charge'];


            foreach ($cartData as $cart){

                $productData = ['product_id' => $cart->product_id,
                'center_diamond_color' => $cart->center_diamond_color_id,
                'center_diamond_clarity' => $cart->center_diamond_clarity_id,
                'side_diamond_color' => $cart->side_diamond_color_id,
                'side_diamond_clarity' => $cart->side_diamond_clarity_id,
                'ringSize' => $cart->size_id,
                'shape_id' => $cart->shape_id,
                'metal_id' => $cart->metal_id,
                'material_id' => $cart->material_id];

                $productDataArr = productPriceCalculation($productData);

                $product_price = $productDataArr['total_price'];
               /*  if($cart->shape_id){
                    $shape = getSingleProductShapePrice($cart->product_id, $cart->shape_id);
                    $product_price = $product_price + $shape['price'];
                } */
                /* if($cart->material_id){

                    $productMetalMaterial = getSingleProductMetalMaterial($cart->product_id, $cart->metal_id, $cart->material_id);
                    $product_price = $product_price + $productMetalMaterial['price'];
                } */
                $cartPrice['price_'.$cart->id] = $currency['symbol'].' '.number_format((float)($productDataArr['countryMultiplyby'][$currency['country_id']] * ($product_price * $cart->quantity)) / $currency['rate'], 3, '.', '');
                $subtotal += ($product_price * $cart->quantity);
            }

            $hidden_cart_total = number_format((float)($productDataArr['countryMultiplyby'][$currency['country_id']] * ($subtotal - $discount) / $currency['rate']) + $shipping_charges, 3, '.', '');
            $total = $currency['symbol'].' '.number_format((float)($productDataArr['countryMultiplyby'][$currency['country_id']] * ($subtotal - $discount) / $currency['rate']) + $shipping_charges, 3, '.', '');

             $subtotal = $currency['symbol'].' '.number_format((float)($productDataArr['countryMultiplyby'][$currency['country_id']] * $subtotal) / $currency['rate'], 3, '.', '');

        }
        return array('cartPrice' => $cartPrice,'subtotal' => $subtotal,'total' => $total,'hidden_cart_total' => $hidden_cart_total);
    }
    public function addToCart(Request $request)
    {
        $product_id = $request->product_id;
        $shape_id = ($request->shape_id) ? $request->shape_id : null;
        $metal_id = ($request->metal_id) ? $request->metal_id : null;
        $material_id = ($request->material_id) ? $request->material_id : null;
        $size_id = ($request->size_id) ? $request->size_id : null;
        $quantity = ($request->quantity) ? $request->quantity : 0;
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $callfrom = ($request->callfrom) ? $request->callfrom : '';
        $center_diamond_color_id = $request->center_diamond_color  ? $request->center_diamond_color : null;
        $center_diamond_clarity_id = $request->center_diamond_clarity  ? $request->center_diamond_clarity : null;
        $side_diamond_color_id = $request->side_diamond_color  ? $request->side_diamond_color : null;
        $side_diamond_clarity_id = $request->side_diamond_clarity  ? $request->side_diamond_clarity : null;

        /*Checked Data In Cart*/
        $cartData = Cart::where('product_id',$product_id);
        if($shape_id > 0){
            $cartData = $cartData->where('shape_id',$shape_id);
        }
        if($metal_id > 0){
            $cartData = $cartData->where('metal_id',$metal_id);
        }
        if($material_id > 0){
            $cartData = $cartData->where('material_id',$material_id);
        }
        if ($size_id > 0) {
            $cartData = $cartData->where('size_id', $size_id);
        }
        if ($center_diamond_color_id > 0) {
            $cartData = $cartData->where('center_diamond_color_id', $center_diamond_color_id);
        }
        if ($center_diamond_clarity_id > 0) {
            $cartData = $cartData->where('center_diamond_clarity_id', $center_diamond_clarity_id);
        }
        if ($side_diamond_color_id > 0) {
            $cartData = $cartData->where('side_diamond_color_id', $side_diamond_color_id);
        }
        if ($side_diamond_clarity_id > 0) {
            $cartData = $cartData->where('side_diamond_clarity_id', $side_diamond_clarity_id);
        }

        $cartData = $cartData->first();

        if($cartData){
            Cart::where('id', $cartData->id)->update(['quantity' => $cartData->quantity + 1]);
        }
        else{
            $cartData =  Cart::create(array('product_id' => $product_id, 'shape_id' => $shape_id, 'metal_id' => $metal_id, 'material_id' => $material_id, 'size_id' => $size_id, 'quantity' => $quantity, 'center_diamond_color_id' => $center_diamond_color_id, 'center_diamond_clarity_id' => $center_diamond_clarity_id, 'side_diamond_color_id' => $side_diamond_color_id, 'side_diamond_clarity_id' => $side_diamond_clarity_id, 'ip_address' => $ip_address));
        }
        $cart_id = $cartData->id;

       // $cookie = Cookie::forget('cookiecart');
        $cart_arr = array();
        if(Cookie::has('cookiecart')){
            $cart_arr = unserialize(Cookie::get('cookiecart'));

            $cart_arr[$cart_id] = $cart_id;
            $cookie = Cookie::forever('cookiecart', serialize($cart_arr));
        }
        else{

            $cart_arr[$cart_id] = $cart_id;
            $cookie = Cookie::forever('cookiecart', serialize($cart_arr));
        }

        if($callfrom == 'wishlist'){
            if(Cookie::has('cookiewishlist')){
                $wishlist_arr = unserialize(Cookie::get('cookiewishlist'));
                $key = array_search($product_id, $wishlist_arr);
                if (false !== $key) {
                    unset($wishlist_arr[$key]);
                }
                $wishlistcookie = Cookie::forever('cookiewishlist', serialize($wishlist_arr));

                return response(['status' => 200, "msg" => 'success', "cart_count" => count($cart_arr), "wishlist_count" => count($wishlist_arr)])->withCookie($cookie)->withCookie($wishlistcookie);
            }
        }
        return response(['status' => 200, "msg" => 'success', "cart_count" => count($cart_arr)])->withCookie($cookie);
    }
    public function checkedCoupon(Request $request)
    {
        $coupon_code = $request->coupon_code;
        $coupon = Coupon::where('code',$coupon_code)->Active()->first();
        if(!$coupon){
            return response(['status' => 200, "msg" => 'success', "error_msg" => 'coupon is not valid!']);
        }
        if($coupon->expired){

            if($this->isPast($coupon->expired)){
                return response(['status' => 200, "msg" => 'success', "error_msg" => 'Sorry, this coupon has expired.']);
            }
        }

        $currency =  countryCurrency();
        $discount = number_format((float)($coupon->discount) / $currency['rate'], 3, '.', '');
        $cart_total = $currency['symbol'].' '.number_format((float)($request->cart_total - $discount), 3, '.', '');

        return response(['status' => 200, "msg" => 'success',"error_msg" => '',"cart_total" => $cart_total,"discount" => $currency['symbol'].' '.$discount])->withCookie(cookie('coupon_discount', serialize(array('coupon_code' => $coupon_code,'discount' => $coupon->discount)), 200));
    }
    function isPast($date){
        return  Carbon::now()->startOfDay()->gt($date);
    }
    public function couponDelete(Request $request)
    {
        $currency =  countryCurrency();
        if(Cookie::has('coupon_discount')){
            $coupon_discount = unserialize(Cookie::get('coupon_discount'));
            $discount = $coupon_discount['discount'];
            $cart_total = $currency['symbol'].' '.number_format((float)($request->cart_total + $discount), 3, '.', '');
        }

        $cookie = Cookie::forget('coupon_discount');
        return response(['status' => 200, "msg" => 'success',"error_msg" => '',"cart_total" => $cart_total,"discount" => $currency['symbol'].' 0.00'])->withCookie($cookie);
    }
}
