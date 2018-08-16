-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 08, 2018 at 03:11 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbhotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adminID` int(20) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) DEFAULT NULL,
  `middleName` varchar(20) DEFAULT NULL,
  `lastName` varchar(20) DEFAULT NULL,
  `contactNumber` varchar(15) DEFAULT NULL,
  `emailAddress` varchar(50) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `firstName`, `middleName`, `lastName`, `contactNumber`, `emailAddress`, `username`, `password`) VALUES
(5, NULL, NULL, NULL, NULL, 'demo@demo.com', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` int(200) NOT NULL AUTO_INCREMENT,
  `reservation_code` varchar(50) NOT NULL,
  `isReserved` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) DEFAULT '1',
  `isModified` tinyint(1) NOT NULL DEFAULT '0',
  `isCancelled` tinyint(1) NOT NULL DEFAULT '0',
  `total_adult` int(50) NOT NULL,
  `total_children` int(50) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `special_requirement` text NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `total_amount` double DEFAULT NULL,
  `amount_paid` decimal(6,0) NOT NULL DEFAULT '0',
  `bank_slip` varchar(255) NOT NULL,
  `bank_slip2` varchar(255) NOT NULL,
  `deposit` double NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone_no` varchar(30) NOT NULL,
  `add_line1` varchar(100) NOT NULL,
  `add_line2` varchar(100) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `postcode` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `reservation_code`, `isReserved`, `isActive`, `isModified`, `isCancelled`, `total_adult`, `total_children`, `checkin_date`, `checkout_date`, `special_requirement`, `payment_status`, `total_amount`, `amount_paid`, `bank_slip`, `bank_slip2`, `deposit`, `booking_date`, `first_name`, `last_name`, `email`, `telephone_no`, `add_line1`, `add_line2`, `city`, `state`, `postcode`, `country`) VALUES
(17, 'RhxM2nswQ45K6GvT9uEri8bp', 0, 0, 1, 0, 1, 0, '2018-02-04', '2018-02-05', '', 'pending', 3000, '0', '', '', 450, '2018-02-04 06:46:55', 'Khen', 'Daniel', 'hbaniqued@yopmail.com', '09065260321', 'Marikina', '', 'Marikina', 'PH', '1800', 'Philippines'),
(18, 'NiHUbVCSf8J42FQTWcGyEKIA', 1, 1, 0, 0, 1, 0, '2018-02-04', '2018-02-05', '', 'Fully paid', 5000, '5000', 'img/bankslips/b1.jpg', '', 750, '2018-02-04 06:56:24', 'Khen', 'Daniel', 'haroldbaniqued@yahoo.com', '1231233123', 'Marikina', '', 'Marin', 'PH', '1800', 'Philippines'),
(19, '50EYUXzPksc2FrWLJBQgi3Mu', 1, 1, 0, 0, 2, 0, '2018-02-27', '2018-02-28', '', 'Fully paid', 3000, '3000', 'img/bankslips/b2.jpeg', '', 450, '2018-02-04 07:23:17', 'Khen', 'Khen', 'qweqweqweqwe@yahoo.com', '609065260321', 'qweqwe', '', 'qwewqe', 'PH', '123123', 'Philippines'),
(20, '7fpBHiI6XzlvSoh92NkKFZWC', 0, 0, 0, 1, 1, 0, '2018-02-05', '2018-02-06', '', 'pending', 3000, '0', '', '', 450, '2018-02-05 15:38:38', 'qwe', 'qwqwe', 'qwe@qwe.qwe', '12321321', 'qwe', '', 'qwe', 'PH', '123', 'Philippines'),
(21, 'tMO8WilwXJxdHCkU1pevaPcR', 1, 1, 0, 0, 2, 0, '2018-02-06', '2018-02-07', '', 'Fully paid', 3000, '3000', 'img/bankslips/b3.jpg', '', 450, '2018-02-06 05:30:40', 'Khen', 'Khen', 'qwe@qwe.qwe', '123123', 'qweqw', '', 'qweqwe', 'PH', '123', 'Philippines'),
(22, 'ulMURjNyB6g92h3CbKHiSTf0', 1, 1, 0, 1, 1, 0, '2018-02-06', '2018-02-07', '', 'Fully paid', 2500, '2500', 'img/bankslips/b4.png', '', 375, '2018-02-06 05:33:16', 'Test', 'Test', 'qwe@qwe.qwe', '123', 'qweqwqwe', 'qwe', 'qwe', 'PH', '123', 'Philippines');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customerID` int(20) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) DEFAULT NULL,
  `middleName` varchar(20) DEFAULT NULL,
  `lastName` varchar(20) DEFAULT NULL,
  `contactNumber` varchar(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `emailAddress` varchar(50) NOT NULL,
  PRIMARY KEY (`customerID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `room_id` int(255) NOT NULL AUTO_INCREMENT,
  `isCottage` tinyint(1) NOT NULL DEFAULT '0',
  `total_room` int(255) NOT NULL,
  `occupancy` int(255) DEFAULT NULL,
  `size` varchar(30) DEFAULT NULL,
  `view` varchar(30) DEFAULT NULL,
  `room_name` varchar(50) NOT NULL,
  `descriptions` text,
  `rate` double NOT NULL,
  `imgpath` varchar(100) NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `isCottage`, `total_room`, `occupancy`, `size`, `view`, `room_name`, `descriptions`, `rate`, `imgpath`) VALUES
(5, 0, 1, 5, '', '', 'Family Rooms', 'Insert description here', 3000, 'img/family1.jpg'),
(6, 0, 14, 4, '50 sqft', 'None', 'Standard Room', 'Insert description here', 2500, 'img/standard1.jpg'),
(11, 1, 12, 12, '', '', 'Test', '12', 12, 'img/240_F_152194974_ivF7F6Td5xQuYuBh17TC5Q4MYjIXz8yY.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `roombook`
--

DROP TABLE IF EXISTS `roombook`;
CREATE TABLE IF NOT EXISTS `roombook` (
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `totalroombook` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roombook`
--

INSERT INTO `roombook` (`booking_id`, `room_id`, `totalroombook`, `id`) VALUES
(17, 5, 1, 17),
(18, 6, 2, 18),
(19, 5, 1, 19),
(20, 5, 1, 20),
(21, 5, 1, 21),
(22, 6, 1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
