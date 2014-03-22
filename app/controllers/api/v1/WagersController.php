<?php namespace Api\v1;

use Illuminate\Support\Facades\Response;
use \Wager;
use \Input;

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
		$input = Input::all();

		try
		{  // Try to make a wager with the input data given
			Wager::create([
				'user_id' => $input['user_id'],
				'session_id' => $input['session_id'],
				'wagerUnitValue' => $input['wagerUnitValue'],
				'wagerTotalValue' => $input['wagerTotalValue'],
				'pointsLost' => $input['pointsLost']
			]);

			$statusCode = 200;
			$value = 'plain/text';
			$contents = 'Success, the wager was created.';

			$response = Response::make($contents, $statusCode);
			$response->header('Content-Type', $value);
		}
		catch (\Exception $e)
		{ // Something went wrong
			$statusCode = 400;
			$value = 'plain/text';
			$contents = 'Error, could not create the Wager. Exception: ' . $e;
			$response = Response::make($contents, $statusCode);
			$response->header('Content-Type', $value);
		}

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
		$wager = Wager::find($id);

		if ($wager)
		{ // If we can find the Wager, update the model with the data given
			$postInput = file_get_contents('php://input');
			$data = json_decode($postInput, true);

			try
			{ // Try to update the wager's properties by seeing if the property is defined
			  // in the submitted data, otherwise set it equal to itself
				$wager->user_id = (isset($data['user_id'])) ? $data['user_id'] : $wager->user_id;
				$wager->session_id = (isset($data['session_id'])) ? $data['session_id'] : $wager->session_id;
				$wager->wagerUnitValue = (isset($data['wagerUnitValue'])) ? $data['wagerUnitValue'] : $wager->wagerUnitValue;
				$wager->wagerTotalValue = (isset($data['wagerTotalValue'])) ? $data['wagerTotalValue'] : $wager->wagerTotalValue;
				$wager->pointsLost = (isset($data['pointsLost'])) ? $data['pointsLost'] : $uwager>pointsLost;
				$wager->save();

				$statusCode = 200;
				$value = 'text/plain';
				$contents = 'Success, Wager updated.';
			}
			catch (\Exception $e)
			{ // One of the values we were trying to update is invalid
				$statusCode = 400;
				$value = 'text/plain';
				$contents = 'Invalid submitted Wager data. Exception: ' . $e;
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
