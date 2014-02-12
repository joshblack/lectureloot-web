<?php

class Wager extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function session()
	{
		return $this->belongsTo('WagerSession');
	}
}
