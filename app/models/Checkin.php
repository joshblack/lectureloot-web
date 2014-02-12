<?php

class Checkin extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function meeting()
	{
		return $this->belongsTo('Meeting');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}
}