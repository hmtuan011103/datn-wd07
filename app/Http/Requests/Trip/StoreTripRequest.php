<?php

namespace App\Http\Requests\Trip;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;

class StoreTripRequest extends FormRequest
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
            'car_id'=>'required',
            'drive_id'=>'required',
            'assistantCar_id'=>'required',
            'start_date'=>'required|after:yesterday|date|date_format:Y-m-d',
            'interval_trip'=>'required',  
            'start_time' => [
                'required',
                // function ($attribute, $value, $fail) {
                //     $selectedDateTime = request()->input('start_date') . ' ' . $value;
                //     $currentDateTime = Carbon::now();
        
                //     if ($selectedDateTime <= $currentDateTime) {
                //         $fail('Vui lòng chọn một thời gian trong tương lai.');
                //     }
                // },
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    // Lấy ngày hiện tại
                    $currentDate = Date::today();
     
                    // Lấy ngày được chọn
                    $selectedDate = $this->input('start_date');
     
                    // Tạo một DateTime object từ ngày và giờ đã chọn
                    $selectedDateTime = Date::createFromFormat('Y-m-d H:i', $selectedDate . ' ' . $value);
     
                    // Kiểm tra xem ngày được chọn có phải là ngày hôm nay hay không
                    if ($selectedDateTime->isSameDay($currentDate)) {
                        // Lấy giờ hiện tại
                        $currentTime = Date::now();
     
                        // Tạo một DateTime object trước 3 tiếng từ thời điểm hiện tại
                        $threeHoursBefore = $currentTime->addHours(3);
     
                        // Kiểm tra xem giờ đã chọn có nằm trong khoảng không được phép
                        if ($selectedDateTime < $threeHoursBefore) {
                            $fail('Không chọn giờ quá khứ và 3 tiếng trước khi xe chạy');

                        }
                      
                    }
            
                },
            ],   
            'start_location'=>'required',
            'trip_price'=>'required',
            'end_location'=>'required|different:start_location',


        ];
    }

    public function messages()
    {
        return [
            'car_id.required'=>'Vui lòng chọn xe',
            'drive_id.required'=>'Vui lòng chọn tài xế',
            'assistantCar_id.required'=>'Vui lòng chọn phụ xe',
            'start_date.required'=>'Vui lòng nhập ngày đi',
            'start_date.after'=>'Vui lòng không chọn ngày quá khứ',
            'start_time.required'=>'Vui lòng nhập giờ đi',
            'interval_trip.required'=>'Vui lòng thời gian hành trình',
            'start_location.required'=>'Vui lòng chọn địa điểm bắt đầu',
            'trip_price.required'=>'Vui lòng nhập giá cho chuyến đi',
            'end_location.required'=>'Vui lòng chọn địa điểm kết thúc',
            'end_location.different'=>'Địa điểm này đã được chọn',

        ];
    }
}
