<?php
include 'helper.php';
if (checkRequest($_POST, ['id'])) {
    $sql = "UPDATE quyentruycap set thoigianthuhoi = ? where id = ?";
    $result = query_input($sql, [date("Y-m-d H:i:s"), $_POST['id']]);
    if ($result) {
        echo respone(200, "Đã huỷ");
        exit();
    }else {
        echo respone(505, "Không thể huỷ");
        exit();
    }
}else {
    echo respone(500, "Có lỗi");
    exit();
}
function respone($status, $message)
{
    $result = array('status' => $status, 'message' => $message);
    header('Content-Type: application/json');
    return json_encode($result);
}

?>