<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Permission extends Model
{
    use HasFactory;
    protected $table = 'permissions';
    protected $fillable = [
        'name',
        'description',
        'parent_id'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission', 'permission_id', 'role_id')->withTimestamps();
    }
}
