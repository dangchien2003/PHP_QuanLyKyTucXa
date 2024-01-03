<?php
include_once '../handle/checkAccount.php';
include_once './helper.php';
if(checkRequest($_POST, ['maphongsv', 'idsv'])) {
    $sql = "update sinhvien set maphong = ? where id = ?";
    $result = query_input($sql, [$_POST['maphongsv'], $_POST['idsv']]);
    if(!$result) {
        header("location: ../page/thongtinp.php?status=400&message=Cập nhật thất bại&maphong=".$_GET['maphong']);
    }else {
        header("location: ../page/thongtinp.php?status=200&message=Cập nhật thành công&maphong=".$_GET['maphong']);
    }
}
?> 