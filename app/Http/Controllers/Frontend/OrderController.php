<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Auth;
use Cookie;

class OrderController extends Controller
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

    public function checkout(Request $request)
    {

        if (!Auth::guard('user')->check()) {
            return redirect()->route('frontend.login')->withCookie(cookie('login-checkout', '1', 120));
        }
        $request->validate([
            'first_name' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'state' => 'required',
        ]);

        $currency =  countryCurrency();
        $customerData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'state' => $request->state,
            'country' => $request->country,
            'street_address' => $request->street_address,
            'street_address2' => $request->street_address2,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'phone_number' => $request->phone_number
        ];
        $cartData = array();
        if(Cookie::has('cookiecart')){
            $cart_arr = unserialize(Cookie::get('cookiecart'));
            $cartData = Cart::with('Product')->whereIn('id', $cart_arr)->get();

        $subtotal = 0;
        $shipping_charges = $currency['shipping_charge'];
        $discount = 0;

        if(Cookie::has('coupon_discount')){
            $coupon_discount = unserialize(Cookie::get('coupon_discount'));
            $discount = $coupon_discount['discount'];

        }

        if(count($cartData) > 0){
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
            //$product_price = $cart->product->price;
                /* $shape = '';
                if($cart->shape_id){
                    $shape = getSingleProductShapePrice($cart->product_id, $cart->shape_id);
                    $product_price = $product_price + $shape['price'];

                }
                if($cart->material_id){
                    $productMetalMaterial = getSingleProductMetalMaterial($cart->product_id, $cart->metal_id, $cart->material_id);
                    $product_price = $product_price + $productMetalMaterial['price'];
                } */
                //$product_price = number_format((float)($productDataArr['countryMultiplyby'][$currency['country_id']] * $product_price * $cart->quantity), 3, '.', '');
                $subtotal += ($product_price * $cart->quantity);
            }
            $total_amount = number_format((float)($productDataArr['countryMultiplyby'][$currency['country_id']] * ($subtotal - $discount) / $currency['rate']) + $shipping_charges, 3, '.', '');
            //$total_amount = number_format((float)(($subtotal - $discount) / $currency['rate']) + $shipping_charges, 3, '.', '');
            $request->session()->put('orders',['customerData' => $customerData, 'currency_code' => $currency['currency_code'], 'total_amount' =>  $total_amount] );

            return redirect()->route('frontend.do-payment');
        }
        }
        else{
            return redirect()->route('frontend.myaccount');
        }
    }
}
