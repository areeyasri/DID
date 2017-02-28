<?php
	session_start();
	
	//check submit from login?
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require_once("connectSQL.php");
		$isOK = true;
		$incorrect = 0;
		//check data success?
		if(trim($_POST["username"]) == "") {
			//echo "Username is required!<br>";
			$isOK = false;
		}
		if(trim($_POST["password"]) == "") {
			//echo "Password is required!<br>";
			$isOK = false;
		}
		if (!$isOK) {
			// not success go to login again
			//echo "<br>Please go back to <a href='index.php'>Login page</a> and try again";
			//$incorrect = 1;	
			exit();
		} else {
			// user correct?
			$strSQL = "SELECT username FROM users WHERE username = '".trim($_POST['username'])."' ";
			$result = mysqli_query($con,$strSQL);
			if (mysqli_fetch_array($result)) {
				// password correct?
				$strSQL = "SELECT user_id,password,usergroup FROM users WHERE username = '".trim($_POST['username'])."' ";
				$result = mysqli_query($con,$strSQL);
				$row = mysqli_fetch_array($result);
				if ($row) {
					if ($row['password'] == trim($_POST["password"])) {
						//set session that login success
						$_SESSION["username"] = $_POST['username'];
						$_SESSION["user_id"] = $row['user_id'];
						$incorrect = 0;
						
						//$_SESSION["password"] = $_POST['password'];
						//echo $row['usergroup']."asdasddas";
						if($row['usergroup'] == 'admin')
							$_SESSION["group"] = 'admin';
						else
							$_SESSION["group"] = 'user';
						
						//header("location:index.php");
						
					} else {
						$isOK = false;
					}
				}
			} else {
				$isOK = false;
			}
			if (!$isOK) {
				// if username or password incorrect go back login
				$incorrect = 1;
				//echo "<br>Email or Password is incorrect.<br>Please go back to <a href='index.php'>Login page</a> and try again";	
				//exit();
				
			}
		}
		mysqli_close($con);
	} else {
		if (!isset($_SESSION["username"])) {
			header("location:index.php");
			//exit();
		}
	}
	$mArray  = array('incorrect' => $incorrect );
	echo json_encode($mArray,JSON_UNESCAPED_UNICODE );

	//if($_SESSION["group"] == 'admin'){}
		//echo 'alert("admin successfully login")';
		//echo "<br><br><a href=\"addHotel.php\"><input type=\"button\" name=\"logout\" value=\"AddHotel\"></a>".
		//		"<a href=\"editHotel.php\"><input type=\"button\" name=\"editHotel\" value=\"EditHotel\"></a>".
		//		"<a href=\"deleteHotel.php\"><input type=\"button\" name=\"deleteHotel\" value=\"DeleteHotel\"></a>";
		
	
	//echo "<script type='text/javascript' src='js/search.js'></script>";
?>