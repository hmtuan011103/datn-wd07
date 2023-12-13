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
    public $totalSeats;
    public $discount;
    public $vip;

    public function __construct($user, $totalSeats,$discount,$vip)
    {
        $this->user = $user;
        $this->totalSeats = $totalSeats;
        $this->discount = $discount;
        $this->vip = $vip;
        $this->onConnection('redis');
        $this->onQueue('discount-success');
    }

    public function handle()
    {
        $subject = '[CHIENTHANGBUS] Mã Giảm Giá';
        $emailReceived = $this->user->email;
        $userName = $this->user->name;
        $Namediscount = $this->discount->name;
        $valuediscount = $this->discount->value;
        $typediscount = $this->discount->id_type_discount_code;

        if ($typediscount == 1){
            $type_discount = "%";
        }else{
            $type_discount = "VNĐ";
        }
        $Vip = $this->vip;
        // Nếu bạn muốn sử dụng view Laravel, thay vì raw content
        // Mail::send(new DiscountEmail($this->user, $this->totalSeats, $this->discounts));
        // Sử dụng raw content
        Mail::send('client.pages.email.email-success',
            compact('Namediscount','Vip','userName','valuediscount','type_discount'),
            function ($email) use ( $emailReceived,$subject) {
                $email->subject($subject);
                $email->to($emailReceived);
            });
    }
}

