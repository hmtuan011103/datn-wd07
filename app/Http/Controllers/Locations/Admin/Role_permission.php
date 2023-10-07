<?php

namespace App\Http\Controllers\Locations\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Role_permission extends Controller
{
    //
    public function add(){
        $title = 'Thêm Vai trò - Quyền';
        return view('admin.pages.role_permission.add',compact('title'));
    }
}
