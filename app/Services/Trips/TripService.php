<?php

namespace App\Services\Trips;

use App\Http\Requests\Trip\StoreTripRequest;
use App\Http\Requests\Trip\UpdateTripRequest;
use App\Models\Bill;
use App\Models\Bills;
use App\Models\Car;
use App\Models\Location;
use App\Models\NewPost;
use App\Models\Route;
use App\Models\Seat;
use App\Models\Trip;
use App\Models\TypeCar;
use App\Models\User;
use App\Models\UserRole;
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

    // public function list_desc()
    // {
    //     // Lấy danh sách các trip_id từ bảng bills
    //     $tripIdsInBills = Bill::pluck('trip_id')->toArray();

    //     $trips = Trip::select('trips.id', 'trips.assistantCar_id', 'trips.car_id', 'trips.drive_id', 'trips.start_date', 'trips.start_time', 'trips.start_location', 'trips.status', 'trips.trip_price', 'trips.end_location', 'trips.created_at', 'trips.updated_at', 'cars.name as car_name', 'users.name as user_name')
    //         ->join('cars', 'cars.id', '=', 'trips.car_id')
    //         ->join('users', 'users.id', '=', 'trips.drive_id')
    //         ->orderBy('updated_at', 'DESC')->get();

    //     // Thêm điều kiện kiểm tra và ẩn nút xóa nếu trip_id đã có trong bảng bills
    //     foreach ($trips as $trip) {
    //         if (in_array($trip->id, $tripIdsInBills)) {
    //             $trip->canDelete = false; // Thêm thuộc tính canDelete để xác định có thể xóa hay không
    //         } else {
    //             $trip->canDelete = true;
    //         }
    //     }

    //     return $trips;
    // }

    public function list_desc($request)
    {
        $tripQuery = Trip::select(
            'trips.id',
            'trips.assistantCar_id',
            'trips.car_id',
            'trips.drive_id',
            'trips.start_date',
            'trips.start_time',
            'trips.start_location',
            'trips.status',
            'trips.trip_price',
            'trips.end_location',
            'trips.created_at',
            'trips.updated_at',
            'cars.name as car_name',
            'users.name as user_name'
        )
            ->join('cars', 'cars.id', '=', 'trips.car_id')
            ->join('users', 'users.id', '=', 'trips.drive_id')
            ->orderBy('updated_at', 'DESC');

        if ($request->isMethod('GET')) {
            $startDate = $request->input('departure-date');
            $driver = $request->input('driver');
            $assistant = $request->input('assistant');
            $startLocation = $request->input('start_location');
            $endLocation = $request->input('end_location');

            if ($startDate) {
                $tripQuery->whereDate('start_date', $startDate);
            }
            if ($driver) {
                $tripQuery->where('drive_id', $driver);
            }
            if ($assistant) {
                $tripQuery->where('assistantCar_id', $assistant);
            }
            if ($startLocation) {
                $tripQuery->where('start_location', $startLocation);
            }
            if ($endLocation) {
                $tripQuery->where('end_location', $endLocation);
            }

            // dd($trips);
        }
        $trips = $tripQuery->get();


        // Lấy danh sách các trip_id từ bảng bills
        $tripIdsInBills = Bill::pluck('trip_id')->toArray();

        // Thêm điều kiện kiểm tra và ẩn nút xóa nếu trip_id đã có trong bảng bills
        foreach ($trips as $trip) {
            $trip->canDelete = !in_array($trip->id, $tripIdsInBills);
        }

        return $trips;
    }


    public function get_parent_id()
    {
        return Location::select('locations.name', 'locations.id')->where('locations.parent_id', Null)->get();
    }



    // public function create(StoreTripRequest $request)
    // {
    //     if ($request->isMethod('POST')) {

    //         $repeat = $request->has('repeat');

    //         $startDate = Carbon::parse($request->start_date);


    //         $route = Route::find($request->route_id);

    //         Trip::create([
    //             'start_date' => $startDate,
    //             'start_time' => $route->start_time,
    //             'interval_trip' => $route->interval_trip,
    //             'car_id' => $request->car_id,
    //             'drive_id' => $request->drive_id,
    //             'assistantCar_id' => $request->assistantCar_id,
    //             'trip_price' => $route->trip_price,
    //             'start_location' => $route->start_location,
    //             'end_location' => $route->end_location,
    //             'status' => $route->status,
    //             'route_id' => $route->id,

    //         ]);

    //         if ($repeat) {
    //             $numberOfDays = $request->input('number_of_days', 0); // Số ngày lặp lại, có thể lấy từ form
    //             for ($i = 1; $i <= $numberOfDays; $i++) {
    //                 $nextDate = $startDate->copy()->addDays($i); // Tăng ngày lên

    //                 Trip::create([
    //                     'start_date' => $nextDate,
    //                     'start_time' => $route->start_time,
    //                     'interval_trip' => $route->interval_trip,
    //                     'car_id' => $request->car_id,
    //                     'drive_id' => $request->drive_id,
    //                     'assistantCar_id' => $request->assistantCar_id,
    //                     'trip_price' => $route->trip_price,
    //                     'start_location' => $route->start_location,
    //                     'end_location' => $route->end_location,
    //                     'status' => $route->status,
    //                     'route_id' => $route->id,
    //                 ]);
    //             }
    //         }
    //     }
    // }

    public function create(StoreTripRequest $request)
    {
        if ($request->isMethod('POST')) {
            $repeat = $request->has('repeat');
            $startDate = Carbon::parse($request->start_date);
            $route = Route::find($request->route_id);

            $startLocation = Location::find($route->start_location);
            $start_Location = $startLocation->name;

            $endLocation = Location::find($route->end_location);
            $end_Location = $endLocation->name;

            Trip::create([
                'start_date' => $startDate,
                'start_time' => $route->start_time,
                'interval_trip' => $route->interval_trip,
                'car_id' => $request->car_id,
                'drive_id' => $request->drive_id,
                'assistantCar_id' => $request->assistantCar_id,
                'trip_price' => $route->trip_price,
                'start_location' => $start_Location,
                'end_location' => $end_Location,
                'status' => $route->status,
                'route_id' => $route->id,

            ]);

            if ($repeat) {
                $numberOfDays = $request->input('number_of_days', 0); // Số ngày lặp lại, có thể lấy từ form
                for ($i = 0; $i < $numberOfDays; $i++) {
                    $nextDate = $startDate->copy()->addDays($i); // Tăng ngày lên

                    // Kiểm tra xem đã có chuyến đi trùng hay không
                    $existingTrip = Trip::where('start_date', $nextDate)

                        ->where('route_id', $route->id)
                        ->exists();

                    if (!$existingTrip) {
                        Trip::create([
                            'start_date' => $nextDate,
                            'start_time' => $route->start_time,
                            'interval_trip' => $route->interval_trip,
                            'car_id' => $request->car_id,
                            'drive_id' => $request->drive_id,
                            'assistantCar_id' => $request->assistantCar_id,
                            'trip_price' => $route->trip_price,
                            'start_location' => $start_Location,
                            'end_location' => $end_Location,
                            'status' => $route->status,
                            'route_id' => $route->id,
                        ]);
                    }
                }
            }
        }
    }



    public function edit_trip(StoreTripRequest $request, $id)
    {
        $trip = Trip::find($id);

        if ($request->isMethod('POST')) {
            $route = Route::find($request->route_id);
            $startDate = Carbon::parse($request->start_date);
            $startLocation = Location::find($route->start_location);
            $start_Location = $startLocation->name;

            $endLocation = Location::find($route->end_location);
            $end_Location = $endLocation->name;


            $trip->start_date = $startDate;
            $trip->start_time = $route->start_time;
            $trip->interval_trip = $route->interval_trip;
            $trip->car_id = $request->car_id;
            $trip->drive_id = $request->drive_id;
            $trip->assistantCar_id = $request->assistantCar_id;
            $trip->trip_price = $route->trip_price;
            $trip->start_location = $start_Location;
            $trip->end_location = $end_Location;
            $trip->status = $route->status;
            $trip->route_id = $route->id;

            $trip->save();
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
                $route = Trip::query()->with('car.typeCar')->whereIn('id', $id)
                    ->orderBy('id', 'desc')
                    ->get();
            }
            if ($id[0] < $id[1]) {
                $route = Trip::query()->with('car.typeCar')->whereIn('id', $id)->get();
            }
        } else {
            $route = Trip::query()->with('car.typeCar')->find($id);
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
                $seat_bill = Bills::select('total_seats', 'seat_id')->where(['trip_id' => $trips[$i]->id])->get();
                $seat_id = [];
                foreach ($seat_bill as $value) {
                    $seat_id = array_merge($seat_id, json_decode($value->seat_id, true));
                }
                $seat_code = Seat::select('code_seat')->whereIn('code_seat', $seat_id)->get();
                $seat_code_car = Seat::select('code_seat')->where('car_id', $trips[$i]->car->id)->get();
                $seat_code_array_car = [];
                foreach ($seat_code_car as $value) {
                    $seat_code_array_car[] = $value->code_seat;
                }
                $seat_code_array = [];
                foreach ($seat_code as $value) {
                    $seat_code_array[] = $value->code_seat;
                }
                $seat_code_empty = array_diff($seat_code_array_car, $seat_code_array);
                $trips[$i]['seat_code'] = $seat_code_empty;
                $seats = count($seat_code_empty);
                if ($seats < intval($request->ticket)) {
                    unset($trips[$i]);
                } else {
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
                $seat_bill = Bills::select('total_seats', 'seat_id')->where(['trip_id' => $tripstart[$i]->id])->get();
                $seat_id = [];
                foreach ($seat_bill as $value) {
                    $seat_id = array_merge($seat_id, json_decode($value->seat_id, true));
                }
                $seat_code = Seat::select('code_seat')->whereIn('code_seat', $seat_id)->get();
                $seat_code_car = Seat::select('code_seat')->where('car_id', $tripstart[$i]->car->id)->get();
                $seat_code_array_car = [];
                foreach ($seat_code_car as $value) {
                    $seat_code_array_car[] = $value->code_seat;
                }
                $seat_code_array = [];
                foreach ($seat_code as $value) {
                    $seat_code_array[] = $value->code_seat;
                }
                $seat_code_empty = array_diff($seat_code_array_car, $seat_code_array);
                $tripstart[$i]['seat_code'] = $seat_code_empty;
                $seats = count($seat_code_empty);
                if ($seats < intval($request->ticket)) {
                    unset($tripstart[$i]);
                } else {
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
                $seat_bill = Bills::select('total_seats', 'seat_id')->where(['trip_id' => $tripend[$i]->id])->get();
                $seat_id = [];
                foreach ($seat_bill as $value) {
                    $seat_id = array_merge($seat_id, json_decode($value->seat_id, true));
                }
                $seat_code = Seat::select('code_seat')->whereIn('code_seat', $seat_id)->get();
                $seat_code_car = Seat::select('code_seat')->where('car_id', $tripend[$i]->car->id)->get();
                $seat_code_array_car = [];
                foreach ($seat_code_car as $value) {
                    $seat_code_array_car[] = $value->code_seat;
                }
                $seat_code_array = [];
                foreach ($seat_code as $value) {
                    $seat_code_array[] = $value->code_seat;
                }
                $seat_code_empty = array_diff($seat_code_array_car, $seat_code_array);
                $tripend[$i]['seat_code'] = $seat_code_empty;
                $seats = count($seat_code_empty);

                if ($seats < intval($request->ticket)) {
                    unset($tripend[$i]);
                } else {
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

            if ($tripDateTime->greaterThan($currentDateTime)) {
                if ($tripDateTime->isSameDay($currentDateTime) && $tripDateTime->lessThan($currentDateTime->copy()->addHours(4))) {
                    unset($trips[$key]);
                } else {
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

    public function getDataFilter()
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

            if ($tripDateTime->greaterThan($currentDateTime)) {
                if ($tripDateTime->isSameDay($currentDateTime) && $tripDateTime->lessThan($currentDateTime->copy()->addHours(4))) {
                    unset($trips[$key]);
                } else {
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

            if ($tripDateTime->greaterThan($currentDateTime)) {
                if ($tripDateTime->isSameDay($currentDateTime) && $tripDateTime->lessThan($currentDateTime->copy()->addHours(4))) {
                    unset($trips[$key]);
                } else {
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
        }

        return $availableTrips;
    }
    public function get_all_type_car()
    {
        $type_car = TypeCar::select('type_seats')->distinct()->get();
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

    public function getDrive($id)
    {
        $trip = Trip::find($id);
        if ($trip) {
            $driver = User::query()->where('user_type_id', 4)
                ->where('id', $trip->drive_id)
                ->first();

            return $driver;
        }
        return null;
    }

    public function assistantCar($id)
    {
        $trip = Trip::find($id);
        if ($trip) {
            $assistant =  User::query()->where('user_type_id', 5)
                ->where('id', $trip->assistantCar_id)
                ->first();

            return $assistant;
        }
        return null;
    }

    public function getCar($id)
    {
        $trip = Trip::find($id);

        if ($trip) {
            $car = Car::query()
                ->where('status', 0)
                ->where('id', $trip->car_id) // Điều kiện thứ hai
                ->first();
            // dd($car);
            return $car;
        }

        return null;
    }



    public function getRoute()
    {
        $route = Route::all();
        return $route;
    }

    // public function getcarDriveAssistant($request)
    // {
    //     $route = Route::first();

    //     $driverIds = json_decode($route->driver_id, true);
    //     $carIds = json_decode($route->car_id, true);
    //     $assistantIds = json_decode($route->assistantCar_id, true);

    //     $drivers = User::whereIn('id', $driverIds)->get(['id', 'name']);
    //     $cars = Car::whereIn('id', $carIds)->get(['id', 'name']); // Thay 'car_name' bằng tên cột chứa tên xe
    //     $assistants = User::whereIn('id', $assistantIds)->get(['id', 'name']);

    //     $driverData = $drivers->toArray();
    //     // dd($driverData);

    //     $carData = $cars->toArray();
    //     $assistantData = $assistants->toArray();

    //     return [
    //         'drivers' => $driverData,
    //         'cars' => $carData,
    //         'assistants' => $assistantData,
    //     ];
    // }

    public function getcarDriveAssistant($request)
    {
        $inputDate = $request->input('inputDate');
        $routeId = $request->input('routeId');


        $route = Route::where('id', $routeId)->first();
        $driverIds = json_decode($route->driver_id, true) ?? [];
        $carIds = json_decode($route->car_id, true) ?? [];
        $assistantIds = json_decode($route->assistantCar_id, true) ?? [];

        $drivers = User::whereIn('id', $driverIds)->get(['id', 'name']);
        $cars = Car::whereIn('id', $carIds)->get(['id', 'name']);
        $assistants = User::whereIn('id', $assistantIds)->get(['id', 'name']);

        $driverData = $drivers->toArray();
        $carData = $cars->toArray();
        $assistantData = $assistants->toArray();

        $trips = Trip::where('route_id', $routeId)->get();


        foreach ($trips as $trip) {
            $dateString = $trip->start_date; // Assume $trip->start_date là chuỗi DateTime
            $dateTime = new DateTime($dateString);
            $fulldate = $dateTime->format('Y-m-d');
            if ($fulldate == $inputDate) {
                $driverIdToRemove = $trip->drive_id;
                $carIdToRemove = $trip->car_id;
                $assistantIdToRemove = $trip->assistantCar_id;


                // Loại bỏ tài xế có driver_id tương ứng ra khỏi danh sách tài xế
                foreach ($driverData as $key => $driver) {
                    if ($driver['id'] == $driverIdToRemove) {
                        unset($driverData[$key]);
                    }
                }

                foreach ($carData as $key => $car) {
                    if ($car['id'] == $carIdToRemove) {
                        unset($carData[$key]);
                    }
                }

                foreach ($assistantData as $key => $assistant) {
                    if ($assistant['id'] == $assistantIdToRemove) {
                        unset($assistantData[$key]);
                    }
                }
            }
        }

        return [
            'drivers' => array_values($driverData), // Reindex lại mảng sau khi unset để tránh các khoảng trắng trong index
            'cars' => array_values($carData),
            'assistants' => array_values($assistantData),
        ];
    }
}
