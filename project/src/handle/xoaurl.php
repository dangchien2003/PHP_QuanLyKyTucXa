<?php 
    include 'helper.php';
    include 'checkAccount.php';

    try {
        if(checkRequest($_GET, ["id"], false)) {
            $sql = "delete from url where id = ?";
            $input =[$_GET['id']];
            $result = query_input($sql, $input);
            if($result) {
                header("Location: ../page/dslienket.php?message=Đã xoá thành công&status=200");
            }else {
                header("Location: ../page/dslienket.php?message=Xoá thất bại&status=400");
            }
        }
    }catch(Exception $e){
        header("Location: ../page/dslienket.php?message=Có lỗi xảy ra&status=400");
    }
?> 