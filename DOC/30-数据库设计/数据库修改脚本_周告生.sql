/*本脚本可以反复执行，重复执行*/
ALTERTABLE`tp_ad`ADD`tokenTall` VARCHAR( 20)NULLAFTER`checkstatus` ;

--
-- 表的结构 `tp_access`
--
DROP table IF EXISTS tp_access;
CREATE TABLE IF NOT EXISTS `tp_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`role_id`,`node_id`),
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_access`
--

INSERT INTO `tp_access` (`role_id`, `node_id`, `pid`, `level`, `module`) VALUES
(10, 90, 84, 2, NULL),
(10, 89, 84, 2, NULL),
(10, 88, 84, 2, NULL),
(9, 47, 46, 3, NULL),
(9, 46, 45, 2, NULL),
(9, 45, 1, 0, NULL),
(9, 1, 0, 1, NULL),
(6, 90, 84, 2, NULL),
(6, 89, 84, 2, NULL),
(6, 88, 84, 2, NULL),
(6, 86, 84, 2, NULL),
(6, 87, 84, 2, NULL),
(6, 84, 1, 0, NULL),
(6, 47, 46, 3, NULL),
(6, 46, 45, 2, NULL),
(6, 45, 1, 0, NULL),
(6, 1, 0, 1, NULL),
(5, 90, 84, 2, NULL),
(5, 89, 84, 2, NULL),
(5, 88, 84, 2, NULL),
(5, 86, 84, 2, NULL),
(5, 87, 84, 2, NULL),
(5, 84, 1, 0, NULL),
(5, 47, 46, 3, NULL),
(5, 46, 45, 2, NULL),
(5, 45, 1, 0, NULL),
(5, 81, 80, 2, NULL),
(5, 80, 1, 1, NULL),
(5, 37, 35, 3, NULL),
(5, 36, 35, 3, NULL),
(5, 35, 1, 0, NULL),
(5, 63, 60, 3, NULL),
(5, 62, 60, 3, NULL),
(5, 61, 60, 3, NULL),
(5, 60, 5, 2, NULL),
(5, 59, 57, 3, NULL),
(5, 58, 57, 3, NULL),
(5, 57, 5, 2, NULL),
(5, 42, 38, 3, NULL),
(5, 41, 38, 3, NULL),
(5, 40, 38, 3, NULL),
(5, 39, 38, 3, NULL),
(5, 38, 5, 2, NULL),
(5, 5, 1, 0, NULL),
(5, 56, 50, 3, NULL),
(5, 55, 50, 3, NULL),
(5, 54, 50, 3, NULL),
(5, 53, 50, 3, NULL),
(5, 52, 50, 3, NULL),
(5, 51, 50, 3, NULL),
(5, 50, 3, 2, NULL),
(5, 49, 48, 3, NULL),
(5, 48, 3, 2, NULL),
(5, 31, 25, 3, NULL),
(5, 30, 25, 3, NULL),
(5, 29, 25, 3, NULL),
(5, 28, 25, 3, NULL),
(5, 27, 25, 3, NULL),
(5, 26, 25, 3, NULL),
(5, 25, 3, 2, NULL),
(5, 24, 18, 3, NULL),
(5, 23, 18, 3, NULL),
(5, 22, 18, 3, NULL),
(5, 21, 18, 3, NULL),
(5, 20, 18, 3, NULL),
(5, 19, 18, 3, NULL),
(5, 18, 3, 2, NULL),
(5, 3, 1, 0, NULL),
(5, 17, 11, 3, NULL),
(5, 16, 11, 3, NULL),
(5, 15, 11, 3, NULL),
(5, 14, 11, 3, NULL),
(5, 13, 11, 3, NULL),
(5, 12, 11, 3, NULL),
(5, 11, 2, 2, NULL),
(5, 83, 6, 3, NULL),
(5, 32, 6, 3, NULL),
(5, 10, 6, 3, NULL),
(5, 9, 6, 3, NULL),
(5, 8, 6, 3, NULL),
(5, 7, 6, 3, NULL),
(5, 6, 2, 2, NULL),
(5, 2, 1, 0, NULL),
(5, 79, 73, 3, NULL),
(5, 78, 73, 3, NULL),
(5, 77, 73, 3, NULL),
(5, 76, 73, 3, NULL),
(5, 75, 73, 3, NULL),
(5, 74, 73, 3, NULL),
(5, 73, 4, 2, NULL),
(5, 72, 66, 3, NULL),
(5, 71, 66, 3, NULL),
(5, 70, 66, 3, NULL),
(5, 69, 66, 3, NULL),
(5, 68, 66, 3, NULL),
(5, 67, 66, 3, NULL),
(5, 66, 4, 2, NULL),
(5, 65, 64, 3, NULL),
(5, 64, 4, 2, NULL),
(5, 4, 1, 0, NULL),
(5, 1, 0, 1, NULL),
(10, 86, 84, 2, NULL),
(10, 87, 84, 2, NULL),
(10, 84, 1, 0, NULL),
(10, 47, 46, 3, NULL),
(10, 46, 45, 2, NULL),
(10, 45, 1, 0, NULL),
(10, 81, 80, 2, NULL),
(10, 80, 1, 1, NULL),
(10, 37, 35, 3, NULL),
(10, 36, 35, 3, NULL),
(10, 63, 60, 3, NULL),
(10, 62, 60, 3, NULL),
(10, 61, 60, 3, NULL),
(10, 60, 5, 2, NULL),
(10, 59, 57, 3, NULL),
(10, 58, 57, 3, NULL),
(10, 57, 5, 2, NULL),
(10, 42, 38, 3, NULL),
(10, 41, 38, 3, NULL),
(10, 40, 38, 3, NULL),
(10, 39, 38, 3, NULL),
(10, 38, 5, 2, NULL),
(10, 5, 1, 0, NULL),
(10, 56, 50, 3, NULL),
(10, 55, 50, 3, NULL),
(10, 54, 50, 3, NULL),
(10, 53, 50, 3, NULL),
(10, 52, 50, 3, NULL),
(10, 51, 50, 3, NULL),
(10, 50, 3, 2, NULL),
(10, 49, 48, 3, NULL),
(10, 48, 3, 2, NULL),
(10, 24, 18, 3, NULL),
(10, 23, 18, 3, NULL),
(10, 22, 18, 3, NULL),
(10, 21, 18, 3, NULL),
(10, 20, 18, 3, NULL),
(10, 19, 18, 3, NULL),
(10, 18, 3, 2, NULL),
(10, 3, 1, 0, NULL),
(10, 79, 73, 3, NULL),
(10, 78, 73, 3, NULL),
(10, 77, 73, 3, NULL),
(10, 76, 73, 3, NULL),
(10, 75, 73, 3, NULL),
(10, 74, 73, 3, NULL),
(10, 73, 4, 2, NULL),
(10, 72, 66, 3, NULL),
(10, 71, 66, 3, NULL),
(10, 70, 66, 3, NULL),
(10, 69, 66, 3, NULL),
(10, 68, 66, 3, NULL),
(10, 67, 66, 3, NULL),
(10, 66, 4, 2, NULL),
(10, 65, 64, 3, NULL),
(10, 64, 4, 2, NULL),
(10, 4, 1, 0, NULL),
(10, 1, 0, 1, NULL);


