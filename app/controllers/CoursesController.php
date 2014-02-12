<?php

class CoursesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$courses = Auth::user()->courses;

        return View::make('courses.index')->withCourses($courses);
	}

	/**
	 * Show the form for creating a new resource, in this case it's our course schedule.
	 *
	 * @return Response
	 */
	public function create()
	{
		$allCourses = Course::all();
		$userCourses = Auth::user()->courses;

        return View::make('courses.create', [
        		'allCourses' => $allCourses,
        		'userCourses' => $userCourses
        	]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = User::find(Auth::user()->id);
		$course = $user->courses->find(Input::get('course_id'));

		// Check to see if the user has the class already
		if ($course)
		{
			return Redirect::back()->with('error', 'You already have this class!');
		}
		else
		{ // The user doesn't have the class
			$user->courses()->attach(Input::get('course_id'));

			return Redirect::back()->with('success', 'Successfully added the course.');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$course = Course::find($id);

        return View::make('courses.show')->withCourse($course);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find(Auth::user()->id);
		$course = $user->courses->find($id);

		// Check to see if the user has the class
		if ($course)
		{
			$user->courses()->detach($id);
			return Redirect::back()->with('success', 'Class removed succesfully');
		}
		else
		{ // The user doesn't have the class
			return Redirect::back()->with('error', 'You do not have this class!');
		}
	}

}
