-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 12, 2014 at 05:38 PM
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
  `EMAIL_ADDRESS` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FIRST_NAME` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LAST_NAME` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ORGANIZATION_NAME` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ACCOUNT_TYPE_IDENTITY` bigint(20) DEFAULT NULL,
  `ACCOUNT_DISABLED` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`IDENTITY`),
  UNIQUE KEY `EMAIL_ADDRESS` (`EMAIL_ADDRESS`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `ACCOUNT`
--

INSERT INTO `ACCOUNT` (`IDENTITY`, `EMAIL_ADDRESS`, `FIRST_NAME`, `LAST_NAME`, `ORGANIZATION_NAME`, `ACCOUNT_TYPE_IDENTITY`, `ACCOUNT_DISABLED`) VALUES
(10, 'cbartholomew@gmail.com', 'Christopher', 'Bartholomew', 'AOIT', 1, '\0'),
(15, 'cbartholomew@fas.harvard.edu', 'Christopher', 'Bartholomew', 'Test Organization ', 1, '\0'),
(16, 'admin@aoitsolutions.com', 'Admin', 'Aoit', 'AOIT Solutions', 2, '\0');

-- --------------------------------------------------------

--
-- Table structure for table `ACCOUNT_TYPE`
--

CREATE TABLE `ACCOUNT_TYPE` (
  `ACCOUNT_TYPE_IDENTITY` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ENABLED` bit(1) NOT NULL,
  PRIMARY KEY (`ACCOUNT_TYPE_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ACCOUNT_TYPE`
--

INSERT INTO `ACCOUNT_TYPE` (`ACCOUNT_TYPE_IDENTITY`, `NAME`, `ENABLED`) VALUES
(1, 'BETA', ''),
(2, 'MASTER', ''),
(3, 'ADMINISTRATOR', ''),
(4, 'PUBLIC', '');

-- --------------------------------------------------------

--
-- Table structure for table `CONFERENCE`
--

CREATE TABLE `CONFERENCE` (
  `CONFERENCE_IDENTITY` bigint(20) NOT NULL AUTO_INCREMENT,
  `ACCOUNT_IDENTITY` bigint(20) NOT NULL,
  `NAME` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `START_DATE` date NOT NULL,
  `END_DATE` date NOT NULL,
  `NUMBER_OF_DAYS` int(11) NOT NULL,
  PRIMARY KEY (`CONFERENCE_IDENTITY`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `CONFERENCE_EVENT`
--

CREATE TABLE `CONFERENCE_EVENT` (
  `EVENT_IDENTITY` bigint(20) NOT NULL AUTO_INCREMENT,
  `CONFERENCE_IDENTITY` bigint(20) NOT NULL,
  `NAME` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PANEL_NAME` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PUBLIC` bit(1) NOT NULL,
  `STATUS_IDENTITY` int(11) NOT NULL,
  `TYPE_IDENTITY` int(11) NOT NULL,
  `TRACK_IDENTITY` int(11) NOT NULL,
  `DAY_NO` int(11) NOT NULL,
  `START_TIME` time NOT NULL,
  `END_TIME` time NOT NULL,
  `ROOM_IDENTITY` bigint(20) NOT NULL,
  `HASHTAG` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ABSTRACT` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `SUMMARY` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `EVENT_FULL` bit(1) NOT NULL,
  PRIMARY KEY (`EVENT_IDENTITY`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `COUNTRIES`
--

CREATE TABLE `COUNTRIES` (
  `COUNTRY_IDENTITY` int(11) NOT NULL AUTO_INCREMENT,
  `ISO_CODE` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `NAME` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`COUNTRY_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=245 ;

--
-- Dumping data for table `COUNTRIES`
--

INSERT INTO `COUNTRIES` (`COUNTRY_IDENTITY`, `ISO_CODE`, `NAME`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AX', 'Åland Islands'),
(3, 'AL', 'Albania'),
(4, 'DZ', 'Algeria'),
(5, 'AS', 'American Samoa'),
(6, 'AD', 'Andorra'),
(7, 'AO', 'Angola'),
(8, 'AI', 'Anguilla'),
(9, 'AQ', 'Antarctica'),
(10, 'AG', 'Antigua and Barbuda'),
(11, 'AR', 'Argentina'),
(12, 'AM', 'Armenia'),
(13, 'AW', 'Aruba'),
(14, 'AU', 'Australia'),
(15, 'AT', 'Austria'),
(16, 'AZ', 'Azerbaijan'),
(17, 'BS', 'Bahamas'),
(18, 'BH', 'Bahrain'),
(19, 'BD', 'Bangladesh'),
(20, 'BB', 'Barbados'),
(21, 'BY', 'Belarus'),
(22, 'BE', 'Belgium'),
(23, 'BZ', 'Belize'),
(24, 'BJ', 'Benin'),
(25, 'BM', 'Bermuda'),
(26, 'BT', 'Bhutan'),
(27, 'BO', 'Bolivia'),
(28, 'BA', 'Bosnia and Herzegovina'),
(29, 'BW', 'Botswana'),
(30, 'BV', 'Bouvet Island'),
(31, 'BR', 'Brazil'),
(32, 'IO', 'British Indian Ocean Territory'),
(33, 'BN', 'Brunei Darussalam'),
(34, 'BG', 'Bulgaria'),
(35, 'BF', 'Burkina Faso'),
(36, 'BI', 'Burundi'),
(37, 'KH', 'Cambodia'),
(38, 'CM', 'Cameroon'),
(39, 'CA', 'Canada'),
(40, 'CV', 'Cape Verde'),
(41, 'KY', 'Cayman Islands'),
(42, 'CF', 'Central African Republic'),
(43, 'TD', 'Chad'),
(44, 'CL', 'Chile'),
(45, 'CN', 'China'),
(46, 'CX', 'Christmas Island'),
(47, 'CC', 'Cocos (Keeling) Islands'),
(48, 'CO', 'Colombia'),
(49, 'KM', 'Comoros'),
(50, 'CG', 'Congo'),
(51, 'CD', 'Congo, The Democratic Republic of The'),
(52, 'CK', 'Cook Islands'),
(53, 'CR', 'Costa Rica'),
(54, 'CI', 'Cote D''ivoire'),
(55, 'HR', 'Croatia'),
(56, 'CU', 'Cuba'),
(57, 'CY', 'Cyprus'),
(58, 'CZ', 'Czech Republic'),
(59, 'DK', 'Denmark'),
(60, 'DJ', 'Djibouti'),
(61, 'DM', 'Dominica'),
(62, 'DO', 'Dominican Republic'),
(63, 'EC', 'Ecuador'),
(64, 'EG', 'Egypt'),
(65, 'SV', 'El Salvador'),
(66, 'GQ', 'Equatorial Guinea'),
(67, 'ER', 'Eritrea'),
(68, 'EE', 'Estonia'),
(69, 'ET', 'Ethiopia'),
(70, 'FK', 'Falkland Islands (Malvinas)'),
(71, 'FO', 'Faroe Islands'),
(72, 'FJ', 'Fiji'),
(73, 'FI', 'Finland'),
(74, 'FR', 'France'),
(75, 'GF', 'French Guiana'),
(76, 'PF', 'French Polynesia'),
(77, 'TF', 'French Southern Territories'),
(78, 'GA', 'Gabon'),
(79, 'GM', 'Gambia'),
(80, 'GE', 'Georgia'),
(81, 'DE', 'Germany'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GG', 'Guernsey'),
(91, 'GN', 'Guinea'),
(92, 'GW', 'Guinea-bissau'),
(93, 'GY', 'Guyana'),
(94, 'HT', 'Haiti'),
(95, 'HM', 'Heard Island and Mcdonald Islands'),
(96, 'VA', 'Holy See (Vatican City State)'),
(97, 'HN', 'Honduras'),
(98, 'HK', 'Hong Kong'),
(99, 'HU', 'Hungary'),
(100, 'IS', 'Iceland'),
(101, 'IN', 'India'),
(102, 'ID', 'Indonesia'),
(103, 'IR', 'Iran, Islamic Republic of'),
(104, 'IQ', 'Iraq'),
(105, 'IE', 'Ireland'),
(106, 'IM', 'Isle of Man'),
(107, 'IL', 'Israel'),
(108, 'IT', 'Italy'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JE', 'Jersey'),
(112, 'JO', 'Jordan'),
(113, 'KZ', 'Kazakhstan'),
(114, 'KE', 'Kenya'),
(115, 'KI', 'Kiribati'),
(116, 'KP', 'Korea, Democratic People''s Republic of'),
(117, 'KR', 'Korea, Republic of'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People''s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macao'),
(130, 'MK', 'Macedonia, The Former Yugoslav Republic of'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'YT', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestinian Territory, Occupied'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'SH', 'Saint Helena'),
(185, 'KN', 'Saint Kitts and Nevis'),
(186, 'LC', 'Saint Lucia'),
(187, 'PM', 'Saint Pierre and Miquelon'),
(188, 'VC', 'Saint Vincent and The Grenadines'),
(189, 'WS', 'Samoa'),
(190, 'SM', 'San Marino'),
(191, 'ST', 'Sao Tome and Principe'),
(192, 'SA', 'Saudi Arabia'),
(193, 'SN', 'Senegal'),
(194, 'RS', 'Serbia'),
(195, 'SC', 'Seychelles'),
(196, 'SL', 'Sierra Leone'),
(197, 'SG', 'Singapore'),
(198, 'SK', 'Slovakia'),
(199, 'SI', 'Slovenia'),
(200, 'SB', 'Solomon Islands'),
(201, 'SO', 'Somalia'),
(202, 'ZA', 'South Africa'),
(203, 'GS', 'South Georgia and The South Sandwich Islands'),
(204, 'ES', 'Spain'),
(205, 'LK', 'Sri Lanka'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan, Province of China'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TL', 'Timor-leste'),
(218, 'TG', 'Togo'),
(219, 'TK', 'Tokelau'),
(220, 'TO', 'Tonga'),
(221, 'TT', 'Trinidad and Tobago'),
(222, 'TN', 'Tunisia'),
(223, 'TR', 'Turkey'),
(224, 'TM', 'Turkmenistan'),
(225, 'TC', 'Turks and Caicos Islands'),
(226, 'TV', 'Tuvalu'),
(227, 'UG', 'Uganda'),
(228, 'UA', 'Ukraine'),
(229, 'AE', 'United Arab Emirates'),
(230, 'GB', 'United Kingdom'),
(231, 'US', 'United States'),
(232, 'UM', 'United States Minor Outlying Islands'),
(233, 'UY', 'Uruguay'),
(234, 'UZ', 'Uzbekistan'),
(235, 'VU', 'Vanuatu'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Viet Nam'),
(238, 'VG', 'Virgin Islands, British'),
(239, 'VI', 'Virgin Islands, U.S.'),
(240, 'WF', 'Wallis and Futuna'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'ZM', 'Zambia'),
(244, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `EVENT_TYPE`
--

CREATE TABLE `EVENT_TYPE` (
  `EVENT_TYPE_IDENTITY` bigint(20) NOT NULL AUTO_INCREMENT,
  `ACCOUNT_IDENTITY` bigint(20) NOT NULL,
  `NAME` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`EVENT_TYPE_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

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
  `END_POINT` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IMG_SRC` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ROOM`
--

CREATE TABLE `ROOM` (
  `ROOM_IDENTITY` bigint(20) NOT NULL AUTO_INCREMENT,
  `VENUE_IDENTITY` bigint(20) NOT NULL,
  `NAME` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ROOM_NUMBER` int(11) DEFAULT NULL,
  `CAPACITY` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ROOM_IDENTITY`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SOCIAL_TYPE`
--

CREATE TABLE `SOCIAL_TYPE` (
  `SOCIAL_TYPE_IDENTITY` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ICO_URL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `URL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `BANNER_URL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PLACEHOLDER_A` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`SOCIAL_TYPE_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

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
  `FIRST_NAME` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `LAST_NAME` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL_ADDRESS` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PUBLIC` int(11) DEFAULT NULL,
  `STATUS` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `COMPANY` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `JOB_TITLE` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`SPEAKER_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `SPEAKER_SOCIAL`
--

CREATE TABLE `SPEAKER_SOCIAL` (
  `SPEAKER_SOCIAL_IDENTITY` bigint(11) NOT NULL AUTO_INCREMENT,
  `SPEAKER_IDENTITY` int(11) NOT NULL,
  `SOCIAL_TYPE_IDENTITY` int(11) NOT NULL,
  `HANDLE` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PROFILE_URL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IS_VIEWABLE` tinyint(1) NOT NULL,
  PRIMARY KEY (`SPEAKER_SOCIAL_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

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
  `NAME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`STATE_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=52 ;

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
  `NAME` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`STATUS_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `STATUS`
--

INSERT INTO `STATUS` (`STATUS_IDENTITY`, `ACCOUNT_IDENTITY`, `NAME`) VALUES
(1, 10, 'Pending'),
(2, 10, 'Confirmed'),
(3, 10, 'Cancelled'),
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
  `NAME` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`TOPIC_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TRACK`
--

CREATE TABLE `TRACK` (
  `TRACK_IDENTITY` int(11) NOT NULL AUTO_INCREMENT,
  `ACCOUNT_IDENTITY` bigint(20) DEFAULT NULL,
  `NAME` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`TRACK_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

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
  `SESSION` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CREATED_DTTM` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LAST_REQUEST_DTTM` timestamp NULL DEFAULT NULL,
  `ACCOUNT_IDENTITY` bigint(20) NOT NULL,
  PRIMARY KEY (`USER_ACCESS_INDEX`),
  UNIQUE KEY `SESSION` (`SESSION`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=79 ;

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
(78, '40e1deb20bf95be599fabb2e12295645', '2014-08-11 17:57:40', '2014-08-12 00:40:36', 10);

-- --------------------------------------------------------

--
-- Table structure for table `VENUE`
--

CREATE TABLE `VENUE` (
  `VENUE_IDENTITY` bigint(20) NOT NULL AUTO_INCREMENT,
  `ACCOUNT_IDENTITY` bigint(20) NOT NULL,
  `NAME` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `IMAGE` longblob NOT NULL,
  `IMAGE_URL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `CAPACITY` int(11) NOT NULL,
  `ADDRESS` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `CITY` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `STATE` int(11) NOT NULL,
  `ZIP` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `COUNTRY` int(11) NOT NULL,
  `PUBLIC_USE` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`VENUE_IDENTITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `VENUE`
--

INSERT INTO `VENUE` (`VENUE_IDENTITY`, `ACCOUNT_IDENTITY`, `NAME`, `IMAGE`, `IMAGE_URL`, `CAPACITY`, `ADDRESS`, `CITY`, `STATE`, `ZIP`, `COUNTRY`, `PUBLIC_USE`) VALUES
(1, 10, 'The White House', 0x687474703a2f2f75706c6f61642e77696b696d656469612e6f72672f77696b6970656469612f636f6d6d6f6e732f612f61662f5768697465486f757365536f7574684661636164652e4a5047, '', 999, '1600 Penn Ave', 'Washington', 51, '02380', 231, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
