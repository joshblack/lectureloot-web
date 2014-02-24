<?php

Route::get('/', 'HomeController@showHome');

Route::get('/login', 'SessionsController@create');
Route::get('/logout', 'SessionsController@destroy');

Route::get('/register', 'UsersController@create');

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

Route::group(array('prefix' => 'api/v1', 'before' => 'api', 'namespace' => 'Api\v1'), function()
{
	Route::resource('courses', 'CoursesController');
	Route::resource('wagers', 'WagersController');
	Route::resource('meetings', 'MeetingsController');
	Route::resource('users', 'UsersController');

	Route::get('users/{id}/courses', 'UsersController@getCourses');
	Route::get('courses/{id}/meetings', 'CoursesController@getMeetings');
	Route::get('buildings/{id}', 'CheckinsController@getBuilding');
});

// Route::group(['before' => 'api'], function() {

// });