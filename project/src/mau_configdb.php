<?php
    $svn = "localhost";
    $usv = "root";
    $usv = "";
    $usv = "dbbanhang";
    $conn = new mysqli($svn, $usv, $usv, $usv);
    if($conn->connect_error) {
        die("Kết nối database không thành công") ;
    }
?> 