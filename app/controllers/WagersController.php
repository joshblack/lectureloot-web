<?php

class WagersController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$wagers = Auth::user()->wagers;

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
		// Try to see if a session exists for the wager the user is trying to make
		try
		{
			$session = WagerSession::where('startDate', '=', Input::get('startDate'))->firstOrFail();
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
				$wager->wagerUnitValue = Input::get('wagerUnitValue');
				$wager->session_id = $session->id;
				$wager->wagerTotalValue = $wager->wagerUnitValue * $numCourses;

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

		$session = WagerSession::where('startDate', '=', Input::get('sessionMonth'))->firstOrFail();
		$numCourses = Auth::user()->courses()->count();
		$wager = Wager::find($id);

		$wager->wagerUnitValue = Input::get('wagerUnitValue');
		$wager->session_id = $session->id;
		$wager->wagerTotalValue = $wager->wagerUnitValue * $numCourses;
		$wager->save();

		return Redirect::route('wagers.index')->with('success', 'The wager has been updated');
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
	 * @return session
	 */
	public function getCurrentSession()
	{

		$date = new Datetime;

		$session = WagerSession::where('startDate', '<=', $date)
								->where('endDate', '>=', $date)
								->first();

		return $session;
	}

}
