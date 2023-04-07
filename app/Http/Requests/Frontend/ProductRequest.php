<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
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
    public function rules(Request $request)
    {
        $image   = 'nullable';
        if(!$request->id){
            $image   = 'required';
        }
        return [
			'title'	=> 'required|string|max:255',
            'content'	=> 'required|string',
            'image' => $image,
            'image.*' => 'mimes:png,jpg,jpeg,svg|max:8192',
            'your_price' => 'required',
            'quantity'	=> 'required',
		];
    }
    public function messages()
    {
        return [
            'content.required' => 'The description field is required.',
            'image.max' => 'The image must not be greater than 8 MB.',
        ];
    }
}
