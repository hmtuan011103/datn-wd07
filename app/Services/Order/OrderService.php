<?php

namespace App\Services\Order;

use App\Models\Bill;
use Symfony\Component\HttpFoundation\Response;

class OrderService
{
    public function index($request) {
        $data = Bill::with('trip.route','user','discountCode')->orderBy('id','desc')->get();
        return $data;
    }
    public function details($id) {
        $data = Bill::with('trip.route','user','discountCode')->where('id',$id)->orderBy('id','desc')->get();
        return $data;
    }
}
