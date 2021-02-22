<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class RegisterController extends Controller
{
    function Register(Request $request){

        $name = $request->name;
        $email = $request->user;
        $passw = $request->passw;
        $confirm_pass = $request->confirm_pass;

        if ($passw == $confirm_pass) {
            DB::insert('INSERT INTO users (name, email, password) values (:name, :email, :passw)', ['name' => $name, 'email' => $email, 'passw' => $passw]);

            return redirect()->route('login')->with('noti1', 'Đăng kí thành công!');
        }else{
            return redirect()->route('register')->with('noti', 'Mật khẩu xác nhận không trùng khớp!');
        }
    }
}
