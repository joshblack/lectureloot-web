<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAllTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sessions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('startDate');
			$table->date('endDate');
		});

		Schema::create('courses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('deptCode');
			$table->string('courseNumber');
			$table->string('sectionNumber')->unique();
			$table->string('credits');
			$table->string('instructor');
			$table->string('courseTitle');
			$table->string('semester');
			$table->integer('year');
		});

		Schema::create('buildings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('buildingCode')->unique();
			$table->decimal('gpsLongitude', 8, 6);
			$table->decimal('gpsLatitude', 8, 6);
		});

		Schema::create('periods', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('period')->unique();
			$table->time('startTime');
		});

		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('emailAddress')->unique();
			$table->string('password');
			$table->string('username');
			$table->string('firstName');
			$table->string('lastName');
			$table->integer('pointBalance')->default(100);
			$table->timestamps();
		});

		Schema::create('meetings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('course_id');
			$table->string('buildingCode');
			$table->string('roomNumber');
			$table->string('meetingDay');
			$table->string('period');
		});

		// Schema::create('classActions', function(Blueprint $table)
		// {
		// 	$table->increments('id');
		// 	$table->integer('user_id')->unsigned();
		// 	$table->string('sectionNumber');
		// 	$table->string('meetingDay');
		// 	$table->string('period');
		// 	$table->boolean('checkedIn')->default(false);
		// 	$table->boolean('cancelled')->default(false);
		// });

		Schema::create('checkins', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('meeting_id');
			$table->boolean('checkin')->default(false);
			$table->boolean('cancelled')->default(false);
		});

		Schema::create('wagers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('session_id');
			$table->integer('wagerUnitValue');
			$table->integer('wagerTotalValue');
			$table->integer('pointsLost')->default(0);
			$table->timestamps();
		});

		Schema::create('currentSession', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('sessionId');
			$table->integer('wagerUnitValue');
			$table->integer('wagerTotalValue');
			$table->integer('pointsLost');
		});

		Schema::create('tokens', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('token');
			$table->string('user_id')->unique();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('currentSession');
		Schema::drop('wagers');
		// Schema::drop('classActions');
		Schema::drop('checkins');
		Schema::drop('meetings');
		Schema::drop('users');
		Schema::drop('periods');
		Schema::drop('buildings');
		Schema::drop('courses');
		Schema::drop('sessions');
		Schema::drop('tokens');
	}

}
