<?php include './layout/header.php';
?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="min-height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-house-door-fill"></i>Thông tin hoá đơn phòng
            </div>
            <div class="form-add row">
                <div class="col-md-3">
                    <div class="icon">
                        <img src="../../public/image/icon/motobike.png" alt="" class="object">
                    </div>
                </div>
                <form action="../handle/suahdguixe.php" method="post" class="col-md-7">
                    <?php
                    if (checkRequest($_GET, ["mahd"])) {
                        // lấy thông tin hoá đơn
                        $sql = "SELECT concat(thexe.kyHieu, thexe.id) as mathe, tongTien, ngayChot, hoadonguixe.tinhTrang FROM hoadonguixe JOIN thexe ON hoadonguixe.idTheXe = thexe.id WHERE concat(hoadonguixe.kyHieu, hoadonguixe.maHoaDon) = ?;";
                        $result = query_input($sql, [$_GET['mahd']]);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1" class="form-label">Hoá đơn:</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            value="Gửi xe" required readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="exampleFormControlInput1" class="form-label">Mã HĐ:</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $_GET['mahd'] ?>"
                                            name="mahd" required readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1" class="form-label">Thẻ: </label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['mathe'] ?>"
                                            required readonly>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-2">
                                    <label for="exampleFormControlInput1" class="form-label">Số tiền: </label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['tongTien'] ?>"
                                           name="tongtien" required >
                                    </div>
                                    <div class="col-md-5">
                                        <label for="exampleFormControlInput1" class="form-label">Tình trạng:</label>
                                        <select class="form-select" aria-label="Default select example" name="tinhtrang" required>
                                            <?php
                                            $sql = "SELECT tinhtrang, id from tinhtrang";
                                            $result = query_no_input($sql);
                                            if ($result->num_rows > 0) {
                                                while ($rowtt = $result->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $rowtt["id"] ?>" <?php if ($rowtt["id"] == $row['tinhTrang']) {
                                                           echo 'selected';
                                                       } ?>>
                                                        <?php echo $rowtt["tinhtrang"]; ?>
                                                    </option>
                                                    <?php

                                                }
                                            } else {
                                                echo '<option value="0" selected>Phòng trống</option>';
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1" class="form-label">Ngày chốt:</label>
                                        <input type="date" class="form-control" id="tongtien" value="<?php echo $row['ngayChot'] ?>" required readonly>
                                    </div>
                                </div>
                                <input type="submit" class="btn d-inline-block bgr-ok"
                                    onclick="return confirm('Xác nhận chỉnh sửa')" value="Sửa" name="sua">
                            <?php
                            }
                        } else {
                            echo '<div class="bi-text-center">Không có thông tin</div>';
                        }
                    } else {
                        echo '<div class="bi-text-center">Không có thông tin</div>';
                    }

                    ?>

                </form>
            </div>
        </div>
    </div>
</div>

<?php include './layout/footer.php' ?>
<script>
    $(document).ready(function () {
        var giaphong = $("#giaphong");
        var vesinh = $("#vesinh");
        var tong = $("#tongtien");
        $(giaphong).on("change", tinhtong);
        $(vesinh).on("change", tinhtong);
        function tinhtong() {
            let tien = ($(giaphong).val() * 1) + ($(vesinh).val() * 1);
            $(tong).val(tien);
        }
    });
</script>