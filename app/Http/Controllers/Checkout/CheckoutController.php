<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Location;
use App\Models\Seat;
use App\Models\Ticket;
use App\Models\User;
use App\Services\CheckoutService\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{

    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;

    }

    public function checkout(Request $request) {
        try {
            $vnp_Url = $this->checkoutService->createPayment($request);
            if ($request->has('redirect')) {
                return redirect($vnp_Url);
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
                'type_pay' => 1,
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
                    'type_pay' => 1,
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
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Có lỗi xảy ra', [$exception]);
        }
    }

    public function getTicketForBill() {
        $allTicket = [];
        $idTurn = Cache::get('bill_turn');
        $idReturn = Cache::get('bill_return');
        $ticketTurn = Ticket::query()->with('bill.trip')
            ->where('bill_id', $idTurn)->get();
        $allTicket['turn'] = $ticketTurn;
        if($idReturn !== null){
            $ticketReturn = Ticket::query()->with('bill.trip')
                ->where('bill_id', $idReturn)->get();
            $allTicket['return'] = $ticketReturn;
        }
        return $allTicket;
    }

    public function checkoutSuccess(Request $request) {
        $cacheData = Cache::get('my_bill_cache');
        if($request->vnp_ResponseCode === "00" && $cacheData !== null){
            $this->saveDataAfterCheckoutSuccess($request, $cacheData);
            return view('client.partials.checkout-success', [
                'data' => $this->getTicketForBill(),
                'inforUser' => Cache::get('infor_user'),
                'totalMoney' => $request->vnp_Amount / 100
            ]);
        } else {
            return view('client.partials.checkout-failed', [
                'data' => "Thanh toán thất bại",
            ]);
        }

    }
}
