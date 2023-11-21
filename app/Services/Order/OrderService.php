<?php

namespace App\Services\Order;

use App\Models\Bill;
use Symfony\Component\HttpFoundation\Response;

class OrderService
{
    public function index($request) {
        $data = Bill::query()->with('trip')->get();
        return $data;
    }

}
