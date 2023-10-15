<?php

namespace App\Http\Controllers\UserRoles\Admin;

use App\Http\Controllers\UserRoles\BaseUserRoleController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends BaseUserRoleController
{
    public function index(){
        $title = 'Trang vai trò người dùng';
        $userRoles = $this->userRoleService->index();
        $users = User::all();
        $roles = Role::all();
        return view('admin.pages.userRole.index', compact('title', 'userRoles','users','roles'));
    }
}
