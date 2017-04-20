<?php
require('dbcon.php');

if(isset($_GET['id'])){
    $_idd= $_GET['id'];

//    $qrry= mysqli_query($link,"Select * from tblreport where RepId='$_idd'");
//    $ftch=mysqli_fetch_assoc($qrry);
//
//    echo $ftn=$ftch['FirstStatus'];

}

if(isset($_POST['btncancel'])){
    header("Location:Tutor.php");
}


if (isset($_POST["btnsubmit"])) {
            $title = $_POST['title'];
            $status1 = $_POST['status'];
            $cmnt1 = $_POST['cmnt'];

            $query = mysqli_query($link, "Update tblreport set TeacherStatus='$status1',Comment='$cmnt1' where RepId='$_idd'");


            echo '<script language="javascript">';
            echo 'alert("File Updated Successfully.")';
            echo '</script>';

    header('Location:Tutor.php');
}
$qry=mysqli_query($link,"Select * from tblreport,tblexperiment where tblexperiment.EId=tblreport.EId and RepId='$_idd'");
$row=mysqli_fetch_assoc($qry);


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

                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
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
                                <form class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Assignment Title</label>
                                        <div class="col-sm-10">
                                            <input type="text"  class="form-control" value="<?php echo $row['ExpTitle'] ?>" name="title" placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Stats</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="status">
                                                <option value="" disabled selected>Select Status</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Not Approved">Not Approved</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Comment</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="cmnt" placeholder="Comment">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" name="btnsubmit"  value="submit" class="btn btn-primary"/>
                                            <input type="submit" name="btncancel" class="btn btn-primary" value="Cancel"/>
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
