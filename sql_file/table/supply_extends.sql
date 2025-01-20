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

 Date: 20/01/2025 13:58:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for supply_extends
-- ----------------------------
DROP TABLE IF EXISTS `supply_extends`;
CREATE TABLE `supply_extends`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã nhóm',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Tên nhóm',
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Ghi chú',
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name_index`(`name`) USING BTREE,
  INDEX `act_indx`(`act`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 44 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of supply_extends
-- ----------------------------
INSERT INTO `supply_extends` VALUES (31, 'Kho nhà máy', 'warehouse_type', 'Kho thành phẩm dưới nhà máy, Hoa Sơn, Ứng Hòa, HN', 1, '2024-08-17 10:18:42', '2024-08-17 10:18:42', 22);
INSERT INTO `supply_extends` VALUES (32, 'Kho văn phòng', 'warehouse_type', 'Kho thành phẩm tại văn phòng Triều Khúc, HN', 1, '2024-08-17 10:19:12', '2024-08-17 10:19:12', 22);
INSERT INTO `supply_extends` VALUES (38, 'VẬT TƯ  IN OFFSET - IN LƯỚI UV', 'other_supply', NULL, 1, '2025-01-17 01:16:32', '2025-01-17 01:16:32', 1);
INSERT INTO `supply_extends` VALUES (39, 'KEO BỒI - CÁC LOẠI KEO', 'other_supply', NULL, 1, '2025-01-17 01:24:55', '2025-01-17 01:26:32', 1);
INSERT INTO `supply_extends` VALUES (40, 'PHỤ KIỆN HỘP QUÀ TẶNG', 'other_supply', NULL, 1, '2025-01-17 01:25:18', '2025-01-17 01:26:16', 1);
INSERT INTO `supply_extends` VALUES (41, 'DÂY XÁCH - ORE', 'other_supply', NULL, 1, '2025-01-17 01:25:48', '2025-01-17 01:25:48', 1);
INSERT INTO `supply_extends` VALUES (42, 'VẬT TƯ PHỤ', 'other_supply', NULL, 1, '2025-01-17 01:27:07', '2025-01-17 01:27:07', 1);
INSERT INTO `supply_extends` VALUES (43, 'LINH PHỤ KIỆN CHO THIẾT BỊ MÁY', 'other_supply', NULL, 1, '2025-01-17 01:27:25', '2025-01-17 02:19:28', 1);

SET FOREIGN_KEY_CHECKS = 1;
