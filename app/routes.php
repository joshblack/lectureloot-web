<?php

Route::get('/', 'HomeController@showHome');

Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');

Route::get('register', ['as' => 'users.create', 'uses' => 'UsersController@create']);
Route::post('register', ['as' => 'users.store', 'uses' => 'UsersController@store']);

Route::get('dashboard', 'HomeController@showDashboard');

Route::resource('sessions', 'SessionsController');

Route::post('checkins', 'CheckinsController@store');

Route::group(array('before' => 'auth'), function()
{
	Route::resource('courses', 'CoursesController');
	Route::resource('wagers', 'WagersController');
	Route::resource('meetings', 'MeetingsController');
	Route::resource('checkins', 'CheckinsController');

});

/* API Routes */

// Registering and loggin in a user
Route::post('api/v1/users', 'Api\v1\UsersController@store');
Route::post('api/v1/users/login', 'Api\v1\UsersController@login');

// Requires valid access token
Route::group(array('prefix' => 'api/v1', 'before' => 'api', 'namespace' => 'Api\v1'), function()
{
	Route::resource('courses', 'CoursesController');
	Route::resource('wagers', 'WagersController');
	Route::resource('meetings', 'MeetingsController');
	Route::resource('users', 'UsersController', ['except' => ['store']]);

	Route::get('users/{id}/courses', 'UsersController@getCourses');
	Route::get('courses/{id}/meetings', 'CoursesController@getMeetings');
	Route::get('buildings/{id}', 'CheckinsController@getBuilding');
});