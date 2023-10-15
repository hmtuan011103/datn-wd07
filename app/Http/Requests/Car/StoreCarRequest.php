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
            'id_type_car' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
            'license_plate' => 'required',
            'name' => 'required',
            'status' => 'required',
        ];

    }
    public function messages()
    {
        return [
            'color.required'=>'Vui lòng chọn xe',
            'id_type_car.required'=>'Vui lòng nhập ngày đi',
            'image.required'=>'Ảnh không được để trống',
            'image.mimes'=>'Không phải file ảnh',
            'image.max'=>'Ảnh không được quá 1MB',
            'name.required'=>'Vui lòng nhập giá cho chuyến đi',
            'status.required'=>'Vui lòng chọn địa điểm kết thúc',
        ];
    }
}
