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

 Date: 16/01/2025 18:40:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for n_regions
-- ----------------------------
DROP TABLE IF EXISTS `n_regions`;
CREATE TABLE `n_regions`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of n_regions
-- ----------------------------
INSERT INTO `n_regions` VALUES (1, 'Thông tin');
INSERT INTO `n_regions` VALUES (2, 'Chi tiết');
INSERT INTO `n_regions` VALUES (3, 'Thông tin cá nhân');
INSERT INTO `n_regions` VALUES (4, 'Thông tin tài khoản');
INSERT INTO `n_regions` VALUES (7, 'Thông tin liên hệ');
INSERT INTO `n_regions` VALUES (8, 'Khác');
INSERT INTO `n_regions` VALUES (9, 'Thông tin khách hàng');
INSERT INTO `n_regions` VALUES (10, 'Thông tin báo giá');
INSERT INTO `n_regions` VALUES (11, 'Thông số bù hao');
INSERT INTO `n_regions` VALUES (12, 'ĐG chỉnh máy');
INSERT INTO `n_regions` VALUES (13, 'ĐG lượt');
INSERT INTO `n_regions` VALUES (14, 'Đơn giá & chi phí');
INSERT INTO `n_regions` VALUES (15, 'NCC đề xuất');
INSERT INTO `n_regions` VALUES (16, 'NCC thực tế');

SET FOREIGN_KEY_CHECKS = 1;
