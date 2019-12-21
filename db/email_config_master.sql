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
-- Table structure for table `email_config_master`
--

CREATE TABLE `email_config_master` (
  `email_config_master_id` int(11) NOT NULL,
  `smtp_user` varchar(200) NOT NULL,
  `smtp_pass` varchar(200) NOT NULL,
  `jobtype` int(11) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_config_master`
--

INSERT INTO `email_config_master` (`email_config_master_id`, `smtp_user`, `smtp_pass`, `jobtype`, `is_deleted`) VALUES
(1, 'info@luxepackers.com.au', 'Packers1369', 3, 1),
(2, 'info@hireamover.com.au', 'DN734QJyJHbdnsdLiCaeS6Mz97in', 1, 0),
(3, 'info@hireapacker.com.au', 'Zaf11323', 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_config_master`
--
ALTER TABLE `email_config_master`
  ADD PRIMARY KEY (`email_config_master_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_config_master`
--
ALTER TABLE `email_config_master`
  MODIFY `email_config_master_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
