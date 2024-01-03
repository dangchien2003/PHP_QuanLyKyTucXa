<?php
    include 'helper.php';
    try {
        if(checkRequest($_POST, ['kyhieu', 'maphong', 'tang', 'tinhtrang', 'succhua'], true)) {
            $result = null;
            if(checkRequest($_POST,  ['nguoidaidien'])) {
                $sql = 'update phong set kyhieu = ?, tang = ?, tinhtrang = ?, succhua=?, nguoidaidien = ? where maphong = ? ';
                if($_POST['tang'] != 0) {
                    echo count([$_POST["kyhieu"], $_POST["tang"], $_POST["tinhtrang"], $_POST["succhua"], $_POST['nguoidaidien'], $_POST["maphong"]]);
                    $result = query_input($sql,[$_POST["kyhieu"], $_POST["tang"], $_POST["tinhtrang"], $_POST["succhua"], $_POST['nguoidaidien'], $_POST["maphong"]]);
                }else {
                    $result = query_input($sql,[$_POST["kyhieu"], $_POST["sotang"], $_POST["tinhtrang"], $_POST["succhua"], $_POST['nguoidaidien'], $_POST["maphong"]]);
                }
            }else {
                $sql = "update phong set kyhieu = ?, tang = ?, tinhtrang = ?, succhua=?, nguoidaidien=NULL where maphong = ? ";
                if($_POST['tang'] != 0) {
                    echo count([$_POST["kyhieu"], $_POST["tang"], $_POST["tinhtrang"], $_POST["succhua"], $_POST["maphong"]]);
                    $result = query_input($sql,[$_POST["kyhieu"], $_POST["tang"], $_POST["tinhtrang"], $_POST["succhua"], $_POST["maphong"]]);
                }else {
                    $result = query_input($sql,[$_POST["kyhieu"], $_POST["sotang"], $_POST["tinhtrang"], $_POST["succhua"], $_POST["maphong"]]);
                }
            }
            if($result) {
                header("Location: ../page/thongtinp.php?status=200&message=Sửa thành công&maphong=".$_GET["maphong"]);
            }else {
                header("Location: ../page/thongtinp.php?status=400&message=Sửa thất bại&maphong=".$_GET["maphong"]);
            }
        }else {
            header("Location: ../page/thongtinp.php?status=300&message=Bổ sung thông tin&maphong=".$_GET["maphong"]);
        }
    }catch(Exception $e) {
        log_error($e->getMessage());
        header("Location: ../page/thongtinp.php?status=400&message=Có lỗi xảy ra&maphong=".$_GET["maphong"]);
    }
?> 