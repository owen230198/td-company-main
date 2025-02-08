/*
 Navicat Premium Data Transfer

 Source Server         : tuandung_dev
 Source Server Type    : MySQL
 Source Server Version : 50740
 Source Host           : 103.173.66.233:3306
 Source Schema         : sql_tuandung_dev

 Target Server Type    : MySQL
 Target Server Version : 50740
 File Encoding         : 65001

 Date: 20/01/2025 11:35:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for supply_types
-- ----------------------------
DROP TABLE IF EXISTS `supply_types`;
CREATE TABLE `supply_types`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã nhóm',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Tên nhóm',
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Cha',
  `factor` bigint(20) NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Ghi chú',
  `act` tinyint(4) NULL DEFAULT NULL,
  `ord` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `is_name` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name_index`(`name`) USING BTREE,
  INDEX `type_index`(`type`) USING BTREE,
  INDEX `act_indx`(`act`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of supply_types
-- ----------------------------
INSERT INTO `supply_types` VALUES (8, 'Mút phẳng K40', 'styrofoam', 0, NULL, 1, NULL, '2023-07-20 10:21:00', '2025-01-16 16:38:32', 1, 0);
INSERT INTO `supply_types` VALUES (9, 'Mút phẳng K30', 'styrofoam', 0, NULL, 1, NULL, '2023-07-20 10:21:00', '2025-01-16 16:20:22', 1, 0);
INSERT INTO `supply_types` VALUES (10, 'Mút phẳng K21', 'styrofoam', 0, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 0);
INSERT INTO `supply_types` VALUES (21, 'CARTON 2 MẶT THƯỜNG', 'carton', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2025-01-16 16:52:08', 1, 0);
INSERT INTO `supply_types` VALUES (37, 'MÀNG PET', 'mica', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2025-01-16 20:23:26', 1, 0);
INSERT INTO `supply_types` VALUES (38, 'KHAY ĐỊNH HÌNH', 'paper', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 1);
INSERT INTO `supply_types` VALUES (39, 'TỜ BỒI THÀNH', 'paper', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 1);
INSERT INTO `supply_types` VALUES (40, 'TỜ BỒI KHAY', 'paper', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 1);
INSERT INTO `supply_types` VALUES (41, 'TỜ BỒI MẶT THÉP', 'paper', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 1);
INSERT INTO `supply_types` VALUES (42, 'TỜ BỒI NẮP HỘP', 'paper', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 1);
INSERT INTO `supply_types` VALUES (43, 'TỜ BỒI ĐÁY HỘP', 'paper', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 1);
INSERT INTO `supply_types` VALUES (44, 'TEM CUỘN', 'paper', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 1);
INSERT INTO `supply_types` VALUES (45, 'TOA IN GHÉP', 'paper', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 1);
INSERT INTO `supply_types` VALUES (48, 'SÓNG E', 'carton', NULL, NULL, 1, NULL, '2023-08-30 09:32:57', '2025-01-16 16:53:16', 1, 1);
INSERT INTO `supply_types` VALUES (51, 'Cao su non ĐEN - TRẮNG', 'rubber', NULL, NULL, 1, NULL, '2024-10-23 16:06:36', '2025-01-16 16:43:38', 1, 0);

SET FOREIGN_KEY_CHECKS = 1;
