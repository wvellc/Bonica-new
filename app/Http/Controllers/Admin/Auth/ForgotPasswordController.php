<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Session;
use DB;
use Carbon\Carbon;
use Mail;
use Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset emails and
	| includes a trait which assists in sending these notifications from
	| your application to your users. Feel free to explore this trait.
	|
	*/

	use SendsPasswordResetEmails;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Get the broker to be used during password reset.
	 *
	 * @return PasswordBroker
	 */
	protected function broker()
	{
		return Password::broker('admins');
	}

	/**
	 * Display the form to request a password reset link.
	 *
	 * @return \Illuminate\View\View
	 */
	public function showLinkRequestForm() {
        return view('admin.auth.passwords.email');
	}

	public function sendResetLinkEmail(Request $request)
	{
		$this->validate($request, ['email' => 'required|email']);

		$userCheck = Admin::where('email', $request->email)->first();
		if (empty($userCheck)) {
			return back()->with('error', "We can't find a user with that email address.");
		} else {
            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
                ]);
            // return view('emails.user.reset', ['token' => $token]);dd();
            Mail::send('emails.user.reset', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });

            return back()->with('success', 'We have e-mailed your password reset link!');
		}
	}
}
