<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
				$email      = 'required|string|email|max:255|unique:users,email,'.$this->id;
				$password   = 'nullable|string|min:6';
				// $image      = 'mimes:png,jpg,jpeg|max:2048';
				break;
			default:
                $email      = 'required|string|email|max:255|unique:users';
				$password   = 'required|confirmed|string|min:6';
				// $image      = 'mimes:png,jpg,jpeg|max:2048';
				break;
		}

		return [
			'first_name' => 'required|string|max:150',
            'last_name' => 'required|string|max:150',
			'email'			=> $email,
            'password'      => $password,
			'status'		=> 'required'
		];
	}
}
