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
-- Table structure for table `email_config`
--

CREATE TABLE `email_config` (
  `emailconf_id` int(11) NOT NULL,
  `protocol` varchar(8) NOT NULL,
  `smtp_port` int(11) NOT NULL,
  `smtp_user` varchar(23) NOT NULL,
  `smtp_pass` varchar(50) NOT NULL,
  `smtp_host` varchar(18) NOT NULL,
  `jobtype` int(11) NOT NULL,
  `change_date` varchar(19) NOT NULL,
  `emailtype` varchar(20) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_config`
--

INSERT INTO `email_config` (`emailconf_id`, `protocol`, `smtp_port`, `smtp_user`, `smtp_pass`, `smtp_host`, `jobtype`, `change_date`, `emailtype`, `is_deleted`) VALUES
(1, 'smtp', 587, 'info@luxepackers.com.au', 'Packers1369', 'smtp.office365.com', 3, '2018-11-21 14:47:09', 'QuoteLP', 1),
(2, 'smtp', 587, 'info@luxepackers.com.au', 'Packers1369', 'smtp.office365.com', 3, '2018-11-30 16:35:30', 'JobSheetLP', 1),
(3, 'smtp', 587, 'info@hireamover.com.au', 'DN734QJyJHbdnsdLiCaeS6Mz97in', 'smtp.office365.com', 1, '2018-12-28 15:22:19', 'QuoteR', 0),
(4, 'smtp', 587, 'info@hireapacker.com.au', 'Zaf11323', 'smtp.office365.com', 2, '2018-12-28 15:34:55', 'QuoteP', 0),
(5, 'smtp', 587, 'info@hireamover.com.au', 'DN734QJyJHbdnsdLiCaeS6Mz97in', 'smtp.office365.com', 1, '2018-12-28 15:35:30', 'FollowupR', 0),
(6, 'smtp', 587, 'info@hireapacker.com.au', 'Zaf11323', 'smtp.office365.com', 2, '2018-12-28 15:35:40', 'FollowupP', 0),
(7, 'smtp', 587, 'info@hireamover.com.au', 'DN734QJyJHbdnsdLiCaeS6Mz97in', 'smtp.office365.com', 1, '2018-12-28 15:36:00', 'JobSheetR', 0),
(8, 'smtp', 587, 'info@hireapacker.com.au', 'Zaf11323', 'smtp.office365.com', 2, '2018-12-28 15:36:41', 'JobSheetP', 0),
(9, 'smtp', 587, 'info@hireamover.com.au', 'DN734QJyJHbdnsdLiCaeS6Mz97in', 'smtp.office365.com', 1, '2018-12-28 15:38:02', 'BookingConfirmationR', 0),
(10, 'smtp', 587, 'info@hireapacker.com.au', 'Zaf11323', 'smtp.office365.com', 2, '2018-12-28 15:38:10', 'BookingConfirmationP', 0),
(11, 'smtp', 587, 'info@hireamover.com.au', 'DN734QJyJHbdnsdLiCaeS6Mz97in', 'smtp.office365.com', 1, '2018-12-28 15:38:20', 'SendFeedbackR', 0),
(12, 'smtp', 587, 'info@hireapacker.com.au', 'Zaf11323', 'smtp.office365.com', 2, '2018-12-28 15:38:43', 'SendReminderP', 0),
(13, 'smtp', 587, 'info@hireapacker.com.au', 'Zaf11323', 'smtp.office365.com', 2, '2018-12-28 15:39:59', 'SendFeedbackP', 0),
(14, 'smtp', 587, 'info@hireamover.com.au', 'DN734QJyJHbdnsdLiCaeS6Mz97in', 'smtp.office365.com', 1, '2018-12-28 15:40:08', 'SendReminderR', 0),
(15, 'smtp', 587, 'info@hireamover.com.au', 'DN734QJyJHbdnsdLiCaeS6Mz97in', 'smtp.office365.com', 1, '2018-12-28 15:41:24', 'InvoiceR', 0),
(16, 'smtp', 587, 'info@hireapacker.com.au', 'Zaf11323', 'smtp.office365.com', 2, '2018-12-28 15:41:34', 'InvoiceP', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_config`
--
ALTER TABLE `email_config`
  ADD PRIMARY KEY (`emailconf_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_config`
--
ALTER TABLE `email_config`
  MODIFY `emailconf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
