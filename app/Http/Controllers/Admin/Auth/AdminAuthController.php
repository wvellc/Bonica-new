<?php
namespace App\Http\Controllers\Admin\Auth;

use Validator;
use Session;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Admin;

class AdminAuthController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/admin/login';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest', ['except' => 'logout']);
	}

	public function getLogin() {

		return view('admin.auth.login');
	}

	/**
	 * Show the application loginprocess.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Request $request) {
		$this->validate($request, [
			'email'		=> 'required|email',
			'password'	=> 'required',
		]);
		$remember_me = $request->has('remember') ? true : false;
		if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me)) {
			$user = auth()->guard('admin')->user();

			Session::flash('success', 'You are Login successfully!!');
			return redirect()->route('admin.dashboard.index');

		} else {
			return back()->with('error','You have entered an invalid username or password.');
		}

	}

	/**
	 * Show the application logout.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function logout() {
		auth()->guard('admin')->logout();
		Session::flush();
		Session::flash('success', 'You have logged out successfully');
		return redirect(route('admin.login'));
	}
}
