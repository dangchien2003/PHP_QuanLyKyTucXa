<?php
require_once "helper.php";
require_once "check.php";
session_start();
if (checkRequest($_COOKIE, ["account"], false)) {
    $account = giaiMa($_COOKIE["account"]);
    kiemTraTaiKhoan($account["username"], $account["password"]);
} else if (checkRequest($_SESSION, ["account"], false)) {
    if ($_SESSION["account"]["dieSS"] < getTimestamp(0)) {
        header("Location: ../page/dangnhap.php?status=300&message=Hết hạn phiên đăng nhập");
    } else {
        kiemTraTaiKhoan($_SESSION["account"]["username"], $_SESSION["account"]["password"]);
    }
} else {
    header("Location: ../page/dangnhap.php");
}


function kiemTraTaiKhoan($u, $p)
{
    if (checkUserPassword($u, $p, false)) {
        if (!checkPage($u)) {
            nextPage($u, $p, "?status=300&message=Bạn không có quyền truy cập");
            return;
        }
    } else {
        header("Location: ../page/dangnhap.php");
    }
}

function checkPage($u)
{
    $page =  getPageHere($_SERVER["PHP_SELF"]);
    if (!checkQC($u, $page)) {

        if (!checkQX($u, $page)) {
            return false;
        } else {
            return true;
        }
    } else {
        return true;
    }
}

function checkQC($u, $page)
{
    $sql = "SELECT quyenchinh.quyen as qc, url.url from taikhoan LEFT JOIN quyenchinh on taikhoan.user = quyenchinh.user JOIN url ON url.quyen = quyenchinh.quyen WHERE taikhoan.user = ?";
    $result = query_input($sql, [$u]);
    while ($row = $result->fetch_assoc()) {
        if ($row["url"] == $page) {
            return true;
        }
    }
    return false;
}

function checkQX($u, $page)
{
    $sql = "SELECT quyentruycap.quyen, url.url FROM quyentruycap JOIN url ON url.quyen = quyentruycap.quyen WHERE quyentruycap.user = ? and quyentruycap.thoiGianThuHoi is null;";
    $result = query_input($sql, [$u]);
    while ($row = $result->fetch_assoc()) {
        if ($row["url"] == $page) {
            return true;
        }
    }
    return false;
}
?>