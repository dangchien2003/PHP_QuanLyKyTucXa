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
                <i class="bi bi-bar-chart-line-fill"></i>Thống kê phòng
            </div>
            <div class="date" style="text-align: right;">
                <?php
                $date = date('Y-m');
                if(checkRequest($_GET, ["date"])) {
                    $date = $_GET['date'];
                }
                    ?>
                    <input type="date" id="fillter-d" value="<?php echo $date?>-01">
                    <?php

                ?> 
                
            </div>
            <div class="baocao">
                <div class="row">
                <div class="thongke col-lg-6" id="thongkehoadondiennuoc">
                        <div class="data d-flex justify-content-center" id="data">
                            <?php
                            $sql = "SELECT COUNT(hoadondiennuoc.tinhtrang) as sl, hoadondiennuoc.tinhtrang, tinhtrang.tinhtrang as tentt FROM hoadondiennuoc JOIN tinhtrang ON tinhtrang.id = hoadondiennuoc.tinhtrang WHERE ngayChot LIKE '$date-%' GROUP BY tinhtrang;";
                            $result = query_no_input($sql);
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <span class="group">
                                    <p><span class="option"><?php echo $row['tentt'] ?></span><span>: </span><span class=data><?php echo $row['sl']; ?></span></p>
                                </span>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="bieudo justify-content-center d-flex" id="bieudo">
                            <canvas></canvas>
                        </div>
                        <div class="name justify-content-center d-flex">
                            Thống kê hoá đơn điện nước
                        </div>
                    </div>
                    <div class="thongke col-lg-6" id="thongkehoadonphong">
                        <div class="data d-flex justify-content-center" id="data">
                            <?php
                            $sql = "SELECT COUNT(hoadonphong.tinhtrang) as sl, hoadonphong.tinhtrang, tinhtrang.tinhtrang as tentt FROM hoadonphong JOIN tinhtrang ON tinhtrang.id = hoadonphong.tinhtrang WHERE ngayChot LIKE '$date-%' GROUP BY tinhtrang;";
                            $result = query_no_input($sql);
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <span class="group">
                                    <p><span class="option"><?php echo $row['tentt'] ?></span><span>: </span><span class=data><?php echo $row['sl']; ?></span></p>
                                </span>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="bieudo justify-content-center d-flex" id="bieudo">
                            <canvas></canvas>
                        </div>
                        <div class="name justify-content-center d-flex">
                            Thống kê hoá đơn phòng
                        </div>
                    </div>
                </div>
                <div class="thongke col-lg-6" id="thongkehoadonxe">
                    <div class="data d-flex justify-content-center" id="data">
                        <?php
                        $sql = "SELECT COUNT(hoadonguixe.tinhtrang) as sl, hoadonguixe.tinhtrang, tinhtrang.tinhtrang as tentt FROM hoadonguixe JOIN tinhtrang ON tinhtrang.id = hoadonguixe.tinhtrang WHERE ngayChot LIKE '$date-%' GROUP BY tinhtrang;";
                        $result = query_no_input($sql);
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <span class="group">
                                <p><span class="option"><?php echo $row['tentt'] ?></span><span>: </span><span class=data><?php echo $row['sl']; ?></span></p>
                            </span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="bieudo justify-content-center d-flex" id="bieudo">
                        <canvas></canvas>
                    </div>
                    <div class="name justify-content-center d-flex">
                        Thống kê hoá đơn gửi xe
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
        $(document).ready(function() {
            $("#fillter-d").on("change", function() {
                var selectDate = $("#fillter-d").val();
                var objectDate = new Date(selectDate);
                if(objectDate < new Date()) {
                    var year = objectDate.getFullYear();
                    var month = (objectDate.getMonth()+1).toString().length == 1?"0"+(objectDate.getMonth()+1):(objectDate.getMonth()+1);
                    var date = year + "-" + month;
                    addParams("date", date);
                    location.reload();
                }
                
            })
        })
    </script>