<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>LectureLoot</title>
	<style>
		video#bgvid {
			position: fixed; right: 0; bottom: 0;
			min-width: 100%; min-height: 100%;
			width: auto; height: auto; z-index: -100;
			background: url(dist/images/phone.jpg) no-repeat;
			background-size: cover;
		}
		#shade {
			width: 100%;
			height: 100%;
			background: rgb(0,0,0);
			background: rgba(0,0,0,.6);
			position: absolute;
			top: 0;
			right: 0;
			bottom: 0;
			left: 0;
			z-index: 1;
		}
		#title {
			position: absolute;
			top: 30%;
			left: 40%;
			color: #fff;
			font-style: 5em;
			z-index: 2;
			font-family: "Helvetica Neue ";
		}
	</style>
</head>
<body>

	<a href="login">Login</a>

	<div id="shade"></div>
	<div id="title">
		<h1>Lecture Loot</h1>
		<h3>Get your ass to class</h3>
	</div>
	<video id="bgvid" autoplay muted loop poster="dist/images/phone.jpg">
		<source src="dist/videos/phone.webm" type="video/webm">
		<source src="dist/videos/phone.mp4" type="video/mp4">
	</video>
</body>
</html>