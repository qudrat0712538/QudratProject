<?php
require('dbConnect.php');

if(isset($_GET['iD'])){
    session_destroy();
    header("Location:Login.php");
}

$qry=mysqli_query($link,"SELECT * FROM tblexperiment WHERE tblexperiment.Status='Assigned'");
$num=mysqli_num_rows($qry);

$qry1=mysqli_query($link,"SELECT * FROM tblexperiment WHERE tblexperiment.Status='Assigned'");
$fetchqry1=mysqli_fetch_assoc($qry1);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrator</title>
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
                                <a href="AdminView.php?iD=$fetchqry1['EId']" >Logout <b class="glyphicon glyphicon-log-out"></b></a>
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
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Assigned Date</th>
                                        <th>Experiment File</th>
                                        <th>Tutor 1</th>
                                        <th>Tutor 2</th>
                                        <th>Exp. Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if($num!=0) {
                                        while ($row = mysqli_fetch_assoc($qry)) {
                                            $rr=$row['Assign1'];
                                            $rr1=$row['Assign2'];
                                            $rrr= mysqli_query($link,"select FirstName,LastName from tblregister where UserId='$rr'");
                                            $rfetch=mysqli_fetch_assoc($rrr);
                                            $rrr1=mysqli_query($link,"select FirstName,LastName from tblregister where UserId='$rr1'");
                                            $rfetch1=mysqli_fetch_assoc($rrr1);
                                            echo
                                            "
                                            <tr>
                                                <td>{$row['EId']}</td>
                                                <td>{$row['ExpTitle']}</td>
                                                <td>{$row['AssignedDate']}</td>
                                                <td>{$row['ExpFileName']}</td>
                                                <td>{$rfetch['FirstName']}{$rfetch['LastName']}</td>
                                                <td>{$rfetch1['FirstName']}{$rfetch1['LastName']}</td>
                                                <td>{$row['Status']}</td>
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
