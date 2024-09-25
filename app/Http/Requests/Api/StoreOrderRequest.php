<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'coupon_code' => 'nullable|string',
            'payment_method' => 'required|string',
            'phone' => 'required',
            'first_name' => 'required|string|max:200',
            'last_name' => 'required|string|max:200',
            'gov_id' => 'required|integer',
            'city_id' => 'required|integer',
            'address' => 'required|string|max:200',
            'points'  => 'required|in:0,1'
        ];
    }



    public function messages()
    {
        return [
            'coupon_code.string' => 'The coupon code must be a string.',
            'payment_method.required' => 'The payment method is required.',
            'payment_method.string' => 'The payment method must be a string.',
            'phone.required' => 'The phone number is required.',
            'first_name.required' => 'The first name is required.',
            'first_name.string' => 'The first name must be a string.',
            'first_name.max' => 'The first name may not be greater than 200 characters.',
            'last_name.required' => 'The last name is required.',
            'last_name.string' => 'The last name must be a string.',
            'last_name.max' => 'The last name may not be greater than 200 characters.',
            'gov_id.required' => 'The government ID is required.',
            'gov_id.integer' => 'The government ID must be an integer.',
            'city_id.required' => 'The city ID is required.',
            'city_id.integer' => 'The city ID must be an integer.',
            'address.required' => 'The address is required.',
            'address.string' => 'The address must be a string.',
            'address.max' => 'The address may not be greater than 200 characters.',
        ];
    }



}
