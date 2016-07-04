-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2016 at 04:36 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE IF NOT EXISTS `tbl_item` (
  `itemId` varchar(50) NOT NULL DEFAULT '',
  `Description` varchar(50) DEFAULT NULL,
  `CostPrice` decimal(15,2) DEFAULT NULL,
  `Quantity` decimal(10,0) DEFAULT NULL,
  `SellPrice` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`itemId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`itemId`, `Description`, `CostPrice`, `Quantity`, `SellPrice`) VALUES
('1001', 'Cell Phone cover', '50.00', '20', '120.00'),
('1002', 'Laptop Bag', '200.00', '30', '300.00'),
('1003', '20 gb flash drive that can plug into any device', '100.00', '200', '120.00'),
('1004', 'Php Coding Book', '1000.00', '50', '2000.00'),
('1005', 'Flat screen tv with usb connection ports', '15000.00', '20', '3000.00'),
('1006', 'Android Beginners guide ', '3000.00', '10', '4000.00'),
('1007', 'CD cover that can contain about 100 cds ', '200.00', '100', '220.00'),
('1008', 'Casio Calculator ', '100.00', '20', '200.00'),
('1009', 'reading glasses case, keep your reading glass safe', '30.00', '20', '50.00'),
('1010', 'High powered Fan that can cool you down on a hot d', '200.00', '10', '300.00'),
('1011', 'Sunglasses that can give you a nice look ', '210.00', '10', '220.00'),
('1012', 'A watch ', '200.00', '5', '220.00'),
('1013', 'a key chain that can keep your keys together', '50.00', '6', '75.00'),
('1014', 'Scarf that can keep you warm', '60.00', '5', '100.00'),
('1015', 'A strong wooden table ', '150.00', '100', '200.00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
