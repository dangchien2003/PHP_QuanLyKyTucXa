<?php 
    require_once './helper.php';
    $error = false;
    if(checkRequest($_POST, ['sua'])) {
        if(checkRequest($_POST,['tinhtrang', 'tongtien', 'mahd'])) {
            $sql = 'UPDATE hoadonguixe set tinhTrang = ?, tongTien = ? where concat(kyHieu, maHoaDon) = ?';
            $result = query_input($sql, [$_POST['tinhtrang'], $_POST['tongtien'], $_POST['mahd']]);
            if(!$result) {
                $error = true;
            }
        }else {
            $error = true;
        }
    }else {
        $error = true;
    }
    if($error) {
        header("Location: ../page/hdxe.php?status=400&message=Có lỗi xảy ra");
    }else {
        header("Location: ../page/tthdguixe.php?status=200&message=Cập nhật thành công&mahd=".$_POST['mahd']);
    }
?> 