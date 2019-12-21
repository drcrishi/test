-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2019 at 06:02 PM
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
-- Table structure for table `cronjob_mails`
--

CREATE TABLE `cronjob_mails` (
  `cronjob_mails_id` int(11) NOT NULL,
  `enquiry_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `is_email_sent` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 - not sent, 1 - sent',
  `created_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cronjob_mails`
--

INSERT INTO `cronjob_mails` (`cronjob_mails_id`, `enquiry_id`, `contact_id`, `contact_email`, `is_email_sent`, `created_date`) VALUES
(2, 54638, 16793, 'movingmatesmelbourne@gmail.com', 1, '2019-11-25 09:25:39'),
(3, 54660, 784, 'murfetremovals@gmail.com', 1, '2019-11-25 15:58:41'),
(4, 54260, 0, '', 0, '2019-11-26 08:29:47'),
(6, 54689, 0, '', 1, '2019-11-27 09:06:22'),
(7, 54724, 0, '', 1, '2019-11-27 13:17:23'),
(8, 54658, 1179, 'info@brillianceremovalistsmelbourne.com.au', 1, '2019-11-28 08:36:28'),
(10, 54604, 15158, 'contact@primetransportgroup.com.au', 0, '2019-11-29 12:03:23'),
(11, 54775, 1179, 'info@brillianceremovalistsmelbourne.com.au', 1, '2019-11-29 12:10:48'),
(12, 54794, 949, 'fastmovers@fastmovers.com.au', 1, '2019-12-02 10:39:24'),
(13, 54875, 1376, 'macri31@hotmail.com', 1, '2019-12-02 16:37:59'),
(14, 54848, 949, 'fastmovers@fastmovers.com.au', 1, '2019-12-03 14:00:28'),
(15, 54186, 15482, 'contract01@goldlineremovals.com.au', 1, '2019-12-03 15:50:09'),
(16, 54373, 784, 'murfetremovals@gmail.com', 1, '2019-12-03 16:00:30'),
(17, 55019, 4847, 'lupaustralia@hotmail.com', 1, '2019-12-06 18:05:10'),
(18, 54976, 0, '', 1, '2019-12-10 15:45:05'),
(19, 54318, 3265, 'info@firstmovetransport.com.au', 1, '2019-12-11 09:55:06'),
(20, 55104, 4503, 'info@brillianceremovalistsmelbourne.com.au', 1, '2019-12-13 10:08:47'),
(21, 55215, 16219, 'bruno@bacremovals.com', 1, '2019-12-13 20:25:36'),
(22, 54754, 14743, 'br.mascarenhas@gmail.com', 0, '2019-12-16 10:58:45'),
(23, 54995, 949, 'fastmovers@fastmovers.com.au', 1, '2019-12-16 12:29:51'),
(24, 55274, 0, '', 1, '2019-12-16 14:35:34'),
(25, 54943, 15482, 'contract01@goldlineremovals.com.au', 1, '2019-12-18 14:03:40'),
(26, 55006, 1376, 'macri31@hotmail.com', 1, '2019-12-21 11:29:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cronjob_mails`
--
ALTER TABLE `cronjob_mails`
  ADD PRIMARY KEY (`cronjob_mails_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cronjob_mails`
--
ALTER TABLE `cronjob_mails`
  MODIFY `cronjob_mails_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
