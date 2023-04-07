<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use App\Models\Payment;
use Cookie;
use Auth;


class RazorpayPaymentController extends Controller
{


    /* private $razorpayId = 'rzp_live_vru05JQL0MeMDJ';  //Live Your Razorpay id here
    private $razorpayKey = 'djtcjeZAE92Loi0uig1hTgus'; //Live Your Razorpay Key here */

    private $razorpayId = 'rzp_test_3lSYsRrQXAV3tb';  //Your Razorpay id here
    private $razorpayKey = 'YisyaU4IMQ3XV8ME8ND2dhks'; //Your Razorpay Key here

    public function do_payment(){

            // Generate random receipt id
            $amount = Session::get('orders')['total_amount'];

            $currency = Session::get('orders')['currency_code'];
            $receiptId = sha1(time());

            // Create an object of razorpay
            //$api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $api = new Api($this->razorpayId, $this->razorpayKey);

            // In razorpay you have to convert rupees into paise we multiply by 100
            // Currency will be INR
            // Creating order
            $order = $api->order->create(array(
                    'receipt' => $receiptId,
                    'amount' => $amount * 100,
                    'currency' => $currency   //'INR'
                )
            );

            // Return response on payment page
            $response = [
                'orderId' => $order['id'],
                'razorpayId' => $this->razorpayId,
                'amount' => $amount * 100,
                'name' => Session::get('orders')['customerData']['first_name'],
                'currency' => $currency,
                'email' => Auth::guard('user')->user()->email,
                'phone_number' => Session::get('orders')['customerData']['phone_number'],
                'description' => "Test Payment",
            ];
            return view('frontend.razorpays.razorpay',compact('response'));
        }

