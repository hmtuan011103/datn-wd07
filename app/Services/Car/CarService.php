<?php

namespace App\Services\Car;

use App\Http\Requests\Car\StoreCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Models\Seat;
//use App\Models\type_car;
use App\Models\Car;
use App\Models\Trip;
use App\Models\TypeCar;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        DB::beginTransaction();
        try{
            $model = new Car($request->all());
            if ($request->hasFile('image')) {
                $model->image = upload_file('car', $request->file('image'));
            }

            $model->save();
            $id_car = $model->id;
            $request = $request->id_type_car;
            $data = TypeCar::find($request);
            $seat = $data->total_seat;
            $numberFloor = $data->number_floors;
            for ($i = 1; $i <= $seat; $i++) {
                $seats = Seat::query();
                if ($numberFloor === 1) {
                    if ($i < 10) {
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
                }
                if($numberFloor === 2){
                    $seatsPerFloor = $seat / 2;
                    if ($i <= $seatsPerFloor) {
                        $seatCode = ($i < 10) ? 'A0' . $i : 'A' . $i;
                    } else {
                        $index = $i - $seatsPerFloor;
                        $seatCode = ($index < 10) ? 'B0' . $index : 'B' . $index;
                    }

                    $seats->create([
                        'car_id' => $id_car,
                        'code_seat' => $seatCode,
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Có lỗi xảy ra', [$exception]);
            return false;
        }
    }



    public function destroy(string $id)
    {
        $model = Car::query()->findOrFail($id);
        $olbImg = $model->image;

        $relatedTrips = Trip::where('car_id', $model->id)->get();

        if ($relatedTrips->isEmpty()) {
            delete_file($olbImg);
            $seats = Seat::query()->where('car_id', $model->id)->get();
            if ($seats) {
                foreach ($seats as $seat) {
                    $seat->delete();
                }
            }
            $model->delete();
            return  toastr()->success('Thành công','Xóa Thành Công!');
        }
        return  toastr()->error('Không Thành Công','Xóa Không Thành Công');

    }
    public function destroy_all(string $id)
    {
        $model = Car::query()->findOrFail($id);
        $olbImg = $model->image;
        $relatedTrips = Trip::where('car_id', $model->id)->get();
        if ($relatedTrips->isEmpty()) {
            delete_file($olbImg);
            $seats = Seat::query()->where('car_id', $model->id)->get();
            if ($seats) {
                foreach ($seats as $seat) {
                    $seat->delete();
                }
            }
            $model->delete();


        };
    }

}
