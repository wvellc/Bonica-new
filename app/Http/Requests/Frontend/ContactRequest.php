<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ContactRequest extends FormRequest
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
            'name'          => 'required|string|max:90',
            'email'         => 'required|string|email|max:255',
            'message'      =>   'required|string',
        ];
    }
    /* public function messages()
    {
        return ['dob.required' => 'The Birthday field is required.',
                'dob.date_format' => 'The Birthday does not match the format m/d/Y.',
                'agree.required' => 'Please checked on aggree',];
    } */
}
