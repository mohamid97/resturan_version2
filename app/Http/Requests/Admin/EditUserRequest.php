<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
           'first_name'=>'required|string|max:255',
           'last_name'=>'required|string|max:255',
           'email'=>'required|email',
            'avatar'=>'nullable|image|mimes:jpeg,png,jpg,gif'
        ];
    }
}
