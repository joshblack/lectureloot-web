<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('users')->truncate();

		$users = array(
			[
				'emailAddress' => 'josh@ufl.edu',
				'password' => Hash::make('password'),
				'username' => 'josh',
				'firstName' => 'josh',
				'lastName' => 'black',
				'pointBalance' => 50,
				'created_at' => new Datetime,
				'updated_at' => new Datetime,
			],
			[
				'emailAddress' => 'austin@ufl.edu',
				'password' => Hash::make('password'),
				'username' => 'austin',
				'firstName' => 'austin',
				'lastName' => 'bruch',
				'pointBalance' => 50,
				'created_at' => new Datetime,
				'updated_at' => new Datetime,
			],
			[
				'emailAddress' => 'justin@ufl.edu',
				'password' => Hash::make('password'),
				'username' => 'justin',
				'firstName' => 'justin',
				'lastName' => 'black',
				'pointBalance' => 50,
				'created_at' => new Datetime,
				'updated_at' => new Datetime,
			]
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
