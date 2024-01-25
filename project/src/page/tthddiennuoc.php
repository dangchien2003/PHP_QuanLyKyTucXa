<?php include './layout/header.php';
    // include '../handle/checkAccount.php';
?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="min-height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-droplet-fill"></i>Thông tin hoá đơn điện nước
            </div>
            <div class="form-add row">
                <div class="col-md-3">
                    <div class="icon">
                        <img src="../../public/image/icon/electric.png" alt="" class="object">
                    </div>
                </div>
                <form action="../handle/suahddiennuoc.php" method="post" class="col-md-7" id="form">
                    <?php
                    if (checkRequest($_GET, ["mahd"])) {
                        // lấy thông tin hoá đơn
                        $sql = "SELECT soDienCu, soDienMoi, soNuocCu, soNuocMoi, ngayChot, tongTien, concat(phong.kyHieu, phong.maPhong) as phong, hoadondiennuoc.tinhtrang from hoadondiennuoc JOIN phong ON phong.maPhong = hoadondiennuoc.toi where concat(hoadondiennuoc.kyHieu, hoadondiennuoc.maHoaDon) = ?";
                        $result = query_input($sql, [$_GET['mahd']]);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1" class="form-label">Hoá đơn:</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            value="Điện nước" required readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="exampleFormControlInput1" class="form-label">Mã HĐ:</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $_GET['mahd'] ?>"
                                            name="mahd" required readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1" class="form-label">Phòng: </label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['phong'] ?>"
                                            required readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1" class="form-label">Điện cũ:</label>
                                        <input type="number" class="form-control" id="diencu" name="diencu" value="<?php echo $row['soDienCu'] ?>"
                                            required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1" class="form-label">Điện mới:</label>
                                        <input type="number" class="form-control" id="dienmoi" name="dienmoi" value="<?php echo $row['soDienMoi'] ?>" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1" class="form-label">Tiền điện:</label>
                                        <input type="text" class="form-control" id="tiendien" value="0" required readonly>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nước cũ:</label>
                                        <input type="number" class="form-control" id="nuoccu" name="nuoccu" value="<?php echo $row['soNuocCu'] ?>"
                                            required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nước mới:</label>
                                        <input type="number" class="form-control" id="nuocmoi" name="nuocmoi" value="<?php echo $row['soNuocMoi'] ?>" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1" class="form-label">Tiền nước:</label>
                                        <input type="text" class="form-control" id="tiennuoc" value="0" required readonly>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1" class="form-label">Tổng tiền:</label>
                                        <input type="text" class="form-control" id="tongtien" value="<?php echo $row['tongTien']?>" required readonly name="tongtien">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleFormControlInput1" class="form-label">Tình trạng:</label>
                                        <select class="form-select" aria-label="Default select example" name="tinhtrang" required>
                                            <?php
                                            $sql = "SELECT tinhtrang, id from tinhtrang";
                                            $result = query_no_input($sql);
                                            if ($result->num_rows > 0) {
                                                while ($rowtt = $result->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $rowtt["id"] ?>" <?php if ($rowtt["id"] == $row['tinhtrang']) {
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
                                    onclick="check()" value="Sửa" name="sua">
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
    $('#form').submit(function(event) {
        event.preventDefault();
    })
    function check() {
    if (!error) {
        if (confirm("Xác nhận chỉnh sửa")) {
            $('#form').off("submit").submit();
        }
    } else {
        toastInfo("Thông tin không đúng");
    }
}
    var error = false;
    $(document).ready(function () {
        var diencu = $("#diencu");
        var dienmoi = $("#dienmoi");
        var nuoccu = $("#nuoccu");
        var nuocmoi = $("#nuocmoi");
        var tong = $("#tongtien");
        var tiendien = $('#tiendien');
        var tiennuoc = $('#tiennuoc');
        $(diencu).on("change", tinhtien);
        $(dienmoi).on("change", tinhtien);
        $(nuoccu).on("change", tinhtien);
        $(nuocmoi).on("change", tinhtien);
        
        function tinhtiendien() {
            $(tiendien).val((($(dienmoi).val() * 1) - ($(diencu).val() * 1)) * 2500);
        }
        function tinhtiennuoc() {
            $(tiennuoc).val((($(nuocmoi).val() * 1) - ($(nuoccu).val() * 1)) * 15000);
        }
        tinhtiendien();
        tinhtiennuoc();
        function tinhtien() {
            tinhtiendien();
            tinhtiennuoc();
            if($(tiendien).val() * 1 < 0 || $(tiennuoc).val() * 1 < 0) {
                toastInfo("Thông tin không đúng");
                error = true;
            }else {
                error = false;
            }
            let tien = $(tiendien).val() * 1 + $(tiennuoc).val()*1;
            $(tong).val(tien);
        }
        
    });
</script>