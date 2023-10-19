<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $table = 'trips';

    protected $fillable = ['car_id','drive_id','assistantCar_id','start_date','start_time','start_location','status','trip_price','end_location'];
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
