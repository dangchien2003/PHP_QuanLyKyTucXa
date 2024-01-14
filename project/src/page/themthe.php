<?php include './layout/header.php';
include '../handle/checkAccount.php' ?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="min-height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-clipboard"></i>Thêm thẻ xe
            </div>
            <div class="form-add row">
                <div class="col-md-4">
                    <div class="icon">
                        <img src="../../public/image/icon/room.png" alt="" class="object">
                        <img src="../../public/image/icon/plus.png" alt="" class="action">
                    </div>
                </div>
                <div class="col-md-7">
                    <form action="../handle/themthe.php" method = "post">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">Họ tên chủ xe:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="chuXe"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">Loại xe:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="tenXe"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">Biển số xe:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="bienSo"
                                    required>
                            </div>
                            <div class="col-md-6">
                            <label for="exampleFormControlInput1" class="form-label">Trạng thái hoạt động:</label>
                                        <select name="tinhtrang" id="" class="form-select">
                                        <?php
                                        $sql = "SELECT tinhtrang, id from tinhtrang";
                                        $result = query_no_input($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row["id"] ?> " <?php if ($row["id"] == 15) {
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
                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="submit" class="btn btn-success">Tạo</button>
                            </div>

                    </form>
                </div>
            </div>
        </div>


    </div>

</div>





<?php include './layout/footer.php' ?>