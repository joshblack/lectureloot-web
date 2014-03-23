<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	@section('title')
		<title>LectureLoot</title>
	@show
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <link rel="stylesheet" type="text/css" href="/dist/css/production.min.css">
</head>

@section('body')
<body class="cbp-spmenu-push">
@show

@section('main-nav')
  <nav class="main-nav">
@show
    <div class="site-width">
      <span id="showLeftPush" class="icon icon_hamburger"></span>
@section('logo')
      <a href="/dashboard" class="logo">LectureLoot</a>
@show
    </div>
  </nav>
  <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
    <div class="hero-unit">
      <div class="hero-avatar" data-tooltip="Change your avatar at gravatar.com" >
        <span>
          <img class="hero-avatar--img" src="//www.gravatar.com/avatar/{{ md5(Auth::user()->emailAddress) }}?s=500" alt="">
        </span>
      </div>
      <h3 class="hero-avatar--title">{{ ucfirst(Auth::user()->firstName) . ' ' . ucfirst(Auth::user()->lastName) }}</h3>
    </div>
    <a href="/dashboard"><span class="icon icon_home"></span> Home</a>
    <a href="/courses"><span class="icon icon_book"></span> Courses</a>
    <a href="/wagers"><span class="icon icon_card"></span> Wagers</a>
    <a href="#"><span class="icon icon_gear"></span> Settings</a>
  </nav>
  <div class="site-width">
    @yield('content')
  </div>
  <script src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
  <script src="/dist/js/production.min.js"></script>
</body>
</html>