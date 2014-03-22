@extends('master')

@section('title')
	<title>Make a Wager - LectureLoot</title>
@show
@section('content')
	<h1>Make a new Wager</h1>
		@if (Session::has('success'))
			<h2>{{ Session::get('success') }}</h2>
		@endif
		@if (Session::has('error'))
			<h2>{{ Session::get('error') }}</h2>
		@endif

	{{ Form::open(['route' => 'wagers.store']) }}
			<input class="text-field" type="number" name="wagerTotalValue" placeholder="10.00" pattern="\d+(\.\d{2})?">
			<input class="text-field" type="date" name="startDate">
			{{ Form::submit('Make Wager') }}
	{{ Form::close() }}
@stop
