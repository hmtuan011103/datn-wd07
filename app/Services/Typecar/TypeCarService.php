<?php

namespace App\Services\Typecar;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Http\Requests\TypeCar\StoreTypeCarRequest;
use App\Models\TypeCar;

class TypeCarService
    {
//    public function index(){
//        $title = 'Trang phân quyền';
//        $data = TypeCar::query()->get();
//        return view('admin.pages.typecar.main',compact('title','data'));
//    }
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
        $model->delete();

    }
}
