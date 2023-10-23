<?php

namespace App\Http\Controllers\Trip\Client;

use App\Http\Controllers\Trip\BaseTripController;
use App\Models\Trip;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TripController extends BaseTripController
{
    public function getInformationDetailTrip() {
        try {
//            $route = $this->tripService->getDetailRoute("3");
//            $locationRouteTrip = $this->tripService->getLocationRouteTrip("3");
//            $seats = $this->tripService->getSeats("3");
//            $seatSelected = $this->tripService->getSeatSelected("3");
            $route = $this->tripService->getDetailRoute([3, 4]);
            $locationRouteTrip = $this->tripService->getLocationRouteTrip([3, 4]);
            $seats = $this->tripService->getSeats([3, 4]);
            $seatSelected = $this->tripService->getSeatSelected([3, 4]);
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
            ],ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
