<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class DBController extends Controller
{
    
   	function listMember(){
   		$rs = DB::select("SELECT members.id as 'id', members.name as 'name', facultys.title as 'faculty', members.phone as 'phone', members.email as 'email', members.addres as 'addres' FROM members, facultys WHERE members.faculty_id = facultys.id");
        $count_rs = count($rs);
		
    	return view('admin.pages.DB.list-member',  ['rs' => $rs, 'count_rs' => $count_rs]); 
    }

    function deleteMember($id){

        if (Session::get('role') == 'admin') {

            $del = DB::delete("DELETE FROM members WHERE id = :id", ['id' => $id]);

            return redirect()->route('facadeDB.list-member')->with('noti', 'Xóa thành công!');
        }else{
            return redirect()->route('facadeDB.list-member')->with('noti1', 'Bạn không có quyền xóa!');
        }
    	
    	
    }

    function getFac(){
    	$rs = DB::select("SELECT * FROM facultys");

    	return view('admin.pages.DB.add-member', ['rs' => $rs]);
    }

    function addMember(Request $request){
    	$name = $request->name;
    	$faculty_id = $request->faculty;
    	$email = $request->email;
    	$phone = $request->phone;
    	$addres = $request->addres;

        $check = DB::select('SELECT *FROM members WHERE phone = :phone OR email = :email', ['phone' => $phone, 'email' => $email]);
        if (count($check) == 0) {
            if ($name != '' && $email != '' && $phone != '' && $addres != '') {
                DB::insert('INSERT INTO members (name, faculty_id, email, phone, addres) values (:name, :faculty_id, :email, :phone, :addres)', ['name' => $name, 'faculty_id' => $faculty_id, 'email' => $email, 'phone' => $phone, 'addres' => $addres]);
                return redirect()->route('facadeDB.list-member')->with('noti', 'Thêm mới thành công!');
            }else{
                return redirect()->route('facadeDB.add-member')->with('noti1', 'Dữ liệu không được để trống!');
            }
        }else{
            return redirect()->route('facadeDB.add-member')->with('noti1', 'SĐT hoặc Email đã trùng!');
        }
    }

    function getMember($id){
    	$rs = DB::select('SELECT *FROM facultys');
    	$member = DB::select('SELECT *FROM members WHERE id = :id', ['id' => $id]);
    	foreach ($member as $key => $value) {
    		$rs_member = $value;
    	}
        return view('admin.pages.DB.edit-member', ['id' => $id, 'rs' => $rs, 'member' => $rs_member]);	
    }

    function editMember(Request $request, $id){
    	$name = $request->name;
    	$faculty_id = $request->faculty;
    	$email = $request->email;
    	$phone = $request->phone;
    	$addres = $request->addres;

        $check = DB::select('SELECT *FROM members WHERE id != :id AND (phone = :phone OR email = :email)', ['id' => $id, 'phone' => $phone, 'email' => $email]);

        if (count($check) == 0 ) {
            if ($name != '' && $email != '' && $phone != '' && $addres != '') {
                DB::update('UPDATE members SET name = :name, faculty_id = :faculty_id, email = :email, phone = :phone, addres = :addres WHERE id = :id', ['name' => $name, 'faculty_id' => $faculty_id, 'email' => $email, 'phone' => $phone, 'addres' => $addres, 'id' => $id]);
                return redirect()->route('facadeDB.list-member')->with('noti', 'Cập nhật thành công!');
            }else{
                return redirect()->route('facadeDB.edit-member', $id)->with('noti1', 'Dữ liệu không được để trống!');
            }
        }else{
            return redirect()->route('facadeDB.edit-member', $id)->with('noti1', 'SĐT hoặc Email đã trùng!');
        }
    }

    function searchPhone(Request $request){
        $key = $request->key;
        $rs = DB::select("SELECT members.id as 'id', members.name as 'name', facultys.title as 'faculty', members.phone as 'phone', members.email as 'email', members.addres as 'addres' FROM members, facultys WHERE phone LIKE :key AND members.faculty_id = facultys.id", ['key' => "%".$key."%"]);
        $count = count($rs);
        $count_rs = count($rs);
        return view('admin.pages.DB.list-member', ['rs' => $rs, 'key' => $key, 'count' => $count, 'count_rs' => $count_rs]);
    }

}
