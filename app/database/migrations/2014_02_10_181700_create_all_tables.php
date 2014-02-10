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
		Schema::create('sessions', function(Blueprint $table) {
			$table->integer('sessionId');
			$table->date('startDate');
			$table->date('endDate');

			// Primary Key
			$table->primary('sessionId');
		});

		Schema::create('courses', function(Blueprint $table) {
			$table->string('deptCode');
			$table->string('courseNumber');
			$table->string('sectionNumber');
			$table->string('credits');
			$table->string('instructor');
			$table->string('courseTitle');

			// Primary Key
			$table->primary('sectionNumber'); // if sectionNumber is unique
			// $table->primary(array('deptCode', 'courseNumber', 'sectionNumber'));
		});

		Schema::create('buildings', function(Blueprint $table) {
			$table->string('buildingCode');
			$table->decimal('gpsLongitude', 8, 6);
			$table->decimal('gpsLatitude', 8, 6);

			// Primary key
			$table->primary('buildingCode');
		});

		Schema::create('periods', function(Blueprint $table) {
			$table->string('period');
			$table->time('startTime');

			// Primary Key
			$table->primary('period');
		});

		Schema::create('users', function(Blueprint $table) {
			$table->increments('userId');
			$table->string('emailAddress');
			$table->string('password');
			$table->string('username');
			$table->string('firstName');
			$table->string('lastName');
			$table->integer('pointBalance')->default(100);
			$table->timestamps();
		});

		Schema::create('meetings', function(Blueprint $table) {
			$table->string('deptCode');
			$table->string('courseNumber');
			$table->string('sectionNumber');
			$table->string('buildingCode');
			$table->string('roomNumber');
			$table->string('meetingDay');
			$table->string('period');

			$table->primary(array('sectionNumber', 'meetingDay', 'period'));

			// $table->foreign('sectionNumber')->references('sectionNumber')->on('courses');
			// $table->foreign('buildingCode')->references('buildingCode')->on('buildings');
			// $table->foreign('period')->references('period')->on('periods');
		});

		Schema::create('classActions', function(Blueprint $table) {
			$table->integer('userId')->unsigned();
			$table->string('sectionNumber');
			$table->string('meetingDay');
			$table->string('period');
			$table->boolean('checkedIn')->default(false);
			$table->boolean('cancelled')->default(false);

			// Primary Key
			$table->primary(array('userId', 'sectionNumber'));

			// $table->foreign('userId')->references('userId')->on('users');
			// $table->foreign('sectionNumber')->references('sectionNumber')->on('meetings');
			// // $table->foreign('meetingDay')->references('meetingDay')->on('meetings');
			// $table->foreign('period')->references('period')->on('meetings');
		});

		Schema::create('wagers', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('userId')->unsigned();
			$table->integer('sessionId');
			$table->integer('wagerUnitValue');
			$table->integer('wagerTotalValue');
			$table->integer('pointsLost')->default(0);

			// Primary Key
			// $table->primary(array('userId', 'sessionId'));

			// $table->foreign('userId')->references('userId')->on('users');
		});

		Schema::create('currentSession', function(Blueprint $table) {
			$table->integer('userId')->unsigned();
			$table->integer('sessionId');
			$table->integer('wagerUnitValue');
			$table->integer('wagerTotalValue');
			$table->integer('pointsLost');

			// Primary Key
			$table->primary(array('userId', 'sessionId'));

			// $table->foreign('userId')->references('userId')->on('users');
		});

		Schema::create('schedules', function(Blueprint $table) {
			$table->integer('userId')->unsigned();
			$table->string('deptCode');
			$table->string('courseNumber');
			$table->string('sectionNumber');

			// Primary Key
			$table->primary('userId');

			// $table->foreign('sectionNumber')->references('sectionNumber')->on('courses');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('schedules');
		Schema::drop('currentSession');
		Schema::drop('wagers');
		Schema::drop('classActions');
		Schema::drop('meetings');
		Schema::drop('users');
		Schema::drop('periods');
		Schema::drop('buildings');
		Schema::drop('courses');
		Schema::drop('sessions');
	}

}
