<?php include './layout/header.php' ?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="min-height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-building-add"></i>Danh sách nhân viên
            </div>
            <nav class="container mt-3 ">
                <form class="container-fluid justify-content-start pd-0">
                    <a href="dsnv.php" class="mgr-10"><button class="btn me-3"
                            style="box-shadow: 5px 5px 6px 6px lightblue" type="button">Tất cả</button></a>
                    <a href="themnhanvien.php"><button class="btn btn-success me-3"
                            style="box-shadow: 5px 5px 6px 6px lightblue" type="button"><img
                                src="../../public/image/icon/them.png" alt="" class="img-icon">Thêm nhân viên</button></a>
                </form>
            </nav>
            
                <div class="col-md-6">
                    <input type="" class="form-control" style="margin-top: 15px;" id="input" placeholder="Nhập...">
                </div>
                <div class="col-md-6">
                    <a href=""></a>
                    <button id="timkiem" class="btn btn-primary mb-3" style="margin-top: 15px" ;>Tìm kiếm</button>
                </div>
            
            <div class="container mt-3">

                <div class="table-responsive">
                <?php
                        $result = null;
                        // kiểm tra nếu có key filltẻ trên url và có giá trị
                        if (checkRequest($_GET, ['fillter'], false)) {
                            // câu sql
                            $sql = "SELECT chucVu.chucDanh, nhanvien.id, hoTen, gioiTinh, anh, queQuan, sdt  FROM `nhanvien` JOIN tinhTrang ON tinhTrang.id=nhanvien.tinhTrang JOIN chucVu ON chucVu.id=nhanvien.chucVu where nhanvien.id =? or nhanvien.hoTen =?";
                            // truy vâấ caâ sql
                            $result = query_input($sql, [$_GET['fillter'], $_GET['fillter']]);

                        } else {
                            // nếu không có key fillter hoặc không có giá trị
                            $sql = "SELECT chucVu.chucDanh, nhanvien.id, hoTen, gioiTinh, anh, queQuan, sdt  FROM `nhanvien` JOIN tinhTrang ON tinhTrang.id=nhanvien.tinhTrang JOIN chucVu ON chucVu.id=nhanvien.chucVu where nhanvien.id = nhanvien.id or nhanvien.hoTen = nhanvien.hoTen";
                            $result = query_no_input($sql);
                        }
                        ?>
                    <?php
                    // $sql = "SELECT chucVu.chucDanh, nhanvien.id, hoTen, gioiTinh, anh, queQuan, sdt  FROM `nhanvien` JOIN tinhTrang ON tinhTrang.id=nhanvien.tinhTrang JOIN chucVu ON chucVu.id=nhanvien.chucVu";
                    // $result = query_no_input($sql);
                    if ($result->num_rows == 0) {
                        echo '<div class="bi-text-center">Không có thông tin</div>';
                    } else {

                        ?>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>

                                    <th>Họ tên</th>
                                    <th>Giới tính</th>
                                    <th>Quê quán</th>
                                    <th>Số điện thoại</th>
                                    <th>Chức vụ</th>
                                    <th class="text-center">Tính năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <tr>

                                        <td>
                                            <?php echo $row["id"] ?>
                                        </td>
                                        <td>
                                            <?php echo $row["hoTen"] ?>
                                        </td>
                                        <td>
                                            <?php
                                            if($row["gioiTinh"] ==1){
                                                echo "Nam";
                                            }else if ($row["gioiTinh"] == 0){
                                                echo "Nữ";
                                            }
                                            
                                            ?>
                                        </td>
                                        
                                        <td>
                                            <?php echo $row["queQuan"] ?>
                                        </td>
                                        <td>
                                            <?php echo $row["sdt"] ?>
                                        </td>
                                        <td>
                                            <?php echo $row["chucDanh"] ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-tt d-inline-block bgr-ok">Xoá</div>
                                            <div class="btn-tt d-inline-block bgr-error">Sửa</div>
                                        </td>
                                        <?php
                                }
                    }
                    ?>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
        // Lấy thẻ HTML có id là "myElementId"
        // lây ra thẻ button co id là timkiem
        const tk = document.getElementById('timkiem');
        // lấu ra thẻ input có id là input
        const nhap = document.getElementById('input');
        tk.addEventListener('click', function () {
            // lây dữ liệu ô input
            const nhapp = nhap.value;
            // hàm trim() để xoá khoảng trắng đầu và cuối của 1 biến
            // nếu có ký tự sau khi xoá khaongr trắng  thì xử lý nếu không thì không xử lý
            if (nhapp.trim() != "") {
                // Lấy URL hiện tại
                let currentURL = new URL(window.location.href);

                // Khởi tạo một URLSearchParams từ query string hiện tại
                let searchParams = currentURL.searchParams;

                // Xóa tất cả các tham số trong query string
                searchParams.forEach((value, key) => {
                    searchParams.delete(key);
                });

                // Thêm hoặc chỉnh sửa tham số 't' trong query string
                // thêm key là filltẻ và value là dữ liệu ô input
                searchParams.set('fillter', nhapp);

                // Gán lại query string đã chỉnh sửa vào URL
                currentURL.search = searchParams.toString();

                // Chuyển hướng trang đến URL mới và tải lại trang
                window.location.href = currentURL;
            }
        });
    </script>

<?php include './layout/footer.php' ?>