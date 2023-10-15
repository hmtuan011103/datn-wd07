<?php

namespace App\Http\Controllers\Car\Admin;

use App\Http\Controllers\Car\BaseCarController;
use App\Http\Requests\Car\StoreCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Models\Car;
use App\Models\TypeCar;
use Illuminate\Http\Request;
use App\Models\Seat;

class CarController extends BaseCarController
{
    public function index()
    {
        $data = $this->CarService->index();
        $title = 'Trang phân quyền';
        return view('admin.pages.car.main', compact('title', 'data'));
    }

    public function create()
    {
        $title = 'Trang phân quyền';
        $data = TypeCar::query()->get();
        return view('admin.pages.car.create', compact('title', 'data'));
    }

    public function store(StoreCarRequest $request)
    {
        toastr()->success('Thêm Thành Công!');
        $this->CarService->store($request);
        return redirect()->route('index_car');
    }
    public function edit(Request $request)
    {
        $title = 'Trang phân quyền';
        $data = TypeCar::query()->get();
        $model = Car::find($request->id);
        return view('admin.pages.car.edit',compact('title', 'data','model'));
    }

    public function update(UpdateCarRequest $request ,string $id)
    {
        $this->CarService->update($request,$id);
        toastr()->success('Sửa Thành Công!');
        return redirect()->route('index_car');
    }
    public function destroy(string $id)
    {
        $this->CarService->destroy($id);
        toastr()->success('Xóa Thành Công!');
        return redirect()->route('index_car');
    }
}
