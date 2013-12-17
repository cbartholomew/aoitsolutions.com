-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 17, 2013 at 06:54 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `AOIT_CONFERENCE`
--

-- --------------------------------------------------------

--
-- Table structure for table `ACCOUNT`
--

CREATE TABLE `ACCOUNT` (
  `IDENTITY` bigint(20) NOT NULL AUTO_INCREMENT,
  `EMAIL_ADDRESS` varchar(100) NOT NULL,
  `FIRST_NAME` varchar(75) NOT NULL,
  `LAST_NAME` varchar(75) NOT NULL,
  `ORGANIZATION_NAME` varchar(100) NOT NULL,
  `ACCOUNT_TYPE_IDENTITY` int(11) NOT NULL,
  `ACCOUNT_DISABLED` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`IDENTITY`),
  UNIQUE KEY `EMAIL_ADDRESS` (`EMAIL_ADDRESS`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `ACCOUNT`
--

INSERT INTO `ACCOUNT` (`IDENTITY`, `EMAIL_ADDRESS`, `FIRST_NAME`, `LAST_NAME`, `ORGANIZATION_NAME`, `ACCOUNT_TYPE_IDENTITY`, `ACCOUNT_DISABLED`) VALUES
(10, 'cbartholomew@gmail.com', 'Christopher', 'Bartholomew', 'AOIT', 1, '\0'),
(11, 'cbartholomew@fas.harvard.edu', 'Christopher', 'Bartholomew', 'Backup', 1, '\0');

-- --------------------------------------------------------

--
-- Table structure for table `ACCOUNT_TYPE`
--

CREATE TABLE `ACCOUNT_TYPE` (
  `ACCOUNT_TYPE_IDENTITY` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(50) NOT NULL,
  `ENABLED` bit(1) NOT NULL,
  PRIMARY KEY (`ACCOUNT_TYPE_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ACCOUNT_TYPE`
--

INSERT INTO `ACCOUNT_TYPE` (`ACCOUNT_TYPE_IDENTITY`, `NAME`, `ENABLED`) VALUES
(1, 'BETA', '');

-- --------------------------------------------------------

--
-- Table structure for table `CONFERENCE`
--

CREATE TABLE `CONFERENCE` (
  `CONFERENCE_IDENTITY` bigint(20) NOT NULL AUTO_INCREMENT,
  `ACCOUNT_IDENTITY` bigint(20) NOT NULL,
  `NAME` varchar(200) NOT NULL,
  `START_DATE` date NOT NULL,
  `END_DATE` date NOT NULL,
  `NUMBER_OF_DAYS` int(11) NOT NULL,
  PRIMARY KEY (`CONFERENCE_IDENTITY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `CONFERENCE_EVENT`
--

CREATE TABLE `CONFERENCE_EVENT` (
  `EVENT_IDENTITY` bigint(20) NOT NULL AUTO_INCREMENT,
  `CONFERENCE_IDENTITY` bigint(20) NOT NULL,
  `NAME` varchar(200) NOT NULL,
  `PANEL_NAME` varchar(200) NOT NULL,
  `PUBLIC` bit(1) NOT NULL,
  `STATUS_IDENTITY` int(11) NOT NULL,
  `TYPE_IDENTITY` int(11) NOT NULL,
  `TRACK_IDENTITY` int(11) NOT NULL,
  `DAY_NO` int(11) NOT NULL,
  `START_TIME` time NOT NULL,
  `END_TIME` time NOT NULL,
  `ROOM` varchar(200) NOT NULL,
  `HASHTAG` varchar(200) NOT NULL,
  `ABSTRACT` text NOT NULL,
  `SUMMARY` text NOT NULL,
  `EVENT_FULL` bit(1) NOT NULL,
  PRIMARY KEY (`EVENT_IDENTITY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `QR_EVENT`
--

CREATE TABLE `QR_EVENT` (
  `QR_IDENTITY` bigint(20) NOT NULL,
  `CONFERENCE_IDENTITY` bigint(20) NOT NULL,
  `END_POINT` varchar(255) NOT NULL,
  `IMG_SRC` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SOCIAL_TYPE`
--

CREATE TABLE `SOCIAL_TYPE` (
  `SOCIAL_TYPE_IDENTITY` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `ICO_URL` varchar(255) NOT NULL,
  `URL` varchar(255) NOT NULL,
  `BANNER_URL` varchar(255) NOT NULL,
  PRIMARY KEY (`SOCIAL_TYPE_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `SOCIAL_TYPE`
--

INSERT INTO `SOCIAL_TYPE` (`SOCIAL_TYPE_IDENTITY`, `NAME`, `ICO_URL`, `URL`, `BANNER_URL`) VALUES
(1, 'Linkedin', '/Static/Assets/Linkedin/LinkedIn-Logo-02.png', 'https://www.linkedin.com/in', ''),
(2, 'Facebook', '/Static/Assets/Facebook/FB-f-Logo__blue_1024.png', 'https://www.facebook.com', ''),
(3, 'Google', '/Static/Assets/Google/gplus-64.png', 'https://plus.google.com', ''),
(4, 'Twitter', '/Static/Assets/Twitter/twitter_logo_blue.png', 'https://twitter.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `SPEAKER`
--

CREATE TABLE `SPEAKER` (
  `SPEAKER_IDENTITY` bigint(20) NOT NULL AUTO_INCREMENT,
  `ACCOUNT_IDENTITY` bigint(20) NOT NULL,
  `FIRST_NAME` varchar(75) NOT NULL,
  `LAST_NAME` varchar(75) NOT NULL,
  `EMAIL_ADDRESS` varchar(100) NOT NULL,
  `PUBLIC` bit(1) NOT NULL,
  `STATUS` varchar(75) NOT NULL,
  `COMPANY` varchar(200) NOT NULL,
  `JOB_TITLE` varchar(200) NOT NULL,
  PRIMARY KEY (`SPEAKER_IDENTITY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SPEAKER_EVENT`
--

CREATE TABLE `SPEAKER_EVENT` (
  `CONFERENCE_EVENT_ID` int(11) NOT NULL,
  `SPEAKER_IDENTITY` bigint(11) NOT NULL,
  `IS_MODERATOR` bit(1) NOT NULL,
  KEY `CONFERENCE_EVENT_ID` (`CONFERENCE_EVENT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SPEAKER_SOCIAL`
--

CREATE TABLE `SPEAKER_SOCIAL` (
  `SPEAKER_SOCIAL_IDENTITY` bigint(11) NOT NULL AUTO_INCREMENT,
  `SPEAKER_IDENTITY` int(11) NOT NULL,
  `SOCIAL_TYPE_IDENTITY` int(11) NOT NULL,
  `HANDLE` int(11) NOT NULL,
  `PROFILE_URL` int(11) NOT NULL,
  `IS_VIEWABLE` bit(4) NOT NULL,
  PRIMARY KEY (`SPEAKER_SOCIAL_IDENTITY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `STATUS`
--

CREATE TABLE `STATUS` (
  `STATUS_IDENTITY` int(11) NOT NULL AUTO_INCREMENT,
  `ACCOUNT_IDENTITY` bigint(20) DEFAULT NULL,
  `NAME` varchar(100) NOT NULL,
  PRIMARY KEY (`STATUS_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `STATUS`
--

INSERT INTO `STATUS` (`STATUS_IDENTITY`, `ACCOUNT_IDENTITY`, `NAME`) VALUES
(1, NULL, 'Pending'),
(2, NULL, 'Confirmed'),
(3, NULL, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `TOPIC`
--

CREATE TABLE `TOPIC` (
  `TOPIC_IDENTITY` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TOPIC_EVENT`
--

CREATE TABLE `TOPIC_EVENT` (
  `CONFERENCE_EVENT_ID` int(11) NOT NULL,
  `TOPIC_ID` int(11) NOT NULL,
  KEY `CONFERENCE_EVENT_ID` (`CONFERENCE_EVENT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TRACK`
--

CREATE TABLE `TRACK` (
  `TRACK_IDENTITY` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` int(11) NOT NULL,
  PRIMARY KEY (`TRACK_IDENTITY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `USER_ACCESS`
--

CREATE TABLE `USER_ACCESS` (
  `USER_ACCESS_INDEX` bigint(20) NOT NULL AUTO_INCREMENT,
  `SESSION` varchar(500) NOT NULL,
  `CREATED_DTTM` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LAST_REQUEST_DTTM` timestamp NULL DEFAULT NULL,
  `ACCOUNT_IDENTITY` bigint(20) NOT NULL,
  PRIMARY KEY (`USER_ACCESS_INDEX`),
  UNIQUE KEY `SESSION` (`SESSION`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `USER_ACCESS`
--

INSERT INTO `USER_ACCESS` (`USER_ACCESS_INDEX`, `SESSION`, `CREATED_DTTM`, `LAST_REQUEST_DTTM`, `ACCOUNT_IDENTITY`) VALUES
(28, 'e8483e9805d4b0121f83e11e1743f4ed', '2013-12-15 16:05:48', '2013-12-16 03:05:47', 10),
(29, '6d679900ee028b7e7aa26b3df16eeafe', '2013-12-17 17:39:49', '2013-12-17 23:39:52', 10);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
