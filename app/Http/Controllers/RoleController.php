<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function __construct(){
         $this->middleware('permission:role-list', ['only' => ['index','show']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    public function index(){
        $data['roles'] = Role::all();
        $data['permissions'] = Permission::all();
        return view('backend.roles.index',$data);
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|unique:roles',
        ]);
        $role = Role::create([
            'name' => $request->name
        ]);
        if($request->has("permissions")){
            $role->permissions()->sync($request->permissions);
        }
        if (!empty($role)) {
            return back();
        }
        return back()->with('success','Added Successfully Done');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,'.$id
        ]);
        $role = Role::where('id',$id)->first();
        $role->name = $request->name;
        if($role->update()){
            if (!empty($request->permissions)) {
                $role->permissions()->sync($request->permissions);
            }
            return back();
        }
        return back()->with('success','Updated Successfully Done');
    }
    public function destroy(Role $role){
        $role->delete();
        return back()->with('error','Deleted Successfully Done');
    }
}
