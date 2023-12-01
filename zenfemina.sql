-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2023 at 07:49 AM
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
-- Table structure for table `change_prayer`
--

CREATE TABLE `change_prayer` (
  `changePrayer_id` int(11) NOT NULL,
  `prayer` enum('shubuh','dzuhur','ashar','maghrib','isya') DEFAULT NULL,
  `status` enum('done','no') DEFAULT 'no',
  `cycleHistory_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Triggers `cycle_est`
--
DELIMITER $$
CREATE TRIGGER `add_cycleEst(reminder)` AFTER INSERT ON `cycle_est` FOR EACH ROW BEGIN
UPDATE reminder SET cycleEst_id = NEW.cycleEst_id
WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;

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
(18, 'd7511_ilustrasi.jpeg', 'Apa itu haid?', 'haid yaitu keluarnya darah selama kurun waktu tertentu, dan ketentuan tertentu.\n', 5),
(25, 'Niqab_Sastra-Arab-UI.jpg', 'kewajiban mengganti sholat', 'setelah siklus haid selesai, perempuan muslimah diwajibkan untuk mengganti sholatnya dengan ketentuan tertentu\n', 0),
(27, 'Niqab_Sastra-Arab-UI.jpg', 'kenali gejala sebelum menstruasi', 'sebelum menstruasi, biasanya beberapa orang mengalami gejara seperti kram perut dan lainnya\r\n', 8);

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `reminder_id` int(11) NOT NULL,
  `type` enum('period_start','period_late','period_end') DEFAULT NULL,
  `message` varchar(100) DEFAULT 'atur dan cek kembali siklus mu',
  `reminderDays` int(2) DEFAULT 0,
  `reminder_time` time DEFAULT '08:00:00',
  `is_on` tinyint(1) NOT NULL DEFAULT 1,
  `cycleEst_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` char(15) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(474, NULL, 'sisi', '2003-08-03', 'user', '082342123456', 'sisi123', 'sisi@gmailcom', 'rahasia'),
(475, NULL, 'nana', '2005-11-03', 'user', '082342123456', 'nana14', 'nana@gmail.com', 'rahasia'),
(476, NULL, 'rika12', '2005-11-03', 'user', '082342123456', 'sinta8', 'sinta@gmail.com', 'rahasia'),
(478, NULL, 'putri', '2005-11-03', 'user', '082342123456', 'putri12', 'putri@gmail.com', 'rahasia'),
(493, NULL, 'siska', '2001-05-03', 'user', NULL, 'siska20', 'siska@gmail.com', '12345'),
(494, NULL, 'ani', '2001-03-02', 'user', NULL, 'ani1', 'ani@gmail.com', 'rahasia'),
(495, NULL, 'rere23', '2001-04-01', 'user', NULL, 'rere23', 'rere@gmail.com', 'rahasia'),
(496, NULL, 'mayang', '2001-07-05', 'user', NULL, 'mayang65', 'mayang@gmail.com', 'rahasia'),
(497, NULL, 'riri', '1998-08-23', 'user', NULL, 'riri12', 'riri@gmail.com', 'rahasia'),
(643, NULL, NULL, '2003-11-16', 'user', NULL, 'mbul', 'mbul@gmail.com', 'rahasia'),
(720, NULL, NULL, '2003-11-16', 'user', NULL, 'mbul', 'azza@gmail.com', 'rahasia'),
(721, NULL, NULL, '2003-11-16', 'user', NULL, 'cici', 'cici@gmail.com', 'rahasia');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `add_reminder` AFTER INSERT ON `users` FOR EACH ROW BEGIN
IF NEW.role = 'user' THEN
        INSERT INTO reminder (type, message, is_on, 			user_id) VALUES
        ('period_start', 'Hari pertama siklus menstruasi Anda dimulai', '0', NEW.user_id),
        ('period_end', 'Masa haid Anda telah selesai', '0', NEW.user_id),
        ('period_late', 'Perhatian! Haid Anda terlambat.', '0', NEW.user_id);
    END IF;
END
$$
DELIMITER ;

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
-- Indexes for table `change_prayer`
--
ALTER TABLE `change_prayer`
  ADD PRIMARY KEY (`changePrayer_id`),
  ADD KEY `change_prayer_ibfk_1` (`cycleHistory_id`);

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
  ADD KEY `reminder_ibfk_1` (`user_id`),
  ADD KEY `fk_reminder` (`cycleEst_id`);

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
-- AUTO_INCREMENT for table `change_prayer`
--
ALTER TABLE `change_prayer`
  MODIFY `changePrayer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cycle_est`
--
ALTER TABLE `cycle_est`
  MODIFY `cycleEst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `cycle_history`
--
ALTER TABLE `cycle_history`
  MODIFY `cycleHistory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `education_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=726;

--
-- AUTO_INCREMENT for table `verifications`
--
ALTER TABLE `verifications`
  MODIFY `verification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `change_prayer`
--
ALTER TABLE `change_prayer`
  ADD CONSTRAINT `change_prayer_ibfk_1` FOREIGN KEY (`cycleHistory_id`) REFERENCES `cycle_history` (`cycleHistory_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_reminder` FOREIGN KEY (`cycleEst_id`) REFERENCES `cycle_est` (`cycleEst_id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
