<?php 
    require_once './helper.php';
    $error = false;
    if(checkRequest($_POST, ['sua'])) {
        if(checkRequest($_POST,['tinhtrang', 'vesinh', 'giaphong', 'mahd'])) {
            $sql = 'UPDATE hoadonphong set giaPhong = ?, giaVeSinh = ?, tinhtrang = ?, tongTien = ? where concat(kyHieu, maHoaDon) = ?';
            $result = query_input($sql, [$_POST['giaphong'], $_POST['vesinh'], $_POST['tinhtrang'], $_POST['giaphong'] + $_POST['vesinh'], $_POST['mahd']]);
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
        header("Location: ../page/hoadonphong.php?status=400&message=Có lỗi xảy ra");
    }else {
        header("Location: ../page/tthdphong.php?status=200&message=Cập nhật thành công&mahd=".$_POST['mahd']);
    }
?> 