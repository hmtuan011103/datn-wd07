<?php

namespace App\Services\Order;

use App\Models\Bill;
use Symfony\Component\HttpFoundation\Response;

class OrderService
{
    public function index($request) {
        $data = Bill::with('trip.route','user')->get();
        return $data;
    }
    public function details($id) {
        $data = Bill::with('trip.route','user')->where('id',$id)->get();
        return $data;
    }
}
