<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('admin/logout','UserController@getadminLogout');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::group(['middleware'=>'auth'], function () {
	Route::get('users',['middleware'=>'check-permission:user|editor|admin','uses'=>'HomeController@allUsers']);
	Route::get('editor',['middleware'=>'check-permission:editor|admin','uses'=>'HomeController@editor']);
	Route::get('admin',['middleware'=>'check-permission:admin','uses'=>'HomeController@admin']);
});

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function()
	{
	//users
	Route::group(['prefix'=>'users'],function(){
		Route::get('list','UserController@getList');

		Route::get('edit/{id}','UserController@getEdit');
		Route::post('edit/{id}','UserController@postEdit');

		Route::get('add','UserController@getAdd');
		Route::post('add','UserController@postAdd');

		Route::get('delete/{id}','UserController@getDelete');
	});
	//posts
	Route::group(['prefix'=>'posts'],function(){
		Route::get('list','PostController@getList');

		Route::get('edit/{id}','PostController@getEdit');
		Route::post('edit/{id}','PostController@postEdit');

		Route::get('add','PostController@getAdd');
		Route::post('add','PostController@postAdd');

		Route::get('delete/{id}','PostController@getDelete');
	});
});
