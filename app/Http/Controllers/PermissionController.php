<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function list(){
        $title = 'Trang phân quyền';
        $permissions = Permission::all();
        return view('admin.pages.permission.index',compact('title','permissions'));
    }
    public function add(Request $request){
        if($request->isMethod('POST')){
            if($request['parent_id'] == ''){
                $request['parent_id'] == 0;
                $params = $request->all();
            }else{
                 $params = $request->all();
            }
            $permissions = Permission::create($params);
            if($permissions){
                return redirect()->route('listPermission');
            }
        }
    }
    public function edit($id){
        $title = 'Trang phân quyền';
        $permission = Permission::find($id);
        $permissions = Permission::all();
        return view('admin.pages.permission.edit',compact('permission','title','permissions'));
    }
    public function save_edit(Request $request,$id){
        $detail = Permission::find($id);
        if($request->isMethod('POST')){
            $params = $request->all();
            $detail->update($params);
            if($detail){
                return redirect()->route('listPermission');
            }
        }
    }
    public function delete($id){
        Permission::find($id)->delete();
        return redirect()->route('listPermission');
   }
}
