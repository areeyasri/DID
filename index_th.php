<?php 
session_start();
require_once('connectSQL.php');
mysqli_set_charset($con, "utf8");
?>
<!DOCTYPE html>
<html id="language" lang="th_utf8">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inappropriate Words Detection</title>

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
                <a class="navbar-brand hidden-xs" href="index_th.php">DETECTION OF INAPPROPRIATE DOCUMENT</a>
                <select id="selectLang" style="margin-left: 555px; margin-top: 15px;">
                    <option value="1">English (en)</option>
                    <option value="2" selected="selected">Thai (th)</option>
                </select>
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
                        echo " ล็อกอิน";
                        echo "<b class=\"caret\"></b></a>";
                    }
                ?> 
                    
                <?php
                        if(isset($_SESSION['username'])){
                            if($_SESSION["group"] == 'user'){
                                echo "<ul class=\"dropdown-menu\">
                                    <li>
                                        <a href=\"#\"><i class=\"fa fa-fw fa-user\"></i> ข้อมูลส่วนตัว</a>
                                    </li>
                                    <li>
                                        <a href=\"history_th.php\"><i class=\"glyphicon glyphicon-globe\"></i> ประวัติการใช้</a>
                                    </li>
                                    <li>
                                        <a href=\"#\"><i class=\"fa fa-fw fa-gear\"></i> ตั้งค่า</a>
                                    </li>
                                    <li class=\"divider\"></li>
                                    <li>
                                        <a href=\"#\" id=\"logout\"><i class=\"fa fa-fw fa-power-off\"></i> ออกจากระบบ</a>
                                    </li>
                                </ul>";
                            }
                            else if($_SESSION["group"] == 'admin'){
                                echo "<ul class=\"dropdown-menu\">
                                    <li>
                                        <a href=\"#\"><i class=\"fa fa-fw fa-user\"></i> ข้อมูลส่วนตัว</a>
                                    </li>
                                    <li>
                                        <a href=\"history_th.php\"><i class=\"glyphicon glyphicon-globe\"></i> ประวัติการใช้</a>
                                    </li>
                                    <li>
                                        <a href=\"#\"><i class=\"fa fa-fw fa-gear\"></i> ตั้งค่า</a>
                                    </li>
                                    <li class=\"divider\"></li>
                                    <li>
                                        <a href=\"#\" id=\"logout\"><i class=\"fa fa-fw fa-power-off\"></i> ออกจากระบบ</a>
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
                    <li class="active">
                        <a href="index_th.php"><i class="glyphicon glyphicon-home"></i> หน้าหลัก</a>
                    </li>
                    <?php
                        if(isset($_SESSION['username'])){
                        } 
                        else{
                            echo "<li>  <a data-toggle=\"modal\" data-target=\"#myModal\" data-dismiss=\"modal\">
                                        <i class=\"glyphicon glyphicon-lock\"></i> ล็อกอิน</a>
                                 </li>";
                        }
                        ?>
                    <?php      
                    if(isset($_SESSION['username'])){
                            if($_SESSION["group"] == 'user'){
                                echo "<li>
                            <a onclick=\"document.getElementById('id02').style.display='block'\"><i class=\"fa fa-fw fa-edit\"></i>เพิ่มคำศัพท์ใหม่ </a>

                        </li>"; 
                                }
                                else if($_SESSION["group"] == 'admin'){
                                    echo "<li>
                        <a href=\"tables.php\"><i class=\"fa fa-fw fa-edit\"></i>เพิ่มคำศัพท์ใหม่ </a>

                    </li>";
                                    } 
                                }
                                else {
                                        echo "<li>
                            <a data-toggle=\"modal\" data-target=\"#myModal\" data-dismiss=\"modal\">
                                        <i class=\"glyphicon glyphicon-lock\"></i> เพิ่มคำศัพท์ใหม่</a>

                        </li>";   
                                        }
                                        ?>
                    
                    <!-- <li>
                        <a href="forms.html"><i class="fglyphicon glyphicon-user"></i> MyAccount</a>
                    </li> -->
                    <li>
                        <a href="aboutus_th.php"><i class="glyphicon glyphicon-cog"></i> เกี่ยวกับเรา</a>
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
            <h3 class="modal-title" style="text-align:center; padding:15px;">เข้าสู่ระบบ</h3>
        </div>
        <div class="modal-body" style="padding:30px;">   
            <label><b>ชื่อผู้ใช้งาน</b></label>
            <input type="text" class="form-control" placeholder="กรอกชื่อผู้ใช้งาน" name="username" id="username" required><br/>
            <label><b>รหัสผ่าน</b></label>
            <input type="password" class="form-control" placeholder="กรอกรหัสผ่าน" name="password" id="password" required>
            <button id="login" class="gbutton" type="submit" style="margin-top:10px;">เข้าสู่ระบบ</button>
            <div style="display:inline-block; width:100%;">
                <input type="checkbox" checked="checked">จดจำไว้ 
                <a href="#" style="float:right;">ลืมรหัสผ่าน?</a>
            </div>
            <hr style="margin:10px 10px 10px 10px;">                                         
            <center style="margin:15px;"><label>ลงทะเบียนบัญชีผู้ใช้&nbsp;</label><a data-toggle="modal" data-target="#Regis"  data-dismiss="modal"  style="font-color:blue;">เข้าร่วม</a></center>
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
                <h3 class="modal-title" style="text-align:center;  padding-top: 10px; padding-bottom:5px;">ยินดีต้อนรับ</h3>
                 <label style="text-align:center; padding:5px 15px 5px 15px; width:100%;">เมื่อคุณเข้ามาเป็นสมาชิก คุณสามารถเข้าใช้งานระบบได้อย่างมีประสิทธิภาพมากขึ้น</label>
      </div>
      <div class="modal-body" style="padding:30px;">
        <label><b>ชื่อ-นามสกุล</b></label><br/>
        <input class="form-control col-lg-6 col-xs-12" type="text" placeholder="กรอกชื่อ" id="fname" name="fname" required>
        <!-- <span id="fnameER"></span><br/> -->
        <input class="form-control col-lg-6 col-xs-12" type="text" placeholder="กรอกนามสกุล" id="lname" name="lname" required>
        <!-- <span id="lnameER"></span><br/> -->
        <label><b>ชื่อผู้ใช้งาน</b></label><br/>
        <input type="text" class="form-control col-lg-6 col-xs-12" placeholder="กรอกชื่อผู้ใช้งาน" id="usernameReg" name="usernameReg" required>
        <!-- <span id="usernameER"></span><br/> -->
        <label><b>อีเมล์</b></label><br/>
        <input type="email" class="form-control col-lg-6 col-xs-12" placeholder="กรอกอีเมล์" id="emailReg" name="emailReg" required>
        <!-- <span id="emailER"></span><br/> -->
        <label><b>รหัสผ่าน</b></label><br/>
        <input type="password" class="form-control col-lg-6 col-xs-12" placeholder="กรอกรหัสผ่าน" id="passwordReg" name="passwordReg" required>
        <!-- <span id="passwordER"></span><br/> -->
        <label><b>ยืนยันรหัสผ่าน</b></label><br/>
        <input type="password" class="form-control col-lg-6 col-xs-12" placeholder="ยืนยันรหัสผ่าน" name="conpasswordReg" id="conpasswordReg" required>
        <!-- <span id="conpasswordER"></span><br/> -->
        <button class="gbutton" type="submit" id="subReg" style="margin-top:10px;">ลงทะเบียน</button>
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
                <h3>เพิ่มคำศัพท์ใหม่</h3>
                <span onclick="document.getElementById('id02').style.display='none'" style="margin-top: -50px;margin-right:15px;width:50px; " class="close" title="Close Modal">&times;</span>                    
            </div>      
        </div>
        <div class="container" style="padding: 16px; margin-left: 50px;">
            <label><b>คำศัพท์ใหม่</b></label>
            <input id="rudeword" name="rudeword" type="text" placeholder="กรอกคำศัพท์ใหม่" required >
            <button type="submit" style="background-color: #4CAF50; width: 90px; color: white; padding: 14px 20px; margin: 8px 0; border: none; cursor: pointer;">OK</button>
        </div>  
    </form>
</div>


       

                <!-- Page Heading -->
                 <div id="page-wrapper" style="height: 750px;">

                    <div class="col-xs-12">
                        <h3 style="margin:10px;">ตรวจสอบคำหยาบ</h3>
                        <div class="panel panel-default"  style="background: none;">
                            <div class="panel-body">
                                <!-- <form method="post"> -->
                                <div  class="col-xs-12 col-lg-6 col-md-6">
                                    <button class="submit" value="sent" id="senttext"
                                        style="border:1px solid black; margin-right:-15px; float:right; margin-top:auto; font-size:18px; width:auto; color:black;">SUBMIT
                                    </button>
                                 </div>
                                
                                <div class="col-xs-12 col-md-12 col-lg-6" style="width:100%; padding:5px;">
                                    <?php
                                    if( $_POST){
                                         if($_SERVER["HTTP_REFERER"] == "http://localhost:81/DID-master/history_th.php"){
                                        //var_dump($_POST);
                                        $strSQL = "SELECT inputText FROM history WHERE id = '".trim($_POST['myid'])."' ";
                                        $result = mysqli_query($con,$strSQL);
                                        $data ="";
                                        while($row = mysqli_fetch_array($result)){
                                            $data = $row['inputText'];
                                        }

                                            echo "<textarea class=\"col-xs-12 col-md-6 col-lg-6\" rows=\"16\" id=\"text_to_segment\" name=\"text_to_segment\" style=\"resize:none; padding:10px;\">".$data."</textarea>";
                                         }
                                       } else {

                                            echo "<textarea class=\"col-xs-12 col-md-6 col-lg-6\" rows=\"16\" id=\"text_to_segment\" name=\"text_to_segment\" style=\"resize:none; padding:10px;\"></textarea>";
                                        }
                                    ?>
                                    
                                    <div class="col-xs-12 col-md-6 col-lg-6" id="box" style="float:right; min-height:343px; border: solid gray 1px; background-color:#E6E6E6; padding:5px;">
                                        <p id="one" style="font-weight: bold; font-size: 16px;">ประโยค:  </p><p id="full"></p></br>
                                        <p id="two">คำหยาบ:  </p><p id="rude"></p></br>
                                        <!-- <p id="three">คำผิด:  </p><p id="wrong"></p><br>-->
                                        <p id="four">เวลา:  </p> <p id="time"></p><br>
                                        <p id="five">อัตราส่วนคำหยาบ: </p>
                                        <div class="progress">
                                          
                                          <div id="barPro" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span id="textPercen"></span>
                                          </div>
                                        </div>
                                         
                                    </div>
                                    <!-- /#box -->
                                </div>
                                <!-- row -->
                                    <!-- </form> -->

                                
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script>
    $("#selectLang").change(function(){
        if($(this).val() == '1')
            window.location = 'index.php';
        else if($(this).val() == '2')
            window.location = 'index_th.php';
    });
        $(document).ready(function(){
            $("#one").hide();
            $("#two").hide();
            //$("#three").hide();
            $("#four").hide();
            $("#five").hide();
            $(".progress").hide();
            
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
                        //alert("Login Successfully.");
                        //window.location.reload();
                        window.location = 'index_th.php';
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

            $("#senttext").click(function(){
                //alert("dsd");
                
                $.post("run.php",
                {
                  text_to_segment: $('#text_to_segment').val()
                },
                function(data,status){
                   console.log(data);
                   $obj = JSON.parse(data);
                   //console.log($obj);
                   var tmp = "";
                   var found = 0;
                   var count = 0;
                   var percentage = 0;
                   //console.log($obj.full_text);
                   var allText = $obj.full_text.length;
                   for(var i=0; i<$obj.full_text.length; i++){
                      for(var j = 0; j<$obj.rudeword.length; j++) {
                        if($obj.full_text[i] == $obj.rudeword[j]){
                          found = 1;
                          $.post("usedWordDB.php",
                          {
                            usedRude: $obj.rudeword[j]
                          },
                          function(data,status){
                            console.log(data);
                            $obj = JSON.parse(data);

                          });
                        }
                      }
                      if (found == 1){
                        tmp = tmp + " |" + "***";
                         found=0;
                         count++;
                      }
                      else{
                        tmp = tmp + "|" + $obj.full_text[i];
                        //console.log($obj.full_text[i]);
                      }
                   }
                   percentage = ((count/allText)*(100));
                   //console.log(allText);
                   //console.log(count);
                   console.log(percentage);
                   if(percentage<26){
                    $("#barPro").attr("class","progress-bar progress-bar-success");
                   }
                   else if(percentage>25 && percentage<51){
                    $("#barPro").attr("class","progress-bar progress-bar-info");
                   }
                   else if(percentage>50 && percentage<76){
                    $("#barPro").attr("class","progress-bar progress-bar-warning");
                   }
                   else if(percentage>75 && percentage<101){
                    $("#barPro").attr("class","progress-bar progress-bar-danger");
                   }
                   $("#barPro").css("width",percentage+"%");
                   $(".progress").show();
                   $("#five").show();
                   $("#textPercen").text(percentage+"%");
                   $("#one").show();
                   $("#full").text(tmp);
                   $("#two").show();
                   $("#rude").text($obj.rudeword);
                   //$("#three").show();
                   //$("#wrong").text($obj.wrongword);
                   $("#four").show();
                   $("#time").text($obj.time);
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
                    alert("มีชื่อผู้ใช้ในระบบแล้ว!!");
                    //document.getElementById("usernameER").innerHTML = "Username already exists!!";
                    //document.getElementById("usernameReg").style.backgroundColor="red";
                    //$("#usernameReg").attr("placeholder","Username already exists!!");
                    //document.getElementById('subReg').style.display = 'none';
                  }
                  if($obj.error[6] == 1){
                    //alert("Please Input All Box!!!");
                    $("#conpasswordReg").attr("placeholder","รหัสผ่านไม่ตรงกัน!!");
                    //$("#conpasswordReg").attr("value","Password Not Match!!");
                    alert("รหัสผ่านไม่ตรงกัน!!");

                  }
                  
                    if($obj.error[0] == 1){
                        //alert("username");
                        //document.getElementById("usernameER").innerHTML = "Please Input Username!!";
                        $("#usernameReg").attr("placeholder","กรอกชื่อผู้ใช้งาน!!");
                        //document.getElementById("usernameReg").style.backgroundColor="red";
                        //document.getElementById('subReg').style.display = 'none';
                    }
                    if($obj.error[1] == 1){
                        //alert("fname");
                        $("#fname").attr("placeholder","กรอกชื่อ!!");
                        //document.getElementById("fnameER").innerHTML = "Please Input First Name!!";
                        //document.getElementById("fname").style.backgroundColor="red";
                        //document.getElementById('subReg').style.display = 'none';
                    }
                    if($obj.error[2] == 1){
                        //alert("lname");
                        //document.getElementById("lnameER").innerHTML = "Please Input Last Name!!";
                        $("#lname").attr("placeholder","กรอกนามสกุล!!");
                        //document.getElementById("lname").style.backgroundColor="red";
                        //document.getElementById('subReg').style.display = 'none';
                    }
                    if($obj.error[3] == 1){
                        //alert("password");
                        //document.getElementById("passwordER").innerHTML = "Please Input Password!!";
                        $("#passwordReg").attr("placeholder","กรอกรหัสผ่าน!!");
                        //document.getElementById("passwordReg").style.backgroundColor="red";
                        //document.getElementById('subReg').style.display = 'none';
                    }
                    if($obj.error[4] == 1){
                        //alert("Confirm-Password");
                        //document.getElementById("conpasswordER").innerHTML = "Please Input Confirm-Password!!";
                        $("#conpasswordReg").attr("placeholder","ยืนยันรหัสผ่าน!!");
                        //document.getElementById("conpasswordReg").style.backgroundColor="red";
                        //document.getElementById('subReg').style.display = 'none';
                    }
                    if($obj.error[5] == 1){
                        //alert("email");
                        //document.getElementById("emailER").innerHTML = "Please Input Email!!";
                        $("#emailReg").attr("placeholder","กรอกอีเมล์!!");
                        //document.getElementById("emailReg").style.backgroundColor="red";
                        //document.getElementById('subReg').style.display = 'none';
                    }
                  else if($obj.dubUsername== 0 && $obj.OK == true) {
                    //alert('Register Successfully!!');
                    window.location = 'index_th.php';
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
