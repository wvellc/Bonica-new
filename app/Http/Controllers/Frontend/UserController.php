<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\RegisterRequest;
use App\Http\Requests\Frontend\LoginRequest;
use App\Http\Requests\Frontend\ProfileRequest;

use App\Models\User;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Country;
use Illuminate\Support\Str;
use App\Commonhelper;
use App\Jobs\SendEmail;
use Session;
use Auth;
use Validator, Redirect, Response;
use Config;
use Carbon\Carbon;
use DB;
use Cookie;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->path = "uploads/user/";
    }
    public function login(Request $request){

        if(Auth::guard('user')->check()){
            return redirect()->route('frontend.home');
        }
        return view('frontend/users/login');
    }
    public function signup(Request $request){
        return view('frontend/users/signup');
    }
    public function saveSignup(RegisterRequest $request)
    {

        try{
        DB::beginTransaction();
        $token = hash('sha256', \Str::random(120));
        $input    = $request->all();
        $input['email']     = Str::lower(trim($input['email']));
        $input['password']    = bcrypt($input['password']);
        $input['confirmation_code']    =  $token;

        $data  = User::create($input);
        $data = $data->toArray();

        //return view('emails.register-email',$data);

       \Mail::send('emails.register-email',['first_name'=>$data['first_name'],'confirmation_code'=>$data['confirmation_code']], function($message) use ($request){

             $message->to(trim($request->email))
                     ->subject('Email Verification');
       });
       DB::commit();

        //SendEmail::dispatch(trim($request->email),$data,'emails.register-email','Email Verification');
        return redirect()->route('frontend.signup')->with('success', __('You need to verify your account. We have sent you an activation link, please check your email.', []));

         /* Transaction successful. */
        }catch(\Exception $e){

            DB::rollback();
            return redirect()->route('frontend.signup')->with('error', __($e->getMessage()));
            /* Transaction failed. */
        }
    }

    public function verify(Request $request){

        $token = $request->token;
        $user = User::where('confirmation_code', $token)->first();
        //dd($user);
        if(!is_null($user)){
            if(!$user->email_verified){
                $user->email_verified = 1;
                $user->save();

                return redirect()->route('frontend.login')->with('success','Your email is verified successfully. You can now login')->with('verifiedEmail', $user->email);
            }else{
                 return redirect()->route('frontend.login')->with('success','Your email is already verified. You can now login')->with('verifiedEmail', $user->email);
            }
        }
    }
    public function saveLogin(LoginRequest $request)
    {
        $msg = "";
        $userInfo = User::select('email_verified','status')->where('email', trim($request->input('email')))->first();
        if(!$userInfo){
            //return back()->with('error','E-mail not found, please enter valid email.');
            $msg = "E-mail not found, please enter valid email.";
        }
        else if(!$userInfo['email_verified']){
            //return back()->with('error','Please confirm your account from your e-mail.');
            $msg = "Please confirm your account from your e-mail.";
        }
        else if(!$userInfo['status']){
            //return back()->with('error','Your account is not active. Please contact to admin.');
            $msg = "Your account is not active. Please contact to admin.";
        }
		else if (auth()->guard('user')->attempt(['email' => trim($request->input('email')), 'password' => $request->input('password')])) {
			$user = auth()->guard('user')->user();
            if(Cookie::has('login-checkout')){

                $cookie = Cookie::forget('login-checkout');
                return redirect()->route('frontend.cart')->withCookie($cookie);
            }
            return redirect()->route('frontend.home');
		}
        else{
            $msg = "You have entered an invalid username or password.";
        }
       /*  if ($request->ajax()) {
            return response()->json(['msg'=> $msg]);
        } */
        return back()->with('error',$msg);
    }
    public function myaccount(Request $request)
    {
        $formObj = User::find(Auth::guard('user')->user()->id);

        //$data['myorders'] = OrderDetail::where('user_id',Auth::guard('user')->user()->id)->with('orderStatus')->orderBy('id', 'DESC')->get();
        $data['myorders'] = Order::where('user_id', Auth::guard('user')->user()->id)->orderBy('id', 'DESC')->get();

        //dd($data['myorders']);
        $data['formObj'] = $formObj;
        $data['country'] = Country::AllCountry();
        return view('frontend/users/myaccount',$data);
    }
    public function myorderDetail(Request $request)
    {

        if ($request->segment(2)) {
            $order_id = Order::where('order_id', $request->segment(2))->value('id');
            if (!$order_id) {
                abort(404);
            }
        }

         $data['myorders'] = OrderDetail::where('user_id',Auth::guard('user')->user()->id)->where('order_id', $order_id)->with('orderStatus')->get();

        $data['orders'] = Order::where('id', $order_id)->first();
        return view('frontend/users/orderdetail', $data);

    }
    public function saveMyaccount(ProfileRequest $request)
    {
        $data = User::find(Auth::guard('user')->user()->id);
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = Str::lower(trim($request->email));
        $data->phone_number = $request->phone_number;
        $data->street_address = $request->street_address;
        $data->street_address2 = $request->street_address2;
        $data->city = $request->city;
        $data->state = $request->state;
        $data->pincode = $request->pincode;
        $data->country = $request->country;

        $data->save();
        return redirect()->route('frontend.myaccount')->with('success', 'Your profile details are updated');
    }
    public function profileImageUpload(Request $request)
    {
        /* $validatedData = $request->validate([
        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]); */
        $rules = [
            'image' => 'required|mimes:png,jpg,jpeg|max:8192',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }
        $data = User::find(Auth::guard('user')->user()->id);
        $uploadImage = "";
        $imagename = "";
        $oldFileName    = "";
            if($data->image){
                 $oldFileName  = $data->image;
            }
		 if ($request->file('image')) {
		 	$thumbnailPath  = $this->path.'thumbnail/';
		 	$uploadImage     = Commonhelper::uploadAjaxFileWithThumbnail($request, 'image', $this->path, $thumbnailPath, 100, 100,$oldFileName);
		 	if ($uploadImage->getData()->code == 200 && $uploadImage->getData()->imagename) {
                $imagename = $uploadImage->getData()->imagename;
                User::where("id", $data->id)->update(['image' => $uploadImage->getData()->imagename]);

		 	}
		 }
         return response()->json(['image'=> $imagename]);
    }
    public function profileImageDelete(Request $request)
    {
        if(Auth::guard('user')->check()){
            $formObj = User::find(Auth::guard('user')->user()->id);
            $thumbnailPath  = $this->path.'thumbnail/';
            if ($formObj->image) {
				if (file_exists(public_path($this->path . $formObj->image))) {
					Commonhelper::deleteFile(public_path($this->path . $formObj->image));
				}
				if (file_exists(public_path($thumbnailPath . $formObj->image))) {
					Commonhelper::deleteFile(public_path($thumbnailPath . $formObj->image));
				}
			}
            $formObj->image = "";
            $formObj->save();
            return response()->json(['msg'=> 'success']);
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        return redirect()->route('frontend.home');
    }

    public function sendResetLink(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email'
        ]);

        $token = \Str::random(64);
        \DB::table('password_resets')->insert([
              'email'=>$request->email,
              'token'=>$token,
              'created_at'=>Carbon::now(),
        ]);

        $action_link = route('frontend.reset.password.form',['token'=>$token,'email'=>$request->email]);
        $body = "We are received a request to reset the password for <b> ".Config::get('constants.APP_NAME')." </b> account associated with ".$request->email.". You can reset your password by clicking the link below";
       \Mail::send('emails.forgot-email',['action_link'=>$action_link,'body'=>$body], function($message) use ($request){

             $message->to($request->email,'Your name')
                     ->subject('Reset Password');
       });
       return back()->with('success', 'We have shared the password reset link on your email.');
   }
    public function showResetForm(Request $request, $token = null){

        return view('frontend/users/reset-password')->with(['token'=>$token,'email'=>$request->email]);
    }
    public function resetPassword(Request $request){

        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:6|confirmed',
            'password_confirmation'=>'required',
        ]);

        $check_token = \DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();

        if(!$check_token){
            return back()->withInput()->with('error', 'Invalid token');
        }else{

            User::where('email', $request->email)->update(['password'=>\Hash::make($request->password), 'email_verified' => 1]);

            \DB::table('password_resets')->where([
                'email'=>$request->email
            ])->delete();

            return redirect()->route('frontend.login')->with('success', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);
        }
    }
}
