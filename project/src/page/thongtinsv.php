<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/toast.css">
</head>

<body>
    <div id="toast"></div>
    <header class="text-white ">
        <div class="logo">
            <div class="" style="width: 100%;">logo</div>
        </div>
        <div class="menu ">
            <nav class="navbar navbar-expand-lg navbar-light ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                    </a>
                    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                        <div class="navbar-nav" style="font-weight: 500;">
                            <a class="nav-link active text-white" aria-current="page" href="#"><i class="bi bi-telephone-forward-fill p-1 fs-5"></i>Điện thoại hỗ trợ: 0333444555</a>
                            <a class="nav-link active text-white" aria-current="page" href="#">Quyền của tôi</a>
                            <a class="nav-link text-white" href="#"><img src="../../public/image/bg-login.jfif" alt=""></a>
                            <a class="nav-link text-white" href="#"><i class="fa-solid fa-power-off"></i></a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <div class="row">
        <div class="col-lg-3 bg-menu">
            <nav class="menu">
                <ul class="list-unstyled">
                    <li class="parent-menu position-relative on">
                    <?php
                    ?> 
                        <i class="bi bi-door-open"></i>
                        Quản lý phòng
                        <span class="arrow position-absolute">
                            <i class="bi bi-chevron-left left d-none"></i>
                            <i class="bi bi-chevron-down down"></i>
                        </span>
                    </li>
                    <ul class="list-unstyled sub-menu">
                        <li>
                            <i class="bi bi-border-style"></i>
                            <a href="./sodophong.php">Sơ đồ phòng</a>
                        </li>
                        <li>
                            <i class="bi bi-patch-plus"></i>
                            <a href="#">Thêm phòng</a>

                        </li>
                        <li>
                            <i class="bi bi-vector-pen"></i>
                            <a href="#">Sửa thông tin</a>
                        </li>

                    </ul>
                    <li class="parent-menu position-relative on">
                        <i class="bi bi-door-open"></i>
                        Quản lý phòng
                        <span class="arrow position-absolute">
                            <i class="bi bi-chevron-left left d-none"></i>
                            <i class="bi bi-chevron-down down"></i>
                        </span>
                    </li>
                    <ul class="list-unstyled sub-menu">
                        <li>
                            <i class="bi bi-border-style"></i>
                            <a href="#">Sơ đồ phòng</a>
                        </li>
                        <li>
                            <i class="bi bi-patch-plus"></i>
                            <a href="#">Thêm phòng</a>

                        </li>
                        <li>
                            <i class="bi bi-vector-pen"></i>
                            <a href="#">Sửa thông tin</a>
                        </li>
                    </ul>
                </ul>
            </nav>
        </div>
        <div class="col-lg-9 info">
            <div class="box">

                <?php
                include '../handle/helper.php';
                if(checkRequest($_GET, ["idsv"])) {
                    $sql = "SELECT * from sinhvien where id = ?";
                    $infoSV = select_input($sql, [$_GET["idsv"]]);
                    while ($info = $infoSV->fetch_assoc()) {
                ?>
                    <div class="row info-student d-flex justify-content-center ">
                        <div class="col-md-4 justify-content-center ">
                            <div class="ttp">
                                <span>Thông tin phòng ở</span>
                                <div class="">
                                    <div class="mb-3 object">
                                        <label for="exampleFormControlInput1" class="form-label">Mã phòng: </label>
                                        <input type="email" class="" id="exampleFormControlInput1" placeholder="">
                                    </div>
                                    <div class="mb-3 object">
                                        <label for="exampleFormControlInput1" class="form-label">Tầng: </label>
                                        <input type="email" class="" id="exampleFormControlInput1" placeholder="">
                                    </div>
                                    <div class="mb-3 object">
                                        <label for="exampleFormControlInput1" class="form-label">Số người: </label>
                                        <input type="email" class="" id="exampleFormControlInput1" placeholder="">
                                    </div>
                                </div>
                                <div class="action d-flex">
                                    <div class="icon edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 ">
                            <div id="add" class=" ">
                                <video id="video" class="a-d-d d-none"></video>
                                <img src="../../public/image/uploads/<?php echo $info["kyHieu"] . $info["id"] . ".png" ?>" alt="add" class="a-d-d" id="anhdaidien">
                                <canvas id="canvas" class="d-none a-d-d"></canvas>
                            </div>

                            <div class="action d-flex justify-content-center">
                                <div class="icon edit">
                                    <i class="bi bi-camera-video-fill"></i>
                                </div>
                                <div class="icon render" id="render">
                                    <i class="bi bi-camera-fill"></i>
                                </div>
                                <div class="icon render" id="upload">
                                    <input type="file" class="d-none" id="inp_file" accept="image/*">
                                    <i class="bi bi-cloud-arrow-up-fill"></i>
                                </div>
                                <div class="icon save">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center ">
                            <form class="ttsv" id="form-info-sv" action="./sodophong.php" method="post">
                                <span>Thông tin sinh viên</span>
                                <div class="">
                                    <div class="mb-3 object d-none">
                                        <label for="exampleFormControlInput1" class="form-label">Id: </label>
                                        <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="idsv" value="<?php echo $info["kyHieu"] . $info["id"] ?>">
                                    </div>
                                    <div class="mb-3 object">
                                        <label for="exampleFormControlInput1" class="form-label">Id sinh viên: </label>
                                        <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="id" value="<?php echo $info["id"] ?>">
                                    </div>
                                    <div class="mb-3 object">
                                        <label for="exampleFormControlInput1" class="form-label">Họ tên: </label>
                                        <input type="email" class="" id="exampleFormControlInput1" placeholder="" name="hoten" value="<?php echo $info["hoTen"] ?>">
                                    </div>
                                    <div class="mb-3 object">
                                        <label for="exampleFormControlInput1" class="form-label">Tình trạng: </label>
                                        <select name="tinhtrang" id="tinhtrangsv" >
                                        <?php 
                                            $sql = "SELECT tinhtrang.id AS idtt, tinhtrang.tinhTrang AS tttt, (SELECT sinhvien.tinhTrang FROM sinhvien WHERE sinhvien.id = ?) AS ttsv FROM tinhtrang";
                                            $result = select_input($sql, [$_GET["idsv"]]);

                                            while($row = $result->fetch_assoc()) {
                                                if($row['idtt'] === $row["ttsv"]) {
                                                    echo '<option value="'.$row['idtt'].'"'. 'selected'.' >'.$row["tttt"].'</option>';
                                                }else {
                                                    echo '<option value="'.$row['idtt'].'"'.' >'.$row["tttt"].'</option>';
                                                }
                                            }
                                        ?> 
                                        </select>
                                    </div>
                                    <div class="mb-3 object">
                                        <label for="exampleFormControlInput1" class="form-label">Giới tính: </label>
                                        <?php
                                        if ($info["gioiTinh"] !== null) {
                                            if (!$info["gioiTinh"]) {
                                                echo '<input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gioitinh" value="1"> Nam
                                                <input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gioitinh" value="0" checked>Nữ';
                                            } else if ($info["gioiTinh"] == 1) {
                                                echo '<input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gioitinh" value="1" checked> Nam
                                                <input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gioitinh" value="0" >Nữ';
                                            } else {
                                                echo '<input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gioitinh" value="1"> Nam
                                                <input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gioitinh" value="0">Nữ';
                                            }
                                        } else {
                                            echo '<input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gioitinh" value="1"> Nam
                                            <input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gioitinh" value="0">Nữ';
                                        }
                                        ?>
                                    </div>
                                    <div class="mb-3 object">
                                        <label for="exampleFormControlInput1" class="form-label">Năm sinh: </label>
                                        <input type="date" class="" id="exampleFormControlInput1" placeholder="" name="namsinh" value="<?php echo $info["namSinh"] ?>">
                                    </div>
                                    <div class="mb-3 object">
                                        <label for="exampleFormControlInput1" class="form-label">SĐT: </label>
                                        <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="sdt" value="<?php echo $info["sdt"] ?>">
                                    </div>

                                    <div class="mb-3 object">
                                        <label for="exampleFormControlInput1" class="form-label">Quê quán: </label>
                                        <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="quequan" value="<?php echo $info["queQuan"] ?>">
                                    </div>
                                    <div class="mb-3 object">
                                        <label for="exampleFormControlInput1" class="form-label">SoCCCD: </label>
                                        <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="cccd" value="<?php echo $info["soCCCD"] ?>">
                                    </div>
                                    <div class="mb-3 object">
                                        <label for="exampleFormControlInput1" class="form-label">Nghề nghiệp: </label>
                                        <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="nghenghiep" value="<?php echo $info["ngheNghiep"] ?>">
                                    </div>
                                    <div class="mb-3 object">
                                        <label for="exampleFormControlInput1" class="form-label">Trường: </label>
                                        <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="truong" value="<?php echo $info["truong"] ?>">
                                    </div>
                                    <div class="mb-3 object">
                                        <label for="exampleFormControlInput1" class="form-label">Ngày vào: </label>
                                        <input type="date" class="" id="exampleFormControlInput1" placeholder="" name="ngayVao" value="<?php echo $info["ngayVao"] ?>">
                                    </div>
                                    <div class="mb-3 object">
                                        <label for="exampleFormControlInput1" class="form-label">Ngày ra: </label>
                                        <input type="date" class="" id="exampleFormControlInput1" placeholder="" name="ngayra" value="<?php echo $info["ngayRa"] ?>">
                                    </div>

                                    <div class="mb-3 object">

                                        <div class="input-group mb-3">
                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <label for="exampleFormControlInput1" class="form-label">Hợp đồng:
                                                    </label>
                                                    <input type="text" class="" id="exampleFormControlInput1" placeholder="" style="padding-left: 5px; width: 50%;" name="hopdong" value="<?php echo $info["maHD"] ?>">
                                                </div>
                                                <div class="">
                                                    <a class="input-group-text" id="basic-addon2" href=" <?php echo $info["maHD"] ?>" style="margin: 0 auto; display: block;">Tới</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="action d-flex">
                                        <div class="icon edit no-write">
                                            <i class="bi bi-pencil-fill"></i>
                                            
                                        </div>
                                        <div class="icon save d-none">
                                            <i class="bi bi-check-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                <?php }}else {
                    echo '<div class="bi-text-center">Không có thông tin</div>';
                } ?>
                
            </div>
        </div>
    </div>

    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/jquery.js"></script>
    <script src="../../public/js/thongtinsv.js"></script>
    <script src="../../public/js/toast.js"></script>
</body>

</html>