<?php

class Course extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function schedules()
	{
		$this->belongsToMany('Schedule');
	}

}
