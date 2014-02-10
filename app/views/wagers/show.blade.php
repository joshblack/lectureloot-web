<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>New Wager</title>
</head>
<body>
	{{ Form::open() }}
		<div>
			{{ Form::label('wagerUnitValue', 'How much do you want to bet?:') }}
			{{ Form::number('wagerUnitValue') }}
		</div>
		<div>
			{{ Form::label('session', 'What week is the bet for:') }}
			{{ Form::date('session') }}
		</div>
		<div>
			{{ Form::submit('Submit') }}
		</div>
	{{ Form::close() }}
</body>
</html>