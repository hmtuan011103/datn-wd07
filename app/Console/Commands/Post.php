<?php

namespace App\Console\Commands;

use App\Models\DiscountCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use DB;

class Post extends Command
{
    protected $signature = 'post:cron';
    protected $description = 'Command description';

    public function handle()
    {
        try {
            $usersWithMoreThanOneSeat = \DB::table('bills')
                ->select('user_id', \DB::raw('SUM(total_seats) as total_seats'))
                ->groupBy('user_id')
                ->having('total_seats', '>=', 1)
                ->get();

            $subject = '[CHIENTHANGBUS] Thông Báo Ưu Đãi';

            foreach ($usersWithMoreThanOneSeat as $user) {
                $userId = $user->user_id;
                $totalSeats = $user->total_seats;

                $userDetails = User::select('id', 'name', 'email')
                    ->where('id', $userId)
                    ->where('user_type_id', 1)
                    ->first();

                if ($userDetails) {
                    if ($totalSeats >= 1 && $totalSeats < 9) {
                        $this->createDiscountCode($userId, 'Ưu Đãi Cho Khách Hàng Vip 1!', 5);
                    } elseif ($totalSeats >= 10 && $totalSeats < 20) {
                        $this->createDiscountCode($userId, 'Ưu Đãi Cho Khách Hàng Vip 2!', 10);
                    }elseif ($totalSeats >= 20 && $totalSeats < 30) {
                        $this->createDiscountCode($userId, 'Ưu Đãi Cho Khách Hàng Vip 3!', 15);
                    }else{
                        $this->createDiscountCode($userId, 'Ưu Đãi Cho Khách Hàng Vip 4', 20);
                    }
                    $this->sendNotificationEmail($userDetails, $subject);
                }
            }
        } catch (\Exception $e) {
            \Log::error('Error sending notification email: ' . $e->getMessage());
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }

    protected function createDiscountCode($userId, $name, $value)
    {
        $discountCode = new DiscountCode();
        $discountCode->id_type_discount_code = 1;
        $discountCode->name = $name;
        $discountCode->quantity = 1;
        $discountCode->quantity_used = 0;
        $discountCode->start_time = Carbon::now();
        $discountCode->value = $value;
        $discountCode->end_time = Carbon::now()->addDays(15);
        $discountCode->code = strtoupper(Str::random(12));
        $discountCode->name_vip = 1;
        $discountCode->save();

        $discountCodeId = $discountCode->id;
        $currentDiscounts = User::where('id', $userId)->value('discount_codes');
        $currentDiscountsArray = json_decode($currentDiscounts, true) ?? [];

        if (!in_array($discountCodeId, $currentDiscountsArray)) {
            $currentDiscountsArray[] = $discountCodeId;
            User::where('id', $userId)->update(['discount_codes' => json_encode($currentDiscountsArray)]);
        }
    }

    protected function sendNotificationEmail($userDetails, $subject)
    {
        $name = $userDetails->name;
        $emailReceived = $userDetails->email;

        if ($emailReceived) {
            Mail::send('client.pages.email.schedule-email', ['name' => $name], function ($email) use ($emailReceived, $subject) {
                $email->subject($subject);
                $email->to($emailReceived);
            });
        }
    }
}
