<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Product;
use App\Models\ProductVariant;

class SizeController extends Controller
{
    public function index(){
        $data['sizes'] = Size::all();
        return view('backend.sizes.index',$data);
    }
    public function store(Request $request){
        $request->validate([ 'size_name' => 'required|unique:sizes', ]);
        $all_data = new Size;
        $all_data->size_name = $request->size_name;
        $all_data->save();
        return back();
    }
    public function update(Request $request, Size $size){
        $request->validate([ 'size_name' => 'required|unique:sizes', ]);
        $size->size_name = $request->size_name;
        $size->update();
        return back();
    }
    public function destroy($id){
        $data = Size::find($id); 
        $product_variants = ProductVariant::where('size_id',$id)->get();
        foreach($product_variants as $product_variant){
            // $products = Product::where('id',$product_variant->product_id)->get();
            // foreach($products as $product){
            //     $product->delete();
            // }
            $product_variant->delete();
        }
        $data->delete();
        return back();
    }
}
