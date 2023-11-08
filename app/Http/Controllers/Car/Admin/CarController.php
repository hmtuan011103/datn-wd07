<?php

namespace App\Http\Controllers\Car\Admin;

use App\Http\Controllers\Car\BaseCarController;
use App\Http\Requests\Car\StoreCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Models\Car;
use App\Models\Seat;
use App\Models\Trip;
use App\Models\TypeCar;
use Illuminate\Http\Request;

class CarController extends BaseCarController
{
    public function index()
    {
        $data = $this->CarService->index();
        $title = 'Danh sách xe';
        return view('admin.pages.car.main', compact('title', 'data'));
    }

    public function create()
    {
        $title = 'Thêm mới xe';
        $data = TypeCar::query()->get();
        return view('admin.pages.car.create', compact('title', 'data'));
    }

    public function store(StoreCarRequest $request)
    {
        toastr()->success('Thành công','Thêm Thành Công!');
        $this->CarService->store($request);
        return back();
    }

    public function edit(Request $request)
    {

        $model = Car::find($request->id);
        $title = 'Sửa thông tin xe';
        $data = TypeCar::query()->get();
        return view('admin.pages.car.edit',compact('title', 'data','model'));
    }

    public function update(UpdateCarRequest $request ,string $id)
    {
        $this->CarService->update($request,$id);
        toastr()->success('Thành công','Sửa Thành Công!');
        return redirect()->route('index_car');
    }
    public function destroy(string $id)
    {
        $this->CarService->destroy($id);
    }
        public function destroy_all(string $id)
    {
        $this->CarService->destroy_all($id);
    }
}
