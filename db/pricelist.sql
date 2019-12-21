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
-- Table structure for table `pricelist`
--

CREATE TABLE `pricelist` (
  `pricelist_id` int(11) NOT NULL,
  `rule_type` tinyint(4) NOT NULL COMMENT '1- default rules, 2 - custom rules, 3 - holiday rules, 4 - packing rules, 5 - packing holiday rules',
  `movetype` int(11) NOT NULL COMMENT '1-home, 2-office, 4-packing, 5-unpacking',
  `day_from` varchar(10) NOT NULL,
  `day_to` varchar(10) NOT NULL,
  `days_range` varchar(20) NOT NULL,
  `dates` varchar(2048) NOT NULL,
  `no_of_trucks` int(11) NOT NULL,
  `no_of_movers` int(11) NOT NULL,
  `travel_fee` float NOT NULL,
  `client_hour_rate` float NOT NULL,
  `per_person_packing_rate` float NOT NULL,
  `packer_cost_price` float NOT NULL,
  `states` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0- inactive, 1- active',
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pricelist`
--

INSERT INTO `pricelist` (`pricelist_id`, `rule_type`, `movetype`, `day_from`, `day_to`, `days_range`, `dates`, `no_of_trucks`, `no_of_movers`, `travel_fee`, `client_hour_rate`, `per_person_packing_rate`, `packer_cost_price`, `states`, `status`, `priority`) VALUES
(1, 1, 1, '1', '4', '1,2,3,4,', '', 1, 2, 65, 130, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(2, 1, 1, '5', '0', '5,6,0,', '', 1, 2, 70, 140, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(3, 1, 1, '1', '4', '1,2,3,4,', '', 1, 3, 85, 170, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(4, 1, 1, '5', '0', '5,6,0,', '', 1, 3, 90, 180, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(5, 1, 1, '1', '4', '1,2,3,4,', '', 2, 3, 95, 190, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(6, 1, 1, '5', '0', '5,6,0,', '', 2, 3, 100, 200, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(7, 1, 1, '1', '4', '1,2,3,4,', '', 2, 4, 125, 250, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(8, 1, 1, '5', '0', '5,6,0,', '', 2, 4, 135, 270, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(9, 1, 1, '1', '4', '1,2,3,4,', '', 2, 5, 150, 300, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(10, 1, 1, '5', '0', '5,6,0,', '', 2, 5, 160, 320, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(11, 1, 1, '1', '4', '1,2,3,4,', '', 2, 6, 170, 340, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(12, 1, 1, '5', '0', '5,6,0,', '', 2, 6, 180, 360, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(13, 1, 2, '0', '6', '0,1,2,3,4,5,6,', '', 1, 2, 70, 140, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(14, 1, 2, '0', '6', '0,1,2,3,4,5,6,', '', 1, 3, 90, 180, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(15, 1, 2, '0', '6', '0,1,2,3,4,5,6,', '', 2, 3, 100, 200, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(16, 1, 2, '0', '6', '0,1,2,3,4,5,6,', '', 2, 4, 135, 270, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(17, 1, 2, '0', '6', '0,1,2,3,4,5,6,', '', 2, 5, 160, 320, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(18, 1, 2, '0', '6', '0,1,2,3,4,5,6,', '', 2, 6, 180, 360, 0, 0, 'NSW,VIC,QLD,WA,SA', 1, 0),
(19, 2, 1, '0', '0', '0,', '', 1, 2, 80, 160, 0, 0, 'WA', 1, 0),
(20, 2, 1, '0', '0', '0,', '', 1, 3, 100, 200, 0, 0, 'WA', 1, 0),
(21, 2, 1, '0', '0', '0,', '', 2, 3, 120, 240, 0, 0, 'WA', 1, 0),
(22, 2, 1, '0', '0', '0,', '', 2, 4, 160, 320, 0, 0, 'WA', 1, 0),
(23, 2, 1, '0', '0', '0,', '', 2, 5, 180, 360, 0, 0, 'WA', 1, 0),
(24, 2, 1, '0', '0', '0,', '', 2, 6, 200, 400, 0, 0, 'WA', 1, 0),
(25, 4, 4, '0', '6', '0,1,2,3,4,5,6,', '', 0, 0, 0, 0, 60, 32.85, 'NSW,VIC,QLD,WA,SA', 1, 0),
(26, 4, 5, '0', '6', '0,1,2,3,4,5,6,', '', 0, 0, 0, 0, 60, 32.85, 'NSW,VIC,QLD,WA,SA', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pricelist`
--
ALTER TABLE `pricelist`
  ADD PRIMARY KEY (`pricelist_id`),
  ADD KEY `rule_type` (`rule_type`),
  ADD KEY `movetype` (`movetype`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pricelist`
--
ALTER TABLE `pricelist`
  MODIFY `pricelist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
