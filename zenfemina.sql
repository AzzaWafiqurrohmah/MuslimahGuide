-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2023 at 01:41 AM
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
-- Database: `zenfemina`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cycle_est`
--

INSERT INTO `cycle_est` (`cycleEst_id`, `cycle_length`, `period_length`, `start_date`, `end_date`, `user_id`) VALUES
(49, 3, 22, NULL, NULL, 544),
(50, 8, 27, NULL, NULL, 545),
(52, 3, 22, NULL, NULL, 547),
(53, 8, 27, NULL, NULL, 548),
(55, 3, 22, NULL, NULL, 560),
(56, 8, 27, NULL, NULL, 561);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cycle_history`
--

INSERT INTO `cycle_history` (`cycleHistory_id`, `cycle_length`, `period_length`, `start_date`, `end_date`, `user_id`) VALUES
(9, 4, 30, NULL, NULL, 559),
(10, 4, 30, NULL, NULL, 572);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`education_id`, `img`, `title`, `contents`, `on_clicked`) VALUES
(18, 'd7511_ilustrasi.jpeg', 'Apa itu haid?', 'haid yaitu keluarnya darah selama kurun waktu tertentu, dan ketentuan tertentu.\r\n', 5),
(25, 'Niqab_Sastra-Arab-UI.jpg', 'kewajiban mengganti sholat', 'setelah siklus mentruasi selesai, perempuan muslimah diwajibkan untuk mengganti sholatnya dengan ketentuan tertentu\r\n', 0),
(27, 'Niqab_Sastra-Arab-UI.jpg', 'kenali gejala sebelum menstruasi', 'sebelum menstruasi, biasanya beberapa orang mengalami gejara seperti kram perut dan lainnya\r\n', 4);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`reminder_id`, `type`, `message`, `reminder`, `reminder_time`, `is_on`, `is_read`, `user_id`) VALUES
(73, 'period_start', 'atur dan cek kembali siklus mu', 0, '08:00:00', 1, 0, 550),
(74, 'period_start', 'haiiii', 0, NULL, 1, 0, 551),
(76, 'period_start', 'atur dan cek kembali siklus mu', 0, '08:00:00', 1, 0, 563),
(77, 'period_start', 'haiiii', 0, NULL, 1, 0, 564);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` char(15) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `user_id`) VALUES
('6556448511faa', 468),
('65564b8530830', 468),
('6556bac57c71c', 468),
('6556baf31630e', 468),
('6556bb0662dc6', 468),
('6558837f41db8', 468),
('6559f8542ddce', 468),
('655a37988e110', 468),
('655ab6bbd0303', 468),
('655b08a7c72aa', 468),
('655c10e9e6b7b', 468),
('655c3874bb6b3', 468),
('655c76cc2a944', 468),
('655c786c33620', 468),
('655cb72d6ca22', 468);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `profileImg`, `name`, `birthdate`, `role`, `phone`, `username`, `email`, `password`) VALUES
(468, 'profile.jpg', 'Azza Wafiqurrohmah', '2003-04-02', 'admin', '087876123213', 'azza23', 'wafiqurrohmahazza@gmail.com', 'rahasia'),
(473, NULL, 'user', '2003-04-02', 'user', '087876123213', 'user', 'user@gmail.com', 'user'),
(474, NULL, 'sisi', '2003-08-03', 'user', '082342123456', 'sisi12', 'sisi@gmailcom', 'rahasia'),
(475, NULL, 'nana', '2005-11-03', 'user', '082342123456', 'nana14', 'nana@gmail.com', 'rahasia'),
(476, NULL, 'rika', '2005-11-03', 'user', '082342123456', 'sinta82', 'sinta@gmail.com', 'rahasia'),
(478, NULL, 'putri', '2005-11-03', 'user', '082342123456', 'putri12', 'putri@gmail.com', 'rahasia'),
(493, NULL, 'siska', '2001-05-03', 'user', NULL, 'siska20', 'siska@gmail.com', 'rahasia'),
(494, NULL, 'ani', '2001-03-02', 'user', NULL, 'ani1', 'ani@gmail.com', 'rahasia'),
(495, NULL, 'rere', '2001-04-01', 'user', NULL, 'rere23', 'rere@gmail.com', 'rahasia'),
(496, NULL, 'mayang', '2001-07-05', 'user', NULL, 'mayang65', 'mayang@gmail.com', 'rahasia'),
(497, NULL, 'riri', '1998-08-23', 'user', NULL, 'riri12', 'riri@gmail.com', 'rahasia'),
(526, NULL, 'second', NULL, 'user', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(544, NULL, 'sisi', NULL, 'admin', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(545, NULL, 'sisi', NULL, 'admin', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(546, NULL, 'sisi', NULL, 'admin', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(547, NULL, 'sisi', NULL, 'admin', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(548, NULL, 'sisi', NULL, 'admin', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(549, NULL, 'sisi', NULL, 'admin', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(550, NULL, 'sisi', NULL, 'admin', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(551, NULL, 'sisi', NULL, 'admin', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(552, NULL, 'sisi', NULL, 'admin', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(555, NULL, NULL, '2023-11-15', 'admin', '082342123456', 'mbul', NULL, 'rahasia'),
(556, NULL, 'rika', '2023-11-15', 'admin', '082342123456', 'mbul', NULL, 'rahasia'),
(558, NULL, NULL, '2023-11-15', 'admin', '082342123456', 'mbul', NULL, 'rahasia'),
(559, NULL, 'sisi', NULL, 'admin', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(560, NULL, 'sisi', NULL, 'admin', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(561, NULL, 'sisi', NULL, 'admin', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(562, NULL, 'sisi', NULL, 'admin', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(563, NULL, 'sisi', NULL, 'admin', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(564, NULL, 'sisi', NULL, 'admin', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(565, NULL, 'sisi', NULL, 'admin', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(568, NULL, NULL, '2023-11-15', 'admin', '082342123456', 'mbul', NULL, 'rahasia'),
(569, NULL, 'rika', '2023-11-15', 'admin', '082342123456', 'mbul', NULL, 'rahasia'),
(571, NULL, NULL, '2023-11-15', 'admin', '082342123456', 'mbul', NULL, 'rahasia'),
(572, NULL, 'sisi', NULL, 'admin', '087342123456', 'hjhjhjhj', 'afdfdgdg', 'rahasia'),
(573, NULL, 'azza', NULL, 'user', '087675453432', 'azza345', 'azza@gmail.com', 'rahasia'),
(594, NULL, 'contoh', NULL, 'admin', NULL, 'contoh', 'contoh@gmail.com', 'rahasia'),
(595, NULL, 'contoh', NULL, 'admin', NULL, 'contoh', 'contoh@gmail.com', 'rahasia'),
(596, NULL, 'contoh', NULL, 'admin', NULL, 'contoh', 'contoh@gmail.com', 'rahasia'),
(597, NULL, 'contoh', NULL, 'admin', NULL, 'contoh', 'contoh@gmail.com', 'rahasia'),
(598, NULL, 'contoh', NULL, 'admin', NULL, 'contoh', 'contoh@gmail.com', 'rahasia'),
(601, NULL, 'contoh', NULL, 'admin', NULL, 'contoh', 'contoh@gmail.com', 'rahasia'),
(602, NULL, 'contoh', NULL, 'admin', NULL, 'contoh', 'contoh@gmail.com', 'rahasia'),
(603, NULL, 'contoh', NULL, 'admin', NULL, 'contoh', 'contoh@gmail.com', 'rahasia'),
(604, NULL, 'contoh', NULL, 'admin', NULL, 'contoh', 'contoh@gmail.com', 'rahasia');

-- --------------------------------------------------------

--
-- Table structure for table `verifications`
--

CREATE TABLE `verifications` (
  `verification_id` int(11) NOT NULL,
  `code` varchar(6) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `verifications`
--
ALTER TABLE `verifications`
  ADD PRIMARY KEY (`verification_id`),
  ADD KEY `verifications_ibfk_1` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cycle_est`
--
ALTER TABLE `cycle_est`
  MODIFY `cycleEst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `cycle_history`
--
ALTER TABLE `cycle_history`
  MODIFY `cycleHistory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `education_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=605;

--
-- AUTO_INCREMENT for table `verifications`
--
ALTER TABLE `verifications`
  MODIFY `verification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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

--
-- Constraints for table `verifications`
--
ALTER TABLE `verifications`
  ADD CONSTRAINT `verifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
