<?php
require('dbConnect.php');


if(isset($_GET['id'])){
    $_id=$_GET['id'];
    $qry=mysqli_query($link,"Select * from tblexperiment where EId='$_id'");
    $row=mysqli_fetch_assoc($qry);
    $ttl=$row['ExpTitle'];
    $asgn1=$row['Assign1'];
    $asgn2=$row['Assign2'];
}

if(isset($_GET['iD'])){
    session_destroy();
    header("Location:Login.php");
}

if(isset($_POST['btncancel'])){
    header('Location:Admin.php');
}

if(isset($_POST["btnsave"])) {
    $_id;
    $title = $_POST['title'];
    $date = date('Y-m-d H:i:s');
    $status = $_POST['optradio'];
    $ddl1=$_POST['tutor_1'];
    $ddl2=$_POST['tutor_2'];

    $query = mysqli_query($link, "Update tblexperiment set ExpTitle='$title',Assign1='$ddl1',Assign2='$ddl2',Status='$status',AssignedDate='$date' where EId='$_id'");

    if($ddl1!=null) {
        $ddl1Qry = mysqli_query($link, "Select * from tblregister where UserId='$ddl1'");
        $name1=mysqli_fetch_assoc($ddl1Qry);
        $nname=$name1['FirstName'];
        $addname1Qry=mysqli_query($link,"Update tblreport set TeacherName='$nname',UserId='$ddl1' where EId='$_id'");
    }
    if($ddl2!=null){
        $ddl2Qry=mysqli_query($link,"Select * from tblregister where UserId='$ddl2'");
        $name2=mysqli_fetch_assoc($ddl2Qry);
        $nname=$name2['FirstName'];
        $addname1Qry=mysqli_query($link,"insert into tblreport (Eid,TeacherName,UserId) value('$_id','$nname','$ddl2')");
    }


    header('Location:Admin.php');
}



$qry1=mysqli_query($link,"Select * from tblregister where RoleId=2");
$num1=mysqli_num_rows($qry1);

$qry2=mysqli_query($link,"Select * from tblregister where RoleId=2");
$num2=mysqli_num_rows($qry2);

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
            <div class="col-md-5">
                <!-- Logo -->
                <div class="logo">
                    <h1><a href="index.html">Assignment Portal</a></h1>
                </div>
            </div>
            <div class="col-md-5">

            </div>
            <div class="col-md-2">
                <div class="navbar navbar-inverse" role="banner">
                    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                            <a href="Assign.php?iD=$row['EId']" >Logout <b class="glyphicon glyphicon-log-out"></b></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <!--<a class="btn default" data-toggle="modal" href="#large"> View Demo </a>-->
    <div class="row">
        <div class="col-md-2">
            <div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li><a href="Admin.php"><i class="glyphicon glyphicon-check"></i> Admin Manage</a></li>
                    <li><a href="AdminView.php"><i class="glyphicon glyphicon-tasks"></i> Assigned</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-12 panel-success">
                    <div class="content-box-header panel-heading">
                        <div class="panel-title ">Welcome to Admin Portal</div>
                        <div class="panel-options">
                            <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                        </div>
                    </div>
                    <div class="content-box-large box-with-header">
                        <div class="content-box-large">
                            <div class="panel-heading">
                                <div class="panel-title">Experiments</div>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Assignment Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="title" value="<?php echo $ttl; ?>" placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Tutor 1</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="tutor1" name="tutor_1" onchange="change_Select(this);">
                                                <option value="" disabled selected>Select Tutor</option>
                                                <?php
                                                if($num1!=0){
                                                    while($row1=mysqli_fetch_assoc($qry1)){
                                                        echo  '<option value="'.$row1["UserId"].'">'.$row1['FirstName']." ".$row1['LastName'].'</option>';
                                                    }
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Tutor 2</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="tutor2" name="tutor_2">
                                                <option value="" disabled selected>Select Tutor</option>
                                                <?php
                                                if($num1!=0){
                                                    while($row2=mysqli_fetch_assoc($qry2)){
                                                        echo  '<option value="'.$row2["UserId"].'">'.$row2['FirstName']." ".$row2['LastName'].'</option>';
                                                        $num1--;
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Assignment Status</label>
                                        <div class="col-sm-10">
                                            <label class="radio-inline">
                                                <input type="radio"  name="optradio" value="Not Assign" checked>Not Assigned
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio"  name="optradio" value="Assigned">Assigned
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" name="btnsave"  value="Save" class="btn btn-primary"/>
                                            <input type="submit" name="btncancel" class="btn btn-primary"  value="Cancel"/>
                                        </div>
                                    </div>
                                </form>
                                <?php mysqli_close($link); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<script type="text/javascript">
    function change_Select(){
        $("#tutor2 option").prop('disable',false);
        var from=$("#tutor1").val();
        var to=$("#tutor2").val();

        $("#tutor2 option").filter(function () {
            return $(this).val()<from;
        }).prop('disabled',true);
    }
</script>
