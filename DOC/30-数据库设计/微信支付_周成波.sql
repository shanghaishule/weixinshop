/*本脚本可以反复执行，重复执行.
 * 
 * 1、微信支付：weTall-home-order-wxpay
 * 2、微信发货：weTall-admin-item_orderAction-orderWxDeliver
 * 3、订单查询：weTall-admin-item_orderAction-orderWxQuery
 * 4、告警通知：weTall-home-alarm（腾讯调起，我方接收）
 * 5、维权通知：weTall-home-rights（腾讯调起，我方接收）
 * 6、维权处理：weTall-admin-wxpay_rights
 * 7、告警查看：weTall-admin-wxpay_alarm
 * 
 * 网页授权
 * 收货地址共享
 * 客服系统：沟通
 * 
 * */



DROP TABLE IF EXISTS `tp_wxpay`;
CREATE TABLE `tp_wxpay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tokenTall` varchar(30) NOT NULL,
  `wxname` varchar(60) NOT NULL COMMENT '公众号名称',
  `appId` varchar(255) NOT NULL COMMENT '公众号身份的唯一标识',
  `paySignKey` varchar(255) NOT NULL COMMENT '公众号支付请求中用于加密的密钥Key',
  `appSecret` varchar(255) NOT NULL COMMENT '',
  `partnerId` varchar(255) NOT NULL COMMENT '财付通商户身份的标识',
  `partnerKey` varchar(255) NOT NULL COMMENT '财付通商户权限密钥Key',
  `notify_url` varchar(255) NOT NULL COMMENT '后台通知url',
  `success_url` varchar(255) NOT NULL COMMENT '前台通知url_成功支付',
  `fail_url` varchar(255) NOT NULL COMMENT '前台通知url_失败支付',
  `cancel_url` varchar(255) NOT NULL COMMENT '前台通知url_取消支付',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


/*支付信息*/
insert into `tp_wxpay`(`tokenTall`, `wxname`, `appId`, `paySignKey`, `appSecret`, `partnerId`, `partnerKey`, `notify_url`, `success_url`, `fail_url`, `cancel_url`)
values('sgvctz1393762965','微指购','wx7b93af2548c04072','6uSTZuiOV4r5qKfZFXxvDVldIwIjnsUvyqkrbJ2S09jFCeZ3nk05tpMBDXixe0XJu4KxACblXELDoIYj6i4Y1Eg8b3RdLeZGAhWOUnHdEAgf8tbTbviCgZv2Y49R6bca','0e7eef0922a587c8f0867e91a691bbcb','1218363601','1c280be45878451ba5cecf9d7f874d7d','http://www.vzhigo.com/weTall/wxpay/notify_url.php','','','');

/*微信支付历史记录*/
DROP TABLE IF EXISTS `tp_wxpay_history`;
CREATE TABLE `tp_wxpay_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sign_type` varchar(255) NULL COMMENT '签名类型',
  `service_version` varchar(255) NULL COMMENT '版本号',
  `input_charset` varchar(255) NULL COMMENT '字符编码',
  `sign` varchar(255) NULL COMMENT '签名',
  `sign_key_index` int(11) NULL COMMENT '多密钥支持的密钥序号',
  `trade_mode` int(11) NULL COMMENT '交易模式：1-即时到账',
  `trade_state` int(11) NULL COMMENT '支付结果：0—成功',
  `pay_info` varchar(255) NULL COMMENT '支付结果信息，支付成功时为空',
  `partner` varchar(255) NULL COMMENT '商户号',
  `bank_type` varchar(255) NULL COMMENT '银行类型，在微信中使用WX',
  `bank_billno` varchar(255) NULL COMMENT '银行订单号',
  `total_fee` int(11) NULL COMMENT '支付金额，单位为分',
  `fee_type` int(11) NULL COMMENT '币种,1-人民币',
  `notify_id` varchar(255) NULL COMMENT '支付结果通知id',
  `transaction_id` varchar(255) NULL COMMENT '交易号',
  `out_trade_no` varchar(255) NULL COMMENT '商户系统的订单号',
  `attach` varchar(255) NULL COMMENT '商户数据包',
  `time_end` varchar(255) NULL COMMENT '支付完成时间',
  `transport_fee` int(11) NULL COMMENT '物流费用，单位分',
  `product_fee` int(11) NULL COMMENT '物品费用，单位分',
  `discount` int(11) NULL COMMENT '折扣价格，单位分',
  `buyer_alias` varchar(255) NULL COMMENT '买家别名',
  `openid` varchar(255) NULL COMMENT '购买用户',
  `appid` varchar(255) NULL COMMENT '',
  `issubscribe` varchar(255) NULL COMMENT '是否关注',
  `timestamp` varchar(255) NULL COMMENT '时间戳',
  `noncestr` varchar(255) NULL COMMENT '随机串',
  `appsignature` varchar(255) NULL COMMENT '',
  `signmethod` varchar(255) NULL COMMENT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*告警信息*/
DROP TABLE IF EXISTS `tp_wxpay_alarm`;
CREATE TABLE `tp_wxpay_alarm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` varchar(255) NULL COMMENT '公众号身份的唯一标识',
  `errortype` varchar(255) NULL COMMENT '错误类型',
  `description` varchar(255) NULL COMMENT '错误描述',
  `alarmcontent` varchar(255) NULL COMMENT '错误详情',
  `timestamp` varchar(255) NULL COMMENT '时间戳',
  `appsignature` varchar(255) NULL COMMENT '',
  `signmethod` varchar(255) NULL COMMENT '',
  `status` int NOT NULL DEFAULT 0 COMMENT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*维权信息*/
DROP TABLE IF EXISTS `tp_wxpay_rights`;
CREATE TABLE `tp_wxpay_rights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) NULL COMMENT '购买用户',
  `appid` varchar(255) NULL COMMENT '公众号身份的唯一标识',
  `timestamp` varchar(255) NULL COMMENT '时间戳',
  `msgtype` varchar(255) NULL COMMENT '消息类型',
  `feedbackid` varchar(255) NULL COMMENT '投诉单号',
  `transid` varchar(255) NULL COMMENT '交易号',
  `reason` varchar(255) NULL COMMENT '投诉原因',
  `solution` varchar(255) NULL COMMENT '解决方法',
  `extinfo` varchar(255) NULL COMMENT '备注',
  `appsignature` varchar(255) NULL COMMENT '',
  `signmethod` varchar(255) NULL COMMENT '',
  `picurl` text NULL COMMENT '',
  `status` int NOT NULL DEFAULT 0 COMMENT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*增加投诉管理菜单*/
delete from tp_menu where `name` = '投诉管理';
insert into tp_menu(`name`,pid,module_name,action_name,`data`,remark,often,ordid,display)
values('投诉管理','148','wxpay_rights','index','','',99,255,1);
/*增加告警管理菜单*/
delete from tp_menu where `name` = '告警管理';
insert into tp_menu(`name`,pid,module_name,action_name,`data`,remark,often,ordid,display)
values('告警管理','148','wxpay_alarm','index','','',99,255,1);
