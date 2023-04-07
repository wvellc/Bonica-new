<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                // $name   = 'required|string|max:190|unique:categories,name,' . $this->id; comment by purvesh
                $name   = 'required|string|max:190';
                break;
            default:
                // $name   = 'required|string|max:190|unique:categories'; comment by purvesh
                $name   = 'required|string|max:190';
                break;
        }


		return [
            'name'  => $name,
			'image' => 'mimes:png,jpg,jpeg,webp|max:8192',
            'icon' => 'mimes:png,jpg,jpeg,svg|max:4096',
            'banner_image' => 'mimes:png,jpg,jpeg,webp|max:8192',
			'status' => 'required'
		];
	}
    public function messages()
    {
        return ['image.max' => 'The image must not be greater than 8 MB.',
            'icon.max' => 'The image must not be greater than 4 MB.',
        ];
    }
}
