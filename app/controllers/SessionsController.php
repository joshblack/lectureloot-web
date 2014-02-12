<?php

class SessionsController extends BaseController {

	public function create()
	{
		if (Auth::check())
		{
			$user = Auth::user();

			return Redirect::to('dashboard')->withUser($user);
		}

		return View::make('sessions.create');
	}

	public function store()
	{

		if (Auth::attempt(Input::only('emailAddress', 'password')))
		{
			return Redirect::intended('dashboard')->with('success', 'You have succesfully logged in.');
		}

		return Redirect::back()->withInput()->with('error', 'Invalid credentials');
	}

	public function destroy()
	{

		Auth::logout();

		return Redirect::route('sessions.create');
	}
}