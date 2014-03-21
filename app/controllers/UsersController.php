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
		// Grab the fields we need
		$input = Input::only('first_name', 'last_name', 'email', 'password');

		// Setup the validator rules for the inputs
		$validator = Validator::make($input,
		[
			'first_name' => 'required|min:1',
			'last_name' => 'required|min:1',
			'email' => 'required|email|unique:users,emailAddress',
			'password' => 'required|min:6'
		]);

		// Check to see if validation was succesful
		if ($validator->fails())
		{ // Something is wrong, grab the validator messages and pass it on to the view
			$messages = $validator->messages();

			return Redirect::back()->with('error', $messages);
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
