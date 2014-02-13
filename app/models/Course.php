<?php

class Course extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	/**
	 * Defines a one-to-many relationship between Course and User.
	 *
	 * @return Eloquent Relationship
	 */
	public function users()
	{
		return $this->belongsToMany('User');
	}

	/**
	 * Defines a many-to-one relationship between Course and Meeting.
	 *
	 * @return Eloquent Relationship
	 */
	public function meetings()
	{
		return $this->hasMany('Meeting');
	}

}
