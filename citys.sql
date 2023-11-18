/*
 Navicat Premium Data Transfer

 Source Server         : owen
 Source Server Type    : MySQL
 Source Server Version : 100425
 Source Host           : localhost:3306
 Source Schema         : td_company

 Target Server Type    : MySQL
 Target Server Version : 100425
 File Encoding         : 65001

 Date: 18/11/2023 07:38:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for citys
-- ----------------------------
DROP TABLE IF EXISTS `citys`;
CREATE TABLE `citys`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '' COMMENT 'Tên',
  `parent` int(255) NULL DEFAULT NULL COMMENT 'Cha',
  `ord` tinyint(4) NULL DEFAULT NULL COMMENT 'Sắp xếp',
  `act` tinyint(1) NULL DEFAULT NULL COMMENT 'Kích hoạt',
  `created_at` datetime(0) NULL DEFAULT NULL COMMENT 'Ngày tạo',
  `updated_at` datetime(0) NULL DEFAULT NULL COMMENT 'Ngày cập nhật',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_act`(`act`) USING BTREE,
  INDEX `idx_parent`(`parent`) USING BTREE,
  INDEX `idx_parent_act`(`parent`, `act`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12080 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of citys
-- ----------------------------
INSERT INTO `citys` VALUES (1, 'Hồ Chí Minh', 0, 1, 1, '2020-11-11 18:02:51', '2020-11-11 18:02:51');
INSERT INTO `citys` VALUES (351, 'Hà Nội', 0, 1, 1, '2020-11-11 18:05:31', '2020-11-11 18:05:31');
INSERT INTO `citys` VALUES (969, 'Đà Nẵng', 0, 1, 1, '2020-11-11 18:06:22', '2020-11-11 18:06:22');
INSERT INTO `citys` VALUES (1035, 'Bình Dương', 0, 1, 1, '2020-11-11 18:07:11', '2020-11-11 18:07:11');
INSERT INTO `citys` VALUES (1137, 'Đồng Nai', 0, 1, 1, '2020-11-11 18:08:27', '2020-11-11 18:08:27');
INSERT INTO `citys` VALUES (1327, 'Khánh Hòa', 0, 1, 1, '2020-11-11 18:08:51', '2020-11-11 18:08:51');
INSERT INTO `citys` VALUES (1478, 'Hải Phòng', 0, 1, 1, '2020-11-11 18:09:25', '2020-11-11 18:09:25');
INSERT INTO `citys` VALUES (1723, 'Long An', 0, 1, 1, '2020-11-11 18:09:44', '2020-11-11 18:09:44');
INSERT INTO `citys` VALUES (1933, 'Quảng Nam', 0, 1, 1, '2020-11-11 18:10:22', '2020-11-11 18:10:22');
INSERT INTO `citys` VALUES (2198, 'Vũng Tàu', 0, 1, 1, '2020-11-11 18:10:39', '2020-11-11 18:10:39');
INSERT INTO `citys` VALUES (2292, 'Đắk Lắk', 0, 1, 1, '2020-11-11 18:10:59', '2020-11-11 18:10:59');
INSERT INTO `citys` VALUES (2493, 'Cần Thơ', 0, 1, 1, '2020-11-11 18:11:12', '2020-11-11 18:11:12');
INSERT INTO `citys` VALUES (2592, 'Bình Thuận  ', 0, 1, 1, '2020-11-11 18:11:30', '2020-11-11 18:11:30');
INSERT INTO `citys` VALUES (2731, 'Lâm Đồng', 0, 1, 1, '2020-11-11 18:11:41', '2020-11-11 18:11:41');
INSERT INTO `citys` VALUES (2893, 'Thiên Huế', 0, 1, 1, '2020-11-11 18:11:54', '2020-11-11 18:11:54');
INSERT INTO `citys` VALUES (3061, 'Kiên Giang', 0, 1, 1, '2020-11-11 18:12:08', '2020-11-11 18:12:08');
INSERT INTO `citys` VALUES (3222, 'Bắc Ninh', 0, 1, 1, '2020-11-11 18:12:21', '2020-11-11 18:12:21');
INSERT INTO `citys` VALUES (3359, 'Quảng Ninh', 0, 1, 1, '2020-11-11 18:12:32', '2020-11-11 18:12:32');
INSERT INTO `citys` VALUES (3563, 'Thanh Hóa', 0, 1, 1, '2020-11-11 18:12:44', '2020-11-11 18:12:44');
INSERT INTO `citys` VALUES (4230, 'Nghệ An', 0, 1, 1, '2020-11-11 18:13:07', '2020-11-11 18:13:07');
INSERT INTO `citys` VALUES (4737, 'Hải Dương', 0, 1, 1, '2020-11-11 18:13:21', '2020-11-11 18:13:21');
INSERT INTO `citys` VALUES (5017, 'Gia Lai', 0, 1, 1, '2020-11-11 18:13:32', '2020-11-11 18:13:32');
INSERT INTO `citys` VALUES (5259, 'Bình Phước', 0, 1, 1, '2020-11-11 18:13:41', '2020-11-11 18:13:41');
INSERT INTO `citys` VALUES (5385, 'Hưng Yên', 0, 1, 1, '2020-11-11 18:13:52', '2020-11-11 18:13:52');
INSERT INTO `citys` VALUES (5558, 'Bình Định', 0, 1, 1, '2020-11-11 18:13:58', '2020-11-11 18:13:58');
INSERT INTO `citys` VALUES (5730, 'Tiền Giang', 0, 1, 1, '2020-11-11 18:14:08', '2020-11-11 18:14:08');
INSERT INTO `citys` VALUES (5922, 'Thái Bình', 0, 1, 1, '2020-11-11 18:14:22', '2020-11-11 18:14:22');
INSERT INTO `citys` VALUES (6218, 'Bắc Giang', 0, 1, 1, '2020-11-11 18:14:31', '2020-11-11 18:14:31');
INSERT INTO `citys` VALUES (6463, 'Hòa Bình', 0, 1, 1, '2020-11-11 18:14:39', '2020-11-11 18:14:39');
INSERT INTO `citys` VALUES (6686, 'An Giang', 0, 1, 1, '2020-11-11 18:14:45', '2020-11-11 18:14:45');
INSERT INTO `citys` VALUES (6854, 'Vĩnh Phúc', 0, 1, 1, '2020-11-11 18:15:00', '2020-11-11 18:15:00');
INSERT INTO `citys` VALUES (7001, 'Tây Ninh', 0, 1, 1, '2020-11-11 18:15:06', '2020-11-11 18:15:06');
INSERT INTO `citys` VALUES (7106, 'Thái Nguyên', 0, 1, 1, '2020-11-11 18:15:14', '2020-11-11 18:15:14');
INSERT INTO `citys` VALUES (7298, 'Lào Cai', 0, 1, 1, '2020-11-11 18:15:20', '2020-11-11 18:15:20');
INSERT INTO `citys` VALUES (7474, 'Nam Định', 0, 1, 1, '2020-11-11 18:15:29', '2020-11-11 18:15:29');
INSERT INTO `citys` VALUES (7715, 'Quảng Ngãi', 0, 1, 1, '2020-11-11 18:15:38', '2020-11-11 18:15:38');
INSERT INTO `citys` VALUES (7917, 'Bến Tre', 0, 1, 1, '2020-11-11 18:15:45', '2020-11-11 18:15:45');
INSERT INTO `citys` VALUES (8095, 'Đắk Nông', 0, 1, 1, '2020-11-11 18:16:05', '2020-11-11 18:16:05');
INSERT INTO `citys` VALUES (8175, 'Cà Mau', 0, 1, 1, '2020-11-11 18:16:13', '2020-11-11 18:16:13');
INSERT INTO `citys` VALUES (8287, 'Vĩnh Long', 0, 1, 1, '2020-11-11 18:16:23', '2020-11-11 18:16:23');
INSERT INTO `citys` VALUES (8405, 'Ninh Bình', 0, 1, 1, '2020-11-11 18:16:28', '2020-11-11 18:16:28');
INSERT INTO `citys` VALUES (8560, 'Phú Thọ', 0, 1, 1, '2020-11-11 18:16:35', '2020-11-11 18:16:35');
INSERT INTO `citys` VALUES (8851, 'Ninh Thuận', 0, 1, 1, '2020-11-11 18:16:43', '2020-11-11 18:16:43');
INSERT INTO `citys` VALUES (8924, 'Phú Yên', 0, 1, 1, '2020-11-11 18:16:47', '2020-11-11 18:16:47');
INSERT INTO `citys` VALUES (9047, 'Hà Nam', 0, 1, 1, '2020-11-11 18:16:52', '2020-11-11 18:16:52');
INSERT INTO `citys` VALUES (9171, 'Hà Tĩnh', 0, 1, 1, '2020-11-11 18:16:57', '2020-11-11 18:16:57');
INSERT INTO `citys` VALUES (9449, 'Đồng Tháp', 0, 1, 1, '2020-11-11 18:17:04', '2020-11-11 18:17:04');
INSERT INTO `citys` VALUES (9607, 'Sóc Trăng', 0, 1, 1, '2020-11-11 18:17:13', '2020-11-11 18:17:13');
INSERT INTO `citys` VALUES (9731, 'Kon Tum', 0, 1, 1, '2020-11-11 18:17:22', '2020-11-11 18:17:22');
INSERT INTO `citys` VALUES (9845, 'Quảng Bình', 0, 1, 1, '2020-11-11 18:17:28', '2020-11-11 18:17:28');
INSERT INTO `citys` VALUES (10025, 'Quảng Trị', 0, 1, 1, '2020-11-11 18:17:37', '2020-11-11 18:17:37');
INSERT INTO `citys` VALUES (10177, 'Trà Vinh', 0, 1, 1, '2020-11-11 18:17:46', '2020-11-11 18:17:46');
INSERT INTO `citys` VALUES (10301, 'Hậu Giang', 0, 1, 1, '2020-11-11 18:17:52', '2020-11-11 18:17:52');
INSERT INTO `citys` VALUES (10387, 'Sơn La', 0, 1, 1, '2020-11-11 18:18:00', '2020-11-11 18:18:00');
INSERT INTO `citys` VALUES (10604, 'Bạc Liêu', 0, 1, 1, '2020-11-11 18:18:07', '2020-11-11 18:18:07');
INSERT INTO `citys` VALUES (10679, 'Yên Bái', 0, 1, 1, '2020-11-11 18:18:11', '2020-11-11 18:18:11');
INSERT INTO `citys` VALUES (10869, 'Tuyên Quang', 0, 1, 1, '2020-11-11 18:18:17', '2020-11-11 18:18:17');
INSERT INTO `citys` VALUES (11019, 'Điện Biên', 0, 1, 1, '2020-11-11 18:18:21', '2020-11-11 18:18:21');
INSERT INTO `citys` VALUES (11162, 'Lai Châu', 0, 1, 1, '2020-11-11 18:18:25', '2020-11-11 18:18:25');
INSERT INTO `citys` VALUES (11280, 'Lạng Sơn', 0, 1, 1, '2020-11-11 18:18:28', '2020-11-11 18:18:28');
INSERT INTO `citys` VALUES (11525, 'Hà Giang', 0, 1, 1, '2020-11-11 18:18:35', '2020-11-11 18:18:35');
INSERT INTO `citys` VALUES (11732, 'Bắc Kạn', 0, 1, 1, '2020-11-11 18:18:40', '2020-11-11 18:18:40');
INSERT INTO `citys` VALUES (11863, 'Cao Bằng', 0, 1, 1, '2020-11-11 18:18:43', '2020-11-11 18:18:43');

SET FOREIGN_KEY_CHECKS = 1;
