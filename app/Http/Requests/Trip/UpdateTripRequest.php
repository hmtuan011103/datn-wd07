<?php

namespace App\Http\Requests\Trip;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTripRequest extends FormRequest
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
            'start_location'=>'required',
            'trip_price'=>'required',
            'end_location'=>'required',


        ];
    }

    public function messages()
    {
        return [
    
            'start_location.required'=>'Vui lòng chọn địa điểm bắt đầu',
            'trip_price.required'=>'Vui lòng nhập giá cho chuyến đi',
            'end_location.required'=>'Vui lòng chọn địa điểm kết thúc',
        ];
    }
}
