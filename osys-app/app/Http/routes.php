<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('/admin', function(){
	return Redirect::to('/admin/order');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'cart' =>'CartController',
	'menu' => 'MenuController',
	'admin/menu' => 'Admin\MenuController',
	'admin/order' => 'Admin\OrderController',
	'admin/category' => 'Admin\CategoryController',
]);
