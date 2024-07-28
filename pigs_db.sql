-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2017 at 03:35 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pigs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `farmers_tbl`
--

CREATE TABLE `farmers_tbl` (
  `farmer_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `mobile_no` text NOT NULL,
  `password` varchar(50) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmers_tbl`
--

INSERT INTO `farmers_tbl` (`farmer_id`, `first_name`, `last_name`, `mobile_no`, `password`, `admin_id`) VALUES
(2, 'John', 'Doe', '0722123456', '81dc9bdb52d04dc20036dbd8313ed055', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feeds_consumption_tbl`
--

CREATE TABLE `feeds_consumption_tbl` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_consumed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shed_no` int(11) NOT NULL,
  `code` text NOT NULL,
  `farmer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feeds_purchase_tbl`
--

CREATE TABLE `feeds_purchase_tbl` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `receipt_no` varchar(100) NOT NULL,
  `quantity` double NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cost` double NOT NULL,
  `farmer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feeds_tbl`
--

CREATE TABLE `feeds_tbl` (
  `code` varchar(100) NOT NULL,
  `feeds_type` text NOT NULL,
  `particular` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pigs_tbl`
--

CREATE TABLE `pigs_tbl` (
  `pig_id` int(11) NOT NULL,
  `pig_weight` int(11) NOT NULL,
  `pig_dob` date NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `shed_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `farmers_tbl`
--
ALTER TABLE `farmers_tbl`
  ADD PRIMARY KEY (`farmer_id`);

--
-- Indexes for table `feeds_consumption_tbl`
--
ALTER TABLE `feeds_consumption_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feeds_purchase_tbl`
--
ALTER TABLE `feeds_purchase_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feeds_tbl`
--
ALTER TABLE `feeds_tbl`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `pigs_tbl`
--
ALTER TABLE `pigs_tbl`
  ADD PRIMARY KEY (`pig_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `farmers_tbl`
--
ALTER TABLE `farmers_tbl`
  MODIFY `farmer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `feeds_consumption_tbl`
--
ALTER TABLE `feeds_consumption_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feeds_purchase_tbl`
--
ALTER TABLE `feeds_purchase_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pigs_tbl`
--
ALTER TABLE `pigs_tbl`
  MODIFY `pig_id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
