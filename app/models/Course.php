<?php

class Course extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function schedule()
	{
		$this->belongsTo('Schedule');
	}
}
