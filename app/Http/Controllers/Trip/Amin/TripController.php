<?php

namespace App\Http\Controllers\Trip\Amin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Trip\BaseTripController;
use App\Http\Requests\Trip\StoreTripRequest;
use App\Http\Requests\Trip\UpdateTripRequest;
use App\Models\Car;
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
        return view('admin.pages.trip.create',compact('cars','users'),[
            'title' => 'Thêm chuyến đi '
        ]);
    }

    public function create_trip (StoreTripRequest $request) {
            $this->tripService->create_trip($request);
            // toastr()->success('Thêm thành công.','Thành công');
            return redirect()->route('form_create_trip');
        
    }

    public function edit_trip($id) {
        $trip = Trip::find($id);
        $cars = Car::all();
        $users = User::all();
        return view('admin.pages.trip.edit', compact('trip','users','cars'),[
            'title' => 'Sửa chuyến đi'
        ]);

    }

    public function save_edit_trip (UpdateTripRequest $request , $id) {
            $this->tripService->edit_trip($request,$id);
            toastr()->success('Sửa thành công.','Thành công');
            return redirect()->route('list_trip');
       
    }

    public function delete_trip($id) {
        Trip::find($id)->delete();
        toastr()->success('Xóa thành công.','Thành công');
        return redirect()->route('list_trip');

    }
   
}
