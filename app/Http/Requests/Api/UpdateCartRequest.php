<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'product_id' => 'required|integer|exists:products,id',
            'type' => 'nullable|in:increase,decrease,null',
            'quantity' => 'nullable|integer|min:1', // Adjust based on your requirements
        ];
    }


    public function messages()
    {
        return [
            'product_id.required' => 'Product ID is required.',
            'product_id.integer' => 'Product ID must be an integer.',
            'product_id.exists' => 'The selected Product ID is invalid.',
            'type.in' => 'The type must be one of the following values: increase, decrease, null.',
            'quantity.integer' => 'Quantity must be an integer.',
            'quantity.min' => 'Quantity must be at least 1.',
        ];
    }


    
}
