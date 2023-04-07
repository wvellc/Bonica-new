<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ShapeRequest extends FormRequest
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
		return [
			'name'			=> 'required|string|max:255',
            'image' => 'mimes:png,jpg,jpeg,svg|max:1024',
			'status'		=> 'required'
		];
	}
    public function messages()
    {
        return [
            'image.max' => 'The image must not be greater than 1 MB.'
        ];
    }
}
