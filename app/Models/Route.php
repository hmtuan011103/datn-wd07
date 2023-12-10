<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    use HasFactory;
    protected $table = 'routes';
    protected $fillable = ['name', 'start_location', 'end_location', 'start_time', 'interval_trip','driver_id','assistantCar_id','car_id','trip_price','status','description'];

    public function trips(): HasMany {
        return $this->hasMany(Trip::class);
    }
}
