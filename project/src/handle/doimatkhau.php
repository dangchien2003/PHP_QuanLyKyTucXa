<?php
require_once 'helper.php';
session_start();
try {
    if(checkRequest($_POST, ['password', 'username', 'newpassword', 'passwordcomfirm'])) {
        $user = "";
        // kt mật khẩu mới trùng  nhau
        $check = true;
        // kiểm tra có session hay không
        if(checkRequest($_SESSION, ['account'])) {
            // kt username session và post khác nhau
            if($_POST['username'] != $_SESSION['account']['username']) {
                $check = false;
                header("location: ../page/thongtincanhan.php?message=Đổi mật khẩu thất bại&status=400");
            }
        }else if(checkRequest($_COOKIE, ['account'])) { // kiểm tra có cookie hay không
            $account = giaiMa($_COOKIE['account']);
            // kt username cookie và post khác nhau
            if($_POST['username'] != $account['username']) {
                $check = false;
                header("location: ../page/thongtincanhan.php?message=Đổi mật khẩu thất bại&status=400");
            }
        }else { // nếu tất cả không có thì quay về đăng nhập
            $check = false;
            header("location: ../page/dangnhap.php?message=Có lỗi xảy ra&status=400");
        }
        // nếu kiểm tra ok
        if($check) {
            // nếu mật khẩu cũ và mới trùng nhau
            if($_POST['password'] == $_POST['newpassword']) {
                header("location: ../page/thongtincanhan.php?message=Đổi mật khẩu thất bại&status=300");
            }else {
                // kt mật khẩu mới và cũ trùng nhau
                if($_POST['passwordcomfirm'] == $_POST['newpassword']) {
                    $sql = "UPDATE taikhoan set pass = ? WHERE user = ? and pass = ?";
                    $result = query_input($sql, [$_POST['passwordcomfirm'], $_POST['username'], $_POST['password']]);
                    // kiểm tra kq
                    if($result) {
                        header("location: ../page/thongtincanhan.php");
                    }else {
                        header("location: ../page/thongtincanhan.php?message=Đổi mật khẩu thất bại&status=300");
                    }
                }else {
                    header("location: ../page/thongtincanhan.php?message=Đổi mật khẩu thất bại&status=300");
                }
            }
        }
    }else {
        header("location: ../page/thongtincanhan.php?message=Đổi mật khẩu thất bại&status=300");
    }
}catch(Exception $e) {
    log_error($e->getMessage());
    header("location: ../page/thongtincanhan.php?message=Đổi mật khẩu thất bại&status=400");
}

?> 