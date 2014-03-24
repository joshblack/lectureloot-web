<?php namespace Api\v1;

use Illuminate\Support\Facades\Response;
use \Meeting;

class MeetingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    $contents = Meeting::all();
		$statusCode = 200;
		$value = 'application/json';

		$response = Response::make($contents, $statusCode);
		$response->header('Content-Type', $value);

		return $response;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $meeting = Meeting::find($id);

		if ($meeting)
		{
			$statusCode = 200;
			$value = 'application/json';
			$response = Response::make($meeting, $statusCode);
		}
		else
		{
			$statusCode = 400;
			$value = 'text/plain';
			$contents = 'Invalid or undefined meeting id';
			$response = Response::make($contents, $statusCode);
		}

		$response->header('Content-Type', $value);

		return $response;
	}
}
