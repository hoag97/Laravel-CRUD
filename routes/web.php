<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DBController;
use App\Http\Controllers\AdminController;
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

/* Login & Register */
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
        	Session::put('role', $rslog['role']);
		}
		return redirect()->route('dashboard'); 
	}else{
		return redirect()->route('login')->with('noti', 'Tên đăng nhập hoặc mật khẩu không đúng!');
	}
	
})->name('login1');


Route::get('register', function() {
    return view('pages.register');
})->name('register');

Route::post('register', function(Request $request){
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
})->name('register1');

/* Admin page */

Route::group(['prefix' => 'admin'], function(){

	Route::get('/', 'AdminController@dashboard')->name('dashboard');

	Route::get('logout', function(){
		Session::flush();
		Session::forget('id');
		Session::forget('name');	
		Auth::logout();
		return redirect()->route('login');
	})->name('logout');
});

/* Facade DB */

Route::group(['prefix' => 'facadeDB'], function(){

	Route::get('list-member', 'DBController@listMember')->name('facadeDB.list-member');

	Route::get('delete-member/{id}', 'DBController@deleteMember')->name('facadeDB.delete-member');

	Route::get('add-member', 'DBController@getFac')->name('facadeDB.get-fac');

    Route::post('add-member','DBController@addMember')->name('facadeDB.add-member');   

    Route::get('edit-member/{id}', 'DBController@getMember')->name('facadeDB.edit-member');

    Route::post('edit-member/{id}', 'DBController@editMember')->name('facadeDB.edit-member');

    Route::post('list-member', 'DBController@searchPhone')->name('facadeDB.search-phone');

});

/* Query Builder */

Route::group(['prefix' => 'QueryBuilder'], function(){

	Route::get('list-member', 'DQBController@listMember')->name('QueryBuilder.list-member');

	Route::get('delete-member/{id}', 'DQBController@deleteMember')->name('QueryBuilder.delete-member');

	Route::get('add-member', 'DQBController@getFac')->name('QueryBuilder.get-fac');

    Route::post('add-member','DQBController@addMember')->name('QueryBuilder.add-member');   

    Route::get('edit-member/{id}', 'DQBController@getMember')->name('QueryBuilder.edit-member');

    Route::post('edit-member/{id}', 'DQBController@editMember')->name('QueryBuilder.edit-member');

    Route::post('list-member', 'DQBController@searchPhone')->name('QueryBuilder.search-phone');

});


