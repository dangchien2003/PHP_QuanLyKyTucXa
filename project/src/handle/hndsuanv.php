<?php 
include 'helper.php';
if(checkRequest($_POST, ['kyhieu', 'id'])) {
    $id = $_POST['id'];
    $kyhieu = $_POST['kyhieu'];
    $taikhoan  = $_POST['taikhoan']??NULL;
    $hoTen  = $_POST['hoten']??NULL;
    $quequan  = $_POST['quequan']??NULL;
    $sdt  = $_POST['sdt']??NULL;
    $gt  = $_POST['gt']??0;
    $ngaysinh  = $_POST['ngaysinh']??NULL;
    $email  = $_POST['email']??NULL;
    $ngayvao  = $_POST['ngayvao']??NULL;
    $ngaynghi  = $_POST['ngaynghi']??NULL;
    $chucvu  = $_POST['chucvu']??NULL;
    $tinhtrang  = $_POST['tinhtrang']??NULL;
    $sql = "UPDATE nhanvien set kyHieu = ?, user = ?, hoten = ?, gioitinh = ?, ngaysinh = ?, quequan = ?, chucvu = ?, email = ?, sdt = ?, ngayvao = ?, ngaynghi = ?, tinhtrang = ? where id = ?";
    $result = query_input($sql, [$kyhieu, $taikhoan, $hoTen, $gt, $ngaysinh, $quequan, $chucvu, $email, $sdt, $ngayvao, $ngaynghi, $tinhtrang, $id]);
    if($result) {
        header("Location: ../page/thongtinnv.php?id=$id&status=200&message=Sửa thành công");
    }else {
        header("Location: ../page/thongtinnv.php?id=$id&status=400&message=Sửa không thành công");
    }
}else {
    header('Location: ../page/dsnv.php?status=400&message=Không được để trống');
}
?> 