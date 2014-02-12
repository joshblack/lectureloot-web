<?php

class Meeting extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function course()
	{
		return $this->belongsTo('Course');
	}

	public function checkins()
	{
		return $this->hasMany('Checkin');
	}
}
