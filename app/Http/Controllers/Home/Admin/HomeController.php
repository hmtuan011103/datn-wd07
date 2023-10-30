<?php

namespace App\Http\Controllers\Home\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\BaseHomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends BaseHomeController
{
    //
    public function index(){
        if (!Auth::check() || count(Auth::user()->permissions) < 1) {
            toastr()->info('Vui lòng đăng nhập', 'Nhắc nhở');
            return redirect()->route('login.form');
        }
        $get_trip_month = $this->homeservice->get_trip_month();
        $get_user_month = $this->homeservice->get_user_month();
        $get_revenue_month = $this->homeservice->get_revenue_month();
        $get_trip_year = $this->homeservice->get_trip_year();
        $get_user_year = $this->homeservice->get_user_year();
        $get_revenue_year = $this->homeservice->get_revenue_year();
        $title = 'Quản trị chiến thắng';
        return view('admin.pages.home.index', compact('title','get_trip_month','get_user_month','get_revenue_month','get_trip_year','get_user_year','get_revenue_year'));
    }

    public function get_data_year(){
        $get_data_year = $this->homeservice->get_data_year();
        return response()->json([$get_data_year],200);
    }
}
