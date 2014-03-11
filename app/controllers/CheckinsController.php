<?php

class CheckinsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        //
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        //
	}

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
			$beforeStart = $nextPeriodStart->sub(new DateInterval('PT5M'));

			// Grab the user's courses' meetings
			$courses = Auth::user()->courses;

			foreach ($courses as $course) {

				$meetings = $course->meetings;

				// Look through the courses' meetings to find one that matches the period
				foreach ($meetings as $meeting) {

					// If our meeting period is the next period we want to check
					// and see if the user is in a specified time interval before the
					// period in order to check in prior to class starting
					if ($meeting->period == $nextPeriod->id)
					{
						if ($beforeStart >= $date)
						{ // We have a valid checkin meeting
							$checkinMeeting = $meeting;
						}
						else
						{
							// It's too soon to check in
							$statusCode = 200;
							$value = 'plain/text';
							$contents = 'It\'s too soon to check in';
						}
					}
					else if ($meeting->period == $currentPeriod->id)
					{
						if ($afterStart <= $date)
						{
							// Don't have to worry about this being redefined because the two
							// cases are mutually exclusive
							$checkinMeeting = $meeting;
						}
						else
						{
							// It's too late to check in
							$statusCode = 200;
							$value = 'plain/text';
							$contents = 'It\'s too late to check in';
						}
					}
					else
					{
						// we can't find a meeting that the user can check into
						$statusCode = 200;
						$value = 'plain/text';
						$contents = 'You don\'t have any classes to check into at this time';
					}
				}
			}

			// Check to see if the user is in the right place
			$latitude = Input::get('latitude');
			$longitude = Input::get('longitude');

			try
			{
				// Find the building where the meeting is hosted and that also
				// matches the position of the user
				$building = DB::table('buildings')
					->where('buildingCode', $checkinMeeting->buildingCode)
					->where('gpsLongitude', $longitude)
					->where('gpsLatitude', $latitude)
					->first();
			}
			catch (Exception $e)
			{
				// If a status code isn't previously defined, make one
				if ($statusCode != 200)
				{
					$statusCode = 200;
					$value = 'plain/text';
					$contents = 'Error, the user is not in the right building for the class they are trying to check into.';
				}

				$contents = $contents . ' Building Error, the user is not in the right building for the class they are trying to check into.';
			}

			// If we have a valid meeting and building create a checkin for the user
			if ($checkinMeeting && $building)
			{
				Checkin::create([
					'user_id' => Auth::user()->id,
					'meeting_id' => $checkinMeeting->id,
					'checkin' => true,
					'cancelled' => false
				]);

				$statusCode = 200;
				$value = 'plain/text';
				$contents = 'Success, you have checked in to your class';
			}
			else if ($checkinMeeting && !$building)
			{ // The user isn't in the right place
				$statusCode = 200;
				$value = 'plain/text';
				$contents = $contents . ' Location Error, you aren\'t in the right location for the class you are trying to check into.';
			}

			$response = Response::make($contents, $statusCode);
			$response->header('Content-Type', $value);

			return $response;
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
        //
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        //
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}