<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard View</title>
</head>
<body>
	<!-- Header -->
	<h1>Hi, {{ $user->username }}</h1>

	<!-- Links/Nav -->
	<div>
		<a href="/wagers">Wagers</a>
	</div>
	<div>
		<a href="/courses">Courses</a>
	</div>
</body>
</html>