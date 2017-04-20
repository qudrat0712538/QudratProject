<?php
require 'dbConnect.php';

if(isset($_SESSION['UID'])){
    session_destroy();
}
session_start();

if(isset($_POST["btnlogin"])){
    $email=$_POST['email'];
    $pwd=$_POST['pwd'];

    $query=mysqli_query($link,"Select * from tblregister where Email='$email' and Password='$pwd'");

    $row=mysqli_num_rows($query);
    if($row==1){
        $rr=mysqli_fetch_assoc($query);
        echo $roleid=$rr["RoleId"];
        $userid=$rr["UserId"];
        $_SESSION['UID']=$userid;
        if(isset($_SESSION['UID'])){
            if($roleid==1){
                header("Location:Index.php");
            }
            elseif($roleid==3){
                header("Location:Admin.php");
            }
            elseif ($roleid==2){
                header("Location:Tutor.php");
            }
        }
    }
    else
    {
        echo '<script language="javascript">';
        echo 'alert("No Such User Exist.")';
        echo '</script>';
    }
    mysqli_close($link);
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="Css/styles.css">
    <script src="Scripts/jquery-3.2.0.min.js"></script>
    <script src="Bootstrap/js/bootstrap.min.js"></script>
    <script src="Scripts/custom.js"></script>
    <link rel="stylesheet" href="Css/table/dataTables.bootstrap.css">
    <script src="Scripts/table/jquery.dataTables.min.js"></script>
    <script src="Scripts/table/dataTables.bootstrap.js"></script>
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="Scripts/tables.js"></script>
</head>
<body>
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Logo -->
                <div class="logo">
                    <h1><a href="index.html">Assignment Portal</a></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-wrapper">
                <div class="box">
                    <div class="content-wrap">
                        <form method="post">
                        <h6>Sign In</h6>

                        <input class="form-control" name="email" type="text" placeholder="E-mail address">
                        <input class="form-control" name="pwd" type="password" placeholder="Password">
                        <div class="action">
                           <input type="submit" class="btn btn-primary signup" name="btnlogin" value="Login"/>
                        </div>
                        </form>
                    </div>
                </div>

                <div class="already">
                    <p>Don't have an account yet?</p>
                    <a href="Register.php">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
</div>




</body>
</html>