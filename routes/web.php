<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DBController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request; 

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use App\Models\Faculty;

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

Route::group(['prefix' => '/'], function() {

    Route::get('/', function() {
	    return view('pages.login');
	})->name('login');

	Route::post('/', 'LoginController@Login')->name('login1');
});

Route::group(['prefix' => 'Register'], function() {

    Route::get('/', function() {
	    return view('pages.register');
	})->name('register');

	Route::post('/', 'RegisterController@Register')->name('register1');
});

/* Admin page */

Route::group(['prefix' => 'Admin'], function(){

	Route::get('/', 'AdminController@dashboard')->name('dashboard');

	Route::get('logout', 'AdminController@logout')->name('logout');
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

/* Eloquent ORM */

Route::group(['prefix' => 'ORM'], function(){

	Route::get('list-member', 'ORMController@listMember')->name('ORM.list-member');

	Route::get('add-member', 'ORMController@getFac')->name('ORM.get-fac');

	Route::post('add-member', 'ORMController@addMember')->name('ORM.add-member');

	Route::get('edit-member/{id}', 'ORMController@getMember')->name('ORM.get-member');

	Route::post('edit-member/{id}', 'ORMController@editMember')->name('ORM.edit-member');

	Route::get('delete-member/{id}', 'ORMController@deleteMember')->name('ORM.delete-member');

	Route::post('list-member', 'ORMController@searchPhone')->name('ORM.seach-phone');
});