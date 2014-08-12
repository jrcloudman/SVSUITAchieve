CREATE DATABASE  IF NOT EXISTS `svsuitachieve_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `svsuitachieve_db`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: svsuitachieve_db
-- ------------------------------------------------------
-- Server version	5.5.24-log

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `adminId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` char(102) NOT NULL,
  `dateAdded` date DEFAULT NULL,
  `permissions` varchar(10) NOT NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `admin_group`
--

DROP TABLE IF EXISTS `admin_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_group` (
  `adminId` int(11) unsigned NOT NULL,
  `groupId` int(11) unsigned NOT NULL,
  KEY `groupId` (`groupId`),
  KEY `adminId` (`adminId`),
  KEY `adminId_2` (`adminId`),
  CONSTRAINT `admin_group_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `studentgroup` (`groupId`) ON DELETE CASCADE,
  CONSTRAINT `admin_group_ibfk_2` FOREIGN KEY (`adminId`) REFERENCES `admin` (`adminId`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `badge`
--

DROP TABLE IF EXISTS `badge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `badge` (
  `badgeId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `badgeName` varchar(45) DEFAULT NULL,
  `imageFile` varchar(255) NOT NULL,
  `badgeDescription` varchar(100) NOT NULL,
  `badgeType` varchar(45) NOT NULL,
  `badgegroupId` int(11) DEFAULT NULL,
  `groupId` int(11) unsigned DEFAULT NULL,
  `dateAdded` date DEFAULT NULL,
  `difficulty` int(11) DEFAULT NULL,
  `expirationDate` date DEFAULT NULL,
  PRIMARY KEY (`badgeId`),
  KEY `groupId` (`groupId`),
  CONSTRAINT `badge_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `studentgroup` (`groupId`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `badgegroup`
--

DROP TABLE IF EXISTS `badgegroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `badgegroup` (
  `badgegroupId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `badgegroupName` varchar(45) NOT NULL,
  `groupId` int(10) unsigned NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`badgegroupId`),
  KEY `groupId` (`groupId`),
  CONSTRAINT `badgegroup_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `studentgroup` (`groupId`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `studentId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupId` int(11) unsigned NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` char(102) NOT NULL,
  `startDate` date DEFAULT NULL,
  `major` varchar(45) DEFAULT NULL,
  `minor` varchar(45) DEFAULT NULL,
  `aboutMe` varchar(150) DEFAULT NULL,
  `dateAdded` date DEFAULT NULL,
  `expectedGraduation` date DEFAULT NULL,
  `allTimeBadges` int(11) DEFAULT NULL,
  `profileImage` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`studentId`),
  UNIQUE KEY `studentId_UNIQUE` (`studentId`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `groupId` (`groupId`),
  CONSTRAINT `student_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `studentgroup` (`groupId`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `student_badge`
--

DROP TABLE IF EXISTS `student_badge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_badge` (
  `studentId` int(11) unsigned NOT NULL,
  `badgeId` int(11) unsigned NOT NULL,
  `dateEarned` date DEFAULT NULL,
  KEY `studentId` (`studentId`),
  KEY `badgeId` (`badgeId`),
  KEY `badgeId_2` (`badgeId`),
  CONSTRAINT `student_badge_ibfk_1` FOREIGN KEY (`badgeId`) REFERENCES `badge` (`badgeId`),
  CONSTRAINT `student_badge_ibfk_2` FOREIGN KEY (`studentId`) REFERENCES `student` (`studentId`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `studentgroup`
--

DROP TABLE IF EXISTS `studentgroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studentgroup` (
  `groupId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupName` varchar(45) NOT NULL,
  `dateAdded` date NOT NULL,
  PRIMARY KEY (`groupId`),
  KEY `groupId` (`groupId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-08-12  1:22:36
