<?php

class WagersController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$wagers = Auth::user()->wagers;

		return View::make('wagers.index')->withWagers($wagers);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('wagers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$wager = new Wager;
		$wager->userId = Auth::user()->id;
		$wager->wagerUnitValue = intval(Input::get('wagerUnitValue'));

		// find out what the session id is
		$wager->sessionId = '';
		// find out the total wager value, unit value * # classes
		$wager->wagerTotalValue = '';

		$wager->save();
		dd($wager->toArray());
		return Redirect::route('wagers.index')->with('success', 'You\'ve successfully created a wager!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$wager = Wager::find($id);

    	return View::make('wagers.show')->withWager($wager);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$wager = Wager::find($id);

        return View::make('wagers.edit')->withWager($wager);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$session = WagerSession::where('startDate', '=', Input::get('sessionMonth'))->get();

		dd($session->toArray());
		$wager = Wager::find($id);
		$wager->wagerUnitValue = Input::get('wagerUnitValue');
		// find the session id
		$wager->sessionId = $session->id;
		dd('hi');
		// find the new wager total
		$wager->wagerTotalValue = '';

		$wager->save();

		return Redirect::route('wagers.index')->with('success', 'The wager has been updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// $wager = Wager::find($id);
		// $wager->delete();

		return Redirect::route('wagers.index')->with('success', 'The wager has been removed');
	}

}
