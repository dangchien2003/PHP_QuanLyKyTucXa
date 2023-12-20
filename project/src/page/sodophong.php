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
</head>

<body>
    <header class="text-white ">
        <div class="logo"><div class="" style="width: 100%;">logo</div></div>
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
                    <li class="parent-menu position-relative on">
                        <i class="bi bi-door-open"></i>
                        Quản lý sinh viên
                        <span class="arrow position-absolute">
                            <i class="bi bi-chevron-left left d-none"></i>
                            <i class="bi bi-chevron-down down"></i>
                        </span>
                    </li>
                    <ul class="list-unstyled sub-menu">
                        <li>
                            <i class="bi bi-border-style"></i>
                            <a href="./thongtinsv.php?idsv=1">Thông tin sinh viên</a>
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
        <div class="col-lg-9 sdp" style="height: 1000px;">
            <div class="box">
                <div class="name">
                    <i class="bi bi-building"></i>Sơ đồ phòng
                </div>
                <div class="find">
                    <div class="find-tang ">
                        <div class="fs-15 fw-500">Tầng:</div>
                        <select class="form-select " aria-label="Default select example">
                            <option value = "0" >Tất cả</option>
                            <option value="1">Tầng 1</option>
                            <option value="2">Tầng 2</option>
                            <option value="3">Tầng 3</option>
                          </select>
                    </div>
                    <div class="ttp">
                        <div class="fs-15 fw-500">Tình trạng phòng:</div>
                        <nav class="navbar navbar-light ">
                            <form class="container-fluid justify-content-start pd-0">
                              <a href="#" class="mgr-10"><button class="btn me-2" type="button">Tất cả</button></a>
                              <a href="#"><button class="btn me-2" type="button"><img src="../../public/image/icon/audience.png" alt="" class="img-icon">Đang ở</button></a>
                              <a href="#"><button class="btn me-2" type="button"><img src="../../public/image/icon/null.png" alt="" class="img-icon">Phòng trống</button></a>
                            </form>
                          </nav>
                    </div>
                </div>
                <div class="list-room">
                    <?php
                        include '../handle/phong.php';
                        $sql = "SELECT sinhvien.id as idsv, phong.sucChua, CONCAT(phong.kyHieu, phong.maPhong) AS phong, tinhtrang.tinhTrang, phong.tinhTrang as matt, COUNT(phong.maPhong) as soNguoi FROM phong LEFT JOIN sinhvien ON sinhvien.maPhong = phong.maPhong LEFT JOIN tinhTrang on tinhTrang.id = phong.tinhTrang GROUP BY phong.maPhong;";
                        printListRoom($sql);
                    ?> 
                    
                </div>
            </div>
        </div>
    </div>


    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/jquery.js"></script>
    <script src="../../public/js/sodophong.js"></script>
</body>

</html>