<?php
namespace App\Services\CheckoutService;

use App\Models\Location;
use App\Models\Seat;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CheckoutService{

    private string $vnp_TmnCode;
    private string $vnp_HashSecret;
    private string $vnp_Url;
    private string $vnp_ReturnUrl;

    public function __construct() {
        $this->vnp_TmnCode = config('vn_pay.vnp_TmnCode');
        $this->vnp_HashSecret = config('vn_pay.vnp_HashSecret');
        $this->vnp_Url = config('vn_pay.vnp_Url');
        $this->vnp_ReturnUrl = config('vn_pay.vnp_ReturnUrl');
    }

    private function getValuePayment($request) : array
    {

        $vnp_TxnRef = Str::random(8);
        $vnp_OrderInfo = "Thanh toán vé xe";
        $vnp_OrderType = "billpayment";
        if($request->money_return) {
            $vnp_Amount = ($request->money_turn + $request->money_return) * 100;
        } else {
            $vnp_Amount = $request->money_turn * 100;
        }
        $vnp_Locale = "vn";
        $vnp_IpAddr = $request->ip();

        // Config data for my bill
        $vnp_seatsReturn = null;
        if($request->seats_return) {
            $vnp_seatsReturn = implode(',', $request->seats_return);
        }
        $vnp_seatsTurn = implode(',', $request->seats_turn);

        $vnp_tripReturn = null;
        if($request->trip_return) {
            $vnp_tripReturn = $request->trip_return;
        }
        $vnp_tripTurn = $request->trip_turn;

        $vnp_startTurn_0 = $request->place_start_turn;
        $vnp_endTurn_0 = $request->place_end_turn;
        $vnp_startTurn_1 = null;
        $vnp_endTurn_1 = null;
        if($request->trip_return && $request->trip_turn){
            $vnp_startTurn_0 = $request->place_start_turn_0;
            $vnp_endTurn_0 = $request->place_end_turn_0;
            $vnp_startTurn_1 = $request->place_start_turn_1;
            $vnp_endTurn_1= $request->place_end_turn_1;
        }
        Cache::put('my_bill_cache', [
            'email' => $request->email,
            'name' => $request->name,
            'phone_number' => $request->phone,
            'moneyTurn' => $request->money_turn,
            'moneyReturn' => $request->money_return,
            'seatsTurn' => $vnp_seatsTurn,
            'seatsReturn' => $vnp_seatsReturn,
            'tripTurn' => $vnp_tripTurn,
            'tripReturn' => $vnp_tripReturn,
            'startTurn_0' => $vnp_startTurn_0,
            'endTurn_0' => $vnp_endTurn_0,
            'startTurn_1' => $vnp_startTurn_1,
            'endTurn_1' => $vnp_endTurn_1,
            // Các thông tin khác mà bạn muốn lưu
        ], 1500);
        // Config data for my bill

        $vnp_Bill_Mobile = $request->phone;
        $vnp_Bill_Email = $request->email;
        $fullName = trim($request->name);
        if (trim($fullName) != '') {
            $name = explode(' ', $fullName);
            $vnpBillFirstName = array_shift($name);
            $vnpBillLastName = array_pop($name) ?? "-no";
        }
        return [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $this->vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $this->vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
            "vnp_Bill_Email" => $vnp_Bill_Email,
            "vnp_Bill_FirstName" => $vnpBillFirstName,
            "vnp_Bill_LastName" => $vnpBillLastName,
        ];
    }

    public function createPayment($request) : string
    {
        $inputData = $this->getValuePayment($request);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $this->vnp_Url . "?" . $query;
        $vnpSecureHash =   hash_hmac('sha512', $hashData, $this->vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

        return $vnp_Url;
    }
}
