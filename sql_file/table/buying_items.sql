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

 Date: 16/01/2025 18:37:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for buying_items
-- ----------------------------
DROP TABLE IF EXISTS `buying_items`;
CREATE TABLE `buying_items`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parent` int NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `target` int NULL DEFAULT NULL,
  `qtv` int NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `width` float NULL DEFAULT NULL,
  `length` float NULL DEFAULT NULL,
  `qty` float NULL DEFAULT NULL,
  `lenth_qty` float NULL DEFAULT NULL,
  `weight` float NULL DEFAULT NULL,
  `sugg_provider` int NULL DEFAULT NULL,
  `sugg_price` float NULL DEFAULT NULL,
  `provider` int NULL DEFAULT NULL,
  `price` float NULL DEFAULT NULL,
  `total` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `contact_by` int NULL DEFAULT NULL,
  `applied_by` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of buying_items
-- ----------------------------
INSERT INTO `buying_items` VALUES (1, NULL, 925, 'paper', 13, 306, 'processing', 66, 33, 100, 33, 5.44503, 327, 0.00173, 327, 0.00173, '94199', NULL, 1, 23, NULL, NULL, '2025-01-16 15:06:16', '2025-01-16 17:33:25');
INSERT INTO `buying_items` VALUES (5, NULL, 925, 'paper', 13, 306, 'processing', 11, 11, 10000, 1100, 30.25, 327, 0.00173, 327, 0.00173, '523325', NULL, 1, 23, NULL, NULL, '2025-01-16 17:19:27', '2025-01-16 17:33:25');
INSERT INTO `buying_items` VALUES (6, NULL, 925, 'paper', 12, 288, 'processing', 55, 55, 10000, 5500, 242, 273, 0.00228, 273, 0.00228, '5517600', NULL, 1, 23, NULL, NULL, '2025-01-16 17:33:25', '2025-01-16 17:33:25');

SET FOREIGN_KEY_CHECKS = 1;
