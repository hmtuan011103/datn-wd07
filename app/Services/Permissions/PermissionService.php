<?php

namespace App\Services\Permissions;

use App\Http\Requests\Permission\AddPermissionRequest;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PermissionService
{
    public function index()
    {
        $permissions = Permission::all();
        $data = $this->getListPermission($permissions);

        $flatData = [];

        // Hàm đệ quy để duyệt và sắp xếp dữ liệu
        $this->flattenPermissionData($data, $flatData);

        return $flatData;
    }

    public function getListPermission($permissions, $parent_id = 0)
    {
        $permissionArray = [];

        foreach ($permissions as $key => $permission) {
            if ($parent_id === $permission->parent_id) {
                $permissionArray[] = $permission;
                unset($permissions[$key]);
                $subPermissions = $this->getListPermission($permissions, $permission->id);
                $permissionArray = array_merge($permissionArray, $subPermissions);
            }
        }

        return $permissionArray;
    }

    public function flattenPermissionData($permissions, &$flatData, $level = 0)
    {
        foreach ($permissions as $permission) {
            $permission->level = $level;
            $flatData[] = $permission;

            if (isset($permission->children) && count($permission->children) > 0) {
                $this->flattenPermissionData($permission->children, $flatData, $level + 1);
            }
        }
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
        DB::beginTransaction();
        try{
            $idDelete = Permission::query()->find($id);
            if($idDelete){
                $rolePermissions = RolePermission::query()->where('permission_id', $idDelete)->get();
                if($rolePermissions) {
                    foreach ($rolePermissions as $rolePermission) {
                        RolePermission::query()->find($rolePermission->id)->delete();
                    }
                }
                $childPermissions = Permission::query()->where('parent_id', $idDelete)->get();
                if($childPermissions) {
                    foreach ($childPermissions as $childPermission) {
                        Permission::query()->find($childPermission->id)->delete();
                    }
                }
                $idDelete->delete();
            }
            DB::commit();
            return $idDelete;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Có lỗi khi xóa', [$exception]);
            return false;
        }
    }
}
