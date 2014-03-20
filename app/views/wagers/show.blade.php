@extends('master')

@section('title')
	<title>Wager #{{ $wager->id }} - LectureLoot</title>
@show

@section('content')
	<h1>Wager #{{ $wager->id }}</h1>
	<ul>
		<li>User ID: {{ $wager->userId }}</li>
		<li>Session ID:{{ $wager->sessionId }}</li>
		<li>Unit Value:{{ $wager->wagerUnitValue }}</li>
	</ul>
	<a href="/wagers/{{ $wager->id }}/edit">Edit</a>
	{{ Form::open(['method' => 'DELETE', 'url' => 'wagers/' . $wager->id]) }}
		{{ Form::submit('Delete') }}
	{{ Form::close() }}
@stop