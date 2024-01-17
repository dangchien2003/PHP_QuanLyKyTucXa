<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/toast.css">
</head>

<body>
    <?php  
        
    ?> 
    <div id="toast"></div>
    <div class="align-items-center d-flex justify-content-center h100" id="calc">
        <form action="../handle/checklogin.php" method="post" class="login">
            <div class="line-header">
                <h2 class="text-center text-white">Đăng nhập</h2>
            </div>

            <div class="login-input d-flex flex-wrap justify-content-center position-relative">
                <div class="user w-100 d-flex justify-content-center">
                    <div class="icon-user">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <input type="text" id="user-input" placeholder="Tên đăng nhập" name="username" required>
                </div>
                <div class="pass w-100 d-flex justify-content-center">
                    <div class="icon-pass">
                        <i class="bi bi-key-fill"></i>
                    </div>
                    <input type="password" id="pass-input" placeholder="Mật khẩu" name="password" required>
                    <div class="eye">
                        <i class="bi bi-eye-fill"></i>
                        <i class="bi bi-eye-slash-fill"></i>
                    </div>
                </div>
                
            </div>
            <div class="nho  w-100 " style="padding: 0 30px; color: white;">
                    <input type="radio" name="nho" id="nho"> Nhớ mật khẩu
                </div>
            <a href="#" class="text-decoration-none d-flex justify-content-center">
                <button class="dangnhap" type="submit">
                    <p class="line-dangnhap text-decoration-none text-white">login</p>
                </button>
            </a>
        </form>
    </div>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/jquery.js"></script>
    <script src="../../public/js/login.js"></script>
    <script src="../../public/js/toast.js"></script>
    <script src="../../public/js/app.js"></script>
</body>
</html>