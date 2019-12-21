-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2019 at 06:07 PM
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
-- Table structure for table `template_master`
--

CREATE TABLE `template_master` (
  `template_master_id` int(11) NOT NULL,
  `template_master_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_master`
--

INSERT INTO `template_master` (`template_master_id`, `template_master_name`) VALUES
(1, 'Quote'),
(2, 'Reminder'),
(3, 'Followup'),
(4, 'JobSheet'),
(5, 'BookingConfirmation'),
(6, 'SendFeedback'),
(7, 'SendReminder'),
(8, 'RemovalistJobSheet'),
(9, 'NoAnswerFeedback'),
(10, 'sendInvoice'),
(11, 'FollowupQuoteReminders'),
(12, 'StoragePaymentReminder'),
(13, 'StorageAgreementReminder'),
(14, 'Sms');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `template_master`
--
ALTER TABLE `template_master`
  ADD PRIMARY KEY (`template_master_id`),
  ADD KEY `template_master_id` (`template_master_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `template_master`
--
ALTER TABLE `template_master`
  MODIFY `template_master_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
