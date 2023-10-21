<?php

namespace App\Http\Controllers\Car\Admin;

use App\Http\Controllers\Car\BaseCarController;
use App\Http\Requests\Car\StoreCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Models\Car;
use App\Models\Seat;
use App\Models\TypeCar;
use Illuminate\Http\Request;

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

    public function edit(String $id)
    {

        $model = Car::findOrFail($id);
        $title = 'Trang phân quyền';
        $data = TypeCar::query()->get();
        return view('admin.pages.car.edit',compact('title', 'data','model'));
    }

    public function update(UpdateCarRequest $request ,string $id)
    {


        $model = Car::query()->findOrFail($id);
        dd($model);

        $olbImg = $model->image;
        if ($request->hasFile('image')) {
            $model->image = upload_file('car', $request->file('image'));
            delete_file($olbImg);
        }
        $model->save();
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
//        $this->CarService->update($request,$id);
//        toastr()->success('Sửa Thành Công!');
        return redirect()->route('index_car');
    }
    public function destroy(string $id)
    {
        $this->CarService->destroy($id);
        toastr()->success('Xóa Thành Công!');
        return redirect()->route('index_car');
    }
}
