<?php
include '../handle/helper.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/toast.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
                    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                        <div class="navbar-nav" style="font-weight: 500;">
                            <a class="nav-link active text-white" aria-current="page" href="#"><i
                                    class="bi bi-telephone-forward-fill p-1 fs-5"></i>Điện thoại hỗ trợ: 0333444555</a>
                            <a class="nav-link active text-white" aria-current="page" href="#">Quyền của tôi</a>
                            <a class="nav-link active text-white" aria-current="page" href="#"><i
                                    class="bi bi-bell-fill"></i></a>
                            <a class="nav-link text-white" href="#"><img src="../../public/image/bg-login.jfif"
                                    alt=""></a>
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
        <div class="col-lg-9 sdp tp" style="height: 1000px;">
            <div class="box">
                <div class="name">
                    <i class="bi bi-building-add"></i>Thêm phòng ở
                </div>
                <div class="form-add row">
                    <div class="col-md-3">
                        <div class="icon">
                            <img src="../../public/image/icon/room.png" alt="" class="object">
                            <img src="../../public/image/icon/plus.png" alt="" class="action">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <form action="../handle/themphong.php" method="post">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="exampleFormControlInput1" class="form-label">Ký hiệu phòng:</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="P"
                                        name="kyhieu" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleFormControlInput1" class="form-label">Mã phòng:</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="maphong"
                                        required>
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleFormControlInput1" class="form-label">Tầng:</label>
                                    <select class="form-select" aria-label="Default select example" name="tang"
                                        required>
                                        <option value="1" selected>1</option>
                                        <?php
                                        $sql = "SELECT MIN(tang) as min, MAX(tang) as max from phong";
                                        $result = query_no_input($sql);
                                        $min = 0;
                                        $max = 0;
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $min = $row["min"];
                                                $max = $row["max"];
                                            }

                                            for ($i = 2; $i <= $max; $i++) {
                                                ?>
                                                <option value="<?php echo $i; ?>">
                                                    <?php echo $i; ?>
                                                </option>
                                                <?php

                                            }
                                        }
                                        ?>
                                        <option value="0">Khác</option>

                                    </select>
                                </div>
                                <div class="col-md-2" style="padding: 0;">
                                    <label for="exampleFormControlInput1" class="form-label"></label>
                                    <input type="number" class="form-control d-none" id="exampleFormControlInput1"
                                        name="sotang" style="margin-top: 13px; width: 70px;" value="1" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="exampleFormControlInput1" class="form-label">Sức chứa:</label>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" value="P"
                                        name="succhua" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="exampleFormControlInput1" class="form-label">Tình trạng:</label>
                                    <select class="form-select" aria-label="Default select example" name="tinhtrang"
                                        required>
                                        <?php
                                        $sql = "SELECT tinhtrang, id from tinhtrang";
                                        $result = query_no_input($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row["id"] ?> " <?php if ($row["id"] == 18) {
                                                        echo 'selected';
                                                    } ?>>
                                                    <?php echo $row["tinhtrang"]; ?>
                                                </option>
                                                <?php

                                            }
                                        } else {
                                            echo '<option value="0" selected>Phòng trống</option>';
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Tạo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/jquery.js"></script>
    <script src="../../public/js/menu.js"></script>
    <script src="../../public/js/toast.js"></script>
    <script src="../../public/js/app.js"></script>
    <script>
        $(document).ready(function () {
            $('select[name="tang"]').change(function () {
                if ($('select[name="tang"]').val() == 0) {
                    $('input[name="sotang"]').removeClass('d-none');
                } else {
                    $('input[name="sotang"]').addClass('d-none');
                }
            })
            $('input[name="sotang"]:first').on('input', function () {
                var value = parseInt($(this).val());
                if (value <= 0) {
                    $(this).val(1);
                }
            });
            $('input[name="succhua"]:first').on('input', function () {
                var value = parseInt($(this).val());
                if (value < 0) {
                    $(this).val(0);
                }
            });
        })
    </script>
</body>

</html>