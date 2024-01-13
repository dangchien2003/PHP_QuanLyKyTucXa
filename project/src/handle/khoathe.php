<?php 
    include 'helper.php';
    try {
        if(checkRequest($_GET, ["id"], false)) {
            $sql = "UPDATE thexe SET tinhTrang= 14 WHERE id = ?; ";
            $input =[$_GET['id']];
            $result = query_input($sql, $input);
            if($result) {
                header("Location: ../page/dsthe.php?message=Đã khoá thành công&status=200");
            }else {
                header("Location: ../page/dsthe.php?message=Khoá thất bại&status=300");
            }
        }
    }catch(Exception $e){
        header("Location: ../page/dsthe.php?message=Có lỗi xảy ra&status=400");
    }
?> 