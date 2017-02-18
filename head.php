<?php
	session_start();
	
	//check submit from login?
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require_once("connectSQL.php");
		$isOK = true;
		//check data success?
		if(trim($_POST["username"]) == "") {
			echo "Username is required!<br>";
			$isOK = false;
		}
		if(trim($_POST["password"]) == "") {
			echo "Password is required!<br>";
			$isOK = false;
		}
		if (!$isOK) {
			// not success go to login again
			echo "<br>Please go back to <a href='home.html'>Login page</a> and try again";	
			exit();
		} else {
			// user correct?
			$strSQL = "SELECT username FROM user WHERE username = '".trim($_POST['username'])."' ";
			$result = mysqli_query($con,$strSQL);
			if (mysqli_fetch_array($result)) {
				// password correct?
				$strSQL = "SELECT password,usergroup FROM user WHERE username = '".trim($_POST['username'])."' ";
				$result = mysqli_query($con,$strSQL);
				$row = mysqli_fetch_array($result);
				if ($row) {
					if ($row['password'] == trim($_POST["password"])) {
						//set session that login success
						$_SESSION["username"] = $_POST['username'];
						$_SESSION["password"] = $_POST['password'];
						//echo $row['usergroup']."asdasddas";
						if($row['usergroup'] == 'admin')
							$_SESSION["group"] = 'admin';
						else
							$_SESSION["group"] = 'user';
						
						header("location:home.html");
					} else {
						$isOK = false;
					}
				}
			} else {
				$isOK = false;
			}
			if (!$isOK) {
				// if username or password incorrect go back login
				echo "<br>Email or Password is incorrect.<br>Please go back to <a href='home.html'>Login page</a> and try again";	
				exit();
			}
		}
		mysqli_close($con);
	} else {
		if (!isset($_SESSION["username"])) {
			header("location:home.html");
			exit();
		}
	}

	if($_SESSION["group"] == 'admin')
		echo 'alert("admin successfully login")';
		//echo "<br><br><a href=\"addHotel.php\"><input type=\"button\" name=\"logout\" value=\"AddHotel\"></a>".
		//		"<a href=\"editHotel.php\"><input type=\"button\" name=\"editHotel\" value=\"EditHotel\"></a>".
		//		"<a href=\"deleteHotel.php\"><input type=\"button\" name=\"deleteHotel\" value=\"DeleteHotel\"></a>";
		
	
	//echo "<script type='text/javascript' src='js/search.js'></script>";
?>