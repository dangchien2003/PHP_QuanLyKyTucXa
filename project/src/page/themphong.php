<?php include './layout/header.php' ?> 
    <div class="row">
        <div class="col-lg-3 bg-menu">
        <?php include './layout/menu.php' ?>
        </div>
        <div class="col-lg-9 sdp tp" style="height: 1000px;">
            <div class="box">
                <div class="name">
                    <i class="bi bi-building-add"></i>Thêm phòng ở
                </div>
                <div class="form-add row">
                    <div class="col-md-3">
                        <div class="icon">
                            <img src="../../public/image/icon/room.png" alt="" class="object">
                            <img src="../../public/image/icon/plus.png" alt="" class="action">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <form action="../handle/themphong.php" method="post">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="exampleFormControlInput1" class="form-label">Ký hiệu phòng:</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="P"
                                        name="kyhieu" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleFormControlInput1" class="form-label">Mã phòng:</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="maphong"
                                        required>
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleFormControlInput1" class="form-label">Tầng:</label>
                                    <select class="form-select" aria-label="Default select example" name="tang"
                                        required>
                                        <option value="1" selected>1</option>
                                        <?php
                                        $sql = "SELECT MIN(tang) as min, MAX(tang) as max from phong";
                                        $result = query_no_input($sql);
                                        $min = 0;
                                        $max = 0;
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $min = $row["min"];
                                                $max = $row["max"];
                                            }

                                            for ($i = 2; $i <= $max; $i++) {
                                                ?>
                                                <option value="<?php echo $i; ?>">
                                                    <?php echo $i; ?>
                                                </option>
                                                <?php

                                            }
                                        }
                                        ?>
                                        <option value="0">Khác</option>

                                    </select>
                                </div>
                                <div class="col-md-2" style="padding: 0;">
                                    <label for="exampleFormControlInput1" class="form-label"></label>
                                    <input type="number" class="form-control d-none" id="exampleFormControlInput1"
                                        name="sotang" style="margin-top: 13px; width: 70px;" value="1" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="exampleFormControlInput1" class="form-label">Sức chứa:</label>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" value="P"
                                        name="succhua" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="exampleFormControlInput1" class="form-label">Tình trạng:</label>
                                    <select class="form-select" aria-label="Default select example" name="tinhtrang"
                                        required>
                                        <?php
                                        $sql = "SELECT tinhtrang, id from tinhtrang";
                                        $result = query_no_input($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row["id"] ?> " <?php if ($row["id"] == 18) {
                                                        echo 'selected';
                                                    } ?>>
                                                    <?php echo $row["tinhtrang"]; ?>
                                                </option>
                                                <?php

                                            }
                                        } else {
                                            echo '<option value="0" selected>Phòng trống</option>';
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Tạo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include './layout/footer.php' ?> 

    <script>
        $(document).ready(function () {
            $('select[name="tang"]').change(function () {
                if ($('select[name="tang"]').val() == 0) {
                    $('input[name="sotang"]').removeClass('d-none');
                } else {
                    $('input[name="sotang"]').addClass('d-none');
                }
            })
            $('input[name="sotang"]:first').on('input', function () {
                var value = parseInt($(this).val());
                if (value <= 0) {
                    $(this).val(1);
                }
            });
            $('input[name="succhua"]:first').on('input', function () {
                var value = parseInt($(this).val());
                if (value < 0) {
                    $(this).val(0);
                }
            });
        })
    </script>
