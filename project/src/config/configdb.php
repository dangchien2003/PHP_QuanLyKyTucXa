<?php
    function connectDB(){
        $svn = "localhost";
        $usv = "root";
        $psv = "";
        $dbsv = "php_qlkytucxa";
        $GLOBALS['conn'] = new mysqli($svn, $usv, $psv, $dbsv);
        if($GLOBALS['conn']->connect_error) {
            header("location ../page/dangnhap.php?status=400&message=Lỗi server");
        }
    }

    function get_key() {
        return "key";
    }

    function get_IV() {
        return "1234567890987654";
    }
?> 
