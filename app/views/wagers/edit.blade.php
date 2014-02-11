<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit a Wager</title>
</head>
<body>
	<h2>Form for editing the wager</h2>


	{{ Form::model($wager, array('route' => array('wagers.update', $wager->id))) }}
		<div>
			{{ Form::label('wagerUnitValue', 'How much do you want to bet?:') }}
			{{ Form::selectRange('wagerUnitValue', 5, 50, $wager->wagerUnitValue) }}
		</div>
		<div>
			{{ Form::label('sessionMonth', 'When would you like to place it on?"') }}
			{{ Form::selectMonth('sessionMonth') }}
		</div>
		<div>
			{{ Form::label('sessionWeek', 'What week?') }}
			{{ Form::selectRange('sessionWeek', 1, 4) }}
		</div>
		<div>
			{{ Form::submit('submit') }}
			</div>
	{{ Form::close() }}




</body>
</html>