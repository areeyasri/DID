<?php
	session_start();
	require_once("connectSQL.php");

	$isOK = 0;
	
	$strSQL = "SELECT * FROM users WHERE username = '".trim($_POST['username'])."' ";
	$result = mysqli_query($con,$strSQL);
	if (mysqli_fetch_array($result)) {
		//echo false
		$isOK = 1;
		//echo "<br>Please go back to <a href='home.html'>Registration page</a> and try again";
		$mArray  = array('dubUsername' => $isOK);
	    echo json_encode($mArray,JSON_UNESCAPED_UNICODE );
	}
	else {	
			$strSQL = "INSERT INTO users (username,password,fname,lname,email,usergroup) VALUES (".
				"'".$_POST["username"]."',".
				"'".$_POST["password"]."',".
				"'".$_POST["fname"]."',".
				"'".$_POST["lname"]."',".
				"'".$_POST["email"]."',".
				"'user')";	
			mysqli_query($con,$strSQL);
			$mArray  = array('dubUsername' => $isOK);
	       echo json_encode($mArray,JSON_UNESCAPED_UNICODE );
	       
			//echo "Register Completed!<br>";		
			//echo "<br>Please go to <a href='home.html'>Login page</a>";
		}
	
	mysqli_close($con);
	
?>