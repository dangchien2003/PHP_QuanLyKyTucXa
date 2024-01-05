<?php include_once './layout/header.php' ?>
<?php include_once  '../handle/checkAccount.php'?> 
<link rel="stylesheet" href="../../public/css/bootstrap.min.css">
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include_once './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="min-height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-people-fill"></i>Sinh viên
            </div>
            <div class="find">
                <div class="find-tang ">
                    <div class="fs-15 fw-500">Tầng:</div>
                    <select class="form-select " aria-label="Default select example">
                        <option value="0">Tất cả</option>
                        <option value="1">Tầng 1</option>
                        <option value="2">Tầng 2</option>
                        <option value="3">Tầng 3</option>
                    </select> 
                </div>
                <div class="ttp">
                    <div class="fs-15 fw-500">Tình trạng phòng:</div>
                    <nav class="navbar navbar-light ">
                        <form class="container-fluid justify-content-start pd-0">
                            <a href="#" class="mgr-10"><button class="btn me-2" type="button">Tất cả</button></a>
                            <a href="#"><button class="btn me-2" type="button"><img src="../../public/image/icon/audience.png" alt="" class="img-icon">Đang ở</button></a>
                            <a href="#"><button class="btn me-2" type="button"><img src="../../public/image/icon/null.png" alt="" class="img-icon">Phòng trống</button></a>
                            <input type="text" class="btn me-2" placeholder="Tìm mã sinh viên" id="find_MP">
                            <input type="text" class="btn me-2" placeholder="Tên cột" id="find_column" value="#">
                        </form>
                    </nav>
                    
                </div>
            </div>
            <div class="table-sv">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Phòng</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Ngày sinh</th>
                            <th scope="col">Ngày vào</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once '../handle/helper.php';
                        $sql = "SELECT sinhvien.id, anh, hoTen, maPhong, namSinh, ngayVao, tinhTrang.id as idtt, tinhTrang.tinhTrang FROM sinhvien JOIN tinhTrang on tinhTrang.id = sinhvien.tinhTrang LIMIT ?,?";
                        $result = query_input($sql, [0, 10]);
                        if ($result->num_rows == 0) {
                            echo '<div class="bi-text-center">Không có thông tin</div>';
                        } else {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td scope="row" style="font-weight: bold;"><?php echo $row['id'] ?> </td>
                                    <td><?php echo $row['maPhong'] ?></td>
                                    <td><img src="../../public/image/uploads/<?php echo $row['anh'] ?>.png " class="mini_img" ></img><?php echo $row['hoTen'] ?></td>
                                    <td><?php echo $row['namSinh'] ?></td>
                                    <td><?php echo $row['ngayVao'] ?></td>
                                    <td><?php
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
                                            <?php echo $row['tinhTrang'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="./thongtinsv.php?idsv=<?php echo $row['id'] ?>&action=show  " class="show">
                                            <div class="btn-tt d-inline-block bgr-ok">Xem</div>
                                        </a>
                                        <a href="#" class="show">
                                            <div class="btn-tt d-inline-block bgr-error">Xoá</div>
                                        </a>
                                    </td>

                                </tr>
                        <?php

                            }
                        }

                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<?php include_once './layout/footer.php' ?>

<script>
    $(document).ready(function() {
        $("#find_MP").on("change", () => {
            findTable($(".table")[0], $("#find_MP").val(), $("#find_column").val())
        })
    })
    function findTable(table, value, column) {
        console.log(column);
        var index = findIndex(table, column);
        numColumn = $(table).find("thead").find("th").length;
        if(index) {
            index = index-1;
            let tr = Array.from($(table).find("tbody").find("tr"));
            // nếu ô tìm kiếm rỗng hoặc bằng 0
            if(value == "" || value == 0) {
                for(let i = 0; i < tr.length; i++) {
                    // mở ẩn
                    $(tr[i]).removeClass("d-none");
                }
            }else {
                // lặp qua từng tr
                for(let i = 0; i < tr.length; i++) {
                    // mở ẩn
                    $(tr[i]).removeClass("d-none");
                    // lấy td của từng tr
                    let td = $(tr[i]).find("td");
                    // nếu khác với ô tìm kiếm thì ẩn
                    if($(td[index]).text().trim().toUpperCase() != value.trim().toUpperCase()) {
                        $(tr[i]).addClass("d-none");
                    }
                }
            }
        }else {
            console.log("Không tìm thấy cột");
        }
    }

    // trả về index trong của thẻ th + 1 || không tìm thấy trả về 0
    function findIndex(table, column) {
        let columnIndex = 0;
        $(table).find("thead").find("th").each((index, element) => {
            if($(element).text().trim().toUpperCase() == column.toUpperCase()) {
                columnIndex = index+1;
            }
        });
        return columnIndex;
    }
</script>