<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="/dist/css/production.min.css">
</head>
<body id="login-page">
	<nav class="main-nav main-nav__login">
		<div class="site-width">
			<span class="icon icon_hamburger"></span>
			<a href="/" class="logo logo--login">LectureLoot</a>
		</div>
	</nav>
	<div class="site-width content">
			@if (Session::has('success'))
				<div>
					<h2>{{ Session::get('success') }}</h2>
				</div>
			@endif
			@if (Session::has('error'))
				<div>
					<h2>{{ Session::get('error') }}</h2>
				</div>
			@endif
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

		{{ link_to('register', 'Make a new account') }}
	</div>
</body>
</html>