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
		$nextMeetingTime = HomeController::findNextMeetingTime();
		$timeTillNextMeeting = $date->diff($nextMeetingTime);
		$courses = $user->courses;

		// get the current session
		$session = DB::table('sessions')
			->where('startDate', '<=', $date)
			->where('endDate', '>=', $date)
			->pluck('id');

		if ($session)
		{
			// Find the user's wager from the current session
			$wager = $user->wagers()->where('session_id', '=', $session)->first();

			return View::make('dashboard', [
					'user' => $user,
					'wager' => $wager,
					'courses' => $courses,
					'timeTillNextMeeting' => $timeTillNextMeeting
				]);
		}
		else
		{
			return View::make('dashboard', [
					'user' => $user,
					'courses' => $courses,
					'timeTillNextMeeting' => $timeTillNextMeeting
				]);
		}
	}

	/**
	 * Find the authenticated user's next meeting start time
	 *
	 * @return Datetime
	 */
	public function findNextMeetingTime()
	{
		$currentTime = new Datetime;
		$courses = Auth::user()->courses;
		$periods = DB::table('periods')->get();

		// Go through each course and find each one's meetings
		foreach ($courses as $course)
		{
			$meetings = $course->meetings;

			foreach ($meetings as $meeting)
			{
				// See when the meeting starts
				$meetingStartTime = new Datetime($periods[$meeting->period]->startTime);

				// If it's already passed, skip that meeting
				if ($meetingStartTime < $currentTime)
				{
					continue;
				}
				else
				{ // We know that the period has yet to begin

					if (isset($nextMeeting))
					{ // A nextMeeting value is defined, we need to see which is closer
						$nextMeetingStartTime = new Datetime($periods[$nextMeeting->period - 1]->startTime);

						$nextMeeting = ($nextMeetingStartTime > $meetingStartTime)
							? $nextMeeting
							: $meeting;
					}
					else
					{ // We need to define the next meeting
						$nextMeeting = $meeting;
					}
				}
				// $periods array is zero indexed so need to subtract one to get our period
				$startTime = new Datetime($periods[$nextMeeting->period - 1]->startTime);
				return $startTime;
			}


		}
	}

}