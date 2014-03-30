<?php 
	set_include_path('D:\websoft\web\phpwind\weTall'.PATH_SEPARATOR.get_include_path()); 

	/*银联后台通知*/
	header('Content-Type:text/html;charset=utf-8');
	require_once("data/config/db.php");
	//var_dump($arr);exit;

	// 写入文件
	$filename = 'notify_back.txt';
	$fh = fopen($filename, "w");
	fwrite($fh, "异步通知：\r\n");
	foreach ($_POST as $key => $value){
		fwrite($fh, $key."=".$value."&");
	}
	fwrite($fh, "\r\n\r\n");

	if ($_POST['trade_state'] == 0){// 成功
		
			// 交易处理成功
			$alldingdanhao=$_POST['out_trade_no']; //取得支付号
			
			fwrite($fh, $alldingdanhao."\r\n");

			$mysqli = new mysqli($arr["DB_HOST"], $arr["DB_USER"], $arr["DB_PWD"], $arr["DB_NAME"], $arr["DB_PORT"]);
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
	
	//关闭文件
	fclose($fh);
	

?>