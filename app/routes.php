<?php

Route::get('/', 'HomeController@showHome');

Route::get('/login', 'SessionsController@create');
Route::get('/logout', 'SessionsController@destroy');

Route::get('/register', 'UsersController@create');

Route::get('dashboard', 'HomeController@showDashboard');

Route::resource('sessions', 'SessionsController');

Route::group(array('before' => 'auth'), function()
{
	Route::resource('courses', 'CoursesController');
	Route::resource('wagers', 'WagersController');
	Route::resource('meetings', 'MeetingsController');
});

Route::group(array('prefix' => 'api/v1', 'namespace' => 'Api\v1'), function()
{
	Route::resource('courses', 'CoursesController');
	Route::resource('wagers', 'WagersController');
	Route::resource('meetings', 'MeetingsController');
	Route::resource('users', 'UsersController');
});

// Route::group(['before' => 'api'], function() {

// });