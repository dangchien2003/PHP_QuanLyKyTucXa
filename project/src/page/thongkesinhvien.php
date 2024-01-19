<?php include './layout/header.php';
include_once '../handle/checkAccount.php';
?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="min-height: 1000px;">
        <div class="box">
            <div class="name">
            <i class="bi bi-bar-chart-line-fill"></i>Thống kê sinh viên
            </div>
            <div class="baocao">
                <div class="thongke" id="thongkesvdangkytheothang">
                    <div class="" style="text-align: right;">
                        <select name="" id="year">
                            <?php
                            for ($i = date("Y"); $i > (date("Y") - 50); $i--) {
                                if (checkRequest($_GET, ['year'])) {
                                    if ($i == $_GET['year']) {
                                        ?>
                                        <option value="<?php echo $i ?>" selected>
                                            <?php echo $i ?>
                                        </option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $i ?>">
                                            <?php echo $i ?>
                                        </option>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option value="<?php echo $i ?>">
                                        <?php echo $i ?>
                                    </option>
                                    <?php
                                }

                            }
                            ?>
                        </select>
                    </div>
                    <div class="data d-flex justify-content-center" id="data">
                        <?php
                        $year = date("Y");
                        if (checkRequest($_GET, ["year"])) {
                            $year = $_GET["year"];
                        }
                        $sql = "SELECT count(sinhvien.id) as sl, MONTH(sinhvien.ngayVao) AS thangVao FROM sinhvien WHERE sinhvien.ngayVao LIKE '$year%' GROUP BY month(sinhvien.ngayVao);";
                        $result = query_no_input($sql);
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <span class="group">
                                <p><span class="option">Tháng <?php echo $row['thangVao']; ?></span><span>: </span><span class=data><?php echo $row['sl']; ?></span></p>
                            </span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="bieudo justify-content-center d-flex" id="bieudo">
                        <canvas></canvas>
                    </div>
                    <div class="name justify-content-center d-flex">
                        Thống kê số lượng sinh viên đăng ký năm
                        <?php echo $year ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include './layout/footer.php';
addScript(["chart", "thongke"])
    ?>

<script>
    $(document).ready(function () {
        $("#year").on("change", function () {
            addParams("year", $("#year").val());
            // Load lại trang để áp dụng URL mới
            window.location.reload();
        })
    })
</script>