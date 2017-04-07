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

Route::get('/', function () {
    return view('index');
});

Route::get('login',['as' => 'getLogin', 'uses' => 'LoginController@getLogin']);
Route::post('login',['as' => 'postLogin', 'uses' => 'LoginController@postLogin']);
Route::group(['middleware'=>'isteacher'], function(){
	Route::group(['prefix' => 'teachersites'], function(){
		//Route::get('/',['as' => 'getStatistics', 'uses' => 'AdminController@getStatistics']);
		Route::get('/', function(){
    		return "You are login as teacher";
    	});

	});
});

