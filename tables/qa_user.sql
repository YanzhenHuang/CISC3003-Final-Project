-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 11:46 AM
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
(1, 'Admin', 'yanzhenhuangwork@gmail.com', '840b5a59aa391d157163f73efbe4f60d0ce3c97030a432aca159369840220c41', 1, 0, NULL),
(2, 'Guo Pengze', 'bingponingmeng@gmail.com', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 1, 0, NULL),
(3, 'Chen Zirui', NULL, '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', 1, 0, NULL),
(4, 'Li Ruoxuan', NULL, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, 0, NULL),
(5, 'Chen Pengyu', NULL, 'e9cee71ab932fde863338d08be4de9dfe39ea049bdafb342ce659ec5450b69ae', 1, 0, NULL),
(6, 'Huang Yanzhen', NULL, 'e7a2ec86b0432d464a402627a91d2da3dd6f76570dd8212864f16558f8ce31a3', 1, 0, NULL),
(45, 'TestLogin', 'huangyanzhen0108@163.com', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 1, 0, '8873f36c6338824be5254e337b3acbaf84b71f2a94a16ff8352693e99e61726b'),
(46, 'Foster', 'like13656929652@gmail.com', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 1, 0, '0b65b08e1f3d1ac83cd8a0ec4f9f0f8ac0bed63b1b1e778885e06830b3856ff6');

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
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User ID', AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
