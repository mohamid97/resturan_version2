<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessage extends FormRequest
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
           'name'=>'nullable|string',
           'phone'=>'required|regex:/^(\+?)([0-9]{1,3})?([0-9]{10,14})$/|min:11|max:11',
           'subject'=>'nullable|string|max:255',
           'email'=>'nullable|email',
           'message'=>'required|max:10000',
        ];
    }
}
