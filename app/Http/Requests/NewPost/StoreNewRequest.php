<?php

namespace App\Http\Requests\NewPost;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewRequest extends FormRequest
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
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề',
        'content.required' => 'Nội Dung Không Được Để Trống',
        'image.required' => 'Ảnh không được để trống',
        'image.mimes' => 'Không phải file ảnh',
        'image.max' => 'Ảnh không được quá 1MB',
        'user_id.required' => 'Người Đăng Không Được Để Trống',
        ];

    }
}
