<?php
    include '../config/configdb.php';
    function select_no_input ($sql){
        $start = $GLOBALS["conn"]->prepare($sql);
        // $start->bind_param("i");
        $start->execute();
        $result = $start->get_result();
        return $result;
    }
    function select_input ($sql, $values){
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
?>  