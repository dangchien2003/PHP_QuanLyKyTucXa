<?php include './layout/header.php';
$user = null;
if (!$user && checkRequest($_SESSION, ['account'])) {
    $user = $_SESSION['account']['username'];
} else if (!$user && checkRequest($_COOKIE, ['account'])) {
    $account = giaiMa($_COOKIE['account']);
    $user = $account['username'];
} ?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="min-height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-building-add"></i>Thêm phòng ở
            </div>
            <div class="row quyencuatoi">
                <div class="col-md-3">
                    <h6>Quyền của tôi</h6>
                    <?php
                    $sql = "SELECT chucvu.chucDanh FROM quyenchinh JOIN chucvu on chucvu.id = quyenchinh.quyen where quyenchinh.user = ?";
                    $result = query_input($sql, [$user]);
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="row" id="xxxhh">
                            <div class="col-md-9">
                                <?php echo $row['chucDanh'] ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-md-3" style="border: 1px solid #ececec; border-top: none; border-bottom: none;">
                    <h6>Đang cho quyền</h6>
                    <?php
                    $sql = "SELECT chucvu.chucDanh, quyentruycap.id, quyentruycap.user FROM quyentruycap JOIN quyen ON quyentruycap.quyen = quyen.idQuyen JOIN chucvu on chucvu.id = quyen.quanLy where quyentruycap.userAdmin = ? and thoigiancap is not null and thoigianthuhoi is null";
                    $result = query_input($sql, [$user]);
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="row" id="xxxhh">
                            <div class="col-md-9">
                                <?php echo $row['user'] ?> -
                                <?php echo $row['chucDanh'] ?>
                            </div>
                            <div class="col-md-3">
                                <a href="../handle/thuhoiquyen.php?id=<?php echo $row['id'] ?>"><i
                                        class="bi bi-x-circle-fill cancle" style="color: #f43232;"></i></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-md-3">
                    <h6>Đang xin quyền</h6>
                    <?php
                    $sql = "SELECT chucvu.chucDanh, quyentruycap.id, quyentruycap.user FROM quyentruycap JOIN quyen ON quyentruycap.quyen = quyen.idQuyen JOIN chucvu on chucvu.id = quyen.quanLy where quyentruycap.user = ? and thoigiancap is not null and thoigianthuhoi is null";
                    $result = query_input($sql, [$user]);
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="row" id="xxxhh">
                            <div class="col-md-9">
                                <?php echo $row['user'] ?> -
                                <?php echo $row['chucDanh'] ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-md-3" style="border-left: 1px solid #ececec;">
                    <h6>Xin quyền</h6>
                    <?php
                    $sql = "SELECT concat(nhanvien.user, '-', quyen.idQuyen) as quyen, concat(nhanvien.user, '-', chucvu.chucDanh) as chucvu from chucvu JOIN nhanvien on nhanvien.chucVu = chucvu.id join quyen on quyen.quanLy = chucvu.id";
                    $result = query_no_input($sql);

                    ?>
                    <form action="../handle/xinquyen.php" method="post">
                        <select class="form-select" name="quyen">
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row['quyen'] ?>">
                                    <?php echo $row['chucvu'] ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                        <button class="btn btn-success" style="margin: 10px 0;">Gửi</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include './layout/footer.php' ?>