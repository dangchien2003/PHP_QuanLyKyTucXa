<?php 
    require_once 'helper.php';
    $error = false;
    if(checkRequest($_POST, ["mahd", "diencu", "dienmoi", "nuoccu", "nuocmoi", "tongtien", "tinhtrang"])) {
        $sql = "update hoadondiennuoc set soDienCu = ?, soDienmoi = ?, soNuocCu = ?, soNuocMoi = ?, tongTien = ?, tinhTrang = ? where concat(kyHieu, maHoaDon) = ?";
        $result = query_input($sql, [$_POST['diencu'], $_POST['dienmoi'], $_POST['nuoccu'], $_POST['nuocmoi'], $_POST['tongtien'], $_POST['tinhtrang'], $_POST['mahd']]);
        if(!$result) {
            $error = true;
        }
    }else {
        $error = true;
    }

    if($error) {
        header('location: ../page/hddiennuoc.php?status=400&message=Có lỗi xảy ra');
    }else {
        header('location: ../page/tthddiennuoc.php?status=200&message=Sửa thành công&mahd='.$_POST['mahd']);
    }
?> 