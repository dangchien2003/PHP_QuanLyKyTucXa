<?php 

 include './layout/header.php';
 include '../handle/checkAccount.php';?> 
    <div class="row">
        <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?> 

        </div>
        <div class="col-lg-9 info">
            <div class="box">
                <?php
                if (checkRequest($_GET, ["idsv"], false)) {
                    $sql = "SELECT * from sinhvien where id = ?";
                    $infoSV = query_input($sql, [$_GET["idsv"]]);
                    while ($info = $infoSV->fetch_assoc()) {
                        $sql = "SELECT phong.maPhong, phong.tang, phong.sucChua, count(sinhvien.id) as soSinhVien from phong right JOIN sinhvien on sinhvien.maPhong = phong.maPhong WHERE sinhvien.maPhong = ? GROUP BY phong.maPhong;";
                        $infoPhong = query_input($sql, [$info["maPhong"]]);
                        while ($infoP = $infoPhong->fetch_assoc()) {


                ?>
                            <div class="row info-student d-flex justify-content-center ">
                                <div class="col-md-4 justify-content-center ">
                                    <div class="ttp">
                                        <span>Thông tin phòng ở</span>
                                        <div class="">
                                            <div class="mb-3 object">
                                                <label for="exampleFormControlInput1" class="form-label">Mã phòng: </label>
                                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" value="<?php echo $infoP["maPhong"] ?>">
                                            </div>
                                            <div class="mb-3 object">
                                                <label for="exampleFormControlInput1" class="form-label">Tầng: </label>
                                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" value="<?php echo $infoP["tang"] ?>">
                                            </div>
                                            <div class="mb-3 object">
                                                <label for="exampleFormControlInput1" class="form-label">Số người: </label>
                                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" value="<?php echo $infoP["soSinhVien"] . "/" . $infoP["sucChua"] ?>">
                                            </div>
                                        </div>
                                        <a href="./thongtinphong?maphong=<?php echo $infoP["maPhong"];?>">
                                            <div class="action d-flex">
                                                <div class="icon edit">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                <?php } ?>

                                </div>
                                <div class="col-md-4 ">
                                    <div id="add" class=" ">
                                        <video id="video" class="a-d-d d-none"></video>
                                        <img src="../../public/image/uploads/<?php echo $info["kyHieu"] . $info["id"] . ".png" ?>" alt="add" class="a-d-d" id="anhdaidien">
                                        <canvas id="canvas" class="d-none a-d-d"></canvas>
                                    </div>

                                    <div class="action d-flex justify-content-center">
                                        <div class="icon edit">
                                            <i class="bi bi-camera-video-fill"></i>
                                        </div>
                                        <div class="icon render" id="render">
                                            <i class="bi bi-camera-fill"></i>
                                        </div>
                                        <div class="icon render" id="upload">
                                            <input type="file" class="d-none" id="inp_file" accept="image/*">
                                            <i class="bi bi-cloud-arrow-up-fill"></i>
                                        </div>
                                        <div class="icon save">
                                            <i class="bi bi-check-lg"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex justify-content-center ">
                                    <?php

                                    ?>
                                    <form class="ttsv" id="form-info-sv" action="../handle/suaTTSV.php" method="post">
                                        <span>Thông tin sinh viên</span>
                                        <div class="">
                                            <div class="mb-3 object d-none">
                                                <label for="exampleFormControlInput1" class="form-label">Id: </label>
                                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="idsv" value="<?php echo $info["kyHieu"] .$info["id"] ?>">
                                            </div>
                                            <div class="mb-3 object">
                                                <label for="exampleFormControlInput1" class="form-label">Id sinh viên: </label>
                                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="id" value="<?php echo $info["kyHieu"] .$info["id"] ?>">
                                            </div>
                                            <div class="mb-3 object">
                                                <label for="exampleFormControlInput1" class="form-label">Họ tên: </label>
                                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="hoten" value="<?php echo $info["hoTen"] ?>">
                                            </div>
                                            <div class="mb-3 object">
                                                <label for="exampleFormControlInput1" class="form-label">Tình trạng: </label>
                                                <select name="tinhtrang" id="tinhtrangsv">
                                                    <?php
                                                    $sql = "SELECT tinhtrang.id AS idtt, tinhtrang.tinhTrang AS tttt FROM tinhtrang";
                                                    $result = query_no_input($sql);

                                                    while ($row = $result->fetch_assoc()) {
                                                        if ($row['idtt'] === $info["tinhTrang"]) {
                                                            echo '<option value="' . $row['idtt'] . '"' . 'selected' . ' >' . $row["tttt"] . '</option>';
                                                        } else {
                                                            echo '<option value="' . $row['idtt'] . '"' . ' >' . $row["tttt"] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3 object">
                                                <label for="exampleFormControlInput1" class="form-label">Giới tính: </label>
                                                <?php
                                                if ($info["gioiTinh"] !== null) {
                                                    if (!$info["gioiTinh"]) {
                                                        echo '<input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gioitinh" value="1"> Nam
                                                <input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gioitinh" value="0" checked>Nữ';
                                                    } else if ($info["gioiTinh"] == 1) {
                                                        echo '<input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gioitinh" value="1" checked> Nam
                                                <input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gioitinh" value="0" >Nữ';
                                                    } else {
                                                        echo '<input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gioitinh" value="1"> Nam
                                                <input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gioitinh" value="0">Nữ';
                                                    }
                                                } else {
                                                    echo '<input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gioitinh" value="1"> Nam
                                            <input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gioitinh" value="0">Nữ';
                                                }
                                                ?>
                                            </div>
                                            <div class="mb-3 object">
                                                <label for="exampleFormControlInput1" class="form-label">Năm sinh: </label>
                                                <input type="date" class="" id="exampleFormControlInput1" placeholder="" name="namsinh" value="<?php echo $info["namSinh"] ?>">
                                            </div>
                                            <div class="mb-3 object">
                                                <label for="exampleFormControlInput1" class="form-label">SĐT: </label>
                                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="sdt" value="<?php echo $info["sdt"] ?>">
                                            </div>

                                            <div class="mb-3 object">
                                                <label for="exampleFormControlInput1" class="form-label">Quê quán: </label>
                                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="quequan" value="<?php echo $info["queQuan"] ?>">
                                            </div>
                                            <div class="mb-3 object">
                                                <label for="exampleFormControlInput1" class="form-label">SoCCCD: </label>
                                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="cccd" value="<?php echo $info["soCCCD"] ?>">
                                            </div>
                                            <div class="mb-3 object">
                                                <label for="exampleFormControlInput1" class="form-label">Nghề nghiệp: </label>
                                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="nghenghiep" value="<?php echo $info["ngheNghiep"] ?>">
                                            </div>
                                            <div class="mb-3 object">
                                                <label for="exampleFormControlInput1" class="form-label">Trường: </label>
                                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="truong" value="<?php echo $info["truong"] ?>">
                                            </div>
                                            <div class="mb-3 object">
                                                <label for="exampleFormControlInput1" class="form-label">Ngày vào: </label>
                                                <input type="date" class="" id="exampleFormControlInput1" placeholder="" name="ngayVao" value="<?php echo $info["ngayVao"] ?>">
                                            </div>
                                            <div class="mb-3 object">
                                                <label for="exampleFormControlInput1" class="form-label">Ngày ra: </label>
                                                <input type="date" class="" id="exampleFormControlInput1" placeholder="" name="ngayra" value="<?php echo $info["ngayRa"] ?>">
                                            </div>

                                            <div class="mb-3 object">

                                                <div class="input-group mb-3">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="">
                                                            <label for="exampleFormControlInput1" class="form-label">Hợp đồng:
                                                            </label>
                                                            <input type="text" class="" id="exampleFormControlInput1" placeholder="" style="padding-left: 5px; width: 50%;" name="hopdong" value="<?php echo $info["maHD"] ?>">
                                                        </div>
                                                        <div class="">
                                                            <a class="input-group-text" id="basic-addon2" href=" <?php echo $info["maHD"] ?>" style="margin: 0 auto; display: block;">Tới</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="action d-flex">
                                                <div class="icon edit no-write">
                                                    <i class="bi bi-pencil-fill"></i>

                                                </div>
                                                <div class="icon save d-none">
                                                    <i class="bi bi-check-lg"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                    <?php }
                } else {
                    echo '<div class="bi-text-center">Không có thông tin</div>';
                } ?>

            </div>
        </div>
    </div>
    <?php include './layout/footer.php'; 
    addScript(["thongtinsv"])?>
</body>

</html>