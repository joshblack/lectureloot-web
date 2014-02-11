<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Showing Wager #{{ $wager->id }}</title>
</head>
<body>
	<h1>Wager #{{ $wager->id }}</h1>
	<ul>
		<li>User ID: {{ $wager->userId }}</li>
		<li>Session ID:{{ $wager->sessionId }}</li>
		<li>Unit Value:{{ $wager->wagerUnitValue }}</li>
	</ul>
	<a href="/wagers/{{ $wager->id }}/edit">Edit</a>
	{{ Form::open(['method' => 'DELETE', 'url' => 'wagers/' . $wager->id]) }}
		{{ Form::submit('Delete') }}
	{{ Form::close() }}
</body>
</html>