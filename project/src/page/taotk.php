<?php include './layout/header.php';
include '../handle/checkAccount.php' ?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="min-height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-person-fill-add"></i>Tạo tài khoản
            </div>
            <div class="form-add row">
                <div class="col-lg-3">
                    <div class="icon">
                        <img src="../../public/image/icon/account.png" alt="" class="object">
                        <img src="../../public/image/icon/plus.png" alt="" class="action">
                    </div>
                </div>
                <div class="col-lg-9" style="margin-top: 15px;">
                    <form action="../handle/taotk.php" method="post">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleFormControlInput1" class="form-label">Tên đăng nhập:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value=""
                                    name="user" required>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label">Mật khẩu:</label>
                                <div class="" id="password">
                                    <input type="password" class="form-control" id="exampleFormControlInput1" value=""
                                        name="password" required id="password">
                                    <span id="random">RĐ</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="exampleFormControlInput1" class="form-label">NV(ID):</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value=""
                                    name="nv" required>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label">Tình trạng:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="Khoá" readonly>
                            </div>
                        </div>
                        <button class="btn btn-success">Tạo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './layout/footer.php' ?>