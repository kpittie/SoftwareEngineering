-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2016 at 07:49 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) NOT NULL,
  `password` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `password`) VALUES
(123, '$2lH9Bbg1vo/g');

-- --------------------------------------------------------

--
-- Table structure for table `engineer`
--

CREATE TABLE IF NOT EXISTS `engineer` (
  `id` int(10) NOT NULL,
  `password` varchar(25) NOT NULL,
  `project_id` int(10) NOT NULL,
  `module_id` int(10) NOT NULL,
  `number_of_complaints` int(10) NOT NULL DEFAULT '0',
  `project_manager` text NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'unassigned',
  `total_complaints` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_project` (`project_id`),
  KEY `fk_module` (`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `project_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_project_module` (`project_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

-- --------------------------------------------------------

--
-- Table structure for table `problem`
--

CREATE TABLE IF NOT EXISTS `problem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(31) NOT NULL,
  `project_id` int(10) NOT NULL,
  `module_id` int(10) NOT NULL,
  `engineer_id` int(10) DEFAULT NULL,
  `timestamp` date NOT NULL,
  `status` varchar(1) NOT NULL,
  `priority` varchar(25) NOT NULL,
  `reopenings` int(25) NOT NULL DEFAULT '0',
  `number_of_hours` int(11) NOT NULL DEFAULT '0',
  `solution_comment` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_project_problem` (`project_id`),
  KEY `fk_module_problem` (`module_id`),
  KEY `fk_engineer_problem` (`engineer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1250 ;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `problems` int(10) NOT NULL DEFAULT '0',
  `client_id` int(10) NOT NULL,
  PRIMARY KEY (`id`,`name`),
  KEY `fk_manager_project` (`manager_id`),
  KEY `fk_client_project` (`client_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL,
  `password` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
