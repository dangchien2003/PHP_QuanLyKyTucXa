<?php
    include 'helper.php';
    try {
        if(checkRequest($_POST, ['chuXe', 'tenXe', 'bienSo', 'tinhtrang'], true)) {
            $sql = 'INSERT into thexe(chuXe, tenXe, bienSo, tinhtrang) values (?, ?, ?, ?)';
            $result = query_input($sql,[$_POST["chuXe"], $_POST["tenXe"], $_POST["bienSo"], $_POST["tinhtrang"]]);
            if($result) {
                header("Location: ../page/dsthe.php?status=200&message=Thêm thành công");
            }else {
                header("Location: ../page/themthe.php?status=400&message=Thêm thất bại");
            }
        }else {
            header("Location: ../page/themthe.php?status=300&message=Bổ sung thông tin");
        }
    }catch(Exception $e) {
        header("Location: ../page/themthe.php?status=400&message=Có lỗi xảy ra");
    }
?> 