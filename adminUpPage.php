<?php
	session_start();
	require_once("connectSQL.php");
	mysqli_set_charset($con, "utf8");

	$updateWord = $_POST['updateWord'];
	$newword_id = $_POST['word_id'];
	$upOK = 0;

	$upSQL = "UPDATE newrudeword SET newword ='".$updateWord."' where newword_id = ".$newword_id;
	$result = mysqli_query($con,$upSQL);
	if ($result){
		$upOK = 1;

		$mArray  = array('update' => $upOK,);
		echo json_encode($mArray,JSON_UNESCAPED_UNICODE);
	}
	else{
		$mArray  = array('update' => $upOK,);
		echo json_encode($mArray,JSON_UNESCAPED_UNICODE);
	}

?>