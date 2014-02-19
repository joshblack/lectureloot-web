<?php namespace Api\v1;

use Illuminate\Support\Facades\Response;
use \User;

class UsersController extends \BaseController {

	public function index()
	{
		$contents = User::all();
		$statusCode = 200;
		$value = 'application/json';

		$response = Response::make($contents, $statusCode);

		$response->header('Content-Type', $value);

		return $response;
	}

	public function show($id)
	{
		$user = User::find($id);

		if ($user)
		{
			$statusCode = 200;
			$value = 'application/json';
			$response = Response::make($user, $statusCode);
		}
		else
		{
			$statusCode = 400;
			$value = 'text/plain';
			$contents = 'Invalid or unlisted User id';
			$response = Response::make($contents, $statusCode);
		}

		$response->header('Content-Type', $value);

		return $response;
	}

	/**
	 * Register the user
	 *
	 * @return Response
	 */
	public function store()
	{
		// Grab the post data
		$postInput = file_get_contents('php://input');
		$data = json_decode($postInput, true);

		// Creating a default value for pointBalance for when we create the user
		$pointBalance = (isset($data['pointBalance'])) ? $data['pointBalance'] : 50;

		try
		{  // Try to make a user with the data given
			User::create([
				'emailAddress' => $data['emailAddress'],
				'password' => $data['password'],
				'username' => $data['username'],
				'firstName' => $data['firstName'],
				'lastName' => $data['lastName'],
				'pointBalance' => $pointBalance
			]);

			$statusCode = 200;
			$value = 'plain/text';
			$contents = 'Success, the user was registered';

			$response = Response::make($contents, $statusCode);
			$response->header('Content-Type', $value);
		}
		catch (\Exception $e)
		{ // Something went wrong
			$statusCode = 400;
			$value = 'plain/text';
			$contents = 'Error, could not create the User. Exception: ' . $e;
			$response = Response::make($contents, $statusCode);
			$response->header('Content-Type', $value);
		}

		return $response;
	}

	/**
	 * Updating a user
	 *
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);

		if ($user)
		{ // If we can find the User, update the model with the data given
			$postInput = file_get_contents('php://input');
			$data = json_decode($postInput, true);

			try
			{ // Try to update the user's properties by seeing if the property is defined
			  // in the submitted data payload, otherwise set it equal to itself
				$user->emailAddress = (isset($data['emailAddress'])) ? $data['emailAddress'] : $user->emailAddress;
				$user->password = (isset($data['password'])) ? $data['password'] : $user->password;
				$user->username = (isset($data['username'])) ? $data['username'] : $user->username;
				$user->firstName = (isset($data['firstName'])) ? $data['firstName'] : $user->firstName;
				$user->lastName = (isset($data['lastName'])) ? $data['lastName'] : $user->lastName;
				$user->pointBalance = (isset($data['pointBalance'])) ? $data['pointBalance'] : $user->pointBalance;

				$user->save();

				$statusCode = 200;
				$value = 'text/plain';
				$contents = 'Success, User updated.';
			}
			catch (\Exception $e)
			{ // One of the values we were trying to update is invalid
				$statusCode = 400;
				$value = 'text/plain';
				$contents = 'Invalid submitted User data. Exception: ' . $e;
			}
		}
		else
		{
			$statusCode = 400;
			$value = 'text/plain';
			$contents = 'Invalid or unlisted User id';
		}

		$response = Response::make($contents, $statusCode);
		$response->header('Content-Type', $value);

		return $response;
	}

	public function destroy($id)
	{
		$user = User::find($id);

		if ($user)
		{
			$user->delete();

			$statusCode = 200;
			$value = 'application/json';
			$contents = 'Success, User deleted';
		}
		else
		{
			$statusCode = 400;
			$value = 'text/plain';
			$contents = 'Invalid or unlisted User id';
		}

		$response = Response::make($contents, $statusCode);
		$response->header('Content-Type', $value);

		return $response;
	}

	public function getCourses($id)
	{
		$user = User::find($id);

		if ($user)
		{
			$contents = $user->courses;
			$statusCode = 200;
			$value = 'application/json';
		}
		else
		{
			$statusCode = 400;
			$value = 'text/plain';
			$contents = 'Invalid or undefined User id';
		}

		$response = Response::make($contents, $statusCode);
		$response->header('Content-Type', $value);

		return $response;
	}
}
