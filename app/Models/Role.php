<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'roles';
    protected $fillable = [
        'name', 'description', 'created_at', 'updated_at'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id')->whereNull('role_permission.deleted_at')->withTimestamps();
    }

    /**
     * Define the many-to-many relationship with User model through the user_role table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id')->withTimestamps();
    }
}
