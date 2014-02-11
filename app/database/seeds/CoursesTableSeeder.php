<?php

class CoursesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('courses')->truncate();

		$courses = array(
			[
				'deptCode' => 'CEN',
				'courseNumber' => '3031',
				'sectionNumber' => '5842',
				'credits' => '3',
				'instructor' => 'Manuel Bermudez',
				'courseTitle' => 'Software Engineering'
			],
			[
				'deptCode' => 'EEL',
				'courseNumber' => '3701',
				'sectionNumber' => '7334',
				'credits' => '4',
				'instructor' => 'Gugel',
				'courseTitle' => 'Digital Logic'
			],
			[
				'deptCode' => 'CIS',
				'courseNumber' => '4930',
				'sectionNumber' => '11F8',
				'credits' => '3',
				'instructor' => 'Small',
				'courseTitle' => 'Web Application Development'
			],
			[
				'deptCode' => 'STA',
				'courseNumber' => '3032',
				'sectionNumber' => '7370',
				'credits' => '3',
				'instructor' => 'Johnny Wu',
				'courseTitle' => 'Statistics for Engineers'
			]
		);

		// Uncomment the below to run the seeder
		DB::table('courses')->insert($courses);
	}

}
