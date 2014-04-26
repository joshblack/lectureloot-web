@extends('master')

@section('title')
	<title>Dashboard View</title>
@show

@section('body')
<body class="cbp-spmenu-push dashboard-page">
@show

@section('dashboard')
<header class="dashboard--panel">
	<div class="dashboard--panel__header">
		<figure class="dashboard--panel__avatar">
      <img src="//www.gravatar.com/avatar/{{ md5(Auth::user()->emailAddress) }}?s=500" alt="">
    </figure>
		<div class="dashboard--panel__desc">
			<h1>{{ ucfirst($user->firstName) . ' ' . ucfirst($user->lastName) }}</h1>
@if (isset($wager))
			<p>${{ $wager->wagerTotalValue }} is on the line this week</p>
@else
			<a href="/wagers/create">Make a Wager</a>
@endif
		</div>
	</div>
</header>
@show

@section('content')
<div class="checkin-box">
	<h3 class="checkin-box--time">{{ $timeTillNextMeeting }}</h3>
	<button id="checkin" class="checkin--button">Checkin</button>
</div>

@show

@stop