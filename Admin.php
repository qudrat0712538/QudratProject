<?php
require('dbcon.php');
session_start();
if(!isset($_SESSION['UID'])){
    header("Location:Login.php");
}
$userid= $_SESSION['UID'];

if(isset($_GET['iD'])){
    session_destroy();
    header("Location:Login.php");
}

if(isset($_POST["btnsave"])) {
    echo '<script language="javascript">';
    echo 'alert("File Uploaded Successfully.")';
    echo '</script>';
}
$qry=mysqli_query($link,"Select * from tblexperiment where Status='Not Assign'");
$num=mysqli_num_rows($qry);

$qry1=mysqli_query($link,"Select * from tblregister where RoleId=2");
$num1=mysqli_num_rows($qry1);

$qry2=mysqli_query($link,"Select * from tblregister where RoleId=2");
$num2=mysqli_num_rows($qry2);

$qry3=mysqli_query($link,"Select * from tblexperiment where Status='Not Assign'");

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
                                <?php $qrryqry=mysqli_fetch_assoc($qry3); ?>
                                <a href="Admin.php?iD=$qrryqry['EId']" >Logout <b class="glyphicon glyphicon-log-out"></b></a>
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
                    <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Assign Tutor</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Assignment Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="title" placeholder="Title">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Tutor 1</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="tutor1" name="tutor" onchange="change_Select();">
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
                                            <label class="col-sm-3 control-label">Tutor 2</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="tutor2" name="tutor">
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
                                            <label class="col-sm-3 control-label">Assignment Status</label>
                                            <div class="col-sm-8">
                                                <label class="radio-inline">
                                                    <input type="radio"  name="optradio" value="Not Assigned" checked>Not Assigned
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio"  name="optradio" value="Assigned">Assigned
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <input type="submit" name="btnsave"  value="Save" class="btn btn-primary"/>
                                                <input type="button" id="btncancel" class="btn btn-primary" data-dismiss="modal" value="Cancel"/>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-box-large box-with-header">
                        <div class="content-box-large">
                            <div class="panel-heading">
                                <div class="panel-title">Experiments</div>
                            </div>
                            <div class="panel-body">
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Experiment Date</th>
                                        <th>Experiment File</th>
                                        <th>Exp. Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if($num!=0) {
                                        while ($qrrry=mysqli_fetch_assoc($qry)) {
                                            echo
                                            "
                                            <tr>
                                                <td>{$qrrry['ExpTitle']}</td>
                                                <td>{$qrrry['ExpDate']}</td>
                                                <td>{$qrrry['ExpFileName']}</td>
                                                <td>{$qrrry['Status']}</td>
                                                <td>
                                                    <a href='Assign.php?id={$qrrry['EId']}'>Assign</a>
                                                 </td>
                                            </tr>
                                            ";
                                            $_id=$row1['EId'];
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
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
