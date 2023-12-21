<?php
    function connectDB(){
        $svn = "localhost";
        $usv = "root";
        $psv = "";
        $dbsv = "php_qlkytucxa";
        $GLOBALS['conn'] = new mysqli($svn, $usv, $psv, $dbsv);
        if($GLOBALS['conn']->connect_error) {
            die("Kết nối database không thành công") ;
        }
    }
    // tạo file cùng cấp có tên configdb.php sau đó dán đoạn mã này và thay đổi thông tin đúng với cấu hình máy
?> 

