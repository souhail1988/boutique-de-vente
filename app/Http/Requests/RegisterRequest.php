<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class RegisterRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    protected function failedValidation(Validator $validator)
     {
         throw new HttpResponseException(
             response()->json(['errors' => $validator->errors()], 422)
         );
     }

    /**
     * Sanitize the inputs after the validation.
     *
     * @return array
     */
    public function getValidatedData()
    {
        return [
            'name'=> $this->get('name'),
            'email' => $this->get('email'),
            'password'=>Hash::make($this->get('password')),
        ];
    }
}
