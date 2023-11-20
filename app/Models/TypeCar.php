<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCar extends Model
{
    use HasFactory;
    protected $fillable = [
        'description' ,
        'name',
        'total_seat',
        'type_seats',
    ];


    public function cars(){
        return $this->hasMany(Car::class);
    }
}
