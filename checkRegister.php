<?php
	session_start();
	require_once("connectSQL.php");

	$dubUser = 0;
	$array =array(0,0,0,0,0,0,0); 
	$isOK = true;

	if(trim($_POST["username"]) == "") {
		//echo "Please input Username!<br>";
		$array[0] = 1;
		$isOK = false;
	}
	if(trim($_POST["fname"]) == "") {
		//echo "Please input Firstname!<br>";
		$array[1] = 1;
		$isOK = false;
	}
	if(trim($_POST["lname"]) == "") {
		//echo "Please input Lastname!<br>";
		$array[2] = 1;
		$isOK = false;
	}
	if(trim($_POST["password"]) == "") {
		//echo "Please input Password!<br>";
		$array[3] = 1;
		$isOK = false;
	}	
	if(trim($_POST["conpassword"]) == "") {
		//echo "Password not Match!<br>";
		$array[4] = 1;
		$isOK = false;
	}	
	if(trim($_POST["email"]) == "") {
		//echo "Password not Match!<br>";
		$array[5] = 1;
		$isOK = false;
	}
	if($_POST["password"] != $_POST["conpassword"]) {
		//echo "Password not Match!<br>";
		$array[6] = 1;
		$isOK = false;
	}	

		$strSQL = "SELECT * FROM users WHERE username = '".trim($_POST['username'])."' ";
		$result = mysqli_query($con,$strSQL);
		if (mysqli_fetch_array($result)) {
			//echo false
			$dubUser = 1;
			$isOK = false;
			//echo "<br>Please go back to <a href='home.html'>Registration page</a> and try again";
			$mArray  = array('dubUsername' => $dubUser, 'OK' => $isOK, 'error' => $array);
		    echo json_encode($mArray,JSON_UNESCAPED_UNICODE );
		}
		else if($dubUser == 0 && $isOK == true){
			$strSQL = "INSERT INTO users (username,password,fname,lname,email,usergroup) VALUES (".
				"'".$_POST["username"]."',".
				"'".$_POST["password"]."',".
				"'".$_POST["fname"]."',".
				"'".$_POST["lname"]."',".
				"'".$_POST["email"]."',".
				"'user')";
			mysqli_query($con,$strSQL);
			
			$LoginSQL = "SELECT user_id,password,usergroup FROM users WHERE username = '".trim($_POST['username'])."' ";
			$result = mysqli_query($con,$LoginSQL);
			$row = mysqli_fetch_array($result);
			$_SESSION["username"] = $_POST['username'];
			$_SESSION["user_id"] = $row['user_id'];
			if($row['usergroup'] == 'admin')
				$_SESSION["group"] = 'admin';
			else
				$_SESSION["group"] = 'user';

			$mArray  = array('dubUsername' => $dubUser, 'OK' => $isOK, 'error' => $array);
	        echo json_encode($mArray,JSON_UNESCAPED_UNICODE );
			//echo "Register Completed!<br>";		
			//echo "<br>Please go to <a href='home.html'>Login page</a>";
		}
		else {
			$mArray  = array('dubUsername' => $dubUser, 'OK' => $isOK, 'error' => $array);
	        echo json_encode($mArray,JSON_UNESCAPED_UNICODE );
		}
	
	
	mysqli_close($con);
	
?>