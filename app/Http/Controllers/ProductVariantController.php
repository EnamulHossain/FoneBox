<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;

class ProductVariantController extends Controller
{
    public function product_variant_delete(Request $request, $id){
        $data = ProductVariant::find($id);
        $data->delete();
        if ($request->ajax()) {return response()->json(['success' => true]);}
        return back();
    }
}
