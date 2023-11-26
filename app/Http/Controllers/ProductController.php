<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;          
use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\Size;
use Image;

class ProductController extends Controller
{
    public function create(){
        $data['sizes'] = Size::all();
        return view('backend.products.create',$data);
    }
    public function index(){
        $data['products'] = Product::all();
        $data['sizes'] = Size::all();
        $data['product_variants'] = ProductVariant::all();
        $data['product_images'] = ProductImage::all();
        return view('backend.products.index',$data);
    }
    public function store(Request $request){
        $all_data = new Product;
        $all_data->title = $request->title;
        $all_data->price = $request->price;
        if($request->hasfile('image')){
            $file = $request->file('image');
            $name = date('YmdHis') . $file->getClientOriginalName();
            $path = public_path('/images/products');
            $img = Image::make($file->path());
            $img->resize(300,439)->save($path.'/'.$name);
            $all_data->image = $name;
        }
        $all_data->save();
        $last_product = Product::latest()->first();

        $size_ids = $request->size_id;
        foreach ($size_ids as $size_id) {
            $product_variants =  new ProductVariant;
            $product_variants->product_id =  $last_product->id;
            $product_variants->size_id =  $size_id;
            $product_variants->save();
        }   
        
        if($request->hasfile('image2')){
            $files = $request->file('image2');
            foreach ($files as $file) {
                $product_images =  new ProductImage;
                $product_images->product_id =  $last_product->id;
                $name = date('YmdHis') . $file->getClientOriginalName();
                $path = public_path('/images/products');
                $img = Image::make($file->path());
                $img->resize(300,439)->save($path.'/'.$name);
                $product_images->image2 = $name;
                $product_images->save();
            } 
        }
        return redirect()->route('products.index')->with('success', 'Deleted Successfully');
    }
    public function edit($id){
        $data['product'] = Product::find($id);
        $data['sizes'] = Size::all();
        $data['product_variants'] = ProductVariant::where('product_id',$id)->get();
        $data['product_images'] = ProductImage::where('product_id',$id)->get();
        return view('backend.products.edit',$data);
    }
    public function update(Request $request, $id){
        $data = Product::find($id);
        $data->title = $request->title;
        $data->price = $request->price;
        if($request->hasfile('image')){
            $destination = 'images/products/'.$data->image;
            if(File::exists($destination)){ File::delete($destination); }  
            $file = $request->file('image');
            $name = date('YmdHis') . $file->getClientOriginalName();
            $path = public_path('/images/products');
            $img = Image::make($file->path());
            $img->resize(300,439)->save($path.'/'.$name);
            $data->image = $name;
        }
        
        $abc=[];
        $product_variants = ProductVariant::where('product_id',$id)->get();
        foreach($product_variants as $product_variant){
            $xyz = $request->input('size_id'.$product_variant->id)[0];
            $abc[$product_variant->id] = $xyz;
            $product_variant->size_id =  $abc[$product_variant->id];
            $product_variant->update();
        }
        $size_ids = $request->size_id;
        foreach ($size_ids as $size_id) {
            if($size_id!=null){
                $product_variants =  new ProductVariant;
                $product_variants->product_id =  $data->id;
                $product_variants->size_id =  $size_id;
                $product_variants->save();
            }
        }

        $data->update();
        return redirect()->route('products.index')->with('success', 'Updated Successfully');
    }
    public function destroy($id){
        $product = Product::find($id);
        $destination = 'images/products/'.$product->image;
        if(File::exists($destination)){ File::delete($destination); }  

        $product_variants = ProductVariant::all();
        foreach($product_variants as $product_variant){ 
            if($product_variant->product_id==$product->id){ $product_variant->delete(); }
        }
        $product_images = ProductImage::all();
        foreach($product_images as $product_image){ 
            if($product_image->product_id==$product->id){ 
                $destination = 'images/products/'.$product_image->image2;
                if(File::exists($destination)){ File::delete($destination); } 
                $product_image->delete();
            }
        }

        $product->delete();
        return back();
    }
}
