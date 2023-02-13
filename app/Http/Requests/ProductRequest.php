<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'sku' => 'required|string|max:255',
            'price' => 'required|max:9',
            'quantity' => 'required|integer',
            'category_id' => 'exists:App\Models\Category,id'
        ];
    }
    /**
     * Sanitize the inputs after the validation.
     *
     * @return array
     */
    public function getValidatedData()
    {
        return [
            'name' => $this->get('name'),
            'sku' => $this->get('sku'),
            'price' => $this->get('price'),
            'quantity' => $this->get('quantity'),
            'category_id' => $this->get('category_id')
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
}
