<?php include_once './layout/header.php';
include_once '../handle/checkAccount.php';
?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include_once './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-building-add"></i>Thêm phòng ở
            </div>
            <div class="form-add row">
                <div class="col-md-3">
                    <div class="icon">
                        <img src="../../public/image/icon/room.png" alt="" class="object">
                        <img src="../../public/image/icon/plus.png" alt="" class="action">
                    </div>
                </div>
                <div class="col-md-7">
                    <?php
                    if (checkRequest($_GET, ['maphong'], false)) {
                        $sql = "SELECT phong.maPhong, phong.kyHieu, tang, phong.tinhTrang, sucChua, nguoiDaiDien, (select COUNT(*) FROM sinhvien where sinhvien.tinhTrang != 1 and sinhvien.maPhong = ?)as sl FROM phong where phong.maPhong = ?;";
                        $result = query_input($sql, [$_GET['maphong'], $_GET['maphong']]);
                        if ($result->num_rows == 0) {
                            echo '<div class="bi-text-center">Không có thông tin</div>';
                        } else {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <form action="../handle/suaTTP.php?maphong=<?php echo $row['maPhong']?>" method="post">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="exampleFormControlInput1" class="form-label">Ký hiệu phòng:</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                value="<?php echo $row['kyHieu'] ?>" name="kyhieu" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleFormControlInput1" class="form-label">Mã phòng:</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1" name="maphong"
                                                value="<?php echo $row['maPhong'] ?>" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="exampleFormControlInput1" class="form-label">Tầng: </label>
                                            <select class="form-select" aria-label="Default select example" name="tang" required>
                                                <?php
                                                $sql = "SELECT MIN(tang) as min, MAX(tang) as max from phong";
                                                $result = query_no_input($sql);
                                                $min = 0;
                                                $max = 0;
                                                if ($result->num_rows > 0) {
                                                    while ($rowt = $result->fetch_assoc()) {
                                                        $min = $rowt["min"];
                                                        $max = $rowt["max"];
                                                    }

                                                    for ($i = 1; $i <= $max; $i++) {
                                                        ?>
                                                        <option <?php if ($i == $row['tang'] * 1) {
                                                            echo "selected";
                                                        } ?> value="<?php echo $i; ?>">
                                                            <?php echo $i; ?>
                                                        </option>
                                                        <?php

                                                    }
                                                }
                                                ?>
                                                <option value="0">Khác</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2" style="padding: 0;">
                                            <label for="exampleFormControlInput1" class="form-label"></label>
                                            <input type="number" class="form-control d-none" id="exampleFormControlInput1"
                                                name="sotang" style="margin-top: 13px; width: 70px;" value="1" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="exampleFormControlInput1" class="form-label">Sức chứa:</label>
                                            <input type="number" class="form-control" id="exampleFormControlInput1"
                                                value="<?php echo $row['sucChua'] ?>" name="succhua" required>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="exampleFormControlInput1" class="form-label">Số người:</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                value="<?php echo $row['sl'] . '/' . $row['sucChua'] ?>" name="songuoi" required>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="exampleFormControlInput1" class="form-label">Tình trạng:</label>
                                            <select class="form-select" aria-label="Default select example" name="tinhtrang"
                                                required>
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
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="exampleFormControlInput1" class="form-label">Người đại diện(ID):</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                value="<?php echo $row['nguoiDaiDien'] ?>" name="nguoidaidien">
                                        </div>
                                    </div>

                                    <?php

                            }
                            ?>
                                <button type="submit" class="btn btn-success">Lưu</button>
                            </form>
                            <div class="table-sv sv_in_room">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Phòng</th>
                                            <th scope="col">Tên</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "select sinhvien.id, sinhvien.hoTen, sinhvien.tinhTrang as idtt, tinhtrang.tinhTrang, sinhvien.maPhong from sinhvien join tinhTrang on tinhTrang.id = sinhvien.tinhTrang WHERE sinhvien.maPhong = ? and sinhvien.tinhTrang != 1;";

                                        if (checkRequest($_GET, ["maphong"])) {
                                            $result = query_input($sql, [$_GET['maphong']]);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    ?>

                                                    <form action="../handle/doiPhongSV.php?maphong=<?php echo $row['maPhong'] ?>"
                                                        method="post">
                                                        <tr>
                                                            <td><input type="text" class="maphong" value="<?php echo $row['id']; ?>"
                                                                    name="idsv" readonly style="width: 50px;"></td>
                                                            <td><input type="text" class="maphong" value="<?php echo $row['maPhong'] ?>"
                                                                    name="maphongsv" readonly></td>
                                                            <td>
                                                                <?php echo $row['hoTen'] ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $class = null;
                                                                switch ($row['idtt']) {
                                                                    case 1:
                                                                        $class = "bgr-no-ok";
                                                                        break;
                                                                    case 2:
                                                                        $class = "bgr-ok";
                                                                        break;
                                                                    case 3:
                                                                        $class = "bgr-info";
                                                                        break;
                                                                    case 4:
                                                                        $class = "bgr-wait";
                                                                        break;
                                                                    default:
                                                                        $class = "bgr-wait";
                                                                        break;
                                                                }
                                                                ?>
                                                                <div class="btn-tt <?php echo $class; ?>">

                                                                    <?php echo $row['tinhTrang']
                                                                        ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="btn-tt d-inline-block bgr-wait edit">Sửa</div>
                                                                <button type="submit"
                                                                    class="btn-tt d-inline-block bgr-ok save d-none">Lưu</button>
                                                            </td>
                                                        </tr>
                                                    </form>

                                                    <?php

                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php

                        }
                    } else {
                        echo '<div class="bi-text-center">Không có thông tin</div>';
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once './layout/footer.php' ?>

    <script>
        $(document).ready(function () {
            $('select[name="tang"]').change(function () {
                if ($('select[name="tang"]').val() == 0) {
                    $('input[name="sotang"]').removeClass('d-none');
                } else {
                    $('input[name="sotang"]').addClass('d-none');
                }
            })
            $('input[name="sotang"]:first').on('input', function () {
                var value = parseInt($(this).val());
                if (value <= 0) {
                    $(this).val(1);
                }
            });
            $('input[name="succhua"]:first').on('input', function () {
                var value = parseInt($(this).val());
                if (value < 0) {
                    $(this).val(0);
                }
            });

            let ipMaPhong = $('input[name="maphongsv"]');
            let btnEdit = $('.edit');
            let btnSave = $('.save');
            btnEdit.each(function (index, element) {
                $(element).click(function () {
                    $(ipMaPhong[index]).prop("readonly", false);
                    $(element).addClass("d-none");
                    $(btnSave[index]).removeClass("d-none");
                })
            })
        })
    </script>