-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2019 at 06:06 PM
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
-- Table structure for table `move_type`
--

CREATE TABLE `move_type` (
  `movetype_id` int(11) NOT NULL,
  `movetype_name` varchar(50) DEFAULT NULL,
  `is_disabled` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `move_type`
--

INSERT INTO `move_type` (`movetype_id`, `movetype_name`, `is_disabled`) VALUES
(1, 'Home', 0),
(2, 'Office', 0),
(3, 'Interstate', 1),
(4, 'Packing', 0),
(5, 'Unpacking', 0),
(6, 'Storage', 0),
(7, 'Luxe Packing', 1),
(8, 'Luxe Unpacking', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `move_type`
--
ALTER TABLE `move_type`
  ADD PRIMARY KEY (`movetype_id`),
  ADD KEY `movetype_id` (`movetype_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `move_type`
--
ALTER TABLE `move_type`
  MODIFY `movetype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
