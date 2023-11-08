<?php

namespace App\Services\Trips;

use App\Http\Requests\Trip\StoreTripRequest;
use App\Http\Requests\Trip\UpdateTripRequest;
use App\Models\Bill;
use App\Models\Bills;
use App\Models\Car;
use App\Models\Location;
use App\Models\NewPost;
use App\Models\Trip;
use App\Models\TypeCar;
use App\Models\User;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;

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
    public function get_parent_id()
    {
        return Location::select('locations.name', 'locations.id')->where('locations.parent_id', Null)->get();
    }

    public function create(StoreTripRequest $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->all();
            $timeFloat = $request->interval_trip;
            $hourMinute = str_replace(['giờ', 'phút'], '', $timeFloat);
            $hourMinuteArray = explode(' ', $hourMinute);
            $hour = $hourMinuteArray[0];
            $minute = $hourMinuteArray[1];
            $time = sprintf("%02d:%02d:00", $hour, $minute);

            $params['interval_trip'] = $time;
            unset($params['_token']);
            return Trip::create($params);
        }
    }


    public function edit_trip(StoreTripRequest $request, $id)
    {
        Trip::find($id);
        if ($request->isMethod('POST')) {
            $params = $request->except('proengsoft_jsvalidation', '_token');
            $timeFloat = $request->interval_trip;
            $hourMinute = str_replace(['giờ', 'phút'], '', $timeFloat);
            $hourMinuteArray = explode(' ', $hourMinute);
            $hour = $hourMinuteArray[0];
            $minute = $hourMinuteArray[1];
            $time = sprintf("%02d:%02d:00", $hour, $minute);

            $params['interval_trip'] = $time;
            unset($params['_token']);
            return Trip::where('id', $id)->update($params);
        }
    }

    public function delete_trip($id)
    {
        Trip::find($id)->delete();
        return redirect()->route('list_trip');
    }
    // Start API For Page Client

    public function getSeatSelected(string|array $id)
    {
        $seatSelected = [];
        if (is_array($id)) {
            if ($id[0] > $id[1]) {
                $data = Trip::query()->with('bills')
                    ->whereIn('id', $id)
                    ->orderBy('id', 'desc')
                    ->get();
            }
            if ($id[0] < $id[1]) {
                $data = Trip::query()->with('bills')
                    ->whereIn('id', $id)
                    ->get();
            }

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

    public function getSeats(string|array $id)
    {
        $seats = [];
        if (is_array($id)) {
            if ($id[0] > $id[1]) {
                $data = Trip::query()->with('car.seats')
                    ->whereIn('id', $id)
                    ->orderBy('id', 'desc')
                    ->get();
            }
            if ($id[0] < $id[1]) {
                $data = Trip::query()->with('car.seats')
                    ->whereIn('id', $id)
                    ->get();
            }
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

    public function getLocationRouteTrip(string|array $id)
    {
        $data = "";
        if (is_array($id)) {
            if ($id[0] > $id[1]) {
                $value = Trip::query()->whereIn('id', $id)
                    ->orderBy('id', 'desc')->get();
                $data = $value[0];
            }
            if ($id[0] < $id[1]) {
                $value = Trip::query()->whereIn('id', $id)
                    ->get();
                $data = $value[0];
            }
        } else {
            $data = Trip::query()->find($id);
        }
        $locationsStart = Location::query()
            ->where('name', $data->start_location)
            ->get();
        $locationsEnd = Location::query()
            ->Where('name', $data->end_location)
            ->get();
        $locationsStartChildren = Location::query()
            ->where('parent_id', $locationsStart[0]->id)
            ->get();
        $locationsEndChildren = Location::query()
            ->Where('parent_id', $locationsEnd[0]->id)
            ->get();
        $arrayLocationsStartChildren = [];
        $arrayLocationsEndChildren = [];
        foreach ($locationsStartChildren as $item) {
            $arrayLocationsStartChildren[] = [
                'id' => $item->id,
                'name' => $item->name,
                'parent_id' => $item->parent_id
            ];
        }
        foreach ($locationsEndChildren as $item) {
            $arrayLocationsEndChildren[] = [
                'id' => $item->id,
                'name' => $item->name,
                'parent_id' => $item->parent_id
            ];
        }
        return [
            'start_location' => $arrayLocationsStartChildren,
            'end_location' => $arrayLocationsEndChildren,
        ];
    }

    public function getDetailRoute(string|array $id)
    {
        if (is_array($id)) {
            if ($id[0] > $id[1]) {
                $route = Trip::query()->whereIn('id', $id)
                    ->orderBy('id', 'desc')
                    ->get();
            }
            if ($id[0] < $id[1]) {
                $route = Trip::query()->whereIn('id', $id)->get();
            }
        } else {
            $route = Trip::query()->find($id);
        }
        return $route;
    }
    // End API For Page Client

    public function searchTrip($request)
    {
        $currentDate = date('Y/m/d');
        $currentTime = date('H:i:s');
        $currenttime = new DateTime($currentTime);
        $interval = new DateInterval('PT4H00M');
        $currenttime->add($interval);
        $currtime = $currenttime->format('H:i:s');
        if ($request->type_ticket == 1) {

            $trips = Trip::with('car.typeCar')->where(['start_location' => $request->start_location, 'end_location' => $request->end_location, 'start_date' => $request->start_date, 'status' => '1'])->orderBy('start_time')->get();
            $total_trip = count($trips);
            for ($i = 0; $i < $total_trip; $i++) {
                if ($currentDate == $request->start_date) {
                    if ($trips[$i]->start_time < $currtime) {
                        unset($trips[$i]);
                        continue;
                    }
                }
                $total_seat_trip = $trips[$i]->car->typeCar->total_seat;
                $seat_bill = Bills::select('total_seats')->where(['trip_id' => $trips[$i]->id])->get();
                $total_seat_bill = 0;
                foreach ($seat_bill as $value) {
                    $total_seat_bill += intval($value->total_seats);
                }
                $seats = intval($total_seat_trip) - intval($total_seat_bill);
                if ($seats < intval($request->ticket)) {
                    unset($trips[$i]);
                }else{
                    $trips[$i]['seat_empty'] = $seats;
                }

            }
            if ($trips->isEmpty()) {
                return null;
            } else {
                return $trips;
            }
        } else {

            $tripstart = Trip::with('car.typeCar')->where(['start_location' => $request->start_location, 'end_location' => $request->end_location, 'start_date' => $request->start_date, 'status' => '1'])->orderBy('start_time')->get();
            $tripend = Trip::with('car.typeCar')->where(['start_location' => $request->end_location, 'end_location' => $request->start_location, 'start_date' => $request->end_date, 'status' => '1'])->orderBy('start_time')->get();
            $total_trip_start = count($tripstart);
            for ($i = 0; $i < $total_trip_start; $i++) {
                if ($currentDate == $request->start_date) {
                    if ($tripstart[$i]->start_time < $currtime) {
                        unset($tripstart[$i]);
                        continue;
                    }
                }
                $total_seat_trip = $tripstart[$i]->car->typeCar->total_seat;
                $seat_bill = Bills::select('total_seats')->where(['trip_id' => $tripstart[$i]->id])->get();
                $total_seat_bill = 0;
                foreach ($seat_bill as $value) {
                    $total_seat_bill += intval($value->total_seats);
                }
                $seats = intval($total_seat_trip) - intval($total_seat_bill);
                if ($seats < intval($request->ticket)) {
                    unset($tripstart[$i]);
                }else{
                    $tripstart[$i]['seat_empty'] = $seats;
                }
            }
            $total_trip_end = count($tripend);
            for ($i = 0; $i < $total_trip_end; $i++) {
                if ($currentDate == $request->end_date) {
                    if ($tripend[$i]->end_time < $currtime) {
                        unset($tripend[$i]);
                        continue;
                    }
                }
                $total_seat_trip = $tripend[$i]->car->typeCar->total_seat;
                $seat_bill = Bills::select('total_seats')->where(['trip_id' => $tripend[$i]->id])->get();
                $total_seat_bill = 0;
                foreach ($seat_bill as $value) {
                    $total_seat_bill += intval($value->total_seats);
                }

                $seats = intval($total_seat_trip) - intval($total_seat_bill);

                if ($seats < intval($request->ticket)) {
                    unset($tripend[$i]);
                }else{
                    $tripend[$i]['seat_empty'] = $seats;
                }
            }
            if ($tripstart->isEmpty() || $tripend->isEmpty()) {
                return null;
            } else {
                return [$tripstart, $tripend];
            }
        }
    }

    public function getData()
    {
        $currentDateTime = Carbon::now();
    
        $trips = DB::table('trips')
            ->join('cars', 'trips.car_id', '=', 'cars.id')
            ->join('type_cars', 'cars.id_type_car', '=', 'type_cars.id')
            ->select('trips.*', 'type_cars.name as car_type_name')
            ->orderBy('start_location', 'asc')
            ->get();
    
        $availableTrips = [];    
        foreach ($trips as $key => $trip) {
            $tripStartDate = Carbon::parse($trip->start_date);
            $tripStartTime = Carbon::parse($trip->start_time);
        
            $tripDateTime = $tripStartDate->copy()->setTime($tripStartTime->hour, $tripStartTime->minute, $tripStartTime->second);
        
            if ($tripDateTime->isSameDay($currentDateTime) && $tripDateTime->lessThan($currentDateTime->copy()->addHours(4))) {
                unset($trips[$key]);
            }else{
                $totalBookedSeats = DB::table('bills')
                    ->where('trip_id', $trip->id)
                    ->sum('total_seats');

    
                $carTotalSeat = DB::table('cars')
                    ->join('type_cars', 'cars.id_type_car', '=', 'type_cars.id')
                    ->where('cars.id', $trip->car_id)
                    ->value('type_cars.total_seat');
                $remainingSeats = $carTotalSeat - $totalBookedSeats;
    
                if ($remainingSeats > 0) {
                    $trip->remaining_seats = $remainingSeats;
                    $availableTrips[] =  $trip;
                }
            }
        }
        $availableTripDetails = [];
        foreach ($availableTrips as $availableTrip) {
            $tripDetails = DB::table('trips')
                ->join('cars', 'trips.car_id', '=', 'cars.id')
                ->join('type_cars', 'cars.id_type_car', '=', 'type_cars.id')
                ->where('trips.id', $availableTrip->id)
                ->orderBy('start_location', 'asc')
                ->select('trips.*', 'type_cars.name as car_type_name')
                ->first();
            $availableTripDetails[] = (array) $tripDetails;
        }
    
        return $availableTripDetails;
    } 


    public function search($request)
    {
        $currentDateTime = Carbon::now()->addHours(4);
        $searchStart = $request->input('search_start');
        $searchEnd = $request->input('search_end');

        $trips = Trip::select('trips.*', 'type_cars.name as car_type_name')
            ->join('cars', 'trips.car_id', '=', 'cars.id')
            ->join('type_cars', 'cars.id_type_car', '=', 'type_cars.id')
            ->where(function ($query) use ($searchStart, $searchEnd) {
                $query->where('start_location', 'LIKE', '%' . $searchStart . '%')
                    ->where('end_location', 'LIKE', '%' . $searchEnd . '%');
            })
            ->orderBy('start_location', 'asc')
            ->get();

            $availableTrips = [];

            foreach ($trips as $key => $trip) {
                $tripStartDate = Carbon::parse($trip->start_date);
                $tripStartTime = Carbon::parse($trip->start_time);
            
                $tripDateTime = $tripStartDate->copy()->setTime($tripStartTime->hour, $tripStartTime->minute, $tripStartTime->second);
            
                if ($tripDateTime->isSameDay($currentDateTime) && $tripDateTime->lessThan($currentDateTime->copy()->addHours(4))) {
                    unset($trips[$key]);
                }else{
                    $totalBookedSeats = DB::table('bills')
                        ->where('trip_id', $trip->id)
                        ->sum('total_seats');
    
        
                    $carTotalSeat = DB::table('cars')
                        ->join('type_cars', 'cars.id_type_car', '=', 'type_cars.id')
                        ->where('cars.id', $trip->car_id)
                        ->value('type_cars.total_seat');
                    $remainingSeats = $carTotalSeat - $totalBookedSeats;
        
                    if ($remainingSeats > 0) {
                        $trip->remaining_seats = $remainingSeats;
                        $availableTrips[] =  $trip;
                    }
                }
            }

        return $availableTrips;
    }
    public function get_all_type_car()
    {
        $type_car = TypeCar::select('type_seats')->get();
        return $type_car;
    }
    public function get_total_seat_empty($request)
    {
        $bill_seat = Bill::select('total_seats')->where(['trip_id' => $request])->get();
        $total_seat_bill = 0;
        foreach ($bill_seat as $key) {
            $total_seat_bill += $key->total_seats;
        }
        $trip = Trip::with('car.typeCar')->where(['id' => $request])->get();
        $total_seat_trip = $trip[0]->car->typeCar->total_seat;
        $seats = intval($total_seat_trip) - intval($total_seat_bill);
        return $seats;
    }

    public function getPopularTripList()
    {
        $popularTrips = Trip::select(
            'trips.id',
            'trips.start_time',
            'trips.start_location',
            'trips.end_location',
            'trips.trip_price',
            'trips.interval_trip',
            DB::raw('SUM(bills.total_seats) as total_seat_sold'),
            'startLocation.image as start_location_image',
            'endLocation.image as end_location_image'
        )
            ->join('bills', function ($join) {
                $join->on('bills.trip_id', '=', 'trips.id')
                    ->where('bills.status_pay', '=', 1);
            })
            ->join('locations as startLocation', function ($join) {
                $join->on(DB::raw('trips.start_location'), '=', 'startLocation.name');
            })
            ->join('locations as endLocation', function ($join) {
                $join->on(DB::raw('trips.end_location'), '=', 'endLocation.name');
            })
            ->groupBy('trips.id', 'trips.start_time', 'trips.start_location', 'trips.end_location', 'trips.trip_price', 'startLocation.image', 'endLocation.image', 'trips.interval_trip')
            ->orderByRaw('SUM(bills.total_seats) DESC')
            ->take(12)
            ->get();

        return collect($popularTrips)->toArray();
    }

    public function getRecentNews()
    {
        $recentNews = NewPost::orderBy('created_at', 'desc')->take(12)->get();

        return collect($recentNews)->toArray();
    }
}
