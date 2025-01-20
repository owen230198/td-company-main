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

 Date: 20/01/2025 11:35:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for supply_prices
-- ----------------------------
DROP TABLE IF EXISTS `supply_prices`;
CREATE TABLE `supply_prices`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã nhóm',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Tên nhóm',
  `price` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `price_purchase` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `supply_id` int(11) NULL DEFAULT NULL COMMENT 'Cha',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Ghi chú',
  `act` tinyint(4) NULL DEFAULT NULL,
  `ord` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `type_index`(`type`) USING BTREE,
  INDEX `carton_foam_index`(`supply_id`) USING BTREE,
  INDEX `name_index`(`name`) USING BTREE,
  INDEX `act_indx`(`act`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 431 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of supply_prices
-- ----------------------------
INSERT INTO `supply_prices` VALUES (9, '1.0cm', '40000', NULL, 'rubber', 6, 'Tính theo m2 là 1.25 x 2.5 = 3.125m2 ( tính ra là 40.000đ/m2 )', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (10, '1.5cm', '60000', NULL, 'rubber', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (11, '2.0cm', '80000', NULL, 'rubber', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (12, '2.5cm', '100000', NULL, 'rubber', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (13, '3.0cm', '120000', NULL, 'rubber', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (14, '3.5cm', '140000', NULL, 'rubber', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (15, '4.0cm', '160000', NULL, 'rubber', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (16, '4.5cm', '180000', NULL, 'rubber', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (17, '5.0cm', '200000', NULL, 'rubber', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (68, '0.5cm', '60000', NULL, 'styrofoam', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (69, '0.8cm', '60000', NULL, 'styrofoam', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (72, '1 cm', '6', NULL, 'styrofoam', 7, '60.000đ/m2 ( Cao su non 35k/m2 + Nhung 25k/m2 )', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1);
INSERT INTO `supply_prices` VALUES (105, 'Carton 0.8ly', '0.01', '560', 'carton', 21, '0.01 là 10 triệu 1 tấn', 1, NULL, '2023-07-20 10:21:00', '2025-01-12 14:24:09', 0);
INSERT INTO `supply_prices` VALUES (154, 'Cao su non bồi nhung 0.8cm', '1', NULL, 'rubber', 22, NULL, 1, NULL, '2023-07-20 10:21:00', '2025-01-10 17:17:10', 1);
INSERT INTO `supply_prices` VALUES (155, 'Cao su non bồi nhung 1cm', '14.6', NULL, 'rubber', 23, NULL, 1, NULL, '2023-07-20 10:21:00', '2025-01-10 17:17:14', 1);
INSERT INTO `supply_prices` VALUES (172, 'PET 0.15', '200', NULL, 'mica', 37, NULL, 1, NULL, '2023-07-20 10:21:00', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (197, 'K30-0.3cm ( KT 180 x 200cm )', '0', '300', 'styrofoam', 9, 'Chỉ mua 180 x 200cm, giá 22.22 triệu/ tấn', 1, NULL, '2023-09-16 02:43:32', '2025-01-16 16:22:40', 1);
INSERT INTO `supply_prices` VALUES (207, 'K40-0.3cm ( KT 180 x 200cm )', '0', '300', 'styrofoam', 8, 'Chỉ mua khổ 180 x 200cm, giá là 29.1666 triệu/ tấn', 1, NULL, '2023-09-16 02:48:52', '2025-01-16 16:35:51', 1);
INSERT INTO `supply_prices` VALUES (225, 'PET 0.18', '200', NULL, 'mica', 37, NULL, 1, NULL, '2024-01-10 10:13:35', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (226, 'PET 0.2', '200', NULL, 'mica', 37, NULL, 1, NULL, '2024-01-10 10:13:47', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (227, 'PET 0.25', '200', NULL, 'mica', 37, NULL, 1, NULL, '2024-01-10 10:13:53', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (228, 'PET 0.3', '200', NULL, 'mica', 37, NULL, 1, NULL, '2024-01-10 10:14:09', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (229, 'PET 0.4', '200', NULL, 'mica', 37, NULL, 1, NULL, '2024-01-10 10:14:15', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (230, 'PET 0.5', '200', NULL, 'mica', 37, NULL, 1, NULL, '2024-01-10 10:14:23', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (288, 'C80', '0.0023', '80', 'paper', 12, NULL, 1, NULL, '2025-01-10 17:24:34', '2025-01-10 17:29:47', 1);
INSERT INTO `supply_prices` VALUES (289, 'C100', '0.00213', '100', 'paper', 12, NULL, 1, NULL, '2025-01-10 17:27:03', '2025-01-10 17:29:19', 1);
INSERT INTO `supply_prices` VALUES (290, 'C120', '0.00213', '120', 'paper', 12, NULL, 1, NULL, '2025-01-10 17:28:34', '2025-01-10 17:29:09', 1);
INSERT INTO `supply_prices` VALUES (291, 'C140', '0.00213', '140', 'paper', 12, NULL, 1, NULL, '2025-01-11 15:23:42', '2025-01-11 15:23:42', 1);
INSERT INTO `supply_prices` VALUES (292, 'C150', '0.00213', '150', 'paper', 12, NULL, 1, NULL, '2025-01-11 15:24:47', '2025-01-11 15:24:47', 1);
INSERT INTO `supply_prices` VALUES (293, 'C200', '0.00213', '200', 'paper', 12, NULL, 1, NULL, '2025-01-11 15:25:38', '2025-01-11 15:25:53', 1);
INSERT INTO `supply_prices` VALUES (294, 'C230', '0.00213', '230', 'paper', 12, NULL, 1, NULL, '2025-01-11 15:26:40', '2025-01-11 15:26:40', 1);
INSERT INTO `supply_prices` VALUES (295, 'C250', '0.00213', '250', 'paper', 12, NULL, 1, NULL, '2025-01-11 15:27:24', '2025-01-11 15:27:24', 1);
INSERT INTO `supply_prices` VALUES (296, 'C300', '0.00213', '300', 'paper', 12, NULL, 1, NULL, '2025-01-11 15:28:10', '2025-01-11 15:28:10', 1);
INSERT INTO `supply_prices` VALUES (297, 'i210', '0.00185', '210', 'paper', 13, NULL, 1, NULL, '2025-01-11 15:30:35', '2025-01-11 15:30:35', 1);
INSERT INTO `supply_prices` VALUES (299, 'i230', '0.00175', '230', 'paper', 13, NULL, 1, NULL, '2025-01-11 15:47:05', '2025-01-11 16:16:11', 1);
INSERT INTO `supply_prices` VALUES (306, 'i250', '0.00175', '250', 'paper', 13, NULL, 1, NULL, '2025-01-11 16:16:33', '2025-01-11 16:16:33', 1);
INSERT INTO `supply_prices` VALUES (307, 'i280', '0.00175', '280', 'paper', 13, NULL, 1, NULL, '2025-01-11 16:16:44', '2025-01-11 16:16:44', 1);
INSERT INTO `supply_prices` VALUES (308, 'i300', '0.00175', '300', 'paper', 13, NULL, 1, NULL, '2025-01-11 16:17:00', '2025-01-11 16:17:00', 1);
INSERT INTO `supply_prices` VALUES (309, 'i330', '0.00175', '330', 'paper', 13, NULL, 1, NULL, '2025-01-11 16:17:10', '2025-01-11 16:17:31', 1);
INSERT INTO `supply_prices` VALUES (310, 'i350', '0.00175', '350', 'paper', 13, NULL, 1, NULL, '2025-01-11 16:17:21', '2025-01-11 16:17:21', 1);
INSERT INTO `supply_prices` VALUES (311, 'i380', '0.00175', '380', 'paper', 13, NULL, 1, NULL, '2025-01-11 16:17:43', '2025-01-11 16:17:43', 1);
INSERT INTO `supply_prices` VALUES (312, 'i400', '0.00175', '400', 'paper', 13, NULL, 1, NULL, '2025-01-11 16:17:55', '2025-01-11 16:17:55', 1);
INSERT INTO `supply_prices` VALUES (313, 'Duplex130', '0.00167', '130', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:21:42', '2025-01-11 16:32:07', 1);
INSERT INTO `supply_prices` VALUES (314, 'Duplex140', '0.00167', '140', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:28:56', '2025-01-11 16:34:03', 1);
INSERT INTO `supply_prices` VALUES (315, 'Duplex150', '0.00167', '150', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:29:06', '2025-01-11 16:33:51', 1);
INSERT INTO `supply_prices` VALUES (316, 'Duplex160', '0.00167', '160', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:29:18', '2025-01-11 16:33:41', 1);
INSERT INTO `supply_prices` VALUES (317, 'Duplex170', '0.00167', '170', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:29:41', '2025-01-11 16:33:29', 1);
INSERT INTO `supply_prices` VALUES (318, 'Duplex181', '0.00167', '181', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:29:56', '2025-01-11 16:33:19', 1);
INSERT INTO `supply_prices` VALUES (319, 'Duplex200', '0.00167', '200', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:30:14', '2025-01-11 16:31:48', 1);
INSERT INTO `supply_prices` VALUES (320, 'Duplex230', '0.00167', '230', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:30:24', '2025-01-11 16:31:37', 1);
INSERT INTO `supply_prices` VALUES (321, 'Duplex250', '0.00163', '250', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:34:43', '2025-01-11 16:34:43', 1);
INSERT INTO `supply_prices` VALUES (322, 'Duplex280', '0.00163', '280', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:35:20', '2025-01-11 16:35:20', 1);
INSERT INTO `supply_prices` VALUES (323, 'Duplex300', '0.0016', '300', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:36:19', '2025-01-11 16:40:20', 1);
INSERT INTO `supply_prices` VALUES (324, 'Duplex330', '0.0016', '330', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:36:33', '2025-01-11 16:40:29', 1);
INSERT INTO `supply_prices` VALUES (325, 'Duplex350', '0.0016', '350', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:38:20', '2025-01-11 16:38:20', 1);
INSERT INTO `supply_prices` VALUES (326, 'Duplex380', '0.0016', '380', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:38:32', '2025-01-11 16:38:32', 1);
INSERT INTO `supply_prices` VALUES (327, 'Duplex400', '0.0016', '400', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:38:54', '2025-01-11 16:38:54', 1);
INSERT INTO `supply_prices` VALUES (328, 'Duplex430', '0.0016', '430', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:39:08', '2025-01-11 16:39:08', 1);
INSERT INTO `supply_prices` VALUES (329, 'Duplex450', '0.0016', '450', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:39:19', '2025-01-11 16:39:19', 1);
INSERT INTO `supply_prices` VALUES (330, 'Duplex480', '0.0016', '480', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:39:29', '2025-01-11 16:39:29', 1);
INSERT INTO `supply_prices` VALUES (331, 'Duplex500', '0.0016', '500', 'paper', 14, '0.00167 là 16.7 triệu/ tấn', 1, NULL, '2025-01-11 16:39:44', '2025-01-11 16:39:44', 1);
INSERT INTO `supply_prices` VALUES (333, 'Metalai nước BẠC 12mic', '0.28', '17', 'metalai', 57, '12mic metalai quy đổi ra hệ số định lượng = 17, giá thì theo nhà cung cấp', 1, NULL, '2025-01-12 09:00:49', '2025-01-12 09:40:17', 1);
INSERT INTO `supply_prices` VALUES (334, 'Metalai bạc 12mic', '0.28', '17', 'nilon', 59, NULL, 1, NULL, '2025-01-12 09:18:41', '2025-01-12 09:19:22', 1);
INSERT INTO `supply_prices` VALUES (335, 'Metailai ĐẶC BIÊT 17mic - Sần đỏ', '6000', '17', 'nilon', 60, NULL, 1, NULL, '2025-01-12 09:23:12', '2025-01-12 09:25:23', 1);
INSERT INTO `supply_prices` VALUES (336, 'Metailai ĐẶC BIÊT 17mic - Sần Xanh', '6000', '17', 'nilon', 60, NULL, 1, NULL, '2025-01-12 09:24:41', '2025-01-12 09:24:41', 1);
INSERT INTO `supply_prices` VALUES (337, 'Metailai ĐẶC BIÊT 17mic - Sần Vàng', '6000', '17', 'nilon', 60, NULL, 1, NULL, '2025-01-12 09:25:02', '2025-01-12 09:25:02', 1);
INSERT INTO `supply_prices` VALUES (338, 'Metailai ĐẶC BIÊT 17mic - Sần Bạc', '6000', '17', 'nilon', 60, NULL, 1, NULL, '2025-01-12 09:25:57', '2025-01-12 09:25:57', 1);
INSERT INTO `supply_prices` VALUES (339, 'Màng nước ĐẶC BIỆT - SẦN ĐỎ 17mic', '0', '17', 'metalai', 57, '12mic metalai quy đổi ra hệ số định lượng = 17, giá thì theo nhà cung cấp LÀ 25K/m2', 1, NULL, '2025-01-12 09:46:51', '2025-01-12 09:47:00', 1);
INSERT INTO `supply_prices` VALUES (340, 'Màng nước ĐẶC BIỆT - SẦN XANH 17mic', '0', '17', 'metalai', 57, '12mic metalai quy đổi ra hệ số định lượng = 17, giá thì theo nhà cung cấp LÀ 25K/m2', 1, NULL, '2025-01-12 09:47:23', '2025-01-12 09:47:23', 1);
INSERT INTO `supply_prices` VALUES (341, 'Màng nước ĐẶC BIỆT - SẦN VÀNG 17mic', '0', '17', 'metalai', 57, '12mic metalai quy đổi ra hệ số định lượng = 17, giá thì theo nhà cung cấp LÀ 25K/m2', 1, NULL, '2025-01-12 09:47:33', '2025-01-12 09:47:33', 1);
INSERT INTO `supply_prices` VALUES (342, 'Màng nước ĐẶC BIỆT - SẦN BẠC 17mic', '0', '17', 'metalai', 57, '12mic metalai quy đổi ra hệ số định lượng = 17, giá thì theo nhà cung cấp LÀ 25K/m2', 1, NULL, '2025-01-12 09:47:43', '2025-01-12 09:47:43', 1);
INSERT INTO `supply_prices` VALUES (344, '12mic - BÓNG NƯỚC', '0.2', '10.94', 'nilon', 46, '12mic = ĐL 10.94', 1, NULL, '2025-01-12 09:58:52', '2025-01-12 10:31:18', 1);
INSERT INTO `supply_prices` VALUES (345, '15mic - BÓNG NƯỚC', '0.2', '13.66', 'nilon', 46, '15mic = ĐL 13.66 OK ( 0.2 xem phần tính giá )', 1, NULL, '2025-01-12 10:15:09', '2025-01-12 11:46:50', 1);
INSERT INTO `supply_prices` VALUES (346, '12mic - MỜ NƯỚC', '0.2', '12', 'nilon', 46, '12mic = ĐL 12 OK ( 0.2 xem phần tính giá )', 0, NULL, '2025-01-12 10:15:34', '2025-01-12 11:47:09', 1);
INSERT INTO `supply_prices` VALUES (347, '15mic - MỜ NƯỚC', '0.2', '12.83', 'nilon', 46, '15mic = ĐL 12.83 OK ( 0.2 xem phần tính giá )', 1, NULL, '2025-01-12 10:15:51', '2025-01-12 11:47:23', 1);
INSERT INTO `supply_prices` VALUES (348, '12mic - MỜ NHIỆT', '0.2', '15.38', 'nilon', 46, '12mic = ĐL 15.38 OK ( 0.2 xem phần tính giá )', 1, NULL, '2025-01-12 10:34:40', '2025-01-12 11:47:39', 1);
INSERT INTO `supply_prices` VALUES (349, '12mic - BÓNG NHIỆT', '0.2', '15.4', 'nilon', 46, '12mic = ĐL 15.4 OK ( 0.2 xem phần tính giá )', 1, NULL, '2025-01-12 10:35:54', '2025-01-12 11:47:53', 1);
INSERT INTO `supply_prices` VALUES (350, 'METALAI NƯỚC BẠC 12mic', '0.2', '16.95', 'nilon', 46, '15mic = ĐL 16.95 OK ( 0.2 xem phần tính giá )', 1, NULL, '2025-01-12 10:36:53', '2025-01-12 11:48:07', 1);
INSERT INTO `supply_prices` VALUES (351, 'Carton 1ly', '0.01', '700', 'carton', 21, '0.01 là 10 triệu 1 tấn', 1, NULL, '2025-01-12 14:24:33', '2025-01-12 14:24:33', 1);
INSERT INTO `supply_prices` VALUES (352, 'Carton 1.2ly', '0.01', '840', 'carton', 21, '0.01 là 10 triệu 1 tấn', 1, NULL, '2025-01-12 14:25:02', '2025-01-12 14:25:02', 1);
INSERT INTO `supply_prices` VALUES (353, 'Carton 1.5ly', '0.01', '1050', 'carton', 21, '0.01 là 10 triệu 1 tấn', 1, NULL, '2025-01-12 14:25:36', '2025-01-12 14:25:36', 1);
INSERT INTO `supply_prices` VALUES (354, 'Carton 1.8ly', '0.01', '1260', 'carton', 21, '0.01 là 10 triệu 1 tấn', 1, NULL, '2025-01-12 14:26:14', '2025-01-12 14:26:26', 1);
INSERT INTO `supply_prices` VALUES (355, 'Carton 2ly', '0.01', '1400', 'carton', 21, '0.01 là 10 triệu 1 tấn', 1, NULL, '2025-01-12 14:26:41', '2025-01-12 14:26:41', 1);
INSERT INTO `supply_prices` VALUES (356, 'Carton 2.2ly', '0.01', '1540', 'carton', 21, '0.01 là 10 triệu 1 tấn', 1, NULL, '2025-01-12 14:27:09', '2025-01-12 14:27:09', 1);
INSERT INTO `supply_prices` VALUES (357, 'Carton 2.5ly', '0.01', '1750', 'carton', 21, '0.01 là 10 triệu 1 tấn', 1, NULL, '2025-01-12 14:27:28', '2025-01-12 14:27:28', 1);
INSERT INTO `supply_prices` VALUES (358, 'SÓNG E 2 lớp - MẶT KPP', '0', '100', 'carton', 48, 'MẶT KPP = 3500/m2', 1, NULL, '2025-01-12 14:37:58', '2025-01-16 17:22:35', 1);
INSERT INTO `supply_prices` VALUES (361, 'K21-0.3cm ( KT 180 x 200cm )', '0', '300', 'styrofoam', 10, 'Chỉ mua khổ 180 x 200cm, giá là 15.2778 triệu/ tấn', 1, NULL, '2025-01-16 16:05:35', '2025-01-16 16:19:18', 1);
INSERT INTO `supply_prices` VALUES (362, 'K21-0.5cm ( KT 180 x 200cm )', '0', '500', 'styrofoam', 10, 'Chỉ mua khổ 180 x 200cm, giá là 15.2778 triệu/ tấn', 1, NULL, '2025-01-16 16:06:02', '2025-01-16 16:19:23', 1);
INSERT INTO `supply_prices` VALUES (363, 'K21-0.8cm ( KT 180 x 200cm )', '0', '800', 'styrofoam', 10, 'Chỉ mua khổ 180 x 200cm, giá là 15.2778 triệu/ tấn', 1, NULL, '2025-01-16 16:06:12', '2025-01-16 16:19:29', 1);
INSERT INTO `supply_prices` VALUES (364, 'K21-1cm ( KT 180 x 200cm )', '0', '1000', 'styrofoam', 10, 'Chỉ mua khổ 180 x 200cm, giá là 22.2 triệu/ tấn', 1, NULL, '2025-01-16 16:06:29', '2025-01-16 16:17:42', 1);
INSERT INTO `supply_prices` VALUES (365, 'K21-1.2cm ( KT 180 x 200cm )', '0', '1200', 'styrofoam', 10, 'Chỉ mua khổ 180 x 200cm, giá là 15.2778 triệu/ tấn', 1, NULL, '2025-01-16 16:06:56', '2025-01-16 16:19:34', 1);
INSERT INTO `supply_prices` VALUES (366, 'K21-1.5cm ( KT 180 x 200cm )', '0', '1500', 'styrofoam', 10, 'Chỉ mua khổ 180 x 200cm, giá là 15.2778 triệu/ tấn', 1, NULL, '2025-01-16 16:07:07', '2025-01-16 16:19:46', 1);
INSERT INTO `supply_prices` VALUES (367, 'K21-1.8cm ( KT 180 x 200cm )', '0', '1800', 'styrofoam', 10, 'Chỉ mua khổ 180 x 200cm, giá là 22.2 triệu/ tấn', 1, NULL, '2025-01-16 16:07:21', '2025-01-16 16:18:26', 1);
INSERT INTO `supply_prices` VALUES (368, 'K21-2cm ( KT 180 x 200cm )', '0', '2000', 'styrofoam', 10, 'Chỉ mua khổ 180 x 200cm, giá là 15.2778 triệu/ tấn', 1, NULL, '2025-01-16 16:07:32', '2025-01-16 16:19:53', 1);
INSERT INTO `supply_prices` VALUES (369, 'K21-2.5cm ( KT 180 x 200cm )', '0', '2500', 'styrofoam', 10, 'Chỉ mua khổ 180 x 200cm, giá là 15.2778 triệu/ tấn', 1, NULL, '2025-01-16 16:07:54', '2025-01-16 16:19:58', 1);
INSERT INTO `supply_prices` VALUES (370, 'K21-3cm ( KT 180 x 200cm )', '0', '3000', 'styrofoam', 10, 'Chỉ mua khổ 180 x 200cm, giá là 15.2778 triệu/ tấn', 1, NULL, '2025-01-16 16:08:06', '2025-01-16 16:20:04', 1);
INSERT INTO `supply_prices` VALUES (371, 'K21-3.5cm ( KT 180 x 200cm )', '0', '3500', 'styrofoam', 10, 'Chỉ mua khổ 180 x 200cm, giá là 15.2778 triệu/ tấn', 1, NULL, '2025-01-16 16:08:19', '2025-01-16 16:20:10', 1);
INSERT INTO `supply_prices` VALUES (372, 'K21-4cm ( KT 180 x 200cm )', '0', '4000', 'styrofoam', 10, 'Chỉ mua khổ 180 x 200cm, giá là 15.2778 triệu/ tấn', 1, NULL, '2025-01-16 16:08:32', '2025-01-16 16:20:16', 1);
INSERT INTO `supply_prices` VALUES (373, 'K30-0.5cm ( KT 180 x 200cm )', '0', '500', 'styrofoam', 9, 'Chỉ mua 180 x 200cm, giá 22.22 triệu/ tấn', 1, NULL, '2025-01-16 16:23:04', '2025-01-16 16:23:04', 1);
INSERT INTO `supply_prices` VALUES (374, 'K30-0.8cm ( KT 180 x 200cm )', '0', '800', 'styrofoam', 9, 'Chỉ mua 180 x 200cm, giá 22.22 triệu/ tấn', 1, NULL, '2025-01-16 16:26:08', '2025-01-16 16:26:08', 1);
INSERT INTO `supply_prices` VALUES (375, 'K30-1cm ( KT 180 x 200cm )', '0', '1000', 'styrofoam', 9, 'Chỉ mua 180 x 200cm, giá 22.22 triệu/ tấn', 1, NULL, '2025-01-16 16:26:23', '2025-01-16 16:27:18', 1);
INSERT INTO `supply_prices` VALUES (376, 'K30-1.2cm ( KT 180 x 200cm )', '0', '1200', 'styrofoam', 9, 'Chỉ mua 180 x 200cm, giá 22.22 triệu/ tấn', 1, NULL, '2025-01-16 16:27:31', '2025-01-16 16:27:31', 1);
INSERT INTO `supply_prices` VALUES (377, 'K30-1.5cm ( KT 180 x 200cm )', '0', '1500', 'styrofoam', 9, 'Chỉ mua 180 x 200cm, giá 22.22 triệu/ tấn', 1, NULL, '2025-01-16 16:27:43', '2025-01-16 16:27:43', 1);
INSERT INTO `supply_prices` VALUES (378, 'K30-1.8cm ( KT 180 x 200cm )', '0', '1800', 'styrofoam', 9, 'Chỉ mua 180 x 200cm, giá 22.22 triệu/ tấn', 1, NULL, '2025-01-16 16:27:54', '2025-01-16 16:27:54', 1);
INSERT INTO `supply_prices` VALUES (379, 'K30-2cm ( KT 180 x 200cm )', '0', '2000', 'styrofoam', 9, 'Chỉ mua 180 x 200cm, giá 22.22 triệu/ tấn', 1, NULL, '2025-01-16 16:28:10', '2025-01-16 16:28:10', 1);
INSERT INTO `supply_prices` VALUES (380, 'K30-2.5cm ( KT 180 x 200cm )', '0', '2500', 'styrofoam', 9, 'Chỉ mua 180 x 200cm, giá 22.22 triệu/ tấn', 1, NULL, '2025-01-16 16:28:25', '2025-01-16 16:28:25', 1);
INSERT INTO `supply_prices` VALUES (381, 'K30-3cm ( KT 180 x 200cm )', '0', '3000', 'styrofoam', 9, 'Chỉ mua 180 x 200cm, giá 22.22 triệu/ tấn', 1, NULL, '2025-01-16 16:28:38', '2025-01-16 16:28:38', 1);
INSERT INTO `supply_prices` VALUES (382, 'K30-3.5cm ( KT 180 x 200cm )', '0', '3500', 'styrofoam', 9, 'Chỉ mua 180 x 200cm, giá 22.22 triệu/ tấn', 1, NULL, '2025-01-16 16:28:53', '2025-01-16 16:28:53', 1);
INSERT INTO `supply_prices` VALUES (383, 'K30-4cm ( KT 180 x 200cm )', '0', '4000', 'styrofoam', 9, 'Chỉ mua 180 x 200cm, giá 22.22 triệu/ tấn', 1, NULL, '2025-01-16 16:29:07', '2025-01-16 16:29:07', 1);
INSERT INTO `supply_prices` VALUES (384, 'K40-0.5cm ( KT 180 x 200cm )', '0', '500', 'styrofoam', 8, 'Chỉ mua khổ 180 x 200cm, giá là 29.1666 triệu/ tấn', 1, NULL, '2025-01-16 16:36:06', '2025-01-16 16:36:06', 1);
INSERT INTO `supply_prices` VALUES (385, 'K40-0.8cm ( KT 180 x 200cm )', '0', '800', 'styrofoam', 8, 'Chỉ mua khổ 180 x 200cm, giá là 29.1666 triệu/ tấn', 1, NULL, '2025-01-16 16:36:19', '2025-01-16 16:36:19', 1);
INSERT INTO `supply_prices` VALUES (386, 'K40-1cm ( KT 180 x 200cm )', '0', '1000', 'styrofoam', 8, 'Chỉ mua khổ 180 x 200cm, giá là 29.1666 triệu/ tấn', 1, NULL, '2025-01-16 16:36:31', '2025-01-16 16:36:31', 1);
INSERT INTO `supply_prices` VALUES (387, 'K40-1.2cm ( KT 180 x 200cm )', '0', '1200', 'styrofoam', 8, 'Chỉ mua khổ 180 x 200cm, giá là 29.1666 triệu/ tấn', 1, NULL, '2025-01-16 16:36:43', '2025-01-16 16:36:43', 1);
INSERT INTO `supply_prices` VALUES (388, 'K40-1.5cm ( KT 180 x 200cm )', '0', '1500', 'styrofoam', 8, 'Chỉ mua khổ 180 x 200cm, giá là 29.1666 triệu/ tấn', 1, NULL, '2025-01-16 16:36:54', '2025-01-16 16:36:54', 1);
INSERT INTO `supply_prices` VALUES (389, 'K40-1.8cm ( KT 180 x 200cm )', '0', '1800', 'styrofoam', 8, 'Chỉ mua khổ 180 x 200cm, giá là 29.1666 triệu/ tấn', 1, NULL, '2025-01-16 16:37:16', '2025-01-16 16:37:16', 1);
INSERT INTO `supply_prices` VALUES (390, 'K40-2cm ( KT 180 x 200cm )', '0', '2000', 'styrofoam', 8, 'Chỉ mua khổ 180 x 200cm, giá là 29.1666 triệu/ tấn', 1, NULL, '2025-01-16 16:37:30', '2025-01-16 16:37:30', 1);
INSERT INTO `supply_prices` VALUES (391, 'K40-2.5cm ( KT 180 x 200cm )', '0', '2500', 'styrofoam', 8, 'Chỉ mua khổ 180 x 200cm, giá là 29.1666 triệu/ tấn', 1, NULL, '2025-01-16 16:37:41', '2025-01-16 16:37:41', 1);
INSERT INTO `supply_prices` VALUES (392, 'K40-3cm ( KT 180 x 200cm )', '0', '3000', 'styrofoam', 8, 'Chỉ mua khổ 180 x 200cm, giá là 29.1666 triệu/ tấn', 1, NULL, '2025-01-16 16:37:55', '2025-01-16 16:37:55', 1);
INSERT INTO `supply_prices` VALUES (393, 'K40-3.5cm ( KT 180 x 200cm )', '0', '3500', 'styrofoam', 8, 'Chỉ mua khổ 180 x 200cm, giá là 29.1666 triệu/ tấn', 1, NULL, '2025-01-16 16:38:06', '2025-01-16 16:38:06', 1);
INSERT INTO `supply_prices` VALUES (394, 'K40-4cm ( KT 180 x 200cm )', '0', '4000', 'styrofoam', 8, 'Chỉ mua khổ 180 x 200cm, giá là 29.1666 triệu/ tấn', 1, NULL, '2025-01-16 16:38:17', '2025-01-16 16:38:17', 1);
INSERT INTO `supply_prices` VALUES (395, 'CSN -0.3cm ( KT 125 x 250cm )', '0', '300', 'rubber', 51, 'Chỉ mua KT 125 x 250cm, giá 35.2 triệu/ tấn', 1, NULL, '2025-01-16 16:46:16', '2025-01-16 16:47:30', 1);
INSERT INTO `supply_prices` VALUES (396, 'CSN -0.5cm ( KT 125 x 250 )', '0', '500', 'rubber', 51, 'Chỉ mua KT 125 x 250cm, giá 35.2 triệu/ tấn', 1, NULL, '2025-01-16 16:46:27', '2025-01-16 16:47:37', 1);
INSERT INTO `supply_prices` VALUES (397, 'CSN -0.8cm ( KT 125 x 250 )', '0', '800', 'rubber', 51, 'Chỉ mua KT 125 x 250cm, giá 35.2 triệu/ tấn', 1, NULL, '2025-01-16 16:47:48', '2025-01-16 16:47:48', 1);
INSERT INTO `supply_prices` VALUES (398, 'CSN -1cm ( KT 125 x 250 )', '0', '1000', 'rubber', 51, 'Chỉ mua KT 125 x 250cm, giá 35.2 triệu/ tấn', 1, NULL, '2025-01-16 16:47:59', '2025-01-16 16:47:59', 1);
INSERT INTO `supply_prices` VALUES (399, 'CSN -1.2cm ( KT 125 x 250 )', '0', '1200', 'rubber', 51, 'Chỉ mua KT 125 x 250cm, giá 35.2 triệu/ tấn', 1, NULL, '2025-01-16 16:48:15', '2025-01-16 16:48:15', 1);
INSERT INTO `supply_prices` VALUES (400, 'CSN -1.5cm ( KT 125 x 250 )', '0', '1500', 'rubber', 51, 'Chỉ mua KT 125 x 250cm, giá 35.2 triệu/ tấn', 1, NULL, '2025-01-16 16:48:25', '2025-01-16 16:48:25', 1);
INSERT INTO `supply_prices` VALUES (401, 'CSN -1.8cm ( KT 125 x 250 )', '0', '1800', 'rubber', 51, 'Chỉ mua KT 125 x 250cm, giá 35.2 triệu/ tấn', 1, NULL, '2025-01-16 16:48:38', '2025-01-16 16:48:38', 1);
INSERT INTO `supply_prices` VALUES (402, 'CSN -2cm ( KT 125 x 250 )', '0', '2000', 'rubber', 51, 'Chỉ mua KT 125 x 250cm, giá 35.2 triệu/ tấn', 1, NULL, '2025-01-16 16:48:51', '2025-01-16 16:48:51', 1);
INSERT INTO `supply_prices` VALUES (403, 'CSN -2.5cm ( KT 125 x 250 )', '0', '2500', 'rubber', 51, 'Chỉ mua KT 125 x 250cm, giá 35.2 triệu/ tấn', 1, NULL, '2025-01-16 16:49:10', '2025-01-16 16:49:10', 1);
INSERT INTO `supply_prices` VALUES (404, 'CSN -3cm ( KT 125 x 250 )', '0', '3000', 'rubber', 51, 'Chỉ mua KT 125 x 250cm, giá 35.2 triệu/ tấn', 1, NULL, '2025-01-16 16:49:21', '2025-01-16 16:49:21', 1);
INSERT INTO `supply_prices` VALUES (405, 'CSN -3.5cm ( KT 125 x 250 )', '0', '3500', 'rubber', 51, 'Chỉ mua KT 125 x 250cm, giá 35.2 triệu/ tấn', 1, NULL, '2025-01-16 16:49:31', '2025-01-16 16:49:31', 1);
INSERT INTO `supply_prices` VALUES (406, 'CSN -4cm ( KT 125 x 250 )', '0', '4000', 'rubber', 51, 'Chỉ mua KT 125 x 250cm, giá 35.2 triệu/ tấn', 1, NULL, '2025-01-16 16:49:41', '2025-01-16 16:49:41', 1);
INSERT INTO `supply_prices` VALUES (409, 'MÀU ĐỎ - nhập KT 150 x 9100cm', '0', '100', 'decal', 48, NULL, 1, NULL, '2025-01-16 17:43:49', '2025-01-16 17:49:45', 1);
INSERT INTO `supply_prices` VALUES (410, 'MÀU XANH - nhập KT 150 x 9100cm', '0', '100', 'decal', 48, NULL, 1, NULL, '2025-01-16 17:45:44', '2025-01-16 17:50:05', 1);
INSERT INTO `supply_prices` VALUES (411, 'MÀU VÀNG - nhập KT 150 x 9100cm', '0', '100', 'decal', 48, NULL, 1, NULL, '2025-01-16 17:45:56', '2025-01-16 17:50:25', 1);
INSERT INTO `supply_prices` VALUES (412, 'MÀU TRẮNG - nhập KT 150 x 9100cm', '0', '100', 'decal', 48, NULL, 1, NULL, '2025-01-16 17:46:09', '2025-01-16 17:50:37', 1);
INSERT INTO `supply_prices` VALUES (413, 'MÀU VÀNG - nhập KT 150 x 9100cm', '0', '10', 'silk', 26, NULL, 1, NULL, '2025-01-16 18:02:18', '2025-01-16 18:03:52', 1);
INSERT INTO `supply_prices` VALUES (414, 'PHI BÓNG - nhập KT 150 x 9100cm', '0', '10', 'silk', 26, NULL, 1, NULL, '2025-01-16 18:07:22', '2025-01-16 18:07:22', 1);
INSERT INTO `supply_prices` VALUES (415, 'BĂNG LÔNG NHUNG - nhập KT 150 x 9100cm', '0', '10', 'silk', 26, NULL, 1, NULL, '2025-01-16 18:09:11', '2025-01-16 18:09:11', 1);
INSERT INTO `supply_prices` VALUES (416, 'BẠC THƯỜNG Mã - KT 65 x 24000cm', '0', '10', 'emulsion', 69, 'công thức đã chuẩn', 1, NULL, '2025-01-16 18:23:39', '2025-01-16 20:19:13', 1);
INSERT INTO `supply_prices` VALUES (417, 'BẠC 7 MÀU Mã - KT 65 x 24000cm', '0', '10', 'emulsion', 69, 'công thức đã chuẩn', 0, NULL, '2025-01-16 20:19:30', '2025-01-16 20:19:30', 1);
INSERT INTO `supply_prices` VALUES (418, 'KEO NHIỆT BỒI HỘP Mã 301', '0', '1', 'skrink', 70, NULL, 1, NULL, '2025-01-16 20:57:35', '2025-01-16 21:01:28', 1);
INSERT INTO `supply_prices` VALUES (419, 'KEO NHIỆT BỒI HỘP - Mã 301', '0', '1', 'other_supply', 39, NULL, 1, NULL, '2025-01-17 01:29:24', '2025-01-17 01:45:46', 1);
INSERT INTO `supply_prices` VALUES (420, 'KEO NHIỆT BỒI HỘP - Mã 308', '0', '1', 'other_supply', 39, NULL, 1, NULL, '2025-01-17 01:31:34', '2025-01-17 01:45:57', 1);
INSERT INTO `supply_prices` VALUES (421, 'KEO SỮA', '0', '1', 'other_supply', 39, NULL, 1, NULL, '2025-01-17 01:32:16', '2025-01-17 01:46:12', 1);
INSERT INTO `supply_prices` VALUES (422, 'MỰC IN OFFSET - C', '0', '1', 'other_supply', 38, NULL, 1, NULL, '2025-01-17 01:35:06', '2025-01-17 01:35:06', 1);
INSERT INTO `supply_prices` VALUES (423, 'MỰC IN OFFSET - M', '0', '1', 'other_supply', 38, NULL, 1, NULL, '2025-01-17 01:35:24', '2025-01-17 01:35:24', 1);
INSERT INTO `supply_prices` VALUES (424, 'MỰC IN OFFSET - Y', '0', '1', 'other_supply', 38, NULL, 1, NULL, '2025-01-17 01:35:34', '2025-01-17 01:35:34', 1);
INSERT INTO `supply_prices` VALUES (425, 'MỰC IN OFFSET - K', '0', '1', 'other_supply', 38, NULL, 1, NULL, '2025-01-17 01:35:45', '2025-01-17 01:35:45', 1);
INSERT INTO `supply_prices` VALUES (426, 'TAY XÁCH - Mã TD 01', '0', '1', 'other_supply', 40, NULL, 1, NULL, '2025-01-17 01:50:20', '2025-01-17 01:50:20', 1);
INSERT INTO `supply_prices` VALUES (427, 'TƠ BÓNG 4 - Màu Vàng', '0', '1', 'other_supply', 41, NULL, 1, NULL, '2025-01-17 01:52:34', '2025-01-17 01:52:34', 1);
INSERT INTO `supply_prices` VALUES (428, 'TƠ BÓNG 5 - Màu Vàng', '0', '1', 'other_supply', 41, NULL, 1, NULL, '2025-01-17 01:52:47', '2025-01-17 01:52:55', 1);
INSERT INTO `supply_prices` VALUES (429, 'MÀNG CO - Khổ 65', '0', '1', 'other_supply', 42, NULL, 1, NULL, '2025-01-17 01:56:24', '2025-01-17 01:56:24', 1);
INSERT INTO `supply_prices` VALUES (430, 'Dây CUROA - Bản 1 x 20 x 4550mm', '0', '1', 'other_supply', 43, NULL, 1, NULL, '2025-01-17 02:05:05', '2025-01-17 02:05:05', 1);

SET FOREIGN_KEY_CHECKS = 1;
