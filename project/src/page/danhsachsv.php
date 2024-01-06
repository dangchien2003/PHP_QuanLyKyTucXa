<?php include_once './layout/header.php' ?>
<?php include_once '../handle/checkAccount.php' ?>

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
                <div class="find-tang">
                    <div class="fs-15 fw-500">Tầng:</div>
                    <select class="form-select " aria-label="Default select example" id="fillter_t">
                        <option value="0" <?php if(checkRequest($_GET, ['t'], true)) {
                            if($_GET['t'] == 0){
                                echo "selected";
                            }
                        }?> >Tất cả</option>
                        <option value="1" <?php if(checkRequest($_GET, ['t'], true)) {
                            if($_GET['t'] == 1){
                                echo "selected";
                            }
                        }?>>Tầng 1</option>
                        <option value="2" <?php if(checkRequest($_GET, ['t'], true)) {
                            if($_GET['t'] == 2){
                                echo "selected";
                            }
                        }?>>Tầng 2</option>
                        <option value="3" <?php if(checkRequest($_GET, ['t'], true)) {
                            if($_GET['t'] == 3){
                                echo "selected";
                            }
                        }?>>Tầng 3</option>
                    </select>
                </div>
                <div class="ttp">
                    <div class="fs-15 fw-500">Tình trạng phòng:</div>
                    <nav class="navbar navbar-light">
                        <form action="" method="get" class="container-fluid justify-content-start pd-0"
                            id="form_fillter">
                            <a href="./danhsachsv.php?tt=0" class="mgr-10"><button class="btn me-2" type="button"
                                    id="tatca">Tất cả</button></a>
                            <a href="./danhsachsv.php?tt=2"><button class="btn me-2" type="button" id="dango"><img
                                        src="../../public/image/icon/audience.png" alt="" class="img-icon">Đang
                                    ở</button></a>
                            <a href="./danhsachsv.php?tt=1"><button class="btn me-2" type="button" id="daroidi"><img
                                        src="../../public/image/icon/null.png" alt="" class="img-icon">Đã rời
                                    đi</button></a>
                            <input type="text" class="btn me-2" placeholder="Tìm sinh viên" id="find_MP">
                            <select id="find_column" class="btn me-2">
                                <option value="#">#</option>
                                <option value="phong">Phòng</option>
                                <option value="ten">Tên</option>
                                <option value="ngaysinh">Ngày sinh</option>
                                <option value="Ngày vào">Ngày vào</option>
                            </select>
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
                    <tbody id="body_table">
                        <?php
                        include_once '../handle/helper.php';
                        $item_one_page = 6;
                        $result = null;
                        $page = 1;
                        $tt = "sinhvien.tinhTrang";
                        $t = "phong.tang";
                        if(checkRequest($_GET, ["t"])) {
                            $t = $_GET["t"];
                        }

                        if (checkRequest($_GET, ["page"])) {
                            $page = $_GET["page"];
                        }

                        if (checkRequest($_GET, ["tt"], true)) {
                            switch ($_GET["tt"]) {
                                case "2":
                                    $tt = 2;
                                    break;
                                case "1":
                                    $tt = 1;
                                    break;
                            }
                        }
                        $sql = "SELECT sinhvien.id, anh, hoTen, sinhvien.maPhong, namSinh, ngayVao, tinhTrang.id as idtt, tinhTrang.tinhTrang FROM sinhvien JOIN tinhTrang on tinhTrang.id = sinhvien.tinhTrang join phong on sinhvien.maPhong = phong.maPhong where sinhvien.tinhtrang = $tt and phong.tang = $t  LIMIT ?, ?";
                        
                        $result = query_input($sql, [($page-1)*$item_one_page, $page * $item_one_page]);
                        if ($result->num_rows == 0) {
                            echo '<div class="bi-text-center">Không có thông tin</div>';
                        } else {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td scope="row" style="font-weight: bold;">
                                        <?php echo $row['id'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['maPhong'] ?>
                                    </td>
                                    <td><img src="../../public/image/uploads/<?php echo $row['anh'] ?>.png "
                                            class="mini_img"></img>
                                        <?php echo $row['hoTen'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['namSinh'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['ngayVao'] ?>
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
                                            <?php echo $row['tinhTrang'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="./thongtinsv.php?idsv=<?php echo $row['id'] ?>&action=show  " class="show">
                                            <div class="btn-tt d-inline-block bgr-ok">Xem</div>
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
            <nav aria-label="...">
                <ul class="pagination pagination-sm">
                    <?php
                    $sql = "SELECT CEILING(count(*)/$item_one_page) as page FROM sinhvien";
                    $result = query_no_input($sql);
                    while ($row = $result->fetch_assoc()) {
                        $page = 1;
                        if (checkRequest($_GET, ["page"])) {
                            if (ceil($_GET["page"]) <= $row["page"]) {
                                $page = $_GET["page"];
                            }
                        }
                        for ($i = 1; $i <= $row["page"]; $i++) {
                            if ($i == $page) {
                                ?>
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link"><?php echo $i ?></span>
                                </li>
                                <?php
                            } else {
                                    ?>
                                    <li class="page-item"><a class="page-link" href="<?php 
                                        if (strpos($_SERVER['REQUEST_URI'], "page=") !== false) {
                                            // Nếu chuỗi cần tìm tồn tại trong chuỗi ban đầu, thực hiện thay thế
                                            $chuoiMoiSauThayThe = str_replace('page='.$_GET['page'], "page=$i", $_SERVER['REQUEST_URI']);
                                            echo $chuoiMoiSauThayThe;
                                        } else {
                                            if(count($_GET) > 0) {
                                                echo $_SERVER['REQUEST_URI']."&page=$i";
                                            }else {
                                                echo $_SERVER['REQUEST_URI']."?page=$i";
                                            }
                                            
                                        }
                                        ?>"><?php echo $i ?></a></li>
                                    <?php 
                                
                                ?>
                                
                                <?php
                            }
                            ?>


                            <?php

                        }
                    }

                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<?php include_once './layout/footer.php' ?>

<script>
    $(document).ready(function () {
        // lọc ô input
        $("#find_MP").on("change", () => {
            find();
        })


        $("#find_column").on("change", () => {
            find();
        })


        function find() {
            findTable($(".table")[0], $("#find_MP").val(), $("#find_column").val())
            // 
            var tr = $(".table").eq(0).find("tbody").find("tr");
            var tbody_empty = true;
            for(let i = 0; i < tr.length; i++) {
                // nếu có tr không có class d-none
                if(!$(tr[i]).hasClass("d-none")) {
                    // tbody không rỗng
                    tbody_empty = false;
                    break;
                }
            }

            if(tbody_empty){
                // thấy thông tin tìm kiếm
                inp = $("#find_MP").val().trim();
                col = $("#find_column").val().trim();

                // lấy dữ liệu từ server
                callServer();
                
            }
        }

        // lọc select tầng
        $("#fillter_t").on("change", () => {
            let currentURL = window.location.href; // Lấy URL hiện tại
            let tangValue = $("#fillter_t").val(); // Lấy giá trị của thẻ select

            let url = new URL(currentURL);
            let params = new URLSearchParams(url.search);

            // Xóa tất cả các tham số 't' hiện có từ URL
            params.delete('t');

            // Thêm tham số 't' mới vào URL
            params.set('t', tangValue);

            // Gán các tham số đã chỉnh sửa vào URL
            url.search = params.toString();
            history.replaceState(null, '', url.toString()); // Cập nhật URL mà không tạo ra lịch sử duyệt

            // Load lại trang để áp dụng URL mới
            window.location.reload();
        })
    })

    function removeVietnameseDiacritics(str) {
        return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    }
    function callServer() {
        // Tạo FormData object và thêm dữ liệu hình ảnh vào
        const formData = new FormData();
        formData.append("inp", $("#find_MP").val().trim());
        formData.append("col", removeVietnameseDiacritics($("#find_column").val().trim()));
        // Gửi dữ liệu ảnh đến server bằng XMLHttpRequest
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../../src/handle/findSV.php"); // api
        xhr.onload = function () {
            console.log(xhr.responseText);
            // nếu gọi lên server thành công
            if (xhr.status === 200) {
                // kết quả trả về và giải mã chuỗi json
                var res = JSON.parse(xhr.responseText);
                
                switch (res.status) {
                    case 200:
                        // thêm kết quả vào bảng
                        let tbody = document.getElementById("body_table");
                        tbody.innerHTML += res.message;
                        break;
                    case 505:
                        toastError("Không tìm thấy id");
                        break;
                    case res.status >= 500:
                        toastError("Lỗi máy chủ");
                        break;
                }
            } else {
                console.error("Có lỗi xảy ra.");
            }
        };
        // gửi form
        xhr.send(formData);
    }
    function findTable(table, value, column) {
        var index = findIndex(table, column);
        numColumn = $(table).find("thead").find("th").length;
        if (index) {
            index = index - 1;
            let tr = Array.from($(table).find("tbody").find("tr"));
            // nếu ô tìm kiếm rỗng hoặc bằng 0
            if (value == "" || value == 0) {
                for (let i = 0; i < tr.length; i++) {
                    // mở ẩn
                    $(tr[i]).removeClass("d-none");
                }
            } else {
                // lặp qua từng tr
                for (let i = 0; i < tr.length; i++) {
                    // mở ẩn
                    $(tr[i]).removeClass("d-none");
                    // lấy td của từng tr
                    let td = $(tr[i]).find("td");
                    // nếu khác với ô tìm kiếm thì ẩn
                    if ($(td[index]).text().trim().toUpperCase() != value.trim().toUpperCase()) {
                        $(tr[i]).addClass("d-none");
                    }
                }
            }
        } else {
            callServer();
        }
    }

    // trả về index trong của thẻ th + 1 || không tìm thấy trả về 0
    function findIndex(table, column) {
        let columnIndex = 0;
        $(table).find("thead").find("th").each((index, element) => {
            if (convertVietnameseString($(element).text().trim().toUpperCase()) == convertVietnameseString(column.toUpperCase())) {
                columnIndex = index + 1;
            }
        });
        return columnIndex;
    }
    function convertVietnameseString(str) {
        // Chuyển đổi chuỗi tiếng Việt có dấu thành chuỗi không dấu
        let convertedStr = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

        // Xoá dấu cách (space)
        convertedStr = convertedStr.replace(/\s/g, "");

        // Chuyển đổi thành chữ in hoa
        convertedStr = convertedStr.toUpperCase();

        return convertedStr;
    }
    
</script>