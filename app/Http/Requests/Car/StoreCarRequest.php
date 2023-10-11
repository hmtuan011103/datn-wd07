<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
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
            'color' => 'required|',
            'description' => 'required',
            'id_type_car' => 'required',
            'image' => 'required',
            'license_plate' => 'required',
            'name' => 'required',
            'status' => 'required',
        ];
    }
}
