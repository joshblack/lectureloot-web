<?php

class Schedule extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function user()
	{
		return $this->belongsTo('User', 'id', 'userId');
	}

	public function courses()
	{
		return $this->belongsToMany('Course');
	}
}
