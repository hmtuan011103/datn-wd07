<?php

namespace App\Http\Controllers\UserRoles;

use App\Http\Controllers\Controller;
use App\Services\UserRoles\UserRoleService;
use Illuminate\Http\Request;

class BaseUserRoleController extends Controller
{
    protected $userRoleService;

    public function __construct(UserRoleService $userRoleService) {
        $this->userRoleService = $userRoleService;
    }
}
