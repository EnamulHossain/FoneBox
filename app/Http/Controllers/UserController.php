<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Image;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{    
    function __construct(){
         $this->middleware('permission:user-list', ['only' => ['index','show']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function create(){
        $data['roles'] = Role::all();
        return view('backend.users.create',$data);
    }
    public function index(){
        $data['users'] = User::all();
        $data['roles'] = Role::all();
        return view('backend.users.index',$data);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8'],
            'role' => ['required'], 
        ]);
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
            
        $role = Role::findByName($validatedData['role']);
        // $user->assignRole($role);
        $user->roles()->sync($role);
        
        // $users = new User;
        // $users->name = $request->name;
        // $users->email = $request->email;
        // $users->password = Hash::make($request->password);
        // $users->save();

        return redirect()->route('users.index');
    }
    public function edit($id)
    {
        $data['user'] = User::find($id);
        $data['roles'] = Role::all();
        $data['permissions'] = Permission::all();
        return view('backend.users.edit',$data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if($user->update()){
            if ($request->roles) {
                $user->roles()->detach();
                $user->assignRole($request->roles);
            }
            return redirect()->route('users.index');
        }
       
        return back();
    }
    // public function update(Request $request, User $user){
    //     $user->name=$request->name;
    //     $user->email=$request->email;
    //     $user->update();
    //     return redirect()->route('users.index');
    // }
    public function destroy(User $user){
        $user->delete();
        return back();
    }
    public function profile_update(Request $request, $id){
        $data = User::find($id);
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->country = $request->country;
        $data->address = $request->address;
        $data->gender = $request->gender;
        if($request->hasfile('image')){
            $destination = 'images/users/'.$data->image;
            if(File::exists($destination)){ File::delete($destination); }
            $file = $request->file('image');
            // $name = $file->getClientOriginalName();
            $name=date('YmdHis') . "." . $file->getClientOriginalExtension();
            $path = public_path('/images/users');
            $img = Image::make($file->path());
            $img->resize(200,200)->save($path.'/'.$name);
            $data->image = $name;
        }
        if($request->hasfile('cover')){
            $destination = 'images/users/'.$data->cover;
            if(File::exists($destination)){ File::delete($destination); }
            $file = $request->file('cover');
            $name = $file->getClientOriginalName();
            // $name=date('YmdHis') . "." . $file->getClientOriginalExtension();
            $path = public_path('/images/users');
            $img = Image::make($file->path());
            $img->resize(700,200)->save($path.'/'.$name);
            $data->cover = $name;
        }
        $data->update();
        return back();
    }
    
}
