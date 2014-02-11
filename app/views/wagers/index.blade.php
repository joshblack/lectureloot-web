<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Wagers</title>
</head>
<body>
<h1>All Wagers</h1>
<ul>
@foreach ($wagers as $wager)
	<li>Date:
		<ul>
			<li>Unit Value: {{ $wager->wagerUnitValue }}</li>
			<li>Total Value: {{ $wager->wagerTotalValue }}</li>
			<li>Points Lost: {{ $wager->pointsLost }}</li>
			<li>{{ link_to('/wagers/' . $wager->id . '/edit', 'Edit') }}</li>
			<li><a href="/wagers/{{ $wager->id }}/edit">Edit</a></li>
		</ul>
	</li>
@endforeach
</ul>
<p>{{ link_to('wagers/create', 'Make a New Wager') }}</p>
</body>
</html>