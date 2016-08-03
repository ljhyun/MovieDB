<html>
<body>
<?php require_once('index.php');?>
<p>
<form action='' method="GET">	
	<input type="radio" name="actdirect" value="actor">Actor</br>
	<input type="radio" name="actdirect" value="director">Director</br>		<input type="radio" name="actdirect" value="both">Both</br>
	Last Name: <input type='textfield' name='last' maxlength="20"></br>
	First Name: <input type='textfield' name='first' maxlength="20"></br>
	Day of birth (YYYY-MM-DD): <input type='number' name='doby' min="1" max="2015"><input type='number' name='dobm' min="1" max="12"><input type='number' name='dobd' min="1" max="31"></br>
	Day of death (YYYY-MM-DD): (Optional) <input type='number' name='dody' min="1" max="2015"><input type='number' name='dodm' min="1" max="12"><input type='number' name='dodd' min="1" max="31"></br>
	Sex: (Actor only) Male: <input type="radio" name="sex" value="Male">Female:<input type="radio" name="sex" value"Female"></br>
	<input type="submit" name="subpost" Value="Submit!"></br>
</form>
</p>
<?php
$db_connection = mysql_connect("localhost", "cs143", "");
$selected = mysql_select_db("CS143", $db_connection);
$last = $_GET['last'];
$first = $_GET['first'];
$dob = $_GET['doby'].'-'.$_GET['dobm'].'-'.$_GET['dobd'];
$dod = $_GET['dody'].'-'.$_GET['dodm'].'-'.$_GET['dodd'];
$sex = $_GET['sex'];

if ($dod=='') {
	$dod='NULL';
}
if ($dob=='') {
	return;
}

$name_match = "/^[-'a-zA-Z]+$/";
if (!preg_match($name_match, $last) OR !preg_match($name_match, $first) OR $_GET['actdirect']=='') {
	return;
} 
if ($selected) {
	$max_i = mysql_query("SELECT id FROM MaxPersonID", $db_connection);
	if (!$max_i) {
		echo "Fail to get MaxID ".mysql_error();
		return;
	}	
	$id = mysql_fetch_row($max_i)[0]+1;
		
	if ($_GET['actdirect'] == "actor" OR $_GET['actdirect'] == "both") {
		if ($sex=='') {
			echo 'Invalid Format';
			return;	
		}
		$query = "INSERT INTO Actor (id, last, first, sex, dob, dod) Values('$id','$last','$first','$sex','$dob','$dod')";
		$ins = mysql_query($query,$db_connection);
	}
	if ($_GET['actdirect'] == "director" OR $_GET['actdirect'] == "both") {
		$query = "insert into Director (id, last, first, dob, dod) Values('$id','$last','$first','$dob','$dod')";
		$ins = mysql_query($query,$db_connection);
	}
	if (! $ins) {
		echo "Fail to Insert: ".mysql_error();
	}
	else {
		echo "Entered Data Successfully\n";
	}
}
else {
	echo 'Could not connect to server: '.mysql_error(); 
}

mysql_close($db_connection);


?>
