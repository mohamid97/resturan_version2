<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
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
            'des.*'=>'required',
            'small_des.*'=>'required|string',
            'photo'=>'nullable|image',
            'percentage'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
            
        ];
    }
}
