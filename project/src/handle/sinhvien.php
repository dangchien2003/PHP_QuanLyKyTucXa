<?php
    include './helper.php';
    $sql = "SELECT * from sinhvien where hoTen = ?";
    $infoSV = select_input($sql, ["Nguyễn Huy Hoà"]);
    while($info = $infoSV->fetch_assoc()){
        echo $info["id"];
    }
?> 