<?php
	session_start();
	require_once("connectSQL.php");
	
	$con = mysqli_connect("127.0.0.1","root","");
	mysqli_select_db($con,"database_web");
	$result = mysqli_query($con,"SELECT max(new_id) FROM newrudeword");
	$row = mysqli_fetch_array($result);
	$id = $row[0]+1;
	$result_id_user = mysqli_query($con,"SELECT user_id FROM user WHERE username = '".$_SESSION['username']."'");
	$r = mysqli_fetch_array($result_id_user);
	$user_id = $r[0];
	mysqli_query($con,"INSERT INTO newrudeword VALUES('".$id."','".$_POST['rudeword']."','".$user_id."')");
	echo "Add NEW RUDE WORD Completed!<br>";		
	//echo "<br>Please go to <a href='home.html'>Home page</a>";
	header("location:home.html");
	mysqli_close($con);
?>