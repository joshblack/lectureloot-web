<?php

class MeetingsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('meetings')->truncate();

		$meetings = array(
			[
				'course_id' => 1,
				'buildingCode' => 'LIT',
				'roomNumber' => '109',
				'meetingDay' => 'm',
				'period' => '6'
			],
			[
				'course_id' => 1,
				'buildingCode' => 'LIT',
				'roomNumber' => '109',
				'meetingDay' => 'w',
				'period' => '6'
			],
			[
				'course_id' => 1,
				'buildingCode' => 'LIT',
				'roomNumber' => '109',
				'meetingDay' => 'f',
				'period' => '6'
			],
			[
				'course_id' => 1,
				'buildingCode' => 'CSE',
				'roomNumber' => 'E116',
				'meetingDay' => 'w',
				'period' => '7'
			],
			[
				'course_id' => 3,
				'buildingCode' => 'CSE',
				'roomNumber' => 'E221',
				'meetingDay' => 't',
				'period' => '7'
			],
			[
				'course_id' => 3,
				'buildingCode' => 'CSE',
				'roomNumber' => 'E221',
				'meetingDay' => 'r',
				'period' => '7'
			],
			[
				'course_id' => 2,
				'buildingCode' => 'CSE',
				'roomNumber' => 'E221',
				'meetingDay' => 'r',
				'period' => '10'
			],
			[
				'course_id' => 4,
				'buildingCode' => 'CSE',
				'roomNumber' => 'E221',
				'meetingDay' => 'r',
				'period' => '10'
			]
		);

		// Uncomment the below to run the seeder
		DB::table('meetings')->insert($meetings);
	}

}
