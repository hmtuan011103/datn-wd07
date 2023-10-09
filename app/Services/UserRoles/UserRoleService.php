<?php

namespace App\Services\UserRoles;

use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRoleService
{
    public function index(){
        return UserRole::all();
    }
}
