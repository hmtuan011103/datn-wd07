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
        $title = 'Trang phân quyền';
        $data = Car::query()->get();
        $model = Seat::query()->get();
        return view('admin.pages.car.main', compact('title', 'data', 'model'));
    }

    public function create()
    {
        $title = 'Trang phân quyền';
        $data = TypeCar::query()->get();
        return view('admin.pages.car.add', compact('title', 'data'));
    }

    public function store(StoreCarRequest $request)
    {
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
        return redirect()->route('index_car');
    }
    public function destroy(string $id)
    {
        $model = Car::query()->findOrFail($id);
        $olbImg = $model->image;
        delete_file($olbImg);
        $model->delete();
        return back();
    }
}
