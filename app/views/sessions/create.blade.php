<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="/dist/css/production.min.css">
</head>
<body class="alternate-page">
	<nav class="main-nav main-nav__alternate">
		<div class="site-width">
			<span class="icon icon_hamburger"></span>
			<a href="/" class="logo logo--login">LectureLoot</a>
		</div>
	</nav>
	<div class="site-width content">
			@if (Session::has('success'))
				<div>
					<h2 class="success-heading">{{ Session::get('success') }}</h2>
				</div>
			@endif
			@if (Session::has('error'))
				<div>
					<h2 class="error-heading">{{ Session::get('error') }}</h2>
				</div>
			@endif
		{{ Form::open(['route' => 'sessions.store']) }}
			{{ Form::email('emailAddress', null,
				[
					'placeholder' => 'Email Address',
					'class' => 'text-field'
				])
			}}
			{{ Form::password('password',
				[
					'placeholder' => 'Password',
					'class' => 'text-field'
				])
			}}
			<div class="submit-container">
				<a class="register--heading" href="register">Forgot your password?</a>
				<button class="submit--button submit--button__login" type="submit">Sign In</button>
			</div>

		{{ Form::close() }}
	</div>
</body>
</html>