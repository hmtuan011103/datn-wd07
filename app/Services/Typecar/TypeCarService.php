<?php

namespace App\Services\Typecar;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Http\Requests\TypeCar\StoreTypeCarRequest;
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
    }
    public function destroy(string $id)
    {
        $model = TypeCar::query()->findOrFail($id);
        $relatedCars = Car::where('id_type_car', $id)->count();

        if ($relatedCars > 0) {
            // Nếu có bản ghi liên quan, bạn không thể xóa TypeCar
            log(123);
            return redirect()->back();
        }

        $model->delete();

    }
}
