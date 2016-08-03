<html>
<body>
<p>
<form action='' method="GET">	
	Actor/Movie Search: <input type='textfield' name='search_val' maxlength="1000"></br>
		<input type="submit" name="subpost" Value="Submit!"></br>
</form>
</p>
<?php
$db_connection = mysql_connect("localhost", "cs143", "");
$selected = mysql_select_db("CS143", $db_connection);
$search_v = $_GET['search_val'];
parse_str($search_v);
$sear_arr = explode(' ',trim($search_v));
if ($search_v=='') {
	return;
} 
if ($selected) {
	if (count($sear_arr)==1) {
		$query = "SELECT * FROM Actor WHERE INSTR(first,'".$sear_arr[0]."')>0 OR INSTR(last,'".$sear_arr[0]."')>0";
	}
	else if(count($sear_arr)==2) {
		$query = "(SELECT * FROM Actor WHERE INSTR(first,'".$sear_arr[0]."')>0 AND INSTR(last,'".$sear_arr[1]."')>0) UNION (SELECT * FROM Actor WHERE INSTR(first,'".$sear_arr[1]."')>0 AND INSTR(last,'".$sear_arr[0]."')>0)"; 
	}
	$query.= ' ORDER BY last';
	$ins = mysql_query($query,$db_connection);
	
	if (!$ins) {
		echo '';
	}
		
	else{
		while($row = mysql_fetch_row($ins)) {
			$actor_res .= '<a href=infoactor.php?search='.$row[0].'>'.$row[2].' '.$row[1]."</a>   ";
			$actor_res .= $row[3]." ";
			$actor_res .= $row[4];
			if ($row[5]==' ') {
				$actor_res .= ":".$row[5];
			}
			$actor_res .=  "</br>";
		}
	}
	$query = "SELECT title,year,id FROM Movie WHERE INSTR(title,'".$sear_arr[0]."')>0";
	for($i=1;$i<count($sear_arr);$i++) {
		$query .=" AND INSTR(title,'".$sear_arr[$i]."')>0";
	}
	$query.= ' ORDER BY title';

	$ins = mysql_query($query,$db_connection);
	
	if (!$ins) {
		echo '';
	}
	
	else{
		while($row = mysql_fetch_row($ins)) {
			$movie_res .= "<a href=infomovie.php?search=".$row[2].">".$row[0]."</a>";
			$movie_res .= " (".$row[1].")</br>";
		}
	}
	echo "Information About the Actor:</br>";
	echo $actor_res;
	echo "</br></br>";
	echo "Information About the Movie:</br>";
	echo $movie_res;
}
else {
	echo 'Could not connect to server: '.mysql_error(); 
}

mysql_close($db_connection);


?>
