<?php

class CurrentSessionTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('currentsession')->truncate();

		$currentsession = array(
			[
				'user_id' => 1,
				'sessionId' => 1,
				'wagerUnitValue' => 10,
				'wagerTotalValue' => 50,
				'pointsLost' => 0
			]
		);

		// Uncomment the below to run the seeder
		DB::table('currentsession')->insert($currentsession);
	}

}
