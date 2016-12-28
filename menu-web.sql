-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 28, 2016 at 03:16 PM
-- Server version: 5.5.52-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `menu-web`
--

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE IF NOT EXISTS `dish` (
  `Name` varchar(50) NOT NULL,
  `Price` float NOT NULL,
  `Outcome` float NOT NULL,
  `Factor` float NOT NULL,
  `Ingredients` text NOT NULL,
  `Emounts` text NOT NULL,
  `OutEmounts` text NOT NULL,
  `Notes` text NOT NULL,
  `Type` text NOT NULL,
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`Name`, `Price`, `Outcome`, `Factor`, `Ingredients`, `Emounts`, `OutEmounts`, `Notes`, `Type`) VALUES
('баже-куре', 114, 300, 8, 'a:4:{i:0;s:23:"стегна курки";i:1;s:16:"картопля";i:2;s:18:"кукурудза";i:3;s:8:"Мука";}', 'a:4:{i:0;s:3:"400";i:1;s:3:"200";i:2;s:3:"100";i:3;s:3:"200";}', 'a:4:{i:0;s:3:"240";i:1;s:3:"120";i:2;s:2:"60";i:3;s:3:"120";}', 'общіпати\r\nпомолоти\r\nпотовкти\r\nвимішати\r\nвикатати\r\nсмажити\r\nваритии\r\nтушити', 'курка'),
('Уха', 100, 250, 49, 'a:2:{i:0;s:12:"кілька";i:1;s:16:"картопля";}', 'a:2:{i:0;s:3:"300";i:1;s:3:"200";}', 'a:2:{i:0;s:3:"180";i:1;s:3:"120";}', 'піймати і зварити', 'перше,риба');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
  `Name` varchar(50) NOT NULL,
  `Price` float NOT NULL,
  `Pack` float NOT NULL,
  `Unit` varchar(5) NOT NULL,
  `BarPrice` float NOT NULL,
  PRIMARY KEY (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`Name`, `Price`, `Pack`, `Unit`, `BarPrice`) VALUES
('зємнякі', 50, 1, 'кг', 70),
('кілька', 15, 0.2, 'кг', 150),
('картопля', 20, 1, 'кг', 30),
('кукурудза', 30, 0.2, 'кг', 300),
('Мука', 70, 2, 'кг', 70),
('сіль', 10, 1, 'кг', 30),
('стегна курки', 70, 1, 'кг', 140),
('цибуля', 30, 1, 'кг', 60),
('цукор', 80, 1, 'кг', 160),
('яйце', 1.5, 1, 'шт', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
