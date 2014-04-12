<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('CoursesTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('WagersTableSeeder');
		$this->call('MeetingsTableSeeder');
		$this->call('CourseUserTableSeeder');
		$this->call('BuildingsTableSeeder');
		$this->call('PeriodsTableSeeder');
		$this->call('SessionsTableSeeder');
	}

}