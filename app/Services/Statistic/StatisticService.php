<?php

namespace App\Services\Statistic;

use App\Models\Bill;
use App\Models\Car;
use App\Models\TypeCar;
use Carbon\Carbon;
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

     // public function getRevenue()
     // {
     //      $labels = []; // Mảng lưu trữ ngày
     //      $dataDaily = []; // Mảng lưu trữ doanh thu theo ngày

     //      // Lấy dữ liệu từ cơ sở dữ liệu (ví dụ, sử dụng Eloquent)
     //      // Thay thế phần này với truy vấn SQL hoặc Eloquent của bạn để lấy dữ liệu thực từ cơ sở dữ liệu
     //      // Ví dụ:
     //      $bills = Bill::whereBetween('created_at', [now()->subDays(30), now()])->get();
     //      // dd($bills);

     //      // Xử lý dữ liệu từ kết quả truy vấn để lấy ngày và doanh thu
     //      foreach ($bills as $bill) {
     //           $labels[] = $bill->created_at->format('Y-m-d'); // Lấy ngày
     //           $dataDaily[] = $bill->total_money; // Lấy doanh thu
     //      }


     //      return ( [
     //           'labels' => $labels,
     //           'dataDaily' => $dataDaily,
     //      ]);
     // }


     public function getFilteredData($request)
     {
         $startDate = $request->input('startDate');
         $endDate = $request->input('endDate');
     
         $query = Bill::query();
         $dailyData = []; // Mảng kết hợp lưu trữ doanh thu theo ngày
     
         if ($startDate && $endDate) {
             $query->whereDate('created_at', '>=', $startDate)
                 ->whereDate('created_at', '<=', $endDate);
         }
     
         $datas = $query->get();
     
         // Tính tổng doanh thu cho từng ngày
         foreach ($datas as $data) {
             $date = $data->created_at->format('Y-m-d');
     
             // Kiểm tra nếu ngày đã tồn tại trong mảng kết hợp
             if (isset($dailyData[$date])) {
                 // Nếu ngày đã tồn tại, cộng thêm vào tổng doanh thu
                 $dailyData[$date]['total_money'] += $data->total_money;
                 $dailyData[$date]['trips_count']++; // Tăng số lượng chuyến đi cho ngày này
             } else {
                 // Nếu ngày chưa tồn tại, khởi tạo giá trị doanh thu và số lượng chuyến đi cho ngày đó
                 $dailyData[$date] = [
                     'total_money' => $data->total_money,
                     'trips_count' => 1 // Bắt đầu với 1 chuyến đi
                 ];
             }
         }
     
         // Chuyển dữ liệu từ mảng kết hợp sang mảng labels và data để trả về
         $labels = array_keys($dailyData);
         $dataDaily = array_values(array_column($dailyData, 'total_money')); // Dữ liệu doanh thu
         $tripsCount = array_values(array_column($dailyData, 'trips_count')); // Số lượng chuyến đi
     
         return [
             'labels' => $labels,
             'data' => $dataDaily,
             'trips_count' => $tripsCount // Trả về số lượng chuyến đi cho mỗi ngày
         ];
     }
     
     // public function getFilteredData($request)
     // {
     //      $startDate = $request->input('startDate');
     //      $endDate = $request->input('endDate');

     //      $query = Bill::query();
     //      $dailyData = []; // Mảng kết hợp lưu trữ doanh thu theo ngày


     //      // $startDate = $request->startDate;
     //      // $endDate = $request->endDate;

     //      // Kiểm tra nếu có cả hai giá trị ngày bắt đầu và kết thúc
     //      if ($startDate && $endDate) {
     //           $query->whereDate('created_at', '>=', $startDate)
     //                ->whereDate('created_at', '<=', $endDate);
     //      }



     //      $datas = $query->get();

     //      // Tính tổng doanh thu cho từng ngày
     //      foreach ($datas as $data) {
     //           $date = $data->created_at->format('Y-m-d');

     //           // Kiểm tra nếu ngày đã tồn tại trong mảng kết hợp
     //           if (isset($dailyData[$date])) {
     //                // Nếu ngày đã tồn tại, cộng thêm vào tổng doanh thu
     //                $dailyData[$date] += $data->total_money;
     //           } else {
     //                // Nếu ngày chưa tồn tại, khởi tạo giá trị doanh thu cho ngày đó
     //                $dailyData[$date] = $data->total_money;
     //           }
     //      }

     //      // Chuyển dữ liệu từ mảng kết hợp sang mảng labels và data để trả về
     //      $labels = array_keys($dailyData);
     //      $dataDaily = array_values($dailyData);

     //      return [
     //           'labels' => $labels,
     //           'data' => $dataDaily,
     //      ];
     // }
     public function getRevenueData($request)
     {
          $year = $request->input('year');

          // Xử lí lấy dữ liệu doanh thu từ cơ sở dữ liệu
          // Đây chỉ là ví dụ, bạn cần thay thế bằng cách lấy dữ liệu thực tế từ cơ sở dữ liệu của bạn
          $revenueData = Bill::selectRaw('MONTH(created_at) as month, COUNT(trip_id) as total_trips, SUM(total_money) as total')
               ->whereYear('created_at', $year)
               ->groupBy('month')
               ->orderBy('month')
               ->get();



          return $revenueData;
     }
}
