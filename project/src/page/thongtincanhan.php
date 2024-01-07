<?php include './layout/header.php';
include '../handle/checkAccount.php'; ?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="min-height: 1000px;">
        <div class="box ttnv">
            <div class="name">
                <i class="bi bi-person-vcard-fill"></i>Thông tin cá nhân
            </div>
            <?php
            $user = "";
            // nếu có session account
            if (checkRequest($_SESSION, ['account'])) {
                $user = $_SESSION['account']['username'];
            } else if (checkRequest($_COOKIE, ['account'])) { // kiểm tra có cookie account hay không
                $account = giaiMa($_COOKIE['account']);
                $user = $account['username'];
            } else {
                header("location: ../page/dangnhap.php");
            }
            $sql = "SELECT nhanvien.*, tinhTrang.tinhTrang as ttnv, chucVu.chucDanh FROM nhanvien JOIN taikhoan on taikhoan.user = nhanvien.user JOIN tinhTrang ON tinhTrang.id = nhanvien.tinhTrang JOIN chucVu on chucVu.id = nhanvien.chucVu WHERE taikhoan.user = ? LIMIT 1";
            $result = query_input($sql, [$user]);
            if ($result->num_rows == 0) {
                echo '<div class="bi-text-center">Không có thông tin</div>';
            } else {
                while ($row = $result->fetch_assoc()) {
                    ?>

                    <div class="row">
                        <div class="col-lg-4 ttcn">
                            <div class="mb-3 object">
                                <label for="exampleFormControlInput1" class="form-label">ID: </label>
                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="id"
                                    value="<?php echo $row['kyHieu'] . $row['id'] ?>" readonly>
                            </div>
                            <div class="mb-3 object">
                                <label for="exampleFormControlInput1" class="form-label">Họ tên: </label>
                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="hoten"
                                    value="<?php echo $row['hoTen'] ?>" readonly>
                            </div>
                            <div class="mb-3 object">
                                <label for="exampleFormControlInput1" class="form-label">Giới tính: </label>
                                <?php
                                if ($row["gioiTinh"] !== null) {
                                    if (!$row["gioiTinh"]) {
                                        echo '<input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gt" disabled value="1"> Nam
                                <input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gt" disabled value="0" checked>Nữ';
                                    } else if ($row["gioiTinh"] == 1) {
                                        echo '<input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gt" disabled value="1" checked> Nam
                                <input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gt" disabled value="0" >Nữ';
                                    } else {
                                        echo '<input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gt" disabled value="1"> Nam
                                <input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gt" disabled value="0">Nữ';
                                    }
                                } else {
                                    echo '<input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gt" disabled value="1"> Nam
                            <input type="radio" class="" id="exampleFormControlInput1" placeholder="" name="gt" disabled value="0">Nữ';
                                }
                                ?>
                            </div>
                            <div class="mb-3 object">
                                <label for="exampleFormControlInput1" class="form-label">Ngày sinh: </label>
                                <input type="date" class="" id="exampleFormControlInput1" placeholder="" name="ngaysinh"
                                    value="<?php echo $row['ngaySinh'] ?>" readonly>
                            </div>
                            <div class="mb-3 object">
                                <label for="exampleFormControlInput1" class="form-label">Quê quán: </label>
                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" name="quequan"
                                    value="<?php echo $row['queQuan'] ?>" readonly>
                            </div>
                            <div class="mb-3 object">
                                <label for="exampleFormControlInput1" class="form-label">Chức vụ: </label>
                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" value="<?php echo $row['chucDanh'] ?>"
                                    readonly>
                            </div>
                            <div class="mb-3 object">
                                <label for="exampleFormControlInput1" class="form-label">Email: </label>
                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" value="<?php echo $row['email'] ?>"
                                    readonly>
                            </div>
                            <div class="mb-3 object">
                                <label for="exampleFormControlInput1" class="form-label">SĐT: </label>
                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" value="<?php echo $row['sdt'] ?>"
                                    readonly>
                            </div>
                            <div class="mb-3 object">
                                <label for="exampleFormControlInput1" class="form-label">Ngày bắt đầu: </label>
                                <input type="date" class="" id="exampleFormControlInput1" placeholder="" value="<?php echo $row['ngayVao'] ?>"
                                    readonly>
                            </div>
                            <div class="mb-3 object">
                                <label for="exampleFormControlInput1" class="form-label">Ngày nghỉ việc: </label>
                                <input type="date" class="" id="exampleFormControlInput1" placeholder="" value="<?php echo $row['ngayNghi'] ?>" readonly>
                            </div>
                            <div class="mb-3 object">
                                <label for="exampleFormControlInput1" class="form-label">Trạng thái: </label>
                                <input type="text" class="" id="exampleFormControlInput1" placeholder="" value="<?php echo $row['ttnv'] ?>"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 add d-flex justify-content-center">
                            <img src="../../public/image/uploads/<?php echo $row['anh'] ?>" alt="add">
                        </div>
                        <div class="col-lg-4 dmk">
                            <div class="name">
                                <i class="bi bi-key-fill"></i>Đổi mật khẩu
                            </div>
                            <form action="../handle/doimatkhau.php" method="post" id="form_change_password">
                                <div class="mb-3 object">
                                    <label for="exampleFormControlInput1" class="form-label">Tên đăng nhập: </label>
                                    <input type="text" class="" id="username" placeholder="" name="username"
                                        value="<?php echo $user ?>" readonly required>
                                </div>
                                <div class="mb-3 object">
                                    <label for="exampleFormControlInput1" class="form-label">Mật khẩu hiện tại: </label>
                                    <input type="password" class="" id="password" placeholder="********" name="password"
                                        value="" required>
                                    <span class="message" id="toast_password"></span>
                                </div>
                                <div class="mb-3 object">
                                    <label for="exampleFormControlInput1" class="form-label">Mật khẩu mới: </label>
                                    <input type="password" class="" id="newpassword" placeholder="********" name="newpassword"
                                        value="" required>
                                    <span class="message" id="toast_newpassword"></span>
                                </div>

                                <div class="mb-3 object">
                                    <label for="exampleFormControlInput1" class="form-label">Xác nhận mật khẩu: </label>
                                    <input type="password" class="" id="passwordcomfirm" placeholder="********"
                                        name="passwordcomfirm" value="" required>
                                    <span class="message" id="toast_passwordcomfirm"></span>
                                </div>
                            </form>
                            <button class="btn btn-success" style="margin: 5px 0;" id="save">
                                Đổi
                            </button>
                        </div>

                    </div>
                    <?php
                }
            }
            ?>

        </div>
    </div>
</div>

<?php include './layout/footer.php' ?>

<script>
    $(document).ready(function () {
        var form = $("#form_change_password");
        var mesP = $("#toast_password");
        var mesCP = $("#toast_passwordconfirm");
        var btn_save = $("#save");

        $(btn_save).click(() => {
            // nếu newP rỗng
            if ($("#password").val().trim() == "") {
                $("#toast_password").text("Nhập mật khẩu")
            } else {
                $("#toast_password").text("")
                if ($("#newpassword").val().trim() == "") {
                    $("#toast_newpassword").text("Nhập ô này")
                } else {
                    $("#toast_newpassword").text("");
                    // nếu 2 mk mới k trùng nhau
                    if ($("#passwordcomfirm").val() != $("#newpassword").val()) {
                        $("#toast_passwordcomfirm").text("Mật khẩu không trùng khớp")
                    } else {
                        $("#toast_passwordcomfirm").text("")
                        // nếu trùng mật khẩu cũ và mới
                        if ($("#passwordcomfirm").val() == $("#password").val()) {
                            $("#toast_password").text("Mật khẩu mới và cũ phải khác nhau")
                        } else {
                            // submit form
                            $(form).trigger('submit');
                        }

                    }
                }
            }


        })

    })
</script>