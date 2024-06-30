<?php
require 'helper.php';
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['image'])) {
            $imgData = $_POST['image'];

            // lấy base64 img
            $imgDecoded = getBase64($imgData);

            // Đường dẫn đến thư mục lưu trữ ảnh
            $uploadPath = '..\..\public\image\uploads\\';
            // echo "$uploadPath";


            if (isset($_POST['idsv']) && $_POST['idsv']) {

                // Tạo tên file
                $fileName = $_POST['idsv'] . '.png';

                // Đường dẫn ảnh
                $file = $uploadPath . $fileName;

                // lưu ảnh
                $success = file_put_contents($file, $imgDecoded);
                $sql = "update sinhvien set anh = ? where id = ?";
                $arr = str_split($_POST['idsv']);

                $id = "";
                foreach ($arr as $value) {
                    if (ctype_digit($value)) {
                        $id .= $value;
                    }
                }
                $result = query_input($sql, [$_POST['idsv'], $id]);
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
    log_error($e->getMessage());
    echo respone(504, "Lỗi trong quá trình xử lý");
    exit();
}
function respone($status, $message)
{
    $result = array('status' => $status, 'message' => $message);
    header('Content-Type: application/json');
    return json_encode($result);
}
