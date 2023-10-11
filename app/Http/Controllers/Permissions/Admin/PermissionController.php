<?php

namespace App\Http\Controllers\Permissions\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Permissions\BasePermissionController;
use App\Http\Requests\Permission\AddPermissionRequest;
use Illuminate\Http\Request;
use App\Models\Permission;
use Yoeunes\Toastr\Facades\Toastr;

class PermissionController extends BasePermissionController
{
    public function index()
    {
        $title = 'Trang phân quyền';
        $permissions = $this->permissionService->index();
        return view('admin.pages.permission.main', compact('title', 'permissions'));
    }
    public function add()
    {
        $title = 'Trang add ';
        $permissions = $this->permissionService->index();
        return view('admin.pages.permission.add', compact('title', 'permissions'));
    }
    public function store(AddPermissionRequest $request)
    {
        $this->permissionService->add($request);

        return redirect()->route('list_permission');
    }
    public function edit($id)
    {
        $title = 'Trang phân quyền';
        $permission = Permission::find($id);
        $permissions = Permission::all();
        return view('admin.pages.permission.edit', compact('permission', 'title', 'permissions'));
    }
    public function update(Request $request, $id)
    {
        $detail = $this->permissionService->save_edit($request, $id);
        if ($detail) {
            return redirect()->route('list_permission');
        }
    }
    public function delete($id)
    {
        $delete = $this->permissionService->delete($id);
        if ($delete) {
            return redirect()->route('list_permission');
        }
    }
}
