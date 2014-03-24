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
			<p>${{ $wager->wagerTotalvalue }} is on the line this week</p>
@else
			<a href="/wagers/create">Make a Wager</a>
@endif
		</div>
	</div>
</header>
@show

@section('content')
<div class="checkin-box">
	<h1 class="checkin-box--time">13min</h1>
	<p class="checkin-box--desc">till your next class</p>
	<button id="checkin" class="checkin--button">Checkin</button>
</div>

@show

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script type="text/javascript">

/* Testing script for user checkin */

	// Toggle showLocation request
	$(document).ready(function() {

		$('#checkin').on('click', function() {
			showLocation();
		});

		function showLocation() {
			navigator.geolocation.getCurrentPosition(callback, errorHandler);
		}

		function callback(position) {
			var latitude = position.coords.latitude,
				longitude = position.coords.longitude;

			$.post(
				'/checkins',
				{
					latitude: latitude,
					longitude: longitude
				},
				function(data) {
					console.log(data);
				}

				);
		}

		function errorHandler(error) {
			switch(error.code) {
				case error.PERMISSION_DENIED:
					document.getElementById('latitude').innerHTML = 'Location service privledges denied. Please enable it to checkin.';
					break;
				case error.POSITION_UNAVAILABLE:
					document.getElementById('latitude').innerHTML = 'Position unavailable, please try checking in in a few minutes.';
					break;
				case error.TIMEOUT:
					document.getElementById('latitude').innerHTML = 'Request timed out, please check your network settings and try again.';
					break;
				case error.UNKNOWN_ERROR:
					document.getElementById('latitude').innerHTML = 'Unknown error, please try again.';
					break;
			}
		}
	});


</script>
@stop