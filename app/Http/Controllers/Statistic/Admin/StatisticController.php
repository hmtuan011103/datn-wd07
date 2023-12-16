<?php

namespace App\Http\Controllers\Statistic\Admin;

use App\Http\Controllers\Statistic\BaseStatisticController;
use App\Models\Bills;
use App\Models\Trip;
use App\Models\User;
use Carbon\Carbon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends BaseStatisticController
{
    public function index()
    {
        $title = 'Thống kê xe';

        // query
        $getTypeCar = $this->statisticService->statisticTypeCar();
        $getTopCar = $this->statisticService->statisticTopCar();

        // format data
        $getTypeCar = $getTypeCar->getData()->data;
        $getTopCar = $getTopCar->getData()->data;

        $totalTypeCar = count($getTypeCar);
        $totalCar = 0;
        foreach ($getTypeCar as $key => $value) {
            $totalCar += $value->cars_count;
        }
        $statisticTypeCar = json_encode($getTypeCar);

        return view('admin.pages.statistic.main', compact('title', 'statisticTypeCar', 'totalTypeCar', 'totalCar', 'getTopCar'));
    }
    public function user()
    {
        $title = 'Thống kê tài khoản';
        $topUser = $this->statisticService->top10User();
        $getCountDriver = $this->statisticService->countTripDriver();
        $getCountAssistant = $this->statisticService->countTripAssistant();
        $sumStaff = $this->statisticService->sumStaff();
        $sumDriver =  $this->statisticService->sumDriver();
        $sumAssistant =  $this->statisticService->sumAssistant();
        $sumTickerSeller =  $this->statisticService->sumTickerSeller();

        // dd($sumStaff);

        // dd($getCountDriver);;
        return view('admin.pages.statistic.user', compact('title', 'topUser','getCountDriver','getCountAssistant','sumStaff','sumDriver','sumAssistant','sumTickerSeller'));
    }
    public function getUserData()
    {
        $data = [
            'UserNotAcount' => $this->statisticService->UserNotACount(),
            'UserAcount' => $this->statisticService->UserACount(),
            'UserBookCustomer' => $this->statisticService->UserBookCustomer(),
        ];

        return response()->json($data);
    }

    public function countUserType()
    {
        $data = $this->statisticService->getUsersCountByTypeEachMonth();
        return response()->json($data);
    }


    public function revenue(Request $request)
    {
        $title = 'Thống kê tài khoản';
        // dd($labels);
        return view('admin.pages.statistic.revenue', compact('title'));
    }

    public function getRevenue(Request $request)
    {
        $data = $this->statisticService->getFilteredData($request);

        // dd($labels);
        return response()->json([
            'labels' => $data['labels'],
            'data' => $data['data'],
            'trips_count' => $data['trips_count']
        ]);
    }

    public function getRevenueData(Request $request)
    {
        $revenueData = $this->statisticService->getRevenueData($request);
        return response()->json($revenueData);
    }



    public function route()
    {
        $title = 'Thống kê tuyến đường';

        // query
        $getRoute = $this->statisticService->getRoute();
        $getTrip = $this->statisticService->getTrip();
        $getRevenue = $this->statisticService->getRevenue();
        // format data
        $getTopRoute = $this->statisticService->getTopRoute();

        return view('admin.pages.statistic.route', compact('title', 'getTopRoute','getRoute','getTrip','getRevenue'));
    }

    public function get_data_route(Request $request){
        $get_data_route = $this->statisticService->get_data_route($request);
        return response()->json([$get_data_route],200);
    }
}
