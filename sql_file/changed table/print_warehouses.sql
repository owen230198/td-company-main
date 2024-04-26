/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : td_company

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 26/04/2024 10:26:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for print_warehouses
-- ----------------------------
DROP TABLE IF EXISTS `print_warehouses`;
CREATE TABLE `print_warehouses`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `length` float NULL DEFAULT NULL,
  `width` float NULL DEFAULT NULL,
  `qtv` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `qty` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `supp_price` int(0) NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `source` tinyint(0) NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 113 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of print_warehouses
-- ----------------------------
INSERT INTO `print_warehouses` VALUES (45, 'C', 51, 48.6, '120', '60000', 'paper', 12, 'imported', NULL, NULL, 1, '2023-09-23 15:55:00', '2023-09-23 17:57:56', 10);
INSERT INTO `print_warehouses` VALUES (46, 'C', 50.3, 55.5, '148', '68000', 'paper', 12, 'imported', NULL, NULL, 1, '2023-11-21 11:21:00', '2023-11-21 11:21:00', 7);
INSERT INTO `print_warehouses` VALUES (47, 'C', 50.3, 51, '150', '48631', 'paper', 12, 'imported', NULL, NULL, 1, '2023-12-25 20:34:10', '2023-12-25 20:34:10', 16);
INSERT INTO `print_warehouses` VALUES (51, 'C', 51, 55.5, '150', '72110', 'paper', 12, 'imported', NULL, NULL, 1, '2024-01-04 16:44:40', '2024-01-04 16:44:40', 16);
INSERT INTO `print_warehouses` VALUES (52, 'C', 51, 56, '150', '5200', 'paper', 12, 'imported', NULL, NULL, 1, '2023-09-23 18:00:00', '2023-09-23 18:00:00', 1);
INSERT INTO `print_warehouses` VALUES (53, 'C', 51, 51, '150', '5200', 'paper', 12, 'imported', NULL, NULL, 1, '2023-09-23 18:00:10', '2023-09-23 18:00:10', 1);
INSERT INTO `print_warehouses` VALUES (54, 'C', 51, 44, '150', '3545', 'paper', 12, 'imported', NULL, NULL, 1, '2023-09-23 18:00:26', '2023-12-12 23:05:32', 1);
INSERT INTO `print_warehouses` VALUES (59, 'c150', 10, 30, '150', '2500', 'paper', 12, 'waiting', 2, NULL, 1, '2023-09-24 10:59:53', '2023-09-24 10:59:53', 6);
INSERT INTO `print_warehouses` VALUES (64, 'C', 51, 48.5, '120', '60000', 'paper', 12, 'imported', NULL, NULL, 1, '2023-09-24 15:38:40', '2023-09-24 15:38:40', 1);
INSERT INTO `print_warehouses` VALUES (65, 'C', 50.3, 55.5, '150', '66000', 'paper', 12, 'imported', NULL, NULL, 1, '2023-09-24 15:39:19', '2023-09-24 15:39:37', 1);
INSERT INTO `print_warehouses` VALUES (66, 'C', 50.3, 51, '150', '46500', 'paper', 12, 'imported', NULL, NULL, 1, '2023-09-24 15:39:59', '2023-09-24 15:39:59', 1);
INSERT INTO `print_warehouses` VALUES (70, 'I250 TÚI MÃ B', 102, 51, '250', '120000', 'paper', 13, 'imported', NULL, NULL, 1, '2023-10-06 09:18:42', '2023-10-06 09:18:42', 7);
INSERT INTO `print_warehouses` VALUES (71, 'I250 TÚI MÃ A', 102, 57, '250', '130760', 'paper', 13, 'imported', NULL, NULL, 1, '2023-10-06 09:06:34', '2023-10-06 09:06:34', 7);
INSERT INTO `print_warehouses` VALUES (72, 'I250 TÚI MÃ C', 102, 44, '250', '120000', 'paper', 13, 'imported', NULL, NULL, 1, '2023-10-06 09:03:17', '2023-10-06 09:03:17', 7);
INSERT INTO `print_warehouses` VALUES (73, 'C120 NẮP MÃ C', 50, 44, '120', '87020', 'paper', 12, 'imported', NULL, NULL, 1, '2023-10-01 12:17:28', '2023-10-01 12:17:28', 1);
INSERT INTO `print_warehouses` VALUES (74, 'C120 ĐÁY MÃ C', 50, 42, '120', '87020', 'paper', 12, 'imported', NULL, NULL, 1, '2023-10-01 12:18:21', '2023-10-01 12:18:21', 1);
INSERT INTO `print_warehouses` VALUES (75, 'C120 ĐÁY MÃ A', 54.5, 48.5, '120', '74300', 'paper', 12, 'imported', NULL, NULL, 1, '2023-10-01 12:19:43', '2023-10-01 12:19:43', 1);
INSERT INTO `print_warehouses` VALUES (77, 'C120 khay thuyền', 62, 50.5, '120', '50000', 'paper', 12, 'imported', NULL, NULL, 1, '2023-10-06 09:30:05', '2023-10-06 09:30:05', 7);
INSERT INTO `print_warehouses` VALUES (78, NULL, 11, 11, '150', '3360', 'paper', 12, 'waiting', 2, NULL, 1, '2023-12-09 10:11:59', '2023-12-09 10:11:59', 6);
INSERT INTO `print_warehouses` VALUES (79, NULL, 11, 11, '150', '890', 'paper', 12, 'waiting', 2, NULL, 1, '2023-12-09 10:12:33', '2023-12-09 10:12:33', 6);
INSERT INTO `print_warehouses` VALUES (80, NULL, 11, 11, '150', '1655', 'paper', 12, 'waiting', 2, NULL, 1, '2023-12-09 10:12:53', '2023-12-09 10:12:53', 6);
INSERT INTO `print_warehouses` VALUES (81, 'ivory 300', 600, 200, '300', '7251', 'paper', 13, 'imported', NULL, NULL, 1, '2023-12-09 11:46:58', '2024-02-20 14:32:58', 7);
INSERT INTO `print_warehouses` VALUES (82, NULL, 11, 10, '300', '1630', 'paper', 13, 'waiting', 2, NULL, 1, '2023-12-09 11:48:10', '2023-12-09 11:48:10', 6);
INSERT INTO `print_warehouses` VALUES (83, NULL, 11, 11, '150', '560', 'paper', 12, 'waiting', 2, NULL, 1, '2024-01-03 04:32:31', '2024-01-03 04:32:31', 6);
INSERT INTO `print_warehouses` VALUES (84, 'I300', 89.5, 74, '300', '100', 'paper', 13, 'imported', NULL, NULL, 1, '2024-02-29 10:51:03', '2024-03-01 14:45:16', 13);
INSERT INTO `print_warehouses` VALUES (85, 'I300', 74.5, 62, '300', '100', 'paper', 13, 'imported', NULL, NULL, 1, '2024-02-29 10:53:23', '2024-03-01 14:45:36', 13);
INSERT INTO `print_warehouses` VALUES (86, 'I300', 102, 37.5, '300', '100', 'paper', 13, 'imported', NULL, NULL, 1, '2024-02-29 10:57:22', '2024-03-01 14:08:03', 13);
INSERT INTO `print_warehouses` VALUES (87, 'I300', 65, 94.5, '300', '13150', 'paper', 13, 'imported', NULL, NULL, 1, '2024-03-18 16:45:28', '2024-03-18 16:45:28', 13);
INSERT INTO `print_warehouses` VALUES (88, 'I300', 92.5, 65, '300', '5900', 'paper', 13, 'imported', NULL, NULL, 1, '2024-03-01 10:44:47', '2024-03-01 14:55:14', 24);
INSERT INTO `print_warehouses` VALUES (89, 'C80', 54.5, 39.5, '80', '12', 'paper', 12, 'imported', NULL, NULL, 1, '2024-04-24 11:17:25', '2024-04-24 13:27:44', 13);
INSERT INTO `print_warehouses` VALUES (90, 'I230', 48, 44, '230', '90', 'paper', 13, 'imported', NULL, NULL, 1, '2024-04-09 10:41:19', '2024-04-09 16:37:31', 13);
INSERT INTO `print_warehouses` VALUES (91, 'I400', 51, 30, '400', '700', 'paper', 13, 'imported', NULL, NULL, 1, '2024-04-09 10:46:01', '2024-04-09 16:37:21', 13);
INSERT INTO `print_warehouses` VALUES (92, 'C120', 55.5, 35.5, '120', '4330', 'paper', 12, 'imported', NULL, NULL, 1, '2024-04-09 10:56:15', '2024-04-09 10:56:15', 13);
INSERT INTO `print_warehouses` VALUES (93, 'C120', 62, 43, '120', '2320', 'paper', 12, 'imported', NULL, NULL, 1, '2024-04-11 08:32:55', '2024-04-11 08:32:55', 13);
INSERT INTO `print_warehouses` VALUES (94, 'C150', 62, 43, '150', '620', 'paper', 12, 'imported', NULL, NULL, 1, '2024-04-11 08:34:33', '2024-04-11 08:34:33', 13);
INSERT INTO `print_warehouses` VALUES (95, 'C300', 54.5, 39.5, '300', '220', 'paper', 12, 'imported', NULL, NULL, 1, '2024-04-11 08:35:14', '2024-04-11 08:35:14', 13);
INSERT INTO `print_warehouses` VALUES (96, 'C120', 54.5, 39.5, '120', '2100', 'paper', 12, 'imported', NULL, NULL, 1, '2024-04-11 08:35:57', '2024-04-11 08:35:57', 13);
INSERT INTO `print_warehouses` VALUES (97, 'C120', 54.5, 46, '120', '3566', 'paper', 12, 'imported', NULL, NULL, 1, '2024-04-12 09:17:15', '2024-04-12 09:17:15', 13);
INSERT INTO `print_warehouses` VALUES (98, 'C120', 48, 36.3, '120', '4300', 'paper', 12, 'imported', NULL, NULL, 1, '2024-04-12 09:17:57', '2024-04-12 09:17:57', 13);
INSERT INTO `print_warehouses` VALUES (99, 'C120', 54.5, 32.5, '120', '2000', 'paper', 12, 'imported', NULL, NULL, 1, '2024-04-12 09:18:58', '2024-04-12 09:18:58', 13);
INSERT INTO `print_warehouses` VALUES (100, 'C120', 69.5, 36, '120', '3600', 'paper', 12, 'imported', NULL, NULL, 1, '2024-04-24 10:03:09', '2024-04-24 10:03:09', 13);
INSERT INTO `print_warehouses` VALUES (101, 'I400', 39.5, 38, '400', '1400', 'paper', 13, 'imported', NULL, NULL, 1, '2024-04-24 10:04:03', '2024-04-24 10:04:03', 13);
INSERT INTO `print_warehouses` VALUES (102, 'I400', 45, 40.5, '400', '10', 'paper', 13, 'imported', NULL, NULL, 1, '2024-04-24 10:07:52', '2024-04-24 10:52:04', 13);
INSERT INTO `print_warehouses` VALUES (103, 'I400', 59.5, 48, '400', '35', 'paper', 13, 'imported', NULL, NULL, 1, '2024-04-24 10:13:29', '2024-04-24 10:44:34', 13);
INSERT INTO `print_warehouses` VALUES (104, 'I300', 53, 43, '300', '1650', 'paper', 13, 'imported', NULL, NULL, 1, '2024-04-24 10:19:58', '2024-04-24 10:19:58', 13);
INSERT INTO `print_warehouses` VALUES (105, 'C120', 54.5, 32.5, '120', '10450', 'paper', 12, 'imported', NULL, NULL, 1, '2024-04-24 10:22:42', '2024-04-24 10:22:42', 13);
INSERT INTO `print_warehouses` VALUES (106, 'I350', 46, 32.5, '350', '2630', 'paper', 13, 'imported', NULL, NULL, 1, '2024-04-24 10:24:55', '2024-04-24 10:24:55', 13);
INSERT INTO `print_warehouses` VALUES (107, 'op 70', 65, 43, '70', '0', 'paper', 15, 'imported', NULL, NULL, 1, '2024-04-24 11:31:46', '2024-04-24 13:27:47', 13);
INSERT INTO `print_warehouses` VALUES (108, 'I400', 54.5, 43.5, '400', '1730', 'paper', 13, 'imported', NULL, NULL, 1, '2024-04-25 09:16:05', '2024-04-25 09:16:05', 13);
INSERT INTO `print_warehouses` VALUES (109, 'I400', 52.5, 32, '400', '738', 'paper', 13, 'imported', NULL, NULL, 1, '2024-04-25 09:18:31', '2024-04-25 09:18:31', 13);
INSERT INTO `print_warehouses` VALUES (110, 'duplex 450', 69, 48, '450', '50000', 'paper', 14, 'imported', NULL, NULL, 1, '2024-04-25 10:42:34', '2024-04-25 10:42:34', 13);
INSERT INTO `print_warehouses` VALUES (111, 'duplex 450', 88.9, 55, '450', '50000', 'paper', 14, 'imported', NULL, NULL, 1, '2024-04-25 10:48:12', '2024-04-25 10:48:12', 13);
INSERT INTO `print_warehouses` VALUES (112, 'duplex 450', 89, 69, '450', '50000', 'paper', 14, 'imported', NULL, NULL, 1, '2024-04-25 10:49:16', '2024-04-25 10:49:16', 13);

SET FOREIGN_KEY_CHECKS = 1;
