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

 Date: 09/02/2025 13:12:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for c_supplies
-- ----------------------------
DROP TABLE IF EXISTS `c_supplies`;
CREATE TABLE `c_supplies`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `size_type` int NULL DEFAULT NULL,
  `qty` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `handled_qty` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `product` int NULL DEFAULT NULL,
  `supply` int NULL DEFAULT NULL,
  `supp_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of c_supplies
-- ----------------------------
INSERT INTO `c_supplies` VALUES (1, 'XVT-00000001', 'GIẤY COUCHES - C100 - 79x109', 19, '5200', NULL, 21, 22, 'paper', NULL, 'handling', 1, 6, '2025-02-07 18:02:18', '2025-02-07 18:02:18');
INSERT INTO `c_supplies` VALUES (2, 'XVT-00000002', '2 MẶT THƯỜNG - Carton 1.2ly - 100x120', 21, '10200', NULL, 21, 78, 'carton', NULL, 'handling', 1, 6, '2025-02-07 18:02:41', '2025-02-07 18:02:41');
INSERT INTO `c_supplies` VALUES (3, 'XVT-00000003', 'GIẤY COUCHES - C100 - 79x109', 19, '2600', NULL, 21, 21, 'paper', NULL, 'handling', 1, 6, '2025-02-07 18:08:53', '2025-02-07 18:08:53');
INSERT INTO `c_supplies` VALUES (4, 'XVT-00000004', 'NILON BÓNG - 12mic - BÓNG NƯỚC - 100x550000', 7, '114400', NULL, 21, 21, 'paper', NULL, 'handling', 1, 6, '2025-02-07 18:08:53', '2025-02-07 18:08:53');
INSERT INTO `c_supplies` VALUES (5, 'XVT-00000005', 'METALAI ( dành cho in ) - METALAI BẠC - Mã TD88 - 100x100000', 6, '114400', NULL, 21, 21, 'paper', NULL, 'handling', 1, 6, '2025-02-07 18:08:53', '2025-02-07 18:08:53');
INSERT INTO `c_supplies` VALUES (6, 'XVT-00000006', 'Phủ bóng UV - Phủ UV BÓNG - 100x100', 28, '114400', NULL, 21, 21, 'paper', NULL, 'handling', 1, 6, '2025-02-07 18:08:53', '2025-02-07 18:08:53');

SET FOREIGN_KEY_CHECKS = 1;
