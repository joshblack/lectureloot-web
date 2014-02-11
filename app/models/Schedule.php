<?php

class Schedule extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function user()
	{
		return $this->belongsTo('User', 'userId', 'id');
	}

	public function courses()
	{
		return $this->hasMany('Courses', 'courses', 'deptCode', 'courseNumber', 'sectionNumber');
	}
}
