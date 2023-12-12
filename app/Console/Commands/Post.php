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
                ->having('total_seats', '>', 1)
                ->get();

            $subject = '[CHIENTHANGBUS] Thông Báo Ưu Đãi';

            foreach ($usersWithMoreThanFiveSeats as $user) {
                $userId = $user->user_id;

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
