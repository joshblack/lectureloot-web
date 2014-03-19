<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>LectureLoot</title>
  <link rel="stylesheet" type="text/css" href="dist/css/production.min.css">
</head>
<body>
	<h1 id="logo">Lecture Loot</h1>
	<a id="login" href="login">Login</a>
	<a id="register" href="register">Register</a>
  <div class="social--container">
    <a href="#">
      <div class="social--box social--box__ios">
        <p class="social--box__description">Get it for</p>
        <h2 class="social--box__title">iOS</h2>
      </div>
    </a>
    <a href="https://plus.google.com/communities/117209311415691656365">
      <div class="social--box social--box__android">
        <p class="social--box__description">Get it for</p>
        <h2 class="social--box__title">Android</h2>
      </div>
    </a>
  </div>
  <div id="poster"></div>
  <video autoplay muted loop poster="/dist/img/phone.jpg" id="bgvid">
    <source src="/dist/videos/phone.webm" type="video/webm">
    <source src="/dist/videos/phone.mp4" type="video/mp4">
  </video>
</body>
</html>