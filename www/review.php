<html>
<body>
<?php require_once('index.php');?>

<p>

<form action='' method="GET">	
	Name: <input type="textfield" name="reviewname" maxlength="20"></br>
	Comment: </br><textarea  name="review" maxlength="500" cols="50" rows="10" ></textarea></br>
	Rating: <select name="rate">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	</select></br>
	<input type="hidden" name="mid1" value=<?php echo $_SERVER['QUERY_STRING'];?>>
	<input type="submit" name="submit">	
</form>
</p>

<?php
$db_connection = mysql_connect("localhost", "cs143", "");
$selected = mysql_select_db("CS143", $db_connection);
if ($selected) {
	$name = $_GET['reviewname'];
	$comment = $_GET['review'];
	$rate = $_GET['rate'];
	$mid = $_GET['mid1'];
	if ($name=='' OR $comment=='') {
		return;
	}	 
	$query = "INSERT INTO Review (name,time,mid,rating,comment) Values('$name',NOW(),'$mid','$rate','$comment')";
$name.',NOW(),'.$mid.','.$rate.','.$comment.');'; 
	$ins = mysql_query($query,$db_connection);
	if (!$ins) {
		echo "Error: ".mysql_error();
	}
	
	else{
		echo "Your comment has been successfully added!</br>";
		header("LOCATION: index.php");
	}
	

}
else {
	echo 'Could not connect to server: '.mysql_error(); 
}

mysql_close($db_connection);


?>
</body>
</html>
