<?php

class HomeController extends BaseController {

	public function showHome()
	{
		return View::make('index');
	}

	public function showDashboard()
	{
		$user = Auth::user();
		$date = new Datetime;

		// get the current session
		$session = DB::table('sessions')
			->where('startDate', '<=', $date)
			->where('endDate', '>=', $date)
			->pluck('id');

		// Find the user's wager from the current session
		$wager = $user->wagers()->where('session_id', '=', $session)->get();

		// Find user's courses for the semester.
		$courses = $user->courses;

		return View::make('dashboard', [
				'user' => $user,
				'wager' => $wager,
				'courses' => $courses
			]);
	}

}