<?php 
session_start();
require_once('connectSQL.php');
mysqli_set_charset($con, "utf8");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>About us - Inappropriate Words Detection</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Jquery -->
    <script src="js/jquery.min.js"></script> 
    <script src="js/jquery.js"></script>

    <!-- Check Register -->
    <!-- <script src="js/checkRegis.js"></script> -->

</head>

<body>
<style>

 #page-wrapper{
   /* font-family: "Lato", sans-serif;
    transition: background-color .5s;*/
    background-image: url(wat-edit.jpg); 
    background-repeat: no-repeat;
    background-size: 100% 725px;
    position: intial;
}
 input[type=text], input[type=password], input[type=email] {
    /*width: 35%;*/
    padding: 12px 20px;
    margin: 8px;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
.gbutton {
    background-color: #4CAF50;
    color: white;
    padding: 5px;
    margin-bottom:8px;
    border: none;
    cursor: pointer;
    width: 100%;
}*/

/* Center the image and position the close button */

.popupcontainer {
    padding: 15px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

.form-control
{
    width: 97%;
}

.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

</style>


    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <img src = "logo.png" style="height:40px; width:40px; margin:5px 0px 5px 10px; float:left; ">
                <a class="navbar-brand hidden-xs" href="index.php">DETECTIVE INAPPROPRIATE WORDS</a>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" style="width:inherit;" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <!-- Top Menu Items -->
            
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                <?php
                    if(isset($_SESSION['username'])){
                        echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fa fa-user\"></i> ";
                        echo $_SESSION['username'];
                        echo "<b class=\"caret\"></b></a>";
                    
                    }
                    else{
                        echo "<a data-toggle=\"modal\" data-target=\"#myModal\" data-dismiss=\"modal\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fa fa-user\"></i>";
                        echo " User";
                        echo "<b class=\"caret\"></b></a>";
                    }
                ?> 
                    <?php
                        if(isset($_SESSION['username'])){
                            if($_SESSION["group"] == 'user'){
                                echo "<ul class=\"dropdown-menu\">
                                    <li>
                                        <a href=\"#\"><i class=\"fa fa-fw fa-user\"></i> Profile</a>
                                    </li>
                                    <li>
                                        <a href=\"history.php\"><i class=\"glyphicon glyphicon-globe\"></i> History</a>
                                    </li>
                                    <li>
                                        <a href=\"#\"><i class=\"fa fa-fw fa-gear\"></i> Settings</a>
                                    </li>
                                    <li class=\"divider\"></li>
                                    <li>
                                        <a href=\"#\" id=\"logout\"><i class=\"fa fa-fw fa-power-off\"></i> Log Out</a>
                                    </li>
                                </ul>";
                            }
                            else if($_SESSION["group"] == 'admin'){
                                echo 
                                "<ul class=\"dropdown-menu\">
                                    <li>
                                        <a href=\"#\"><i class=\"fa fa-fw fa-user\"></i> Profile</a>
                                    </li>
                                    <li>
                                        <a href=\"history.php\"><i class=\"glyphicon glyphicon-globe\"></i> History</a>
                                    </li>
                                    <li>
                                        <a href=\"#\"><i class=\"fa fa-fw fa-gear\"></i> Settings</a>
                                    </li>
                                    <li class=\"divider\"></li>
                                    <li>
                                        <a href=\"#\" id=\"logout\"><i class=\"fa fa-fw fa-power-off\"></i> Log Out</a>
                                    </li>
                                </ul>";
                            }
                            
                        }
                    ?>
                </li>
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="glyphicon glyphicon-home"></i> Home</a>
                    </li>
                    <?php
                        if(isset($_SESSION['username'])){
                        } 
                        else{
                            echo "<li>  <a data-toggle=\"modal\" data-target=\"#myModal\" data-dismiss=\"modal\">
                                        <i class=\"glyphicon glyphicon-lock\"></i> LogIn</a>
                                 </li>";
                        }
                        ?>
                    <?php      
                    if(isset($_SESSION['username'])){
                            if($_SESSION["group"] == 'user'){
                                echo "<li>
                            <a onclick=\"document.getElementById('id02').style.display='block'\"><i class=\"fa fa-fw fa-edit\"></i>Add a new word </a>

                        </li>"; 
                                }
                                else if($_SESSION["group"] == 'admin'){
                                    echo "<li>
                        <a href=\"tables.php\"><i class=\"fa fa-fw fa-edit\"></i>Add a new word </a>

                    </li>";
                                    } 
                                }
                                else {
                                         echo "<li>
                            <a data-toggle=\"modal\" data-target=\"#myModal\" data-dismiss=\"modal\">
                                        <i class=\"glyphicon glyphicon-lock\"></i> Add a new word</a>

                        </li>"; 
                                }
                        ?>
                    
                    <!-- <li>
                        <a href="forms.html"><i class="fglyphicon glyphicon-user"></i> MyAccount</a>
                    </li> -->
                    <li class="active">
                        <a href="aboutus.php"><i class="glyphicon glyphicon-cog"></i> About us</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

<!-- Modal -->
<div id="myModal" class="modal fade">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title" style="text-align:center; padding:15px;">MEMBER LOGIN AREA</h3>
        </div>
        <div class="modal-body" style="padding:30px;">   
            <label><b>Username</b></label>
            <input type="text" class="form-control" placeholder="Enter Username" name="username" id="username" required><br/>
            <label><b>Password</b></label>
            <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password" required>
            <button id="login" class="gbutton" type="submit" style="margin-top:10px;">Login</button>
            <div style="display:inline-block; width:100%;">
                <input type="checkbox" checked="checked">Remember me 
                <a href="#" style="float:right;">Forgot password?</a>
            </div>
            <hr style="margin:10px 10px 10px 10px;">                                         
            <center style="margin:15px;"><label>Not A Member Yet&nbsp;</label><a data-toggle="modal" data-target="#Regis"  data-dismiss="modal"  style="font-color:blue;">Join Now</a></center>
        </div>
        <!-- .model-content -->
    </div>
    <!-- .modal-dialog -->
  </div>
  <!-- #mymodel -->
</div>

                   
<!-- Register Page popup -->
<div id="Regis" class="modal fade" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" style="text-align:center;  padding-top: 10px; padding-bottom:5px;">YOU ARE WELCOME</h3>
                 <label style="text-align:center; padding:5px 15px 5px 15px; width:100%;">When becoming a member of the site, you could use full range of functions.</label>
      </div>
      <div class="modal-body" style="padding:30px;">
        <label><b>Full name</b></label><br/>
        <input class="form-control col-lg-6 col-xs-12" type="text" placeholder="Enter First Name" id="fname" name="fname" required>
        <!-- <span id="fnameER"></span><br/> -->
        <input class="form-control col-lg-6 col-xs-12" type="text" placeholder="Enter Last Name" id="lname" name="lname" required>
        <!-- <span id="lnameER"></span><br/> -->
        <label><b>Username</b></label><br/>
        <input type="text" class="form-control col-lg-6 col-xs-12" placeholder="Enter Username" id="usernameReg" name="usernameReg" required>
        <!-- <span id="usernameER"></span><br/> -->
        <label><b>Email</b></label><br/>
        <input type="email" class="form-control col-lg-6 col-xs-12" placeholder="Enter Email" id="emailReg" name="emailReg" required>
        <!-- <span id="emailER"></span><br/> -->
        <label><b>Password</b></label><br/>
        <input type="password" class="form-control col-lg-6 col-xs-12" placeholder="Enter Password" id="passwordReg" name="passwordReg" required>
        <!-- <span id="passwordER"></span><br/> -->
        <label><b>Confirm Password</b></label><br/>
        <input type="password" class="form-control col-lg-6 col-xs-12" placeholder="Enter Confirm-Password" name="conpasswordReg" id="conpasswordReg" required>
        <!-- <span id="conpasswordER"></span><br/> -->
        <button class="gbutton" type="submit" id="subReg" style="margin-top:10px;">Register</button>
     </div>
     <!-- .model-content -->
    </div>
    <!-- .modal-dialog -->
  </div>
  <!-- #mymodel -->
</div>

<div id="id02" class="modal" style="background-color: rgba(0,0,0,0);">
    <form class="modal-content animate" action="addNewWordDB.php" style="width:45%; margin-left:225px; margin-top:100px;" method="post" style="background-color: #fefefe; margin: 15% auto 15% auto; border: 1px solid #888; padding: 1%; width: 40%;">
        <div class="imgcontainer" style="text-align: center; margin: 24px 0 12px 0; position: relative;">
            <div style="display:inline-block; width:100%; height: 60px;">
                <h3>ADD NEW RUDE WORD</h3>
                <span onclick="document.getElementById('id02').style.display='none'" style="margin-right:15px;width:50px; " class="close" title="Close Modal">&times;</span>                    
            </div>      
        </div>
        <div class="container" style="padding: 16px; margin-left: 50px;">
            <label><b>NEW RUDE WORD</b></label>
            <input id="rudeword" name="rudeword" type="text" placeholder="Rude Word" required >
            <button type="submit" style="background-color: #4CAF50; width: 90px; color: white; padding: 14px 20px; margin: 8px 0; border: none; cursor: pointer;">OK</button>
        </div>  
    </form>
</div>


       

                <!-- Page Heading -->
                 <div id="page-wrapper" style="height: 750px;">

                   
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script>
        $(document).ready(function(){
            $("#login").click(function() {
                $.post("head.php",{
                    username: $('#username').val(),
                    password: $('#password').val()
                },
                function(data,status){
                    //console.log(status);
                    $obj = JSON.parse(data);
                    //console.log($obj.incorrect);
                    if($obj.incorrect == 1){
                        alert("Username or Password is incorrect. Please try again.");
                        //window.location.reload();
                    }
                    else if($obj.incorrect == 0) {
                        alert("Login Successfully.");
                        //window.location.reload();
                        window.location = 'index.php';
                    }
                });
            });

            $("#logout").click(function(){
                //console.log('logout');
                $.post("logout.php",{
                  username: $('#username').val()
                },
                function(data,status){
                  window.location = 'index.php';
                });
            });

            $("#subReg").click(function(){
 
                $.post("checkRegister.php",{
                  username: $('#usernameReg').val(),
                  fname: $('#fname').val(),
                  lname: $('#lname').val(),
                  password: $('#passwordReg').val(),
                  email: $('#emailReg').val(),
                  conpassword: $('#conpasswordReg').val()
                },
                function(data,status){
                  //console.log(data);
                  $obj = JSON.parse(data);
                  //console.log($obj);
                  
                  if($obj.dubUsername == 1){
                    //console.log("dub");
                    alert("Username already exists!!");
                    //document.getElementById("usernameER").innerHTML = "Username already exists!!";
                    //document.getElementById("usernameReg").style.backgroundColor="red";
                    //$("#usernameReg").attr("placeholder","Username already exists!!");
                    //document.getElementById('subReg').style.display = 'none';
                  }
                  if($obj.error[6] == 1){
                    //alert("Please Input All Box!!!");
                    $("#conpasswordReg").attr("placeholder","Password Not Match!!");
                    //$("#conpasswordReg").attr("value","Password Not Match!!");
                    alert("Password Not Match!!");

                  }
                  
                    if($obj.error[0] == 1){
                        //alert("username");
                        //document.getElementById("usernameER").innerHTML = "Please Input Username!!";
                        $("#usernameReg").attr("placeholder","Please Input Username!!");
                        //document.getElementById("usernameReg").style.backgroundColor="red";
                        //document.getElementById('subReg').style.display = 'none';
                    }
                    if($obj.error[1] == 1){
                        //alert("fname");
                        $("#fname").attr("placeholder","Please Input First Name!!");
                        //document.getElementById("fnameER").innerHTML = "Please Input First Name!!";
                        //document.getElementById("fname").style.backgroundColor="red";
                        //document.getElementById('subReg').style.display = 'none';
                    }
                    if($obj.error[2] == 1){
                        //alert("lname");
                        //document.getElementById("lnameER").innerHTML = "Please Input Last Name!!";
                        $("#lname").attr("placeholder","Please Input Last Name!!");
                        //document.getElementById("lname").style.backgroundColor="red";
                        //document.getElementById('subReg').style.display = 'none';
                    }
                    if($obj.error[3] == 1){
                        //alert("password");
                        //document.getElementById("passwordER").innerHTML = "Please Input Password!!";
                        $("#passwordReg").attr("placeholder","Please Input Password!!");
                        //document.getElementById("passwordReg").style.backgroundColor="red";
                        //document.getElementById('subReg').style.display = 'none';
                    }
                    if($obj.error[4] == 1){
                        //alert("Confirm-Password");
                        //document.getElementById("conpasswordER").innerHTML = "Please Input Confirm-Password!!";
                        $("#conpasswordReg").attr("placeholder","Please Input Confirm-Password!!");
                        //document.getElementById("conpasswordReg").style.backgroundColor="red";
                        //document.getElementById('subReg').style.display = 'none';
                    }
                    if($obj.error[5] == 1){
                        //alert("email");
                        //document.getElementById("emailER").innerHTML = "Please Input Email!!";
                        $("#emailReg").attr("placeholder","Please Input Email!!");
                        //document.getElementById("emailReg").style.backgroundColor="red";
                        //document.getElementById('subReg').style.display = 'none';
                    }
                  else if($obj.dubUsername== 0 && $obj.OK == true) {
                    alert('Register Successfully!!');
                    window.location = 'index.php';
                  }
                });
              });

        });


    </script>

    <!-- jQuery -->
    <!-- <script src="js/jquery.js"></script> -->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
