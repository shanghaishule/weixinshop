<?php

/**
 * 发货通知
 * @author www.linauror.com
 * @copyright 2014
 */
include 'config.php';
include 'lib.php';

$wechat = new Wechat;

$parameter = array(
    'appid' => $config['appId'],
    'openid' => 'oX99MDgNcgwnz3zFN3DNmo8uwa-w', // 购买用户的 OpenId，这个已经放在最终支付结果通知的 PostData 里了
    'transid' => '111112222233333', // 交易单号
    'out_trade_no' => '555666uuu', // 本站订单号
    'deliver_timestamp' => mktime(), // 发货时间戳，这里指得是 linux 时间戳
    'deliver_status' => '1', // 发货状态，1 表明成功，0 表明失败，失败时需要在 deliver_msg 填上失败原因
    'deliver_msg' => 'ok' // 是发货状态信息，失败时可以填上 UTF8 编码的错误提示信息，比如“该商品已退款”
);
$result = $wechat->delivernotify($config, $parameter); 
if ($result['errcode']) { // 判断结果
    echo 'success';
} else {
    print_r($result);
}

?>
