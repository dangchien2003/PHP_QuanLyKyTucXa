<?php
try {
    include 'helper.php';
    if (checkRequest($_POST, ['kyhieu', 'hoten', 'cccd', 'nghenghiep', 'tinhtrang', 'ngayvao'])) {
        $kyhieu = $_POST['kyhieu'];
        $hoten = $_POST['hoten'];
        $cccd = $_POST['cccd'];
        $nghenghiep = $_POST['nghenghiep'];
        $tinhtrang = covint($_POST,'tinhtrang');
        $ngayvao = $_POST['ngayvao'];
        $gioitinh = covint($_POST,'gt');
        $sdt = $_POST['sdt'] ?? NULL;
        $quequan = $_POST['quequan'] ?? NULL;
        $truong = $_POST['truong'] ?? NULL;
        $mahd = covint($_POST,'mahd');
        $file = NULL;
        $maphong = 100;
        $ngaysinh = $_POST['ngaysinh'] ?? NULL;
        $sql = "INSERT into sinhvien(id,kyHieu, anh, maPhong, hoTen, gioiTinh, namSinh, sdt, soCCCD, queQuan, ngheNghiep, truong, tinhTrang, ngayVao, maHD) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $result = query_input($sql, [NULL, $kyhieu, $file, $maphong, $hoten, $gioitinh, $ngaysinh, $sdt, $cccd, $quequan, $nghenghiep, $truong, $tinhtrang, $ngayvao, $mahd]);
        $id = null;
        // nếu có file và thêm thành công không có lỗi
        if($result) {
            $sql = "SELECT id from sinhvien where hoten = ? and maphong = ? and ngayvao = ? and kyhieu = ? and socccd = ? limit 1;";
            $kq = query_input($sql, [$hoten, $maphong, $ngayvao, $kyhieu, $cccd]);
            if($kq->num_rows > 0) {
                while($row = $kq->fetch_assoc()) {
                    $id = $row['id'];
                    $result = true;
                }
            }else {
                $result = false;
            }
        }
        
        // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //     if (isset($_FILES["file"])) {
        //         // Lấy thông tin về tên tệp đã tải lên
        //         $file_name = $_FILES["file"]["name"];
        //         echo "Tên tệp tin đã tải lên: " . $file_name;
        //     } else {
        //         echo "Có lỗi khi tải tệp lên.";
        //     }
        // }

        //check có thông tin trong db và có file
        // if($result && $file) {


        //     // ... chưa xử lý
        //     $base64 = getBase64($file);
        //     // Đường dẫn đến thư mục lưu trữ ảnh
        //     $uploadPath = '..\..\public\image\uploads\\';
        //     // Tạo tên file
        //     $fileName = $kyhieu.$id. '.png';
        //     // Đường dẫn ảnh
        //     $linkIMG = $uploadPath . $fileName;

        //     // lưu ảnh
        //     $success = file_put_contents($linkIMG, $base64);
        //     // tải ảnh thành công
        //     if($success) {
        //         header("Location: ../page/thongtinsv.php?idsv=$id&message=Thêm thành công&status=200");
        //         exit();
        //     }else {
        //         header("Location: ../page/thongtinsv.php?idsv=$id&message=Lỗi trong quá trình lưu ảnh&status=300");
        //         exit();
        //     }
        // }
        // trả kết quả
        if ($result && $id) {
            header("Location: ../page/thongtinsv.php?idsv=$id&message=Thêm thành công&status=200");
            exit();
        } else {
            header("Location: ../page/themsinhvien.php?message=Thất bại&status=300");
            exit();
        }
    } else {
        header("Location: ../page/themsinhvien.php?message=Bổ sung thông tin&status=300");
        exit();
    }
}catch (Exception $e) {
    log_error($e->getMessage());
    header("Location: ../page/themsinhvien.php?message=Có lỗi xảy ra&status=400");
}




?>