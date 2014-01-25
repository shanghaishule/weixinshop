-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 01 月 25 日 05:04
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
-- 表的结构 `tp_access`
--

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
