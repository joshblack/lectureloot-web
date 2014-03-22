@extends('master')

@section('title')
	<title>Wagers - LectureLoot</title>
@show

@section('content')
	<h1 class="page-title">Your Wagers</h1>
	{{ link_to('wagers/create', 'Make a New Wager', ['class' => 'link--add']) }}
	@if (Session::has('success'))
		<h2>{{ Session::get('success') }}</h2>
	@endif
	@if (Session::has('error'))
		<h2>{{ Session::get('error') }}</h2>
	@endif
	@foreach ($wagers as $wager)
		<div class="info-box">
			<span class="icon icon_ellipses info-box--options"></span>
			<div class="info-box--heading">
				<h6 class="info-box--heading__date">
					<span class="icon icon_calendar"></span>
					{{ date('jS M', strtotime($wager->session->startDate)) . ' - ' . date('jS M', strtotime($wager->session->endDate)) }}
				</h6>
				<h3 class="info-box--heading__primary">
					<span class="icon icon_card"></span>
					<a href="/wagers/{{ $wager->id }}/edit">Wager #{{ $wager->id }}</a>
				</h3>
				@if (new Datetime($wager->session->startDate) > new Datetime)
					<div class="info-box--desc info-box--desc__future">
						<p class="info-box--desc__text">This session has not started yet.</p>
					</div>
					<h1 class="info-box--jumbo">{{ '$' . $wager->wagerTotalValue }}</h1>
				@elseif ($wager->pointsLost > 0)
					<div class="info-box--desc info-box--desc__negative">
						<p class="info-box--desc__text">You lost money this week.</p>
					</div>
					<h1 class="info-box--jumbo info-box--jumbo__negative">{{ '$' . -$wager->pointsLost }}</h1>
				@else
					<div class="info-box--desc info-box--desc__positive">
						<p class="info-box--desc__text">You won money this week.</p>
					</div>
					<h1 class="info-box--jumbo info-box--jumbo__positive">{{ '$' . -$wager->pointsLost }}</h1>
				@endif
			</div>
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
@stop