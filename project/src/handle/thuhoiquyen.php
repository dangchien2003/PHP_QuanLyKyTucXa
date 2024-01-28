<?php 
include "helper.php";
if(checkRequest($_GET, ['id'])) {
    $user = null;
    if (!$user && checkRequest($_SESSION, ['account'])) {
        $user = $_SESSION['account']['username'];
    } else if (!$user && checkRequest($_COOKIE, ['account'])) {
        $account = giaiMa($_COOKIE['account']);
        $user = $account['username'];
    }
    if($user) {
        $sql = "update quyentruycap set thoigianthuhoi = ? where userAdmin = ? and id = ?";
        $time = date("Y-m-d H:i:s");
        $result = query_input($sql, [$time, $user, $_GET['id']]);
        if($result) {
            header("Location: ../page/quyencuatoi.php?status=200&message=Đã thu hồi");
        }else {
            header("Location: ../page/quyencuatoi.php?status=400&message=Không thể thu hồi");
        }
    }else {
        header("Location: ../page/dangnhap.php");
    }
}else {
    header("Location: ../page/quyencuatoi.php?status=400&message=Có lỗi xảy ra");
}


?> 