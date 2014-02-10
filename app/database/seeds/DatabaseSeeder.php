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

		// $this->call('UserTableSeeder');
		$this->call('CoursesTableSeeder');
		$this->call('WagersTableSeeder');
		$this->call('MeetingsTableSeeder');
		$this->call('SchedulesTableSeeder');
		$this->call('UsersTableSeederTableSeeder');
		$this->call('BuildingsTableSeederTableSeeder');
		$this->call('BuildingsTableSeeder');
		$this->call('UsersTableTableSeeder');
		$this->call('ClassActionsTableSeeder');
		$this->call('CurrentSessionTableSeeder');
		$this->call('PeriodsTableSeeder');
		$this->call('SessionsTableSeeder');
	}

}