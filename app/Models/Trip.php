<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    use HasFactory;
    protected $table = 'trips';

    protected $fillable = ['car_id','drive_id','assistantCar_id','start_date','start_time','start_location','status','trip_price','end_location','interval_trip','route_id'];

    public function bills(): HasMany {
        return $this->hasMany(Bill::class);
    }

    public function car(): BelongsTo {
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function route(): BelongsTo {
        return $this->belongsTo(Route::class);;
    }
}
