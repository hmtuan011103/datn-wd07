<?php

namespace App\Services\Home;

use App\Models\Bills;
use App\Models\Trip;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class HomeService
{
    public function get_trip_month()
    {
        $currentMonth = Carbon::now()->month;
        $trip = Trip::whereMonth('created_at', $currentMonth)->count();
        return $trip;
    }
    public function get_user_month()
    {
        $currentMonth = Carbon::now()->month;
        $user = User::whereMonth('created_at', $currentMonth)->count();
        return $user;
    }
    public function get_revenue_month()
    {
        $currentMonth = Carbon::now()->month;
        $bill = Bills::whereMonth('created_at', $currentMonth)->get();
        $revenue = 0;
        foreach ($bill as $item) {
            $revenue += $item->total_money;
        }
        return $revenue;
    }
    public function get_trip_year()
    {
        $currentMonth = Carbon::now()->year;
        $trip = Trip::whereYear('created_at', $currentMonth)->count();
        return $trip;
    }
    public function get_user_year()
    {
        $currentMonth = Carbon::now()->year;
        $user = User::whereYear('created_at', $currentMonth)->count();
        return $user;
    }
    public function get_revenue_year()
    {
        $currentMonth = Carbon::now()->year;
        $bill = Bills::whereYear('created_at', $currentMonth)->get();
        $revenue = 0;
        foreach ($bill as $item) {
            $revenue += $item->total_money;
        }
        return $revenue;
    }

    public function get_data_year()
    {
        $currentYear = Carbon::now()->year;
        $dataTrip = [];
        $dataUser = [];
        $dataRevenue = [];
        for ($month = 1; $month <= 12; $month++) {
            $trip = Trip::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->count();

            $dataTrip[$month] = $trip;
            $user = User::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->count();

            $dataUser[$month] = $user;
            $bill = Bills::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->get();
            $dataRevenue[$month] = 0;
            foreach ($bill as $item) {
                $dataRevenue[$month] += $item->total_money;
            }
        }
        return [$dataTrip, $dataUser, $dataRevenue];
    }
}
