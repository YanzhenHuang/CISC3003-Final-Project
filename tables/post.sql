-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 03:46 PM
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
(1, 1, 'This is a message from Admin.', 0, '2024-04-19 11:48:38'),
(2, 1, 'This is another message from admin.', 0, '2024-04-19 11:48:38'),
(3, 3, 'Aminos', 0, '2024-04-19 11:48:38'),
(4, 2, '123', 0, '2024-04-19 11:48:38'),
(5, 2, 'Test', 0, '2024-04-19 11:48:38'),
(6, 1, 'This is a test of database.', 0, '2024-04-19 11:50:06');

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
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `User Post` FOREIGN KEY (`u_id`) REFERENCES `qa_user` (`u_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
