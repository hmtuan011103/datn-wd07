<?php

namespace App\Http\Controllers\TypeCar\Admin;

use App\Http\Controllers\TypeCar\BaseTypeCarController;
use App\Http\Requests\TypeCar\StoreTypeCarRequest;
use App\Http\Requests\TypeCar\UpdateTypeCarRequest;
use Illuminate\Http\Request;
use App\Models\TypeCar;
use App\Models\Car;

class TypeCarController extends BaseTypeCarController
{

    public function index()
    {
        $title = 'Danh sách loại xe';
        $data = TypeCar::query()->get();
        return view('admin.pages.typecar.main',compact('title','data'));
    }
    public function create()
    {
        $title = 'Tạo mới loại xe';
        return view('admin.pages.typecar.create',compact('title'));
    }
    public function store(StoreTypeCarRequest $request)
    {
        toastr()->success('Thành công','Thêm Thành Công!');
        $this->TypeCarService->store($request);
        return back();
    }
    public function edit(Request $request)
    {
        $title = 'Sửa loại xe';
        $model = TypeCar::find($request->id);
        return view('admin.pages.typecar.edit', ['model' => $model],compact('title'));
    }
    public function update(UpdateTypeCarRequest $request, string $id)
    {
        $this->TypeCarService->update($request,$id);
        toastr()->success('Thành công','Sửa Thành Công!');
        return redirect()->route('index_typecar');
    }
    public function destroy(string $id)
    {
        $model = TypeCar::query()->findOrFail($id);

        $relatedCars = Car::where('id_type_car', $model->id)->get();

        if ($relatedCars->isEmpty()) {
            $model->delete();
            return response()->json(['message' => 'Xóa loại xe thành công'], 200);
        }

        return response()->json(['message' => 'Không thể xóa loại xe'], 400);
    }
}
