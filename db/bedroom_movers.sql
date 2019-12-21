-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2019 at 06:00 PM
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
-- Table structure for table `bedroom_movers`
--

CREATE TABLE `bedroom_movers` (
  `bm_id` int(11) NOT NULL,
  `bm_no_of_bedrooms` int(11) NOT NULL,
  `bm_no_of_desks` int(11) NOT NULL,
  `bm_no_of_movers` int(11) NOT NULL,
  `sign` varchar(3) NOT NULL,
  `bm_status` int(11) NOT NULL DEFAULT 1 COMMENT '0- inactive, 1- active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bedroom_movers`
--

INSERT INTO `bedroom_movers` (`bm_id`, `bm_no_of_bedrooms`, `bm_no_of_desks`, `bm_no_of_movers`, `sign`, `bm_status`) VALUES
(11, 3, 0, 3, '>=', 1),
(10, 0, 1, 3, '>=', 1),
(9, 2, 0, 2, '<=', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bedroom_movers`
--
ALTER TABLE `bedroom_movers`
  ADD PRIMARY KEY (`bm_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bedroom_movers`
--
ALTER TABLE `bedroom_movers`
  MODIFY `bm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
