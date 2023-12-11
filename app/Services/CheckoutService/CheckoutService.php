<?php

namespace App\Services\CheckoutService;

use App\Models\Location;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CheckoutService
{

    private string $vnp_TmnCode;
    private string $vnp_HashSecret;
    private string $vnp_Url;
    private string $vnp_ReturnUrl;

    public function __construct()
    {
        $this->vnp_TmnCode = config('vn_pay.vnp_TmnCode');
        $this->vnp_HashSecret = config('vn_pay.vnp_HashSecret');
        $this->vnp_Url = config('vn_pay.vnp_Url');
        $this->vnp_ReturnUrl = config('vn_pay.vnp_ReturnUrl');
    }

    private function getValuePayment($request): array
    {
        $vnp_TxnRef = Str::random(8);
        $vnp_OrderInfo = "Thanh toán vé xe";
        $vnp_OrderType = "billpayment";
        if ($request->money_return) {
            $vnp_Amount = ($request->money_turn + $request->money_return) * 100;
        } else {
            $vnp_Amount = $request->money_turn * 100;
        }
        $vnp_Locale = "vn";
        $vnp_IpAddr = $request->ip();

        // Config data for my bill
        $vnp_seatsReturn = null;
        if ($request->seats_return) {
            $vnp_seatsReturn = implode(',', $request->seats_return);
        }
        $vnp_seatsTurn = implode(',', $request->seats_turn);

        $vnp_tripReturn = null;
        if ($request->trip_return) {
            $vnp_tripReturn = $request->trip_return;
        }
        $vnp_tripTurn = $request->trip_turn;

        $vnp_startTurn_0 = $request->place_start_turn;
        $vnp_endTurn_0 = $request->place_end_turn;
        $vnp_startTurn_1 = null;
        $vnp_endTurn_1 = null;
        if ($request->trip_return && $request->trip_turn) {
            $vnp_startTurn_0 = $request->place_start_turn_0;
            $vnp_endTurn_0 = $request->place_end_turn_0;
            $vnp_startTurn_1 = $request->place_start_turn_1;
            $vnp_endTurn_1 = $request->place_end_turn_1;
        }
        Cache::put('my_bill_cache' . $vnp_TxnRef, [
            'clientLogin' => $request->client_login,
            'email' => $request->phone,
            'name' => $request->name,
            'phone_number' => $request->email,
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
            'type_payment' => 1
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

    public function createPayment($request): string
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
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    public function momoPayment($request)
    {
        // Information config
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        // Information config

        // Information checkout
        $orderInfo = "Thanh toán vé xe";
        $orderId = 'HZ-' . now()->format('Ymd') . '-' . Str::random(6);
        $redirectUrl = route('trang_thai_thanh_toan');
        $ipnUrl = route('trang_thai_thanh_toan');
        $extraData = "";
        $requestId = now()->format('YmdHis') . "";
        if ($request->money_return) {
            $amount = ($request->money_turn + $request->money_return);
        } else {
            $amount = $request->money_turn;
        }
        // Config data for my bill
        $momo_seatsReturn = null;
        if ($request->seats_return) {
            $momo_seatsReturn = implode(',', $request->seats_return);
        }
        $momo_seatsTurn = implode(',', $request->seats_turn);

        $momo_tripReturn = null;
        if ($request->trip_return) {
            $momo_tripReturn = $request->trip_return;
        }
        $momo_tripTurn = $request->trip_turn;

        $momo_startTurn_0 = $request->place_start_turn;
        $momo_endTurn_0 = $request->place_end_turn;
        $momo_startTurn_1 = null;
        $momo_endTurn_1 = null;
        if ($request->trip_return && $request->trip_turn) {
            $momo_startTurn_0 = $request->place_start_turn_0;
            $momo_endTurn_0 = $request->place_end_turn_0;
            $momo_startTurn_1 = $request->place_start_turn_1;
            $momo_endTurn_1 = $request->place_end_turn_1;
        }
        Cache::put('my_bill_cache' . $orderId, [
            'clientLogin' => $request->client_login,
            'email' => $request->phone,
            'name' => $request->name,
            'phone_number' => $request->email,
            'moneyTurn' => $request->money_turn,
            'moneyReturn' => $request->money_return,
            'seatsTurn' => $momo_seatsTurn,
            'seatsReturn' => $momo_seatsReturn,
            'tripTurn' => $momo_tripTurn,
            'tripReturn' => $momo_tripReturn,
            'startTurn_0' => $momo_startTurn_0,
            'endTurn_0' => $momo_endTurn_0,
            'startTurn_1' => $momo_startTurn_1,
            'endTurn_1' => $momo_endTurn_1,
            'type_payment' => 2
            // Các thông tin khác mà bạn muốn lưu
        ], 1500);
        // Config data for my bill
        // Information checkout

        $requestType = "payWithMethod";
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo .
            "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);
        return $jsonResult['payUrl'];
    }
}
