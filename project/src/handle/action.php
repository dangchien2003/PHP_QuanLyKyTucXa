<?php
require_once 'helper.php';
if(checkRequest($_GET, ['user', 'action'])) {
    $tinhtrang = 0;
    if($_GET["action"] == 'unlock') {
        $tinhtrang = 15;
        $_GET['action'] = "mở khoá";
    }else if($_GET["action"] == 'lock') {
        $tinhtrang = 14;
        $_GET['action'] = "khoá";
    }else {
        header("Location: ../page/dstaikhoan.php?status=300&message=Không có yêu cầu");
        exit();
    }

    if($tinhtrang) {
        $sql = "UPDATE taikhoan set tinhtrang = ? where user = ?";
        $result = query_input($sql, [$tinhtrang, $_GET['user']]);
        if($result) {
            header("Location: ../page/dstaikhoan.php?status=200&message=".strtoupper($_GET['action'])." thành công tài khoản ".$_GET['user']);
        }else {
            header("Location: ../page/dstaikhoan.php?status=400&message=Cập nhật thất bại");
        }
    }
}else {
    header("Location: ../page/dstaikhoan.php?status=400&message=Thông tin không xác định");
}
?> 