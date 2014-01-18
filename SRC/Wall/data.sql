-- phpMyAdmin SQL Dump
-- http://www.phpmyadmin.net
--
-- 生成日期: 2013 年 08 月 06 日 21:25

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `RoHehltiZClVTMajFqPh`
--

-- --------------------------------------------------------

--
-- 表的结构 `weixin_admin`
--

CREATE TABLE IF NOT EXISTS `weixin_admin` (
  `user` text NOT NULL,
  `pwd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `weixin_admin`
--

INSERT INTO `weixin_admin` (`user`, `pwd`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- 表的结构 `weixin_flag`
--

CREATE TABLE IF NOT EXISTS `weixin_flag` (
  `openid` varchar(255) NOT NULL,
  `flag` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  `nickname` text NOT NULL,
  PRIMARY KEY  (`openid`),
  UNIQUE KEY `openid` (`openid`),
  KEY `openid_2` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `weixin_flag`
--

INSERT INTO `weixin_flag` (`openid`, `flag`, `vote`, `nickname`) VALUES
('okuOVjuycpVi_SKaC7_7Jhi6sm4I', -1, 1, ''),
('okuOVjrT_gRIn7PSk1j4wrQR6i6I', -1, 1, ''),
('okuOVjrFJ06a7xqqOgObnk_A19sQ', -1, 1, ''),
('okuOVjgy6hkjoK7CA_67TLiZX9ro', -1, 1, ''),
('okuOVjqQJahBcZxUeu26ls1M3Zjw', -1, 1, ''),
('okuOVjnUgF2atpKmGcexi2m6CDO8', -1, 1, ''),
('okuOVjn8L8emG9kN-IIBup5HRdmE', -1, 1, ''),
('okuOVjm0gl45Q0o3JZGjZ7skn9ms', -1, 1, ''),
('okuOVjseKeFe6-zbFC8U_gA2wJaQ', -1, 1, ''),
('okuOVjqOaECNNUL74DZlsCMWqY8U', -1, 1, ''),
('okuOVjmSvprVR1fXHwG4zU-5ZlNI', -1, 1, ''),
('okuOVjhwG8oPS73-iJVZA_P-Yl68', -1, 1, ''),
('okuOVjnS291JbEfU3ZeJWj5LMy6Q', -1, 1, ''),
('okuOVjmldq9GXbVfxvGlmoJh7GYs', -1, 1, ''),
('okuOVjuCeIPjs1m6z6soyKMfaKcA', -1, 1, ''),
('okuOVjlfDOiag9VCX43Fx0YVdQWg', -1, 1, ''),
('okuOVjow0bnhu9oWy1S5NueAuvfo', -1, 1, ''),
('okuOVjjm6ksDKXbqe39wj0-yrfrk', -1, 1, ''),
('okuOVjoyEQ6xNLQO39s6K_Jqhvs8', -1, 1, ''),
('okuOVjsN4iDb262nDzbLdyEcXnrs', -1, 1, ''),
('okuOVjtMlh5QTM4RZEfmB8TuW1qg', -1, 1, ''),
('okuOVjpPWzAz-DjyErGjiU6QW_sA', -1, 1, ''),
('okuOVjttu5JtVP_K5P24xKyHDsvY', -1, 1, ''),
('okuOVjsEHaY3qFyhSPGiYltcH9gQ', -1, 1, ''),
('okuOVjt3uMyDGFgrckBqVRFtVpos', -1, 1, ''),
('okuOVjpYd95V3XxWoU-dc_wp3KVw', -1, 1, ''),
('okuOVjkV2w_yvoJd8BWjNcF71oh0', -1, 1, ''),
('okuOVjuS12FpzeTMrIvmAQRMv0Sw', -1, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `weixin_vote`
--

CREATE TABLE IF NOT EXISTS `weixin_vote` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `res` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `res` (`res`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `weixin_vote`
--

INSERT INTO `weixin_vote` (`id`, `name`, `res`) VALUES
(1, '杨峰', 6),
(2, '荷莉', 2),
(3, '赵姝婷', 1),
(4, '赵六', 1),
(5, '赵爽', 2),
(6, '岗拉美朵', 1),
(7, '高姝璇', 0),
(8, '郭思彤', 0),
(9, '邓可', 0),
(10, '周润发', 0),
(11, '江巴群培', 1),
(12, '狄义宁', 0),
(13, '黄河', 1),
(14, '郭富城', 1),
(15, '陈冠希', 1);

-- --------------------------------------------------------

--
-- 表的结构 `weixin_wall`
--

CREATE TABLE IF NOT EXISTS `weixin_wall` (
  `id` int(11) NOT NULL auto_increment,
  `messageid` int(11) NOT NULL,
  `fakeid` varchar(255) NOT NULL,
  `num` int(11) NOT NULL,
  `content` text NOT NULL,
  `nickname` text NOT NULL,
  `avatar` text NOT NULL,
  `ret` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- 表的结构 `weixin_wall`
--

CREATE TABLE IF NOT EXISTS `allsql` (
  `id` int(11) NOT NULL auto_increment,
  `messageid` int(11) NOT NULL,
  `fakeid` varchar(255) NOT NULL,
  `num` int(11) NOT NULL,
  `content` text NOT NULL,
  `nickname` text NOT NULL,
  `avatar` text NOT NULL,
  `ret` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `weixin_wall_num`
--

CREATE TABLE IF NOT EXISTS `weixin_wall_num` (
  `num` int(11) NOT NULL,
  PRIMARY KEY  (`num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `weixin_wall_num`
--

INSERT INTO `weixin_wall_num` (`num`) VALUES
(1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
