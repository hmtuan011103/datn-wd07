<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use App\Services\Permissions\PermissionService;
use Illuminate\Http\Request;

class BasePermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService) {
        $this->permissionService = $permissionService;
    }
}
