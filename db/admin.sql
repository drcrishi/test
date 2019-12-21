-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2019 at 05:59 PM
-- Server version: 10.3.18-MariaDB-0+deb10u1
-- PHP Version: 7.2.25-1+0~20191128.32+debian10~1.gbp108445

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prod_hireamover_crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_firstname` varchar(50) DEFAULT NULL,
  `admin_lastname` varchar(50) DEFAULT NULL,
  `userprofile` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `admin_firstname`, `admin_lastname`, `userprofile`, `is_deleted`) VALUES
(1, 'brett@hireamover.com.au', '9c9cd8126fcc4cd1669b1b0476a85622', 'Brett', 'Epstein', '34d8ec2cc0f5847648734d428bafdbc8.jpeg', 0),
(2, 'admin@drcinfotech.com', 'dfcf06d54bdec1dc6cddfa3f4ba798d6', 'Darshak', 'Shah', '', 0),
(4, 'zeel.mavani@drcinfotech.com', '4c6a26fbeb797bc34dca1e359aec43e7', 'Zeel', 'Mavani', 'b7bf5f1779d744dc844d0123d4dd595e.jpg', 1),
(5, 'info@hireamover.com.au', '4db63cb2f0bde8c4a2582b0e66fe4c7a', 'Jen', 'Carmody', 'd1c90c8aa8d68c2cf7674dc76d278e25.png', 0),
(6, 'hireamover51@gmail.com', '88c8faeffc4c4d66b30bec40ea8807a5', 'Stephanie ', 'Ogrizek', '', 0),
(7, 'darshak.shah@drcinfotech.com', '391627826bd5b826c614e6cf85fc5ea8', 'Darshak', 'Shah', '', 1),
(8, 'kishanvk@drcinfotech.com', 'b1634c02812896b87fff3d56f89e36af', 'Kishan', 'Patel', '', 1),
(9, 'hireamover52@gmail.com', 'f8d73884b97101498357dacac27436da', 'Joanna', 'Rogers', '', 0),
(10, 'matthew.lear@cast-control.net', '361fb081e4c9e18d143b9b201d0826a3', 'Matt', 'Cast', '', 0),
(11, 'emelenelongfield@gmail.com', 'b24585078df6e6a784e1e97171641066', 'Emma', 'Longfield', '', 1),
(12, 'justinehireamover@gmail.com', 'dbbbe5ec85c42b4ec7d81744a8f367df', 'Justine', 'Orford', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
