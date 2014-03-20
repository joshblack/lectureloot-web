@extends('master')

@section('title')
	<title>Wagers - LectureLoot</title>
@show

@section('content')
	<!-- Header -->
	<h1>Wagers for {{ ucfirst(Auth::user()->firstName) . ' ' . ucfirst(Auth::user()->lastName) }}</h1>

	<!-- Flash Messages -->
	<div>
		@if (Session::has('success'))
			<h2>{{ Session::get('success') }}</h2>
		@endif
		@if (Session::has('error'))
			<h2>{{ Session::get('error') }}</h2>
		@endif
	</div>

	<!-- Wagers -->
	<div>
		<ul>
			@foreach ($wagers as $wager)
				<li><a href="/wagers/{{ $wager->id }}">Wager id #{{ $wager->id }}</a>
					<ul>
						<li>Unit Value: {{ $wager->wagerUnitValue }}</li>
						<li>Total Value: {{ $wager->wagerTotalValue }}</li>
						<li>Points Lost: {{ $wager->pointsLost }}</li>
						<li>Session: {{ $wager->session->startDate . ' - ' . $wager->session->endDate }}</li>
						<li><a href="/wagers/{{ $wager->id }}/edit">Edit</a></li>
					</ul>
				</li>
			@endforeach
		</ul>
	</div>

	<!-- Utility -->
	<div>
		<p>{{ link_to('wagers/create', 'Make a New Wager') }}</p>
	</div>
@stop