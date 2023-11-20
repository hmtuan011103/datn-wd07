<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, CanResetPasswordContract
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type_id',
        'phone_number',
        'address',
        'description',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the user's permissions.
     */
    public function getPermissionsAttribute()
    {
        // Check if the user permissions are already loaded
        if (!$this->relationLoaded('permissions')) {
            // Load and cache user permissions
            $this->load('roles.permissions');
            $permissions = collect();
            foreach ($this->roles as $role) {
                $filteredPermissions = $role->permissions->where('parent_id', '!=', 0)->pluck('name');
                $permissions = $permissions->merge($filteredPermissions);
            }
            // Use unique() to remove duplicates and reindex the keys
            $uniquePermissions = $permissions->unique()->values()->toArray();

            $this->setRelation('permissions', $uniquePermissions);
        }

        // Return the user permissions
        return $this->getRelation('permissions');
    }

    // Define the inverse one-to-many relationship with the TypeUser model
    public function typeUser()
    {
        return $this->belongsTo(TypeUser::class, 'user_type_id');
    }

    /**
     * Define the many-to-many relationship with Role model through the user_role table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id')->withTimestamps();
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
