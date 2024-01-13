<?php include './layout/header.php';
require '../handle/checkAccount.php' ?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="min-height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-person-bounding-box"></i>Tài khoản
            </div>
            <table class="table table-hover" id="table-tk">
                <thead>
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Nhân viên</th>
                        <th scope="col">Chức vụ</th>
                        <th scope="col">Quyền chính</th>
                        <th scope="col">Tình trạng</th>
                        <th scope="col">Mật khẩu</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody id="body_table">
                    <?php
                    require_once '../handle/helper.php';
                    $sql = "SELECT taikhoan.user, taikhoan.tinhTrang, tinhtrang.tinhTrang as tentt, concat(nhanvien.id, '-', nhanvien.hoTen) as ten, chucvu.chucDanh, quyenchinh.quyen as qc FROM taikhoan JOIN nhanvien on nhanvien.user = taikhoan.user JOIN tinhTrang on tinhTrang.id = taikhoan.tinhTrang JOIN chucvu on nhanvien.chucVu = chucvu.id LEFT JOIN quyenchinh on quyenchinh.user = taikhoan.user ORDER BY taikhoan.user;";
                    $result = query_no_input($sql);
                    $quyen = "";
                    $user = "";
                    $ten = "";
                    $chucvu = "";
                    $tt = 0;
                    $next = false;
                    while ($row = $result->fetch_assoc()) {
                        // khởi tạo user bằng user đầu tiên
                        if (!$user) {
                            $user = $row['user'];
                        }
                        // nếu user khác nhau
                        if ($row['user'] == $user) {
                            if(!$next) {
                                $quyen .= $row['qc'];
                                $next = true;
                            }else {
                                $quyen .= '-' . $row['qc'];
                            }
                            $ten = $row['ten'];
                            $chucvu = $row['chucDanh'];
                            $tt = $row['tinhTrang'];
                            $ttt = $row['tentt'];
                            continue;
                        } else {
                            ?>
                            <tr>
                                <td style="font-weight: bold;" class="user">
                                    <?php echo $user ?>
                                </td>
                                <td>
                                    <?php echo $ten ?>
                                </td>
                                <td>
                                    <?php echo $chucvu ?>
                                </td>
                                <td>
                                    <?php echo $quyen ?>
                                </td>
                                <td>
                                    <?php
                                    $class = null;
                                    switch ($tt) {
                                        case 14:
                                            $class = "bgr-no-ok";
                                            break;
                                        case 15:
                                            $class = "bgr-ok";
                                            break;
                                        default:
                                            $class = "bgr-wait";
                                            break;
                                    }
                                    ?>
                                    <div class="btn-tt <?php echo $class; ?>">
                                        <?php echo $ttt ?>
                                    </div>
                                </td>
                                <td class="mk">********</td>
                                <td>
                                    
                                    <div class="btn-tt d-inline-block bgr-ok quenmk">Quên</div>
                                    <?php
                                    if ($tt == 14) {
                                        ?>
                                        <a href="../handle/action.php?user=<?php echo $user ?>&action=unlock">
                                            <div class="btn-tt d-inline-block bgr-wait">Mở khoá</div>
                                        </a>
                                    <?php
                                    } else {
                                        ?>
                                        <a href="../handle/action.php?user=<?php echo $user ?>&action=lock">
                                            <div class="btn-tt d-inline-block bgr-error">Khoá</div>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            $user = $row['user'];
                            $quyen = "";
                            $quyen .= $row['qc'];
                            $ten = $row['ten'];
                            $chucvu = $row['chucDanh'];
                            $tt = $row['tinhTrang'];
                            $ttt = $row['tentt'];
                        }

                    }
                    ?>
                    <tr>
                        <td style="font-weight: bold;" class="user">
                            <?php echo $user ?>
                        </td>
                        <td>
                            <?php echo $ten ?>
                        </td>
                        <td>
                            <?php echo $chucvu ?>
                        </td>
                        <td>
                            <?php echo $quyen ?>
                        </td>
                        <td>
                            <?php
                            $class = null;
                            switch ($tt) {
                                case 14:
                                    $class = "bgr-no-ok";
                                    break;
                                case 15:
                                    $class = "bgr-ok";
                                    break;
                                default:
                                    $class = "bgr-wait";
                                    break;
                            }
                            ?>
                            <div class="btn-tt <?php echo $class; ?>">
                                <?php echo $ttt ?>
                            </div>
                        </td>
                        <td class="mk">********</td>
                        <td>
                            <div class="btn-tt d-inline-block bgr-ok quenmk">Quên</div>
                            <?php
                            if ($tt == 14) {
                                ?>
                                <a href="../handle/action.php?user=<?php echo $user ?>&action=unlock">
                                    <div class="btn-tt d-inline-block bgr-wait">Mở khoá</div>
                                </a>
                            <?php
                            } else {
                                ?>
                                <a href="../handle/action.php?user=<?php echo $user ?>&action=lock">
                                    <div class="btn-tt d-inline-block bgr-error">Khoá</div>
                                </a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include './layout/footer.php';
addScript(['taikhoan']) ?>