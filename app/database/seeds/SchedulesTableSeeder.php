<?php

class SchedulesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('schedules')->truncate();

		$schedules = array(
			[
				'userId' => 1,
				'course_id' => 1,
				'semester' => 'fall',
				'year' => 2014
			],
			[
				'userId' => 1,
				'course_id' => 2,
				'semester' => 'fall',
				'year' => 2014
			],
			[
				'userId' => 1,
				'course_id' => 3,
				'semester' => 'fall',
				'year' => 2014
			],
			[
				'userId' => 1,
				'course_id' => 4,
				'semester' => 'fall',
				'year' => 2014
			]
		);

		// Uncomment the below to run the seeder
		DB::table('schedules')->insert($schedules);
	}

}
