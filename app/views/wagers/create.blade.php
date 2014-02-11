<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>New Wager</title>
</head>
<body>
	{{ Form::open(['route' => 'wagers.store']) }}
		<div>
			{{ Form::label('wagerUnitValue', 'How much do you want to bet?:') }}
			<input type="number" name="wagerUnitValue" placeholder="10.00" pattern="\d+(\.\d{2})?">
		</div>
		<div>
			{{ Form::label('sessionMonth', 'When would you it to start?') }}
			<input type="date" name="sessionMonth">
		</div>
		<div>
			{{ Form::submit('Submit') }}
		</div>
	{{ Form::close() }}
</body>
</html>