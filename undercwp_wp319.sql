-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2015 at 08:21 AM
-- Server version: 5.1.73-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `undercwp_wp319`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `administrator_code` varchar(20) NOT NULL,
  `administrator_name` varchar(50) NOT NULL,
  `administrator_surname` varchar(50) NOT NULL,
  `administrator_username` varchar(50) NOT NULL,
  `administrator_password` varchar(20) DEFAULT NULL,
  `administrator_email` varchar(50) DEFAULT NULL,
  `administrator_cell` varchar(20) DEFAULT NULL,
  `administrator_last_login` datetime DEFAULT NULL,
  `administrator_updated` datetime NOT NULL,
  `administrator_active` tinyint(1) NOT NULL DEFAULT '1',
  `administrator_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `administrator_added` datetime NOT NULL,
  PRIMARY KEY (`administrator_code`),
  UNIQUE KEY `administrator_email_UNIQUE` (`administrator_username`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`administrator_code`, `administrator_name`, `administrator_surname`, `administrator_username`, `administrator_password`, `administrator_email`, `administrator_cell`, `administrator_last_login`, `administrator_updated`, `administrator_active`, `administrator_deleted`, `administrator_added`) VALUES
('254884', 'Bokang', 'Seritsane', 'bokang@under35mavericks.com', 'bokang123', 'bokang@under35mavericks.com', NULL, '2015-02-09 09:58:00', '2015-02-09 09:58:00', 1, 0, '2015-02-07 00:00:00'),
('478553', 'Mzimhle', 'Mosiwe', 'mzimhle@under35mavericks.com', 'sakile', 'mzimhle@under35mavericks.com', '0735640764', '2015-02-25 00:28:14', '2015-02-25 00:28:14', 1, 0, '2011-04-22 05:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `application_code` varchar(20) NOT NULL,
  `year_code` varchar(5) NOT NULL,
  `category_code` varchar(20) DEFAULT NULL COMMENT 'industry business is in',
  `participant_code` varchar(20) DEFAULT NULL,
  `areapost_code` varchar(20) DEFAULT NULL COMMENT 'to get the postal code',
  `application_name` varchar(50) DEFAULT NULL COMMENT 'company name',
  `application_tradingname` varchar(50) DEFAULT NULL COMMENT 'company trade name',
  `application_telephone` varchar(20) DEFAULT NULL,
  `application_website` varchar(50) DEFAULT NULL,
  `application_social_twitter` varchar(30) DEFAULT NULL COMMENT 'Twitter handler',
  `application_registration_number` varchar(20) DEFAULT NULL,
  `application_business_type` varchar(50) DEFAULT NULL,
  `application_tax_number` varchar(20) DEFAULT NULL,
  `application_bbee_level` int(3) DEFAULT NULL,
  `application_years` int(5) DEFAULT NULL COMMENT 'years in operation',
  `application_address` varchar(255) DEFAULT NULL,
  `application_province` varchar(20) DEFAULT NULL,
  `application_added` datetime NOT NULL,
  `application_updated` datetime DEFAULT NULL,
  `application_active` tinyint(1) NOT NULL DEFAULT '1',
  `application_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`application_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `applicationcategory`
--

CREATE TABLE IF NOT EXISTS `applicationcategory` (
  `applicationcategory_code` varchar(20) NOT NULL,
  `application_code` varchar(20) NOT NULL,
  `category_code` varchar(20) NOT NULL,
  `applicationcategory_notes` text,
  `applicationcategory_added` datetime NOT NULL,
  `applicationcategory_updated` datetime DEFAULT NULL,
  `applicationcategory_active` tinyint(1) NOT NULL DEFAULT '1',
  `applicationcategory_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `applicationquestion`
--

