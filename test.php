<?php
    require 'dbcon.php';
        $query = mysqli_query($link, "Select * from tblexperiment where Eid=9");
        mysqli_close($link);
        echo $rr = mysqli_num_rows($query);
        while ($row = mysqli_fetch_assoc($query)) {
            $imageData = $row["ExpFile"];
        }
        //header("content-type: application/msword");
        //header("content-type: image/jpeg");
?>
<img src="<?php $imageData; ?>"/>
