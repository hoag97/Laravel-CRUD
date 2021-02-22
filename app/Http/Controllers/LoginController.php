<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class LoginController extends Controller
{
    function Login(Request $request){

        $user = $request->user;
        $passw = $request->passw;

        $rs = DB::select("SELECT * FROM users where email = :user AND password = :passw ", ['user' => $user, 'passw' => $passw]); 

        if (count($rs) !=0 ) {
            foreach($rs as $rslog) {
                $rslog     = get_object_vars($rslog);
                Session::put('id', $rslog['id']);
                Session::put('name', $rslog['name']);
                Session::put('role', $rslog['role']);
            }
            return redirect()->route('dashboard'); 
        }else{
            return redirect()->route('login')->with('noti', 'Tên đăng nhập hoặc mật khẩu không đúng!');
        }
    }
}
