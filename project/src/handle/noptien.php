<?php
include('../config/configdb.php');
include('checkAccount.php');
$error = false;
if (checkRequest($_GET, ['hoadon', 'mahd'])) {
    $table = "";
    switch ($_GET['hoadon']) {
        case "diennuoc":
            $table = "hoadondiennuoc";
            break;
        case "guixe":
            $table = "hoadonguixe";
            break;
        case "phong":
            $table = "hoadonphong";
            break;
        default:
            $error = true;
    }
    // nếu trùng case
    if($table && !$error) {
        $sql = "UPDATE $table set tinhtrang = ? where concat(kyHieu, maHoaDon) = ?";
        $result = query_input($sql, [6, $_GET['mahd']]);
        header("Location: ../page/tthd".$_GET['hoadon'].".php");
    }
} else {
    $error = true;
}
// nếu không có hoặc không phải trường hợp nào 
if($error) {
    header("Location: ../page/403.html");
}


?>