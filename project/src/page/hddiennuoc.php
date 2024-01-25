<?php include './layout/header.php';
include '../handle/checkAccount.php' ?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="min-height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-receipt-cutoff"></i>Hoá đơn điện nước
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
                            style="box-shadow: none; border :1px solid #ced4da;" name = "ngaychot" id="ngaychot" value="<?php echo $_GET['ngaychot']??""?>">
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
                                <th scope="col">Mã phòng</th>
                                <th scope="col">Đại diện phòng</th>
                                <th scope="col">SĐT liên hệ</th>
                                <th scope="col">Ngày chốt</th>
                                <th scope="col">Số điện</th>
                                <th scope="col">Số nước</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <?php
                        $timestamp = null;
                        $tang = 'phong.tang';
                        $tinhtrang = 'hoadondiennuoc.tinhtrang';
                        $maphong = 'hoadondiennuoc.toi';

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
                        $sql = "SELECT concat(hoadondiennuoc.kyHieu, hoadondiennuoc.maHoaDon) as mahd, hoadondiennuoc.toi as maphong, soDienMoi-soDienCu as sodien, soNuocMoi-soNuocCu as sonuoc, hoadondiennuoc.ngayChot, tinhtrang.tinhTrang, hoadondiennuoc.tinhtrang as idtt,  concat(sinhvien.kyHieu,sinhvien.id,'-',sinhvien.hoTen) as daidien, hoadondiennuoc.tongTien, sinhvien.sdt from hoadondiennuoc JOIN phong on phong.maPhong = hoadondiennuoc.toi JOIN sinhvien ON sinhvien.id = phong.nguoiDaiDien JOIN tinhtrang on tinhtrang.id = hoadondiennuoc.tinhtrang where month(ngayChot) = ? and year(ngayChot) = ? and phong.tang = $tang and hoadondiennuoc.tinhtrang = $tinhtrang and hoadondiennuoc.toi = $maphong";
                        
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
                                            <?php echo $row['maphong'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['daidien'] ?>
                                        </td>
                                        <td>
                                        <?php echo $row['sdt'] ?>
                                        </td>
                                        <td>
                                        <?php echo $row['ngayChot'] ?>
                                        </td>
                                        <td>
                                        <?php echo $row['sodien'] ?>
                                        </td>
                                        <td>
                                        <?php echo $row['sonuoc'] ?>
                                        </td>
                                        <td>
                                        <?php echo $row['tongTien'] ?>
                                        </td>
                                        <td>
                                            <?php
                                            if($row['idtt'] == 6) {
                                                ?> 
                                                <div class="btn-tt bgr-ok">
                                                <?php echo $row['tinhTrang'] ?>
                                                </div>
                                                <?php 
                                            }else {
                                                ?> 
                                                <div class="btn-tt bgr-wait">
                                                <?php echo $row['tinhTrang'] ?>
                                                </div>
                                                <?php 
                                            }
                                            ?> 
                                        </td>
                                        <td>
                                            <a href="./tthddiennuoc.php?hoadon=diennuoc&mahd=<?php echo $row['mahd'] ?>" class="show">
                                                <div class="btn-tt d-inline-block bgr-ok">Xem</div>
                                            </a>
                                            <?php
                                            if($row['idtt'] == 5) {
                                                ?> 
                                                <a href="../handle/noptien.php?hoadon=diennuoc&mahd=<?php echo $row['mahd'] ?>" class="show" onclick="return confirm('Xác nhận nộp tiền <?php echo $row['mahd'] ?>')">
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