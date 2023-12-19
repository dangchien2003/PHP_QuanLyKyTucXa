<?php
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['image'])) {
            $imgData = $_POST['image'];

            // loại bỏ phần đầu của base64(chỉ định kiểu và đuôi ảnh)
            $imgData = str_replace('data:image/png;base64,', '', $imgData);
            //thay ' ' thành + để chuẩn định dạng base64
            $imgData = str_replace(' ', '+', $imgData);

            // Giải mã dữ liệu ảnh từ Base64
            $imgDecoded = base64_decode($imgData);

            // Đường dẫn đến thư mục lưu trữ ảnh
            $uploadPath = 'E:\DH_CNDA\PHP\BTL\PHP_QuanLyKyTucXa\project\public\image\uploads\\';



            if (isset($_POST['idsv']) && $_POST['idsv']) {

                // Tạo tên file
                $fileName = $_POST['idsv'] . '.png';

                // Đường dẫn ảnh
                $file = $uploadPath . $fileName;

                // lưu ảnh
                $success = file_put_contents($file, $imgDecoded);

                if ($success) {
                    echo respone(200, "Đã lưu trữ ảnh: $fileName");
                    exit();
                } else {
                    echo respone(501, "Có lỗi khi lưu ảnh");
                    exit();
                }
            } else {
                echo respone(505, "Không tìm thấy id");
                exit();
            }
        } else {
            echo respone(502, "Không có dữ liệu ảnh");
            exit();
        }
    } else {
        echo respone(503, "Phương thức không hợp kệ");
    }
} catch (Exception $e) {
    echo respone(504, "Lỗi trong quá trình xử lý");
    exit();
}
function respone($status, $message)
{
    $result = array('status' => $status, 'message' => $message);
    header('Content-Type: application/json');
    return json_encode($result);
}
