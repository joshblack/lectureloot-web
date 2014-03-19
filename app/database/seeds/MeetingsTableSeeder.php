<?php

class MeetingsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('meetings')->truncate();

		$meetings = array(
			[
				'course_id' => 1,
				'building_id' => 1,
				'roomNumber' => '109',
				'meetingDay' => 'm',
				'period' => '6'
			],
			[
				'course_id' => 1,
				'building_id' => 1,
				'roomNumber' => '109',
				'meetingDay' => 'w',
				'period' => '6'
			],
			[
				'course_id' => 1,
				'building_id' => 1,
				'roomNumber' => '109',
				'meetingDay' => 'f',
				'period' => '6'
			],
			[
				'course_id' => 1,
				'building_id' => 2,
				'roomNumber' => 'E116',
				'meetingDay' => 'w',
				'period' => '7'
			],
			[
				'course_id' => 3,
				'building_id' => 2,
				'roomNumber' => 'E221',
				'meetingDay' => 't',
				'period' => '7'
			],
			[
				'course_id' => 3,
				'building_id' => 2,
				'roomNumber' => 'E221',
				'meetingDay' => 'r',
				'period' => '7'
			],
			[
				'course_id' => 2,
				'building_id' => 2,
				'roomNumber' => 'E221',
				'meetingDay' => 'r',
				'period' => '10'
			],
			[
				'course_id' => 4,
				'building_id' => 2,
				'roomNumber' => 'E221',
				'meetingDay' => 'r',
				'period' => '10'
			]
		);

		// Uncomment the below to run the seeder
		DB::table('meetings')->insert($meetings);
	}

}
