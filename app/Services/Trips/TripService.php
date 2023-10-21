<?php

namespace App\Services\Trips;

use App\Http\Requests\Trip\StoreTripRequest;
use App\Http\Requests\Trip\UpdateTripRequest;
use App\Models\Bills;
use App\Models\Car;
use App\Models\Location;
use App\Models\Trip;
use App\Models\User;
use Carbon\Carbon;

class TripService
{
    public function list()
    {
        return Trip::all();
    }
    public function list_desc()
    {
        // $trips = Trip::all();       
        $trips = Trip::select('trips.id', 'trips.assistantCar_id', 'trips.car_id', 'trips.drive_id', 'trips.start_date', 'trips.start_time', 'trips.start_location', 'trips.status', 'trips.trip_price', 'trips.end_location', 'trips.created_at', 'trips.updated_at', 'cars.name as car_name', 'users.name as user_name')
            ->join('cars', 'cars.id', '=', 'trips.car_id')
            ->join('users', 'users.id', '=', 'trips.drive_id')
            ->orderBy('updated_at', 'DESC')->get();
        return $trips;
    }

    public function create (StoreTripRequest $request) {
        if($request->isMethod('POST')) {
          
            $params = $request->all();
            // dd($params);
            $timeFloat = $request->interval_trip;
            $hourMinute = str_replace(['giờ', 'phút'], '', $timeFloat);
            $hourMinuteArray = explode(' ', $hourMinute);
            $hour = $hourMinuteArray[0];
            $minute = $hourMinuteArray[1];

            // Định dạng thành chuỗi "H:i:s"
            $time = sprintf("%02d:%02d:00", $hour, $minute);

            $params['interval_trip'] = $time;
            // dd($params);
            unset($params['_token']);

            return Trip::create($params);   



        }
    }
    public function get_parent_id()
    {
        return Location::select('locations.name', 'locations.id')->where('locations.parent_id', Null)->get();
    }


    public function edit_trip(StoreTripRequest $request , $id) {
        Trip::find($id);
        if($request->isMethod('POST')) {
            $params = $request->except('proengsoft_jsvalidation','_token');
            // dd($params);
            return Trip::where('id', $id)->update($params);
        }
    }

    public function delete_trip($id)
    {
        Trip::find($id)->delete();
        return redirect()->route('list_trip');

    }
}
