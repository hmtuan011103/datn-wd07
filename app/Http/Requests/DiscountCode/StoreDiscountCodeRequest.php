<?php

namespace App\Http\Requests\DiscountCode;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Date;

class StoreDiscountCodeRequest extends FormRequest
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
            'id_type_discount_code'=>'required',
            'name'=>'required',
            'quantity'=>'required|numeric',
            'start_time'=>'required|after:yesterday|date|date_format:Y-m-d',
            'value'=>'required|numeric',
            'code'=>'required|unique:discount_codes,code', 
            'end_time'=>'required|after:start_time|date|date_format:Y-m-d',
        ];
    }

    public function messages()
    {
        return [
            'id_type_discount_code.required'=>'Vui lòng chọn loại mã',
            'name.required'=>'Tên không được để trống',
            'quantity.required'=>'Vui lòng thêm số lượng',
            'quantity.numeric'=>'Vui lòng nhập số',
            'start_time.required'=>'Vui lòng nhập ngày bắt đầu',
            'start_time.after'=>'Vui lòng không chọn ngày quá khứ',
            'value.required'=>'Vui lòng thêm giá trị',
            'value.numeric'=>'Vui lòng nhập số',
            'code.required'=>'Vui lòng thêm mã',
            'code.unique'=>'Mã bạn nhập đã tồn tại',
            'end_time.required'=>'Vui lòng nhập ngày kết thúc',
            'end_time.after'=>'Vui lòng không chọn ngày nhỏ hơn ngày bắt đầu',
        ];
    }
}