drop TABLE IF EXISTS `tp_adforhome`;
CREATE TABLE IF NOT EXISTS `tp_adforhome` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `board_id` smallint(5) NOT NULL,
  `type` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `extimg` varchar(255) NOT NULL,
  `extval` varchar(200) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `start_time` int(10) NOT NULL,
  `end_time` int(10) NOT NULL,
  `clicks` int(10) NOT NULL DEFAULT '0',
  `add_time` int(10) NOT NULL DEFAULT '0',
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `checkstatus` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-未审核 1-审核通过 2-等待',
  `boadid` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0--未投入 1-首页头部 2-首页中部 3-首页中下部位',
  `adid` int(11) NOT NULL DEFAULT '0' COMMENT '对应商家广告id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- 转存表中的数据 `tp_adforhome`
--

INSERT INTO `tp_adforhome` (`id`, `board_id`, `type`, `name`, `url`, `content`, `extimg`, `extval`, `desc`, `start_time`, `end_time`, `clicks`, `add_time`, `ordid`, `status`, `checkstatus`, `boadid`, `adid`) VALUES
(37, 1, 'image', '小店来推广', 'http://localhost:8081/weTall/index.php', '1401/22/52df8061b2e7b.jpg', '', '嘎达', '发', 1388592000, 1399564800, 0, 0, 255, 1, 0, 1, 30),
(36, 1, 'image', '广告4', 'http://bestchoice88.com/weTall/index.php?m=index&a=index', '1401/15/52d6393f29c15.jpg', '', '', '清新夏天', 1353686400, 1432483200, 0, 0, 1, 1, 0, 1, 1),
(35, 1, 'image', '广告3', 'http://bestchoice88.com/weTall/index.php?m=index&a=index', '1401/15/52d638db85dcc.jpg', '', '哈哈', '榴莲菇凉秀', 1353686400, 1417017600, 0, 0, 3, 1, 0, 1, 11),
(34, 1, 'image', '广告2', 'http://bestchoice88.com/weTall/index.php?m=index&a=index', '1401/15/52d638ad61fdb.jpg', '', '', '畅销网', 1353686400, 1416931200, 0, 0, 2, 1, 0, 1, 12),
(33, 1, 'image', '小店来推广', 'http://localhost:8081/', '1401/22/52df60c447fdd.png', '', '发呆', '分哇', 1389283200, 1393603200, 0, 0, 255, 1, 0, 1, 29),
(38, 1, 'image', '正小神', 'http://localhost:8081/weTall/index.php', '1401/22/52df80ae3831b.jpg', '', ' 放大', ' 大', 1388592000, 1401638400, 0, 0, 255, 1, 2, 1, 31),
(39, 1, 'image', '诸佛二娃', 'http://localhost:8081/index.php?g=System&m=AdNTAX&a=index', '1401/22/52df816c284aa.png', '', '放大', '放大', 1388678400, 1396713600, 0, 0, 255, 1, 2, 2, 32),
(40, 1, 'image', '小店来推广', 'http://localhost:8081/', '1401/22/52df60c447fdd.png', '', '发呆', '分哇', 1389283200, 1393603200, 0, 0, 255, 1, 1, 2, 29);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


