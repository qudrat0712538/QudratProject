<?php
require 'dbConnect.php';

$qry=mysqli_query($link,"select * from tbluserrole");
 echo $num=mysqli_num_rows($qry);

if(isset($_POST["btnRegister"])){
   echo $fname=$_POST['fname'];
 echo  $lname=$_POST['lname'];
  echo  $email=$_POST['email'];
   echo $pwd=$_POST['pwd'];
  echo  $gender=$_POST['optradio'];
  echo  $phone=$_POST['phone'];
  echo  $role=$_POST['role'];

    //$query=mysqli_query($link,"Insert into tblregister (FirstName,LastName,Email,Password,Gender,PhoneNo,RoleId) values ('$fname','$lname','$email','$pwd','$gender','$phone','$role')");
    $query=mysqli_query($link, "Insert into tblregister (FirstName,LastName,Email,Password,Gender,PhoneNo,RoleId) values ('$fname','$lname','$email','$pwd','$gender','$phone','$role')");
    mysqli_close($link);

    echo '<script language="javascript">';
    echo 'alert("Registered Successfully.")';
    echo '</script>';

  //  header("Location:Login.php");
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

<div class="page-content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="row">
                <div class="content-box-large">
                    <div class="panel-heading col-md-8 col-md-offset-4">
                        <div class="panel-title"><h4><b>SIGN UP</b></h4></div>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">First Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm" name="fname" placeholder="First Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Last Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm" name="lname" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control input-sm" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control input-sm" name="pwd" placeholder="Password">
                                </div>
                            </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Gender</label>
                                    <div class="col-sm-8">
                                    <label class="radio-inline">
                                        <input type="radio"  name="optradio" value="Male" checked>Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio"  name="optradio" value="Female">Female
                                    </label>
                                    </div>
                                </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Phone No</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm" name="phone" placeholder="Phone No">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">UserRole</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="tutor1" name="role">
                                        <option value="" disabled selected>Select Role</option>
                                        <?php
                                        if($num!=0){
                                            while($row=mysqli_fetch_assoc($qry)){
                                                echo  '<option value="'.$row["RoleId"].'">'.$row['RoleName'].'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-2">
                                    <input type="submit" name="btnRegister"  value="Sign Up" class="btn btn-primary signup"/>
                                </div>
                                <div class="already col-sm-5">
                                    Have an account already?
                                    <a href="Login.php">Login</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




</body>
</html>