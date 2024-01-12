<?php
require_once 'helper.php';
try {
    if(checkRequest($_POST,['user'])) {
        $pass = getTimestamp(0).rand(10, 99);
        $sql = "UPDATE taikhoan SET pass = ? WHERE user = ?";
        $result = query_input($sql, [$pass, $_POST['user']]);
        
        if($result) {
            $sql = "SELECT count(*) from taikhoan where user = ? and pass = ?";
            $result = query_input($sql, [$_POST['user'], $pass]);
            if($result->num_rows == 1) {

                echo respone(200, "$pass");
            }else {
                echo respone(400, "Thất bại");
            }
        }else {
            echo respone(505, "Thông tin không đúng");
        }
        
    }else {
        echo respone(400, "Có lỗi xảy ra");
    }
}catch(Exception $e) {
    log_error($e->getMessage());
    echo respone(500, "Có lỗi xảy ra");

}

function respone($status, $message)
{
    $result = array('status' => $status, 'message' => $message);
    header('Content-Type: application/json');
    return json_encode($result);
}

?> 