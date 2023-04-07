<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        switch ($this->method()) {
			case 'PUT':
				$email      = 'required|string|email|max:255|unique:admins,email,'.$this->id;
				$password   = 'nullable|string|min:6';
				// $image      = 'mimes:png,jpg,jpeg|max:2048';
				break;
			default:
                $email      = 'required|string|email|max:255|unique:admins';
				$password   = 'required|string|min:6';
				// $image      = 'mimes:png,jpg,jpeg|max:2048';
				break;
		}

		return [
			'name'			=> 'required|string|max:255',
			'email'			=> $email,
            'password'      => $password,
			// 'profile_image'	=> $image,
			'is_super'		=> 'required',
			'status'		=> 'required'
		];
	}
}
