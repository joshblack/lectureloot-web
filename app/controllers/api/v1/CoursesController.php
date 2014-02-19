<?php namespace Api\v1;

use Illuminate\Support\Facades\Response;
use \Course;

class CoursesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $contents = Course::all();
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
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $contents = Course::find($id);

        if ($contents)
        {
        	$statusCode = 200;
        	$value = 'application/json';
        }
        else
        {
        	$statusCode = 400;
        	$value = 'text/plain';
        	$contents = 'Invalid Course id';
        }

        $response = Response::make($contents, $statusCode);
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

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		$course = Course::find($id);

		// Check to see if the Course exists
		if ($course)
		{
			$course->delete();

			$contents = 'Success, course removed';
			$statusCode = 200;
			$value = 'text/plain';
		}
		else
		{ // The course does not exist

			$contents = 'Error, the course does not exist';
			$statusCode = 400;
			$value = 'text/plain';
		}

        $response = Response::make($contents, $statusCode);
		$response->header('Content-Type', $value);

        return $response;
	}

	public function getMeetings($id)
	{
		$course = Course::find($id);

		if ($course)
		{
			return $course->meetings;
		}
		else
		{

		}
	}

}
