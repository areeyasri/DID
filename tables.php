<?php
    session_start();
    $serverName   = "127.0.0.1:3306";
    $userName     = "root";
    $userPassword     = "";
    $dbName   = "database_web";

    $con = mysqli_connect($serverName,$userName,$userPassword,$dbName) or die("Database Connect Failed : " . mysqli_connect_error());
    //require_once('connectSQL.php');
    mysqli_set_charset($con, "tis-620");
    if(!($_SESSION["group"] == "admin")) 
    {
        header("location:index.php");
    } 
   
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Inappropriate Words Detection</title>

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
<style type="text/css">
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
}

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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                        <?php
                           if(isset($_SESSION['username'])){
                                echo $_SESSION['username'];
                            } else{
                                echo "User";
                            }
                        ?> 
                    <b class="caret"></b></a>
                    <?php
                        if(isset($_SESSION['username'])){
                            if($_SESSION["group"] == 'user'){
                                header("location:index.php");
                            }
                            else if($_SESSION["group"] == 'admin'){
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
                            
                        }else {header("location:index.php");}
                    ?>
                </li>
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="glyphicon glyphicon-home"></i> Home</a>
                    </li>
                    <li>
                        <a href="tables.php"><i class="fa fa-fw fa-edit"></i>Add a new word </a>
                    </li>
                    <li>
                        <a href="aboutus.php"><i class="glyphicon glyphicon-cog"></i> About us</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
            
    <div id="page-wrapper" style="height: 750px;">
        <div class="panel panel-default" style="background: none;">
            <h2 style="margin-left:10px;">Check New words For Admin</h2>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <div class="table-responsive" style="margin:10px;">
                            <table class="table table-bordered table-hover table-striped" style="background-color: white; ">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th width="50%">Word</th>
                                        <th width="30%">Username</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $strSQL = "SELECT * FROM newrudeword, users where newrudeword.user_id = users.user_id";
                                        $result = mysqli_query($con,$strSQL);
                                        while($row = mysqli_fetch_array($result)){
                                            echo 
                                            "<tr>
                                                <form method=\"post\">
                                                <td>".$row['newword_id']."</td>
                                                <td><input type='text' disabled value='".$row['newword']."' id=\"_".$row['newword_id']."\"/></td>
                                                <td>".$row['username']."</td>
                                                <td><button class=\"glyphicon glyphicon-ok\" style=\"margin: 0px 2px 0px 2px; padding:2px 5px 2px 5px;\"></button>
                                                <button class=\"glyphicon glyphicon-trash\" style=\"margin: 0px 2px 0px 2px; padding:2px 5px 2px 5px;\"></button>
                                                <button id=\"pencil\" class=\"glyphicon glyphicon-pencil\" style=\"margin: 0px 2px 0px 2px; padding:2px 5px 2px 5px;\" onclick=\"editMyWord(".$row['newword_id'].")\"></button></td></form>
                                            </tr>";
                                            }
                                        ?>          
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div> 
        <!-- .panel-body -->
        </div>
    </div>

    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script>
         function editMyWord(param){
            $("#_"+param).prop('disabled', false);
         }

        $("#logout").click(function(){
                //console.log('logout');
                $.post("logout.php",{
                  username: $('#username').val()
                },
                function(data,status){
                  window.location = 'index.php';
                });
            }); 
    </script>

</body>

</html>
