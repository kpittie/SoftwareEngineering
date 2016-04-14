-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2016 at 11:19 AM
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
(123, '123');

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
  PRIMARY KEY (`id`),
  KEY `fk_project` (`project_id`),
  KEY `fk_module` (`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `engineer`
--

INSERT INTO `engineer` (`id`, `password`, `project_id`, `module_id`, `number_of_complaints`, `project_manager`, `status`) VALUES
(11, 'sdfds', 12, 123, 123, 'yes', 'unassigned'),
(1199, 'sdfds', 12, 123, 123, 'yes', 'unassigned'),
(0, '', 30, 0, 0, '', 'unassigned'),
(23, 'vfdfvfd', 28, 0, 0, 'y', 'unassigned'),
(123, 'hello', 30, 27, 0, 'y', 'unassigned'),
(1233, 'helloworld', 30, 28, 0, 'y', 'unassigned'),
(12345, 'heythere', 30, 28, 0, 'n', 'unassigned'),
(123456, 'huygtf', 30, 28, 0, 'n', 'unassigned'),
(67, 'uifdhfviu', 30, 27, 0, 'n', 'unassigned'),
(1234567890, 'vbfjhvbjhfvbjhfbvhbxfvhj', 30, 27, 0, 'n', 'unassigned'),
(2147483647, 'njnfvkjfdnvjnvkjfdjv', 30, 27, 0, 'n', 'unassigned'),
(13243342, 'dasdsad', 31, 31, 0, 'y', 'unassigned');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `project_id`) VALUES
(36, 'mod3', 33),
(35, 'mod2', 33),
(34, 'mod1', 33),
(33, 'frrf', 32),
(32, 'hdfv', 32),
(31, 'testhui', 31),
(30, 'test3', 31),
(29, 'mod1', 31),
(28, 'Module2', 30),
(27, 'Module1', 30);

-- --------------------------------------------------------

--
-- Table structure for table `problem`
--

CREATE TABLE IF NOT EXISTS `problem` (
  `id` int(10) NOT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `problem`
--

INSERT INTO `problem` (`id`, `description`, `project_id`, `module_id`, `engineer_id`, `timestamp`, `status`, `priority`, `reopenings`, `number_of_hours`, `solution_comment`) VALUES
(1, 'This is dummy', 1, 1, 1, '2016-03-01', 'n', 'h', 0, 0, NULL),
(999, 'This is dummy', 1, 1, 1, '2016-03-01', 'n', 'h', 0, 0, NULL),
(123, 'test3', 132123, 123, 0, '2016-04-05', 'c', 'h', 5, 0, NULL),
(1234, 'test4', 123, 123123, NULL, '2016-04-26', 'n', 'h', 0, 0, NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `manager_id`, `problems`, `client_id`) VALUES
(32, 'jsnk', NULL, 0, 0),
(31, 'Karanss', 13243342, 0, 0),
(33, 'test0', NULL, 0, 123456556),
(30, 'Project1', 1122211, 0, 1321213);

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

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `password`, `name`) VALUES
(1321213, 'vgfdgd', 'dsfsjnfs,m'),
(1, 'pass', 'Karan'),
(123456556, 'harsh', 'harsh');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
