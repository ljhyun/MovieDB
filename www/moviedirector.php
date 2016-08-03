<html>
<body>
<?php require_once('index.php');?>

<p>
<form action='' method="GET"> 
	Movie: <select name="mid">
		<?php $db_connection = mysql_connect("localhost", "cs143", "");
$selected = mysql_select_db("CS143", $db_connection);$mov = mysql_query("SELECT title, year,id FROM Movie ORDER BY title", $db_connection);while($row=mysql_fetch_row($mov)) { echo '<option value="'.$row[2].'">'.$row[0].' '.$row[1]."</option>";}mysql_close($db_connection);?>
	</select></br>
	Director: <select name="did">
	<?php $db_connection = mysql_connect("localhost", "cs143", "");
$selected = mysql_select_db("CS143", $db_connection);$mov = mysql_query("SELECT first,last,dob, id FROM Director ORDER BY last", $db_connection);while($row=mysql_fetch_row($mov)) { echo '<option value="'.$row[3].'">'.$row[0].' '.$row[1].' '.$row[2]."</option>";}mysql_close($db_connection);?>
	</select>
	<input type="submit" name="subpost" Value="Submit!"></br>
</form>
</p>
<?php
$db_connection = mysql_connect("localhost", "cs143", "");
$selected = mysql_select_db("CS143", $db_connection);
$mid = $_GET['mid'];
$did = $_GET['did'];

if ($mid=='' OR $did=='') {
	return;
} 
if ($selected) {	
	$query = "INSERT INTO MovieDirector (mid, did) Values('$mid','$did')";
	$ins = mysql_query($query,$db_connection);	
	if (!$ins) {
		echo "Fail to Insert: ".mysql_error();
	}
	else {
		echo "Entered Successfully";
	}
}
else {
	echo 'Could not connect to server: '.mysql_error(); 
}

mysql_close($db_connection);


?>

