<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|min:2|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|min:10|max:16',
            'user_type_id' => 'required|exists:type_users,id',
            'address' => 'max:255',
            'description' => 'max:600',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
            'password' => 'required|min:8|confirmed',
            // Add more validation rules for other fields if needed
        ];
    }
}
