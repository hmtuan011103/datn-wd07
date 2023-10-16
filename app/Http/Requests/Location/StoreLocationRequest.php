<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'image'=>'mimes:jpeg,jpg,png,gif|max:1000',

        ];
       
    }

    public function messages()
    {
        return [
            'name.required'=>'Tên địa điểm không được để trống',
            'image.mimes'=>'Không phải file ảnh',
            'image.max'=>'Ảnh không được quá 1MB',
        ];

    }
}
