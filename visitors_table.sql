-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 15, 2016 at 09:59 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `visitors_table`
--

-- --------------------------------------------------------

--
-- Table structure for table `visitors_table`
--

CREATE TABLE IF NOT EXISTS `visitors_table` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `visitor_ip` varchar(32) DEFAULT NULL,
  `visitor_browser` varchar(255) DEFAULT NULL,
  `visitor_hour` smallint(2) NOT NULL DEFAULT '0',
  `visitor_minute` smallint(2) NOT NULL DEFAULT '0',
  `visitor_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visitor_day` smallint(2) NOT NULL,
  `visitor_month` smallint(2) NOT NULL,
  `visitor_year` smallint(4) NOT NULL,
  `visitor_refferer` varchar(255) DEFAULT NULL,
  `visitor_page` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `visitors_table`
--

INSERT INTO `visitors_table` (`ID`, `visitor_ip`, `visitor_browser`, `visitor_hour`, `visitor_minute`, `visitor_date`, `visitor_day`, `visitor_month`, `visitor_year`, `visitor_refferer`, `visitor_page`) VALUES
(1, '172.16.212.174', 'mozilla', 9, 58, '0000-00-00 00:00:00', 15, 4, 2016, '172.16.212.174', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
