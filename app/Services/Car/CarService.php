<?php

namespace App\Services\Car;

//use App\Http\Requests\Car\UpdateCarRequest;
use App\Http\Requests\Car\StoreCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Models\Seat;
//use App\Models\type_car;
use App\Models\Car;
use App\Models\TypeCar;
use http\Env\Request;

class CarService
{
    public function index()
    {
        $data = Car::select('cars.id', 'cars.color', 'cars.id_type_car', 'cars.description',
            'cars.image', 'cars.license_plate', 'cars.name', 'cars.status',
            'type_cars.name as typecar_name',
            'type_cars.total_seat as typecar_total_seat',
        )
            ->join('type_cars', 'type_cars.id', '=', 'cars.id_type_car')
            ->get();
        return $data;
    }

    public function store(StoreCarRequest $request)
    {
        $model = new Car($request->all());
        if ($request->hasFile('image')) {
            $model->image = upload_file('car', $request->file('image'));
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
    }

    public function update(UpdateCarRequest $request, string $id)
    {

        $model = Car::query()->findOrFail($id);
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
        $model->delete();
    }
}

