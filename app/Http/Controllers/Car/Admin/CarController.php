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
        $carTypeNames = TypeCar::pluck('name');
        $carColors = Car::pluck('color')->unique();
        $carStatuses = Car::pluck('status')->unique();
        $data = $this->CarService->index();
        $title = 'Danh sách xe';


        return view('admin.pages.car.main', compact('title', 'data', 'carTypeNames', 'carColors', 'carStatuses'));
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
        $data = $request->validated();
        $model = Car::query()->findOrFail($id);

        if ($model->trips()->exists()) {
            if (isset($data['status']) && $model->status != $data['status']) {
                toastr()->error('Không thành công', 'Xe Đang Hoạt Động Không Được Sửa Trạng Thái!');
                return redirect()->back()->withInput();
            }
        }
        $model->fill($request->except('image'));
        $olbImg = $model->image;
        if ($request->hasFile('image')) {
            delete_file($olbImg);
            $model->image = upload_file('car', $request->file('image'));

        }
        $seats = Seat::query()->where('car_id', $model->id)->get();
        if ($seats) {
            foreach ($seats as $seat) {
                $seat->delete();
            }
        }
        $model->save();

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
