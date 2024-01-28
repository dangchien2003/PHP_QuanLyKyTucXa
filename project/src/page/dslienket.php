<?php include './layout/header.php';
    include_once '../handle/checkAccount.php';
    $find = $_GET['url'] ?? "";
?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="min-height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-link"></i>Liên kết
            </div>
            <div class="find">
               
                <div class="ttp">
                    <div class="fs-15 fw-500">Tìm kiếm:</div>
                    <div class="">
                            <input type="text" class="btn me-2" placeholder="Tìm url" id="find_url" value="<?php echo $find?>">
                            <a href="./taolienket.php?tt=0" class="mgr-10"><button class="btn me-2 bgr-ok" type="button" id="tatca">Tạo mới</button></a>
                    </div>
                   
                </div>
            </div>
            <table class="table table-hover" id="table-tk">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Liên kết</th>
                        <th scope="col">Quyền</th>
                        <th scope="col">Dữ liệu đầu vào</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody id="body_table">
                    <?php
                    
                    $sql = "SELECT * from url  where url.url like ? ORDER BY url, id";
                    $result = query_input($sql,["%$find%"]);
                    // $result = query_no_input($sql);
                    $next = false;
                    $bg = "#fffbfb";
                    $start = true;
                    $link = "";
                    while ($row = $result->fetch_assoc()) {
                        if(!$start) {
                            if($link != $row['url']) {
                                $next = !$next;
                                $link = $row['url'];
                            }
                        }else {
                            $link = $row['url'];
                        }
                        ?>
                        <tr <?php if($next) echo 'style="background-color:'.$bg.'"'?>>
                            <td>
                                <?php echo $row['id'] ?>
                            </td>
                            <td>
                                <?php echo $row['url'] ?>
                            </td>
                            <td>
                                <?php echo $row['quyen'] ?>
                            </td>
                            <td>
                                <?php if ($row['indata']) {
                                    ?>
                                    Có
                                <?php
                                } else {
                                    ?>
                                    Không
                                <?php
                                } ?>
                            </td>
                            <td>
                                <a href="../handle/xoaurl.php?id=<?php echo $row['id'] ?>" class="show" onclick="return confirm('Bạn có chắc chắn muốn xoá?')">
                                    <div class="btn-tt d-inline-block bgr-error">Xoá</div>
                                </a>
                                <a href="./ttlienket.php?id=<?php echo $row['id'] ?>" class="show">
                                    <div class="btn-tt d-inline-block bgr-ok">Sửa</div>
                                </a>
                            </td>
                        </tr>
                    <?php
                    $start = false;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include './layout/footer.php' ?>

<script>
    $(document).ready(function() {
        $("#find_url").on("change", function() {
            addParams("url", $("#find_url").val().trim())
            location.reload();
        })
    })
</script>