<?php
include 'check.php'; // bao gồm helper.php
try {
    huyTatCaCookie($_SERVER);
    if (checkRequest($_POST, ['username', 'password'], false)) {
        $result = checkAccount($_POST["username"], $_POST["password"], true);
        // đúng tài khoản mật khẩu
        if ($result) {

            $account = [$_POST["username"], $_POST["password"]];
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
                setcookie("account", $account_mh, time() + 3600, '/', false, true);
                setcookie("info", $info, time() + 3600, '/', false, true);
                // chuyển hướng trang
                nextPage($_POST["username"], $_POST["password"]);
            } else {
                // không nhớ tkmk
                session_start();
                $_SESSION["account"] = $account;
                setcookie("info", $info, time() + 3600, '/', false, true);
                // chuyển hướng trang
                nextPage($_POST["username"], $_POST["password"]);
            }
        } else {
            // huỷ session
            session_start();
            session_destroy();
            // chuyển hướng
            header("Location: ../page/dangnhap.php?message=Tài khoản mật khẩu không đúng&status=400");
        }
    } else {
    }
} catch (Exception $e) {
    header("Location: ../page/dangnhap.php?message=Hiện không thể đăng nhập&status=400");
}

// chuyển hướng sang trang không cần dữ liệu đầu vào
function nextPage($user, $pass)
{
    $sql = "SELECT url FROM url JOIN quyenchinh ON quyenchinh.quyen = url.quyen JOIN taikhoan on taikhoan.user = quyenchinh.user WHERE taikhoan.user = ? AND taikhoan.pass = ? AND url.indata = 0 LIMIT 1";
    $result = query_input($sql, [$user, $pass]);
    if ($result->num_rows == 0) {
        header("Location: ../page/403.html");
    } else {
        while ($row = $result->fetch_assoc()) {
            header("Location: ../page/" . $row['url']);
        }
    }
}

function huyTatCaCookie($server)
{
    if (isset($server['HTTP_COOKIE'])) {
        $cookies = explode(';', $server['HTTP_COOKIE']);
        foreach ($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time() - 3600, '/');
        }
    }
}
