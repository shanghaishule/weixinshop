/*本脚本可以反复执行，重复执行*/

use bestchoi_shule;
/*商品表，加tokenTall*/
alter table tp_item add `tokenTall` varchar(20) NOT NULL DEFAULT '';
/*广告，加tokenTall*/
alter table tp_ad add `tokenTall` varchar(20) NOT NULL DEFAULT '';
/*订单表，加tokenTall*/
alter table tp_item_order add `tokenTall` varchar(20) NOT NULL DEFAULT '';
/*终端用户表，加email*/
alter table tp_user add `email` varchar(90) NOT NULL DEFAULT '';
/*快递表，加tokenTall*/
alter table tp_delivery add `tokenTall` varchar(20) NOT NULL DEFAULT '';
/*发货地址表，加tokenTall*/
alter table tp_address add `tokenTall` varchar(20) NOT NULL DEFAULT '';
/*平台广告表，加tokenTall*/
alter table tp_adforhome add `tokenTall` varchar(20) NOT NULL DEFAULT '';


/*增加结账方式*/
delete from tp_menu where `name` = '结账方式管理';
insert into tp_menu(`name`,pid,module_name,action_name,`data`,remark,often)
values('结账方式管理',0,'account','setting','','',3);
/*菜单重置*/
update tp_menu set often = -1;
/*商品管理、商品分类、添加商品、品牌管理*/
update tp_menu set often = 0 where id in(52,56,249,291);
/*订单管理、快递方式管理、发货地址管理*/
update tp_menu set often = 1 where id in(296,297,298);
/*广告管理*/
update tp_menu set often = 2 where id in(12);
/*结账方式管理*/
update tp_menu set often = 3 where `name` = '结账方式管理';
/*设置*/
update tp_menu set often = 99 where id in(275);

/*结账方式管理表*/
drop table IF EXISTS `tp_account_setting`;
CREATE TABLE IF NOT EXISTS `tp_account_setting` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `bankname` varchar(200) NOT NULL COMMENT '银行名称',
  `account` varchar(100) NOT NULL COMMENT '银行账号',
  `payee` varchar(255) NOT NULL COMMENT '收款人',
  `mobile` varchar(255) DEFAULT NULL COMMENT '手机号码',
  `tokenTall` varchar(20) NOT NULL DEFAULT '' COMMENT '商家token',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*账单汇总表*/
