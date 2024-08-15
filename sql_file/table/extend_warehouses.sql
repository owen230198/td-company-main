-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 15, 2024 at 08:41 AM
-- Server version: 8.0.39-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `td_company`
--

-- --------------------------------------------------------

--
-- Table structure for table `extend_warehouses`
--

CREATE TABLE `extend_warehouses` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ver` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `act` tinyint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `extend_warehouses`
--

INSERT INTO `extend_warehouses` (`id`, `name`, `ver`, `qty`, `unit`, `type`, `note`, `status`, `act`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'Băng dính trắng', '1cm', '204', 'hank', 1, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(2, 'Băng dính 2 mặt', '0.5cm', '316', 'hank', 1, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-08-12 07:37:29', 25),
(3, 'Băng dính 2 mặt', '1cm', '106', 'hank', 1, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-08-09 16:56:00', 25),
(4, 'Băng dính 2 mặt', '5cm', '2', 'hank', 1, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(5, 'Băng dính trắng', '4.8cm', '86', 'hank', 1, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-08-15 07:52:10', 25),
(6, 'Băng dính góc', '1.9cm', '96', 'hank', 2, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(7, 'Băng dính góc', '1.9cm', '48', 'hank', 3, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(8, 'Bóng kính', '50x70', '195', 'sheet', 1, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(9, 'Chun', NULL, '6.5', 'kg', 1, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(10, 'Chun', NULL, '10', 'kg', 1, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-08-09 17:00:12', 25),
(11, 'Gân', '0.5', '6', 'bottle', 1, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(12, 'Gân', '0.5', '300', 'unit', 1, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(13, 'Lọ nhỏ keo', NULL, '4', 'jar', 1, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(14, 'Dây tết vàng nhỏ', '35cm', '3000', 'duo', 4, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(15, 'Dây đen nhỏ', '35cm', '1000', 'duo', 5, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(16, 'Dây đỏ nhỏ', '35cm', '18700', 'duo', 5, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(17, 'Dây nâu to', '35cm', '2000', 'duo', 6, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(18, 'Dây Ruy băng 048', '35cm', '5000', 'duo', 7, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(19, 'Dây Ruy băng  049', '35cm', '2105', 'duo', 7, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-08-08 14:55:46', 25),
(20, 'Dây Ruy băng  051', '35cm', '3860', 'duo', 7, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-08-08 14:56:16', 25),
(21, 'Dây Ruy băng  052', '35cm', '17150', 'duo', 7, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-08-08 16:23:53', 25),
(22, 'Dây Ruy băng  053', '35cm', '18950', 'duo', 7, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-08-08 16:23:34', 25),
(23, 'DâyRuy băng 054', '35cm', '20000', 'duo', 7, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(24, 'Dây Ruy băng 055', '35cm', '19610', 'duo', 7, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-08-08 16:23:05', 25),
(25, 'Dây  Ruy băng  056', '35cm', '5000', 'duo', 7, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(26, 'Dây  Ruy băng 057', '35cm', '20000', 'duo', 7, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(27, 'Dây  Ruy băng  060', '35cm', '20000', 'duo', 7, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(28, 'Dây xoắn đỏ to', '35cm', '2000', 'duo', 8, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(29, 'Dây xoắn trắng to', '35cm', '700', 'duo', 8, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(30, 'Dây dù xanh nhỏ', '35cm', '100', 'duo', 5, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(31, 'Dây xoắn xanh to', '35cm', '200', 'duo', 8, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(32, 'Keo 201', NULL, '220', 'kg', 9, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(33, 'Keo 508', NULL, '850', 'kg', 10, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-31 14:26:01', 25),
(34, 'keo 301', NULL, '7000', 'kg', 10, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(35, 'Keo đỉnh vàng ', NULL, '19', 'kg', 11, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-08-08 16:24:18', 25),
(36, 'Keo KCM2', NULL, '250', 'kg', 12, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(37, 'Keo đỏ', NULL, '60', 'kg', 9, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(38, 'Keo 905', NULL, '425', 'kg', 13, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(39, 'Keo 881', NULL, '270', 'kg', 9, 'Nhập từ Misa', 'imported', 1, '2024-08-05 10:50:12', '2024-08-05 10:50:12', 13),
(40, 'Keo 6682', NULL, '100', 'kg', 14, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(41, 'Keo 201A', NULL, '40', 'kg', 9, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(42, 'Mực đen', NULL, '130', 'kg', 15, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(43, 'Mực đỏ cờ', NULL, '40', 'kg', 15, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(44, 'Mực phủ mờ', NULL, '120', 'kg', 16, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(45, 'Mực chờ khô màu đen', NULL, '10', 'kg', 16, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(46, 'Mực chờ khô  màu đỏ', NULL, '30', 'kg', 16, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(47, 'Mực chờ khô màu trắng', NULL, '40', 'kg', 16, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(48, 'Mực chờ khô màu vàng', NULL, '30', 'kg', 16, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(49, 'Mực chờ khô màu xanh', NULL, '60', 'kg', 16, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(50, 'Mực nhũ bạc', NULL, '20', 'kg', 15, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(51, 'Mực vàng ', NULL, '40', 'kg', 15, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(52, 'Mực xanh', NULL, '70', 'kg', 15, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(53, 'Mực đỏ', NULL, '30', 'kg', 15, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(54, 'Sữa rửa bản kẽm', NULL, '24', 'cm', 17, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(55, 'Dung dịch ẩm', NULL, '75', 'cm', 18, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(56, 'Nước rửa máy', NULL, '60', 'cm', 19, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(57, 'Máy 5m', NULL, '1', 'plate', 20, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(58, 'Máy 2m', NULL, '6', 'plate', 20, 'Nhập từ Misa', 'imported', 1, '2024-07-24 16:08:46', '2024-07-24 16:08:46', 25),
(59, 'gôm 5lit', 'lít', '5', NULL, 22, NULL, 'imported', 1, '2024-07-30 08:17:03', '2024-07-30 08:17:03', 13),
(60, 'kẽm', NULL, '500', 'plate', 21, NULL, 'imported', 1, '2024-07-30 09:19:40', '2024-07-30 09:19:40', 13),
(61, 'ô nhê túi 10 gói', NULL, '10', NULL, 25, NULL, 'imported', 1, '2024-07-30 11:07:27', '2024-07-30 11:07:27', 13),
(62, 'mực sần (cho UV )', NULL, '5', 'kg', 27, NULL, 'imported', 1, '2024-07-30 14:11:49', '2024-07-30 14:11:49', 13),
(63, 'tẩy bóng ma (uv)', NULL, '2', 'kg', 28, NULL, 'imported', 1, '2024-07-30 14:11:49', '2024-07-30 14:11:49', 13),
(64, 'nhũ tương Pluss 7000 kèm bắt sáng', NULL, '3', 'kg', 29, NULL, 'imported', 1, '2024-07-30 14:11:49', '2024-07-30 14:11:49', 13),
(65, 'keo 305', NULL, '1250', 'kg', 10, NULL, 'imported', 1, '2024-08-05 10:50:12', '2024-08-05 10:50:12', 13),
(66, 'dây vàng đậm', NULL, '2000', 'duo', 8, NULL, 'imported', 1, '2024-08-05 10:54:54', '2024-08-05 10:54:54', 13),
(67, 'gân 0.5', NULL, '10', 'bottle', 1, NULL, 'imported', 1, '2024-08-05 10:56:09', '2024-08-05 10:56:09', 13),
(68, 'lọ nhỏ keo', NULL, '50', NULL, 1, NULL, 'imported', 1, '2024-08-05 11:06:53', '2024-08-05 11:06:53', 13),
(69, 'dây trắng to', 'nhê 5', '10100', 'duo', 6, NULL, 'imported', 1, '2024-08-05 11:19:47', '2024-08-05 11:19:47', 13),
(70, 'dung môi pha Uv', NULL, '4', 'kg', 26, NULL, 'imported', 1, '2024-08-05 14:31:54', '2024-08-05 14:31:54', 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `extend_warehouses`
--
ALTER TABLE `extend_warehouses`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `extend_warehouses`
--
ALTER TABLE `extend_warehouses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
