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
            'image'=>'required',
            'parent_id'=>'required',
            'description'=>'required',

        ];
       
    }

    public function messages()
    {
        return [
            'name.required'=>'Tên địa điểm không được để trống',
            'image.required'=>'Ảnh không được để trống',
            'parent_id.required'=>'Địa điểm không được để trống',
            'description.required'=>'Mô tả không được để trống',
        ];

    }
}
