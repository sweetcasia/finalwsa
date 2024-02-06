-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2024 at 02:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appoint`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appoint`
--

CREATE TABLE `tbl_appoint` (
  `a_id` int(11) NOT NULL,
  `s_id` int(50) NOT NULL,
  `p_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_appoint`
--

INSERT INTO `tbl_appoint` (`a_id`, `s_id`, `p_id`) VALUES
(5, 10, 6),
(6, 13, 6),
(7, 15, 7),
(8, 16, 8),
(9, 15, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient`
--

CREATE TABLE `tbl_patient` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `p_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_patient`
--

INSERT INTO `tbl_patient` (`p_id`, `p_name`, `p_email`) VALUES
(7, 'Sweet', 'sweetvenicecasia@gmail.com'),
(8, 'Edgardo Siton', 'edgardo@gmail.com'),
(9, 'aeron', 'aeron@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `s_id` int(11) NOT NULL,
  `s_date` date NOT NULL,
  `s_status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`s_id`, `s_date`, `s_status`) VALUES
(10, '2024-01-25', 'Pending'),
(13, '2024-01-04', 'Pending'),
(15, '2024-01-24', 'Pending'),
(16, '2024-01-16', 'Pending'),
(17, '2024-01-15', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_appoint`
--
ALTER TABLE `tbl_appoint`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `tbl_appoint_ibfk_1` (`p_id`),
  ADD KEY `tbl_appoint_ibfk_2` (`s_id`);

--
-- Indexes for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_appoint`
--
ALTER TABLE `tbl_appoint`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_appoint`
--
ALTER TABLE `tbl_appoint`
  ADD CONSTRAINT `tbl_appoint_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `tbl_patient` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_appoint_ibfk_2` FOREIGN KEY (`s_id`) REFERENCES `tbl_schedule` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
