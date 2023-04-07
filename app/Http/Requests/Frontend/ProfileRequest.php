<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ProfileRequest extends FormRequest
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
            'first_name' => 'required|string|max:150',
            'last_name' => 'required|string|max:150',
            'email'   => 'required|string|email|max:255|unique:users,email,'. \Auth::guard('user')->user()->id,
            'phone_number' => 'required|numeric|digits:10',


        ];
    }

    /* public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => $validator->errors()->first(),
            'data'      => null
        ], 400));
    } */

    public function messages()
    {
        return ['dob.required' => 'The Birthday field is required.',
                'dob.date_format' => 'The Birthday does not match the format mm/dd/YYYY.',
                'agree.required' => 'Please checked on aggree',];
    }
}
