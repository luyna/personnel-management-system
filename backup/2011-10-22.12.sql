-- MySQL dump 10.11
--
-- Host: localhost    Database: system
-- ------------------------------------------------------
-- Server version	5.0.90-community-nt

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `changestate`
--

DROP TABLE IF EXISTS `changestate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `changestate` (
  `userID` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `state` varchar(20) NOT NULL,
  KEY `userID` (`userID`),
  CONSTRAINT `changestate_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `changestate`
--

LOCK TABLES `changestate` WRITE;
/*!40000 ALTER TABLE `changestate` DISABLE KEYS */;
/*!40000 ALTER TABLE `changestate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deptmsg`
--

DROP TABLE IF EXISTS `deptmsg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deptmsg` (
  `deptName` varchar(20) NOT NULL,
  `deptnum` int(11) NOT NULL,
  `deptManager` varchar(20) default NULL,
  `employeeNum` int(11) default NULL,
  `deptDescribe` text,
  PRIMARY KEY  (`deptnum`),
  KEY `deptManager` (`deptManager`),
  CONSTRAINT `deptmsg_ibfk_1` FOREIGN KEY (`deptManager`) REFERENCES `userinfo` (`userID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deptmsg`
--

LOCK TABLES `deptmsg` WRITE;
/*!40000 ALTER TABLE `deptmsg` DISABLE KEYS */;
INSERT INTO `deptmsg` VALUES ('一',1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `deptmsg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `userID` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY  (`userID`),
  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jiangcheng`
--

DROP TABLE IF EXISTS `jiangcheng`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jiangcheng` (
  `userID` varchar(20) NOT NULL,
  `date` date default NULL,
  `type` varchar(20) default NULL,
  `score` int(11) default NULL,
  `reason` text,
  PRIMARY KEY  (`userID`),
  CONSTRAINT `jiangcheng_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jiangcheng`
--

LOCK TABLES `jiangcheng` WRITE;
/*!40000 ALTER TABLE `jiangcheng` DISABLE KEYS */;
/*!40000 ALTER TABLE `jiangcheng` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobmsg`
--

DROP TABLE IF EXISTS `jobmsg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobmsg` (
  `jobName` varchar(20) NOT NULL,
  `deptnum` int(11) NOT NULL,
  `duty` text,
  `conditions` text,
  `workYears` int(11) default NULL,
  PRIMARY KEY  (`jobName`,`deptnum`),
  KEY `deptnum` (`deptnum`),
  CONSTRAINT `jobmsg_ibfk_1` FOREIGN KEY (`deptnum`) REFERENCES `deptmsg` (`deptnum`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobmsg`
--

LOCK TABLES `jobmsg` WRITE;
/*!40000 ALTER TABLE `jobmsg` DISABLE KEYS */;
INSERT INTO `jobmsg` VALUES ('一一',1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `jobmsg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manage`
--

DROP TABLE IF EXISTS `manage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manage` (
  `manageID` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY  (`manageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manage`
--

LOCK TABLES `manage` WRITE;
/*!40000 ALTER TABLE `manage` DISABLE KEYS */;
INSERT INTO `manage` VALUES ('11111','11111'),('22222','22222');
/*!40000 ALTER TABLE `manage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moverecords`
--

DROP TABLE IF EXISTS `moverecords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moverecords` (
  `userID` varchar(20) NOT NULL,
  `moveTime` date default NULL,
  `jobname` varchar(20) default NULL,
  `deptnum` int(11) default NULL,
  `reason` text,
  KEY `jobname` (`jobname`),
  KEY `deptnum` (`deptnum`),
  KEY `userID` (`userID`),
  CONSTRAINT `moverecords_ibfk_4` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`) ON DELETE CASCADE,
  CONSTRAINT `moverecords_ibfk_7` FOREIGN KEY (`jobname`) REFERENCES `jobmsg` (`jobName`) ON DELETE SET NULL,
  CONSTRAINT `moverecords_ibfk_8` FOREIGN KEY (`deptnum`) REFERENCES `jobmsg` (`deptnum`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moverecords`
--

LOCK TABLES `moverecords` WRITE;
/*!40000 ALTER TABLE `moverecords` DISABLE KEYS */;
/*!40000 ALTER TABLE `moverecords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `record`
--

DROP TABLE IF EXISTS `record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `record` (
  `manageID` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `text` text NOT NULL,
  KEY `manageID` (`manageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `record`
--

LOCK TABLES `record` WRITE;
/*!40000 ALTER TABLE `record` DISABLE KEYS */;
/*!40000 ALTER TABLE `record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `train`
--

DROP TABLE IF EXISTS `train`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `train` (
  `userID` varchar(20) NOT NULL,
  `date` date default NULL,
  `content` text,
  `result` text,
  PRIMARY KEY  (`userID`),
  CONSTRAINT `train_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `train`
--

LOCK TABLES `train` WRITE;
/*!40000 ALTER TABLE `train` DISABLE KEYS */;
/*!40000 ALTER TABLE `train` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userinfo` (
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
  KEY `job` (`job`),
  CONSTRAINT `userinfo_ibfk_2` FOREIGN KEY (`deptnum`) REFERENCES `deptmsg` (`deptnum`) ON DELETE SET NULL,
  CONSTRAINT `userinfo_ibfk_3` FOREIGN KEY (`job`) REFERENCES `jobmsg` (`jobName`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userinfo`
--

LOCK TABLES `userinfo` WRITE;
/*!40000 ALTER TABLE `userinfo` DISABLE KEYS */;
INSERT INTO `userinfo` VALUES ('1212','1','女','2011-10-22','是','','','1','','',1,'一一','学士','','','2011-10-22','2011-10-22','2011-10-22','','在职',''),('121212','1212','男','2011-10-22','是','','','121','','',1,'一一','学士','','','2011-10-22','2011-10-22','2011-10-22','','在职','');
/*!40000 ALTER TABLE `userinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wage`
--

DROP TABLE IF EXISTS `wage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wage` (
  `userID` varchar(20) NOT NULL,
  `month` varchar(20) NOT NULL,
  `basewage` int(11) default NULL,
  `allowance` int(11) default NULL,
  `prize` int(11) default NULL,
  `extrawork` int(11) default NULL,
  PRIMARY KEY  (`userID`,`month`),
  CONSTRAINT `wage_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`userID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wage`
--

LOCK TABLES `wage` WRITE;
/*!40000 ALTER TABLE `wage` DISABLE KEYS */;
/*!40000 ALTER TABLE `wage` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-10-22 12:58:42
