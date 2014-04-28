<?php
/*-------------------------------------------------
|     index.php [ 微信公众平台接口 ]
+--------------------------------------------------
|     Author: LinYunpeng <QQ:50663950>
+------------------------------------------------*/
define("TOKEN", "weixin");
//$wechatObj = new wechat();
//$wechatObj->valid();
//$wechatObj->responseMsg();
class wechat {
	
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

	public function responseMsg() {

		//---------- 接 收 数 据 ---------- //

		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"]; //获取POST数据

		//用SimpleXML解析POST过来的XML数据
		$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

		$fromUsername = $postObj->FromUserName; //获取发送方帐号（OpenID）
		$toUsername = $postObj->ToUserName; //获取接收方账号
		$keyword = trim($postObj->Content); //获取消息内容
		$time = time(); //获取当前时间戳



		//---------- 返 回 数 据 ---------- //

		//返回消息模板
		$textTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[%s]]></MsgType>
		<Content><![CDATA[%s]]></Content>
		<FuncFlag>0</FuncFlag>
		</xml>";

		$msgType = "text"; //消息类型
	//	include('simsimi.php');
		//$contentStr = SimSimi($keyword).$fromUsername."|".$toUsername; //返回消息内容
		if($keyword=='Hello2BizUser')
		{
			 $contentStr=$keyword." 欢迎来到厦门!";
		}else{
			$contentStr=$keyword.'|'.$fromUsername."|".$toUsername;
		}
         
		//格式化消息模板
		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
		echo $resultStr; //输出结果
	}
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}
?>