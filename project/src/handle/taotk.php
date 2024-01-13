<?php
require_once '../handle/helper.php';
if(checkRequest($_POST, ['user', 'password', 'quyen'])) {
    if(count($_POST['password'])< 8) {
        header("Location: ../page/taotk.php?status=300&message=Mật khẩu yếu");
    }
    $sql = "INSERT into taikhoan(user, pass, quyen, tinhtrang) values(?, ?, ?, ?)";
    $result = query_input($sql, [$_POST['user'], $_POST['password'], covint($_POST['quyen']), 14]);
    if($result) {
        $sql = "SELECT count(*) from taikhoan where user = ? and pass =?";
        $check = query_input($sql, [$_POST['user'], $_POST['password']]);
        if($check->num_rows == 1) {
            header("Location: ../page/taotk.php?status=200&message=Tạo thành công tài khoản". $_POST['user']);
        }else {
            header("Location: ../page/taotk.php?status=300&message=Tạo thất bại");
        }
    }else {
        header("Location: ../page/taotk.php?status=400&message=Có lỗi trong quá trình tạo");
    }

}else {
    header("Location: ../page/taotk.php?status=400&message=Thông tin không đầy đủ");
}
?> 