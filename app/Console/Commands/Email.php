<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Trip;
use Carbon\Carbon;
use DB;

class Email extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:email';

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
            $currentTime = Carbon::now();
            $recentlyCompletedTrips = Trip::where(function ($query) use ($currentTime) {
                $query->whereDate('start_date', '<', $currentTime->toDateString())
                    ->orWhere(function ($query) use ($currentTime) {
                        $query->whereDate('start_date', '=', $currentTime->toDateString())
                            ->where(function ($query) use ($currentTime) {
                                $query->whereTime(DB::raw('(start_time + interval_trip)'), '<', $currentTime->toTimeString())
                                    ->orWhere(function ($query) use ($currentTime) {
                                        $query->whereTime(DB::raw('(start_time + interval_trip)'), '=', $currentTime->toTimeString());
                                    });
                            });
                    });
            })->where('gmail_sent', 0)->get();
            if ($recentlyCompletedTrips->isNotEmpty()) {
                $relatedUsers = DB::table('bills')
                    ->join('trips', 'bills.trip_id', '=', 'trips.id')
                    ->whereIn('trips.id', $recentlyCompletedTrips->pluck('id'))
                    ->select('bills.*') // Chọn tất cả các cột từ bảng bills
                    ->get();
                $subject = '[CHIENTHANGBUS] Chia Sẻ Trải Nghiệm Của Bạn - Nhà Xe Chiến Thắng Luôn Lắng Nghe';
                Trip::whereIn('id', $recentlyCompletedTrips->pluck('id'))->update(['gmail_sent' => 1]);
                foreach ($relatedUsers as $relatedUser) {
                    $userSendMail = User::query()->find($relatedUser->user_id);
                    $tripInfo = $recentlyCompletedTrips->where('id', $relatedUser->trip_id)->first();
                    Mail::send('client.pages.email.date_time_email', ['user' => $userSendMail,
                        'id_trip' => $relatedUser->id,
                        'tripInfo' => $tripInfo],
                        function ($email) use ($userSendMail, $subject) {
                            $email->subject($subject);
                            $email->to($userSendMail->email);
                        });
                }

            }
        } catch (\Exception $e) {
            \Log::error('Error sending notification email: ' . $e->getMessage());
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }
}
