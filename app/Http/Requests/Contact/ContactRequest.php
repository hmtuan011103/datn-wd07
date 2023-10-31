<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'title' => 'required',
            'note' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Vui lòng nhập họ và tên',
            'email.required'=>'Vui lòng nhập email',
            'phone_number.required'=>'Vui lòng nhập số điện thoại',
            'title.required'=>'Vui lòng nhập tiêu đề',
            'note.required'=>'Vui lòng nhập nội dung'
        ];
    }
}
