<?php

class HomeController extends BaseController {

	public function showHome()
	{
		return View::make('index');
	}

	public function showDashboard()
	{
		// Grab the current user and date
		$user = Auth::user();
		$date = new Datetime;

		// Find and format the next meeting time for the user
		$nextMeetingTime = $this->findNextMeetingTime();
		$timeTillNextMeeting = $this->formatMeetingTime($nextMeetingTime);

		// Grab all the user's courses
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

		// Go through each course and find each one's meetings
		foreach ($courses as $course)
		{
			$meetings = $course->meetings;

			foreach ($meetings as $meeting)
			{
				$meetingPeriod = $this->parseMeetingPeriod($meeting->period);

				// See when the meeting starts
				$meetingStartTime = new Datetime(DB::table('periods')
					->where('period', $meetingPeriod)
					->pluck('startTime'));

				$currentMeetingDay = date('D')[0];

				if (isset($nextMeeting) && $meeting->meetingDay == $currentMeetingDay && $currentTime < $meetingStartTime)
				{ // A $nextMeeting value is defined, we need to see which is closer:
				  // the current iteration of meeting or the one already defined.
					$nextMeetingStartTime = new Datetime(DB::table('periods')
						->where('period', $this->parseMeetingPeriod($nextMeeting->period))
						->pluck('startTime'));

					$nextMeeting = ($nextMeetingStartTime > $meetingStartTime)
						? $nextMeeting
						: $meeting;
				}
				else if ($meeting->meetingDay == $currentMeetingDay && $currentTime < $meetingStartTime)
				{ // We need to define the next meeting
					$nextMeeting = $meeting;
				}
			}
		}

		$startTime = (isset($nextMeeting))
			? new Datetime(DB::table('periods')
				->where('period', $this->parseMeetingPeriod($nextMeeting->period))
				->pluck('startTime'))
			: null;

		return $startTime;
	}

	/**
	 * Formats the given meeting time for the Dashboard view
	 *
	 * @param Datetime $meetingTime
	 * @return String
	 */
	public function formatMeetingTime($meetingTime)
	{
		$date = new Datetime;

		return ($meetingTime)
			? $date->diff($meetingTime)->format(' %r %d days, %h hours %i minutes and %s seconds till your next class')
			: 'No More Classes today';
	}
}