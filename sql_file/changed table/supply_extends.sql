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

 Date: 11/07/2024 22:23:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for supply_extends
-- ----------------------------
DROP TABLE IF EXISTS `supply_extends`;
CREATE TABLE `supply_extends`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Mã nhóm',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Tên nhóm',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Ghi chú',
  `act` tinyint NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name_index`(`name` ASC) USING BTREE,
  INDEX `act_indx`(`act` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 58 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of supply_extends
-- ----------------------------
INSERT INTO `supply_extends` VALUES (56, 'Túi bóng', NULL, 1, '2024-07-11 22:17:22', '2024-07-11 22:17:22', 23);
INSERT INTO `supply_extends` VALUES (57, 'Chun vòng', NULL, 1, '2024-07-11 22:17:38', '2024-07-11 22:17:38', 23);

SET FOREIGN_KEY_CHECKS = 1;
