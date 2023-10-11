<?php

namespace App\Services\Car;
use App\Http\Requests\Car\StoreCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Models\Seat;
use App\Models\type_car;
use App\Models\Car;
use App\Models\TypeCar;
use http\Env\Request;

class CarService
{
    public function store(StoreCarRequest $request)
    {

        $model = new Car();
        $model->fill($request->except('image'));
        if ($request->hasFile('image')) {
            $model->image = upload_file('car', $request->file('image'));
        }
        $model->save();
        $id_car = $model->id;
        $request = $request->id_type_car;
        $data = TypeCar::find($request);
//      So luong ghe
        $seat = $data->total_seat;
        for ($i = 1; $i <= $seat; $i++) {
            $model = Seat::query();
            if ($i <= 24) {
                $model->create([
                    'car_id' => $id_car,
                    'code_seat' => 'A' . $i,
                ]);
            } else {
                $model->create([
                    'car_id' => $id_car,
                    'code_seat' => 'B' . $i,
                ]);
            }
        }
    }
    public function update( $request , string $id){
        $model = Car::query()->findOrFail($id);;
        $model->fill($request->except('image'));
        $olbImg = $model->image;
        if ($request->hasFile('image')) {
            $model->image = upload_file('car', $request->file('image'));
            delete_file($olbImg);
        }
        $model->save();
    }
}

