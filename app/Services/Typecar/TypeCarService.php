<?php

namespace App\Services\Typecar;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Http\Requests\TypeCar\StoreTypeCarRequest;
use App\Models\Seat;
use App\Models\TypeCar;
use App\Models\Car;

class TypeCarService
    {
    public function store($request){
        $model = new TypeCar();
        $model->fill($request->all());
        $model->save();
    }
    public function update( $request , string $id){
        $model = TypeCar::query()->findOrFail($id);
        $model->fill($request->all());
        $model->save();
        $relatedCars = Car::where('id_type_car', $model->id)->get();
        foreach ($relatedCars as $car) {
            $this->updateCarSeats($car);
        }
    }
    public function updateCarSeats(Car $car)
    {
        $seats = Seat::query()->where('car_id', $car->id)->get();
        foreach ($seats as $seat) {
            $seat->delete();
        }
        $data = $car->typeCar;
        $seat = $data->total_seat;
        $numberFloor = $data->number_floors;
        $id_car = $car->id;
        for ($i = 1; $i <= $seat; $i++) {
            $seats = Seat::query();
            if ($numberFloor === 1) {
                if ($i < 10){
                    $seats->create([
                        'car_id' => $id_car,
                        'code_seat' => 'A0' . $i,
                    ]);
                } else {
                    $seats->create([
                        'car_id' => $id_car,
                        'code_seat' => 'A' . $i,
                    ]);
                }
            } else {
                $seatSecondFloor = $seat / 2;
                if ($seatSecondFloor < 10) {
                    $seats->create([
                        'car_id' => $id_car,
                        'code_seat' => 'A0' . $i,
                    ]);
                    $seats->create([
                        'car_id' => $id_car,
                        'code_seat' => 'B0' . ($i - 24),
                    ]);
                } else {
                    $seats->create([
                        'car_id' => $id_car,
                        'code_seat' => 'A' . $i,
                    ]);
                    $seats->create([
                        'car_id' => $id_car,
                        'code_seat' => 'B' . ($i - 24),
                    ]);
                }
            }
        }
    }
    public function destroy(string $id)
    {
        $model = TypeCar::query()->findOrFail($id);

        $relatedCars = Car::where('id_type_car', $model->id)->get();

        if ($relatedCars->isEmpty()) {
            $model->delete();
            return  toastr()->success('Thành công','Xóa Thành Công!');
        }

        return  toastr()->error('Không Thành Công','Xóa Không Thành Công');

    }
    public function destroy_all(string $id)
    {
        $model = TypeCar::query()->findOrFail($id);

        $relatedCars = Car::where('id_type_car', $model->id)->get();

        if ($relatedCars->isEmpty()) {
            $model->delete();
        }
    }
}
