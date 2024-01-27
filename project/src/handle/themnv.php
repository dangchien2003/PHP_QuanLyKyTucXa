<?php
try {
    include 'helper.php';
    if (checkRequest($_POST, ['kyhieu', 'hoten','tinhtrang', 'chucvu', 'ngayvao', 'sdt', 'quequan'])) {
        $kyhieu = $_POST['kyhieu'];
        $hoten = $_POST['hoten'];
        $nghenghiep = $_POST['nghenghiep'];
        $tinhtrang = covint($_POST,'tinhtrang');
        $chucvu = covint($_POST, 'chucvu');
        $ngayvao = $_POST['ngayvao'];
        $gioitinh = covint($_POST,'gt');
        $sdt = $_POST['sdt'] ?? NULL;
        $quequan = $_POST['quequan'] ?? NULL;
        $file = NULL;
        $ngaysinh = $_POST['ngaysinh'] ?? NULL;
        $sql = "INSERT into nhanvien(id,kyHieu, hoTen, gioiTinh, ngaySinh,queQuan, chucVu, email, sdt, ngayvao, tinhTrang) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $result = query_input($sql, [NULL, $kyhieu, $hoten, $gioitinh, $ngaysinh, $quequan, $chucvu, $email, $sdt, $ngayvao, $tinhtrang]);
        $id = null;
        // nếu có file và thêm thành công không có lỗi
        if($result) {
            $sql = "SELECT id from nhanvien where hoten = ? and chucvu = ? and ngayvao = ? and kyhieu = ?  limit 1;";
            $kq = query_input($sql, [$hoten, $chucvu, $ngayvao, $kyhieu, ]);
            if($kq->num_rows > 0) {
                while($row = $kq->fetch_assoc()) {
                    $id = $row['id'];
                    $result = true;
                }
            }else {
                $result = false;
            }
        }
        if ($result && $id) {
            header("Location: ../page/dsnv.php?idsv=$id&message=Thêm thành công&status=200");
            exit();
        } else {
            header("Location: ../page/themnhanvien.php?message=Thất bại&status=300");
            exit();
        }
    } else {
        header("Location: ../page/themnhanvien.php?message=Bổ sung thông tin&status=300");
        exit();
    }
}catch (Exception $e) {
    log_error($e->getMessage());
    header("Location: ../page/themnhanvien.php?message=Có lỗi xảy ra&status=400");
}




?>