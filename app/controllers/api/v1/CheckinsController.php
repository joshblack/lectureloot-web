<?php namespace Api\v1;

use Illuminate\Support\Facades\Response;
use \Checkin;
use \DB;

class CheckinsController extends \BaseController {

	public function getBuilding($id)
	{
		$contents = DB::table('buildings')
			->where('id', $id)
			->get();

		if ($contents)
		{
			$statusCode = 200;
			$value = 'application/json';
		}
		else
		{
			$statusCode = 400;
			$value = 'plain/text';
			$contents = 'Error, no building found with that id.';
		}

		$response = Response::make($contents, $statusCode);
		$response->header('Content-Type', $value);

        return $response;
	}

}