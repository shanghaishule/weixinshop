/*本脚本可以反复执行，重复执行*/

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


/*李帅的支付信息*/
insert into `tp_wxpay`(`tokenTall`, `wxname`, `appId`, `paySignKey`, `appSecret`, `partnerId`, `partnerKey`)
values('sgvctz1393762965','微指购','wx7b93af2548c04072','','0e7eef0922a587c8f0867e91a691bbcb','1218363601','1c280be45878451ba5cecf9d7f874d7d')

