<?php
require_once '../handle/helper.php';
if(checkRequest($_POST, ['user', 'password', 'nv'])) {
    $sql = "INSERT into taikhoan(user, pass, tinhtrang, quyen) values(?, ?, ?, ?)";

}else {
    header("Location: ../page/taotk.php?status=400&message=Thông tin không đầy đủ");
}
?> 