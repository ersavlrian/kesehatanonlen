<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
}