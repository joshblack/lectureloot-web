@extends('master')

@section('title')
	<title>Make a Wager - LectureLoot</title>
@stop

@section('body')
<body class="alternate-page cbp-spmenu-push">
@stop

@section('main-nav')
<nav class="main-nav main-nav__alternate">
@stop

@section('logo')
<a href="/dashboard" class="logo logo--alternate">LectureLoot</a>
@stop

@section('content')
	<h1 class="main-heading">Make a new Wager</h1>
		@if (Session::has('success'))
			<h2>{{ Session::get('success') }}</h2>
		@endif
		@if (Session::has('error'))
			<h2>{{ Session::get('error') }}</h2>
		@endif

	{{ Form::open(['route' => 'wagers.store']) }}

			<label for="wagerTotalValue">How much would you like to bet?</label>
			<input class="text-field" type="number" name="wagerTotalValue" step="any" placeholder="10.00" pattern="\d+(\.\d{2})?">

			<label for="startDate">When would you like this wager to start?</label>
			<input class="text-field" type="date" name="startDate">

			<div class="submit-container submit-container--center">
				<button class="submit--button submit--button__create" type="submit">Make a Wager</button>
			</div>
	{{ Form::close() }}
@stop
