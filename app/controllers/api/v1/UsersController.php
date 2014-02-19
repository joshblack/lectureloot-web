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
