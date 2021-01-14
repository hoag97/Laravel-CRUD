<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class HomeController extends Controller
{
    function dashboard(){

        if (Session::has('id')) {
            return view('admin.pages.dashboard');
        }else{
            return redirect()->route('login')->with('noti', 'Bạn cần đăng nhập!');;
        }
    	
    }
   	
   	function listMember(){
   		$rs = DB::select("SELECT members.id as 'id', members.name as 'name', facultys.title as 'faculty', members.phone as 'phone', members.email as 'email', members.addres as 'addres' FROM members, facultys WHERE members.faculty_id = facultys.id");
		
    	return view('admin.pages.list-member',  ['rs' => $rs]); 
    }

    function deleteMember($id){
    	
    	$del = DB::delete("DELETE FROM members WHERE id = :id", ['id' => $id]);

       	return redirect()->route('facadeDB.list-member')->with('noti', 'Xóa thành công!');
    }

    function getFac(){
    	$rs = DB::select("SELECT * FROM facultys");

    	return view('admin.pages.add-member', ['rs' => $rs]);
    }

    function addMember(Request $request){
    	$name = $request->name;
    	$faculty_id = $request->faculty;
    	$email = $request->email;
    	$phone = $request->phone;
    	$addres = $request->addres;

    	DB::insert('INSERT INTO members (name, faculty_id, email, phone, addres) values (:name, :faculty_id, :email, :phone, :addres)', ['name' => $name, 'faculty_id' => $faculty_id, 'email' => $email, 'phone' => $phone, 'addres' => $addres]);
    	return redirect()->route('facadeDB.list-member')->with('noti', 'Thêm mới thành công!');
    }

    function getMember($id){
    	$rs = DB::select('SELECT *FROM facultys');
    	$member = DB::select('SELECT *FROM members WHERE id = :id', ['id' => $id]);
    	foreach ($member as $key => $value) {
    		$rs_member = $value;
    	}
        return view('admin.pages.edit-member', ['id' => $id, 'rs' => $rs, 'member' => $rs_member]);	
    }

    function editMember(Request $request, $id){
    	$name = $request->name;
    	$faculty_id = $request->faculty;
    	$email = $request->email;
    	$phone = $request->phone;
    	$addres = $request->addres;

    	DB::update('UPDATE members SET name = :name, faculty_id = :faculty_id, email = :email, phone = :phone, addres = :addres WHERE id = :id', ['name' => $name, 'faculty_id' => $faculty_id, 'email' => $email, 'phone' => $phone, 'addres' => $addres, 'id' => $id]);
    	return redirect()->route('facadeDB.list-member')->with('noti', 'Cập nhật thành công!');
    }

}
