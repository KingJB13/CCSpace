-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 01:50 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ccspace`
--

-- --------------------------------------------------------

--
-- Table structure for table `ccs_log`
--

CREATE TABLE `ccs_log` (
  `log_id` int(11) NOT NULL,
  `prof_name` varchar(50) DEFAULT NULL,
  `room` varchar(20) DEFAULT NULL,
  `subject` varchar(20) DEFAULT NULL,
  `section` varchar(20) DEFAULT NULL,
  `log_date` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `remarks` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ccs_log`
--

INSERT INTO `ccs_log` (`log_id`, `prof_name`, `room`, `subject`, `section`, `log_date`, `time_start`, `time_end`, `remarks`) VALUES
(2191821, 'Joshua Lawrence Lumba', 'ICT LAB', 'CSS', 'IT 3-B', '2023-12-11', '11:39:58', '11:56:04', 'Present'),
(2639257, 'Justin Bais', 'COM LAB', 'DBMS', 'IT 3-G', '2023-12-12', '11:06:56', '11:07:08', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `ccs_reservation`
--

CREATE TABLE `ccs_reservation` (
  `reservation_id` int(11) NOT NULL,
  `prof_name` varchar(50) DEFAULT NULL,
  `room` varchar(20) DEFAULT NULL,
  `subject` varchar(20) DEFAULT NULL,
  `section` varchar(20) DEFAULT NULL,
  `sched_date` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `reserve_status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ccs_reservation`
--

INSERT INTO `ccs_reservation` (`reservation_id`, `prof_name`, `room`, `subject`, `section`, `sched_date`, `time_start`, `time_end`, `purpose`, `reserve_status`) VALUES
(2192997, 'Nathaniel Mallari', 'CS 101', 'MOBDEV', 'IT 3-J', '2023-12-04', '07:00:00', '10:00:00', 'Group Activity', 'Pending'),
(2409420, 'Justin Bais', 'CS 101', 'WEB DEV', 'IT 3-D', '2023-12-13', '10:00:00', '13:00:00', 'Lab Quiz', 'Rejected'),
(2511762, 'Carla Joy Manapsal', 'COM LAB', 'OOP', 'IT 3-C', '2023-12-08', '20:00:00', '23:00:00', 'Long Quiz', 'Accepted'),
(2630862, 'Justin Bais', 'COM LAB', 'DBMS', 'IT 3-A', '2023-12-14', '16:00:00', '19:00:00', 'Finals Exam', 'Accepted'),
(2979818, 'Karl Brian Mallari', 'ICT LAB', 'IAS', 'IT 3-G', '2023-12-15', '13:00:00', '16:00:00', 'Final Project Presentation', 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `ccs_room`
--

CREATE TABLE `ccs_room` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ccs_room`
--

INSERT INTO `ccs_room` (`room_id`, `room_name`) VALUES
(2413248, 'ICT LAB'),
(2493374, 'CS 101'),
(2586119, 'COM LAB');

-- --------------------------------------------------------

--
-- Table structure for table `ccs_schedule`
--

CREATE TABLE `ccs_schedule` (
  `schedule_id` int(11) NOT NULL,
  `prof_name` varchar(50) DEFAULT NULL,
  `room` varchar(20) DEFAULT NULL,
  `subject` varchar(20) DEFAULT NULL,
  `section` varchar(20) DEFAULT NULL,
  `sched_day` int(11) DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ccs_schedule`
--

INSERT INTO `ccs_schedule` (`schedule_id`, `prof_name`, `room`, `subject`, `section`, `sched_day`, `time_start`, `time_end`) VALUES
(2005079, 'Mariella Macaspac', 'CS 101', 'WEB DEV', 'IT 3-F', 3, '10:00:00', '13:00:00'),
(2008664, 'Nicole Dimacali', 'COM LAB', 'SAD', 'IT 3-E', 3, '13:00:00', '16:00:00'),
(2030881, 'Nicole Dimacali', 'CS 101', 'SAD', 'IT 3-B', 1, '07:00:00', '10:00:00'),
(2052803, 'Joshua Lawrence Lumba', 'COM LAB', 'CSS', 'IT 3-H', 3, '07:00:00', '10:00:00'),
(2057414, 'Mark Joseph Tayag', 'COM LAB', 'NET', 'IT 3-D', 3, '16:00:00', '19:00:00'),
(2074027, 'Mariella Macaspac', 'COM LAB', 'WEB DEV', 'IT 3-I', 2, '16:00:00', '19:00:00'),
(2094591, 'Karl Brian Mallari', 'ICT LAB', 'IAS', 'IT 3-K', 5, '10:00:00', '13:00:00'),
(2104241, 'Carla Joy Manapsal', 'COM LAB', 'OOP', 'IT 3-I', 1, '16:00:00', '19:00:00'),
(2158227, 'Justin Bais', 'ICT LAB', 'DBMS', 'IT 3-F', 3, '07:00:00', '10:00:00'),
(2198334, 'Nicole Dimacali', 'CS 101', 'SAD', 'IT 3-C', 2, '10:00:00', '13:00:00'),
(2207466, 'Justin Bais', 'ICT LAB', 'DBMS', 'IT 3-C', 5, '07:00:00', '10:00:00'),
(2227708, 'Justin Bais', 'COM LAB', 'DBMS', 'IT 3-G', 2, '10:00:00', '13:00:00'),
(2228043, 'Justin Bais', 'ICT LAB', 'DBMS', 'IT 3-K', 6, '07:00:00', '10:00:00'),
(2235440, 'Justin Bais', 'CS 101', 'DBMS', 'IT 3-D', 1, '13:00:00', '16:00:00'),
(2300458, 'Justin Bais', 'COM LAB', 'DBMS', 'IT 3-K', 1, '07:00:00', '10:00:00'),
(2308220, 'Nathaniel Mallari', 'CS 101', 'MOB DEV', 'IT 3-C', 6, '07:00:00', '10:00:00'),
(2310984, 'Mark Joseph Tayag', 'ICT LAB', 'NET', 'IT 3-A', 1, '07:00:00', '10:00:00'),
(2313916, 'Mariella Macaspac', 'ICT LAB', 'WEB DEV', 'IT 3-I', 3, '10:00:00', '13:00:00'),
(2328863, 'Karl Brian Mallari', 'CS 101', 'IAS', 'IT 3-A', 1, '10:00:00', '13:00:00'),
(2362646, 'Nicole Dimacali', 'COM LAB', 'DBMS', 'IT 3-C', 4, '07:00:00', '10:00:00'),
(2411136, 'Joshua Lawrence Lumba', 'ICT LAB', 'CSS', 'IT 3-E', 2, '16:00:00', '19:00:00'),
(2430395, 'Nathaniel Mallari', 'CS 101', 'MOB DEV', 'IT 3-F', 5, '10:00:00', '13:00:00'),
(2444188, 'Nathaniel Mallari', 'CS 101', 'MOB DEV', 'IT 3-E', 2, '13:00:00', '16:00:00'),
(2448581, 'Carla Joy Manapsal', 'COM LAB', 'OOP', 'IT 3-A', 5, '10:00:00', '13:00:00'),
(2488691, 'Karl Brian Mallari', 'COM LAB', 'IAS', 'IT 3-J', 1, '13:00:00', '16:00:00'),
(2577249, 'Joshua Lawrence Lumba', 'COM LAB', 'CSS', 'IT 3-G', 5, '13:00:00', '16:00:00'),
(2596524, 'Mark Joseph Tayag', 'ICT LAB', 'NET', 'IT 3-D', 1, '16:00:00', '19:00:00'),
(2607268, 'Nicole Dimacali', 'ICT LAB', 'SAD', 'IT 3-H', 4, '10:00:00', '13:00:00'),
(2618236, 'Justin Bais', 'ICT LAB', 'DBMS', 'IT 3-G', 2, '07:00:00', '10:00:00'),
(2686789, 'Joshua Lawrence Lumba', 'CS 101', 'CSS', 'IT 3-B', 5, '16:00:00', '19:00:00'),
(2826341, 'Mariella Macaspac', 'COM LAB', 'WEB DEV', 'IT 3-F', 4, '10:00:00', '13:00:00'),
(2880173, 'Joshua Lawrence Lumba', 'CS 101', 'CSS', 'IT 3-G', 4, '07:00:00', '10:00:00'),
(2885973, 'Mark Joseph Tayag', 'CS 101', 'NET', 'IT 3-D', 4, '16:00:00', '19:00:00'),
(2936430, 'Mark Joseph Tayag', 'ICT LAB', 'NET', 'IT 3-J', 4, '07:00:00', '10:00:00'),
(2987438, 'Joshua Lawrence Lumba', 'ICT LAB', 'CSS', 'IT 3-B', 1, '10:00:00', '13:00:00'),
(3819738, 'Joshua Lawrence Lumba', 'COM LAB', 'CSS', 'IT 3-B', 4, '16:00:00', '19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ccs_user`
--

CREATE TABLE `ccs_user` (
  `ccs_id` int(11) NOT NULL,
  `ccs_email` varchar(35) DEFAULT NULL,
  `ccs_password` varchar(255) DEFAULT NULL,
  `ccs_firstname` varchar(25) DEFAULT NULL,
  `ccs_lastname` varchar(25) DEFAULT NULL,
  `ccs_middlename` varchar(25) DEFAULT NULL,
  `ccs_position` varchar(20) DEFAULT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ccs_user`
--

INSERT INTO `ccs_user` (`ccs_id`, `ccs_email`, `ccs_password`, `ccs_firstname`, `ccs_lastname`, `ccs_middlename`, `ccs_position`, `reset_token_hash`, `reset_token_expiry`) VALUES
(2000878, '2021306738@dhvsu.edu.ph', '$2y$10$H.Bkw/6cDW0cxcDGoqCR7.wscHmCD/NI7Fs9dGFDT3NOqyNfJa6UG', 'Joshua Lawrence', 'Lumba', '', 'Instructor', NULL, NULL),
(2006740, 'adm1n.ccspace@gmail.com', 'rzgpsfjsvyopoaqx', '', '', '', 'Admin', NULL, NULL),
(2178761, '2021305494@dhvsu.edu.ph', '$2y$10$UIpbvYRIcxHINQRiancpM.UWbFcjSn7Qu51zRi11./mUoh76o05NS', 'Justin', 'Bais', 'Pabustan', 'Instructor', NULL, NULL),
(2496934, '2018004764@dhvsu.edu.ph', '$2y$10$tGnmRF/Akip/28waPVMRvukPEASWuzFp3dMSP2DtagdYsv/eTPtee', 'Mark', 'Tayag', 'Miguel', 'Instructor', NULL, NULL),
(2583822, '2021305877@dhvsu.edu.ph', '$2y$10$2hlNmXtC/RqeARviEXTc/eQsIWU4iy8hJh7pwWV6Ma4HR0OOHIcaO', 'Mariella ', 'Macaspac', 'Sambat', 'Instructor', NULL, NULL),
(2631540, '2021312432@dhvsu.edu.ph', '$2y$10$kzG8uCHZ4/1h4gMqrqaROu2j1GQUjdR3Dan7.Vf5L22YM/W2GBl0O', 'Nicole', 'Dimacali', 'Ugot', 'Instructor', NULL, NULL),
(2643735, '2021307409@dhvsu.edu.ph', '$2y$10$0Ysu2/TqZ4j5NTjhW7cl9.LyjQnBhThhArNDLykpdwK.f8rH/Uwxi', 'Carla Joy', 'Manapsal', 'Maniago', 'Instructor', NULL, NULL),
(2700570, '2021306340@dhvsu.edu.ph', '$2y$10$t9Vc5k5ctTzon0FRjacSteQ57pGnt93tLa/F1MjzoLWRw.tPNEpgu', 'Nathaniel', 'Mallari', 'Susi', 'Instructor', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ccs_log`
--
ALTER TABLE `ccs_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `ccs_reservation`
--
ALTER TABLE `ccs_reservation`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `ccs_room`
--
ALTER TABLE `ccs_room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `ccs_schedule`
--
ALTER TABLE `ccs_schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `ccs_user`
--
ALTER TABLE `ccs_user`
  ADD PRIMARY KEY (`ccs_id`),
  ADD UNIQUE KEY `ccs_email` (`ccs_email`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ccs_log`
--
ALTER TABLE `ccs_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2989504;

--
-- AUTO_INCREMENT for table `ccs_reservation`
--
ALTER TABLE `ccs_reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2979819;

--
-- AUTO_INCREMENT for table `ccs_room`
--
ALTER TABLE `ccs_room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2586120;

--
-- AUTO_INCREMENT for table `ccs_schedule`
--
ALTER TABLE `ccs_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3819739;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
