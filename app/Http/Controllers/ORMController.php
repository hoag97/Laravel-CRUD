<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use App\Models\Faculty;
use Session;

/**
 * 
 */
class ORMController extends Controller
{
	
	function listMember(){
		 
		$rs = Member::orderBy('id', 'desc')->paginate(3);

		$count_rs = count($rs);

		return view('admin.pages.ORM.list-member', ['rs' => $rs, 'count_rs' => $count_rs]);
	}

	function getFac(){

		$rs = Faculty::all();

		return view('admin.pages.ORM.add-member', ['rs' => $rs]);
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

	    try {

	    	$add_member = new Member;
		    $name 		             = $request->old('name');
            $add_member->name        = $request->name;

            $add_member->faculty_id  = $request->faculty;
		    $email 		             = $request->old('email');
            $add_member->email       = $request->email;

		    $phone 		             = $request->old('phone');
            $add_member->phone       = $request->phone;

		    $addres 	             = $request->old('addres');
            $add_member->addres      = $request->addres;
		    $add_member->save();
		    return redirect(route('ORM.list-member'))->with('noti', 'Thêm mới thành công!');
	    	
	    } catch (Exception $e) {
	    	return redirect(route('ORM.list-member'))->with('noti1', 'Xảy ra lỗi khi thêm mới! '.$e->getMessage());
	    }
	}

	function getMember($id){

		$member = Member::findOrFail($id);

		$rs = Faculty::all();

		return view('admin.pages.ORM.edit-member', ['member' => $member, 'rs' => $rs]);
	}

	function editMember(Request $request, $id){

		$email = $request->email;
    	$phone = $request->phone;

    	$checkUpdate = Member::where(function($query) use($email, $phone) {
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

	    	$edit = Member::where('id', $id)
	    		->update([
	    			'name'			=>	$request->name,
	    			'faculty_id'	=>	$request->faculty,
	    			'email'			=>	$request->email,
	    			'phone'			=>	$request->phone,
	    			'addres'		=>	$request->addres
	    		]
	    	);

	    	return redirect()->route('ORM.list-member')->with('noti', 'Cập nhật thành công!');
		}else{
			return redirect()->route('ORM.edit-member', $id)->with('noti1', 'Email hoặc SĐT đã trùng!');
		}
	}

	function searchPhone(Request $request){

		$key = $request->key;

		$rs = Member::where('phone', 'LIKE', '%'.$key.'%')
					->orwhere('name', 'LIKE', '%'.$key.'%')
					->paginate(3);
		$count_rs = count($rs);
		$count = count($rs);
		return view('admin.pages.ORM.list-member', ['key' => $key, 'rs' => $rs, 'count_rs' => $count_rs, 'count' => $count]);
	}

	function deleteMember($id){

		$member = Member::findOrFail($id)->delete();

		return redirect(route('ORM.list-member'))->with('noti', 'Xóa thành công');
	}
}