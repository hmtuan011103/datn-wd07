<?php

namespace App\Services\Trips;

use App\Http\Requests\Trip\StoreTripRequest;
use App\Http\Requests\Trip\UpdateTripRequest;
use App\Models\Car;
use App\Models\Trip;
use App\Models\User;
use Carbon\Carbon;

class TripService
{
    public function list()
    {
        // $trips = Trip::all();       
        $trips = Trip::select('trips.id', 'trips.car_id', 'trips.drive_id','trips.start_date','trips.start_time','trips.start_location','trips.status','trips.trip_price','trips.end_location','cars.name as car_name','users.name as user_name')
        ->join('cars', 'cars.id', '=', 'trips.car_id')
        ->join('users', 'users.id', '=', 'trips.drive_id')
        ->get();
        return $trips;
    }

    public function create (StoreTripRequest $request) {
        if($request->isMethod('POST')) {
          
            $trip = new Trip();
            //  date ('d-m-Y', strtotime ($request->start_date));
            $trip->car_id = $request->car_id;
            $trip->drive_id = $request->drive_id;
            $trip->assistantCar_id = $request->assistantCar_id;
            $trip->start_date = Carbon::parse($request->start_date)->format('Y/m/d');
            $trip->start_time = $request->start_time;
            $trip->trip_price = $request->trip_price;
            $trip->start_location = $request->start_location;
            $trip->end_location = $request->end_location;
            $trip->status = $request->status;
            $trip->save();


        }
    }


    public function edit_trip(StoreTripRequest $request , $id) {
        Trip::find($id);
        if($request->isMethod('POST')) {
            $params = $request->except('proengsoft_jsvalidation','_token');  
            // dd($params);    
            return Trip::where('id',$id)->update($params);
        }
       
    }

    public function delete_trip($id) {
        Trip::find($id)->delete();
        return redirect()->route('list_trip');

    }
}
