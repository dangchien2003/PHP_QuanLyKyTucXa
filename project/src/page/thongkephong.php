<?php include './layout/header.php' ?>
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
                        <span class="group">
                            <p><span class="option">Phòng trống</span><span>: </span><span class=data>1</span></p>
                        </span>
                        <span class="group">
                            <p><span class="option">Đang ở</span><span>: </span><span class=data>1</span></p>
                        </span>
                        <span class="group">
                            <p><span class="option">Khác</span><span>: </span><span class=data>1</span></p>
                        </span>
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
                        <span class="group">
                            <p><span class="option">Trống 1</span><span>: </span><span class=data>1</span></p>
                        </span>
                        <span class="group">
                            <p><span class="option">Trống 2</span><span>: </span><span class=data>5</span></p>
                        </span>
                        <span class="group">
                            <p><span class="option">Trống 3</span><span>: </span><span class=data>2</span></p>
                        </span>
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
