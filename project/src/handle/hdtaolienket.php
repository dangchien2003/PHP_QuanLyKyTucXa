<?php 
include 'helper.php';
include 'checkAccount.php';
$error = false;
$message = "";
print_r($_POST);
if(checkRequest($_POST,['namefile', 'indata', 'quyen'], true)) {
    $sql = "INSERT into url(url, indata, quyen) values(?, ?, ?)";
    $result = query_input($sql, [$_POST['namefile'], covint($_POST['indata']), covint($_POST['quyen'])]);
    if(!$result) {
        $error = true;
        $message = "Lỗi tạo mới";
    }
}else {
    $error = true;
    $message = "Thiếu thông tin";
}
// die();
if(!$error) {
    header("Location: ../page/dslienket.php?status=200&message=Tạo thành công");
}else {
    header("Location: ../page/taolienket.php?status=400&message=$message");
}
?> 