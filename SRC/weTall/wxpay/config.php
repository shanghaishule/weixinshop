<?php
set_include_path('D:\websoft\web\phpwind\weTall'.PATH_SEPARATOR.get_include_path()); 
header('Content-Type:text/html;charset=utf-8');
require_once("data/config/db.php");
//var_dump($arr);exit;
$config = array();
$mysqli = new mysqli($arr["DB_HOST"], $arr["DB_USER"], $arr["DB_PWD"], $arr["DB_NAME"], $arr["DB_PORT"]);
$query = "SELECT * FROM ".$arr["DB_PREFIX"]."wxpay LIMIT 1";	
if ($result = $mysqli->query($query)) {
	if ($row = $result->fetch_row()) {
		$config['appId'] = $row['appId']; // 公众号身份标识
		$config['appSecret'] = $row['appSecret']; // 权限获取所需密钥 Key
		$config['paySignKey'] = $row['paySignKey']; // 加密密钥 Key，也即appKey
		$config['partnerId'] = $row['partnerId']; // 财付通商户身份标识
		$config['partnerKey'] = $row['partnerKey']; // 财付通商户权限密钥 Key
		$config['notifyUrl'] = $row['notify_url']; // 微信支付完成服务器通知页面地址
		$config['successUrl'] = $row['success_url']; // 微信支付完成跳转到的页面，也可以在传递之前自定义
		$config['failUrl'] = $row['fail_url'];
		$config['cancelUrl'] = $row['cancel_url'];
	}
	$result->close();
}
$mysqli->close();




?>