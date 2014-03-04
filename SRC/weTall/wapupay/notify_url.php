<?php
 /**
  * 功能：异步通知页面
  * 版本：1.0
  * 日期：2012-10-11
  * 作者：中国银联UPMP团队
  * 版权：中国银联
  * 说明：以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己的需要，按照技术文档编写,并非一定要使用该代码。该代码仅供参考。
  * */

header('Content-Type:text/html;charset=utf-8');
require_once("lib/upmp_service.php");

if (UpmpService::verifySignature($_POST)){// 服务器签名验证成功
	//请在这里加上商户的业务逻辑程序代码
	//获取通知返回参数，可参考接口文档中通知参数列表(以下仅供参考)
	$transStatus = $_POST['transStatus'];// 交易状态
	if (""!=$transStatus && "00"==$transStatus){
		// 交易处理成功
	}else {
	}
	echo "success";
}else {// 服务器签名验证失败
	echo "fail";
}

?>