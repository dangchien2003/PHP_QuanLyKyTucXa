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

    function get_key() {
        return "key";
    }

    function get_IV() {
        return "1234567890987654";
    }
?> 