ALTER TABLE  `tp_ad` ADD  `checkstatus` TINYINT NOT NULL DEFAULT  '0' COMMENT  '0-未申请 1-已申请' AFTER  `status` ;


drop TABLE IF EXISTS `tp_info_notice`;
CREATE TABLE IF NOT EXISTS `tp_info_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT NULL,
  `content` text,
  `ptime` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

drop table `tp_node`;
CREATE TABLE IF NOT EXISTS `tp_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '节点名称',
  `title` varchar(50) NOT NULL COMMENT '菜单名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否激活 1：是 2：否',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注说明',
  `pid` smallint(6) unsigned NOT NULL COMMENT '父ID',
  `level` tinyint(1) unsigned NOT NULL COMMENT '节点等级',
  `data` varchar(255) DEFAULT NULL COMMENT '附加参数',
  `sort` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '排序权重',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '菜单显示类型 0:不显示 1:导航菜单 2:左侧菜单',
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

--
-- 转存表中的数据 `tp_node`
--

INSERT INTO `tp_node` (`id`, `name`, `title`, `status`, `remark`, `pid`, `level`, `data`, `sort`, `display`) VALUES
(1, 'cms', '根节点', 1, '', 0, 1, NULL, 0, 0),
(2, 'Site', '站点管理', 1, '', 1, 0, NULL, 0, 1),
(3, 'User', '用户管理', 1, '', 1, 0, NULL, 0, 1),
(4, 'extent', '扩展管理', 1, '', 1, 0, NULL, 10, 1),
(5, 'article', '内容管理', 1, '', 1, 0, NULL, 0, 1),
(6, 'Site', '站点设置', 1, '', 2, 2, NULL, 0, 2),
(7, 'index', '基本信息设置', 1, '', 6, 3, NULL, 0, 2),
(8, 'safe', '安全设置', 1, '', 6, 3, NULL, 0, 2),
(9, 'email', '邮箱设置', 1, '', 6, 3, NULL, 0, 2),
(10, 'upfile', '附件设置', 1, '', 6, 3, NULL, 0, 2),
(11, 'Node', '节点管理', 1, NULL, 2, 2, NULL, 0, 2),
(12, 'add', '添加节点', 1, '', 11, 3, NULL, 0, 2),
(13, 'index', '节点列表', 1, '', 11, 3, NULL, 0, 2),
(14, 'insert', '写入', 1, '0', 11, 3, NULL, 0, 0),
(15, 'edit', '编辑节点', 1, '0', 11, 3, NULL, 0, 0),
(16, 'update', '更新节点', 1, '0', 11, 3, NULL, 0, 0),
(17, 'del', '删除节点', 1, '0', 11, 3, NULL, 0, 0),
(18, 'User', '用户中心', 1, '0', 3, 2, NULL, 0, 2),
(19, 'add', '添加用户', 1, '0', 18, 3, NULL, 0, 2),
(20, 'index', '用户列表', 1, '0', 18, 3, NULL, 0, 2),
(21, 'edit', '编辑用户', 1, '0', 18, 3, NULL, 0, 0),
(22, 'insert', '写入数据库', 1, '0', 18, 3, NULL, 0, 0),
(23, 'update', '更新用户', 1, '0', 18, 3, NULL, 0, 0),
(24, 'del', '删除用户', 1, '0', 18, 3, NULL, 0, 0),
(25, 'Group', '管理组', 1, '0', 3, 2, NULL, 0, 2),
(26, 'add', '创建用户组', 1, '0', 25, 3, NULL, 0, 2),
(27, 'index', '用户组列表', 1, '0', 25, 3, NULL, 0, 2),
(28, 'edit', '编辑用户组', 1, '0', 25, 3, NULL, 0, 0),
(29, 'del', '删除用户组', 1, '0', 25, 3, NULL, 0, 0),
(30, 'insert', '写入数据库', 1, '0', 25, 3, NULL, 0, 0),
(31, 'update', '更新用户组', 1, '0', 25, 3, NULL, 0, 0),
(32, 'insert', '保存测试', 1, '0', 6, 3, NULL, 0, 0),
(36, 'menu', '左侧栏', 1, '0', 35, 3, NULL, 0, 0),
(35, 'System', '首页', 1, '0', 1, 0, NULL, 0, 0),
(37, 'main', '右侧栏目', 1, '0', 35, 3, NULL, 0, 0),
(38, 'Article', '微信图文', 1, '0', 5, 2, NULL, 0, 2),
(39, 'index', '图文列表', 1, '0', 38, 3, NULL, 0, 2),
(40, 'add', '图文添加', 1, '0', 38, 3, NULL, 0, 2),
(41, 'edit', '微信图文编辑', 1, '0', 38, 3, NULL, 0, 0),
(42, 'del', '微信图文删除', 1, '0', 38, 3, NULL, 0, 0),
(80, 'token', '公众号管理', 1, '0', 1, 1, NULL, 0, 1),
(45, 'Function', '功能模块', 1, '0', 1, 0, NULL, 0, 1),
(46, 'Function', '功能模块', 1, '0', 45, 2, NULL, 0, 2),
(47, 'add', '添加模块', 1, '0', 46, 3, NULL, 0, 2),
(48, 'User_group', '会员组', 1, '0', 3, 2, NULL, 0, 2),
(49, 'add', '添加会员组', 1, '0', 48, 3, NULL, 0, 2),
(50, 'Users', '前台用户', 1, '0', 3, 2, NULL, 0, 2),
(51, 'index', '用户列表', 1, '0', 50, 3, NULL, 0, 0),
(52, 'add', '添加用户', 1, '0', 50, 3, NULL, 0, 2),
(53, 'edit', '编辑用户', 1, '0', 50, 3, NULL, 0, 0),
(54, 'del', '删除用户', 1, '0', 50, 3, NULL, 0, 0),
(55, 'insert', '写入数据库', 1, '0', 50, 3, NULL, 0, 0),
(56, 'upsave', '更新用户', 1, '0', 50, 3, NULL, 0, 0),
(57, 'Text', '微信文本', 1, '0', 5, 2, NULL, 0, 2),
(58, 'index', '文本列表', 1, '0', 57, 3, NULL, 0, 2),
(59, 'del', '删除', 1, '0', 57, 3, NULL, 0, 0),
(60, 'Custom', '自定义页面', 1, '0', 5, 2, NULL, 0, 2),
(61, 'index', '列表', 1, '0', 60, 3, NULL, 0, 2),
(62, 'edit', '编辑', 1, '0', 60, 3, NULL, 0, 0),
(63, 'del', '删除', 1, '0', 60, 3, NULL, 0, 0),
(64, 'Records', '充值记录', 1, '0', 4, 2, NULL, 0, 2),
(65, 'index', '充值列表', 1, '0', 64, 3, NULL, 0, 2),
(66, 'Case', '用户案例', 1, '0', 4, 2, NULL, 0, 2),
(67, 'index', '案例列表', 1, '0', 66, 3, NULL, 0, 2),
(68, 'add', '添加案例', 1, '0', 66, 3, NULL, 0, 2),
(69, 'edit', '编辑案例', 1, '0', 66, 3, NULL, 0, 0),
(70, 'del', '删除案例', 1, '0', 66, 3, NULL, 0, 0),
(71, 'insert', '写入数据库', 1, '0', 66, 3, NULL, 0, 0),
(72, 'upsave', '更新数据库', 1, '0', 66, 3, NULL, 0, 0),
(73, 'Links', '友情链接', 1, '0', 4, 2, NULL, 0, 2),
(74, 'index', '友情链接', 1, '0', 73, 3, NULL, 0, 2),
(75, 'add', '添加链接', 1, '0', 73, 3, NULL, 0, 2),
(76, 'edit', '编辑链接', 1, '0', 73, 3, NULL, 0, 0),
(77, 'insert', '插入数据库', 1, '0', 73, 3, NULL, 0, 0),
(78, 'upsave', '更新数据库', 1, '0', 73, 3, NULL, 0, 0),
(79, 'del', '删除友情链接', 1, '0', 73, 3, NULL, 0, 0),
(81, 'Token', '公众号管理', 1, '0', 80, 2, NULL, 0, 2),
(83, 'alipay', '在线支付接口', 1, '0', 6, 3, NULL, 0, 2),
(84, 'Tall', '商城管理', 1, '0', 1, 0, NULL, 0, 1),
(87, 'Brand', '品牌管理', 1, '品牌管理', 84, 2, NULL, 0, 2),
(86, 'Tall', '商品分类', 1, '0', 84, 2, NULL, 0, 2),
(88, 'Info_Notice', '信息发布管理', 1, '公告发布管理', 84, 2, NULL, 0, 2),
(89, 'AdNTAX', '广告及汇率设置', 1, '0', 84, 2, NULL, 0, 2),
(90, 'Statistics', '商家结算系统', 1, '0', 84, 2, NULL, 0, 2);

