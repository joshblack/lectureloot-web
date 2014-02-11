<?php

class TokensController extends BaseController {

	/**
	 * Check to see if token has expired.
	 *
	 * @return boolean
	 */
	public function expired($token) {

		$currentDate = new Datetime;

		if ($currentDate >= $token->expirationDate)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}