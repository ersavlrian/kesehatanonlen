<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/',[UserController::class,'home'])->name('index');

Route::get('/test_admin', function () {
    return view('admin.test_admin');
});

Route::get('/dashboard',[UserController::class, 'index'] )->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin')->group(function () {
     Route::get('/category', [AdminController::class, 'Category'])->name('admin.category');
     Route::post('/category', [AdminController::class, 'postCategory'])->name('admin.postcategory');
     Route::delete('/admin.category/{id}', [AdminController::class, 'deleteCategory'])->name('deletecategory');
     Route::put('/admin/category/update/{id}', [AdminController::class, 'updateCategory'])->name('updatecategory');
     Route::get('/product', [AdminController::class, 'product'])->name('admin.product');
     Route::post('/product', [AdminController::class, 'addProduct'])->name('addproduct');
     Route::delete('/product/{id}', [AdminController::class, 'deleteProduct'])->name('deleteproduct');
     Route::put('/product/update/{id}', [AdminController::class, 'updateProduct'])->name('updateproduct');

});

Route::get('/shop', [UserController::class, 'shop'])->name('shop');

require __DIR__.'/auth.php';
