<?php
	session_start();
	require_once("connectSQL.php");
	mysqli_set_charset($con, "utf8");

	$addWord = $_POST['addWord'];
	$newword_id = $_POST['word_id'];
	$delOK = 0;
	$rudeOK = 0;
	$thaiOK = 0;

	$result = mysqli_query($con,"SELECT max(rude_id) FROM rudedictionary");
	$result2 = mysqli_query($con,"SELECT max(thai_id) FROM dictionary");
	$row = mysqli_fetch_array($result);
	$id = $row[0]+1;
	$row2 = mysqli_fetch_array($result2);
	$id2 = $row2[0]+1;
	$num = 0;

	$addToRude = "INSERT INTO rudedictionary VALUES('".$id."','".$addWord."','".$num."')";
	$addToThai = "INSERT INTO dictionary VALUES('".$id2."','".$addWord."')";
	$resultToRude = mysqli_query($con,$addToRude);
	$resultToThai = mysqli_query($con,$addToThai);

	$delSQL = "DELETE from newrudeword where newword_id = ".$newword_id;
	$resultOfDel = mysqli_query($con,$delSQL);

	if ($resultToRude && $resultToThai){
		$rudeOK = 1;
		$thaiOK = 1;
		$mArray  = array('toRude' => $rudeOK, 'toThai' => $thaiOK);
		echo json_encode($mArray,JSON_UNESCAPED_UNICODE);
	}
	else{
		$mArray  = array('toRude' => $rudeOK, 'toThai' => $thaiOK);
		echo json_encode($mArray,JSON_UNESCAPED_UNICODE);
	}
	mysqli_close($con);
?>