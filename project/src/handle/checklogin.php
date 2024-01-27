<?php
include_once  'helper.php';
include_once  'check.php'; // bao gồm helper.php
try {
    huyTatCaCookie($_SERVER);
    if (checkRequest($_POST, ['username', 'password'], false)) {
        $result = checkUserPassword($_POST["username"], $_POST["password"], true);
        // đúng tài khoản mật khẩu
        if ($result) {

            $account = ["username"=>$_POST["username"], "password"=>$_POST["password"], "dieSS"=>getTimestamp(get_ENV()['timeSession'])];
            $info = null;
            while ($row = $result->fetch_assoc()) {
                $info = ["anh" => $row["anh"], "hoten" => $row["hoTen"], "chucvu" => $row["chucVu"]];
                // chuyển thông tin qua dạng json
                $info = json_encode($info);
            }
            // có nhớ tkmk
            if (checkRequest($_POST, ['nho'], false)) {
                // mã hoá user và pass
                $account_mh = maHoa($account);

                // đẩy về cookie
                setcookie("account", $account_mh, time() + get_ENV()['timeCookie'], '/', false, true);
                setcookie("info", $info, time() + get_ENV()['timeCookie'], '/', false, true);
                // chuyển hướng trang
                nextPage($_POST["username"], $_POST["password"],"");
            } else {
                // không nhớ tkmk
                session_start();
                $_SESSION["account"] = $account;
                setcookie("info", $info, time() + get_ENV()['timeCookie'], '/', false, true);
                // chuyển hướng trang
                nextPage($_POST["username"], $_POST["password"], "");
                // header("Location: ./checkAccount.php");
            }
        } else {
            // chuyển hướng
            header("Location: ../page/dangnhap.php?message=Tài khoản mật khẩu không đúng&status=400");
        }
    } else {
        header("Location: ../page/dangnhap.php?message=Lỗi server&status=400");
    }
} catch (Exception $e) {
    log_error($e->getMessage());
    header("Location: ../page/dangnhap.php?message=Hiện không thể đăng nhập&status=400");
}

function huyTatCaCookie($server)
{
    if (isset($server['HTTP_COOKIE'])) {
        $cookies = explode(';', $server['HTTP_COOKIE']);
        foreach ($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            if(strtoupper($name) != "PHPSESSID") {
                setcookie($name, '', time() - get_ENV()['timeCookie'], '/');
            }
        }
    }
    // huỷ session
    session_start();
    session_destroy();
}
