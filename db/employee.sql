-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2019 at 06:05 PM
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
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(10) NOT NULL,
  `emp_ecod` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `technologies_id` varchar(100) NOT NULL,
  `designation_id` int(20) NOT NULL,
  `assign_emp_id` varchar(100) DEFAULT NULL,
  `emp_gardian` varchar(100) NOT NULL,
  `emp_gender` varchar(100) NOT NULL,
  `emp_dob` date NOT NULL,
  `emp_joindate` date NOT NULL,
  `emp_presentadd` text NOT NULL,
  `emp_permanentadd` text NOT NULL,
  `emp_company_email` varchar(100) NOT NULL,
  `emp_company_ph` varchar(100) NOT NULL,
  `emp_personal_email` varchar(100) NOT NULL,
  `emp_personal_ph` varchar(100) NOT NULL,
  `emp_maritalstatus` varchar(100) NOT NULL,
  `emp_panno` varchar(100) NOT NULL,
  `emp_licence` varchar(100) NOT NULL,
  `emp_adhar` varchar(100) NOT NULL,
  `emp_passport` varchar(100) NOT NULL,
  `emp_bloodgroup` varchar(50) NOT NULL,
  `emp_bankacc` varchar(100) NOT NULL,
  `emp_nomineenum` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `emp_login_status` int(11) NOT NULL DEFAULT 0,
  `emp_profile_attachment` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `change_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_ecod`, `username`, `password`, `emp_name`, `technologies_id`, `designation_id`, `assign_emp_id`, `emp_gardian`, `emp_gender`, `emp_dob`, `emp_joindate`, `emp_presentadd`, `emp_permanentadd`, `emp_company_email`, `emp_company_ph`, `emp_personal_email`, `emp_personal_ph`, `emp_maritalstatus`, `emp_panno`, `emp_licence`, `emp_adhar`, `emp_passport`, `emp_bloodgroup`, `emp_bankacc`, `emp_nomineenum`, `status`, `emp_login_status`, `emp_profile_attachment`, `change_date`) VALUES
(1, 'SRK1', 'gautam', 'gomzeel', 'Gautam', '4', 14, NULL, 'Himmatbhai', 'Male', '1994-10-16', '2017-02-04', 'Nand park society, near bhavani circle , Surat', 'Nand park society, near bhavani circle , Surat', 'srkasy@gmail.com', '8745236912', 'gautam.vanani@srkays.com', '9747483647', 'single', '632589', '53696698', '25874125', '896523', '0', '58963258147', '2147483647', 1, 0, '', '2017-02-14 10:02:32'),
(2, 'DRC1', 'zeel', 'zeelmavani', 'Zeel Mavani', '1', 10, '4,6', 'Kanaiyalal', 'Female', '1995-06-20', '2017-01-04', '148-B, Laxmikant society, Kamrej', '148-B, Laxmikant society, Kamrej', 'drcinfotech@gmail.com', '9147483647', 'zeel.mavani@drcinfotech.com', '9714748364', 'single', '369852147', '123654', '2589631', '254136', '0', '555', '2147483647', 0, 0, 'Koala.jpg', '2017-02-13 11:02:41'),
(3, 'DRC2', 'pinkal', 'pinkal', 'Pinkal Devani', '1', 15, NULL, 'Ghanshyambhai', 'Female', '1970-01-01', '2016-07-05', 'Santoshi society, Surat', 'Santoshi society, Surat', 'drcinfotech@gmail.com', '4748364765', 'pinkal.beladiya@drcinfotech.com', '8147483647', 'single', '', '', '', '', '', '', '2147483647', 1, 0, '', '2017-02-13 10:02:43'),
(4, 'DRC3', 'jignasa', 'jignasarg', 'Jignasa', '1', 10, '', 'Rameshbhai', 'Female', '1992-08-08', '2017-01-07', 'surat', 'surat', 'drcinfotech@gmail.com', '5247483647', 'jignasa@gmail.com', '8547483647', 'married', '', '', '', '', '0', '', '2147483647', 1, 0, '', '2017-02-13 10:02:20'),
(5, 'DRC4', 'aesha', 'aesha', 'Aesha', '1', 10, '2', 'Aesha', 'Female', '2016-10-03', '2018-02-22', 'Kamrej', 'Kamrej', 'drcinfotech@gmail.com', '8952367893', 'asha@yahoo.in', '6985267893', 'single', '', '', '', '', '0', '6985231478', '2147483647', 4, 0, '', '2017-02-13 10:02:20'),
(6, 'DRC5', 'ghanshyam', 'ghanshyam', 'Ghanshyam', '1,2', 31, NULL, 'Rajubhai', 'Male', '1991-05-01', '2017-02-04', 'Surat', 'Surat', 'drcinfotech@gmail.com', '9875236418', 'ghanshyam@drcinfotech.com', '9875286314', 'single', '', '', '', '', '0', '', '9853621475', 4, 0, '', '2017-02-13 10:02:21'),
(7, 'DRC6', 'dhirendra', 'dhirendra', 'Dhirendrabhai', '1,2', 29, NULL, 'Hirenbhai', 'Male', '1970-01-01', '2006-07-04', 'surat', 'surat', 'drcinfotech@gmail.com', '81234567893', 'dhirendra@gmail.com', '98234567893', 'married', '', '', '', '', '', '', '21474836475', 1, 0, '', '2017-02-13 10:02:21'),
(8, 'E0012', 'kishanvk', 'kk@123', 'Kishan V Kachhadiya', '2', 14, '2,4', 'kishan kachhadiya', 'Male', '1970-01-01', '1970-01-01', 'Kamrej', 'kamrej', 'kishanvk@drcinfotech.com', '123546', 'kishan@yahoo.in', '123546', 'married', '11111', '22222', '3333', '44444', '0', '555553', '666666', 1, 0, '', '2017-02-13 10:02:31'),
(9, 'DRC0011', 'mayanak', 'mayanak@123', 'mayank Challavala', '1', 10, '3,6', 'mayanak', 'Male', '1970-01-01', '1970-01-01', 'Amroli', 'Amroli', 'mayank@drcinfotech.com', '123546891', 'mayank@yahoo.com', '235436', 'single', '2136', '5156', '', '', '2', '251', '545646', 4, 0, '', '2017-02-14 10:02:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
