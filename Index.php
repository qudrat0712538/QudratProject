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

    $title = $_POST['title'];
    $date = date('Y-m-d H:i:s');
    $status = 'Not Assign';
    $filename = mysqli_real_escape_string($link, $_FILES['files']['name']);
    $fileData = mysqli_real_escape_string($link, file_get_contents($_FILES['files']['tmp_name']));
    $filetype = mysqli_real_escape_string($link, $_FILES['files']['type']);
    $filesize=mysqli_real_escape_string($link,$_FILES['files']['size']);

    $query = mysqli_query($link, "Insert into tblexperiment (ExpTitle,ExpDate,ExpFile,Status,ExpFileName,ExpFileSize,UserId) values ('$title','$date','$fileData','$status','$filename','$filesize','$userid')");

    $exidQry=mysqli_query($link,"Select EId from `tblexperiment` ORDER by EId DESC ");
    $ftch=mysqli_fetch_assoc($exidQry);
    $idd=$ftch['EId'];

    $qqry=mysqli_query($link,"insert into tblreport (EId) VALUE ('$idd')");

    echo '<script language="javascript">';
    echo 'alert("File Uploaded Successfully.")';
    echo '</script>';
}
    $qry=mysqli_query($link,"Select * from tblexperiment where UserId='$userid'  Order by EId DESC");
    $num=mysqli_num_rows($qry);
?>
<?php
if(isset($_GET['id'])){
    $_id=$_GET['id'];
    $delrepQry=mysqli_query($link,"Delete from tblreport where EId='$_id'");
    $delQry=mysqli_query($link,"Delete from tblexperiment where EId='$_id'");
    echo '<script language="javascript">';
    echo 'alert("File Deleted Successfully.")';
    echo '</script>';
    $qry=mysqli_query($link,"Select * from tblexperiment where UserId='$userid'  Order by EId DESC");
    $num=mysqli_num_rows($qry);
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
                                <a href="Index.php?iD=$row['EId']" >Logout <b class="glyphicon glyphicon-log-out"></b></a>
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
                    <li class="current"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li ><a href="indexView.php"><i class="glyphicon glyphicon-list"></i> Report</a></li>
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
                    <div class="modal fade bs-modal-lg" id='large' tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Submit Assignment</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Assignment Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"  name="title" id="title" placeholder="Title">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">File</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="files" class="form-control btn btn-default" ></input>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Assignment Status</label>
                                            <div class="col-sm-9">
                                                <span class="form-control">Not Assigned</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <input type="submit" name="btnsubmit"  value="submit" class="btn btn-primary"/>
                                                <input type="button" id="btncancel" class="btn btn-primary" data-dismiss="modal" value="Cancel"/>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-box-large box-with-header">
                        <div class="row form-group">
                            <div class="col-md-2 col-md-offset-10">
                                <input type="button" class="btn btn-primary form-control" value="Add Assignment" data-toggle="modal" data-target="#large" />
                            </div>
                        </div>
                        <div class="content-box-large">
                            <div class="panel-heading">
                                <h4 class="modal-title">Assignments</h4>

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
                                        while ($row = mysqli_fetch_assoc($qry)) {
                                            echo
                                            "
                                            <tr>
                                                <td>{$row['ExpTitle']}</td>
                                                <td>{$row['ExpDate']}</td>
                                                <td>{$row['ExpFileName']}</td>
                                                <td>{$row['Status']}</td>
                                                <td>
                                                 <!-- <a href='#large' class='open_modal' data-toggle='modal' data-id='{$row['EId']}' data-target='#large'>Edit</a>-->
                                                <a href='myajax.php?Eid={$row['EId']}'>Edit</a>
                                                 <a href='Index.php?id={$row['EId']}'>Delete</a>
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


