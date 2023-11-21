<?php

namespace App\Jobs;

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

    protected $cacheData;

    public function __construct($cacheData)
    {
        $this->cacheData = $cacheData;
        $this->onConnection('redis');
        $this->onQueue('mail-checkout-success');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $subject = '[CHIENTHANGBUS] Hóa đơn đặt vé';
        $data = $this->cacheData;
        Mail::send('client.pages.email.checkout-success', compact('data'), function ($email) use ($subject) {
            $email->subject($subject);
            $email->to('tuanhmph28448@fpt.edu.vn');
        });
    }
}
