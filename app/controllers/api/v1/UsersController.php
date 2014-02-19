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
}
