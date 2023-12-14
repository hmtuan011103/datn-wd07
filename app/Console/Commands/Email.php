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
                    ->select('bills.*')
                    ->get();
                $subject = '[CHIENTHANGBUS] Chia Sẻ Trải Nghiệm Của Bạn - Nhà Xe Chiến Thắng Luôn Lắng Nghe';
                $userIds = $relatedUsers->pluck('user_id');
                foreach ($recentlyCompletedTrips as $recentlyCompletedTrip){
                    foreach ($userIds as $user) {
                          $userSendMail = User::query()->find($user);
                        Mail::send('client.pages.email.date_time_email', ['user' => $userSendMail,
                            'id_trip' => $recentlyCompletedTrip->id],
                            function ($email) use ($userSendMail, $subject) {
                            $email->subject($subject);
                            $email->to($userSendMail->email);
                        });
                    }
                }
                Trip::whereIn('id', $recentlyCompletedTrips->pluck('id'))->update(['gmail_sent' => 1]);
            }
        } catch (\Exception $e) {
            \Log::error('Error sending notification email: ' . $e->getMessage());
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }
}
