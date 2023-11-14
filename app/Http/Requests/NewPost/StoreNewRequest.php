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
            'title' => 'required|min:50|max:70',
            'content' => 'required|min:1024',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.min' => 'Vui lòng nhập tiêu đề trên 50 kí tự',
            'title.max' => 'Vui lòng nhập tiêu đề đưới 70 kí tự',
            'content.required' => 'Nội Dung Không Được Để Trống',
            'content.min' => 'Nội Dung phải ít nhất 1024 từ',
            'image.required' => 'Ảnh không được để trống',
            'image.mimes' => 'Bạn phải chọn ảnh',
            'image.max' => 'Ảnh không được quá 2MB',
            'user_id.required' => 'Người Đăng Không Được Để Trống',
        ];

    }
}
