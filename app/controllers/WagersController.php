<?php

class WagersController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$wagers = Auth::user()->wagers()->orderBy('session_id', 'DESC')->get();

		$currentSession = WagersController::getCurrentSession();

		return View::make('wagers.index', [
			'wagers' => $wagers,
			'currentSession' => $currentSession
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('wagers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$currentDate = new Datetime;
		$startDate = new Datetime(Input::get('startDate'));

		// Check to see if they are trying to make a wager that starts in the past
		if ($startDate < $currentDate)
		{
			return Redirect::back()->with('error', 'Trying to make a wager for a session that\'s already passed.');
		}

		// Try to see if a session exists for the wager the user is trying to make
		try
		{
			$session = WagerSession::where('startDate', '=', $startDate)->firstOrFail();
			$numCourses = Auth::user()->courses()->count();

			$sessionWager = Auth::user()->wagers()->where('session_id', '=', $session->id)->first();

			// Check if the user already has a wager for the session
			if ($sessionWager)
			{
				return Redirect::back()->with('error', 'You\'ve already made a wager for this session');
			}
			else
			{ // The user hasn't made a wager yet for this session, let's make one for him/her
				$wager = new Wager;
				$wager->user_id = Auth::user()->id;
				$wager->wagerTotalValue = Input::get('wagerTotalValue');
				$wager->session_id = $session->id;
				$wager->wagerUnitValue = round($wager->wagerTotalValue / $numCourses, 2);

				$wager->save();

				return Redirect::back()->with('success', 'You\'ve successfully created a wager!');
			}
		}
		catch (Exception $e)
		{
			// Invalid session start date
			return Redirect::back()->with('error', 'Your start date is not valid!');
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
		$wager = Wager::find($id);

		return View::make('wagers.show')->withWager($wager);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$wager = Wager::find($id);

		return View::make('wagers.edit')->withWager($wager);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$currentDate = new Datetime;
		$wager = Wager::find($id);

		$wagerSession = $wager->session;
		$wagerStartDate = new Datetime($wagerSession->startDate);

		// Check to see if it's past the wagers startDate
		if ($wagerStartDate > $currentDate)
		{ // We're good to go, update the wager

			// Find the total number of meetings
			$courses = Auth::user()->courses;
			$numMeetings = WagersController::getNumOfMeetings($courses);

			// Update the session start date if its changed
			$sessionMonth = Input::get('sessionMonth');

			if ($wagerStartDate != $sessionMonth)
			{ // Need to find the new session (if it exists)
				$sessionId = WagerSession::where('startDate', '=', $sessionMonth)->pluck('id');
			}
			else
			{ // Keep the same wager session id
				$sessionId = $wagerSession->id;
			}

			if ($sessionId)
			{
				$wager->wagerTotalValue = Input::get('wagerTotalValue');
				$wager->wagerUnitValue = round($wager->wagerTotalValue / $numMeetings, 2);
				$wager->session_id = $sessionId;
				$wager->save();

				return Redirect::route('wagers.index')->with('success', 'The wager has been updated.');
			}
			else
			{
				return Redirect::back()->with('error', 'Invalid session start date');
			}
		}
		else
		{
			return Redirect::back()->with('error', 'The session for this wager has already begun.');
		}
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
		$startDate = $wager->session->startDate;
		$currentDate = new Datetime;

		// Check to see if we are already in the session
		if ($startDate < $currentDate)
		{
			$wager->delete();
			return Redirect::route('wagers.index')->with('success', 'The wager has been removed');
		}
		else
		{
			return Redirect::back()->with('error', 'The session for this wager has already begun');
		}
	}

	/**
	 * Grab the current Session
	 *
	 * @return WagerSession Eloquent Model
	 */
	public function getCurrentSession()
	{

		$date = new Datetime;

		$session = WagerSession::where('startDate', '<=', $date)
								->where('endDate', '>=', $date)
								->first();

		return $session;
	}

	/**
	 * Gets the number of meetings for a listing of courses
	 *
	 * @param Eloquent Collection
	 * @return int
	 */
	public function getNumOfMeetings($courses)
	{
		$numMeetings = 0;

		// Go through each course and add its meeting count to the total number of meetings
		foreach ($courses as $course)
		{
			$numMeetings += $course->meetings()->count();
		}

		return $numMeetings;
	}
}
