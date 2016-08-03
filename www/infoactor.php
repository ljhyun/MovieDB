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
	$query = "SELECT * FROM Actor WHERE id=".$search; 
	$ins = mysql_query($query,$db_connection);
	
	if (!$ins) {
		echo "Error: ".mysql_error();
	}
	
	else{
		while($row = mysql_fetch_row($ins)) {
			$actor_res .= 'Name:'.$row[2].' '.$row[1]."</br>";
			$actor_res .= 'Sex:'.$row[3]."</br>";
			$actor_res .= 'DOB:'.$row[4]."</br>";
			if ($row[5]==' ') {
				$actor_res .= 'DOD:'.$row[5]."</br>";
			}
			$actor_res .=  "</br>";
		}
	}
	
	echo "Information About the Actor:</br>";
	echo $actor_res;

	$query_m = "SELECT title,role,mid FROM Movie JOIN MovieActor ON MovieActor.aid=".$search." AND MovieActor.mid = Movie.id";
	$ins_m = mysql_query($query_m,$db_connection);
	
	if (!$ins_m) {
		echo "Error: ".mysql_error();
	}
	
	else{
		while($row = mysql_fetch_row($ins_m)) {
			$movie_res .= '<a href=infomovie.php?search='.$row[2].'>'.$row[0].'</a></br>';
			$movie_res .= 'Role:'.$row[1]."</br>";
			$movie_res .=  "</br>";
		}
	}

	echo "Acted in:</br>";
	echo $movie_res;


}
else {
	echo 'Could not connect to server: '.mysql_error(); 
}

mysql_close($db_connection);


?>
