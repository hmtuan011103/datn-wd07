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
            'user_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'Tiêu Đề Không Được Để Trống',
            'content.required'=>'Nội Dung Không Được Để Trống',
            'user_id.required'=>'Người Đăng Không Được Để Trống',
        ];

    }
}
