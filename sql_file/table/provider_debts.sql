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

 Date: 21/01/2025 22:23:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for provider_debts
-- ----------------------------
DROP TABLE IF EXISTS `provider_debts`;
CREATE TABLE `provider_debts`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `supply` int NULL DEFAULT NULL,
  `provider` int NULL DEFAULT NULL,
  `price` float NULL DEFAULT NULL,
  `other_price` float NULL DEFAULT 0,
  `total` float NULL DEFAULT NULL,
  `advance` float NULL DEFAULT NULL,
  `qty` float NULL DEFAULT NULL,
  `rest` float NULL DEFAULT NULL,
  `bill` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 931 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of provider_debts
-- ----------------------------
INSERT INTO `provider_debts` VALUES (931, 'CNVT-00000931', 'Cao su non ĐEN - TRẮNG - CSN -0.3cm ( KT 125 x 250cm ) - 125x250', 'debt', 155, 500, 0.00352, 700000, 4000000, 0, 100, 4000000, '{\"id\":\"8156\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/n_tables.sql\",\"name\":\"n_tables.sql\"}', NULL, 1, 23, '2025-01-21 21:49:24', '2025-01-21 21:49:24');
INSERT INTO `provider_debts` VALUES (932, 'CNVT-00000932', 'Cao su non ĐEN - TRẮNG - CSN -2.5cm ( KT 125 x 250 ) - 125x250', 'debt', 156, 508, 0.00352, 0, 27500000, 0, 100, 27500000, '{\"id\":\"8157\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/provider_prices.sql\",\"name\":\"provider_prices.sql\"}', NULL, 1, 23, '2025-01-21 21:50:26', '2025-01-21 21:50:26');
INSERT INTO `provider_debts` VALUES (933, 'CNVT-00000933', 'Cao su non ĐEN - TRẮNG - CSN -1cm ( KT 125 x 250 ) - 125x250', 'debt', 157, 503, 0.00352, 0, 1100000, 0, 10, 1100000, '{\"id\":\"8158\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/supply_prices.sql\",\"name\":\"supply_prices.sql\"}', NULL, 1, 23, '2025-01-21 21:51:08', '2025-01-21 21:51:08');

SET FOREIGN_KEY_CHECKS = 1;
