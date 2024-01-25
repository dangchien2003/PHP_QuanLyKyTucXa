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
                        <img src="../../public/image/icon/room.png" alt="" class="object">
                    </div>
                </div>
                <form action="../handle/suahdphong.php" method="post" class="col-md-7">
                    <?php
                    if (checkRequest($_GET, ["mahd"])) {
                        // lấy thông tin hoá đơn
                        $sql = "SELECT sinhvien.hoTen, hoadonphong.giaPhong, hoadonphong.giaVeSinh, hoadonphong.tongTien, hoadonphong.tinhtrang, hoadonphong.ngayChot from hoadonphong join sinhvien on sinhvien.id = hoadonphong.toi where concat(hoadonphong.kyHieu, hoadonphong.maHoaDon) = ?";
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
                                        <label for="exampleFormControlInput1" class="form-label">Sinh viên: </label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['hoTen'] ?>"
                                            required readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1" class="form-label">Giá phòng:</label>
                                        <input type="number" class="form-control" id="giaphong" name="giaphong" value="<?php echo $row['giaPhong'] ?>"
                                            required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1" class="form-label">Vệ sinh:</label>
                                        <input type="number" class="form-control" id="vesinh" name="vesinh" value="<?php echo $row['giaVeSinh'] ?>" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1" class="form-label">Tổng tiền:</label>
                                        <input type="text" class="form-control" id="tongtien" value="<?php echo $row['tongTien'] ?>" required readonly>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-5">
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