<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\BlogController;

Route::get('/', function () {  return view('welcome'); });
Route::view('/requirements','requirements');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('products', ProductController::class);
    Route::resource('sizes', SizeController::class);
    Route::resource('blogs', BlogController::class);
    Route::post('/blog_editor_store', [BlogController::class, 'blog_editor_store'])->name('blog_editor_store');

    Route::view('profile', 'backend.users.profile')->name('users.profile');
    Route::put('/profile_update/{id}', [UserController::class, 'profile_update']);

    Route::get('/product_variant_delete/{id}', [ProductVariantController::class, 'product_variant_delete']);
});

require __DIR__.'/auth.php';
