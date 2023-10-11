<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    protected $fillable = [
        'car_id',
        'code_seat' ,
    ];
    public function car(){
        return $this->belongsTo(Car::class,'car_id','id');
    }
}
