<?php

class WagersController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$wagers = Wager::all();

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
		return 'hi';
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
		$input = Input::all();

		$wager = Wager::find($id);
		$wager->wagerUnitValue = $input['wagerUnitValue'];
		// find the session id
		$wager->sessionId = '';
		// find the new wager total
		$wager->wagerTotalValue = '';

		$wager->save();

		return 'hi';
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
