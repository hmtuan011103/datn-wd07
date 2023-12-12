<?php

namespace App\Http\Controllers\Order\Admin;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Services\Order\OrderService;
use Dompdf\Dompdf;
use DateTime;
use Dompdf\Options;
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
        $routes = Route::all();
        return view('admin.pages.order.main', compact('data','title','routes'));
    }

    public function details($id){
        $data = $this->orderService->details($id);
        return response()->json(['data' => $data], 200);
    }

    public function export($id){
        $data = $this->orderService->details($id);
        $dateTime = new DateTime($data[0]->created_at);
        $time_create = $dateTime->format('H:i:s, d/m/Y');
        $dompdf = new Dompdf();
        $str = str_replace(['[', ']'], '', $data[0]->seat_id);
        $arr = explode(',', $str);
        $arr = array_map('trim', $arr);
        $seats = str_replace('"', '', $arr);
        // $img = base64_encode(file_get_contents(asset('client/assets/images/log_qr.jpg')));
        $img ='aa';
        // dd(asset('client/assets/images/log_qr.jpg'));
        // dd($img);
        // return view('admin.pages.order.pdf', compact('data','time_create','seats','img'));
        $html = view('admin.pages.order.pdf', compact('data','time_create','seats'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        $dompdf->stream('Hoadonmuahang.pdf');
    }
}
