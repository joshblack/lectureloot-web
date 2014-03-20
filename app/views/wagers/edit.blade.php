@extends('master')

@section('title')
	<title>Edit a Wager - LectureLoot</title>
@show

@section('content')
	<h2>Form for editing <a href="/wagers/{{ $wager->id }}">Wager #{{ $wager->id }}</a></h2>


	{{ Form::open(['method' => 'PATCH', 'url' => 'wagers/' . $wager->id]) }}
		<div>
			{{ Form::label('wagerUnitValue', 'How many points do you want to bet?:') }}
			<input type="number" name="wagerUnitValue" value="{{ $wager->wagerUnitValue }}" pattern="\d+(\.\d{2})?">
		</div>
		<div>
			{{ Form::label('sessionMonth', 'When would you like it to start?') }}
			<input type="date" value="{{ $wager->session->startDate }}" name="sessionMonth">
		</div>
		<div>
			{{ Form::submit('submit') }}
			</div>
	{{ Form::close() }}
@stop