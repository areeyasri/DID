<?php
	
	ini_set('display_errors', 1);
	error_reporting(~0);

	$serverName	  = "127.0.0.1:3306";
	$userName	  = "root";
	$userPassword	  = "";
	$dbName	  = "database_web";

	$con = mysqli_connect($serverName,$userName,$userPassword,$dbName) or die("Database Connect Failed : " . mysqli_connect_error());
	
	mysqli_set_charset($con, "utf8");
	//*** Reject user not online
	$intRejectTime = 20; // Minute
	//$sql = "UPDATE member SET LoginStatus = '0', LastUpdate = '0000-00-00 00:00:00'  WHERE 1 AND DATE_ADD(LastUpdate, INTERVAL $intRejectTime MINUTE) <= NOW() ";
	//$query = mysqli_query($con,$sql);

?>