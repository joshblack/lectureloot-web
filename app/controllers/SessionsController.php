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
		{ // Authentication is successful

			// Grabbing the current date and then finding the expiration date of the user's token
			$currentDate = new Datetime;
			$expDate = $currentDate->sub(new DateInterval('P6M'));

			// Lookup to see if the user has a token in the database
			$token = Token::where('user_id', Auth::user()->id)->first();

			// Check to see if the user's access token is expired
			if ($token && ($token->updated_at > $expDate))
			{ // Token is expired
				$token->token = str_random(40);
				$token->save();
			}
			else if (!$token)
			{ // No token for the user, we need to create one
				Token::create([
					'token' => str_random(40),
					'user_id' => Auth::user()->id
				]);
			} // Otherwise our token is valid

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