<?php

namespace App\Http\Controllers\Role\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\role\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Services\Role\RoleService;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Role\BaseRoleController;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\RolePermission;
use Yoeunes\Toastr\Facades\Toastr;
use Yoeunes\Toastr\Toastr as ToastrToastr;

class RoleController extends BaseRoleController
{
    //
    public function list()
    {
        $title = 'Quản trị vai trò';
        $roles = $this->roleService->index();
        return view('admin.pages.role.main', compact('roles', 'title'));
    }
    public function add()
    {
        $title = 'Thêm mới vai trò';
        $permission = Permission::where(['parent_id' => 0])->get();
        return view('admin.pages.role.add', compact('title','permission'));
    }
    public function store(StoreRoleRequest $request)
    {
        $role = $this->roleService->add($request);
        if ($role->id) {
            toastr()->success('Thêm vai trò mới thành công!');
            return redirect()->route('add_role');
        }
    }
    public function edit($id)
    {
        $title = 'Sửa vai trò';
        $role =  Role::find($id);
        $role_permission = RolePermission::where(['role_id' => $id])->get();
        $permission = Permission::where(['parent_id' => 0])->get();
        return view('admin.pages.role.edit', compact('title', 'role','role_permission','permission'));
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $role = $this->roleService->update($request, $id);
        if ($role) {
            toastr()->success('Sửa vai trò mới thành công!');
            return redirect()->route('list_role');
        }
    }

    public function delete($id)
    {
        $result = $this->roleService->delete($id);
        if ($result) {
            return response()->json(["Xóa thành công!"],200);
        }
    }

    public function details($id){
        $role = Role::find($id);
        $role_permission = RolePermission::where(['role_id' => $id])->get();
        return response()->json([$role,$role_permission],200);
    }
    public function getPermission($id){
        $permission = Permission::find($id);
        return response()->json([$permission],200);
    }
}
