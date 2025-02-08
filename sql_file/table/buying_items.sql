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

 Date: 19/01/2025 23:08:01
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
  `deliveried` float NULL DEFAULT NULL,
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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

SET FOREIGN_KEY_CHECKS = 1;
