<?php

class BuildingsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('buildings')->truncate();

		$buildings = array(
			[
				'buildingCode' => 'LIT',
				'gpsLongitude' => 5.8435346,
				'gpsLatitude' => 5.8435346
			],
			[
				'buildingCode' => 'CIS',
				'gpsLongitude' => 2.8435346,
				'gpsLatitude' => 2.8435346
			]
		);

		// Uncomment the below to run the seeder
		DB::table('buildings')->insert($buildings);
	}

}
