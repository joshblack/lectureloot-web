<?php

class HomeController extends BaseController {

	public function showHome()
	{
		return View::make('index');
	}

	public function showDashboard()
	{
		$user = Auth::user();

		return View::make('dashboard')->withUser($user);
	}

}