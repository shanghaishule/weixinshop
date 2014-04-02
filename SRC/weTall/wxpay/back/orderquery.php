<?php

/**
 * 订单查询
 * @author www.linauror.com
 * @copyright 2014
 */
include 'config.php';
include 'lib.php';

$wechat = new Wechat;

$result = $wechat->orderquery($config, $out_trade_no);  // 这里仅需要本站订单号
print_r($result)
?>
