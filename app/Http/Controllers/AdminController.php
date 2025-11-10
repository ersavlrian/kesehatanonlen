<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Category()
    {
        return view('admin.category');
    }
    public function postCategory(Request $request){
        $category=$request->category;
    }

}
