<?php
    require "helper.php";
    session_start();
    if(checkRequest($_COOKIE, ["account"])) {
        $account = giaiMa($_COOKIE["account"]);
        $account["nho"] = "on";
        $account["ck"] = true;
    }
    else if(checkRequest($_SESSION, ["account"])) {
        if($_SESSION["account"]["die"] < getTimestamp(0)) {
            header("Location: ../page/dangnhap.php?message=Hết hạn phiên làm việc&status=300");
        }
    }else {
        header("Location: ../page/dangnhap.php?message=Vui lòng đăng nhập&status=300");
    }
?> 