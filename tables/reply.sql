-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 12:29 PM
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
-- Database: `qadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `r_id` int(11) NOT NULL COMMENT 'Reply ID',
  `p_id` int(11) NOT NULL COMMENT 'Parent post ID',
  `u_id` int(11) NOT NULL,
  `r_content` varchar(1024) NOT NULL COMMENT 'Reply Content',
  `r_create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`r_id`, `p_id`, `u_id`, `r_content`, `r_create_time`) VALUES
(1, 1, 2, 'This is a reply', '2024-04-19 11:56:42'),
(2, 1, 1, 'This is a reply from Admin.', '2024-04-19 11:57:02'),
(6, 21, 2, 'Test', '2024-04-25 12:26:36'),
(22, 25, 2, 'Test', '2024-04-25 14:11:37'),
(23, 19, 2, 'This is a repy!', '2024-04-25 14:13:35'),
(24, 21, 2, 'Reply', '2024-04-25 15:52:08'),
(27, 21, 2, 'test', '2024-04-25 16:16:07'),
(28, 21, 2, 'test', '2024-04-25 16:16:09'),
(33, 25, 2, 'Test', '2024-04-26 06:35:35'),
(36, 25, 2, 'Test', '2024-04-26 06:35:52'),
(38, 21, 2, 'Test', '2024-04-26 06:43:25'),
(39, 21, 2, 'Test', '2024-04-26 06:43:28'),
(40, 21, 2, 'Test', '2024-04-26 06:43:31'),
(42, 13, 2, 'test', '2024-04-27 18:53:53'),
(58, 48, 46, '123', '2024-05-05 14:04:39'),
(60, 48, 46, 'not', '2024-05-05 14:04:50'),
(61, 51, 2, 'I am a little bit worried.', '2024-05-06 01:05:33'),
(62, 51, 4, 'I remember once is enough for students who graduate in 2025. I\'m graduating in 2024 so it is twice for me.', '2024-05-06 01:06:41'),
(63, 51, 46, 'You only need to do it once ;) Don\'t worry!', '2024-05-06 01:07:28'),
(64, 52, 46, 'Too tired to walk...', '2024-05-06 01:08:33'),
(65, 6, 1, '', '2024-05-06 01:11:37'),
(66, 6, 1, '', '2024-05-06 01:11:42'),
(67, 51, 1, 'Once is enough', '2024-05-06 01:20:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `Reply belong to post` (`p_id`),
  ADD KEY `User post reply` (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Reply ID', AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `Reply belong to post` FOREIGN KEY (`p_id`) REFERENCES `post` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User post reply` FOREIGN KEY (`u_id`) REFERENCES `qa_user` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
