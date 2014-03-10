<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard View</title>
</head>
<script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

<body>
	<!-- Links/Nav -->
	<nav>
		<ul>
			<li><a href="/dashboard">Home</a>
			<li><a href="/wagers">Wagers</a></li>
			<li><a href="/courses">Courses</a></li>
		</ul>
	</nav>

	<!-- Header -->
	<h1>Hi, {{ ucfirst($user->firstName) }}!</h1>
	<a id="checkin" href="#">Checkin</a>

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
</body>
</html>