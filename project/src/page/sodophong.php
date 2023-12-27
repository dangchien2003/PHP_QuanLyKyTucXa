 
    <?php include 'layout/header.php' ?> 
    <div class="row">
        <div class="col-lg-3 bg-menu">
            <?php include 'layout/menu.php' ?> 
        </div>
        <div class="col-lg-9 sdp" style="height: 1000px;">
            <div class="box">
                <div class="name">
                    <i class="bi bi-building"></i>Sơ đồ phòng
                </div>
                <div class="find">
                    <div class="find-tang ">
                        <div class="fs-15 fw-500">Tầng:</div>
                        <select class="form-select " aria-label="Default select example">
                            <option value = "0" >Tất cả</option>
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
                            </form>
                          </nav>
                    </div>
                </div>
                <div class="list-room">
                    <?php
                        include '../handle/phong.php';
                        $sql = "SELECT sinhvien.id as idsv, phong.sucChua, CONCAT(phong.kyHieu, phong.maPhong) AS phong, tinhtrang.tinhTrang, phong.tinhTrang as matt, COUNT(phong.maPhong) as soNguoi FROM phong LEFT JOIN sinhvien ON sinhvien.maPhong = phong.maPhong LEFT JOIN tinhTrang on tinhTrang.id = phong.tinhTrang GROUP BY phong.maPhong;";
                        printListRoom($sql);
                    ?> 
                    
                </div>
            </div>
        </div>
    </div>

<?php include 'layout/footer.php'?> 

