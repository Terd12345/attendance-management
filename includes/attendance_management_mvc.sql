-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2025 at 07:30 AM
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
-- Database: `attendance_management_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `adminID` int(11) NOT NULL,
  `full_name` varchar(244) NOT NULL,
  `email` varchar(244) NOT NULL,
  `password` varchar(233) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` varchar(233) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `adminID`, `full_name`, `email`, `password`, `created_at`, `role`) VALUES
(1, 101, 'Romeo V. Eustaquio III', 'terd.eustaquioiii@gmail.com', 'terdpogi', '2025-05-02 18:41:45', 'HR');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_logs`
--

CREATE TABLE `attendance_logs` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `time_in` datetime DEFAULT current_timestamp(),
  `time_out` datetime DEFAULT NULL,
  `status` enum('Present','Late','Absent') DEFAULT 'Present',
  `log_date` date DEFAULT curdate(),
  `time_in_image` varchar(255) DEFAULT NULL,
  `time_out_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_logs`
--

INSERT INTO `attendance_logs` (`id`, `employee_id`, `time_in`, `time_out`, `status`, `log_date`, `time_in_image`, `time_out_image`) VALUES
(49, 19, NULL, NULL, 'Absent', '2025-05-07', NULL, NULL),
(50, 20, NULL, '2025-05-07 14:27:35', 'Absent', '2025-05-07', NULL, '681afd574ebfd_timeout.png'),
(51, 16, NULL, NULL, 'Absent', '2025-05-07', NULL, NULL),
(52, 17, NULL, NULL, 'Absent', '2025-05-07', NULL, NULL),
(53, 16, '2025-05-08 09:32:43', '2025-05-08 09:33:04', 'Absent', '2025-05-08', '681c09bb24853.png', '681c09d060e8e_timeout.png'),
(54, 17, '2025-05-08 09:34:02', '2025-05-08 09:35:42', 'Absent', '2025-05-08', '681c0a0abadee.png', '681c0a6e4a4ea_timeout.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `employee_id` varchar(20) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `created_at`, `employee_id`, `role`) VALUES
(16, 'Romeo V. Eustaquio III', 'romeov.eustaquioiii@gmail.com', '$2y$10$xOPQ5UZV49uxUH0nOTvkz.r3kDmp5DCosUnBFSSuaM6MqzFw4il96', '2025-05-02 18:23:58', 'EMP-ABBE245A', 'Data Encoder'),
(17, 'harry', 'hairy@gmail.com', '$2y$10$teme6CuB615UK56q5u0breeJ8LIkhUr5y03vHBmvOjYh.M3y/MvWW', '2025-05-02 19:56:39', 'EMP-D04DB7E0', 'Accountant'),
(19, 'Jerica mae salcedo', 'jeca@gmail.com', '$2y$10$Dkybs/DZmT/KDhqs0G08ROT2nIsluQ5espkHHdV/NOey2V7cWZAsW', '2025-05-07 02:46:10', 'EMP-3B2A30C3', 'Cashier'),
(20, 'marc escobido', 'scoobydo@gmail.com', '$2y$10$nlfYx0eUtJSaNNc97zlZCOhKTKzPOKT3XIONpsohJ1Yq3/a56xHIi', '2025-05-07 05:48:17', 'EMP-4C44A61B', 'Accountant');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_logs`
--
ALTER TABLE `attendance_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_employee_date` (`employee_id`,`log_date`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance_logs`
--
ALTER TABLE `attendance_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance_logs`
--
ALTER TABLE `attendance_logs`
  ADD CONSTRAINT `attendance_logs_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
