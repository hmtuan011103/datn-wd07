<?php

namespace App\Http\Controllers\Locations\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\role\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    //
    public function list()
    {
        $roles = Role::all();
        $title = 'Quản trị vai trò';
        return view('admin.pages.role.main', compact('roles', 'title'));
    }
    public function add(RoleRequest $request)
    {
        $title = 'Thêm mới vai trò';
        if ($request->isMethod('post')) {
            $role = new Role;
            $role->name = $request->name;
            $role->description = $request->description;
            $role->save();
            if ($role->id) {
                Session::flash('success','Thêm vai trò mới thành công');
                return redirect()->route('add_role');
            }
        }
        return view('admin.pages.role.add',compact('title'));
    }
    public function edit(RoleRequest $request, $id)
    {
        $title = 'Sửa vai trò';
        $role =  Role::find($id);
        if ($request->isMethod('post')) {
            $role->name = $request->name;
            $role->description = $request->description;
            $role->save();
            return redirect()->route('list_role');
        }
        return view('admin.pages.role.edit', compact( 'title', 'role'));
    }

    public function delete($id){
        $title = 'Sửa vai trò';
        $role =  Role::find($id);
        if ($role) {
            $result = $role->delete();
            if ($result) {
                Session::flash('success','Xoa thanh cong');
                return redirect()->route('list_role');
            }
        }
    }
}
