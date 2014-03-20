<?php

class UsersController extends BaseController {

	public function showUser()
	{
		return View::make('user.show')->withUsername(Auth::user()->username);
	}

	/**
	 * Show the form for creating a new user
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('user.create');
	}

	/**
	 * Create a new user
	 *
	 * @return Response
	 */
	public function store()
	{
		// Check to see if a user has already been made for the given email address
		$user = User::where('emailAddress', Input::get('email'))->get();

		// Need to check if the $user variable created by the query builder is empty since
		// the function returns an empty array if nothing is found
		if (empty($user))
		{ // A user has already signed up with that email address
			return Redirect::back()->with('error', 'That email address has already been registered');
		}
		else
		{ // We're good to go, try to create a new user

			try
			{
				$user = User::create([
					'emailAddress' => Input::get('email'),
					'firstName' => Input::get('first_name'),
					'lastName' => Input::get('last_name'),
					'password' => Hash::make(Input::get('password'))
				]);

				// Need to login the user here so we can navigate to the dashboard for them
				Auth::login($user);

				return Redirect::to('dashboard')->with('success', 'You have registered successfully!');
			}
			catch (Exception $e)
			{ // Something went wrong
				return Redirect::back()->with('error', 'Something went wrong. Error: ' . $e);
			}
		}
	}
}
