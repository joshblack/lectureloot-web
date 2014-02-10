<?php

class SessionsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('sessions')->truncate();

		$sessions = array(
			[
				'sessionId' => 1,
				'startDate' => new Datetime('2014-02-05'),
				'endDate' => new DateTime('2014-02-13')
			]
		);

		// Uncomment the below to run the seeder
		DB::table('sessions')->insert($sessions);
	}

}
