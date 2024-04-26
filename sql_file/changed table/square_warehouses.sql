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

 Date: 26/04/2024 20:35:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for square_warehouses
-- ----------------------------
DROP TABLE IF EXISTS `square_warehouses`;
CREATE TABLE `square_warehouses`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `width` float NULL DEFAULT NULL,
  `qty` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `supp_price` int(0) NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of square_warehouses
-- ----------------------------
INSERT INTO `square_warehouses` VALUES (1, 'Màng nilon mờ', 70, '39143', 'nilon', 9, 'imported', NULL, 1, '2023-09-23 16:18:36', '2023-09-29 14:11:58', 1);
INSERT INTO `square_warehouses` VALUES (2, 'Nilon mờ ( đã gọi )', 71.5, '62420', 'nilon', 9, 'imported', NULL, 1, '2023-09-24 16:08:00', '2023-12-12 23:08:20', 1);
INSERT INTO `square_warehouses` VALUES (3, 'mang nilon test', 11, '1111', 'nilon', 9, 'imported', NULL, 1, '2023-09-25 23:37:00', '2023-09-25 23:37:00', 7);
INSERT INTO `square_warehouses` VALUES (4, 'nilon mờ ( test )', 100, '0', 'nilon', 9, 'imported', NULL, 1, '2024-01-04 16:44:40', '2024-03-01 13:52:31', 16);
INSERT INTO `square_warehouses` VALUES (5, 'màng mờ', 50.5, '530000', 'nilon', 9, 'imported', NULL, 1, '2023-10-07 08:29:35', '2023-10-07 08:29:35', 7);
INSERT INTO `square_warehouses` VALUES (6, 'màng mờ', 101, '417215', 'nilon', 9, 'imported', NULL, 1, '2023-10-07 08:49:10', '2024-03-01 14:44:07', 7);
INSERT INTO `square_warehouses` VALUES (7, 'màng bóng', 93.5, '385500', 'nilon', 8, 'imported', NULL, 1, '2024-03-01 14:37:47', '2024-03-01 14:55:11', 13);
INSERT INTO `square_warehouses` VALUES (8, 'màng bóng', 101, '525250', 'nilon', 8, 'imported', NULL, 1, '2024-03-01 14:46:25', '2024-03-01 14:46:38', 13);
INSERT INTO `square_warehouses` VALUES (9, 'màng mờ', 93.5, '463050', 'nilon', 9, 'imported', NULL, 1, '2024-03-01 14:35:03', '2024-03-01 14:45:27', 13);
INSERT INTO `square_warehouses` VALUES (10, 'màng bóng', 73.5, '508280', 'nilon', 8, 'imported', NULL, 1, '2024-03-01 14:25:50', '2024-03-01 14:45:33', 13);
INSERT INTO `square_warehouses` VALUES (11, 'màng mờ', 73.5, '530000', 'nilon', 9, 'imported', NULL, 1, '2024-03-01 14:24:34', '2024-03-01 14:24:34', 13);
INSERT INTO `square_warehouses` VALUES (12, 'màng bóng', 88.5, '381680', 'nilon', 8, 'imported', NULL, 1, '2024-03-01 14:39:44', '2024-03-01 14:44:13', 13);
INSERT INTO `square_warehouses` VALUES (13, 'màng bóng', 46, '500', 'nilon', 8, 'imported', NULL, 1, '2024-04-09 16:31:47', '2024-04-09 16:37:25', 13);
INSERT INTO `square_warehouses` VALUES (14, 'màng bóng', 52, '73163', 'nilon', 8, 'imported', NULL, 1, '2024-04-09 16:35:58', '2024-04-09 16:37:14', 13);
INSERT INTO `square_warehouses` VALUES (15, 'màng mờ', 62, '205848', 'nilon', 9, 'imported', NULL, 1, '2024-04-24 10:36:22', '2024-04-24 10:44:30', 13);
INSERT INTO `square_warehouses` VALUES (16, 'màng mờ', 49.5, '534440', 'nilon', 9, 'imported', NULL, 1, '2024-04-24 10:45:49', '2024-04-24 10:52:16', 13);
INSERT INTO `square_warehouses` VALUES (17, 'màng mờ', 54, '530000', 'nilon', 9, 'imported', NULL, 1, '2024-04-24 13:49:06', '2024-04-24 13:49:06', 13);
INSERT INTO `square_warehouses` VALUES (18, 'màng mờ', 101, '15790000', 'nilon', 9, 'imported', NULL, 1, '2024-04-25 08:47:43', '2024-04-25 08:47:43', 13);
INSERT INTO `square_warehouses` VALUES (19, 'màng mờ', 43, '1560000', 'nilon', 9, 'imported', NULL, 1, '2024-04-25 08:48:51', '2024-04-25 08:48:51', 13);
INSERT INTO `square_warehouses` VALUES (20, 'màng mờ', 55, '1160000', 'nilon', 9, 'imported', NULL, 1, '2024-04-25 08:50:09', '2024-04-25 08:50:09', 13);
INSERT INTO `square_warehouses` VALUES (21, 'màng mờ', 46, '510000', 'nilon', 9, 'imported', NULL, 1, '2024-04-25 08:51:00', '2024-04-25 08:51:00', 13);
INSERT INTO `square_warehouses` VALUES (22, 'màng mờ', 36, '500000', 'nilon', 9, 'imported', NULL, 1, '2024-04-25 08:51:40', '2024-04-25 08:51:40', 13);
INSERT INTO `square_warehouses` VALUES (23, 'màng mờ', 65, '740000', 'nilon', 9, 'imported', NULL, 1, '2024-04-25 08:53:17', '2024-04-25 08:53:17', 13);
INSERT INTO `square_warehouses` VALUES (24, 'màng mờ', 79, '240000', 'nilon', 9, 'imported', NULL, 1, '2024-04-25 08:54:12', '2024-04-25 08:54:12', 13);
INSERT INTO `square_warehouses` VALUES (25, 'màng bóng', 78, '500000', 'nilon', 8, 'imported', NULL, 1, '2024-04-25 09:02:11', '2024-04-25 09:02:11', 13);
INSERT INTO `square_warehouses` VALUES (26, 'màng bóng', 62, '520000', 'nilon', 8, 'imported', NULL, 1, '2024-04-25 09:02:40', '2024-04-25 09:02:40', 13);
INSERT INTO `square_warehouses` VALUES (27, 'màng bóng', 43, '1340000', 'nilon', 8, 'imported', NULL, 1, '2024-04-25 09:04:15', '2024-04-25 09:04:15', 13);
INSERT INTO `square_warehouses` VALUES (28, 'màng bóng', 57, '530000', 'nilon', 8, 'imported', NULL, 1, '2024-04-25 09:10:09', '2024-04-25 09:10:09', 13);
INSERT INTO `square_warehouses` VALUES (29, 'màng bóng', 69, '510000', 'nilon', 8, 'imported', NULL, 1, '2024-04-25 09:11:08', '2024-04-25 09:11:08', 13);

SET FOREIGN_KEY_CHECKS = 1;
