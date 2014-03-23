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
		// Validate the input
		$validator = Validator::make(Input::all(), [
			'startDate' => 'required|date',
			'wagerTotalValue' => 'required|integer'
		]);

		if ($validator->fails())
		{ // Something was wrong with our input
			return Redirect::back()->with('error', $validator->messages());
		}

		$startDate = Input::get('startDate');

		// Check to see if they are trying to make a wager that starts in the past
		if (!WagersController::validStartDate($startDate))
		{
			return Redirect::back()->with('error', 'Trying to make a wager for a session that\'s already passed.');
		}

		// Try to see if a session exists for the wager the user is trying to make
		$session = WagerSession::where('startDate', '=', $startDate)->first();

		if ($session)
		{ // We're good to go
			$numCourses = Auth::user()->courses()->count();

			// Check if the user already has a wager for the session
			if (WagersController::userHasWagerFor($session->id))
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
		else
		{ // Invalid session start date
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
		// Validate the input
		$validator = Validator::make(Input::all(), [
			'startDate' => 'required|date',
			'wagerTotalValue' => 'required|integer'
		]);

		if ($validator->fails())
		{ // Something was wrong with our input
			return Redirect::back()->with('error', $validator->messages());
		}

		$wager = Wager::find($id);
		$startDate = Input::get('startDate');
		$wagerTotalValue = Input::get('wagerTotalValue');

		// Check to see if wager total value has changed
		if ($wager->wagerTotalValue != $wagerTotalValue)
		{ // Total value has changed, let's set up the values to update unit value with

			// Grab the total number of meetings and calculate new unit value
			$courses = Auth::user()->courses;
			$numMeetings  = WagersController::getNumOfMeetings($courses);
			$wagerUnitValue = round($wagerTotalValue / $numMeetings, 2);
		}

		// Check to see if start date has changed
		$wagerSession = WagerSession::find($wager->session_id);

		if ($wagerSession->startDate != $startDate)
		{ // Start date has changed, check to see if the new start date is valid

			$session = WagerSession::where('startDate', '=', $startDate)->first();
			if ($session)
			{ // We have a valid session

				// Check to see if user has a wager already for that session
				if (!WagersController::userHasWagerFor($session->id))
				{ // No wager found for the user in this session
					$session_id = $session->id;
				}
				else
				{ // The user already has a wager for the session
					return Redirect::back()->with('error', 'You already have made a wager for that session.');
				}
			}
			else
			{ // We have an invalid session
				return Redirect::back()->with('error', 'The start date you entered is invalid.');
			}

		}

		// Make the wager
		$wager->wagerTotalValue = isset($wagerTotalValue) ? $wagerTotalValue : $wager->wagerTotalValue;
		$wager->wagerUnitValue = isset($wagerUnitValue) ? $wagerUnitValue : $wager->wagerUnitValue;
		$wager->session_id = isset($session_id) ? $session_id : $wager->session_id;
		$wager->save();

		return Redirect::back()->with('success', 'Wager successfully updated!');
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
		$startDate = new Datetime($wager->session->startDate);
		$currentDate = new Datetime;

		// Check to see if we are already in the session or past it
		if ($startDate > $currentDate)
		{ // The session hasn't started yet
			$wager->delete();
			return Redirect::route('wagers.index')->with('success', 'The wager has been removed');
		}
		else
		{
			return Redirect::route('wagers.index')->with('error', 'The session for this wager has already begun or has passed');
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

	/**
	 * Check to see if a user has a wager for a given session
	 *
	 * @param int
	 * @return bool
	 */
	public function userHasWagerFor($session_id)
	{
		// Try and find a wager for the given session id
		$sessionWager = Auth::user()->wagers()->where('session_id', '=', $session_id)->first();

		return ($sessionWager) ? true : false;
	}

	/**
	 * Check to see if a given start date has already passed
	 *
	 * @param date
	 * @return bool
	 */
	public function validStartDate($date)
	{
		$currentDate = new Datetime;
		$startDate = new Datetime($date);

		return ($startDate < $currentDate) ? false : true;
	}
}
