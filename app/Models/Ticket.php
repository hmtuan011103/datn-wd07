<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'ticket_order';
    protected $fillable = ['code_ticket', 'bill_id', 'code_seat', 'pickup_location', 'pay_location'];

    public function bill(): BelongsTo
    {
        return $this->belongsTo(Bill::class);
    }
}
