<?php

class CourseUserTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('course_user')->truncate();

		$schedules = array(
			[
				'user_id' => 1,
				'course_id' => 1
			],
			[
				'user_id' => 1,
				'course_id' => 2
			],
			[
				'user_id' => 1,
				'course_id' => 3
			],
			[
				'user_id' => 1,
				'course_id' => 4
			]
		);

		// Uncomment the below to run the seeder
		DB::table('course_user')->insert($schedules);
	}

}
