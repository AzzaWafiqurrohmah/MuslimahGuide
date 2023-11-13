-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2023 at 07:49 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `muslimahguide`
--

-- --------------------------------------------------------

--
-- Table structure for table `cycle_est`
--

CREATE TABLE `cycle_est` (
  `cycleEst_id` int(11) NOT NULL,
  `cycle_length` int(3) DEFAULT NULL,
  `period_length` int(3) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cycle_history`
--

CREATE TABLE `cycle_history` (
  `cycleHistory_id` int(11) NOT NULL,
  `cycle_length` int(3) DEFAULT NULL,
  `period_length` int(3) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `education_id` int(11) NOT NULL,
  `img` varchar(50) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `contents` text DEFAULT NULL,
  `on_clicked` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`education_id`, `img`, `title`, `contents`, `on_clicked`) VALUES
(18, 'd7511_ilustrasi.jpeg', 'Apa itu haid?', 'haid yaitu keluarnya darah selama kurun waktu tertentu\r\n', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `reminder_id` int(11) NOT NULL,
  `type` enum('period_start','period_late','period_end') DEFAULT NULL,
  `message` varchar(100) DEFAULT 'atur dan cek kembali siklus mu',
  `reminder` int(2) DEFAULT 0,
  `reminder_time` time DEFAULT '08:00:00',
  `is_on` tinyint(1) NOT NULL DEFAULT 1,
  `is_read` tinyint(4) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` char(15) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `user_id`) VALUES
('654ae57b464b0', 468),
('6550f41c7f068', 473),
('6550fbfee9e5d', 473);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `profileImg` varchar(50) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `role` enum('admin','user') NOT NULL,
  `phone` char(12) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `profileImg`, `name`, `birthdate`, `role`, `phone`, `username`, `email`, `password`) VALUES
(468, 'profile.jpg', 'Azza Wafiqurrohmah', NULL, 'admin', '087546534211', 'azza23', 'azza@gmail.com', 'rahasia'),
(473, NULL, 'user', '2003-08-07', 'user', NULL, 'user', 'nisa@gmail.com', 'user'),
(474, NULL, 'sisi', '2003-08-03', 'user', '082342123456', 'sisi123', 'sisi@gmailcom', 'rahasia'),
(475, NULL, 'nana', '2005-11-03', 'user', '082342123456', 'nana', 'nana@gmail.com', 'rahasia'),
(476, NULL, 'rika', '2005-11-03', 'user', '082342123456', 'sinta', 'sinta@gmail.com', 'rahasia'),
(478, NULL, 'putri', '2005-11-03', 'user', '082342123456', 'putri123', 'putri@gmail.com', 'rahasia'),
(493, NULL, 'siska', '2001-05-03', 'user', NULL, 'siska20', 'siska@gmail.com', 'rahasia'),
(494, NULL, 'ani', '2001-03-02', 'user', NULL, 'ani12', 'ani@gmail.com', 'rahasia'),
(495, NULL, 'rere', '2001-04-01', 'user', NULL, 'rere23', 'rere@gmail.com', 'rahasia'),
(496, NULL, 'mayang', '2001-07-05', 'user', NULL, 'mayang', 'mayang@gmail.com', 'rahasia'),
(497, NULL, 'riri', '1998-08-23', 'user', NULL, 'riri12', 'riri@gmail.com', 'rahasia'),
(526, NULL, 'second', NULL, 'user', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(540, NULL, NULL, NULL, 'user', NULL, 'monika23', 'monika@gmail.com', 'rahasia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cycle_est`
--
ALTER TABLE `cycle_est`
  ADD PRIMARY KEY (`cycleEst_id`),
  ADD KEY `cycle_est_ibfk_1` (`user_id`);

--
-- Indexes for table `cycle_history`
--
ALTER TABLE `cycle_history`
  ADD PRIMARY KEY (`cycleHistory_id`),
  ADD KEY `cycle_history_ibfk_1` (`user_id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`education_id`);

--
-- Indexes for table `reminder`
--
ALTER TABLE `reminder`
  ADD PRIMARY KEY (`reminder_id`),
  ADD KEY `reminder_ibfk_1` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `sessions_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cycle_est`
--
ALTER TABLE `cycle_est`
  MODIFY `cycleEst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `cycle_history`
--
ALTER TABLE `cycle_history`
  MODIFY `cycleHistory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `education_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=544;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cycle_est`
--
ALTER TABLE `cycle_est`
  ADD CONSTRAINT `cycle_est_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cycle_history`
--
ALTER TABLE `cycle_history`
  ADD CONSTRAINT `cycle_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reminder`
--
ALTER TABLE `reminder`
  ADD CONSTRAINT `reminder_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
