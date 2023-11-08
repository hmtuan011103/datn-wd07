<?php

namespace App\Http\Requests\Car;

use App\Models\Car;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $tableName = (new Car())->getTable();
        $id = request()->segment('4');
        return [
            'color' => 'required',
            'id_type_car' => 'required',
            'license_plate' => [
                'required',
                Rule::unique($tableName)->ignore($id),
            ],
            'name' => 'required',
            'status' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'license_plate.required'=>'Biển Số Xe Không Được Để Trống.',
            'license_plate.unique'=>'Biển Số Xe Không Được Trùng nhau.',
            'color.required'=>'Vui Lòng Chọn Màu Của Xe.',
            'id_type_car.required'=>'Vui Lòng Nhập Số Lượng Ghế.',
            'name.required'=>'Vui Lòng Nhập Tên Xe.',
            'status.required'=>'Vui Lòng Nhập Trạng Thái Của Xe.',
        ];
    }
}