        public function store_payment(Request $request){
            // Now verify the signature is correct . We create the private function for verify the signature
            $signatureStatus = $this->SignatureVerify(
                $request->rzp_signature,
                $request->rzp_paymentid,
                $request->rzp_orderid
            );

            // If Signature status is true We will save the payment response in our database
            // In this tutorial we send the response to Success page if payment successfully made
            $api = new Api($this->razorpayId, $this->razorpayKey);
            if($signatureStatus == true)
            {
                //$payment = $api->payment->fetch($request->rzp_paymentid);
                //dd($payment);
                // You can create this page
                /*  Payment::insert(['user_id'=>Auth::user()->id,'payment_id'=>$request->rzp_paymentid,'order_id'=>$request->rzp_orderid]); */
                $cartData = array();
                if(Cookie::has('cookiecart')){
                    $cart_arr = unserialize(Cookie::get('cookiecart'));
                    $cartData = Cart::with('Product','Product.category','Product.subcategory','size','center_diamond_color','center_diamond_clarity','side_diamond_color','side_diamond_clarity')->whereIn('id', $cart_arr)->get();
                }

                $currency =  countryCurrency();
                $subtotal = 0;
                $shipping_charges = $currency['shipping_charge'];
                $discount = 0;
                $coupon_code = '';
                if(Cookie::has('coupon_discount')){
                    $coupon_discount = unserialize(Cookie::get('coupon_discount'));
                    $discount = $coupon_discount['discount'];
                    $coupon_code = $coupon_discount['coupon_code'];
                }
                $orderArr = array();
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
                    //dd($product_price);

                   // $product_price = $cart->product->price;
                    $shape = '';
                    $metal = '';
                    $material = '';
                    $category_id = 0;
                    $category_slug = '';
                    $subcategory_id = 0;
                    $subcategory_slug = '';

                    if($cart->shape_id){
                        $shape = getSingleProductShapePrice($cart->product_id, $cart->shape_id);
                       // $product_price = $product_price + $shape['price'];
                        $shape = $shape['shape'];
                    }
                    if($cart->material_id){
                        $productMetalMaterial = getSingleProductMetalMaterial($cart->product_id, $cart->metal_id, $cart->material_id);
                       // $product_price = $product_price + $productMetalMaterial['price'];
                        $metal =    $productMetalMaterial['metal'];
                        $material = $productMetalMaterial['material'];
                    }
                    //$product_price = number_format((float)($productDataArr['countryMultiplyby'][$currency['country_id']] * ($product_price * $cart->quantity)) / $currency['rate'], 3, '.', '');

                    $product_first_image = getSingleProductImage($cart->product_id, $cart->metal_id , $cart->shape_id);
                    if($cart->product->subcategory){
                        $subcategory_id = $cart->product->subcategory->id;
                        $subcategory_slug = $cart->product->subcategory->slug;

                        $category_id = $cart->product->category->id;
                        $category_slug = $cart->product->category->slug;
                    }
                    else if($cart->product->category){
                        $category_id = $cart->product->category->id;
                        $category_slug = $cart->product->category->slug;
                    }
                    $orderArr[] = array(
                        'user_id' => Auth::guard('user')->user()->id,
                        'product_id' => $cart->product->id,
                        'product_name' => $cart->product->name,
                        'product_slug' => $cart->product->slug,
                        'category_id' =>  $category_id,
                        'category_slug' =>  $category_slug,
                        'subcategory_id' => $subcategory_id,
                        'subcategory_slug' => $subcategory_slug,
                        'shape' =>  $shape,
                        'metal' => $metal,
                        'material' => $material,
                        'size' => isset($cart->size) ?  $cart->size->name : null,
                        'center_diamond_color' => isset($cart->center_diamond_color) ? $cart->center_diamond_color->name : null,
                        'center_diamond_clarity' => isset($cart->center_diamond_clarity) ? $cart->center_diamond_clarity->name : null,
                        'side_diamond_color' => isset($cart->side_diamond_color) ? $cart->side_diamond_color->name : null,
                        'side_diamond_clarity' => isset($cart->side_diamond_clarity) ? $cart->side_diamond_clarity->name : null,
                        'quantity' => $cart->quantity,
                        'currency_symbol' => $currency['symbol'],
                        'price' => number_format((float)($productDataArr['countryMultiplyby'][$currency['country_id']] * ($product_price * $cart->quantity)) / $currency['rate'], 3, '.', ''),
                        'order_status_id' => 1,
                        'image' =>  $product_first_image,
                        'image_path' => $product_first_image,
                    );
                    $subtotal += ($product_price * $cart->quantity);
                    Cart::where('id', $cart->id)->delete();
                }
               // dd($subtotal);
                $order = new Order();
                $order->user_id = Auth::guard('user')->user()->id;

                $order->order_id = $request->rzp_orderid;
                $order->payment_id = $request->rzp_paymentid;

                $order->first_name = Session::get('orders')['customerData']['first_name'];
                $order->last_name = Session::get('orders')['customerData']['last_name'];
                $order->state = Session::get('orders')['customerData']['state'];
                $order->country = Session::get('orders')['customerData']['country'];
                $order->street_address = Session::get('orders')['customerData']['street_address'];
                $order->street_address2 = Session::get('orders')['customerData']['street_address2'];
                $order->city = Session::get('orders')['customerData']['city'];
                $order->pincode = Session::get('orders')['customerData']['pincode'];
                $order->phone_number = Session::get('orders')['customerData']['phone_number'];
                $order->currency_symbol = $currency['symbol'];

                $shipping_charges =  number_format((float)$shipping_charges, 3, '.', '');
                $discount = number_format((float)($discount) / $currency['rate'], 3, '.', '');
                $order->subtotal = number_format((float)($productDataArr['countryMultiplyby'][$currency['country_id']] *  $subtotal) / $currency['rate'], 3, '.', '');;
                $order->shipping_charges =  $shipping_charges;
                $order->coupon_code = $coupon_code;
                $order->discount = $discount;
                $order->total = number_format((float)($productDataArr['countryMultiplyby'][$currency['country_id']] * ($subtotal - $discount) / $currency['rate']) + $shipping_charges, 3, '.', '');
                $order->save();
                //$orderArr['order_id'] = $order->id;

                if($order->id > 0){
                    $paymentdata = $api->payment->fetch($request->rzp_paymentid);
                    $payment = new Payment();
                    $payment->order_id = $order->id;
                    $payment->user_id =  Auth::guard('user')->user()->id;
                    $payment->transaction_id = $paymentdata['id'];
                    $payment->amount = $paymentdata['amount'] / 100;
                    $payment->currency = $paymentdata['currency'];
                    $payment->amount_in_INR = ($paymentdata['amount'] / 100) * $currency['rate'];
                    $payment->entity = $paymentdata['entity'];
                    $payment->status = $paymentdata['status'];
                    $payment->generated_order_id = $paymentdata['order_id'];
                    $payment->method = $paymentdata['method'];
                    $payment->bank = $paymentdata['bank'];
                    $payment->wallet = $paymentdata['wallet'];
                    $payment->bank_transaction_id = isset($paymentdata['acquirer_data']['bank_transaction_id']) ? $paymentdata['acquirer_data']['bank_transaction_id'] : '';
                    $payment->upi_transaction_id = isset($paymentdata['acquirer_data']['upi_transaction_id']) ? $paymentdata['acquirer_data']['upi_transaction_id'] : '';
                    $payment->save();

                    //dd($orderArr);
                    foreach($orderArr as $value){
                        $data = array(
                            'user_id' => $value['user_id'],
                            'order_id' => $order->id,
                            'product_id' => $value['product_id'],
                            'product_name' => $value['product_name'],
                            'product_slug' => $value['product_slug'],
                            'category_id' =>  $value['category_id'],
                            'category_slug' =>  $value['category_slug'],
                            'subcategory_id' => $value['subcategory_id'],
                            'subcategory_slug' => $value['subcategory_slug'],
                            'shape' =>  $value['shape'],
                            'metal' => $value['metal'],
                            'material' => $value['material'],
                            'size' => $value['size'],
                            'center_diamond_color' => $value['center_diamond_color'],
                            'center_diamond_clarity' => $value['center_diamond_clarity'],
                            'side_diamond_color' => $value['side_diamond_color'],
                            'side_diamond_clarity' => $value['side_diamond_clarity'],
                            'quantity' => $value['quantity'],
                            'currency_symbol' => $value['currency_symbol'],
                            'price' => $value['price'],
                            'order_status_id' => $value['order_status_id'],
                            'image' =>  $value['image'],
                            'image_path' => $value['image_path'],
                        );
                        OrderDetail::create($data);
                    }
                }
                $cookiecart = Cookie::forget('cookiecart');
                $coupon_discount = Cookie::forget('coupon_discount');
                $login_checkout = Cookie::forget('login-checkout');
                Session::forget('orders');
                return redirect()->route('frontend.thankyou')->withCookie($cookiecart)->withCookie($coupon_discount)->withCookie($login_checkout);
                //return "<h1 style='color: green'> Payment Successful </h1>";

            }
            else{
                // You can create this page
                return "<h1 style='color: red'> Payment Failed</h1>";
            }
        }

        // In this function we return boolean if signature is correct
        private function SignatureVerify($_signature,$_paymentId,$_orderId)
        {
            try
            {
                // Create an object of razorpay class
                $api = new Api($this->razorpayId, $this->razorpayKey);
                $attributes  = array('razorpay_signature'  => $_signature,  'razorpay_payment_id'  => $_paymentId ,  'razorpay_order_id' => $_orderId);
                $order  = $api->utility->verifyPaymentSignature($attributes);
                return true;
            }
            catch(\Exception $e)
            {
                // If Signature is not correct its give a excetption so we use try catch
                return false;
            }
        }
}
