<?php

class WagerSession extends Eloquent {

	protected $table = 'sessions';

	public function wagers()
	{
		return $this->hasMany('Wager', 'session_id', 'id');
	}
}