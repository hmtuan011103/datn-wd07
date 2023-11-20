<?php

namespace App\Services\Statistic;

use App\Models\Car;
use App\Models\TypeCar;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StatisticService
{
     public function statisticTypeCar()
     {
          // statistic each type car has how many car
          $query = TypeCar::select('name')
               ->withCount('cars')
               ->orderByDesc('cars_count')
               ->get();

          $query = collect($query)->toArray();

          $response['data'] = $query;
          $response['status'] = ResponseAlias::HTTP_OK;

          if (count($query) < 1) {
               $response['message'] = 'No data found';
               $response['status'] = ResponseAlias::HTTP_BAD_REQUEST;
          }

          return response()->json($response, $response['status']);
     }

     public function statisticTopCar()
     {
          // statistic each type car has how many money, seat sold success
          $query = Car::select('cars.id', 'cars.name', DB::raw('COUNT(bills.id) as total_trip'), DB::raw('SUM(bills.total_money_after_discount) as total_money'), DB::raw('SUM(bills.total_seats) as total_seats'))
               ->leftJoin('trips', 'cars.id', '=', 'trips.car_id')
               ->leftJoin('bills', function ($join) {
                    $join->on('trips.id', '=', 'bills.trip_id')
                         ->where('bills.status_pay', '=', 1);
               })
               ->groupBy('cars.id', 'cars.name')
               // ->havingRaw('total_money > 0')
               ->orderByDesc('total_money')
               ->limit(10)
               ->get();

          $query = collect($query)->toArray();

          $response['data'] = $query;
          $response['status'] = ResponseAlias::HTTP_OK;

          if (count($query) < 1) {
               $response['message'] = 'No data found';
               $response['status'] = ResponseAlias::HTTP_BAD_REQUEST;
          }

          return response()->json($response, $response['status']);
     }
}
