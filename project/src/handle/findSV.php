<?php
include_once 'helper.php';

try {
    if (checkRequest($_POST, ['inp', 'col'])) {
        $col = "sinhvien.id";
        switch (trim(strtoupper($_POST['col']))) {
            case "PHONG":
                $col = "sinhvien.maPhong";
                break;
            case "TEN":
                $col = "sinhvien.hoten";
                break;
            case "NGAYSINH":
            case "NGAY SINH":
                $col = "sinhvien.namsinh";
                break;
            case "NGAYVAO":
            case "NGAY VAO":
                $col = "sinhvien.ngayvao";
                break;
        }
        $sql = "SELECT sinhvien.id, anh, hoTen, sinhvien.maPhong, namSinh, ngayVao, tinhTrang.id as idtt, tinhTrang.tinhTrang FROM sinhvien JOIN tinhTrang on tinhTrang.id = sinhvien.tinhTrang where $col = ?";
        $result = query_input($sql, [$_POST["inp"]]);
        $message = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $class = null;
                switch ($row['idtt']) {
                    case 1:
                        $class = "bgr-no-ok";
                        break;
                    case 2:
                        $class = "bgr-ok";
                        break;
                    case 3:
                        $class = "bgr-info";
                        break;
                    case 4:
                        $class = "bgr-wait";
                        break;
                    default:
                        $class = "bgr-wait";
                        break;
                }
                $message .= '<tr><td scope="row" style="font-weight: bold;">' . $row['id'] . '</td><td>' . $row['maPhong'] . '</td><td><img src="../../public/image/uploads/' . $row['anh'] . '.png "class="mini_img"></img>' . $row['hoTen'] . '</td><td>' . $row['namSinh'] . '</td><td>' . $row['ngayVao'] . '</td><td><div class="btn-tt ' . $class . '">' . $row['tinhTrang'] . '</div></td><td><a href="./thongtinsv.php?idsv=' . $row['id'] . '&action=show" class="show"><div class="btn-tt d-inline-block bgr-ok">Xem</div></a><a href="#" class="show"><div class="btn-tt d-inline-block bgr-error">Xoá</div></a></td></tr>';
            }
        }
        echo respone(200, $message);
    } else {
        echo respone(505, "Không tìm thấy");
    }
} catch (PDOException $e) {
    log_error($e->getMessage());
    echo respone(504, "LỖI");
}

function respone($status, $message)
{
    $result = array('status' => $status, 'message' => $message);
    header('Content-Type: application/json');
    return json_encode($result);
}
?>