<?php

class WagersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('wagers')->truncate();

		$wagers = array(
			[
				'user_id' => 1,
				'session_id' => 1,
				'wagerUnitValue' => 10,
				'wagerTotalValue' => 50,
				'pointsLost' => 0
			],
			[
				'user_id' => 2,
				'session_id' => 4,
				'wagerUnitValue' => 10,
				'wagerTotalValue' => 50,
				'pointsLost' => 0
			],
			[
				'user_id' => 3,
				'session_id' => 3,
				'wagerUnitValue' => 10,
				'wagerTotalValue' => 50,
				'pointsLost' => 0
			],
			[
				'user_id' => 1,
				'session_id' => 2,
				'wagerUnitValue' => 10,
				'wagerTotalValue' => 50,
				'pointsLost' => 0
			],
		);

		// Uncomment the below to run the seeder
		DB::table('wagers')->insert($wagers);
	}

}
