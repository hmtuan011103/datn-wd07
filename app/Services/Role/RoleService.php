<?php

namespace App\Services\Role;

use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Session;

class RoleService
{

    public function index()
    {
        return Role::all();
    }

    public function add(StoreRoleRequest $request)
    {
        if ($request->isMethod('post')) {
            $role = new Role;
            $role->name = $request->name;
            $role->description = $request->description;
            $role->save();
            foreach ($request->permission as $permission) {
                $rolepermission = new RolePermission;
                $rolepermission->role_id = $role->id;
                $rolepermission->permission_id = $permission;
                $rolepermission->save();
            }
            return $role;
        }
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $role = Role::find($id);
        if ($request->isMethod('post')) {
            $role->name = $request->name;
            $role->description = $request->description;
            $role->save();
            $selectedPers = $request->input('permission', []);
            $role->permissions()->sync($selectedPers);
            return $role;
        }
    }

    public function delete($id)
    {
        $role =  Role::find($id);
        if ($role) {
            $result = $role->delete();
            RolePermission::where(['role_id' => $id])->delete();
            return $result;
        }
    }
}
