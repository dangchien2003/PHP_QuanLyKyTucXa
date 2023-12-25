<?php 
    include "./helper.php";
    try {
        if(checkRequest($_POST, ["password", "username"])) {
            
            $sql = "SELECT 
            taikhoan.tinhTrang,
            tinhTrang.tinhTrang as tttt,
            taikhoan.quyen as qc,
            chucvu.chucDanh,
            nhanvien.anh,
            quyentruycap.quyen as qtc,
            nhanvien.id as idnv,
            url.url 
            FROM taikhoan 
            JOIN nhanvien ON nhanvien.user = taikhoan.user 
            JOIN tinhTrang ON tinhTrang.id = taikhoan.tinhTrang 
            JOIN chucvu ON chucvu.quyen = taikhoan.quyen 
            RIGHT JOIN quyentruycap on taikhoan.user = quyentruycap.user JOIN url on url.quyen = taikhoan.quyen 
            WHERE 
            taikhoan.user = ? AND taikhoan.pass = ? and quyentruycap.thoiGianThuHoi IS NULL";
            $result = query_input($sql, [$_POST["username"], $_POST["password"]]);
            $check_tt = false;
            $account = [];
            $quyenkhac = [];
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if(!$check_tt) {
                        switch($row["tinhTrang"]) {
                            case 14: 
                                header("Location: ../page/dangnhap.php?message=Tài khoản không còn hoạt động&status=400");
                            break;
                            case 15:
                                // chạy đăng nhập
                                $account["anh"] = $row["anh"];
                                $account["chucdanh"] = $row["chucDanh"];
                                $account["idnv"] = $row["idnv"];
                            break;
                            default:
                                throw new Exception("không nhận ra tình trạng");
                        }
                        $check_tt = true;
                    }
                   
                    // thêm quyền truy cập
                    array_push($quyenkhac, $row["qtc"]);
                    // thêm quyền chính
                    $account["qc"] = $row["qc"];
                    // thêm url
                    $account["url"] = $row["url"];
                }
                // thêm quyền khác
                $account["quyenkhac"] = $quyenkhac;
                $account["username"] = $_POST["username"];
                $account["password"] = $_POST["password"];
                $account["die"] = getTimestamp(10);
                // tạo session
                if(checkRequest($_POST, ["nho"])) {
                    if($_POST["nho"]=="on") {
                        setcookie("account", maHoa($account), time() + (15), "/", false, true);
                        // 30*24*60*60
                    }
                }else {
                    session_start();
                    $_SESSION["account"] = $account;
                }
                
                // chuyển hướng trang
                header("Location: ../page/".$account['url']);
            }else {
                header("Location: ../page/dangnhap.php?message=Thông tin tài khoản mật khẩu không chính xác&status=400");
            }
            
        }else {
            header("Location: ../page/dangnhap.php?message=Thông tin tài khoản mật khẩu không chính xác&status=300");
        }

    }catch(Exception $e) {
        header("Location: ../page/dangnhap.php?message=Hiện không thể đăng nhập&status=400");
    }

    function loginSuccess() {
        
    }
?> 