<?php 
class Sms 
{
	var $sms_url;
	var $sms_account;
	var $sms_password;
	var $is_long;
	var $smstype;
	var $method;
	
	function sms($sms_url,$sms_account,$sms_password,$is_long = 0,$smstype = 0,$method = 'sendSMS'){
		$this->sms_url = $sms_url; 
		$this->sms_account = $sms_account; 
		$this->sms_password = base64_encode($sms_password);
		$this->is_long = $is_long;
		$this->smstype = $smstype;
		$this->method = $method;
	}
	function sendsms($phone,$content){
		$str = mb_convert_encoding($content, "GBK", "UTF-8");
		$sdata="method=".$this->method."&isLongSms=".$this->is_long."&username=".$this->sms_account."&password=".$this->sms_password."&smstype=".$this->smstype."&mobile=".$phone."&content=".$str;
		
		$header = "Content-type: text/xml";
		$ch = curl_init();
		@curl_setopt($ch, CURLOPT_URL, $this->sms_url);
		@curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		@curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		@curl_setopt($ch, CURLOPT_POST, 1);
		@curl_setopt($ch, CURLOPT_POSTFIELDS, $sdata);
		$response = curl_exec($ch);
		if(curl_errno($ch)){
			print curl_error($ch);
		}
		curl_close($ch);
		
		$arr = explode(';',$response);
		if($arr['0'] == 'success'){
			$txt = '发送成功';
		}else{
			$txt = '发送失败';
		}
		return $txt;
	}
}
?> 