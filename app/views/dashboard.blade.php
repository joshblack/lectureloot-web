<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard View</title>
</head>
<body>
	<!-- Links/Nav -->
	<nav>
		<ul>
			<li><a href="/dashboard">Home</a>
			<li><a href="/wagers">Wagers</a></li>
			<li><a href="/courses">Courses</a></li>
		</ul>
	</nav>

	<!-- Header -->
	<h1>Hi, {{ ucfirst($user->username) }}!</h1>


</body>
</html>