-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2014 年 02 月 19 日 16:44
-- 服务器版本: 5.5.32
-- PHP 版本: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `bestchoi_shule`
--
delete from tp_comments;

-- --------------------------------------------------------

--
-- 表的结构 `tp_comments`
--

CREATE TABLE IF NOT EXISTS `tp_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `comments_type` int(3) unsigned NOT NULL,
  `user_comments` varchar(1024) DEFAULT NULL,
  `create_time` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `tp_comments`
--

INSERT INTO `tp_comments` (`id`, `item_id`, `user_name`, `comments_type`, `user_comments`, `create_time`) VALUES
(1, 139, 'admin', 1, 'dd', '14-02-18 02:52:02'),
(2, 135, 'admin', 1, 'qwe', '14-02-18 03:00:02'),
(3, 139, 'admin', 1, '123', '14-02-18 03:01:02'),
(4, 139, 'admin', 2, 'dd', '14-02-18 03:01:02'),
(22, 134, 'admin', 1, '挺好用的。', '14-02-18 16:20:02'),
(21, 134, 'admin', 1, 'aabc', '14-02-18 09:09:02');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
