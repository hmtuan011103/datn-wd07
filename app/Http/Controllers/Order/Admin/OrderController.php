<?php

namespace App\Http\Controllers\Order\Admin;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request){
        $title = "Danh sách hóa đơn";
        $data = $this->orderService->index($request);
        return view('admin.pages.order.main', compact('data','title'));
    }
}
