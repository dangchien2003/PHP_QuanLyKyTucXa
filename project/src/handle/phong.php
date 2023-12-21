<?php
    include 'helper.php';
    function printListRoom($sql) {
        $list_room = query_no_input($sql);
        if($list_room->num_rows > 0) {
            while($room =  $list_room->fetch_assoc()) {
                $bg_room = "";
                switch($room["matt"]) {
                    case 2:
                        $bg_room = "bg-red";
                    break;
                    default:
                        $bg_room = "bg-green";
                }
                
                $soLuong = "0";
                if(!$room["idsv"]) {
                    $soLuong = "0/".$room["sucChua"];
                }else {
                    $soLuong = $room["soNguoi"]."/".$room["sucChua"];
                }
                


                echo "<a href="."./roomInfo.php?mp=".$room['phong']."> <div class='room $bg_room'>
                <div class='top d-flex justify-content-center align-items-end'>
                    <span>" . $room['phong'] . "</span>
                </div>
                <div class='mid d-flex justify-content-center align-items-end'>
                    <span>". $room['tinhTrang']."</span>
                </div>
                <div class='bottom d-flex justify-content-center align-items-end'>
                    <span>".$soLuong."</span>
                </div>
            </div></a>";
            }
        } else {
            echo '<div style="text-align: center;">Không có phòng</div>';
        }
    }
?> 