<?php
	session_start();
	require_once("connectSQL.php");
	mysqli_set_charset($con, "utf8");

	$newword_id = $_POST['word_id'];
	$delOK = 0;

	$delSQL = "DELETE from newrudeword where newword_id = ".$newword_id;
	$result = mysqli_query($con,$delSQL);
	if ($result){
		$delOK = 1;

		$mArray  = array('delete' => $delOK,);
		echo json_encode($mArray,JSON_UNESCAPED_UNICODE);
	}
	else{
		$mArray  = array('delete' => $delOK,);
		echo json_encode($mArray,JSON_UNESCAPED_UNICODE);
	}

?>