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

 Date: 10/01/2025 17:04:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for provider_prices
-- ----------------------------
DROP TABLE IF EXISTS `provider_prices`;
CREATE TABLE `provider_prices`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Mã nhóm',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `supp_price` int NULL DEFAULT NULL,
  `provider` int NULL DEFAULT NULL,
  `price` double NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Ghi chú',
  `act` tinyint NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `type_index`(`provider` ASC) USING BTREE,
  INDEX `carton_foam_index`(`price` ASC) USING BTREE,
  INDEX `name_index`(`name` ASC) USING BTREE,
  INDEX `act_indx`(`act` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 270 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of provider_prices
-- ----------------------------
INSERT INTO `provider_prices` VALUES (270, 'GIẤY ANH ĐẠT', 271, 49, 0.0021, NULL, 1, '2025-01-10 16:27:26', '2025-01-10 16:27:26', 23);
INSERT INTO `provider_prices` VALUES (271, 'GIẤY VẠN PHÚ GIA', 271, 50, 0.0022, NULL, 1, '2025-01-10 16:27:26', '2025-01-10 16:27:26', 23);
INSERT INTO `provider_prices` VALUES (272, 'GIẤY NGỌC VIỆT', 271, 51, 0.0023, NULL, 1, '2025-01-10 16:27:26', '2025-01-10 16:27:26', 23);

SET FOREIGN_KEY_CHECKS = 1;
