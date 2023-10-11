<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Define the one-to-many relationship with the User model
    public function users()
    {
        return $this->hasMany(User::class, 'user_type_id');
    }
}
