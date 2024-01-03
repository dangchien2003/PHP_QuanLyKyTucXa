<?php 
    include 'helper.php';
    try {
        if(checkRequest($_POST, ["idsv"], false)) {
            $sql = "UPDATE sinhvien SET hoTen = ?, gioiTinh = ?, namSinh=?, sdt = ?, soCCCD = ?, queQuan = ?, ngheNghiep = ?, truong = ?, tinhTrang = ?, ngayVao = ?, ngayRa = ?, maHD = ? WHERE id = ?; ";
            $input = [$_POST["hoten"], $_POST["gioitinh"],$_POST["namsinh"], $_POST["sdt"], $_POST["cccd"], $_POST["quequan"], $_POST["nghenghiep"], $_POST["truong"], $_POST["tinhtrang"], $_POST["ngayVao"], $_POST["ngayra"], $_POST["hopdong"], $_POST["id"]];
            $result = query_input($sql, $input);
            if($result) {
                header("Location: ../page/thongtinsv.php?idsv=".$_POST['id']."&message=Đã sửa thành công&status=200");
            }else {
                header("Location: ../page/thongtinsv.php?idsv=".$_POST['id']."&message=Sửa không thành công&status=300");
            }
        }
    }catch(Exception $e){
        log_error($e->getMessage());
        header("Location: ../page/thongtinsv.php?message=Có lỗi xảy ra&status=400");
    }
?> 