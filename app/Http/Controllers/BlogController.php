<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\File;
use App\Models\Blog;
use Image;

class BlogController extends Controller
{    
    function __construct(){
         $this->middleware('permission:blog-list', ['only' => ['index','show']]);
         $this->middleware('permission:blog-create', ['only' => ['create','store']]);
         $this->middleware('permission:blog-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:blog-delete', ['only' => ['destroy']]);
    }
    public function create(){
        return view('backend.blogs.create');
    }
    public function index(){
        $data['blogs'] = Blog::all();
        return view('backend.blogs.index',$data);
    }
    public function store(Request $request){
        $all_data = new Blog;
        $all_data->title = $request->title;
        $all_data->detail = $request->detail;
        if($request->hasfile('image')){
            $file = $request->file('image');
            $name = date('YmdHis') . $file->getClientOriginalName();
            $path = public_path('/images/blogs');
            $img = Image::make($file->path());
            $img->resize(400,300)->save($path.'/'.$name);
            $all_data->image = $name;
        }
        $all_data->save();
        return redirect()->route('blogs.index');
    }
    public function edit($id){
        $data['blog'] = Blog::find($id);
        return view('backend.blogs.edit',$data);
    }

    public function update(Request $request, $id){
        $data = Blog::find($id);
        $data->title = $request->title;
        $data->detail = $request->detail;
        if($request->hasfile('image')){
            $destination = 'images/blogs/'.$data->image;
            if(File::exists($destination)){ File::delete($destination); }  
            $file = $request->file('image');
            $name = date('YmdHis') . $file->getClientOriginalName();
            $path = public_path('/images/blogs');
            $img = Image::make($file->path());
            $img->resize(400,300)->save($path.'/'.$name);
            $data->image = $name;
        }
        $data->update();
        return redirect()->route('blogs.index');
    }
    public function destroy(Blog $blog){
        $destination = 'images/blogs/'.$blog->image;
        if(File::exists($destination)){ File::delete($destination); }  
        $blog->delete();
        return back();
    }
    public function blog_editor_store(Request $request){
        if($request->hasFile('upload')){
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
    
            $file = $request->file('upload');
            $path = public_path('media');
    
            // Save the original image
            $file->move($path, $fileName);
    
            // Resize the image
            $img = Image::make($path . '/' . $fileName);
            $img->resize(400, 300)->save($path . '/' . $fileName);
    
            $url = asset('media/'.$fileName);
    
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }

    // public function blog_editor_store(Request $request){
    //     if($request->hasFile('upload')){
    //         $originName = $request->file('upload')->getClientOriginalName();
    //         $fileName = pathinfo($originName, PATHINFO_FILENAME);
    //         $extension = $request->file('upload')->getClientOriginalExtension();
    //         $fileName = $fileName.'_'.time().'.'.$extension;
    //         $request ->file('upload')->move(public_path('media'),$fileName);
    //         $url = asset('media/'.$fileName);
    //         return response()->json(['fileName'=>$fileName,'uploaded'=>1,'url'=>$url]);
    //     }
    // }
    
}