<?php include './layout/header.php';
include '../handle/checkAccount.php'
?>
<div class="row">
    <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?>
    </div>
    <div class="col-lg-9 sdp tp" style="min-height: 1000px;">
        <div class="box">
            <div class="name">
                <i class="bi bi-link"></i>Thông tin liên kết
            </div>
            <div class="form-add row">
                <div class="col-lg-3">
                    <div class="icon">
                        <img src="../../public/image/icon/link.png" alt="" class="object">
                    </div>
                </div>
                <div class="col-lg-9" style="margin-top: 15px;">
                    <form action="../handle/hndsualienket.php" method="post">
                        <?php
                        if (checkRequest($_GET, ['id'])) {
                            $sql = "select * from url where id = ?";
                            $result = query_input($sql, [$_GET['id']]);
                            if ($result->num_rows == 1) {
                                while ($row = $result->fetch_assoc()) {

                        ?>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="exampleFormControlInput1" class="form-label">Tên đích:</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $row['url'] ?>" required readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleFormControlInput1" class="form-label">Dữ liệu đầu vào:</label>
                                            <div>
                                                <input type="radio" value="1" name="indata" required <?php if ($row['indata'] == 1) echo "checked" ?>> Có
                                                <input type="radio" value="0" name="indata" required <?php if ($row['indata'] == 0) echo "checked" ?>> Không
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
                                                while ($rowcd = $result->fetch_assoc()) {
                                                ?>
                                                    <option value="<?php echo $rowcd['idQuyen'] ?>" <?php if($rowcd['idQuyen'] == $row['quyen']) echo "selected"?> >
                                                        <?php echo $rowcd['chucDanh'] ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <input type="password" name='id' value="<?php echo $row['id'] ?>" class='d-none' required>
                                        </div>
                                    </div>
                                    <button class="btn btn-success" id="submit">Tạo</button>
                        <?php

                                }
                            } else {
                                echo '<div class="bi-text-center">Không có thông tin</div>';
                            }
                        } else {
                            echo '<div class="bi-text-center">Không có thông tin</div>';
                        }
                        ?>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include './layout/footer.php' ?>