<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class DQBController extends Controller
{
    function listMember(){

        $rs = DB::table('members')
                    ->join('facultys', 'members.faculty_id', 'facultys.id')
                    ->select('members.id AS id', 'members.name AS name', 'facultys.title AS title', 'members.phone AS phone', 'members.email AS email', 'members.addres AS addres' )
                    ->orderBy('members.id', 'desc')
                    ->paginate(3);
        $count_rs = count($rs);

        return view('admin.pages.DQB.list-member', ['rs' => $rs, 'count_rs' => $count_rs]);

    }

    function deleteMember($id){
    	if (Session::get('role') == 'admin') {

    		$delete = DB::table('members')->where('id', '=', $id)->delete();

    		return redirect()->route('QueryBuilder.list-member')->with('noti', 'Xóa thành công!');
    	}else{

    		return redirect()->route('QueryBuilder.list-member')->with('noti1', 'Bạn không có quyền xóa!');
    	}
    }

    function getFac(){

    	$rs = DB::table('facultys')->get();

    	return view('admin.pages.DQB.add-member', ['rs' => $rs]);
    }

    function addMember(Request $request){

    	$request->validate(
    		[
    			'name'		=>	'required',
    			'email'		=>	'required|email|unique:members',
    			'phone'		=>	'required|unique:members|regex: /^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$/',
    			'addres'	=>	'required'
    		],

    		[
    			'name.required'		=>	'Họ tên không được để trống',
    			'email.required'	=>	'Email không được để trống',
    			'email.email'		=>	'Email không đúng định dạng',
    			'email.unique'		=>	'Email đã trùng',
    			'phone.required'	=>	'Số điện thoại không được để trống',
    			'phone.unique'		=>	'Số điện thoại đã trùng',
    			'phone.regex'		=>	'Số điện thoại không đúng định dạng',
    			'addres.required'	=>	'Địa chỉ không được để trống'
    		]
    	);

    	$add = DB::table('members')->insert(
    		[
    			'name' 			=> 	$request->name,
    			'faculty_id'	=>	$request->faculty,
    			'email'			=>	$request->email,
    			'phone'			=>	$request->phone,
    			'addres'		=>	$request->addres
    		]	
    	);

    	return redirect()->route('QueryBuilder.list-member')->with('noti', 'Thêm mới thành công!');
    }

    function getMember($id){

    	$rs = DB::table('facultys')->get();

    	$member = DB::table('members')->find($id);

    	return view('admin.pages.DQB.edit-member', ['rs' => $rs, 'member' => $member]);
    }

    function editMember(Request $request, $id){

    	$email = $request->email;
    	$phone = $request->phone;

    	$checkUpdate = DB::table('members')
					    ->where(function($query) use($email, $phone) {
					                        $query->where('email', '=', $email)
					                            ->orWhere('phone','=', $phone);
					            })
					    ->where('id','!=',$id)
					    ->get();

		if(count($checkUpdate) == 0){
			$request->validate(
	    		[
	    			'name'		=>	'required',
	    			'email'		=>	'required|email',
	    			'phone'		=>	'required|regex: /^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$/',
	    			'addres'	=>	'required'
	    		],

	    		[
	    			'name.required'		=>	'Họ tên không được để trống',
	    			'email.required'	=>	'Email không được để trống',
	    			'email.email'		=>	'Email không đúng định dạng',
	    			'phone.required'	=>	'Số điện thoại không được để trống',
	    			'phone.regex'		=>	'Số điện thoại không đúng định dạng',
	    			'addres.required'	=>	'Địa chỉ không được để trống'
	    		]
	    	);

	    	$edit = DB::table('members')
	    		->where('id', $id)
	    		->update([
	    			'name'			=>	$request->name,
	    			'faculty_id'	=>	$request->faculty,
	    			'email'			=>	$request->email,
	    			'phone'			=>	$request->phone,
	    			'addres'		=>	$request->addres
	    		]
	    	);

	    	return redirect()->route('QueryBuilder.list-member')->with('noti', 'Cập nhật thành công!');
		}else{
			return redirect()->route('QueryBuilder.edit-member', $id)->with('noti1', 'Email hoặc SĐT đã trùng!');
		}
    }

    function searchPhone(Request $request){

    	$key = $request->key;

    	$rs = DB::table('members')
    			->select('members.id AS id', 'members.name AS name', 'facultys.title AS title', 'members.phone AS phone', 'members.email AS email', 'members.addres AS addres' )
    			->join('facultys', 'members.faculty_id', 'facultys.id')
    			->where('phone', 'LIKE', '%'.$key.'%')
    			->orderBy('members.id', 'desc')
    			->paginate(3);
    	$count = count($rs);
    	$count_rs = count($rs);
    	return view('admin.pages.DQB.list-member', ['rs' => $rs, 'count' => $count, 'count_rs' => $count_rs]);
    }
}
