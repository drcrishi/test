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
-- Table structure for table `peoples`
--

CREATE TABLE `peoples` (
  `people_id` int(11) NOT NULL,
  `people_name` varchar(50) DEFAULT NULL,
  `people_phone` text DEFAULT NULL COMMENT 'multiphone numbers',
  `people_email` text DEFAULT NULL COMMENT 'multi email address',
  `organization_id` int(11) DEFAULT NULL COMMENT '#reff to organization table organization_id',
  `owner_id` int(11) DEFAULT NULL COMMENT '#reff to employee table emp_id',
  `people_visiable_to` int(11) DEFAULT NULL COMMENT '0=>entire compnay 1=> owner & followers',
  `created_by` int(11) DEFAULT NULL COMMENT '#reff to employee table  emp_id',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=>not deleted 1=>deleted',
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=>yes 0=>no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `peoples`
--
ALTER TABLE `peoples`
  ADD PRIMARY KEY (`people_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peoples`
--
ALTER TABLE `peoples`
  MODIFY `people_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
