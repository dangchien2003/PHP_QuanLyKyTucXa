<?php 
include 'helper.php';
include 'checkAccount.php';
$error = false;
$message = "";
print_r($_POST);
if(checkRequest($_POST,['indata', 'quyen'], true)) {
    $sql = "UPDATE url set indata = ?, quyen = ? where id = ?";
    $result = query_input($sql, [covint($_POST['indata']), covint($_POST['quyen']), $_POST['id'],]);
    if(!$result) {
        $error = true;
        $message = "Lỗi sửa url";
    }
}else {
    $error = true;
    $message = "Thiếu thông tin";
}
// die();
if(!$error) {
    header("Location: ../page/ttlienket.php?status=200&message=Sửa thành công&id=".$_POST['id']);
}else {
    header("Location: ../page/ttlienket.php?status=400&message=$message&id=".$_POST['id']);
}
?> 