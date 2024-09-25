<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'type'=>'required|in:0,1',
            'parent_id'=>'nullable|integer',
            'des.*'=>'required',
            'small_des.*'=>'required|string',
            'photo'=>'required|image',
            'has_options'=>'required|in:0,1'
        ];
    }
}
