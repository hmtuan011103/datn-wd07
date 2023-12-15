<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountCode extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'discount_codes';

    protected $fillable = ['id_type_discount_code','name','quantity','quantity_used','start_time','value','code','end_time','name_vip'];
}
