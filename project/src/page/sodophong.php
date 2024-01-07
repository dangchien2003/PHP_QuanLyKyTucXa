<?php include_once 'layout/header.php' ?>
<?php include_once  '../handle/checkAccount.php'
?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include_once 'layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp" style="height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-building"></i>Sơ đồ phòng
            </div>
            <div class="find">
                <div class="find-tang ">
                    <div class="fs-15 fw-500">Tầng:</div>
                    <select class="form-select " aria-label="Default select example" id="tang">
                        <option value="0">Tất cả</option>
                        <?php
                        require_once '../handle/helper.php';
                        $sql = "SELECT max(tang) as maxtang from phong";
                        $result = query_no_input($sql);
                        while ($row = $result->fetch_assoc()) {
                            for ($i = 1; $i <= $row['maxtang']; $i++) {
                                if (checkRequest($_GET, ['t'])) {
                                    if ($i == $_GET['t']) {
                                        ?>
                                        <option value="<?php echo $i ?>" selected>Tầng
                                            <?php echo $i ?>
                                        </option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $i ?>">Tầng
                                            <?php echo $i ?>
                                        </option>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option value="<?php echo $i ?>">Tầng
                                        <?php echo $i ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="ttp">
                    <div class="fs-15 fw-500">Tình trạng phòng:</div>
                    <nav class="navbar navbar-light ">
                        <form class="container-fluid justify-content-start pd-0">
                            <a href="sodophong.php?tt=0" class="mgr-10"><button class="btn me-2" type="button">Tất
                                    cả</button></a>
                            <a href="sodophong.php?tt=15"><button class="btn me-2" type="button"><img
                                        src="../../public/image/icon/audience.png" alt="" class="img-icon">Đang hoạt
                                    động</button></a>
                            <a href="sodophong.php?tt=18"><button class="btn me-2" type="button"><img
                                        src="../../public/image/icon/null.png" alt="" class="img-icon">Phòng
                                    trống</button></a>
                            <a href="sodophong.php?tt=1518"><button class="btn me-2" type="button"><img
                                        src="../../public/image/icon/other.png" alt="" class="img-icon">Khác</button></a>
                        </form>
                    </nav>
                </div>
            </div>
            <div class="list-room">
                <?php
                include '../handle/phong.php';
                $mqh = "";
                $w1 = null;
                $w2 = null;
                $inp = false;
                $tang = "phong.tang";
                if (checkRequest($_GET, ["tt"])) {
                    switch ($_GET["tt"]) {
                        case 15:
                            $w1 = $w2 = 15;
                            $inp = true;
                            break;
                        case 18:
                            $w1 = $w2 = 18;
                            $inp = true;
                            break;
                        case 1518:
                            $mqh = "not";
                            $w1 = 15;
                            $w2 = 18;
                            $inp = true;
                            break;
                    }
                }

                if (checkRequest($_GET, ["t"])) {
                    if (ctype_digit($_GET['t'])) {
                        $tang = $_GET['t'];
                    }
                }
                if (!$inp) {
                    $sql = "SELECT sinhvien.id as idsv, phong.sucChua, CONCAT(phong.kyHieu, phong.maPhong) AS phong, tinhtrang.tinhTrang, phong.tinhTrang as matt, COUNT(phong.maPhong) as soNguoi FROM phong LEFT JOIN sinhvien ON sinhvien.maPhong = phong.maPhong LEFT JOIN tinhTrang on tinhTrang.id = phong.tinhTrang where (sinhvien.tinhTrang != 1 or sinhvien.tinhTrang is null) and phong.tang = $tang GROUP BY phong.maPhong  order by phong.tang , phong.kyHieu, phong.kyHieu,phong.maphong;";
                    // không input
                    printListRoom($sql);
                } else {
                    $sql = "SELECT sinhvien.id as idsv, phong.sucChua, CONCAT(phong.kyHieu, phong.maPhong) AS phong, tinhtrang.tinhTrang, phong.tinhTrang as matt, COUNT(phong.maPhong) as soNguoi FROM phong LEFT JOIN sinhvien ON sinhvien.maPhong = phong.maPhong LEFT JOIN tinhTrang on tinhTrang.id = phong.tinhTrang where (sinhvien.tinhTrang != 1 or sinhvien.tinhTrang is null) and (phong.tinhTrang $mqh in (?, ?)) and phong.tang = $tang GROUP BY phong.maPhong order by phong.tang, phong.kyHieu, phong.kyHieu, phong.maphong;";
                    // có inpout
                    printListRoom($sql, [$w1, $w2]);
                }
                ?>

            </div>
        </div>
    </div>
</div>

<?php include 'layout/footer.php' ?>
<script>
    $(document).ready(function () {
        $("#tang").on("change", function () {
            addParams('t', $('#tang').val());
            location.reload();
        })
    })
</script>