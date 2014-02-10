<?php

class SessionsController extends BaseController {

	public function create() {
		if (Auth::check())
		{
			return Redirect::route('/');
		}

		return View::make('sessions.create');
	}

	public function store() {

		if (Auth::attempt(Input::only('emailAddress', 'password')))
		{
			return View::make('user.show')->withUsername(Auth::user()->username);
			// return Redirect::route('user')->withUsername(Auth::user()->username);
		}

		return Redirect::back()->withInput();
	}

	public function destroy() {

		Auth::logout();

		return Redirect::route('sessions.create');
	}
}