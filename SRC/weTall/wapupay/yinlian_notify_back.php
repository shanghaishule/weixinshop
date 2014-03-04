<?php 
	set_include_path('D:\websoft\web\phpwind\weTall'.PATH_SEPARATOR.get_include_path()); 

	/*银联后台通知*/
	header('Content-Type:text/html;charset=utf-8');
	//print_r($_SERVER['DOCUMENT_ROOT']."/weTall/wapupay/lib/upmp_service.php");exit;
	require_once("lib/upmp_service.php");
	require_once("data/config/db.php");

	//var_dump($arr);exit;

	// 写入文件
	$filename = 'notify_back.txt';
	$fh = fopen($filename, "w");
	fwrite($fh, "异步通知报文：\r\n");
	//异步通知报文
	foreach ($_POST as $key => $value){
		fwrite($fh, $key."=".$value."&");
	}
	fwrite($fh, "\r\n");

	if (UpmpService::verifySignature($_POST)){// 服务器签名验证成功
		//请在这里加上商户的业务逻辑程序代码
		//获取通知返回参数，可参考接口文档中通知参数列表(以下仅供参考)
		$transStatus = $_POST['transStatus'];// 交易状态
		if (""!=$transStatus && "00"==$transStatus){
			// 交易处理成功
			$alldingdanhao=$_POST['orderNumber']; //取得支付号
			
			fwrite($fh, $alldingdanhao."\r\n");
			//$connection = mysqli_connect($arr["DB_HOST"], $arr["DB_USER"], $arr["DB_PWD"], $arr["DB_NAME"], $arr["DB_PORT"]);
			//$cursor = mysqli_query($connection, $Q);
			
			$mysqli = new mysqli($arr["DB_HOST"], $arr["DB_USER"], $arr["DB_PWD"], $arr["DB_NAME"], $arr["DB_PORT"]);
			$query = "SELECT * FROM ".$arr["DB_PREFIX"]."order_merge WHERE mergeid='".$alldingdanhao."'";
			fwrite($fh, $query."\r\n");
			if ($result = $mysqli->query($query)) {
			
				while ($row = $result->fetch_row()) {
					//printf ("%s (%s)\n", $row[0], $row[1]);
					fwrite($fh, implode('@@',$row)."\r\n");
					
					$query_item = "update ".$arr["DB_PREFIX"]."item_order set status=2, supportmetho=3, support_time=".time()." WHERE orderId='".$row[1]."' and status=1;";
					fwrite($fh, $query_item."\r\n");
					$mysqli->query($query_item);
				}
				
				$result->close();
			}
			$mysqli->close();

		}
		
	}else {// 服务器签名验证失败
		//echo "fail";
	}
	
	//关闭文件
	fclose($fh);
	

?>