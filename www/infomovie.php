<html>
<body>
<?php require_once('index.php');?>
<p>
</p>
<?php
$db_connection = mysql_connect("localhost", "cs143", "");
$selected = mysql_select_db("CS143", $db_connection);
$search = $_SERVER['QUERY_STRING'];
parse_str($search);
if ($search=='' OR !is_numeric($search)) {
	return;
} 
if ($selected) {
	$query = "SELECT * FROM Movie WHERE id=".$search; 
	$ins = mysql_query($query,$db_connection);
	
	if (!$ins) {
		echo "Error: ".mysql_error();
	}
	
	else{
		while($row = mysql_fetch_row($ins)) {
			$movie_res .= 'Title:'.$row[1]."</br>";
			$movie_res .= 'Year:'.$row[2]."</br>";
			$movie_res .= 'Rating:'.$row[3]."</br>";
			$movie_res .= 'Company:'.$row[4]."</br>";
			$movie_res .= "</br>";
		}
	}
	
	echo "Information About the Movie:</br>";
	echo $movie_res;

	$query_m = "SELECT last, first, role, id FROM Actor JOIN MovieActor ON MovieActor.mid=".$search." AND MovieActor.aid = id";
	$ins_m = mysql_query($query_m,$db_connection);
	
	if (!$ins_m) {
		echo "Error: ".mysql_error();
	}
	
	else{
		while($row = mysql_fetch_row($ins_m)) {
			$actor_res .= '<a href=infoactor.php?search='.$row[3].'> '.$row[1].' '.$row[0]."</a></br>";
			$actor_res .= 'Acted as: '.$row[2]."</br>";
			$actor_res .=  "</br>";
		}
	}
	
	echo "Actors in Movie</br></br>";
	echo $actor_res;

	$query_m = "SELECT first,last FROM Director JOIN MovieDirector ON MovieDirector.mid=".$search." AND MovieDirector.did = Director.id";
	$ins_m = mysql_query($query_m,$db_connection);
	
	if (!$ins_m) {
		echo "Error: ".mysql_error();
	}
	
	else{
		while($row = mysql_fetch_row($ins_m)) {
			$direct_res .= 'Name: '.$row[0].' '.$row[1]."</br>";
			$direct_res .=  "</br>";
		}
	}

	echo "Directors in this Movie:</br></br>";
	echo $direct_res;

	$query_g = "SELECT genre FROM MovieGenre WHERE mid=".$search;
	$ins_g = mysql_query($query_g,$db_connection);
	echo 'Genre: ';
	while($row = mysql_fetch_row($ins_g)) {
		$genre_res .= $row[0].' ';
	}
	echo $genre_res;
	echo "</br></br>";
	echo "<a href=review.php?".$search.">Click Here to Submit a Review Now!</a></br>";
	$query_r = "SELECT * FROM Review WHERE mid=".$search;
	$avg_review = mysql_fetch_row(mysql_query("SELECT AVG(rating) FROM Review WHERE mid=".$search,$db_connection))[0];
	if ($avg_review == '') {
		echo "No review has been submitted. Why not be the first one?</br>";
		$avg_review = "N/A";
	}
	$ins_r = mysql_query($query_r,$db_connection);
	echo 'Reviews: Average Review Score: '.$avg_review.'</br></br>';
	while($row = mysql_fetch_row($ins_r)) {
		$review_res .= 'User '.$row[0].' ';			
		$review_res .= 'at time: '.$row[1].' ';
		$review_res .= 'gave a rating of '.$row[3].' ';
		$review_res .= 'with comment: '.$row[4];
		$review_res .= '</br>';
	}
	echo $review_res;


}
else {
	echo 'Could not connect to server: '.mysql_error(); 
}

mysql_close($db_connection);


?>
