<?php
require('dbConnect.php');

if(isset($_GET['Eid'])){
    $id=$_GET['Eid'];
    $qry=mysqli_query($link,"Select * from tblexperiment where EId='$id'");
    $row=mysqli_fetch_assoc($qry);
    $title=$row['ExpTitle'];
    $file=$row['ExpFile'];
}

if(isset($_POST['btncancel'])){
    header("Location:Index.php");
}
//if(!isset($_SESSION['UserID'])){
//    header("Location:Login.php");
//}

if(isset($_POST["btnedit"])) {

    echo $id;
    $title = $_POST['title'];
    $date = date('Y-m-d H:i:s');
    $status = 'Not Assign';
    $filename = mysqli_real_escape_string($link, $_FILES['files']['name']);
    $fileData = mysqli_real_escape_string($link, file_get_contents($_FILES['files']['tmp_name']));
    $filetype = mysqli_real_escape_string($link, $_FILES['files']['type']);

    $query = mysqli_query($link, "Update tblexperiment set ExpTitle='$title',ExpDate='$date',ExpFile='$fileData',Status='$status',ExpFileName='$filename' where EId='$id'");
    header('Location:Index.php');
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
                                            <input type="text" class="form-control"  name="title" value="<?php echo $title ?>"  placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">File</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="files"  class="form-control btn btn-default" ></input>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" name="btnedit"  value="submit" class="btn btn-primary"/>
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



