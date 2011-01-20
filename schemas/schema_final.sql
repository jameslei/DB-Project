-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 建立日期: Jan 20, 2011, 05:32 AM
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
CREATE DATABASE `Travel Journal` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `Travel Journal`;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `ACCOUNT`
--


-- --------------------------------------------------------

--
-- 資料表格式： `CITY`
--

CREATE TABLE IF NOT EXISTS `CITY` (
  `country_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`cid`),
  KEY `cname` (`country_id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `CITY`
--


-- --------------------------------------------------------

--
-- 資料表格式： `COUNTRY`
--

CREATE TABLE IF NOT EXISTS `COUNTRY` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=246 ;

--
-- 列出以下資料庫的數據： `COUNTRY`
--

INSERT INTO `COUNTRY` (`country_id`, `name`) VALUES
(1, '千里達與托貝哥共和國'),
(2, '土瓦魯'),
(3, '土耳其'),
(4, '土庫曼'),
(5, '不丹'),
(6, '中非共和國'),
(7, '中國'),
(8, '丹麥'),
(9, '厄瓜多'),
(10, '厄利垂亞'),
(11, '巴布亞紐幾內亞'),
(12, '巴西'),
(13, '巴貝多'),
(14, '巴拉圭'),
(15, '巴林'),
(16, '巴哈馬'),
(17, '巴拿馬'),
(18, '巴勒斯坦自治區'),
(19, '巴基斯坦'),
(20, '日本'),
(21, '比利時'),
(22, '牙買加'),
(23, '以色列'),
(24, '加拿大'),
(25, '加彭'),
(26, '北馬里亞納群島'),
(27, '北韓'),
(28, '卡達'),
(29, '古巴'),
(30, '史瓦濟蘭'),
(31, '台灣'),
(32, '尼日'),
(33, '尼加拉瓜'),
(34, '尼泊爾'),
(35, '布干維島'),
(36, '布吉納法索'),
(37, '瓜地馬拉'),
(38, '瓜達羅普'),
(39, '瓦利斯群島和富圖納群島'),
(40, '甘比亞'),
(41, '白俄羅斯'),
(42, '皮特康'),
(43, '立陶宛'),
(44, '伊拉克'),
(45, '伊朗'),
(46, '冰島'),
(47, '列支敦士登'),
(48, '匈牙利'),
(49, '印尼'),
(50, '印度'),
(51, '吉布地'),
(52, '吉里巴斯'),
(53, '吉爾吉斯'),
(54, '多明尼加'),
(55, '多明尼加共和國'),
(56, '多哥'),
(57, '安地卡及巴布達'),
(58, '安哥拉'),
(59, '安道爾共和國'),
(60, '安歸拉島'),
(61, '托克勞群島'),
(62, '百慕達'),
(63, '衣索比亞'),
(64, '西班牙'),
(65, '西撒哈拉'),
(66, '克羅埃西亞'),
(67, '冷岸及央棉群島'),
(68, '利比亞'),
(69, '宏都拉斯'),
(70, '希臘'),
(71, '沙烏地阿拉伯'),
(72, '汶萊'),
(73, '貝里斯'),
(74, '貝南'),
(75, '赤道幾內亞'),
(76, '辛巴威'),
(77, '亞美尼亞'),
(78, '亞賽拜然'),
(79, '坦尚尼亞'),
(80, '奈及利亞'),
(81, '委內瑞拉'),
(82, '孟加拉'),
(83, '尚比亞'),
(84, '帛琉'),
(85, '所羅門群島'),
(86, '拉脫維亞'),
(87, '東加'),
(88, '東帝汶'),
(89, '波士尼亞-赫塞哥維納'),
(90, '波札那'),
(91, '波多黎克'),
(92, '波蘭'),
(93, '法國'),
(94, '法羅群島'),
(95, '法屬圭亞那'),
(96, '法屬波里尼西亞'),
(97, '法屬南部屬地'),
(98, '直布羅陀'),
(99, '肯亞'),
(100, '芬蘭'),
(101, '阿拉伯聯合大公國'),
(102, '阿根廷'),
(103, '阿曼'),
(104, '阿富汗'),
(105, '阿爾及利亞'),
(106, '阿爾巴尼亞'),
(107, '阿魯巴島'),
(108, '保加利亞'),
(109, '俄羅斯'),
(110, '南非'),
(111, '南喬治亞與南桑威奇群島'),
(112, '南極洲'),
(113, '南韓'),
(114, '哈薩克'),
(115, '柬埔寨'),
(116, '查德'),
(117, '玻利維亞'),
(118, '科克群島'),
(119, '科克群島'),
(120, '科威特'),
(121, '科摩洛'),
(122, '突尼西亞'),
(123, '約旦'),
(124, '美國'),
(125, '美屬外部小群島'),
(126, '美屬維京群島'),
(127, '美屬薩摩亞'),
(128, '茅利塔尼亞'),
(129, '英國'),
(130, '英屬印度洋領地'),
(131, '英屬維京群島'),
(132, '迦納'),
(133, '香港'),
(134, '剛果'),
(135, '剛果民主共和國'),
(136, '哥倫比亞'),
(137, '哥斯大黎加'),
(138, '埃及'),
(139, '挪威'),
(140, '根息'),
(141, '格陵蘭'),
(142, '格瑞那達'),
(143, '泰國'),
(144, '海地'),
(145, '烏干達'),
(146, '烏克蘭'),
(147, '烏拉圭'),
(148, '烏茲別克'),
(149, '特克斯和凱科斯群島'),
(150, '留尼望'),
(151, '秘魯'),
(152, '索馬利亞'),
(153, '紐西蘭'),
(154, '紐埃島'),
(155, '納米比亞'),
(156, '馬丁尼克島'),
(157, '馬利'),
(158, '馬來西亞'),
(159, '馬其頓'),
(160, '馬拉威'),
(161, '馬約特島'),
(162, '馬歇爾群島'),
(163, '馬達加斯加'),
(164, '馬爾他'),
(165, '馬爾地夫'),
(166, '曼島'),
(167, '密克羅尼西亞'),
(168, '捷克共和國'),
(169, '敘利亞'),
(170, '梵蒂岡'),
(171, '莫三比克'),
(172, '荷屬安地列斯群島'),
(173, '荷蘭'),
(174, '喀麥隆'),
(175, '喬治亞'),
(176, '幾內亞'),
(177, '幾內亞比索'),
(178, '斐濟'),
(179, '斯里蘭卡'),
(180, '斯洛伐克'),
(181, '斯洛維尼亞'),
(182, '智利'),
(183, '菲律賓'),
(184, '象牙海岸'),
(185, '越南'),
(186, '開曼群島'),
(187, '塞內加爾'),
(188, '塞席爾'),
(189, '塞爾維亞'),
(190, '塞爾維亞蒙特內哥羅'),
(191, '塔吉克'),
(192, '奧地利'),
(193, '奧蘭群島'),
(194, '愛沙尼亞'),
(195, '愛爾蘭'),
(196, '新加坡'),
(197, '新喀里多尼亞'),
(198, '獅子山'),
(199, '瑞士'),
(200, '瑞典'),
(201, '萬那杜'),
(202, '義大利'),
(203, '聖匹島'),
(204, '聖文森與格瑞那丁'),
(205, '聖多美與普林西比'),
(206, '聖克里斯多福'),
(207, '聖馬力諾'),
(208, '聖赫勒拿島'),
(209, '聖誕島'),
(210, '聖露西亞'),
(211, '葉門'),
(212, '葡萄牙'),
(213, '福克蘭群島'),
(214, '維德角'),
(215, '蒙古'),
(216, '蒙特內哥羅'),
(217, '蒙特色納島'),
(218, '蒲隆地'),
(219, '蓋亞那'),
(220, '赫德島及麥當勞群島'),
(221, '寮國'),
(222, '德國'),
(223, '摩洛哥'),
(224, '摩納哥'),
(225, '摩爾多瓦'),
(226, '模里西斯'),
(227, '緬甸'),
(228, '黎巴嫩'),
(229, '墨西哥'),
(230, '澤西島'),
(231, '澳門'),
(232, '澳洲'),
(233, '盧安達'),
(234, '盧森堡'),
(235, '諾福克島'),
(236, '諾魯'),
(237, '賴比瑞亞'),
(238, '賴索托'),
(239, '賽普勒斯'),
(240, '薩爾瓦多共和國'),
(241, '薩摩斯島'),
(242, '羅馬尼亞'),
(243, '關島'),
(244, '蘇丹'),
(245, '蘇利南');

-- --------------------------------------------------------

--
-- 資料表格式： `DAY`
--

CREATE TABLE IF NOT EXISTS `DAY` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `next` int(11) DEFAULT NULL,
  `tid` int(11) NOT NULL,
  PRIMARY KEY (`did`),
  KEY `next` (`next`),
  KEY `tid` (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 列出以下資料庫的數據： `DAYS_SCHEDULE`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `next_traffic` varchar(255) DEFAULT NULL,
  `tid` int(11) NOT NULL,
  `next` int(11) DEFAULT NULL,
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`lid`),
  KEY `tid` (`tid`),
  KEY `next` (`next`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `lid` int(11) NOT NULL,
  `description` text,
  `did` int(11) NOT NULL,
  PRIMARY KEY (`sid`),
  KEY `next` (`next`),
  KEY `did` (`did`),
  KEY `lid` (`lid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

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
  `did` int(11) NOT NULL,
  PRIMARY KEY (`shid`),
  KEY `did` (`did`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `TRAVELLER`
--


-- --------------------------------------------------------

--
-- 資料表格式： `TRAVELLER_CITY`
--

CREATE TABLE IF NOT EXISTS `TRAVELLER_CITY` (
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`uid`,`cid`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `TRIP`
--


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
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表限制 `DAY`
--
ALTER TABLE `DAY`
  ADD CONSTRAINT `day_ibfk_1` FOREIGN KEY (`next`) REFERENCES `day` (`did`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `day_ibfk_2` FOREIGN KEY (`tid`) REFERENCES `trip` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`next`) REFERENCES `schedule` (`sid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`did`) REFERENCES `day` (`did`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表限制 `SHELTER`
--
ALTER TABLE `SHELTER`
  ADD CONSTRAINT `shelter_ibfk_2` FOREIGN KEY (`did`) REFERENCES `day` (`did`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表限制 `TRAVELLER_CITY`
--
ALTER TABLE `TRAVELLER_CITY`
  ADD CONSTRAINT `traveller_city_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `traveller` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `traveller_city_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `city` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;
