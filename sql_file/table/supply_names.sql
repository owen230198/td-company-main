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

 Date: 20/01/2025 15:31:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for supply_names
-- ----------------------------
DROP TABLE IF EXISTS `supply_names`;
CREATE TABLE `supply_names`  (
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
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name_index`(`name`) USING BTREE,
  INDEX `type_index`(`type`) USING BTREE,
  INDEX `act_indx`(`act`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 72 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of supply_names
-- ----------------------------
INSERT INTO `supply_names` VALUES (49, 'CARTON BÌA', 'carton', 1, 'chỉ là tên vật tư cho lệnh sản xuất', 1, NULL, '2023-07-20 10:21:00', '2023-09-15 02:05:25', 1);
INSERT INTO `supply_names` VALUES (50, 'Carton THÀNH', 'carton', 2, 'chỉ là tên vật tư cho lệnh sản xuất', 1, NULL, '2023-07-20 10:21:00', '2023-09-15 02:49:21', 1);
INSERT INTO `supply_names` VALUES (51, 'Carton NẮP', 'carton', 2, 'chỉ là tên vật tư cho lệnh sản xuất', 1, NULL, '2023-07-20 10:21:00', '2023-09-15 04:25:55', 1);
INSERT INTO `supply_names` VALUES (52, 'CARTON ĐÁY', 'carton', 2, 'chỉ là tên vật tư cho lệnh sản xuất', 1, NULL, '2023-07-20 10:21:00', '2023-09-15 04:25:44', 1);
INSERT INTO `supply_names` VALUES (53, 'CARTON GHÉP NẮP + ĐÁY', 'carton', 4, 'chỉ là tên vật tư cho lệnh sản xuất', 1, NULL, '2023-07-20 10:21:00', '2023-09-15 04:25:31', 1);
INSERT INTO `supply_names` VALUES (54, 'CARTON KHAY ĐỊNH HÌNH', 'carton', 2, 'chỉ là tên vật tư cho lệnh sản xuất', 1, NULL, '2023-07-20 10:21:00', '2023-09-15 04:25:10', 1);
INSERT INTO `supply_names` VALUES (55, 'SÓNG E 3 lớp', 'carton', 2, 'chỉ là tên vật tư cho lệnh sản xuất', 1, NULL, '2023-10-06 08:09:30', '2023-10-06 08:09:30', 1);
INSERT INTO `supply_names` VALUES (56, 'Màng nhiệt', 'nilon', 1, 'chỉ là tên vật tư cho lệnh sản xuất', 1, NULL, '2023-10-06 08:09:30', '2024-07-15 17:34:28', 10);
INSERT INTO `supply_names` VALUES (57, 'Màng nước', 'nilon', 1, '', 1, NULL, '2023-10-06 08:09:30', '2024-07-15 17:34:29', 10);
INSERT INTO `supply_names` VALUES (58, 'Màng nhiệt', 'metalai', 1, '', 1, NULL, '2023-10-06 08:09:30', '2024-07-15 17:34:30', 10);
INSERT INTO `supply_names` VALUES (59, 'Màng nước', 'metalai', 1, '', 1, NULL, '2023-10-06 08:09:30', '2024-07-15 17:34:33', 10);
INSERT INTO `supply_names` VALUES (69, 'NHŨ LOẠI BÓNG', 'emulsion', NULL, NULL, 1, NULL, '2024-07-18 16:21:20', '2025-01-16 18:17:33', 23);
INSERT INTO `supply_names` VALUES (70, 'Màng co ( TÍNH THỬ KEO BỒI  )', 'skrink', NULL, NULL, 1, NULL, '2024-07-19 03:07:37', '2025-01-16 20:51:44', 23);
INSERT INTO `supply_names` VALUES (71, 'NHŨ LOẠI MỜ', 'emulsion', NULL, NULL, 1, NULL, '2025-01-16 18:17:19', '2025-01-16 18:17:19', 1);

SET FOREIGN_KEY_CHECKS = 1;
