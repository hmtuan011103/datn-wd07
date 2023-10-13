<?php

namespace App\Http\Controllers\Trip\Amin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Trip\BaseTripController;
use App\Http\Requests\Trip\StoreTripRequest;
use App\Http\Requests\Trip\UpdateTripRequest;
use App\Models\Car;
use App\Models\Location;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;

class TripController extends BaseTripController
{
    public function list_trip()
    {
        // $trips = Trip::all();       
        $trips = $this->tripService->list();
        return view('admin.pages.trip.main',  compact('trips'), [      
            'title' => 'Danh sách chuyến đi'
        ]);
    }

    public function form_create_trip() {
        $cars = Car::all();
        $users = User::all();
        $locations = Location::all();
        return view('admin.pages.trip.create',compact('cars','users','locations'),[
            'title' => 'Thêm chuyến đi '
        ]);
    }

    public function create_trip (StoreTripRequest $request) {
            $this->tripService->create($request);
            toastr()->success('Thêm thành công.','Thành công');
            return redirect()->route('form_create_trip');
        
    }

    public function edit_trip($id) {
       
        $trip = Trip::find($id);
        $cars = Car::all();
        $users = User::all();
        $locations = Location::all();
        return view('admin.pages.trip.edit', compact('trip','users','cars','locations'),[
            'title' => 'Sửa chuyến đi'
        ]);

    }

    public function save_edit_trip (StoreTripRequest $request , $id) {
            $this->tripService->edit_trip($request,$id);
            toastr()->success('Sửa thành công.','Thành công');
            return redirect()->route('list_trip');
       
    }

    public function delete_trip($id) {
        Trip::find($id)->delete();
        
        toastr()->success('Xóa thành công.','Thành công');
        return redirect()->route('list_trip');

    }

    public function show($id)
    {
        $trip = array();
        $trip[] = Trip::find($id);
        $trip[] = Trip::select('users.name as drive_name')->join('users', 'users.id', '=', 'trips.drive_id')->get();        
        $trip[] = Trip::select('users.name as assistantCar_name')->join('users', 'users.id', '=', 'trips.assistantCar_id')->get();
        $trip[] = Trip::select('cars.name as car_name')->join('cars', 'cars.id', '=', 'trips.car_id')->get();

        
        return response()->json(['data'=>$trip],200); // 200 là mã lỗi
    }
   
}
