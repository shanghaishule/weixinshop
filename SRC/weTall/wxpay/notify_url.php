<?php

/**
 * 服务器异步通知
 * @author www.linauror.com
 * @copyright 2014
 */
include 'config.php';
include 'lib.php';

// 写入文件
$filename = 'config.txt';
$fh = fopen($filename, "w");
fwrite($fh, "配置：\r\n");
foreach ($config as $key => $value){
	fwrite($fh, $key."=".$value."&");
}
fwrite($fh, "\r\n\r\n");
//关闭文件
fclose($fh);


$wechat = new Wechat;
$array = $_GET; // 官方文档所说的post是接收不到参数的，实际上要用get才行


// 写入文件
$filename = 'notify_back_before.txt';
$fh = fopen($filename, "w");
fwrite($fh, "异步通知：\r\n");
foreach ($array as $key => $value){
	fwrite($fh, $key."=".$value."&");
}
fwrite($fh, "\r\n\r\n");
//关闭文件
fclose($fh);


//$verifyNotify = $wechat->verifyNotify($array, $config); // 验证通知
//if ($verifyNotify) {
if ($array['trade_state'] == 0) {  //成功支付
    $array += $wechat->getXmlArray(); // 再获取xml数据
    // 结果已经获取到了 下面可以更新数据库支付状态等操作了 也可以使用订单查询接口来查询是否支付成功

    // 写入文件
    $filename = 'notify_back_after.txt';
    $fh = fopen($filename, "w");
    fwrite($fh, "异步通知：\r\n");
    foreach ($array as $key => $value){
    	fwrite($fh, $key."=".$value."&");
    }
    fwrite($fh, "\r\n\r\n");
    //关闭文件
    fclose($fh);
    
    $mysqli = new mysqli($arr["DB_HOST"], $arr["DB_USER"], $arr["DB_PWD"], $arr["DB_NAME"], $arr["DB_PORT"]);
    //记录支付日志
    $query = "insert into ".$arr["DB_PREFIX"]."wxpay_history(`sign_type`,`service_version`,`input_charset`,"
     		."`sign`,`sign_key_index`,`trade_mode`,`trade_state`,`pay_info`,`partner`,`bank_type`,`bank_billno`,"
     		."`total_fee`,`fee_type`,`notify_id`,`transaction_id`,`out_trade_no`,`attach`,`time_end`,`transport_fee`,"
     		."`product_fee`,`discount`,`buyer_alias`,`openid`,`appid`,`issubscribe`,`timestamp`,`noncestr`,`appsignature`,`signmethod`)"
    		." values ( '".$array['sign_type']."', '".$array['service_version']."', '".$array['input_charset']."', '"
    		.$array['sign']."', '".$array['sign_key_index']."', '".$array['trade_mode']."', '"
    		.$array['trade_state']."', '".$array['pay_info']."', '".$array['partner']."', '".$array['bank_type']."', '"
    		.$array['bank_billno']."', '".$array['total_fee']."', '".$array['fee_type']."', '"
    		.$array['notify_id']."', '".$array['transaction_id']."', '".$array['out_trade_no']."', '"
    		.$array['attach']."', '".$array['time_end']."', '".$array['transport_fee']."', '"
    		.$array['product_fee']."', '".$array['discount']."', '".$array['buyer_alias']."', '"
    		.$array['openid']."', '".$array['appid']."', '".$array['issubscribe']."', '"
    		.$array['timestamp']."', '".$array['noncestr']."', '".$array['appsignature']."', '".$array['signmethod']."')";
    $mysqli->query($query);

    // 交易处理成功
    $alldingdanhao=$array['out_trade_no']; //取得支付号
    $query = "SELECT * FROM ".$arr["DB_PREFIX"]."order_merge WHERE mergeid='".$alldingdanhao."'";
    if ($result = $mysqli->query($query)) {
	    while ($row = $result->fetch_row()) {
	    	$query_item = "update ".$arr["DB_PREFIX"]."item_order set status=2, supportmetho=4, support_time=".time()." WHERE orderId='".$row[1]."' and status=1;";
	    	$mysqli->query($query_item);
	    }
    	$result->close();

    }
    $mysqli->close();

    //向微信回复成功。如果不回复，微信将在30分钟内重复通知8次
    echo "success";
}


?>
