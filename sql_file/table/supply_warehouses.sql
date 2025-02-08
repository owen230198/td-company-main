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

 Date: 23/01/2025 18:41:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for supply_warehouses
-- ----------------------------
DROP TABLE IF EXISTS `supply_warehouses`;
CREATE TABLE `supply_warehouses`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `target` int NULL DEFAULT NULL,
  `qtv` int NULL DEFAULT NULL,
  `length` float NULL DEFAULT NULL,
  `width` float NULL DEFAULT NULL,
  `qty` float NULL DEFAULT NULL,
  `lenth_qty` float NULL DEFAULT NULL,
  `weight` float NULL DEFAULT NULL,
  `source` tinyint NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 162 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of supply_warehouses
-- ----------------------------
INSERT INTO `supply_warehouses` VALUES (155, 'GIẤY COUCHES - C100 - 100x100', 'paper', 55, 289, 100, 100, 102100, 102100, 10210, NULL, 'imported', NULL, 1, '2025-01-22 11:58:30', '2025-01-22 11:58:30', 13);
INSERT INTO `supply_warehouses` VALUES (156, 'METALAI ( dành cho in ) - METALAI BẠC - Mã TD88 - 10x550000', 'metalai', 72, 333, 550000, 10, 1, 5500, 9.35, NULL, 'imported', NULL, 1, '2025-01-22 11:59:58', '2025-01-22 11:59:58', 13);
INSERT INTO `supply_warehouses` VALUES (157, 'MÀNG BÓNG - MỜ - 12mic - BÓNG NƯỚC - 100x550000', 'nilon', 69, 344, 550000, 100, 9, 49500, 541.53, NULL, 'imported', NULL, 1, '2025-01-22 12:01:16', '2025-01-22 12:01:16', 13);
INSERT INTO `supply_warehouses` VALUES (158, 'MÀNG CÁN: BÓNG - MỜ - IN MỰC 12mic - BÓNG NHIỆT - 66x550000', 'cover', 61, 436, 550000, 66, 2, 1100000, 111.8, NULL, 'imported', NULL, 1, '2025-01-23 15:40:29', '2025-01-23 16:23:39', 23);
INSERT INTO `supply_warehouses` VALUES (159, 'MÀNG CÁN: BÓNG - MỜ - IN MỰC 12mic - BÓNG NHIỆT - 55x550000', 'cover', 61, 436, 550000, 55, 2, 1100000, 93.18, NULL, 'imported', NULL, 1, '2025-01-23 15:42:20', '2025-01-23 16:23:59', 23);
INSERT INTO `supply_warehouses` VALUES (160, '2 MẶT THƯỜNG - Carton 1.8ly - 200x200', 'carton', 21, 354, 200, 200, 1000, 200000, 5040, NULL, 'imported', NULL, 1, '2025-01-23 17:23:31', '2025-01-23 17:23:31', 23);
INSERT INTO `supply_warehouses` VALUES (161, '2 MẶT THƯỜNG - Carton 1.8ly - 100x100', 'carton', 21, 354, 100, 100, 1000, 100000, 1260, NULL, 'imported', NULL, 1, '2025-01-23 17:24:18', '2025-01-23 17:24:18', 23);
INSERT INTO `supply_warehouses` VALUES (162, 'CSN ĐEN - CSN ĐEN 1cm - 200x200', 'rubber', 51, 398, 200, 200, 1000, 200000, 4000, NULL, 'imported', NULL, 1, '2025-01-23 17:38:27', '2025-01-23 17:38:27', 23);
INSERT INTO `supply_warehouses` VALUES (163, 'NHUNG - LÔNG NGẮN - MÀU ĐỎ - Lông ngắn - 165x9100', 'decal', 71, 409, 9100, 165, 1, 9100, 15.02, NULL, 'imported', NULL, 1, '2025-01-23 17:45:02', '2025-01-23 17:45:02', 23);
INSERT INTO `supply_warehouses` VALUES (164, 'VẢI LỤA THƯỜNG - MÀU VÀNG - 150x500000', 'silk', 60, 413, 500000, 150, 2, 1000000, 150, NULL, 'imported', NULL, 1, '2025-01-23 18:22:24', '2025-01-23 18:22:24', 23);
INSERT INTO `supply_warehouses` VALUES (165, 'NAM CHÂM - Loại nhỏ ( KT )', 'magnet', 59, 460, NULL, NULL, 1000, NULL, NULL, NULL, 'imported', NULL, 1, '2025-01-23 18:39:48', '2025-01-23 18:39:48', 23);

SET FOREIGN_KEY_CHECKS = 1;
