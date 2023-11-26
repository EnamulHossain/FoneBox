<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    function __construct(){
         $this->middleware('permission:permission-list', ['only' => ['index','show']]);
         $this->middleware('permission:permission-create', ['only' => ['create','store']]);
         $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }
    public function index(){
        $data['permissions'] = Permission::all();
        return view('backend.permissions.index',$data);
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:permissions',
        ]);
        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);
        if (!empty($permission)) {
            return back();
        }
        return back();
    }
    public function update(Request $request, Permission $permission){
        $request->validate([
            'name' => 'required|unique:permissions',
        ]);
        $permission->name=$request->name;
        $permission->group_name=$request->group_name;
        $permission->update();
        return back();
    }
    public function destroy(Permission $permission){
        $permission->delete();
        return back();
    }
}
