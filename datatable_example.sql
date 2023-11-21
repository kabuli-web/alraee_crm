-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 26, 2021 at 05:25 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datatable_example`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `st_id` varchar(128) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `industry` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `st_id`, `username`, `email`, `mobile`, `industry`, `comment`) VALUES
(7, 'pen', 'pki-validation', 'user@gmail.com', '8887919632', 'Lucknow', 'how are you'),
(8, 'pen', 'pki-validation', 'user@gmail.com', '8887919632', 'Lucknow', 'how are you'),
(9, 'pen', 'Rajs', 'user@gmail.com', '8887919632', 'Lucknow', 'how are you'),
(10, 'pen', 'Amrendra', 'user@gmail.com', '434334', 'Lucknow', 'how are you'),
(11, 'pen', 'Bahubalis', 'user@gmail.com', '434334', 'Lucknow', 'how are you'),
(12, 'pen', 'Alok Kumar bisht', 'user@gmail.com', '434334', 'Lucknow', 'how are you'),
(13, 'pen', 'admin', 'admin@gmail.com', '9988999999', 'Lucknow', 'how are you'),
(15, 'pen', 'ninebroadband', 'superadmin@gmail.com', '8127956219', 'Lucknow', 'how are you'),
(16, 'pen', 'index.html', 'superadmin@gmail.com', '8127956219', 'Lucknow', 'how are you'),
(18, 'pen', 'index.html', 'user@gmail.com', '8127956219', 'Lucknow', 'how are you'),
(19, 'pen', 'sfd', 'sfdasf@Gmail.com', 'adsffsaf', 'safdsa', 'how are you'),
(20, 'pen', 'sfd', 'sfdasf@Gmail.com', 'adsffsaf', 'safdsa', 'how are you');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
