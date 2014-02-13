<?php

class Checkin extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	/**
	 * Defines a one-to-many relationship between Checkin and Meeting.
	 *
	 * @return Eloquent Relationship
	 */
	public function meeting()
	{
		return $this->belongsTo('Meeting');
	}

	/**
	 * Defines a one-to-many relationship between Checkin and User.
	 *
	 * @return Eloquent Relationship
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}
}