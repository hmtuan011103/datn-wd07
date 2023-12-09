<?php

namespace App\Services\Route;

use App\Models\Location;
use App\Models\Route;
use App\Models\Trip;
use Carbon\Carbon;

class RouteService
{
    public function store($request){
        if ($request->isMethod('POST')) {  
            $timeFloat = $request->interval_trip;
            $hourMinute = str_replace(['giờ', 'phút'], '', $timeFloat);
            $hourMinuteArray = explode(' ', $hourMinute);
            $hour = $hourMinuteArray[0];
            $minute = $hourMinuteArray[1];
            $time = sprintf("%02d:%02d:00", $hour, $minute);

            $trip_price = $request->trip_price;
            $fomatPrice = str_replace(".", "", $trip_price);
            $start_location = Location::where('id',$request->start_location)->first()->name;
            $end_location = Location::where('id',$request->end_location)->first()->name;
            $name = $start_location . '-' . $end_location . ' (' . $request->start_time . ')';
            Route::create([
                'name' => $name,
                'start_time' => $request->start_time,
                'interval_trip' => $time,
                'car_id' => json_encode($request->car_id),
                'driver_id' => json_encode($request->driver_id),
                'assistantCar_id' => json_encode($request->assistantCar_id),
                'trip_price' => $fomatPrice,
                'start_location' => $request->start_location,
                'end_location' => $request->end_location,
                'description' => $request->descrition,
                'status' => 1,
            ]);
            return true;
        }
        return false;
    }

    public function update($request,$id){
        if ($request->isMethod('POST')) {  
            $timeFloat = $request->interval_trip;
            $hourMinute = str_replace(['giờ', 'phút'], '', $timeFloat);
            $hourMinuteArray = explode(' ', $hourMinute);
            $hour = $hourMinuteArray[0];
            $minute = $hourMinuteArray[1];
            $time = sprintf("%02d:%02d:00", $hour, $minute);

            $trip_price = $request->trip_price;
            $fomatPrice = str_replace(".", "", $trip_price);
            $start_location = Location::where('id',$request->start_location)->first()->name;
            $end_location = Location::where('id',$request->end_location)->first()->name;
            $name = $start_location . '-' . $end_location . ' (' . $request->start_time . ')';
            $route = Route::find($id);
            $route->update([
                'name' => $name,
                'start_time' => $request->start_time,
                'interval_trip' => $time,
                'car_id' => json_encode($request->car_id),
                'driver_id' => json_encode($request->driver_id),
                'assistantCar_id' => json_encode($request->assistantCar_id),
                'trip_price' => $fomatPrice,
                'start_location' => $request->start_location,
                'end_location' => $request->end_location,
                'description' => $request->description,
                'status' => $request->status,
            ]);
            return true;
        }
        return false;
    }

    public function delete($id){
        $route =  Route::find($id);
        if ($route) {
            $result = $route->delete();
            return $result;
        }
    }
}