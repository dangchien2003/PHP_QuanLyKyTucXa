<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../public/image/icon/logo.png" type="image/png">
    <title>Quản lý ký túc xá</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/toast.css">
    <?php 
        function addStyle($name) {
            foreach($name as $style) {
                echo '<script src="'.'../../public/js/'.$style.'.css"></script>';    
            }
        }
    ?> 
</head>

<body>
<?php
    include '../handle/helper.php';
    // include "../handle/checkAccount.php";
?>
    <div id="toast"></div>
    <header class="text-white ">
        <div class="logo"><img src="../../public/image/icon/logo.png" alt=""><span class="" style="width: 100%;">KÝ TÚC XÁ</span></div>
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
                            <a class="nav-link active text-white" aria-current="page" href="#"><i class="bi bi-telephone-forward-fill p-1 fs-5"></i>Điện thoại hỗ trợ: 0333444555</a>
                            <a class="nav-link active text-white" aria-current="page" href="#">Quyền của tôi</a>
                            <a class="nav-link active text-white" aria-current="page" href="#"><i class="bi bi-bell-fill"><span class="sl-tb">1</span></i></a>
                            <a class="nav-link text-white" href="thongtincanhan.php"><img src="../../public/image/bg-login.jfif" alt=""></a>
                            <a class="nav-link text-white" href="dangnhap.php"><i class="fa-solid fa-power-off"></i></a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>