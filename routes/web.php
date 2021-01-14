<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request; 
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('infos', function() {
//     return 'đạt đầu moi óc chó';
// })->name('infos');
// Route::get('infos/name', function() {
//     return 'dat ngu vkl';
// });
// Route::post('submit-infos', function() {
//     echo "submit dữ liệu";
// });
// Route::match(['POST', 'GET'], 'students', function() {
//     return 'giao diện hiển thị thông tin sinh viên';
// });
// Route::resource('news', 'NewsController'); //Tự động tạo ra các hàm ở NewsController CRUD

// Route::group(['prefix' => 'admin'], function() {

//     Route::get('list', function() {
// 	    return 'hiển thị thành viên';
// 	});

// 	Route::get('create', function() {
// 	    return 'Thêm mới';
// 	});

// 	Route::get('edit', function() {
// 	    return 'Sửa học viên';
// 	});

// 	Route::get('get-name{/name}', function($name) {
// 	    return 'Xin chào'.$name;
// 	});

// 	Route::get('sum/{number1}/{number2}', function($number1, $number2) {
// 	    // echo "Tổng 2 số = ".($number1 + $number2);
// 	    $sum = $number1 + $number2;
// 	    if ($sum > 100) {
// 	    	return redirect(route('infos'));
// 	    }else{
// 	    	return redirect('/');
// 	    }
// 	});
// });


// Route::get('home', function() {
//      return view('home');   
// });   

// Route::get('home', function() {
//      $name = 'Hoag';
//      $age = 23;
//      return view('home', ['name' => $name, 'age' => $age]);
// }); 

Route::get('/', function() {
    return view('pages.login');
})->name('login');

Route::post('/', function(Request $request){
	$user = $request->user;
	$passw = $request->passw;

	$rs = DB::select("SELECT * FROM users where email = :user AND password = :passw ", ['user' => $user, 'passw' => $passw]); 

	if (count($rs) !=0 ) {
		foreach($rs as $rslog) {
        $rslog     = get_object_vars($rslog);
		Session::put('id', $rslog['id']);
        Session::put('name', $rslog['name']);
        
		}
		return redirect()->route('dashboard'); 
	}else{
		return redirect()->route('login')->with('noti', 'Tên đăng nhập hoặc mật khẩu không đúng!');
	}
	
})->name('login1');



Route::get('register', function() {
    return view('pages.register');
})->name('register');

Route::group(['prefix' => 'facadeDB'], function(){
	

	Route::get('/', 'HomeController@dashboard')->name('dashboard');

	Route::get('logout', function(){
		Session::flush();
		Session::forget('id');
		Session::forget('name');	
		Auth::logout();
		return redirect()->route('login');
	})->name('facadeDB.logout');

	Route::get('list-member', 'HomeController@listMember')->name('facadeDB.list-member');

	Route::get('delete-member/{id}', 'HomeController@deleteMember')->name('facadeDB.delete-member');

	Route::get('add-member', 'HomeController@getFac')->name('facadeDB.get-fac');

    Route::post('add-member','HomeController@addMember')->name('facadeDB.add-member');   

    Route::get('edit-member/{id}', 'HomeController@getMember')->name('facadeDB.edit-member');

    Route::post('edit-member/{id}', 'HomeController@editMember')->name('facadeDB.edit-member');

});  


