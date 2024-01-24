<?php include './layout/header.php';
include '../handle/checkAccount.php' ?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="min-height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-receipt-cutoff"></i>Hoá đơn phòng
            </div>
            <div class="find">
                <div class="row">
                    <div class="find-tang col-md-3">
                        <div class="fs-15 fw-500">Tầng:</div>
                        <select class="form-select " aria-label="Default select example" id="fillter_t">
                            <option value="0" <?php if (checkRequest($_GET, ['t'], true)) {
                                if ($_GET['t'] == 0) {
                                    echo "selected";
                                }
                            } ?>>Tất cả</option>
                            <?php
                            $sql = "select max(tang) as maxtang from phong";
                            $result = query_no_input($sql);
                            $max = 0;
                            while ($row = $result->fetch_assoc()) {
                                $max = $row['maxtang'];
                            }

                            for ($i = 1; $i <= $max; $i++) {
                                ?>
                                <option value="<?php echo $i; ?>" <?php if (checkRequest($_GET, ['t'], true)) {
                                       if ($_GET['t'] == $i) {
                                           echo "selected";
                                       }
                                   } ?>>Tầng <?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="ngaychot col-md-3">
                        <div class="fs-15 fw-500">Ngày chốt:</div>
                        <input type="date" class="btn me-2"
                            style="margin: 10px 0; box-shadow: none; border :1px solid #ced4da;" name = "ngaychot" id="ngaychot" value="<?php echo $_GET['ngaychot']??""?>">
                    </div>
                </div>
                <div class="ttp">
                    <div class="fs-15 fw-500">Trạng thái:</div>
                    <nav class="navbar navbar-light">
                        <div class="container-fluid justify-content-start pd-0" id="form_fillter">
                            <button class="btn me-2 tt" type="button"
                                    id="tatca">Tất cả</button>
                            <button class="btn me-2 tt" type="button" id="dango"><img
                                        src="../../public/image/icon/close.png" alt="" class="img-icon">Chờ thanh toán</button>
                            <button class="btn me-2 tt" type="button" id="daroidi"><img
                                        src="../../public/image/icon/check.png" alt="" class="img-icon">Đã thanh toán</button>
                            <input type="text" class="btn me-2" placeholder="Mã phòng" id="find_MP" value="<?php echo $_GET["mp"]??null?>">
                        </div>
                    </nav>

                </div>
                <div class="table-sv">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Sinh viên</th>
                                <th scope="col">Liên hệ</th>
                                <th scope="col">Giá phòng</th>
                                <th scope="col">Vệ sinh</th>
                                <th scope="col">Ngày chốt</th>
                                <th scope="col">Số tháng</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <?php
                        $timestamp = null;
                        $tang = 'phong.tang';
                        $tinhtrang = 'hoadonphong.tinhtrang';
                        $sinhvien = 'hoadonphong.toi';

                        if(checkRequest($_GET, ['t'])) {
                            $tang = $_GET['t'];
                        }
                        if(checkRequest($_GET, ['tt'])) {
                            $tinhtrang = $_GET['tt'];
                        }
                        if(checkRequest($_GET, ['mp'])) {
                            $maphong = $_GET['mp'];
                        }

                        if(checkRequest($_GET, ['ngaychot'])) {
                            $timestamp = strtotime($_GET['ngaychot']);
                        }else {
                            $timestamp = getTimestamp(0);
                        }
                        $nam = date('Y', $timestamp);
                        $thang = date('m', $timestamp);
                        $sql = "SELECT concat(hoadonphong.kyHieu, hoadonphong.maHoaDon) as mahd, concat(phong.kyHieu,sinhvien.maPhong,'-',sinhvien.kyHieu,hoadonphong.toi, '-', sinhvien.hoten) as sinhvien, giaPhong, giaVeSinh, ngayChot, tongTien, tinhtrang.tinhTrang as tt, hoadonphong.tinhtrang as idtt, soThang, sinhvien.sdt FROM hoadonphong JOIN sinhvien on sinhvien.id = hoadonphong.toi JOIN tinhtrang on tinhtrang.id = hoadonphong.tinhtrang JOIN phong on sinhvien.maPhong = phong.maPhong where month(ngayChot) = ? and year(ngayChot) = ? and phong.tang = $tang and hoadonphong.tinhtrang = $tinhtrang and hoadonphong.toi = $sinhvien";
                        $result = query_input($sql, [$thang, $nam]);
                        if ($result->num_rows > 0) {
                            ?>
                            <tbody id="body_table">
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['mahd'] ?> 
                                        </td>
                                        <td>
                                            <?php echo $row['sinhvien'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['sdt'] ?>
                                        </td>
                                        <td>
                                        <?php echo $row['giaPhong'] ?>
                                        </td>
                                        <td>
                                        <?php echo $row['giaVeSinh'] ?>
                                        </td>
                                        <td>
                                        <?php echo $row['ngayChot'] ?>
                                        </td>
                                        <td>
                                        <?php echo $row['soThang'] ?>
                                        </td>
                                        <td>
                                        <?php echo $row['tongTien'] ?>
                                        </td>
                                        <td>
                                            <?php
                                            if($row['idtt'] == 6) {
                                                ?> 
                                                <div class="btn-tt bgr-ok">
                                                <?php echo $row['tt'] ?>
                                                </div>
                                                <?php 
                                            }else {
                                                ?> 
                                                <div class="btn-tt bgr-wait">
                                                <?php echo $row['tt'] ?>
                                                </div>
                                                <?php 
                                            }
                                            ?> 
                                        </td>
                                        <td>
                                            <a href="./thongtinsv.php?id=1" class="show">
                                                <div class="btn-tt d-inline-block bgr-ok">Xem</div>
                                            </a>
                                            <?php
                                            if($row['idtt'] == 5) {
                                                ?> 
                                                <a href="../handle/noptien.php?hoadon=phong&mahd=<?php echo $row['mahd'] ?>" class="show" onclick="return confirm('Xác nhận nộp tiền <?php echo $row['mahd'] ?>')">
                                                    <div class="btn-tt d-inline-block bgr-info">Nộp tiền</div>
                                                </a>
                                                <?php 
                                            }
                                            ?> 
                                        </td>
                                    </tr>

                                <?php
                                }
                                ?>
                            </tbody>
                        <?php
                        } else {
                            echo '<div class="bi-text-center">Không có thông tin</div>';
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './layout/footer.php';
addScript(['hoadon']) ?>