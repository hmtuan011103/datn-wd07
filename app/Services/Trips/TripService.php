<?php

namespace App\Services\Trips;

use App\Http\Requests\Trip\StoreTripRequest;
use App\Http\Requests\Trip\UpdateTripRequest;
use App\Models\Car;
use App\Models\Location;
use App\Models\Trip;
use App\Models\TypeCar;
use App\Models\User;
use Carbon\Carbon;

class TripService
{
    public function list() {
        return Trip::all();
    }
    public function list_desc()
    {
        // $trips = Trip::all();
        $trips = Trip::select('trips.id', 'trips.car_id', 'trips.drive_id','trips.start_date','trips.start_time','trips.start_location','trips.status','trips.trip_price','trips.end_location','trips.created_at','trips.updated_at','cars.name as car_name','users.name as user_name')
        ->join('cars', 'cars.id', '=', 'trips.car_id')
        ->join('users', 'users.id', '=', 'trips.drive_id')
        ->orderBy('updated_at', 'DESC')->get();
        return $trips;
    }

    public function create (StoreTripRequest $request) {
        if($request->isMethod('POST')) {

            $params = $request->all();
            unset($params['_token']);

            return Trip::create($params);
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
    // Start API For Page Client

    public function getSeatSelected(string | array $id) {
        $seatSelected = [];
        if (is_array($id)) {
            $data = Trip::query()->with('bills')
                ->whereIn('id', $id)->get();
            foreach ($data as $index => $item) {
                foreach ($item->bills as $seats) {
                    $arraySeats = json_decode($seats->seat_id);
                    foreach ($arraySeats as $seat) {
                        $key = $index === 0 ? 'turn' : 'return';
                        $seatSelected[] = [
                            $key,
                            $seat
                        ];

                    }
                }
            }
        } else {
            $data = Trip::query()->with('bills')->find($id);
            foreach ($data->bills as $seats) {
                $arraySeats = json_decode($seats->seat_id);
                foreach ($arraySeats as $seat) {
                    $seatSelected[] = $seat;
                }
            }
        }

        return $seatSelected;
    }

    public function getSeats(string | array $id) {
        $seats = [];
        if (is_array($id)) {
            $data = Trip::query()->with('car.seats')
                ->whereIn('id',$id)->get();
            foreach ($data as $index => $item) {
                foreach ($item->car->seats as $seat) {
                    $key = $index === 0 ? 'turn' : 'return';
                    $seats[] = [
                        'key' => $key,
                        'id' => $seat->id,
                        'code' => $seat->code_seat
                    ];
                }
            }
        } else {
            $data = Trip::query()->with('car.seats')->find($id);
            foreach ($data->car->seats as $seat) {
                $seats[] = [
                    'id' => $seat->id,
                    'code' => $seat->code_seat
                ];
            }
        }

        return $seats;
    }

    public function getLocationRouteTrip(string | array $id) {
        $locationsChildrenId = [];
        if (is_array($id)) {
            $data = Trip::query()->whereIn('id', $id)->get();
            $checkTripWithArrayStart = [];
            $checkTripWithArrayEnd = [];
            foreach ($data as $item) {
                $checkTripWithArrayStart[] = $item->start_location;
                $checkTripWithArrayEnd[] = $item->end_location;
            }
            $locations = Location::query()
                ->whereIn('name', $checkTripWithArrayStart)
                ->orwhereIn('name', $checkTripWithArrayEnd)
                ->get();
        } else {
            $data = Trip::query()->find($id);
            $locations = Location::query()
                ->where('name', $data->start_location)
                ->orWhere('name', $data->end_location)
                ->get();
        }
        foreach ($locations as $location) {
            $locationsChildrenId[] = $location->id;
        }
        $locationsChildrenName = Location::query()
            ->whereIn('parent_id', $locationsChildrenId)
            ->get();
        $data = [];
        foreach ($locationsChildrenId as $index => $locationChildrenId) {
            foreach ($locationsChildrenName as $item) {
                if($item->parent_id === $locationChildrenId) {
                    $key = $index === 0 ? 'start_location' : 'end_location';
                    $data[] =  [
                        'key' => $key,
                        'id' => $item->id,
                        'name' => $item->name,
                        'parent_id' => $item->parent_id,
                    ];
                }
            }
        }
        return $data;
    }

    public function getdetailRoute(string | array $id) {
        if (is_array($id)) {
            $route = Trip::query()->whereIn('id',$id)->get();
        } else {
            $route = Trip::query()->find($id);
        }
        return $route;
    }
    // End API For Page Client

}
