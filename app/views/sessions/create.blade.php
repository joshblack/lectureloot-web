<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>

	<!-- Flash Messages -->
	<div>
		@if (Session::has('success'))
			<h2>{{ Session::get('success') }}</h2>
		@endif
	</div>
	<div>
		@if (Session::has('error'))
			<h2>{{ Session::get('error') }}</h2>
		@endif
	</div>

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