<?php

namespace App\Http\Controllers\Statistic\Admin;

use App\Http\Controllers\Statistic\BaseStatisticController;
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

        return view('admin.pages.statistic.index', compact('title', 'statisticTypeCar', 'totalTypeCar', 'totalCar', 'getTopCar'));
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
}