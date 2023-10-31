<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePermission extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'role_permission';
    protected $fillable = ['permission_id','role_id'];
}
