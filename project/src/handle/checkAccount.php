<?php
require "helper.php";
// session_start();
// // if(checkRequest($_COOKIE, ["account"], false)) {
// //     $account = giaiMa($_COOKIE["account"]);
// //     $account["nho"] = "on";
// //     echo "cookie";
// // } else 
// if(checkRequest($_SESSION, ["account"], false)) {
//     // if($_SESSION["account"]["die"] < getTimestamp(0)) {
//     //     header("Location: ../page/dangnhap.php?message=Hết hạn phiên làm việc&status=300");
//     // }
// }else {
//     header("Location: ../page/dangnhap.php");
// }

// tạm thời không check ck
session_start();
$page =  getPageHere($_SERVER["PHP_SELF"]);
$quyen = [];
$qc = 0;
if (!checkRequest($_SESSION, ["account"], false)) {
    header("Location: ../page/dangnhap.php");
} else {


    $sql = "SELECT nhanvien.anh, quyentruycap.quyen as qtc, taikhoan.quyen as qc, taikhoan.tinhTrang, url.url FROM taikhoan RIGHT JOIN quyentruycap ON taikhoan.user = quyentruycap.user JOIN nhanvien ON nhanvien.user = taikhoan.user RIGHT JOIN url ON url.quyen = quyentruycap.quyen WHERE taikhoan.user = ? and taikhoan.pass = ? and quyentruycap.thoiGianThuHoi IS NULL;";
    $result = query_input($sql, [$_SESSION["account"]["username"], $_SESSION["account"]["password"]]);

    $next = false;
    if ($result->num_rows == 0) {
        session_destroy();
        header("Location: ../page/dangnhap.php");
    } else {
        $next = check1($result, $page, $quyen, $qc);
    }

    $page_admin = "";
    // print_r($quyen);
    if(!$next) {
        $next = check2($qc, $page, $page_admin);
    }
    if(!$next) {
        header("Location: ../page/$page_admin?status=300&message=Bạn không có quyền truy cập&kc=abc");
    }
}
// kiểm tra user, pass, quyền xin
function check1($result, $page, &$quyen, &$qc)
{
    $next = false;
    $check_tt = false;
    // kt tk
    while ($row = $result->fetch_assoc()) {
        if (!$check_tt) {
            switch ($row["tinhTrang"]) {
                case 14:
                    header("Location: ../page/dangnhap.php?message=Tài khoản không còn hoạt động&status=400");
                    break;
                case 15:
                    // update ảnh
                    $_SESSION["account"]["anh"] = $row["anh"];
                    break;
                default:
                    throw new Exception("không nhận ra tình trạng");
            }
            $check_tt = true;
        }
        if (!$next && $row["url"] === $page) {
            $next = true;
        }
        if (!$qc) {

            $qc = $row["qc"];
            array_push($quyen, $qc);
        }
        array_push($quyen, $row["qtc"]);
    }
    // lấy quyền dạng key value
    $quyen_key = createKeyValueArray($quyen, $quyen);
    $quyen = [];
    // lấy ra quyền rạng array
    foreach($quyen_key as $key => $value) {
        array_push($quyen, $value);
    }
    return $next;
}

// check quyền chính
function check2($qc, $page, &$page_admin) {
    $add_page = false;
    $sql = "SELECT url FROM `url` WHERE quyen=?";
    $result = query_input($sql, [$qc]);
    if($result->num_rows == 0) {
        echo 'không có du l';
        return false;
        
    }else {
        while($row = $result->fetch_assoc()) {
            if($page==$row['url']) {
                return true;
            }else if(!$add_page) {
                $page_admin = $row['url'];
            }
        }
        return false;
    }
}