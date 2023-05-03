-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 01, 2023 at 12:57 PM
-- Server version: 10.3.38-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nhwebbs9_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE `papers` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `product_qty` bigint(20) DEFAULT NULL,
  `nqty` int(10) DEFAULT NULL,
  `supp_qty` bigint(20) DEFAULT NULL,
  `size` text DEFAULT NULL,
  `print` text DEFAULT NULL,
  `nilon` text DEFAULT NULL,
  `elevate` text DEFAULT NULL,
  `peel` text DEFAULT NULL,
  `box_paste` text DEFAULT NULL,
  `metalai` text DEFAULT NULL,
  `compress` text DEFAULT NULL,
  `float` text DEFAULT NULL,
  `uv` text DEFAULT NULL,
  `ext_price` text DEFAULT NULL,
  `total_cost` varchar(20) DEFAULT NULL,
  `product` int(10) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `main` tinyint(4) DEFAULT NULL,
  `act` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `papers`
--

INSERT INTO `papers` (`id`, `name`, `product_qty`, `nqty`, `supp_qty`, `size`, `print`, `nilon`, `elevate`, `peel`, `box_paste`, `metalai`, `compress`, `float`, `uv`, `ext_price`, `total_cost`, `product`, `note`, `main`, `act`, `created_at`, `updated_at`, `created_by`) VALUES
(14, 'Hộp Tuấn Dung 1-5', 10000, 2, 5000, '{\"materal\":\"other\",\"qttv\":\"400\",\"length\":\"43\",\"width\":\"65\",\"unit_price\":\"0.0003\",\"materal_price\":0.0003,\"supp_qty\":5150,\"act\":1,\"total\":1727309.9999999998}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"supp_qty\":4030,\"model_price\":55000,\"work_price\":30,\"shape_price\":100000,\"printer\":2,\"act\":1,\"total\":1103600}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"47\",\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":5050,\"materal_price\":0.25,\"act\":1,\"total\":3578687.5}', '{\"ext_price\":\"100000\",\"machine\":\"4\",\"float\":{\"price\":\"100\",\"shape_price\":\"100000\",\"qty_pro\":10100,\"nqty\":2,\"float_cost\":1210000},\"model_price\":150,\"work_price\":120,\"shape_price\":150000,\"supp_qty\":5050,\"cost\":1175250,\"act\":1,\"total\":2485250}', '{\"machine\":\"12\",\"nqty\":\"1\",\"model_price\":0,\"work_price\":10,\"shape_price\":20000,\"qty_pro\":10100,\"act\":1,\"total\":121000}', '{\"machine\":\"6\",\"model_price\":0,\"work_price\":50,\"shape_price\":50000,\"qty_pro\":10100,\"act\":1,\"total\":555000}', '{\"materal\":\"1\",\"face\":\"1\",\"cover_materal\":\"5\",\"cover_face\":\"1\",\"machine\":\"15\",\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":5150,\"cover_supp_qty\":5080,\"materal_price\":0.36,\"metalai_price\":5231930,\"materal_cover_price\":0.23,\"metalai_cover_price\":3315678,\"act\":1,\"total\":8547608}', '{\"price\":\"100\",\"shape_price\":\"100000\",\"machine\":\"2\",\"qty_pro\":10100,\"nqty\":2,\"act\":1,\"total\":1210000}', NULL, '{\"face\":\"1\",\"materal\":\"10\",\"machine\":\"10\",\"model_price\":80,\"work_price\":600,\"shape_price\":150000,\"supp_qty\":5050,\"materal_price\":0,\"act\":1,\"total\":3403600}', '{\"temp_price\":\"100\",\"prescript_price\":\"200\",\"supp_price\":\"300\",\"qty_pro\":10000,\"act\":1,\"total\":6000000}', '28732055.5', 10, NULL, 1, 1, '2023-05-01 05:56:00', '2023-05-01 05:56:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `quote_indx` (`product`) USING BTREE,
  ADD KEY `main_index` (`main`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `papers`
--
ALTER TABLE `papers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
