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


Route::get('/test', function(){
	$r = Place::getWithImages(1);
	return Response::json($r);
});

Route::get('/es', function(){
	Session::put('locale', 'es');
	return Redirect::to('/');
});
Route::get('/en', function(){
	Session::put('locale', 'en');
	return Redirect::to('/');
});
Route::group(array('before' =>'noGuest'), function(){
	Route::get('/logout', function(){
		Auth::logout();
		return Redirect::to('/');
	});
	//Temporal
	Route::get('/admin', function(){
		return Redirect::to('/admin/add');
	});
	Route::get('/admin/add', 'PanelController@showAdd');

	Route::get('/admin/del', 'PanelController@showDel');

	Route::get('/admin/edit', 'PanelController@showEdit');

	Route::get('/admin/newUser', 'PanelController@showNewUser');

	Route::post('/admin/newUser', 'PanelController@addUser');

	Route::post('/admin/add', array('before' => 'sanitize', 'uses'=> 'PanelController@add'));

	Route::post('/admin/del', array('before' => 'sanitize', 'uses'=> 'PanelController@delete'));

	Route::post('/admin/edit', array('before' => 'sanitize', 'uses'=> 'PanelController@patch'));
	//Esta ruta post es temporal
	Route::post('/admin/collector', array('before' => 'sanitize', 'uses'=>'CollectorController@getProperty'));

	Route::post('/admin/upload', array('before' => 'sanitize', 'uses'=> 'PanelController@uploadImage'));
});
Route::get('/','HomeController@showWelcome');

Route::get('/getData/{id}.json', array('before' => 'sanitize', 'uses' => 'HomeController@showJson'))
	->where(array('id'=>'[0-9]+'));

Route::get('/knowme' , array('before' => 'sanitize', 'uses' => 'HomeController@showKnowMe'));

Route::get('/buy' , array('before' => 'sanitize', 'uses' => 'HomeController@showBuy'));

Route::get('/support' , array('before' => 'sanitize', 'uses' => 'HomeController@showSupport'));

Route::get('/sell' , array('before' => 'sanitize', 'uses' => 'HomeController@showSell'));

Route::get('/adv' , array('before' => 'sanitize', 'uses' => 'HomeController@showAdv'));

Route::get('/center' , array('before' => 'sanitize', 'uses' => 'HomeController@showCenter'));

Route::get('/contact' , array('before' => 'sanitize', 'uses' => 'HomeController@showContact'));

Route::post('/contact/send' , array('before' => 'sanitize', 'uses' => 'HomeController@SendEMail'));

Route::get('/{title}/{id}','HomeController@showProperty')->where(array('id' => '[0-9]+'));

Route::get('/login', array('before' => 'guest','uses' =>'PanelController@login'));

Route::post('/login', array('before' => 'csrf','uses' =>'PanelController@loginProcess'));

Route::get('/search' , 'SearchController@search');