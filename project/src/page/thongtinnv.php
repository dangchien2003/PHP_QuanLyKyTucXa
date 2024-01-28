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
                Thông tin nhân viên
            </div>
            <div class="form-add row">
                <div class="col-md-9">
                    <?php
                    if (checkRequest($_GET, ['id'], false)) {
                        $sql = "select nhanvien.kyHieu, nhanvien.id, nhanvien.user, nhanvien.hoTen, nhanvien.queQuan, nhanvien.sdt, nhanvien.email, nhanvien.ngaySinh, nhanvien.ngayVao, nhanvien.ngayNghi, chucVu.chucDanh, nhanvien.tinhTrang, nhanvien.gioiTinh FROM nhanvien JOIN chucVu on chucVu.id = nhanvien.chucVu WHERE nhanvien.id = ? ";
                        $result = query_input($sql, [$_GET['id']]);
                        if ($result->num_rows == 0) {
                            echo '<div class="bi-text-center">Không có thông tin</div>';
                        } else {
                            ?>
                            <form action="../handle/hndsuanv.php" method="post">
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="exampleFormControlInput1" class="form-label">Ký hiệu</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['kyHieu']?>"
                                                name="kyhieu" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleFormControlInput1" class="form-label">ID nhân viên</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1" name="id" value="<?php echo $row['id'] ?>"
                                                readonly required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleFormControlInput1" class="form-label">Tài khoản</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1" name="taikhoan" value="<?php echo $row['user'] ?>" >
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="exampleFormControlInput1" class="form-label">Họ tên</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="Họ và tên" name="hoten"  value="<?php echo $row['hoTen'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="exampleFormControlInput1" class="form-label">Quê quán</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="Quê quán..." name="quequan" value="<?php echo $row['queQuan'] ?>">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="exampleFormControlInput1" class="form-label">SĐT</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="Số điện thoại" name="sdt" value="<?php echo $row['sdt'] ?>">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="exampleFormControlInput1" class="form-label">Giới tính</label>
                                            <?php 
                                                if($row['gioiTinh']){
                                                    ?> 
                                                    <input type="radio" name="gt"  value="1" checked>Nam
                                                    <input type="radio" name="gt"  value="0">Nữ
                                                    <?php 
                                                }else {
                                                    ?>
                                                    <input type="radio" name="gt"  value="1" >Nam
                                                    <input type="radio" name="gt"  value="0" checked>Nữ
                                                    <?php 
                                                }
                                            ?> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="exampleFormControlInput1" class="form-label">Nghề nghiệp</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1" value="Nhân viên"  readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="exampleFormControlInput1" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="Email..." name="email" value="<?php echo $row['email'] ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="exampleFormControlInput1" class="form-label">Ngày sinh</label>
                                            <input type="date" class="form-control" id="exampleFormControlInput1" name="ngaysinh"
                                                 value="<?php echo $row['ngaySinh'] ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleFormControlInput1" class="form-label">Ngày vào</label>
                                            <input type="date" class="form-control" id="exampleFormControlInput1" name="ngayvao"
                                                 value="<?php echo $row['ngayVao'] ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleFormControlInput1" class="form-label">Ngày nghỉ</label>
                                            <input type="date" class="form-control" id="exampleFormControlInput1" name="ngaynghi" value="<?php echo $row['ngayNghi'] ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="exampleFormControlInput1" class="form-label">Chức vụ</label>
                                            <select name="chucvu" id="" class="form-select">
                                                <?php
                                                $sql = "SELECT chucDanh, id from chucvu ";
                                                $result = query_no_input($sql);
                                                if ($result->num_rows > 0) {
                                                    while ($rowtt = $result->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?php echo $rowtt["id"] ?> " <?php if ($rowtt["id"] == $row['chucVu']) {
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

                                        <div class="col-md-6">
                                            <label for="exampleFormControlInput1" class="form-label">Tình trạng</label>
                                            <select name="tinhtrang" id="" class="form-select">
                                                <?php
                                                $sql = "SELECT tinhtrang, id from tinhtrang where id in (8,7)";
                                                $result = query_no_input($sql);
                                                if ($result->num_rows > 0) {
                                                    while ($rowtt = $result->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?php echo $rowtt["id"] ?> " <?php if ($rowtt["id"] == $row['tinhTrang']) {
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
                                    
                                    <button class="btn btn-success">Sửa</button>
                                <?php }
                        }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once './layout/footer.php' ?>