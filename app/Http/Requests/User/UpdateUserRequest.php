<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|unique:users,email,' . $this->route('user'), // ignore the current user's email
            'phone_number' => 'required|min:10|max:16',
            'user_type_id' => 'required|exists:type_users,id',
            'address' => 'required|max:255',
            'description' => 'max:600',
            // Add more validation rules for other fields if needed
        ];

        // Check if password is present in the request, if yes, apply password validation rules
        if ($this->has('password') && !empty($this->input('password'))) {
            $rules['password'] = 'min:8|confirmed';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'min' => [
                'string' => 'Trường :attribute phải chứa ít nhất :min ký tự.',
                'numeric' => 'Trường :attribute phải có giá trị ít nhất là :min.',
            ],

            'max' => [
                'string' => 'Trường :attribute không được vượt quá :max ký tự.',
                'numeric' => 'Trường :attribute không được lớn hơn :max.',
            ],

            'required' => 'Trường :attribute là bắt buộc.',
            'unique' => 'Trường :attribute đã được sử dụng.',
            'email' => 'Trường :attribute phải là một địa chỉ email hợp lệ.',
            'exists' => 'Trường :attribute không hợp lệ.',
            'confirmed' => 'Trường :attribute xác nhận không khớp.',
            'min' => 'Trường :attribute phải chứa ít nhất :min ký tự.',
            'max' => 'Trường :attribute không được vượt quá :max ký tự.',
        ];
    }
}
