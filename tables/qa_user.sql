-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 03:33 AM
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
  `u_pwd` varchar(256) DEFAULT NULL COMMENT 'User Password',
  `u_valid` tinyint(1) NOT NULL DEFAULT 0,
  `u_change_valid` tinyint(1) NOT NULL DEFAULT 0,
  `u_token` varchar(256) DEFAULT NULL COMMENT 'Login Token for validation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qa_user`
--

INSERT INTO `qa_user` (`u_id`, `u_name`, `u_email`, `u_pwd`, `u_valid`, `u_change_valid`, `u_token`) VALUES
(1, 'Admin', 'yanzhenhuangwork@gmail.com', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 1, 0, '28ff14220062ec93334d34677fed8aa72b980d03292e9f1074c24ee791f444a4'),
(2, 'Guo Pengze', 'bingponingmeng@gmail.com', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 1, 0, NULL),
(4, 'Li Ruoxuan', 'louiselrxuan@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, 0, NULL),
(46, 'Foster Chen Pengyu', '3297104944@qq.com', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 1, 0, '5a1b66934e52b940dbdc1a94891540d40f31a2463cc156e055dede45855d13a6'),
(47, 'Group 04', 'huangyanzhen0108@163.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 1, 0, '5546c6a2c8842f94b055e954c18cfb40f2f4419d9bf0c14afb863e5a11ed9e89'),
(48, 'Chen Zirui', '614550317@qq.com', '9a639003b35ec01545e23fc3ea7cbb083ae1762896f8371df00aa4b956679fc9', 1, 0, 'bc4b3b167d24e4bc134b5a31d4953c9c5ae29c27e54ee4fef018e957ff21e1ec');

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
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User ID', AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
