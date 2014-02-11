<?php namespace Api\V1;

class UsersController extends BaseController {

	public function showUser() {
		return View::make('user.show')->withUsername(Auth::user()->username);
	}
}
