<?php
    include '../config/configdb.php';
    function query_no_input ($sql){
        $start = $GLOBALS["conn"]->prepare($sql);
        $run = $start->execute();
        $typeSql = explode(" ", trim($sql))[0];
        if($typeSql === "SELECT" && $run) {
            $result = $start->get_result();
            return $result;
        }else {
            return $run;
        }
    }
    function query_input ($sql, $values){
        try {
            $start = $GLOBALS["conn"]->prepare($sql);
            $types = "";
            foreach ($values as $value) {
                if (is_int($value)) {
                    $types .= "i"; // Loại dữ liệu là integer
                } elseif (is_float($value)) {
                    $types .= "d"; // Loại dữ liệu là double
                } elseif (is_string($value)) {
                    $types .= "s"; // Loại dữ liệu là string
                }
            }
            $start->bind_param($types, ...$values);
            $run = $start->execute();
            $typeSql = explode(" ", trim($sql))[0];
            if($typeSql === "SELECT" && $run) {
                $result = $start->get_result();
                return $result;
            }else {
                return $run;
            }
        }catch (Exception $e) {
            return false;
        }
        
        
    }


    function createKeyValueArray($keys, $values) {
        // Kiểm tra số lượng phần tử trong mảng keys và values
        $numKeys = count($keys);
        $numValues = count($values);

        // Nếu số lượng phần tử không khớp, không thể tạo mảng key-value
        if ($numKeys !== $numValues) {
            return false; // Hoặc xử lý lỗi theo ý muốn của bạn
        }

        // Tạo mảng key-value từ các mảng keys và values
        $result = array_combine($keys, $values);

        return $result;
    }

    function checkRequest($method, $names) {
        foreach($names as $name) {
            if(isset($method["$name"])) {
                if(empty($method["$name"])) {
                    return false; // nếu rỗng
                }
            }else {
                return false; //nếu không tồn tại
            }
        }
        
        return true;
    }
?> 
