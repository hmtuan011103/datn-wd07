<?php

namespace App\Http\Controllers\Trip\Client;

use App\Http\Controllers\Trip\BaseTripController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TripController extends BaseTripController
{
    public function getInformationDetailTrip()
    {
        try {
//            $route = $this->tripService->getDetailRoute("3");
//            $locationRouteTrip = $this->tripService->getLocationRouteTrip("3");
//            $seats = $this->tripService->getSeats("3");
//            $seatSelected = $this->tripService->getSeatSelected("3");
            $route = $this->tripService->getDetailRoute([4,5]);
            $locationRouteTrip = $this->tripService->getLocationRouteTrip([4,5]);
            $seats = $this->tripService->getSeats([4,5]);
            $seatSelected = $this->tripService->getSeatSelected([4,5]);
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
        return view('client.pages.trip.index');
    }

    public function getData()
    {
        $data = $this->tripService->getData();
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
                return response()->json(['status' => 0,$trips], 200);
            } else {
                return response()->json(['status' => 1,$trips], 200);
            }
        } else {
            $trips = $this->tripService->searchTrip($request);
            if ($trips == null) {
                return response()->json(['status' => 0,$trips], 200);
            } else {
                return response()->json(['status' => 2,$trips], 200);
            }

        }
    }
    public function get_type_car(){
        $type_car = $this->tripService->get_all_type_car();
        return response()->json($type_car,200);
    }
}
