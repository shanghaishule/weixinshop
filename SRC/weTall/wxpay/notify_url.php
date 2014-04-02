<?php

/**
 * 服务器异步通知
 * @author www.linauror.com
 * @copyright 2014
 */
include 'config.php';
include 'lib.php';

$wechat = new Wechat;
$array = $_GET; // 官方文档所说的post是接收不到参数的，实际上要用get才行

// 写入文件
$filename = 'notify_back.txt';
$fh = fopen($filename, "w");
fwrite($fh, "异步通知：\r\n");
foreach ($array as $key => $value){
	fwrite($fh, $key."=".$value."&");
}
fwrite($fh, "\r\n\r\n");
//关闭文件
fclose($fh);


$verifyNotify = $wechat->verifyNotify($array, $config); // 验证通知
if ($verifyNotify) {
    $array += $wechat->getXmlArray(); // 再获取xml数据
    // 结果已经获取到了 下面可以更新数据库支付状态等操作了 也可以使用订单查询接口来查询是否支付成功


}


?>
