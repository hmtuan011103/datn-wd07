<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailCheckOutSuccess;
use App\Models\Bill;
use App\Models\Location;
use App\Models\Seat;
use App\Models\Ticket;
use App\Models\Trip;
use App\Models\User;
use App\Services\CheckoutService\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckoutController extends Controller
{

    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;

    }

    public function continuesCheckout(Request $request) {
//        $token = auth()->user();
//        dd($token);
//        $user = JWTAuth::parseToken()->authenticate();
//        dd($user);
        $data = $request->except('_token');
        $title = "Chiến thắng | Thanh toán";
        $nameUser = $request->name;
        $emailUser = $request->email;
        $phoneUser = $request->phone;
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
        return view('client.pages.choose-type-payment.index',
            compact('nameUser','emailUser','phoneUser','tripTurn','tripReturn', 'title',
                'placeStart','placeEnd','placeStartSecond','placeEndSecond','seatsTurn','seatsReturn', 'moneyTurn', 'moneyReturn'
            )
        );
    }

    public function checkout(Request $request) {
        try {
            if ($request->has('redirect-payment') && $request->type_payment === "1") {
                $vnp_Url = $this->checkoutService->createPayment($request);
                return redirect($vnp_Url);
            }
            if ($request->has('redirect-payment') && $request->type_payment === "2") {
                $momo_Url = $this->checkoutService->momoPayment($request);
                return redirect($momo_Url);
            }
        } catch (\Exception $exception) {
            Log::error('Có lỗi xảy ra', [$exception]);
            abort(500);
        }
    }

    private function saveDataAfterCheckoutSuccess($request, $cacheData) {
        DB::beginTransaction();
        try {
            // Save User
            $user = User::query()->create([
                'user_type_id' => 6,
                'email' => $cacheData['email'],
                'name' => $cacheData['name'],
                'phone_number' => $cacheData['phone_number'],
            ]);
            if ($request->hasCookie('is_client')) {
                $userInfor = Auth::user();
                if ($userInfor && $userInfor->user_type_id === 1) {
                    $user = User::query()->find($userInfor->id)->get();
                }
            }
            Cache::put('infor_user', $user, 1500);
            // Save to Bill Order

            // Bill Turn
            $seatsCodeTurn = explode(',', $cacheData['seatsTurn']);
            $tripTurn = $cacheData['tripTurn'];
            $seatsTurnArray = Seat::whereIn('code_seat', $seatsCodeTurn)
                ->where('car_id', function ($query) use ($tripTurn) {
                    $query->select('car_id')->from('trips')->where('id', $tripTurn);
                })->pluck('code_seat')->toArray();
            $total_seats_turn = count($seatsTurnArray);
            $bill = Bill::query()->create([
                'seat_id' => json_encode($seatsTurnArray),
                'trip_id' => $tripTurn,
                'user_id' => $user->id,
                'status_pay' => 1,
                'total_money' => $cacheData['moneyTurn'],
                'total_money_after_discount' => $cacheData['moneyTurn'],
                'type_pay' => $cacheData['type_payment'],
                'total_seats' => $total_seats_turn,
                'code_bill' => Str::random(8)
            ]);
            Cache::put('bill_turn', $bill->id, 1500);
            $startLocation = Location::query()->find($cacheData['startTurn_0']);
            $endLocation = Location::query()->find($cacheData['endTurn_0']);
            foreach ($seatsTurnArray as $item) {
                Ticket::query()->create([
                    'code_ticket' => Str::random(8),
                    'bill_id' => $bill->id,
                    'code_seat' => $item,
                    'pickup_location' => $startLocation->name,
                    'pay_location' => $endLocation->name,
                ]);
            }
            SendMailCheckOutSuccess::dispatch($user->name, $bill->code_bill, $bill->trip_id, $startLocation->name, $endLocation->name, implode(', ', $seatsTurnArray), $user->email);
            // Bill Return
            if ($cacheData['seatsReturn'] !== null && $cacheData['tripReturn'] !== null) {
                $seatsCodeReturn = explode(',', $cacheData['seatsReturn']);
                $tripReturn = $cacheData['tripReturn'];
                $seatsReturnArray = Seat::whereIn('code_seat', $seatsCodeReturn)
                    ->where('car_id', function ($query) use ($tripReturn) {
                        $query->select('car_id')->from('trips')->where('id', $tripReturn);
                    })->pluck('code_seat')->toArray();
                $total_seats_return  = count($seatsReturnArray);
                $billReturn  = Bill::query()->create([
                    'seat_id' => json_encode($seatsReturnArray),
                    'trip_id' => $tripReturn,
                    'user_id' => $user->id,
                    'status_pay' => 1,
                    'total_money' => $cacheData['moneyReturn'],
                    'total_money_after_discount' => $cacheData['moneyReturn'],
                    'type_pay' => $cacheData['type_payment'],
                    'total_seats' => $total_seats_return,
                    'code_bill' => Str::random(8)
                ]);
                Cache::put('bill_return', $billReturn->id, 1500);
                $startLocation = Location::query()->find($cacheData['startTurn_1']);
                $endLocation = Location::query()->find($cacheData['endTurn_1']);
                foreach ($seatsReturnArray as $item) {
                    Ticket::query()->create([
                        'code_ticket' => Str::random(8),
                        'bill_id' => $billReturn->id,
                        'code_seat' => $item,
                        'pickup_location' => $startLocation->name,
                        'pay_location' => $endLocation->name,
                    ]);
                }
                SendMailCheckOutSuccess::dispatch($user->name, $billReturn->code_bill, $billReturn->trip_id, $startLocation->name, $endLocation->name, implode(', ', $seatsReturnArray), $user->email);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Có lỗi xảy ra', [$exception]);
            return false;
        }
    }

    public function getTicketForBill() {
        $allTicket = [];
        $idTurn = Cache::get('bill_turn');
        $idReturn = Cache::get('bill_return');
        $ticketTurn = Ticket::query()->with('bill.trip')
            ->where('bill_id', $idTurn)->get();
        Cache::forget('bill_turn');
        $allTicket['turn'] = $ticketTurn;

        if($idReturn !== null){
            $ticketReturn = Ticket::query()->with('bill.trip')
                ->where('bill_id', $idReturn)->get();
            Cache::forget('bill_return');
            $allTicket['return'] = $ticketReturn;
        }
        return $allTicket;
    }

    public function checkoutSuccess(Request $request) {
        $cacheDataVnpay = Cache::get('my_bill_cache'. $request->vnp_TxnRef);
        $cacheDataMomo = Cache::get('my_bill_cache' . $request->orderId);
        if($request->vnp_ResponseCode === "00" && $cacheDataVnpay !== null && $this->saveDataAfterCheckoutSuccess($request, $cacheDataVnpay))
        {
            return view('client.partials.checkout-success', [
                'data' => $this->getTicketForBill(),
                'inforUser' => Cache::get('infor_user'),
                'totalMoney' => $request->vnp_Amount / 100,
                'type_pay' => $cacheDataVnpay['type_payment'],
            ]);
        } else if($request->resultCode === "0" && $cacheDataMomo !== null && $this->saveDataAfterCheckoutSuccess($request, $cacheDataMomo)) {
            return view('client.partials.checkout-success', [
                'data' => $this->getTicketForBill(),
                'inforUser' => Cache::get('infor_user'),
                'totalMoney' => $request->amount,
                'type_pay' => $cacheDataMomo['type_payment'],
            ]);
        }
         else {
            return view('client.partials.checkout-failed', [
                'data' => "Thanh toán thất bại",
            ]);
        }

    }
}
