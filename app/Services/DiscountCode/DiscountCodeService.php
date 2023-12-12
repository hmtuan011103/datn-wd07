<?php

namespace App\Services\DiscountCode;

use App\Http\Requests\DiscountCode\StoreDiscountCodeRequest;
use App\Http\Requests\DiscountCode\UpdateDiscountCodeRequest;
use App\Models\DiscountCode;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DiscountCodeService
{
    public function index(){
        $discount_code_list = DiscountCode::all();
        return $discount_code_list;
    }

    public function store(StoreDiscountCodeRequest $request){
        $discount_code_list = DiscountCode::create($request->all());
        return $discount_code_list;
    }

    public function update(UpdateDiscountCodeRequest $request,$id){
        $discount_code = DiscountCode::find($id);
        if ($request->isMethod('post')) {
            $discount_code->update($request->all());
            return $discount_code;
        }
    }
    public function delete($id)
    {
        $discount_code =  DiscountCode::find($id);
        if ($discount_code) {
            $result = $discount_code->delete();
            return $result;
        }
    }

    public function getDiscount($code) {
        if($code) {
            $currentDateTime = Carbon::now();
            $discount = DiscountCode::query()
                ->whereRaw('BINARY code = ?', [$code])
                ->where('quantity', '>', 0)
                ->where('start_time', '<=', $currentDateTime)
                ->where('end_time', '>=', $currentDateTime)
                ->get();
            return $discount;
        }
        return false;
    }
}
