<?php 
include 'helper.php';
if(checkRequest($_POST, ["quyen"])) {
    $quyen = $_POST["quyen"];
    $cat = explode('-', $quyen);
    $userAD = isset($cat[0]) ? $cat[0] : null;
    $idquyen = isset($cat[1]) ? $cat[1] : null;
    $user = null;
    if (!$user && checkRequest($_SESSION, ['account'])) {
        $user = $_SESSION['account']['username'];
    } else if (!$user && checkRequest($_COOKIE, ['account'])) {
        $account = giaiMa($_COOKIE['account']);
        $user = $account['username'];
    }
    if($user && $quyen && $userAD) {
        
        $sql = "INSERT into quyentruycap(user, userAdmin, quyen) values (?, ?, ?)";
        $result = query_input($sql, [$user, $userAD, covint($idquyen)]);
        if($result) {
            
            header("location: ../page/quyencuatoi.php?status=200&message=Đã gửi yêu cầu");
        }else {
            echo "a";
            header("Location: ../page/quyencuatoi.php?status=400&message=Không thể gửi yêu cầu");
        }
    }else {
        header("Location: ../page/quyencuatoi.php?status=400&message=Có lỗi xảy ra");
    }
}else {
    header("Location: ../page/quyencuatoi.php?status=400&message=Không có thông tin");
}
?> 