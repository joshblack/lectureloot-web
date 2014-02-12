<?php

class PeriodsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('periods')->truncate();

		$periods = array(
			[
				'period' => '1',
				'startTime' => date("H:i:s", strtotime("7:25 am"))
			],
			[
				'period' => '2',
				'startTime' => date("H:i:s", strtotime("8:30 am"))
			],
			[
				'period' => '3',
				'startTime' => date("H:i:s", strtotime("9:35 am"))
			],
			[
				'period' => '4',
				'startTime' => date("H:i:s", strtotime("10:40 am"))
			],
			[
				'period' => '5',
				'startTime' => date("H:i:s", strtotime("11:45 am"))
			],
			[
				'period' => '6',
				'startTime' => date("H:i:s", strtotime("12:50 pm"))
			],
			[
				'period' => '7',
				'startTime' => date("H:i:s", strtotime("1:55 pm"))
			],
			[
				'period' => '8',
				'startTime' => date("H:i:s", strtotime("3:00 pm"))
			],
			[
				'period' => '9',
				'startTime' => date("H:i:s", strtotime("4:05 pm"))
			],
			[
				'period' => '10',
				'startTime' => date("H:i:s", strtotime("5:10 pm"))
			],
			[
				'period' => '11',
				'startTime' => date("H:i:s", strtotime("6:15 pm"))
			],
			[
				'period' => 'E1',
				'startTime' => date("H:i:s", strtotime("7:20 pm"))
			],
			[
				'period' => 'E2',
				'startTime' => date("H:i:s", strtotime("8:20 pm"))
			],
			[
				'period' => 'E3',
				'startTime' => date("H:i:s", strtotime("9:20 pm"))
			]
		);

		// Uncomment the below to run the seeder
		DB::table('periods')->insert($periods);
	}

}
