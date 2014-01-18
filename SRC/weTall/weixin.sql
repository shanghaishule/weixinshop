/*
Navicat MySQL Data Transfer

Source Server         : lodb
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : weixin

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-08-21 12:26:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tp_weixin_ad`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_ad`;
CREATE TABLE `tp_weixin_ad` (
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_ad
-- ----------------------------
INSERT INTO `tp_weixin_ad` VALUES ('1', '1', 'image', '广告4', 'http://www.you27.com', '1307/17/51e656ccd4797.jpg', '1307/17/51e656cf02643.jpg', '', '', '1353686400', '1369238400', '0', '0', '1', '1');
INSERT INTO `tp_weixin_ad` VALUES ('12', '1', 'image', '广告2', 'http://www.you27.com', '1307/17/51e656becac0e.jpg', '1307/17/51e656c069abf.jpg', '', '畅销网', '1353686400', '1385222400', '0', '0', '2', '1');
INSERT INTO `tp_weixin_ad` VALUES ('11', '1', 'image', '广告3', 'http://www.you27.com', '1307/17/51e656c5e2472.jpg', '1307/17/51e656c793ae1.jpg', '', '榴莲菇凉秀', '1353686400', '1385222400', '0', '0', '3', '1');

-- ----------------------------
-- Table structure for `tp_weixin_adboard`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_adboard`;
CREATE TABLE `tp_weixin_adboard` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `tpl` varchar(20) NOT NULL,
  `width` smallint(5) NOT NULL,
  `height` smallint(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_adboard
-- ----------------------------
INSERT INTO `tp_weixin_adboard` VALUES ('1', '首页焦点图', 'indexfocus', '730', '395', '小图调用扩展图', '1');

-- ----------------------------
-- Table structure for `tp_weixin_address`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_address`;
CREATE TABLE `tp_weixin_address` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `contacts` varchar(100) DEFAULT '联系人',
  `Province` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Area` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL COMMENT '详细地址',
  `postcode` varchar(30) DEFAULT NULL COMMENT '邮编',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手机号码',
  `phone` varchar(50) DEFAULT NULL COMMENT '电话号码',
  `name` varchar(50) NOT NULL COMMENT '公司名称',
  `isno` varchar(10) DEFAULT '0' COMMENT '0:否 1:是',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_address
-- ----------------------------
INSERT INTO `tp_weixin_address` VALUES ('4', '周建群', '福建省', '厦门市', '思明区', '金沙花园', '362246', '15880765056', '15655', '乐谷', '1', '1', '0');

-- ----------------------------
-- Table structure for `tp_weixin_admin`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_admin`;
CREATE TABLE `tp_weixin_admin` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role_id` smallint(5) NOT NULL,
  `last_ip` varchar(15) NOT NULL,
  `last_time` int(10) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_admin
-- ----------------------------
INSERT INTO `tp_weixin_admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', '127.0.0.1', '1377059042', '123456@qq.com', '1');

-- ----------------------------
-- Table structure for `tp_weixin_admin_auth`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_admin_auth`;
CREATE TABLE `tp_weixin_admin_auth` (
  `role_id` tinyint(3) NOT NULL,
  `menu_id` smallint(6) NOT NULL,
  KEY `role_id` (`role_id`,`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_admin_auth
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_admin_role`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_admin_role`;
CREATE TABLE `tp_weixin_admin_role` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `remark` text NOT NULL,
  `ordid` tinyint(3) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_admin_role
-- ----------------------------
INSERT INTO `tp_weixin_admin_role` VALUES ('1', '超级管理员', '超级管理员', '0', '1');

-- ----------------------------
-- Table structure for `tp_weixin_album`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_album`;
CREATE TABLE `tp_weixin_album` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` smallint(4) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL,
  `uname` varchar(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `intro` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `cover_cache` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `likes` int(10) NOT NULL,
  `items` int(10) unsigned NOT NULL DEFAULT '0',
  `follows` int(10) unsigned NOT NULL DEFAULT '0',
  `is_index` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `add_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_album
-- ----------------------------
INSERT INTO `tp_weixin_album` VALUES ('1', '1', '14', '泡芙小米粒', '【大自然的小精灵。】', '', '', 'a:5:{i:0;a:2:{s:3:\"img\";s:96:\"http://img01.taobaocdn.com/bao/uploaded/i1/15957022531960761/T1lBuqXB4fXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:90:\"韩版新款夏装中长款带帽长袖透明防晒衣空调衫防晒衫披肩开衫外套\";}i:1;a:2:{s:3:\"img\";s:72:\"http://img03.taobaocdn.com/bao/uploaded/i3/T197PPXgVoXXcy8OM._112623.jpg\";s:5:\"intro\";s:79:\"淘金币 【远步正品】 2012新款 星旗条纹男女帆布鞋情侣鞋子\";}i:2;a:2:{s:3:\"img\";s:72:\"http://img04.taobaocdn.com/bao/uploaded/i4/T1wBy7XflaXXX6UvwV_020442.jpg\";s:5:\"intro\";s:86:\"MIYI新款鳄鱼纹翻盖潮手包牛皮女包单肩包复古包小包包 清仓包邮\";}i:3;a:2:{s:3:\"img\";s:72:\"http://img04.taobaocdn.com/bao/uploaded/i4/T1qdnCXlBhXXbCT873_051140.jpg\";s:5:\"intro\";s:82:\"浪漫一身 2012秋装新款 通勤OL开衫V领长袖 纯色百搭时尚小外套\";}i:4;a:2:{s:3:\"img\";s:72:\"http://img02.taobaocdn.com/bao/uploaded/i2/T1h4F7XbdAXXce_eEZ_032143.jpg\";s:5:\"intro\";s:79:\"浪漫一身 2012秋装新款 专柜正品 亮色带帽长袖休闲格子外套\";}}', '1', '255', '0', '6', '0', '0', '1353896347');
INSERT INTO `tp_weixin_album` VALUES ('2', '1', '10', '设计系小女生', '甜美商品惹人爱♡', '', '', 'a:5:{i:0;a:2:{s:3:\"img\";s:96:\"http://img02.taobaocdn.com/bao/uploaded/i2/12023026773167605/T14VXuFiNgXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:81:\"2013夏装新款 韩版大码修身 圆领雪纺袖印花 纯棉短袖女T恤 夏\";}i:1;a:2:{s:3:\"img\";s:93:\"http://image.taobao.com/bao/uploaded/i4/19292023009681721/T1pgyHXEJfXXXXXXXX_!!2-item_pic.png\";s:5:\"intro\";s:87:\"2013夏装新款韩版女装 时尚修身百搭体恤圆领印花纯棉女士T恤短袖\";}i:2;a:2:{s:3:\"img\";s:96:\"http://img04.taobaocdn.com/bao/uploaded/i4/13411024173381739/T1IppqFbNXXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:85:\"奕生缘2013新款 高档纯棉V领纯色修身白色韩版t恤短袖女夏装大码\";}i:3;a:2:{s:3:\"img\";s:72:\"http://img03.taobaocdn.com/bao/uploaded/i3/T1hG1IXelfXXcX4o.9_105150.jpg\";s:5:\"intro\";s:64:\"【远步正品】  2011冬季时尚女士平底雪地靴 棉鞋\";}i:4;a:2:{s:3:\"img\";s:72:\"http://img01.taobaocdn.com/bao/uploaded/i1/T1tWOuXmFTXXXbvKDb_093608.jpg\";s:5:\"intro\";s:84:\"MIYI 2012秋冬新款头层牛皮手提包单肩包水桶真皮女包通勤包包邮\";}}', '1', '255', '0', '7', '0', '0', '1353896347');
INSERT INTO `tp_weixin_album` VALUES ('3', '2', '19', '安土桃山', '一个人的世界', '', '', 'a:4:{i:0;a:2:{s:3:\"img\";s:96:\"http://img04.taobaocdn.com/bao/uploaded/i4/18075021709325472/T1L8N.XudgXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:88:\"都衣舞尔情侣装短袖撞色拼接夏装新款韩国男女大码T恤沙滩情侣衫\";}i:1;a:2:{s:3:\"img\";s:96:\"http://img01.taobaocdn.com/bao/uploaded/i1/12816023555462640/T18JONXApeXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:83:\"印迪洋时2013夏季新品女装韩版修身大码圆点印花连帽短袖T恤女\";}i:2;a:2:{s:3:\"img\";s:72:\"http://img01.taobaocdn.com/bao/uploaded/i1/T1RKfEXkxkXXc.bh3U_014824.jpg\";s:5:\"intro\";s:77:\"【远步正品】 加厚松高鞋休闲棉帆布鞋 韩版厚底帆松糕鞋\";}i:3;a:2:{s:3:\"img\";s:72:\"http://img01.taobaocdn.com/bao/uploaded/i1/T1FGLNXmJbXXbjSLvb_093718.jpg\";s:5:\"intro\";s:85:\"浪漫一身 2012秋装新款 专柜正品 休闲长袖薄外套修身立领棒球衫\";}}', '1', '255', '0', '4', '0', '0', '1353896347');
INSERT INTO `tp_weixin_album` VALUES ('4', '1', '8', '枕水而眠', '❀色彩_谁是那个人', '', '', 'a:5:{i:0;a:2:{s:3:\"img\";s:25:\"1307/18/51e7ad7789d26.jpg\";s:5:\"intro\";s:6:\"测试\";}i:1;a:2:{s:3:\"img\";s:96:\"http://img04.taobaocdn.com/bao/uploaded/i4/15843024126370724/T1Fq9QXstiXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:84:\"短袖女t恤2013夏装韩版新款小清新女装宽松甜美上衣女生白色t桖\";}i:2;a:2:{s:3:\"img\";s:96:\"http://img01.taobaocdn.com/bao/uploaded/i1/19526021830466963/T1KW5dXxlcXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:87:\"2013新款女装夏装韩版短袖时尚休闲运动套装加大码胖mm套装运动服\";}i:3;a:2:{s:3:\"img\";s:72:\"http://img04.taobaocdn.com/bao/uploaded/i4/T1ac2vXcRvXXXE1hsU_014747.jpg\";s:5:\"intro\";s:84:\"【远步正品】2012秋冬新款 英伦印花松糕厚底高帮鞋 松糕鞋女款\";}i:4;a:2:{s:3:\"img\";s:72:\"http://img02.taobaocdn.com/bao/uploaded/i2/T1x7C0XhxqXXbW6xwT_012127.jpg\";s:5:\"intro\";s:79:\"特卖款2012秋冬新款榴莲家 风衣帅气外套 带帽风衣外套LLS1009\";}}', '1', '255', '0', '10', '0', '0', '1353896347');
INSERT INTO `tp_weixin_album` VALUES ('5', '1', '18', '晨雪熙', '一颗心的距离', '', '', 'a:5:{i:0;a:2:{s:3:\"img\";s:96:\"http://img03.taobaocdn.com/bao/uploaded/i3/19490024699170259/T1QmRxFX8aXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:85:\"Simier斯米尔流行男鞋潮鞋夏季透气低帮鞋男休闲鞋男英伦板鞋1039\";}i:1;a:2:{s:3:\"img\";s:96:\"http://img04.taobaocdn.com/bao/uploaded/i4/15721024181492800/T1wMS5Xy4cXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:87:\"哥弟专柜正品2013新款夏装新品大码女装短袖T恤 女式韩版修身上衣\";}i:2;a:2:{s:3:\"img\";s:96:\"http://img04.taobaocdn.com/bao/uploaded/i4/10114024878170152/T162pAFoBcXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:87:\"年中大促天猫 夏装 韩版名族风时尚修身大码绣花女装棉短袖t恤女\";}i:3;a:2:{s:3:\"img\";s:96:\"http://img01.taobaocdn.com/bao/uploaded/i1/13331035721128449/T1bG5JXB8iXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:83:\"欧罗兰2013夏季新款女装韩版宽松圆领大码纯棉短袖中长款t恤女\";}i:4;a:2:{s:3:\"img\";s:96:\"http://img02.taobaocdn.com/bao/uploaded/i2/18118024057573261/T1zhO3XDhbXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:84:\"公子一派 2013新款男士V领短袖T恤品质男装纯棉男士T恤修身男T恤\";}}', '1', '255', '0', '12', '0', '1', '1353896348');
INSERT INTO `tp_weixin_album` VALUES ('6', '1', '6', '起个名字太累', '总有一个角落，卸下你的包袱', '', '', 'a:5:{i:0;a:2:{s:3:\"img\";s:96:\"http://img03.taobaocdn.com/bao/uploaded/i3/18997020551833232/T1DaRKXCReXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:86:\"2013夏装女装韩国代购潮现货7分泡泡袖胖MM大码长款宽松女t恤短袖\";}i:1;a:2:{s:3:\"img\";s:96:\"http://img03.taobaocdn.com/bao/uploaded/i3/17241035052144126/T1ANX.Xz4iXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:81:\"新品2013胖mm显瘦款莫代尔蝙蝠衫宽松韩版短袖夏装 女 大码T恤\";}i:2;a:2:{s:3:\"img\";s:72:\"http://img02.taobaocdn.com/bao/uploaded/i2/T1_tHLXn4fXXXLjDMT_013219.jpg\";s:5:\"intro\";s:72:\"【远步正品】2012秋冬季印花高帮帆布鞋 韩版 学生女鞋\";}i:3;a:2:{s:3:\"img\";s:72:\"http://img01.taobaocdn.com/bao/uploaded/i1/T1wnqyXXNfXXa2j1I0_034801.jpg\";s:5:\"intro\";s:73:\"【远步正品】 越狱米勒系列厚底帆布鞋松糕鞋 欧美ca276\";}i:4;a:2:{s:3:\"img\";s:72:\"http://img04.taobaocdn.com/bao/uploaded/i4/T1ZArWXkllXXX.ujTX_085705.jpg\";s:5:\"intro\";s:85:\"远步正品 韩版潮 厚底松糕高帮帆布鞋子 学生休闲鞋 女式帆布鞋\";}}', '1', '255', '0', '9', '0', '1', '1353896348');
INSERT INTO `tp_weixin_album` VALUES ('7', '1', '20', '熊小熊zz', '放慢脚步，细细地品味生活', '', '', 'a:5:{i:0;a:2:{s:3:\"img\";s:96:\"http://img04.taobaocdn.com/bao/uploaded/i4/19109019960887092/T1cFFxXsVfXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:89:\"休闲套装夏季韩版时尚女 短袖运动服运动套装夏装 大码女装卫衣装\";}i:1;a:2:{s:3:\"img\";s:96:\"http://img01.taobaocdn.com/bao/uploaded/i1/14456024842364836/T13LJuFkBfXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:86:\"t恤男短袖韩版2013新款夏装男装潮牌正品代购美国男士短袖af男t恤\";}i:2;a:2:{s:3:\"img\";s:72:\"http://img02.taobaocdn.com/bao/uploaded/i2/T1Ag54XbtuXXXfz.I5_060343.jpg\";s:5:\"intro\";s:84:\"榴莲家2012秋季女装 韩版波点翻袖小西装外套 修身休闲西装 20072\";}i:3;a:2:{s:3:\"img\";s:72:\"http://img04.taobaocdn.com/bao/uploaded/i4/T1.Ly7XmhmXXcoBArb_124637.jpg\";s:5:\"intro\";s:85:\"MIYI休闲糖果色邮差包韩版撞色单肩斜挎包磨砂牛皮复古包包女包\";}i:4;a:2:{s:3:\"img\";s:72:\"http://img01.taobaocdn.com/bao/uploaded/i1/T1xtK1XnlkXXaGp4E6_062100.jpg\";s:5:\"intro\";s:86:\"MIYI单肩小包2012新款潮时尚韩版休闲牛皮欧美红色新娘手拿女包包\";}}', '1', '255', '0', '8', '0', '1', '1353896348');
INSERT INTO `tp_weixin_album` VALUES ('8', '1', '17', 'V小莲小莲V', '美好时光', '', '', 'a:5:{i:0;a:2:{s:3:\"img\";s:96:\"http://img03.taobaocdn.com/bao/uploaded/i3/10519034815428119/T1GVSyXDFaXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:86:\"2013夏装新款情侣装两件套女裙韩国版新品时尚撞色拼接男短袖T恤\";}i:1;a:2:{s:3:\"img\";s:96:\"http://img04.taobaocdn.com/bao/uploaded/i4/12239024730307672/T14HWxXqpbXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:85:\"包邮2013男T女裙女t女恤短袖情侣装夏装长款打底衫女韩版情侣T恤\";}i:2;a:2:{s:3:\"img\";s:96:\"http://img04.taobaocdn.com/bao/uploaded/i4/13434022985138156/T1Lz1zXtXXXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:83:\"夏装新款2013大码女装 胖mm夏装韩版修身显瘦打底衫宽松短袖t恤\";}i:3;a:2:{s:3:\"img\";s:96:\"http://img01.taobaocdn.com/bao/uploaded/i1/11867023623831451/T14UeRXDdXXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:82:\"2013夏装韩版女款新款大码上衣网纱打底衫纯色短袖t恤短袖26320\";}i:4;a:2:{s:3:\"img\";s:96:\"http://img04.taobaocdn.com/bao/uploaded/i4/17601022601388672/T1niWsXDpfXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:86:\"依嬅莎 2013新款夏装韩版女装专柜正品女士T恤显瘦条纹短袖t恤 女\";}}', '1', '255', '0', '12', '0', '0', '1353896349');
INSERT INTO `tp_weixin_album` VALUES ('9', '1', '12', '跳房子123', '❤ Home❥小小的空间', '', '', 'a:4:{i:0;a:2:{s:3:\"img\";s:72:\"http://img02.taobaocdn.com/bao/uploaded/i2/T1RR2RXkNcXXceltU7_063938.jpg\";s:5:\"intro\";s:60:\"【远步正品】男女款 越狱 低帮帆布鞋 情侣鞋\";}i:1;a:2:{s:3:\"img\";s:72:\"http://img04.taobaocdn.com/bao/uploaded/i4/T1DxC8Xi4eXXXO8ZZ5_054947.jpg\";s:5:\"intro\";s:86:\"MIYI米逸 新款英伦小包卡其色单肩包复古牛皮撞色复古女包邮差包\";}i:2;a:2:{s:3:\"img\";s:72:\"http://img02.taobaocdn.com/bao/uploaded/i2/T1X697XjXbXXcMnfM._112229.jpg\";s:5:\"intro\";s:85:\"MIYI 红色斜纹牛皮单肩包包女包 2012新款潮包结婚包新娘包晚宴包\";}i:3;a:2:{s:3:\"img\";s:72:\"http://img04.taobaocdn.com/bao/uploaded/i4/T1oAbZXkldXXcH5ug2_043616.jpg\";s:5:\"intro\";s:84:\"MIYI 英国2013新款头层牛皮撞色真皮女包小包单肩包信封邮差包邮\";}}', '1', '255', '0', '4', '0', '0', '1353902316');
INSERT INTO `tp_weixin_album` VALUES ('10', '1', '7', '咕咕是一只猫', '手作王国', '', '', 'a:3:{i:0;a:2:{s:3:\"img\";s:96:\"http://img01.taobaocdn.com/bao/uploaded/i1/10917022951369205/T1wfGxXCxiXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:84:\"春夏新品潮爆图案印花双口袋纯棉宽松大版蝙蝠T恤 CC皇后家C0062\";}i:1;a:2:{s:3:\"img\";s:72:\"http://img01.taobaocdn.com/bao/uploaded/i1/T18U_SXklkXXcPno7._084022.jpg\";s:5:\"intro\";s:85:\"MIYI 2012秋冬新款欧美时尚牛皮邮差包单肩斜挎包 复古百搭女大包\";}i:2;a:2:{s:3:\"img\";s:72:\"http://img02.taobaocdn.com/bao/uploaded/i2/T1qrdqXXlwXXa_4U38_101909.jpg\";s:5:\"intro\";s:85:\"MIYI 2012英伦复古学院风牛皮撞色邮差包 时尚单肩斜挎潮包女士包\";}}', '1', '255', '0', '3', '0', '0', '1353902316');
INSERT INTO `tp_weixin_album` VALUES ('11', '1', '11', '彩色淘', '怀旧系，寻找时光的芳', '', '', 'a:5:{i:0;a:2:{s:3:\"img\";s:96:\"http://img01.taobaocdn.com/bao/uploaded/i1/12542025078365981/T14i8OFohXXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:84:\"2013情侣装夏装 流氓兔子韩版短袖纯棉打底衫情侣t恤修身男女款\";}i:1;a:2:{s:3:\"img\";s:96:\"http://img01.taobaocdn.com/bao/uploaded/i1/16534025602603614/T1nUSPXq0hXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:88:\"缀爱依 连衣裙 夏季 韩版 新款女装小碎花休闲修身雪纺连衣裙裙子\";}i:2;a:2:{s:3:\"img\";s:96:\"http://img04.taobaocdn.com/bao/uploaded/i4/18861022761956552/T1RGWvXvhfXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:85:\"2013夏装新款 韩版女装纯棉修身百搭圆领短袖T恤女 大码白色半袖\";}i:3;a:2:{s:3:\"img\";s:96:\"http://img03.taobaocdn.com/bao/uploaded/i3/12912023572419619/T1PXyaXu4cXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:83:\"2013夏天新款女装翻领纯棉T恤女短袖韩版修身POLO衫刺绣t恤女士t\";}i:4;a:2:{s:3:\"img\";s:96:\"http://img04.taobaocdn.com/bao/uploaded/i4/12179025445503052/T1oHNyFl8iXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:86:\"韩版防晒衫 无扣披肩 防晒衣 空调开衫罩衫超薄 针织衫外套 女夏\";}}', '1', '255', '0', '11', '0', '1', '1353902316');
INSERT INTO `tp_weixin_album` VALUES ('12', '1', '15', 'Prickleman', '小小角落', '', '', 'a:2:{i:0;a:2:{s:3:\"img\";s:72:\"http://img02.taobaocdn.com/bao/uploaded/i2/T1ctjsXf4gXXXA2Yvb_093214.jpg\";s:5:\"intro\";s:89:\"正品 防晒衣长袖透明蕾丝超薄外套女 夏防紫外线防晒衫开衫防晒服\";}i:1;a:2:{s:3:\"img\";s:72:\"http://img04.taobaocdn.com/bao/uploaded/i4/T1_HC7XhlwXXbMVu7W_023330.jpg\";s:5:\"intro\";s:81:\"MIYI秋冬新款牛皮复古OL通勤单肩斜挎女包包英伦潮款特价包邮\";}}', '1', '255', '0', '2', '0', '0', '1353902316');
INSERT INTO `tp_weixin_album` VALUES ('13', '1', '16', 'Eudora_寻寻', '温暖的小世界。', '', '', 'a:5:{i:0;a:2:{s:3:\"img\";s:96:\"http://img01.taobaocdn.com/bao/uploaded/i1/11492021659317504/T1TyOaXCXbXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:86:\"tinee天鹅绒运动套装女款春秋休闲套装女韩版金丝绒大码卫衣套装\";}i:1;a:2:{s:3:\"img\";s:96:\"http://img03.taobaocdn.com/bao/uploaded/i3/10261021377723980/T1GbZ_Xl0cXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:90:\"笠莎春秋韩版天鹅绒运动套装女金丝绒大码卫衣套装休闲套装运动服\";}i:2;a:2:{s:3:\"img\";s:96:\"http://img03.taobaocdn.com/bao/uploaded/i3/14022024525063591/T1XJusXE0eXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:86:\"奶牛的梦 短袖男装夏装2013新款 男t恤休闲翻领珠地棉男士短袖T恤\";}i:3;a:2:{s:3:\"img\";s:72:\"http://img01.taobaocdn.com/bao/uploaded/i1/T1msjzXfFmXXbavIAU_013829.jpg\";s:5:\"intro\";s:76:\"【远步正品】2012秋冬新款 印花高帮帆布鞋 韩版 学生女鞋\";}i:4;a:2:{s:3:\"img\";s:72:\"http://img04.taobaocdn.com/bao/uploaded/i4/T1gz6JXj8iXXblFxU8_100704.jpg\";s:5:\"intro\";s:87:\"MIYI 欧美鸵鸟纹头层牛皮单肩包斜跨复古女包邮差包 手提真皮女包\";}}', '1', '255', '0', '5', '0', '0', '1353902317');
INSERT INTO `tp_weixin_album` VALUES ('14', '1', '13', '想太多妹子', '创意也能DIY', '', '', 'a:5:{i:0;a:2:{s:3:\"img\";s:72:\"http://img01.taobaocdn.com/bao/uploaded/i1/T1K_vfXlJaXXakVJ37_064254.jpg\";s:5:\"intro\";s:77:\"【远步正品】2012秋冬新款 星星印花女式低帮帆布鞋学生鞋\";}i:1;a:2:{s:3:\"img\";s:72:\"http://img03.taobaocdn.com/bao/uploaded/i3/T1qYjFXbXfXXXvyygU_015147.jpg\";s:5:\"intro\";s:63:\"【远步正品】 男女帆布鞋韩版 高帮 学生情侣鞋\";}i:2;a:2:{s:3:\"img\";s:72:\"http://img03.taobaocdn.com/bao/uploaded/i3/T1M463XeBdXXb0fkM9_074304.jpg\";s:5:\"intro\";s:85:\"预售定金 榴莲家 英伦双排扣毛呢外套牛角扣肩章羊毛呢大衣20459\";}i:3;a:2:{s:3:\"img\";s:72:\"http://img04.taobaocdn.com/bao/uploaded/i4/T1srf5Xm8XXXXV8lI__110350.jpg\";s:5:\"intro\";s:82:\"预售款 榴莲家秋冬装新款呢大衣女 双排扣气质呢大衣外套20281\";}i:4;a:2:{s:3:\"img\";s:72:\"http://img02.taobaocdn.com/bao/uploaded/i2/T1O9mQXndwXXXD_O.0_035651.jpg\";s:5:\"intro\";s:85:\"MIYI 2012秋冬新款欧美头层牛皮单肩斜挎包 韩版真皮女包通勤包包\";}}', '1', '255', '0', '5', '0', '1', '1353902318');
INSERT INTO `tp_weixin_album` VALUES ('15', '1', '9', 'wingsa区', '韩范范思密达', '', '', 'a:5:{i:0;a:2:{s:3:\"img\";s:25:\"1307/18/51e7a67871098.gif\";s:5:\"intro\";s:15:\"sadasdsadsadsad\";}i:1;a:2:{s:3:\"img\";s:96:\"http://img02.taobaocdn.com/bao/uploaded/i2/14997021759858927/T1RF1XXAddXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:83:\"包邮特价2013女士夏装纯色t恤/韩版修身V领白色短袖t恤女/胖mm潮\";}i:2;a:2:{s:3:\"img\";s:96:\"http://img03.taobaocdn.com/bao/uploaded/i3/13541025066567942/T1PPWEXxpfXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:85:\"艾路丝婷2013夏装新款大码韩版女装修身体恤短袖打底衫T恤女B0601\";}i:3;a:2:{s:3:\"img\";s:96:\"http://img01.taobaocdn.com/bao/uploaded/i1/13873036405076498/T1THxmFm8XXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:85:\"2013新款夏装韩版短袖潮女装上衣服胖MM大码宽松中长款短袖女t恤\";}i:4;a:2:{s:3:\"img\";s:96:\"http://img02.taobaocdn.com/bao/uploaded/i2/12582025820267890/T1bjmYXzxdXXXXXXXX_!!0-item_pic.jpg\";s:5:\"intro\";s:86:\"尚西哲 男士短袖t恤 男夏装男T恤 韩版男装 t恤 大码男装短袖条纹\";}}', '1', '255', '0', '7', '0', '0', '1353902642');

-- ----------------------------
-- Table structure for `tp_weixin_album_cate`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_album_cate`;
CREATE TABLE `tp_weixin_album_cate` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `albums` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `seo_title` varchar(255) NOT NULL,
  `seo_keys` varchar(255) NOT NULL,
  `seo_desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_album_cate
-- ----------------------------
INSERT INTO `tp_weixin_album_cate` VALUES ('1', '甜美', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('2', '欧美', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('3', '街拍', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('4', '复古', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('5', '明星', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('6', '穿搭', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('7', '品牌', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('8', '婚礼', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('9', '美妆', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('10', '美发', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('11', '个性', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('12', '日系', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('13', '韩系', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('14', '清新', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('15', '英伦', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('16', 'BF风', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('17', '朋克', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('18', '优雅', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('19', '名媛', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('20', '森女', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('21', '性感', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('22', '流行', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('23', '时尚', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('24', '简约', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('25', '民族', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('26', '原单', '', '0', '0', '1', '', '', '');
INSERT INTO `tp_weixin_album_cate` VALUES ('27', 'OL', '', '0', '0', '1', '', '', '');

-- ----------------------------
-- Table structure for `tp_weixin_album_comment`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_album_comment`;
CREATE TABLE `tp_weixin_album_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `album_id` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `uname` varchar(20) NOT NULL,
  `info` text NOT NULL,
  `add_time` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_album_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_album_follow`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_album_follow`;
CREATE TABLE `tp_weixin_album_follow` (
  `uid` int(10) NOT NULL,
  `album_id` int(10) NOT NULL,
  `add_time` int(10) NOT NULL,
  UNIQUE KEY `uid` (`uid`,`album_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_album_follow
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_album_item`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_album_item`;
CREATE TABLE `tp_weixin_album_item` (
  `album_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `intro` varchar(255) NOT NULL,
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`album_id`,`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_album_item
-- ----------------------------
INSERT INTO `tp_weixin_album_item` VALUES ('0', '124', 'CCCCCCC', '1376964390');

-- ----------------------------
-- Table structure for `tp_weixin_alipay`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_alipay`;
CREATE TABLE `tp_weixin_alipay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alipayname` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '支付宝名称',
  `partner` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '合作身份者id',
  `key` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '安全检验码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tp_weixin_alipay
-- ----------------------------
INSERT INTO `tp_weixin_alipay` VALUES ('1', 'meiruoju@163.com', '2088601266739497', 'abq6lde5sbeq1jkzyulbej66ub7xvh84');

-- ----------------------------
-- Table structure for `tp_weixin_article`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_article`;
CREATE TABLE `tp_weixin_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` smallint(4) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `colors` varchar(10) NOT NULL,
  `author` varchar(100) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL,
  `intro` varchar(255) NOT NULL,
  `info` text NOT NULL,
  `comments` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览数',
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序值',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `last_time` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `seo_title` varchar(255) NOT NULL,
  `seo_keys` varchar(255) NOT NULL,
  `seo_desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_article
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_article_cate`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_article_cate`;
CREATE TABLE `tp_weixin_article_cate` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `pid` smallint(4) unsigned NOT NULL DEFAULT '0',
  `spid` varchar(50) NOT NULL,
  `ordid` smallint(4) unsigned NOT NULL DEFAULT '255',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `seo_title` varchar(255) NOT NULL,
  `seo_keys` varchar(255) NOT NULL,
  `seo_desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_article_cate
-- ----------------------------
INSERT INTO `tp_weixin_article_cate` VALUES ('1', '1', '网站信息', '', '', '0', '0', '255', '1', '', '', '');
INSERT INTO `tp_weixin_article_cate` VALUES ('2', '1', '关于我们', '', '', '1', '1|', '255', '1', '', '', '');
INSERT INTO `tp_weixin_article_cate` VALUES ('3', '1', '联系我们', '', '', '1', '1|', '255', '1', '', '', '');
INSERT INTO `tp_weixin_article_cate` VALUES ('4', '1', '加入我们', '', '', '1', '1|', '255', '1', '', '', '');
INSERT INTO `tp_weixin_article_cate` VALUES ('6', '1', '积分规则', '', '', '5', '5|', '255', '1', '', '', '');
INSERT INTO `tp_weixin_article_cate` VALUES ('7', '1', '兑换说明', '', '', '5', '5|', '255', '1', '', '', '');

-- ----------------------------
-- Table structure for `tp_weixin_article_page`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_article_page`;
CREATE TABLE `tp_weixin_article_page` (
  `cate_id` smallint(4) unsigned NOT NULL DEFAULT '0',
  `title` varchar(120) NOT NULL,
  `info` text NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_keys` varchar(255) NOT NULL,
  `seo_desc` text NOT NULL,
  `last_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_article_page
-- ----------------------------
INSERT INTO `tp_weixin_article_page` VALUES ('2', '关于我们', '<div>\r\n	欢迎来到PinPHP－拼品网， 拼品网是一个技术驱动创造时尚的互联网创业型公司，通过搜索引擎、图形处理、视觉搜索等核心技术研发优势，为中国千百万的个人站长提供一个解决如何快速抢建一个社会化的电子商务导购平台，它可以帮助爱美丽的女生找到适合的穿衣搭配、在哪里购买合适的时装搭配网购社区平台；我们将致力于为每一个时尚女孩都能轻松地创建属于自己的搭配宝典库而矢志不移的奉献青春年华。\r\n</div>\r\n<div>\r\n	<br />\r\n</div>\r\n<div>\r\n	　　来逛拼品网&nbsp;，你将发现更多喜爱的搭配风格，找到你最喜欢的时尚元素，你也将发现全球各地流行的风格与趋势，你还能很方便的在线拼贴搭配出你的时尚品味；懂得搭配的女人才更美丽，拉上你的好姐妹们一起来逛拼品网吧！\r\n</div>\r\n<div>\r\n	<br />\r\n</div>\r\n<div>\r\n	　　Logo寓意诠释：化蛹成碟的美丽蜕变，意思是通过来逛拼品网能让女孩们蜕变得更美丽！\r\n</div>', '', '', '', '0');
INSERT INTO `tp_weixin_article_page` VALUES ('3', '联系我们', '<p style=\"margin-top:0px;margin-bottom:0px;padding:0px;color:#666666;font-family:Arial;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\r\n	联系电话：0571-28058597\r\n</p>\r\n<p style=\"margin-top:0px;margin-bottom:0px;padding:0px;color:#666666;font-family:Arial;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\r\n	&nbsp;\r\n</p>\r\n<p style=\"margin-top:0px;margin-bottom:0px;padding:0px;color:#666666;font-family:Arial;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\r\n	官方网站：www.pinphp.com\r\n</p>\r\n<p style=\"margin-top:0px;margin-bottom:0px;padding:0px;color:#666666;font-family:Arial;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\r\n	&nbsp;\r\n</p>\r\n<p style=\"margin-top:0px;margin-bottom:0px;padding:0px;color:#666666;font-family:Arial;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\r\n	地址：杭州市万塘路６９号华星科技苑Ａ楼\r\n</p>\r\n<p style=\"margin-top:0px;margin-bottom:0px;padding:0px;color:#666666;font-family:Arial;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\r\n	&nbsp;\r\n</p>\r\n<p style=\"margin-top:0px;margin-bottom:0px;padding:0px;color:#666666;font-family:Arial;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\r\n	邮编：３１００１２\r\n</p>', '', '', '', '0');
INSERT INTO `tp_weixin_article_page` VALUES ('4', '加入我们', '<span style=\"white-space:nowrap;\"><strong>岗位名称：信息编辑</strong></span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp;<strong> 岗位职责：&nbsp;</strong></span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 1、产业网站内容建设；&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 2、产业数据搜集整理；</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; <strong>任职要求 ：&nbsp;</strong></span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 1、大专以上学历，传媒、新闻、电子商务相关专业优先；&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 2、1年以上互联网行业媒体从业经验，有电子商务相关从业经历者优先；&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 3、熟悉网页制作软件，良好的文字功底、有原创采写经验者优先；&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 4、对新闻、电子商务等产业有持续关注兴趣，良好的英文阅读能力；&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 5、具有较强学习能力和责任心，以及团队合作精神；&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 6、优秀应届毕业生可放宽工作经验要求；</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 有意者请发送简历至：HR#insuny.com （#替换成@）</span><br />\r\n<span style=\"white-space:nowrap;\"><br />\r\n</span><br />\r\n<span style=\"white-space:nowrap;\"><strong>岗位名称：开发工程师</strong></span><br />\r\n<span style=\"white-space:nowrap;\"><strong>&nbsp; &nbsp; 岗位职责：&nbsp;</strong></span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 1、负责网站系统及B/S架构产品开发；&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 2、负责产品体验优化；</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp;<strong> 任职要求 ：</strong>&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 1、大学专科及以上，计算机相关专业优先；&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 2、2年以上B/S架构开发经验；有独立开发开发经验者优先；&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 3、良好掌握PHP开发语言及MySQL数据库；&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 4、熟练掌握javascript / ajax等；&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 5、有激情，热爱互联网行业，熟悉web2.0应用；</span><br />\r\n<span style=\"white-space:nowrap;\"><br />\r\n</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; 有意者请发送简历至：HR#insuny.com（#替换成@）</span><br />\r\n<span style=\"white-space:nowrap;\"><br />\r\n</span><br />\r\n<span style=\"white-space:nowrap;\"><strong>岗位名称：网页设计师</strong></span><br />\r\n<span style=\"white-space:nowrap;\"><strong>&nbsp; &nbsp; 岗位职责：</strong>&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 1、负责网站及B/S架构产品前端界面设计及重构；&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 2、负责产品体验优化；</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp;<strong> 任职要求 ：</strong>&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 1、大学专科及以上，计算机相关专业优先；&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 2、2年以上网站设计经验；有整站设计重构经验者优先；&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 3、良好掌握XHTML，CSS手工书写页面，熟悉W3C标准，精通div+css；&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 4、精通Photoshop、Dreamweaver、Flash等多种网页设计制作软件；&nbsp;</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp; 5、有激情，热爱互联网行业，熟悉web2.0应用；</span><br />\r\n<span style=\"white-space:nowrap;\"><br />\r\n</span><br />\r\n<span style=\"white-space:nowrap;\">&nbsp; &nbsp; &nbsp; &nbsp;有意者请发送简历至：HR#insuny.com （#替换成@）</span><br />', '', '', '', '0');
INSERT INTO `tp_weixin_article_page` VALUES ('6', '会员加减分规则', '<p>\r\n	<strong>积分兑换</strong>\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	积分是为了答谢支持PinPHP网站会员而制定的一种奖励方式，您可以进入账户中的积分页面查看积分明细，同时PinPHP会推出各类积分兑换活动，请随时关注关于积分的活动告知。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong>积分获得：</strong>\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	1、会员注册：会员注册即送20点积分，一个账户只能得一次注册积分；\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	2、每日登录：会员每日首次登录PinPHP网站能获得10积分，每日上限5次；\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	3、发布分享：会员分享新商品到PinPHP网站能获得20积分，每日上限10次；\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	4、添加喜欢：针对PinPHP网站上的商品会员点击喜欢可获得1积分，每日上限10次；\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	5、添加到专辑：会员把喜欢的商品添加进个人的专辑中可获得2积分，每日上限10次；\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	6、转发分享：会员转发PinPHP网站上商品到其他网站上可获2积分，每日上限10次；\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	7、发布评论：会员评论PinPHP网站商品可获1积分，每日上线5次。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong>积分扣除：</strong>\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	1、删除分享：会员删除自己添加的商品减20积分，每日上限100次；\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	2、兑换商品：会员使用积分兑换自己喜欢的商品会扣除相对应的积分。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<div>\r\n	<br />\r\n</div>', '', '', '', '0');
INSERT INTO `tp_weixin_article_page` VALUES ('7', '兑换说明', '1、奖品价格已经包含邮寄费用在内，您无须另行支付。兑奖前请确认您的帐户中有足够数量的积分！<br />\r\n2、奖品寄送方式：QQ直充类奖品兑奖审核通过后会直接充入您的QQ号码中，其余虚拟奖品采用在线发送卡密的方式；实体奖品全部采用快递方式。<br />\r\n3、虚拟奖品有效期：虚拟卡密类奖品除手机充值卡10/20/30元卡密，因为充值卡金额少，有效期比较短，大约一周左右,其余卡密类奖品有效期为1个月；虚拟卡直冲类为即时发货即时到账，无有效期限制！积分兑换含有有效期的奖品，请尽快充值使用，如过有效期未充值导致卡密失效，PinPHP网概不负责。<br />\r\n4、确认您的奖品邮寄地址、联系电话正确无误后提交兑奖申请！如因您未提供详细信息或信息错误，导致奖品错投或无法寄送，网站不负任何责任，并不再补发奖品。<br />\r\n5、实物奖品将在兑奖提交后的2-5工作日内发出(奖品状态您可通过“积分订单”查询)！<br />\r\n6、实物奖品按照会员申请的要求发出去之后，无破损、短缺等质量问题或因个人喜好（色泽、外观）要求退换货将无法受理。<br />\r\n7、兑奖中心所有实物奖品颜色均为随机发送, 敬请谅解！<br />\r\n<br />\r\n<strong>注意：</strong><br />\r\n<br />\r\n1、签收奖品前，务必仔细检查货物是否完好！如果发现有破损、短缺情况，请直接让快递公司退回，无需承担任何费用，并及时与我们联系。签收后提出货物破损等问题，一律责任自负！无法受理退换货要求！他人代签与本人签收一样。<br />\r\n2、收到奖品7天内，若发现质量问题，请及时与我们联系并提供图片说明。如因个人使用不当导致的奖品问题无法更换。<br />\r\n3、如提交兑奖后，由于商家缺货导致无法发货的情况，会员会收到站内信息通知并取消兑奖，请重新选择其他奖品兑换。<br />\r\n<br />\r\n兑奖过程中如有问题请通过“联系我们”联系咨询。<br />\r\n以上奖品图片仅供参考,请您以收取的实物为准！如有异议请联系客服人员确认奖品情况。<br />', '', '', '', '0');

-- ----------------------------
-- Table structure for `tp_weixin_auto_user`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_auto_user`;
CREATE TABLE `tp_weixin_auto_user` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `users` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_auto_user
-- ----------------------------
INSERT INTO `tp_weixin_auto_user` VALUES ('1', '商品采集采集', '熊小熊zz,安土桃山,晨雪熙,V小莲小莲V,Eudora_寻寻,Prickleman,泡芙小米粒,想太多妹子,跳房子123,彩色淘,设计系小女生,wingsa区,枕水而眠,咕咕是一只猫,起个名字太累');

-- ----------------------------
-- Table structure for `tp_weixin_badword`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_badword`;
CREATE TABLE `tp_weixin_badword` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1：禁用；2：替换；3：审核',
  `badword` varchar(100) NOT NULL,
  `replaceword` varchar(100) NOT NULL,
  `add_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_badword
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_brandlist`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_brandlist`;
CREATE TABLE `tp_weixin_brandlist` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_brandlist
-- ----------------------------
INSERT INTO `tp_weixin_brandlist` VALUES ('1', '释风行', '1', '0');
INSERT INTO `tp_weixin_brandlist` VALUES ('10', '彩彩美衣', '1', '0');

-- ----------------------------
-- Table structure for `tp_weixin_custom_menu`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_custom_menu`;
CREATE TABLE `tp_weixin_custom_menu` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `tags` varchar(50) NOT NULL,
  `pid` smallint(4) unsigned NOT NULL,
  `spid` varchar(50) NOT NULL,
  `fcolor` varchar(10) NOT NULL,
  `remark` text NOT NULL,
  `add_time` int(10) NOT NULL,
  `items` int(10) unsigned NOT NULL DEFAULT '0',
  `likes` int(10) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0:商品分类 1:标签分类',
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `status` tinyint(1) NOT NULL,
  `is_index` tinyint(1) NOT NULL DEFAULT '0',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键词',
  `key` varchar(255) DEFAULT NULL COMMENT 'key值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=377 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_custom_menu
-- ----------------------------
INSERT INTO `tp_weixin_custom_menu` VALUES ('343', '案例展示', '', '0', '0', '', '', '0', '0', '0', '0', '1', '1', '1', '0', 'alzs', 'alzs');
INSERT INTO `tp_weixin_custom_menu` VALUES ('344', '车联', '', '343', '343|', '', '', '0', '0', '0', '0', '1', '1', '1', '0', 'cl', 'cl');
INSERT INTO `tp_weixin_custom_menu` VALUES ('345', '餐饮', '', '343', '343|', '', '', '0', '0', '0', '0', '2', '1', '1', '0', 'cy', 'cy');
INSERT INTO `tp_weixin_custom_menu` VALUES ('346', '婚纱', '', '343', '343|', '', '', '0', '0', '0', '0', '3', '1', '1', '0', 'hs', 'hs');
INSERT INTO `tp_weixin_custom_menu` VALUES ('349', '微信商城', '', '343', '343|', '', '', '0', '0', '0', '0', '4', '1', '0', '0', 'gw', 'gw');
INSERT INTO `tp_weixin_custom_menu` VALUES ('359', '抽奖转盘', '', '358', '358|', '', '', '0', '0', '0', '0', '2', '1', '0', '0', 'ty', 'cjzp');
INSERT INTO `tp_weixin_custom_menu` VALUES ('358', '互动模块', '', '0', '0', '', '', '0', '0', '0', '0', '2', '1', '0', '0', 'hdmk', 'hdmk');
INSERT INTO `tp_weixin_custom_menu` VALUES ('360', '幸运机', '', '358', '358|', '', '', '0', '0', '0', '0', '3', '1', '0', '0', 'ty', 'xyj');
INSERT INTO `tp_weixin_custom_menu` VALUES ('361', '刮刮乐', '', '358', '358|', '', '', '0', '0', '0', '0', '1', '1', '0', '0', 'ty', 'ggl');
INSERT INTO `tp_weixin_custom_menu` VALUES ('373', '微团购', '', '371', '371|', '', '', '0', '0', '0', '0', '255', '1', '0', '0', 'ty', 'wtg');
INSERT INTO `tp_weixin_custom_menu` VALUES ('372', '微信会员卡', '', '371', '371|', '', '', '0', '0', '0', '0', '255', '1', '0', '0', 'ty', 'wxhyk');
INSERT INTO `tp_weixin_custom_menu` VALUES ('371', '会员模块', '', '0', '0', '', '', '0', '0', '0', '0', '3', '1', '0', '0', 'ty', 'hymk');
INSERT INTO `tp_weixin_custom_menu` VALUES ('370', '果蔬', '', '343', '343|', '', '', '0', '0', '0', '0', '255', '1', '0', '0', 'gs', 'gs');
INSERT INTO `tp_weixin_custom_menu` VALUES ('374', '微投票', '', '371', '371|', '', '', '0', '0', '0', '0', '255', '1', '0', '0', 'ty', 'wtp');

-- ----------------------------
-- Table structure for `tp_weixin_delivery`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_delivery`;
CREATE TABLE `tp_weixin_delivery` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_delivery
-- ----------------------------
INSERT INTO `tp_weixin_delivery` VALUES ('1', 'EMS', '1', '0');
INSERT INTO `tp_weixin_delivery` VALUES ('2', '中通速递', '1', '0');
INSERT INTO `tp_weixin_delivery` VALUES ('3', '圆通速递', '1', '0');
INSERT INTO `tp_weixin_delivery` VALUES ('4', '汇通快运', '1', '0');
INSERT INTO `tp_weixin_delivery` VALUES ('5', '申通快递', '1', '0');
INSERT INTO `tp_weixin_delivery` VALUES ('6', '韵达快运', '1', '0');
INSERT INTO `tp_weixin_delivery` VALUES ('7', '顺丰速运', '1', '0');

-- ----------------------------
-- Table structure for `tp_weixin_flink`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_flink`;
CREATE TABLE `tp_weixin_flink` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `cate_id` smallint(5) NOT NULL,
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_flink
-- ----------------------------
INSERT INTO `tp_weixin_flink` VALUES ('1', 'PinPHP', '', 'http://www.pinphp.com', '1', '0', '1');
INSERT INTO `tp_weixin_flink` VALUES ('2', '羽绒衣', '', 'http://www.yurongyi.com', '1', '0', '1');

-- ----------------------------
-- Table structure for `tp_weixin_flink_cate`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_flink_cate`;
CREATE TABLE `tp_weixin_flink_cate` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_flink_cate
-- ----------------------------
INSERT INTO `tp_weixin_flink_cate` VALUES ('1', '友情链接', '255', '1');

-- ----------------------------
-- Table structure for `tp_weixin_images`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_images`;
CREATE TABLE `tp_weixin_images` (
  `iid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `imgurl` varchar(300) NOT NULL,
  PRIMARY KEY (`iid`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_images
-- ----------------------------
INSERT INTO `tp_weixin_images` VALUES ('22', 'data/upload/keyword/1308/16/520dc84ee84b2.jpg');

-- ----------------------------
-- Table structure for `tp_weixin_ipban`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_ipban`;
CREATE TABLE `tp_weixin_ipban` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `expires_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_ipban
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_item`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_item`;
CREATE TABLE `tp_weixin_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` smallint(4) unsigned DEFAULT NULL,
  `orig_id` smallint(6) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `intro` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `rates` float(8,2) NOT NULL COMMENT '佣金比率xxx.xx%',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:商品,2:图片',
  `comments` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `cmt_taobao_time` int(10) unsigned NOT NULL DEFAULT '0',
  `add_time` int(10) NOT NULL,
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `info` text,
  `news` tinyint(4) DEFAULT '0',
  `tuijian` tinyint(4) DEFAULT '0',
  `goods_stock` int(11) DEFAULT '50' COMMENT '库存',
  `buy_num` int(11) DEFAULT '0' COMMENT '卖出数量',
  `brand` int(11) DEFAULT '1' COMMENT '品牌',
  `pingyou` decimal(10,2) DEFAULT '0.00',
  `kuaidi` decimal(10,2) DEFAULT '0.00',
  `ems` decimal(10,2) DEFAULT '0.00',
  `free` int(11) DEFAULT '1',
  `color` varchar(255) DEFAULT NULL COMMENT '颜色',
  `size` varchar(255) DEFAULT NULL COMMENT '尺寸',
  PRIMARY KEY (`id`),
  KEY `cid` (`cate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_item
-- ----------------------------
INSERT INTO `tp_weixin_item` VALUES ('124', '340', '0', 'CCCCCCCC', 'CCCCCCC', '1308/20/5212cf25287db.jpg', '1.00', '0.00', '1', '0', '0', '1376964389', '255', '1', '1111', '0', '0', '1', '0', '1', '0.00', '0.00', '0.00', '1', null, null);

-- ----------------------------
-- Table structure for `tp_weixin_item_attr`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_item_attr`;
CREATE TABLE `tp_weixin_item_attr` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_id` int(10) NOT NULL,
  `attr_name` varchar(50) NOT NULL,
  `attr_value` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_item_attr
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_item_cate`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_item_cate`;
CREATE TABLE `tp_weixin_item_cate` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `tags` varchar(50) NOT NULL,
  `pid` smallint(4) unsigned NOT NULL,
  `spid` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `fcolor` varchar(10) NOT NULL,
  `remark` text NOT NULL,
  `add_time` int(10) NOT NULL,
  `items` int(10) unsigned NOT NULL DEFAULT '0',
  `likes` int(10) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0:商品分类 1:标签分类',
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `status` tinyint(1) NOT NULL,
  `is_index` tinyint(1) NOT NULL DEFAULT '0',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `seo_title` varchar(255) NOT NULL,
  `seo_keys` varchar(255) NOT NULL,
  `seo_desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=341 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_item_cate
-- ----------------------------
INSERT INTO `tp_weixin_item_cate` VALUES ('340', '女装', '', '0', '0', '', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('3', '外套', '', '2', '1|2|', '50b2e01aea8b9_thumb.jpg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('4', '毛衣', '', '2', '1|2|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('5', 'T恤', '', '2', '1|2|', '50b2e02405c92_thumb.jpg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('6', '西装', '', '2', '1|2|', '50b2e02e0332f_thumb.jpg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('7', '风衣', '', '2', '1|2|', '50b2e03a38859_thumb.jpg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('8', '卫衣', '', '2', '1|2|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('9', '马甲', '', '2', '1|2|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('10', '牛仔裤', '', '2', '1|2|', '50b2e044c46ad_thumb.jpg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('11', '小脚裤', '', '2', '1|2|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('12', '哈伦裤', '', '2', '1|2|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('319', '黑色', '', '315', '1|315|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('318', '黄色', '', '315', '1|315|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('317', '绿色', '', '315', '1|315|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('316', '红色', '', '315', '1|315|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('17', '打底裤', '', '2', '1|2|', '50b2e06575aa1_thumb.jpg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('18', '五分裤', '', '2', '1|2|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('21', '蕾丝', '', '20', '1|20|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('22', '打底', '', '20', '1|20|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('23', '牛仔', '', '20', '1|20|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('24', '镂空', '', '20', '1|20|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('25', '拼接', '', '20', '1|20|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('26', '紧身', '', '20', '1|20|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('27', '格子', '', '20', '1|20|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('28', '水洗', '', '20', '1|20|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('29', '高腰', '', '20', '1|20|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('30', '磨旧', '', '20', '1|20|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('32', '宽松', '', '31', '1|31|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('33', '清新', '', '31', '1|31|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('34', '欧美', '', '31', '1|31|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('35', '韩系', '', '31', '1|31|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('36', '甜美', '', '31', '1|31|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('37', '复古', '', '31', '1|31|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('38', '简约', '', '31', '1|31|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('39', '英伦', '', '31', '1|31|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('41', '珊瑚绒', '', '40', '1|40|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('42', '莫代尔', '', '40', '1|40|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('43', '纯棉', '', '40', '1|40|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('44', '全棉', '', '40', '1|40|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('45', '毛呢', '', '40', '1|40|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('46', '牛仔', '', '40', '1|40|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('47', '针织', '', '40', '1|40|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('48', '毛绒', '', '40', '1|40|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('49', '雪纺', '', '40', '1|40|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('339', '鞋子', '', '336', '336|', '', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('52', '优雅', '', '51', '50|51|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('53', '朋克', '', '51', '50|51|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('54', '名媛', '', '51', '50|51|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('55', '复古', '', '51', '50|51|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('56', '甜美', '', '51', '50|51|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('57', '百搭', '', '51', '50|51|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('58', '欧美', '', '51', '50|51|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('59', '英伦', '', '51', '50|51|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('61', '细跟', '', '60', '50|60|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('62', '圆头', '', '60', '50|60|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('63', '铆钉', '', '60', '50|60|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('64', '豹纹', '', '60', '50|60|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('65', '防水台', '', '60', '50|60|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('66', '流苏', '', '60', '50|60|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('67', '粗跟', '', '60', '50|60|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('68', '尖头', '', '60', '50|60|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('69', '坡跟', '', '60', '50|60|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('70', '厚底', '', '60', '50|60|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('71', '系带', '', '60', '50|60|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('72', '撞色', '', '60', '50|60|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('74', '工装靴', '', '73', '50|73|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('75', '长靴', '', '73', '50|73|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('76', '复古鞋', '', '73', '50|73|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('77', '马靴', '', '73', '50|73|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('78', '布洛克鞋', '', '73', '50|73|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('79', '及裸靴', '', '73', '50|73|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('81', '豆豆鞋', '', '80', '50|80|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('82', '休闲鞋', '', '80', '50|80|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('83', '高帮鞋', '', '80', '50|80|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('84', '运动鞋', '', '80', '50|80|', '50b2e09aa9967_thumb.jpeg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('85', '帆布鞋', '', '80', '50|80|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('86', '松糕鞋', '', '80', '50|80|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('87', '厚底鞋', '', '80', '50|80|', '50b2e0a2e6b97_thumb.jpeg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('88', '雪地靴', '', '80', '50|80|', '50b2e0aabcb80_thumb.jpeg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('89', '家居鞋', '', '80', '50|80|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('91', '低跟鞋', '', '90', '50|90|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('92', '细跟鞋', '', '90', '50|90|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('93', '牛津鞋', '', '90', '50|90|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('94', '中跟鞋', '', '90', '50|90|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('95', '单鞋', '', '90', '50|90|', '50b2e07ae109c_thumb.jpeg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('96', '粗跟鞋', '', '90', '50|90|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('97', '坡跟鞋', '', '90', '50|90|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('98', '平底鞋', '', '90', '50|90|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('99', '马丁靴', '', '90', '50|90|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('100', '高跟鞋', '', '90', '50|90|', '50b2e086780ab_thumb.jpeg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('101', '短靴', '', '90', '50|90|', '50b2e091e2cec_thumb.jpeg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('104', '真皮', '', '103', '102|103|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('105', '金属', '', '103', '102|103|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('106', '透明', '', '103', '102|103|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('107', '棉麻', '', '103', '102|103|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('108', '羊皮', '', '103', '102|103|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('109', 'PU', '', '103', '102|103|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('110', '帆布', '', '103', '102|103|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('111', '牛皮', '', '103', '102|103|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('113', '代购', '', '112', '102|112|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('338', '裤子', '', '336', '336|', '', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('337', 't恤', '', '336', '336|', '', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('117', '铆钉', '', '112', '102|112|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('118', '豹纹', '', '112', '102|112|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('119', '菱形格', '', '112', '102|112|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('120', '甜美', '', '112', '102|112|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('121', '复古', '', '112', '102|112|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('122', '外贸', '', '112', '102|112|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('123', '链条', '', '112', '102|112|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('127', '马鞍包', '', '125', '102|125|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('128', '相机包', '', '125', '102|125|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('130', '信封包', '', '125', '102|125|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('132', '剑桥包', '', '125', '102|125|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('133', '医生包', '', '125', '102|125|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('135', '笑脸包', '', '125', '102|125|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('137', '波士顿包', '', '125', '102|125|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('139', '邮差包', '', '125', '102|125|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('140', '机车包', '', '125', '102|125|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('141', '行李箱', '', '125', '102|125|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('143', '水桶包', '', '125', '102|125|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('145', '手提包', '', '125', '102|125|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('148', '帆布包', '', '126', '102|126|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('150', '链条包', '', '126', '102|126|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('151', '复古包', '', '126', '102|126|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('152', '手拿包', '', '126', '102|126|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('154', '斜挎包', '', '126', '102|126|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('156', '大包', '', '126', '102|126|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('158', '钱包', '', '126', '102|126|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('160', '双肩包', '', '126', '102|126|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('161', '单肩包', '', '126', '102|126|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('163', '花朵', '', '129', '114|129|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('164', '玉', '', '129', '114|129|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('165', '24K金', '', '129', '114|129|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('166', '水晶', '', '129', '114|129|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('167', '玫瑰金', '', '129', '114|129|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('168', '银饰', '', '129', '114|129|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('169', '印花', '', '129', '114|129|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('170', '哥特', '', '131', '114|131|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('171', '欧美', '', '131', '114|131|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('172', '韩系', '', '131', '114|131|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('173', '英伦', '', '131', '114|131|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('174', '个性', '', '131', '114|131|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('175', '甜美', '', '131', '114|131|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('176', '朋克', '', '131', '114|131|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('177', '复古', '', '131', '114|131|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('178', '袜套', '', '134', '114|134|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('179', '电子表', '', '134', '114|134|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('180', '发带', '', '134', '114|134|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('181', '礼帽', '', '134', '114|134|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('182', '锁骨链', '', '134', '114|134|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('183', '鸭舌帽', '', '134', '114|134|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('184', '贝雷帽', '', '134', '114|134|', '50b2dc6c73cb4_thumb.jpeg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('185', '假领', '', '134', '114|134|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('186', '发饰', '', '134', '114|134|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('187', '脚链', '', '136', '114|136|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('188', '腰链', '', '136', '114|136|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('189', '手镯', '', '136', '114|136|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('190', '手链', '', '136', '114|136|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('191', '耳环', '', '136', '114|136|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('192', '戒指', '', '136', '114|136|', '50b2dc7deb82f_thumb.jpeg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('193', '耳钉', '', '136', '114|136|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('194', '项链', '', '136', '114|136|', '50b2dc8787567_thumb.jpeg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('195', '墨镜', '', '138', '114|138|', '50b2dcb8b134a_thumb.jpeg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('196', '钥匙链', '', '138', '114|138|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('197', '腰带', '', '138', '114|138|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('198', '手套', '', '138', '114|138|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('199', '头花', '', '138', '114|138|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('200', '毛衣链', '', '138', '114|138|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('201', '瘦腿袜', '', '138', '114|138|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('202', '发箍', '', '138', '114|138|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('203', '手表', '', '138', '114|138|', '50b2dc974a19b_thumb.jpeg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('204', '帽子', '', '138', '114|138|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('205', '围巾', '', '138', '114|138|', '50b2dca7045fc_thumb.jpeg', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('206', '储物罐', '', '142', '115|142|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('207', '烹饪', '', '142', '115|142|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('208', '烘焙', '', '142', '115|142|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('209', '锅具', '', '142', '115|142|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('210', '饭盒', '', '142', '115|142|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('211', '筷子', '', '142', '115|142|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('212', '勺', '', '142', '115|142|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('213', '茶具', '', '142', '115|142|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('214', '水壶', '', '142', '115|142|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('215', '盘碟', '', '142', '115|142|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('216', '调味瓶', '', '142', '115|142|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('217', '餐巾', '', '142', '115|142|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('218', '餐垫', '', '142', '115|142|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('219', '床上用品', '', '144', '115|144|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('220', '梳妆', '', '144', '115|144|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('221', '家居鞋', '', '144', '115|144|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('222', '窗帘', '', '144', '115|144|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('223', '斗柜', '', '144', '115|144|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('224', '衣柜', '', '144', '115|144|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('225', '床头柜', '', '144', '115|144|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('226', '床', '', '144', '115|144|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('227', '茶几', '', '146', '115|146|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('228', '搁板', '', '146', '115|146|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('229', '电视柜', '', '146', '115|146|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('230', '椅子', '', '146', '115|146|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('231', '桌子', '', '146', '115|146|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('232', '坐垫', '', '146', '115|146|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('233', '沙发垫', '', '146', '115|146|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('234', '照片墙', '', '146', '115|146|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('235', '沙发', '', '146', '115|146|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('236', '相框', '', '146', '115|146|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('237', '收纳', '', '147', '115|147|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('238', '台灯', '', '147', '115|147|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('239', '时钟', '', '147', '115|147|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('240', '吊灯', '', '147', '115|147|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('241', '吸顶灯', '', '147', '115|147|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('242', '杯子', '', '147', '115|147|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('243', '置物架', '', '147', '115|147|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('244', '香薰', '', '147', '115|147|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('245', '地毯', '', '147', '115|147|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('246', '落地灯', '', '147', '115|147|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('247', '桌布', '', '147', '115|147|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('248', '摆件', '', '147', '115|147|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('249', '墙贴', '', '147', '115|147|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('250', '烛台', '', '147', '115|147|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('251', '书柜', '', '147', '115|147|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('252', '挂钩', '', '149', '115|149|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('253', '马桶刷', '', '149', '115|149|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('254', '衣架', '', '149', '115|149|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('255', '皂盒', '', '149', '115|149|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('256', '浴室垫', '', '149', '115|149|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('257', '浴室套件', '', '149', '115|149|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('258', '浴帘', '', '149', '115|149|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('259', '毛巾', '', '149', '115|149|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('260', '补水', '', '153', '116|153|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('261', '控油', '', '153', '116|153|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('262', '美白', '', '153', '116|153|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('263', '遮瑕', '', '153', '116|153|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('264', '去角质', '', '153', '116|153|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('265', '祛痘', '', '153', '116|153|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('266', '保湿', '', '153', '116|153|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('267', '洁面', '', '153', '116|153|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('268', '去黑头', '', '153', '116|153|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('269', '收毛孔', '', '153', '116|153|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('270', '去眼袋', '', '153', '116|153|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('271', '倩碧', '', '155', '116|155|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('272', '雅漾', '', '155', '116|155|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('273', '资生堂', '', '155', '116|155|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('274', '娇韵诗', '', '155', '116|155|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('275', '欧舒丹', '', '155', '116|155|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('276', '兰蔻', '', '155', '116|155|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('277', '水宝宝', '', '155', '116|155|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('278', '雅诗兰黛', '', '155', '116|155|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('279', '丝芙兰', '', '155', '116|155|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('280', '露得清', '', '155', '116|155|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('281', '染发膏', '', '157', '116|157|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('282', '蓬蓬粉', '', '157', '116|157|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('283', '发膜', '', '157', '116|157|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('284', '弹力素', '', '157', '116|157|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('285', '发蜡', '', '157', '116|157|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('286', '假发', '', '157', '116|157|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('287', '护手霜', '', '157', '116|157|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('288', '身体乳', '', '157', '116|157|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('289', '美颈霜', '', '157', '116|157|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('290', '沐浴露', '', '157', '116|157|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('291', '手工皂', '', '157', '116|157|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('292', '眼线膏', '', '159', '116|159|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('293', '唇彩', '', '159', '116|159|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('294', '眉笔', '', '159', '116|159|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('295', '眼影', '', '159', '116|159|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('296', '腮红', '', '159', '116|159|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('297', '口红', '', '159', '116|159|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('298', '蜜粉', '', '159', '116|159|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('299', '粉饼', '', '159', '116|159|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('300', 'BB霜', '', '159', '116|159|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('301', '睫毛膏', '', '159', '116|159|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('302', '指甲油', '', '159', '116|159|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('303', '香水', '', '159', '116|159|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('304', '药妆', '', '162', '116|162|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('305', '吸油面纸', '', '162', '116|162|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('306', '隔离霜', '', '162', '116|162|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('307', '精油', '', '162', '116|162|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('308', '爽肤水', '', '162', '116|162|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('309', '眼霜', '', '162', '116|162|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('310', '面膜', '', '162', '116|162|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('311', '洗面奶', '', '162', '116|162|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('312', '卸妆油', '', '162', '116|162|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('313', '喷雾', '', '162', '116|162|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('314', '防晒霜', '', '162', '116|162|', '', '', '', '0', '0', '0', '0', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('320', '粉色', '', '315', '1|315|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('321', '紫色', '', '315', '1|315|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('322', '白色', '', '315', '1|315|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('323', '蓝色', '', '315', '1|315|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('336', '男装', '', '0', '0', '', '', '', '0', '0', '0', '0', '255', '1', '1', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('325', '红色', '', '324', '102|324|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('326', '黑色', '', '324', '102|324|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('327', '蓝色', '', '324', '102|324|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('328', '绿色', '', '324', '102|324|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('329', '紫色', '', '324', '102|324|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('330', '白色', '', '324', '102|324|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('331', '粉色', '', '324', '102|324|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');
INSERT INTO `tp_weixin_item_cate` VALUES ('332', '黄色', '', '324', '102|324|', '', '', '', '0', '0', '0', '1', '255', '1', '0', '0', '', '', '');

-- ----------------------------
-- Table structure for `tp_weixin_item_cate_tag`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_item_cate_tag`;
CREATE TABLE `tp_weixin_item_cate_tag` (
  `cate_id` smallint(4) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `weight` tinyint(3) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `cate_id` (`cate_id`,`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_item_cate_tag
-- ----------------------------
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('3', '1', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('4', '2', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('5', '3', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('6', '4', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('7', '5', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('8', '6', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('9', '7', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('10', '8', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('11', '9', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('12', '10', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('17', '11', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('18', '12', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('21', '13', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('23', '14', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('22', '15', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('24', '16', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('25', '17', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('26', '18', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('27', '19', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('28', '20', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('29', '21', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('30', '22', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('32', '23', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('33', '24', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('34', '25', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('35', '26', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('36', '27', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('37', '28', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('38', '29', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('39', '30', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('41', '31', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('42', '32', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('43', '33', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('44', '34', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('45', '35', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('46', '14', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('47', '36', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('48', '37', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('49', '38', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('319', '39', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('318', '40', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('317', '41', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('316', '42', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('320', '43', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('321', '44', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('322', '45', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('323', '46', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('91', '96', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('92', '97', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('93', '98', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('94', '99', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('281', '100', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('95', '101', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('282', '102', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('283', '103', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('96', '104', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('284', '105', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('97', '106', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('285', '107', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('98', '108', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('99', '109', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('286', '110', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('100', '111', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('287', '112', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('101', '113', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('288', '114', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('289', '115', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('290', '116', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('291', '117', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('292', '118', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('293', '119', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('294', '120', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('295', '121', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('296', '122', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('297', '123', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('298', '124', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('299', '125', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('300', '126', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('301', '127', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('302', '128', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('303', '129', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('304', '130', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('305', '131', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('306', '132', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('307', '133', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('308', '134', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('309', '135', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('310', '136', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('219', '137', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('311', '138', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('312', '139', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('313', '140', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('314', '141', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('260', '142', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('261', '143', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('262', '144', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('263', '145', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('264', '146', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('265', '147', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('266', '148', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('267', '149', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('268', '150', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('269', '151', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('270', '152', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('271', '153', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('272', '154', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('273', '155', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('274', '156', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('275', '157', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('276', '158', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('277', '159', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('278', '160', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('279', '161', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('280', '162', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('237', '163', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('238', '164', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('239', '165', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('240', '166', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('241', '167', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('242', '168', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('243', '169', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('244', '170', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('245', '171', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('246', '172', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('247', '173', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('248', '174', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('249', '175', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('250', '176', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('251', '177', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('206', '178', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('207', '179', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('208', '180', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('209', '181', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('210', '182', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('211', '183', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('212', '184', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('213', '185', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('214', '186', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('215', '187', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('216', '188', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('217', '189', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('218', '190', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('220', '191', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('221', '192', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('222', '193', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('223', '194', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('224', '195', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('225', '196', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('226', '196', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('226', '137', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('227', '197', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('228', '198', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('229', '199', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('230', '200', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('231', '201', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('232', '202', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('233', '203', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('234', '204', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('236', '205', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('235', '206', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('252', '207', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('253', '208', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('254', '209', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('255', '210', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('256', '211', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('257', '212', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('258', '213', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('259', '214', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('178', '215', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('179', '216', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('180', '267', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('181', '268', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('182', '269', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('183', '270', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('184', '271', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('185', '289', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('186', '290', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('187', '291', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('188', '292', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('189', '293', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('190', '294', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('191', '295', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('192', '296', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('193', '297', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('194', '330', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('195', '336', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('196', '337', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('197', '338', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('198', '339', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('199', '340', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('200', '341', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('201', '342', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('202', '343', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('203', '344', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('204', '345', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('205', '346', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('170', '347', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('171', '25', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('172', '26', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('173', '30', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('174', '348', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('175', '27', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('176', '349', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('177', '259', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('177', '28', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('163', '350', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('164', '351', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('165', '352', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('166', '353', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('167', '354', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('168', '355', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('169', '314', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('127', '356', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('128', '357', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('130', '358', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('132', '359', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('81', '360', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('82', '301', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('83', '323', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('84', '361', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('85', '300', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('86', '318', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('87', '362', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('88', '332', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('89', '192', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('74', '363', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('75', '364', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('76', '365', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('77', '366', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('78', '367', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('79', '368', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('61', '97', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('61', '369', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('62', '370', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('63', '371', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('64', '372', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('316', '373', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('316', '374', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('316', '375', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('65', '376', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('65', '377', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('66', '378', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('67', '379', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('68', '380', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('69', '381', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('70', '382', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('71', '308', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('72', '383', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('52', '384', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('53', '349', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('54', '385', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('55', '28', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('56', '27', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('57', '386', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('58', '25', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('59', '30', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('133', '387', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('135', '388', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('137', '389', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('139', '390', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('140', '246', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('141', '391', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('143', '392', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('145', '241', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('148', '393', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('150', '394', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('151', '259', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('152', '395', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('154', '237', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('156', '238', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('158', '396', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('160', '397', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('161', '218', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('113', '398', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('117', '371', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('118', '372', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('119', '399', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('119', '400', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('120', '27', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('121', '28', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('122', '401', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('123', '233', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('104', '220', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('105', '402', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('106', '403', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('107', '404', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('108', '405', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('109', '406', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('110', '302', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('111', '223', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('325', '42', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('325', '374', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('325', '375', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('326', '39', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('326', '407', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('327', '46', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('327', '408', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('327', '409', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('327', '410', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('327', '411', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('328', '41', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('328', '412', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('328', '413', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('328', '414', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('329', '44', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('329', '415', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('330', '45', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('330', '416', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('331', '43', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('331', '373', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('332', '40', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('332', '417', '0');
INSERT INTO `tp_weixin_item_cate_tag` VALUES ('332', '418', '0');

-- ----------------------------
-- Table structure for `tp_weixin_item_comment`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_item_comment`;
CREATE TABLE `tp_weixin_item_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `uname` varchar(20) NOT NULL,
  `info` text NOT NULL,
  `add_time` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_item_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_item_img`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_item_img`;
CREATE TABLE `tp_weixin_item_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `add_time` int(10) NOT NULL DEFAULT '0',
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=515 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_item_img
-- ----------------------------
INSERT INTO `tp_weixin_item_img` VALUES ('514', '124', '1308/20/5212cf25287db.jpg', '1376964389', '255', '1');

-- ----------------------------
-- Table structure for `tp_weixin_item_like`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_item_like`;
CREATE TABLE `tp_weixin_item_like` (
  `item_id` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `add_time` int(10) NOT NULL,
  PRIMARY KEY (`item_id`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_item_like
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_item_order`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_item_order`;
CREATE TABLE `tp_weixin_item_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` varchar(50) NOT NULL COMMENT '订单号',
  `add_time` int(11) DEFAULT NULL COMMENT '下单时间',
  `goods_sumPrice` decimal(10,2) NOT NULL COMMENT '商品总额',
  `order_sumPrice` decimal(10,2) NOT NULL COMMENT '订单总额',
  `note` text CHARACTER SET utf8 COMMENT '客服备注',
  `userId` int(11) NOT NULL COMMENT '用户ID',
  `userName` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '用户名',
  `address_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '收货人',
  `mobile` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT '联系手机',
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '收货地址',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '订单状态 1:待付款 2：待发货  3:待收货 4:完成 5:关闭',
  `supportmetho` tinyint(5) DEFAULT NULL COMMENT '支付方式 1:支付宝 2:货到付款',
  `freetype` int(11) DEFAULT NULL COMMENT '用户快递方式  1:平邮 2:快递 3:ems 0:卖家包邮',
  `freeprice` decimal(10,2) DEFAULT '0.00' COMMENT '快递费用',
  `closemsg` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '关闭原因',
  `support_time` int(11) DEFAULT NULL COMMENT '支付时间',
  `sellerRemark` text CHARACTER SET utf8 COMMENT '客服备注',
  `userfree` varchar(50) CHARACTER SET utf8 DEFAULT '' COMMENT '给用户配送快递方式 0:无需快递',
  `freecode` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '快递编号',
  `fahuoaddress` int(11) DEFAULT NULL COMMENT '发货地址',
  `fahuo_time` int(11) DEFAULT NULL COMMENT '发货时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tp_weixin_item_order
-- ----------------------------
INSERT INTO `tp_weixin_item_order` VALUES ('4', '201308071958511781', '1375876731', '159.00', '159.00', null, '1', 'dan8288749', '周建群', '15880765056', '福建省厦门市思明区金沙花园', '2', '2', '0', '0.00', null, '1375876749', null, '', null, null, null);
INSERT INTO `tp_weixin_item_order` VALUES ('5', '201308081502021656', '1375945322', '20.00', '20.00', null, '1', 'dan8288749', '周建群', '15880765056', '福建省厦门市思明区金沙花园', '1', null, '0', '0.00', null, null, null, '', null, null, null);

-- ----------------------------
-- Table structure for `tp_weixin_item_orig`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_item_orig`;
CREATE TABLE `tp_weixin_item_orig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_item_orig
-- ----------------------------
INSERT INTO `tp_weixin_item_orig` VALUES ('1', '50b2e721a6c1e_thumb.jpg', '淘宝', 'taobao.com', '0');
INSERT INTO `tp_weixin_item_orig` VALUES ('2', '50b2e726d4ade_thumb.jpg', '天猫', 'tmall.com', '0');

-- ----------------------------
-- Table structure for `tp_weixin_item_site`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_item_site`;
CREATE TABLE `tp_weixin_item_site` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `config` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_item_site
-- ----------------------------
INSERT INTO `tp_weixin_item_site` VALUES ('5', 'taobao', '淘宝', 'taobao.com,tianmao.com,tmall.com', 'http://www.taobao.com', '通过淘宝开放平台获取商品数据，可到 http://open.taobao.com/ 查看详细', 'a:2:{s:7:\"app_key\";s:8:\"21342572\";s:10:\"app_secret\";s:32:\"1f3beed14c1b6f0b42416e4ee5add418\";}', 'PinPHP TEAM', '255', '1');

-- ----------------------------
-- Table structure for `tp_weixin_item_tag`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_item_tag`;
CREATE TABLE `tp_weixin_item_tag` (
  `item_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `item_id` (`item_id`,`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_item_tag
-- ----------------------------
INSERT INTO `tp_weixin_item_tag` VALUES ('124', '530');

-- ----------------------------
-- Table structure for `tp_weixin_keyword`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_keyword`;
CREATE TABLE `tp_weixin_keyword` (
  `kid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kename` varchar(300) DEFAULT NULL,
  `kecontent` varchar(500) DEFAULT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1:文本 2：图文',
  `kyword` varchar(255) DEFAULT NULL,
  `titles` varchar(1000) DEFAULT NULL,
  `imageinfo` varchar(1000) DEFAULT NULL,
  `linkinfo` varchar(1000) DEFAULT NULL,
  `ismess` tinyint(1) DEFAULT NULL,
  `isfollow` tinyint(1) DEFAULT NULL,
  `iskey` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`kid`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_keyword
-- ----------------------------
INSERT INTO `tp_weixin_keyword` VALUES ('56', '欢迎来到乐谷户外', 'hehe', '1', '欢迎来到乐谷户外', null, null, null, null, '1', null);
INSERT INTO `tp_weixin_keyword` VALUES ('91', '123', '', '2', '123', 'a:1:{i:0;s:3:\"ccc\";}', 'a:1:{i:0;s:45:\"data/upload/keyword/1308/16/520dc84ee84b2.jpg\";}', 'a:1:{i:0;s:20:\"http://www.baidu.com\";}', null, null, '1');
INSERT INTO `tp_weixin_keyword` VALUES ('88', '回复', '来到<a href=\"http://www.baidu.com\">乐谷户外</a>', '1', '回复', null, null, null, '1', null, null);

-- ----------------------------
-- Table structure for `tp_weixin_mail_queue`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_mail_queue`;
CREATE TABLE `tp_weixin_mail_queue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mail_to` varchar(120) NOT NULL,
  `mail_subject` varchar(255) NOT NULL,
  `mail_body` text NOT NULL,
  `priority` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `err_num` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `add_time` int(10) unsigned NOT NULL,
  `lock_expiry` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_mail_queue
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_menu`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_menu`;
CREATE TABLE `tp_weixin_menu` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `pid` smallint(6) NOT NULL,
  `module_name` varchar(20) NOT NULL,
  `action_name` varchar(20) NOT NULL,
  `data` varchar(120) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `often` tinyint(1) NOT NULL DEFAULT '0',
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `display` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=309 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_menu
-- ----------------------------
INSERT INTO `tp_weixin_menu` VALUES ('1', '全局', '0', 'setting', 'index', '', '', '0', '7', '0');
INSERT INTO `tp_weixin_menu` VALUES ('2', '核心设置', '1', 'setting', 'index', '', '', '0', '0', '1');
INSERT INTO `tp_weixin_menu` VALUES ('3', '全局参数', '148', 'setting', 'index', '&type=site', '', '0', '2', '1');
INSERT INTO `tp_weixin_menu` VALUES ('4', '邮件设置', '148', 'setting', 'index', '&type=mail', '', '0', '5', '1');
INSERT INTO `tp_weixin_menu` VALUES ('172', '专辑管理', '285', 'album', 'index', '', '', '0', '4', '1');
INSERT INTO `tp_weixin_menu` VALUES ('6', '菜单管理', '2', 'menu', 'index', '', '', '0', '7', '1');
INSERT INTO `tp_weixin_menu` VALUES ('7', '新增', '6', 'menu', 'add', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('8', '编辑', '6', 'menu', 'edit', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('9', '删除', '6', 'menu', 'delete', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('10', '运营', '0', 'operate', 'index', '', '', '0', '4', '0');
INSERT INTO `tp_weixin_menu` VALUES ('11', '广告管理', '10', 'advert', 'index', '', '', '0', '2', '1');
INSERT INTO `tp_weixin_menu` VALUES ('12', '广告管理', '11', 'ad', 'index', '', '', '5', '0', '1');
INSERT INTO `tp_weixin_menu` VALUES ('13', '广告位管理', '11', 'adboard', 'index', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('14', '友情链接', '10', 'flink', 'index', '', '', '0', '3', '0');
INSERT INTO `tp_weixin_menu` VALUES ('15', '友情链接', '14', 'flink', 'index', '', '', '0', '0', '1');
INSERT INTO `tp_weixin_menu` VALUES ('16', '链接分类', '14', 'flink_cate', 'index', '', '', '0', '0', '1');
INSERT INTO `tp_weixin_menu` VALUES ('17', '新增', '15', 'flink', 'add', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('18', '编辑', '15', 'flink', 'edit', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('19', '删除', '15', 'flink', 'delete', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('20', '新增', '16', 'flink_cate', 'add', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('21', '编辑', '16', 'flink_cate', 'edit', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('22', '删除', '16', 'flink_cate', 'del', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('23', '新增', '12', 'ad', 'add', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('24', '编辑', '12', 'ad', 'edit', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('25', '删除', '12', 'ad', 'delete', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('26', '新增', '13', 'adboard', 'add', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('27', '编辑', '13', 'adboard', 'edit', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('28', '删除', '13', 'adboard', 'delete', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('29', '数据', '0', 'data', 'index', '', '', '0', '5', '0');
INSERT INTO `tp_weixin_menu` VALUES ('258', '商品分类', '256', 'score_item_cate', 'index', '', '', '0', '255', '1');
INSERT INTO `tp_weixin_menu` VALUES ('31', '数据库管理', '29', 'backup', 'index', '', '', '0', '2', '1');
INSERT INTO `tp_weixin_menu` VALUES ('32', '数据备份', '31', 'backup', 'index', '', '', '0', '0', '1');
INSERT INTO `tp_weixin_menu` VALUES ('33', '数据恢复', '31', 'backup', 'restore', '', '', '0', '0', '1');
INSERT INTO `tp_weixin_menu` VALUES ('34', '缓存管理', '254', 'cache', 'index', '', '', '0', '0', '1');
INSERT INTO `tp_weixin_menu` VALUES ('195', '登陆接口', '245', 'oauth', 'index', '', '', '0', '2', '0');
INSERT INTO `tp_weixin_menu` VALUES ('36', '黑名单管理', '117', 'ipban', 'index', '', '', '0', '3', '0');
INSERT INTO `tp_weixin_menu` VALUES ('37', '新增', '36', 'ipban', 'add', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('38', '编辑', '36', 'ipban', 'edit', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('50', '商品', '0', 'content', 'index', '', '', '0', '1', '0');
INSERT INTO `tp_weixin_menu` VALUES ('51', '商品管理', '50', 'article', 'index', '', '', '0', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('52', '商品管理', '51', 'item', 'index', '', '', '1', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('54', '编辑', '52', 'article', 'edit', '', '', '0', '3', '0');
INSERT INTO `tp_weixin_menu` VALUES ('190', '删除', '52', 'item', 'delete', '', '', '0', '4', '0');
INSERT INTO `tp_weixin_menu` VALUES ('56', '商品分类', '51', 'item_cate', 'index', '', '', '1', '6', '1');
INSERT INTO `tp_weixin_menu` VALUES ('57', '新增', '56', 'article_cate', 'add', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('58', '编辑', '56', 'article_cate', 'edit', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('59', '删除', '56', 'article_cate', 'delete', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('60', '管理员管理', '1', 'admin', 'index', '', '', '0', '4', '1');
INSERT INTO `tp_weixin_menu` VALUES ('61', '管理员管理', '60', 'admin', 'index', '', '', '7', '0', '1');
INSERT INTO `tp_weixin_menu` VALUES ('62', '新增', '61', 'admin', 'add', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('63', '编辑', '61', 'admin', 'edit', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('64', '删除', '61', 'admin', 'delete', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('65', '角色管理', '60', 'admin_role', 'index', '', '', '7', '0', '1');
INSERT INTO `tp_weixin_menu` VALUES ('66', '新增', '65', 'admin_role', 'add', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('192', '淘宝采集', '164', 'collect_alimama', 'index', '', '', '0', '0', '1');
INSERT INTO `tp_weixin_menu` VALUES ('70', '用户', '0', 'user', 'index', '', '', '0', '3', '0');
INSERT INTO `tp_weixin_menu` VALUES ('119', '新增', '149', 'user', 'add', '', '', '0', '3', '0');
INSERT INTO `tp_weixin_menu` VALUES ('118', '编辑', '149', 'user', 'edit', '', '', '0', '4', '0');
INSERT INTO `tp_weixin_menu` VALUES ('117', '会员管理', '70', 'user', 'index', '', '', '0', '0', '1');
INSERT INTO `tp_weixin_menu` VALUES ('156', '文章分类', '154', 'article_cate', 'index', '', '', '0', '3', '1');
INSERT INTO `tp_weixin_menu` VALUES ('151', '导航设置', '216', 'nav', 'index', '', '', '0', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('149', '会员管理', '117', 'user', 'index', '', '', '0', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('150', '删除', '149', 'user', 'delete', '', '', '0', '5', '0');
INSERT INTO `tp_weixin_menu` VALUES ('152', '主导航', '151', 'nav', 'index', '&type=main', '', '0', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('153', '底部导航', '151', 'nav', 'index', '&type=bottom', '', '0', '2', '1');
INSERT INTO `tp_weixin_menu` VALUES ('154', '文章管理', '10', 'article', 'index', '', '', '0', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('155', '文章管理', '154', 'article', 'index', '', '', '0', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('148', '站点设置', '2', 'setting', 'index', '', '', '0', '0', '1');
INSERT INTO `tp_weixin_menu` VALUES ('157', '添加文章', '155', 'article', 'add', '', '', '0', '2', '1');
INSERT INTO `tp_weixin_menu` VALUES ('158', '编辑', '155', 'article', 'edit', '', '', '0', '3', '0');
INSERT INTO `tp_weixin_menu` VALUES ('159', '删除', '155', 'article', 'delete', '', '', '0', '4', '0');
INSERT INTO `tp_weixin_menu` VALUES ('160', '新增', '156', 'article_cate', 'add', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('161', '编辑', '156', 'article_cate', '编辑', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('162', '删除', '156', 'article_cate', 'delete', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('164', '商品采集', '50', 'item_collect', 'index', '', '', '0', '2', '0');
INSERT INTO `tp_weixin_menu` VALUES ('173', '专辑管理', '172', 'album', 'index', '', '', '0', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('174', '专辑分类', '172', 'album_cate', 'index', '', '', '0', '3', '1');
INSERT INTO `tp_weixin_menu` VALUES ('175', '新增', '174', 'album_cate', 'add', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('176', '编辑', '174', 'album_cate', 'edit', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('177', '删除', '174', 'album_cate', 'delete', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('178', '敏感词管理', '254', 'badword', 'index', '', '', '0', '4', '1');
INSERT INTO `tp_weixin_menu` VALUES ('179', '新增', '178', 'badword', 'add', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('180', '编辑', '178', 'badword', 'edit', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('181', '删除', '36', 'ipban', 'delete', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('182', '删除', '178', 'badword', 'delete', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('255', '采集马甲', '117', 'auto_user', 'index', '', '', '0', '2', '0');
INSERT INTO `tp_weixin_menu` VALUES ('184', '标签管理', '254', 'tag', 'index', '', '', '0', '3', '1');
INSERT INTO `tp_weixin_menu` VALUES ('185', '商品接口', '245', 'item_site', 'index', '', '', '0', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('186', '商品评论', '51', 'item_comment', 'index', '', '', '0', '7', '0');
INSERT INTO `tp_weixin_menu` VALUES ('187', '删除', '186', 'item_comment', 'delete', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('265', '删除', '257', 'score_item', 'edit', '', '', '0', '4', '0');
INSERT INTO `tp_weixin_menu` VALUES ('250', '一键删除', '51', 'item', 'delete_search', '', '', '0', '5', '1');
INSERT INTO `tp_weixin_menu` VALUES ('198', '新增', '196', 'message', 'add', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('199', '商品来源', '51', 'item_orig', 'index', '', '', '0', '6', '0');
INSERT INTO `tp_weixin_menu` VALUES ('200', '新增', '199', 'item_orig', 'add', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('201', '编辑', '199', 'item_orig', 'edit', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('202', '删除', '199', 'item_orig', 'delete', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('203', '商品审核', '51', 'item', 'check', '', '', '0', '5', '0');
INSERT INTO `tp_weixin_menu` VALUES ('249', '添加商品', '51', 'item', 'add', '', '', '1', '3', '1');
INSERT INTO `tp_weixin_menu` VALUES ('259', '新增', '258', 'score_item_cate', 'add', '', '', '0', '255', '0');
INSERT INTO `tp_weixin_menu` VALUES ('268', '批量添加', '164', 'collect_batch', 'index', '', '', '0', '255', '0');
INSERT INTO `tp_weixin_menu` VALUES ('269', '积分设置', '2', 'score', 'setting', '', '', '0', '3', '0');
INSERT INTO `tp_weixin_menu` VALUES ('210', '专辑审核', '172', 'album', 'check', '', '', '0', '2', '1');
INSERT INTO `tp_weixin_menu` VALUES ('257', '积分商品', '256', 'score_item', 'index', '', '', '0', '255', '1');
INSERT INTO `tp_weixin_menu` VALUES ('212', '日志管理', '29', 'log', 'index', '', '', '0', '3', '0');
INSERT INTO `tp_weixin_menu` VALUES ('213', '管理员日志', '212', 'log', 'index', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('214', '用户日志', '212', 'log', 'user', '', '', '0', '0', '1');
INSERT INTO `tp_weixin_menu` VALUES ('215', '积分日志', '212', 'log', 'score', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('216', '界面设置', '1', 'setting', 'index', '&type=show', '', '0', '2', '0');
INSERT INTO `tp_weixin_menu` VALUES ('256', '积分商城', '70', 'score_item', 'index', '', '', '0', '255', '0');
INSERT INTO `tp_weixin_menu` VALUES ('254', '系统数据', '29', 'tag', 'index', '', '', '0', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('264', '编辑', '257', 'score_item', 'edit', '', '', '0', '3', '0');
INSERT INTO `tp_weixin_menu` VALUES ('263', '添加商品', '257', 'score_item', 'add', '', '', '0', '2', '1');
INSERT INTO `tp_weixin_menu` VALUES ('262', '积分订单', '256', 'score_order', 'index', '', '', '0', '255', '1');
INSERT INTO `tp_weixin_menu` VALUES ('261', '删除', '258', 'score_item_cate', 'delete', '', '', '0', '255', '0');
INSERT INTO `tp_weixin_menu` VALUES ('260', '编辑', '258', 'score_item_cate', 'edit', '', '', '0', '255', '0');
INSERT INTO `tp_weixin_menu` VALUES ('232', '站内信管理', '70', 'message', 'index', '', '', '0', '0', '0');
INSERT INTO `tp_weixin_menu` VALUES ('233', '系统通知', '232', 'message', 'index', '&type=1', '', '0', '0', '1');
INSERT INTO `tp_weixin_menu` VALUES ('234', '用户私信', '232', 'message', 'index', '&type=2', '', '0', '0', '1');
INSERT INTO `tp_weixin_menu` VALUES ('235', '通知模版', '2', 'message_tpl', 'index', '&type=msg', '', '0', '4', '0');
INSERT INTO `tp_weixin_menu` VALUES ('236', '添加模版', '235', 'message_tpl', 'add', '', '', '0', '7', '1');
INSERT INTO `tp_weixin_menu` VALUES ('237', '编辑', '235', 'message_tpl', 'edit', '', '', '0', '255', '0');
INSERT INTO `tp_weixin_menu` VALUES ('238', '删除', '235', 'message_tpl', 'delete', '', '', '0', '255', '0');
INSERT INTO `tp_weixin_menu` VALUES ('240', '单页管理', '154', 'article', 'page', '', '', '0', '2', '1');
INSERT INTO `tp_weixin_menu` VALUES ('242', '积分记录', '269', 'score', 'logs', '', '', '0', '2', '1');
INSERT INTO `tp_weixin_menu` VALUES ('244', '应用', '0', 'plugin', 'index', '', '', '0', '6', '0');
INSERT INTO `tp_weixin_menu` VALUES ('245', '系统接口', '244', 'apis', 'index', '', '', '0', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('246', '应用管理', '244', 'plugin', 'index', '', '', '0', '3', '0');
INSERT INTO `tp_weixin_menu` VALUES ('247', '应用中心', '246', 'plugin', 'index', '', '', '0', '0', '1');
INSERT INTO `tp_weixin_menu` VALUES ('248', '已安装应用', '246', 'plugin', 'list', '', '', '0', '0', '1');
INSERT INTO `tp_weixin_menu` VALUES ('252', '用户整合', '245', 'integrate', 'index', '', '', '0', '255', '0');
INSERT INTO `tp_weixin_menu` VALUES ('253', '图片模式', '52', 'item', 'index', '&sm=image', '', '0', '2', '1');
INSERT INTO `tp_weixin_menu` VALUES ('267', '批量注册', '149', 'user', 'add_users', '', '', '0', '2', '1');
INSERT INTO `tp_weixin_menu` VALUES ('270', '邮件模板', '235', 'message_tpl', 'index', '&type=mail', '', '0', '6', '1');
INSERT INTO `tp_weixin_menu` VALUES ('271', '短消息模板', '235', 'message_tpl', 'index', '&type=msg', '', '0', '5', '1');
INSERT INTO `tp_weixin_menu` VALUES ('272', '附件设置', '148', 'setting', 'index', '&type=attachment', '', '0', '4', '1');
INSERT INTO `tp_weixin_menu` VALUES ('273', '显示设置', '216', 'setting', 'index', '&type=style', '', '0', '2', '1');
INSERT INTO `tp_weixin_menu` VALUES ('274', '模板管理', '216', 'template', 'index', '', '', '0', '3', '0');
INSERT INTO `tp_weixin_menu` VALUES ('275', '站点设置', '148', 'setting', 'index', '', '', '6', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('276', '积分设置', '269', 'score', 'setting', '', '', '0', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('277', '商品管理', '52', 'item', 'index', '', '', '0', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('278', '文章管理', '155', 'article', 'index', '', '', '0', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('279', '会员管理', '149', 'user', 'index', '', '', '3', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('280', '积分商品', '257', 'score_item', 'index', '', '', '0', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('281', '淘宝评论', '164', 'cmt_taobao', 'index', '', '', '0', '255', '0');
INSERT INTO `tp_weixin_menu` VALUES ('282', 'SEO设置', '2', 'seo', 'url', '', '', '0', '5', '0');
INSERT INTO `tp_weixin_menu` VALUES ('283', 'UR静态化', '282', 'seo', 'url', '', '', '0', '255', '1');
INSERT INTO `tp_weixin_menu` VALUES ('284', '页面SEO', '282', 'seo', 'page', '', '', '0', '255', '1');
INSERT INTO `tp_weixin_menu` VALUES ('285', '专辑', '0', 'album', 'index', '', '', '0', '2', '0');
INSERT INTO `tp_weixin_menu` VALUES ('286', '注册登陆', '2', 'setting', 'user', '', '', '6', '2', '1');
INSERT INTO `tp_weixin_menu` VALUES ('293', '编辑', '291', 'brandlist', ' edit', '', '', '0', '255', '0');
INSERT INTO `tp_weixin_menu` VALUES ('292', '新增', '291', 'brandlist', 'add', '', '', '0', '255', '0');
INSERT INTO `tp_weixin_menu` VALUES ('291', '品牌管理', '51', 'brandlist', 'index', '', '', '1', '1', '1');
INSERT INTO `tp_weixin_menu` VALUES ('294', '删除', '291', 'brandlist', 'delete', '', '', '0', '255', '0');
INSERT INTO `tp_weixin_menu` VALUES ('295', '交易管理', '50', 'item_order', 'index', '', '', '0', '255', '1');
INSERT INTO `tp_weixin_menu` VALUES ('296', '订单管理', '295', 'item_order', 'index', '', '', '2', '255', '1');
INSERT INTO `tp_weixin_menu` VALUES ('297', '快递方式管理', '295', 'delivery', 'index', '', '', '2', '255', '1');
INSERT INTO `tp_weixin_menu` VALUES ('298', '发货地址管理', '295', 'address', 'index', '', '', '2', '255', '1');
INSERT INTO `tp_weixin_menu` VALUES ('299', '回复设置', '0', 'keyword', 'index', '', '', '0', '2', '0');
INSERT INTO `tp_weixin_menu` VALUES ('300', '回复设置', '299', 'keyword', 'index', '', '', '0', '255', '1');
INSERT INTO `tp_weixin_menu` VALUES ('301', '关键词自动回复', '300', 'keyword', 'addkeyword', '', '', '4', '255', '1');
INSERT INTO `tp_weixin_menu` VALUES ('302', '消息自动回复', '300', 'keyword', 'addmess', '', '', '4', '255', '1');
INSERT INTO `tp_weixin_menu` VALUES ('303', '关注自动回复', '300', 'keyword', 'addfollow', '', '', '4', '255', '1');
INSERT INTO `tp_weixin_menu` VALUES ('304', '收款方式设置', '295', 'alipay', 'index', '', '', '2', '255', '1');
INSERT INTO `tp_weixin_menu` VALUES ('305', '自定义菜单', '300', 'custom_menu', 'index', '', '', '4', '255', '1');
INSERT INTO `tp_weixin_menu` VALUES ('306', '添加', '305', 'custom_menu', 'add', '', '', '0', '255', '0');
INSERT INTO `tp_weixin_menu` VALUES ('307', '编辑', '305', 'custom_menu', 'edit', '', '', '0', '255', '0');
INSERT INTO `tp_weixin_menu` VALUES ('308', '删除', '305', 'custom_menu', 'delete', '', '', '0', '255', '0');

-- ----------------------------
-- Table structure for `tp_weixin_message`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_message`;
CREATE TABLE `tp_weixin_message` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ftid` int(10) unsigned NOT NULL,
  `from_id` int(10) NOT NULL,
  `from_name` varchar(50) NOT NULL,
  `to_id` int(10) NOT NULL,
  `to_name` varchar(50) NOT NULL,
  `add_time` int(10) NOT NULL,
  `info` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_message
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_message_tpl`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_message_tpl`;
CREATE TABLE `tp_weixin_message_tpl` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `is_sys` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL COMMENT '别名',
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_message_tpl
-- ----------------------------
INSERT INTO `tp_weixin_message_tpl` VALUES ('1', 'msg', '1', '登录', 'login', '<p>\r\n	欢迎\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<div>\r\n	<p>\r\n		<span style=\"font-size:10.5000pt;font-family:\'宋体\';\">拼品网是一个集购物与分享与一体的网站，它会带给你惊喜，它让你与心仪的宝贝不期而遇，同时和朋友一起逛，分享每一次的购物乐趣，惊喜不断<span>~</span></span><span style=\"font-size:10.5000pt;font-family:\'宋体\';\"></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:10.5000pt;font-family:\'宋体\';\"></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:10.5000pt;font-family:\'宋体\';\">为了更好地开始专属于你的购物之旅，你可以：</span><span style=\"font-size:10.5000pt;font-family:\'宋体\';\"></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:10.5000pt;font-family:\'宋体\';\"></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:10.5000pt;font-family:\'宋体\';\">1<span>、发现更多美好</span></span><span style=\"font-size:10.5000pt;font-family:\'宋体\';\"></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:10.5000pt;font-family:\'宋体\';\"></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:10.5000pt;font-family:\'宋体\';\">2<span>、寻找喜好相投的好友</span></span><span style=\"font-size:10.5000pt;font-family:\'宋体\';\"></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:10.5000pt;font-family:\'宋体\';\"></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:10.5000pt;font-family:\'宋体\';\">4<span>、创建属于自己的专辑</span></span><span style=\"font-size:10.5000pt;font-family:\'宋体\';\"></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:10.5000pt;font-family:\'宋体\';\"></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:10.5000pt;font-family:\'宋体\';\">5<span>、邀请你的好友一起发现美丽</span></span><span style=\"font-size:10.5000pt;font-family:\'宋体\';\"></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:10.5000pt;font-family:\'宋体\';\"></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:10.5000pt;font-family:\'宋体\';\">6<span>、分享更多好东西</span></span><span style=\"font-size:10.5000pt;font-family:\'宋体\';\"></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:10.5000pt;font-family:\'宋体\';\"></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:10.5000pt;font-family:\'宋体\';\"></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:10.5000pt;font-family:\'宋体\';\">欢迎联系使用拼品网，我们随时恭候你的提问和建议。</span><span style=\"font-size:10.5000pt;font-family:\'宋体\';\"></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:10.5000pt;font-family:\'宋体\';\">祝您玩的愉快<span>^^</span></span> \r\n	</p>\r\n</div>\r\n<p>\r\n	<br />\r\n</p>');
INSERT INTO `tp_weixin_message_tpl` VALUES ('3', 'mail', '1', '找回密码', 'findpwd', '<p>\r\n	尊敬的{$username}:\r\n</p>\r\n<p style=\"padding-left:30px;\">\r\n	您好, 您刚才在 {$site_name} 申请了重置密码，请点击下面的链接进行重置：\r\n</p>\r\n<p style=\"padding-left:30px;\">\r\n	<a href=\"{$reset_url}\">{$reset_url}</a> \r\n</p>\r\n<p style=\"padding-left:30px;\">\r\n	此链接只能使用一次, 如果失效请重新申请. 如果以上链接无法点击，请将它拷贝到浏览器(例如IE)的地址栏中。\r\n</p>\r\n<p style=\"text-align:right;\">\r\n	{$site_name}\r\n</p>\r\n<p style=\"text-align:right;\">\r\n	{$send_time}\r\n</p>');

-- ----------------------------
-- Table structure for `tp_weixin_nav`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_nav`;
CREATE TABLE `tp_weixin_nav` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `alias` varchar(20) NOT NULL,
  `link` varchar(255) NOT NULL,
  `target` tinyint(1) NOT NULL DEFAULT '1',
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `mod` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_nav
-- ----------------------------
INSERT INTO `tp_weixin_nav` VALUES ('1', 'main', '发现', 'book', '', '0', '255', 'sys', '1');
INSERT INTO `tp_weixin_nav` VALUES ('2', 'main', '专辑', 'album', '', '0', '255', 'sys', '1');
INSERT INTO `tp_weixin_nav` VALUES ('3', 'main', '集市', 'cate', '?m=book&a=cate&cid=1', '0', '255', '', '1');
INSERT INTO `tp_weixin_nav` VALUES ('4', 'bottom', '发现', 'book', '', '0', '255', 'sys', '1');
INSERT INTO `tp_weixin_nav` VALUES ('5', 'main', '兑换', 'exchange', '', '0', '255', 'sys', '1');
INSERT INTO `tp_weixin_nav` VALUES ('6', 'bottom', '专辑', 'album', '', '0', '255', 'sys', '1');
INSERT INTO `tp_weixin_nav` VALUES ('7', 'bottom', '集市', 'cate', '?m=book&a=cate&cid=1', '0', '255', '', '1');
INSERT INTO `tp_weixin_nav` VALUES ('8', 'bottom', '兑换', 'exchange', '', '0', '255', 'sys', '1');

-- ----------------------------
-- Table structure for `tp_weixin_oauth`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_oauth`;
CREATE TABLE `tp_weixin_oauth` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `config` text NOT NULL,
  `desc` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_oauth
-- ----------------------------
INSERT INTO `tp_weixin_oauth` VALUES ('4', 'qq', 'QQ登录', 'a:2:{s:7:\"app_key\";s:9:\"100330010\";s:10:\"app_secret\";s:32:\"098381fd5d6a89f44127d61f0f2645da\";}', '申请地址：http://connect.opensns.qq.com/', 'PinPHP TEAM', '2', '1');
INSERT INTO `tp_weixin_oauth` VALUES ('7', 'sina', '微博登陆', 'a:2:{s:7:\"app_key\";s:10:\"3115666660\";s:10:\"app_secret\";s:32:\"e59677c031210b6d063a2661b6a895cf\";}', '申请地址：http://open.weibo.com/', 'PinPHP TEAM', '1', '1');
INSERT INTO `tp_weixin_oauth` VALUES ('8', 'taobao', '淘宝登录', 'a:2:{s:7:\"app_key\";s:8:\"21270789\";s:10:\"app_secret\";s:32:\"0c28536510e0b0b429750f478222d549\";}', '申请地址：http://open.taobao.com/', 'PinPHP TEAM', '3', '1');

-- ----------------------------
-- Table structure for `tp_weixin_order_detail`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_order_detail`;
CREATE TABLE `tp_weixin_order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '订单编号',
  `itemId` int(11) NOT NULL COMMENT '商品ID',
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '商品名称',
  `img` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '图片路径',
  `price` decimal(10,2) DEFAULT '0.00' COMMENT '单价',
  `quantity` int(11) NOT NULL COMMENT '购买数量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tp_weixin_order_detail
-- ----------------------------
INSERT INTO `tp_weixin_order_detail` VALUES ('2', '201308071922091735', '120', '粉红大布娃娃 2013夏款蓝白条纹海军风复古翻领短袖连衣裙', '1308/05/51ff3011cca0f.jpg', '159.00', '1');
INSERT INTO `tp_weixin_order_detail` VALUES ('3', '201308071926441715', '120', '粉红大布娃娃 2013夏款蓝白条纹海军风复古翻领短袖连衣裙', '1308/05/51ff3011cca0f.jpg', '159.00', '1');
INSERT INTO `tp_weixin_order_detail` VALUES ('4', '201308071958511781', '120', '粉红大布娃娃 2013夏款蓝白条纹海军风复古翻领短袖连衣裙', '1308/05/51ff3011cca0f.jpg', '159.00', '1');
INSERT INTO `tp_weixin_order_detail` VALUES ('5', '201308081502021656', '122', '测试商品1', '1308/08/52033f4755a0e.jpg', '20.00', '1');

-- ----------------------------
-- Table structure for `tp_weixin_score_item`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_score_item`;
CREATE TABLE `tp_weixin_score_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` smallint(4) unsigned NOT NULL,
  `title` varchar(120) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0：实物；1：虚拟',
  `img` varchar(255) NOT NULL,
  `score` int(10) unsigned NOT NULL DEFAULT '0',
  `stock` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_num` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `buy_num` mediumint(8) NOT NULL DEFAULT '0',
  `desc` text NOT NULL,
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_score_item
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_score_item_cate`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_score_item_cate`;
CREATE TABLE `tp_weixin_score_item_cate` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_score_item_cate
-- ----------------------------
INSERT INTO `tp_weixin_score_item_cate` VALUES ('1', '数码', '1', '0');
INSERT INTO `tp_weixin_score_item_cate` VALUES ('2', '美容', '1', '0');
INSERT INTO `tp_weixin_score_item_cate` VALUES ('3', '虚拟', '1', '0');
INSERT INTO `tp_weixin_score_item_cate` VALUES ('4', '生活', '1', '0');
INSERT INTO `tp_weixin_score_item_cate` VALUES ('5', '运动', '1', '0');
INSERT INTO `tp_weixin_score_item_cate` VALUES ('6', '吃完', '1', '0');

-- ----------------------------
-- Table structure for `tp_weixin_score_log`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_score_log`;
CREATE TABLE `tp_weixin_score_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `score` int(10) NOT NULL,
  `add_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_score_log
-- ----------------------------
INSERT INTO `tp_weixin_score_log` VALUES ('1', '9', 'wingsa区', 'login', '10', '1353909837');
INSERT INTO `tp_weixin_score_log` VALUES ('2', '13', '想太多妹子', 'login', '10', '1353909897');
INSERT INTO `tp_weixin_score_log` VALUES ('3', '16', 'Eudora_寻寻', 'login', '10', '1353909964');
INSERT INTO `tp_weixin_score_log` VALUES ('4', '15', 'Prickleman', 'login', '10', '1353910012');
INSERT INTO `tp_weixin_score_log` VALUES ('5', '11', '彩色淘', 'login', '10', '1353910069');
INSERT INTO `tp_weixin_score_log` VALUES ('6', '7', '咕咕是一只猫', 'login', '10', '1353910109');
INSERT INTO `tp_weixin_score_log` VALUES ('7', '12', '跳房子123', 'login', '10', '1353910146');
INSERT INTO `tp_weixin_score_log` VALUES ('8', '17', 'V小莲小莲V', 'login', '10', '1353910177');
INSERT INTO `tp_weixin_score_log` VALUES ('9', '20', '熊小熊zz', 'login', '10', '1353910221');
INSERT INTO `tp_weixin_score_log` VALUES ('10', '6', '起个名字太累', 'login', '10', '1353910265');
INSERT INTO `tp_weixin_score_log` VALUES ('11', '18', '晨雪熙', 'login', '10', '1353910348');
INSERT INTO `tp_weixin_score_log` VALUES ('12', '8', '枕水而眠', 'login', '10', '1353910407');
INSERT INTO `tp_weixin_score_log` VALUES ('13', '19', '安土桃山', 'login', '10', '1353910445');
INSERT INTO `tp_weixin_score_log` VALUES ('14', '10', '设计系小女生', 'login', '10', '1353910499');
INSERT INTO `tp_weixin_score_log` VALUES ('15', '14', '泡芙小米粒', 'login', '10', '1353910539');
INSERT INTO `tp_weixin_score_log` VALUES ('16', '21', 'hjklhklj', 'register', '20', '1374633583');
INSERT INTO `tp_weixin_score_log` VALUES ('17', '21', 'hjklhklj', 'login', '10', '1374633583');
INSERT INTO `tp_weixin_score_log` VALUES ('18', '22', 'dsadsa', 'register', '20', '1374724879');
INSERT INTO `tp_weixin_score_log` VALUES ('19', '22', 'dsadsa', 'login', '10', '1374724879');
INSERT INTO `tp_weixin_score_log` VALUES ('20', '23', 'wooo', 'register', '20', '1374724936');
INSERT INTO `tp_weixin_score_log` VALUES ('21', '23', 'wooo', 'login', '10', '1374724936');
INSERT INTO `tp_weixin_score_log` VALUES ('22', '24', 'cvvv', 'register', '20', '1374724990');
INSERT INTO `tp_weixin_score_log` VALUES ('23', '24', 'cvvv', 'login', '10', '1374724990');
INSERT INTO `tp_weixin_score_log` VALUES ('24', '26', 'Ace', 'register', '20', '1375152929');
INSERT INTO `tp_weixin_score_log` VALUES ('25', '26', 'Ace', 'login', '10', '1375152929');
INSERT INTO `tp_weixin_score_log` VALUES ('26', '27', 'ceshi', 'register', '20', '1375154088');
INSERT INTO `tp_weixin_score_log` VALUES ('27', '27', 'ceshi', 'login', '10', '1375154088');
INSERT INTO `tp_weixin_score_log` VALUES ('28', '28', 'xmyiquan', 'register', '20', '1375176967');
INSERT INTO `tp_weixin_score_log` VALUES ('29', '28', 'xmyiquan', 'login', '10', '1375176967');
INSERT INTO `tp_weixin_score_log` VALUES ('30', '29', 'leguhuwai', 'register', '20', '1375250687');
INSERT INTO `tp_weixin_score_log` VALUES ('31', '29', 'leguhuwai', 'login', '10', '1375250687');

-- ----------------------------
-- Table structure for `tp_weixin_score_order`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_score_order`;
CREATE TABLE `tp_weixin_score_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(100) NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `uname` varchar(20) NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `item_name` varchar(120) NOT NULL,
  `item_num` mediumint(8) NOT NULL,
  `consignee` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `order_score` int(10) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `add_time` int(10) unsigned NOT NULL,
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_score_order
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_setting`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_setting`;
CREATE TABLE `tp_weixin_setting` (
  `name` varchar(100) NOT NULL,
  `data` text NOT NULL,
  `remark` varchar(255) NOT NULL,
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_setting
-- ----------------------------
INSERT INTO `tp_weixin_setting` VALUES ('site_name', '释风行网络', '');
INSERT INTO `tp_weixin_setting` VALUES ('site_title', '释风行网络-微信商城', '');
INSERT INTO `tp_weixin_setting` VALUES ('site_keyword', '释风行,微信商城,最新商城模式,电商领航者', '');
INSERT INTO `tp_weixin_setting` VALUES ('site_description', '释风行网络专注微信客户端应用开发，众多真实案例，微信商城、微信餐饮系统、微房产、微汽车等产品受到广大商家和用户好评。因为真诚，所以值得信赖！', '');
INSERT INTO `tp_weixin_setting` VALUES ('site_status', '1', '');
INSERT INTO `tp_weixin_setting` VALUES ('closed_reason', '网站升级中。。', '');
INSERT INTO `tp_weixin_setting` VALUES ('site_icp', '', '');
INSERT INTO `tp_weixin_setting` VALUES ('statistics_code', '', '');
INSERT INTO `tp_weixin_setting` VALUES ('statics_url', '', '');
INSERT INTO `tp_weixin_setting` VALUES ('mail_server', '', '');
INSERT INTO `tp_weixin_setting` VALUES ('item_check', '0', '');
INSERT INTO `tp_weixin_setting` VALUES ('score_rule', 'a:16:{s:8:\"register\";s:2:\"20\";s:13:\"register_nums\";s:1:\"1\";s:5:\"login\";s:2:\"10\";s:10:\"login_nums\";s:1:\"5\";s:7:\"pubitem\";s:2:\"20\";s:12:\"pubitem_nums\";s:2:\"10\";s:8:\"likeitem\";s:1:\"1\";s:13:\"likeitem_nums\";s:2:\"20\";s:9:\"joinalbum\";s:1:\"2\";s:14:\"joinalbum_nums\";s:2:\"10\";s:6:\"fwitem\";s:1:\"2\";s:11:\"fwitem_nums\";s:2:\"10\";s:6:\"pubcmt\";s:1:\"1\";s:11:\"pubcmt_nums\";s:1:\"5\";s:7:\"delitem\";s:3:\"-20\";s:12:\"delitem_nums\";s:3:\"100\";}', '');
INSERT INTO `tp_weixin_setting` VALUES ('album_cover_items', '5', '专辑封面显示图片数量');
INSERT INTO `tp_weixin_setting` VALUES ('integrate_code', 'default', '');
INSERT INTO `tp_weixin_setting` VALUES ('integrate_config', '', '');
INSERT INTO `tp_weixin_setting` VALUES ('hot_tags', '家居,花园,美食,旅行,创意,建筑,户外,飘窗,卧室,城堡,DIY,萌宠,门厅,衣帽间,婚礼,书房,厨房,客厅,浴室,阳台,工作台,收纳,餐厅,阁楼,儿童房,小空间,性感', '');
INSERT INTO `tp_weixin_setting` VALUES ('wall_spage_max', '5', '');
INSERT INTO `tp_weixin_setting` VALUES ('wall_spage_size', '50', '');
INSERT INTO `tp_weixin_setting` VALUES ('book_page_max', '100', '');
INSERT INTO `tp_weixin_setting` VALUES ('default_keyword', '懒得逛了，我搜~', '');
INSERT INTO `tp_weixin_setting` VALUES ('album_default_title', '默认专辑', '');
INSERT INTO `tp_weixin_setting` VALUES ('avatar_size', '24,32,48,64,100,200', '');
INSERT INTO `tp_weixin_setting` VALUES ('attr_allow_exts', 'jpg,gif,png,jpeg,swf', '');
INSERT INTO `tp_weixin_setting` VALUES ('attr_allow_size', '2048', '');
INSERT INTO `tp_weixin_setting` VALUES ('itemcate_img', 'a:2:{s:5:\"width\";s:3:\"150\";s:6:\"height\";s:3:\"170\";}', '');
INSERT INTO `tp_weixin_setting` VALUES ('reg_protocol', '一、总则\r\n1．1　用户应当同意本协议的条款并按照页面上的提示完成全部的注册程序。用户在进行注册程序过程中点击\"立即注册\"按钮即表示用户与拼品网公司达成协议，完全接受本协议项下的全部条款。\r\n1．2　用户注册成功后，拼品网将给予每个用户一个用户帐号及相应的密码，该用户帐号和密码由用户负责保管；用户应当对以其用户帐号进行的所有活动和事件负法律责任。\r\n1．3　用户可以使用拼品网各个频道单项服务，当用户使用拼品网各单项服务时，用户的使用行为视为其对该单项服务的服务条款以及拼品网在该单项服务中发出的各类公告的同意。\r\n1．4　拼品网会员服务协议以及各个频道单项服务条款和公告可由拼品网公司随时更新，且无需另行通知。您在使用相关服务时,应关注并遵守其所适用的相关条款。\r\n您在使用拼品网提供的各项服务之前，应仔细阅读本服务协议。如您不同意本服务协议及/或随时对其的修改，您可以主动取消拼品网提供的服务；您一旦使用拼品网产品，即视为您已了解并完全同意本服务协议各项内容，包括拼品网对服务协议随时所做的任何修改，并成为拼品网用户。\r\n二、注册信息和隐私保护\r\n2．1　 拼品网帐号（即拼品网用户ID）的所有权归拼品网，用户完成注册申请手续后，获得拼品网帐号的使用权。用户应提供及时、详尽及准确的个人资料，并不断更新注册资料，符合及时、详尽准确的要求。所有原始键入的资料将引用为注册资料。如果因注册信息不真实而引起的问题，并对问题发生所带来的后果，拼品网概不负任何责任。\r\n2．2　用户不应将其帐号、密码转让或出借予他人使用。如用户发现其帐号遭他人非法使用，应立即通知拼品网。因黑客行为或用户的保管疏忽导致帐号、密码遭他人非法使用，拼品网不承担任何责任。\r\n2．3　拼品网不对外公开或向第三方提供单个用户的注册资料，除非：\r\n（1）事先获得用户的明确授权；\r\n（2）只有透露你的个人资料，才能提供你所要求的产品和服务；\r\n（3）根据有关的法律法规要求；\r\n（4）按照相关政府主管部门的要求；\r\n（5）为维护拼品网的合法权益。\r\n2．4　在你注册拼品网帐户，使用其他拼品网产品或服务，访问拼品网网页, 或参加促销和有奖游戏时，拼品网会收集你的个人身份识别资料，并会将这些资料用于：改进为你提供的服务及网页内容。\r\n三、使用规则\r\n3．1　用户在使用拼品网服务时，必须遵守中华人民共和国相关法律法规的规定，用户应同意将不会利用本服务进行任何违法或不正当的活动，包括但不限于下列行为∶\r\n（1）上载、展示、张贴、传播或以其它方式传送含有下列内容之一的信息：\r\n1） 反对宪法所确定的基本原则的； 2） 危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的； 3） 损害国家荣誉和利益的； 4） 煽动民族仇恨、民族歧视、破坏民族团结的； 5） 破坏国家宗教政策，宣扬邪教和封建迷信的； 6） 散布谣言，扰乱社会秩序，破坏社会稳定的； 7） 散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的； 8） 侮辱或者诽谤他人，侵害他人合法权利的； 9） 含有虚假、有害、胁迫、侵害他人隐私、骚扰、侵害、中伤、粗俗、猥亵、或其它道德上令人反感的内容； 10） 含有中国法律、法规、规章、条例以及任何具有法律效力之规范所限制或禁止的其它内容的；\r\n（2）不得为任何非法目的而使用网络服务系统；\r\n（3）不利用拼品网服务从事以下活动：\r\n1) 未经允许，进入计算机信息网络或者使用计算机信息网络资源的；\r\n2) 未经允许，对计算机信息网络功能进行删除、修改或者增加的；\r\n3) 未经允许，对进入计算机信息网络中存储、处理或者传输的数据和应用程序进行删除、修改或者增加的；\r\n4) 故意制作、传播计算机病毒等破坏性程序的；\r\n5) 其他危害计算机信息网络安全的行为。\r\n3．2　 用户违反本协议或相关的服务条款的规定，导致或产生的任何第三方主张的任何索赔、要求或损失，包括合理的律师费，您同意赔偿拼品网与合作公司、关联公司，并使之免受损害。对此，拼品网有权视用户的行为性质，采取包括但不限于删除用户发布信息内容、暂停使用许可、终止服务、限制使用、回收拼品网帐号、追 究法律责任等措施。对恶意注册拼品网帐号或利用拼品网帐号进行违法活动、捣乱、骚扰、欺骗、其他用户以及其他违反本协议的行为，拼品网有权回收其帐号。同 时，拼品网公司会视司法部门的要求，协助调查。\r\n3．3　用户不得对本服务任何部分或本服务之使用或获得，进行复制、拷贝、出售、转售或用于任何其它商业目的。\r\n3．4　用户须对自己在使用拼品网服务过程中的行为承担法律责任。用户承担法律责任的形式包括但不限于：对受到侵害者进行赔偿，以及在拼品网公司首先承担了因用户行为导致的行政处罚或侵权损害赔偿责任后，用户应给予拼品网公司等额的赔偿。\r\n四、服务内容\r\n4．1　拼品网网络服务的具体内容由拼品网根据实际情况提供。\r\n4．2　除非本服务协议另有其它明示规定，拼品网所推出的新产品、新功能、新服务，均受到本服务协议之规范。\r\n4．3　为使用本服务，您必须能够自行经有法律资格对您提供互联网接入服务的第三方，进入国际互联网，并应自行支付相关服务费用。此外，您必须自行配备及负责与国际联网连线所需之一切必要装备，包括计算机、数据机或其它存取装置。\r\n4．4　鉴于网络服务的特殊性，用户同意拼品网有权不经事先通知，随时变更、中断或终止部分或全部的网络服务（包括收费网络服务）。拼品网不担保网络服务不会中断，对网络服务的及时性、安全性、准确性也都不作担保。\r\n4．5　拼品网需要定期或不定期地对提供网络服务的平台或相关的设备进行检修或者维护，如因此类情况而造成网络服务（包括收费网络服务）在合理时间内的中断，拼品网无需为此承担任何责任。拼品网保留不经事先通知为维修保养、升级或其它目的暂停本服务任何部分的权利。\r\n4．6　 本服务或第三人可提供与其它国际互联网上之网站或资源之链接。由于拼品网无法控制这些网站及资源，您了解并同意，此类网站或资源是否可供利用，拼品网不予负责，存在或源于此类网站或资源之任何内容、广告、产品或其它资料，拼品网亦不予保证或负责。因使用或依赖任何此类网站或资源发布的或经由此类网站或资 源获得的任何内容、商品或服务所产生的任何损害或损失，拼品网不承担任何责任。\r\n4．7　用户明确同意其使用拼品网网络服务所存在的风险将完全由其 自己承担。用户	理解并接受下载或通过拼品网服务取得的任何信息资料取决于用户自己，并由其承担系统受损、资料丢失以及其它任何风险。拼品网对在服务网上得 到的任何商品购物服	务、交易进程、招聘信息，都不作担保。\r\n4．8　3个月未登录的帐号，拼品网保留关闭的权利。\r\n4．9　拼品网有权于任何时间暂时或永久修改或终止本服务（或其任何部分），而无论其通知与否，拼品网对用户和任何第三人均无需承担任何责任。\r\n4．10　终止服务\r\n您同意拼品网得基于其自行之考虑，因任何理由，包含但不限于长时间未使用，或拼品网认为您已经违反本服务协议的文字及精神，终止您的密码、帐号或本服务之使 用（或服务之任何部分），并将您在本服务内任何内容加以移除并删除。您同意依本服务协议任何规定提供之本服务，无需进行事先通知即可中断或终止，您承认并 同意，拼品网可立即关闭或删除您的帐号及您帐号中所有相关信息及文件，及/或禁止继续使用前述文件或本服务。此外，您同意若本服务之使用被中断或终止或您 的帐号及相关信息和文件被关闭或删除，拼品网对您或任何第三人均不承担任何责任。\r\n五、知识产权和其他合法权益（包括但不限于名誉权、商誉权）\r\n5．1　用户专属权利\r\n拼品网尊重他人知识产权和合法权益，呼吁用户也要同样尊重知识产权和他人合法权益。若您认为您的知识产权或其他合法权益被侵犯，请按照以下说明向拼品网提供资料∶\r\n请注意：如果权利通知的陈述失实，权利通知提交者将承担对由此造成的全部法律责任（包括但不限于赔偿各种费用及律师费）。如果上述个人或单位不确定网络上可获取的资料是否侵犯了其知识产权和其他合法权益，拼品网建议该个人或单位首先咨询专业人士。\r\n为了拼品网有效处理上述个人或单位的权利通知，请使用以下格式（包括各条款的序号）：\r\n1. 权利人对涉嫌侵权内容拥有知识产权或其他合法权益和/或依法可以行使知识产权或其他合法权益的权属证明；\r\n2. 请充分、明确地描述被侵犯了知识产权或其他合法权益的情况并请提供涉嫌侵权的第三方网址（如果有）。\r\n3. 请指明涉嫌侵权网页的哪些内容侵犯了第2项中列明的权利。\r\n4. 请提供权利人具体的联络信息，包括姓名、身份证或护照复印件（对自然人）、单位登记证明复印件（对单位）、通信地址、电话号码、传真和电子邮件。\r\n5. 请提供涉嫌侵权内容在信息网络上的位置（如指明您举报的含有侵权内容的出处，即：指网页地址或网页内的位置）以便我们与您举报的含有侵权内容的网页的所有权人/管理人联系。\r\n5．1　 对于用户通过拼品网服务上传到拼品网网站上可公开获取区域的任何内容，用户同意拼品网在全世界范围内具有免费的、永久性的、不可撤销的、非独家的和完全再许可的权利和许可，以使用、复制、修改、改编、出版、翻译、据以创作衍生作品、传播、表演和展示此等内容（整体或部分），和/或将此等内容编入当前已知 的或以后开发的其他任何形式的作品、媒体或技术中。\r\n5．2　拼品网拥有本网站内所有资料的版权。任何被授权的浏览、复制、打印和传播属于本网站内的资料必须符合以下条件：所有的资料和图象均以获得信息为目的；\r\n所有的资料和图象均不得用于商业目的；\r\n所有的资料、图象及其任何部分都必须包括此版权声明；\r\n本网站（www.pinphp.com）所有的产品、技术与所有程序均属于拼品网知识产权，在此并未授权。\r\n“www.pinphp.com”, “拼品网”及相关图形等为拼品网的注册商标。\r\n未经拼品网许可，任何人不得擅自（包括但不限于：以非法的方式复制、传播、展示、镜像、上载、下载）使用。否则，拼品网将依法追究法律责任。\r\n六、青少年用户特别提示\r\n青少年用户必须遵守全国青少年网络文明公约：\r\n要善于网上学习，不浏览不良信息；要诚实友好交流，不侮辱欺诈他人；要增强自护意识，不随意约会网友；要维护网络安全，不破坏网络秩序；要有益身心健康，不沉溺虚拟时空。\r\n七、其他\r\n7．1　本协议的订立、执行和解释及争议的解决均应适用中华人民共和国法律。\r\n7．2　如双方就本协议内容或其执行发生任何争议，双方应尽量友好协商解决；协商不成时，任何一方均可向拼品网所在地的人民法院提起诉讼。\r\n7．3　拼品网未行使或执行本服务协议任何权利或规定，不构成对前述权利或权利之放弃。\r\n7．4　如本协议中的任何条款无论因何种原因完全或部分无效或不具有执行力，本协议的其余条款仍应有效并且有约束力。\r\n拼品网对本使用协议享有最终解释权。', '');
INSERT INTO `tp_weixin_setting` VALUES ('item_cover_comments', '2', '');
INSERT INTO `tp_weixin_setting` VALUES ('user_intro_default', '这个家伙太懒，什么都木留下~', '');
INSERT INTO `tp_weixin_setting` VALUES ('ipban_switch', '1', '');
INSERT INTO `tp_weixin_setting` VALUES ('score_item_img', 'a:4:{s:6:\"swidth\";s:3:\"210\";s:7:\"sheight\";s:3:\"210\";s:6:\"bwidth\";s:3:\"350\";s:7:\"bheight\";s:3:\"350\";}', '');
INSERT INTO `tp_weixin_setting` VALUES ('seo_config', 'a:6:{s:4:\"book\";a:3:{s:5:\"title\";s:23:\"{tag_name}-{site_title}\";s:8:\"keywords\";s:23:\"逛宝贝，{site_name}\";s:11:\"description\";s:18:\"{site_description}\";}s:4:\"cate\";a:3:{s:5:\"title\";s:23:\"{cate_name}-{seo_title}\";s:8:\"keywords\";s:14:\"{seo_keywords}\";s:11:\"description\";s:17:\"{seo_description}\";}s:5:\"album\";a:3:{s:5:\"title\";s:6:\"专辑\";s:8:\"keywords\";s:47:\"{site_name},购物分享,淘宝网购物,专辑\";s:11:\"description\";s:18:\"{site_description}\";}s:10:\"album_cate\";a:3:{s:5:\"title\";s:11:\"{seo_title}\";s:8:\"keywords\";s:14:\"{seo_keywords}\";s:11:\"description\";s:17:\"{seo_description}\";}s:12:\"album_detail\";a:3:{s:5:\"title\";s:13:\"{album_title}\";s:8:\"keywords\";s:13:\"{album_intro}\";s:11:\"description\";s:23:\"杂志详细Description\";}s:4:\"item\";a:3:{s:5:\"title\";s:12:\"{item_title}\";s:8:\"keywords\";s:10:\"{item_tag}\";s:11:\"description\";s:12:\"{item_intro}\";}}', '');
INSERT INTO `tp_weixin_setting` VALUES ('item_img', 'a:2:{s:5:\"width\";s:3:\"210\";s:6:\"height\";s:4:\"1000\";}', '');
INSERT INTO `tp_weixin_setting` VALUES ('item_simg', 'a:2:{s:5:\"width\";s:3:\"100\";s:6:\"height\";s:3:\"100\";}', '');
INSERT INTO `tp_weixin_setting` VALUES ('item_bimg', 'a:2:{s:5:\"width\";s:3:\"468\";s:6:\"height\";s:4:\"1000\";}', '');
INSERT INTO `tp_weixin_setting` VALUES ('attach_path', 'data/upload/', '');
INSERT INTO `tp_weixin_setting` VALUES ('wall_distance', '500', '');
INSERT INTO `tp_weixin_setting` VALUES ('reg_status', '1', '');
INSERT INTO `tp_weixin_setting` VALUES ('reg_closed_reason', '<h1>暂时关闭注册</h1>', '');
INSERT INTO `tp_weixin_setting` VALUES ('index_wall', '1', '');
INSERT INTO `tp_weixin_setting` VALUES ('tp_weixin_img', '1308/06/5200a7cba87b0.jpg', '');
INSERT INTO `tp_weixin_setting` VALUES ('weixinshop_img', '1308/06/5200a7cba936c.jpg', '');
INSERT INTO `tp_weixin_setting` VALUES ('appid', '', '');
INSERT INTO `tp_weixin_setting` VALUES ('appsecret', '', '');

-- ----------------------------
-- Table structure for `tp_weixin_tag`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_tag`;
CREATE TABLE `tp_weixin_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=531 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_tag
-- ----------------------------
INSERT INTO `tp_weixin_tag` VALUES ('1', '外套');
INSERT INTO `tp_weixin_tag` VALUES ('2', '毛衣');
INSERT INTO `tp_weixin_tag` VALUES ('3', 'T恤');
INSERT INTO `tp_weixin_tag` VALUES ('4', '西装');
INSERT INTO `tp_weixin_tag` VALUES ('5', '风衣');
INSERT INTO `tp_weixin_tag` VALUES ('6', '卫衣');
INSERT INTO `tp_weixin_tag` VALUES ('7', '马甲');
INSERT INTO `tp_weixin_tag` VALUES ('8', '牛仔裤');
INSERT INTO `tp_weixin_tag` VALUES ('9', '小脚裤');
INSERT INTO `tp_weixin_tag` VALUES ('10', '哈伦裤');
INSERT INTO `tp_weixin_tag` VALUES ('11', '打底裤');
INSERT INTO `tp_weixin_tag` VALUES ('12', '五分裤');
INSERT INTO `tp_weixin_tag` VALUES ('13', '蕾丝');
INSERT INTO `tp_weixin_tag` VALUES ('14', '牛仔');
INSERT INTO `tp_weixin_tag` VALUES ('15', '打底');
INSERT INTO `tp_weixin_tag` VALUES ('16', '镂空');
INSERT INTO `tp_weixin_tag` VALUES ('17', '拼接');
INSERT INTO `tp_weixin_tag` VALUES ('18', '紧身');
INSERT INTO `tp_weixin_tag` VALUES ('19', '格子');
INSERT INTO `tp_weixin_tag` VALUES ('20', '水洗');
INSERT INTO `tp_weixin_tag` VALUES ('21', '高腰');
INSERT INTO `tp_weixin_tag` VALUES ('22', '磨旧');
INSERT INTO `tp_weixin_tag` VALUES ('23', '宽松');
INSERT INTO `tp_weixin_tag` VALUES ('24', '清新');
INSERT INTO `tp_weixin_tag` VALUES ('25', '欧美');
INSERT INTO `tp_weixin_tag` VALUES ('26', '韩系');
INSERT INTO `tp_weixin_tag` VALUES ('27', '甜美');
INSERT INTO `tp_weixin_tag` VALUES ('28', '复古');
INSERT INTO `tp_weixin_tag` VALUES ('29', '简约');
INSERT INTO `tp_weixin_tag` VALUES ('30', '英伦');
INSERT INTO `tp_weixin_tag` VALUES ('31', '珊瑚绒');
INSERT INTO `tp_weixin_tag` VALUES ('32', '莫代尔');
INSERT INTO `tp_weixin_tag` VALUES ('33', '纯棉');
INSERT INTO `tp_weixin_tag` VALUES ('34', '全棉');
INSERT INTO `tp_weixin_tag` VALUES ('35', '毛呢');
INSERT INTO `tp_weixin_tag` VALUES ('36', '针织');
INSERT INTO `tp_weixin_tag` VALUES ('37', '毛绒');
INSERT INTO `tp_weixin_tag` VALUES ('38', '雪纺');
INSERT INTO `tp_weixin_tag` VALUES ('39', '黑色');
INSERT INTO `tp_weixin_tag` VALUES ('40', '黄色');
INSERT INTO `tp_weixin_tag` VALUES ('41', '绿色');
INSERT INTO `tp_weixin_tag` VALUES ('42', '红色');
INSERT INTO `tp_weixin_tag` VALUES ('43', '粉色');
INSERT INTO `tp_weixin_tag` VALUES ('44', '紫色');
INSERT INTO `tp_weixin_tag` VALUES ('45', '白色');
INSERT INTO `tp_weixin_tag` VALUES ('46', '蓝色');
INSERT INTO `tp_weixin_tag` VALUES ('47', '翻领');
INSERT INTO `tp_weixin_tag` VALUES ('48', '毛呢大衣');
INSERT INTO `tp_weixin_tag` VALUES ('49', '冬装');
INSERT INTO `tp_weixin_tag` VALUES ('50', '专柜');
INSERT INTO `tp_weixin_tag` VALUES ('51', '正品');
INSERT INTO `tp_weixin_tag` VALUES ('52', '新款');
INSERT INTO `tp_weixin_tag` VALUES ('53', '一身');
INSERT INTO `tp_weixin_tag` VALUES ('54', '浪漫');
INSERT INTO `tp_weixin_tag` VALUES ('55', '韩版大');
INSERT INTO `tp_weixin_tag` VALUES ('56', '纯色');
INSERT INTO `tp_weixin_tag` VALUES ('57', '短外套');
INSERT INTO `tp_weixin_tag` VALUES ('58', '羊毛');
INSERT INTO `tp_weixin_tag` VALUES ('59', '秋装');
INSERT INTO `tp_weixin_tag` VALUES ('60', '球衫');
INSERT INTO `tp_weixin_tag` VALUES ('61', '立领');
INSERT INTO `tp_weixin_tag` VALUES ('62', '修身');
INSERT INTO `tp_weixin_tag` VALUES ('63', '长袖');
INSERT INTO `tp_weixin_tag` VALUES ('64', '麂皮');
INSERT INTO `tp_weixin_tag` VALUES ('65', '加厚');
INSERT INTO `tp_weixin_tag` VALUES ('66', '棉质');
INSERT INTO `tp_weixin_tag` VALUES ('67', '蝙蝠');
INSERT INTO `tp_weixin_tag` VALUES ('68', '休闲');
INSERT INTO `tp_weixin_tag` VALUES ('69', '带帽');
INSERT INTO `tp_weixin_tag` VALUES ('70', '棉衣');
INSERT INTO `tp_weixin_tag` VALUES ('71', '袋鼠');
INSERT INTO `tp_weixin_tag` VALUES ('72', '拉链');
INSERT INTO `tp_weixin_tag` VALUES ('73', '街头');
INSERT INTO `tp_weixin_tag` VALUES ('74', '女装');
INSERT INTO `tp_weixin_tag` VALUES ('75', '春秋');
INSERT INTO `tp_weixin_tag` VALUES ('76', '宣言');
INSERT INTO `tp_weixin_tag` VALUES ('77', '1016111');
INSERT INTO `tp_weixin_tag` VALUES ('78', '开衫');
INSERT INTO `tp_weixin_tag` VALUES ('79', '短款');
INSERT INTO `tp_weixin_tag` VALUES ('80', '运动休闲');
INSERT INTO `tp_weixin_tag` VALUES ('81', '通勤');
INSERT INTO `tp_weixin_tag` VALUES ('82', '亮色');
INSERT INTO `tp_weixin_tag` VALUES ('83', '时尚');
INSERT INTO `tp_weixin_tag` VALUES ('84', '胸花');
INSERT INTO `tp_weixin_tag` VALUES ('85', '线下');
INSERT INTO `tp_weixin_tag` VALUES ('86', '春装');
INSERT INTO `tp_weixin_tag` VALUES ('87', '夹克');
INSERT INTO `tp_weixin_tag` VALUES ('88', '中长');
INSERT INTO `tp_weixin_tag` VALUES ('89', '双排');
INSERT INTO `tp_weixin_tag` VALUES ('90', '小西装');
INSERT INTO `tp_weixin_tag` VALUES ('91', '帅气');
INSERT INTO `tp_weixin_tag` VALUES ('92', '无袖');
INSERT INTO `tp_weixin_tag` VALUES ('93', '皱褶');
INSERT INTO `tp_weixin_tag` VALUES ('94', '品牌女装');
INSERT INTO `tp_weixin_tag` VALUES ('95', '夏装');
INSERT INTO `tp_weixin_tag` VALUES ('96', '低跟鞋');
INSERT INTO `tp_weixin_tag` VALUES ('97', '细跟鞋');
INSERT INTO `tp_weixin_tag` VALUES ('98', '牛津鞋');
INSERT INTO `tp_weixin_tag` VALUES ('99', '中跟鞋');
INSERT INTO `tp_weixin_tag` VALUES ('100', '染发膏');
INSERT INTO `tp_weixin_tag` VALUES ('101', '单鞋');
INSERT INTO `tp_weixin_tag` VALUES ('102', '蓬蓬粉');
INSERT INTO `tp_weixin_tag` VALUES ('103', '发膜');
INSERT INTO `tp_weixin_tag` VALUES ('104', '粗跟鞋');
INSERT INTO `tp_weixin_tag` VALUES ('105', '弹力素');
INSERT INTO `tp_weixin_tag` VALUES ('106', '坡跟鞋');
INSERT INTO `tp_weixin_tag` VALUES ('107', '发蜡');
INSERT INTO `tp_weixin_tag` VALUES ('108', '平底鞋');
INSERT INTO `tp_weixin_tag` VALUES ('109', '马丁靴');
INSERT INTO `tp_weixin_tag` VALUES ('110', '假发');
INSERT INTO `tp_weixin_tag` VALUES ('111', '高跟鞋');
INSERT INTO `tp_weixin_tag` VALUES ('112', '护手霜');
INSERT INTO `tp_weixin_tag` VALUES ('113', '短靴');
INSERT INTO `tp_weixin_tag` VALUES ('114', '身体乳');
INSERT INTO `tp_weixin_tag` VALUES ('115', '美颈霜');
INSERT INTO `tp_weixin_tag` VALUES ('116', '沐浴露');
INSERT INTO `tp_weixin_tag` VALUES ('117', '手工皂');
INSERT INTO `tp_weixin_tag` VALUES ('118', '眼线膏');
INSERT INTO `tp_weixin_tag` VALUES ('119', '唇彩');
INSERT INTO `tp_weixin_tag` VALUES ('120', '眉笔');
INSERT INTO `tp_weixin_tag` VALUES ('121', '眼影');
INSERT INTO `tp_weixin_tag` VALUES ('122', '腮红');
INSERT INTO `tp_weixin_tag` VALUES ('123', '口红');
INSERT INTO `tp_weixin_tag` VALUES ('124', '蜜粉');
INSERT INTO `tp_weixin_tag` VALUES ('125', '粉饼');
INSERT INTO `tp_weixin_tag` VALUES ('126', 'BB霜');
INSERT INTO `tp_weixin_tag` VALUES ('127', '睫毛膏');
INSERT INTO `tp_weixin_tag` VALUES ('128', '指甲油');
INSERT INTO `tp_weixin_tag` VALUES ('129', '香水');
INSERT INTO `tp_weixin_tag` VALUES ('130', '药妆');
INSERT INTO `tp_weixin_tag` VALUES ('131', '吸油面纸');
INSERT INTO `tp_weixin_tag` VALUES ('132', '隔离霜');
INSERT INTO `tp_weixin_tag` VALUES ('133', '精油');
INSERT INTO `tp_weixin_tag` VALUES ('134', '爽肤水');
INSERT INTO `tp_weixin_tag` VALUES ('135', '眼霜');
INSERT INTO `tp_weixin_tag` VALUES ('136', '面膜');
INSERT INTO `tp_weixin_tag` VALUES ('137', '床上用品');
INSERT INTO `tp_weixin_tag` VALUES ('138', '洗面奶');
INSERT INTO `tp_weixin_tag` VALUES ('139', '卸妆油');
INSERT INTO `tp_weixin_tag` VALUES ('140', '喷雾');
INSERT INTO `tp_weixin_tag` VALUES ('141', '防晒霜');
INSERT INTO `tp_weixin_tag` VALUES ('142', '补水');
INSERT INTO `tp_weixin_tag` VALUES ('143', '控油');
INSERT INTO `tp_weixin_tag` VALUES ('144', '美白');
INSERT INTO `tp_weixin_tag` VALUES ('145', '遮瑕');
INSERT INTO `tp_weixin_tag` VALUES ('146', '去角质');
INSERT INTO `tp_weixin_tag` VALUES ('147', '祛痘');
INSERT INTO `tp_weixin_tag` VALUES ('148', '保湿');
INSERT INTO `tp_weixin_tag` VALUES ('149', '洁面');
INSERT INTO `tp_weixin_tag` VALUES ('150', '去黑头');
INSERT INTO `tp_weixin_tag` VALUES ('151', '收毛孔');
INSERT INTO `tp_weixin_tag` VALUES ('152', '去眼袋');
INSERT INTO `tp_weixin_tag` VALUES ('153', '倩碧');
INSERT INTO `tp_weixin_tag` VALUES ('154', '雅漾');
INSERT INTO `tp_weixin_tag` VALUES ('155', '资生堂');
INSERT INTO `tp_weixin_tag` VALUES ('156', '娇韵诗');
INSERT INTO `tp_weixin_tag` VALUES ('157', '欧舒丹');
INSERT INTO `tp_weixin_tag` VALUES ('158', '兰蔻');
INSERT INTO `tp_weixin_tag` VALUES ('159', '水宝宝');
INSERT INTO `tp_weixin_tag` VALUES ('160', '雅诗兰黛');
INSERT INTO `tp_weixin_tag` VALUES ('161', '丝芙兰');
INSERT INTO `tp_weixin_tag` VALUES ('162', '露得清');
INSERT INTO `tp_weixin_tag` VALUES ('163', '收纳');
INSERT INTO `tp_weixin_tag` VALUES ('164', '台灯');
INSERT INTO `tp_weixin_tag` VALUES ('165', '时钟');
INSERT INTO `tp_weixin_tag` VALUES ('166', '吊灯');
INSERT INTO `tp_weixin_tag` VALUES ('167', '吸顶灯');
INSERT INTO `tp_weixin_tag` VALUES ('168', '杯子');
INSERT INTO `tp_weixin_tag` VALUES ('169', '置物架');
INSERT INTO `tp_weixin_tag` VALUES ('170', '香薰');
INSERT INTO `tp_weixin_tag` VALUES ('171', '地毯');
INSERT INTO `tp_weixin_tag` VALUES ('172', '落地灯');
INSERT INTO `tp_weixin_tag` VALUES ('173', '桌布');
INSERT INTO `tp_weixin_tag` VALUES ('174', '摆件');
INSERT INTO `tp_weixin_tag` VALUES ('175', '墙贴');
INSERT INTO `tp_weixin_tag` VALUES ('176', '烛台');
INSERT INTO `tp_weixin_tag` VALUES ('177', '书柜');
INSERT INTO `tp_weixin_tag` VALUES ('178', '储物罐');
INSERT INTO `tp_weixin_tag` VALUES ('179', '烹饪');
INSERT INTO `tp_weixin_tag` VALUES ('180', '烘焙');
INSERT INTO `tp_weixin_tag` VALUES ('181', '锅具');
INSERT INTO `tp_weixin_tag` VALUES ('182', '饭盒');
INSERT INTO `tp_weixin_tag` VALUES ('183', '筷子');
INSERT INTO `tp_weixin_tag` VALUES ('184', '勺');
INSERT INTO `tp_weixin_tag` VALUES ('185', '茶具');
INSERT INTO `tp_weixin_tag` VALUES ('186', '水壶');
INSERT INTO `tp_weixin_tag` VALUES ('187', '盘碟');
INSERT INTO `tp_weixin_tag` VALUES ('188', '调味瓶');
INSERT INTO `tp_weixin_tag` VALUES ('189', '餐巾');
INSERT INTO `tp_weixin_tag` VALUES ('190', '餐垫');
INSERT INTO `tp_weixin_tag` VALUES ('191', '梳妆');
INSERT INTO `tp_weixin_tag` VALUES ('192', '家居鞋');
INSERT INTO `tp_weixin_tag` VALUES ('193', '窗帘');
INSERT INTO `tp_weixin_tag` VALUES ('194', '斗柜');
INSERT INTO `tp_weixin_tag` VALUES ('195', '衣柜');
INSERT INTO `tp_weixin_tag` VALUES ('196', '床头柜');
INSERT INTO `tp_weixin_tag` VALUES ('197', '茶几');
INSERT INTO `tp_weixin_tag` VALUES ('198', '搁板');
INSERT INTO `tp_weixin_tag` VALUES ('199', '电视柜');
INSERT INTO `tp_weixin_tag` VALUES ('200', '椅子');
INSERT INTO `tp_weixin_tag` VALUES ('201', '桌子');
INSERT INTO `tp_weixin_tag` VALUES ('202', '坐垫');
INSERT INTO `tp_weixin_tag` VALUES ('203', '沙发垫');
INSERT INTO `tp_weixin_tag` VALUES ('204', '照片墙');
INSERT INTO `tp_weixin_tag` VALUES ('205', '相框');
INSERT INTO `tp_weixin_tag` VALUES ('206', '沙发');
INSERT INTO `tp_weixin_tag` VALUES ('207', '挂钩');
INSERT INTO `tp_weixin_tag` VALUES ('208', '马桶刷');
INSERT INTO `tp_weixin_tag` VALUES ('209', '衣架');
INSERT INTO `tp_weixin_tag` VALUES ('210', '皂盒');
INSERT INTO `tp_weixin_tag` VALUES ('211', '浴室垫');
INSERT INTO `tp_weixin_tag` VALUES ('212', '浴室套件');
INSERT INTO `tp_weixin_tag` VALUES ('213', '浴帘');
INSERT INTO `tp_weixin_tag` VALUES ('214', '毛巾');
INSERT INTO `tp_weixin_tag` VALUES ('215', '袜套');
INSERT INTO `tp_weixin_tag` VALUES ('216', '电子表');
INSERT INTO `tp_weixin_tag` VALUES ('217', '邮差');
INSERT INTO `tp_weixin_tag` VALUES ('218', '单肩包');
INSERT INTO `tp_weixin_tag` VALUES ('219', '女包');
INSERT INTO `tp_weixin_tag` VALUES ('220', '真皮');
INSERT INTO `tp_weixin_tag` VALUES ('221', '英国');
INSERT INTO `tp_weixin_tag` VALUES ('222', '小包');
INSERT INTO `tp_weixin_tag` VALUES ('223', '牛皮');
INSERT INTO `tp_weixin_tag` VALUES ('224', '信封');
INSERT INTO `tp_weixin_tag` VALUES ('225', '包邮');
INSERT INTO `tp_weixin_tag` VALUES ('226', '单肩');
INSERT INTO `tp_weixin_tag` VALUES ('227', '斜挎');
INSERT INTO `tp_weixin_tag` VALUES ('228', '女士');
INSERT INTO `tp_weixin_tag` VALUES ('229', '学院');
INSERT INTO `tp_weixin_tag` VALUES ('230', 'MIYI');
INSERT INTO `tp_weixin_tag` VALUES ('231', '剑桥');
INSERT INTO `tp_weixin_tag` VALUES ('232', '糖果');
INSERT INTO `tp_weixin_tag` VALUES ('233', '链条');
INSERT INTO `tp_weixin_tag` VALUES ('234', '宴会');
INSERT INTO `tp_weixin_tag` VALUES ('235', '秋冬');
INSERT INTO `tp_weixin_tag` VALUES ('236', '2012');
INSERT INTO `tp_weixin_tag` VALUES ('237', '斜挎包');
INSERT INTO `tp_weixin_tag` VALUES ('238', '大包');
INSERT INTO `tp_weixin_tag` VALUES ('239', '包包');
INSERT INTO `tp_weixin_tag` VALUES ('240', '特价');
INSERT INTO `tp_weixin_tag` VALUES ('241', '手提包');
INSERT INTO `tp_weixin_tag` VALUES ('242', '挎包');
INSERT INTO `tp_weixin_tag` VALUES ('243', '清仓');
INSERT INTO `tp_weixin_tag` VALUES ('244', '购物');
INSERT INTO `tp_weixin_tag` VALUES ('245', '古风');
INSERT INTO `tp_weixin_tag` VALUES ('246', '机车包');
INSERT INTO `tp_weixin_tag` VALUES ('247', '手提');
INSERT INTO `tp_weixin_tag` VALUES ('248', '鸵鸟');
INSERT INTO `tp_weixin_tag` VALUES ('249', '单肩斜跨');
INSERT INTO `tp_weixin_tag` VALUES ('250', '可爱');
INSERT INTO `tp_weixin_tag` VALUES ('251', '斜纹');
INSERT INTO `tp_weixin_tag` VALUES ('252', '晚宴');
INSERT INTO `tp_weixin_tag` VALUES ('253', '新娘');
INSERT INTO `tp_weixin_tag` VALUES ('254', '结婚');
INSERT INTO `tp_weixin_tag` VALUES ('255', '卡其色');
INSERT INTO `tp_weixin_tag` VALUES ('256', '米逸');
INSERT INTO `tp_weixin_tag` VALUES ('257', '手包');
INSERT INTO `tp_weixin_tag` VALUES ('258', '鳄鱼纹');
INSERT INTO `tp_weixin_tag` VALUES ('259', '复古包');
INSERT INTO `tp_weixin_tag` VALUES ('260', '翻盖');
INSERT INTO `tp_weixin_tag` VALUES ('261', '水桶');
INSERT INTO `tp_weixin_tag` VALUES ('262', '韩版');
INSERT INTO `tp_weixin_tag` VALUES ('263', '简约主义');
INSERT INTO `tp_weixin_tag` VALUES ('264', 'MIYI2012');
INSERT INTO `tp_weixin_tag` VALUES ('265', '漆皮');
INSERT INTO `tp_weixin_tag` VALUES ('266', '磨砂');
INSERT INTO `tp_weixin_tag` VALUES ('267', '发带');
INSERT INTO `tp_weixin_tag` VALUES ('268', '礼帽');
INSERT INTO `tp_weixin_tag` VALUES ('269', '锁骨链');
INSERT INTO `tp_weixin_tag` VALUES ('270', '鸭舌帽');
INSERT INTO `tp_weixin_tag` VALUES ('271', '贝雷帽');
INSERT INTO `tp_weixin_tag` VALUES ('272', '呢大衣');
INSERT INTO `tp_weixin_tag` VALUES ('273', '榴莲');
INSERT INTO `tp_weixin_tag` VALUES ('274', '秋冬装');
INSERT INTO `tp_weixin_tag` VALUES ('275', '预售');
INSERT INTO `tp_weixin_tag` VALUES ('276', '气质');
INSERT INTO `tp_weixin_tag` VALUES ('277', '20281');
INSERT INTO `tp_weixin_tag` VALUES ('278', '特卖');
INSERT INTO `tp_weixin_tag` VALUES ('279', 'LLS1009');
INSERT INTO `tp_weixin_tag` VALUES ('280', '秋季');
INSERT INTO `tp_weixin_tag` VALUES ('281', '20072');
INSERT INTO `tp_weixin_tag` VALUES ('282', '韩版波');
INSERT INTO `tp_weixin_tag` VALUES ('283', 'RENEEVON');
INSERT INTO `tp_weixin_tag` VALUES ('284', '公主');
INSERT INTO `tp_weixin_tag` VALUES ('285', '20398');
INSERT INTO `tp_weixin_tag` VALUES ('286', '肩章');
INSERT INTO `tp_weixin_tag` VALUES ('287', '牛角');
INSERT INTO `tp_weixin_tag` VALUES ('288', '定金');
INSERT INTO `tp_weixin_tag` VALUES ('289', '假领');
INSERT INTO `tp_weixin_tag` VALUES ('290', '发饰');
INSERT INTO `tp_weixin_tag` VALUES ('291', '脚链');
INSERT INTO `tp_weixin_tag` VALUES ('292', '腰链');
INSERT INTO `tp_weixin_tag` VALUES ('293', '手镯');
INSERT INTO `tp_weixin_tag` VALUES ('294', '手链');
INSERT INTO `tp_weixin_tag` VALUES ('295', '耳环');
INSERT INTO `tp_weixin_tag` VALUES ('296', '戒指');
INSERT INTO `tp_weixin_tag` VALUES ('297', '耳钉');
INSERT INTO `tp_weixin_tag` VALUES ('298', '高帮');
INSERT INTO `tp_weixin_tag` VALUES ('299', '松糕');
INSERT INTO `tp_weixin_tag` VALUES ('300', '帆布鞋');
INSERT INTO `tp_weixin_tag` VALUES ('301', '休闲鞋');
INSERT INTO `tp_weixin_tag` VALUES ('302', '帆布');
INSERT INTO `tp_weixin_tag` VALUES ('303', '女式');
INSERT INTO `tp_weixin_tag` VALUES ('304', '鞋子');
INSERT INTO `tp_weixin_tag` VALUES ('305', '学生');
INSERT INTO `tp_weixin_tag` VALUES ('306', '韩版潮');
INSERT INTO `tp_weixin_tag` VALUES ('307', '女款');
INSERT INTO `tp_weixin_tag` VALUES ('308', '系带');
INSERT INTO `tp_weixin_tag` VALUES ('309', '金币');
INSERT INTO `tp_weixin_tag` VALUES ('310', '情侣');
INSERT INTO `tp_weixin_tag` VALUES ('311', '经典');
INSERT INTO `tp_weixin_tag` VALUES ('312', '男女');
INSERT INTO `tp_weixin_tag` VALUES ('313', '学生鞋');
INSERT INTO `tp_weixin_tag` VALUES ('314', '印花');
INSERT INTO `tp_weixin_tag` VALUES ('315', '星星');
INSERT INTO `tp_weixin_tag` VALUES ('316', '越狱');
INSERT INTO `tp_weixin_tag` VALUES ('317', '米勒');
INSERT INTO `tp_weixin_tag` VALUES ('318', '松糕鞋');
INSERT INTO `tp_weixin_tag` VALUES ('319', '系列');
INSERT INTO `tp_weixin_tag` VALUES ('320', 'ca276');
INSERT INTO `tp_weixin_tag` VALUES ('321', '星旗');
INSERT INTO `tp_weixin_tag` VALUES ('322', '条纹');
INSERT INTO `tp_weixin_tag` VALUES ('323', '高帮鞋');
INSERT INTO `tp_weixin_tag` VALUES ('324', '女鞋');
INSERT INTO `tp_weixin_tag` VALUES ('325', '高鞋');
INSERT INTO `tp_weixin_tag` VALUES ('326', '韩版厚');
INSERT INTO `tp_weixin_tag` VALUES ('327', '秋冬季');
INSERT INTO `tp_weixin_tag` VALUES ('328', '子学');
INSERT INTO `tp_weixin_tag` VALUES ('329', '布鞋');
INSERT INTO `tp_weixin_tag` VALUES ('330', '项链');
INSERT INTO `tp_weixin_tag` VALUES ('331', '平底');
INSERT INTO `tp_weixin_tag` VALUES ('332', '雪地靴');
INSERT INTO `tp_weixin_tag` VALUES ('333', '棉鞋');
INSERT INTO `tp_weixin_tag` VALUES ('334', '冬季');
INSERT INTO `tp_weixin_tag` VALUES ('335', '2011');
INSERT INTO `tp_weixin_tag` VALUES ('336', '墨镜');
INSERT INTO `tp_weixin_tag` VALUES ('337', '钥匙链');
INSERT INTO `tp_weixin_tag` VALUES ('338', '腰带');
INSERT INTO `tp_weixin_tag` VALUES ('339', '手套');
INSERT INTO `tp_weixin_tag` VALUES ('340', '头花');
INSERT INTO `tp_weixin_tag` VALUES ('341', '毛衣链');
INSERT INTO `tp_weixin_tag` VALUES ('342', '瘦腿袜');
INSERT INTO `tp_weixin_tag` VALUES ('343', '发箍');
INSERT INTO `tp_weixin_tag` VALUES ('344', '手表');
INSERT INTO `tp_weixin_tag` VALUES ('345', '帽子');
INSERT INTO `tp_weixin_tag` VALUES ('346', '围巾');
INSERT INTO `tp_weixin_tag` VALUES ('347', '哥特');
INSERT INTO `tp_weixin_tag` VALUES ('348', '个性');
INSERT INTO `tp_weixin_tag` VALUES ('349', '朋克');
INSERT INTO `tp_weixin_tag` VALUES ('350', '花朵');
INSERT INTO `tp_weixin_tag` VALUES ('351', '玉');
INSERT INTO `tp_weixin_tag` VALUES ('352', '24K金');
INSERT INTO `tp_weixin_tag` VALUES ('353', '水晶');
INSERT INTO `tp_weixin_tag` VALUES ('354', '玫瑰金');
INSERT INTO `tp_weixin_tag` VALUES ('355', '银饰');
INSERT INTO `tp_weixin_tag` VALUES ('356', '马鞍包');
INSERT INTO `tp_weixin_tag` VALUES ('357', '相机包');
INSERT INTO `tp_weixin_tag` VALUES ('358', '信封包');
INSERT INTO `tp_weixin_tag` VALUES ('359', '剑桥包');
INSERT INTO `tp_weixin_tag` VALUES ('360', '豆豆鞋');
INSERT INTO `tp_weixin_tag` VALUES ('361', '运动鞋');
INSERT INTO `tp_weixin_tag` VALUES ('362', '厚底鞋');
INSERT INTO `tp_weixin_tag` VALUES ('363', '工装鞋');
INSERT INTO `tp_weixin_tag` VALUES ('364', '长靴');
INSERT INTO `tp_weixin_tag` VALUES ('365', '复古鞋');
INSERT INTO `tp_weixin_tag` VALUES ('366', '马靴');
INSERT INTO `tp_weixin_tag` VALUES ('367', '布洛克鞋');
INSERT INTO `tp_weixin_tag` VALUES ('368', '及裸靴');
INSERT INTO `tp_weixin_tag` VALUES ('369', '细跟');
INSERT INTO `tp_weixin_tag` VALUES ('370', '圆头');
INSERT INTO `tp_weixin_tag` VALUES ('371', '铆钉');
INSERT INTO `tp_weixin_tag` VALUES ('372', '豹纹');
INSERT INTO `tp_weixin_tag` VALUES ('373', '粉红');
INSERT INTO `tp_weixin_tag` VALUES ('374', '玫红');
INSERT INTO `tp_weixin_tag` VALUES ('375', '深红');
INSERT INTO `tp_weixin_tag` VALUES ('376', '防水台');
INSERT INTO `tp_weixin_tag` VALUES ('377', '防水');
INSERT INTO `tp_weixin_tag` VALUES ('378', '流苏');
INSERT INTO `tp_weixin_tag` VALUES ('379', '粗跟');
INSERT INTO `tp_weixin_tag` VALUES ('380', '尖头');
INSERT INTO `tp_weixin_tag` VALUES ('381', '坡跟');
INSERT INTO `tp_weixin_tag` VALUES ('382', '厚底');
INSERT INTO `tp_weixin_tag` VALUES ('383', '撞色');
INSERT INTO `tp_weixin_tag` VALUES ('384', '优雅');
INSERT INTO `tp_weixin_tag` VALUES ('385', '名媛');
INSERT INTO `tp_weixin_tag` VALUES ('386', '百搭');
INSERT INTO `tp_weixin_tag` VALUES ('387', '医生包');
INSERT INTO `tp_weixin_tag` VALUES ('388', '笑脸包');
INSERT INTO `tp_weixin_tag` VALUES ('389', '波士顿包');
INSERT INTO `tp_weixin_tag` VALUES ('390', '邮差包');
INSERT INTO `tp_weixin_tag` VALUES ('391', '行李箱');
INSERT INTO `tp_weixin_tag` VALUES ('392', '水桶包');
INSERT INTO `tp_weixin_tag` VALUES ('393', '帆布包');
INSERT INTO `tp_weixin_tag` VALUES ('394', '链条包');
INSERT INTO `tp_weixin_tag` VALUES ('395', '手拿包');
INSERT INTO `tp_weixin_tag` VALUES ('396', '钱包');
INSERT INTO `tp_weixin_tag` VALUES ('397', '双肩包');
INSERT INTO `tp_weixin_tag` VALUES ('398', '代购');
INSERT INTO `tp_weixin_tag` VALUES ('399', '菱形格');
INSERT INTO `tp_weixin_tag` VALUES ('400', '菱形');
INSERT INTO `tp_weixin_tag` VALUES ('401', '外贸');
INSERT INTO `tp_weixin_tag` VALUES ('402', '金属');
INSERT INTO `tp_weixin_tag` VALUES ('403', '透明');
INSERT INTO `tp_weixin_tag` VALUES ('404', '棉麻');
INSERT INTO `tp_weixin_tag` VALUES ('405', '羊皮');
INSERT INTO `tp_weixin_tag` VALUES ('406', 'PU');
INSERT INTO `tp_weixin_tag` VALUES ('407', '灰黑');
INSERT INTO `tp_weixin_tag` VALUES ('408', '兰色');
INSERT INTO `tp_weixin_tag` VALUES ('409', '浅蓝');
INSERT INTO `tp_weixin_tag` VALUES ('410', '深蓝');
INSERT INTO `tp_weixin_tag` VALUES ('411', '淡蓝');
INSERT INTO `tp_weixin_tag` VALUES ('412', '果绿');
INSERT INTO `tp_weixin_tag` VALUES ('413', '浅绿');
INSERT INTO `tp_weixin_tag` VALUES ('414', '深绿');
INSERT INTO `tp_weixin_tag` VALUES ('415', '深紫');
INSERT INTO `tp_weixin_tag` VALUES ('416', '灰白');
INSERT INTO `tp_weixin_tag` VALUES ('417', '浅黄');
INSERT INTO `tp_weixin_tag` VALUES ('418', '米黄');
INSERT INTO `tp_weixin_tag` VALUES ('419', '跟鞋');
INSERT INTO `tp_weixin_tag` VALUES ('420', '短袖');
INSERT INTO `tp_weixin_tag` VALUES ('421', '男装');
INSERT INTO `tp_weixin_tag` VALUES ('422', '西哲');
INSERT INTO `tp_weixin_tag` VALUES ('423', '男士');
INSERT INTO `tp_weixin_tag` VALUES ('424', '男款');
INSERT INTO `tp_weixin_tag` VALUES ('425', '短袖T恤');
INSERT INTO `tp_weixin_tag` VALUES ('426', '美国');
INSERT INTO `tp_weixin_tag` VALUES ('427', '2013');
INSERT INTO `tp_weixin_tag` VALUES ('428', '一派');
INSERT INTO `tp_weixin_tag` VALUES ('429', '公子');
INSERT INTO `tp_weixin_tag` VALUES ('430', '品质');
INSERT INTO `tp_weixin_tag` VALUES ('431', '奶牛');
INSERT INTO `tp_weixin_tag` VALUES ('432', '休闲潮');
INSERT INTO `tp_weixin_tag` VALUES ('433', '变色');
INSERT INTO `tp_weixin_tag` VALUES ('434', '圆领');
INSERT INTO `tp_weixin_tag` VALUES ('435', '牛奶');
INSERT INTO `tp_weixin_tag` VALUES ('436', '衣服');
INSERT INTO `tp_weixin_tag` VALUES ('437', '防晒');
INSERT INTO `tp_weixin_tag` VALUES ('438', '防紫外线');
INSERT INTO `tp_weixin_tag` VALUES ('439', '披肩');
INSERT INTO `tp_weixin_tag` VALUES ('440', '超薄');
INSERT INTO `tp_weixin_tag` VALUES ('441', '罩衫');
INSERT INTO `tp_weixin_tag` VALUES ('442', '针织衫');
INSERT INTO `tp_weixin_tag` VALUES ('443', '空调');
INSERT INTO `tp_weixin_tag` VALUES ('444', '运动套装');
INSERT INTO `tp_weixin_tag` VALUES ('445', '衣装');
INSERT INTO `tp_weixin_tag` VALUES ('446', '休闲套装');
INSERT INTO `tp_weixin_tag` VALUES ('447', '运动服');
INSERT INTO `tp_weixin_tag` VALUES ('448', '夏季');
INSERT INTO `tp_weixin_tag` VALUES ('449', '时尚休闲');
INSERT INTO `tp_weixin_tag` VALUES ('450', '套装');
INSERT INTO `tp_weixin_tag` VALUES ('451', '加大');
INSERT INTO `tp_weixin_tag` VALUES ('452', '金丝绒');
INSERT INTO `tp_weixin_tag` VALUES ('453', '天鹅绒');
INSERT INTO `tp_weixin_tag` VALUES ('454', 'tinee');
INSERT INTO `tp_weixin_tag` VALUES ('455', '生缘');
INSERT INTO `tp_weixin_tag` VALUES ('456', '高档');
INSERT INTO `tp_weixin_tag` VALUES ('457', '刺绣');
INSERT INTO `tp_weixin_tag` VALUES ('458', '夏天');
INSERT INTO `tp_weixin_tag` VALUES ('459', '蝙蝠衫');
INSERT INTO `tp_weixin_tag` VALUES ('460', '新品');
INSERT INTO `tp_weixin_tag` VALUES ('461', '上衣');
INSERT INTO `tp_weixin_tag` VALUES ('462', '女生');
INSERT INTO `tp_weixin_tag` VALUES ('463', '罗兰');
INSERT INTO `tp_weixin_tag` VALUES ('464', '天猫');
INSERT INTO `tp_weixin_tag` VALUES ('465', '中大');
INSERT INTO `tp_weixin_tag` VALUES ('466', '绣花');
INSERT INTO `tp_weixin_tag` VALUES ('467', '韩版名');
INSERT INTO `tp_weixin_tag` VALUES ('468', '春夏');
INSERT INTO `tp_weixin_tag` VALUES ('469', '皇后');
INSERT INTO `tp_weixin_tag` VALUES ('470', '图案');
INSERT INTO `tp_weixin_tag` VALUES ('471', '口袋');
INSERT INTO `tp_weixin_tag` VALUES ('472', '圆点');
INSERT INTO `tp_weixin_tag` VALUES ('473', '连帽');
INSERT INTO `tp_weixin_tag` VALUES ('474', '韩国');
INSERT INTO `tp_weixin_tag` VALUES ('475', '现货');
INSERT INTO `tp_weixin_tag` VALUES ('476', '泡泡');
INSERT INTO `tp_weixin_tag` VALUES ('477', '26320');
INSERT INTO `tp_weixin_tag` VALUES ('478', '体恤');
INSERT INTO `tp_weixin_tag` VALUES ('479', 'B0601');
INSERT INTO `tp_weixin_tag` VALUES ('480', '艾路丝');
INSERT INTO `tp_weixin_tag` VALUES ('481', '情侣装');
INSERT INTO `tp_weixin_tag` VALUES ('482', '沙滩');
INSERT INTO `tp_weixin_tag` VALUES ('483', '女裙');
INSERT INTO `tp_weixin_tag` VALUES ('484', '件套');
INSERT INTO `tp_weixin_tag` VALUES ('485', 'asdsadsad');
INSERT INTO `tp_weixin_tag` VALUES ('486', '测试');
INSERT INTO `tp_weixin_tag` VALUES ('487', '是的');
INSERT INTO `tp_weixin_tag` VALUES ('488', '擦擦');
INSERT INTO `tp_weixin_tag` VALUES ('489', '11');
INSERT INTO `tp_weixin_tag` VALUES ('490', '11111');
INSERT INTO `tp_weixin_tag` VALUES ('491', '呵呵');
INSERT INTO `tp_weixin_tag` VALUES ('492', 'ass');
INSERT INTO `tp_weixin_tag` VALUES ('493', 'sssssssssss');
INSERT INTO `tp_weixin_tag` VALUES ('494', 'asss');
INSERT INTO `tp_weixin_tag` VALUES ('495', 'asdsa');
INSERT INTO `tp_weixin_tag` VALUES ('496', 'asdsad');
INSERT INTO `tp_weixin_tag` VALUES ('497', 'cc2111');
INSERT INTO `tp_weixin_tag` VALUES ('498', 'cccccccccccc');
INSERT INTO `tp_weixin_tag` VALUES ('499', 'ccc');
INSERT INTO `tp_weixin_tag` VALUES ('500', 'cccccccccccccc');
INSERT INTO `tp_weixin_tag` VALUES ('501', '111111111111');
INSERT INTO `tp_weixin_tag` VALUES ('502', 'asdsd');
INSERT INTO `tp_weixin_tag` VALUES ('503', 'cccc');
INSERT INTO `tp_weixin_tag` VALUES ('504', 'ccccccc');
INSERT INTO `tp_weixin_tag` VALUES ('505', '斯米尔');
INSERT INTO `tp_weixin_tag` VALUES ('506', '男鞋');
INSERT INTO `tp_weixin_tag` VALUES ('507', '板鞋');
INSERT INTO `tp_weixin_tag` VALUES ('508', '透气');
INSERT INTO `tp_weixin_tag` VALUES ('509', '流行');
INSERT INTO `tp_weixin_tag` VALUES ('510', 'Simier');
INSERT INTO `tp_weixin_tag` VALUES ('511', '1039');
INSERT INTO `tp_weixin_tag` VALUES ('512', '原来');
INSERT INTO `tp_weixin_tag` VALUES ('513', '撒旦');
INSERT INTO `tp_weixin_tag` VALUES ('514', '阿萨德');
INSERT INTO `tp_weixin_tag` VALUES ('515', 'sad');
INSERT INTO `tp_weixin_tag` VALUES ('516', '2222');
INSERT INTO `tp_weixin_tag` VALUES ('517', '连衣裙');
INSERT INTO `tp_weixin_tag` VALUES ('518', '碎花');
INSERT INTO `tp_weixin_tag` VALUES ('519', '裙子');
INSERT INTO `tp_weixin_tag` VALUES ('520', '兔子');
INSERT INTO `tp_weixin_tag` VALUES ('521', '流氓');
INSERT INTO `tp_weixin_tag` VALUES ('522', '43155');
INSERT INTO `tp_weixin_tag` VALUES ('523', '实打实');
INSERT INTO `tp_weixin_tag` VALUES ('524', '蓝白');
INSERT INTO `tp_weixin_tag` VALUES ('525', '布娃娃');
INSERT INTO `tp_weixin_tag` VALUES ('526', '海军');
INSERT INTO `tp_weixin_tag` VALUES ('527', '夏款');
INSERT INTO `tp_weixin_tag` VALUES ('528', 'cccccccccc');
INSERT INTO `tp_weixin_tag` VALUES ('529', '商品');
INSERT INTO `tp_weixin_tag` VALUES ('530', 'CCCCCCCC');

-- ----------------------------
-- Table structure for `tp_weixin_topic`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_topic`;
CREATE TABLE `tp_weixin_topic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `uname` varchar(20) NOT NULL,
  `content` varchar(255) NOT NULL,
  `extra` text NOT NULL,
  `src_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '引用内容类型',
  `src_id` int(10) unsigned NOT NULL COMMENT '引用内容ID',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0，原创；1，转发；',
  `comments` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数量',
  `forwards` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '转发数量',
  `add_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_topic
-- ----------------------------
INSERT INTO `tp_weixin_topic` VALUES ('1', '14', '泡芙小米粒', '浪漫一身 2012冬装新款 专柜正品 韩版大翻领格纹毛呢大衣外套', 'http://img03.taobaocdn.com/bao/uploaded/i3/T1o2R8XdRtXXcjNLgV_020417.jpg', '0', '1', '0', '0', '0', '1353896347');
INSERT INTO `tp_weixin_topic` VALUES ('2', '10', '设计系小女生', '浪漫一身 2012冬装新款 专柜正品 欧美范 羊毛毛纯色呢短外套', 'http://img03.taobaocdn.com/bao/uploaded/i3/T1L.urXiFJXXa2x2w2_043755.jpg', '0', '2', '0', '0', '0', '1353896347');
INSERT INTO `tp_weixin_topic` VALUES ('3', '19', '安土桃山', '浪漫一身 2012秋装新款 专柜正品 休闲长袖薄外套修身立领棒球衫', 'http://img01.taobaocdn.com/bao/uploaded/i1/T1FGLNXmJbXXbjSLvb_093718.jpg', '0', '3', '0', '0', '0', '1353896347');
INSERT INTO `tp_weixin_topic` VALUES ('4', '8', '枕水而眠', '浪漫一身 2012冬装新款 欧美仿麂皮翻领长袖 修身加厚短外套', 'http://img02.taobaocdn.com/bao/uploaded/i2/T1Fw5FXmxmXXc2RowZ_034012.jpg', '0', '4', '0', '0', '0', '1353896347');
INSERT INTO `tp_weixin_topic` VALUES ('5', '8', '枕水而眠', '浪漫一身 2012秋装新款 韩版蝙蝠袖长袖 假两件休闲棉质马甲外套', 'http://img04.taobaocdn.com/bao/uploaded/i4/T1tmvLXnhmXXXxzzQW_024228.jpg', '0', '5', '0', '0', '0', '1353896347');
INSERT INTO `tp_weixin_topic` VALUES ('6', '18', '晨雪熙', '浪漫一身  直筒带帽休闲加薄长款棉衣外套', 'http://img01.taobaocdn.com/bao/uploaded/i1/T1dmCzXaxgXXcNQv71_040909.jpg', '0', '6', '0', '0', '0', '1353896348');
INSERT INTO `tp_weixin_topic` VALUES ('7', '6', '起个名字太累', '浪漫一身 2012秋装新款 修身街头运动 拉链带帽拼接袋鼠兜短外套', 'http://img01.taobaocdn.com/bao/uploaded/i1/T1yhLQXnVqXXXEh_71_042519.jpg', '0', '7', '0', '0', '0', '1353896348');
INSERT INTO `tp_weixin_topic` VALUES ('8', '18', '晨雪熙', '浪漫宣言新款春秋修身单扣长袖女装短外套1016111', 'http://img03.taobaocdn.com/bao/uploaded/i3/T1ssGRXeVoXXXa7CQ5_060120.jpg', '0', '8', '0', '0', '0', '1353896348');
INSERT INTO `tp_weixin_topic` VALUES ('9', '20', '熊小熊zz', '浪漫一身 2012秋装新款 专柜正品 韩版蝙蝠袖西装式针织开衫外套', 'http://img01.taobaocdn.com/bao/uploaded/i1/T1hP1mXjRrXXcK2PU3_050554.jpg', '0', '9', '0', '0', '0', '1353896348');
INSERT INTO `tp_weixin_topic` VALUES ('10', '8', '枕水而眠', '浪漫一身 2012秋装新款 直筒运动休闲长袖 短款立领拉链纯色外套', 'http://img01.taobaocdn.com/bao/uploaded/i1/T1As6HXiBmXXcXtaPb_093121.jpg', '0', '10', '0', '0', '0', '1353896348');
INSERT INTO `tp_weixin_topic` VALUES ('11', '18', '晨雪熙', '浪漫一身 2012秋装新款 宽松加厚运动休闲 带拉链连帽毛衣外套', 'http://img01.taobaocdn.com/bao/uploaded/i1/T1_fvTXbdjXXc3i8E1_042214.jpg', '0', '11', '0', '0', '0', '1353896348');
INSERT INTO `tp_weixin_topic` VALUES ('12', '20', '熊小熊zz', '浪漫一身 2012冬装新款 专柜正品 通勤简约 柳钉拼接时尚短外套', 'http://img04.taobaocdn.com/bao/uploaded/i4/T1vdvYXktiXXb1Opc__104853.jpg', '0', '12', '0', '0', '0', '1353896348');
INSERT INTO `tp_weixin_topic` VALUES ('13', '14', '泡芙小米粒', '浪漫一身 2012秋装新款 专柜正品 亮色带帽长袖休闲格子外套', 'http://img02.taobaocdn.com/bao/uploaded/i2/T1h4F7XbdAXXce_eEZ_032143.jpg', '0', '13', '0', '0', '0', '1353896348');
INSERT INTO `tp_weixin_topic` VALUES ('14', '14', '泡芙小米粒', '浪漫一身 2012秋装新款 通勤OL开衫V领长袖 纯色百搭时尚小外套', 'http://img04.taobaocdn.com/bao/uploaded/i4/T1qdnCXlBhXXbCT873_051140.jpg', '0', '14', '0', '0', '0', '1353896349');
INSERT INTO `tp_weixin_topic` VALUES ('15', '8', '枕水而眠', '浪漫一身 线下专柜正品 2012春装一粒扣短款西装 韩版胸花短外套', 'http://img01.taobaocdn.com/bao/uploaded/i1/T1QEO7XcBdXXXWXn.U_015911.jpg', '0', '15', '0', '0', '0', '1353896349');
INSERT INTO `tp_weixin_topic` VALUES ('16', '18', '晨雪熙', '浪漫一身 线下 专柜正品 2012春装翻领长袖中长款 夹克风衣外套女', 'http://img02.taobaocdn.com/bao/uploaded/i2/T1DReVXjtbXXcISRE9_104415.jpg', '0', '16', '0', '0', '0', '1353896349');
INSERT INTO `tp_weixin_topic` VALUES ('17', '10', '设计系小女生', '浪漫一身 2012秋装新款 线下 专柜正品 韩版双排扣风衣外套', 'http://img03.taobaocdn.com/bao/uploaded/i3/T1Xo6dXhptXXb5KSA9_104530.jpg', '0', '17', '0', '0', '0', '1353896349');
INSERT INTO `tp_weixin_topic` VALUES ('18', '17', 'V小莲小莲V', '浪漫一身 2012秋装新款 通勤长袖翻领  OL时尚帅气小西装式短外套', 'http://img03.taobaocdn.com/bao/uploaded/i3/T1ms_UXi0bXXb4juQ1_041036.jpg', '0', '18', '0', '0', '0', '1353896349');
INSERT INTO `tp_weixin_topic` VALUES ('19', '6', '起个名字太累', '浪漫一身 冬装 专柜正品 羊毛毛呢短外套  外套 女装长袖', 'http://img02.taobaocdn.com/bao/uploaded/i2/T1V_KxXkXuXXX2Qls4_053710.jpg', '0', '19', '0', '0', '0', '1353896349');
INSERT INTO `tp_weixin_topic` VALUES ('20', '18', '晨雪熙', '浪漫一身 品牌女装 专柜正品 春夏装中长款抽皱褶无袖短外套', 'http://img01.taobaocdn.com/bao/uploaded/i1/T1vN18Xe8wXXabtx7U_014829.jpg', '0', '20', '0', '0', '0', '1353896349');
INSERT INTO `tp_weixin_topic` VALUES ('21', '12', '跳房子123', 'MIYI 英国2013新款头层牛皮撞色真皮女包小包单肩包信封邮差包邮', 'http://img04.taobaocdn.com/bao/uploaded/i4/T1oAbZXkldXXcH5ug2_043616.jpg', '0', '21', '0', '0', '0', '1353902316');
INSERT INTO `tp_weixin_topic` VALUES ('22', '7', '咕咕是一只猫', 'MIYI 2012英伦复古学院风牛皮撞色邮差包 时尚单肩斜挎潮包女士包', 'http://img02.taobaocdn.com/bao/uploaded/i2/T1qrdqXXlwXXa_4U38_101909.jpg', '0', '22', '0', '0', '0', '1353902316');
INSERT INTO `tp_weixin_topic` VALUES ('23', '11', '彩色淘', 'MIYI 英伦学院风复古糖果色牛皮剑桥包 单肩包时尚女包 小包潮包', 'http://img03.taobaocdn.com/bao/uploaded/i3/T1yj1xXg01XXX_.NQ8_100702.jpg', '0', '23', '0', '0', '0', '1353902316');
INSERT INTO `tp_weixin_topic` VALUES ('24', '11', '彩色淘', 'MIYI 2012新款秋冬头层牛皮女包菱格链条包单肩包 真皮女包宴会包', 'http://img02.taobaocdn.com/bao/uploaded/i2/T1DsrnXbRkXXanw8_b_124847.jpg', '0', '24', '0', '0', '0', '1353902316');
INSERT INTO `tp_weixin_topic` VALUES ('25', '7', '咕咕是一只猫', 'MIYI 2012秋冬新款欧美时尚牛皮邮差包单肩斜挎包 复古百搭女大包', 'http://img01.taobaocdn.com/bao/uploaded/i1/T18U_SXklkXXcPno7._084022.jpg', '0', '25', '0', '0', '0', '1353902316');
INSERT INTO `tp_weixin_topic` VALUES ('26', '15', 'Prickleman', 'MIYI秋冬新款牛皮复古OL通勤单肩斜挎女包包英伦潮款特价包邮', 'http://img04.taobaocdn.com/bao/uploaded/i4/T1_HC7XhlwXXbMVu7W_023330.jpg', '0', '26', '0', '0', '0', '1353902316');
INSERT INTO `tp_weixin_topic` VALUES ('27', '11', '彩色淘', '【清仓】MIYI 简约手提包女包 单肩牛皮大包通勤包 购物包肩挎包', 'http://img03.taobaocdn.com/bao/uploaded/i3/T1rnuWXbXwXXaT3dnb_093439.jpg', '0', '27', '0', '0', '0', '1353902316');
INSERT INTO `tp_weixin_topic` VALUES ('28', '8', '枕水而眠', 'MIYI 秋冬新款复古风撞色手提包单肩包斜挎包包 机车包邮差包女包', 'http://img01.taobaocdn.com/bao/uploaded/i1/T1sPfKXcxbXXXPQIYb_123402.jpg', '0', '28', '0', '0', '0', '1353902317');
INSERT INTO `tp_weixin_topic` VALUES ('29', '16', 'Eudora_寻寻', 'MIYI 欧美鸵鸟纹头层牛皮单肩包斜跨复古女包邮差包 手提真皮女包', 'http://img04.taobaocdn.com/bao/uploaded/i4/T1gz6JXj8iXXblFxU8_100704.jpg', '0', '29', '0', '0', '0', '1353902317');
INSERT INTO `tp_weixin_topic` VALUES ('30', '20', '熊小熊zz', 'MIYI时尚可爱复古学院风糖果色单肩斜跨女包包小包牛皮邮差包特价', 'http://img02.taobaocdn.com/bao/uploaded/i2/T1m397XXJlXXaqnVg0_033805.jpg', '0', '30', '0', '0', '0', '1353902317');
INSERT INTO `tp_weixin_topic` VALUES ('31', '12', '跳房子123', 'MIYI 红色斜纹牛皮单肩包包女包 2012新款潮包结婚包新娘包晚宴包', 'http://img02.taobaocdn.com/bao/uploaded/i2/T1X697XjXbXXcMnfM._112229.jpg', '0', '31', '0', '0', '0', '1353902317');
INSERT INTO `tp_weixin_topic` VALUES ('32', '12', '跳房子123', 'MIYI米逸 新款英伦小包卡其色单肩包复古牛皮撞色复古女包邮差包', 'http://img04.taobaocdn.com/bao/uploaded/i4/T1DxC8Xi4eXXXO8ZZ5_054947.jpg', '0', '32', '0', '0', '0', '1353902317');
INSERT INTO `tp_weixin_topic` VALUES ('33', '14', '泡芙小米粒', 'MIYI新款鳄鱼纹翻盖潮手包牛皮女包单肩包复古包小包包 清仓包邮', 'http://img04.taobaocdn.com/bao/uploaded/i4/T1wBy7XflaXXX6UvwV_020442.jpg', '0', '33', '0', '0', '0', '1353902317');
INSERT INTO `tp_weixin_topic` VALUES ('34', '10', '设计系小女生', 'MIYI 2012秋冬新款头层牛皮手提包单肩包水桶真皮女包通勤包包邮', 'http://img01.taobaocdn.com/bao/uploaded/i1/T1tWOuXmFTXXXbvKDb_093608.jpg', '0', '34', '0', '0', '0', '1353902317');
INSERT INTO `tp_weixin_topic` VALUES ('35', '20', '熊小熊zz', 'MIYI单肩小包2012新款潮时尚韩版休闲牛皮欧美红色新娘手拿女包包', 'http://img01.taobaocdn.com/bao/uploaded/i1/T1xtK1XnlkXXaGp4E6_062100.jpg', '0', '35', '0', '0', '0', '1353902318');
INSERT INTO `tp_weixin_topic` VALUES ('36', '6', '起个名字太累', 'MIYI韩版新款真皮女包包2012新款潮女包水桶通勤斜挎单肩机车包邮', 'http://img02.taobaocdn.com/bao/uploaded/i2/T1Ad58XctiXXcyC0s8_100130.jpg', '0', '36', '0', '0', '0', '1353902318');
INSERT INTO `tp_weixin_topic` VALUES ('37', '13', '想太多妹子', 'MIYI 2012秋冬新款欧美头层牛皮单肩斜挎包 韩版真皮女包通勤包包', 'http://img02.taobaocdn.com/bao/uploaded/i2/T1O9mQXndwXXXD_O.0_035651.jpg', '0', '37', '0', '0', '0', '1353902318');
INSERT INTO `tp_weixin_topic` VALUES ('38', '6', '起个名字太累', 'MIYI2012新款全牛皮简约主义韩版糖果女包包复古手提大包单肩包', 'http://img01.taobaocdn.com/bao/uploaded/i1/T17FtRXaBGXXa3dJs6_061244.jpg', '0', '38', '0', '0', '0', '1353902318');
INSERT INTO `tp_weixin_topic` VALUES ('39', '17', 'V小莲小莲V', 'MIYI 鳄鱼纹晚宴包链条包单肩包 牛皮潮女包漆皮菱格包 清仓包邮', 'http://img01.taobaocdn.com/bao/uploaded/i1/T1h8HdXXXkXXcz7r.4_051921.jpg', '0', '39', '0', '0', '0', '1353902318');
INSERT INTO `tp_weixin_topic` VALUES ('40', '20', '熊小熊zz', 'MIYI休闲糖果色邮差包韩版撞色单肩斜挎包磨砂牛皮复古包包女包', 'http://img04.taobaocdn.com/bao/uploaded/i4/T1.Ly7XmhmXXcoBArb_124637.jpg', '0', '40', '0', '0', '0', '1353902318');
INSERT INTO `tp_weixin_topic` VALUES ('41', '13', '想太多妹子', '预售款 榴莲家秋冬装新款呢大衣女 双排扣气质呢大衣外套20281', 'http://img04.taobaocdn.com/bao/uploaded/i4/T1srf5Xm8XXXXV8lI__110350.jpg', '0', '41', '0', '0', '0', '1353902490');
INSERT INTO `tp_weixin_topic` VALUES ('42', '8', '枕水而眠', '特卖款2012秋冬新款榴莲家 风衣帅气外套 带帽风衣外套LLS1009', 'http://img02.taobaocdn.com/bao/uploaded/i2/T1x7C0XhxqXXbW6xwT_012127.jpg', '0', '42', '0', '0', '0', '1353902490');
INSERT INTO `tp_weixin_topic` VALUES ('43', '20', '熊小熊zz', '榴莲家2012秋季女装 韩版波点翻袖小西装外套 修身休闲西装 20072', 'http://img02.taobaocdn.com/bao/uploaded/i2/T1Ag54XbtuXXXfz.I5_060343.jpg', '0', '43', '0', '0', '0', '1353902490');
INSERT INTO `tp_weixin_topic` VALUES ('44', '18', '晨雪熙', '预售款 榴莲家2012秋冬新款 RENEEVON★秋款绝美公主外套20398', 'http://img04.taobaocdn.com/bao/uploaded/i4/T1ugbYXkpdXXa56jsZ_033049.jpg', '0', '44', '0', '0', '0', '1353902490');
INSERT INTO `tp_weixin_topic` VALUES ('45', '13', '想太多妹子', '预售定金 榴莲家 英伦双排扣毛呢外套牛角扣肩章羊毛呢大衣20459', 'http://img03.taobaocdn.com/bao/uploaded/i3/T1M463XeBdXXb0fkM9_074304.jpg', '0', '45', '0', '0', '0', '1353902490');
INSERT INTO `tp_weixin_topic` VALUES ('46', '6', '起个名字太累', '远步正品 韩版潮 厚底松糕高帮帆布鞋子 学生休闲鞋 女式帆布鞋', 'http://img04.taobaocdn.com/bao/uploaded/i4/T1ZArWXkllXXX.ujTX_085705.jpg', '0', '46', '0', '0', '0', '1353902641');
INSERT INTO `tp_weixin_topic` VALUES ('47', '11', '彩色淘', '淘金币 【远步正品】 经典糖果低帮系带韩版帆布鞋 潮 男女款情侣', 'http://img01.taobaocdn.com/bao/uploaded/i1/T1EzLEXaFlXXcpN3g3_050111.jpg', '0', '47', '0', '0', '0', '1353902641');
INSERT INTO `tp_weixin_topic` VALUES ('48', '11', '彩色淘', '【一淘专享价】远步经典糖果低帮系带韩版帆布鞋 潮 男女款情侣鞋', 'http://img01.taobaocdn.com/bao/uploaded/i1/T16.j3XdlbXXa8hGnb_123051.jpg', '0', '48', '0', '0', '0', '1353902641');
INSERT INTO `tp_weixin_topic` VALUES ('49', '13', '想太多妹子', '【远步正品】 男女帆布鞋韩版 高帮 学生情侣鞋', 'http://img03.taobaocdn.com/bao/uploaded/i3/T1qYjFXbXfXXXvyygU_015147.jpg', '0', '49', '0', '0', '0', '1353902641');
INSERT INTO `tp_weixin_topic` VALUES ('50', '13', '想太多妹子', '【远步正品】2012秋冬新款 星星印花女式低帮帆布鞋学生鞋', 'http://img01.taobaocdn.com/bao/uploaded/i1/T1K_vfXlJaXXakVJ37_064254.jpg', '0', '50', '0', '0', '0', '1353902642');
INSERT INTO `tp_weixin_topic` VALUES ('51', '12', '跳房子123', '【远步正品】男女款 越狱 低帮帆布鞋 情侣鞋', 'http://img02.taobaocdn.com/bao/uploaded/i2/T1RR2RXkNcXXceltU7_063938.jpg', '0', '51', '0', '0', '0', '1353902642');
INSERT INTO `tp_weixin_topic` VALUES ('52', '6', '起个名字太累', '【远步正品】 越狱米勒系列厚底帆布鞋松糕鞋 欧美ca276', 'http://img01.taobaocdn.com/bao/uploaded/i1/T1wnqyXXNfXXa2j1I0_034801.jpg', '0', '52', '0', '0', '0', '1353902642');
INSERT INTO `tp_weixin_topic` VALUES ('53', '14', '泡芙小米粒', '淘金币 【远步正品】 2012新款 星旗条纹男女帆布鞋情侣鞋子', 'http://img03.taobaocdn.com/bao/uploaded/i3/T197PPXgVoXXcy8OM._112623.jpg', '0', '53', '0', '0', '0', '1353902642');
INSERT INTO `tp_weixin_topic` VALUES ('54', '8', '枕水而眠', '【远步正品】2012秋冬新款 英伦印花松糕厚底高帮鞋 松糕鞋女款', 'http://img04.taobaocdn.com/bao/uploaded/i4/T1ac2vXcRvXXXE1hsU_014747.jpg', '0', '54', '0', '0', '0', '1353902642');
INSERT INTO `tp_weixin_topic` VALUES ('55', '17', 'V小莲小莲V', '【远步正品】2012秋冬新款 韩版星星印花女式低帮帆布鞋学生鞋', 'http://img02.taobaocdn.com/bao/uploaded/i2/T1E2O9XhFvXXbOmjZW_024241.jpg', '0', '55', '0', '0', '0', '1353902642');
INSERT INTO `tp_weixin_topic` VALUES ('56', '9', 'wingsa区', '【远步正品】2012秋冬新款男女帆布鞋韩版 女 潮 高帮 学生情侣鞋', 'http://img04.taobaocdn.com/bao/uploaded/i4/T1l3fIXkFgXXc53Jk9_102745.jpg', '0', '56', '0', '0', '0', '1353902642');
INSERT INTO `tp_weixin_topic` VALUES ('57', '16', 'Eudora_寻寻', '【远步正品】2012秋冬新款 印花高帮帆布鞋 韩版 学生女鞋', 'http://img01.taobaocdn.com/bao/uploaded/i1/T1msjzXfFmXXbavIAU_013829.jpg', '0', '57', '0', '0', '0', '1353902642');
INSERT INTO `tp_weixin_topic` VALUES ('58', '19', '安土桃山', '【远步正品】 加厚松高鞋休闲棉帆布鞋 韩版厚底帆松糕鞋', 'http://img01.taobaocdn.com/bao/uploaded/i1/T1RKfEXkxkXXc.bh3U_014824.jpg', '0', '58', '0', '0', '0', '1353902643');
INSERT INTO `tp_weixin_topic` VALUES ('59', '6', '起个名字太累', '【远步正品】2012秋冬季印花高帮帆布鞋 韩版 学生女鞋', 'http://img02.taobaocdn.com/bao/uploaded/i2/T1_tHLXn4fXXXLjDMT_013219.jpg', '0', '59', '0', '0', '0', '1353902643');
INSERT INTO `tp_weixin_topic` VALUES ('60', '18', '晨雪熙', '远步正品 韩版潮 厚底松糕鞋 高帮布鞋子学生休闲鞋 女鞋帆布鞋', 'http://img03.taobaocdn.com/bao/uploaded/i3/T1A4n_XglcXXcUv5g0_035537.jpg', '0', '60', '0', '0', '0', '1353902643');
INSERT INTO `tp_weixin_topic` VALUES ('61', '9', 'wingsa区', '【远步正品】2012秋冬新款时尚女士平底加绒中筒雪地靴 包邮', 'http://img02.taobaocdn.com/bao/uploaded/i2/T1MDaHXc0rXXaonAs9_104246.jpg', '0', '61', '0', '0', '0', '1353902643');
INSERT INTO `tp_weixin_topic` VALUES ('62', '10', '设计系小女生', '【远步正品】  2011冬季时尚女士平底雪地靴 棉鞋', 'http://img03.taobaocdn.com/bao/uploaded/i3/T1hG1IXelfXXcX4o.9_105150.jpg', '0', '62', '0', '0', '0', '1353902643');
INSERT INTO `tp_weixin_topic` VALUES ('63', '9', 'wingsa区', '尚西哲 男士短袖t恤 男夏装男T恤 韩版男装 t恤 大码男装短袖条纹', 'http://img02.taobaocdn.com/bao/uploaded/i2/12582025820267890/T1bjmYXzxdXXXXXXXX_!!0-item_pic.jpg', '0', '63', '0', '0', '0', '1374050935');
INSERT INTO `tp_weixin_topic` VALUES ('64', '17', 'V小莲小莲V', '凡兔夏装男t恤男装时尚男款t男恤短袖修身男士短袖T恤衫 纯棉包邮', 'http://img02.taobaocdn.com/bao/uploaded/i2/12109022512073394/T1PLJ3XEpcXXXXXXXX_!!0-item_pic.jpg', '0', '64', '0', '0', '0', '1374050935');
INSERT INTO `tp_weixin_topic` VALUES ('65', '20', '熊小熊zz', 't恤男短袖韩版2013新款夏装男装潮牌正品代购美国男士短袖af男t恤', 'http://img01.taobaocdn.com/bao/uploaded/i1/14456024842364836/T13LJuFkBfXXXXXXXX_!!0-item_pic.jpg', '0', '65', '0', '0', '0', '1374050935');
INSERT INTO `tp_weixin_topic` VALUES ('66', '18', '晨雪熙', '公子一派 2013新款男士V领短袖T恤品质男装纯棉男士T恤修身男T恤', 'http://img02.taobaocdn.com/bao/uploaded/i2/18118024057573261/T1zhO3XDhbXXXXXXXX_!!0-item_pic.jpg', '0', '66', '0', '0', '0', '1374050935');
INSERT INTO `tp_weixin_topic` VALUES ('67', '16', 'Eudora_寻寻', '奶牛的梦 短袖男装夏装2013新款 男t恤休闲翻领珠地棉男士短袖T恤', 'http://img03.taobaocdn.com/bao/uploaded/i3/14022024525063591/T1XJusXE0eXXXXXXXX_!!0-item_pic.jpg', '0', '67', '0', '0', '0', '1374050935');
INSERT INTO `tp_weixin_topic` VALUES ('68', '17', 'V小莲小莲V', '凡兔男士短袖t恤 男 短袖韩版休闲潮 渐变色t男恤 短袖 男装包邮', 'http://img02.taobaocdn.com/bao/uploaded/i2/12109021282260613/T1phB5Xs4XXXXXXXXX_!!0-item_pic.jpg', '0', '68', '0', '0', '0', '1374050936');
INSERT INTO `tp_weixin_topic` VALUES ('69', '17', 'V小莲小莲V', '2013夏装新款女装韩版大码修身纯棉圆领短袖女士T恤白色半袖t桖女', 'http://img03.taobaocdn.com/bao/uploaded/i3/19292023702975097/T1oh9JXqxeXXXXXXXX_!!0-item_pic.jpg', '0', '69', '0', '0', '0', '1374050954');
INSERT INTO `tp_weixin_topic` VALUES ('70', '17', 'V小莲小莲V', '叠语 2013新款韩版糖果色潮 宽松圆领牛奶丝短袖女士T恤 简约显瘦', 'http://img01.taobaocdn.com/bao/uploaded/i1/19443027148759978/T1n1xHFoBbXXXXXXXX_!!0-item_pic.jpg', '0', '70', '0', '0', '0', '1374050954');
INSERT INTO `tp_weixin_topic` VALUES ('71', '17', 'V小莲小莲V', '依嬅莎 2013新款夏装韩版女装专柜正品女士T恤显瘦条纹短袖t恤 女', 'http://img04.taobaocdn.com/bao/uploaded/i4/17601022601388672/T1niWsXDpfXXXXXXXX_!!0-item_pic.jpg', '0', '71', '0', '0', '0', '1374050954');
INSERT INTO `tp_weixin_topic` VALUES ('72', '9', 'wingsa区', '2013新款夏装韩版短袖潮女装上衣服胖MM大码宽松中长款短袖女t恤', 'http://img01.taobaocdn.com/bao/uploaded/i1/13873036405076498/T1THxmFm8XXXXXXXXX_!!0-item_pic.jpg', '0', '72', '0', '0', '0', '1374050955');
INSERT INTO `tp_weixin_topic` VALUES ('73', '11', '彩色淘', '防紫外线防晒衣长袖透明正品防晒服开衫超薄外套俊军披肩女防晒衫', 'http://img04.taobaocdn.com/bao/uploaded/i4/17801023056701550/T1TiOJXERbXXXXXXXX_!!0-item_pic.jpg', '0', '73', '0', '0', '0', '1374050975');
INSERT INTO `tp_weixin_topic` VALUES ('74', '15', 'Prickleman', '正品 防晒衣长袖透明蕾丝超薄外套女 夏防紫外线防晒衫开衫防晒服', 'http://img02.taobaocdn.com/bao/uploaded/i2/T1ctjsXf4gXXXA2Yvb_093214.jpg', '0', '74', '0', '0', '0', '1374050975');
INSERT INTO `tp_weixin_topic` VALUES ('75', '11', '彩色淘', '韩版防晒衫 无扣披肩 防晒衣 空调开衫罩衫超薄 针织衫外套 女夏', 'http://img04.taobaocdn.com/bao/uploaded/i4/12179025445503052/T1oHNyFl8iXXXXXXXX_!!0-item_pic.jpg', '0', '75', '0', '0', '0', '1374050975');
INSERT INTO `tp_weixin_topic` VALUES ('76', '14', '泡芙小米粒', '韩版新款夏装中长款带帽长袖透明防晒衣空调衫防晒衫披肩开衫外套', 'http://img01.taobaocdn.com/bao/uploaded/i1/15957022531960761/T1lBuqXB4fXXXXXXXX_!!0-item_pic.jpg', '0', '76', '0', '0', '0', '1374050975');
INSERT INTO `tp_weixin_topic` VALUES ('77', '20', '熊小熊zz', '休闲套装夏季韩版时尚女 短袖运动服运动套装夏装 大码女装卫衣装', 'http://img04.taobaocdn.com/bao/uploaded/i4/19109019960887092/T1cFFxXsVfXXXXXXXX_!!0-item_pic.jpg', '0', '77', '0', '0', '0', '1374050990');
INSERT INTO `tp_weixin_topic` VALUES ('78', '8', '枕水而眠', '2013新款女装夏装韩版短袖时尚休闲运动套装加大码胖mm套装运动服', 'http://img01.taobaocdn.com/bao/uploaded/i1/19526021830466963/T1KW5dXxlcXXXXXXXX_!!0-item_pic.jpg', '0', '78', '0', '0', '0', '1374050990');
INSERT INTO `tp_weixin_topic` VALUES ('79', '16', 'Eudora_寻寻', '笠莎春秋韩版天鹅绒运动套装女金丝绒大码卫衣套装休闲套装运动服', 'http://img03.taobaocdn.com/bao/uploaded/i3/10261021377723980/T1GbZ_Xl0cXXXXXXXX_!!0-item_pic.jpg', '0', '79', '0', '0', '0', '1374050990');
INSERT INTO `tp_weixin_topic` VALUES ('80', '16', 'Eudora_寻寻', 'tinee天鹅绒运动套装女款春秋休闲套装女韩版金丝绒大码卫衣套装', 'http://img01.taobaocdn.com/bao/uploaded/i1/11492021659317504/T1TyOaXCXbXXXXXXXX_!!0-item_pic.jpg', '0', '80', '0', '0', '0', '1374050990');
INSERT INTO `tp_weixin_topic` VALUES ('81', '10', '设计系小女生', '奕生缘2013新款 高档纯棉V领纯色修身白色韩版t恤短袖女夏装大码', 'http://img04.taobaocdn.com/bao/uploaded/i4/13411024173381739/T1IppqFbNXXXXXXXXX_!!0-item_pic.jpg', '0', '81', '0', '0', '0', '1374053759');
INSERT INTO `tp_weixin_topic` VALUES ('82', '11', '彩色淘', '2013夏天新款女装翻领纯棉T恤女短袖韩版修身POLO衫刺绣t恤女士t', 'http://img03.taobaocdn.com/bao/uploaded/i3/12912023572419619/T1PXyaXu4cXXXXXXXX_!!0-item_pic.jpg', '0', '82', '0', '0', '0', '1374053759');
INSERT INTO `tp_weixin_topic` VALUES ('83', '6', '起个名字太累', '新品2013胖mm显瘦款莫代尔蝙蝠衫宽松韩版短袖夏装 女 大码T恤', 'http://img03.taobaocdn.com/bao/uploaded/i3/17241035052144126/T1ANX.Xz4iXXXXXXXX_!!0-item_pic.jpg', '0', '83', '0', '0', '0', '1374053759');
INSERT INTO `tp_weixin_topic` VALUES ('84', '8', '枕水而眠', '短袖女t恤2013夏装韩版新款小清新女装宽松甜美上衣女生白色t桖', 'http://img04.taobaocdn.com/bao/uploaded/i4/15843024126370724/T1Fq9QXstiXXXXXXXX_!!0-item_pic.jpg', '0', '84', '0', '0', '0', '1374053759');
INSERT INTO `tp_weixin_topic` VALUES ('85', '18', '晨雪熙', '欧罗兰2013夏季新款女装韩版宽松圆领大码纯棉短袖中长款t恤女', 'http://img01.taobaocdn.com/bao/uploaded/i1/13331035721128449/T1bG5JXB8iXXXXXXXX_!!0-item_pic.jpg', '0', '85', '0', '0', '0', '1374053759');
INSERT INTO `tp_weixin_topic` VALUES ('86', '18', '晨雪熙', '年中大促天猫 夏装 韩版名族风时尚修身大码绣花女装棉短袖t恤女', 'http://img04.taobaocdn.com/bao/uploaded/i4/10114024878170152/T162pAFoBcXXXXXXXX_!!0-item_pic.jpg', '0', '86', '0', '0', '0', '1374053759');
INSERT INTO `tp_weixin_topic` VALUES ('87', '7', '咕咕是一只猫', '春夏新品潮爆图案印花双口袋纯棉宽松大版蝙蝠T恤 CC皇后家C0062', 'http://img01.taobaocdn.com/bao/uploaded/i1/10917022951369205/T1wfGxXCxiXXXXXXXX_!!0-item_pic.jpg', '0', '87', '0', '0', '0', '1374053759');
INSERT INTO `tp_weixin_topic` VALUES ('88', '19', '安土桃山', '印迪洋时2013夏季新品女装韩版修身大码圆点印花连帽短袖T恤女', 'http://img01.taobaocdn.com/bao/uploaded/i1/12816023555462640/T18JONXApeXXXXXXXX_!!0-item_pic.jpg', '0', '88', '0', '0', '0', '1374053759');
INSERT INTO `tp_weixin_topic` VALUES ('89', '6', '起个名字太累', '2013夏装女装韩国代购潮现货7分泡泡袖胖MM大码长款宽松女t恤短袖', 'http://img03.taobaocdn.com/bao/uploaded/i3/18997020551833232/T1DaRKXCReXXXXXXXX_!!0-item_pic.jpg', '0', '89', '0', '0', '0', '1374053759');
INSERT INTO `tp_weixin_topic` VALUES ('90', '17', 'V小莲小莲V', '2013夏装韩版女款新款大码上衣网纱打底衫纯色短袖t恤短袖26320', 'http://img01.taobaocdn.com/bao/uploaded/i1/11867023623831451/T14UeRXDdXXXXXXXXX_!!0-item_pic.jpg', '0', '90', '0', '0', '0', '1374053759');
INSERT INTO `tp_weixin_topic` VALUES ('91', '18', '晨雪熙', '哥弟专柜正品2013新款夏装新品大码女装短袖T恤 女式韩版修身上衣', 'http://img04.taobaocdn.com/bao/uploaded/i4/15721024181492800/T1wMS5Xy4cXXXXXXXX_!!0-item_pic.jpg', '0', '91', '0', '0', '0', '1374053760');
INSERT INTO `tp_weixin_topic` VALUES ('92', '17', 'V小莲小莲V', '夏装新款2013大码女装 胖mm夏装韩版修身显瘦打底衫宽松短袖t恤', 'http://img04.taobaocdn.com/bao/uploaded/i4/13434022985138156/T1Lz1zXtXXXXXXXXXX_!!0-item_pic.jpg', '0', '92', '0', '0', '0', '1374053760');
INSERT INTO `tp_weixin_topic` VALUES ('93', '10', '设计系小女生', '2013夏装新款韩版女装 时尚修身百搭体恤圆领印花纯棉女士T恤短袖', 'http://image.taobao.com/bao/uploaded/i4/19292023009681721/T1pgyHXEJfXXXXXXXX_!!2-item_pic.png', '0', '93', '0', '0', '0', '1374053760');
INSERT INTO `tp_weixin_topic` VALUES ('94', '9', 'wingsa区', '艾路丝婷2013夏装新款大码韩版女装修身体恤短袖打底衫T恤女B0601', 'http://img03.taobaocdn.com/bao/uploaded/i3/13541025066567942/T1PPWEXxpfXXXXXXXX_!!0-item_pic.jpg', '0', '94', '0', '0', '0', '1374053760');
INSERT INTO `tp_weixin_topic` VALUES ('95', '19', '安土桃山', '都衣舞尔情侣装短袖撞色拼接夏装新款韩国男女大码T恤沙滩情侣衫', 'http://img04.taobaocdn.com/bao/uploaded/i4/18075021709325472/T1L8N.XudgXXXXXXXX_!!0-item_pic.jpg', '0', '95', '0', '0', '0', '1374053760');
INSERT INTO `tp_weixin_topic` VALUES ('96', '9', 'wingsa区', '包邮特价2013女士夏装纯色t恤/韩版修身V领白色短袖t恤女/胖mm潮', 'http://img02.taobaocdn.com/bao/uploaded/i2/14997021759858927/T1RF1XXAddXXXXXXXX_!!0-item_pic.jpg', '0', '96', '0', '0', '0', '1374053760');
INSERT INTO `tp_weixin_topic` VALUES ('97', '17', 'V小莲小莲V', '包邮2013男T女裙女t女恤短袖情侣装夏装长款打底衫女韩版情侣T恤', 'http://img04.taobaocdn.com/bao/uploaded/i4/12239024730307672/T14HWxXqpbXXXXXXXX_!!0-item_pic.jpg', '0', '97', '0', '0', '0', '1374053760');
INSERT INTO `tp_weixin_topic` VALUES ('98', '10', '设计系小女生', '2013夏装新款 韩版大码修身 圆领雪纺袖印花 纯棉短袖女T恤 夏', 'http://img02.taobaocdn.com/bao/uploaded/i2/12023026773167605/T14VXuFiNgXXXXXXXX_!!0-item_pic.jpg', '0', '98', '0', '0', '0', '1374053760');
INSERT INTO `tp_weixin_topic` VALUES ('99', '17', 'V小莲小莲V', '2013夏装新款情侣装两件套女裙韩国版新品时尚撞色拼接男短袖T恤', 'http://img03.taobaocdn.com/bao/uploaded/i3/10519034815428119/T1GVSyXDFaXXXXXXXX_!!0-item_pic.jpg', '0', '99', '0', '0', '0', '1374053760');
INSERT INTO `tp_weixin_topic` VALUES ('100', '11', '彩色淘', '2013夏装新款 韩版女装纯棉修身百搭圆领短袖T恤女 大码白色半袖', 'http://img04.taobaocdn.com/bao/uploaded/i4/18861022761956552/T1RGWvXvhfXXXXXXXX_!!0-item_pic.jpg', '0', '100', '0', '0', '0', '1374053760');
INSERT INTO `tp_weixin_topic` VALUES ('101', '9', 'wingsa区', 'sadasdsadsadsad', '1307/18/51e7a67871098.gif', '0', '101', '0', '0', '0', '1374135928');
INSERT INTO `tp_weixin_topic` VALUES ('102', '8', '枕水而眠', '测试', '1307/18/51e7ad7789d26.jpg', '0', '102', '0', '0', '0', '1374137719');
INSERT INTO `tp_weixin_topic` VALUES ('103', '18', '晨雪熙', 'Simier斯米尔流行男鞋潮鞋夏季透气低帮鞋男休闲鞋男英伦板鞋1039', 'http://img03.taobaocdn.com/bao/uploaded/i3/19490024699170259/T1QmRxFX8aXXXXXXXX_!!0-item_pic.jpg', '0', '110', '0', '0', '0', '1374216640');
INSERT INTO `tp_weixin_topic` VALUES ('104', '11', '彩色淘', '缀爱依 连衣裙 夏季 韩版 新款女装小碎花休闲修身雪纺连衣裙裙子', 'http://img01.taobaocdn.com/bao/uploaded/i1/16534025602603614/T1nUSPXq0hXXXXXXXX_!!0-item_pic.jpg', '0', '115', '0', '0', '0', '1374829008');
INSERT INTO `tp_weixin_topic` VALUES ('105', '11', '彩色淘', '2013情侣装夏装 流氓兔子韩版短袖纯棉打底衫情侣t恤修身男女款', 'http://img01.taobaocdn.com/bao/uploaded/i1/12542025078365981/T14i8OFohXXXXXXXXX_!!0-item_pic.jpg', '0', '116', '0', '0', '0', '1375070862');

-- ----------------------------
-- Table structure for `tp_weixin_topic_at`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_topic_at`;
CREATE TABLE `tp_weixin_topic_at` (
  `uid` int(10) unsigned NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`uid`,`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_topic_at
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_topic_comment`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_topic_comment`;
CREATE TABLE `tp_weixin_topic_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `uname` varchar(20) NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `author_uid` int(10) unsigned NOT NULL,
  `content` varchar(255) NOT NULL,
  `add_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_topic_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_topic_index`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_topic_index`;
CREATE TABLE `tp_weixin_topic_index` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户ID',
  `tid` int(10) unsigned NOT NULL COMMENT '信息ID',
  `author_id` int(10) unsigned NOT NULL COMMENT '发布者ID',
  `add_time` int(10) unsigned NOT NULL,
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_topic_index
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_topic_relation`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_topic_relation`;
CREATE TABLE `tp_weixin_topic_relation` (
  `tid` int(10) unsigned NOT NULL COMMENT '信息ID',
  `src_tid` int(10) unsigned NOT NULL COMMENT '被引用信息ID',
  `author_uid` int(10) unsigned NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '操作类型(1,转发)',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_topic_relation
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_user`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_user`;
CREATE TABLE `tp_weixin_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uc_uid` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(100) NOT NULL DEFAULT '0',
  `password` varchar(32) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1男，0女',
  `tags` varchar(50) NOT NULL COMMENT '个人标签',
  `intro` varchar(500) NOT NULL,
  `byear` smallint(4) unsigned NOT NULL,
  `bmonth` tinyint(2) unsigned NOT NULL,
  `bday` tinyint(2) unsigned NOT NULL,
  `province` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `score` int(10) unsigned NOT NULL DEFAULT '0',
  `score_level` int(10) unsigned NOT NULL DEFAULT '0',
  `cover` varchar(255) NOT NULL,
  `reg_ip` varchar(15) NOT NULL,
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0',
  `last_time` int(10) unsigned NOT NULL DEFAULT '0',
  `last_ip` varchar(15) DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `shares` int(10) unsigned DEFAULT '0',
  `likes` int(10) unsigned DEFAULT '0',
  `follows` int(10) unsigned DEFAULT '0',
  `fans` int(10) unsigned DEFAULT '0',
  `albums` int(10) unsigned DEFAULT '0',
  `daren` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_user
-- ----------------------------
INSERT INTO `tp_weixin_user` VALUES ('1', '0', 'dan8288749', '5f05b9a44a2ef4c619143b44fe5dc926', '313131@qq.com', '1', '', '', '2013', '7', '19', '', '', '0', '0', '', '192.168.1.111', '1353895892', '1376018066', '0', '1', '0', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `tp_weixin_user_address`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_user_address`;
CREATE TABLE `tp_weixin_user_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `consignee` varchar(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `sheng` varchar(50) DEFAULT NULL,
  `shi` varchar(50) DEFAULT NULL,
  `qu` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_user_address
-- ----------------------------
INSERT INTO `tp_weixin_user_address` VALUES ('22', '26', 'Ace', '金沙花园', '12345678910', '福建省', '厦门市', '思明区');
INSERT INTO `tp_weixin_user_address` VALUES ('21', '1', '周建群', '金沙花园', '15880765056', '福建省', '厦门市', '思明区');
INSERT INTO `tp_weixin_user_address` VALUES ('20', '27', 'ff', 'fefefefefe', '11111111111', '福建省', '厦门市', '思明区');

-- ----------------------------
-- Table structure for `tp_weixin_user_bind`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_user_bind`;
CREATE TABLE `tp_weixin_user_bind` (
  `uid` int(10) unsigned NOT NULL,
  `type` varchar(60) NOT NULL,
  `keyid` varchar(100) NOT NULL,
  `info` text NOT NULL,
  KEY `uid` (`uid`),
  KEY `uid_type` (`uid`,`type`),
  KEY `type_keyid` (`type`,`keyid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_user_bind
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_user_follow`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_user_follow`;
CREATE TABLE `tp_weixin_user_follow` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户ID',
  `follow_uid` int(10) unsigned NOT NULL COMMENT '被关注者ID',
  `add_time` int(10) unsigned NOT NULL,
  `mutually` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`follow_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_user_follow
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_user_msgtip`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_user_msgtip`;
CREATE TABLE `tp_weixin_user_msgtip` (
  `uid` int(10) unsigned NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1:关注，2:提到，3:私信，4:通知',
  `num` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_user_msgtip
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_weixin_user_stat`
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_user_stat`;
CREATE TABLE `tp_weixin_user_stat` (
  `uid` int(10) unsigned NOT NULL,
  `action` varchar(20) NOT NULL,
  `num` int(10) unsigned NOT NULL,
  `last_time` int(10) unsigned NOT NULL,
  UNIQUE KEY `uid_type` (`uid`,`action`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_user_stat
-- ----------------------------
INSERT INTO `tp_weixin_user_stat` VALUES ('9', 'login', '1', '1353909837');
INSERT INTO `tp_weixin_user_stat` VALUES ('13', 'login', '1', '1353909897');
INSERT INTO `tp_weixin_user_stat` VALUES ('16', 'login', '1', '1353909964');
INSERT INTO `tp_weixin_user_stat` VALUES ('15', 'login', '1', '1353910012');
INSERT INTO `tp_weixin_user_stat` VALUES ('11', 'login', '1', '1353910069');
INSERT INTO `tp_weixin_user_stat` VALUES ('7', 'login', '1', '1353910109');
INSERT INTO `tp_weixin_user_stat` VALUES ('12', 'login', '1', '1353910146');
INSERT INTO `tp_weixin_user_stat` VALUES ('17', 'login', '1', '1353910177');
INSERT INTO `tp_weixin_user_stat` VALUES ('20', 'login', '1', '1353910221');
INSERT INTO `tp_weixin_user_stat` VALUES ('6', 'login', '1', '1353910265');
INSERT INTO `tp_weixin_user_stat` VALUES ('18', 'login', '1', '1353910348');
INSERT INTO `tp_weixin_user_stat` VALUES ('8', 'login', '1', '1353910407');
INSERT INTO `tp_weixin_user_stat` VALUES ('19', 'login', '1', '1353910445');
INSERT INTO `tp_weixin_user_stat` VALUES ('10', 'login', '1', '1353910499');
INSERT INTO `tp_weixin_user_stat` VALUES ('14', 'login', '1', '1353910539');
INSERT INTO `tp_weixin_user_stat` VALUES ('21', 'register', '1', '1374633583');
INSERT INTO `tp_weixin_user_stat` VALUES ('21', 'login', '1', '1374633583');
INSERT INTO `tp_weixin_user_stat` VALUES ('22', 'register', '1', '1374724879');
INSERT INTO `tp_weixin_user_stat` VALUES ('22', 'login', '1', '1374724879');
INSERT INTO `tp_weixin_user_stat` VALUES ('23', 'register', '1', '1374724936');
INSERT INTO `tp_weixin_user_stat` VALUES ('23', 'login', '1', '1374724936');
INSERT INTO `tp_weixin_user_stat` VALUES ('24', 'register', '1', '1374724990');
INSERT INTO `tp_weixin_user_stat` VALUES ('24', 'login', '1', '1374724990');
INSERT INTO `tp_weixin_user_stat` VALUES ('26', 'register', '1', '1375152929');
INSERT INTO `tp_weixin_user_stat` VALUES ('26', 'login', '1', '1375152929');
INSERT INTO `tp_weixin_user_stat` VALUES ('27', 'register', '1', '1375154088');
INSERT INTO `tp_weixin_user_stat` VALUES ('27', 'login', '1', '1375154088');
INSERT INTO `tp_weixin_user_stat` VALUES ('28', 'register', '1', '1375176967');
INSERT INTO `tp_weixin_user_stat` VALUES ('28', 'login', '1', '1375176967');
INSERT INTO `tp_weixin_user_stat` VALUES ('29', 'register', '1', '1375250687');
INSERT INTO `tp_weixin_user_stat` VALUES ('29', 'login', '1', '1375250687');
