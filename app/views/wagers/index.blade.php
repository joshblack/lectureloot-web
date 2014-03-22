@extends('master')

@section('title')
	<title>Wagers - LectureLoot</title>
@show

@section('content')
	<!-- Header -->
	<h1>Your Wagers</h1>

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
	@foreach ($wagers as $wager)
		<div class="info-box">
			<span class="icon icon_ellipses info-box--options"></span>
			<div class="info-box--heading">
				<h6 class="info-box--heading__date">
					<span class="icon icon_calendar"></span>
					{{ $wager->session->startDate . ' - ' . $wager->session->endDate }}
				</h6>
				<h3 class="info-box--heading__primary">
					<span class="icon icon_card"></span>
					<a href="/wagers/{{ $wager->id }}/edit">Wager #{{ $wager->id }}</a>
				</h3>
				<div class="info-box--desc">
					<p class="info-box--desc__text">This session has not started yet.</p>
				</div>
			</div>
			<h1 class="info-box--jumbo">{{ '$' . $wager->wagerTotalValue }}</h1>
			<div class="options-box">
				<div class="option-select">
					<a class="option-select--edit" href="/wagers/{{ $wager->id }}/edit">
						<span class="icon icon_pencil"></span>
						<p class="option-select--text">Edit</p>
					</a>
				</div>
				<div class="option-select">
					<a class="option-select--delete" href="/wagers/{{ $wager->id }}/delete">
						<span class="icon icon_trash"></span>
						<p class="option-select--text">Delete</p>
					</a>
				</div>
			</div>
		</div>
	@endforeach

	<!-- Utility -->
	<div>
		<p>{{ link_to('wagers/create', 'Make a New Wager') }}</p>
	</div>
@stop