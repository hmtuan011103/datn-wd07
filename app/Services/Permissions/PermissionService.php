<?php

namespace App\Services\Permissions;

use App\Http\Requests\Permission\AddPermissionRequest;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class PermissionService
{
    public function index()
    {
        return Permission::all();
    }
    public function add(AddPermissionRequest $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->all();
            toastr()->success('Thêm dữ liệu thành công!', 'Thành Công');
            return Permission::create($params);
        }
    }
    public function save_edit(Request $request, $id)
    {
        $detail = Permission::find($id);
        if ($request->isMethod('POST')) {
            $params = $request->all();
            $detail->update($params);
            toastr()->success('Sửa dữ liệu thành công!', 'Thành Công');
            return $detail;
        }
    }
    public function delete($id)
    {
        // Permission::find($id)->delete();

        $delete = Permission::where('id', $id)
        ->orWhere('parent_id', $id)
        ->delete();
        if ($delete) {
            RolePermission::where('permission_id', $id)
                ->delete();
            $pers = Permission::where('parent_id', $id)->get();
            foreach ($pers as $per) {
                $id_per = $per->id;
                RolePermission::where('permission_id', $id_per)
                    ->delete();
            }
        }
        // toastr()->success('Xóa dữ liệu thành công!', 'Thành Công');
        return $delete;
    }
}
