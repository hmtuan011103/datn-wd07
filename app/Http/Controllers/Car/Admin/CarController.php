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
        $model = Car::query()->findOrFail($id);
        $model->fill($request->all());
        $olbImg = $model->image;
        if ($request->hasFile('image')) {
            $model->image = upload_file('car', $request->file('image'));
            delete_file($olbImg);
        }

        $model->save();
        toastr()->success('Thành công','Sửa Thành Công!');

       $seats = Seat::query()->where('car_id', $model->id)->get();
       if ($seats) {
           foreach ($seats as $seat) {
               $seat->delete();
           }
       }

       $id_car = $model->id;
       $request = $request->id_type_car;
       $data = TypeCar::find($request);
       $seat = $data->total_seat;
       for ($i = 1; $i <= $seat; $i++) {
           $seats = Seat::query();
           if ($i <= 24) {
               if ($i < 10){
                   $seats->create([
                       'car_id' => $id_car,
                       'code_seat' => 'A0' . $i,
                   ]);
               }else{
                   $seats->create([
                       'car_id' => $id_car,
                       'code_seat' => 'A' . $i,
                   ]);
               }

           } else {
               if ($i < 34){
                   $seats->create([
                       'car_id' => $id_car,
                       'code_seat' => 'B0' . ($i-24),
                   ]);
               }else{
                   $seats->create([
                       'car_id' => $id_car,
                       'code_seat' => 'B' . ($i-24),
                   ]);
               }
           }
       }
       return redirect()->route('index_car');
    }
    public function destroy(string $id)
    {
        $model = Car::query()->findOrFail($id);
        $olbImg = $model->image;
        delete_file($olbImg);
        $seats = Seat::query()->where('car_id', $model->id)->get();
        if ($seats) {
            foreach ($seats as $seat) {
                $seat->delete();
            }
        }
       $relatedTrips = Trip::where('car_id', $model->id)->get();

       if ($relatedTrips->isEmpty()) {
           $model->delete();
           return response()->json(['message' => 'Xóa loại xe thành công'], 200);
       }

        return response()->json(['message' => 'Không thể xóa loại xe'], 400);
    }
}
