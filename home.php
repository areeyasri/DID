<?php 
session_start();
require_once('connectSQL.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  
        <SCRIPT LANGUAGE="JavaScript" CHARSET="UTF-8"></SCRIPT>
        <title>DID - Detection Inappropriate Document</title>
        <script src="jquery.min.js"></script>
        <script src="registerCheck.js"></script>
        <script src="process.js"></script>
    </head>
    <body>
    <style>

 input[type=text], input[type=password], input[type=email] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    padding: 1%;
    width: 40%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}


textarea
{
  height: 300px;
  width: 600px;
  position: relative;
}

 .button
     {

     	padding: 0;
     	border: none;
     	background: none;
     }
    

 body {
    font-family: "Lato", sans-serif;
    transition: background-color .5s;
    background-image: url(wat-edit.jpg); 
    background-repeat: no-repeat;
	background-size: 100% 725px;
}

.sidenav {
	height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}


.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s
}

.sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

#box
{
	background-color: #E6E6E6;
	border:0px solid black;
	
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}


    </style>

 			<!-- BANNER-->
 			<!-- This div cover all of template so end of the div is located at the last part  -->
 			<div style="background-color:black; width:100%; height:80px; top:0px; left:0px; position: fixed;">
		 	
		 	<span style="  font-size:30px; cursor:pointer; color: white; margin:0px 0px 0px 15px; position: relative; bottom: 20px; "onclick="openNav()">&#9776;</span>
				 	<img src = "logo.png" style="height:60px; width:60px; margin-top: 10px; margin-left:15px; ">
				 	<h2 style="display:inline-block; color:white; position:relative; margin-left:10px; bottom:20px;">INAPPROPRIATE แฮร่ WORDS DETECTION สัส เหี้ย ห่า ไอ้เหี้ยยย อีกแค่สองคะแนน</h2>
          <div style="float:right;color:#fff;margin-top:10px;">
          <?php
               if(isset($_SESSION['username'])){
               echo $_SESSION['username'];
               echo '<button id="logout">log out</button>';
            }else{
                echo "none";
              }
              ?>
       
           </div>
		   		<div id="mySidenav" class="sidenav">
  					<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  					<a href="#">Guide</a>
  					<a onclick="document.getElementById('id01').style.display='block'">Log In</a>
  					<a onclick="document.getElementById('id02').style.display='block'">Add a new word</a>
  					<a href="#">About Us</a>
				</div>

							<div id="id01" class="modal">
								  <form class="modal-content animate" action="head.php" method="post" >
  								  		<div class="imgcontainer">
    							 	
  								  				<div style="display:inline-block; width:100%;">
		    							 		 		<h3>MEMBER LOGIN AREA</h3>
		    							 		 		<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>    		 		
		    							 		</div> 	
  								
   										 </div>

 							  			 <div class="container">
		 	   										 <label><b>Username</b></label>
		     										 <input type="text" placeholder="Enter Username" name="username" required>
		    							 			 <label><b>Password</b></label>
		     										 <input type="password" placeholder="Enter Password" name="password" required>
		        									 <button type="submit">Login</button>
		        									 <div style="display:inline-block; width:100%;">
				     							  			<input type="checkbox" checked="checked">Remember me 
				     							  			<a href="#" style="float:right;">Forgot password?</a>
		     							  			</div>
   										</div>
   										<hr style="margin:10px 10px 10px 10px;">										 
   										<center style="margin:15px;"><label>Not A Member Yet  </label><a href="#" onclick="openRegis()" style="font-color:blue;" >Join Now</a></center>

  								</form>
							</div>

							<!-- Register Page popup -->
									<div id="new" class="modal" style="background-color: rgba(0,0,0,0);">

										<form class="modal-content animate" style="width:45%" method="post">
  								  			<div class="imgcontainer" >
  								  				<div style="display:inline-block; width:100%;">
		    							 		 		<h3>YOU ARE WELCOME</h3>
		    							 		 		<span onclick="document.getElementById('new').style.display='none'" class="close" title="Close Modal">&times;</span>    		 		
		    							 		</div> 		
		    							 				<label>When becoming a member of the site, you could use full range of functions.</label>

  								    		</div>
 							  				<div class="container">
		 	   										 <label><b>Full name</b></label>
		 	   										 <div style="display:inline-block; width:100%;">
				     										 <input style=" width:45%; margin-right:1%;" type="text" placeholder="Enter First Name" name="fname" id="fname" required="required">
                                 <input style="float:right; width:54%;" type="text" placeholder="Enter Last Name" name="lname" id="lname" required="required">
                                 <span id="fnameER"></span><br>
                                 <span id="lnameER"></span><br>
				     								 </div>
				    							 			 <label><b>Username</b></label>
															 <input type="text" placeholder="Enter Username" name="username" id="username" onkeyup="checkUsername(username)" required="required">
                               <span id="usernameER"></span><br>
															 <label><b>Email</b></label>
				     										 <input type="email" placeholder="Enter Email" name="email" id="email" required="required">
                                 <span id="usernameER"></span><br>
				     										 <label><b>Password</b></label>
				     										 <input type="password" placeholder="Enter Password" name="password" id="password" required="required">
				     										 <label><b>Confirm Password</b></label>
				     										 <input type="password" placeholder="Enter Confirm-Password" name="conpassword" id="conpassword" required="required">
				        									 <button type="button" id="subReg">Register</button>
															 <!-- <input class="animated" type="submit" value="Register"> -->
		        									 
   											</div>	
  										</form>
  									</div>
									
						<!-- Add New Word-->
						
						<div id="id02" class="modal" style="background-color: rgba(0,0,0,0);">
							<form class="modal-content animate" action="addNewWordDB.php" style="width:45%" method="post">
								<div class="imgcontainer" >
									<div style="display:inline-block; width:100%;">
		    							<h3>ADD NEW RUDE WORD</h3>
										<span onclick="document.getElementById('new').style.display='none'" class="close" title="Close Modal">&times;</span>    		 		
									</div> 		
  								</div>
								<div class="container">
									<label><b>NEW RUDE WORD</b></label>
									<input id="rudeword" name="rudeword" type="text" placeholder="Rude Word" required="required" >
									<button type="submit" >OK</button>
   								</div>	
  							</form>
  						</div>
						
						<!-- End Add New Word -->

			<!-- <button class="submit" onclick="myFunction()" style="float:right; font-size:20px;">ADD NEW WORDS</button> -->
  			<!-- END OF BANNER -->

				  	<div id="main">

							<table id="tarea" align="center" style="border:1px solid black; width:95%; height: 100%; padding-right:15px; border-spacing:5px; border-collapse: separate;">
					   			<!-- button submit -->
								
					   			<tr>
					    			<td style="border:0px solid black;">
										<!-- <button class="submit" value="sent"  
										style="border:1px solid black; float:right; font-size:18px; width:auto; color:black;">SUBMIT
										</button> -->
									</td>
									
									<td style="border:0px solid black;"></td>
					   			</tr>
					   			<!-- end of button submit -->
					     		<tr>
	
					    			<td style="border:1px solid black; width:50%;">
                      <button class="button" value="sent" style="border:1px solid black; float:right; font-size:18px; width:auto; color:black;">SUBMIT</button>
                      <textarea id="text_to_segment" name="text_to_segment" class="box" style="resize:none;"> </textarea>
					    			</td>
							
									<!-- result path -->
					    			<td >
                      <P id="full">ประโยค :</P><div id="full_text"></div>
							         <div id="box"></div> 
					    			</td>
					   			<!-- end of result -->
					    		</tr>
					    	</table>

					</div>
 <div id="clearTxt"></div>


					</div>


    <script>
