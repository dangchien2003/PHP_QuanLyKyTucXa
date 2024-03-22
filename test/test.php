<?php
echo __DIR__;
// set_include_path("E:\DH_CNDA\PHP\BTL\PHP_QuanLyKyTucXa");
echo get_include_path();

use PHPUnit\Framework\TestCase;


require_once ('project/src/handle/helper.php');
final class test extends TestCase
{


    function testGetKey()
    {
        $key = get_key();
        $this->assertEquals("key", $key);
    }

    function testktMaHoaVaGiaiMa()
    {
        $startValue = "acb";
        $maHoa = maHoa($startValue);
        $giaiMa = giaiMa($maHoa);
        $this->assertEquals($startValue, $giaiMa);
    }


}