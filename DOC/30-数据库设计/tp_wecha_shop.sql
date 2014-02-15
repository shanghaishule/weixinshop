-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 01 月 28 日 14:51
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
-- 表的结构 `tp_wecha_shop`
--

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
ALTER TABLE`tp_wecha_shop`CHANGE`HaveReal``HaveReal` TINYINT( 4)NOTNULL DEFAULT'0' COMMENT'0-无实体店 1-有实体店 2-认证中 3-审核不通过';
ALTER TABLE`tp_wecha_shop`ADD`licence` VARCHAR( 255)NULL ;
ALTER TABLE`tp_wecha_shop`ADD`address` VARCHAR( 255)NULL ;

ALTER TABLE`tp_wecha_shop`ADD`phone` VARCHAR( 11) NULL ;
ALTER TABLE`tp_wecha_shop`ADD`logo` VARCHAR(255) NULL ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
