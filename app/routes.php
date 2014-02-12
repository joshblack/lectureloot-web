<?php

Route::get('/', 'HomeController@showHome');

Route::get('/login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');

Route::resource('sessions', 'SessionsController');

Route::group(array('before' => 'auth'), function()
{
	Route::resource('courses', 'CoursesController');
	Route::resource('wagers', 'WagersController');
	Route::resource('meetings', 'MeetingsController');
});

Route::group(array('prefix' => 'api/v1', 'before' => 'auth', 'namespace' => 'Api\V1'), function()
{
	Route::resource('courses', 'CoursesController');
	Route::resource('wagers', 'WagersController');
	Route::resource('meetings', 'MeetingsController');
});




