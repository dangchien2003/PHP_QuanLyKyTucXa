<?php include_once './layout/header.php';
//include_once '../handle/checkAccount.php';
?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include_once './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-person-plus-fill"></i>Đăng ký sinh viên
            </div>
            <div class="form-add row">
                <div class="col-md-3">
                    <div class="icon">
                        <img src="../../public/image/icon/student.png" alt="" class="object">
                        <img src="../../public/image/icon/plus.png" alt="" class="action">
                    </div>
                </div>
                <div class="col-md-7">
                    <form action="../handle/themsv.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="exampleFormControlInput1" class="form-label">Ký hiệu:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="SV"
                                    name="kyhieu" required>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label">Họ tên:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="hoten"
                                    required value="Lê Đăng Chiến">
                            </div>
                            <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label">Ngày sinh:</label>
                                <input type="date" class="form-control" id="exampleFormControlInput1" name="ngaysinh">
                            </div>
                            <div class="col-md-2">
                                <label for="exampleFormControlInput1" class="form-label">Giới tính:</label>
                                <input type="radio" name="gt" value="1">Nam
                                <input type="radio" name="gt" value="0">Nữ
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleFormControlInput1" class="form-label">SĐT:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value=""
                                    name="sdt">
                            </div>
                            <div class="col-md-3">
                                <label for="exampleFormControlInput1" class="form-label">CCCD:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="cccd"
                                    required>
                            </div>
                            <div class="col-md-5">
                                <label for="exampleFormControlInput1" class="form-label">Quê quán:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value=""
                                    name="quequan">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleFormControlInput1" class="form-label">Nghề nghiệp:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="Sinh viên"
                                    name="nghenghiep" required>
                            </div>
                            <div class="col-md-5">
                                <label for="exampleFormControlInput1" class="form-label">Trường:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value=""
                                    name="truong">
                            </div>
                            <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label">Tình trạng:</label>
                                <select class="form-select" aria-label="Default select example" name="tinhtrang"
                                    required>
                                    <?php
                                    $sql = "SELECT tinhtrang, id from tinhtrang";
                                    $result = query_no_input($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row["id"] ?>" <?php if ($row["id"] == 16) {
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
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label">Ngày vào:</label>
                                <input type="date" class="form-control" id="exampleFormControlInput1" name="ngayvao"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label">Mã hợp đồng:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="mahd">
                            </div>
                            <!-- <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label">Tải ảnh lên:</label>
                                <input type="file" class="form-control" id="fileanh" name="file"
                                    accept="image/png">
                            </div> -->

                        </div>
                        <button class="btn btn-success">Tạo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once './layout/footer.php' ?>