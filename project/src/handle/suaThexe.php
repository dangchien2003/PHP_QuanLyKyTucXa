<?php 
    include 'helper.php';
    try {
        if(checkRequest($_POST, ["idtx"], false)) {
            $sql = "UPDATE thexe SET tenXe = ?, bienSo = ?, tinhTrang =? WHERE id = ?; ";
            $input = [$_POST["tenxe"], $_POST["bienso"], $_POST["tinhtrang"], $_POST["idtx"]];
            $result = query_input($sql, $input);
            if($result) {
                header("Location: ../page/thongtinthe.php?id=".$_POST['idtx']."&message=Đã sửa thành công&status=200");
            }else {
                header("Location: ../page/thongtinthe.php?id=".$_POST['idtx']."&message=Sửa không thành công&status=300");
            }
        }else {
            header("Location: ../page/thongtinthe.php?message=Có lỗi xảy ra&status=400");
        }
    }catch(Exception $e){
        header("Location: ../page/thongtinthe.php?message=Có lỗi xảy ra&status=400");
    }
?> 