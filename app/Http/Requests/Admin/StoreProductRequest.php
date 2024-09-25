<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name.*'=>'required|string',
            'slug.*'=>'required|string',
            'des.*'=>'required|string',
            'meta_title.*'=>'required|string',
            'meta_des.*'=>'required|string',
            'category'=>'nullable',
            'price'=>'required',
            'discount'=>'nullable|string',
            'old_price'=>'nullable'


        ];
    }
}
