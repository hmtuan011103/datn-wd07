<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'total_seats',
        'type_pay',
        'code_bill',
        'user_email',
        'user_name',
        'user_phone',
    ];

    public function trip() : BelongsTo{
        return $this->belongsTo(Trip::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function discountCode() : BelongsTo {
        return $this->belongsTo(DiscountCode::class);
    }
}
