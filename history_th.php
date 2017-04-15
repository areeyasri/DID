<?php 
session_start();
require_once('connectSQL.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>History - Inappropriate Words Detection</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
 input[type=text], input[type=password] {
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
}

#custom-search-input{
    padding: 2px;
    border: solid 1px #E4E4E4;
    border-radius: 6px;
    background-color: #fff;
}

#custom-search-input input{
    border: 0;
    box-shadow: none;
}

#custom-search-input button{
    margin: 2px 0 0 0;
    background: none;
    box-shadow: none;
    border: 0;
    color: #666666;
    padding: 0 8px 0 10px;
    border-left: solid 1px #ccc;
}

#custom-search-input button:hover{
    border: 0;
    box-shadow: none;
    border-left: solid 1px #ccc;
}

#custom-search-input .glyphicon-search{
    font-size: 23px;
}



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

.hisdoc
{   background-color: white;
    border:0px solid black;
    height:172px;
    width:140px;
    padding: 10px;
    box-shadow: 1px 1px 10px 1px #888888;
    margin:0px 10px 0px 10px;
}
.hisdoc:hover
{
 box-shadow: 2px 2px 10px 3px #888888;

}
.hisdoc-content
{
    overflow: hidden;
    height: 141px;
    font-size: 11px;
    line-height: 15px;
}

.hisdoc-title{
    //font-weight: bold;
    line-height: 17px;
    margin-bottom: 3px;
    font-size: 14px;
    font-weight: 700;
}

.hisdoc-footer
{
display: flex;
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
                <!-- <select id="selectLang" style="margin-left: 535px; margin-top: 15px;">
                    <option value="1">English (en)</option>
                    <option value="2" selected="selected">Thai (th)</option>
                </select> -->

            <div class="navbar-header">
                <p style="font-size: 18px; margin-left: 710px; margin-top: 12px;"><a href="history.php">EN</a>/<a href="history_th.php">TH</a></p>
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                        <?php
                           if(isset($_SESSION['username'])){
                                echo $_SESSION['username'];
                            } else{
                                echo "ล็อกอิน";
                            }
                        ?> 
                    <b class="caret"></b></a>
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
                            
                        }else {
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

        <div id="page-wrapper" style="height:750px;">
                <!-- Page Heading -->
<div class="row"> 
   <div class= "col-md-2 col-xs-12">
          <i class="glyphicon glyphicon-globe fa-2x" ><div style=" margin-left:0px; font-size:16px; display:inline-block;">ประวัติการใช้งาน</div></i>
    </div>
        <div class="col-md-3 col-xs-12" style="margin-top: 10px;">
            <div id="custom-search-input" >
                <div class="input-group col-md-12">
                    <input type="text" class="form-control input-lg" style="height: 20px; padding: 0px;" placeholder="ค้นหา" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
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


                    <form id="myform" method="post" action="index_th.php">
                        <div class="panel panel-default" style="background: none; padding: 15px; height: 650px;">

                        <div class="breadcrumb" style="background-color:#FAFAFA;">
                            <a href="index_th.php"><i class="fa fa-file" style="margin-right: 5px;"></i>ตรวจสอบงานใหม่</a>  
                        </div>
                        <?php
                            $strSQL = "SELECT * FROM history WHERE user_id = '".$_SESSION['user_id']."' ";
                            $result = mysqli_query($con,$strSQL);
                            $i = 0;
                            while($row = mysqli_fetch_array($result)){
                                echo "<div class=\"hisdoc\" style=\"float:left; margin-top:10px;\" onClick=\"myHistory(".$row['id'].")\">";
                                echo "<div class=\"hisdoc-content\">".$row['inputText']."</div></div>";
                            }

                        ?>
                          <input type="hidden" id="myid" name="myid" />
                        </div> <!-- /.panel panel-default -->
                    </form>
                
            
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    $("#selectLang").change(function(){
        if($(this).val() == '1')
            window.location = 'history.php';
        else if($(this).val() == '2')
            window.location = 'history_th.php';
    });
        function myHistory(inputId) {
            $("#myid").val(inputId);
            $("#myform").submit();
            
           
        }

        $("#logout").click(function(){
                //console.log('logout');
                $.post("logout.php",{
                  username: $('#username').val()
                },
                function(data,status){
                  window.location = 'index_th.php';
                });
            });

    </script>

</body>

</html>
