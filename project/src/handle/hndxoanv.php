<?php 
include 'helper.php';
if(checkRequest($_GET, ['id'])) {
    $error = false;
    $sql = "DELETE from nhanvien where id = ?";
    $result = query_input($sql, [$_GET['id']]);
    if(!$result) {
        $error = true;
    }
}else {
    $error = true;
}


if(!$error) {
    header("Location: ../page/dsnv.php?status=200&message=Xoá thành công");
}else {
    header("Location: ../page/thongtinnv.php?status=400&message=Có lỗi xảy ra");
}
?> 