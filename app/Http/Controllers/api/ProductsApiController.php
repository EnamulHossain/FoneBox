<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsApiController extends Controller
{
    public function getData(Request $request)
    {
        $searchTerm = $request->input('search');
        $category = $request->input('category');
        $brand = $request->input('brand');

        $query = DB::table('products');

        if ($searchTerm) {
            $query->where('title', 'like', '%' . $searchTerm . '%')
                ->orWhere('price', 'like', '%' . $searchTerm . '%');
        }

        if ($category) {
            $query->where('category', '=', $category);
        }

        if ($brand) {
            $query->where('brand', '=', $brand);
        }

        $productsData = $query->paginate(16);

        return response()->json($productsData);
    }
}