// When the user clicks on div, open the popup
function myFunction() {
    alert("Hello! I am an alert box!");
}
function openNav() {

	
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
    //document.getElementById("box").style.backgroundColor="rgba(0,0,0,0)";
 
}
function closeNav() {

	
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    //document.getElementById("box").style.backgroundColor="#E6E6E6";
    document.body.style.backgroundColor = "white";

}

function openRegis(){
document.getElementById('new').style.display='initial';
document.getElementById('id01').style.display='none';
}

// Get the modal
	var modal = document.getElementById('id01');
	var clear = document.getElementById('new');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    	if (event.target == modal) {
        modal.style.display = "none";
    }
     if (event.target == clear) {
        clear.style.display = "none";
        modal.style.display = "none";
    }
  

	var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-28746062-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

  
}
$(document).ready(function(){
  $("#full").hide();
  $(".button").click(function(){

        $.post("run.php",
        {
          text_to_segment: $('#text_to_segment').val()
        },
        function(data,status){
           //console.log(status);
           $obj = JSON.parse(data);
           //console.log($obj);
           var tmp = "";
           var found = 0;
           //console.log($obj.full_text);

           for(var i=0; i<$obj.full_text.length; i++){
              for(var j = 0; j<$obj.rudeword.length; j++) {
                if($obj.full_text[i] == $obj.rudeword[j]){
                  found = 1;
                }
               
              }
              if (found == 1){
                tmp = tmp + " |" + "***";
                 found=0;
              }
              else{
                tmp = tmp + "|" + $obj.full_text[i];
                //console.log($obj.full_text[i]);
              }
           }
           console.log(tmp);
           $("#full").show();
           $("#full_text").text(tmp);
           $("#box").text($obj.rudeword);
        });
    });

  $("#subReg").click(function(){
    console.log('sasa');
    $.post("checkRegister.php",{
      username: $('#username').val(),
      fname: $('#fname').val(),
      lname: $('#lname').val(),
      password: $('#password').val(),
      email: $('#email').val(),
      conpassword: $('#conpassword').val()
    },
    function(data,status){
      //console.log(data);
      $obj = JSON.parse(data);
      console.log($obj.dubUsername);
      if($obj.dubUsername == 1){
        //console.log("dub");
        alert("Username already exists!!");
      }
      else if($obj.dubUsername == 0){
        alert('Register Successfully!!');
        window.location = 'home.html';
      }
    });
  });

  $("#logout").click(function(){
    //console.log('logout');
    $.post("logout.php",{
      username: $('#username').val()
    },
    function(data,status){
      window.location.reload();
    });
  });

});


</script>

</body>
</html>