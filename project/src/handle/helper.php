<?php
    include '../config/configdb.php';
    function select_no_input ($sql){
        $start = $GLOBALS["conn"]->prepare($sql);
        $start->execute();
        $result = $start->get_result();
        return $result;
    }
?> 