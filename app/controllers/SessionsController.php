<?php

class SessionsController extends BaseController {

	public function create()
	{
		if (Auth::check())
		{
			return Redirect::route('/');
		}

		return View::make('sessions.create');
	}

	public function store()
	{

		if (Auth::attempt(Input::only('emailAddress', 'password')))
		{
			return Redirect::intended('wagers')->with('success', 'You have succesfully logged in.');
		}

		return Redirect::back()->withInput()->with('error', 'Invalid credentials');
	}

	public function destroy()
	{

		Auth::logout();

		return Redirect::route('sessions.create');
	}
}