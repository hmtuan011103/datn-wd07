<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'name' => 'unique:permissions',
            'description' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Không được bỏ trống tên',
            'name.unique' => 'Tên phân quyền bị trùng lặp',
            'description.required' => 'Không được bỏ trống mô tả',
        ];
    }
}
