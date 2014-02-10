<?php

class UsersController extends BaseController {

	public function showUser() {
		return View::make('user.show')->withUsername(Auth::user()->username);
	}
}
