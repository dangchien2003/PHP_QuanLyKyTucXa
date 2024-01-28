<?php include './layout/header.php';
include_once '../handle/checkAccount.php'; ?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="min-height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-link"></i>Tạo liên kết
            </div>
            <div class="form-add row">
                <div class="col-lg-3">
                    <div class="icon">
                        <img src="../../public/image/icon/link.png" alt="" class="object">
                    </div>
                </div>
                <div class="col-lg-9" style="margin-top: 15px;">
                    <form action="../handle/hdtaolienket.php" method="post">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleFormControlInput1" class="form-label">Tên đích:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value=""
                                    name="namefile" required>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label">Dữ liệu đầu vào:</label>
                                <div>
                                    <input type="radio" value="1" name="indata" required> Có
                                    <input type="radio" value="0" name="indata" required> Không
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleFormControlInput1" class="form-label">Quyền:</label>
                                <select name="quyen" class="form-select" id="" required>
                                    <option hidden></option>
                                    <?php
                                    $sql = "select quyen.idQuyen, chucvu.chucDanh from quyen JOIN chucvu on chucvu.id = quyen.quanLy";
                                    $result = query_no_input($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row['idQuyen'] ?>">
                                            <?php echo $row['chucDanh'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-success" id="submit">Tạo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './layout/footer.php' ?>