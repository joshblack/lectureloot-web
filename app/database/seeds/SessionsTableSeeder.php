<?php

class SessionsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('sessions')->truncate();

		$sessions = array(
			[
				'sessionId' => 1,
				'startDate' => new Datetime('2014-02-03'),
				'endDate' => new DateTime('2014-02-07')
			],
			[
				'sessionId' => 2,
				'startDate' => new Datetime('2014-02-10'),
				'endDate' => new DateTime('2014-02-14')
			],
			[
				'sessionId' => 3,
				'startDate' => new Datetime('2014-02-17'),
				'endDate' => new DateTime('2014-02-21')
			],
			[
				'sessionId' => 4,
				'startDate' => new Datetime('2014-02-24'),
				'endDate' => new DateTime('2014-02-28')
			]
		);

		// Uncomment the below to run the seeder
		DB::table('sessions')->insert($sessions);
	}

}
