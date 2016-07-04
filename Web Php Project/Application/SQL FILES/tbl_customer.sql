-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2016 at 04:35 PM
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
-- Table structure for table `tbl_customer`
--

CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `custId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `custName` varchar(30) DEFAULT NULL,
  `custSurname` varchar(30) DEFAULT NULL,
  `custEmail` varchar(30) DEFAULT NULL,
  `custPassword` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`custId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`custId`, `custName`, `custSurname`, `custEmail`, `custPassword`) VALUES
(1, 'Sarina', 'Till', 'sarinatill@vc.co.za', '46b7e6d3287356c1777cdc382240b5ec'),
(2, 'Maggaret', 'Thomas', 'maggaretthomas56@gmail.com', '2811de7aaf9aafda9f071b23e99f08d7'),
(3, 'Mtho', 'Kobone', 'romeo89@gmail.com', '05bcc6f1b7a0a4a8b6620f26f1dfd581'),
(4, 'Rajesh', 'Chanderman', 'rajchanderman00@gmail.com', 'd14dad027e25674e03ec4a4a75e41265'),
(5, 'Andrea', 'Mesarits', 'andmesaritis34@gmail.com', '91eb0cbb6340e71f7f53e8e4d3711282'),
(6, 'Deniel', 'Lalla', 'danellalal90@gmail.com', '5dd33113949c5967ed272f732a107809'),
(7, 'Mishantha', 'Sewpersad', 'mishsewpersad76@gmail.com', 'f11b9607cb830fb10cc920c33f8c5a83'),
(8, 'Kate', 'Smith', 'smithkate77@yahoo.com', '83b18799048a8ccbc73198441c9814c4'),
(9, 'Warren', 'Eddy', 'eddywarren12@yahoo.com', '025093e2d19d376a40f4289987f09e2b'),
(10, 'Calvin', 'Reed', 'calreed11@yahoo.com', '56ec8b22cf384746c7aec101479a7204'),
(11, 'Lunga', 'Steve', 'stevelunga99@yahoo.com', '1ccaf8dd4d1aa18dfd314074447eb2c9'),
(12, 'Loyiso', 'Kabana', 'loyisokab67@yahoo.com', 'fc6f1949a603092dd2b503cca4c9c6ee'),
(13, 'Cameron', 'Maduray', 'cameronmaduray34@yahoo.com', '4cfebfcd70f755d349a1474c9555df66'),
(14, 'Sanele', 'Luyanda', 'sanele700@yahoo.com', '241352b6497f7cf1da29ebd7ca7d5842'),
(15, 'Sachin', 'Naidoo', 'sach45@yahoo.com', '39934d52fa86c23e81169e3b9ade3939'),
(16, 'Nikil', 'Naidu', 'nik3636@yahoo.com', 'cbad7872ee0054e4181f9dd5451a8331'),
(17, 'Priyen', 'Rajbansi', 'priyenraj14@yahoo.com', '762e298ed24cc8d9ed409119b367f21d'),
(18, 'Mathew', 'Hutchinson', 'hutchMat39@yahoo.com', 'd81411480ba040c3ab35fd8e35b46c3a'),
(19, 'Mathew', 'Harmsworth', 'matHarms@yahoo.com', '3d8cbddd4719cc61efa806ac8741dc67'),
(20, 'Sivewe', 'Ndlovu', 'sivNdlovu456@yahoo.com', '5c21faa341df34f386cc9e3eb6182099'),
(21, 'Derek', 'Bestel', 'derkbestel@yahoo.com', '18d6c2b4c0ba6739dd356a91376031c9'),
(22, 'Anthony', 'Smith', 'antsmith765@yahoo.com', 'a83eb2a7ca659f39dfd0f8a0e7096241'),
(23, 'Nik', 'Grey', 'nikgrey87@yahoo.com', '3b9a99c07f2bc64da9d2c4bfe5f28a26'),
(24, 'Ian', 'Singh', 'iansingh877@yahoo.com', '9ef864de201b925d6a4fd926b2fd6342'),
(25, 'Mandla', 'Impelo', 'mandlaimp07@yahoo.com', '749efb0206975fdaf02123153b4a5a38'),
(26, 'Sohail', 'Khan', 'sohailkhan89@yahoo.com', '8ad28748e09a45137aec12dc8eb03372'),
(27, 'Vasu', 'Chetty', 'vasuchetty98@yahoo.com', '6f312814e569301fe3d62cbcec1d2ae4'),
(28, 'Dona', 'Smith', 'smithdona23@yahoo.com', '02b228af44d663595b716419f8b0d6e3'),
(29, 'Samantha', 'Smith', 'smithsam100@yahoo.com', 'c48a0ab717369ec6352a4d19ebd20b38'),
(30, 'Duran', 'Moodley', 'duranmoodley97@gmail.com', '0786634635ea2948b422bfda7308faed'),
(31, 'Duran', 'Moodley', 'duranmoodley77@gmail.com', '79cfeb94595de33b3326c06ab1c7dbda'),
(32, 'Josh', 'Smith', 'josh89@gmail.com', 'fb48572ac68763ca7e1e672923ffd4e4'),
(33, 'Dan', 'Singh', 'sing77@gmail.com', '19fea57eb5c137ac85c046b2671f7b9d'),
(34, 'Sam', 'Jones', 'sarinatill@vc.co.za', '46b7e6d3287356c1777cdc382240b5ec'),
(35, 'Dave', 'Jones', 'dave@gmail.com', 'ad304601e6638bf2bcdd5345c013a6c1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
