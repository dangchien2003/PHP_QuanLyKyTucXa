<?php include './layout/header.php';
include_once '../handle/checkAccount.php' ?>
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
                                <div id="password" >
                                    <input type="password" class="form-control" id="newpass" value=""
                                        name="password" required >
                                    <span id="random">RĐ</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label">Quyền:</label>
                                <select name="quyen" class="form-select" id="" require>
                                    <?php
                                    $sql = "select * from chucvu";
                                    $result = query_no_input($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        ?> 
                                        <option value="<?php echo $row['id']?>"><?php echo $row['chucDanh']?></option>
                                        <?php 
                                    }
                                    ?> 

                                </select>
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
<script>
    $(document).ready(function() {
        $('#random').click(function(){
            $('#newpass').val(randomUpperCaseString(10));
        })
    })
    function randomUpperCaseString(length) {
        const characters = 'abcdefghijklmnopqrstuvwxyz';
        const randomChar = characters.charAt(Math.floor(Math.random() * characters.length));
        const randomString = randomChar.toUpperCase() + Array.from({ length: length - 1 }, () => characters.charAt(Math.floor(Math.random() * characters.length))).join('');
        return randomString;
    }
</script>