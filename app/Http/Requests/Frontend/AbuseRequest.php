<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AbuseRequest extends FormRequest
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
            'practitioner_id'  => 'required',
            'reasons_id'     => 'required',
            'content'		=> 'required',
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
        return ['practitioner_id.required' => 'The practitioner field is required.',
                'reasons_id.required' => 'The reason field is required.',
                'content.required' => 'The description field is required.'];
    }
}
