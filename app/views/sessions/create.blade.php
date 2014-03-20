<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" href="/dist/css/production.min.css">
</head>
<body class="alternate-page cbp-spmenu-push">
	<nav class="main-nav main-nav__alternate">
		<div class="site-width">
			<span id="showLeftPush" class="icon icon_hamburger"></span>
			<a href="/" class="logo logo--alternate">LectureLoot</a>
		</div>
	</nav>
	<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<h3>Menu</h3>
		<a href="/">Home</a>
		<a href="/login">Login</a>
		<a href="/register">Register</a>
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
				<a class="register--heading" href="#">Forgot your password?</a>
				<button class="submit--button submit--button__login" type="submit">Sign In</button>
			</div>

		{{ Form::close() }}
	</div>
	<script src="/dist/js/production.min.js"></script>
</body>
</html>