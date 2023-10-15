<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
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
            'color' => 'required',
            'id_type_car' => 'required',
            'image' => 'required',
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
            'license_plate.required'=>'Vui lòng nhập Biển Số',
            'image.required'=>'Vui Lòng Nhập Ảnh',
            'image.mimes'=>'File Ảnh Không Đúng Yêu Cầu',
            'image.max'=>'Dung Lượng Ảnh Quá Lớn',
            'name.required'=>'Vui lòng nhập tên cho chuyến đi',
            'status.required'=>'Vui lòng chọn địa điểm kết thúc',
        ];
    }
}
