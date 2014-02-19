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
		try
		{
			Course::make([
				'deptCode' => Input::get('deptCode'),
				'courseNumber' => Input::get('courseNumber'),
				'sectionNumber' => Input::get('sectionNumber'),
				'credits' => Input::get('credits'),
				'instructor' => Input::get('instructor'),
				'courseTitle' => Input::get('courseTitle'),
				'semester' => Input::get('semester'),
				'year' => Input::get('year')
			]);

			$statusCode = 200;
			$value = 'plain/text';
			$contents = 'Success, the course was created';

			$response = Response::make($contents, $statusCode);
			$response->header('Content-Type', $value);
		}
		catch (Exception $e)
		{
			$statusCode = 400;
			$value = 'plain/text';
			$contents = 'Error, could not make the Course';
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

	/**
	 * Get the meetings for a specific course.
	 *
	 * @return Response
	 */
	public function getMeetings($id)
	{
		// Try and find the course
		$course = Course::find($id);

		if ($course)
		{ // We found the course, set the contents to this courses meetings'
			$statusCode = 200;
			$value = 'application/json';
			$contents = $course->meetings;
		}
		else
		{
			$statusCode = 400;
			$value = 'plain/text';
			$contents = 'Error, could not find course id.';
		}

		$response = Response::make($contents, $statusCode);
		$response->header('Content-Type', $value);

		return $response;
	}

}
