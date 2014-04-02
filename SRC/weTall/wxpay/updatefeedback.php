<?php

/**
 * 标记客户的投诉处理状态
 * @author www.linauror.com
 * @copyright 2014
 */
include 'config.php';
include 'lib.php';

$wechat = new Wechat;

$data = $wechat->getXmlArray(); // 具体参数可以查看文档
// openid 与 feedback参数都可以从数据库中得到
$result = file_get_contents('http://api.weixin.qq.com/cgi-bin/pay/delivernotify?access_token=' . $wechat->getAccessToken() . '&openid=' . $openid . '&feedbackid=' . $feedbackid);
$result = json_decode($result, true);
if ($result['errcode'] == 0) {
    echo 'success';
} else {
    print_r($result);
}
?>
