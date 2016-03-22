<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function(){
	return Redirect::to('home');
});

Route::controller('home', 'HomeController');

Route::controller('patient', 'PatientController');
Route::controller('referout', 'ReferoutController');
Route::controller('immigration', 'ImmigrationController');
Route::controller('search', 'SearchController');

Route::get('referin', function(){
	return View::make('referins.index');
});

Route::controller('auth', 'Auth\AuthController');

Route::group(['prefix'=>'administrator'], function(){

	Route::get('/', 'Administrators\AdministratorController@index');

	Route::controller('user', 	'Administrators\UserController');
	Route::controller('doctor', 'Administrators\DoctorController');
	Route::controller('ward', 	'Administrators\WardController');
	Route::controller('rfrcs', 	'Administrators\ReferCauseController');
	// Route::controller('prefix', 'Administrators\PrefixController');
});
