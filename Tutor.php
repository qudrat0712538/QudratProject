<?php
require('dbConnect.php');
session_start();
if(!isset($_SESSION['UID'])){
    header("Location:Login.php");
}
$userid= $_SESSION['UID'];

if(isset($_GET['iD'])){
    session_destroy();
    header("Location:Login.php");
}

if(isset($_POST["btnsubmit"])) {
    echo '<script language="javascript">';
    echo 'alert("File Uploaded Successfully.")';
    echo '</script>';
}

$qry=mysqli_query($link,"Select DISTINCT tblreport.RepId,tblreport.Eid,tblexperiment.ExpTitle,tblreport.TeacherName,tblreport.TeacherStatus,tblreport.Comment from tblreport,tblexperiment,tblregister where tblexperiment.EId=tblreport.Eid and tblreport.UserId='$userid'");

$num=mysqli_num_rows($qry);


if(isset($_GET['id'])){
    $iid=$_GET['id'];
    $result=mysqli_query($link,"select * from tblexperiment where EId='$iid'");
    $resultfetch=mysqli_fetch_assoc($result);

    $file=$resultfetch['ExpFile'];
    $filename=$resultfetch['ExpFileName'];
    $filesize=$resultfetch['ExpFileSize'];
    $filetype=$resultfetch['ExpFileType'];

    header("Content-length:$filesize");
    header("Content-type:$filetype");
    header("Content-disposition:attachment; filename=$filename");
    echo $file;


}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Experiment Approval Officer</title>
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
                    <h1><a href="index.html">RGU Assignment Portal</a></h1>
                </div>
            </div>
            <div class="col-md-5">

            </div>
            <div class="col-md-2">
                <div class="navbar navbar-inverse" role="banner">
                    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="Tutor.php?iD=$row['EId']" >Logout <b class="glyphicon glyphicon-log-out"></b></a>

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
                    <li><a href="Tutor.php"><i class="glyphicon glyphicon-list"></i> Tutor Manage</a></li>

                </ul>
            </div>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-12 panel-success">
                    <div class="content-box-header panel-heading">
                        <div class="panel-title ">Welcome to Student Portal</div>
                        <div class="panel-options">
                            <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                        </div>
                    </div>

                    <div class="content-box-large box-with-header">
                        <div class="content-box-large">
                            <div class="panel-heading">
                                <h4 class="modal-title">Assignments</h4>

                            </div>
                            <div class="panel-body">
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Teacher Name</th>
                                        <th>Status</th>
                                        <th>Comment</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if($num!=0) {
                                        while ($row = mysqli_fetch_assoc($qry)) {
                                            echo
                                            "
                                            <tr>
                                                <td>{$row['ExpTitle']}</td>
                                                <td>{$row['TeacherName']}</td>
                                                <td>{$row['TeacherStatus']}</td>
                                                <td>{$row['Comment']}</td>
                                                <td>
                                                <a href='Comment.php?id={$row['RepId']}' class='btn btn-sm btn-primary'>Comment</a>
                                                <a href='Tutor.php?id={$row['Eid']}' class='btn btn-sm btn-primary'>Download</a>
                                                </td>
                                            </tr>
                                            ";
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
