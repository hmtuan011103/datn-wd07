<?php

namespace App\Http\Controllers\DiscountCode\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DiscountCode\BaseDiscountCodeController;
use App\Http\Requests\DiscountCode\StoreDiscountCodeRequest;
use App\Http\Requests\DiscountCode\UpdateDiscountCodeRequest;
use App\Models\DiscountCode;
use Illuminate\Http\Request;

class DiscountCodeController extends BaseDiscountCodeController
{
    //
    public function index(){
        $title = 'Quản trị mã giảm giá';
        $discount_code = $this->discountcodeService->index();
        return view('admin.pages.discount_code.main', compact('discount_code', 'title'));
    }

    public function add(){
        $title = 'Thêm mã giảm giá';
        return view('admin.pages.discount_code.add', compact('title'));
    }

    public function store(StoreDiscountCodeRequest $request){
        $this->discountcodeService->store($request);
        toastr()->success('Thêm thành công.','Thành công');
        return redirect()->route('create_discount_code');
    }

    public function edit($id){
        $title = 'Sửa mã giảm giá';
        $discount_code = DiscountCode::find($id);
        return view('admin.pages.discount_code.edit', compact('title','discount_code'));
    }

    public function update(UpdateDiscountCodeRequest $request, $id){
        $this->discountcodeService->update($request, $id);
        toastr()->success('Sửa thành công.','Thành công');
        return redirect()->route('list_discount_code');
    }
    public function delete($id)
    {
        $result = $this->discountcodeService->delete($id);
        if ($result) {
            return response()->json(["Xóa thành công!"],200);
        }
    }

}
