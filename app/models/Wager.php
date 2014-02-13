<?php

class Wager extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	/**
	 * Defines a one-to-many relationship between Wager and User.
	 *
	 * @return Eloquent Relationship
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * Defines a one-to-many relationship between a Wager and a WagerSession.
	 *
	 * @return Eloquent Relationship
	 */
	public function session()
	{
		return $this->belongsTo('WagerSession');
	}
}
