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
            'name' => 'required|min:2|max:255',
            'email' => 'required|email|unique:users,email,' . $this->route('user'), // ignore the current user's email
            'phone_number' => 'required|min:10|max:16',
            'user_type_id' => 'required|exists:type_users,id',
            'address' => 'max:255',
            'description' => 'max:600',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ];

        // Check if password is present in the request, if yes, apply password validation rules
        if (
            $this->has('password') && !empty($this->input('password'))
            ||
            $this->has('password_confirmation') && !empty($this->input('password_confirmation'))
        ) {
            $rules['password'] = 'min:8|confirmed';
        }

        return $rules;
    }
}
