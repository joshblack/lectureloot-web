<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Users</title>
</head>
<body>
	<h1>Hi there, {{ $username }}!</h1>
	<ul>
		<li>{{ link_to('wagers', 'Wagers') }}</li>
		<li>{{ link_to('courses', 'Courses') }}</li>
	</ul>
	<a href="/logout">Logout</a>
</body>
</html>