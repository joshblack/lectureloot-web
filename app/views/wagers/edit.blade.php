@extends('master')

@section('title')
	<title>Edit a Wager - LectureLoot</title>
@show

@section('content')
	<h2>Form for editing <a href="/wagers/{{ $wager->id }}">Wager #{{ $wager->id }}</a></h2>
		@if (Session::has('success'))
			<h2>{{ Session::get('success') }}</h2>
		@endif
		@if (Session::has('error'))
			<h2>{{ Session::get('error') }}</h2>
		@endif

	{{ Form::open(['method' => 'PATCH', 'url' => 'wagers/' . $wager->id]) }}
		<div>
			{{ Form::label('wagerTotalValue', 'How many points do you want to bet?:') }}
			<input type="number" name="wagerTotalValue" value="{{ $wager->wagerTotalValue }}" pattern="\d+(\.\d{2})?">
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