<?php

class CheckinsController extends BaseController {

	/**
	 * Checkin a user
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Request::ajax())
		{
			// Grab the current date and find the first period that is
			// immediately before it and grab it
			$date = new Datetime;

			$nextPeriod = Period::where('startTime', '>', $date)->first();
			$currentPeriod = Period::find($nextPeriod->id - 1);

			// Creating the interval for when the user can check in
			$currentPeriodStart = new Datetime($currentPeriod->startTime);
			$afterStart = $currentPeriodStart->add(new DateInterval('PT5M'));

			// Period start is redefined because of the way adding an interval
			// is implemented, it changes the original variable so the value
			// needs to be redeclared so the interval returns the correct time
			$nextPeriodStart = new Datetime($nextPeriod->startTime);
			$beforeStart = $nextPeriodStart->sub(new DateInterval('PT15M'));

			// Grab the user's courses' meetings
			$courses = Auth::user()->courses;

			foreach ($courses as $course) {

				$meetings = $course->meetings;

				// Look through the courses' meetings to find one that matches the period
				foreach ($meetings as $meeting) {

					// Find the correct beginning of the meeting
					$meetingPeriod = $this->parseMeetingPeriod($meeting->period);

					// If our meeting period is the next period we want to check
					// and see if the user is in a specified time interval before the
					// period in order to check in prior to class starting
					if ($meetingPeriod == $nextPeriod->period)
					{
						$checkinMeeting = ($beforeStart < $date) ? $meeting : null;
						$error = 'It\'s too soon to check in';
					}
					else if ($meetingPeriod == $currentPeriod->period)
					{
						$checkinMeeting = ($afterStart > $date) ? $meeting : null;
						$error = 'It\'s too late to check in';
					}
					else
					{
						// We can't find a meeting that the user can check into
						$checkinMeeting = null;
						$error = 'You don\'t have any classes to check into at this time';
					}
				}
			}

			// Check to see if the user is in the right place
			$latitude = Input::get('latitude');
			$longitude = Input::get('longitude');

			// Dummy checkinMeeting
			// $checkinMeeting = DB::table('meetings')->where('id', 3011)->first();

			if ($checkinMeeting != null)
			{ // Grab the building where the meeting is located
				$building = DB::table('buildings')
					->where('id', $checkinMeeting->building_id)
					->first();

				// Check to see if the submitted coordinates are within the acceptable
				// range of the building location
				$tolerance = sqrt(pow(-0.001345, 2) + pow(0.001781, 2));
				$distanceFromBuilding = $this->findDiffInPosition($building, $latitude, $longitude);
			}
			else
			{
				$error = $error . 'You can\'t checkin at this time';
			}

			// Check to see if we have a valid checkin meeting and our distance is within
			// an acceptable range
			if ($checkinMeeting && ($tolerance > $distanceFromBuilding))
			{
				// Create checkin
				Checkin::create([
					'user_id' => Auth::user()->id,
					'meeting_id' => $checkinMeeting->id,
					'checkin' => true,
					'cancelled' => false
				]);

				$success = 'Success, you have checked in to your class';
			}
			else
			{ // The user isn't in the right place
				$statusCode = 200;
				$value = 'plain/text';
				$error = $error . 'Location Error, you aren\'t in the right location for the class you are trying to check into.';
			}

			$contents = ($error) ? $error : $success;
			$statusCode = 200;
			$response = Response::make($contents, $statusCode);
			$response->header('Content-Type', $value);

			return $response;
		}
	}

	/**
	 * Processes a given string to find the base period for the meeting
	 *
	 * @param string $meetingPeriod
	 * @return int $period
	 */
	public function parseMeetingPeriod($meetingPeriod)
	{
		// Determine the meeting period
		switch (strlen($meetingPeriod)) {
			case 4:
				// Check to see if we are in a double block of "E" periods.
				if (substr($meetingPeriod, 0, 1) == 'E')
				{ // We know we have an "E" period range
					$period = substr($meetingPeriod, 0, 2);
				}
				else if (substr($meetingPeriod, 1, 1) != '-')
				{ // We know that we have a double digit period going to "E". E.g. 11E1 (11-E1)
					$period = substr($meetingPeriod, 0, 2);
				}
				else
				{ // We are still in the normal integer periods
					$period = substr($meetingPeriod, 0, 1);
				}
				break;

			case 3:
				// We know that we have a range of periods, E.g. 7-8. Grab the first period
				// in the range
				$period = substr($meetingPeriod, 0, 1);
				break;

			case 2:
			  // We know that we have a singular, double-digit integer period, E.g. 11
				$period = substr($meetingPeriod, 0, 2);
				break;

			case 1:
				// We know that we have a singular, one-digit integer period
				$period = substr($meetingPeriod, 0, 1);
				break;

			default:
				// Something went wrong
				$period = null;
				break;
		}

		return $period;
	}

	/**
	 * Find the distance between the supplied building coordinates and the user submitted coordinates
	 *
	 * @param Building $building, float $latidude, float $longitude
	 * @return float
	 */
	public function findDiffInPosition($building, $latitude, $longitude)
	{

		$diffLongitude = $building->gpsLongitude - $longitude;
		$diffLatitidue = $building->gpsLatitude - $latitude;

		return sqrt(pow($diffLatitidue, 2) + pow($diffLatitidue, 2));
	}
}