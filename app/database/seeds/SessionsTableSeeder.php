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
			],
			[
				'startDate' => new Datetime('2014-03-03'),
				'endDate' => new DateTime('2014-03-07')
			],
			[
				'startDate' => new Datetime('2014-03-10'),
				'endDate' => new DateTime('2014-03-14')
			],
			[
				'startDate' => new Datetime('2014-03-17'),
				'endDate' => new DateTime('2014-03-21')
			],
			[
				'startDate' => new Datetime('2014-03-24'),
				'endDate' => new DateTime('2014-03-28')
			],
			[
				'startDate' => new Datetime('2014-03-31'),
				'endDate' => new DateTime('2014-04-04')
			],
			[
				'startDate' => new Datetime('2014-04-07'),
				'endDate' => new DateTime('2014-04-11')
			],
			[
				'startDate' => new Datetime('2014-04-14'),
				'endDate' => new DateTime('2014-04-18')
			],
			[
				'startDate' => new Datetime('2014-04-21'),
				'endDate' => new DateTime('2014-04-25')
			],
			[
				'startDate' => new Datetime('2014-04-28'),
				'endDate' => new DateTime('2014-05-02')
			],
		);

		// Uncomment the below to run the seeder
		DB::table('sessions')->insert($sessions);
	}

}
