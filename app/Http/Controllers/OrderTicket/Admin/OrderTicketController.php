<?php

namespace App\Http\Controllers\OrderTicket\Admin;

use Illuminate\Http\Request;

class OrderTicketController
{
    public function index(){
        $title = "Đặt vé";
        return view('admin.pages.order-ticket.main-search', compact('title'));
    }

    public function searchRouteAdmin(){
        $title = "Tìm chuyến đi";
        return view('admin.pages.order-ticket.main-show-search', compact('title'));
    }
}
