<?php

namespace App\Http\Controllers\Statistic\Admin;

use App\Http\Controllers\Statistic\BaseStatisticController;
use App\Models\Bills;
use App\Models\Trip;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        $query = $this->statisticService->statisticTypeCar();

        $statisticTypeCar = json_encode($query->getData()->data);

        return view('admin.pages.statistic.index', compact('title', 'statisticTypeCar'));
        // $pageViewInfo = 'admin.pages.type_user.create';
        // return view('admin.pages.type_user.index', compact('title', 'pageViewInfo', 'allTypeUserData'));
    }

    public function revenue(Request $request) {
        $title = 'Thống kê tài khoản';      
        // dd($labels);
        return view('admin.pages.statistic.revenue', compact('title'));

    }

    public function getRevenue(Request $request) {
        $data = $this->statisticService->getFilteredData($request);
       
        // dd($labels);
        return response()->json([
            'labels' =>$data['labels'],
            'data' => $data['data'],
            'trips_count' =>$data['trips_count']
        ]);

    }

    public function getRevenueData(Request $request) {
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
