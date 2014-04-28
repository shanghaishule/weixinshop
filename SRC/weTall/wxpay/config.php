<?php
header('Content-Type:text/html;charset=utf-8');
$wetallroute = dirname(dirname(__FILE__));
include $wetallroute."/data/config/db.php";
//var_dump($arr);exit;
$config = array();
$mysqli = new mysqli($arr["DB_HOST"], $arr["DB_USER"], $arr["DB_PWD"], $arr["DB_NAME"], $arr["DB_PORT"]);
$query = "SELECT appId,appSecret,paySignKey,partnerId,partnerKey,notify_url,success_url,fail_url,cancel_url FROM ".$arr["DB_PREFIX"]."wxpay LIMIT 1";	
if ($result = $mysqli->query($query)) {
	if ($row = $result->fetch_row()) {
		$config['appId'] = $row[0]; // 公众号身份标识
		$config['appSecret'] = $row[1]; // 权限获取所需密钥 Key
		$config['paySignKey'] = $row[2]; // 加密密钥 Key，也即appKey
		$config['partnerId'] = $row[3]; // 财付通商户身份标识
		$config['partnerKey'] = $row[4]; // 财付通商户权限密钥 Key
		$config['notifyUrl'] = $row[5]; // 微信支付完成服务器通知页面地址
		$config['successUrl'] = $row[6]; // 微信支付完成跳转到的页面，也可以在传递之前自定义
		$config['failUrl'] = $row[7];
		$config['cancelUrl'] = $row[8];
		
		//var_dump($config);exit;
	}
	$result->close();
}
$mysqli->close();




?>