<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'discount_code_id',
        'seat_id',
        'trip_id',
        'user_id',
        'status_pay',
        'total_money',
        'total_money_after_discount',
        'type_pay'
    ];
}
