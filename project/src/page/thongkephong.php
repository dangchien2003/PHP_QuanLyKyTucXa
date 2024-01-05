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
                <i class="bi bi-building-add"></i>Thống kê phòng
            </div>
            <div class="baocao">
                <div class="thongke" id="thongkesoluongtrong">
                    <div class="data d-flex justify-content-center" id="data">
                        <?php
                        $sql = "SELECT phong.tinhTrang, COUNT(phong.tinhTrang) as sl, tinhTrang.tinhTrang as tentt, (select COUNT(*) from phong) as tongphong FROM phong JOIN tinhTrang on tinhTrang.id = phong.tinhTrang GROUP BY phong.tinhTrang; ";
                        $result = query_no_input($sql);
                        $data = [];
                        while ($row = $result->fetch_assoc()) {
                            switch ($row['tinhTrang']) {
                                case 15:
                                    if (checkRequest($data, [$row['tentt']])) {
                                        $data[$row['tentt']] += $row['sl'];
                                    } else {
                                        $data[$row['tentt']] = $row['sl'];
                                    }
                                    break;
                                case 18:
                                    if (checkRequest($data, [$row['tentt']])) {
                                        $data[$row['tentt']] += $row['sl'];
                                    } else {
                                        $data[$row['tentt']] = $row['sl'];
                                    }
                                    break;
                                default:
                                    if (checkRequest($data, ['Khác'])) {
                                        $data["Khác"] += $row['sl'];
                                    } else {
                                        $data["Khác"] = $row['sl'];
                                    }
                            }
                        }
                        foreach ($data as $key => $value) {
                            ?>
                            <span class="group">
                                <p><span class="option"><?php echo $key;?></span><span>: </span><span class=data><?php echo $value;?></span></p>
                            </span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="bieudo justify-content-center d-flex" id="bieudo">
                        <canvas></canvas>
                    </div>
                    <div class="name justify-content-center d-flex">
                        Thống kê tình trạng phòng
                    </div>
                </div>
                <div class="thongke" id="thongkesoluongtrong1">
                    <div class="data d-flex justify-content-center" id="data">
                    <?php
                        $sql = "SELECT count(slt) as sl, slt from (select (phong.sucChua-COUNT(sinhvien.maPhong)) as slt from phong LEFT JOIN sinhvien on phong.maPhong = sinhvien.maPhong where (sinhvien.tinhTrang != 1 AND phong.tinhTrang != 20) OR (sinhvien.tinhTrang is null AND phong.tinhTrang != 20) GROUP BY phong.maPhong) as tkslt GROUP BY slt";
                        $result = query_no_input($sql);
                        $data = [];
                        while ($row = $result->fetch_assoc()) {
                            ?> 
                            <span class="group">
                                <p><span class="option">Trống <?php echo $row['slt'];?></span><span>: </span><span class=data><?php echo $row['sl'];?></span></p>
                            </span>
                            <?php 
                        }
                        ?>
                    </div>
                    <div class="bieudo justify-content-center d-flex" id="bieudo">
                        <canvas></canvas>
                    </div>
                    <div class="name justify-content-center d-flex">
                        Thống kê chỗ trống
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include './layout/footer.php';
addScript(["chart", "thongke"])
    ?>