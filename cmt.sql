-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2016 at 11:26 AM
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `engineer`
--

INSERT INTO `engineer` (`id`, `password`, `project_id`, `module_id`, `number_of_complaints`, `project_manager`) VALUES
(11, 'sdfds', 12, 123, 123, 'yes'),
(1199, 'sdfds', 12, 123, 123, 'yes'),
(0, '', 30, 0, 0, ''),
(23, 'vfdfvfd', 28, 0, 0, 'y'),
(123, 'hello', 30, 27, 0, 'y'),
(1233, 'helloworld', 30, 28, 0, 'y'),
(12345, 'heythere', 30, 28, 0, 'n'),
(123456, 'huygtf', 30, 28, 0, 'n'),
(67, 'uifdhfviu', 30, 27, 0, 'n');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `project_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `project_id`) VALUES
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
  `engineer_id` int(10) NOT NULL,
  `timestamp` date NOT NULL,
  `status` varchar(25) NOT NULL,
  `priority` varchar(25) NOT NULL,
  `reopenings` int(25) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `problem`
--

INSERT INTO `problem` (`id`, `description`, `project_id`, `module_id`, `engineer_id`, `timestamp`, `status`, `priority`, `reopenings`) VALUES
(1, 'This is dummy', 1, 1, 1, '2016-03-01', 'n', 'h', 0),
(999, 'This is dummy', 1, 1, 1, '2016-03-01', 'n', 'h', 0);

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
  PRIMARY KEY (`id`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `manager_id`, `problems`, `client_id`) VALUES
(31, 'Karanss', NULL, 0, 0),
(30, 'Project1', 123456, 0, 0);

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
(1, 'pass', 'Karan');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
