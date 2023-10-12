<?php

namespace App\Http\Requests\TypeUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTypeUserRequest extends FormRequest
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
            'name' => [
                'required',
                'max:125',
                'min:2',
                Rule::unique('type_users'), // Add this line if 'name' should be unique in the 'type_users' table
            ],
            // Add more validation rules for other fields if needed
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'min' => [
    //             'string' => 'Trường :attribute phải chứa ít nhất :min ký tự.',
    //             'numeric' => 'Trường :attribute phải có giá trị ít nhất là :min.',
    //         ],

    //         'max' => [
    //             'string' => 'Trường :attribute không được vượt quá :max ký tự.',
    //             'numeric' => 'Trường :attribute không được lớn hơn :max.',
    //         ],

    //         'required' => 'Trường :attribute là bắt buộc.',
    //         'unique' => 'Trường :attribute đã được sử dụng.',
    //         'email' => 'Trường :attribute phải là một địa chỉ email hợp lệ.',
    //         'exists' => 'Trường :attribute không hợp lệ.',
    //         'confirmed' => 'Trường :attribute xác nhận không khớp.',
    //         'min' => 'Trường :attribute phải chứa ít nhất :min ký tự.',
    //         'max' => 'Trường :attribute không được vượt quá :max ký tự.',
    //         // Add more custom error messages for other rules if needed
    //     ];
    // }
}
