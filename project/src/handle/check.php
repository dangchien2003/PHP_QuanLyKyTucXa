<?php
include 'helper.php';
function checkAccount($user, $password, $info) {
    $sql = "";
    if(!$info) {
        $sql = "select * from taikhoan where user=? and pass = ?";
    }else {
        $sql = "select nhanvien.anh, nhanvien.hoTen, nhanvien.chucVu from taikhoan JOIN nhanvien on nhanvien.user = taikhoan.user where taikhoan.user = ? and taikhoan.pass = ?;";
    }
    $result = query_input($sql, [$user, $password]);
    
    if($result->num_rows == 1) {
        // trả về dữ liệu nếu cần thông tin
        if($info) {
            return $result;
        }else {
            return true;
        }
    }else {
        return false;
    }
}

?> 