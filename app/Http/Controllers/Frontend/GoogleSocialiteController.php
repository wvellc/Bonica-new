<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use Exception;
use App\Models\User;

class GoogleSocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
            //$finduser = User::where('social_id', $user->id)->first();
            $finduser  = User::where('social_id', $user->id)->orWhere('email', $user->email)->first();

            if ($finduser) {
                if ($finduser->status == 1) {
                    if (empty($finduser->social_id)) {
                        $finduser->social_id = $user->id;
                        $finduser->social_type = 'google';
                        $finduser->save();
                    }
                    Auth::guard('user')->login($finduser);

                    return redirect()->route('frontend.home');
                } else {
                    return redirect()->route('frontend.login')->with('error', 'Your account is inactive. Please contact admin.');
                }
            } else {
                $newUser = User::create([
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'password' => null,
                    'confirmation_code' => null,
                    'social_id' => $user->id,
                    'social_type' => 'google',
                    'confirmed'  => 1,
                    'email_verified' => 1
                ]);
                Auth::guard('user')->login($newUser);

                return redirect()->route('frontend.home');
                //return redirect('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
