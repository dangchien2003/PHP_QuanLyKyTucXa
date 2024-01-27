<?php include './layout/header.php';
//   include_once '../handle/checkAccount.php'
?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="min-height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-clipboard"></i>Danh sách thẻ

            </div>
            <div class="ttp">
                <div class="fs-15 fw-500">Tình trạng thẻ:</div>
                <nav class="navbar navbar-light ">
                    <form class="container-fluid justify-content-start pd-0">
                        <a href="dsthe.php" class="mgr-10"><button class="btn me-3"
                                style="box-shadow: 5px 5px 6px 6px lightblue" type="button">Tất cả</button></a>
                        <a href="dsthe.php?tt=15"><button class="btn bgr-ok me-3" type="button"><img
                                    src="../../public/image/icon/audience.png" alt="" class="img-icon">Đang hoạt
                                động</button></a>
                        <a href="dsthe.php?tt=14"><button class="btn bgr-error me-3" type="button"><img
                                    src="../../public/image/icon/null.png" alt="" class="img-icon">Khoá</button></a>
                        <a href="dsthe.php?tt=16"><button class="btn bgr-wait me-3" type="button"><img
                                    src="../../public/image/icon/null.png" alt="" class="img-icon">Chờ
                                duyệt</button></a>
                        <a href="dsthe.php?tt=10"><button class="btn bgr-no-ok me-3" type="button"><img
                                    src="../../public/image/icon/null.png" alt="" class="img-icon">Báo mất</button></a>
                        <a href="themthe.php"><button class="btn btn-success me-3" type="button"><img
                                    src="../../public/image/icon/them.png" alt="" class="img-icon">Thêm thẻ xe</button></a>


                    </form>
                </nav>
                <div class="row g-3">
                <div class="col-md-6">
                    <input type="" class="form-control" style="margin-top: 15px;" id="input" placeholder="Nhập...">
                </div>
                <div class="col-auto">
                    <a href=""></a>
                    <button id="timkiem" class="btn btn-primary mb-3" style="margin-top: 15px" ;>Tìm kiếm</button>
                </div>
               
            </div>
            <div class="table-sv">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Chủ Xe</th>
                            <th scope="col">Biển số xe</th>
                            <th scope="col">Loại xe</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $result = null;
                        // kiểm tra nếu có key filltẻ trên url và có giá trị
                        if (checkRequest($_GET, ['fillter'], false)) {
                            // câu sql
                            $sql = "SELECT thexe.id, sinhvien.hoTen, bienSo, tenXe, tinhTrang.tinhTrang, tinhtrang.id as idtt FROM thexe JOIN sinhvien ON sinhvien.id = thexe.chuXe JOIN tinhtrang ON tinhtrang.id = thexe.tinhTrang WHERE sinhvien.hoTen = ? OR thexe.bienSo = ?";
                            // truy vâấ caâ sql
                            $result = query_input($sql, [$_GET['fillter'], $_GET['fillter']]);

                        } else {
                            // nếu không có key fillter hoặc không có giá trị
                            $sql = "SELECT thexe.id, sinhvien.hoTen, bienSo, tenXe, tinhTrang.tinhTrang, tinhtrang.id as idtt FROM thexe JOIN sinhvien ON sinhvien.id = thexe.chuXe JOIN tinhtrang ON tinhtrang.id = thexe.tinhTrang WHERE sinhvien.hoTen = sinhvien.hoTen OR thexe.bienSo = thexe.bienSo";
                            $result = query_no_input($sql);
                        }
                        // khởi tạo biến để gắn giá trị vào câu lệnh sql
                        $tt = "thexe.tinhtrang";

                        // kiểm trả sự tồn tại trên url có key tt hay kh
                        if (checkRequest($_GET, ["tt"], false)) {
                            // kiểm tra giá trị của  key tt trên url
                            switch ($_GET['tt']) {
                                // nếu giá trị của key tt trên url =16 thì
                                case 16:
                                    // gán id tình trạng tuơng ứng
                                    $tt = 16;
                                    break;
                                case 15:
                                    $tt = 15;
                                    break;
                                case 14:
                                    $tt = 14;
                                    break;
                                case 10:
                                    $tt = 10;
                                    break;
                            }
                            $sql = "SELECT thexe.id, sinhvien.hoTen, bienSo, tenXe, tinhTrang.tinhTrang, tinhtrang.id as idtt FROM `thexe` JOIN sinhvien ON sinhvien.id = thexe.chuXe JOIN tinhtrang ON tinhtrang.id = thexe.tinhTrang WHERE thexe.tinhTrang=$tt;";
                            $result = query_no_input($sql);
                        }


                        if ($result->num_rows == 0) {
                            echo '<div class="bi-text-center">Không có thông tin</div>';
                        } else {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row["id"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["hoTen"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["bienSo"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["tenXe"] ?>
                                    </td>

                                    <td>
                                        <?php
                                        $class = null;
                                        switch ($row['idtt']) {
                                            case 10:
                                                $class = "bgr-no-ok";
                                                break;
                                            case 15:
                                                $class = "bgr-ok";
                                                break;
                                            case 14:
                                                $class = "bgr-error";
                                                break;
                                            default:
                                                $class = "bgr-wait";
                                                break;
                                        }
                                        ?>
                                        <div class="btn-tt <?php echo $class; ?>">
                                            <?php echo $row['tinhTrang'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="thongtinthe.php?id=<?php echo $row['id'] ?>">
                                            <div class="btn-tt d-inline-block bgr-info">Xem</div>
                                        </a>
                                        <?php
                                        if ($row["idtt"] == 14) {
                                            ?>
                                            <a href="../handle/mothe.php?id=<?php echo $row['id'] ?>">
                                                <div class="btn-tt d-inline-block bgr-ok">Mở khoá</div>
                                            </a>
                                            <?php

                                        } else {
                                            ?>
                                            <a href="../handle/khoathe.php?id=<?php echo $row['id'] ?>">
                                                <div class="btn-tt d-inline-block bgr-error">Khoá thẻ</div>
                                            </a>
                                            <?php
                                        }
                                        ?>


                                    </td>

                                </tr>
                                <?php

                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        // Lấy thẻ HTML có id là "myElementId"
        // lây ra thẻ button co id là timkiem
        const tk = document.getElementById('timkiem');
        // lấu ra thẻ input có id là input
        const nhap = document.getElementById('input');
        tk.addEventListener('click', function () {
            // lây dữ liệu ô input
            const nhapp = nhap.value;
            // hàm trim() để xoá khoảng trắng đầu và cuối của 1 biến
            // nếu có ký tự sau khi xoá khaongr trắng  thì xử lý nếu không thì không xử lý
            if (nhapp.trim() != "") {
                // Lấy URL hiện tại
                let currentURL = new URL(window.location.href);
                // Khởi tạo một URLSearchParams từ query string hiện tại
                let searchParams = currentURL.searchParams;

                // Xóa tất cả các tham số trong query string
                searchParams.forEach((value, key) => {
                    searchParams.delete(key);
                });

                // Thêm hoặc chỉnh sửa tham số 't' trong query string
                // thêm key là filltẻ và value là dữ liệu ô input
                searchParams.set('fillter', nhapp);

                // Gán lại query string đã chỉnh sửa vào URL
                currentURL.search = searchParams.toString();
                // console.log(searchParams.toString());

                // Chuyển hướng trang đến URL mới và tải lại trang
                window.location.href = currentURL;
            }
        });
    </script>
    <?php include './layout/footer.php' ?>