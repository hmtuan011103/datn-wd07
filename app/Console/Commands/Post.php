<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use DB;

class Post extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        try {
            $usersWithMoreThanFiveSeats = DB::table('bills')
                ->select('user_id', DB::raw('SUM(total_seats) as total_seats'))
                ->groupBy('user_id')
                ->having('total_seats', '>=', 1)
                ->get();
            $discount = DB::table('discount_codes')->where('code', 'UuDaiVip1')->first();
            $subject = '[CHIENTHANGBUS] Thông Báo Ưu Đãi';

            foreach ($usersWithMoreThanFiveSeats as $user) {
                $userId = $user->user_id;
                $totalSeats = $user->total_seats;

                // Kiểm tra và thêm mã UuDaiVip1 nếu số ghế lớn hơn hoặc bằng 1
                $discount1 = DB::table('discount_codes')->where('code', 'UuDaiVip1')->first();
                if ($discount1) {
                    $discountId1 = $discount1->id;

                    $currentDiscounts1 = DB::table('users')->where('id', $userId)->value('discount_codes');
                    $currentDiscountsArray1 = json_decode($currentDiscounts1, true) ?? [];

                    if (!in_array($discountId1, $currentDiscountsArray1)) {
                        $currentDiscountsArray1[] = $discountId1;
                        DB::table('users')->where('id', $userId)->update(['discount_codes' => json_encode($currentDiscountsArray1)]);
                    }
                }

                // Kiểm tra và thêm mã UuDaiVip2 nếu số ghế lớn hơn hoặc bằng 5
                $discount2 = DB::table('discount_codes')->where('code', 'UuDaiVip2')->first();
                if ($discount2 && $totalSeats >= 10) {
                    $discountId2 = $discount2->id;

                    $currentDiscounts2 = DB::table('users')->where('id', $userId)->value('discount_codes');
                    $currentDiscountsArray2 = json_decode($currentDiscounts2, true) ?? [];

                    if (!in_array($discountId2, $currentDiscountsArray2)) {
                        $currentDiscountsArray2[] = $discountId2;
                        DB::table('users')->where('id', $userId)->update(['discount_codes' => json_encode($currentDiscountsArray2)]);
                    }
                }
                $discount3 = DB::table('discount_codes')->where('code', 'UuDaiVip3')->first();
                if ($discount3 && $totalSeats >= 20) {
                    $discountId3 = $discount3->id;

                    $currentDiscounts3 = DB::table('users')->where('id', $userId)->value('discount_codes');
                    $currentDiscountsArray3 = json_decode($currentDiscounts3, true) ?? [];

                    if (!in_array($discountId3, $currentDiscountsArray3)) {
                        $currentDiscountsArray3[] = $discountId3;
                        DB::table('users')->where('id', $userId)->update(['discount_codes' => json_encode($currentDiscountsArray3)]);
                    }
                }
                $discount4 = DB::table('discount_codes')->where('code', 'UuDaiVip4')->first();
                if ($discount4 && $totalSeats >= 30) {
                    $discountId4 = $discount4->id;

                    $currentDiscounts4 = DB::table('users')->where('id', $userId)->value('discount_codes');
                    $currentDiscountsArray4 = json_decode($currentDiscounts4, true) ?? [];

                    if (!in_array($discountId4, $currentDiscountsArray4)) {
                        $currentDiscountsArray4[] = $discountId4;
                        DB::table('users')->where('id', $userId)->update(['discount_codes' => json_encode($currentDiscountsArray4)]);
                    }
                }
                // Lấy thông tin chi tiết của người dùng từ bảng 'users'
                $userDetails = DB::table('users')
                    ->select('id', 'name', 'email')
                    ->where('id', $userId)
                    ->first();
                $name = $userDetails->name;
                if ($userDetails) {
                    $emailReceived = $userDetails->email;
                    // Gửi email sử dụng Mailable
                    Mail::send('client.pages.email.schedule-email', ['name' => $name], function ($email) use ($emailReceived, $subject) {
                        $email->subject($subject);
                        $email->to($emailReceived);
                    });
                }
            }
        } catch (\Exception $e) {
            \Log::error('Error sending notification email: ' . $e->getMessage());
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }
}
