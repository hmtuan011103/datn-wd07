<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'ticket_order';
    protected $fillable = ['code_ticket','bill_id','code_seat','pickup_location','pay_location'];
}
