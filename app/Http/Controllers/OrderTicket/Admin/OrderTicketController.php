<?php

namespace App\Http\Controllers\OrderTicket\Admin;

use App\Models\Location;
use App\Models\Trip;
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

    public function selectSeatAdmin() {
        $title = "Chọn ghế";
        return view('admin.pages.select-checkout-seat-admin.main', compact('title'));
    }

   public function detailSelectSeatAdmin(Request $request) {
       $data = $request->except('_token');
       $title = "Chi tiết thanh toán";
       $customeDirect = "Khách hàng trực tiếp" ;
       $nameUser = $request->name === null || $request->name === ""  ? $customeDirect : $request->name;
       $emailUser = $request->email === null || $request->name === ""  ? $customeDirect : $request->email;
       $phoneUser = $request->phone === null || $request->name === ""  ? $customeDirect : $request->phone;
       $tripTurn = Trip::query()->find($request->trip_turn);
       $tripReturn = null;
       if($request->trip_return) {
           $tripReturn = Trip::query()->find($request->trip_return);
       }
       $placeStart = Location::query()->find($request->place_start_turn);
       $placeEnd = Location::query()->find($request->place_end_turn);
       $placeStartSecond = null;
       $placeEndSecond = null;
       if($request->place_start_turn_0) {
           $placeStart = Location::query()->find($request->place_start_turn_0);
           $placeEnd = Location::query()->find($request->place_end_turn_0);
           $placeStartSecond = Location::query()->find($request->place_start_turn_1);
           $placeEndSecond = Location::query()->find($request->place_end_turn_1);
       }
       $seatsTurn = $request->seats_turn;
       $seatsReturn = null;
       if($request->seats_return) {
           $seatsReturn = $request->seats_return;
       }
       $moneyTurn = (int) $request->money_turn;
       $moneyReturn = null;
       if($request->money_return) {
           $moneyReturn = (int) $request->money_return;
       }
       return view('admin.pages.select-checkout-type-info.main',
           compact('nameUser','emailUser','phoneUser','tripTurn','tripReturn', 'title',
               'placeStart','placeEnd','placeStartSecond','placeEndSecond','seatsTurn','seatsReturn', 'moneyTurn', 'moneyReturn'
           )
       );
   }
}
