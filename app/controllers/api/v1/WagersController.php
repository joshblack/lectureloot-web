<?php namespace Api\v1;

use Illuminate\Support\Facades\Response;
use \Wager;

class WagersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$contents = Wager::all();
		$statusCode = 200;
		$value = 'application/json';

		$response = Response::make($contents, $statusCode);
		$response->header('Content-Type', $value);

		return $response;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return 'hi';
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$wager = Wager::find($id);

    	if ($wager)
		{
			$statusCode = 200;
			$value = 'application/json';
			$response = Response::make($wager, $statusCode);
		}
		else
		{
			$statusCode = 400;
			$value = 'text/plain';
			$contents = 'Invalid or undefined wager id';
			$response = Response::make($contents, $statusCode);
		}

		$response->header('Content-Type', $value);

		return $response;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return 'hi';
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$wager = Wager::find($id);

		if ($wager)
		{
			$wager->delete();

			$statusCode = 200;
			$value = 'application/json';
			$contents = 'Success, Wager deleted';
		}
		else
		{
			$statusCode = 400;
			$value = 'text/plain';
			$contents = 'Invalid or unlisted Wager id';
		}

		$response = Response::make($contents, $statusCode);
		$response->header('Content-Type', $value);

		return $response;
	}

}
