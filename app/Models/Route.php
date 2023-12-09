<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $table = 'routes';

    protected $fillable = ['name','car_id','driver_id','assistantCar_id','start_time','start_location','status','trip_price','end_location','interval_trip','description'];
}
