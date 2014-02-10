<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
	{{ Form::open(['route' => 'sessions.store']) }}
		<div>
			{{ Form::label('emailAddress', 'Email:') }}
			{{ Form::email('emailAddress') }}
		</div>
		<div>
			{{ Form::label('password', 'Password:') }}
			{{ Form::password('password') }}
		</div>
		<div>
			{{ Form::submit('Login') }}
		</div>
	{{ Form::close() }}
</body>
</html>