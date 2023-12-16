<?php

namespace App\Http\Requests\DiscountCode;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateDiscountCodeRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            'id_type_discount_code'=>'required',
            'name'=>'required',
            'quantity'=>'required|numeric',
            'start_time'=>'required|after:yesterday|date|date_format:Y-m-d',
            'value'=>'required|numeric|custom_validation',
            // 'value' => 'required_if:id_type_discount_code,1|lt:100',
            // 'code' => 'required|regex:/^[a-zA-Z0-9]+$/u|unique:discount_codes,code,',
            'code' => [
                'required',
                'regex:/^[a-zA-Z0-9]+$/u',
                'between:6,30',
            ],
            'end_time'=>'required|after:start_time|date|date_format:Y-m-d',
        ];
    }

    public function messages()
    {
        return [
            'id_type_discount_code.required'=>'Vui lòng chọn loại mã',
            'name.required'=>'Tên không được để trống',
            'quantity.required'=>'Vui lòng thêm số lượng',
            'start_time.required'=>'Vui lòng nhập ngày bắt đầu',
            'start_time.after'=>'Vui lòng không chọn ngày quá khứ',
            'value.required'=>'Vui lòng thêm giá trị',
            'value.required_if'=>'Vui lòng thêm giá trị',
            'value.numeric'=>'Vui lòng nhập số',
            'value.custom_validation' => 'Mã giảm theo % giá trị phải nhỏ hơn 100.',
            'code.required'=>'Vui lòng thêm mã',
            'code.unique'=>'Mã bạn nhập đã tồn tại',
            'code.between' => "Độ dài của mã từ 6-30 kí tự",
            'code.regex' => 'Mã bạn nhập sai định dạng',
            'end_time.required'=>'Vui lòng nhập ngày kết thúc',
            'end_time.after'=>'Vui lòng không chọn ngày nhỏ hơn ngày bắt đầu',
        ];
    }

    public function withValidator($validator)
    {
        $validator->addExtension('custom_validation', function ($attribute, $value, $parameters, $validator) {
            if ($this->input('id_type_discount_code') == 1 && $value >= 100) {
                return false;
            }
            return true;
        });
    }
}
