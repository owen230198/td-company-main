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

 Date: 21/01/2025 22:23:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for warehouse_histories
-- ----------------------------
DROP TABLE IF EXISTS `warehouse_histories`;
CREATE TABLE `warehouse_histories`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `target` int NULL DEFAULT NULL,
  `imported` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ex_inventory` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `exported` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `inventory` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `provider` int NULL DEFAULT NULL,
  `price` float NULL DEFAULT NULL,
  `other_price` float NULL DEFAULT NULL,
  `bill` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `act` tinyint NULL DEFAULT NULL,
  `total` float NULL DEFAULT NULL,
  `buying_item` int NULL DEFAULT NULL,
  `product` int NULL DEFAULT NULL,
  `c_supply` int NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name`(`name` ASC, `created_at` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3821 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of warehouse_histories
-- ----------------------------
INSERT INTO `warehouse_histories` VALUES (1, NULL, 'Cao su non ĐEN - TRẮNG - CSN -0.3cm ( KT 125 x 250cm ) - 125x250', 155, '100', '300', '0', '395', NULL, 500, 0.00352, 700000, '{\"id\":\"8156\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/n_tables.sql\",\"name\":\"n_tables.sql\"}', 1, 4000000, 12, 0, NULL, 23, '2025-01-21 21:49:24', '2025-01-21 21:49:24');
INSERT INTO `warehouse_histories` VALUES (2, NULL, 'Cao su non ĐEN - TRẮNG - CSN -2.5cm ( KT 125 x 250 ) - 125x250', 156, '100', '0', '0', '403', NULL, 508, 0.00352, 0, '{\"id\":\"8157\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/provider_prices.sql\",\"name\":\"provider_prices.sql\"}', 1, 27500000, 11, 0, NULL, 23, '2025-01-21 21:50:26', '2025-01-21 21:50:26');
INSERT INTO `warehouse_histories` VALUES (3, NULL, 'Cao su non ĐEN - TRẮNG - CSN -1cm ( KT 125 x 250 ) - 125x250', 157, '10', '0', '0', '398', NULL, 503, 0.00352, 0, '{\"id\":\"8158\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/supply_prices.sql\",\"name\":\"supply_prices.sql\"}', 1, 1100000, 10, 0, NULL, 23, '2025-01-21 21:51:08', '2025-01-21 21:51:08');

SET FOREIGN_KEY_CHECKS = 1;
