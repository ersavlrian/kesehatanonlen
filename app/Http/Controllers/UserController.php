<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;

class UserController extends Controller
{
    public function index(){
        if(Auth::check() && Auth::user()->user_type=="user"){
            return view("dashboard");
      }
      else if(Auth::check() && Auth::user()->user_type=="admin"){
            return view("admin.dashboard");
       }
    }
    public function home()
{
    $products = Product::with('category')->latest()->get();
    $categories = Category::all();
    return view('index', compact('products', 'categories'));
}

public function shop()
{
    $products = Product::with('category')->latest()->paginate(12); // bisa pagination
    $categories = Category::all();
    return view('shop', compact('products', 'categories'));
}


}