drop table IF EXISTS `tp_account_bill_mst`;
CREATE TABLE IF NOT EXISTS `tp_account_bill_mst` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `billnum` varchar(50) NOT NULL COMMENT '账单单号',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `gen` varchar(50) NOT NULL DEFAULT '' COMMENT '生成人',
  `gen_time` int(10) NOT NULL DEFAULT '0' COMMENT '生成时间',
  `start_time` int(10) NOT NULL DEFAULT '0' COMMENT '账单开始时间',
  `end_time` int(10) NOT NULL DEFAULT '0' COMMENT '账单结束时间',
  `totalamt` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '账单总金额',
  `rate` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '扣率',
  `yingjie` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '应结金额',
  `tokenTall` varchar(20) NOT NULL DEFAULT '' COMMENT '商家token',
  `duizhang` varchar(50) NULL COMMENT '商城对账人',
  `duizhang_time` int(10) NULL COMMENT '商城对账时间',
  `duizhang2` varchar(50) NULL COMMENT '商家对账人',
  `duizhang2_time` int(10) NULL COMMENT '商家对账时间',
  `pay` varchar(50) NULL COMMENT '付款人',
  `pay_time` int(10) NULL COMMENT '付款时间',
  PRIMARY KEY (`id`), UNIQUE (`billnum`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

/*账单明细表*/
drop table IF EXISTS `tp_account_bill_dtl`;
CREATE TABLE IF NOT EXISTS `tp_account_bill_dtl` (
  `billnum` varchar(50) NOT NULL COMMENT '账单单号',
  `itemno` int NOT NULL COMMENT '序号',
  `orderId` varchar(50) NOT NULL COMMENT '订单号',
  `goods_sumPrice` decimal(10,2) NOT NULL COMMENT '商品总额',
  `order_sumPrice` decimal(10,2) NOT NULL COMMENT '订单总额',
  PRIMARY KEY (`billnum`,`itemno`), UNIQUE (`billnum`,`orderId`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*增加账单管理*/
delete from tp_menu where `name` = '账单管理';
insert into tp_menu(`name`,pid,module_name,action_name,`data`,remark,often)
values('账单管理',0,'account','index','','',3);

/*订单商品明细表，加大小和颜色*/
alter table tp_order_detail add `size` varchar(255) NOT NULL DEFAULT '';
alter table tp_order_detail add `color` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '';

/*总商城增加留言管理*/
/*插入节点表*/
delete from tp_node where `name` = 'Suggestion';
insert into tp_node(`name`,title,`status`,remark,pid,`level`,sort,display)
values('Suggestion','留言和建议',1,0,84,2,0,2);
/*给admin组加权限*/
delete a from tp_access a , tp_node b where a.node_id = b.id and b.title = '留言和建议';
INSERT into tp_access(role_id, node_id, pid, `level`)
select 5,id,pid,`level` from tp_node where title = '留言和建议';

/*总商城增加申请开店管理*/
/*插入节点表*/
delete from tp_node where `name` = 'Application';
insert into tp_node(`name`,title,`status`,remark,pid,`level`,sort,display)
values('Application','申请开店信息',1,0,84,2,0,2);
/*给admin组加权限*/
delete a from tp_access a , tp_node b where a.node_id = b.id and b.title = '申请开店信息';
INSERT into tp_access(role_id, node_id, pid, `level`)
select 5,id,pid,`level` from tp_node where title = '申请开店信息';

/*开店申请表*/
DROP TABLE IF EXISTS `tp_application`;
CREATE TABLE `tp_application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(10) DEFAULT NULL COMMENT '用户id',
  `uname` varchar(30) DEFAULT NULL COMMENT '用户名',
  `umail` varchar(30) DEFAULT NULL COMMENT '用户邮箱',
  `applicant` varchar(30) DEFAULT NULL COMMENT '申请人',
  `addr` varchar(255) DEFAULT NULL COMMENT '地址',
  `phone` varchar(50) DEFAULT NULL COMMENT '电话',
  `licence` varchar(255) DEFAULT NULL COMMENT '营业执照',
  `shopname` varchar(255) DEFAULT NULL COMMENT '店铺名称',
  `trueshop` SMALLINT(1) DEFAULT 0 COMMENT '是否有实体店',
  `text` varchar(500) DEFAULT NULL COMMENT '其他说明',
  `createtime` int(20) DEFAULT NULL COMMENT '申请时间',
  `uptatetime` int(20) DEFAULT NULL,
  `tokenTall` varchar(30) NOT NULL,
  `re` varchar(500) DEFAULT NULL,
  `wecha_id` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*店铺收藏表*/
DROP TABLE IF EXISTS `tp_shop_favi`;
CREATE TABLE `tp_shop_favi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL COMMENT '用户id',
  `tokenTall` varchar(30) DEFAULT NULL COMMENT '店铺token',
  PRIMARY KEY (`id`), UNIQUE (`userid`,`tokenTall`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


/*总商城增加会员管理*/
/*插入节点表*/
delete from tp_node where `name` = 'Member';
insert into tp_node(`name`,title,`status`,remark,pid,`level`,sort,display)
values('Member','会员管理',1,0,84,2,0,2);
/*给admin组加权限*/
delete a from tp_access a , tp_node b where a.node_id = b.id and b.title = '会员管理';
INSERT into tp_access(role_id, node_id, pid, `level`)
select 5,id,pid,`level` from tp_node where title = '会员管理';

/*改变*/
ALTER TABLE `tp_diymen_class` CHANGE `url` `url` varchar(180) NOT NULL DEFAULT '' COMMENT 'url地址';
