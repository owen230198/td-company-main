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

 Date: 20/01/2025 11:34:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for materals
-- ----------------------------
DROP TABLE IF EXISTS `materals`;
CREATE TABLE `materals`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã nhóm',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Tên nhóm',
  `price` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `factor` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Cha',
  `default` tinyint(4) NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Ghi chú',
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `ord` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 60 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of materals
-- ----------------------------
INSERT INTO `materals` VALUES (3, 'IN MỰC PHỦ MỜ', '0.08', NULL, 'cover', 1, '0.08 = 800đ/m2', 1, '2023-07-17 20:26:21', '2023-09-16 01:59:46', 0, NULL);
INSERT INTO `materals` VALUES (10, 'MỰC UV - BÓNG', '0', NULL, 'uv', 1, 'CT này không áp dụng tính khách hàng, chỉ áp dụng đo lường vật tư', 1, '2023-07-17 20:26:21', '2025-01-17 02:22:48', 0, NULL);
INSERT INTO `materals` VALUES (11, 'MỰC UV - SẦN CÁT', '0', NULL, 'uv', 1, 'CT này không áp dụng tính khách hàng, chỉ áp dụng đo lường vật tư', 1, '2023-07-17 20:26:21', '2025-01-17 02:23:05', 0, NULL);
INSERT INTO `materals` VALUES (12, 'GIẤY COUCHES ok', '0.00224', NULL, 'paper', 0, '0.0022 = 22triệu/ tấn', 1, '2023-07-17 20:26:21', '2025-01-12 15:30:34', 0, NULL);
INSERT INTO `materals` VALUES (13, 'GIẤY IVOLRY ok', '0.00187', NULL, 'paper', 0, '0.00192 = 19.2 triệu/ tấn', 1, '2023-07-17 20:26:21', '2025-01-12 15:30:42', 0, NULL);
INSERT INTO `materals` VALUES (14, 'GIẤY DUPLEX ok', '0.0016', NULL, 'paper', 0, '0.00145 = 16 triệu/ tấn', 1, '2023-07-17 20:26:21', '2025-01-12 15:30:49', 0, NULL);
INSERT INTO `materals` VALUES (15, 'GIẤY OFFSET', '0.0028', NULL, 'paper', 0, '0.0024 = 24 triệu/ tấn', 1, '2023-07-17 20:26:21', '2023-08-08 14:55:23', 0, NULL);
INSERT INTO `materals` VALUES (16, 'CHI PHÍ BỒI NẮP', '0.5', NULL, 'fill', 0, '0.5 = 5000đ/m2 keo bồi ( CT dành cho tính chi phí keo bồi )', 1, '2023-08-14 17:23:12', '2024-05-24 08:37:03', 0, NULL);
INSERT INTO `materals` VALUES (17, 'Nam châm nhỏ  ( KHÔNG PHÙ HỢP CÔNG THỨC NÀY )', '500', NULL, 'magnet', 0, '0', 1, '2023-08-14 12:39:31', '2025-01-12 15:33:15', 1, NULL);
INSERT INTO `materals` VALUES (18, 'CHI PHÍ BỒI ĐÁY', '0.5', NULL, 'fill', 0, '0.5 = 5000đ/m2 keo bồi ( CT dành cho tính chi phí keo bồi )', 1, '2023-08-14 17:23:49', '2024-05-24 08:36:58', 0, NULL);
INSERT INTO `materals` VALUES (19, 'CHI PHÍ BỒI THÀNH', '0.5', NULL, 'fill', 0, '0.5 = 5000đ/m2 keo bồi ( CT dành cho tính chi phí keo bồi )', 1, '2023-07-20 10:21:00', '2024-05-24 08:36:47', 1, NULL);
INSERT INTO `materals` VALUES (20, 'CHI PHÍ BỒI BÌA', '0.5', NULL, 'fill', 0, '0.5 = 5000đ/m2 keo bồi ( CT dành cho tính chi phí keo bồi )', 1, '2023-07-20 10:21:00', '2024-05-24 08:36:41', 1, NULL);
INSERT INTO `materals` VALUES (21, 'CHI PHÍ BỒI MẶT THÉP', '0.5', NULL, 'fill', 0, '0.5 = 5000đ/m2 keo bồi ( CT dành cho tính chi phí keo bồi )', 1, '2023-07-20 10:21:00', '2024-05-24 08:36:36', 1, NULL);
INSERT INTO `materals` VALUES (23, 'CHI PHÍ KHAY ĐỊNH HÌNH', '0.2', NULL, 'fill', 0, '0.5 = 5000đ/m2 keo bồi ( CT dành cho tính chi phí keo bồi )', 1, '2023-07-20 10:21:00', '2024-06-16 17:16:24', 1, NULL);
INSERT INTO `materals` VALUES (24, 'CHI PHÍ BỒI MẶT PHẲNG', '0.2', NULL, 'fill', 0, '0.5 = 5000đ/m2 keo bồi ( CT dành cho tính chi phí keo bồi )', 1, '2023-07-20 10:21:00', '2024-06-16 17:15:17', 1, NULL);
INSERT INTO `materals` VALUES (26, 'VẢI LỤA THƯỜNG', '0.6', NULL, 'silk', 0, '1.5m = 8000đ/đ\r\n1m = 6000đ cả công cắt lụa', 1, '2023-08-14 17:51:05', '2024-04-11 16:55:20', 1, NULL);
INSERT INTO `materals` VALUES (27, 'CHI PHÍ BỒI PHỤ KIỆN', '0.5', NULL, 'fill', NULL, '0.5 = 5000đ/m2 keo bồi ( CT dành cho tính chi phí keo bồi )', 1, '2023-09-15 05:11:08', '2024-05-24 08:36:04', 1, NULL);
INSERT INTO `materals` VALUES (29, 'IN MỰC PHỦ BÓNG', '0.08', NULL, 'cover', 1, '0.08 = 800đ/m2', 1, '2023-09-16 01:59:37', '2023-09-16 01:59:37', 1, NULL);
INSERT INTO `materals` VALUES (30, 'PHỦ BÓNG GỐC DẦU - CTY NHẬT SƠN', '1.5', NULL, 'cover', 1, '1.5 = 1500đ/m2', 1, '2023-09-16 02:00:33', '2023-09-16 02:00:33', 1, NULL);
INSERT INTO `materals` VALUES (31, 'Nam châm nhỡ', '800', NULL, 'magnet', 0, '0', 1, '2023-09-16 02:54:18', '2023-09-16 02:54:18', 1, NULL);
INSERT INTO `materals` VALUES (32, 'Nam châm to', '1200', NULL, 'magnet', 0, '0', 1, '2023-09-16 02:54:37', '2023-09-16 02:54:37', 1, NULL);
INSERT INTO `materals` VALUES (33, 'GIẤY MỸ THUẬT ĐEN', '0.005', NULL, 'paper', 0, '0.005 = 50 triệu/ tấn', 1, '2023-09-19 01:14:55', '2023-09-19 01:27:48', 1, NULL);
INSERT INTO `materals` VALUES (34, 'ĐỀ CAN GIẤY', '0.0033', NULL, 'paper', 0, '0.0032 = 32 triệu/ tấn', 1, '2023-09-26 18:05:21', '2023-10-04 06:40:53', 1, NULL);
INSERT INTO `materals` VALUES (39, 'GIẤY DL 181gmr', '0.00155', NULL, 'paper', 0, '0.00155 = 15.5 triệu/ tấn', 1, '2024-06-22 15:05:16', '2024-06-22 15:06:24', 1, NULL);
INSERT INTO `materals` VALUES (40, 'GIẤY GOLDSUN 450mgr', '0.00105', NULL, 'paper', 0, '0.00105 = 10.5 triệu/ tấn', 1, '2024-06-22 15:50:13', '2024-06-22 15:50:13', 1, NULL);
INSERT INTO `materals` VALUES (46, 'MÀNG BÓNG - MỜ - METALAI BẠC ok', '0', '757600', 'nilon', 0, '0.9 = 9000đ/m2', 1, '2024-07-02 09:25:55', '2025-01-12 15:31:11', 1, NULL);
INSERT INTO `materals` VALUES (47, 'GIẤY KRAP', '0.0015', NULL, 'paper', NULL, NULL, 1, '2024-07-12 14:32:15', '2024-09-09 21:33:58', 10, NULL);
INSERT INTO `materals` VALUES (48, 'ĐỀ CAN NHUNG - LÔNG NGẮN', '0', NULL, 'decal', 0, NULL, 1, '2024-07-12 14:44:03', '2025-01-16 17:47:29', 10, NULL);
INSERT INTO `materals` VALUES (57, 'Màng METALAI - METALAI ĐẶC BIỆT ok', '0.8', NULL, 'metalai', 1, '0.8 = 8000d/ M2', 1, '2024-10-07 11:09:42', '2025-01-12 15:31:20', 1, NULL);
INSERT INTO `materals` VALUES (58, 'GIẤY COUCHES 100-300', '0.0021', NULL, 'paper', 0, '0.0022 = 22triệu/ tấn', 1, '2025-01-10 12:34:10', '2025-01-10 12:34:10', 1, NULL);
INSERT INTO `materals` VALUES (59, 'ĐỀ CAN NHUNG - LÔNG DÀI chưa có giá', '0', NULL, 'decal', 0, NULL, 1, '2025-01-16 17:53:31', '2025-01-16 17:57:47', 1, NULL);

SET FOREIGN_KEY_CHECKS = 1;
