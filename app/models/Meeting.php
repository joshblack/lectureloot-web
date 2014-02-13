<?php

class Meeting extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	/**
	 * Defines a one-to-many relationship between Meeting and Course.
	 *
	 * @return Eloquent Relationship
	 */
	public function course()
	{
		return $this->belongsTo('Course');
	}

	/**
	 * Defines a many-to-one relationship between Meeting and Checkin.
	 *
	 * @return Eloquent Relationship
	 */
	public function checkins()
	{
		return $this->hasMany('Checkin');
	}
}
