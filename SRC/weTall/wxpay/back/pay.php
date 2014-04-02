<?php

/** 
 * 微信支付
 * @author www.linauror.com
 * @copyright 2014
 */
include 'config.php';
include 'lib.php';

$wechat = new Wechat;
$timestamp = microtime(true);
if (strpos($timestamp, '.')) {
    $timestamp = substr($timestamp * 1000, 0, -2);
}

$parameter = array(
    'appid' => $config['appId'],
    'timestamp' => $timestamp, // 13位时间戳
    'noncestr' => uniqid(), // 随机字符串
	'body' => '测试微信支付商品', // 商品描述
	'out_trade_no' => date('YmdHis') . uniqid(), // 本站订单号
	'notify_url' => $config['notifyUrl'], // 微信支付成功服务器通知，可自定义
	'spbill_create_ip' => $_SERVER['REMOTE_ADDR'], // 微信用户IP
	'total_fee' => 100, // 支付金额 单位：分
);
$parameter += $wechat->bulidForm($parameter, $config);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>微信支付测试</title>
</head>

<body>
<form>
<p>商品名称：<?=$parameter['body']?></p>
<p>订单号：<?=$parameter['out_trade_no']?></p>
<input type="submit" value="微信安全支付" id="getBrandWCPayRequest" />
</form>
<script type="text/javascript">
// 当微信内置浏览器完成内部初始化后会触发WeixinJSBridgeReady事件。
// 其实中间部分可以写成一个事件，点击某个按钮触发
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
     WeixinJSBridge.invoke('getBrandWCPayRequest',{
                           "appId" : '<?=$config['appId']?>', //公众号名称，由商户传入
                           "timeStamp" : '<?=$parameter['timestamp']?>', //时间戳
                           "nonceStr" : '<?=$parameter['noncestr']?>', //随机串
                           "package" : '<?=$parameter['package']?>',//扩展包
                           "signType" : 'SHA1', //微信签名方式:1.sha1
                           "paySign" : '<?=$parameter['paysign']?>' //微信签名
     },function(res){
        if(res.err_msg == "get_brand_wcpay_request:ok" ) {
            window.location.href = '<?=$config['successUrl']?>';               
        } else {
            // 这里是取消支付或者其他意外情况，可以弹出错误信息或做其他操作
            alert(res.err_msg);
        }
     }); 
}, false)
</script>
<!-- 下面为必须js文件 -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="http://res.mail.qq.com/mmr/static/lib/js/lazyloadv3.js"></script>
</body>
</html>
