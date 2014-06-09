-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2011 年 10 月 22 日 05:02
-- 服务器版本: 5.0.90
-- PHP 版本: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `system`
--

-- --------------------------------------------------------

--
-- 表的结构 `changestate`
--

CREATE TABLE IF NOT EXISTS `changestate` (
  `userID` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `state` varchar(20) NOT NULL,
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `changestate`
--


-- --------------------------------------------------------

--
-- 表的结构 `deptmsg`
--

CREATE TABLE IF NOT EXISTS `deptmsg` (
  `deptName` varchar(20) NOT NULL,
  `deptnum` int(11) NOT NULL,
  `deptManager` varchar(20) default NULL,
  `employeeNum` int(11) default NULL,
  `deptDescribe` text,
  PRIMARY KEY  (`deptnum`),
  KEY `deptManager` (`deptManager`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `deptmsg`
--

INSERT INTO `deptmsg` (`deptName`, `deptnum`, `deptManager`, `employeeNum`, `deptDescribe`) VALUES
('一', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `userID` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY  (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `employee`
--


-- --------------------------------------------------------

--
-- 表的结构 `jiangcheng`
--

CREATE TABLE IF NOT EXISTS `jiangcheng` (
  `userID` varchar(20) NOT NULL,
  `date` date default NULL,
  `type` varchar(20) default NULL,
  `score` int(11) default NULL,
  `reason` text,
  PRIMARY KEY  (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jiangcheng`
--


-- --------------------------------------------------------

--
-- 表的结构 `jobmsg`
--

CREATE TABLE IF NOT EXISTS `jobmsg` (
  `jobName` varchar(20) NOT NULL,
  `deptnum` int(11) NOT NULL,
  `duty` text,
  `conditions` text,
  `workYears` int(11) default NULL,
  PRIMARY KEY  (`jobName`,`deptnum`),
  KEY `deptnum` (`deptnum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jobmsg`
--

INSERT INTO `jobmsg` (`jobName`, `deptnum`, `duty`, `conditions`, `workYears`) VALUES
('一一', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `manage`
--

CREATE TABLE IF NOT EXISTS `manage` (
  `manageID` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY  (`manageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `manage`
--

INSERT INTO `manage` (`manageID`, `password`) VALUES
('11111', '11111'),
('22222', '22222');

-- --------------------------------------------------------

--
-- 表的结构 `moverecords`
--

CREATE TABLE IF NOT EXISTS `moverecords` (
  `userID` varchar(20) NOT NULL,
  `moveTime` date default NULL,
  `jobname` varchar(20) default NULL,
  `deptnum` int(11) default NULL,
  `reason` text,
  KEY `jobname` (`jobname`),
  KEY `deptnum` (`deptnum`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `moverecords`
--


-- --------------------------------------------------------

--
-- 表的结构 `record`
--

CREATE TABLE IF NOT EXISTS `record` (
  `manageID` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `text` text NOT NULL,
  KEY `manageID` (`manageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `record`
--


-- --------------------------------------------------------

--
-- 表的结构 `train`
--

CREATE TABLE IF NOT EXISTS `train` (
  `userID` varchar(20) NOT NULL,
  `date` date default NULL,
  `content` text,
  `result` text,
  PRIMARY KEY  (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `train`
--


-- --------------------------------------------------------

--
-- 表的结构 `userinfo`
--

CREATE TABLE IF NOT EXISTS `userinfo` (
  `username` varchar(20) default NULL,
  `userID` varchar(20) NOT NULL,
  `sex` varchar(6) default NULL,
  `birth` date default NULL,
  `marriage` varchar(4) default NULL,
  `nation` varchar(12) default NULL,
  `zzmm` varchar(12) default NULL,
  `id` varchar(20) default NULL,
  `tel` varchar(12) default NULL,
  `addr` varchar(50) default NULL,
  `deptnum` int(11) default NULL,
  `job` varchar(20) default NULL,
  `edu` varchar(20) default NULL,
  `spec` varchar(20) default NULL,
  `school` varchar(20) default NULL,
  `graduateTime` date default NULL,
  `beginTime` date default NULL,
  `endTime` date default NULL,
  `mark` text,
  `state` varchar(20) default NULL,
  `fore` varchar(20) default NULL,
  PRIMARY KEY  (`userID`),
  UNIQUE KEY `id` (`id`),
  KEY `dept` (`deptnum`),
  KEY `job` (`job`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `userinfo`
--

INSERT INTO `userinfo` (`username`, `userID`, `sex`, `birth`, `marriage`, `nation`, `zzmm`, `id`, `tel`, `addr`, `deptnum`, `job`, `edu`, `spec`, `school`, `graduateTime`, `beginTime`, `endTime`, `mark`, `state`, `fore`) VALUES
('1212', '1', '女', '2011-10-22', '是', '', '', '1', '', '', 1, '一一', '学士', '', '', '2011-10-22', '2011-10-22', '2011-10-22', '', '在职', ''),
('121212', '1212', '男', '2011-10-22', '是', '', '', '121', '', '', 1, '一一', '学士', '', '', '2011-10-22', '2011-10-22', '2011-10-22', '', '在职', '');

-- --------------------------------------------------------

--
-- 表的结构 `wage`
--

CREATE TABLE IF NOT EXISTS `wage` (
  `userID` varchar(20) NOT NULL,
  `month` varchar(20) NOT NULL,
  `basewage` int(11) default NULL,
  `allowance` int(11) default NULL,
  `prize` int(11) default NULL,
  `extrawork` int(11) default NULL,
  PRIMARY KEY  (`userID`,`month`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wage`
--


--
-- 限制导出的表
--

--
-- 限制表 `changestate`
--
ALTER TABLE `changestate`
  ADD CONSTRAINT `changestate_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`) ON DELETE CASCADE;

--
-- 限制表 `deptmsg`
--
ALTER TABLE `deptmsg`
  ADD CONSTRAINT `deptmsg_ibfk_1` FOREIGN KEY (`deptManager`) REFERENCES `userinfo` (`userID`) ON DELETE CASCADE;

--
-- 限制表 `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`) ON DELETE CASCADE;

--
-- 限制表 `jiangcheng`
--
ALTER TABLE `jiangcheng`
  ADD CONSTRAINT `jiangcheng_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`) ON DELETE CASCADE;

--
-- 限制表 `jobmsg`
--
ALTER TABLE `jobmsg`
  ADD CONSTRAINT `jobmsg_ibfk_1` FOREIGN KEY (`deptnum`) REFERENCES `deptmsg` (`deptnum`) ON DELETE CASCADE;

--
-- 限制表 `moverecords`
--
ALTER TABLE `moverecords`
  ADD CONSTRAINT `moverecords_ibfk_4` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `moverecords_ibfk_7` FOREIGN KEY (`jobname`) REFERENCES `jobmsg` (`jobName`) ON DELETE SET NULL,
  ADD CONSTRAINT `moverecords_ibfk_8` FOREIGN KEY (`deptnum`) REFERENCES `jobmsg` (`deptnum`) ON DELETE SET NULL;

--
-- 限制表 `train`
--
ALTER TABLE `train`
  ADD CONSTRAINT `train_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`) ON DELETE CASCADE;

--
-- 限制表 `userinfo`
--
ALTER TABLE `userinfo`
  ADD CONSTRAINT `userinfo_ibfk_2` FOREIGN KEY (`deptnum`) REFERENCES `deptmsg` (`deptnum`) ON DELETE SET NULL,
  ADD CONSTRAINT `userinfo_ibfk_3` FOREIGN KEY (`job`) REFERENCES `jobmsg` (`jobName`) ON DELETE SET NULL;

--
-- 限制表 `wage`
--
ALTER TABLE `wage`
  ADD CONSTRAINT `wage_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`) ON DELETE CASCADE;
