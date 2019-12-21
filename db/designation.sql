-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2019 at 06:03 PM
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
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_id` int(20) NOT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `des_current_time` datetime DEFAULT NULL,
  `change_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation`, `status`, `des_current_time`, `change_date`) VALUES
(10, 'Team leader', 1, '2017-01-11 17:03:17', NULL),
(13, 'Employee', 1, '2017-01-12 14:33:31', NULL),
(14, 'Manager', 1, '2017-01-12 14:33:41', NULL),
(15, 'Senior Developer', 1, '2017-01-12 14:33:49', NULL),
(29, 'Senior manager', 1, '2017-01-23 11:18:37', NULL),
(30, 'Tester', 1, '2017-01-23 11:22:49', NULL),
(31, 'Designer', 1, '2017-01-23 11:23:45', NULL),
(32, 'Senior manager', 1, '2017-01-23 12:44:10', NULL),
(33, 'test', 4, '2017-01-23 13:38:43', NULL),
(34, 'tt', 4, '2017-02-14 14:36:59', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
