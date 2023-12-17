<?php
namespace App\Jobs;

use App\Mail\DiscountEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendDiscountEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $discountCode;

    public function __construct($user,$discountCode)
    {
        $this->user = $user;
        $this->discountCode = $discountCode;
        $this->onConnection('redis');
        $this->onQueue('discount-success');
    }

    public function handle()
    {
        $subject = '[CHIENTHANGBUS] Chúc Mừng Bạn Đã Trở Thành '.$this->discountCode->name ;
        $emailReceived = $this->user->email;
        $userName = $this->user->name;
        $nameDiscount =  $this->discountCode->name;
        $valueDiscount =  $this->discountCode->value;
        Mail::send('client.pages.email.email-success',
            compact('userName','nameDiscount','valueDiscount'),
            function ($email) use ( $emailReceived,$subject) {
                $email->subject($subject);
                $email->to($emailReceived);
            });
    }
}