CREATE TABLE IF NOT EXISTS `applicationquestion` (
  `applicationquestion_code` varchar(20) NOT NULL,
  `applicationsub_code` varchar(20) NOT NULL,
  `applicationquestion_name` varchar(255) NOT NULL,
  `applicationquestion_added` datetime NOT NULL,
  `applicationquestion_updated` datetime DEFAULT NULL,
  `applicationquestion_active` tinyint(1) NOT NULL DEFAULT '1',
  `applicationquestion_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `awardcategory`
--

CREATE TABLE IF NOT EXISTS `awardcategory` (
  `awardcategory_code` varchar(20) NOT NULL,
  `year_code` varchar(10) NOT NULL,
  `awardcategory_name` varchar(100) NOT NULL,
  `awardcategory_added` datetime NOT NULL,
  `awardcategory_updated` datetime DEFAULT NULL,
  `awardcategory_active` tinyint(1) NOT NULL DEFAULT '1',
  `awardcategory_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`awardcategory_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `awardcategory`
--

INSERT INTO `awardcategory` (`awardcategory_code`, `year_code`, `awardcategory_name`, `awardcategory_added`, `awardcategory_updated`, `awardcategory_active`, `awardcategory_deleted`) VALUES
('1424803951598', '2015', 'The Maverick Start-Up of The Year', '2015-02-24 20:52:31', NULL, 1, 0),
('1424804120176', '2015', 'The Maverick Award for Employment Creation', '2015-02-24 20:55:20', NULL, 1, 0),
('1424804134556', '2015', 'The Maverick Without Borders Award for Export Excellence', '2015-02-24 20:55:34', NULL, 1, 0),
('1424804145821', '2015', 'The Maverick Award for Social Innovation Excellence', '2015-02-24 20:55:45', NULL, 1, 0),
('1424804156721', '2015', 'The Maverick Award for Service Innovation Excellence', '2015-02-24 20:55:56', NULL, 1, 0),
('1424804167651', '2015', 'The Maverick Award for Manufacturing and Industrial Innovation Excellence', '2015-02-24 20:56:07', NULL, 1, 0),
('1424804177865', '2015', 'The Maverick Award for Built Environment Innovation Excellence', '2015-02-24 20:56:17', NULL, 1, 0),
('1424804189487', '2015', 'The Maverick Award for Agricultural Innovation Excellence', '2015-02-24 20:56:29', NULL, 1, 0),
('1424804202634', '2015', 'The Maverick Award for Green Innovation Excellence', '2015-02-24 20:56:42', NULL, 1, 0),
('1424804213915', '2015', 'The Maverick Award for Technology Innovation Excellence', '2015-02-24 20:56:53', NULL, 1, 0),
('1424804229862', '2015', 'The Maverick Award for Blue Ocean Innovation Excellence', '2015-02-24 20:57:09', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `awardsection`
--

CREATE TABLE IF NOT EXISTS `awardsection` (
  `awardsection_code` varchar(20) NOT NULL,
  `year_code` varchar(20) NOT NULL,
  `awardsection_name` varchar(50) NOT NULL,
  `awardsection_index` int(5) NOT NULL DEFAULT '1',
  `awardsection_added` datetime NOT NULL,
  `awardsection_updated` datetime DEFAULT NULL,
  `awardsection_active` tinyint(1) NOT NULL DEFAULT '1',
  `awardsection_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`awardsection_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `awardsection`
--

INSERT INTO `awardsection` (`awardsection_code`, `year_code`, `awardsection_name`, `awardsection_index`, `awardsection_added`, `awardsection_updated`, `awardsection_active`, `awardsection_deleted`) VALUES
('1424815332333', '2015', 'Business Overview', 1, '2015-02-25 00:02:12', '2015-02-25 00:06:47', 1, 0),
('1424815418558', '2015', 'Innovation', 2, '2015-02-25 00:03:38', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `awardsubsection`
--

CREATE TABLE IF NOT EXISTS `awardsubsection` (
  `awardsubsection_code` varchar(20) NOT NULL,
  `awardsection_code` varchar(20) NOT NULL,
  `awardsubsection_name` varchar(100) NOT NULL,
  `awardsubsection_index` int(5) NOT NULL DEFAULT '1',
  `awardsubsection_added` datetime NOT NULL,
  `awardsubsection_updated` datetime DEFAULT NULL,
  `awardsubsection_active` tinyint(1) NOT NULL DEFAULT '1',
  `awardsubsection_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`awardsubsection_code`),
  UNIQUE KEY `awardsubsection_code` (`awardsubsection_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE IF NOT EXISTS `campaign` (
  `campaign_code` varchar(20) NOT NULL,
  `campaign_name` varchar(100) NOT NULL,
  `campaign_type` varchar(10) NOT NULL COMMENT 'SMS or EMAIL',
  `campaign_sent` tinyint(1) DEFAULT '0',
  `campaign_sentDate` datetime DEFAULT NULL,
  `campaign_subject` varchar(100) DEFAULT NULL,
  `campaign_content` text,
  `campaign_html` text,
  `campaign_added` datetime DEFAULT NULL,
  `campaign_updated` datetime DEFAULT NULL,
  `campaign_active` tinyint(1) DEFAULT '1',
  `campaign_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`campaign_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `company_code` varchar(20) NOT NULL,
  `areapost_code` varchar(10) DEFAULT NULL,
  `participant_code` varchar(20) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_tax` varchar(20) DEFAULT NULL,
  `company_registration` varchar(30) DEFAULT NULL,
  `company_website` varchar(50) DEFAULT NULL,
  `company_description` varchar(200) DEFAULT NULL COMMENT 'This is for search purposes, less than 50 letters',
  `company_logo` varchar(50) DEFAULT NULL COMMENT 'path to the logo only',
  `company_address` varchar(150) DEFAULT NULL,
  `company_postal` varchar(150) DEFAULT NULL,
  `company_latitude` varchar(30) DEFAULT NULL,
  `company_longitude` varchar(30) DEFAULT NULL,
  `company_url` varchar(50) DEFAULT NULL,
  `company_telephone` varchar(15) DEFAULT NULL,
  `company_cellphone` varchar(15) DEFAULT NULL,
  `company_fax` varchar(15) DEFAULT NULL,
  `company_email` varchar(30) DEFAULT NULL,
  `company_logo_name` varchar(20) DEFAULT NULL,
  `company_logo_path` varchar(50) DEFAULT NULL,
  `company_logo_ext` varchar(5) DEFAULT NULL,
  `company_added` datetime DEFAULT NULL,
  `company_updated` datetime DEFAULT NULL,
  `company_active` tinyint(1) DEFAULT '1',
  `company_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`company_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `companyservice`
--

CREATE TABLE IF NOT EXISTS `companyservice` (
  `companyservice_code` varchar(20) NOT NULL,
  `company_code` varchar(20) DEFAULT NULL,
  `category_code` varchar(10) DEFAULT NULL,
  `companyservice_type` varchar(10) DEFAULT NULL COMMENT 'CATEGORY or SERVICE',
  `companyservice_name` varchar(50) DEFAULT NULL,
  `companyservice_primary` tinyint(1) DEFAULT NULL,
  `companyservice_added` datetime DEFAULT NULL,
  `companyservice_updated` datetime DEFAULT NULL,
  `companyservice_active` tinyint(1) DEFAULT '1',
  `companyservice_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`companyservice_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `document_code` varchar(20) NOT NULL COMMENT 'use ',
  `document_reference` varchar(20) DEFAULT NULL COMMENT 'code of the item the file belongs to, be it asset, assetsection, assetcost, etc.',
  `document_type` varchar(20) DEFAULT NULL COMMENT 'Type the file belongs to be it asset, assetsection, assetcost, etc.',
  `document_name` varchar(200) DEFAULT NULL,
  `document_path` varchar(150) DEFAULT NULL,
  `document_filename` varchar(100) DEFAULT NULL,
  `document_comment` varchar(255) DEFAULT NULL,
  `document_added` datetime DEFAULT NULL,
  `document_updated` datetime DEFAULT NULL,
  `document_active` tinyint(1) DEFAULT '1',
  `document_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`document_code`),
  UNIQUE KEY `pk_jobType_id_UNIQUE` (`document_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='I.T., financials, etc for all categories';

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `event_code` varchar(50) NOT NULL,
  `event_name` varchar(150) NOT NULL,
  `event_description` varchar(255) DEFAULT NULL,
  `event_address` varchar(50) DEFAULT NULL,
  `event_startdate` datetime DEFAULT NULL,
  `event_enddate` datetime DEFAULT NULL,
  `event_page` text,
  `event_url` varchar(100) DEFAULT NULL,
  `event_added` datetime DEFAULT NULL,
  `event_updated` datetime DEFAULT NULL,
  `event_active` tinyint(1) DEFAULT '1',
  `event_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`event_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_code`, `event_name`, `event_description`, `event_address`, `event_startdate`, `event_enddate`, `event_page`, `event_url`, `event_added`, `event_updated`, `event_active`, `event_deleted`) VALUES
('6384434799', 'Night of the Unknowns Xmas Afterparty', 'adfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad f', 'adfad fadfad fadfad f', '2015-01-19 00:00:00', '2015-01-31 00:00:00', 'adfad fadfad fadfad fadfadadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad f fadfad fadfad fadfad fadfad fadfad fadfadadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad f fadfad fadfad fadfad fadfad fadfad fadfadadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad f fadfad fadfad fadfad fadfad fadfad fadfadadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad fadfad \r\nfadfad fadfad f fadfad fadfad f', 'night_of_the_unknowns_xmas_afterparty', '2015-01-30 19:29:09', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `financial`
--

CREATE TABLE IF NOT EXISTS `financial` (
  `financial_code` varchar(20) NOT NULL,
  `application_code` varchar(20) NOT NULL,
  `financial_type` varchar(30) NOT NULL COMMENT 'revenue or gross',
  `financial_year` varchar(20) NOT NULL COMMENT 'e.g. 2012 / 2013',
  `financial_descption` text NOT NULL COMMENT 'Briefly Explain The Drivers of Y/Y Gross Profit Growth or Reduction in each year:',
  `financial_employees` int(9) NOT NULL,
  `financial_avgremuneration` decimal(7,2) NOT NULL,
  `financial_added` datetime NOT NULL,
  `financial_updated` datetime DEFAULT NULL,
  `financial_active` tinyint(1) DEFAULT '1',
  `financial_deleted` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `gallery_code` varchar(20) NOT NULL,
  `year_code` int(5) NOT NULL,
  `gallery_name` varchar(100) NOT NULL,
  `gallery_description` varchar(255) DEFAULT NULL,
  `gallery_added` datetime DEFAULT NULL,
  `gallery_updated` datetime DEFAULT NULL,
  `gallery_active` tinyint(1) DEFAULT '1',
  `gallery_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`gallery_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `galleryimage`
--

CREATE TABLE IF NOT EXISTS `galleryimage` (
  `galleryimage_code` varchar(20) NOT NULL,
  `gallery_code` varchar(20) NOT NULL,
  `galleryimage_primary` tinyint(1) DEFAULT '0',
  `galleryimage_description` varchar(255) DEFAULT NULL,
  `galleryimage_filename` varchar(20) DEFAULT NULL,
  `galleryimage_path` varchar(50) DEFAULT NULL,
  `galleryimage_ext` varchar(5) DEFAULT NULL,
  `galleryimage_added` datetime DEFAULT NULL,
  `galleryimage_updated` datetime DEFAULT NULL,
  `galleryimage_active` tinyint(1) DEFAULT '1',
  `galleryimage_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`galleryimage_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE IF NOT EXISTS `participant` (
  `participant_code` varchar(20) NOT NULL,
  `participant_name` varchar(100) NOT NULL,
  `participant_surname` varchar(100) DEFAULT NULL,
  `participant_email` varchar(50) NOT NULL,
  `participant_designation` varchar(30) DEFAULT NULL,
  `participant_birthdate` date DEFAULT NULL,
  `participant_cellphone` varchar(15) DEFAULT NULL,
  `participant_social_twitter` varchar(30) DEFAULT NULL COMMENT 'twitter handle',
  `participant_added` datetime DEFAULT NULL,
  `participant_updated` datetime DEFAULT NULL,
  `participant_active` tinyint(1) DEFAULT '1',
  `participant_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`participant_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`participant_code`, `participant_name`, `participant_surname`, `participant_email`, `participant_designation`, `participant_birthdate`, `participant_cellphone`, `participant_social_twitter`, `participant_added`, `participant_updated`, `participant_active`, `participant_deleted`) VALUES
('24875879167814962121', 'Mzimhle Sakile', 'Mosiwe', 'mzimhle@willow-nettica.co.za', '8610285815088', '2014-09-03', '0735640764', NULL, '2014-09-25 22:29:05', '2014-09-25 22:41:06', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `participantlogin`
--

CREATE TABLE IF NOT EXISTS `participantlogin` (
  `participantlogin_code` varchar(20) NOT NULL,
  `participant_code` varchar(20) NOT NULL,
  `participantlogin_type` varchar(20) NOT NULL,
  `participantlogin_id` varchar(50) DEFAULT NULL,
  `participantlogin_username` varchar(100) NOT NULL COMMENT 'email or cell number',
  `participantlogin_password` varchar(20) DEFAULT NULL,
  `participantlogin_name` varchar(100) DEFAULT NULL,
  `participantlogin_surname` varchar(100) DEFAULT NULL,
  `participantlogin_image` varchar(255) DEFAULT NULL,
  `participantlogin_location` varchar(100) DEFAULT NULL,
  `participantlogin_url` varchar(200) DEFAULT NULL,
  `participantlogin_hashcode` varchar(30) DEFAULT NULL,
  `participantlogin_lastlogin` datetime DEFAULT NULL,
  `participantlogin_added` datetime DEFAULT NULL,
  `participantlogin_updated` datetime DEFAULT NULL,
  `participantlogin_active` tinyint(1) DEFAULT '0',
  `participantlogin_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`participantlogin_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participantlogin`
--

INSERT INTO `participantlogin` (`participantlogin_code`, `participant_code`, `participantlogin_type`, `participantlogin_id`, `participantlogin_username`, `participantlogin_password`, `participantlogin_name`, `participantlogin_surname`, `participantlogin_image`, `participantlogin_location`, `participantlogin_url`, `participantlogin_hashcode`, `participantlogin_lastlogin`, `participantlogin_added`, `participantlogin_updated`, `participantlogin_active`, `participantlogin_deleted`) VALUES
('1178675172', '24875879167814962121', 'EMAIL', NULL, 'mzimhle@willow-nettica.co.za', '16rfbg', 'Mzimhle Sakile', 'Mosiwe', NULL, NULL, NULL, 'c6235061a7cd4dc7ee8b832f8dc3d7', NULL, '2014-09-25 22:29:05', '2014-09-25 22:41:06', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `type_code` varchar(10) NOT NULL COMMENT 'use ',
  `type_name` varchar(50) DEFAULT NULL,
  `type_url` varchar(50) DEFAULT NULL,
  `type_added` datetime DEFAULT NULL,
  `type_updated` datetime DEFAULT NULL,
  `type_active` tinyint(1) DEFAULT '1',
  `type_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`type_code`),
  UNIQUE KEY `pk_jobType_id_UNIQUE` (`type_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='I.T., financials, etc for all categories';

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_code`, `type_name`, `type_url`, `type_added`, `type_updated`, `type_active`, `type_deleted`) VALUES
('01637', 'Laundry Services', 'laundry_services', '2014-04-21 20:04:25', NULL, 1, 0),
('02134', 'Civil engineering', 'civil_engineering', '2014-04-21 20:01:56', '2014-09-18 15:54:17', 1, 1),
('05857', 'Security Services', 'security_services', '2014-04-21 20:06:07', NULL, 1, 0),
('06296', 'Appliances', 'appliances', '2014-04-21 19:58:09', NULL, 1, 0),
('07253', 'Accounting and Auditing', 'accounting_and_auditing', '2014-04-21 19:57:47', NULL, 1, 0),
('09187', 'Medical Supplies', 'medical_supplies', '2014-04-21 20:04:59', NULL, 1, 0),
('15611', 'Quantity Surveyor', 'quantity_surveyor', '2014-04-21 20:05:41', NULL, 1, 0),
('18142', 'Legal and Paralegal', 'legal_and_paralegal', '2014-09-18 15:51:04', NULL, 1, 0),
('18866', 'Construction and architectural services', 'construction_and_architectural_services', '2014-04-21 20:02:19', NULL, 1, 0),
('19100', 'Specialised Products', 'specialised_products', '2014-04-21 20:06:13', NULL, 1, 0),
('19513', 'Information Technology and Telecommunication', 'information_technology_and_telecommunication', '2014-04-21 20:04:03', NULL, 1, 0),
('20976', 'Gardening Services', 'gardening_services', '2014-04-21 20:03:31', NULL, 1, 0),
('21595', 'Landscaping and horticulture', 'landscaping_and_horticulture', '2014-04-21 20:04:19', NULL, 1, 0),
('22201', 'Electrical Equipment', 'electrical_equipment', '2014-04-21 20:02:47', NULL, 1, 0),
('22987', 'Sports and Fitness', 'sports_and_fitness', '2014-09-18 15:48:50', NULL, 1, 0),
('23712', 'Pest Control Services', 'pest_control_services', '2014-04-21 20:05:16', NULL, 1, 0),
('25095', 'Human Resources and Labour', 'human_resources_and_labour', '2014-04-21 20:03:50', NULL, 1, 0),
('29090', 'Insurance services', 'insurance_services', '2014-04-21 20:04:08', NULL, 1, 0),
('29271', 'Waste Removal', 'waste_removal', '2014-04-21 20:06:56', NULL, 1, 0),
('29384', 'Events Management', 'events_management', '2014-04-21 20:03:00', NULL, 1, 0),
('30059', 'Recruitment Services', 'recruitment_services', '2014-04-21 20:05:48', NULL, 1, 0),
('31226', 'Furniture', 'furniture', '2014-04-21 20:03:22', NULL, 1, 0),
('36018', 'Agriculture', 'agriculture', '2014-04-21 19:57:54', NULL, 1, 0),
('36818', 'Chemical Supplies', 'chemical_supplies', '2014-04-21 20:00:26', NULL, 1, 0),
('42402', 'Research, Consultancy and Professional Services', 'research,_consultancy_and_professional_services', '2014-04-21 20:05:55', NULL, 1, 0),
('47246', 'Road, Construction and Maintainance', 'road,_construction_and_maintainance', '2014-04-21 20:06:00', '2014-09-18 15:50:25', 1, 1),
('47833', 'Printing', 'printing', '2014-04-21 20:05:27', NULL, 1, 0),
('48231', 'Financial Services', 'financial_services', '2014-04-21 20:03:05', NULL, 1, 0),
('49589', 'Graphic design, publishing and DTP', 'graphic_design,_publishing_and_dtp', '2014-04-21 20:03:39', NULL, 1, 0),
('51907', 'Plumbing services', 'plumbing_services', '2014-04-21 20:05:22', NULL, 1, 0),
('52399', 'Education and Training', 'education_and_training', '2014-04-21 20:02:30', NULL, 1, 0),
('52445', 'Electrical Engineering', 'electrical_engineering', '2014-04-21 20:02:42', '2014-09-18 15:54:07', 1, 1),
('52920', 'Interior Design Services', 'interior_design_services', '2014-04-21 20:04:14', NULL, 1, 0),
('53658', 'Healthcare', 'healthcare', '2014-04-21 20:03:44', NULL, 1, 0),
('54599', 'Transport, Import / Export, and Logistics', 'transport_and_logistics', '2014-04-21 20:06:37', '2014-09-18 15:53:19', 1, 0),
('58463', 'Water works', 'water_works', '2014-04-21 20:07:04', '2014-04-28 13:47:40', 1, 0),
('60672', 'Property and Real Estate', 'property_and_real_estate', '2014-04-21 20:05:34', NULL, 1, 0),
('61967', 'Video and Film', 'video_and_film', '2014-04-21 20:06:50', NULL, 1, 0),
('64042', 'Mechanical engineering', 'mechanical_engineering', '2014-04-21 20:04:29', '2014-09-18 15:53:59', 1, 1),
('64616', 'Facilities, Building Repairs and Maintenance', 'building_repairs_and_maintenance', '2014-04-21 19:58:25', '2014-09-18 15:41:44', 1, 0),
('66289', 'Catering Services', 'catering_services', '2014-04-21 19:58:32', NULL, 1, 0),
('67011', 'Specialised Services', 'specialised_services', '2014-04-21 20:06:19', NULL, 1, 0),
('69297', 'Marketing, Communication, Public Relations and Adv', 'communication,_public_relations_and_advertising', '2014-04-21 20:02:13', '2014-09-18 15:42:14', 1, 0),
('69492', 'Courier Services', 'courier_services', '2014-04-21 20:02:24', NULL, 1, 0),
('70272', 'Equipment hire', 'equipment_hire', '2014-04-21 20:02:53', NULL, 1, 0),
('70802', 'Clothing and textiles', 'clothing_and_textiles', '2014-04-21 20:02:08', NULL, 1, 0),
('73443', 'Electrical and Mechanical Services', 'electrical_and_mechanical_services', '2014-04-21 20:02:36', NULL, 1, 0),
('76499', 'Hotel and Hospitality', 'hotel_and_hospitality', '2014-09-18 15:41:06', '2014-09-18 15:41:18', 1, 1),
('78435', 'Trades, Import / Exports and Services', 'trades,_import_exports_and_services', '2014-09-18 15:49:41', '2014-09-18 15:53:47', 1, 1),
('78753', 'Science, Biology and Physics', 'science,_biology_and_physics', '2014-09-18 15:42:47', NULL, 1, 0),
('79337', 'Office Administration and Payroll', 'office_equipment_stationary_and_furniture', '2014-04-21 20:05:04', '2014-09-18 15:43:55', 1, 0),
('79464', 'Hygiene Services', 'hygiene_services', '2014-04-21 20:03:56', NULL, 1, 0),
('83334', 'Cleaning Services', 'cleaning_services', '2014-04-21 20:02:02', NULL, 1, 0),
('83543', 'Manufacturing and Engineering', 'manufacturing_and_engineering', '2014-09-18 15:51:51', NULL, 1, 0),
('84665', 'Vehicles and vehicle parts', 'vehicles_and_vehicle_parts', '2014-04-21 20:06:45', NULL, 1, 0),
('85179', 'Building materials', 'building_materials', '2014-04-21 19:58:17', NULL, 1, 0),
('87704', 'Tourism, Travel and Hospitality', 'tourism,_travel_and_hospitality', '2014-04-21 20:06:31', NULL, 1, 0),
('88524', 'Air-conditioning', 'air_conditioning', '2014-04-21 19:58:01', NULL, 1, 0),
('89503', 'Painting', 'painting', '2014-04-21 20:05:10', NULL, 1, 0),
('91134', 'Retail, Sales and Franchise', 'retail_and_franchise', '2014-09-18 15:48:27', '2014-09-18 15:52:35', 1, 0),
('92803', 'Medical equipment', 'medical_equipment', '2014-04-21 20:04:48', NULL, 1, 0),
('96253', 'Mechanical Equipment', 'mechanical_equipment', '2014-04-21 20:04:41', NULL, 1, 0),
('98333', 'Food Products', 'food_products', '2014-04-21 20:03:11', NULL, 1, 0),
('98527', 'Structural Engineering', 'structural_engineering', '2014-04-21 20:06:25', '2014-09-18 15:52:10', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE IF NOT EXISTS `year` (
  `year_code` varchar(5) NOT NULL,
  `year_name` varchar(100) NOT NULL,
  `year_added` datetime NOT NULL,
  `year_updated` datetime DEFAULT NULL,
  `year_active` tinyint(1) NOT NULL DEFAULT '1',
  `year_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`year_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`year_code`, `year_name`, `year_added`, `year_updated`, `year_active`, `year_deleted`) VALUES
('2014', '2014 Awards', '2015-01-31 09:25:44', '2015-01-31 09:25:49', 1, 0),
('2015', '2015 Awards', '2015-02-24 20:40:00', NULL, 1, 0),
('2016', '2016 Awards', '2015-02-24 21:05:05', '2015-02-24 21:05:09', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `_comm`
--

CREATE TABLE IF NOT EXISTS `_comm` (
  `_comm_code` varchar(20) NOT NULL,
  `campaign_code` varchar(20) DEFAULT NULL,
  `participant_code` varchar(20) NOT NULL,
  `_comm_name` varchar(30) DEFAULT NULL,
  `_comm_type` varchar(20) DEFAULT NULL COMMENT 'what ',
  `_comm_sent` tinyint(1) DEFAULT '0',
  `_comm_reference` varchar(20) DEFAULT NULL,
  `_comm_cellphone` varchar(15) DEFAULT NULL,
  `_comm_email` varchar(50) DEFAULT NULL,
  `_comm_output` varchar(200) DEFAULT NULL COMMENT 'message returned when sending.',
  `_comm_message` varchar(100) DEFAULT NULL COMMENT 'sms message sent',
  `_comm_html` text COMMENT 'email message sent',
  `_comm_added` datetime DEFAULT NULL,
  PRIMARY KEY (`_comm_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_tracker`
--

CREATE TABLE IF NOT EXISTS `_tracker` (
  `_tracker_code` varchar(100) NOT NULL,
  `_comm_code` varchar(100) NOT NULL COMMENT 'what ',
  `_tracker_views` varchar(5) DEFAULT NULL COMMENT 'number of views on this particular item.',
  `_tracker_added` datetime NOT NULL,
  PRIMARY KEY (`_tracker_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
