<?php

namespace App\Http\Requests\Route;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRouteRequest extends FormRequest
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
            'start_location' => 'required',
            'end_location' => 'required|different:start_location',
            'start_time' => 'required|date_format:H:i',
            'interval_trip' => 'required',
            'car_id' => 'required',
            'driver_id' => 'required',
            'assistantCar_id' => 'required',
            'trip_price' => 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'car_id.required'=>'Vui lòng chọn xe',
            'driver_id.required'=>'Vui lòng chọn tài xế',
            'assistantCar_id.required'=>'Vui lòng chọn phụ xe',
            'start_time.required'=>'Vui lòng nhập giờ đi',
            'interval_trip.required'=>'Vui lòng nhập thời gian hành trình',
            'start_location.required'=>'Vui lòng chọn địa điểm bắt đầu',
            'trip_price.required'=>'Vui lòng nhập giá cho chuyến đi',
            'trip_price.numeric'=>'Giá phải là số',
            'end_location.required'=>'Vui lòng chọn địa điểm kết thúc',
            'end_location.different'=>'Địa điểm này đã được chọn',

        ];
    }
}
