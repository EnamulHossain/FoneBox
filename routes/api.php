<?php

use App\Http\Controllers\GetDataController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Blog;
use App\Models\Size;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/blogs', function(){
    $blogs = Blog::latest()->get();
    return response()->json($blogs);
});

// https://arman.shamim07.com/api/blogs  id,title

Route::get('/sizes', function(){
    $sizes = Size::latest()->get();
    return response()->json($sizes);
});

// https://arman.shamim07.com/api/sizes id,size_name


Route::get('/datas', function(){
    $User = User::latest()->get();
    return response()->json($User);
});


Route::get('/get-data', [GetDataController::class, 'getData']);


