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

 Date: 15/01/2025 15:20:26
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
) ENGINE = InnoDB AUTO_INCREMENT = 361 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `supply_prices` VALUES (61, 'Mút phẳng K21-0.3cm', '0.44', NULL, 'styrofoam', 10, '1: giá gốc NCC ĐẠI THÀNH là 35k  ( Khổ 1.5 x 1.9m Loại dày 1cm )\r\n2: giá bán cho khách hàng 35k x 1.20% = 42k ( Khổ 1.5 x 1.9m = 2.85m2 ) tăng 20% để bù hao CP khác\r\n( ghi chú: 1m2 = 14.730đ )', 1, NULL, '2023-07-20 10:21:00', '2025-01-06 20:35:51', 0);
INSERT INTO `supply_prices` VALUES (64, 'Mút phẳng K30-0.3cm', '0.9', NULL, 'styrofoam', 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-07-20 10:21:00', '2025-01-06 20:35:51', 0);
INSERT INTO `supply_prices` VALUES (67, 'Mút phẳng K40-0.3cm', '1.14', NULL, 'styrofoam', 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-07-20 10:21:00', '2025-01-06 20:35:51', 0);
INSERT INTO `supply_prices` VALUES (68, '0.5cm', '60000', NULL, 'styrofoam', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (69, '0.8cm', '60000', NULL, 'styrofoam', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (72, '1 cm', '6', NULL, 'styrofoam', 7, '60.000đ/m2 ( Cao su non 35k/m2 + Nhung 25k/m2 )', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1);
INSERT INTO `supply_prices` VALUES (105, 'Carton 0.8ly', '0.01', '560', 'carton', 21, '0.01 là 10 triệu 1 tấn', 1, NULL, '2023-07-20 10:21:00', '2025-01-12 14:24:09', 0);
INSERT INTO `supply_prices` VALUES (154, 'Cao su non bồi nhung 0.8cm', '1', NULL, 'rubber', 22, NULL, 1, NULL, '2023-07-20 10:21:00', '2025-01-10 17:17:10', 1);
INSERT INTO `supply_prices` VALUES (155, 'Cao su non bồi nhung 1cm', '14.6', NULL, 'rubber', 23, NULL, 1, NULL, '2023-07-20 10:21:00', '2025-01-10 17:17:14', 1);
INSERT INTO `supply_prices` VALUES (172, 'PET 0.15', '200', NULL, 'mica', 37, NULL, 1, NULL, '2023-07-20 10:21:00', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (184, 'Mút phẳng K21-0.5cm', '0.73', NULL, 'styrofoam', 10, '1: giá gốc NCC ĐẠI THÀNH là 35k  ( Khổ 1.5 x 1.9m Loại dày 1cm )\r\n2: giá bán cho khách hàng 35k x 1.20% = 42k ( Khổ 1.5 x 1.9m = 2.85m2 ) tăng 20% để bù hao CP khác\r\n( ghi chú: 1m2 = 14.730đ )', 1, NULL, '2023-09-16 02:34:50', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (185, 'Mút phẳng K21-0.8cm', '1.17', NULL, 'styrofoam', 10, '1: giá gốc NCC ĐẠI THÀNH là 35k  ( Khổ 1.5 x 1.9m Loại dày 1cm )\r\n2: giá bán cho khách hàng 35k x 1.20% = 42k ( Khổ 1.5 x 1.9m = 2.85m2 ) tăng 20% để bù hao CP khác\r\n( ghi chú: 1m2 = 14.730đ )', 1, NULL, '2023-09-16 02:35:23', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (186, 'Mút phẳng K21-1cm', '1.473', NULL, 'styrofoam', 10, '1: giá gốc NCC ĐẠI THÀNH là 35k  ( Khổ 1.5 x 1.9m Loại dày 1cm )\r\n2: giá bán cho khách hàng 35k x 1.20% = 42k ( Khổ 1.5 x 1.9m = 2.85m2 ) tăng 20% để bù hao CP khác\r\n( ghi chú: 1m2 = 14.730đ )', 1, NULL, '2023-09-16 02:35:55', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (187, 'Mút phẳng K21-1.2cm', '1.76', NULL, 'styrofoam', 10, '1: giá gốc NCC ĐẠI THÀNH là 35k  ( Khổ 1.5 x 1.9m Loại dày 1cm )\r\n2: giá bán cho khách hàng 35k x 1.20% = 42k ( Khổ 1.5 x 1.9m = 2.85m2 ) tăng 20% để bù hao CP khác\r\n( ghi chú: 1m2 = 14.730đ )', 1, NULL, '2023-09-16 02:36:22', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (188, 'Mút phẳng K21-1.5cm', '2.2', NULL, 'styrofoam', 10, '1: giá gốc NCC ĐẠI THÀNH là 35k  ( Khổ 1.5 x 1.9m Loại dày 1cm )\r\n2: giá bán cho khách hàng 35k x 1.20% = 42k ( Khổ 1.5 x 1.9m = 2.85m2 ) tăng 20% để bù hao CP khác\r\n( ghi chú: 1m2 = 14.730đ ) )', 1, NULL, '2023-09-16 02:36:39', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (190, 'Mút phẳng K21-1.8cm', '2.64', NULL, 'styrofoam', 10, '1: giá gốc NCC ĐẠI THÀNH là 35k  ( Khổ 1.5 x 1.9m Loại dày 1cm )\r\n2: giá bán cho khách hàng 35k x 1.20% = 42k ( Khổ 1.5 x 1.9m = 2.85m2 ) tăng 20% để bù hao CP khác\r\n( ghi chú: 1m2 = 14.730đ )', 1, NULL, '2023-09-16 02:37:14', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (191, 'Mút phẳng K21-2cm', '2.94', NULL, 'styrofoam', 10, 'giá nhà đại thành 18k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:37:31', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (192, 'Mút phẳng K21-2.5cm', '3.675', NULL, 'styrofoam', 10, '1: giá gốc NCC ĐẠI THÀNH là 35k  ( Khổ 1.5 x 1.9m Loại dày 1cm )\r\n2: giá bán cho khách hàng 35k x 1.20% = 42k ( Khổ 1.5 x 1.9m = 2.85m2 ) tăng 20% để bù hao CP khác\r\n( ghi chú: 1m2 = 14.730đ )', 1, NULL, '2023-09-16 02:38:07', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (193, 'Mút phẳng K21-3cm', '4.42', NULL, 'styrofoam', 10, '1: giá gốc NCC ĐẠI THÀNH là 35k  ( Khổ 1.5 x 1.9m Loại dày 1cm )\r\n2: giá bán cho khách hàng 35k x 1.20% = 42k ( Khổ 1.5 x 1.9m = 2.85m2 ) tăng 20% để bù hao CP khác\r\n( ghi chú: 1m2 = 14.730đ )', 1, NULL, '2023-09-16 02:38:21', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (194, 'Mút phẳng K21-3.5cm', '5.15', NULL, 'styrofoam', 10, '1: giá gốc NCC ĐẠI THÀNH là 35k  ( Khổ 1.5 x 1.9m Loại dày 1cm )\r\n2: giá bán cho khách hàng 35k x 1.20% = 42k ( Khổ 1.5 x 1.9m = 2.85m2 ) tăng 20% để bù hao CP khác\r\n( ghi chú: 1m2 = 14.730đ )', 1, NULL, '2023-09-16 02:38:34', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (195, 'Mút phẳng K21-4cm', '5.89', NULL, 'styrofoam', 10, '1: giá gốc NCC ĐẠI THÀNH là 35k  ( Khổ 1.5 x 1.9m Loại dày 1cm )\r\n2: giá bán cho khách hàng 35k x 1.20% = 42k ( Khổ 1.5 x 1.9m = 2.85m2 ) tăng 20% để bù hao CP khác\r\n( ghi chú: 1m2 = 14.730đ )', 1, NULL, '2023-09-16 02:39:09', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (196, 'Mút phẳng K30-0.5cm', '1.5', NULL, 'styrofoam', 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:43:20', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (197, 'Mút phẳng K30-0.8cm', '2.4', NULL, 'styrofoam', 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:43:32', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (198, 'Mút phẳng K30-1cm', '3', NULL, 'styrofoam', 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:43:44', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (199, 'Mút phẳng K30-1.2cm', '3.6', NULL, 'styrofoam', 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:44:04', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (200, 'Mút phẳng K30-1.5cm', '4.5', NULL, 'styrofoam', 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:44:22', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (201, 'Mút phẳng K30-1.8cm', '5.4', NULL, 'styrofoam', 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:44:37', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (202, 'Mút phẳng K30-2cm', '7', NULL, 'styrofoam', 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:44:51', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (203, 'Mút phẳng K30-2.5cm', '87.5', NULL, 'styrofoam', 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:45:07', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (204, 'Mút phẳng K30-3cm', '10.05', NULL, 'styrofoam', 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:45:49', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (205, 'Mút phẳng K30-3.5cm', '12.25', NULL, 'styrofoam', 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:46:10', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (206, 'Mút phẳng K30-4cm', '14', NULL, 'styrofoam', 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:46:24', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (207, 'Mút phẳng K40-0.5cm', '19', NULL, 'styrofoam', 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:48:52', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (208, 'Mút phẳng K40-0.8cm', '3.04', NULL, 'styrofoam', 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:49:21', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (209, 'Mút phẳng K40-1cm', '3.8', NULL, 'styrofoam', 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:49:36', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (210, 'Mút phẳng K40-1.2cm', '4.56', NULL, 'styrofoam', 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:49:55', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (211, 'Mút phẳng K40-1.5cm', '5.7', NULL, 'styrofoam', 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:50:14', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (212, 'Mút phẳng K40-1.8cm', '6.84', NULL, 'styrofoam', 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:50:33', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (213, 'Mút phẳng K40-2cm', '8.6', NULL, 'styrofoam', 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:50:46', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (214, 'Mút phẳng K40-2.5cm', '10.75', NULL, 'styrofoam', 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:51:00', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (215, 'Mút phẳng K40-3cm', '12.9', NULL, 'styrofoam', 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:51:13', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (216, 'Mút phẳng K40-3.5cm', '15.05', NULL, 'styrofoam', 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:51:30', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (217, 'Mút phẳng K40-4cm', '17.2', NULL, 'styrofoam', 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:51:45', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (225, 'PET 0.18', '200', NULL, 'mica', 37, NULL, 1, NULL, '2024-01-10 10:13:35', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (226, 'PET 0.2', '200', NULL, 'mica', 37, NULL, 1, NULL, '2024-01-10 10:13:47', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (227, 'PET 0.25', '200', NULL, 'mica', 37, NULL, 1, NULL, '2024-01-10 10:13:53', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (228, 'PET 0.3', '200', NULL, 'mica', 37, NULL, 1, NULL, '2024-01-10 10:14:09', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (229, 'PET 0.4', '200', NULL, 'mica', 37, NULL, 1, NULL, '2024-01-10 10:14:15', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (230, 'PET 0.5', '200', NULL, 'mica', 37, NULL, 1, NULL, '2024-01-10 10:14:23', '2025-01-06 20:35:51', 1);
INSERT INTO `supply_prices` VALUES (233, 'CAO SU NON 0.3cm', '0', '0.3', 'rubber', 51, NULL, 1, NULL, '2023-07-20 03:21:00', '2025-01-12 15:22:42', 1);
INSERT INTO `supply_prices` VALUES (234, 'CAO SU NON 0.5cm', '0', '0.5', 'rubber', 51, NULL, 1, NULL, '2023-07-20 03:21:00', '2025-01-12 15:23:15', 1);
INSERT INTO `supply_prices` VALUES (235, 'CAO SU NON 0.8cm', '0', '0.8', 'rubber', 51, NULL, 1, NULL, '2023-07-20 03:21:00', '2025-01-12 15:23:46', 1);
INSERT INTO `supply_prices` VALUES (236, 'CAO SU NON 1cm', '0', '1', 'rubber', 51, '1cm = 10', 1, NULL, '2023-07-20 03:21:00', '2025-01-12 15:27:00', 1);
INSERT INTO `supply_prices` VALUES (237, 'CAO SU NON 1.3cm', '0', '1.3', 'rubber', 51, NULL, 1, NULL, '2023-07-20 03:21:00', '2025-01-12 15:24:11', 1);
INSERT INTO `supply_prices` VALUES (238, 'CAO SU NON 1.5cm', '0', '1.5', 'rubber', 51, NULL, 1, NULL, '2023-07-20 03:21:00', '2025-01-12 15:24:36', 1);
INSERT INTO `supply_prices` VALUES (239, 'CAO SU NON 1.8cm', '0', '1.8', 'rubber', 51, NULL, 1, NULL, '2023-07-20 03:21:00', '2025-01-12 15:25:13', 1);
INSERT INTO `supply_prices` VALUES (240, 'CAO SU NON 2cm', '0', '2', 'rubber', 51, NULL, 1, NULL, '2023-07-20 03:21:00', '2025-01-12 15:25:33', 1);
INSERT INTO `supply_prices` VALUES (241, 'CAO SU NON 2.5cm', '0', '2.5', 'rubber', 51, NULL, 1, NULL, '2023-07-20 03:21:00', '2025-01-12 15:25:51', 1);
INSERT INTO `supply_prices` VALUES (242, 'CAO SU NON 3cm', '0', '3', 'rubber', 51, NULL, 1, NULL, '2023-07-20 03:21:00', '2025-01-12 15:26:12', 1);
INSERT INTO `supply_prices` VALUES (243, 'CAO SU NON 3.5cm', '0', '3.5', 'rubber', 51, NULL, 1, NULL, '2023-07-20 03:21:00', '2025-01-12 15:26:34', 1);
INSERT INTO `supply_prices` VALUES (244, 'CAO SU NON 4cm', '0', '4', 'rubber', 51, NULL, 1, NULL, '2023-07-20 03:21:00', '2025-01-12 15:26:51', 1);
INSERT INTO `supply_prices` VALUES (284, 'MÀNG BÓNG NƯỚC 12mic', '0', '0.0011', 'nilon', 8, '0.0011 là định lượng của 12mic màng nước', 1, NULL, '2025-01-10 09:43:46', '2025-01-10 13:50:06', 1);
INSERT INTO `supply_prices` VALUES (285, 'MÀNG BÓNG NƯỚC 15mic', '0', '0.0014', 'nilon', 8, '0.0014 là định lượng của 15mic màng nước', 1, NULL, '2025-01-10 09:45:05', '2025-01-10 09:48:13', 1);
INSERT INTO `supply_prices` VALUES (286, 'MÀNG NHIỆT 12mic', '0', '0.00154', 'nilon', 9, '0.00154 Là định lượng của màng nhiệt 12 mic', 1, NULL, '2025-01-10 09:50:02', '2025-01-10 09:50:02', 1);
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
INSERT INTO `supply_prices` VALUES (358, 'SÓNG E 2 lớp', '0', '1', 'carton', 48, 'Quy định sóng E là 1', 1, NULL, '2025-01-12 14:37:58', '2025-01-12 14:46:49', 1);
INSERT INTO `supply_prices` VALUES (359, 'SÓNG E 3 lớp', '0.1', '1', 'carton', 48, 'Quy định sóng E là 1', 1, NULL, '2025-01-12 14:38:16', '2025-01-12 14:46:58', 1);
INSERT INTO `supply_prices` VALUES (360, 'LÔNG TRẮNG - Ngắn', '0', '10', 'decal', 48, 'Đối với nhung tính định lượng là 100mgr', 1, NULL, '2025-01-15 06:18:20', '2025-01-15 06:31:31', 1);

SET FOREIGN_KEY_CHECKS = 1;
