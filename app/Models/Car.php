<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_type_car',
        'image' ,
        'license_plate',
        'name',
        'status',
        'color' ,
        'description',
    ];
    public function typeCar()
    {
        return $this->belongsTo(TypeCar::class, 'id_type_car','id');
    }
    public function seats(){
        return $this->hasMany(Seat::class,'car_id','id');
    }


}
