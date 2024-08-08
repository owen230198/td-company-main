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

 Date: 08/08/2024 10:53:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for notifies
-- ----------------------------
DROP TABLE IF EXISTS `notifies`;
CREATE TABLE `notifies`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `group_user` int NULL DEFAULT NULL,
  `user` int NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `handle_method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `param` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `act` tinyint NULL DEFAULT NULL,
  `table_created` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `index`(`id` ASC, `name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of notifies
-- ----------------------------
INSERT INTO `notifies` VALUES (26, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (27, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (28, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (29, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (30, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (31, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (32, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (33, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (34, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (35, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (36, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (37, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (38, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (39, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (40, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (41, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (42, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (43, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (44, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');
INSERT INTO `notifies` VALUES (45, 'Yêu cầu cập nhật lệnh sản xuất', 14, 0, 'Công nhân: Mr Quý - Đích (offset) Tổ máy in - in offset đã yêu cầu quản đốc cập nhật lệnh sản xuất Hộp DNA Hồng yến/ 18*16*5.8 cm ', 'feedBack', '{\"id\":\"1719\",\"type\":\"print\",\"color\":\"4\",\"factor\":\"2\",\"note\":null}', 1, 'w_users', 10, '2024-08-08 09:10:17', '2024-08-08 10:17:09');

SET FOREIGN_KEY_CHECKS = 1;
