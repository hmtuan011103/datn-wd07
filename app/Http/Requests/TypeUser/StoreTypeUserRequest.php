<?php

namespace App\Http\Requests\TypeUser;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|min:2|max:125|unique:type_users,name,' . $this->route('type_user'),
            // Add more validation rules for other fields if needed
        ];
    }
}
