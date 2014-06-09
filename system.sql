-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2011 年 10 月 21 日 10:26
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

INSERT INTO `changestate` (`userID`, `date`, `state`) VALUES
('7', '2011-10-18', '辞退');

-- --------------------------------------------------------

--
-- 表的结构 `deptmsg`
--

CREATE TABLE IF NOT EXISTS `deptmsg` (
  `deptName` varchar(20) NOT NULL,
  `deptnum` int(11) NOT NULL,
  `deptManager` varchar(20) NOT NULL,
  `employeeNum` int(11) default NULL,
  `deptDescribe` text,
  PRIMARY KEY  (`deptnum`),
  KEY `deptManager` (`deptManager`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `deptmsg`
--

INSERT INTO `deptmsg` (`deptName`, `deptnum`, `deptManager`, `employeeNum`, `deptDescribe`) VALUES
('市场部', 1, '', NULL, NULL),
('行政人力部', 2, '', NULL, NULL),
('财务部', 3, '', NULL, NULL),
('软件部', 4, '', NULL, NULL),
('法萨芬', 6, '7', 0, ''),
('郭德纲', 8, '7', 0, ''),
('11', 11, '7', 0, ''),
('12', 12, '7', 0, ''),
('13', 13, '7', 0, '');

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

INSERT INTO `jiangcheng` (`userID`, `date`, `type`, `score`, `reason`) VALUES
('7', '2011-10-13', '奖', 0, '');

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
('开发人员', 4, NULL, NULL, NULL),
('普通员工', 2, NULL, NULL, NULL),
('测试人员', 4, NULL, NULL, NULL),
('美工人员', 4, NULL, NULL, NULL),
('调研人员', 1, NULL, NULL, NULL),
('财务人员', 3, NULL, NULL, NULL),
('软件架构师', 4, NULL, NULL, NULL),
('部门经理', 1, NULL, NULL, NULL),
('部门经理', 2, NULL, NULL, NULL),
('部门经理', 3, NULL, NULL, NULL),
('部门经理', 4, NULL, NULL, NULL),
('需求工程师', 4, NULL, NULL, NULL);

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
  `deptnum` int(11) NOT NULL,
  `reason` text,
  KEY `jobname` (`jobname`),
  KEY `deptnum` (`deptnum`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `moverecords`
--

INSERT INTO `moverecords` (`userID`, `moveTime`, `jobname`, `deptnum`, `reason`) VALUES
('6', '0000-00-00', '调研人员', 1, ''),
('7', '2011-10-05', '开发人员', 4, ''),
('7', '0000-00-00', '调研人员', 1, ''),
('7', '2011-10-19', '普通员工', 2, '合法搜if萨嘎的说服力的将高搜igsd将gas更改');

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

INSERT INTO `train` (`userID`, `date`, `content`, `result`) VALUES
('7', '2011-10-12', '飞洒发晒更烦', '将覅搜更烦');

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
  `deptnum` int(11) NOT NULL,
  `job` varchar(20) NOT NULL,
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
  KEY `birth` (`birth`),
  KEY `dept` (`deptnum`),
  KEY `job` (`job`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `userinfo`
--

INSERT INTO `userinfo` (`username`, `userID`, `sex`, `birth`, `marriage`, `nation`, `zzmm`, `id`, `tel`, `addr`, `deptnum`, `job`, `edu`, `spec`, `school`, `graduateTime`, `beginTime`, `endTime`, `mark`, `state`, `fore`) VALUES
('11', '11', '男', '2011-10-17', '11', '是', '11', '11', '11', '11', 1, '调研人员', '转出', '学士', '11', '0000-00-00', '2011-10-17', '2011-10-17', '2011-10-17', '11', '11'),
('11', '112', '男', '2011-10-17', '11', '是', '11', '112', '11', '11', 1, '调研人员', '转出', '学士', '11', '0000-00-00', '2011-10-17', '2011-10-17', '2011-10-17', '11', '11'),
('121', '1213', '男', '2011-10-17', '是', '', '', '313', '', '', 3, '财务人员', '学士', '', '', '2011-10-17', '2011-10-17', '2011-10-17', '', '转出', ''),
('22', '22', '男', '2011-10-17', '是', '22', '22', '22', '22', '22', 1, '调研人员', '学士', '22', '22', '2011-10-17', '2011-10-17', '2011-10-17', '', '在职', NULL),
('33', '33', '男', '2011-10-17', '33', '是', '33', '33', '33', '33', 2, '普通员工', '在职', '学士', '33', '0000-00-00', '2011-10-17', '2011-10-17', '2011-10-17', '33', '33'),
('于娈', '44', '男', '2011-10-17', '是', '汉', '团员', '32324353905390', '124384434545', '安徽', 2, '普通员工', '学士', '软件', '合工大', '2011-10-17', '2011-10-17', '2011-10-17', '', '在职', '英语'),
('6', '6', NULL, NULL, NULL, NULL, NULL, '6', NULL, NULL, 4, '需求工程师', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6'),
('7', '7', '男', '2011-10-17', '7', '是', '7', '7', '7', '7', 11, '部门经理', '在职', '学士', '7', '0000-00-00', '2011-10-17', '2011-10-17', '2011-10-17', '辞退', '7'),
('9', '9', '男', '2011-10-17', '9', '是', '9', '9', '9', '9', 3, '财务人员', '在职', '学士', '9', '0000-00-00', '2011-10-17', '2011-10-17', '2011-10-17', '9', '9');

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

INSERT INTO `wage` (`userID`, `month`, `basewage`, `allowance`, `prize`, `extrawork`) VALUES
('7', '二月', 0, 0, 0, 0),
('7', '六月', 45, 565, 56, 57);

--
-- 限制导出的表
--

--
-- 限制表 `changestate`
--
ALTER TABLE `changestate`
  ADD CONSTRAINT `changestate_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`);

--
-- 限制表 `deptmsg`
--
ALTER TABLE `deptmsg`
  ADD CONSTRAINT `deptmsg_ibfk_1` FOREIGN KEY (`deptManager`) REFERENCES `userinfo` (`userID`);

--
-- 限制表 `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`);

--
-- 限制表 `jiangcheng`
--
ALTER TABLE `jiangcheng`
  ADD CONSTRAINT `jiangcheng_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`);

--
-- 限制表 `jobmsg`
--
ALTER TABLE `jobmsg`
  ADD CONSTRAINT `jobmsg_ibfk_1` FOREIGN KEY (`deptnum`) REFERENCES `deptmsg` (`deptnum`);

--
-- 限制表 `moverecords`
--
ALTER TABLE `moverecords`
  ADD CONSTRAINT `moverecords_ibfk_2` FOREIGN KEY (`jobname`) REFERENCES `jobmsg` (`jobName`),
  ADD CONSTRAINT `moverecords_ibfk_3` FOREIGN KEY (`deptnum`) REFERENCES `jobmsg` (`deptnum`),
  ADD CONSTRAINT `moverecords_ibfk_4` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`);

--
-- 限制表 `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `record_ibfk_1` FOREIGN KEY (`manageID`) REFERENCES `manage` (`manageID`);

--
-- 限制表 `train`
--
ALTER TABLE `train`
  ADD CONSTRAINT `train_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`);

--
-- 限制表 `userinfo`
--
ALTER TABLE `userinfo`
  ADD CONSTRAINT `userinfo_ibfk_1` FOREIGN KEY (`job`) REFERENCES `jobmsg` (`jobName`),
  ADD CONSTRAINT `userinfo_ibfk_2` FOREIGN KEY (`deptnum`) REFERENCES `deptmsg` (`deptnum`);

--
-- 限制表 `wage`
--
ALTER TABLE `wage`
  ADD CONSTRAINT `wage_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`);
