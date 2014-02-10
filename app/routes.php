<?php


Route::get('/', 'HomeController@showHome');

Route::get('login', 'SessionsController@create');
Route::resource('sessions', 'SessionsController');
Route::get('logout', 'SessionsController@destroy');

Route::get('user', 'UsersController@showUser');

Route::group(array('prefix' => 'user'), function() {
	Route::resource('courses', 'CoursesController');
	Route::resource('wagers', 'WagersController');
	Route::resource('meetings', 'MeetingsController');
	Route::resource('schedules', 'SchedulesController');
});






