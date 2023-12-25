<?php
    include '../config/configdb.php';
    
    function query_no_input ($sql){
        try {
            connectDB();
            $start = $GLOBALS["conn"]->prepare($sql);
            $run = $start->execute();
            $typeSql = explode(" ", trim($sql))[0];
            if($typeSql === "SELECT" && $run) {
                $result = $start->get_result();
                closeDB($start);
                return $result;
            }else {
                closeDB($start);
                $run = explode(" ", trim($sql));
                return $run;
            }
        }catch(Exception $e) {
            throw new Exception;
        }
        
    }
    function query_input ($sql, $values){
        try {
            // Kiểm tra số lượng tham số
            $numParams = substr_count($sql, '?');
            $numValues = count($values);
            if ($numParams !== $numValues) {
                throw new Exception("tham số truyền không trùng nhau");
            }
            connectDB();
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
            if(strtoupper($typeSql) == "SELECT" && $run) {
                $result = $start->get_result();
                closeDB($start);
                return $result;
            }else {
                closeDB($start);
                return $run;
            }
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
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

    function closeDB($start) {
        $GLOBALS['conn']->close();
        $start->close();
    }

    function getTimestamp($seconds) {
        $dateTime = new DateTime();
        return $dateTime->getTimestamp()+$seconds;
    }

    function maHoa($duLieu) {
        $json = json_encode($duLieu);
        $encrypted = openssl_encrypt($json, 'aes-256-cbc', get_key(), 0, get_IV());
        return $encrypted;
    }

    function giaiMa($mahoa) {
        $json = openssl_decrypt($mahoa, 'aes-256-cbc', get_key(), 0, get_IV());
        return json_decode($json, true);
    }

    function getPageHere($url) {
        $tree = explode("/",$url);
        return $tree[count($tree)-1];
    }
?> 
