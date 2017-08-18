<?php

/***
 * 生成订单号
 */
if(!function_exists('createOrderNo')) {
    function createOrderNo()
    {
        list($tmp1, $tmp2) = explode(' ', microtime());
        $msec = sprintf('%.0f', (floatval($tmp1) + floatval($tmp2)) * 1000);
        return $msec;
    }
}
