<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Commonhelper;
use Session;

class SettingController extends Controller
{
    public function changePassword() {
		return view('admin.change_password');
	}

	public function changePasswordStore(Request $request) {
		$this->validate($request, [
			'current_password' 		=> 'required', new MatchOldPassword,
			'new_password' 			=> 'required|min:6',
			'new_confirm_password' 	=> 'required|same:new_password',
		]);

		try{
			if (Hash::check($request->get('current_password'), Auth()->guard('admin')->user()->password)) {
				Admin::find(auth()->guard('admin')->user()->id)->update(['password'=> Hash::make($request->new_password)]);
				Session::flash('success', 'Password change successfully!');
			} else {
				Session::flash('error', 'The current password is incorrect.');
			}
		}catch(\Exception $e){
			Session::flash('error', 'Something went wrong.please try again!');
		}
		return redirect()->back();
	}

	public function profileUpdateStore(Request $request) {
		$this->validate($request, [
			'name' 	=> 'required',
			'email' => 'required|email|unique:admins,email,'.auth()->guard('admin')->user()->id,
            // 'imageFile' => 'nullable|mimes:png,PNG,jpg,jpeg,JPG,JPEG|max:2048'
		]);

		try{

			$admin          = Admin::find(auth()->guard('admin')->user()->id);
            $admin->name	= $request->name;
		    $admin->email	= $request->email;
            $admin->save();

            // $oldFileName    = "";
            // if($admin->profile_image){
            //     $oldFileName    = $admin->profile_image;
            // }

            // $nameImages = array();
            // if ($request->hasfile('imageFile')) {
            //     $path           = 'uploads/admin/' . $admin->id .'/';
            //     $thumbnailPath  = 'uploads/admin/' . $admin->id . '/thumbnail/';
            //     $uploadImage    = Commonhelper::uploadFileWithThumbnail($request, 'imageFile', $path, $thumbnailPath, 100, 100,$oldFileName);

            //     if ($uploadImage->getData()->code == 200 && $uploadImage->getData()->imagename) {
            //         $admin->profile_image = $uploadImage->getData()->imagename;
            //         $admin->save();
            //     }
            // }
			Session::flash('success', 'Profile has been successfully updated.');
		}catch(\Exception $e){
			Session::flash('error', 'Something went wrong.please try again!');
		}
		return redirect()->back();
	}
}
