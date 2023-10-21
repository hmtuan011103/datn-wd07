<?php

namespace App\Services\Trips;

use App\Http\Requests\Trip\StoreTripRequest;
use App\Http\Requests\Trip\UpdateTripRequest;
use App\Models\Bills;
use App\Models\Car;
use App\Models\Trip;
use App\Models\User;
use Carbon\Carbon;
use DateInterval;
use DateTime;

use function PHPUnit\Framework\isEmpty;

class TripService
{
    public function list()
    {
        return Trip::all();
    }
    public function list_desc()
    {
        // $trips = Trip::all();       
        $trips = Trip::select('trips.id', 'tríp.assistantCar_id','trips.car_id', 'trips.drive_id','trips.start_date','trips.start_time','trips.start_location','trips.status','trips.trip_price','trips.end_location','trips.created_at','trips.updated_at','cars.name as car_name','users.name as user_name')
        ->join('cars', 'cars.id', '=', 'trips.car_id')
        ->join('users', 'users.id', '=', 'trips.drive_id')
        ->orderBy('updated_at', 'DESC')->get();
        return $trips;
    }

    public function create(StoreTripRequest $request)
    {
        if ($request->isMethod('POST')) {

            $params = $request->all();
            unset($params['_token']);

            return Trip::create($params);
        }
    }


    public function edit_trip(StoreTripRequest $request, $id)
    {
        Trip::find($id);
        if ($request->isMethod('POST')) {
            $params = $request->except('proengsoft_jsvalidation', '_token');
            // dd($params);
            return Trip::where('id', $id)->update($params);
        }
    }

    public function delete_trip($id)
    {
        Trip::find($id)->delete();
        return redirect()->route('list_trip');
    }

    public function searchTrip($request)
    {
        $currentDate = date('Y/m/d');
        $currentTime = date('H:i:s');
        $currenttime = new DateTime($currentTime);
        $interval = new DateInterval('PT4H00M');
        $currenttime->add($interval);
        $currtime = $currenttime->format('H:i:s');
        if ($request->type_ticket == 1) {

            $trips = Trip::with('car.typeCar')->where(['start_location' => $request->start_location, 'end_location' => $request->end_location, 'start_date' => $request->start_date, 'status' =>'1'])->orderBy('start_time')->get();
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
                }
            }

            if ($trips->isEmpty()) {
                return null;
            } else {
                return $trips;
            }
        } else {

            $tripstart = Trip::with('car.typeCar')->where(['start_location' => $request->start_location, 'end_location' => $request->end_location, 'start_date' => $request->start_date, 'status' =>'1'])->orderBy('start_time')->get();
            $tripend = Trip::with('car.typeCar')->where(['start_location' => $request->end_location, 'end_location' => $request->start_location, 'start_date' => $request->end_date, 'status' =>'1'])->orderBy('start_time')->get();
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
                }
            }
            $total_trip_end = count($tripend);
            for ($i = 0; $i < $total_trip_end; $i++) {
                if ($currentDate == $request->start_date) {
                    if ($tripend[$i]->start_time < $currtime) {
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


        $trips = DB::table('trips')
            // ->select('*')
            ->join('cars', 'trips.car_id', '=', 'cars.id')
            ->join('type_cars', 'cars.id_type_car', '=', 'type_cars.id')
            ->select('trips.*', 'type_cars.name as car_type_name')
            ->orderBy('start_location', 'asc')
            ->get();
        return $trips;
    }
    public function search($request)
    {
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

        return $trips;
    }
}
