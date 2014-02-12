<?php

class UsersController extends BaseController {

	public function showUser()
	{
		return View::make('user.show')->withUsername(Auth::user()->username);
	}

	/**
	 * Create a user
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}
}
