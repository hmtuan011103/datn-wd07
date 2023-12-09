<?php

namespace App\Http\Controllers\Trip\Client;

use App\Http\Controllers\Trip\BaseTripController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TripController extends BaseTripController
{
    public function getInformationDetailTrip(Request $request)
    {
        try {
            $arrayIdBySearch = [];
            $tripTurn = $request->query('trip_turn');
            $tripReturn = $request->query('trip_return');
            $paramsId = "";
            if ($tripTurn && !$tripReturn) {
                $paramsId = $tripTurn;
            } elseif ($tripTurn && $tripReturn) {
                $arrayIdBySearch[] = $tripTurn;
                $arrayIdBySearch[] = $tripReturn;
                $paramsId = $arrayIdBySearch;
            }
            $route = $this->tripService->getDetailRoute($paramsId);
            $locationRouteTrip = $this->tripService->getLocationRouteTrip($paramsId);
            $seats = $this->tripService->getSeats($paramsId);
            $seatSelected = $this->tripService->getSeatSelected($paramsId);
            return response()->json([
                'seatSelected' => $seatSelected,
                'seats' => $seats,
                'locationRouteTrip' => $locationRouteTrip,
                'route' => $route,
                'status' => ResponseAlias::HTTP_OK,
                'message' => 'Lấy dữ liệu chi tiết chuyến đi thành công'
            ], ResponseAlias::HTTP_OK);
        } catch (\Exception $exception) {
            Log::error('Lấy chi tiết chuyến đi thất bại', [$exception]);
            return response()->json([
                'message' => 'Có lỗi xảy ra ' . $exception->getMessage(),
                'status' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR,
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function lich_trinh()
    {
        $title = "Chiến thắng | Lịch Trình";
        return view('client.pages.trip.index', compact('title'));
    }

    public function getData()
    {
        $data = $this->tripService->getData();
        return response()->json($data);
        // return view('client.pages.trip.main', compact('trips'));
    }

    public function getDataFilter()
    {
        $data = $this->tripService->getDataFilter();
        return response()->json($data);
        // return view('client.pages.trip.main', compact('trips'));
    }

    public function search_start_trip(Request $request)
    {

        $trip = $this->tripService->search($request);
        return response()->json($trip);
    }
    public function searchTrip(Request $request)
    {
        if ($request->type_ticket == 1) {
            $trips = $this->tripService->searchTrip($request);
            if ($trips == null) {
                return response()->json(['status' => 0, $trips], 200);
            } else {
                return response()->json(['status' => 1, $trips], 200);
            }
        } else {
            $trips = $this->tripService->searchTrip($request);
            if ($trips == null) {
                return response()->json(['status' => 0, $trips], 200);
            } else {
                return response()->json(['status' => 2, $trips], 200);
            }
        }
    }
    public function get_type_car()
    {
        $type_car = $this->tripService->get_all_type_car();
        return response()->json($type_car, 200);
    }

    public function getPopularTripList()
    {
        $data = $this->tripService->getPopularTripList();

        if (count($data) < 1) {
            return response()->json([], 400);
        }
        return response()->json($data, 200);
    }
    public function get_seat_empty(Request $request)
    {
        $seat_empty = $this->tripService->get_total_seat_empty($request->trip_id);
        return response()->json($seat_empty, 200);
    }

    public function getRecentNews()
    {
        $data = $this->tripService->getRecentNews();

        if (count($data) < 1) {
            return response()->json([], 400);
        }
        return response()->json($data, 200);
    }
}


// public function create(StoreTripRequest $request )
// {
//     if ($request->isMethod('POST')) {
//         dd($request->all());
//         $repeat = $request->has('repeat');

//         $startDate = Carbon::parse($request->start_date);


//         $route = Route::find($request->route_id);
//         dd($request->route_id);

//         // $timeFloat = $request->interval_trip;
//         // $hourMinute = str_replace(['giờ', 'phút'], '', $timeFloat);
//         // $hourMinuteArray = explode(' ', $hourMinute);
//         // $hour = $hourMinuteArray[0];
//         // $minute = $hourMinuteArray[1];
//         // $time = sprintf("%02d:%02d:00", $hour, $minute);

//         // $trip_price = $request->trip_price;
//         // $fomatPrice = str_replace(".", "", $trip_price);

//         Trip::create([
//             'start_date' => $startDate,
//             'start_time' => $route->start_time,
//             'interval_trip' => $route->interval_trip,
//             'car_id' => $route->car_id,
//             'drive_id' => $route->drive_id,
//             'assistantCar_id' => $route->assistantCar_id,
//             'trip_price' => $route->trip_price,
//             'start_location' => $route->start_location,
//             'end_location' => $route->end_location,
//             'status' => $route->status,
//         ]);

//         if ($repeat) {
//             $numberOfDays = $request->input('number_of_days', 0); // Số ngày lặp lại, có thể lấy từ form
//             for ($i = 1; $i <= $numberOfDays; $i++) {
//                 $nextDate = $startDate->copy()->addDays($i); // Tăng ngày lên

//                 Trip::create([
//                     'start_date' => $nextDate,
//                     'start_time' => $route->start_time,
//                     'interval_trip' => $route->interval_trip,
//                     'car_id' => $route->car_id,
//                     'drive_id' => $route->drive_id,
//                     'assistantCar_id' => $route->assistantCar_id,
//                     'trip_price' => $route->trip_price,
//                     'start_location' => $route->start_location,
//                     'end_location' => $route->end_location,
//                     'status' => $route->status,
//                 ]);
//             }
//         }
//     }
// }
// $routes = $this->tripService->getRoute();
