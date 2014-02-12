<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>New Wager</title>
</head>
<body>
	<!-- Header -->
	<h1>Make a new Wager</h1>

	<!-- Flash Messages -->
	<div>
		@if (Session::has('success'))
			<h2>{{ Session::get('success') }}</h2>
		@endif
		@if (Session::has('error'))
			<h2>{{ Session::get('error') }}</h2>
		@endif
	</div>

	{{ Form::open(['route' => 'wagers.store']) }}
		<div>
			{{ Form::label('wagerUnitValue', 'How much do you want to bet?:') }}
			<input type="number" name="wagerUnitValue" placeholder="10.00" pattern="\d+(\.\d{2})?">
		</div>
		<div>
			{{ Form::label('startDate', 'When would you it to start?') }}
			<input type="date" name="startDate">
		</div>
		<div>
			{{ Form::submit('Submit') }}
		</div>
	{{ Form::close() }}
</body>
</html>