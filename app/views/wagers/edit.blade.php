@extends('master')

@section('title')
	<title>Edit a Wager - LectureLoot</title>
@show

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
	<h1 class="main-heading">Edit Wager #{{ $wager->id }}</h1>
	@if (Session::has('success'))
		<h2>{{ Session::get('success') }}</h2>
	@endif
	@if (Session::has('error'))
		<h2>{{ Session::get('error') }}</h2>
	@endif

	{{ Form::open(['method' => 'PATCH', 'url' => 'wagers/' . $wager->id]) }}
			{{ Form::label('wagerTotalValue', 'How many points do you want to bet?:') }}
			<input class="text-field" type="number" name="wagerTotalValue" value="{{ $wager->wagerTotalValue }}" pattern="\d+(\.\d{2})?">

			{{ Form::label('startDate', 'When would you like it to start?') }}
			<input class="text-field" type="date" value="{{ $wager->session->startDate }}" name="startDate">

			<div class="submit-container submit-container--center">
				<button class="submit--button submit--button__create" type="submit">Edit this Wager</button>
			</div>
	{{ Form::close() }}
@stop