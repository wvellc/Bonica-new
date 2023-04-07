<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CourseWorkshopRequest extends FormRequest
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
			'title'	=> 'required|string|max:255',
            'content'	=> 'required|string',
            'image' => 'mimes:png,jpg,jpeg,svg|max:8192',
            'no_of_session' => 'required',
            'no_of_participants' => 'required',
		];
    }
    public function messages()
    {
        return ['no_of_session.required' => 'The no of session is required.',
            'no_of_participants.required' => 'The no of participants is required.',
            'content.required' => 'The description field is required.',
            'image.max' => 'The image must not be greater than 8 MB.',
        ];
    }
}
