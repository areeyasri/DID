<?php
	session_start();
	require_once("connectSQL.php");
	mysqli_set_charset($con, "utf8");

	$usedRude = $_POST['usedRude'];

	$result = mysqli_query($con,"SELECT * FROM rudedictionary where rudeword = '".$usedRude."'");
	$row = mysqli_fetch_array($result);
	$number = $row[2]+1;

	//$upSQL = "UPDATE rudedictionary SET Used ='".$number."' where rudeword = ".$usedRude;
	mysqli_query($con,"UPDATE rudedictionary SET Used ='".$number."' where rudeword = '".$usedRude."'");


	$mArray  = array('word' => $usedRude, 'number' => $number);
	echo json_encode($mArray,JSON_UNESCAPED_UNICODE );
?>