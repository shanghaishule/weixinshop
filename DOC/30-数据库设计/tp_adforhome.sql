-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 01 月 22 日 08:37
-- 服务器版本: 5.6.12-log
-- PHP 版本: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `bestchoi_shule`
--

-- --------------------------------------------------------

--
-- 表的结构 `tp_adforhome`
--

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