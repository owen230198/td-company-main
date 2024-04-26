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

 Date: 26/04/2024 20:35:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for supply_warehouses
-- ----------------------------
DROP TABLE IF EXISTS `supply_warehouses`;
CREATE TABLE `supply_warehouses`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `length` float NULL DEFAULT NULL,
  `width` float NULL DEFAULT NULL,
  `qty` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `supp_type` int(0) NULL DEFAULT NULL,
  `supp_price` int(0) NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `source` tinyint(0) NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `confirm_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(0) NULL DEFAULT NULL,
  `confirm_by` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supply_warehouses
-- ----------------------------
INSERT INTO `supply_warehouses` VALUES (1, 'Carton', 90.6, 51.5, '20636', 'carton', 21, 121, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-09-24 15:45:21', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (5, 'Cao su non DL 0.8mm KT 30x20', 30, 20, '1000000', 'rubber', 28, 156, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-08-07 23:26:08', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (6, 'Cao su non DL 0.8mm KT 50x25', 50, 25, '1000000', 'rubber', 28, 156, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-08-07 23:25:46', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (7, 'Đề can nhung cao cấp KT 60x50', 60, 50, '1000000', 'decal', 46, 92, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-08-07 23:24:41', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (8, 'Đề can nhung cao cấp KT 100 x 50', 100, 50, '1000000', 'decal', 46, 92, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-08-07 23:24:27', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (10, 'Lụa vàng KT 100 x 50', 100, 50, '1000000', 'silk', 47, 75, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-08-07 23:24:16', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (11, 'Lụa vàng KT 30 x 30', 30, 30, '1000000', 'silk', 47, 75, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-08-07 23:24:03', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (13, 'Mút phẳng K21 ĐL 0.5mm KT 50 x 40', 50, 40, '1000000', 'styrofoam', 10, 60, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-07-11 02:25:07', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (14, 'Mút phẳng K21 ĐL 0.5mm KT 50 x 30', 50, 30, '1000000', 'styrofoam', 10, 60, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-07-11 02:25:07', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (15, 'Mút phẳng K21 ĐL 0.5mm KT 100 x 50', 100, 50, '1000000', 'styrofoam', 10, 60, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-07-11 02:25:07', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (17, 'Vật tư mica KT 100 x 50', 100, 50, '1000000', 'mica', 37, 172, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-08-07 23:23:40', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (18, 'Vật tư mica KT 30 x 30', 30, 30, '1000000', 'mica', 37, 172, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-08-07 16:56:55', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (25, 'Mút phẳng K30 ĐL 1cm KT 100 x 50', 100, 50, '1000000', 'styrofoam', 9, 37, 'imported', NULL, NULL, 1, '2023-08-21 18:16:10', '2023-08-21 18:16:10', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (29, 'Carton', 90.6, 52.5, '1658', 'carton', 21, 121, 'imported', NULL, NULL, 1, '2023-09-24 15:45:53', '2023-12-12 23:03:34', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (30, 'Carton', 90.6, 46.5, '50360', 'carton', 21, 121, 'imported', NULL, NULL, 1, '2023-09-24 15:46:41', '2023-09-24 15:46:41', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (31, 'Carton', 48, 77.5, '14560', 'carton', 21, 121, 'imported', NULL, NULL, 1, '2023-09-24 15:48:15', '2023-09-24 15:48:15', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (32, 'Carton nháp', 100, 120, '14560', 'carton', 21, 117, 'imported', NULL, NULL, 1, '2023-09-24 16:11:07', '2023-09-24 16:11:07', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (33, NULL, 5, 5, '1561', 'carton', 21, 121, 'waiting', 2, NULL, 1, '2023-12-12 21:45:09', '2023-12-12 21:45:09', NULL, 6, NULL);
INSERT INTO `supply_warehouses` VALUES (34, NULL, 5, 5, '781', 'carton', 21, 121, 'waiting', 2, NULL, 1, '2023-12-12 21:45:29', '2023-12-12 21:45:29', NULL, 6, NULL);
INSERT INTO `supply_warehouses` VALUES (35, 'CARTON MẶT NÂU - MỘC', 200, 150, '8959', 'carton', 21, 118, 'imported', NULL, NULL, 1, '2023-12-12 21:49:25', '2023-12-12 22:59:21', NULL, 16, NULL);
INSERT INTO `supply_warehouses` VALUES (36, NULL, 5, 6, '1041', 'carton', 21, 118, 'waiting', 2, NULL, 1, '2023-12-12 21:51:54', '2023-12-12 21:51:54', NULL, 6, NULL);
INSERT INTO `supply_warehouses` VALUES (37, 'carton 1.8', 126, 100, '600', 'carton', 21, 118, 'imported', NULL, NULL, 1, '2024-04-24 15:31:58', '2024-04-24 15:31:58', NULL, 13, NULL);

SET FOREIGN_KEY_CHECKS = 1;
