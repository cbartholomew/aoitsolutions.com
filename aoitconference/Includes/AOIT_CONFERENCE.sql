-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 11, 2014 at 05:12 PM
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
CREATE DATABASE IF NOT EXISTS `AOIT_CONFERENCE` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `AOIT_CONFERENCE`;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `ACCOUNT`
--

INSERT INTO `ACCOUNT` (`IDENTITY`, `EMAIL_ADDRESS`, `FIRST_NAME`, `LAST_NAME`, `ORGANIZATION_NAME`, `ACCOUNT_TYPE_IDENTITY`, `ACCOUNT_DISABLED`) VALUES
(10, 'cbartholomew@gmail.com', 'Christopher', 'Bartholomew', 'AOIT', 1, '\0'),
(15, 'cbartholomew@fas.harvard.edu', 'Christopher', 'Bartholomew', 'Test Organization ', 1, '\0');

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
  `ROOM_IDENTITY` bigint(20) NOT NULL,
  `HASHTAG` varchar(200) NOT NULL,
  `ABSTRACT` text NOT NULL,
  `SUMMARY` text NOT NULL,
  `EVENT_FULL` bit(1) NOT NULL,
  PRIMARY KEY (`EVENT_IDENTITY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `EVENT_TYPE`
--

CREATE TABLE `EVENT_TYPE` (
  `EVENT_TYPE_IDENTITY` bigint(20) NOT NULL AUTO_INCREMENT,
  `ACCOUNT_IDENTITY` bigint(20) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  PRIMARY KEY (`EVENT_TYPE_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `EVENT_TYPE`
--

INSERT INTO `EVENT_TYPE` (`EVENT_TYPE_IDENTITY`, `ACCOUNT_IDENTITY`, `NAME`) VALUES
(2, 15, 'Keynote'),
(3, 15, 'Session'),
(4, 15, 'Workshop'),
(5, 15, 'Code Lab'),
(6, 10, 'Session'),
(7, 10, 'Keynote'),
(8, 10, 'Workshop'),
(9, 10, 'Code Lab'),
(10, 10, 'Panel');

-- --------------------------------------------------------

--
-- Table structure for table `QR_EVENT`
--

CREATE TABLE `QR_EVENT` (
  `QR_IDENTITY` bigint(20) NOT NULL,
  `CONFERENCE_IDENTITY` bigint(20) NOT NULL,
  `CONFERENCE_EVENT_IDENTITY` bigint(11) NOT NULL,
  `END_POINT` varchar(255) NOT NULL,
  `IMG_SRC` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ROOM`
--

CREATE TABLE `ROOM` (
  `ROOM_IDENTITY` bigint(20) NOT NULL AUTO_INCREMENT,
  `VENUE_IDENTITY` bigint(20) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `ROOM_NUMBER` int(11) DEFAULT NULL,
  `CAPACITY` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ROOM_IDENTITY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `PLACEHOLDER_A` varchar(25) NOT NULL,
  PRIMARY KEY (`SOCIAL_TYPE_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `SOCIAL_TYPE`
--

INSERT INTO `SOCIAL_TYPE` (`SOCIAL_TYPE_IDENTITY`, `NAME`, `ICO_URL`, `URL`, `BANNER_URL`, `PLACEHOLDER_A`) VALUES
(1, 'Google', 'Static/Assets/Google/gplus-64.png', 'https://plus.google.com', '', '&#43;HonestAbe'),
(2, 'Facebook', 'Static/Assets/Facebook/FB-f-Logo__blue_1024.png', 'https://www.facebook.com', '', 'HonestAbe'),
(3, 'Twitter', 'Static/Assets/Twitter/twitter_logo_blue.png', 'https://twitter.com', '', '@HonestAbe'),
(4, 'Linkedin', 'Static/Assets/Linkedin/LinkedIn-Logo-02.png', 'https://www.linkedin.com/in', '', 'HonestAbe');

-- --------------------------------------------------------

--
-- Table structure for table `SPEAKER`
--

CREATE TABLE `SPEAKER` (
  `SPEAKER_IDENTITY` bigint(20) NOT NULL AUTO_INCREMENT,
  `ACCOUNT_IDENTITY` bigint(20) NOT NULL,
  `FIRST_NAME` varchar(75) NOT NULL,
  `LAST_NAME` varchar(75) NOT NULL,
  `EMAIL_ADDRESS` varchar(100) DEFAULT NULL,
  `PUBLIC` int(11) DEFAULT NULL,
  `STATUS` varchar(75) DEFAULT NULL,
  `COMPANY` varchar(200) DEFAULT NULL,
  `JOB_TITLE` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`SPEAKER_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `SPEAKER`
--

INSERT INTO `SPEAKER` (`SPEAKER_IDENTITY`, `ACCOUNT_IDENTITY`, `FIRST_NAME`, `LAST_NAME`, `EMAIL_ADDRESS`, `PUBLIC`, `STATUS`, `COMPANY`, `JOB_TITLE`) VALUES
(25, 10, 'Christopher', 'Bartholomew', 'cbartholomew@gmail.com', 0, '2', 'AOIT Solutions', 'Founder'),
(30, 10, 'Theodore', 'Roosevelt', 'teddyr@gmail.com', 1, '2', 'Government', 'President');

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
  `HANDLE` varchar(100) NOT NULL,
  `PROFILE_URL` varchar(255) NOT NULL,
  `IS_VIEWABLE` tinyint(1) NOT NULL,
  PRIMARY KEY (`SPEAKER_SOCIAL_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `SPEAKER_SOCIAL`
--

INSERT INTO `SPEAKER_SOCIAL` (`SPEAKER_SOCIAL_IDENTITY`, `SPEAKER_IDENTITY`, `SOCIAL_TYPE_IDENTITY`, `HANDLE`, `PROFILE_URL`, `IS_VIEWABLE`) VALUES
(18, 25, 1, '%2BChristopherBartholomew', 'https://plus.google.com/%2BChristopherBartholomew', 1),
(19, 25, 3, '@ChristopherUSA', 'https://twitter.com/@ChristopherUSA', 1),
(25, 30, 3, '@teddyr', 'https://twitter.com/@teddyr', 1);

-- --------------------------------------------------------

--
-- Table structure for table `STATE`
--

CREATE TABLE `STATE` (
  `STATE_IDENTITY` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(50) NOT NULL,
  PRIMARY KEY (`STATE_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `STATE`
--

INSERT INTO `STATE` (`STATE_IDENTITY`, `NAME`) VALUES
(1, 'Alabama'),
(2, 'Alaska'),
(3, 'Arizona'),
(4, 'Arkansas'),
(5, 'California'),
(6, 'Colorado'),
(7, 'Connecticut'),
(8, 'Delaware'),
(9, 'Florida'),
(10, 'Georgia'),
(11, 'Hawaii'),
(12, 'Idaho'),
(13, 'Illinois'),
(14, 'Indiana'),
(15, 'Iowa'),
(16, 'Kansas'),
(17, 'Kentucky'),
(18, 'Louisiana'),
(19, 'Maine'),
(20, 'Maryland'),
(21, 'Massachusetts'),
(22, 'Michigan'),
(23, 'Minnesota'),
(24, 'Mississippi'),
(25, 'Missouri'),
(26, 'Montana'),
(27, 'Nebraska'),
(28, 'Nevada'),
(29, 'New Hampshire'),
(30, 'New Jersey'),
(31, 'New Mexico'),
(32, 'New York'),
(33, 'North Carolina'),
(34, 'North Dakota'),
(35, 'Ohio'),
(36, 'Oklahoma'),
(37, 'Oregon'),
(38, 'Pennsylvania'),
(39, 'Rhode Island'),
(40, 'South Carolina'),
(41, 'South Dakota'),
(42, 'Tennessee'),
(43, 'Texas'),
(44, 'Utah'),
(45, 'Vermont'),
(46, 'Virginia'),
(47, 'Washington'),
(48, 'West Virginia'),
(49, 'Wisconsin'),
(50, 'Wyoming'),
(51, 'District of Columbia ');

-- --------------------------------------------------------

--
-- Table structure for table `STATUS`
--

CREATE TABLE `STATUS` (
  `STATUS_IDENTITY` int(11) NOT NULL AUTO_INCREMENT,
  `ACCOUNT_IDENTITY` bigint(20) DEFAULT NULL,
  `NAME` varchar(100) NOT NULL,
  PRIMARY KEY (`STATUS_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `STATUS`
--

INSERT INTO `STATUS` (`STATUS_IDENTITY`, `ACCOUNT_IDENTITY`, `NAME`) VALUES
(1, 10, 'Pending'),
(2, 10, 'Confirmed'),
(3, 10, 'Cancelled'),
(10, 14, 'Pending'),
(11, 14, 'Confirmed'),
(12, 14, 'Cancelled'),
(13, 15, 'Pending'),
(14, 15, 'Confirmed'),
(15, 15, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `TOPIC`
--

CREATE TABLE `TOPIC` (
  `TOPIC_IDENTITY` int(11) NOT NULL AUTO_INCREMENT,
  `ACCOUNT_IDENTITY` bigint(20) DEFAULT NULL,
  `NAME` varchar(100) NOT NULL,
  PRIMARY KEY (`TOPIC_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `TOPIC`
--

INSERT INTO `TOPIC` (`TOPIC_IDENTITY`, `ACCOUNT_IDENTITY`, `NAME`) VALUES
(2, 10, 'Topic A'),
(3, 10, 'Topic B');

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
  `ACCOUNT_IDENTITY` bigint(20) DEFAULT NULL,
  `NAME` varchar(100) NOT NULL,
  PRIMARY KEY (`TRACK_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `TRACK`
--

INSERT INTO `TRACK` (`TRACK_IDENTITY`, `ACCOUNT_IDENTITY`, `NAME`) VALUES
(1, 10, 'Track A'),
(2, 10, 'Track B');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `USER_ACCESS`
--

INSERT INTO `USER_ACCESS` (`USER_ACCESS_INDEX`, `SESSION`, `CREATED_DTTM`, `LAST_REQUEST_DTTM`, `ACCOUNT_IDENTITY`) VALUES
(28, 'e8483e9805d4b0121f83e11e1743f4ed', '2013-12-15 16:05:48', '2013-12-16 03:05:47', 10),
(39, '6d679900ee028b7e7aa26b3df16eeafe', '2013-12-18 19:12:44', '2013-12-19 01:12:54', 10),
(40, '1af0226499f28543dd0d5f673171685d', '2013-12-20 17:00:34', '2013-12-21 00:37:27', 10),
(50, 'f8624400a068c13a77ab86c633517bc7', '2013-12-24 17:11:21', '2013-12-24 23:19:19', 10),
(56, '9427c05fe1d915ab7a7d608ccc14bd08', '2013-12-26 23:34:01', '2013-12-27 05:45:43', 10),
(57, '73a4c00c5a01ebf4eb7daa3d99d8b070', '2013-12-27 14:18:32', '2013-12-27 22:09:00', 10),
(61, '081a1a5ffd7c8768ba9630fbb639bf71', '2013-12-29 00:43:41', '2013-12-29 06:44:20', 10),
(68, '912017cd1c3c08a71d1085dc272acbcb', '2014-06-10 15:58:45', '2014-06-10 22:14:20', 10),
(71, '3025cafea809ea8b28555d0cb8682666', '2014-06-13 18:39:12', '2014-06-14 04:35:17', 10),
(72, 'bad0927bd269085cc309676caea3ab1d', '2014-06-15 23:34:06', '2014-06-16 08:42:35', 10),
(73, 'b070f4612e6278d7065ef27ec8b62cd8', '2014-06-17 16:43:07', '2014-06-18 01:43:10', 10),
(74, '1aa5a436423d5b1ccd9e116bdd907c29', '2014-06-24 18:06:28', '2014-06-25 00:12:35', 10),
(75, '7413c019329cfced1ad8c6bd181d49d9', '2014-07-26 21:06:50', '2014-07-27 03:59:46', 10),
(76, '90afaf75a20eb6547ccf033c4dec7ddb', '2014-07-28 19:44:08', '2014-07-29 03:47:22', 10),
(77, '40e1deb20bf95be599fabb2e12295645', '2014-08-09 14:55:42', '2014-08-09 21:11:07', 10);

-- --------------------------------------------------------

--
-- Table structure for table `VENUE`
--

CREATE TABLE `VENUE` (
  `VENUE_IDENTITY` bigint(20) NOT NULL AUTO_INCREMENT,
  `ACCOUNT_IDENTITY` bigint(20) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `IMAGE` longblob NOT NULL,
  `CAPACITY` int(11) NOT NULL,
  `ADDRESS` varchar(100) NOT NULL,
  `CITY` varchar(100) NOT NULL,
  `STATE` int(11) NOT NULL,
  `ZIP` varchar(10) NOT NULL,
  `COUNTRY` int(11) NOT NULL,
  PRIMARY KEY (`VENUE_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `VENUE`
--

INSERT INTO `VENUE` (`VENUE_IDENTITY`, `ACCOUNT_IDENTITY`, `NAME`, `IMAGE`, `CAPACITY`, `ADDRESS`, `CITY`, `STATE`, `ZIP`, `COUNTRY`) VALUES
(1, 10, 'The White House', 0x687474703a2f2f75706c6f61642e77696b696d656469612e6f72672f77696b6970656469612f636f6d6d6f6e732f612f61662f5768697465486f757365536f7574684661636164652e4a5047, 999, '1600 Penn Ave', 'Washington', 51, '02380', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
