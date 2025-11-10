<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('index');
})->name('index');

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

});

Route::get('/admin/category/view', function () {
    return view('admin.viewcategory');
})->name('admin.category.view');


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
Route::get('/admin/product', function () {
    return view('admin.product');
})->name('admin.product');

require __DIR__.'/auth.php';
