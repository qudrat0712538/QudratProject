<?php

//$link = mysql_connect('localhost','root','');
$link=mysqli_connect('localhost','root','','studentportal');

//$link=mysqli('localhost:8080','root','') or die ('error');
//$link = mysqli_connect('localhost','root','');

if (!$link) {
    die('Could not connect: ' . mysqli_error());
}
//mysqli_select_db("studentportal",$link) or die('could not able to connect db');

?>