<?php

namespace App\Services\Statistic;

use App\Models\Bill;
use App\Models\Car;
use App\Models\TypeCar;
use App\Models\User;
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

     public function UserNotACount()
     {
          $countUserNotACount = User::where('user_type_id', 6)->count();
          return $countUserNotACount;
     }
     public function UserACount()
     {
          $countUserACount = User::where('user_type_id', 1)->count();
          return $countUserACount;
     }

     public function UserBookCustomer()
     {
          $UserBookCustomer = User::where('user_type_id', 7)->count();
          return $UserBookCustomer;
     }


     public function getUsersCountByTypeEachMonth()
     {
          $userCountsByMonth = [];
          $currentYear = now()->year;

          for ($month = 1; $month <= 12; $month++) {
               $userNotACountThisMonth = User::where('user_type_id', 6)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $currentYear)
                    ->count();

               $userACountThisMonth = User::where('user_type_id', 1)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $currentYear)
                    ->count();

               $userBookCustomerThisMonth = User::where('user_type_id', 7)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $currentYear)
                    ->count();

               $userCountsByMonth[] = [
                    'month' => $month,
                    'userNotACount' => $userNotACountThisMonth,
                    'userACount' => $userACountThisMonth,
                    'userBookCustomer' => $userBookCustomerThisMonth,
               ];
          }

          return $userCountsByMonth;
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

     public function top10User()
     {
          $topBuyers = DB::table('bills')
               ->select('users.name', 'users.email', DB::raw('COUNT(DISTINCT bills.id) as total_bills'), DB::raw('SUM(bills.total_money) as total_payment'), DB::raw('SUM(bills.total_seats) as total_seats'))
               ->join('users', 'bills.user_id', '=', 'users.id')
               ->groupBy('users.id', 'users.name', 'users.email')
               ->orderByDesc('total_payment')
               ->limit(10)
               ->get();

          return $topBuyers;
     }

     public function countTripDriver()
     {
          $currentDateTime = Carbon::now();

          $drivers = DB::table('users')
               ->select('users.id', 'users.name', 'users.email', 'users.phone_number', DB::raw('COUNT(trips.id) as total_trips'))
               ->leftJoin('trips', 'users.id', '=', 'trips.drive_id')
               ->where('users.user_type_id', 4)
               ->groupBy('users.id', 'users.name', 'users.email', 'users.phone_number')
               ->get();


          foreach ($drivers as $driver) {
               $driverId = $driver->id;
               $finishedTripsCount = DB::table('trips')
                    ->where('drive_id', $driverId)
                    ->get();

                    $totalFinishedTrips = 0;

                    foreach ($finishedTripsCount as $trip) {
                         $startTime = Carbon::parse($trip->start_time)->secondsSinceMidnight();
                         $interval = Carbon::parse($trip->interval_trip)->secondsSinceMidnight();
     
                         $startDate = Carbon::parse($trip->start_date); // Chuyển đổi start_date thành Carbon
                         $formatDate = $startDate->timestamp;
                         $endTime = $startTime + $interval + $formatDate;
     
                         $formetCurrentDateTime = $currentDateTime->timestamp;
     
     
                         if ($endTime < $formetCurrentDateTime) {
                              $totalFinishedTrips++;
                         }
                    }

               $driver->total_finished_trips = $totalFinishedTrips;
          }

          $sortedDrivers = $drivers->sortByDesc('total_finished_trips')->values()->all();


          return $sortedDrivers;
     }
     public function countTripAssistant()
     {

          $currentDateTime = Carbon::now();

          $assistants = DB::table('users')
               ->select('users.id', 'users.name', 'users.email', 'users.phone_number', DB::raw('COUNT(trips.id) as total_trips'))
               ->leftJoin('trips', 'users.id', '=', 'trips.assistantCar_id')
               ->where('users.user_type_id', 5)
               ->groupBy('users.id', 'users.name', 'users.email', 'users.phone_number')
               ->get();


          foreach ($assistants as $assistant) {
               $assistantId = $assistant->id;
               $finishedTrips = DB::table('trips')
                    ->where('assistantCar_id', $assistantId)
                    ->get();

               $totalFinishedTrips = 0;

               foreach ($finishedTrips as $trip) {
                    $startTime = Carbon::parse($trip->start_time)->secondsSinceMidnight();
                    $interval = Carbon::parse($trip->interval_trip)->secondsSinceMidnight();

                    $startDate = Carbon::parse($trip->start_date); // Chuyển đổi start_date thành Carbon
                    $formatDate = $startDate->timestamp;
                    $endTime = $startTime + $interval + $formatDate;

                    $formetCurrentDateTime = $currentDateTime->timestamp;


                    if ($endTime < $formetCurrentDateTime) {
                         $totalFinishedTrips++;
                    }
               }

               $assistant->total_finished_trips = $totalFinishedTrips;


          }
          $sortedAssistants = $assistants->sortByDesc('total_finished_trips')->values()->all();

          return $sortedAssistants;
     }

     public function sumStaff() {
          $staff = User::whereIn('user_type_id', [2, 4, 5])->count();
          return $staff;
      }

      public function sumDriver() {
          $staff = User::where('user_type_id', 4)->count();
          return $staff;
      }
      public function sumAssistant() {
          $staff = User::where('user_type_id', 5)->count();
          return $staff;
      }
      public function sumTickerSeller() {
          $staff = User::where('user_type_id', 2)->count();
          return $staff;
      }
}
