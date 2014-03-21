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
		// Grab the input that we need
		$input = Input::only('emailAddress', 'password');

		// Setup our validator rules
		$validator = Validator::make($input, [
			'emailAddress' 	=> 'required|email',
			'password'	=> 'required'
		]);

		if($validator->fails())
		{ // Something went wrong
			$messages = $validator->messages();

			return Redirect::back()->withInput()->with('error', $messages);
		}
		else
		{ // Validation passed, try to login the user
			if (Auth::attempt(Input::only('emailAddress', 'password')))
			{ // Authentication is successful

				// Lookup to see if the user has a token in the database
				$token = Token::where('user_id', Auth::user()->id)->first();

				$currentDate = new Datetime;
				$expDate = $currentDate->add(new DateInterval('P6M'));

				// Check to see if the user's access token is expired
				if ($token && !$token->isValidToken())
				{ // Token exists but is not valid

					// Update the token field value and the expiration date.
					$token->token = str_random(40);
					$token->valid_until = $expDate;
					$token->save();
				}
				else if (!$token)
				{ // No token for the user, we need to create one

					Token::create([
						'token' => str_random(40),
						'user_id' => Auth::user()->id,
						'valid_until' => $expDate
					]);
				} // Otherwise our token is valid

				return Redirect::intended('dashboard')->with('success', 'You have succesfully logged in.');
			}

			return Redirect::back()->withInput()->with('error', 'Invalid credentials');
		}
	}

	public function destroy()
	{

		Auth::logout();

		return Redirect::route('sessions.create');
	}
}
