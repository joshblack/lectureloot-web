<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('users')->truncate();

		$users = array(
			[
				'emailAddress' => 'joshuatblack@ufl.edu',
				'password' => Hash::make('password'),
				'username' => 'Josh',
				'firstName' => 'Josh',
				'lastName' => 'Black',
				'pointBalance' => 50,
				'created_at' => new Datetime,
				'updated_at' => new Datetime,
			]

		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
