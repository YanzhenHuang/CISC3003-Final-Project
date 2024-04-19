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
-- Table structure for table `qa_user`
--

CREATE TABLE `qa_user` (
  `u_id` int(11) NOT NULL COMMENT 'User ID',
  `u_name` varchar(32) NOT NULL DEFAULT current_timestamp() COMMENT 'User Name',
  `u_pwd` varchar(256) DEFAULT NULL COMMENT 'User Password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qa_user`
--

INSERT INTO `qa_user` (`u_id`, `u_name`, `u_pwd`) VALUES
(1, 'Admin', 'BrYSjHHrhL987466574265468'),
(2, 'Guo Pengze', 'abc'),
(3, 'Chen Zirui', 'abc123'),
(4, 'Li Ruoxuan', '123456'),
(5, 'Chen Pengyu', 'abcd1234'),
(6, 'Huang Yanzhen', 'hyzfashionboy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `qa_user`
--
ALTER TABLE `qa_user`
  ADD PRIMARY KEY (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
