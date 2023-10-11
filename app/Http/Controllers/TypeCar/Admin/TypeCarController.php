<?php

namespace App\Http\Controllers\TypeCar\Admin;

use App\Http\Controllers\TypeCar\BaseTypeCarController;
use App\Http\Requests\TypeCar\StoreTypeCarRequest;
use App\Http\Requests\TypeCar\UpdateTypeCarRequest;
use Illuminate\Http\Request;
use App\Models\TypeCar;

class TypeCarController extends BaseTypeCarController
{

    public function index()
    {

        $title = 'Trang phân quyền';
        $data = TypeCar::query()->get();
        return view('admin.pages.typecar.main',compact('title','data'));
    }
    public function create()
    {
        $title = 'Trang phân quyền';
        return view('admin.pages.typecar.add',compact('title'));
    }
    public function store(StoreTypeCarRequest $request)
    {
        $model = new TypeCar();
        $model->fill($request->all());
        $model->save();
        return redirect()->route('index_typecar');
    }
    public function edit(Request $request)
    {
        $title = 'Trang phân quyền';
        $model = TypeCar::find($request->id);
        return view('admin.pages.typecar.edit', ['model' => $model],compact('title'));
    }
    public function update(UpdateTypeCarRequest $request, string $id)
    {
        $model = TypeCar::query()->findOrFail($id);
        $model->fill($request->all());
        $model->save();
        return redirect()->route('index_typecar');
    }
    public function destroy(string $id)
    {
        $model = TypeCar::query()->findOrFail($id);
        $model->delete();
        return back();
    }
}
