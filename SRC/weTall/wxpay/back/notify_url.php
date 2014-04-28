<?php 
	set_include_path('D:\websoft\web\phpwind\weTall'.PATH_SEPARATOR.get_include_path()); 

	/*后台通知*/
	header('Content-Type:text/html;charset=utf-8');
	require_once("data/config/db.php");
	//var_dump($arr);exit;
	$mysqli = new mysqli($arr["DB_HOST"], $arr["DB_USER"], $arr["DB_PWD"], $arr["DB_NAME"], $arr["DB_PORT"]);

	// 写入文件
	$filename = 'notify_back.txt';
	$fh = fopen($filename, "w");
	fwrite($fh, "异步通知：\r\n");
	foreach ($_POST as $key => $value){
		fwrite($fh, $key."=".$value."&");
	}
	fwrite($fh, "\r\n\r\n");

	//记录支付日志
	/*
	$query = "insert into ".$arr["DB_PREFIX"]."wxpay_history(`sign_type`,`service_version`,`input_charset`,
			`sign`,`sign_key_index`,`trade_mode`,`trade_state`,`pay_info`,`partner`,`bank_type`,`bank_billno`,
			`total_fee`,`fee_type`,`notify_id`,`transaction_id`,`out_trade_no`,`attach`,`time_end`,`transport_fee`,
			`product_fee`,`discount`,`buyer_alias`) 
			values ( '".$_POST['sign_type']."', '".$_POST['service_version']."', '".$_POST['input_charset']
			."', '".$_POST['sign']."', '".$_POST['sign_key_index']."', '".$_POST['trade_mode']."', '"
			.$_POST['trade_state']."', '".$_POST['pay_info']."', '".$_POST['partner']."', '".$_POST['bank_type']
			."', '".$_POST['bank_billno']."', '".$_POST['total_fee']."', '".$_POST['fee_type']."', '"
			.$_POST['notify_id']."', '".$_POST['transaction_id']."', '".$_POST['out_trade_no']."', '"
			.$_POST['attach']."', '".$_POST['time_end']."', '".$_POST['transport_fee']."', '"
			.$_POST['product_fee']."', '".$_POST['discount']."', '".$_POST['buyer_alias']."')";
	
	fwrite($fh, $query."\r\n");
	$mysqli->query($query_item);
	
	
	
	if ($_POST['trade_state'] == 0){// 成功
		
			// 交易处理成功
			$alldingdanhao=$_POST['out_trade_no']; //取得支付号
			
			fwrite($fh, $alldingdanhao."\r\n");

			
			$query = "SELECT * FROM ".$arr["DB_PREFIX"]."order_merge WHERE mergeid='".$alldingdanhao."'";
			
			fwrite($fh, $query."\r\n");
			
			if ($result = $mysqli->query($query)) {
				while ($row = $result->fetch_row()) {
					
					fwrite($fh, implode('@@',$row)."\r\n");
					
					$query_item = "update ".$arr["DB_PREFIX"]."item_order set status=2, supportmetho=4, support_time=".time()." WHERE orderId='".$row[1]."' and status=1;";
					
					fwrite($fh, $query_item."\r\n");
					
					$mysqli->query($query_item);
				}
				
				$result->close();
			}
			$mysqli->close();
		
	}else {
		//echo "fail";
	}
	*/
	//关闭文件
	fclose($fh);
	

?>