<?php

class Course extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function users()
	{
		return $this->belongsToMany('User');
	}

	public function meetings()
	{
		return $this->hasMany('Meeting');
	}

}
