<?php
    include 'helper.php';
    try {
        if(checkRequest($_POST, ['kyhieu', 'maphong', 'tang', 'tinhtrang', 'succhua'], true)) {
            $sql = 'INSERT into phong(maphong, kyhieu, tang, tinhtrang, succhua) values (?, ?, ?, ?, ?)';
            
            $result = null;
            if($_POST['tang'] != 0) {
                $result = query_input($sql,[$_POST["maphong"], $_POST["kyhieu"], $_POST["tang"], $_POST["tinhtrang"], $_POST["succhua"]]);
            }else {
                $result = query_input($sql,[$_POST["maphong"], $_POST["kyhieu"], $_POST["sotang"], $_POST["tinhtrang"], $_POST["succhua"]]);
            }
            if($result) {
                header("Location: ../page/themphong.php?status=200&message=Thêm thành công");
            }else {
                header("Location: ../page/themphong.php?status=400&message=Thêm thất bại");
            }
        }else {
            header("Location: ../page/themphong.php?status=300&message=Bổ sung thông tin");
        }
    }catch(Exception $e) {
        log_error($e->getMessage());
        header("Location: ../page/themphong.php?status=400&message=Có lỗi xảy ra");
    }
?> 