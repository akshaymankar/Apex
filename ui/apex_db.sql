-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 27, 2012 at 06:35 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `apex`
--
/*drop database apex;*/
create database apex;
use apex;

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

DROP TABLE IF EXISTS `userdata`;
CREATE TABLE IF NOT EXISTS `userdata` (
  `serialnum` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `usertype` varchar(10) NOT NULL,
  `locked` varchar(10) NOT NULL,
  PRIMARY KEY (`serialnum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Contains primary user info' AUTO_INCREMENT=7 ;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`serialnum`, `username`, `password`, `phone`, `usertype`, `locked`) VALUES
(2, 'main', PASSWORD('main'), '9923184428', 'admin', 'open'),
(3, 'user', PASSWORD('user'), NULL, 'user', 'open'),
(4, 'john', PASSWORD('john'), '9923129023', 'user', 'locked'),
(5, 'yogesh', PASSWORD('yogesh'), '9876567876', 'admin', 'nolock'),
(6, 'd', PASSWORD('d'), '9876567645', 'admin', 'open');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
