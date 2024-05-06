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
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `p_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `p_content` varchar(256) NOT NULL,
  `p_is_close` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'When a question is successfully asked, the originator can close this question.',
  `p_create_time` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Time when the post is created.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`p_id`, `u_id`, `p_content`, `p_is_close`, `p_create_time`) VALUES
(1, 1, 'This is a message from Admin.', 1, '2024-04-19 11:48:38'),
(2, 1, 'This is another message from admin.', 1, '2024-04-19 11:48:38'),
(3, 3, 'Aminos', 0, '2024-04-19 11:48:38'),
(6, 1, 'This is a test of database.', 0, '2024-04-19 11:50:06'),
(12, 3, 'My name is Guo Pengze 2.', 0, '2024-04-19 16:45:30'),
(13, 3, 'My name is Guo Pengze 3.', 0, '2024-04-19 16:45:33'),
(14, 3, 'My name is Guo Pengze 4.', 0, '2024-04-19 16:45:38'),
(15, 3, 'My name is Guo Pengze 5.', 0, '2024-04-19 16:45:43'),
(16, 4, 'This is my first question!', 1, '2024-04-19 16:49:09'),
(18, 1, 'Admin test if remove manual increment of post id works.', 1, '2024-04-19 17:33:08'),
(19, 1, 'Test merge.', 1, '2024-04-19 17:35:14'),
(20, 1, 'This is a test post from admin on 17:18 of April 20, 2024.', 1, '2024-04-20 09:18:37'),
(21, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in', 1, '2024-04-20 10:14:47'),
(22, 5, 'lorem ipsum layout test', 0, '2024-04-20 10:16:00'),
(23, 6, 'I am huang yanzhen', 0, '2024-04-20 10:17:42'),
(24, 6, 'I am huang yanzhen. I am a fashionboy.', 0, '2024-04-20 10:38:28'),
(25, 3, 'Test', 0, '2024-04-21 14:57:17'),
(27, 38, 'Test delete behavior.', 0, '2024-04-23 14:12:53'),
(28, 38, 'test agatest agatest agatest agatest agatest agatest agatest aga', 0, '2024-04-23 14:13:02'),
(48, 47, '1=1？', 0, '2024-05-05 14:03:51'),
(50, 1, 'The service had started. If you have any questions, please contact admin huangyanzhen0108@gmail.com. Thanks!', 0, '2024-05-06 01:04:41'),
(51, 2, 'How many high table should I attend in order to graduate?', 0, '2024-05-06 01:05:24'),
(52, 46, 'When will the school bus end its service during weekends? Just heading school and I don\'t want to walk....', 0, '2024-05-06 01:08:20'),
(53, 4, 'Does anyone knows machine learning? My PyCharm won\'t work...', 0, '2024-05-06 01:09:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `User Post` (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
