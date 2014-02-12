<?php

class SessionsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('sessions')->truncate();

		$sessions = array(
			[
				'startDate' => new Datetime('2014-02-03'),
				'endDate' => new DateTime('2014-02-07')
			],
			[
				'startDate' => new Datetime('2014-02-10'),
				'endDate' => new DateTime('2014-02-14')
			],
			[
				'startDate' => new Datetime('2014-02-17'),
				'endDate' => new DateTime('2014-02-21')
			],
			[
				'startDate' => new Datetime('2014-02-24'),
				'endDate' => new DateTime('2014-02-28')
			]
		);

		// Uncomment the below to run the seeder
		DB::table('sessions')->insert($sessions);
	}

}
