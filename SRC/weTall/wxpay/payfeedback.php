<?php

/**
 * 订单反馈
 * @author www.linauror.com
 * @copyright 2014
 */
include 'config.php';
include 'lib.php';

$wechat = new Wechat;

$data = $wechat->getXmlArray(); // 具体参数可以查看文档
switch ($data['msgtype']) {
    case 'request' : // 新增投诉单，这里可以记录到数据库，以作相应处理
        print_r($data);
    break;
    case 'confirm' : // 买家确认反馈已经得到解决
        print_r($data);
    break;
    case 'reject' : // 买家拒绝问题已经完善解决，需要再次协商
        print_r($data);
    break;
}

?>