drop TABLE IF EXISTS `tp_set_tax`
CREATE TABLE IF NOT EXISTS `tp_set_tax` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `shoptax` float DEFAULT '0',
  `coupontax` float DEFAULT '0',
  `giftpointtax` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tp_set_tax`
--

INSERT INTO `tp_set_tax` (`id`, `shoptax`, `coupontax`, `giftpointtax`) VALUES
(1, 0.25, 0.34, 0.56);


drop TABLE IF EXISTS `tp_wecha_shop`;
CREATE TABLE IF NOT EXISTS `tp_wecha_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `tokenTall` varchar(20) NOT NULL,
  `weName` varchar(20) NOT NULL,
  `credit` int(11) NOT NULL DEFAULT '0' COMMENT '信誉点数',
  `headurl` varchar(180) DEFAULT NULL,
  `HaveReal` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-无实体店 1-有实体店',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tokenTall` (`tokenTall`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*添加几个字段*/
ALTER TABLE  `tp_wecha_shop` ADD  `title` VARCHAR( 150 ) NULL DEFAULT NULL AFTER  `HaveReal` ,
ADD  `keywords` VARCHAR( 200 ) NULL DEFAULT NULL AFTER  `title` ,
ADD  `descr` TEXT NULL DEFAULT NULL AFTER  `keywords` ,
ADD  `twodcode` VARCHAR( 200 ) NULL DEFAULT NULL AFTER  `descr` ,
ADD  `status` TINYINT NOT NULL DEFAULT  '1' AFTER  `twodcode` ;

ALTER TABLE  `tp_wecha_shop` ADD  `closeReason` TEXT NULL AFTER  `status` ;

/*实体店认证*/
ALTER TABLE `tp_wecha_shop` CHANGE `HaveReal` `HaveReal` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '0-无实体店 1-有实体店 2-认证中 3-审核不通过';
ALTER TABLE `tp_wecha_shop` ADD `licence` VARCHAR(255) NULL ;
ALTER TABLE `tp_wecha_shop` ADD `address` VARCHAR(255) NULL ;

ALTER TABLE `tp_wecha_shop` ADD `phone` VARCHAR(11) NULL ;
ALTER TABLE `tp_wecha_shop` ADD `logo` VARCHAR(255) NULL ;
