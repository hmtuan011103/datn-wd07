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
                'string',
                'max:125',
                'min:2',
                Rule::unique('type_users'), // Add this line if 'name' should be unique in the 'type_users' table
            ],
            // Add more validation rules for other fields if needed
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Không được trống.',
            'name.max' => 'Tối đa :max ký tự.',
            'name.min' => 'Tối thiểu :min ký tự.',
            'name.unique' => 'Đã tồn tại.',
            // Add more custom error messages for other rules if needed
        ];
    }
}
