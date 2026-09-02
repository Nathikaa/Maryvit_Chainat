-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2026 at 09:50 AM
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
-- Database: `maryvit_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `fullname`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$cxxMqTjxxUn6LmbUnNWtgeL.1ES7pfCZugPl2wC9CkNecsaCwZVsq', 'ผู้ดูแลระบบส่วนกลาง', 'SuperAdmin', '2026-08-27 03:06:30'),
(2, 'admin2', '$2y$10$YejrF3PKrk6Cjm.Zpnehr.RqBbqZ4O8935fN8ihoCaNUU5fyoCUVS', 'น.ส.มีบุญ มากมี', 'admin', '2026-08-27 05:33:45'),
(3, 'admin3', '$2y$10$2lr.wBnHixIqhemGH9Zj9uh4cRz33zyyF2PF68s0oUKCaY7BBHOFG', 'นาย สุภาพ บุรุษ', 'admin', '2026-08-27 05:54:45');

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE `admissions` (
  `id` int(11) NOT NULL,
  `student_name` varchar(150) NOT NULL,
  `grade_level` varchar(50) NOT NULL,
  `parent_phone` varchar(20) NOT NULL,
  `parent_line` varchar(50) DEFAULT NULL,
  `status` enum('pending','contacted','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`id`, `student_name`, `grade_level`, `parent_phone`, `parent_line`, `status`, `created_at`) VALUES
(1, 'ด.ช.กล้าหาญ ใจดี', 'แผนกปฐมวัย (เตรียมอนุบาล - อ.3)', '082-426-8741', '123456', 'pending', '2026-08-27 03:19:59');

-- --------------------------------------------------------

--
-- Table structure for table `contact_tickets`
--

CREATE TABLE `contact_tickets` (
  `id` int(11) NOT NULL,
  `ticket_code` varchar(30) NOT NULL,
  `topic` varchar(50) NOT NULL,
  `urgency` enum('Normal','Fast','Urgent') DEFAULT 'Normal',
  `sender_name` varchar(150) NOT NULL,
  `sender_phone` varchar(20) NOT NULL,
  `sender_email` varchar(100) DEFAULT NULL,
  `sender_line` varchar(50) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('new','in_progress','resolved') DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_tickets`
--

INSERT INTO `contact_tickets` (`id`, `ticket_code`, `topic`, `urgency`, `sender_name`, `sender_phone`, `sender_email`, `sender_line`, `message`, `status`, `created_at`) VALUES
(1, 'MV-2026-CH6471', 'Admissions', 'Normal', 'ด.ญ.สุขใจ มีมาก', '054-987-5624', 'ex123@gmail.com', '123456', 'ต้องการสมัครเรียน แบบด่วนที่สุด', 'new', '2026-08-27 03:25:31');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` enum('general','academic','activity','pride') DEFAULT 'general',
  `detail` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `category`, `detail`, `image_path`, `views`, `created_at`) VALUES
(1, 'กิจกรรมวันภาษาไทย ปี 2569', 'activity', 'โรงเรียนได้จัดกิจกรรม วันภาษาไทยแห่งชาติ เพื่อส่งเสริมให้นักเรียนเห็นคุณค่าและความสำคัญของภาษาไทย ตลอดจนร่วมอนุรักษ์ภาษาไทยให้คงอยู่สืบไป ภายในงานมีกิจกรรมส่งเสริมทักษะทางภาษาไทยที่หลากหลาย นักเรียนได้ร่วมกิจกรรมอย่างสนุกสนานและได้รับความรู้ควบคู่กับการเรียนรู้', NULL, 0, '2026-08-27 03:30:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `admissions`
--
ALTER TABLE `admissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_tickets`
--
ALTER TABLE `contact_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admissions`
--
ALTER TABLE `admissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_tickets`
--
ALTER TABLE `contact_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
