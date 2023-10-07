<?php

namespace App\Http\Requests\role;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $rules = [];
        $method = $this->route()->getActionMethod();
        switch ($this->method()) {
            case 'POST':
                switch ($method) {
                    case 'add':
                        $rules = [
                            'name' => 'required',
                            'description' => 'required'
                        ];
                        break;
                    case 'edit':
                        $rules = [
                            'name' => 'required',
                            'description' => 'required'
                        ];
                        break;
                    default:
                        # code...
                        break;
                }
                break;

            default:
                # code...
                break;
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống',
            'description.required' => 'Mô tả không được bỏ trống'
        ];
    }
}
