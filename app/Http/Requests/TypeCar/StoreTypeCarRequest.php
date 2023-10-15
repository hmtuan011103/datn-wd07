<?php

namespace App\Http\Requests\TypeCar;

use Illuminate\Foundation\Http\FormRequest;

class StoreTypeCarRequest extends FormRequest
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
            'name' => 'required',
            'total_seat' => 'required|integer|max:50',
        ];
    }


public function messages()
{
    return [
        'name.required'=>'Tên Loại Xe Không Được Để Trống',
        'total_seat.required'=>'Ảnh Không Được Để Trống',
        'total_seat.integer'=>'Vui Lòng Nhập Số',
        'total_seat.max'=>'Số Ghé Không Quá 50',
    ];

}
}
