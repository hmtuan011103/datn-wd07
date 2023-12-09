<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
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
            'image'=>'mimes:jpeg,jpg,png,gif|max:1000',
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'status.required'=>'Trạng thái không được để trống',
            'image.mimes'=>'Không phải file ảnh',
            'image.max'=>'Ảnh không được quá 1MB',
        ];

    }
}
