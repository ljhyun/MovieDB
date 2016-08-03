<html>
<head>
<style type="text/css">
#nav {
	line-height:30px;
	width:400px;
	height:2000px;
	float:left;
	padding:5px;
}

#footer {
	float:right;
}
</style>
<body bgcolor=#EEFBEE>	
<div id="Container">
		<div id="header">
		Navigation
		</div>

		<div id="Menu">
		<ul id="nav">
			<li><a href='actordirector.php'>Add Actor/director information</a></li>
			<li><a href='movies.php'>Add Movie information</a></li>
			<li><a href='actormovie.php'>Add Actor/Movie relation</a></li>
			<li><a href='moviedirector.php'>Add Director/Movie relation</a></li>
		</ul>
		</div>

	</div>
<div id="footer">
<?php require_once('infogeneral.php');?>
</div>
</body>
</html>
