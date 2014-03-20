<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	@section('title')
		<title>LectureLoot</title>
	@show
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="dist/css/production.min.css">
</head>
<body class="cbp-spmenu-push">
  <nav class="main-nav">
    <div class="site-width">
      <span id="showLeftPush" class="icon icon_hamburger"></span>
      <a href="/" class="logo logo--alternate">LectureLoot</a>
    </div>
  </nav>
  <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
    <h3>Menu</h3>
    <a href="/">Home</a>
    <a href="#">Courses</a>
    <a href="#">Wagers</a>
    <a href="#">Settings</a>
  </nav>
  <div class="site-width content">
    @yield('content')
  </div>
  <script src="/dist/js/production.min.js"></script>
</body>
</html>