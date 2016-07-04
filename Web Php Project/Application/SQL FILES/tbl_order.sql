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
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `orderId` varchar(100) NOT NULL DEFAULT '',
  `itemId` varchar(50) NOT NULL DEFAULT '',
  `custId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`orderId`,`itemId`,`custId`),
  KEY `itemId` (`itemId`),
  KEY `custId` (`custId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`orderId`, `itemId`, `custId`) VALUES
('255i6d4aseu2cg39eq5ra16is0', '1003', 1),
('255i6d4aseu2cg39eq5ra16is0', '1004', 1),
('255i6d4aseu2cg39eq5ra16is0', '1005', 1),
('4n937faj7ef8ht49e2a3246jv2', '1004', 1),
('4n937faj7ef8ht49e2a3246jv2', '1005', 1),
('4n937faj7ef8ht49e2a3246jv2', '1007', 1),
('4n937faj7ef8ht49e2a3246jv2', '1010', 1),
('4n937faj7ef8ht49e2a3246jv2', '1012', 1),
('a8889b97ue29tmsfe4jhsp3f80', '1010', 1),
('fojookk985jnpdvrc4m47q6dh6', '1004', 1),
('fojookk985jnpdvrc4m47q6dh6', '1006', 1),
('ivv1bn4rdis5b0e365tgcjjn01', '1003', 1),
('ivv1bn4rdis5b0e365tgcjjn01', '1004', 1),
('ivv1bn4rdis5b0e365tgcjjn01', '1006', 1),
('ivv1bn4rdis5b0e365tgcjjn01', '1009', 1),
('q5oum64vi9491rv4gh4imt4mk1', '1003', 1),
('vhfffl2sf8rn80g21m90lu69q0', '1003', 1),
('4n937faj7ef8ht49e2a3246jv2', '1007', 31),
('4n937faj7ef8ht49e2a3246jv2', '1009', 31),
('a8889b97ue29tmsfe4jhsp3f80', '1005', 32),
('a8889b97ue29tmsfe4jhsp3f80', '1011', 32),
('a8889b97ue29tmsfe4jhsp3f80', '1012', 32),
('a8889b97ue29tmsfe4jhsp3f80', '1014', 32),
('a8889b97ue29tmsfe4jhsp3f80', '1015', 32),
('a8889b97ue29tmsfe4jhsp3f80', '1003', 33),
('a8889b97ue29tmsfe4jhsp3f80', '1004', 33),
('a8889b97ue29tmsfe4jhsp3f80', '1005', 33),
('a8889b97ue29tmsfe4jhsp3f80', '1006', 33),
('a8889b97ue29tmsfe4jhsp3f80', '1010', 33),
('a8889b97ue29tmsfe4jhsp3f80', '1013', 33),
('a8889b97ue29tmsfe4jhsp3f80', '1015', 33),
('60crv17ecije7k3qksifvf9s97', '1001', 35),
('60crv17ecije7k3qksifvf9s97', '1002', 35),
('60crv17ecije7k3qksifvf9s97', '1003', 35),
('odt19poht38m2alrghvoukf187', '1001', 35),
('odt19poht38m2alrghvoukf187', '1003', 35),
('reb2dfhdsrgj0qqdt15m8q6j31', '1001', 35);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`itemId`) REFERENCES `tbl_item` (`itemId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_order_ibfk_2` FOREIGN KEY (`custId`) REFERENCES `tbl_customer` (`custId`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
