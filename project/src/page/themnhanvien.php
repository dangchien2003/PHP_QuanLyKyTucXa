<?php include_once './layout/header.php';
// include_once '../handle/checkAccount.php';
?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include_once './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-person-plus-fill"></i>Nhân viên mới
            </div>
            <div class="form-add row">
                <div class="col-md-3">
                    <div class="icon">
                        <img src="../../public/image/icon/student.png" alt="" class="object">
                        <img src="../../public/image/icon/plus.png" alt="" class="action">
                    </div>
                </div>
                <div class="col-md-9">
                    <form action="../handle/themnv.php" method="post">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="exampleFormControlInput1" class="form-label">Ký hiệu:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="NV"
                                    name="kyhieu" required>
                            </div>
                            <div class="col-md-5">
                                <label for="exampleFormControlInput1" class="form-label">Họ tên:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Họ và tên" name="hoten"
                                    required>
                            </div>
                            <div class="col-md-5">
                                <label for="exampleFormControlInput1" class="form-label">Ngày sinh:</label>
                                <input type="date" class="form-control" id="exampleFormControlInput1" name="ngaysinh">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label">SĐT:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Số điện thoại" value=""
                                    name="sdt">
                            </div>
                            <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label">CCCD:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"  name="cccd"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label">Quê quán:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value=""
                                    name="quequan">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label">Nghề nghiệp:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="Nhân viên"
                                    name="nghenghiep" required>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label">Chức vụ:</label>
                                <select name="chucvu" id="" class="form-select">
                                    <?php
                                    $sql = "SELECT chucDanh, id from chucvu ";
                                    $result = query_no_input($sql);
                                    if ($result->num_rows > 0) {
                                        while ($rowtt = $result->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $rowtt["id"] ?> " <?php if ($rowtt["id"] == 3) {
                                                    echo 'selected';
                                                } ?>>
                                                <?php echo $rowtt["chucDanh"]; ?>
                                            </option>
                                            <?php

                                        }
                                    } else {
                                        echo '<option value="0" selected>Không có thẻ</option>';
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label">Ngày vào:</label>
                                <input type="date" class="form-control" id="exampleFormControlInput1" name="ngayvao"
                                    required>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">Email:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Email..." name="email">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">Tình trạng:</label>
                                <select name="tinhtrang" id="" class="form-select">
                                    <?php
                                    $sql = "SELECT tinhtrang, id from tinhtrang where id in (8,7)";
                                    $result = query_no_input($sql);
                                    if ($result->num_rows > 0) {
                                        while ($rowtt = $result->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $rowtt["id"] ?> " <?php if ($rowtt["id"] == 8) {
                                                    echo 'selected';
                                                } ?>>
                                                <?php echo $rowtt["tinhtrang"]; ?>
                                            </option>
                                            <?php

                                        }
                                    } else {
                                        echo '<option value="0" selected>Không có thẻ</option>';
                                    }

                                    ?>
                                </select>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="exampleFormControlInput1" class="form-label">Giới tính:</label>
                                <input type="radio" name="gt" required value="1">Nam
                                <input type="radio" name="gt" required value="0">Nữ
                            </div>
                        </div>
                        <button class="btn btn-success">Tạo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once './layout/footer.php' ?>