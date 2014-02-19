<?php

class Token extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	/**
	 * Check to see if the token's valid_until field is older than the current date. This allows
	 * us to see if the token has expired.
	 *
	 * @return Boolean
	 */
	public function isValidToken()
	{
		$date = new Datetime;

		return ($this->valid_until > $date) ? false : true;
	}

}
