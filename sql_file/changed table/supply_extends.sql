/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : td_company

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 13/07/2024 02:06:10
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
) ENGINE = InnoDB AUTO_INCREMENT = 64 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of supply_extends
-- ----------------------------
INSERT INTO `supply_extends` VALUES (56, 'Bóng kính', NULL, 1, '2024-07-11 22:17:22', '2024-07-12 22:11:42', 23);
INSERT INTO `supply_extends` VALUES (57, 'Chun vòng', NULL, 1, '2024-07-11 22:17:38', '2024-07-11 22:17:38', 23);
INSERT INTO `supply_extends` VALUES (58, 'Mực', NULL, 1, '2024-07-12 22:12:07', '2024-07-12 22:12:07', 23);
INSERT INTO `supply_extends` VALUES (59, 'Băng dính', NULL, 1, '2024-07-12 22:12:38', '2024-07-12 22:12:38', 23);
INSERT INTO `supply_extends` VALUES (60, 'Keo', NULL, 1, '2024-07-12 22:12:44', '2024-07-12 22:12:44', 23);
INSERT INTO `supply_extends` VALUES (61, 'Dây', NULL, 1, '2024-07-12 22:12:51', '2024-07-12 22:12:51', 23);
INSERT INTO `supply_extends` VALUES (62, 'Nhũ', NULL, 1, '2024-07-12 22:12:57', '2024-07-12 22:12:57', 23);
INSERT INTO `supply_extends` VALUES (63, 'Túi nilon', NULL, 1, '2024-07-12 23:11:05', '2024-07-12 23:11:05', 23);

SET FOREIGN_KEY_CHECKS = 1;
