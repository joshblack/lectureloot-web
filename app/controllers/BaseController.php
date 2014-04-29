<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
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

}