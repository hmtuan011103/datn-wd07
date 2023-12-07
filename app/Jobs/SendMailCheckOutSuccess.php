<?php

namespace App\Jobs;

use App\Models\Trip;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailCheckOutSuccess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $userName;
    protected $codeBill;
    protected $tripId;
    protected $startLocation;
    protected $endLocation;
    protected $seats;
    protected $email;

    public function __construct($userName, $codeBill, $tripId, $startLocation, $endLocation, $seats, $email)
    {
        $this->userName = $userName;
        $this->codeBill = $codeBill;
        $this->tripId = $tripId;
        $this->startLocation = $startLocation;
        $this->endLocation = $endLocation;
        $this->seats = $seats;
        $this->email = $email;
        $this->onConnection('redis');
        $this->onQueue('mail-checkout-success');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $subject = '[CHIENTHANGBUS] Hóa đơn đặt vé';
        $userName = $this->userName;
        $codeBill = $this->codeBill;
        $trip = Trip::query()->find($this->tripId);
        $startLocation = $this->startLocation;
        $endLocation = $this->endLocation;
        $seats = $this->seats;
        $emailReceived = $this->email;
        Mail::send('client.pages.email.checkout-success',
            compact('userName','codeBill','trip','startLocation','endLocation','seats'),
            function ($email) use ($emailReceived, $subject) {
                $email->subject($subject);
                $email->to($emailReceived);
        });
    }
}
