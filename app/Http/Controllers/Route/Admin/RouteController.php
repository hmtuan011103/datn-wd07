<?php

namespace App\Http\Controllers\Route\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Route\BaseRouteController;
use App\Http\Requests\Route\StoreRouteRequest;
use App\Http\Requests\Route\UpdateRouteRequest;
use App\Models\Car;
use App\Models\Location;
use App\Models\Route;
use App\Models\User;
use Illuminate\Http\Request;

class RouteController extends BaseRouteController
{
    public function index(){
        $routes = Route::all();
        $locations = Location::all();
        $title = 'Quản lí tuyến đường';
        return view('admin.pages.route.main', compact('title','routes','locations'));
    }

    public function create(){
        $title = 'Tạo tuyến đường';
        $locations = Location::where('parent_id',null)->get();
        $drivers = User::where('user_type_id',4)->get();
        $assistants = User::where('user_type_id',5)->get();
        $cars = Car::all();
        return view('admin.pages.route.add', compact('title','locations','drivers','assistants','cars'));
    }

    public function store(StoreRouteRequest $request){
        $result = $this->routeService->store($request);
        if ($result) {
            toastr()->success('Thêm thành công.', 'Thành công');
            return redirect()->route('create_route');
        }
    }

    public function edit($id){
        $title = 'Sửa tuyến đường';
        $locations = Location::where('parent_id',null)->get();
        $drivers = User::where('user_type_id',4)->get();
        $assistants = User::where('user_type_id',5)->get();
        $cars = Car::all();
        $route = Route::find($id);
        return view('admin.pages.route.edit', compact('title','locations','drivers','assistants','cars','route'));
    }

    public function update(UpdateRouteRequest $request, $id){
        $result = $this->routeService->update($request,$id);
        if ($result) {
            toastr()->success('Cập nhật thành công.', 'Thành công');
            return redirect()->route('list_route');
        }
    }

    public function delete($id){
        $result = $this->routeService->delete($id);
        if ($result) {
            toastr()->success('Xóa thành công.', 'Thành công');
            return redirect()->route('list_route');
        }
    }

    public function details($id){
        $route = Route::find($id);
        $drivers = User::where('user_type_id',4)->get();
        $assistants = User::where('user_type_id',5)->get();
        $cars = Car::all();
        return response()->json([$route,$drivers,$assistants,$cars],200);
    }
}
