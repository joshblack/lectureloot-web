<?php

class WagerSession extends Eloquent {

	protected $table = 'sessions';

	/**
	 * Defines a many-to-one relationship between WagerSession and Wager.
	 *
	 * @return Eloquent Relationship
	 */
	public function wagers()
	{
		return $this->hasMany('Wager', 'session_id', 'id');
	}
}