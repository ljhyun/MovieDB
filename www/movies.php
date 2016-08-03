<html>
<body>
<?php require_once('index.php');?>
<p>
<form action='' method="GET">	
	Title: <input type='textfield' name='title' maxlength="1000"></br>
	Company: <input type='company' name='company' maxlength="50"></br>
	Year: <input type='number' name='year' min="1" max="2015"></br>
	Rating: <select name="rating">
		<option value="G">G</option>
		<option value="PG">PG</option>
		<option value="PG-13">PG-13</option>
		<option value="R">R</option>
		<option value="NC-17">NC-17</option>
		<option value="surrendere">surrendere</option>
	</select></br>
	Genre:</br> 	
		<input type="checkbox" name="genredr" value="Drama">Drama</br>
		<input type="checkbox" name="genreco" value="Comedy">Comedy</br>
		<input type="checkbox" name="genrero" value="Romance">Romance</br>
		<input type="checkbox" name="genrecr" value="Crime">Crime</br>
		<input type="checkbox" name="genreho" value="Horror">Horror</br>
		<input type="checkbox" name="genremy" value="Mystery">Mystery</br>
		<input type="checkbox" name="genreth" value="Thriller">Thriller</br>
		<input type="checkbox" name="genreac" value="Action">Action</br>
		<input type="checkbox" name="genread" value="Adventure">Adventure</br>
		<input type="checkbox" name="genrefa" value="Fantasy">Fantasy</br>
		<input type="checkbox" name="genredo" value="Documentary">Documentary</br>
		<input type="checkbox" name="genrefa" value="Family">Family</br>
		<input type="checkbox" name="genresc" value="Sci-Fi">Sci-Fi</br>
		<input type="checkbox" name="genrean" value="Animation">Animation</br>
		<input type="checkbox" name="genremu" value="Musical">Musical</br>
		<input type="checkbox" name="genrewar" value="War">War</br>
		<input type="checkbox" name="genrewe" value="Western">Western</br>
		<input type="checkbox" name="genread" value="Adult">Adult</br>
		<input type="checkbox" name="genresh" value="Short">Short</br>

	<input type="submit" name="subpost" Value="Submit!"></br>
</form>
</p>
<?php
$db_connection = mysql_connect("localhost", "cs143", "");
$genre_list = array("genredr","genreco","genrero","genrecr","genreho","genremy","genreth","genreac","genread","genrefa","genredo","genrefa","genresc","genrean","genremu","genrewar","genread","genresh");
$selected = mysql_select_db("CS143", $db_connection);
$title = $_GET['title'];
$company = $_GET['company'];
$year = $_GET['year'];
$rating = $_GET['rating'];
$genre = $_GET['genre'];
if ($title=='' OR $company=='' OR $year=='' OR $rating=='') {
	return;
} 
if ($selected) {
	$max_i = mysql_query("SELECT id FROM MaxMovieID", $db_connection);
	if (!$max_i) {
		echo "Fail to get MaxID ".mysql_error();
		return;
	}	
	$id = mysql_fetch_row($max_i)[0]+1;
		
	$query = "INSERT INTO Movie (id, title, year, rating, company) Values('$id','$title','$year','$rating','$company')";
	$ins = mysql_query($query,$db_connection);
	
	if (!$ins) {
		echo "Fail to Insert: ".mysql_error();
		return;
	}
	for($ch=0;$ch<count($genre_list);$ch=$ch+1) {
		$genre = $_GET[$genre_list[$ch]];
		$query1 = "INSERT INTO MovieGenre (mid, genre) Values('$id','$genre')";
		$ins1 = mysql_query($query1,$db_connection);
		
		if (!$ins1) {
			echo "Fail to Insert: ".mysql_error();
			return;
		}
	}
	if ($ins && $ins1){
		echo "Entered Data Successfully\n";
	}
}
else {
	echo 'Could not connect to server: '.mysql_error(); 
}

mysql_close($db_connection);


?>
