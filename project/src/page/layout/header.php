<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../public/image/icon/logo.png" type="image/png">
    <title>Quản lý ký túc xá</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/calc.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/toast.css">
    <?php
    error_reporting(1);
    function addStyle($name)
    {
        foreach ($name as $style) {
            echo '<script src="' . '../../public/js/' . $style . '.css"></script>';
        }
    }
    ?>
</head>

<body>
    <?php
    include '../handle/helper.php';
    include "../handle/checkAccount.php";
    ?>
    <div id="toast"></div>
    <?php include 'calc.php' ?>

    <header class="text-white ">
        <div class="logo"><img src="../../public/image/icon/logo.png" alt=""><span class="" style="width: 100%;">KÝ TÚC
                XÁ</span></div>
        <div class="menu ">
            <nav class="navbar navbar-expand-lg navbar-light ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                    </a>
                    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                        <div class="navbar-nav" style="font-weight: 500;">
                            <a class="nav-link active text-white" aria-current="page" href="#"><i
                                    class="bi bi-telephone-forward-fill p-1 fs-5"></i>Điện thoại hỗ trợ: 0333444555</a>
                            <a  class="nav-link active text-white" aria-current="page" href="quyencuatoi.php"><span>Quyền
                                    của tôi</span>
                            </a>
                            <a class="nav-link active text-white" aria-current="page" href="#" id="myquyen"><i
                                    class="bi bi-bell-fill"><span class="sl-tb">
                                        <?php
                                        $user = null;
                                        if (!$user && checkRequest($_SESSION, ['account'])) {
                                            $user = $_SESSION['account']['username'];
                                        } else if (!$user && checkRequest($_COOKIE, ['account'])) {
                                            $account = giaiMa($_COOKIE['account']);
                                            $user = $account['username'];
                                        }
                                        $sql = "SELECT count(*) as sl FROM quyentruycap where quyentruycap.thoigiancap is null and quyentruycap.thoigianthuhoi is null and userAdmin = ?";

                                        $result = query_input($sql, [$user]);
                                            while ($row = $result->fetch_assoc()) {
                                                echo $row['sl'];
                                                break;
                                            }

                                        ?>
                                    </span></i>
                                    <div id="quyen" class="d-none">
                                    <i class="bi bi-caret-up-fill" id="tg"></i>
                                    <?php
                                    $user = null;
                                    if (!$user && checkRequest($_SESSION, ['account'])) {
                                        $user = $_SESSION['account']['username'];
                                    } else if (!$user && checkRequest($_COOKIE, ['account'])) {
                                        $account = giaiMa($_COOKIE['account']);
                                        $user = $account['username'];
                                    }
                                    $sql = "select chucvu.chucDanh, quyentruycap.id, quyentruycap.user FROM quyentruycap JOIN quyen ON quyentruycap.quyen = quyen.idQuyen JOIN chucvu on chucvu.id = quyen.quanLy where quyentruycap.userAdmin = ? and quyentruycap.thoigiancap is null and quyentruycap.thoigianthuhoi is null";
                                    $result = query_input($sql, [$user]);
                                    if ($result->num_rows == 0) {
                                        echo '<div class="tb row">
                                        <div>Không có thông báo</div>
                                    </div>';
                                    } else {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <div class="tb row">
                                                <div class="col-md-9"><?php echo $row['user']?> - <?php echo $row['chucDanh']?></div>
                                                <div class="col-md-3 icon"
                                                    style="padding: 0 5px; display: grid; grid-template-columns: 5fr 5fr;">
                                                    <input type="password" class="d-none id-q" id="id" value="<?php echo $row['id']?>">
                                                    <i class="bi bi-x-circle-fill cancle" style="color: #f43232;"></i>
                                                    <i class="bi bi-check-circle-fill tick" style="color: #2be02b;"></i>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    }
                                    ?>


                                </div></a>
                            <a class="nav-link text-white" href="thongtincanhan.php"><img
                                    src="../../public/image/bg-login.jfif" alt=""></a>
                            <a class="nav-link text-white" href="dangnhap.php"><i class="fa-solid fa-power-off"></i></a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>