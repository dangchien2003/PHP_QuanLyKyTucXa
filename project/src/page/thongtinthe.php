<?php include './layout/header.php';
include '../handle/checkAccount.php' ?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="min-height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-clipboard"></i>Thông tin thẻ
            </div>
            <div class="col-md-7">
                <?php
                if (checkRequest($_GET, ['id'], false)) {
                    $sql = "SELECT thexe.id as idtx, thexe.chuXe as idsv, sinhvien.hoTen, thexe.tenXe, thexe.bienSo, sinhvien.maPhong, sinhvien.sdt, sinhvien.soCCCD, tinhTrang.tinhTrang, thexe.tinhTrang as ttxe FROM `thexe` JOIN sinhvien on sinhvien.id = thexe.chuXe JOIN tinhtrang ON tinhtrang.id = thexe.tinhTrang WHERE thexe.id =?";
                    $result = query_input($sql, [$_GET['id']]);
                    if ($result->num_rows == 0) {
                        echo '<div class="bi-text-center">Không có thông tin</div>';
                    } else {
                        ?>
                        <form action="../handle/suaThexe.php" method="post">
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">ID thẻ xe:</label>
                                        <input type="text" class="form-control" value="<?php echo $row['idtx'] ?> " name="idtx"
                                            readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">ID sinh viên:</label>
                                        <input type="text" class="form-control" value="<?php echo $row["idsv"] ?>" name="idsv"
                                            readonly>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleFormControlInput1" class="form-label">Họ tên: </label>
                                        <input type="text" class="form-control" value="<?php echo $row["hoTen"] ?>" name="hoten"
                                            readonly>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="exampleFormControlInput1" class="form-label">Loại xe: </label>
                                        <input type="text" class="form-control" value="<?php echo $row["tenXe"] ?>" name="tenxe"
                                            required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="exampleFormControlInput1" class="form-label">Biển số xe:</label>
                                        <input type="text" class="form-control" value="<?php echo $row["bienSo"] ?>" name="bienso"
                                            required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="exampleFormControlInput1" class="form-label">Nơi ở:</label>
                                        <input type="text" class="form-control" value="<?php echo $row["maPhong"] ?>" name="maphong"
                                            readonly>

                                    </div>
                                    <div class="col-md-12">
                                        <label for="exampleFormControlInput1" class="form-label">Số điện thoại:</label>
                                        <input type="text" class="form-control" value="<?php echo $row["sdt"] ?>" name="sdt"
                                            readonly>

                                    </div>
                                    <div class="col-md-12">
                                        <label for="exampleFormControlInput1" class="form-label">CCCD (Căn Cước Công Dân):</label>
                                        <input type="text" class="form-control" value="<?php echo $row["soCCCD"] ?>" name="CCCD"
                                            readonly>

                                    </div>
                                    <div class="col-md-12">
                                        <label for="exampleFormControlInput1" class="form-label">Trạng thái hoạt động:</label>
                                        <select name="tinhtrang" id="" class="form-select">
                                        <?php
                                        $sql = "SELECT tinhtrang, id from tinhtrang where id in (16,10,15)";
                                        $result = query_no_input($sql);
                                        if ($result->num_rows > 0) {
                                            while ($rowtt = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $rowtt["id"] ?> " <?php if ($rowtt["id"] == $row['ttxe']) {
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

                                </div>

                                <button type="submit" class="btn btn-success" style=" margin-top: 15px !important;">Sửa</button>
                            <?php } ?>
                        </form>
                        <?php
                    }
                } else {
                    echo '<div class="bi-text-center">Không có thông tin</div>';
                }
                ?>


            </div>

        </div>
    </div>

    <?php include './layout/footer.php' ?>