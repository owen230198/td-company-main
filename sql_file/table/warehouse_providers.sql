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

 Date: 15/01/2025 18:16:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for warehouse_providers
-- ----------------------------
DROP TABLE IF EXISTS `warehouse_providers`;
CREATE TABLE `warehouse_providers`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã nhóm',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Tên nhóm',
  `contacter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Cha',
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
) ENGINE = InnoDB AUTO_INCREMENT = 91 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of warehouse_providers
-- ----------------------------
INSERT INTO `warehouse_providers` VALUES (49, 'GIẤY ANH ĐẠT', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-09-25 20:55:27', '2023-09-29 15:49:01', 10);
INSERT INTO `warehouse_providers` VALUES (50, 'GIẤY VẠN PHÚ GIA', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-09-25 20:55:48', '2023-09-29 15:49:15', 10);
INSERT INTO `warehouse_providers` VALUES (51, 'GIẤY NGỌC VIỆT', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-09-25 20:55:57', '2023-09-29 15:49:26', 10);
INSERT INTO `warehouse_providers` VALUES (52, 'CAO SU NON ĐẠI THÀNH', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-09-29 15:50:29', '2023-09-29 15:50:29', 1);
INSERT INTO `warehouse_providers` VALUES (53, 'VŨ GIA', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-09-29 15:50:41', '2023-09-29 15:50:41', 1);
INSERT INTO `warehouse_providers` VALUES (54, 'PHƯƠNG ANH', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-09-29 15:51:00', '2023-09-29 15:51:00', 1);
INSERT INTO `warehouse_providers` VALUES (55, 'GOLD SUN', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-04-09 15:56:20', '2024-04-09 15:56:20', 23);
INSERT INTO `warehouse_providers` VALUES (56, 'HÒA TRUNG', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-04-12 14:24:43', '2024-04-12 14:24:43', 23);
INSERT INTO `warehouse_providers` VALUES (57, 'HƯNG TIẾN', NULL, '000', 'Đuôi cá', '[\"nilon\",\"metalai\"]', NULL, 1, NULL, '2024-04-12 14:25:03', '2025-01-11 17:42:42', 23);
INSERT INTO `warehouse_providers` VALUES (58, 'Tâm Thủy', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-04-24 14:00:25', '2024-04-24 14:00:25', 23);
INSERT INTO `warehouse_providers` VALUES (59, 'carton Hà Tây', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-04-24 14:00:47', '2024-04-24 14:00:47', 23);
INSERT INTO `warehouse_providers` VALUES (60, 'vinaphat', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-05-23 08:12:59', '2024-05-23 08:12:59', 6);
INSERT INTO `warehouse_providers` VALUES (61, 'SANSIN', NULL, '0906868361', 'BẮC NINH', '[\"nilon\",\"decal\",\"emulsion\",\"magnet\"]', NULL, 1, NULL, '2024-05-23 09:39:04', '2025-01-11 17:40:53', 6);
INSERT INTO `warehouse_providers` VALUES (62, 'decan linh hiếu', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-05-27 16:48:26', '2024-05-27 16:48:26', 6);
INSERT INTO `warehouse_providers` VALUES (63, 'hiền đồng xuân', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-05-29 16:15:52', '2024-05-29 16:15:52', 6);
INSERT INTO `warehouse_providers` VALUES (64, 'HUYỀN THÁI TRIỀU KHÚC', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-07-24 10:54:30', '2024-07-24 10:54:30', 18);
INSERT INTO `warehouse_providers` VALUES (65, 'A ĐỒng triều khúc', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-07-27 08:23:35', '2024-07-27 08:23:35', 18);
INSERT INTO `warehouse_providers` VALUES (66, 'MỰC UV DKT', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-07-27 15:20:12', '2024-07-27 15:20:12', 18);
INSERT INTO `warehouse_providers` VALUES (67, 'HOÀ KHÍ', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-07-27 15:20:35', '2024-07-27 15:20:35', 18);
INSERT INTO `warehouse_providers` VALUES (68, 'AN HÙNG MINH', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-07-31 14:31:03', '2024-07-31 14:31:03', 18);
INSERT INTO `warehouse_providers` VALUES (69, 'MUA NGOÀI', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-08-01 08:30:03', '2024-08-01 08:30:03', 18);
INSERT INTO `warehouse_providers` VALUES (70, 'Linh Duy', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-08-03 13:41:41', '2024-08-03 13:41:41', 6);
INSERT INTO `warehouse_providers` VALUES (71, 'BAO BÌ PHƯƠNG ANH', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-08-10 16:04:35', '2024-08-10 16:04:35', 18);
INSERT INTO `warehouse_providers` VALUES (72, 'CARTON GP Việt nam', NULL, '0965633395', 'Hoàng Dương - ứng Hòa', '[\"carton\"]', NULL, 1, NULL, '2024-08-13 15:36:10', '2025-01-12 14:15:37', 6);
INSERT INTO `warehouse_providers` VALUES (73, 'C LOAN DÂY TÚI TRIỀU KHÚC', NULL, NULL, NULL, NULL, NULL, 1, '0', '2024-08-17 10:05:26', '2024-08-17 10:05:26', 18);
INSERT INTO `warehouse_providers` VALUES (74, 'ENOMI NHŨ, BÓNG KÍNH', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-08-23 08:37:39', '2024-08-23 08:37:39', 18);
INSERT INTO `warehouse_providers` VALUES (75, 'keo bồi đỉnh vàng', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-08-28 15:37:40', '2024-08-28 15:37:40', 18);
INSERT INTO `warehouse_providers` VALUES (76, 'DECAN NHẬT LINH', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-08-29 14:35:43', '2024-08-29 14:35:43', 18);
INSERT INTO `warehouse_providers` VALUES (77, 'Toàn Cầu- cồn', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-09-24 16:24:17', '2024-09-24 16:24:17', 18);
INSERT INTO `warehouse_providers` VALUES (78, 'Ngọc diệp', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-09-25 16:27:18', '2024-09-25 16:27:18', 18);
INSERT INTO `warehouse_providers` VALUES (79, 'Nhà CC palet gỗ', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-10-02 09:06:20', '2024-10-02 09:06:20', 18);
INSERT INTO `warehouse_providers` VALUES (80, 'Palet nhựa', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-10-03 08:32:09', '2024-10-03 08:32:09', 18);
INSERT INTO `warehouse_providers` VALUES (81, 'Keo cán nước Hằng Lực', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-10-03 13:48:08', '2024-10-03 13:48:08', 18);
INSERT INTO `warehouse_providers` VALUES (82, 'A Quốc chun buộc', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-10-05 16:26:12', '2024-10-05 16:26:12', 18);
INSERT INTO `warehouse_providers` VALUES (83, 'Giẻ lau máy thiên bằng', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-10-08 15:54:11', '2024-10-08 15:54:11', 18);
INSERT INTO `warehouse_providers` VALUES (84, 'CARTON MAK', NULL, '0936523563', 'Từ châu - Thanh oai', '[\"carton\"]', NULL, 1, NULL, '2024-10-23 16:26:46', '2025-01-12 14:12:08', 18);
INSERT INTO `warehouse_providers` VALUES (85, 'CARTON TIẾN VĂN', NULL, '0989878760', 'Từ châu - Thanh oai', '[\"carton\"]', NULL, 1, NULL, '2024-10-29 14:12:00', '2025-01-12 14:13:20', 18);
INSERT INTO `warehouse_providers` VALUES (86, 'Caton Thành Phúc', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-11-06 08:59:51', '2024-11-06 08:59:51', 18);
INSERT INTO `warehouse_providers` VALUES (87, 'A Cường việt tiến', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-11-09 10:28:08', '2024-11-09 10:28:08', 18);
INSERT INTO `warehouse_providers` VALUES (88, 'Nhũ Thành Tín', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-11-14 08:31:04', '2024-11-14 08:31:04', 18);
INSERT INTO `warehouse_providers` VALUES (89, 'Kho xưởng', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-12-13 10:53:46', '2024-12-13 10:53:46', 18);
INSERT INTO `warehouse_providers` VALUES (90, 'GIẤY BAO BÌ HÀ NỘI', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-01-11 16:24:22', '2025-01-11 16:24:22', 1);

SET FOREIGN_KEY_CHECKS = 1;
