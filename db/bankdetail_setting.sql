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
-- Table structure for table `bankdetail_setting`
--

CREATE TABLE `bankdetail_setting` (
  `bankdetail_setting_id` int(11) NOT NULL,
  `company_address` varchar(300) NOT NULL,
  `bank_detail` varchar(300) NOT NULL,
  `gst` double(10,2) NOT NULL,
  `company_no` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bankdetail_setting`
--

INSERT INTO `bankdetail_setting` (`bankdetail_setting_id`, `company_address`, `bank_detail`, `gst`, `company_no`) VALUES
(1, 'Hire A Mover Pty Ltd, 1/34 James Craig Road, Rozelle NSW 2039', 'Hire A Mover, BSB 332051, Account No. 553988696', 10.00, '82 163 150 749'),
(3, '', '', 0.00, ''),
(4, '', '', 0.00, ''),
(5, '', '', 0.00, ''),
(6, '', '', 0.00, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bankdetail_setting`
--
ALTER TABLE `bankdetail_setting`
  ADD PRIMARY KEY (`bankdetail_setting_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bankdetail_setting`
--
ALTER TABLE `bankdetail_setting`
  MODIFY `bankdetail_setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
