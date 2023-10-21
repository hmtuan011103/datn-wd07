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
            'image' => 'mimes:jpeg,png,jpg,gif,jfif',
            'color' => 'required',
            'id_type_car' => 'required',
            'license_plate' => 'required',
            'name' => 'required',
            'status' => 'required',
        ];

    }
    public function messages()
    {
        return [
            'license_plate.required'=>'Biển Số Xe Không Được Để Trống.',
            'color.required'=>'Vui Lòng Chọn Màu Của Xe.',
            'id_type_car.required'=>'Vui Lòng Nhập Số Lượng Ghế.',
//            'image.required'=>'Ảnh Không Được Để Trống.',
            'image.mimes'=>'Không Phải File Ảnh.',
            'name.required'=>'Vui Lòng Nhập Tên Xe.',
            'status.required'=>'Vui Lòng Nhập Trạng Thái Của Xe.',
        ];
    }
}
