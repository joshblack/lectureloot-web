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
			<li>{{ link_to('user/wagers/create', 'Make a New Wager')}}</li>
		  <li>{{ link_to('user/wagers/' . $wager->id, 'Edit') }}</li>
		</ul>
	</li>
@endforeach
</ul>
</body>
</html>