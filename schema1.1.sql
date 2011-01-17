-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 建立日期: Jan 17, 2011, 08:21 AM
-- 伺服器版本: 5.1.44
-- PHP 版本: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `Travel Journal`
--

-- --------------------------------------------------------

--
-- 資料表格式： `ACCOUNT`
--

CREATE TABLE IF NOT EXISTS `ACCOUNT` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`aid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- 列出以下資料庫的數據： `ACCOUNT`
--

INSERT INTO `ACCOUNT` (`aid`, `password`, `username`, `uid`) VALUES
(1, 'qwer', 'Joshua', 1);

-- --------------------------------------------------------

--
-- 資料表格式： `CITY`
--

CREATE TABLE IF NOT EXISTS `CITY` (
  `cname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`cid`),
  KEY `cname` (`cname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `CITY`
--


-- --------------------------------------------------------

--
-- 資料表格式： `COUNTRY`
--

CREATE TABLE IF NOT EXISTS `COUNTRY` (
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 列出以下資料庫的數據： `COUNTRY`
--


-- --------------------------------------------------------

--
-- 資料表格式： `DAY`
--

CREATE TABLE IF NOT EXISTS `DAY` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `next` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  PRIMARY KEY (`did`),
  KEY `next` (`next`),
  KEY `tid` (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `DAY`
--


-- --------------------------------------------------------

--
-- 資料表格式： `DAYS_SCHEDULE`
--

CREATE TABLE IF NOT EXISTS `DAYS_SCHEDULE` (
  `did` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`did`,`sid`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 列出以下資料庫的數據： `DAYS_SCHEDULE`
--


-- --------------------------------------------------------

--
-- 資料表格式： `EXPANSE`
--

CREATE TABLE IF NOT EXISTS `EXPANSE` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `purchase` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `EXPANSE`
--


-- --------------------------------------------------------

--
-- 資料表格式： `FAV_THING`
--

CREATE TABLE IF NOT EXISTS `FAV_THING` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `type` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `lid` int(11) NOT NULL,
  PRIMARY KEY (`fid`),
  KEY `lid` (`lid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `FAV_THING`
--


-- --------------------------------------------------------

--
-- 資料表格式： `GROUP`
--

CREATE TABLE IF NOT EXISTS `GROUP` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`gid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `GROUP`
--


-- --------------------------------------------------------

--
-- 資料表格式： `GROUP_TRAVELLER`
--

CREATE TABLE IF NOT EXISTS `GROUP_TRAVELLER` (
  `gid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `invite_status` varchar(255) NOT NULL,
  PRIMARY KEY (`gid`,`uid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 列出以下資料庫的數據： `GROUP_TRAVELLER`
--


-- --------------------------------------------------------

--
-- 資料表格式： `LOCATION`
--

CREATE TABLE IF NOT EXISTS `LOCATION` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `next_traffic` varchar(255) NOT NULL,
  `tid` int(11) NOT NULL,
  `next` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`lid`),
  KEY `tid` (`tid`),
  KEY `next` (`next`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `LOCATION`
--


-- --------------------------------------------------------

--
-- 資料表格式： `LOCATION_DAY`
--

CREATE TABLE IF NOT EXISTS `LOCATION_DAY` (
  `lid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  PRIMARY KEY (`lid`,`did`),
  KEY `did` (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 列出以下資料庫的數據： `LOCATION_DAY`
--


-- --------------------------------------------------------

--
-- 資料表格式： `SCHEDULE`
--

CREATE TABLE IF NOT EXISTS `SCHEDULE` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  `next` int(11) DEFAULT NULL,
  PRIMARY KEY (`sid`),
  KEY `next` (`next`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `SCHEDULE`
--


-- --------------------------------------------------------

--
-- 資料表格式： `SHELTER`
--

CREATE TABLE IF NOT EXISTS `SHELTER` (
  `shid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `info` text NOT NULL,
  `lid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  PRIMARY KEY (`shid`),
  KEY `lid` (`lid`),
  KEY `did` (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `SHELTER`
--


-- --------------------------------------------------------

--
-- 資料表格式： `TRAVELLER`
--

CREATE TABLE IF NOT EXISTS `TRAVELLER` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `bdate` date NOT NULL,
  `addr` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- 列出以下資料庫的數據： `TRAVELLER`
--

INSERT INTO `TRAVELLER` (`uid`, `name`, `gender`, `bdate`, `addr`) VALUES
(1, 'Joshua', 'male', '1989-07-23', 'home');

-- --------------------------------------------------------

--
-- 資料表格式： `TRAVELLER_CITY`
--

CREATE TABLE IF NOT EXISTS `TRAVELLER_CITY` (
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`uid`,`cid`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 列出以下資料庫的數據： `TRAVELLER_CITY`
--


-- --------------------------------------------------------

--
-- 資料表格式： `TRIP`
--

CREATE TABLE IF NOT EXISTS `TRIP` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `time` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `belongs_to` varchar(255) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- 列出以下資料庫的數據： `TRIP`
--

INSERT INTO `TRIP` (`tid`, `name`, `type`, `time`, `status`, `belongs_to`, `owner_id`) VALUES
(1, 'hahaha', 'business', '0000-00-00', '', 'group', 0),
(2, 'hahaha', 'business', '0000-00-00', '', 'group', 0),
(3, 'hahaha', 'business', '0000-00-00', '', 'group', 0),
(4, '', '', '0000-00-00', '', 'group', 0),
(5, 'hahaha', 'business', '0000-00-00', '', 'group', 0),
(6, 'ya', 'pleasure', '0000-00-00', '', 'group', 0),
(7, 'yo', 'other', '0000-00-00', '', 'traveller', 0),
(8, 'j', 'pleasure', '0000-00-00', 'male', 'group', 0),
(9, 'kk', 'pleasure', '0001-01-02', 'female', 'group', 0),
(10, 'jkjkjk', 'family', '0001-01-03', 'male', 'group', 0),
(11, 'jkjkjk', 'family', '0001-01-03', 'male', 'group', 99);

--
-- 備份資料表限制
--

--
-- 資料表限制 `ACCOUNT`
--
ALTER TABLE `ACCOUNT`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `traveller` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表限制 `CITY`
--
ALTER TABLE `CITY`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`cname`) REFERENCES `country` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表限制 `DAY`
--
ALTER TABLE `DAY`
  ADD CONSTRAINT `day_ibfk_2` FOREIGN KEY (`tid`) REFERENCES `trip` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `day_ibfk_1` FOREIGN KEY (`next`) REFERENCES `day` (`did`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表限制 `DAYS_SCHEDULE`
--
ALTER TABLE `DAYS_SCHEDULE`
  ADD CONSTRAINT `days_schedule_ibfk_1` FOREIGN KEY (`did`) REFERENCES `day` (`did`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `days_schedule_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `schedule` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表限制 `FAV_THING`
--
ALTER TABLE `FAV_THING`
  ADD CONSTRAINT `fav_thing_ibfk_1` FOREIGN KEY (`lid`) REFERENCES `location_day` (`lid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表限制 `GROUP`
--
ALTER TABLE `GROUP`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `traveller` (`uid`);

--
-- 資料表限制 `GROUP_TRAVELLER`
--
ALTER TABLE `GROUP_TRAVELLER`
  ADD CONSTRAINT `group_traveller_ibfk_1` FOREIGN KEY (`gid`) REFERENCES `group` (`gid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_traveller_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `traveller` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表限制 `LOCATION`
--
ALTER TABLE `LOCATION`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `trip` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `location_ibfk_2` FOREIGN KEY (`next`) REFERENCES `location` (`lid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `location_ibfk_3` FOREIGN KEY (`cid`) REFERENCES `city` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表限制 `LOCATION_DAY`
--
ALTER TABLE `LOCATION_DAY`
  ADD CONSTRAINT `location_day_ibfk_1` FOREIGN KEY (`lid`) REFERENCES `location` (`lid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `location_day_ibfk_2` FOREIGN KEY (`did`) REFERENCES `day` (`did`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表限制 `SCHEDULE`
--
ALTER TABLE `SCHEDULE`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`next`) REFERENCES `schedule` (`sid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 資料表限制 `SHELTER`
--
ALTER TABLE `SHELTER`
  ADD CONSTRAINT `shelter_ibfk_2` FOREIGN KEY (`did`) REFERENCES `day` (`did`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shelter_ibfk_1` FOREIGN KEY (`lid`) REFERENCES `location` (`lid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表限制 `TRAVELLER_CITY`
--
ALTER TABLE `TRAVELLER_CITY`
  ADD CONSTRAINT `traveller_city_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `traveller` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `traveller_city_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `city` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;
