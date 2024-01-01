<?php
    include_once  './helper.php';
    $sql = "SELECT * from sinhvien where hoTen = ?";
    $infoSV = query_input($sql, ["Nguyễn Huy Hoà"]);
    while($info = $infoSV->fetch_assoc()){
        echo $info["id"];
    }
?> 