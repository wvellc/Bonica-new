<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
			'name' => 'required|string|max:255',
            'cat_id' => 'required',
            'description' => 'required|string',
            'price' => 'required',
            'quantity' => 'required',
            //'metal_display_priority'=>'required',
		];
	}
    public function messages()
    {
        return [
            'cat_id.required' => 'The category field is required.',
        ];
    }
}
