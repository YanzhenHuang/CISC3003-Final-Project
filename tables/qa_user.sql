-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 11:43 AM
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
  `u_email` varchar(128) DEFAULT NULL,
  `u_pwd` varchar(256) DEFAULT NULL COMMENT 'User Password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qa_user`
--

INSERT INTO `qa_user` (`u_id`, `u_name`, `u_email`, `u_pwd`) VALUES
(1, 'Admin', 'yanzhenhuangwork@gmail.com', '840b5a59aa391d157163f73efbe4f60d0ce3c97030a432aca159369840220c41'),
(2, 'Guo Pengze', NULL, 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad'),
(3, 'Chen Zirui', NULL, '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090'),
(4, 'Li Ruoxuan', NULL, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92'),
(5, 'Chen Pengyu', NULL, 'e9cee71ab932fde863338d08be4de9dfe39ea049bdafb342ce659ec5450b69ae'),
(6, 'Huang Yanzhen', NULL, 'e7a2ec86b0432d464a402627a91d2da3dd6f76570dd8212864f16558f8ce31a3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `qa_user`
--
ALTER TABLE `qa_user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `qa_user`
--
ALTER TABLE `qa_user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User ID', AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
