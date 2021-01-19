<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class AdminController extends Controller
{
    function dashboard(){

        if (Session::has('id')) {
            return view('admin.pages.dashboard');
        }else{
            return redirect()->route('login')->with('noti', 'Bạn cần đăng nhập!');;
        }
        
    }
}
