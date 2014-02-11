<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit a Wager</title>
</head>
<body>
	<h2>Form for editing <a href="/wagers/{{ $wager->id }}">Wager #{{ $wager->id }}</a></h2>


	{{ Form::open(['method' => 'PATCH', 'url' => 'wagers/' . $wager->id]) }}
		<div>
			{{ Form::label('wagerUnitValue', 'How much do you want to bet?:') }}
			<input type="number" name="wagerUnitValue" value="{{ $wager->wagerUnitValue }}" pattern="\d+(\.\d{2})?">
		</div>
		<div>
			{{ Form::label('sessionMonth', 'When would you like it to start?') }}
			<input type="date" name="sessionMonth">
		</div>
		<div>
			{{ Form::submit('submit') }}
			</div>
	{{ Form::close() }}




</body>
</html>