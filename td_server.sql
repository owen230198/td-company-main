/*
 Navicat Premium Data Transfer

 Source Server         : owen
 Source Server Type    : MySQL
 Source Server Version : 100425
 Source Host           : localhost:3306
 Source Schema         : td_server

 Target Server Type    : MySQL
 Target Server Version : 100425
 File Encoding         : 65001

 Date: 18/11/2023 07:17:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for c_designs
-- ----------------------------
DROP TABLE IF EXISTS `c_designs`;
CREATE TABLE `c_designs`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `order` int(10) NULL DEFAULT NULL,
  `product` int(10) NULL DEFAULT NULL,
  `customer` int(10) NULL DEFAULT NULL,
  `demo_expired` datetime(0) NULL DEFAULT NULL,
  `expired` datetime(0) NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `assign_by` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_designs
-- ----------------------------
INSERT INTO `c_designs` VALUES (1, 'TK-DH-000001A', NULL, 1, 2, NULL, NULL, NULL, NULL, 'design_submited', 1, 4, 3, '2023-09-23 15:36:57', '2023-09-23 15:41:36');
INSERT INTO `c_designs` VALUES (2, 'TK-DH-000002A', NULL, 2, 4, NULL, NULL, NULL, NULL, 'design_submited', 1, 4, 3, '2023-09-23 16:15:31', '2023-09-23 16:16:14');
INSERT INTO `c_designs` VALUES (3, 'TK-DH-000004A', NULL, 4, 6, NULL, NULL, NULL, NULL, 'design_submited', 1, 4, 3, '2023-09-23 19:10:26', '2023-09-23 19:12:28');
INSERT INTO `c_designs` VALUES (4, 'TK-DH-000005A', NULL, 5, 9, NULL, NULL, NULL, NULL, 'design_submited', 1, 4, 3, '2023-09-24 08:45:40', '2023-09-24 08:47:08');
INSERT INTO `c_designs` VALUES (5, 'TK-DH-000007A', NULL, 7, 13, NULL, NULL, NULL, NULL, 'design_submited', 1, 4, 3, '2023-09-24 15:55:14', '2023-09-24 15:56:10');
INSERT INTO `c_designs` VALUES (6, 'TK-DH-000015A', NULL, 15, 25, NULL, NULL, NULL, NULL, 'design_submited', 1, 4, 3, '2023-09-28 14:07:27', '2023-09-28 14:15:18');
INSERT INTO `c_designs` VALUES (7, 'TK-DH-000012A', NULL, 12, 24, NULL, NULL, NULL, NULL, 'design_submited', 1, 4, 3, '2023-09-28 15:13:59', '2023-09-28 16:15:56');
INSERT INTO `c_designs` VALUES (8, 'TK-DH-000011A', NULL, 11, 23, NULL, NULL, NULL, NULL, 'design_submited', 1, 4, 3, '2023-09-28 15:14:31', '2023-09-28 15:29:49');
INSERT INTO `c_designs` VALUES (9, 'TK-DH-000014A', NULL, 14, 18, NULL, NULL, NULL, NULL, 'design_submited', 1, 4, 3, '2023-09-28 15:20:13', '2023-09-28 16:31:18');
INSERT INTO `c_designs` VALUES (10, 'TK-DH-000009A', NULL, 9, 17, NULL, NULL, NULL, NULL, 'design_submited', 1, 4, 3, '2023-09-28 15:20:44', '2023-09-28 16:05:54');
INSERT INTO `c_designs` VALUES (14, 'TK-DH-000010A', NULL, 10, 1, NULL, NULL, NULL, NULL, 'design_submited', 1, 4, 3, '2023-09-28 17:59:20', '2023-09-29 16:10:30');
INSERT INTO `c_designs` VALUES (15, 'TK-DH-000016A', NULL, 16, 27, NULL, NULL, NULL, NULL, 'design_submited', 1, 4, 3, '2023-09-29 15:26:41', '2023-09-29 15:27:45');
INSERT INTO `c_designs` VALUES (16, 'TK-DH-000018A', NULL, 18, 36, NULL, NULL, NULL, NULL, 'design_submited', 1, 4, 3, '2023-10-04 06:53:59', '2023-10-04 06:56:06');
INSERT INTO `c_designs` VALUES (17, 'TK-DH-000021A', NULL, 21, 52, NULL, NULL, NULL, NULL, 'design_submited', 1, 4, 3, '2023-10-07 08:07:21', '2023-10-07 08:12:55');
INSERT INTO `c_designs` VALUES (18, 'TK-DH-000020A', NULL, 20, 53, NULL, NULL, NULL, NULL, 'design_submited', 1, 4, 3, '2023-10-07 08:07:45', '2023-10-07 08:12:16');
INSERT INTO `c_designs` VALUES (19, 'TK-DH-000019A', NULL, 19, 54, NULL, NULL, NULL, NULL, 'design_submited', 1, 4, 3, '2023-10-07 08:08:48', '2023-10-07 08:11:49');

-- ----------------------------
-- Table structure for c_processes
-- ----------------------------
DROP TABLE IF EXISTS `c_processes`;
CREATE TABLE `c_processes`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `order_expired` datetime(0) NULL DEFAULT NULL,
  `expired` datetime(0) NULL DEFAULT NULL,
  `json_data_conf` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` int(1) NULL DEFAULT NULL,
  `assign_by` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `product_id` int(10) NULL DEFAULT NULL,
  `order_id` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for c_supplies
-- ----------------------------
DROP TABLE IF EXISTS `c_supplies`;
CREATE TABLE `c_supplies`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `size_type` int(10) NULL DEFAULT NULL,
  `qty` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `product` int(10) NULL DEFAULT NULL,
  `supply` int(10) NULL DEFAULT NULL,
  `supp_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_supplies
-- ----------------------------
INSERT INTO `c_supplies` VALUES (3, 'XVT-000003', 1, '10857.5', 9, 17, 'nilon', NULL, 'handled', 1, 6, '2023-09-24 10:59:53', '2023-09-24 10:59:53');
INSERT INTO `c_supplies` VALUES (5, 'XVT-000005', 2, '50500', 13, 27, 'nilon', NULL, 'handled', 1, 6, '2023-09-24 16:09:51', '2023-09-24 16:09:51');

-- ----------------------------
-- Table structure for configs
-- ----------------------------
DROP TABLE IF EXISTS `configs`;
CREATE TABLE `configs`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `keyword` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `act` tinyint(1) NULL DEFAULT 0,
  `view_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ord` int(10) NULL DEFAULT NULL COMMENT 'Sắp xếp',
  `default_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `required` tinyint(4) NULL DEFAULT NULL,
  `region` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`, `keyword`) USING BTREE,
  INDEX `_index`(`id`, `keyword`, `act`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of configs
-- ----------------------------
INSERT INTO `configs` VALUES (1, 'app_name', 'APP_NAME', 'Tuan Dung app', 1, 'text', 'Tên phần mềm', 0, NULL, NULL, '1', '2023-05-16 21:51:59', '2023-05-16 21:52:03');
INSERT INTO `configs` VALUES (2, 'timezone', 'TIMEZONE', 'Asia/Ho_Chi_Minh', 1, 'text', 'Múi giờ', 0, NULL, NULL, '1', '2023-05-16 22:15:15', '2023-05-16 22:15:15');
INSERT INTO `configs` VALUES (3, 'mail_host', 'MAIL_HOST', 'smtp.gmail.com', 1, 'text', 'Mail host', 0, NULL, NULL, '1', '2023-05-16 23:41:06', '2023-05-16 23:41:06');
INSERT INTO `configs` VALUES (4, 'mail_port', 'MAIL_PORT', '587', 1, 'text', 'Mail port', 0, NULL, NULL, '1', '2023-05-16 23:41:15', '2023-05-16 23:41:15');
INSERT INTO `configs` VALUES (5, 'mail_encryption', 'MAIL_ENCRYPTION', 'tls', 1, 'text', 'Giao thức gửi mail', 0, NULL, NULL, '1', '2023-05-16 23:44:05', '2023-05-16 23:44:05');
INSERT INTO `configs` VALUES (6, 'mail_username', 'MAIL_USERNAME', 'nguyenduykhanh2323@gmail.com', 1, 'text', 'Mail gửi', 0, NULL, NULL, '1', '2023-05-16 23:42:40', '2023-05-16 23:42:40');
INSERT INTO `configs` VALUES (7, 'mail_password', 'MAIL_PASSWORD', 'pass23', 1, 'text', 'Mail gửi', 0, NULL, NULL, '1', '2023-05-16 23:42:38', '2023-05-16 23:42:38');

-- ----------------------------
-- Table structure for customer_user
-- ----------------------------
DROP TABLE IF EXISTS `customer_user`;
CREATE TABLE `customer_user`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`, `customer_id`, `user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `contacter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `manager` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `telephone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tax_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name_index`(`name`) USING BTREE,
  INDEX `infor_index`(`address`, `email`, `phone`) USING BTREE,
  INDEX `conttacter_index`(`contacter`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, 'KH-000001', 'CTY CP THƯƠNG MẠI DƯỢC PHẨM BIGFAM', 'Ms Thảo', NULL, '0325544040', '0325544040', 'zalo', 'Tòa R2 TTTM Royal City, 72A Nguyễn Trãi - Thanh Xuân - HN', '351', NULL, NULL, '1', 1, '2023-09-23 11:10:31', '2023-09-24 08:40:12', 1);
INSERT INTO `customers` VALUES (3, 'KH-000002', 'CÔNG TY DỆT MAY THÀNH VƯỢNG', 'Ms Hằng', NULL, '0979359387', '0979359387', 'zalo', 'Hoa sơn - Ứng hòa - Hà nội', '351', NULL, NULL, '1', 1, '2023-09-23 13:39:43', '2023-09-24 08:40:12', 1);
INSERT INTO `customers` VALUES (4, 'KH-000004', 'CTY TNHH VIETBRAND', 'Phương', NULL, '0977070289', '0977070289', 'Phuongn@vietbrandco.vn', 'Hà Nam', '9047', NULL, NULL, '1', 1, '2023-09-23 13:42:14', '2023-10-20 18:55:52', 1);
INSERT INTO `customers` VALUES (5, 'KH-000005', 'CTY DƯỢC PHẨM DIAMOND PHÁP', 'Ms Hải', NULL, '0917129458', '0917129458', 'zalo', 'KCN Đồng Văn - Hà Nam', '9047', NULL, NULL, '1', 1, '2023-09-23 14:16:26', '2023-09-24 08:40:12', 1);
INSERT INTO `customers` VALUES (6, 'KH-000006', 'CTY TNHH IN & SẢN XUẤT BAO BÌ NGHỆ AN', 'Mr Dũng', NULL, '0912188628', '0912188628', 'zalo', 'TP Vinh - Nghệ An', '4230', NULL, NULL, '1', 1, '2023-09-23 14:18:56', '2023-09-24 08:40:12', 1);
INSERT INTO `customers` VALUES (7, 'KH-000007', 'CÔNG TY DƯỢC PHẨM NOVA PHÁP', 'Mr Hải', NULL, '0914755299', '0914755299', 'zalo', 'TP Nam Định', '7474', NULL, NULL, '1', 1, '2023-09-23 14:22:24', '2023-09-24 08:40:12', 1);
INSERT INTO `customers` VALUES (8, 'KH-000008', 'CTY HATACHI', 'Mr Phúc', NULL, '0358866868', '0358866868', 'zalo', 'Trung Kính - HN', '351', NULL, NULL, '1', 1, '2023-09-23 14:32:18', '2023-09-24 08:40:12', 1);
INSERT INTO `customers` VALUES (9, 'KH-000009', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', NULL, '0963303999', '02438303888', 'kd1.intuandung@gmail.com', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', '351', NULL, NULL, '1', 1, '2023-09-23 14:34:33', '2023-09-24 08:40:12', 1);
INSERT INTO `customers` VALUES (10, 'KH-000010', 'Công ty TNHH phát triển y tế USA', 'Ms Dịu', NULL, '0983 580 635', '0983 580 635', 'chưa có', 'NV1 Số 38 Tổng Cục V Tân Triều Thanh Trì TP.Hà Nội', '351', NULL, NULL, '1', 1, '2023-09-26 14:37:54', '2023-09-26 14:37:54', 10);
INSERT INTO `customers` VALUES (11, 'KH-000011', 'CÔNG TY TNHH ĐẦU TƯ XUẤT NHẬP KHẨU VÀ THƯƠNG MẠI THÀNH ĐỨC', 'Anh Cương', NULL, '0988373219', '0988373219', 'zalo', 'Số 3B, Ngách 144/4, Phố Quan Nhân, Phường Nhân Chính, Quận Thanh Xuân, Thành phố Hà Nội', '7474', NULL, 'TP Ninh bình 0988373219', '1', 1, '2023-09-26 16:14:25', '2023-09-26 16:14:25', 10);
INSERT INTO `customers` VALUES (12, 'KH-000012', 'CÔNG TY DƯỢC PHẨM HADIPHACO', 'Mr Hải', NULL, '0968 754 654', '0968 754 654', 'duocphamhadiphaco@gmail.com', 'Số 65 ngõ 173/192 Lê Trọng Tấn, Định Công, Hoàng Mai, HN', '351', NULL, NULL, '1', 1, '2023-09-26 16:51:54', '2023-09-26 16:51:54', 10);
INSERT INTO `customers` VALUES (13, 'KH-000013', 'Công ty TNHH dược phẩm Blue pharma', 'Mr Hải', NULL, '0968754654', '0968754654', 'zalo', 'Số nhà 22, ngách 50/37 Đường Khuyến Lương, Trần phú', '351', NULL, NULL, '1', 1, '2023-09-26 16:59:34', '2023-09-26 16:59:34', 10);
INSERT INTO `customers` VALUES (14, 'KH-000014', 'CÔNG TY CP DƯỢC MỸ PHẨM OLYMPUS', 'Mr Tú', NULL, '0966969622', '0966969622', 'zalo', 'Ngõ 77 Bùi Xương Trạch - Thanh Xuân - HN', '351', NULL, NULL, '1', 1, '2023-09-28 10:01:06', '2023-09-28 10:01:06', 10);
INSERT INTO `customers` VALUES (15, 'KH-000015', 'CÔNG TY TNHH ĐẦU TƯ THƯƠNG MẠI THẢO DƯỢC GLOBAL PHARMA', 'Mr Dự', NULL, '0982123263', '0982123263', 'globalpharma88@gmail.com', 'Số 63 ngõ 172/92 Lê trọng Tấn, Định Công, Hoàng Mai, HN', '351', NULL, NULL, '1', 1, '2023-09-28 11:16:29', '2023-09-28 11:16:29', 10);
INSERT INTO `customers` VALUES (16, 'KH-000016', 'CÔNG TY TNHH ECOPHAR VIỆT NAM', 'Mr Cường', NULL, '0987608052', '0987608052', 'zalo', 'Số 12, ngõ 4 Đường Đào Nguyên, Châu Quì, Gia Lâm, HN', '351', NULL, NULL, '1', 1, '2023-09-28 11:32:08', '2023-09-28 11:32:08', 10);
INSERT INTO `customers` VALUES (17, 'KH-000017', 'CÔNG TY TNHH DƯỢC PHẨM MAILISA GROUP', 'Chị Phương', NULL, '0908737986', '0908737986', 'mainguyendv@gmail.com', 'Nhà LK2, lô 3, khu đô thị 379, đường Phan Bá Vành', '5922', NULL, NULL, '1', 1, '2023-09-30 14:11:20', '2023-09-30 14:11:20', 10);
INSERT INTO `customers` VALUES (18, 'KH-000018', 'Công ty cổ phần LáArt', 'Lê Bắc', NULL, '0373375882', '0373375882', 'zalo', 'Số 66 Nguyễn Thái Học, Ba Đình, Hn', '351', NULL, NULL, '2', 1, '2023-10-09 14:57:14', '2023-10-09 14:57:14', 10);
INSERT INTO `customers` VALUES (19, 'KH-000019', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', NULL, '0963303999', '02438303888', 'kd1.intuandung@gmail.com', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', NULL, NULL, NULL, '0', 1, '2023-10-14 16:05:24', '2023-10-14 16:05:24', 1);
INSERT INTO `customers` VALUES (20, 'KH-000020', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', NULL, '0963303999', '02438303888', 'kd1.intuandung@gmail.com', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', NULL, NULL, NULL, '0', 1, '2023-10-19 15:10:12', '2023-10-19 15:10:12', 1);
INSERT INTO `customers` VALUES (21, 'KH-000021', 'CÔNG TY HNA', 'Mr Đức', NULL, '0382700882', '0382700882', 'zalo', '171 Kim Mã - HN', '351', NULL, NULL, '1', 1, '2023-11-02 08:41:33', '2023-11-02 08:41:33', 1);

-- ----------------------------
-- Table structure for design_types
-- ----------------------------
DROP TABLE IF EXISTS `design_types`;
CREATE TABLE `design_types`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `index`(`id`, `name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of design_types
-- ----------------------------
INSERT INTO `design_types` VALUES (1, 'Thiết kế mới', 1, 1, '2023-03-11 15:10:23', '2023-03-11 15:10:23');
INSERT INTO `design_types` VALUES (2, 'Chế bản', 1, 1, '2023-03-11 15:10:23', '2023-03-11 15:10:23');
INSERT INTO `design_types` VALUES (3, 'File cũ có chỉnh sửa', 1, 1, '2023-03-11 15:10:23', '2023-03-11 15:10:23');
INSERT INTO `design_types` VALUES (4, 'File cũ không chỉnh sửa', 1, 1, '2023-03-11 15:10:23', '2023-03-11 15:10:23');
INSERT INTO `design_types` VALUES (5, 'File khách hàng gửi', 1, 1, '2023-03-11 15:10:23', '2023-03-11 15:10:23');

-- ----------------------------
-- Table structure for devices
-- ----------------------------
DROP TABLE IF EXISTS `devices`;
CREATE TABLE `devices`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã nhóm',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Tên nhóm',
  `model_price` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `work_price` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `shape_price` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `w_work_price` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `w_shape_price` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `key_device` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `supply` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `default_device` tinyint(4) NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Ghi chú',
  `act` tinyint(4) NULL DEFAULT NULL,
  `ord` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 69 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of devices
-- ----------------------------
INSERT INTO `devices` VALUES (2, 'TỰ ĐỘNG', '0', '0', '100000', '25', '50000', 'compress', 'auto', 'paper', 1, NULL, 1, 0, '2023-05-23 17:01:35', '2023-09-10 15:15:53', 0);
INSERT INTO `devices` VALUES (4, 'BÁN TỰ ĐỘNG', '150', '150', '100000', '50', '50000', 'elevate', 'semi_auto', 'paper', 0, '150đ/cm ( Ví dụ: 43 x 65 x 150 = 420.000đ tiền khuôn', 1, 0, '2023-05-23 17:01:35', '2023-09-14 21:43:48', 0);
INSERT INTO `devices` VALUES (6, 'TỰ ĐỘNG', '0', '50', '100000', '10', '25000', 'box_paste', 'auto', 'paper', NULL, NULL, 1, 0, '2023-05-23 17:01:35', '2023-09-14 21:44:17', 0);
INSERT INTO `devices` VALUES (7, 'TỰ ĐỘNG', '0', '150', '100000', '25', '35000', 'mill', 'auto', 'carton', 0, NULL, 1, 0, '2023-05-23 17:01:35', '2023-09-14 20:46:18', 0);
INSERT INTO `devices` VALUES (8, 'MÁY CÁN NHIỆT', '0', '0', '50000', '40', '25000', 'nilon', 'semi_auto', 'paper', 0, NULL, 1, 1, '2023-05-23 17:01:35', '2023-09-14 19:25:01', 1);
INSERT INTO `devices` VALUES (9, 'THỦY LỰC - ÉP THỦ CÔNG', '0', '0', '100000', '50', '35000', 'compress', 'semi_auto', 'paper', NULL, NULL, 1, 1, '2023-05-23 17:01:35', '2023-10-06 12:54:13', 0);
INSERT INTO `devices` VALUES (10, 'BÁN TỰ ĐỘNG', '80', '600', '200000', '150', '100000', 'uv', 'semi_auto', 'paper', NULL, NULL, 1, 1, '2023-05-23 17:01:35', '2023-09-14 21:43:09', 0);
INSERT INTO `devices` VALUES (12, 'BÓC LỀ', '0', '10', '30000', '5', '0', 'peel', 'semi_auto', 'paper', NULL, NULL, 1, 1, '2023-05-23 17:01:35', '2023-09-14 19:27:03', 0);
INSERT INTO `devices` VALUES (13, 'THỦ CÔNG', '0', '200', '50000', '80', '25000', 'box_paste', 'semi_auto', 'paper', NULL, NULL, 1, 1, '2023-05-23 17:01:35', '2023-10-06 12:57:34', 0);
INSERT INTO `devices` VALUES (14, 'MÁY PHAY BÁN TỰ ĐỘNG', '0', '130', '100000', '35', '35000', 'mill', 'semi_auto', 'carton', NULL, NULL, 0, 1, '2023-05-23 17:01:35', '2023-09-14 20:45:34', 0);
INSERT INTO `devices` VALUES (16, 'MÁY CÁN METALAI - THUÊ BÊN NGOÀI', '0', '0', '100000', '0', '0', 'metalai', 'auto', 'paper', NULL, NULL, 1, 1, '2023-05-23 17:01:35', '2023-09-14 21:57:38', 1);
INSERT INTO `devices` VALUES (18, 'MÁY XÉN', '0', '80', '100000', '0', '10000', 'cut', 'semi_auto', 'carton', 0, NULL, 1, 1, '2023-05-23 17:01:35', '2023-10-06 13:09:44', 0);
INSERT INTO `devices` VALUES (19, 'Máy thúc nổi carton', '0', '200', '100000', '50', '50000', 'float', 'auto', 'paper', NULL, 'Chưa có máy', 0, 0, '2023-05-23 17:01:35', '2023-10-01 14:48:51', 0);
INSERT INTO `devices` VALUES (21, 'BÁN TỰ ĐỘNG', '150', '150', '100000', '50', '50000', 'elevate', 'semi_auto', 'carton', 0, '150đ/cm áp dụng cho tất cả các khuôn máy bế, Khuôn phức tạp + thêm ngoài theo cảm nhận', 1, 1, '2023-05-23 17:01:35', '2023-09-14 20:44:21', 0);
INSERT INTO `devices` VALUES (23, 'BÁN TỰ ĐỘNG', '150', '1000', '100000', '500', '50000', 'elevate', 'semi_auto', 'rubber', 0, NULL, 1, 1, '2023-05-23 17:01:35', '2023-09-14 20:50:42', 0);
INSERT INTO `devices` VALUES (25, 'BÁN TỰ ĐỘNG', '150', '1000', '100000', '500', '50000', 'elevate', 'semi_auto', 'styrofoam', NULL, '150d/cm', 1, 1, '2023-05-23 17:01:35', '2023-10-01 14:57:22', 0);
INSERT INTO `devices` VALUES (26, 'Máy bế tự động', '0', '100', '100000', '0', '0', 'elevate', 'auto', 'mica', NULL, NULL, 1, 0, '2023-05-23 17:01:35', '2023-09-10 15:15:53', 0);
INSERT INTO `devices` VALUES (27, 'Máy bế bán tự động', '0', '150', '100000', '0', '0', 'elevate', 'semi_auto', 'mica', NULL, NULL, 1, 1, '2023-05-23 17:01:35', '2023-09-10 15:17:44', 0);
INSERT INTO `devices` VALUES (29, 'MÁY XÉN', '0', '200', '100000', '0', '0', 'cut', 'semi_auto', 'rubber', 0, NULL, 1, 1, '2023-05-23 17:01:35', '2023-10-06 13:16:01', 0);
INSERT INTO `devices` VALUES (31, 'BÁN TỰ ĐỘNG', '0', '100', '50000', '0', '0', 'cut', 'semi_auto', 'decal', NULL, NULL, 1, 1, '2023-05-23 17:01:35', '2023-10-06 13:18:01', 0);
INSERT INTO `devices` VALUES (33, 'Máy xén bán tự động', '0', '100', '50000', '0', '0', 'cut', 'semi_auto', 'silk', NULL, NULL, 1, 1, '2023-05-23 17:01:35', '2023-10-06 13:18:20', 0);
INSERT INTO `devices` VALUES (35, 'MÁY XÉN', '0', '150', '50000', '0', '0', 'cut', 'semi_auto', 'styrofoam', NULL, NULL, 1, 1, '2023-05-23 17:01:35', '2023-10-06 13:16:45', 0);
INSERT INTO `devices` VALUES (37, 'Máy xén bán tự động', '0', '100', '50000', '0', '0', 'cut', 'semi_auto', 'mica', NULL, NULL, 1, 1, '2023-05-23 17:01:35', '2023-10-06 13:18:44', 0);
INSERT INTO `devices` VALUES (39, 'BÓC LỀ CARTON', '0', '20', '20000', '8', '0', 'peel', 'semi_auto', 'carton', 0, NULL, 1, 1, '2023-05-23 17:01:35', '2023-09-14 20:49:08', 0);
INSERT INTO `devices` VALUES (41, 'BÓC LỀ', '0', '30', '20000', '15', '0', 'peel', 'semi_auto', 'rubber', NULL, NULL, 1, 1, '2023-05-23 17:01:35', '2023-09-14 20:51:34', 0);
INSERT INTO `devices` VALUES (43, 'BÁN TỰ ĐỘNG', '0', '30', '20000', '15', '0', 'peel', 'semi_auto', 'styrofoam', NULL, NULL, 1, 1, '2023-05-23 17:01:35', '2023-10-06 13:17:44', 0);
INSERT INTO `devices` VALUES (45, 'Máy bóc lề bán tự động', '0', '15', '20000', '6', '0', 'peel', 'semi_auto', 'mica', NULL, NULL, 1, 1, '2023-05-23 17:01:35', '2023-10-01 15:00:35', 0);
INSERT INTO `devices` VALUES (46, 'MÁY CÁN NƯỚC - THUÊ BÊN NGOÀI', '0', '0', '50000', '0', '0', 'nilon', 'auto', 'paper', 0, NULL, 1, NULL, '2023-05-23 17:01:35', '2023-09-10 15:17:15', 1);
INSERT INTO `devices` VALUES (48, 'MÁY BỒI', '0', '500', '300000', '140', '100000', 'fill', 'semi_auto', 'fill_finish', 0, NULL, 1, NULL, '2023-05-23 17:01:35', '2023-10-06 13:27:03', 0);
INSERT INTO `devices` VALUES (49, 'Túi giấy khổ in  43 x 65', '150', '1360', '100000', '440', '50000', 'bag_paste', 'semi_auto', 'paper', NULL, '150d/cm', 1, NULL, '2023-05-23 17:01:35', '2023-10-01 08:49:33', 1);
INSERT INTO `devices` VALUES (50, 'Túi giấy khổ in  52 x 72', '150', '1550', '100000', '440', '50000', 'bag_paste', 'semi_auto', 'paper', NULL, '150d/cm', 1, NULL, '2023-05-23 17:01:35', '2023-10-01 08:49:21', 1);
INSERT INTO `devices` VALUES (51, 'Túi giấy khổ in  65 x 86', '150', '1700', '100000', '440', '50000', 'bag_paste', 'semi_auto', 'paper', NULL, '150d/cm', 1, NULL, '2023-05-23 17:01:35', '2023-10-01 08:49:13', 1);
INSERT INTO `devices` VALUES (52, 'Túi giấy khổ in 72 x 102', '150', '2000', '100000', '440', '50000', 'bag_paste', 'semi_auto', 'paper', NULL, '150d/cm', 1, NULL, '2023-05-23 17:01:35', '2023-10-01 08:48:53', 1);
INSERT INTO `devices` VALUES (53, 'GẮN BÌA VỚI THÀNH', '0', '500', '100000', '150', '0', 'finish', 'auto', 'fill_finish', NULL, NULL, 1, NULL, '2023-05-23 17:01:35', '2023-09-16 02:57:00', 1);
INSERT INTO `devices` VALUES (54, 'GẮN KHAY ĐỊNH HÌNH', '0', '150', '50000', '40', '0', 'finish', 'semi_auto', 'fill_finish', NULL, NULL, 1, NULL, '2023-05-23 17:01:35', '2023-09-15 05:45:45', 1);
INSERT INTO `devices` VALUES (55, 'GẮN CAO SU NON', '0', '150', '50000', '40', '0', 'finish', 'semi_auto', 'fill_finish', NULL, NULL, 1, NULL, '2023-05-23 17:01:35', '2023-09-15 05:45:38', 1);
INSERT INTO `devices` VALUES (56, 'GẮN MÚT PHẲNG', '0', '150', '50000', '40', '0', 'finish', 'semi_auto', 'fill_finish', NULL, NULL, 1, NULL, '2023-05-23 17:01:35', '2023-09-15 05:47:05', 1);
INSERT INTO `devices` VALUES (57, 'GẮN VẢI LỤA', '0', '600', '50000', '300', '0', 'finish', 'semi_auto', 'fill_finish', NULL, NULL, 1, NULL, '2023-05-23 17:01:35', '2023-09-15 05:49:28', 1);
INSERT INTO `devices` VALUES (58, 'GẮN PHỤ KIỆN', '0', '150', '50000', '50', '0', 'finish', 'semi_auto', 'fill_finish', NULL, NULL, 1, NULL, '2023-05-23 17:01:35', '2023-09-15 05:48:05', 1);
INSERT INTO `devices` VALUES (59, 'ĐỘT KHUYẾT', '0', '150', '50000', '40', '0', 'finish', 'semi_auto', 'fill_finish', NULL, NULL, 1, NULL, '2023-05-23 17:01:35', '2023-09-15 05:49:04', 1);
INSERT INTO `devices` VALUES (60, 'GẮN 2 THÀNH HỘP TRẢI PHẲNG', '0', '600', '200000', '300', '50000', 'finish', 'semi_auto', 'fill_finish', NULL, NULL, 1, NULL, '2023-05-23 17:01:35', '2023-09-15 05:45:06', 1);
INSERT INTO `devices` VALUES (61, 'BÁN TỰ ĐỘNG', '0', '80', '50000', '0', '0', 'cut', 'auto', 'paper', NULL, NULL, 1, NULL, '2023-05-23 17:01:35', '2023-10-06 13:10:08', 1);
INSERT INTO `devices` VALUES (62, 'TỰ ĐỘNG', '50', '35', '100000', '0', '0', 'fold', 'auto', 'paper', 0, NULL, 1, NULL, '2023-05-23 17:01:35', '2023-10-06 13:03:41', 1);
INSERT INTO `devices` VALUES (63, 'MÁY BỒI TĐ', '0', '500', '300000', '140', '100000', 'fill', 'auto', 'fill_finish', NULL, NULL, 1, NULL, '2023-09-15 06:11:13', '2023-10-06 13:26:56', 1);
INSERT INTO `devices` VALUES (64, 'BÓ GÓI', '0', '100', '200000', '50', '50000', 'finish', 'semi_auto', 'fill_finish', NULL, NULL, 1, NULL, '2023-10-05 09:31:58', '2023-10-05 09:32:34', 1);
INSERT INTO `devices` VALUES (65, 'GẮN THÀNH HỘP QUÀ TẾT 2024', '0', '800', '200000', '200', '50000', 'finish', 'semi_auto', 'fill_finish', NULL, NULL, 1, NULL, '2023-10-07 07:38:17', '2023-10-07 07:38:17', 1);
INSERT INTO `devices` VALUES (66, 'GẮN ĐÁY CHAI RƯỢU HỘP QUÀ TẾT 2024', '0', '500', '200000', '200', '50000', 'finish', 'semi_auto', 'fill_finish', NULL, NULL, 1, NULL, '2023-10-07 07:39:00', '2023-10-07 07:39:00', 1);
INSERT INTO `devices` VALUES (67, 'GẮN CỔ CHAI RƯỢU HỘP QUÀ TẾT 2024', '0', '500', '200000', '200', '50000', 'finish', 'semi_auto', 'fill_finish', NULL, NULL, 1, NULL, '2023-10-07 07:39:22', '2023-10-07 07:39:22', 1);
INSERT INTO `devices` VALUES (68, 'BÓ GÓI HỘP QUÀ TẾT 2024', '0', '300', '200000', '100', '50000', 'finish', 'semi_auto', 'fill_finish', NULL, NULL, 1, NULL, '2023-10-07 07:40:32', '2023-10-07 07:40:42', 1);

-- ----------------------------
-- Table structure for districts
-- ----------------------------
DROP TABLE IF EXISTS `districts`;
CREATE TABLE `districts`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ord` tinyint(4) NULL DEFAULT NULL,
  `parent` int(11) NULL DEFAULT NULL,
  `act` tinyint(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 780 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of districts
-- ----------------------------
INSERT INTO `districts` VALUES (2, 'An Phú', NULL, 1, 1, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (3, 'Châu Đốc', NULL, 1, 1, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (4, 'Châu Phú', NULL, 1, 1, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (5, 'Châu Thành', NULL, 1, 1, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (6, 'Chợ Mới', NULL, 1, 1, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (7, 'Long Xuyên', NULL, 1, 1, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (8, 'Phú Tân', NULL, 1, 1, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (9, 'Tân Châu', NULL, 1, 1, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (10, 'Thoại Sơn', NULL, 1, 1, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (11, 'Tịnh Biên', NULL, 1, 1, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (12, 'Tri Tôn', NULL, 1, 1, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (14, 'Côn Đảo', NULL, 1, 13, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (15, 'Đất Đỏ', NULL, 1, 13, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (16, 'Tân Thành', NULL, 1, 13, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (17, 'Vũng Tàu', NULL, 1, 13, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (18, 'Xuyên Mộc', NULL, 1, 13, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (19, 'Bà Rịa-Vũng Tàu', NULL, 1, 13, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (20, 'Bà Rịa', NULL, 1, 13, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (21, 'Châu Đức', NULL, 1, 13, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (22, 'Long Điền', NULL, 1, 13, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (24, 'Bàu Bàng', NULL, 1, 23, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (25, 'Bắc Tân Uyên', NULL, 1, 23, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (26, 'Bến Cát', NULL, 1, 23, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (27, 'Dầu Tiếng', NULL, 1, 23, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (28, 'Dĩ An', NULL, 1, 23, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (29, 'Phú Giáo', NULL, 1, 23, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (30, 'Tân Uyên', NULL, 1, 23, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (31, 'Thủ Dầu Một', NULL, 1, 23, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (32, 'Thuận An', NULL, 1, 23, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (34, 'Bình Long', NULL, 1, 33, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (35, 'Bù Đăng', NULL, 1, 33, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (36, 'Bù Đốp', NULL, 1, 33, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (37, 'Bù Gia Mập', NULL, 1, 33, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (38, 'Chơn Thành', NULL, 1, 33, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (39, 'Đồng Phú', NULL, 1, 33, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (40, 'Đồng Xoài', NULL, 1, 33, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (41, 'Hớn Quản', NULL, 1, 33, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (42, 'Lộc Ninh', NULL, 1, 33, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (43, 'Phú Riềng', NULL, 1, 33, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (44, 'Phước Long', NULL, 1, 33, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (46, 'Bắc Bình', NULL, 1, 45, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (47, 'Đức Linh', NULL, 1, 45, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (48, 'Hàm Tân', NULL, 1, 45, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (49, 'Hàm Thuận Bắc', NULL, 1, 45, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (50, 'Hàm Thuận Nam', NULL, 1, 45, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (51, 'La Gi', NULL, 1, 45, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (52, 'Phan Thiết', NULL, 1, 45, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (53, 'Phú Quý', NULL, 1, 45, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (54, 'Tánh Linh', NULL, 1, 45, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (55, 'Tuy Phong', NULL, 1, 45, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (57, 'An Lão', NULL, 1, 56, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (58, 'An Nhơn', NULL, 1, 56, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (59, 'Hoài Ân', NULL, 1, 56, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (60, 'Hoài Nhơn', NULL, 1, 56, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (61, 'Phù Cát', NULL, 1, 56, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (62, 'Phù Mỹ', NULL, 1, 56, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (63, 'Quy Nhơn', NULL, 1, 56, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (64, 'Tây Sơn', NULL, 1, 56, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (65, 'Tuy Phước', NULL, 1, 56, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (66, 'Vân Canh', NULL, 1, 56, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (67, 'Vĩnh Thạnh', NULL, 1, 56, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (69, 'Bạc Liêu', NULL, 1, 68, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (70, 'Đông Hải', NULL, 1, 68, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (71, 'Giá Rai', NULL, 1, 68, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (72, 'Hoà Bình', NULL, 1, 68, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (73, 'Hồng Dân', NULL, 1, 68, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (74, 'Phước Long', NULL, 1, 68, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (75, 'Vĩnh Lợi', NULL, 1, 68, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (77, 'Bắc Giang', NULL, 1, 76, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (78, 'Hiệp Hòa', NULL, 1, 76, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (79, 'Lạng Giang', NULL, 1, 76, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (80, 'Lục Nam', NULL, 1, 76, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (81, 'Lục Ngạn', NULL, 1, 76, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (82, 'Sơn Động', NULL, 1, 76, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (83, 'Tân Yên', NULL, 1, 76, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (84, 'Việt Yên', NULL, 1, 76, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (85, 'Yên Dũng', NULL, 1, 76, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (86, 'Yên Thế', NULL, 1, 76, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (88, 'Ba Bể', NULL, 1, 87, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (89, 'Bạch Thông', NULL, 1, 87, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (90, 'Bắc Kạn', NULL, 1, 87, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (91, 'Chợ Đồn', NULL, 1, 87, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (92, 'Chợ Mới', NULL, 1, 87, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (93, 'Na Rì', NULL, 1, 87, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (94, 'Ngân Sơn', NULL, 1, 87, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (95, 'Pác Nặm', NULL, 1, 87, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (97, 'Bắc Ninh', NULL, 1, 96, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (98, 'Gia Bình', NULL, 1, 96, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (99, 'Lương Tài', NULL, 1, 96, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (100, 'Quế Võ', NULL, 1, 96, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (101, 'Thuận Thành', NULL, 1, 96, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (102, 'Tiên Du', NULL, 1, 96, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (103, 'Từ Sơn', NULL, 1, 96, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (104, 'Yên Phong', NULL, 1, 96, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (106, 'Ba Tri', NULL, 1, 105, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (107, 'Bến Tre', NULL, 1, 105, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (108, 'Bình Đại', NULL, 1, 105, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (109, 'Châu Thành', NULL, 1, 105, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (110, 'Chợ Lách', NULL, 1, 105, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (111, 'Giồng Trôm', NULL, 1, 105, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (112, 'Mỏ Cày Bắc', NULL, 1, 105, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (113, 'Mỏ Cày Nam', NULL, 1, 105, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (114, 'Thạnh Phú', NULL, 1, 105, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (116, 'Bảo Lạc', NULL, 1, 115, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (117, 'Bảo Lâm', NULL, 1, 115, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (118, 'Cao Bằng', NULL, 1, 115, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (119, 'Hà Quảng', NULL, 1, 115, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (120, 'Hạ Lang', NULL, 1, 115, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (121, 'Hòa An', NULL, 1, 115, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (122, 'Nguyên Bình', NULL, 1, 115, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (123, 'Phục Hòa', NULL, 1, 115, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (124, 'Quảng Uyên', NULL, 1, 115, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (125, 'Thạch An', NULL, 1, 115, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (126, 'Thông Nông', NULL, 1, 115, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (127, 'Trà Lĩnh', NULL, 1, 115, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (128, 'Trùng Khánh', NULL, 1, 115, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (130, 'Cà Mau', NULL, 1, 129, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (131, 'Cái Nước', NULL, 1, 129, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (132, 'Đầm Dơi', NULL, 1, 129, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (133, 'Năm Căn', NULL, 1, 129, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (134, 'Ngọc Hiển', NULL, 1, 129, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (135, 'Phú Tân', NULL, 1, 129, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (136, 'Thới Bình', NULL, 1, 129, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (137, 'Trần Văn Thời', NULL, 1, 129, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (138, 'U Minh', NULL, 1, 129, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (140, 'Bình Thủy', NULL, 1, 139, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (141, 'Cái Răng', NULL, 1, 139, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (142, 'Cờ Đỏ', NULL, 1, 139, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (143, 'Ninh Kiều', NULL, 1, 139, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (144, 'Ô Môn', NULL, 1, 139, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (145, 'Phong Điền', NULL, 1, 139, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (146, 'Thốt Nốt', NULL, 1, 139, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (147, 'Thới Lai', NULL, 1, 139, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (148, 'Vĩnh Thạnh', NULL, 1, 139, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (150, 'An Khê', NULL, 1, 149, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (151, 'Ayun Pa', NULL, 1, 149, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (152, 'Chư Păh', NULL, 1, 149, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (153, 'Chư Prông', NULL, 1, 149, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (154, 'Chư Pưh', NULL, 1, 149, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (155, 'Chư Sê', NULL, 1, 149, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (156, 'Đắk Đoa', NULL, 1, 149, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (157, 'Đak Pơ', NULL, 1, 149, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (158, 'Đức Cơ', NULL, 1, 149, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (159, 'Ia Grai', NULL, 1, 149, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (160, 'Ia Pa', NULL, 1, 149, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (161, 'KBang', NULL, 1, 149, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (162, 'Kông Chro', NULL, 1, 149, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (163, 'Krông Pa', NULL, 1, 149, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (164, 'Mang Yang', NULL, 1, 149, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (165, 'Phú Thiện', NULL, 1, 149, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (166, 'Pleiku', NULL, 1, 149, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (168, 'Cao Phong', NULL, 1, 167, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (169, 'Đà Bắc', NULL, 1, 167, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (170, 'Hoà Bình', NULL, 1, 167, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (171, 'Kim Bôi', NULL, 1, 167, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (172, 'Kỳ Sơn', NULL, 1, 167, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (173, 'Lạc Sơn', NULL, 1, 167, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (174, 'Lạc Thủy', NULL, 1, 167, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (175, 'Lương Sơn', NULL, 1, 167, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (176, 'Mai Châu', NULL, 1, 167, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (177, 'Tân Lạc', NULL, 1, 167, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (178, 'Yên Thủy', NULL, 1, 167, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (180, 'Bắc Mê', NULL, 1, 179, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (181, 'Bắc Quang', NULL, 1, 179, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (182, 'Đồng Văn', NULL, 1, 179, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (183, 'Hà Giang', NULL, 1, 179, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (184, 'Hoàng Su Phì', NULL, 1, 179, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (185, 'Mèo Vạc', NULL, 1, 179, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (186, 'Quản Bạ', NULL, 1, 179, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (187, 'Quang Bình', NULL, 1, 179, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (188, 'Vị Xuyên', NULL, 1, 179, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (189, 'Xín Mần', NULL, 1, 179, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (190, 'Yên Minh', NULL, 1, 179, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (192, 'Bình Lục', NULL, 1, 191, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (193, 'Duy Tiên', NULL, 1, 191, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (194, 'Kim Bảng', NULL, 1, 191, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (195, 'Lý Nhân', NULL, 1, 191, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (196, 'Phủ Lý', NULL, 1, 191, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (197, 'Thanh Liêm', NULL, 1, 191, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (199, 'Ba Đình', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (200, 'Ba Vì', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (201, 'Bắc Từ Liêm', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (202, 'Cầu Giấy', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (203, 'Chương Mỹ', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (204, 'Đan Phượng', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (205, 'Đông Anh', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (206, 'Đống Đa', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (207, 'Gia Lâm', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (208, 'Hà Đông', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (209, 'Hai Bà Trưng', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (210, 'Hoài Đức', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (211, 'Hoàn Kiếm', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (212, 'Hoàng Mai', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (213, 'Long Biên', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (214, 'Mê Linh', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (215, 'Mỹ Đức', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (216, 'Nam Từ Liêm', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (217, 'Phú Xuyên', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (218, 'Phúc Thọ', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (219, 'Quốc Oai', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (220, 'Sóc Sơn', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (221, 'Sơn Tây', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (222, 'Tây Hồ', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (223, 'Thạch Thất', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (224, 'Thanh Oai', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (225, 'Thanh Trì', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (226, 'Thanh Xuân', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (227, 'Thường Tín', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (228, 'Ứng Hòa', NULL, 1, 198, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (230, 'Can Lộc', NULL, 1, 229, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (231, 'Cẩm Xuyên', NULL, 1, 229, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (232, 'Đức Thọ', NULL, 1, 229, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (233, 'Hà Tĩnh', NULL, 1, 229, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (234, 'Hồng Lĩnh', NULL, 1, 229, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (235, 'Hương Khê', NULL, 1, 229, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (236, 'Hương Sơn', NULL, 1, 229, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (237, 'Kỳ Anh', NULL, 1, 229, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (238, 'Kỳ Anh', NULL, 1, 229, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (239, 'Lộc Hà', NULL, 1, 229, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (240, 'Nghi Xuân', NULL, 1, 229, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (241, 'Thạch Hà', NULL, 1, 229, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (242, 'Vũ Quang', NULL, 1, 229, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (244, 'Ân Thi', NULL, 1, 243, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (245, 'Hưng Yên', NULL, 1, 243, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (246, 'Khoái Châu', NULL, 1, 243, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (247, 'Kim Động', NULL, 1, 243, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (248, 'Mỹ Hào', NULL, 1, 243, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (249, 'Phù Cừ', NULL, 1, 243, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (250, 'Tiên Lữ', NULL, 1, 243, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (251, 'Văn Giang', NULL, 1, 243, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (252, 'Văn Lâm', NULL, 1, 243, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (253, 'Yên Mỹ', NULL, 1, 243, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (255, 'Bình Giang', NULL, 1, 254, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (256, 'Cẩm Giàng', NULL, 1, 254, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (257, 'Chí Linh', NULL, 1, 254, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (258, 'Gia Lộc', NULL, 1, 254, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (259, 'Hải Dương', NULL, 1, 254, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (260, 'Kim Thành', NULL, 1, 254, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (261, 'Kinh Môn', NULL, 1, 254, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (262, 'Nam Sách', NULL, 1, 254, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (263, 'Ninh Giang', NULL, 1, 254, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (264, 'Thanh Hà', NULL, 1, 254, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (265, 'Thanh Miện', NULL, 1, 254, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (266, 'Tứ Kỳ', NULL, 1, 254, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (268, 'An Dương', NULL, 1, 267, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (269, 'An Lão', NULL, 1, 267, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (270, 'Bạch Long Vĩ', NULL, 1, 267, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (271, 'Cát Hải', NULL, 1, 267, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (272, 'Dương Kinh', NULL, 1, 267, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (273, 'Đồ Sơn', NULL, 1, 267, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (274, 'Hải An', NULL, 1, 267, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (275, 'Hồng Bàng', NULL, 1, 267, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (276, 'Kiến An', NULL, 1, 267, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (277, 'Kiến Thụy', NULL, 1, 267, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (278, 'Lê Chân', NULL, 1, 267, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (279, 'Ngô Quyền', NULL, 1, 267, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (280, 'Thuỷ Nguyên', NULL, 1, 267, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (281, 'Tiên Lãng', NULL, 1, 267, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (282, 'Vĩnh Bảo', NULL, 1, 267, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (284, 'Châu Thành', NULL, 1, 283, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (285, 'Châu Thành A', NULL, 1, 283, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (286, 'Long Mỹ', NULL, 1, 283, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (287, 'Long Mỹ', NULL, 1, 283, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (288, 'Ngã Bảy', NULL, 1, 283, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (289, 'Phụng Hiệp', NULL, 1, 283, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (290, 'Vị Thanh', NULL, 1, 283, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (291, 'Vị Thủy', NULL, 1, 283, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (293, 'Cam Lâm', NULL, 1, 292, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (294, 'Cam Ranh', NULL, 1, 292, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (295, 'Diên Khánh', NULL, 1, 292, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (296, 'Khánh Sơn', NULL, 1, 292, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (297, 'Khánh Vĩnh', NULL, 1, 292, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (298, 'Nha Trang', NULL, 1, 292, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (299, 'Ninh Hòa', NULL, 1, 292, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (300, 'Trường Sa', NULL, 1, 292, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (301, 'Vạn Ninh', NULL, 1, 292, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (303, 'An Biên', NULL, 1, 302, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (304, 'An Minh', NULL, 1, 302, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (305, 'Châu Thành', NULL, 1, 302, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (306, 'Giang Thành', NULL, 1, 302, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (307, 'Giồng Riềng', NULL, 1, 302, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (308, 'Gò Quao', NULL, 1, 302, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (309, 'Hà Tiên', NULL, 1, 302, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (310, 'Hòn Đất', NULL, 1, 302, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (311, 'Kiên Hải', NULL, 1, 302, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (312, 'Kiên Lương', NULL, 1, 302, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (313, 'Phú Quốc', NULL, 1, 302, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (314, 'Rạch Giá', NULL, 1, 302, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (315, 'Tân Hiệp', NULL, 1, 302, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (316, 'U Minh Thượng', NULL, 1, 302, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (317, 'Vĩnh Thuận', NULL, 1, 302, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (319, 'Đắk Glei', NULL, 1, 318, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (320, 'Đắk Hà', NULL, 1, 318, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (321, 'Đăk Tô', NULL, 1, 318, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (322, 'Ia H\'Drai', NULL, 1, 318, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (323, 'Kon Plông', NULL, 1, 318, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (324, 'Kon Rẫy', NULL, 1, 318, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (325, 'Kon Tum', NULL, 1, 318, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (326, 'Ngọc Hồi', NULL, 1, 318, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (327, 'Sa Thầy', NULL, 1, 318, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (328, 'Tu Mơ Rông', NULL, 1, 318, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (330, 'Lai Châu', NULL, 1, 329, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (331, 'Mường Tè', NULL, 1, 329, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (332, 'Nậm Nhùn', NULL, 1, 329, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (333, 'Phong Thổ', NULL, 1, 329, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (334, 'Sìn Hồ', NULL, 1, 329, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (335, 'Tam Đường', NULL, 1, 329, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (336, 'Tân Uyên', NULL, 1, 329, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (337, 'Than Uyên', NULL, 1, 329, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (339, 'Bến Lức', NULL, 1, 338, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (340, 'Cần Đước', NULL, 1, 338, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (341, 'Cần Giuộc', NULL, 1, 338, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (342, 'Châu Thành', NULL, 1, 338, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (343, 'Đức Hòa', NULL, 1, 338, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (344, 'Đức Huệ', NULL, 1, 338, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (345, 'Kiến Tường', NULL, 1, 338, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (346, 'Mộc Hóa', NULL, 1, 338, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (347, 'Tân An', NULL, 1, 338, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (348, 'Tân Hưng', NULL, 1, 338, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (349, 'Tân Thạnh', NULL, 1, 338, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (350, 'Tân Trụ', NULL, 1, 338, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (351, 'Thạnh Hóa', NULL, 1, 338, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (352, 'Thủ Thừa', NULL, 1, 338, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (353, 'Vĩnh Hưng', NULL, 1, 338, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (355, 'Bảo Thắng', NULL, 1, 354, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (356, 'Bảo Yên', NULL, 1, 354, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (357, 'Bát Xát', NULL, 1, 354, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (358, 'Bắc Hà', NULL, 1, 354, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (359, 'Lào Cai', NULL, 1, 354, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (360, 'Mường Khương', NULL, 1, 354, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (361, 'Sa Pa', NULL, 1, 354, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (362, 'Si Ma Cai', NULL, 1, 354, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (363, 'Văn Bàn', NULL, 1, 354, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (365, 'Bảo Lâm', NULL, 1, 364, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (366, 'Bảo Lộc', NULL, 1, 364, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (367, 'Cát Tiên', NULL, 1, 364, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (368, 'Di Linh', NULL, 1, 364, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (369, 'Đà Lạt', NULL, 1, 364, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (370, 'Đạ Huoai', NULL, 1, 364, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (371, 'Đạ Tẻh', NULL, 1, 364, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (372, 'Đam Rông', NULL, 1, 364, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (373, 'Đơn Dương', NULL, 1, 364, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (374, 'Đức Trọng', NULL, 1, 364, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (375, 'Lạc Dương', NULL, 1, 364, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (376, 'Lâm Hà', NULL, 1, 364, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (378, 'Bắc Sơn', NULL, 1, 377, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (379, 'Bình Gia', NULL, 1, 377, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (380, 'Cao Lộc', NULL, 1, 377, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (381, 'Chi Lăng', NULL, 1, 377, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (382, 'Đình Lập', NULL, 1, 377, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (383, 'Hữu Lũng', NULL, 1, 377, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (384, 'Lạng Sơn', NULL, 1, 377, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (385, 'Lộc Bình', NULL, 1, 377, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (386, 'Tràng Định', NULL, 1, 377, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (387, 'Vãn Lãng', NULL, 1, 377, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (388, 'Văn Quan', NULL, 1, 377, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (390, 'Giao Thủy', NULL, 1, 389, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (391, 'Hải Hậu', NULL, 1, 389, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (392, 'Mỹ Lộc', NULL, 1, 389, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (393, 'Nam Định', NULL, 1, 389, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (394, 'Nam Trực', NULL, 1, 389, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (395, 'Nghĩa Hưng', NULL, 1, 389, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (396, 'Trực Ninh', NULL, 1, 389, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (397, 'Vụ Bản', NULL, 1, 389, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (398, 'Xuân Trường', NULL, 1, 389, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (399, 'Ý Yên', NULL, 1, 389, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (401, 'Anh Sơn', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (402, 'Con Cuông', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (403, 'Cửa Lò', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (404, 'Diễn Châu', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (405, 'Đô Lương', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (406, 'Hoàng Mai', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (407, 'Hưng Nguyên', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (408, 'Kỳ Sơn', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (409, 'Nam Đàn', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (410, 'Nghi Lộc', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (411, 'Nghĩa Đàn', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (412, 'Quế Phong', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (413, 'Quỳ Châu', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (414, 'Quỳ Hợp', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (415, 'Quỳnh Lưu', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (416, 'Tân Kỳ', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (417, 'Thái Hòa', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (418, 'Thanh Chương', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (419, 'Tương Dương', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (420, 'Vinh', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (421, 'Yên Thành', NULL, 1, 400, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (423, 'Gia Viễn', NULL, 1, 422, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (424, 'Hoa Lư', NULL, 1, 422, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (425, 'Kim Sơn', NULL, 1, 422, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (426, 'Nho Quan', NULL, 1, 422, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (427, 'Ninh Bình', NULL, 1, 422, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (428, 'Tam Điệp', NULL, 1, 422, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (429, 'Yên Khánh', NULL, 1, 422, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (430, 'Yên Mô', NULL, 1, 422, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (432, 'Bác Ái', NULL, 1, 431, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (433, 'Ninh Hải', NULL, 1, 431, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (434, 'Ninh Phước', NULL, 1, 431, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (435, 'Ninh Sơn', NULL, 1, 431, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (436, 'Phan Rang-Tháp Chàm', NULL, 1, 431, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (437, 'Thuận Bắc', NULL, 1, 431, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (438, 'Thuận Nam', NULL, 1, 431, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (440, 'Cẩm Khê', NULL, 1, 439, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (441, 'Đoan Hùng', NULL, 1, 439, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (442, 'Hạ Hòa', NULL, 1, 439, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (443, 'Lâm Thao', NULL, 1, 439, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (444, 'Phú Thọ', NULL, 1, 439, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (445, 'Phù Ninh', NULL, 1, 439, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (446, 'Tam Nông', NULL, 1, 439, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (447, 'Tân Sơn', NULL, 1, 439, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (448, 'Thanh Ba', NULL, 1, 439, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (449, 'Thanh Sơn', NULL, 1, 439, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (450, 'Thanh Thủy', NULL, 1, 439, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (451, 'Việt Trì', NULL, 1, 439, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (452, 'Yên Lập', NULL, 1, 439, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (454, 'Đông Hòa', NULL, 1, 453, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (455, 'Đồng Xuân', NULL, 1, 453, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (456, 'Phú Hòa', NULL, 1, 453, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (457, 'Sông Cầu', NULL, 1, 453, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (458, 'Sông Hinh', NULL, 1, 453, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (459, 'Sơn Hòa', NULL, 1, 453, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (460, 'Tây Hòa', NULL, 1, 453, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (461, 'Tuy An', NULL, 1, 453, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (462, 'Tuy Hòa', NULL, 1, 453, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (464, 'Ba Đồn', NULL, 1, 463, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (465, 'Bố Trạch', NULL, 1, 463, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (466, 'Đồng Hới', NULL, 1, 463, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (467, 'Lệ Thủy', NULL, 1, 463, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (468, 'Minh Hóa', NULL, 1, 463, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (469, 'Quảng Ninh', NULL, 1, 463, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (470, 'Quảng Trạch', NULL, 1, 463, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (471, 'Tuyên Hóa', NULL, 1, 463, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (473, 'Bắc Trà My', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (474, 'Duy Xuyên', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (475, 'Đại Lộc', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (476, 'Điện Bàn', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (477, 'Đông Giang', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (478, 'Hiệp Đức', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (479, 'Hội An', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (480, 'Nam Giang', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (481, 'Nam Trà My', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (482, 'Nông Sơn', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (483, 'Núi Thành', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (484, 'Phú Ninh', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (485, 'Phước Sơn', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (486, 'Quế Sơn', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (487, 'Tam Kỳ', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (488, 'Tây Giang', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (489, 'Thăng Bình', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (490, 'Tiên Phước', NULL, 1, 472, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (492, 'Ba Tơ', NULL, 1, 491, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (493, 'Bình Sơn', NULL, 1, 491, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (494, 'Đức Phổ', NULL, 1, 491, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (495, 'Lý Sơn', NULL, 1, 491, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (496, 'Minh Long', NULL, 1, 491, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (497, 'Mộ Đức', NULL, 1, 491, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (498, 'Nghĩa Hành', NULL, 1, 491, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (499, 'Quảng Ngãi', NULL, 1, 491, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (500, 'Sơn Hà', NULL, 1, 491, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (501, 'Sơn Tây', NULL, 1, 491, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (502, 'Sơn Tịnh', NULL, 1, 491, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (503, 'Tây Trà', NULL, 1, 491, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (504, 'Trà Bồng', NULL, 1, 491, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (505, 'Tư Nghĩa', NULL, 1, 491, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (507, 'Ba Chẽ', NULL, 1, 506, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (508, 'Bình Liêu', NULL, 1, 506, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (509, 'Cẩm Phả', NULL, 1, 506, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (510, 'Cô Tô', NULL, 1, 506, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (511, 'Đầm Hà', NULL, 1, 506, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (512, 'Đông Triều', NULL, 1, 506, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (513, 'Hạ Long', NULL, 1, 506, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (514, 'Hải Hà', NULL, 1, 506, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (515, 'Hoành Bồ', NULL, 1, 506, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (516, 'Móng Cái', NULL, 1, 506, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (517, 'Quảng Yên', NULL, 1, 506, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (518, 'Tiên Yên', NULL, 1, 506, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (519, 'Uông Bí', NULL, 1, 506, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (520, 'Vân Đồn', NULL, 1, 506, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (522, 'Cam Lộ', NULL, 1, 521, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (523, 'Cồn Cỏ', NULL, 1, 521, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (524, 'Đa Krông', NULL, 1, 521, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (525, 'Đông Hà', NULL, 1, 521, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (526, 'Gio Linh', NULL, 1, 521, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (527, 'Hải Lăng', NULL, 1, 521, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (528, 'Hướng Hóa', NULL, 1, 521, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (529, 'Quảng Trị', NULL, 1, 521, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (530, 'Triệu Phong', NULL, 1, 521, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (531, 'Vĩnh Linh', NULL, 1, 521, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (533, 'Châu Thành', NULL, 1, 532, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (534, 'Cù Lao Dung', NULL, 1, 532, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (535, 'Kế Sách', NULL, 1, 532, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (536, 'Long Phú', NULL, 1, 532, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (537, 'Mỹ Tú', NULL, 1, 532, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (538, 'Mỹ Xuyên', NULL, 1, 532, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (539, 'Ngã Năm', NULL, 1, 532, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (540, 'Sóc Trăng', NULL, 1, 532, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (541, 'Thạnh Trị', NULL, 1, 532, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (542, 'Trần Đề', NULL, 1, 532, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (543, 'Vĩnh Châu', NULL, 1, 532, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (545, 'Bắc Yên', NULL, 1, 544, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (546, 'Mai Sơn', NULL, 1, 544, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (547, 'Mộc Châu', NULL, 1, 544, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (548, 'Mường La', NULL, 1, 544, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (549, 'Phù Yên', NULL, 1, 544, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (550, 'Quỳnh Nhai', NULL, 1, 544, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (551, 'Sông Mã', NULL, 1, 544, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (552, 'Sốp Cộp', NULL, 1, 544, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (553, 'Sơn La', NULL, 1, 544, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (554, 'Thuận Châu', NULL, 1, 544, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (555, 'Vân Hồ', NULL, 1, 544, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (556, 'Yên Châu', NULL, 1, 544, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (558, 'Bá Thước', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (559, 'Bỉm Sơn', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (560, 'Cẩm Thủy', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (561, 'Đông Sơn', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (562, 'Hà Trung', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (563, 'Hậu Lộc', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (564, 'Hoằng Hóa', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (565, 'Lang Chánh', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (566, 'Mường Lát', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (567, 'Nga Sơn', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (568, 'Ngọc Lặc', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (569, 'Như Thanh', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (570, 'Như Xuân', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (571, 'Nông Cống', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (572, 'Quan Hóa', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (573, 'Quan Sơn', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (574, 'Quảng Xương', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (575, 'Sầm Sơn', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (576, 'Thạch Thành', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (577, 'Thanh Hóa', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (578, 'Thiệu Hóa', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (579, 'Thọ Xuân', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (580, 'Thường Xuân', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (581, 'Tĩnh Gia', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (582, 'Triệu Sơn', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (583, 'Vĩnh Lộc', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (584, 'Yên Định', NULL, 1, 557, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (586, 'Đông Hưng', NULL, 1, 585, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (587, 'Hưng Hà', NULL, 1, 585, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (588, 'Kiến Xương', NULL, 1, 585, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (589, 'Quỳnh Phụ', NULL, 1, 585, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (590, 'Thái Bình', NULL, 1, 585, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (591, 'Thái Thụy', NULL, 1, 585, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (592, 'Tiền Hải', NULL, 1, 585, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (593, 'Vũ Thư', NULL, 1, 585, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (595, 'Đại Từ', NULL, 1, 594, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (596, 'Định Hóa', NULL, 1, 594, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (597, 'Đồng Hỷ', NULL, 1, 594, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (598, 'Phổ Yên', NULL, 1, 594, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (599, 'Phú Bình', NULL, 1, 594, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (600, 'Phú Lương', NULL, 1, 594, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (601, 'Sông Công', NULL, 1, 594, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (602, 'Thái Nguyên', NULL, 1, 594, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (603, 'Võ Nhai', NULL, 1, 594, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (605, 'Huế', NULL, 1, 604, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (606, 'Hương Thủy', NULL, 1, 604, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (607, 'Hương Trà', NULL, 1, 604, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (608, 'Nam Đông', NULL, 1, 604, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (609, 'Thừa Thiên-Huế', NULL, 1, 604, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (610, 'A Lưới', NULL, 1, 604, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (611, 'Phong Điền', NULL, 1, 604, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (612, 'Phú Lộc', NULL, 1, 604, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (613, 'Phú Vang', NULL, 1, 604, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (614, 'Quảng Điền', NULL, 1, 604, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (616, 'Cai Lậy', NULL, 1, 615, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (617, 'Cai Lậy', NULL, 1, 615, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (618, 'Cái Bè', NULL, 1, 615, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (619, 'Châu Thành', NULL, 1, 615, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (620, 'Chợ Gạo', NULL, 1, 615, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (621, 'Gò Công', NULL, 1, 615, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (622, 'Gò Công Đông', NULL, 1, 615, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (623, 'Gò Công Tây', NULL, 1, 615, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (624, 'Mỹ Tho', NULL, 1, 615, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (625, 'Tân Phú Đông', NULL, 1, 615, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (626, 'Tân Phước', NULL, 1, 615, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (628, 'Bình Chánh', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (629, 'Bình Tân', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (630, 'Bình Thạnh', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (631, 'Cần Giờ', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (632, 'Củ Chi', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (633, 'Gò Vấp', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (634, 'Hóc Môn', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (635, 'Nhà Bè', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (636, 'Phú Nhuận', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (637, 'Quận 1', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (638, 'Quận 2', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (639, 'Quận 3', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (640, 'Quận 4', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (641, 'Quận 5', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (642, 'Quận 6', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (643, 'Quận 7', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (644, 'Quận 8', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (645, 'Quận 9', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (646, 'Quận 10', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (647, 'Quận 11', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (648, 'Quận 12', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (649, 'Tân Bình', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (650, 'Tân Phú', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (651, 'Thủ Đức', NULL, 1, 627, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (653, 'Càng Long', NULL, 1, 652, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (654, 'Cầu Kè', NULL, 1, 652, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (655, 'Cầu Ngang', NULL, 1, 652, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (656, 'Châu Thành', NULL, 1, 652, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (657, 'Duyên Hải', NULL, 1, 652, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (658, 'Duyên Hải', NULL, 1, 652, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (659, 'Tiểu Cần', NULL, 1, 652, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (660, 'Trà Cú', NULL, 1, 652, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (661, 'Trà Vinh', NULL, 1, 652, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (663, 'Chiêm Hóa', NULL, 1, 662, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (664, 'Hàm Yên', NULL, 1, 662, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (665, 'Lâm Bình', NULL, 1, 662, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (666, 'Na Hang', NULL, 1, 662, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (667, 'Sơn Dương', NULL, 1, 662, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (668, 'Tuyên Quang', NULL, 1, 662, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (669, 'Yên Sơn', NULL, 1, 662, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (671, 'Bến Cầu', NULL, 1, 670, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (672, 'Châu Thành', NULL, 1, 670, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (673, 'Dương Minh Châu', NULL, 1, 670, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (674, 'Gò Dầu', NULL, 1, 670, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (675, 'Hòa Thành', NULL, 1, 670, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (676, 'Tân Biên', NULL, 1, 670, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (677, 'Tân Châu', NULL, 1, 670, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (678, 'Tây Ninh', NULL, 1, 670, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (679, 'Trảng Bàng', NULL, 1, 670, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (681, 'Bình Minh', NULL, 1, 680, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (682, 'Bình Tân', NULL, 1, 680, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (683, 'Long Hồ', NULL, 1, 680, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (684, 'Mang Thít', NULL, 1, 680, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (685, 'Tam Bình', NULL, 1, 680, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (686, 'Trà Ôn', NULL, 1, 680, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (687, 'Vĩnh Long', NULL, 1, 680, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (688, 'Vũng Liêm', NULL, 1, 680, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (690, 'Bình Xuyên', NULL, 1, 689, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (691, 'Lập Thạch', NULL, 1, 689, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (692, 'Phúc Yên', NULL, 1, 689, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (693, 'Sông Lô', NULL, 1, 689, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (694, 'Tam Dương', NULL, 1, 689, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (695, 'Tam Đảo', NULL, 1, 689, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (696, 'Vĩnh Tường', NULL, 1, 689, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (697, 'Vĩnh Yên', NULL, 1, 689, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (698, 'Yên Lạc', NULL, 1, 689, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (700, 'Lục Yên', NULL, 1, 699, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (701, 'Mù Căng Chải', NULL, 1, 699, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (702, 'Nghĩa Lộ', NULL, 1, 699, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (703, 'Trạm Tấu', NULL, 1, 699, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (704, 'Trấn Yên', NULL, 1, 699, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (705, 'Văn Chấn', NULL, 1, 699, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (706, 'Văn Yên', NULL, 1, 699, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (707, 'Yên Bái', NULL, 1, 699, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (708, 'Yên Bình', NULL, 1, 699, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (710, 'Điện Biên', NULL, 1, 709, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (711, 'Điện Biên Đông', NULL, 1, 709, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (712, 'Điện Biên Phủ', NULL, 1, 709, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (713, 'Mường Ảng', NULL, 1, 709, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (714, 'Mường Chà', NULL, 1, 709, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (715, 'Mường Lay', NULL, 1, 709, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (716, 'Mường Nhé', NULL, 1, 709, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (717, 'Nậm Pồ', NULL, 1, 709, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (718, 'Tủa Chùa', NULL, 1, 709, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (719, 'Tuần Giáo', NULL, 1, 709, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (721, 'Cẩm Lệ', NULL, 1, 720, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (722, 'Hải Châu', NULL, 1, 720, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (723, 'Hòa Vang', NULL, 1, 720, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (724, 'Hoàng Sa', NULL, 1, 720, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (725, 'Liên Chiểu', NULL, 1, 720, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (726, 'Ngũ Hành Sơn', NULL, 1, 720, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (727, 'Sơn Trà', NULL, 1, 720, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (728, 'Thanh Khê', NULL, 1, 720, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (730, 'Gia Nghĩa', NULL, 1, 729, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (731, 'Tuy Đức', NULL, 1, 729, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (733, 'Buôn Đôn', NULL, 1, 732, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (734, 'Buôn Hồ', NULL, 1, 732, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (735, 'Buôn Ma Thuột', NULL, 1, 732, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (736, 'Cư Kuin', NULL, 1, 732, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (737, 'Cư M\'gar', NULL, 1, 732, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (738, 'Ea H\'leo', NULL, 1, 732, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (739, 'Ea Kar', NULL, 1, 732, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (740, 'Ea Súp', NULL, 1, 732, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (741, 'Krông Ana', NULL, 1, 732, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (742, 'Krông Bông', NULL, 1, 732, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (743, 'Krông Búk', NULL, 1, 732, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (744, 'Krông Năng', NULL, 1, 732, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (745, 'Krông Pắk', NULL, 1, 732, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (746, 'Lắk', NULL, 1, 732, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (747, 'M\'Đrăk', NULL, 1, 732, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (749, 'Cư Jút', NULL, 1, 748, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (750, 'Đắk Glong', NULL, 1, 748, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (751, 'Đắk Mil', NULL, 1, 748, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (752, 'Đắk R\'lấp', NULL, 1, 748, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (753, 'Đăk Song', NULL, 1, 748, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (754, 'Krông Nô', NULL, 1, 748, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (756, 'Biên Hòa', NULL, 1, 755, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (757, 'Cẩm Mỹ', NULL, 1, 755, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (758, 'Định Quán', NULL, 1, 755, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (759, 'Long Khánh', NULL, 1, 755, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (760, 'Long Thành', NULL, 1, 755, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (761, 'Nhơn Trạch', NULL, 1, 755, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (762, 'Tân Phú', NULL, 1, 755, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (763, 'Thống Nhất', NULL, 1, 755, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (764, 'Trảng Bom', NULL, 1, 755, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (765, 'Vĩnh Cửu', NULL, 1, 755, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (766, 'Xuân Lộc', NULL, 1, 755, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (768, 'Cao Lãnh', NULL, 1, 767, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (769, 'Cao Lãnh', NULL, 1, 767, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (770, 'Châu Thành', NULL, 1, 767, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (771, 'Hồng Ngự', NULL, 1, 767, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (772, 'Hồng Ngự', NULL, 1, 767, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (773, 'Lai Vung', NULL, 1, 767, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (774, 'Lấp Vò', NULL, 1, 767, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (775, 'Sa Đéc', NULL, 1, 767, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (776, 'Tam Nông', NULL, 1, 767, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (777, 'Tân Hồng', NULL, 1, 767, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (778, 'Thanh Bình', NULL, 1, 767, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');
INSERT INTO `districts` VALUES (779, 'Tháp Mười', NULL, 1, 767, 1, '2022-06-21 14:53:25', '2022-06-21 14:53:25');

-- ----------------------------
-- Table structure for domains
-- ----------------------------
DROP TABLE IF EXISTS `domains`;
CREATE TABLE `domains`  (
  `id` int(11) NOT NULL COMMENT 'Mã',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Tên',
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT 'Ghi chú',
  `ord` tinyint(4) NULL DEFAULT NULL COMMENT 'Sắp xếp',
  `act` tinyint(1) NULL DEFAULT NULL COMMENT 'Kích hoạt',
  `created_at` datetime(0) NULL DEFAULT NULL COMMENT 'Thời gian tạo',
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0) COMMENT 'Thời gian sửa',
  `pos_x` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Kính tuyến',
  `pos_y` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Vĩ tuyến',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of domains
-- ----------------------------
INSERT INTO `domains` VALUES (1, 'Miền bắc', NULL, 1, 1, '2022-06-21 14:54:02', '2022-06-21 14:54:02', '21.0205873', '105.8081512');
INSERT INTO `domains` VALUES (2, 'Miền trung', NULL, 2, 1, '2022-06-21 14:54:02', '2022-06-21 14:54:02', '16.4322431', '107.3452953');
INSERT INTO `domains` VALUES (3, 'Miền nam', NULL, 3, 1, '2022-06-21 14:54:02', '2022-06-21 14:54:02', '11.5844862', '106.9994653');

-- ----------------------------
-- Table structure for files
-- ----------------------------
DROP TABLE IF EXISTS `files`;
CREATE TABLE `files`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `base_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `dir` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `count` bigint(20) NULL DEFAULT NULL,
  `ext_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 139 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of files
-- ----------------------------
INSERT INTO `files` VALUES (4, 'FileKhuon_00029712A_Bộ (hộp+tem+toa) O%0d%0a lymcouta_53 53 125 mm_', NULL, 'uploads/files/products/sale_shape_file', 'uploads/files/products/sale_shape_file/FileKhuon_00029712A_Bộ (hộp+tem+toa) O%0d%0a lymcouta_53 53 125 mm_.pdf', 0, 'pdf', 1, '2023-09-28 10:02:03', '2023-09-28 15:05:01', 10);
INSERT INTO `files` VALUES (5, 'Olymcouta', NULL, 'uploads/files/products/sale_shape_file', 'uploads/files/products/sale_shape_file/Olymcouta.cdr', 1, 'cdr', 1, '2023-09-28 10:09:25', '2023-09-28 10:27:40', 10);
INSERT INTO `files` VALUES (6, 'Olymcouta_1', NULL, 'uploads/files/products/sale_shape_file', 'uploads/files/products/sale_shape_file/Olymcouta_1.cdr', NULL, 'cdr', 1, '2023-09-28 10:27:40', '2023-09-28 10:27:40', 10);
INSERT INTO `files` VALUES (8, 'khuôn DH-000011A Olymcouta 65x55x130(chưa lật)', NULL, 'uploads/files/products/tech_shape_file', 'uploads/files/products/tech_shape_file/khuôn DH-000011A Olymcouta 65x55x130(chưa lật).pdf', NULL, 'pdf', 1, '2023-09-28 11:15:40', '2023-09-28 11:15:40', 4);
INSERT INTO `files` VALUES (9, 'bacillus', NULL, 'uploads/files/products/sale_shape_file', 'uploads/files/products/sale_shape_file/bacillus.cdr', NULL, 'cdr', 1, '2023-09-28 11:18:54', '2023-09-28 11:18:54', 10);
INSERT INTO `files` VALUES (10, '5', NULL, 'uploads/files/products/sale_shape_file', 'uploads/files/products/sale_shape_file/5.jpg', 3, 'jpg', 1, '2023-09-28 11:47:56', '2023-09-28 12:12:37', 2);
INSERT INTO `files` VALUES (11, '5_1', NULL, 'uploads/files/products/sale_shape_file', 'uploads/files/products/sale_shape_file/5_1.jpg', NULL, 'jpg', 1, '2023-09-28 12:07:52', '2023-09-28 12:07:52', 2);
INSERT INTO `files` VALUES (12, '5_2', NULL, 'uploads/files/products/sale_shape_file', 'uploads/files/products/sale_shape_file/5_2.jpg', NULL, 'jpg', 1, '2023-09-28 12:10:07', '2023-09-28 12:10:07', 1);
INSERT INTO `files` VALUES (13, '5_3', NULL, 'uploads/files/products/sale_shape_file', 'uploads/files/products/sale_shape_file/5_3.jpg', NULL, 'jpg', 1, '2023-09-28 12:12:37', '2023-09-28 12:12:37', 1);
INSERT INTO `files` VALUES (14, 'FileKhuon_00027665A_bộ ( hộp+toa) thym_0d_0a oglucan 2 loại_130 65 110_', NULL, 'uploads/files/products/tech_shape_file', 'uploads/files/products/tech_shape_file/FileKhuon_00027665A_bộ ( hộp+toa) thym_0d_0a oglucan 2 loại_130 65 110_.pdf', NULL, 'pdf', 1, '2023-09-28 14:02:56', '2023-09-28 14:02:56', 4);
INSERT INTO `files` VALUES (15, 'THYMO GLUCAN', NULL, 'uploads/files/products/design_file', 'uploads/files/products/design_file/THYMO GLUCAN.ai', NULL, 'ai', 1, '2023-09-28 14:14:58', '2023-09-28 14:14:58', 3);
INSERT INTO `files` VALUES (16, 'THYMO GLUCAN CV', NULL, 'uploads/files/products/design_shape_file', 'uploads/files/products/design_shape_file/THYMO GLUCAN CV.ai', NULL, 'ai', 1, '2023-09-28 14:15:09', '2023-09-28 14:15:09', 3);
INSERT INTO `files` VALUES (22, 'khuôn DH-000012A Bacilluss Claussi(chưa lật)', NULL, 'uploads/files/products/tech_shape_file', 'uploads/files/products/tech_shape_file/khuôn DH-000012A Bacilluss Claussi(chưa lật).pdf', 1, 'pdf', 1, '2023-09-28 15:13:08', '2023-09-28 15:20:40', 4);
INSERT INTO `files` VALUES (23, 'khuon 30633  túi Eva Estrogen ( chưa lật )', NULL, 'uploads/files/products/tech_shape_file', 'uploads/files/products/tech_shape_file/khuon 30633  túi Eva Estrogen ( chưa lật ).pdf', NULL, 'pdf', 1, '2023-09-28 15:18:05', '2023-09-28 15:18:05', 4);
INSERT INTO `files` VALUES (24, 'khuôn DH-000012A Bacilluss Claussi(chưa lật)_1', NULL, 'uploads/files/products/tech_shape_file', 'uploads/files/products/tech_shape_file/khuôn DH-000012A Bacilluss Claussi(chưa lật)_1.pdf', NULL, 'pdf', 1, '2023-09-28 15:20:40', '2023-09-28 15:20:40', 4);
INSERT INTO `files` VALUES (25, 'UP FILE', NULL, 'uploads/files/products/tech_shape_file', 'uploads/files/products/tech_shape_file/UP FILE.jpg', NULL, 'jpg', 1, '2023-09-28 15:21:47', '2023-09-28 15:21:47', 4);
INSERT INTO `files` VALUES (26, 'OLYM COUTA', NULL, 'uploads/files/products/design_file', 'uploads/files/products/design_file/OLYM COUTA.ai', NULL, 'ai', 1, '2023-09-28 15:27:10', '2023-09-28 15:27:10', 3);
INSERT INTO `files` VALUES (27, 'OLYM COUTA CV', NULL, 'uploads/files/products/design_shape_file', 'uploads/files/products/design_shape_file/OLYM COUTA CV.ai', NULL, 'ai', 1, '2023-09-28 15:27:53', '2023-09-28 15:27:53', 3);
INSERT INTO `files` VALUES (28, 'khuôn DH-000008B Phong bao Coo Newcare 80x30x120 mm', NULL, 'uploads/files/products/tech_shape_file', 'uploads/files/products/tech_shape_file/khuôn DH-000008B Phong bao Coo Newcare 80x30x120 mm.pdf', NULL, 'pdf', 1, '2023-09-28 15:30:21', '2023-09-28 15:30:21', 4);
INSERT INTO `files` VALUES (29, 'FileKhuon_00032404A_Vỏ hộp Akennecare _0d_0a ( Hộp to)_', NULL, 'uploads/files/products/tech_shape_file', 'uploads/files/products/tech_shape_file/FileKhuon_00032404A_Vỏ hộp Akennecare _0d_0a ( Hộp to)_.pdf', 1, 'pdf', 1, '2023-09-28 15:32:41', '2023-09-28 15:32:56', 4);
INSERT INTO `files` VALUES (30, 'FileKhuon_00032404A_Vỏ hộp Akennecare _0d_0a ( Hộp to)__1', NULL, 'uploads/files/products/tech_shape_file', 'uploads/files/products/tech_shape_file/FileKhuon_00032404A_Vỏ hộp Akennecare _0d_0a ( Hộp to)__1.pdf', NULL, 'pdf', 1, '2023-09-28 15:32:56', '2023-09-28 15:32:56', 4);
INSERT INTO `files` VALUES (31, 'Bacillus Claussi', NULL, 'uploads/files/products/design_file', 'uploads/files/products/design_file/Bacillus Claussi.ai', 1, 'ai', 1, '2023-09-28 16:04:33', '2023-09-28 16:14:57', 3);
INSERT INTO `files` VALUES (32, 'Bacillus Claussi CV', NULL, 'uploads/files/products/design_shape_file', 'uploads/files/products/design_shape_file/Bacillus Claussi CV.ai', 1, 'ai', 1, '2023-09-28 16:04:53', '2023-09-28 16:15:08', 3);
INSERT INTO `files` VALUES (33, 'FileKhuon_00027665A_bộ ( hộp+toa) thym_0d_0a oglucan 2 loại_130 65 110_', NULL, 'uploads/files/products/handle_shape_file', 'uploads/files/products/handle_shape_file/FileKhuon_00027665A_bộ ( hộp+toa) thym_0d_0a oglucan 2 loại_130 65 110_.pdf', NULL, 'pdf', 1, '2023-09-28 16:08:06', '2023-09-28 16:08:06', 5);
INSERT INTO `files` VALUES (34, 'Bacillus Claussi_1', NULL, 'uploads/files/products/design_file', 'uploads/files/products/design_file/Bacillus Claussi_1.ai', NULL, 'ai', 1, '2023-09-28 16:14:57', '2023-09-28 16:14:57', 3);
INSERT INTO `files` VALUES (35, 'Bacillus Claussi CV_1', NULL, 'uploads/files/products/design_shape_file', 'uploads/files/products/design_shape_file/Bacillus Claussi CV_1.ai', NULL, 'ai', 1, '2023-09-28 16:15:08', '2023-09-28 16:15:08', 3);
INSERT INTO `files` VALUES (36, 'Túi Eva Estrogen', NULL, 'uploads/files/products/design_file', 'uploads/files/products/design_file/Túi Eva Estrogen.ai', NULL, 'ai', 1, '2023-09-28 16:30:50', '2023-09-28 16:30:50', 3);
INSERT INTO `files` VALUES (37, 'Túi Eva Estrogen CV', NULL, 'uploads/files/products/design_shape_file', 'uploads/files/products/design_shape_file/Túi Eva Estrogen CV.ai', NULL, 'ai', 1, '2023-09-28 16:30:59', '2023-09-28 16:30:59', 3);
INSERT INTO `files` VALUES (38, 'khuon 30633  túi Eva Estrogen ( chưa lật )', NULL, 'uploads/files/products/handle_shape_file', 'uploads/files/products/handle_shape_file/khuon 30633  túi Eva Estrogen ( chưa lật ).pdf', NULL, 'pdf', 1, '2023-09-28 17:17:10', '2023-09-28 17:17:10', 5);
INSERT INTO `files` VALUES (39, 'khuôn DH-000011A Olymcouta 65x55x130(chưa lật)', NULL, 'uploads/files/products/handle_shape_file', 'uploads/files/products/handle_shape_file/khuôn DH-000011A Olymcouta 65x55x130(chưa lật).pdf', 1, 'pdf', 1, '2023-09-28 17:36:03', '2023-09-28 17:36:41', 5);
INSERT INTO `files` VALUES (40, 'khuôn DH-000011A Olymcouta 65x55x130(chưa lật)_1', NULL, 'uploads/files/products/handle_shape_file', 'uploads/files/products/handle_shape_file/khuôn DH-000011A Olymcouta 65x55x130(chưa lật)_1.pdf', NULL, 'pdf', 1, '2023-09-28 17:36:41', '2023-09-28 17:36:41', 5);
INSERT INTO `files` VALUES (41, 'khuôn 00022305A  Bacillus Claussi(chưa lật)', NULL, 'uploads/files/products/handle_shape_file', 'uploads/files/products/handle_shape_file/khuôn 00022305A  Bacillus Claussi(chưa lật).pdf', NULL, 'pdf', 1, '2023-09-28 17:41:12', '2023-09-28 17:41:12', 5);
INSERT INTO `files` VALUES (42, 'khuôn DH-000010AHộp giấy INSUVA(chưa lật)', NULL, 'uploads/files/products/tech_shape_file', 'uploads/files/products/tech_shape_file/khuôn DH-000010AHộp giấy INSUVA(chưa lật).pdf', NULL, 'pdf', 1, '2023-09-28 17:58:12', '2023-09-28 17:58:12', 4);
INSERT INTO `files` VALUES (43, 'khuôn DH-000009A Bio Enter Clausii(chưa lật)', NULL, 'uploads/files/products/handle_shape_file', 'uploads/files/products/handle_shape_file/khuôn DH-000009A Bio Enter Clausii(chưa lật).pdf', NULL, 'pdf', 1, '2023-09-29 08:41:11', '2023-09-29 08:41:11', 5);
INSERT INTO `files` VALUES (44, 'chamcong', NULL, 'uploads/files/products/design_file', 'uploads/files/products/design_file/chamcong.sql', NULL, 'sql', 1, '2023-09-29 10:35:58', '2023-09-29 10:35:58', 3);
INSERT INTO `files` VALUES (47, 'INSUVA END', NULL, 'uploads/files/products/design_file', 'uploads/files/products/design_file/INSUVA END.ai', 1, 'ai', 1, '2023-09-29 13:47:56', '2023-09-29 14:49:49', 3);
INSERT INTO `files` VALUES (48, 'INSUVA END_1', NULL, 'uploads/files/products/design_file', 'uploads/files/products/design_file/INSUVA END_1.ai', NULL, 'ai', 1, '2023-09-29 14:49:49', '2023-09-29 14:49:49', 3);
INSERT INTO `files` VALUES (49, '7', NULL, 'uploads/files/products/sale_shape_file', 'uploads/files/products/sale_shape_file/7.jpg', NULL, 'jpg', 1, '2023-09-29 15:22:56', '2023-09-29 15:22:56', 1);
INSERT INTO `files` VALUES (50, '7', NULL, 'uploads/files/orders/rest_bill', 'uploads/files/orders/rest_bill/7.jpg', NULL, 'jpg', 1, '2023-09-29 15:24:16', '2023-09-29 15:24:16', 1);
INSERT INTO `files` VALUES (51, '7', NULL, 'uploads/files/products/tech_shape_file', 'uploads/files/products/tech_shape_file/7.jpg', NULL, 'jpg', 1, '2023-09-29 15:25:26', '2023-09-29 15:25:26', 4);
INSERT INTO `files` VALUES (52, '7', NULL, 'uploads/files/products/design_file', 'uploads/files/products/design_file/7.jpg', NULL, 'jpg', 1, '2023-09-29 15:27:34', '2023-09-29 15:27:34', 3);
INSERT INTO `files` VALUES (53, '7', NULL, 'uploads/files/products/design_shape_file', 'uploads/files/products/design_shape_file/7.jpg', NULL, 'jpg', 1, '2023-09-29 15:27:37', '2023-09-29 15:27:37', 3);
INSERT INTO `files` VALUES (54, '7', NULL, 'uploads/files/products/handle_shape_file', 'uploads/files/products/handle_shape_file/7.jpg', NULL, 'jpg', 1, '2023-09-29 15:28:30', '2023-09-29 15:28:30', 5);
INSERT INTO `files` VALUES (55, '7', NULL, 'uploads/files/log[bill]', 'uploads/files/log[bill]/7.jpg', 1, 'jpg', 1, '2023-09-29 15:34:48', '2023-09-29 15:37:21', 7);
INSERT INTO `files` VALUES (56, '7_1', NULL, 'uploads/files/log[bill]', 'uploads/files/log[bill]/7_1.jpg', NULL, 'jpg', 1, '2023-09-29 15:37:21', '2023-09-29 15:37:21', 7);
INSERT INTO `files` VALUES (57, 'INSUVA END-01', NULL, 'uploads/files/products/design_file', 'uploads/files/products/design_file/INSUVA END-01.png', NULL, 'png', 1, '2023-09-29 16:09:48', '2023-09-29 16:09:48', 3);
INSERT INTO `files` VALUES (58, 'Gotu-Regular', NULL, 'uploads/files/products/design_file', 'uploads/files/products/design_file/Gotu-Regular.ttf', NULL, 'ttf', 1, '2023-09-29 16:10:18', '2023-09-29 16:10:18', 3);
INSERT INTO `files` VALUES (59, 'Gotu-Regular', NULL, 'uploads/files/products/design_shape_file', 'uploads/files/products/design_shape_file/Gotu-Regular.ttf', NULL, 'ttf', 1, '2023-09-29 16:10:23', '2023-09-29 16:10:23', 3);
INSERT INTO `files` VALUES (60, 'Hoop moi a trung', NULL, 'uploads/files/products/sale_shape_file', 'uploads/files/products/sale_shape_file/Hoop moi a trung.cdr', NULL, 'cdr', 1, '2023-09-30 08:12:33', '2023-09-30 08:12:33', 1);
INSERT INTO `files` VALUES (61, 'dưỡng da 123 plus', NULL, 'uploads/files/products/sale_shape_file', 'uploads/files/products/sale_shape_file/dưỡng da 123 plus.cdr', 1, 'cdr', 1, '2023-09-30 14:13:57', '2023-09-30 14:30:08', 10);
INSERT INTO `files` VALUES (62, 'dưỡng da 123 plus_1', NULL, 'uploads/files/products/sale_shape_file', 'uploads/files/products/sale_shape_file/dưỡng da 123 plus_1.cdr', NULL, 'cdr', 1, '2023-09-30 14:30:08', '2023-09-30 14:30:08', 10);
INSERT INTO `files` VALUES (63, 'FileKhuon_00028600A_bộ (hộp +tem+toa) %0d%0a pregnacare_ 80 55 130 mm_', NULL, 'uploads/files/products/sale_shape_file', 'uploads/files/products/sale_shape_file/FileKhuon_00028600A_bộ (hộp +tem+toa) %0d%0a pregnacare_ 80 55 130 mm_.pdf', NULL, 'pdf', 1, '2023-09-30 15:22:56', '2023-09-30 15:22:56', 10);
INSERT INTO `files` VALUES (64, '0f29c7686f11024ac2d64c80a910fa02', NULL, 'uploads/files/products/sale_shape_file', 'uploads/files/products/sale_shape_file/0f29c7686f11024ac2d64c80a910fa02.jpg', 1, 'jpg', 1, '2023-09-30 19:08:48', '2023-09-30 20:23:13', 2);
INSERT INTO `files` VALUES (65, '0f29c7686f11024ac2d64c80a910fa02_1', NULL, 'uploads/files/products/sale_shape_file', 'uploads/files/products/sale_shape_file/0f29c7686f11024ac2d64c80a910fa02_1.jpg', NULL, 'jpg', 1, '2023-09-30 20:23:13', '2023-09-30 20:23:13', 1);
INSERT INTO `files` VALUES (66, 'z4733599205103_b3f925dda987872bbe9dd21e2f8f924e', NULL, 'uploads/files/log[bill]', 'uploads/files/log[bill]/z4733599205103_b3f925dda987872bbe9dd21e2f8f924e.jpg', 7, 'jpg', 1, '2023-10-01 11:19:59', '2023-10-01 12:19:42', 1);
INSERT INTO `files` VALUES (67, 'z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_1', NULL, 'uploads/files/log[bill]', 'uploads/files/log[bill]/z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_1.jpg', NULL, 'jpg', 1, '2023-10-01 11:21:23', '2023-10-01 11:21:23', 1);
INSERT INTO `files` VALUES (68, 'z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_2', NULL, 'uploads/files/log[bill]', 'uploads/files/log[bill]/z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_2.jpg', NULL, 'jpg', 1, '2023-10-01 11:22:56', '2023-10-01 11:22:56', 1);
INSERT INTO `files` VALUES (69, 'z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_3', NULL, 'uploads/files/log[bill]', 'uploads/files/log[bill]/z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_3.jpg', NULL, 'jpg', 1, '2023-10-01 11:23:41', '2023-10-01 11:23:41', 1);
INSERT INTO `files` VALUES (70, 'z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_4', NULL, 'uploads/files/log[bill]', 'uploads/files/log[bill]/z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_4.jpg', NULL, 'jpg', 1, '2023-10-01 11:24:41', '2023-10-01 11:24:41', 1);
INSERT INTO `files` VALUES (71, 'z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_5', NULL, 'uploads/files/log[bill]', 'uploads/files/log[bill]/z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_5.jpg', NULL, 'jpg', 1, '2023-10-01 12:17:24', '2023-10-01 12:17:24', 1);
INSERT INTO `files` VALUES (72, 'z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_6', NULL, 'uploads/files/log[bill]', 'uploads/files/log[bill]/z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_6.jpg', NULL, 'jpg', 1, '2023-10-01 12:18:18', '2023-10-01 12:18:18', 1);
INSERT INTO `files` VALUES (73, 'z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_7', NULL, 'uploads/files/log[bill]', 'uploads/files/log[bill]/z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_7.jpg', NULL, 'jpg', 1, '2023-10-01 12:19:42', '2023-10-01 12:19:42', 1);
INSERT INTO `files` VALUES (80, 'MẪU 16- 2 CÁNH IN THƯỜNG', NULL, 'storages/uploads', 'storage/app/public/uploads/MẪU 16- 2 CÁNH IN THƯỜNG', 1, 'ai', 1, '2023-10-04 06:46:08', '2023-10-04 06:55:50', 1);
INSERT INTO `files` VALUES (81, 'MẪU 17 - CNC Cung chuc tan xuan tron canh', NULL, 'storages/uploads', 'storage/app/public/uploads/MẪU 17 - CNC Cung chuc tan xuan tron canh', NULL, 'ai', 1, '2023-10-04 06:53:55', '2023-10-04 06:53:55', 4);
INSERT INTO `files` VALUES (82, 'MẪU 16- 2 CÁNH IN THƯỜNG(1)', NULL, 'storages/uploads', 'storage/app/public/uploads/MẪU 16- 2 CÁNH IN THƯỜNG(1)', NULL, 'ai', 1, '2023-10-04 06:55:52', '2023-10-04 06:55:52', 3);
INSERT INTO `files` VALUES (83, 'MẪU 17 - CNC', NULL, 'storages/uploads', 'storage/app/public/uploads/MẪU 17 - CNC', 1, 'pdf', 1, '2023-10-04 06:56:01', '2023-10-04 06:56:42', 3);
INSERT INTO `files` VALUES (84, 'MẪU 17 - CNC(1)', NULL, 'storages/uploads', 'storage/app/public/uploads/MẪU 17 - CNC(1)', NULL, 'pdf', 1, '2023-10-04 06:56:42', '2023-10-04 06:56:42', 5);
INSERT INTO `files` VALUES (85, '1 THUYỀN THẲNG 2024 ok', NULL, 'storages/uploads', 'storage/app/public/uploads/1 THUYỀN THẲNG 2024 ok', 1, 'cdr', 1, '2023-10-04 08:49:43', '2023-10-04 10:18:06', 1);
INSERT INTO `files` VALUES (86, '1 THUYỀN THẲNG 2024 ok(1)', NULL, 'storages/uploads', 'storage/app/public/uploads/1 THUYỀN THẲNG 2024 ok(1)', NULL, 'cdr', 1, '2023-10-04 10:18:06', '2023-10-04 10:18:06', 1);
INSERT INTO `files` VALUES (87, 'CỠ 1 - Nhỏ nhất', NULL, 'storages/uploads', 'storage/app/public/uploads/CỠ 1 - Nhỏ nhất', NULL, 'cdr', 1, '2023-10-05 21:39:57', '2023-10-05 21:39:57', 1);
INSERT INTO `files` VALUES (88, 'CỠ 2 HÌNH CÁI QUẠT', NULL, 'storages/uploads', 'storage/app/public/uploads/CỠ 2 HÌNH CÁI QUẠT', NULL, 'cdr', 1, '2023-10-05 21:54:02', '2023-10-05 21:54:02', 1);
INSERT INTO `files` VALUES (89, 'z4740902657631_c709f1fad82bab43b1410bc080d11b3e309', NULL, 'storages/uploads', 'storage/app/public/uploads/z4740902657631_c709f1fad82bab43b1410bc080d11b3e309', NULL, 'jpg', 1, '2023-10-06 09:00:22', '2023-10-06 09:00:22', 7);
INSERT INTO `files` VALUES (90, 'z4754814908091_e354e8304c3fa35b01885cc2ce469068.3.10', NULL, 'storages/uploads', 'storage/app/public/uploads/z4754814908091_e354e8304c3fa35b01885cc2ce469068.3.10', 1, 'jpg', 1, '2023-10-06 09:03:14', '2023-10-06 09:04:54', 7);
INSERT INTO `files` VALUES (91, 'z4754814908091_e354e8304c3fa35b01885cc2ce469068.3.10(1)', NULL, 'storages/uploads', 'storage/app/public/uploads/z4754814908091_e354e8304c3fa35b01885cc2ce469068.3.10(1)', NULL, 'jpg', 1, '2023-10-06 09:04:54', '2023-10-06 09:04:54', 7);
INSERT INTO `files` VALUES (92, 'z4757664944281_8905b34b8c31e8fed9a5094c1605ba3c.6.10', NULL, 'storages/uploads', 'storage/app/public/uploads/z4757664944281_8905b34b8c31e8fed9a5094c1605ba3c.6.10', 2, 'jpg', 1, '2023-10-06 09:06:32', '2023-10-06 09:29:47', 7);
INSERT INTO `files` VALUES (93, 'z4757706903407_2b6e350b72256de66a8dd153f82eaf83.9.9', NULL, 'storages/uploads', 'storage/app/public/uploads/z4757706903407_2b6e350b72256de66a8dd153f82eaf83.9.9', NULL, 'jpg', 1, '2023-10-06 09:18:40', '2023-10-06 09:18:40', 7);
INSERT INTO `files` VALUES (94, 'z4757664944281_8905b34b8c31e8fed9a5094c1605ba3c.6.10(1)', NULL, 'storages/uploads', 'storage/app/public/uploads/z4757664944281_8905b34b8c31e8fed9a5094c1605ba3c.6.10(1)', NULL, 'jpg', 1, '2023-10-06 09:23:56', '2023-10-06 09:23:56', 7);
INSERT INTO `files` VALUES (95, 'z4757664944281_8905b34b8c31e8fed9a5094c1605ba3c.6.10(2)', NULL, 'storages/uploads', 'storage/app/public/uploads/z4757664944281_8905b34b8c31e8fed9a5094c1605ba3c.6.10(2)', NULL, 'jpg', 1, '2023-10-06 09:29:47', '2023-10-06 09:29:47', 7);
INSERT INTO `files` VALUES (96, '1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999', NULL, 'storages/uploads', 'storage/app/public/uploads/1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999', 7, 'cdr', 1, '2023-10-07 07:19:13', '2023-10-21 08:08:02', 1);
INSERT INTO `files` VALUES (97, '1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(1)', NULL, 'storages/uploads', 'storage/app/public/uploads/1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(1)', NULL, 'cdr', 1, '2023-10-07 08:07:00', '2023-10-07 08:07:00', 4);
INSERT INTO `files` VALUES (98, '1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(2)', NULL, 'storages/uploads', 'storage/app/public/uploads/1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(2)', NULL, 'cdr', 1, '2023-10-07 08:07:33', '2023-10-07 08:07:33', 4);
INSERT INTO `files` VALUES (99, '1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(3)', NULL, 'storages/uploads', 'storage/app/public/uploads/1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(3)', NULL, 'cdr', 1, '2023-10-07 08:08:46', '2023-10-07 08:08:46', 4);
INSERT INTO `files` VALUES (100, 'mẫu TD-C101C', NULL, 'storages/uploads', 'storage/app/public/uploads/mẫu TD-C101C', 1, 'pdf', 1, '2023-10-07 08:11:28', '2023-10-07 08:11:46', 3);
INSERT INTO `files` VALUES (101, 'mẫu TD-C101C(1)', NULL, 'storages/uploads', 'storage/app/public/uploads/mẫu TD-C101C(1)', NULL, 'pdf', 1, '2023-10-07 08:11:47', '2023-10-07 08:11:47', 3);
INSERT INTO `files` VALUES (102, 'mẫu TD-C101B', NULL, 'storages/uploads', 'storage/app/public/uploads/mẫu TD-C101B', 1, 'pdf', 1, '2023-10-07 08:12:04', '2023-10-07 08:12:14', 3);
INSERT INTO `files` VALUES (103, 'mẫu TD-C101B(1)', NULL, 'storages/uploads', 'storage/app/public/uploads/mẫu TD-C101B(1)', NULL, 'pdf', 1, '2023-10-07 08:12:14', '2023-10-07 08:12:14', 3);
INSERT INTO `files` VALUES (104, 'mẫu TD-C101A', NULL, 'storages/uploads', 'storage/app/public/uploads/mẫu TD-C101A', 1, 'pdf', 1, '2023-10-07 08:12:37', '2023-10-07 08:12:51', 3);
INSERT INTO `files` VALUES (105, 'mẫu TD-C101A(1)', NULL, 'storages/uploads', 'storage/app/public/uploads/mẫu TD-C101A(1)', NULL, 'pdf', 1, '2023-10-07 08:12:51', '2023-10-07 08:12:51', 3);
INSERT INTO `files` VALUES (106, 'khuôn ép nhũ mã 01', NULL, 'storages/uploads', 'storage/app/public/uploads/khuôn ép nhũ mã 01', 2, 'pdf', 1, '2023-10-07 08:13:39', '2023-10-07 08:14:17', 5);
INSERT INTO `files` VALUES (107, 'khuôn ép nhũ mã 01(1)', NULL, 'storages/uploads', 'storage/app/public/uploads/khuôn ép nhũ mã 01(1)', NULL, 'pdf', 1, '2023-10-07 08:14:00', '2023-10-07 08:14:00', 5);
INSERT INTO `files` VALUES (108, 'khuôn ép nhũ mã 01(2)', NULL, 'storages/uploads', 'storage/app/public/uploads/khuôn ép nhũ mã 01(2)', NULL, 'pdf', 1, '2023-10-07 08:14:17', '2023-10-07 08:14:17', 5);
INSERT INTO `files` VALUES (109, 'khuôn DH-000010AHộp giấy INSUVA(chưa lật)', NULL, 'storages/uploads', 'storage/app/public/uploads/khuôn DH-000010AHộp giấy INSUVA(chưa lật)', NULL, 'pdf', 1, '2023-10-07 08:15:11', '2023-10-07 08:15:11', 5);
INSERT INTO `files` VALUES (110, 'z4760701989751_6f54d1003e109c981cf6a00cea345769mang505', NULL, 'storages/uploads', 'storage/app/public/uploads/z4760701989751_6f54d1003e109c981cf6a00cea345769mang505', 1, 'jpg', 1, '2023-10-07 08:27:51', '2023-10-07 08:49:00', 7);
INSERT INTO `files` VALUES (111, 'z4760701989751_6f54d1003e109c981cf6a00cea345769mang505(1)', NULL, 'storages/uploads', 'storage/app/public/uploads/z4760701989751_6f54d1003e109c981cf6a00cea345769mang505(1)', NULL, 'jpg', 1, '2023-10-07 08:49:00', '2023-10-07 08:49:00', 7);
INSERT INTO `files` VALUES (112, 'ảnh 1', NULL, 'storages/uploads', 'storage/app/public/uploads/ảnh 1.jpg', NULL, 'jpg', 1, '2023-10-08 07:07:48', '2023-10-08 07:07:48', 1);
INSERT INTO `files` VALUES (113, 'nova', NULL, 'storages/uploads', 'storage/app/public/uploads/nova.cdr', NULL, 'cdr', 1, '2023-10-09 15:04:18', '2023-10-09 15:04:18', 10);
INSERT INTO `files` VALUES (114, '1 CARTON ĐÁY CHAI RƯỢU 2024', NULL, 'storages/uploads', 'storage/app/public/uploads/1 CARTON ĐÁY CHAI RƯỢU 2024.cdr', 5, 'cdr', 1, '2023-10-14 12:56:34', '2023-10-14 16:07:33', 10);
INSERT INTO `files` VALUES (115, '1 CARTON ĐÁY CHAI RƯỢU 2024', NULL, 'storages/uploads', 'storage/app/public/uploads/1 CARTON ĐÁY CHAI RƯỢU 2024(1).cdr', NULL, 'cdr', 1, '2023-10-14 13:11:05', '2023-10-14 13:11:05', 1);
INSERT INTO `files` VALUES (116, '1 CARTON ĐÁY CHAI RƯỢU 2024', NULL, 'storages/uploads', 'storage/app/public/uploads/1 CARTON ĐÁY CHAI RƯỢU 2024(2).cdr', NULL, 'cdr', 1, '2023-10-14 15:36:14', '2023-10-14 15:36:14', 1);
INSERT INTO `files` VALUES (117, '1 CARTON ĐÁY CHAI RƯỢU 2024', NULL, 'storages/uploads', 'storage/app/public/uploads/1 CARTON ĐÁY CHAI RƯỢU 2024(3).cdr', NULL, 'cdr', 1, '2023-10-14 16:01:25', '2023-10-14 16:01:25', 1);
INSERT INTO `files` VALUES (118, '1 CARTON ĐÁY CHAI RƯỢU 2024', NULL, 'storages/uploads', 'storage/app/public/uploads/1 CARTON ĐÁY CHAI RƯỢU 2024(4).cdr', NULL, 'cdr', 1, '2023-10-14 16:03:26', '2023-10-14 16:03:26', 1);
INSERT INTO `files` VALUES (119, '1 CARTON ĐÁY CHAI RƯỢU 2024', NULL, 'storages/uploads', 'storage/app/public/uploads/1 CARTON ĐÁY CHAI RƯỢU 2024(5).cdr', NULL, 'cdr', 1, '2023-10-14 16:07:33', '2023-10-14 16:07:33', 1);
INSERT INTO `files` VALUES (120, '2 CỔ CHAI RƯỢU', NULL, 'storages/uploads', 'storage/app/public/uploads/2 CỔ CHAI RƯỢU.cdr', NULL, 'cdr', 1, '2023-10-14 16:15:23', '2023-10-14 16:15:23', 1);
INSERT INTO `files` VALUES (121, 'Nền màu xanh', NULL, 'storages/uploads', 'storage/app/public/uploads/Nền màu xanh.jpg', 3, 'jpg', 1, '2023-10-18 06:08:08', '2023-10-18 07:15:59', 1);
INSERT INTO `files` VALUES (122, 'Nền màu xanh', NULL, 'storages/uploads', 'storage/app/public/uploads/Nền màu xanh(1).jpg', NULL, 'jpg', 1, '2023-10-18 06:52:37', '2023-10-18 06:52:37', 1);
INSERT INTO `files` VALUES (123, 'Nền màu xanh', NULL, 'storages/uploads', 'storage/app/public/uploads/Nền màu xanh(2).jpg', NULL, 'jpg', 1, '2023-10-18 07:07:34', '2023-10-18 07:07:34', 1);
INSERT INTO `files` VALUES (124, 'Nền màu xanh', NULL, 'storages/uploads', 'storage/app/public/uploads/Nền màu xanh(3).jpg', NULL, 'jpg', 1, '2023-10-18 07:15:59', '2023-10-18 07:15:59', 1);
INSERT INTO `files` VALUES (125, 'A5-A9', NULL, 'storages/uploads', 'storage/app/public/uploads/A5-A9.cdr', 1, 'cdr', 1, '2023-10-21 06:31:04', '2023-10-21 06:49:22', 1);
INSERT INTO `files` VALUES (126, 'A5-A9', NULL, 'storages/uploads', 'storage/app/public/uploads/A5-A9(1).cdr', NULL, 'cdr', 1, '2023-10-21 06:49:22', '2023-10-21 06:49:22', 1);
INSERT INTO `files` VALUES (127, '1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999', NULL, 'storages/uploads', 'storage/app/public/uploads/1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(4).cdr', NULL, 'cdr', 1, '2023-10-21 07:40:56', '2023-10-21 07:40:56', 1);
INSERT INTO `files` VALUES (128, '1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999', NULL, 'storages/uploads', 'storage/app/public/uploads/1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(5).cdr', NULL, 'cdr', 1, '2023-10-21 07:52:13', '2023-10-21 07:52:13', 1);
INSERT INTO `files` VALUES (129, '1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999', NULL, 'storages/uploads', 'storage/app/public/uploads/1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(6).cdr', NULL, 'cdr', 1, '2023-10-21 07:58:41', '2023-10-21 07:58:41', 1);
INSERT INTO `files` VALUES (130, '1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999', NULL, 'storages/uploads', 'storage/app/public/uploads/1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(7).cdr', NULL, 'cdr', 1, '2023-10-21 08:08:02', '2023-10-21 08:08:02', 1);
INSERT INTO `files` VALUES (131, 'Hộp cứng Bigfam', NULL, 'storages/uploads', 'storage/app/public/uploads/Hộp cứng Bigfam.cdr', NULL, 'cdr', 1, '2023-10-21 14:30:41', '2023-10-21 14:30:41', 1);
INSERT INTO `files` VALUES (132, 'khăn mat', NULL, 'storages/uploads', 'storage/app/public/uploads/khăn mat.pdf', NULL, 'pdf', 1, '2023-10-25 08:48:52', '2023-10-25 08:48:52', 1);
INSERT INTO `files` VALUES (133, 'Cắt mẫu 3 khay định hình', NULL, 'storages/uploads', 'storage/app/public/uploads/Cắt mẫu 3 khay định hình.cdr', NULL, 'cdr', 1, '2023-10-26 09:58:57', '2023-10-26 09:58:57', 1);
INSERT INTO `files` VALUES (134, 'Tinh giá', NULL, 'storages/uploads', 'storage/app/public/uploads/Tinh giá.cdr', NULL, 'cdr', 1, '2023-10-31 09:28:32', '2023-10-31 09:28:32', 1);
INSERT INTO `files` VALUES (135, 'HQT cặp xách 2024', NULL, 'storages/uploads', 'storage/app/public/uploads/HQT cặp xách 2024.cdr', NULL, 'cdr', 1, '2023-11-01 16:11:21', '2023-11-01 16:11:21', 1);
INSERT INTO `files` VALUES (136, 'HQT 36x36 cao cấp 2024(2)', NULL, 'storages/uploads', 'storage/app/public/uploads/HQT 36x36 cao cấp 2024(2).cdr', NULL, 'cdr', 1, '2023-11-01 16:28:07', '2023-11-01 16:28:07', 1);
INSERT INTO `files` VALUES (137, 'HQT 36x42 cao cấp 2024', NULL, 'storages/uploads', 'storage/app/public/uploads/HQT 36x42 cao cấp 2024.cdr', NULL, 'cdr', 1, '2023-11-01 16:41:28', '2023-11-01 16:41:28', 1);
INSERT INTO `files` VALUES (138, 'Khuôn ĐỨC HNA', NULL, 'storages/uploads', 'storage/app/public/uploads/Khuôn ĐỨC HNA.cdr', NULL, 'cdr', 1, '2023-11-02 08:43:16', '2023-11-02 08:43:16', 1);

-- ----------------------------
-- Table structure for fill_finishes
-- ----------------------------
DROP TABLE IF EXISTS `fill_finishes`;
CREATE TABLE `fill_finishes`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `product_qty` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `fill` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `finish` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `magnet` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `total_cost` bigint(20) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `product` int(10) NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `quote_index`(`product`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 62 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fill_finishes
-- ----------------------------
INSERT INTO `fill_finishes` VALUES (46, NULL, '10000', '{\"stage\":[{\"length\":\"51\",\"width\":\"62\",\"materal\":\"20\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":24272000,\"work_price\":500,\"shape_price\":300000}],\"ext_price\":\"1000\",\"qty_pro\":10000,\"handle_qty\":10050,\"fill_cost\":24272000,\"act\":1,\"total\":34272000}', '{\"ext_price\":\"0\",\"qty_pro\":10000,\"handle_qty\":10050,\"finish_cost\":0,\"act\":0,\"total\":0}', '{\"type\":null,\"qty\":null,\"qttv_price\":0,\"magnet_perc\":1.05,\"qty_pro\":10000,\"act\":0,\"total\":0}', NULL, NULL, 34272000, '2023-10-19 14:38:58', '2023-10-19 14:38:58', 73, 1, 1);
INSERT INTO `fill_finishes` VALUES (47, NULL, '100000', '{\"stage\":[{\"length\":null,\"width\":null,\"machine\":null,\"qttv_price\":0,\"cost\":0}],\"ext_price\":\"200\",\"qty_pro\":100000,\"handle_qty\":100050,\"fill_cost\":0,\"act\":1,\"total\":20000000}', '{\"ext_price\":\"0\",\"qty_pro\":100000,\"handle_qty\":100050,\"finish_cost\":0,\"act\":0,\"total\":0}', '{\"type\":null,\"qty\":null,\"qttv_price\":0,\"magnet_perc\":1.05,\"qty_pro\":100000,\"act\":0,\"total\":0}', NULL, NULL, 20000000, '2023-10-18 07:12:54', '2023-10-18 07:12:54', 75, 1, 1);
INSERT INTO `fill_finishes` VALUES (48, NULL, '13000', '{\"stage\":[{\"length\":\"22\",\"width\":\"23\",\"materal\":\"18\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":10746799.999999998,\"work_price\":500,\"shape_price\":300000},{\"length\":\"21\",\"width\":\"21\",\"materal\":\"16\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":10239799.999999998,\"work_price\":500,\"shape_price\":300000}],\"ext_price\":\"0\",\"qty_pro\":13000,\"handle_qty\":13050,\"fill_cost\":20986599.999999996,\"act\":1,\"total\":20986599.999999996}', '{\"ext_price\":\"500\",\"qty_pro\":13000,\"handle_qty\":13050,\"finish_cost\":0,\"act\":1,\"total\":6500000}', '{\"type\":null,\"qty\":null,\"qttv_price\":0,\"magnet_perc\":1.05,\"qty_pro\":13000,\"act\":0,\"total\":0}', NULL, NULL, 27486600, '2023-10-21 06:41:23', '2023-10-21 06:41:23', 76, 1, 1);
INSERT INTO `fill_finishes` VALUES (49, NULL, '3500', '{\"stage\":[{\"length\":\"15\",\"width\":\"33\",\"materal\":\"18\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":3089500,\"work_price\":500,\"shape_price\":300000},{\"length\":\"13.4\",\"width\":\"31.2\",\"materal\":\"16\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":2927968,\"work_price\":500,\"shape_price\":300000}],\"ext_price\":\"0\",\"qty_pro\":3500,\"handle_qty\":3550,\"fill_cost\":6017468,\"act\":1,\"total\":6017468}', '{\"ext_price\":\"500\",\"qty_pro\":3500,\"handle_qty\":3550,\"finish_cost\":0,\"act\":1,\"total\":1750000}', '{\"type\":null,\"qty\":null,\"qttv_price\":0,\"magnet_perc\":1.05,\"qty_pro\":3500,\"act\":0,\"total\":0}', NULL, NULL, 7767468, '2023-10-21 06:57:41', '2023-10-21 06:57:41', 77, 1, 1);
INSERT INTO `fill_finishes` VALUES (50, NULL, '100000', '{\"stage\":[{\"length\":null,\"width\":null,\"machine\":null,\"qttv_price\":0,\"cost\":0}],\"ext_price\":\"145\",\"qty_pro\":100000,\"handle_qty\":100050,\"fill_cost\":0,\"act\":1,\"total\":14500000}', '{\"ext_price\":\"0\",\"qty_pro\":100000,\"handle_qty\":100050,\"finish_cost\":0,\"act\":0,\"total\":0}', '{\"type\":null,\"qty\":null,\"qttv_price\":0,\"magnet_perc\":1.05,\"qty_pro\":100000,\"act\":0,\"total\":0}', NULL, NULL, 14500000, '2023-10-21 07:56:21', '2023-10-21 07:56:21', 79, 1, 1);
INSERT INTO `fill_finishes` VALUES (51, NULL, '100000', '{\"stage\":[{\"length\":\"19\",\"width\":\"53\",\"materal\":\"20\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":110719999.99999999,\"work_price\":500,\"shape_price\":300000}],\"ext_price\":\"0\",\"qty_pro\":100000,\"handle_qty\":100050,\"fill_cost\":110719999.99999999,\"act\":1,\"total\":110719999.99999999}', '{\"ext_price\":\"0\",\"qty_pro\":100000,\"handle_qty\":100050,\"finish_cost\":0,\"act\":0,\"total\":0}', '{\"type\":null,\"qty\":null,\"qttv_price\":0,\"magnet_perc\":1.05,\"qty_pro\":100000,\"act\":0,\"total\":0}', NULL, NULL, 110720000, '2023-10-21 08:01:37', '2023-10-21 08:01:37', 80, 1, 1);
INSERT INTO `fill_finishes` VALUES (52, NULL, '10000', '{\"stage\":[{\"length\":\"51\",\"width\":\"56\",\"materal\":\"16\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":22436000,\"work_price\":500,\"shape_price\":300000},{\"length\":\"51\",\"width\":\"56\",\"materal\":\"18\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":22436000,\"work_price\":500,\"shape_price\":300000},{\"length\":\"20\",\"width\":\"80\",\"materal\":\"19\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":14900000,\"work_price\":500,\"shape_price\":300000},{\"length\":\"19\",\"width\":\"79\",\"materal\":\"19\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":14306000,\"work_price\":500,\"shape_price\":300000}],\"ext_price\":\"0\",\"qty_pro\":10000,\"handle_qty\":10050,\"fill_cost\":74078000,\"act\":1,\"total\":74078000}', '{\"stage\":[{\"materal\":\"53\",\"qttv_price\":500,\"cost\":5000000},{\"materal\":\"58\",\"qttv_price\":150,\"cost\":1500000},{\"materal\":\"58\",\"qttv_price\":150,\"cost\":1500000},{\"materal\":\"58\",\"qttv_price\":150,\"cost\":1500000},{\"materal\":\"54\",\"qttv_price\":150,\"cost\":1500000},{\"materal\":\"68\",\"qttv_price\":300,\"cost\":3000000}],\"ext_price\":\"1000\",\"qty_pro\":10000,\"handle_qty\":10050,\"finish_cost\":14000000,\"act\":1,\"total\":24000000}', '{\"type\":null,\"qty\":null,\"qttv_price\":0,\"magnet_perc\":1.05,\"qty_pro\":10000,\"act\":0,\"total\":0}', NULL, NULL, 98078000, '2023-10-21 08:18:06', '2023-10-21 08:18:06', 81, 1, 1);
INSERT INTO `fill_finishes` VALUES (53, NULL, '10000', '{\"stage\":[{\"length\":\"51\",\"width\":\"56\",\"materal\":\"16\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":22436000,\"work_price\":500,\"shape_price\":300000},{\"length\":\"51\",\"width\":\"56\",\"materal\":\"18\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":22436000,\"work_price\":500,\"shape_price\":300000},{\"length\":\"20\",\"width\":\"80\",\"materal\":\"19\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":14900000,\"work_price\":500,\"shape_price\":300000},{\"length\":\"19\",\"width\":\"79\",\"materal\":\"19\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":14306000,\"work_price\":500,\"shape_price\":300000}],\"ext_price\":\"0\",\"qty_pro\":10000,\"handle_qty\":10050,\"fill_cost\":74078000,\"act\":1,\"total\":74078000}', '{\"stage\":[{\"materal\":\"53\",\"qttv_price\":500,\"cost\":5000000},{\"materal\":\"58\",\"qttv_price\":150,\"cost\":1500000},{\"materal\":\"58\",\"qttv_price\":150,\"cost\":1500000},{\"materal\":\"58\",\"qttv_price\":150,\"cost\":1500000},{\"materal\":\"54\",\"qttv_price\":150,\"cost\":1500000}],\"ext_price\":\"0\",\"qty_pro\":10000,\"handle_qty\":10050,\"finish_cost\":11000000,\"act\":1,\"total\":11000000}', '{\"type\":null,\"qty\":null,\"qttv_price\":0,\"magnet_perc\":1.05,\"qty_pro\":10000,\"act\":0,\"total\":0}', NULL, NULL, 85078000, '2023-10-21 08:45:30', '2023-10-21 08:45:30', 82, 1, 1);
INSERT INTO `fill_finishes` VALUES (54, NULL, '10000', '{\"stage\":[{\"length\":\"51\",\"width\":\"51\",\"materal\":\"16\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":20906000,\"work_price\":500,\"shape_price\":300000},{\"length\":\"51\",\"width\":\"51\",\"materal\":\"18\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":20906000,\"work_price\":500,\"shape_price\":300000},{\"length\":\"20\",\"width\":\"74\",\"materal\":\"19\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":14180000,\"work_price\":500,\"shape_price\":300000},{\"length\":\"19\",\"width\":\"74\",\"materal\":\"19\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":13736000,\"work_price\":500,\"shape_price\":300000}],\"ext_price\":\"0\",\"qty_pro\":10000,\"handle_qty\":10050,\"fill_cost\":69728000,\"act\":1,\"total\":69728000}', '{\"stage\":[{\"materal\":\"53\",\"qttv_price\":500,\"cost\":5000000},{\"materal\":\"58\",\"qttv_price\":150,\"cost\":1500000},{\"materal\":\"58\",\"qttv_price\":150,\"cost\":1500000},{\"materal\":\"58\",\"qttv_price\":150,\"cost\":1500000},{\"materal\":\"54\",\"qttv_price\":150,\"cost\":1500000}],\"ext_price\":\"0\",\"qty_pro\":10000,\"handle_qty\":10050,\"finish_cost\":11000000,\"act\":1,\"total\":11000000}', '{\"type\":null,\"qty\":null,\"qttv_price\":0,\"magnet_perc\":1.05,\"qty_pro\":10000,\"act\":0,\"total\":0}', NULL, NULL, 80728000, '2023-10-21 08:44:25', '2023-10-21 08:44:25', 83, 1, 1);
INSERT INTO `fill_finishes` VALUES (55, NULL, '10000', '{\"stage\":[{\"length\":\"43\",\"width\":\"50\",\"materal\":\"16\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":18200000,\"work_price\":500,\"shape_price\":300000},{\"length\":\"43\",\"width\":\"50\",\"materal\":\"18\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":18200000,\"work_price\":500,\"shape_price\":300000},{\"length\":\"16\",\"width\":\"67\",\"materal\":\"19\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":11731999.999999998,\"work_price\":500,\"shape_price\":300000},{\"length\":\"16\",\"width\":\"67\",\"materal\":\"19\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":11731999.999999998,\"work_price\":500,\"shape_price\":300000}],\"ext_price\":\"0\",\"qty_pro\":10000,\"handle_qty\":10050,\"fill_cost\":59864000,\"act\":1,\"total\":59864000}', '{\"stage\":[{\"materal\":\"53\",\"qttv_price\":500,\"cost\":5000000},{\"materal\":\"58\",\"qttv_price\":150,\"cost\":1500000},{\"materal\":\"58\",\"qttv_price\":150,\"cost\":1500000},{\"materal\":\"58\",\"qttv_price\":150,\"cost\":1500000},{\"materal\":\"54\",\"qttv_price\":150,\"cost\":1500000}],\"ext_price\":\"0\",\"qty_pro\":10000,\"handle_qty\":10050,\"finish_cost\":11000000,\"act\":1,\"total\":11000000}', '{\"type\":null,\"qty\":null,\"qttv_price\":0,\"magnet_perc\":1.05,\"qty_pro\":10000,\"act\":0,\"total\":0}', NULL, NULL, 70864000, '2023-10-21 08:55:53', '2023-10-21 08:55:53', 84, 1, 1);
INSERT INTO `fill_finishes` VALUES (56, NULL, '5000', '{\"stage\":[{\"length\":\"21\",\"width\":\"43\",\"materal\":\"20\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":5509000,\"work_price\":500,\"shape_price\":300000},{\"length\":\"21\",\"width\":\"18\",\"materal\":\"21\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":3934000,\"work_price\":500,\"shape_price\":300000},{\"length\":\"23\",\"width\":\"27\",\"materal\":\"24\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":4663000,\"work_price\":500,\"shape_price\":300000}],\"ext_price\":\"0\",\"qty_pro\":5000,\"handle_qty\":5050,\"fill_cost\":14106000,\"act\":1,\"total\":14106000}', '{\"stage\":[{\"materal\":\"53\",\"qttv_price\":500,\"cost\":2500000},{\"materal\":\"54\",\"qttv_price\":150,\"cost\":750000},{\"materal\":\"64\",\"qttv_price\":100,\"cost\":500000}],\"ext_price\":\"0\",\"qty_pro\":5000,\"handle_qty\":5050,\"finish_cost\":3750000,\"act\":1,\"total\":3750000}', '{\"type\":\"32\",\"qty\":\"1\",\"qttv_price\":\"1200\",\"magnet_perc\":1.05,\"qty_pro\":5000,\"act\":1,\"total\":6300000}', NULL, NULL, 24156000, '2023-10-31 18:51:48', '2023-10-31 18:51:48', 85, 1, 16);
INSERT INTO `fill_finishes` VALUES (57, NULL, '309330', '{\"stage\":[{\"length\":null,\"width\":null,\"machine\":null,\"qttv_price\":0,\"cost\":0}],\"ext_price\":\"2000\",\"qty_pro\":309330,\"handle_qty\":309380,\"fill_cost\":0,\"act\":1,\"total\":618660000}', '{\"ext_price\":\"200\",\"qty_pro\":309330,\"handle_qty\":309380,\"finish_cost\":0,\"act\":1,\"total\":61866000}', '{\"type\":null,\"qty\":null,\"qttv_price\":0,\"magnet_perc\":1.05,\"qty_pro\":309330,\"act\":0,\"total\":0}', NULL, NULL, 680526000, '2023-10-31 09:45:39', '2023-10-31 09:45:39', 88, 1, 1);
INSERT INTO `fill_finishes` VALUES (58, NULL, '309330', '{\"stage\":[{\"length\":null,\"width\":null,\"machine\":null,\"qttv_price\":0,\"cost\":0}],\"ext_price\":\"2000\",\"qty_pro\":309330,\"handle_qty\":309380,\"fill_cost\":0,\"act\":1,\"total\":618660000}', '{\"ext_price\":\"200\",\"qty_pro\":309330,\"handle_qty\":309380,\"finish_cost\":0,\"act\":1,\"total\":61866000}', '{\"type\":null,\"qty\":null,\"qttv_price\":0,\"magnet_perc\":1.05,\"qty_pro\":309330,\"act\":0,\"total\":0}', NULL, NULL, 680526000, '2023-10-31 09:51:09', '2023-10-31 09:51:09', 89, 1, 1);
INSERT INTO `fill_finishes` VALUES (59, NULL, '3000', '{\"stage\":[{\"length\":null,\"width\":null,\"machine\":null,\"qttv_price\":0,\"cost\":0}],\"ext_price\":\"8000\",\"qty_pro\":3000,\"handle_qty\":3050,\"fill_cost\":0,\"act\":1,\"total\":24000000}', '{\"ext_price\":\"2000\",\"qty_pro\":3000,\"handle_qty\":3050,\"finish_cost\":0,\"act\":1,\"total\":6000000}', '{\"type\":\"32\",\"qty\":\"2\",\"qttv_price\":\"1200\",\"magnet_perc\":1.05,\"qty_pro\":3000,\"act\":1,\"total\":7560000}', NULL, NULL, 37560000, '2023-11-01 16:22:02', '2023-11-01 16:22:02', 90, 1, 1);
INSERT INTO `fill_finishes` VALUES (60, NULL, '3000', '{\"stage\":[{\"length\":null,\"width\":null,\"machine\":null,\"qttv_price\":0,\"cost\":0}],\"ext_price\":\"8000\",\"qty_pro\":3000,\"handle_qty\":3050,\"fill_cost\":0,\"act\":1,\"total\":24000000}', '{\"ext_price\":\"2000\",\"qty_pro\":3000,\"handle_qty\":3050,\"finish_cost\":0,\"act\":1,\"total\":6000000}', '{\"type\":\"32\",\"qty\":\"2\",\"qttv_price\":\"1200\",\"magnet_perc\":1.05,\"qty_pro\":3000,\"act\":1,\"total\":7560000}', NULL, NULL, 37560000, '2023-11-01 16:38:57', '2023-11-01 16:38:57', 91, 1, 1);
INSERT INTO `fill_finishes` VALUES (61, NULL, '3000', '{\"stage\":[{\"length\":null,\"width\":null,\"machine\":null,\"qttv_price\":0,\"cost\":0}],\"ext_price\":\"8000\",\"qty_pro\":3000,\"handle_qty\":3050,\"fill_cost\":0,\"act\":1,\"total\":24000000}', '{\"ext_price\":\"2000\",\"qty_pro\":3000,\"handle_qty\":3050,\"finish_cost\":0,\"act\":1,\"total\":6000000}', '{\"type\":\"32\",\"qty\":\"2\",\"qttv_price\":\"1200\",\"magnet_perc\":1.05,\"qty_pro\":3000,\"act\":1,\"total\":7560000}', NULL, NULL, 37560000, '2023-11-01 16:44:08', '2023-11-01 16:44:08', 92, 1, 1);

-- ----------------------------
-- Table structure for materals
-- ----------------------------
DROP TABLE IF EXISTS `materals`;
CREATE TABLE `materals`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã nhóm',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Tên nhóm',
  `price` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Cha',
  `default` tinyint(4) NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Ghi chú',
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NOT NULL,
  `ord` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of materals
-- ----------------------------
INSERT INTO `materals` VALUES (1, 'Màng bạc', '0.36', 'metalai', 1, '0.36 = 3600đ/m2', 1, '2023-07-17 20:26:21', '2023-11-01 16:10:10', 0, NULL);
INSERT INTO `materals` VALUES (2, 'Màng vàng', '0.4', 'metalai', 1, '0.38 = 3800đ/m2', 1, '2023-07-17 20:26:21', '2023-09-14 19:54:46', 0, NULL);
INSERT INTO `materals` VALUES (3, 'IN MỰC PHỦ MỜ', '0.08', 'cover', 1, '0.08 = 800đ/m2', 1, '2023-07-17 20:26:21', '2023-09-16 01:59:46', 0, NULL);
INSERT INTO `materals` VALUES (8, 'Cán bóng', '0.23', 'nilon', 0, '0.23 = 2300đ/m2', 1, '2023-07-17 20:26:21', '2023-08-04 13:22:31', 0, NULL);
INSERT INTO `materals` VALUES (9, 'Cán mờ', '0.25', 'nilon', 0, '0.25 = 2500đ/m2', 1, '2023-07-17 20:26:21', '2023-08-04 13:22:31', 0, NULL);
INSERT INTO `materals` VALUES (10, 'Mực bóng', '0', 'uv', 1, 'CT này không áp dụng tính khách hàng, chỉ áp dụng đo lường vật tư', 1, '2023-07-17 20:26:21', '2023-09-19 01:12:09', 0, NULL);
INSERT INTO `materals` VALUES (11, 'Mực sần cát', '0', 'uv', 1, 'CT này không áp dụng tính khách hàng, chỉ áp dụng đo lường vật tư', 1, '2023-07-17 20:26:21', '2023-09-19 01:12:04', 0, NULL);
INSERT INTO `materals` VALUES (12, 'GIẤY COUCHES', '0.002', 'paper', 0, '0.0020 = 20triệu/ tấn', 1, '2023-07-17 20:26:21', '2023-10-04 06:40:42', 0, NULL);
INSERT INTO `materals` VALUES (13, 'GIẤY IVOLRY', '0.00195', 'paper', 0, '0.00185 = 18.5 triệu/ tấn', 1, '2023-07-17 20:26:21', '2023-10-04 06:40:35', 0, NULL);
INSERT INTO `materals` VALUES (14, 'GIẤY DUPLEX', '0.0015', 'paper', 0, '0.00150 = 15 triệu/ tấn', 1, '2023-07-17 20:26:21', '2023-08-08 14:47:51', 0, NULL);
INSERT INTO `materals` VALUES (15, 'GIẤY OFFSET', '0.0028', 'paper', 0, '0.0024 = 24 triệu/ tấn', 1, '2023-07-17 20:26:21', '2023-08-08 14:55:23', 0, NULL);
INSERT INTO `materals` VALUES (16, 'CHI PHÍ BỒI NẮP', '0.6', 'fill', 0, '0.6 = 6000đ/m2 keo bồi ( CT dành cho tính chi phí keo bồi )', 1, '2023-08-14 17:23:12', '2023-09-30 20:11:27', 0, NULL);
INSERT INTO `materals` VALUES (17, 'Nam châm nhỏ', '500', 'magnet', 0, '0', 1, '2023-08-14 12:39:31', '2023-09-16 02:53:39', 1, NULL);
INSERT INTO `materals` VALUES (18, 'CHI PHÍ BỒI ĐÁY', '0.6', 'fill', 0, '0.6 = 6000đ/m2 keo bồi ( CT dành cho tính chi phí keo bồi )', 1, '2023-08-14 17:23:49', '2023-09-30 20:11:01', 0, NULL);
INSERT INTO `materals` VALUES (19, 'CHI PHÍ BỒI THÀNH', '0.6', 'fill', 0, '0.6 = 6000đ/m2 keo bồi ( CT dành cho tính chi phí keo bồi )', 1, '2023-07-20 10:21:00', '2023-09-30 20:11:12', 1, NULL);
INSERT INTO `materals` VALUES (20, 'CHI PHÍ BỒI BÌA', '0.6', 'fill', 0, '0.6 = 6000đ/m2 keo bồi ( CT dành cho tính chi phí keo bồi )', 1, '2023-07-20 10:21:00', '2023-09-30 20:10:50', 1, NULL);
INSERT INTO `materals` VALUES (21, 'CHI PHÍ BỒI MẶT THÉP', '0.6', 'fill', 0, '0.6 = 6000đ/m2 keo bồi ( CT dành cho tính chi phí keo bồi )', 1, '2023-07-20 10:21:00', '2023-09-30 20:10:39', 1, NULL);
INSERT INTO `materals` VALUES (23, 'CHI PHÍ KHAY ĐỊNH HÌNH', '0.6', 'fill', 0, '0.3 = 3000đ/m2 keo bồi ( CT dành cho tính chi phí keo bồi )', 1, '2023-07-20 10:21:00', '2023-09-30 20:10:09', 1, NULL);
INSERT INTO `materals` VALUES (24, 'CHI PHÍ BỒI MẶT PHẲNG', '0.6', 'fill', 0, '0.3 = 3000đ/m2 keo bồi ( CT dành cho tính chi phí keo bồi )', 1, '2023-07-20 10:21:00', '2023-09-30 20:10:03', 1, NULL);
INSERT INTO `materals` VALUES (25, 'ĐỀ CAN NHUNG - LÔNG NGẮN', '2.6', 'decal', NULL, 'Đề can nhung lông ngắn 23.000đ/m2\r\nTính công xả + bồi là 3000đ/m2\r\nTổng = 26.000đ/m2\r\nQuy đổi 2.6', 1, '2023-08-14 17:50:37', '2023-09-16 01:32:19', 1, NULL);
INSERT INTO `materals` VALUES (26, 'VẢI LỤA THƯỜNG', '6', 'silk', 0, '1.5m = 8000đ/đ\r\n1m = 6000đ cả công cắt lụa', 1, '2023-08-14 17:51:05', '2023-09-16 01:57:28', 1, NULL);
INSERT INTO `materals` VALUES (27, 'CHI PHÍ BỒI PHỤ KIỆN', '0.6', 'fill', NULL, '0.3 = 3000đ/m2 keo bồi ( CT dành cho tính chi phí keo bồi )', 1, '2023-09-15 05:11:08', '2023-09-30 20:09:55', 1, NULL);
INSERT INTO `materals` VALUES (28, 'ĐỀ CAN NHUNG - LÔNG DÀI', '3.3', 'decal', NULL, 'Đề can nhung lông dài 30.000đ/m2\r\nTính công xả + bồi là 3000đ/m2\r\nTổng = 33.000đ/m2\r\nQuy đổi 3.3', 1, '2023-09-16 01:33:50', '2023-09-16 01:33:50', 1, NULL);
INSERT INTO `materals` VALUES (29, 'IN MỰC PHỦ BÓNG', '0.08', 'cover', 1, '0.08 = 800đ/m2', 1, '2023-09-16 01:59:37', '2023-09-16 01:59:37', 1, NULL);
INSERT INTO `materals` VALUES (30, 'PHỦ BÓNG GỐC DẦU - CTY NHẬT SƠN', '1.5', 'cover', 1, '1.5 = 1500đ/m2', 1, '2023-09-16 02:00:33', '2023-09-16 02:00:33', 1, NULL);
INSERT INTO `materals` VALUES (31, 'Nam châm nhỡ', '800', 'magnet', 0, '0', 1, '2023-09-16 02:54:18', '2023-09-16 02:54:18', 1, NULL);
INSERT INTO `materals` VALUES (32, 'Nam châm to', '1200', 'magnet', 0, '0', 1, '2023-09-16 02:54:37', '2023-09-16 02:54:37', 1, NULL);
INSERT INTO `materals` VALUES (33, 'GIẤY MỸ THUẬT ĐEN', '0.005', 'paper', 0, '0.005 = 50 triệu/ tấn', 1, '2023-09-19 01:14:55', '2023-09-19 01:27:48', 1, NULL);
INSERT INTO `materals` VALUES (34, 'ĐỀ CAN GIẤY', '0.0033', 'paper', 0, '0.0032 = 32 triệu/ tấn', 1, '2023-09-26 18:05:21', '2023-10-04 06:40:53', 1, NULL);

-- ----------------------------
-- Table structure for n_detail_tables
-- ----------------------------
DROP TABLE IF EXISTS `n_detail_tables`;
CREATE TABLE `n_detail_tables`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `attr` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `note` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `table_map` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `view` tinyint(4) NULL DEFAULT NULL,
  `insert` tinyint(4) NULL DEFAULT NULL,
  `update` tinyint(4) NULL DEFAULT NULL,
  `search` tinyint(4) NULL DEFAULT NULL,
  `parent` int(10) NULL DEFAULT NULL,
  `other_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `region` int(10) NULL DEFAULT NULL,
  `ord` int(10) NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `map_view`(`table_map`, `view`) USING BTREE,
  INDEX `map_insert`(`table_map`, `insert`) USING BTREE,
  INDEX `map_update`(`table_map`, `update`) USING BTREE,
  INDEX `map_search`(`table_map`, `search`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 264 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of n_detail_tables
-- ----------------------------
INSERT INTO `n_detail_tables` VALUES (1, 'code', '{\"disable_field\":1,\"required\":1}', 'Mã KH', 'text', 'customers', 1, 0, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-04-07 23:41:47');
INSERT INTO `n_detail_tables` VALUES (2, 'name', '{\"required\":1}', 'Tên KH/Cty', 'text', 'customers', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-04-07 23:41:47');
INSERT INTO `n_detail_tables` VALUES (3, 'contacter', '{\"required\":1}', 'Người liên hệ', 'text', 'customers', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-04-07 23:41:47');
INSERT INTO `n_detail_tables` VALUES (4, 'phone', '{\"required\":1}', 'SĐT di động', 'text', 'customers', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-04-07 23:41:47');
INSERT INTO `n_detail_tables` VALUES (5, 'telephone', '', 'SĐT cố định', 'text', 'customers', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-04-07 23:41:47');
INSERT INTO `n_detail_tables` VALUES (6, 'email', '{\"required\":1}', 'Email', 'text', 'customers', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-04-07 23:41:47');
INSERT INTO `n_detail_tables` VALUES (7, 'address', '{\"required\":1}', 'Địa chỉ', 'text', 'customers', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-04-07 23:41:47');
INSERT INTO `n_detail_tables` VALUES (8, 'city', '{\"required\":1}', 'Tỉnh/TP', 'linking', 'customers', 1, 1, 1, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"citys\",\r\n		\"where\":{\"parent\":0}\r\n	}\r\n}', 1, 0, 1, '2023-04-07 23:41:47', '2023-04-07 23:41:47');
INSERT INTO `n_detail_tables` VALUES (9, 'tax_code', '', 'Mã số thuế', 'text', 'customers', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-07 23:45:08', '2023-04-07 23:45:08');
INSERT INTO `n_detail_tables` VALUES (10, 'status', '{\"required\":1}', 'Trạng thái', 'select', 'customers', 1, 1, 1, 1, 0, '{\"data\":{\n		\"options\":{\"\":\"Loại KH\", \"1\":\"KH cũ\", \"2\":\"KH mới\"}\n	}\n}', 1, 0, 1, '2023-05-11 11:18:58', '2023-10-20 18:31:37');
INSERT INTO `n_detail_tables` VALUES (11, 'note', '', 'Ghi chú', 'textarea', 'customers', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-08 00:05:12', '2023-04-08 00:05:12');
INSERT INTO `n_detail_tables` VALUES (12, 'act', '', 'Kích hoạt', 'checkbox', 'customers', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-08 00:05:47', '2023-04-08 00:05:47');
INSERT INTO `n_detail_tables` VALUES (13, 'created_by', NULL, 'Phụ trách', 'linking', 'customers', 1, 1, 1, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', 1, 0, 1, '2023-04-08 00:08:00', '2023-04-08 00:08:00');
INSERT INTO `n_detail_tables` VALUES (14, 'created_at', NULL, 'Ngày tạo', 'datetime', 'customers', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-08 00:08:00', '2023-04-08 00:08:00');
INSERT INTO `n_detail_tables` VALUES (15, 'updated_at', NULL, 'Ngày sửa', 'datetime', 'customers', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-08 00:12:15', '2023-04-08 00:12:15');
INSERT INTO `n_detail_tables` VALUES (16, 'name', '{\"required\":1}', 'Tên thiết bị', 'text', 'devices', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-08 00:51:39', '2023-04-08 00:51:39');
INSERT INTO `n_detail_tables` VALUES (17, 'model_price', '{\"required\":1}', 'Chi phí khuôn', 'text', 'devices', 1, 1, 1, 0, 0, '', 1, 1, 1, '2023-04-08 01:02:39', '2023-07-27 23:50:56');
INSERT INTO `n_detail_tables` VALUES (18, '', '', 'ĐG chỉnh máy', 'group', 'devices', 1, 0, 0, 0, 0, '', 0, 0, 1, '2023-04-08 00:51:39', '2023-04-08 00:51:39');
INSERT INTO `n_detail_tables` VALUES (19, '', '', 'ĐG lượt', 'group', 'devices', 1, 0, 0, 0, 0, '', 0, 0, 1, '2023-04-08 00:51:39', '2023-04-08 00:51:39');
INSERT INTO `n_detail_tables` VALUES (20, 'shape_price', '{\"required\":1}', 'Khách', 'text', 'devices', 1, 1, 1, 0, 18, '', 12, 0, 1, '2023-04-27 04:39:05', '2023-07-26 09:34:14');
INSERT INTO `n_detail_tables` VALUES (21, 'w_shape_price', '{\"required\":1}', 'Thợ', 'text', 'devices', 1, 1, 1, 0, 18, '', 12, 0, 1, '2023-04-27 04:39:20', '2023-07-26 09:34:12');
INSERT INTO `n_detail_tables` VALUES (22, 'work_price', '{\"required\":1}', 'Khách', 'text', 'devices', 1, 1, 1, 0, 19, '', 13, 0, 1, '2023-04-27 04:39:22', '2023-07-26 09:34:12');
INSERT INTO `n_detail_tables` VALUES (23, 'w_work_price', '{\"required\":1}', 'Thợ', 'text', 'devices', 1, 1, 1, 0, 19, '', 13, 0, 1, '2023-04-27 04:39:26', '2023-07-26 09:34:11');
INSERT INTO `n_detail_tables` VALUES (24, 'act', '', 'Kích hoạt', 'checkbox', 'devices', 1, 1, 1, 0, 0, '', 1, 3, 1, '2023-04-30 10:39:49', '2023-07-27 23:50:20');
INSERT INTO `n_detail_tables` VALUES (25, 'created_at', '', 'Ngày tạo', 'datetime', 'devices', 1, 1, 1, 1, 0, '', 1, 3, 1, '2023-04-30 10:39:49', '2023-07-27 23:50:18');
INSERT INTO `n_detail_tables` VALUES (26, 'updated_at', '', 'Ngày sửa', 'datetime', 'devices', 0, 1, 1, 0, 0, '', 1, 3, 1, '2023-04-30 10:45:00', '2023-07-27 23:51:00');
INSERT INTO `n_detail_tables` VALUES (27, 'seri', '{\"disable_field\":1,\"required\":1}', 'Mã BG', 'text', 'quotes', 1, 0, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-04-07 23:41:47');
INSERT INTO `n_detail_tables` VALUES (28, 'customer_id', NULL, 'Khách hàng', 'linking', 'quotes', 1, 1, 1, 1, 0, '{\n	\"config\":{\n		\"search\":1,\n		\"except_linking\":1\n	},\n	\"data\":{\n		\"table\":\"customers\"\n	}\n}', 1, 0, 1, '2023-04-23 18:20:42', '2023-10-07 11:08:58');
INSERT INTO `n_detail_tables` VALUES (29, 'city', '{\"required\":1}', 'Tỉnh/TP', 'linking', 'quotes', 1, 1, 1, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"citys\",\r\n		\"where\":{\"parent\":0}\r\n	}\r\n}', 1, 1, 1, '2023-04-30 11:00:08', '2023-04-30 11:00:08');
INSERT INTO `n_detail_tables` VALUES (30, 'profit', '{\"required\":1, \"type_input\":\"price\"}', 'Lợi nhuận', 'text', 'quotes', 1, 1, 1, 0, 0, '', 1, 3, 1, '2023-04-30 11:00:22', '2023-08-16 17:01:46');
INSERT INTO `n_detail_tables` VALUES (31, 'ship_price', '{\"required\":1, \"type_input\":\"price\"}', 'Phí Ship', 'text', 'quotes', 1, 1, 1, 0, 0, '', 1, 2, 1, '2023-04-30 11:00:13', '2023-08-16 17:01:32');
INSERT INTO `n_detail_tables` VALUES (32, 'total_amount', '{\"required\":1, \"type_input\":\"price\"}', 'Giá trị BG', 'text', 'quotes', 1, 1, 1, 0, 0, '', 1, 4, 1, '2023-04-30 11:00:33', '2023-08-16 17:01:39');
INSERT INTO `n_detail_tables` VALUES (33, 'status', '{\"required\":1}', 'Trạng thái', 'select', 'quotes', 1, 1, 1, 1, 0, '{\"data\":{\r\n		\"options\":{\"\":\"Trạng thái\", \"not_accepted\":\"Chưa duyệt\", \"accepted\":\"Đã duyệt\", \"order_created\":\"Đã tạo đơn\"}\r\n	}\r\n}', 1, 5, 1, '2023-05-11 11:19:48', '2023-09-26 16:58:12');
INSERT INTO `n_detail_tables` VALUES (34, 'created_by', NULL, 'Phụ trách', 'linking', 'quotes', 1, 1, 1, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', 1, 0, 1, '2023-04-08 00:08:00', '2023-04-08 00:08:00');
INSERT INTO `n_detail_tables` VALUES (35, 'created_at', NULL, 'Ngày tạo', 'datetime', 'quotes', 1, 1, 1, 1, 0, '', 1, 6, 1, '2023-04-30 11:00:43', '2023-04-30 11:00:43');
INSERT INTO `n_detail_tables` VALUES (36, 'updated_at', NULL, 'Ngày sửa', 'datetime', 'quotes', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-08 00:12:15', '2023-04-08 00:12:15');
INSERT INTO `n_detail_tables` VALUES (46, 'name', '{\"required\":1}', 'Tên vật tư', 'text', 'materals', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-28 11:32:02', '2023-04-28 11:32:02');
INSERT INTO `n_detail_tables` VALUES (47, 'price', '{\"required\":1,\"type_input\":\"number\"}', 'Đơn giá', 'text', 'materals', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:32:02', '2023-04-28 11:32:02');
INSERT INTO `n_detail_tables` VALUES (48, 'default', '', 'Lựa chọn mặc định', 'checkbox', 'materals', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:32:02', '2023-04-28 11:32:02');
INSERT INTO `n_detail_tables` VALUES (49, 'act', '', 'Kích hoạt', 'checkbox', 'materals', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:32:02', '2023-04-28 11:32:02');
INSERT INTO `n_detail_tables` VALUES (50, 'note', '', 'Ghi chú', 'textarea', 'materals', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:32:40', '2023-04-28 11:32:40');
INSERT INTO `n_detail_tables` VALUES (51, 'created_at', '', 'Ngày tạo', 'datetime', 'materals', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-28 00:28:28', '2023-04-28 00:28:28');
INSERT INTO `n_detail_tables` VALUES (52, 'updated_at', '', 'Ngày sửa', 'datetime', 'materals', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 00:28:28', '2023-04-28 00:28:28');
INSERT INTO `n_detail_tables` VALUES (53, 'name', '{\"required\":1}', 'Tên vật tư', 'text', 'supply_prices', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-28 11:38:57', '2023-04-28 11:38:57');
INSERT INTO `n_detail_tables` VALUES (54, 'price', '{\"required\":1,\"type_input\":\"number\"}', 'Đơn giá', 'text', 'supply_prices', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:38:57', '2023-04-28 11:38:57');
INSERT INTO `n_detail_tables` VALUES (55, 'act', '', 'Kích hoạt', 'checkbox', 'supply_prices', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:38:57', '2023-04-28 11:38:57');
INSERT INTO `n_detail_tables` VALUES (56, 'note', '', 'Ghi chú', 'textarea', 'supply_prices', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:38:57', '2023-04-28 11:38:57');
INSERT INTO `n_detail_tables` VALUES (57, 'created_at', '', 'Ngày tạo', 'datetime', 'supply_prices', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-28 11:38:57', '2023-04-28 11:38:57');
INSERT INTO `n_detail_tables` VALUES (58, 'updated_at', '', 'Ngày sửa', 'datetime', 'supply_prices', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:38:57', '2023-04-28 11:38:57');
INSERT INTO `n_detail_tables` VALUES (59, 'name', '{\"required\":1}', 'Tên vật tư', 'text', 'supply_types', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-04-28 11:43:12');
INSERT INTO `n_detail_tables` VALUES (60, 'act', '', 'Kích hoạt', 'checkbox', 'supply_types', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-04-28 11:43:12');
INSERT INTO `n_detail_tables` VALUES (61, 'note', '', 'Ghi chú', 'textarea', 'supply_types', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-04-28 11:43:12');
INSERT INTO `n_detail_tables` VALUES (62, 'created_at', '', 'Ngày tạo', 'datetime', 'supply_types', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-04-28 11:43:12');
INSERT INTO `n_detail_tables` VALUES (63, 'updated_at', '', 'Ngày sửa', 'datetime', 'supply_types', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-04-28 11:43:12');
INSERT INTO `n_detail_tables` VALUES (64, 'note', '', 'Ghi chú', 'textarea', 'devices', 0, 1, 1, 0, 0, '', 1, 2, 1, '2023-04-08 00:05:12', '2023-07-27 23:50:29');
INSERT INTO `n_detail_tables` VALUES (66, 'product', NULL, 'Tên sản phẩm', 'child_linking', 'quotes', 1, 0, 0, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"products\",\r\n		\"field_query\":\"quote_id\"\r\n	}\r\n}', 1, 0, 1, '2023-04-30 11:17:52', '2023-04-30 11:17:52');
INSERT INTO `n_detail_tables` VALUES (67, 'name', '{\"required\":1}', 'Tên nhân viên', 'text', 'n_users', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-05-23 14:40:33', '2023-05-23 14:40:33');
INSERT INTO `n_detail_tables` VALUES (68, 'email', '{\"required\":1}', 'Email', 'text', 'n_users', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-05-23 14:28:34', '2023-05-23 14:28:34');
INSERT INTO `n_detail_tables` VALUES (69, 'phone', '{\"required\":1}', 'SĐT', 'text', 'n_users', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-05-23 14:38:05', '2023-05-23 14:38:05');
INSERT INTO `n_detail_tables` VALUES (70, 'created_at', '', 'Ngày tạo', 'datetime', 'n_users', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-05-23 14:38:05', '2023-05-23 14:38:05');
INSERT INTO `n_detail_tables` VALUES (71, 'created_by', '', 'Người tạo', 'linking', 'n_users', 1, 0, 0, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', 0, 0, 1, '2023-05-23 14:38:05', '2023-05-23 14:38:05');
INSERT INTO `n_detail_tables` VALUES (72, 'act', '', 'Kích hoạt', 'checkbox', 'n_users', 1, 1, 1, 0, 0, '', 4, 1, 1, '2023-05-23 14:42:33', '2023-05-23 14:42:33');
INSERT INTO `n_detail_tables` VALUES (73, 'note', '', 'Ghi chú', 'textarea', 'n_users', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-05-23 14:38:05', '2023-05-23 14:38:05');
INSERT INTO `n_detail_tables` VALUES (74, 'username', '{\"required\":1,\"unique\":1}', 'Username', 'text', 'n_users', 0, 1, 1, 0, 0, '', 4, 0, 1, '2023-05-23 15:22:01', '2023-05-23 15:22:01');
INSERT INTO `n_detail_tables` VALUES (75, 'password', '{\"required\":1,\"type_input\":\"password\"}', 'Password', 'text', 'n_users', 0, 1, 1, 0, 0, '', 4, 0, 1, '2023-05-23 14:41:41', '2023-09-23 16:35:53');
INSERT INTO `n_detail_tables` VALUES (76, 'group_user', '', 'Vai trò', 'linking', 'n_users', 1, 1, 1, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_group_users\"\r\n	}\r\n}', 4, 0, 1, '2023-05-23 14:41:40', '2023-05-23 14:41:40');
INSERT INTO `n_detail_tables` VALUES (77, 'code', '{\"disable_field\":1,\"required\":1}', 'Mã đơn', 'text', 'orders', 1, 0, 1, 1, 0, '', 1, 0, 1, '2023-05-26 03:19:12', '2023-05-26 03:19:12');
INSERT INTO `n_detail_tables` VALUES (78, 'list_product', '', 'Sản phẩm', 'child_linking', 'orders', 1, 0, 1, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"products\",\r\n		\"field_query\":\"order\"\r\n	}\r\n}', 1, 0, 1, '2023-05-26 03:19:12', '2023-08-22 03:16:35');
INSERT INTO `n_detail_tables` VALUES (79, 'status', '', 'Trạng thái', 'select', 'orders', 1, 0, 1, 0, 0, '{\"data\":{\r\n		\"options\":{\r\n			\"not_accepted\":\"Chưa duyệt\", \r\n			\"accepted\":\"Đã duyệt thiết kế\", \r\n			\"to_design\":\"Chờ thiết kế nhận lệnh\",\r\n			\"designing\":\"Đang thiết kế\",\r\n			\"design_submited\":\"Đã xong thiết kế\",\r\n			\"tech_submited\":\"Kế hoạch đang xử lí\",\r\n			\"making_process\":\"Đang gia công\"\r\n		}\r\n	}\r\n}', 1, 0, 1, '2023-05-26 03:19:12', '2023-08-01 03:49:32');
INSERT INTO `n_detail_tables` VALUES (80, 'advance', '{\"type_input\":\"price\"}', 'Tạm ứng', 'text', 'orders', 1, 0, 1, 0, 0, '', 1, 0, 1, '2023-05-26 03:19:12', '2023-08-20 11:40:04');
INSERT INTO `n_detail_tables` VALUES (81, 'rest', '{\"type_input\":\"price\"}', 'Còn lại', 'text', 'orders', 1, 0, 1, 0, 0, '', 1, 0, 1, '2023-05-26 03:19:12', '2023-08-20 11:40:03');
INSERT INTO `n_detail_tables` VALUES (82, 'created_at', '', 'Ngày tạo', 'datetime', 'orders', 1, 0, 1, 1, 0, '', 1, 0, 1, '2023-05-26 03:19:12', '2023-05-26 03:19:12');
INSERT INTO `n_detail_tables` VALUES (83, 'created_by', '', 'Kinh doanh', 'linking', 'orders', 1, 0, 1, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', 1, 0, 1, '2023-05-26 03:19:12', '2023-05-26 03:19:12');
INSERT INTO `n_detail_tables` VALUES (84, 'code', '{\"disable_field\":1}', 'Mã lệnh', 'text', 'c_designs', 1, 0, 1, 1, 0, '', 1, 0, 1, '2023-06-15 06:55:51', '2023-06-15 06:55:51');
INSERT INTO `n_detail_tables` VALUES (85, 'order', '', 'Đơn hàng', 'linking', 'c_designs', 1, 0, 1, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"orders\",\r\n		\"field_title\":\"code\"\r\n	}\r\n}', 1, 0, 1, '2023-06-15 07:02:19', '2023-06-15 07:02:19');
INSERT INTO `n_detail_tables` VALUES (86, 'product', '', 'Sản phẩm', 'linking', 'c_designs', 1, 0, 1, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"products\"\r\n	}\r\n}', 1, 0, 1, '2023-06-15 06:55:51', '2023-06-15 06:55:51');
INSERT INTO `n_detail_tables` VALUES (87, 'status', '', 'Trạng thái', 'select', 'c_designs', 1, 0, 1, 0, 0, '{\"data\":{\r\n		\"options\":{\"not_accepted\":\"Chưa duyệt\", \"designing\":\"Đang thiết kế\", \"design_submited\":\"Đã hoàn thành\"}\r\n	}\r\n}', 1, 0, 1, '2023-06-15 06:55:51', '2023-08-25 22:35:17');
INSERT INTO `n_detail_tables` VALUES (88, 'created_at', '', 'Ngày tạo', 'datetime', 'c_designs', 1, 0, 1, 1, 0, '', 1, 0, 1, '2023-06-15 06:55:51', '2023-06-15 06:55:51');
INSERT INTO `n_detail_tables` VALUES (89, 'created_by', '', 'Tạo bởi', 'linking', 'c_designs', 1, 0, 1, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', 1, 0, 1, '2023-06-15 06:55:51', '2023-06-15 06:55:51');
INSERT INTO `n_detail_tables` VALUES (90, 'assign_by', '', 'Nhận bởi', 'linking', 'c_designs', 1, 0, 1, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', 1, 0, 1, '2023-06-15 10:42:46', '2023-06-15 10:42:46');
INSERT INTO `n_detail_tables` VALUES (91, 'code', '{\"disable_field\":1,\"required\":1}', 'Mã Lệnh', 'text', 'c_supplies', 1, 0, 1, 1, 0, '', 1, 0, 1, '2023-07-14 02:55:30', '2023-08-17 02:17:59');
INSERT INTO `n_detail_tables` VALUES (92, 'size_type', '{\"required\":1,\"disable_field\":1,\"inject_class\":\"__wh_select_size\"}', 'Loại vật tư', 'linking', 'c_supplies', 1, 0, 0, 0, 148, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":{\r\n			\"getFunc\":\"getTableWarehouseByType\"\r\n		}\r\n	}\r\n}', 1, 1, 1, '2023-07-14 02:55:31', '2023-09-26 20:18:58');
INSERT INTO `n_detail_tables` VALUES (93, 'qty', '{\"required\":1, \"type_input\":\"number\"}', 'SL cần xuất cả bù hao', 'text', 'c_supplies', 1, 1, 1, 0, 0, '', 1, 1, 1, '2023-07-14 02:55:32', '2023-09-26 18:21:52');
INSERT INTO `n_detail_tables` VALUES (94, 'order', '', 'Xuất cho đơn', 'linking', 'c_supplies', 1, 1, 1, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"orders\"\r\n	}\r\n}', 1, 1, 0, '2023-07-14 02:56:31', '2023-08-30 02:20:09');
INSERT INTO `n_detail_tables` VALUES (95, 'product', '', 'Sản phẩm', 'linking', 'c_supplies', 1, 1, 1, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"products\"\r\n	}\r\n}', 1, 0, 1, '2023-07-14 03:16:25', '2023-09-26 20:03:43');
INSERT INTO `n_detail_tables` VALUES (96, 'status', '', 'Trạng thái', 'select', 'c_supplies', 1, 0, 1, 0, 0, '{\r\n		\"data\":{\r\n				\"options\":{\"\":\"Chưa gửi yêu cầu xuất\", \"handling\":\"Đang chờ xuất kho\", \"handled\":\"Đã xuất kho\"}\r\n		}\r\n}', 1, 1, 1, '2023-07-14 02:50:55', '2023-08-17 02:08:07');
INSERT INTO `n_detail_tables` VALUES (97, 'created_by', '', 'Người tạo', 'linking', 'c_supplies', 1, 0, 0, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', 1, 1, 1, '2023-07-14 03:11:41', '2023-08-17 02:08:07');
INSERT INTO `n_detail_tables` VALUES (98, 'assign_by', '', 'Phụ trách', 'linking', 'c_supplies', 1, 0, 0, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', 1, 1, 1, '2023-07-14 03:11:21', '2023-08-29 23:57:47');
INSERT INTO `n_detail_tables` VALUES (99, 'created_at', '', 'Ngày tạo', 'datetime', 'c_supplies', 1, 0, 1, 1, 0, '', 1, 1, 1, '2023-07-14 02:56:03', '2023-08-17 02:08:07');
INSERT INTO `n_detail_tables` VALUES (100, 'table_map', '', 'Bảng dữ liệu', 'linking', 'n_log_actions', 0, 0, 0, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_tables\",\r\n		\"field_title\":\"note\"\r\n	}\r\n}', NULL, 0, 0, '2023-05-26 03:19:12', '2023-07-18 17:16:23');
INSERT INTO `n_detail_tables` VALUES (101, 'action', '', 'Hoạt động', 'select', 'n_log_actions', 0, 0, 1, 1, 0, '{\"data\":{\r\n		\"options\":{\r\n				\"\":\"Chọn hành động\", \r\n				\"insert\":\"Thêm mới\", \r\n				\"update\":\"Cập nhật\", \r\n				\"remove\":\"Xóa\"\r\n			}\r\n	}\r\n}', NULL, 0, 1, '2023-05-26 03:19:12', '2023-07-18 17:54:45');
INSERT INTO `n_detail_tables` VALUES (102, 'user', '', 'Nhân viên', 'linking', 'n_log_actions', 0, 0, 0, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', NULL, 0, 1, '2023-05-26 03:19:12', '2023-07-18 17:33:50');
INSERT INTO `n_detail_tables` VALUES (103, 'created_at', '', 'Thời gian', 'datetime', 'n_log_actions', 0, 0, 0, 1, 0, '', NULL, 0, 1, '2023-06-15 06:55:51', '2023-07-18 17:54:42');
INSERT INTO `n_detail_tables` VALUES (104, 'ord', '{\"type_input\":\"number\"}', 'Sắp xếp', 'text', 'supply_types', 1, 1, 1, 0, 0, '', 1, 3, 1, '2023-04-30 11:00:22', '2023-07-20 10:43:13');
INSERT INTO `n_detail_tables` VALUES (105, 'ord', '{\"type_input\":\"number\"}', 'Sắp xếp', 'text', 'supply_prices', 1, 1, 1, 0, 0, '', 1, 3, 1, '2023-04-30 11:00:22', '2023-07-20 10:43:15');
INSERT INTO `n_detail_tables` VALUES (106, 'ord', '', 'Sắp xếp', 'text', 'materals', 1, 1, 1, 0, 0, '', 1, 3, 1, '2023-04-30 11:00:22', '2023-08-14 17:38:25');
INSERT INTO `n_detail_tables` VALUES (108, 'ord', '{\"type_input\":\"number\"}', 'Sắp xếp', 'text', 'devices', 1, 1, 1, 0, 0, '', 1, 3, 1, '2023-04-30 11:00:22', '2023-07-20 10:43:15');
INSERT INTO `n_detail_tables` VALUES (109, 'default_device', '', 'Lựa chọn mặc định', 'checkbox', 'devices', 1, 1, 1, 0, 0, '', 1, 2, 1, '2023-04-28 11:32:02', '2023-07-27 23:50:13');
INSERT INTO `n_detail_tables` VALUES (110, 'name', '{\"required\":1}', 'Tên công nhân', 'text', 'w_users', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-05-23 14:40:33', '2023-07-25 18:44:05');
INSERT INTO `n_detail_tables` VALUES (111, 'phone', '{\"required\":1}', 'SĐT', 'text', 'w_users', 1, 1, 1, 1, 0, '', 1, 1, 1, '2023-05-23 14:38:05', '2023-10-01 14:20:53');
INSERT INTO `n_detail_tables` VALUES (112, 'created_at', '', 'Ngày tạo', 'datetime', 'w_users', 1, 1, 1, 1, 0, '', 1, 4, 1, '2023-05-23 14:38:05', '2023-10-01 14:21:34');
INSERT INTO `n_detail_tables` VALUES (113, 'created_by', '', 'Người tạo', 'linking', 'w_users', 1, 0, 0, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', 0, 3, 1, '2023-05-23 14:38:05', '2023-10-01 14:21:23');
INSERT INTO `n_detail_tables` VALUES (114, 'act', '', 'Kích hoạt', 'checkbox', 'w_users', 1, 1, 1, 0, 0, '', 4, 5, 1, '2023-05-23 14:42:33', '2023-10-01 14:22:15');
INSERT INTO `n_detail_tables` VALUES (115, 'note', '', 'Ghi chú', 'textarea', 'w_users', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-05-23 14:38:05', '2023-07-25 18:44:05');
INSERT INTO `n_detail_tables` VALUES (116, 'username', '{\"required\":1,\"unique\":1}', 'Username', 'text', 'w_users', 1, 1, 1, 0, 0, '', 4, 2, 1, '2023-05-23 15:22:01', '2023-10-01 14:21:10');
INSERT INTO `n_detail_tables` VALUES (117, 'password', '{\"required\":1,\"type_input\":\"password\"}', 'Password', 'text', 'w_users', 0, 1, 1, 0, 0, '', 4, 0, 1, '2023-05-23 14:41:41', '2023-09-23 16:35:57');
INSERT INTO `n_detail_tables` VALUES (118, 'group_user', '', 'Thiết bị máy', 'group', 'w_users', 1, 1, 1, 1, 0, '{\r\n	\"group_class\":\"__module_select_ajax_value_child\",\r\n	\"inject_attr\":\"link=get-device-by-type\",\r\n	\"width\":\"8\",\r\n	\"width_child\":\"6\"\r\n}', 4, 0, 0, '2023-05-23 14:41:40', '2023-09-10 15:09:14');
INSERT INTO `n_detail_tables` VALUES (119, 'type', '{\"required\":1,\"inject_class\":\"__select_parent\"}', 'Tổ máy', 'select', 'w_users', 1, 0, 0, 0, 118, '{\r\n	\"config\":{\r\n		\"searchbox\":1\r\n	},\r\n	\"data\":{\r\n		\"options\":{\r\n			\"0\":\"Chọn tổ máy\",\r\n			\"print\":\"Tổ in\", \r\n			\"nilon\":\"Cán màng\", \r\n			\"metalai\":\"Tổ cán metalai\",\r\n			\"compress\":\"Tổ ép nhũ\",\r\n			\"float\":\"Tổ thúc nổi\",\r\n			\"uv\":\"Tổ in UV\",\r\n			\"elevate\":\"Tổ bế\",\r\n			\"peel\":\"Tổ bóc lề\",\r\n			\"mill\":\"Tổ máy phay\",\r\n			\"cut\":\"Tổ máy xén\",\r\n			\"fill\":\"Tổ máy bồi\",\r\n			\"box_paste\":\"Tổ dán hộp giấy\",\r\n			\"bag_paste\":\"Tổ dán túi giấy\",\r\n			\"finish\":\"Tổ hoàn thiện cuối\"\r\n		}\r\n	}\r\n}', 1, 0, 0, '2023-06-15 06:55:51', '2023-09-10 15:09:15');
INSERT INTO `n_detail_tables` VALUES (120, 'device', '{\"required\":1,\"disable_field\":1,\"inject_class\":\"__select_child\"}', 'Thiết bị', 'select', 'w_users', 1, 0, 0, 0, 118, '{\r\n	\"data\":{\r\n		\"options\":{\r\n			\"\":\"Chọn loại thiết bị\",\r\n			\"1\":\"In offset\",\r\n			\"2\":\"In offset uv\",\r\n			\"3\":\"In label\",\r\n			\"4\":\"In KTS\",\r\n			\"auto\":\"Thiết bị tự động\",\r\n			\"semi_auto\":\"Thiết bị bán tự động\"\r\n		}\r\n	}\r\n}', 1, 0, 0, '2023-06-15 06:55:51', '2023-09-10 15:09:18');
INSERT INTO `n_detail_tables` VALUES (121, 'name', '{\"required\":\"1\",\"unique\":\"1\"}', 'Tên vật tư', 'text', 'paper_extends', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-07-27 16:04:34');
INSERT INTO `n_detail_tables` VALUES (122, 'category', '', 'Nhóm sản phẩm', 'select', 'paper_extends', 1, 1, 1, 1, 0, '{\"data\":{\r\n		\"options\":{\r\n			\"0\":\"Chọn nhóm\", \r\n			\"2\":\"Hộp giấy\", \r\n			\"3\":\"Túi giấy\",\r\n			\"4\":\"Tem rời dán tay\",\r\n			\"5\":\"Mác giấy\",\r\n			\"6\":\"Toa - Tờ rơi - Tờ gấp\"\r\n		}\r\n	}\r\n}', 1, 0, 1, '2023-05-26 03:19:12', '2023-07-27 15:55:19');
INSERT INTO `n_detail_tables` VALUES (123, 'ord', '{\"type_input\":\"number\"}', 'Sắp xếp', 'text', 'paper_extends', 1, 1, 1, 0, 0, '', 1, 3, 1, '2023-04-30 11:00:22', '2023-07-27 15:55:19');
INSERT INTO `n_detail_tables` VALUES (124, 'act', '', 'Kích hoạt', 'checkbox', 'paper_extends', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-07-27 15:55:19');
INSERT INTO `n_detail_tables` VALUES (125, 'note', '', 'Ghi chú', 'textarea', 'paper_extends', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-07-27 15:55:19');
INSERT INTO `n_detail_tables` VALUES (126, 'created_at', '', 'Ngày tạo', 'datetime', 'paper_extends', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-07-27 15:55:19');
INSERT INTO `n_detail_tables` VALUES (127, 'updated_at', '', 'Ngày sửa', 'datetime', 'paper_extends', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-07-27 15:55:19');
INSERT INTO `n_detail_tables` VALUES (128, 'type', '{\"required\":1}', 'Loại thiết bị', 'select', 'devices', 1, 1, 1, 1, 0, '{\"data\":{\r\n		\"options\":{\"\":\"Loại Thiết bị\", \"auto\":\"Tự động\", \"semi_auto\":\"Bán tự động\"}\r\n	}\r\n}', 1, 0, 1, '2023-05-11 11:18:58', '2023-07-27 23:59:41');
INSERT INTO `n_detail_tables` VALUES (129, 'name', '{\"required\":1}', 'Tên vật tư', 'text', 'supply_warehouses', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-08-03 12:01:18');
INSERT INTO `n_detail_tables` VALUES (130, 'length', '{\"required\":1}', 'KT dài', 'text', 'supply_warehouses', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-08-03 12:01:18');
INSERT INTO `n_detail_tables` VALUES (131, 'width', '{\"required\":1}', 'KT rộng', 'text', 'supply_warehouses', 1, 1, 1, NULL, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-08-03 12:01:18');
INSERT INTO `n_detail_tables` VALUES (132, 'qty', '{\"type_input\":\"number\",\"disable_field\":1}', 'Số lượng', 'text', 'supply_warehouses', 1, 0, 1, 0, 0, '', 1, 0, 1, '2023-04-30 11:00:22', '2023-09-26 10:19:25');
INSERT INTO `n_detail_tables` VALUES (133, 'supp_type', '{\"required\":1,\"inject_class\":\"__select_parent\"}', 'Loại vật tư', 'linking', 'supply_warehouses', 1, 0, 0, 0, 135, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"supply_types\",\r\n		\"where\":{\"is_name\":0},\r\n		\"where_default\":{\"type\":\"type\"}\r\n	}\r\n}', 1, 0, 1, '2023-05-11 11:18:58', '2023-08-17 01:50:38');
INSERT INTO `n_detail_tables` VALUES (134, 'supp_price', '{\"required\":1,\"disable_field\":1,\"inject_class\":\"__select_child\"}', 'Định lượng', 'linking', 'supply_warehouses', 1, 0, 0, 0, 135, '{\r\n	\"config\":{\r\n		\"searchbox\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"supply_prices\"\r\n	}\r\n}', 1, 0, 1, '2023-05-11 11:18:58', '2023-08-17 01:50:40');
INSERT INTO `n_detail_tables` VALUES (135, 'group_supply', '', 'Dạng vật tư', 'group', 'supply_warehouses', 1, 1, 1, 1, 0, '{\r\n	\"group_class\":\"__module_select_ajax_value_child\",\r\n	\"inject_attr\":\"link=option-ajax-child/supply_prices/supply_id\",\r\n	\"width\":\"8\",\r\n	\"width_child\":\"6\"\r\n}', 1, 0, 1, '2023-05-23 14:41:40', '2023-08-07 16:38:46');
INSERT INTO `n_detail_tables` VALUES (136, 'name', '{\"required\":1}', 'Tên vật tư', 'text', 'print_warehouse', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-08-12 11:10:07');
INSERT INTO `n_detail_tables` VALUES (137, 'length', '{\"required\":1}', 'KT dài', 'text', 'print_warehouse', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-08-12 11:10:07');
INSERT INTO `n_detail_tables` VALUES (138, 'width', '{\"required\":1}', 'KT rộng', 'text', 'print_warehouse', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-08-12 11:10:07');
INSERT INTO `n_detail_tables` VALUES (139, 'qty', '{\"type_input\":\"number\",\"required\":1}', 'Số lượng', 'text', 'print_warehouse', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-30 11:00:22', '2023-08-12 11:10:07');
INSERT INTO `n_detail_tables` VALUES (140, 'name', '{\"required\":1}', 'Tên vật tư', 'text', 'print_warehouses', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-25 08:45:22');
INSERT INTO `n_detail_tables` VALUES (141, 'length', '{\"required\":1}', 'KT dài', 'text', 'print_warehouses', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-11-16 22:39:14');
INSERT INTO `n_detail_tables` VALUES (142, 'width', '{\"required\":1}', 'KT rộng', 'text', 'print_warehouses', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-11-16 22:39:14');
INSERT INTO `n_detail_tables` VALUES (143, 'qty', '{\"type_input\":\"number\",\"disable_field\":1}', 'Số lượng', 'text', 'print_warehouses', 1, 0, 1, 0, 0, '', 1, 0, 1, '2023-04-30 11:00:22', '2023-09-26 10:19:25');
INSERT INTO `n_detail_tables` VALUES (144, 'supp_price', '{\"required\":1}', 'Loại giấy', 'linking', 'print_warehouses', 1, 1, 1, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"materals\",\r\n		\"where_default\":{\"type\":\"type\"}\r\n	}\r\n}', 1, 0, 1, '2023-05-11 11:18:58', '2023-11-16 22:39:30');
INSERT INTO `n_detail_tables` VALUES (145, 'name', '{\"required\":1}', 'Tên vật tư', 'text', 'other_warehouses', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-08-16 15:29:54');
INSERT INTO `n_detail_tables` VALUES (146, 'qty', '{\"type_input\":\"number\",\"disable_field\":1}', 'Số lượng', 'text', 'other_warehouses', 1, 0, 1, 0, 0, '', 1, 0, 1, '2023-04-30 11:00:22', '2023-09-26 10:19:25');
INSERT INTO `n_detail_tables` VALUES (147, 'supp_price', '{\"required\":1}', 'Loại nam châm', 'linking', 'other_warehouses', 1, 1, 1, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"materals\",\r\n		\"where_default\":{\"type\":\"type\"}\r\n	}\r\n}', 1, 0, 1, '2023-05-11 11:18:58', '2023-11-16 22:43:32');
INSERT INTO `n_detail_tables` VALUES (148, 'group_supply', '', 'Dạng vật tư', 'group', 'c_supplies', 1, 1, 1, 1, 0, '{\r\n	\"group_class\":\"__module_select_type_warehouse\",\r\n	\"width\":\"8\",\r\n	\"width_child\":\"6\"\r\n}', 1, 0, 1, '2023-05-23 14:41:40', '2023-08-17 03:13:39');
INSERT INTO `n_detail_tables` VALUES (149, 'supp_type', '{\"required\":1,\"inject_class\":\"__wh_select_type\"}', 'Loại vật tư', 'select', 'c_supplies', 1, 0, 0, 0, 148, '{\r\n	\"config\":{\r\n		\"searchbox\":1\r\n	},\r\n	\"data\":{\r\n		\"options\":{\r\n			\"0\":\"Chọn loại vật tư\",\r\n			\"paper\":\"Giấy in\", \r\n			\"nilon\":\"Màng nilon\", \r\n			\"metalai\":\"Màng metalai\",\r\n			\"cover\":\"Màng phủ trên\",\r\n			\"carton\":\"Carton\",\r\n			\"rubber\":\"Cao su\",\r\n			\"styrofoam\":\"Mút phẳng\",\r\n			\"decal\":\"Nhung\",\r\n			\"silk\":\"Vải lụa\",\r\n			\"mica\":\"Mi ca\",\r\n			\"magnet\":\"Nam châm\"\r\n		}\r\n	}\r\n}', 1, 0, 1, '2023-05-11 11:18:58', '2023-08-17 03:16:06');
INSERT INTO `n_detail_tables` VALUES (150, 'name', '{\"required\":1}', 'Tên vật tư', 'text', 'square_warehouses', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-08-17 15:56:46');
INSERT INTO `n_detail_tables` VALUES (151, 'qty', '{\"type_input\":\"number\",\"disable_field\":1}', 'Còn lại (m)', 'text', 'square_warehouses', 1, 0, 1, 0, 0, '', 1, 1, 1, '2023-04-30 11:00:22', '2023-09-26 10:19:25');
INSERT INTO `n_detail_tables` VALUES (152, 'supp_price', '{\"required\":1}', 'Loại vật tư', 'linking', 'square_warehouses', 1, 1, 1, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"materals\",\r\n		\"where_default\":{\"type\":\"type\"}\r\n	}\r\n}', 1, 1, 1, '2023-05-11 11:18:58', '2023-08-26 00:39:38');
INSERT INTO `n_detail_tables` VALUES (153, 'created_by', NULL, 'Người thêm', 'linking', 'other_warehouses', 1, 0, 0, 0, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', 1, 0, 1, '2023-04-08 00:08:00', '2023-11-16 22:43:36');
INSERT INTO `n_detail_tables` VALUES (154, 'created_at', NULL, 'Ngày thêm', 'datetime', 'other_warehouses', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-08 00:08:00', '2023-11-16 22:43:35');
INSERT INTO `n_detail_tables` VALUES (155, 'created_by', NULL, 'Người thêm', 'linking', 'square_warehouses', 1, 0, 0, 0, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', 1, 1, 1, '2023-04-08 00:08:00', '2023-11-16 22:42:05');
INSERT INTO `n_detail_tables` VALUES (156, 'created_at', NULL, 'Ngày thêm', 'datetime', 'square_warehouses', 1, 1, 1, 0, 0, '', 1, 1, 1, '2023-04-08 00:08:00', '2023-11-16 22:42:03');
INSERT INTO `n_detail_tables` VALUES (157, 'order', NULL, 'Đơn hàng', 'linking', 'products', 1, NULL, NULL, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"orders\",\r\n		\"field_title\":\"code\"\r\n	}\r\n}', 1, 0, 1, '2023-08-22 03:54:31', '2023-09-24 08:48:22');
INSERT INTO `n_detail_tables` VALUES (158, 'code', '{\"disable_field\":1,\"required\":1}', 'Seri', 'text', 'products', 1, 0, 1, 1, 0, '', 1, 0, 1, '2023-05-26 03:19:12', '2023-08-22 03:57:05');
INSERT INTO `n_detail_tables` VALUES (159, 'name', '', 'Tên', 'text', 'products', 1, 0, 1, 1, 0, '', 1, 0, 1, '2023-05-26 03:19:12', '2023-08-22 03:57:00');
INSERT INTO `n_detail_tables` VALUES (160, 'category', NULL, 'Nhóm sản phẩm', 'linking', 'products', 0, NULL, NULL, 0, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"product_categories\"\r\n	}\r\n}', 1, 0, 0, '2023-08-22 03:54:31', '2023-10-06 12:36:26');
INSERT INTO `n_detail_tables` VALUES (161, 'qty', '{\"type_input\":\"number\",\"required\":1}', 'Số lượng', 'text', 'products', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-30 11:00:22', '2023-08-22 04:00:56');
INSERT INTO `n_detail_tables` VALUES (162, 'total_amount', '{\"type_input\":\"price\"}', 'Tổng giá', 'text', 'products', 1, 0, 1, 0, 0, '', 1, 0, 1, '2023-05-26 03:19:12', '2023-08-22 04:03:37');
INSERT INTO `n_detail_tables` VALUES (163, 'created_by', NULL, 'Người thêm', 'linking', 'products', 1, 0, 0, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', 1, 0, 1, '2023-04-08 00:08:00', '2023-08-22 04:03:06');
INSERT INTO `n_detail_tables` VALUES (164, 'created_at', NULL, 'Ngày thêm', 'datetime', 'products', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-08 00:08:00', '2023-08-17 15:56:04');
INSERT INTO `n_detail_tables` VALUES (165, 'width', '{\"type_input\":\"number\",\"required\":1}', 'Kích thước khổ', 'text', 'square_warehouses', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-30 11:00:22', '2023-11-16 22:42:11');
INSERT INTO `n_detail_tables` VALUES (166, 'qtv', '{\"type_input\":\"number\",\"required\":1}', 'Định lượng', 'text', 'print_warehouses', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-30 11:00:22', '2023-11-16 22:39:35');
INSERT INTO `n_detail_tables` VALUES (171, 'name', '', 'Tên lệnh', 'text', 'w_salaries', 1, 0, 0, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-11 09:51:02');
INSERT INTO `n_detail_tables` VALUES (172, 'command', '', 'Mã lệnh', 'text', 'w_salaries', 1, 0, 0, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-11 09:51:02');
INSERT INTO `n_detail_tables` VALUES (173, 'qty', '', 'SL hoàn thành', 'text', 'w_salaries', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-11 09:51:02');
INSERT INTO `n_detail_tables` VALUES (174, 'workprice', '', 'Đơn giá', 'text', 'w_salaries', 1, 0, 0, 0, 0, '', 1, 0, 0, '2023-04-07 23:41:47', '2023-09-11 10:09:38');
INSERT INTO `n_detail_tables` VALUES (175, 'shape_price', '', 'Lên khuôn', 'text', 'w_salaries', 1, 0, 0, 0, 0, '', 1, 0, 0, '2023-04-07 23:41:47', '2023-09-11 10:09:39');
INSERT INTO `n_detail_tables` VALUES (176, 'handle', '', 'Thông tin SX', 'json_name', 'w_salaries', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-11 09:51:02');
INSERT INTO `n_detail_tables` VALUES (177, 'total', '', 'Thành tiền', 'text', 'w_salaries', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-11 09:51:02');
INSERT INTO `n_detail_tables` VALUES (178, 'group_user', '', 'Thiết bị máy', 'group', 'w_salaries', 1, 0, 0, 1, 0, '{\r\n	\"group_class\":\"__module_select_type_worker\"\r\n}', 4, 0, 1, '2023-05-23 14:41:40', '2023-09-11 10:35:18');
INSERT INTO `n_detail_tables` VALUES (179, 'type', '{\"inject_class\":\"__worker_select_type\"}', 'Tổ máy', 'select', 'w_salaries', 1, 0, 0, 0, 178, '{\r\n	\"config\":{\r\n		\"searchbox\":1\r\n	},\r\n	\"data\":{\r\n		\"options\":{\r\n			\"\":\"Chọn tổ máy\",\r\n			\"print\":\"Tổ in\", \r\n			\"nilon\":\"Cán màng\", \r\n			\"metalai\":\"Tổ cán metalai\",\r\n			\"compress\":\"Tổ ép nhũ\",\r\n			\"uv\":\"Tổ in UV\",\r\n			\"elevate\":\"Tổ bế\",\r\n			\"float\":\"Tổ thúc nổi\",\r\n			\"peel\":\"Tổ bóc lề\",\r\n			\"mill\":\"Tổ máy phay\",\r\n			\"cut\":\"Tổ máy xén\",\r\n			\"fold\":\"Tổ gấp vạch\",\r\n			\"fill\":\"Tổ máy bồi\",\r\n			\"box_paste\":\"Tổ dán hộp giấy\",\r\n			\"bag_paste\":\"Tổ dán túi giấy\",\r\n			\"finish\":\"Tổ hoàn thiện cuối\"\r\n		}\r\n	}\r\n}', 1, 0, 1, '2023-06-15 06:55:51', '2023-09-12 15:26:31');
INSERT INTO `n_detail_tables` VALUES (180, 'worker', '{\"disable_field\":1,\"inject_class\":\"__worker_select_worker\"}', 'Công nhân', 'linking', 'w_salaries', 1, 0, 0, 0, 178, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"w_users\"\r\n	}\r\n}', 1, 0, 1, '2023-06-15 06:55:51', '2023-09-11 10:35:25');
INSERT INTO `n_detail_tables` VALUES (181, 'submited_at', '', 'TG Chấm công', 'datetime', 'w_salaries', 1, 0, 0, 1, 0, '', 1, 0, 1, '2023-05-23 14:38:05', '2023-09-11 10:42:32');
INSERT INTO `n_detail_tables` VALUES (182, 'created_by', '', 'Tạo lệnh', 'linking', 'w_salaries', 1, 0, 0, 0, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', 1, 0, 1, '2023-05-23 14:38:05', '2023-09-11 09:51:02');
INSERT INTO `n_detail_tables` VALUES (183, 'name', '{\"required\":1}', 'Tên máy in', 'text', 'printers', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-28 00:28:28', '2023-09-13 00:21:20');
INSERT INTO `n_detail_tables` VALUES (184, 'print_length', '{\"required\":1,\"type_input\":\"number\"}', 'Chiều dài cho phép', 'text', 'printers', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 00:28:28', '2023-09-13 00:21:20');
INSERT INTO `n_detail_tables` VALUES (185, 'print_width', '{\"required\":1,\"type_input\":\"number\"}', 'Chiều rộng cho phép', 'text', 'printers', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 00:28:28', '2023-09-13 00:21:20');
INSERT INTO `n_detail_tables` VALUES (186, 'model_price', '{\"required\":1,\"type_input\":\"number\"}', 'Chi phí khuôn mẫu', 'text', 'printers', 1, 1, 1, 0, 0, '', 14, 0, 1, '2023-04-28 00:28:28', '2023-09-13 00:21:20');
INSERT INTO `n_detail_tables` VALUES (187, '', '', 'ĐG chỉnh máy', 'group', 'printers', 1, 0, 0, 0, 0, '', 0, 0, 1, '2023-04-08 00:51:39', '2023-09-13 00:21:20');
INSERT INTO `n_detail_tables` VALUES (188, '', '', 'ĐG lượt', 'group', 'printers', 1, 0, 0, 0, 0, '', 0, 0, 1, '2023-04-08 00:51:39', '2023-09-13 00:21:20');
INSERT INTO `n_detail_tables` VALUES (189, 'shape_price', '{\"required\":1}', 'Khách', 'text', 'printers', 1, 1, 1, 0, 187, '', 12, 0, 1, '2023-04-27 04:39:05', '2023-09-13 00:22:46');
INSERT INTO `n_detail_tables` VALUES (190, 'w_shape_price', '{\"required\":1}', 'Thợ', 'text', 'printers', 1, 1, 1, 0, 187, '', 12, 0, 1, '2023-04-27 04:39:20', '2023-09-13 00:22:48');
INSERT INTO `n_detail_tables` VALUES (191, 'work_price', '{\"required\":1}', 'Khách', 'text', 'printers', 1, 1, 1, 0, 188, '', 13, 0, 1, '2023-04-27 04:39:22', '2023-09-13 00:22:52');
INSERT INTO `n_detail_tables` VALUES (192, 'w_work_price', '{\"required\":1}', 'Thợ', 'text', 'printers', 1, 1, 1, 0, 188, '', 13, 0, 1, '2023-04-27 04:39:26', '2023-09-13 00:22:55');
INSERT INTO `n_detail_tables` VALUES (193, 'act', '', 'Kích hoạt', 'checkbox', 'printers', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-30 10:44:01', '2023-09-13 00:21:26');
INSERT INTO `n_detail_tables` VALUES (194, 'created_at', '', 'Ngày tạo', 'datetime', 'printers', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-30 10:43:59', '2023-09-13 00:21:26');
INSERT INTO `n_detail_tables` VALUES (195, 'ord', '{\"type_input\":\"number\"}', 'Sắp xếp', 'text', 'printers', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-30 11:00:22', '2023-09-13 00:21:26');
INSERT INTO `n_detail_tables` VALUES (196, 'name', '{\"required\":1}', 'Tên vật tư', 'text', 'supply_names', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-09-15 02:12:21');
INSERT INTO `n_detail_tables` VALUES (197, 'factor', '{\"required\":1,\"type_input\":\"number\"}', 'Hệ số máy phay', 'text', 'supply_names', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-09-15 02:12:21');
INSERT INTO `n_detail_tables` VALUES (198, 'act', '', 'Kích hoạt', 'checkbox', 'supply_names', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-09-15 02:12:21');
INSERT INTO `n_detail_tables` VALUES (199, 'note', '', 'Ghi chú', 'textarea', 'supply_names', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-09-15 02:12:21');
INSERT INTO `n_detail_tables` VALUES (200, 'created_at', '', 'Ngày tạo', 'datetime', 'supply_names', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-09-15 02:12:21');
INSERT INTO `n_detail_tables` VALUES (201, 'updated_at', '', 'Ngày sửa', 'datetime', 'supply_names', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-09-15 02:12:21');
INSERT INTO `n_detail_tables` VALUES (202, 'ord', '{\"type_input\":\"number\"}', 'Sắp xếp', 'text', 'supply_names', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-30 11:00:22', '2023-09-15 02:12:32');
INSERT INTO `n_detail_tables` VALUES (203, 'name', '', 'Tên vật tư', 'text', 'papers', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-04-07 23:41:47');
INSERT INTO `n_detail_tables` VALUES (204, 'product_qty', '', 'SL sản phẩm', 'text', 'papers', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-16 05:54:51');
INSERT INTO `n_detail_tables` VALUES (205, 'nqty', '', 'Số bát', 'text', 'papers', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-16 05:56:11');
INSERT INTO `n_detail_tables` VALUES (206, 'supp_qty', '', 'Số L vật tư', 'text', 'papers', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-16 05:54:39');
INSERT INTO `n_detail_tables` VALUES (207, 'print', '', 'In', 'handle_stage', 'papers', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-16 05:54:39');
INSERT INTO `n_detail_tables` VALUES (208, 'nilon', '', 'Cán nilon', 'handle_stage', 'papers', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-16 05:54:39');
INSERT INTO `n_detail_tables` VALUES (209, 'metalai', '', 'Cán metalai', 'handle_stage', 'papers', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-16 05:54:39');
INSERT INTO `n_detail_tables` VALUES (210, 'compress', '', 'Ép nhũ', 'handle_stage', 'papers', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-16 05:54:39');
INSERT INTO `n_detail_tables` VALUES (211, 'uv', '', 'In UV', 'handle_stage', 'papers', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-16 05:54:39');
INSERT INTO `n_detail_tables` VALUES (212, 'elevate', '', 'Bế', 'handle_stage', 'papers', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-16 05:54:39');
INSERT INTO `n_detail_tables` VALUES (213, 'float', '', 'Thúc nổi', 'handle_stage', 'papers', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-16 05:54:39');
INSERT INTO `n_detail_tables` VALUES (214, 'peel', '', 'Bóc lề', 'handle_stage', 'papers', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-16 06:01:20');
INSERT INTO `n_detail_tables` VALUES (215, 'fold', '', 'Gấp vạch', 'handle_stage', 'papers', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-16 05:54:39');
INSERT INTO `n_detail_tables` VALUES (216, 'box_paste', '', 'Dán hộp', 'handle_stage', 'papers', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-16 05:54:39');
INSERT INTO `n_detail_tables` VALUES (217, 'bag_paste', '', 'Dấn túi', 'handle_stage', 'papers', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-16 05:54:39');
INSERT INTO `n_detail_tables` VALUES (218, 'status', '', 'Trạng thái', 'text', 'papers', 1, 0, 0, 0, 0, '', 1, 0, 0, '2023-04-07 23:41:47', '2023-09-17 10:42:36');
INSERT INTO `n_detail_tables` VALUES (219, 'name', '', 'Tên vật tư', 'text', 'supplies', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-17 10:47:33');
INSERT INTO `n_detail_tables` VALUES (220, 'product_qty', '', 'SL sản phẩm', 'text', 'supplies', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-17 10:47:33');
INSERT INTO `n_detail_tables` VALUES (221, 'nqty', '', 'Số bát', 'text', 'supplies', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-17 10:47:33');
INSERT INTO `n_detail_tables` VALUES (222, 'supp_qty', '', 'Số L vật tư', 'text', 'supplies', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-17 10:47:33');
INSERT INTO `n_detail_tables` VALUES (223, 'cut', '', 'Xén', 'handle_stage', 'supplies', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-17 10:47:33');
INSERT INTO `n_detail_tables` VALUES (224, 'elavate', '', 'Bế', 'handle_stage', 'supplies', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-17 10:47:33');
INSERT INTO `n_detail_tables` VALUES (225, 'peel', '', 'Bóc lề', 'handle_stage', 'supplies', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-17 10:47:33');
INSERT INTO `n_detail_tables` VALUES (226, 'mill', '', 'Phay', 'handle_stage', 'supplies', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-17 10:47:33');
INSERT INTO `n_detail_tables` VALUES (227, 'status', '', 'Trạng thái', 'text', 'supplies', 1, 0, 0, 0, 0, '', 1, 0, 0, '2023-04-07 23:41:47', '2023-09-17 10:47:33');
INSERT INTO `n_detail_tables` VALUES (228, 'product_qty', '', 'SL sản phẩm', 'text', 'fill_finishes', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-17 10:51:21');
INSERT INTO `n_detail_tables` VALUES (229, 'fill', '', 'Bồi', 'handle_stage', 'fill_finishes', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-17 10:51:21');
INSERT INTO `n_detail_tables` VALUES (230, 'finish', '', 'Hoàn thiện cuối', 'handle_stage', 'fill_finishes', 1, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-17 10:51:21');
INSERT INTO `n_detail_tables` VALUES (231, 'status', '', 'Trạng thái', 'text', 'fill_finishes', 1, 0, 0, 0, 0, '', 1, 0, 0, '2023-04-07 23:41:47', '2023-09-17 10:51:21');
INSERT INTO `n_detail_tables` VALUES (232, 'category', NULL, 'Nhóm sản phẩm', 'group_product', 'quotes', 0, 0, 0, 1, 0, '{\r\n	\"table_target\":\"quotes\"\r\n}', 1, 0, 1, '2023-04-30 11:17:52', '2023-09-20 17:23:16');
INSERT INTO `n_detail_tables` VALUES (233, 'size', NULL, 'Kích thước khuôn', 'product_size', 'quotes', 0, 0, 0, 1, 0, '{\r\n	\"table_target\":\"quotes\"\r\n}', 1, 0, 1, '2023-04-30 11:17:52', '2023-09-20 17:23:19');
INSERT INTO `n_detail_tables` VALUES (234, 'name', '{\"required\":1,\"disable_field\":1}', 'Tên', 'text', 'product_categories', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-20 14:46:23');
INSERT INTO `n_detail_tables` VALUES (235, 'design_factor', '{\"required\":1,\"type_input\":\"number\"}', 'Hệ số tính điểm cho TK', 'text', 'product_categories', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-20 14:45:19');
INSERT INTO `n_detail_tables` VALUES (236, 'act', '', 'Kích hoạt', 'checkbox', 'product_categories', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-08 00:05:47', '2023-09-20 14:52:50');
INSERT INTO `n_detail_tables` VALUES (237, 'name', '{\"required\":1}', 'Tên', 'text', 'product_styles', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-09-20 15:01:14');
INSERT INTO `n_detail_tables` VALUES (238, 'category', NULL, 'Nhóm sản phẩm', 'linking', 'product_styles', 1, 0, 0, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"product_categories\"\r\n	}\r\n}', 1, 0, 1, '2023-04-08 00:08:00', '2023-09-20 15:01:45');
INSERT INTO `n_detail_tables` VALUES (239, 'created_at', NULL, 'Ngày tạo', 'datetime', 'product_styles', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-08 00:08:00', '2023-09-20 14:59:54');
INSERT INTO `n_detail_tables` VALUES (240, 'updated_at', NULL, 'Ngày sửa', 'datetime', 'product_styles', 0, 0, 0, 0, 0, '', 1, 0, 1, '2023-04-08 00:12:15', '2023-09-20 14:59:55');
INSERT INTO `n_detail_tables` VALUES (241, 'act', '', 'Kích hoạt', 'checkbox', 'product_styles', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-08 00:05:47', '2023-09-20 14:52:50');
INSERT INTO `n_detail_tables` VALUES (242, 'status', '', 'Trạng thái', 'select', 'products', 1, 0, 1, 0, 0, '{\"data\":{\r\n		\"options\":{\r\n			\"not_accepted\":\"Chưa duyệt\", \r\n			\"accepted\":\"Đã duyệt thiết kế\", \r\n			\"to_design\":\"Chờ thiết kế nhận lệnh\",\r\n			\"designing\":\"Đang thiết kế\",\r\n			\"design_submited\":\"Đã xong thiết kế\",\r\n			\"tech_submited\":\"Kế hoạch đang xử lí\",\r\n			\"making_process\":\"Đang gia công\",\r\n			\"submited\":\"Hoàn tất gia công\"\r\n		}\r\n	}\r\n}', 1, 0, 1, '2023-05-26 03:19:12', '2023-09-22 00:39:04');
INSERT INTO `n_detail_tables` VALUES (243, 'category', NULL, 'Nhóm sản phẩm', 'group_product', 'products', 0, 0, 0, 1, 0, '{\r\n	\"table_target\":\"quotes\"\r\n}', 1, 0, 1, '2023-04-30 11:17:52', '2023-09-21 11:32:54');
INSERT INTO `n_detail_tables` VALUES (244, 'size', NULL, 'Kích thước', 'product_size', 'products', 0, 0, 0, 1, 0, '{\r\n	\"table_target\":\"quotes\"\r\n}', 1, 0, 1, '2023-04-30 11:17:52', '2023-09-21 11:32:56');
INSERT INTO `n_detail_tables` VALUES (245, 'name', '{\"required\":1}', 'Tên vật tư', 'text', 'warehouse_providers', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-09-25 20:52:35');
INSERT INTO `n_detail_tables` VALUES (246, 'act', '', 'Kích hoạt', 'checkbox', 'warehouse_providers', 1, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-09-25 20:52:35');
INSERT INTO `n_detail_tables` VALUES (247, 'note', '', 'Ghi chú', 'textarea', 'warehouse_providers', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-09-25 20:52:35');
INSERT INTO `n_detail_tables` VALUES (248, 'created_at', '', 'Ngày tạo', 'datetime', 'warehouse_providers', 1, 1, 1, 1, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-09-25 20:52:35');
INSERT INTO `n_detail_tables` VALUES (249, 'updated_at', '', 'Ngày sửa', 'datetime', 'warehouse_providers', 0, 1, 1, 0, 0, '', 1, 0, 1, '2023-04-28 11:43:12', '2023-09-25 20:52:35');
INSERT INTO `n_detail_tables` VALUES (250, 'ord', '{\"type_input\":\"number\"}', 'Sắp xếp', 'text', 'warehouse_providers', 1, 1, 1, 0, 0, '', 1, 3, 1, '2023-04-30 11:00:22', '2023-09-25 20:52:35');
INSERT INTO `n_detail_tables` VALUES (251, 'code', '{\"disable_field\":1,\"required\":1}', 'Mã', 'text', 'supply_buyings', 1, 0, 1, 1, 0, '', 1, 0, 1, '2023-04-07 23:41:47', '2023-11-14 22:30:40');
INSERT INTO `n_detail_tables` VALUES (252, 'name', '{\"required\":1}', 'Tên', 'text', 'supply_buyings', 1, 1, 1, 1, 0, '', 1, 1, 1, '2023-04-07 23:41:47', '2023-11-14 23:53:53');
INSERT INTO `n_detail_tables` VALUES (253, 'provider', '', 'Nhà cung cấp', 'linking', 'supply_buyings', 1, 1, 1, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"warehouse_providers\"\r\n	}\r\n}', 1, 2, 1, '2023-04-08 00:08:00', '2023-11-14 23:53:54');
INSERT INTO `n_detail_tables` VALUES (254, 'supply', '', 'Vật tư cần mua', 'json_supply', 'supply_buyings', 1, 1, 1, 0, 0, '', 1, 3, 1, '2023-04-08 00:08:00', '2023-11-17 03:09:23');
INSERT INTO `n_detail_tables` VALUES (255, 'status', '', 'Trạng thái', 'select', 'supply_buyings', 1, 0, 0, 1, 0, '{\"data\":{\r\n		\"options\":{\r\n			\"not_accepted\":\"Chưa duyệt\", \r\n			\"accepted\":\"Đã duyệt mua\", \r\n			\"buying\":\"Đang chờ mua\",\r\n			\"bought\":\"Đã mua\",\r\n			\"submited\":\"Đã nhập kho\"\r\n		}\r\n	}\r\n}', 1, 4, 1, '2023-05-26 03:19:12', '2023-11-14 23:53:55');
INSERT INTO `n_detail_tables` VALUES (256, 'payment_status', '', 'Công nợ', 'select', 'supply_buyings', 1, 1, 1, 1, 0, '{\"data\":{\r\n		\"options\":{\r\n			\"not_payment\":\"Chưa thanh toán\",\r\n			\"debt\":\"Còn nợ\",\r\n			\"paid_off\":\"Đã thanh toán hết\"\r\n		}\r\n	}\r\n}', 1, 5, 1, '2023-05-26 03:19:12', '2023-11-14 23:55:11');
INSERT INTO `n_detail_tables` VALUES (257, 'note', '', 'Ghi chú', 'textarea', 'supply_buyings', 0, 1, 1, 0, 0, '', 1, 6, 1, '2023-04-28 11:43:12', '2023-11-14 23:53:57');
INSERT INTO `n_detail_tables` VALUES (258, 'created_at', '', 'Ngày tạo', 'datetime', 'supply_buyings', 1, 0, 0, 1, 0, '', 1, 7, 1, '2023-04-28 11:43:12', '2023-11-14 23:53:58');
INSERT INTO `n_detail_tables` VALUES (259, 'updated_at', '', 'Ngày sửa', 'datetime', 'supply_buyings', 0, 0, 0, 0, 0, '', 1, 8, 1, '2023-04-28 11:43:12', '2023-11-14 23:54:00');
INSERT INTO `n_detail_tables` VALUES (260, 'created_by', NULL, 'Người thêm', 'linking', 'supply_buyings', 1, 0, 0, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', 1, 9, 1, '2023-04-08 00:08:00', '2023-11-14 23:54:01');
INSERT INTO `n_detail_tables` VALUES (261, 'applied_by', NULL, 'Người duyệt mua', 'linking', 'supply_buyings', 1, 0, 0, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', 1, 10, 1, '2023-04-08 00:08:00', '2023-11-14 23:54:03');
INSERT INTO `n_detail_tables` VALUES (262, 'bought_by', NULL, 'Người mua', 'linking', 'supply_buyings', 1, 0, 0, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', 1, 11, 1, '2023-04-08 00:08:00', '2023-11-16 07:50:44');
INSERT INTO `n_detail_tables` VALUES (263, 'submited_by', NULL, 'Nhập kho bởi', 'linking', 'supply_buyings', 1, 0, 0, 1, 0, '{\r\n	\"config\":{\r\n		\"search\":1\r\n	},\r\n	\"data\":{\r\n		\"table\":\"n_users\"\r\n	}\r\n}', 1, 11, 1, '2023-04-08 00:08:00', '2023-11-16 07:50:44');

-- ----------------------------
-- Table structure for n_group_users
-- ----------------------------
DROP TABLE IF EXISTS `n_group_users`;
CREATE TABLE `n_group_users`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of n_group_users
-- ----------------------------
INSERT INTO `n_group_users` VALUES (1, 'Admin', 'Admin cao nhất có mọi quyền truy cập', 1, '2023-05-23 14:44:18', '2023-05-23 14:44:18', 1);
INSERT INTO `n_group_users` VALUES (2, 'Phòng Kinh Doanh', 'Phòng Kinh Doanh', 1, '2023-05-23 14:44:18', '2023-05-23 14:44:18', 1);
INSERT INTO `n_group_users` VALUES (3, 'Phòng Kỹ thuật duyệt lệnh', 'Phòng Kỹ thuật duyệt lệnh', 1, '2023-05-23 14:44:18', '2023-05-23 14:44:18', 1);
INSERT INTO `n_group_users` VALUES (4, 'Phòng thiết kế', 'Phòng thiết kế', 1, '2023-05-23 14:44:18', '2023-05-23 14:44:18', 1);
INSERT INTO `n_group_users` VALUES (5, 'Phòng Kỹ thuật sản xuất', 'Phòng Kỹ thuật sản xuất', 1, '2023-05-23 14:44:18', '2023-05-23 14:44:18', 1);
INSERT INTO `n_group_users` VALUES (6, 'Phòng Kế hoạch', 'Phòng Kế hoạch', 1, '2023-05-23 14:44:18', '2023-05-23 14:44:18', 1);
INSERT INTO `n_group_users` VALUES (7, 'Kho vật tư xuất - nhập', 'Kho vật tư xuất - nhập', 1, '2023-05-23 14:44:18', '2023-05-23 14:44:18', 1);
INSERT INTO `n_group_users` VALUES (8, 'Phòng duyệt mua', 'Phòng duyệt mua', 1, '2023-05-23 14:44:18', '2023-11-16 01:11:53', 1);
INSERT INTO `n_group_users` VALUES (9, 'Phòng khuôn mẫu', 'Khuôn mẫu', 1, '2023-05-23 14:44:18', '2023-11-16 03:39:45', 1);
INSERT INTO `n_group_users` VALUES (10, 'Phòng mua hàng', 'Phòng mua hàng', 1, '2023-05-23 14:44:18', '2023-11-16 03:40:13', 1);

-- ----------------------------
-- Table structure for n_log_actions
-- ----------------------------
DROP TABLE IF EXISTS `n_log_actions`;
CREATE TABLE `n_log_actions`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `table_map` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `action` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `target` int(10) NULL DEFAULT NULL,
  `user` int(10) NULL DEFAULT NULL,
  `parent` int(10) NULL DEFAULT NULL,
  `detail_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 635 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of n_log_actions
-- ----------------------------
INSERT INTO `n_log_actions` VALUES (250, 'supply_prices', 'insert', 218, 1, 0, '{\"supply_id\":\"49\",\"name\":\"MDF 1.9ly\",\"price\":\"1.1\",\"act\":\"1\",\"note\":\"Kh\\u1ed5 1.22 x 2.44 =\",\"created_at\":\"04\\/10\\/2023 9:52\",\"updated_at\":\"04\\/10\\/2023 9:52\",\"ord\":null}', 1, '2023-10-04 09:55:53', '2023-10-04 09:55:53');
INSERT INTO `n_log_actions` VALUES (251, 'supply_prices', 'update', 218, 1, 0, '{\"price\":{\"old\":\"1.1\",\"new\":\"1.2\"}}', 1, '2023-10-04 09:57:50', '2023-10-04 09:57:50');
INSERT INTO `n_log_actions` VALUES (260, 'supply_prices', 'insert', 219, 1, 0, '{\"supply_id\":\"49\",\"name\":\"MDF 2.3ly\",\"price\":\"1.2\",\"act\":\"1\",\"note\":\"Kh\\u1ed5 1.22 x 2.44 =\",\"created_at\":\"04\\/10\\/2023 9:55\",\"updated_at\":\"04\\/10\\/2023 9:57\",\"ord\":null}', 1, '2023-10-04 10:03:21', '2023-10-04 10:03:21');
INSERT INTO `n_log_actions` VALUES (261, 'supply_prices', 'update', 219, 1, 0, '{\"price\":{\"old\":\"1.2\",\"new\":\"1.4\"},\"note\":{\"old\":\"Kh\\u1ed5 1.22 x 2.44 =\",\"new\":\"Kh\\u1ed5 1.22 x 2.44 = 42.000\\u0111\"}}', 1, '2023-10-04 10:06:05', '2023-10-04 10:06:05');
INSERT INTO `n_log_actions` VALUES (262, 'supply_prices', 'update', 218, 1, 0, '{\"price\":{\"old\":\"1.2\",\"new\":\"1.4\"},\"note\":{\"old\":\"Kh\\u1ed5 1.22 x 2.44 =\",\"new\":\"Kh\\u1ed5 1.22 x 2.44 = 42.000\\u0111\"}}', 1, '2023-10-04 10:06:25', '2023-10-04 10:06:25');
INSERT INTO `n_log_actions` VALUES (263, 'supply_prices', 'update', 219, 1, 0, '{\"price\":{\"old\":\"1.4\",\"new\":\"1.6\"}}', 1, '2023-10-04 10:06:49', '2023-10-04 10:06:49');
INSERT INTO `n_log_actions` VALUES (264, 'supply_prices', 'update', 219, 1, 0, '{\"note\":{\"old\":\"Kh\\u1ed5 1.22 x 2.44 = 42.000\\u0111\",\"new\":\"Kh\\u1ed5 1.22 x 2.44 = 47.500\\u0111\"}}', 1, '2023-10-04 10:07:07', '2023-10-04 10:07:07');
INSERT INTO `n_log_actions` VALUES (265, 'supply_prices', 'insert', 220, 1, 0, '{\"supply_id\":\"49\",\"name\":\"MDF 3ly\",\"price\":\"2\",\"act\":\"1\",\"note\":\"Kh\\u1ed5 1.22 x 2.44 = 47.500\\u0111\",\"created_at\":\"04\\/10\\/2023 10:03\",\"updated_at\":\"04\\/10\\/2023 10:07\",\"ord\":null}', 1, '2023-10-04 10:08:33', '2023-10-04 10:08:33');
INSERT INTO `n_log_actions` VALUES (266, 'supply_prices', 'insert', 221, 1, 0, '{\"supply_id\":\"49\",\"name\":\"MDF 5ly\",\"price\":\"3.23\",\"act\":\"1\",\"note\":\"Kh\\u1ed5 1.22 x 2.44 = 96000\\u0111\",\"created_at\":\"04\\/10\\/2023 10:08\",\"updated_at\":\"04\\/10\\/2023 10:08\",\"ord\":null}', 1, '2023-10-04 10:09:12', '2023-10-04 10:09:12');
INSERT INTO `n_log_actions` VALUES (267, 'supply_prices', 'update', 220, 1, 0, '{\"note\":{\"old\":\"Kh\\u1ed5 1.22 x 2.44 = 47.500\\u0111\",\"new\":\"Kh\\u1ed5 1.22 x 2.44 = 60000\\u0111\"}}', 1, '2023-10-04 10:09:44', '2023-10-04 10:09:44');
INSERT INTO `n_log_actions` VALUES (311, 'supply_prices', 'update', 218, 1, 0, '{\"price\":{\"old\":\"1.4\",\"new\":\"1.55\"}}', 1, '2023-10-05 21:13:00', '2023-10-05 21:13:00');
INSERT INTO `n_log_actions` VALUES (312, 'supply_prices', 'update', 219, 1, 0, '{\"price\":{\"old\":\"1.6\",\"new\":\"1.6835\"}}', 1, '2023-10-05 21:13:14', '2023-10-05 21:13:14');
INSERT INTO `n_log_actions` VALUES (313, 'supply_prices', 'update', 220, 1, 0, '{\"price\":{\"old\":\"2\",\"new\":\"2.155\"}}', 1, '2023-10-05 21:13:33', '2023-10-05 21:13:33');
INSERT INTO `n_log_actions` VALUES (314, 'supply_prices', 'update', 221, 1, 0, '{\"price\":{\"old\":\"3.23\",\"new\":\"3.4345\"}}', 1, '2023-10-05 21:13:55', '2023-10-05 21:13:55');
INSERT INTO `n_log_actions` VALUES (315, 'supply_prices', 'insert', 222, 1, 0, '{\"supply_id\":\"49\",\"name\":\"MDF 8ly\",\"price\":\"4.512\",\"act\":\"1\",\"note\":\"Kh\\u1ed5 1.22 x 2.44 = 96000\\u0111\",\"created_at\":\"04\\/10\\/2023 10:09\",\"updated_at\":\"05\\/10\\/2023 21:13\",\"ord\":null}', 1, '2023-10-05 21:14:28', '2023-10-05 21:14:28');
INSERT INTO `n_log_actions` VALUES (316, 'supply_prices', 'insert', 223, 1, 0, '{\"supply_id\":\"49\",\"name\":\"MDF 10ly\",\"price\":\"5.0500\",\"act\":\"1\",\"note\":\"Kh\\u1ed5 1.22 x 2.44 = 96000\\u0111\",\"created_at\":\"05\\/10\\/2023 21:14\",\"updated_at\":\"05\\/10\\/2023 21:14\",\"ord\":null}', 1, '2023-10-05 21:14:41', '2023-10-05 21:14:41');
INSERT INTO `n_log_actions` VALUES (340, 'supply_prices', 'insert', 224, 1, 0, '{\"supply_id\":\"50\",\"name\":\"S\\u00d3NG E 3 l\\u1edbp lo\\u1ea1i c\\u1ee9ng\",\"price\":\"0.65\",\"act\":\"1\",\"note\":\"Nh\\u00e0 ph\\u01b0\\u01a1ng anh b\\u00e1n 6200\\u0111\\/m2\",\"created_at\":\"06\\/10\\/2023 8:12\",\"updated_at\":\"06\\/10\\/2023 8:12\",\"ord\":null}', 1, '2023-10-06 08:13:51', '2023-10-06 08:13:51');
INSERT INTO `n_log_actions` VALUES (394, 'printers', 'update', 5, 1, 0, '{\"w_work_price\":{\"old\":\"25\",\"new\":\"30\"}}', 1, '2023-10-06 12:49:34', '2023-10-06 12:49:34');
INSERT INTO `n_log_actions` VALUES (505, 'customers', 'insert', 19, 1, 0, '{}', 1, '2023-10-14 16:05:24', '2023-10-14 16:05:24');
INSERT INTO `n_log_actions` VALUES (512, 'quotes', 'insert_customer', 101, 1, 0, '{\"name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"contacter\":\"Mr Tu\\u1ea5n\",\"phone\":\"0963303999\",\"telephone\":\"02438303888\",\"email\":\"kd1.intuandung@gmail.com\",\"address\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"seri\":\"BG-000101\",\"customer_id\":\"19\",\"company_name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"status\":\"not_accepted\",\"created_by\":1,\"created_at\":\"2023-10-18 06:06:43\",\"act\":1,\"updated_at\":\"2023-10-18 06:06:43\"}', 1, '2023-10-18 06:06:43', '2023-10-18 06:06:43');
INSERT INTO `n_log_actions` VALUES (513, 'quotes', 'insert_customer', 102, 1, 0, '{\"name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"contacter\":\"Mr Tu\\u1ea5n\",\"phone\":\"0963303999\",\"telephone\":\"02438303888\",\"email\":\"kd1.intuandung@gmail.com\",\"address\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"seri\":\"BG-000102\",\"customer_id\":\"19\",\"company_name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"status\":\"not_accepted\",\"created_by\":1,\"created_at\":\"2023-10-18 06:36:17\",\"act\":1,\"updated_at\":\"2023-10-18 06:36:17\"}', 1, '2023-10-18 06:36:17', '2023-10-18 06:36:17');
INSERT INTO `n_log_actions` VALUES (517, 'quotes', 'insert_customer', 106, 1, 0, '{\"name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"contacter\":\"Mr Tu\\u1ea5n\",\"phone\":\"0963303999\",\"telephone\":\"02438303888\",\"email\":\"kd1.intuandung@gmail.com\",\"address\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"seri\":\"BG-000106\",\"customer_id\":\"19\",\"company_name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"status\":\"not_accepted\",\"created_by\":1,\"created_at\":\"2023-10-18 07:06:51\",\"act\":1,\"updated_at\":\"2023-10-18 07:06:51\"}', 1, '2023-10-18 07:06:51', '2023-10-18 07:06:51');
INSERT INTO `n_log_actions` VALUES (519, 'quotes', 'update_customer', 101, 1, 0, '{\"seri\":{\"old\":\"BG-000101\",\"new\":\"BG-000108\"}}', 1, '2023-10-19 14:38:33', '2023-10-19 14:38:33');
INSERT INTO `n_log_actions` VALUES (521, 'customers', 'insert', 20, 1, 0, '{}', 1, '2023-10-19 15:10:12', '2023-10-19 15:10:12');
INSERT INTO `n_log_actions` VALUES (523, 'quotes', 'update_customer', 106, 1, 0, '{\"seri\":{\"old\":\"BG-000106\",\"new\":\"BG-000108\"}}', 1, '2023-10-19 15:10:39', '2023-10-19 15:10:39');
INSERT INTO `n_log_actions` VALUES (525, 'customers', 'update', 4, 1, 0, '{\"name\":{\"old\":\"CTY VIETBANRD\",\"new\":\"CTY TNHH VIETBANRD\"},\"phone\":{\"old\":\"000\",\"new\":\"0977070289\"},\"telephone\":{\"old\":\"000\",\"new\":\"0977070289\"}}', 1, '2023-10-20 18:35:55', '2023-10-20 18:35:55');
INSERT INTO `n_log_actions` VALUES (526, 'customers', 'update', 4, 1, 0, '{\"email\":{\"old\":\"zalo\",\"new\":\"Phuongn@vietbrandco.vn\"}}', 1, '2023-10-20 18:36:48', '2023-10-20 18:36:48');
INSERT INTO `n_log_actions` VALUES (528, 'customers', 'update', 4, 16, 0, '{\"name\":{\"old\":\"CTY TNHH VIETBANRD\",\"new\":\"CTY TNHH VIETBRAND\"}}', 1, '2023-10-20 18:55:52', '2023-10-20 18:55:52');
INSERT INTO `n_log_actions` VALUES (530, 'quotes', 'insert_customer', 110, 1, 0, '{\"name\":\"CTY TNHH VIETBRAND\",\"contacter\":\"Ph\\u01b0\\u01a1ng\",\"phone\":\"0977070289\",\"telephone\":\"0977070289\",\"email\":\"Phuongn@vietbrandco.vn\",\"address\":\"H\\u00e0 Nam\",\"city\":\"9047\",\"seri\":\"BG-000110\",\"customer_id\":\"4\",\"company_name\":\"CTY TNHH VIETBRAND\",\"status\":\"not_accepted\",\"created_by\":1,\"created_at\":\"2023-10-21 06:30:45\",\"act\":1,\"updated_at\":\"2023-10-21 06:30:45\"}', 1, '2023-10-21 06:30:45', '2023-10-21 06:30:45');
INSERT INTO `n_log_actions` VALUES (531, 'quotes', 'insert_customer', 111, 1, 0, '{\"name\":\"CTY TNHH VIETBRAND\",\"contacter\":\"Ph\\u01b0\\u01a1ng\",\"phone\":\"0977070289\",\"telephone\":\"0977070289\",\"email\":\"Phuongn@vietbrandco.vn\",\"address\":\"H\\u00e0 Nam\",\"city\":\"9047\",\"seri\":\"BG-000111\",\"customer_id\":\"4\",\"company_name\":\"CTY TNHH VIETBRAND\",\"status\":\"not_accepted\",\"created_by\":1,\"created_at\":\"2023-10-21 06:48:26\",\"act\":1,\"updated_at\":\"2023-10-21 06:48:26\"}', 1, '2023-10-21 06:48:26', '2023-10-21 06:48:26');
INSERT INTO `n_log_actions` VALUES (532, 'quotes', 'update_customer', 111, 1, 0, '{\"seri\":{\"old\":\"BG-000111\",\"new\":\"BG-000112\"}}', 1, '2023-10-21 07:00:26', '2023-10-21 07:00:26');
INSERT INTO `n_log_actions` VALUES (533, 'quotes', 'update_customer', 110, 1, 0, '{\"seri\":{\"old\":\"BG-000110\",\"new\":\"BG-000112\"}}', 1, '2023-10-21 07:07:17', '2023-10-21 07:07:17');
INSERT INTO `n_log_actions` VALUES (536, 'quotes', 'insert_customer', 112, 1, 0, '{\"name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"contacter\":\"Mr Tu\\u1ea5n\",\"phone\":\"0963303999\",\"telephone\":\"02438303888\",\"email\":\"kd1.intuandung@gmail.com\",\"address\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"city\":\"351\",\"seri\":\"BG-000112\",\"customer_id\":\"9\",\"company_name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"status\":\"not_accepted\",\"created_by\":1,\"created_at\":\"2023-10-21 07:39:25\",\"act\":1,\"updated_at\":\"2023-10-21 07:39:25\"}', 1, '2023-10-21 07:39:25', '2023-10-21 07:39:25');
INSERT INTO `n_log_actions` VALUES (537, 'quotes', 'update_customer', 112, 1, 0, '{\"seri\":{\"old\":\"BG-000112\",\"new\":\"BG-000113\"}}', 1, '2023-10-21 07:50:50', '2023-10-21 07:50:50');
INSERT INTO `n_log_actions` VALUES (538, 'quotes', 'insert_customer', 113, 1, 0, '{\"name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"contacter\":\"Mr Tu\\u1ea5n\",\"phone\":\"0963303999\",\"telephone\":\"02438303888\",\"email\":\"kd1.intuandung@gmail.com\",\"address\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"seri\":\"BG-000113\",\"customer_id\":\"20\",\"company_name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"status\":\"not_accepted\",\"created_by\":1,\"created_at\":\"2023-10-21 07:51:27\",\"act\":1,\"updated_at\":\"2023-10-21 07:51:27\"}', 1, '2023-10-21 07:51:27', '2023-10-21 07:51:27');
INSERT INTO `n_log_actions` VALUES (539, 'quotes', 'insert_customer', 114, 1, 0, '{\"name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"contacter\":\"Mr Tu\\u1ea5n\",\"phone\":\"0963303999\",\"telephone\":\"02438303888\",\"email\":\"kd1.intuandung@gmail.com\",\"address\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"seri\":\"BG-000114\",\"customer_id\":\"20\",\"company_name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"status\":\"not_accepted\",\"created_by\":1,\"created_at\":\"2023-10-21 07:58:00\",\"act\":1,\"updated_at\":\"2023-10-21 07:58:00\"}', 1, '2023-10-21 07:58:00', '2023-10-21 07:58:00');
INSERT INTO `n_log_actions` VALUES (540, 'quotes', 'insert_customer', 115, 1, 0, '{\"name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"contacter\":\"Mr Tu\\u1ea5n\",\"phone\":\"0963303999\",\"telephone\":\"02438303888\",\"email\":\"kd1.intuandung@gmail.com\",\"address\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"seri\":\"BG-000115\",\"customer_id\":\"20\",\"company_name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"status\":\"not_accepted\",\"created_by\":1,\"created_at\":\"2023-10-21 08:07:21\",\"act\":1,\"updated_at\":\"2023-10-21 08:07:21\"}', 1, '2023-10-21 08:07:21', '2023-10-21 08:07:21');
INSERT INTO `n_log_actions` VALUES (541, 'materals', 'update', 1, 1, 0, '{\"price\":{\"old\":\"0.36\",\"new\":\"0.28\"}}', 1, '2023-10-21 08:30:56', '2023-10-21 08:30:56');
INSERT INTO `n_log_actions` VALUES (542, 'quotes', 'insert', 116, 1, 0, '{\"seri\":\"BG-000116\",\"status\":\"not_accepted\",\"name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"product_qty\":null,\"customer_id\":20,\"company_name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"contacter\":\"Mr Tu\\u1ea5n\",\"address\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"email\":\"kd1.intuandung@gmail.com\",\"phone\":\"0963303999\",\"telephone\":\"02438303888\",\"city\":null,\"profit\":\"0\",\"ship_price\":\"0\",\"total_cost\":\"421298807.5\",\"total_amount\":\"421298807.5\",\"note\":null,\"act\":1,\"src\":null,\"created_by\":1,\"created_at\":\"2023-10-21 08:31:07\",\"updated_at\":\"2023-10-21 08:31:07\"}', 1, '2023-10-21 08:31:07', '2023-10-21 08:31:07');
INSERT INTO `n_log_actions` VALUES (543, 'products', 'insert', 82, 1, 542, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024\",\"category\":1,\"product_style\":11,\"qty\":\"10000\",\"design\":1,\"length\":\"36\",\"width\":\"42\",\"height\":\"10\",\"quote_id\":116,\"total_cost\":\"421298807.5\",\"total_amount\":\"421298807.5\",\"custom_design_file\":null,\"sale_shape_file\":\"{\\\"id\\\":\\\"130\\\",\\\"dir\\\":\\\"storages\\/uploads\\\",\\\"path\\\":\\\"storage\\/app\\/public\\/uploads\\/1 T\\u00daI QU\\u00c0 T\\u1ebeT KT chu\\u1ea9n 2024 3 lo\\u1ea1i CHU\\u1ea8N NH\\u1ea4T 9999(7).cdr\\\",\\\"name\\\":\\\"1 T\\u00daI QU\\u00c0 T\\u1ebeT KT chu\\u1ea9n 2024 3 lo\\u1ea1i CHU\\u1ea8N NH\\u1ea4T 9999(7).cdr\\\"}\",\"tech_shape_file\":null,\"design_file\":null,\"design_shape_file\":null,\"handle_shape_file\":null,\"note\":null,\"act\":1,\"detail\":null,\"created_by\":1,\"created_at\":\"2023-10-21 08:31:07\",\"updated_at\":\"2023-10-21 08:31:07\"}', 1, '2023-10-21 08:31:07', '2023-10-21 08:31:07');
INSERT INTO `n_log_actions` VALUES (544, 'papers', 'insert', 152, 1, 543, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024\",\"product_qty\":10000,\"nqty\":1,\"base_supp_qty\":10050,\"compent_percent\":\"250\",\"compent_plus\":200,\"supp_qty\":10500,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"150\\\",\\\"length\\\":\\\"51\\\",\\\"width\\\":\\\"56\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":10500,\\\"act\\\":1,\\\"total\\\":8996400}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"4\\\",\\\"machine\\\":\\\"1\\\",\\\"note\\\":null,\\\"supp_qty\\\":9050,\\\"handle_qty\\\":10050,\\\"model_price\\\":66000,\\\"work_price\\\":35,\\\"shape_price\\\":110000,\\\"printer\\\":3,\\\"act\\\":1,\\\"total\\\":1971000}\",\"nilon\":\"{\\\"materal\\\":\\\"9\\\",\\\"face\\\":\\\"1\\\",\\\"machine\\\":\\\"8\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":50000,\\\"supp_qty\\\":10400,\\\"handle_qty\\\":10050,\\\"materal_price\\\":0.25,\\\"act\\\":1,\\\"total\\\":7475600}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"1000\\\",\\\"shape_price\\\":\\\"200000\\\",\\\"machine\\\":\\\"2\\\",\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"nqty\\\":1,\\\"act\\\":1,\\\"total\\\":10300000}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":10400,\\\"handle_qty\\\":10050,\\\"cost\\\":2088400,\\\"act\\\":1,\\\"total\\\":2088400}\",\"float\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":131000}\",\"cut\":null,\"fold\":null,\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":1,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"30962400\",\"product\":82,\"note\":null,\"main\":1,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:31:07\",\"updated_at\":\"2023-10-21 08:31:07\"}', 1, '2023-10-21 08:31:07', '2023-10-21 08:31:07');
INSERT INTO `n_log_actions` VALUES (545, 'papers', 'insert', 153, 1, 543, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024 ( T\\u1edc B\\u1ed2I \\u0110\\u00c1Y H\\u1ed8P )\",\"product_qty\":10000,\"nqty\":1,\"base_supp_qty\":10050,\"compent_percent\":\"250\",\"compent_plus\":200,\"supp_qty\":10500,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"120\\\",\\\"length\\\":\\\"51\\\",\\\"width\\\":\\\"56\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":10500,\\\"act\\\":1,\\\"total\\\":7197120}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"4\\\",\\\"machine\\\":\\\"1\\\",\\\"note\\\":null,\\\"supp_qty\\\":9050,\\\"handle_qty\\\":10050,\\\"model_price\\\":66000,\\\"work_price\\\":35,\\\"shape_price\\\":110000,\\\"printer\\\":3,\\\"act\\\":1,\\\"total\\\":1971000}\",\"nilon\":\"{\\\"materal\\\":\\\"9\\\",\\\"face\\\":\\\"1\\\",\\\"machine\\\":\\\"8\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":50000,\\\"supp_qty\\\":10400,\\\"handle_qty\\\":10050,\\\"materal_price\\\":0.25,\\\"act\\\":1,\\\"total\\\":7475600}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":10400,\\\"handle_qty\\\":10050,\\\"cost\\\":2088400,\\\"act\\\":1,\\\"total\\\":2088400}\",\"float\":null,\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":131000}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"18863120\",\"product\":82,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:31:07\",\"updated_at\":\"2023-10-21 08:31:07\"}', 1, '2023-10-21 08:31:08', '2023-10-21 08:31:08');
INSERT INTO `n_log_actions` VALUES (546, 'papers', 'insert', 154, 1, 543, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024 ( T\\u00daI GI\\u1ea4Y )\",\"product_qty\":10000,\"nqty\":1,\"base_supp_qty\":10050,\"compent_percent\":\"250\",\"compent_plus\":0,\"supp_qty\":10300,\"size\":\"{\\\"materal\\\":\\\"13\\\",\\\"qttv\\\":\\\"250\\\",\\\"length\\\":\\\"57\\\",\\\"width\\\":\\\"102\\\",\\\"materal_price\\\":0.00195,\\\"supp_qty\\\":10300,\\\"act\\\":1,\\\"total\\\":29193547.5}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"4\\\",\\\"machine\\\":\\\"1\\\",\\\"note\\\":null,\\\"supp_qty\\\":9050,\\\"handle_qty\\\":10050,\\\"model_price\\\":123600,\\\"work_price\\\":80,\\\"shape_price\\\":220000,\\\"printer\\\":5,\\\"act\\\":1,\\\"total\\\":4270400}\",\"nilon\":\"{\\\"materal\\\":\\\"9\\\",\\\"face\\\":\\\"1\\\",\\\"machine\\\":\\\"8\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":50000,\\\"supp_qty\\\":10200,\\\"handle_qty\\\":10050,\\\"materal_price\\\":0.25,\\\"act\\\":1,\\\"total\\\":14875700}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":10200,\\\"handle_qty\\\":10050,\\\"cost\\\":2502100,\\\"act\\\":1,\\\"total\\\":2502100}\",\"float\":null,\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":131000}\",\"cut\":null,\"fold\":null,\"box_paste\":null,\"bag_paste\":\"{\\\"machine\\\":\\\"52\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":2000,\\\"shape_price\\\":100000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":21172100}\",\"ext_cate\":3,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"72144847.5\",\"product\":82,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:31:08\",\"updated_at\":\"2023-10-21 08:31:08\"}', 1, '2023-10-21 08:31:08', '2023-10-21 08:31:08');
INSERT INTO `n_log_actions` VALUES (547, 'papers', 'insert', 155, 1, 543, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024 ( T\\u1edc B\\u1ed2I TH\\u00c0NH )\",\"product_qty\":10000,\"nqty\":2,\"base_supp_qty\":5050,\"compent_percent\":\"150\",\"compent_plus\":200,\"supp_qty\":5400,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"120\\\",\\\"length\\\":\\\"65\\\",\\\"width\\\":\\\"80\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":5400,\\\"act\\\":1,\\\"total\\\":6739200}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"2\\\",\\\"machine\\\":\\\"2\\\",\\\"note\\\":null,\\\"supp_qty\\\":4050,\\\"handle_qty\\\":5050,\\\"model_price\\\":123600,\\\"work_price\\\":500,\\\"shape_price\\\":600000,\\\"printer\\\":11,\\\"act\\\":1,\\\"total\\\":5497200}\",\"nilon\":\"{\\\"act\\\":0}\",\"metalai\":\"{\\\"materal\\\":\\\"1\\\",\\\"face\\\":\\\"1\\\",\\\"cover_materal\\\":\\\"3\\\",\\\"cover_face\\\":\\\"1\\\",\\\"machine\\\":\\\"16\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5400,\\\"handle_qty\\\":5050,\\\"cover_supp_qty\\\":5400,\\\"materal_price\\\":0.36,\\\"metalai_price\\\":10208800,\\\"materal_cover_price\\\":0.08,\\\"metalai_cover_price\\\":2304800,\\\"act\\\":1,\\\"total\\\":12513600}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":5050,\\\"nqty\\\":2,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5300,\\\"handle_qty\\\":5050,\\\"cost\\\":1675000,\\\"act\\\":1,\\\"total\\\":1675000}\",\"float\":null,\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":131000}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"26556000\",\"product\":82,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:31:08\",\"updated_at\":\"2023-10-21 08:31:08\"}', 1, '2023-10-21 08:31:08', '2023-10-21 08:31:08');
INSERT INTO `n_log_actions` VALUES (548, 'supplies', 'insert', 152, 1, 543, '{\"name\":51,\"product_qty\":10000,\"nqty\":\"2\",\"base_supp_qty\":5000,\"compent_percent\":\"100\",\"compent_plus\":100,\"supp_qty\":5200,\"size\":\"{\\\"length\\\":\\\"52.5\\\",\\\"width\\\":\\\"91\\\",\\\"supply_type\\\":\\\"5\\\",\\\"supply_price\\\":\\\"129\\\",\\\"qttv_price\\\":2.465,\\\"supp_qty\\\":5200,\\\"act\\\":1,\\\"total\\\":61237994.99999999}\",\"cut\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"machine\\\":\\\"21\\\",\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5200,\\\"handle_qty\\\":5050,\\\"cost\\\":1596625,\\\"act\\\":1,\\\"total\\\":1596625}\",\"peel\":\"{\\\"machine\\\":\\\"39\\\",\\\"model_price\\\":0,\\\"work_price\\\":20,\\\"shape_price\\\":20000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":222000}\",\"mill\":\"{\\\"machine\\\":\\\"7\\\",\\\"model_price\\\":0,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"qty_pro\\\":10100,\\\"factor\\\":2,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":3130000}\",\"note\":null,\"handle_elevate\":null,\"type\":\"carton\",\"product\":82,\"total_cost\":\"66186620\",\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:31:08\",\"updated_at\":\"2023-10-21 08:31:08\"}', 1, '2023-10-21 08:31:08', '2023-10-21 08:31:08');
INSERT INTO `n_log_actions` VALUES (549, 'supplies', 'insert', 153, 1, 543, '{\"name\":51,\"product_qty\":10000,\"nqty\":\"2\",\"base_supp_qty\":5000,\"compent_percent\":\"100\",\"compent_plus\":100,\"supp_qty\":5200,\"size\":\"{\\\"length\\\":\\\"52.5\\\",\\\"width\\\":\\\"91\\\",\\\"supply_type\\\":\\\"5\\\",\\\"supply_price\\\":\\\"129\\\",\\\"qttv_price\\\":2.465,\\\"supp_qty\\\":5200,\\\"act\\\":1,\\\"total\\\":61237994.99999999}\",\"cut\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"machine\\\":\\\"21\\\",\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5200,\\\"handle_qty\\\":5050,\\\"cost\\\":1596625,\\\"act\\\":1,\\\"total\\\":1596625}\",\"peel\":\"{\\\"machine\\\":\\\"39\\\",\\\"model_price\\\":0,\\\"work_price\\\":20,\\\"shape_price\\\":20000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":222000}\",\"mill\":\"{\\\"machine\\\":\\\"7\\\",\\\"model_price\\\":0,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"qty_pro\\\":10100,\\\"factor\\\":2,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":3130000}\",\"note\":null,\"handle_elevate\":null,\"type\":\"carton\",\"product\":82,\"total_cost\":\"66186620\",\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:31:08\",\"updated_at\":\"2023-10-21 08:31:08\"}', 1, '2023-10-21 08:31:08', '2023-10-21 08:31:08');
INSERT INTO `n_log_actions` VALUES (550, 'supplies', 'insert', 154, 1, 543, '{\"name\":50,\"product_qty\":10000,\"nqty\":\"2\",\"base_supp_qty\":5000,\"compent_percent\":\"100\",\"compent_plus\":100,\"supp_qty\":5200,\"size\":\"{\\\"length\\\":\\\"48\\\",\\\"width\\\":\\\"77.5\\\",\\\"supply_type\\\":\\\"21\\\",\\\"supply_price\\\":\\\"121\\\",\\\"qttv_price\\\":1.925,\\\"supp_qty\\\":5200,\\\"act\\\":1,\\\"total\\\":37237200}\",\"cut\":\"{\\\"machine\\\":\\\"18\\\",\\\"model_price\\\":0,\\\"work_price\\\":80,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5200,\\\"handle_qty\\\":5050,\\\"act\\\":1,\\\"total\\\":516000}\",\"elevate\":\"{\\\"machine\\\":\\\"21\\\",\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5200,\\\"handle_qty\\\":5050,\\\"cost\\\":1438000,\\\"act\\\":1,\\\"total\\\":1438000}\",\"peel\":\"{\\\"act\\\":0}\",\"mill\":\"{\\\"machine\\\":\\\"7\\\",\\\"model_price\\\":0,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"qty_pro\\\":10100,\\\"factor\\\":2,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":3130000}\",\"note\":null,\"handle_elevate\":null,\"type\":\"carton\",\"product\":82,\"total_cost\":\"42321200\",\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:31:08\",\"updated_at\":\"2023-10-21 08:31:08\"}', 1, '2023-10-21 08:31:08', '2023-10-21 08:31:08');
INSERT INTO `n_log_actions` VALUES (551, 'fill_finishes', 'insert', 53, 1, 543, '{\"product_qty\":\"10000\",\"fill\":\"{\\\"stage\\\":[{\\\"length\\\":\\\"51\\\",\\\"width\\\":\\\"56\\\",\\\"materal\\\":\\\"16\\\",\\\"machine\\\":\\\"48\\\",\\\"qttv_price\\\":0.6,\\\"cost\\\":22436000,\\\"work_price\\\":500,\\\"shape_price\\\":300000},{\\\"length\\\":\\\"51\\\",\\\"width\\\":\\\"56\\\",\\\"materal\\\":\\\"18\\\",\\\"machine\\\":\\\"48\\\",\\\"qttv_price\\\":0.6,\\\"cost\\\":22436000,\\\"work_price\\\":500,\\\"shape_price\\\":300000},{\\\"length\\\":\\\"20\\\",\\\"width\\\":\\\"80\\\",\\\"materal\\\":\\\"19\\\",\\\"machine\\\":\\\"48\\\",\\\"qttv_price\\\":0.6,\\\"cost\\\":14900000,\\\"work_price\\\":500,\\\"shape_price\\\":300000},{\\\"length\\\":\\\"19\\\",\\\"width\\\":\\\"79\\\",\\\"materal\\\":\\\"19\\\",\\\"machine\\\":\\\"48\\\",\\\"qttv_price\\\":0.6,\\\"cost\\\":14306000,\\\"work_price\\\":500,\\\"shape_price\\\":300000}],\\\"ext_price\\\":\\\"0\\\",\\\"qty_pro\\\":10000,\\\"handle_qty\\\":10050,\\\"fill_cost\\\":74078000,\\\"act\\\":1,\\\"total\\\":74078000}\",\"finish\":\"{\\\"stage\\\":[{\\\"materal\\\":\\\"53\\\",\\\"qttv_price\\\":500,\\\"cost\\\":5000000},{\\\"materal\\\":\\\"58\\\",\\\"qttv_price\\\":150,\\\"cost\\\":1500000},{\\\"materal\\\":\\\"58\\\",\\\"qttv_price\\\":150,\\\"cost\\\":1500000},{\\\"materal\\\":\\\"58\\\",\\\"qttv_price\\\":150,\\\"cost\\\":1500000},{\\\"materal\\\":\\\"54\\\",\\\"qttv_price\\\":150,\\\"cost\\\":1500000},{\\\"materal\\\":\\\"68\\\",\\\"qttv_price\\\":300,\\\"cost\\\":3000000}],\\\"ext_price\\\":\\\"1000\\\",\\\"qty_pro\\\":10000,\\\"handle_qty\\\":10050,\\\"finish_cost\\\":14000000,\\\"act\\\":1,\\\"total\\\":24000000}\",\"magnet\":\"{\\\"type\\\":null,\\\"qty\\\":null,\\\"qttv_price\\\":0,\\\"magnet_perc\\\":1.05,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"note\":null,\"total_cost\":98078000,\"product\":82,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:31:08\",\"updated_at\":\"2023-10-21 08:31:08\"}', 1, '2023-10-21 08:31:08', '2023-10-21 08:31:08');
INSERT INTO `n_log_actions` VALUES (552, 'quotes', 'update_customer', 116, 1, 0, '{\"seri\":{\"old\":\"BG-000116\",\"new\":\"BG-000117\"}}', 1, '2023-10-21 08:31:11', '2023-10-21 08:31:11');
INSERT INTO `n_log_actions` VALUES (553, 'quotes', 'insert', 117, 1, 0, '{\"seri\":\"BG-000117\",\"status\":\"not_accepted\",\"name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"product_qty\":null,\"customer_id\":20,\"company_name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"contacter\":\"Mr Tu\\u1ea5n\",\"address\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"email\":\"kd1.intuandung@gmail.com\",\"phone\":\"0963303999\",\"telephone\":\"02438303888\",\"city\":null,\"profit\":\"0\",\"ship_price\":\"0\",\"total_cost\":\"389406447.5\",\"total_amount\":\"389406447.5\",\"note\":null,\"act\":1,\"src\":null,\"created_by\":1,\"created_at\":\"2023-10-21 08:39:17\",\"updated_at\":\"2023-10-21 08:39:17\"}', 1, '2023-10-21 08:39:17', '2023-10-21 08:39:17');
INSERT INTO `n_log_actions` VALUES (554, 'products', 'insert', 83, 1, 553, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024 ( S\\u1eeda metailai v\\u1ec1 2800\\u0111\\/m ) gi\\u00e1 b\\u1ed3i 8000k\",\"category\":1,\"product_style\":11,\"qty\":\"10000\",\"design\":1,\"length\":\"36\",\"width\":\"42\",\"height\":\"10\",\"quote_id\":117,\"total_cost\":\"389406447.5\",\"total_amount\":\"389406447.5\",\"custom_design_file\":null,\"sale_shape_file\":\"{\\\"id\\\":\\\"130\\\",\\\"dir\\\":\\\"storages\\/uploads\\\",\\\"path\\\":\\\"storage\\/app\\/public\\/uploads\\/1 T\\u00daI QU\\u00c0 T\\u1ebeT KT chu\\u1ea9n 2024 3 lo\\u1ea1i CHU\\u1ea8N NH\\u1ea4T 9999(7).cdr\\\",\\\"name\\\":\\\"1 T\\u00daI QU\\u00c0 T\\u1ebeT KT chu\\u1ea9n 2024 3 lo\\u1ea1i CHU\\u1ea8N NH\\u1ea4T 9999(7).cdr\\\"}\",\"tech_shape_file\":null,\"design_file\":null,\"design_shape_file\":null,\"handle_shape_file\":null,\"note\":null,\"act\":1,\"detail\":null,\"created_by\":1,\"created_at\":\"2023-10-21 08:39:17\",\"updated_at\":\"2023-10-21 08:39:17\"}', 1, '2023-10-21 08:39:17', '2023-10-21 08:39:17');
INSERT INTO `n_log_actions` VALUES (555, 'papers', 'insert', 158, 1, 554, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024\",\"product_qty\":10000,\"nqty\":1,\"base_supp_qty\":10050,\"compent_percent\":\"250\",\"compent_plus\":200,\"supp_qty\":10500,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"150\\\",\\\"length\\\":\\\"51\\\",\\\"width\\\":\\\"56\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":10500,\\\"act\\\":1,\\\"total\\\":8996400}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"4\\\",\\\"machine\\\":\\\"1\\\",\\\"note\\\":null,\\\"supp_qty\\\":9050,\\\"handle_qty\\\":10050,\\\"model_price\\\":66000,\\\"work_price\\\":35,\\\"shape_price\\\":110000,\\\"printer\\\":3,\\\"act\\\":1,\\\"total\\\":1971000}\",\"nilon\":\"{\\\"materal\\\":\\\"9\\\",\\\"face\\\":\\\"1\\\",\\\"machine\\\":\\\"8\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":50000,\\\"supp_qty\\\":10400,\\\"handle_qty\\\":10050,\\\"materal_price\\\":0.25,\\\"act\\\":1,\\\"total\\\":7475600}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"1000\\\",\\\"shape_price\\\":\\\"200000\\\",\\\"machine\\\":\\\"2\\\",\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"nqty\\\":1,\\\"act\\\":1,\\\"total\\\":10300000}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":10400,\\\"handle_qty\\\":10050,\\\"cost\\\":2088400,\\\"act\\\":1,\\\"total\\\":2088400}\",\"float\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":131000}\",\"cut\":null,\"fold\":null,\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":1,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"30962400\",\"product\":83,\"note\":null,\"main\":1,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:39:17\",\"updated_at\":\"2023-10-21 08:39:17\"}', 1, '2023-10-21 08:39:17', '2023-10-21 08:39:17');
INSERT INTO `n_log_actions` VALUES (556, 'papers', 'insert', 159, 1, 554, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024 ( T\\u1edc B\\u1ed2I \\u0110\\u00c1Y H\\u1ed8P )\",\"product_qty\":10000,\"nqty\":1,\"base_supp_qty\":10050,\"compent_percent\":\"250\",\"compent_plus\":200,\"supp_qty\":10500,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"120\\\",\\\"length\\\":\\\"51\\\",\\\"width\\\":\\\"56\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":10500,\\\"act\\\":1,\\\"total\\\":7197120}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"4\\\",\\\"machine\\\":\\\"1\\\",\\\"note\\\":null,\\\"supp_qty\\\":9050,\\\"handle_qty\\\":10050,\\\"model_price\\\":66000,\\\"work_price\\\":35,\\\"shape_price\\\":110000,\\\"printer\\\":3,\\\"act\\\":1,\\\"total\\\":1971000}\",\"nilon\":\"{\\\"materal\\\":\\\"9\\\",\\\"face\\\":\\\"1\\\",\\\"machine\\\":\\\"8\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":50000,\\\"supp_qty\\\":10400,\\\"handle_qty\\\":10050,\\\"materal_price\\\":0.25,\\\"act\\\":1,\\\"total\\\":7475600}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":10400,\\\"handle_qty\\\":10050,\\\"cost\\\":2088400,\\\"act\\\":1,\\\"total\\\":2088400}\",\"float\":null,\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":131000}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"18863120\",\"product\":83,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:39:17\",\"updated_at\":\"2023-10-21 08:39:17\"}', 1, '2023-10-21 08:39:17', '2023-10-21 08:39:17');
INSERT INTO `n_log_actions` VALUES (557, 'papers', 'insert', 160, 1, 554, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024 ( T\\u00daI GI\\u1ea4Y )\",\"product_qty\":10000,\"nqty\":1,\"base_supp_qty\":10050,\"compent_percent\":\"250\",\"compent_plus\":0,\"supp_qty\":10300,\"size\":\"{\\\"materal\\\":\\\"13\\\",\\\"qttv\\\":\\\"250\\\",\\\"length\\\":\\\"57\\\",\\\"width\\\":\\\"102\\\",\\\"materal_price\\\":0.00195,\\\"supp_qty\\\":10300,\\\"act\\\":1,\\\"total\\\":29193547.5}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"4\\\",\\\"machine\\\":\\\"1\\\",\\\"note\\\":null,\\\"supp_qty\\\":9050,\\\"handle_qty\\\":10050,\\\"model_price\\\":123600,\\\"work_price\\\":80,\\\"shape_price\\\":220000,\\\"printer\\\":5,\\\"act\\\":1,\\\"total\\\":4270400}\",\"nilon\":\"{\\\"materal\\\":\\\"9\\\",\\\"face\\\":\\\"1\\\",\\\"machine\\\":\\\"8\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":50000,\\\"supp_qty\\\":10200,\\\"handle_qty\\\":10050,\\\"materal_price\\\":0.25,\\\"act\\\":1,\\\"total\\\":14875700}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":10200,\\\"handle_qty\\\":10050,\\\"cost\\\":2502100,\\\"act\\\":1,\\\"total\\\":2502100}\",\"float\":null,\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":131000}\",\"cut\":null,\"fold\":null,\"box_paste\":null,\"bag_paste\":\"{\\\"machine\\\":\\\"52\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":2000,\\\"shape_price\\\":100000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":21172100}\",\"ext_cate\":3,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"72144847.5\",\"product\":83,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:39:17\",\"updated_at\":\"2023-10-21 08:39:17\"}', 1, '2023-10-21 08:39:17', '2023-10-21 08:39:17');
INSERT INTO `n_log_actions` VALUES (558, 'papers', 'insert', 161, 1, 554, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024 ( T\\u1edc B\\u1ed2I TH\\u00c0NH )\",\"product_qty\":10000,\"nqty\":2,\"base_supp_qty\":5050,\"compent_percent\":\"150\",\"compent_plus\":200,\"supp_qty\":5400,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"120\\\",\\\"length\\\":\\\"65\\\",\\\"width\\\":\\\"80\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":5400,\\\"act\\\":1,\\\"total\\\":6739200}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"2\\\",\\\"machine\\\":\\\"1\\\",\\\"note\\\":null,\\\"supp_qty\\\":4050,\\\"handle_qty\\\":5050,\\\"model_price\\\":123600,\\\"work_price\\\":80,\\\"shape_price\\\":220000,\\\"printer\\\":5,\\\"act\\\":1,\\\"total\\\":1335200}\",\"nilon\":\"{\\\"act\\\":0}\",\"metalai\":\"{\\\"materal\\\":\\\"1\\\",\\\"face\\\":\\\"1\\\",\\\"cover_materal\\\":\\\"3\\\",\\\"cover_face\\\":\\\"1\\\",\\\"machine\\\":\\\"16\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5400,\\\"handle_qty\\\":5050,\\\"cover_supp_qty\\\":5400,\\\"materal_price\\\":0.28,\\\"metalai_price\\\":7962400.000000001,\\\"materal_cover_price\\\":0.08,\\\"metalai_cover_price\\\":2304800,\\\"act\\\":1,\\\"total\\\":10267200}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":5050,\\\"nqty\\\":2,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5300,\\\"handle_qty\\\":5050,\\\"cost\\\":1675000,\\\"act\\\":1,\\\"total\\\":1675000}\",\"float\":null,\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":131000}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"20147600\",\"product\":83,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:39:18\",\"updated_at\":\"2023-10-21 08:39:18\"}', 1, '2023-10-21 08:39:18', '2023-10-21 08:39:18');
INSERT INTO `n_log_actions` VALUES (559, 'papers', 'insert', 162, 1, 554, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024 ( S\\u1eeda metailai v\\u1ec1 2800\\u0111\\/m ) gi\\u00e1 b\\u1ed3i 8000k ( T\\u1edc B\\u1ed2I M\\u1eb6T TH\\u00c9P )\",\"product_qty\":10000,\"nqty\":1,\"base_supp_qty\":10050,\"compent_percent\":\"250\",\"compent_plus\":0,\"supp_qty\":10300,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"120\\\",\\\"length\\\":\\\"45\\\",\\\"width\\\":\\\"51\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":10300,\\\"act\\\":1,\\\"total\\\":5673240}\",\"print\":\"{\\\"type\\\":\\\"0\\\",\\\"color\\\":\\\"4\\\",\\\"machine\\\":\\\"0\\\",\\\"note\\\":null,\\\"supp_qty\\\":9050,\\\"handle_qty\\\":10050,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":0,\\\"printer\\\":0,\\\"act\\\":0,\\\"total\\\":0}\",\"nilon\":\"{\\\"act\\\":0}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"act\\\":0}\",\"float\":null,\"peel\":\"{\\\"act\\\":0}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"5673240\",\"product\":83,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:39:18\",\"updated_at\":\"2023-10-21 08:39:18\"}', 1, '2023-10-21 08:39:18', '2023-10-21 08:39:18');
INSERT INTO `n_log_actions` VALUES (560, 'papers', 'insert', 163, 1, 554, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024 ( S\\u1eeda metailai v\\u1ec1 2800\\u0111\\/m ) gi\\u00e1 b\\u1ed3i 8000k ( T\\u1edc B\\u1ed2I M\\u1eb6T TH\\u00c9P )\",\"product_qty\":10000,\"nqty\":1,\"base_supp_qty\":10050,\"compent_percent\":\"250\",\"compent_plus\":0,\"supp_qty\":10300,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"120\\\",\\\"length\\\":\\\"45\\\",\\\"width\\\":\\\"51\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":10300,\\\"act\\\":1,\\\"total\\\":5673240}\",\"print\":\"{\\\"type\\\":\\\"0\\\",\\\"color\\\":\\\"4\\\",\\\"machine\\\":\\\"0\\\",\\\"note\\\":null,\\\"supp_qty\\\":9050,\\\"handle_qty\\\":10050,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":0,\\\"printer\\\":0,\\\"act\\\":0,\\\"total\\\":0}\",\"nilon\":\"{\\\"act\\\":0}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"act\\\":0}\",\"float\":null,\"peel\":\"{\\\"act\\\":0}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"5673240\",\"product\":83,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:39:18\",\"updated_at\":\"2023-10-21 08:39:18\"}', 1, '2023-10-21 08:39:18', '2023-10-21 08:39:18');
INSERT INTO `n_log_actions` VALUES (561, 'supplies', 'insert', 155, 1, 554, '{\"name\":51,\"product_qty\":10000,\"nqty\":\"2\",\"base_supp_qty\":5000,\"compent_percent\":\"100\",\"compent_plus\":100,\"supp_qty\":5200,\"size\":\"{\\\"length\\\":\\\"52.5\\\",\\\"width\\\":\\\"91\\\",\\\"supply_type\\\":\\\"21\\\",\\\"supply_price\\\":\\\"121\\\",\\\"qttv_price\\\":1.925,\\\"supp_qty\\\":5200,\\\"act\\\":1,\\\"total\\\":47822775}\",\"cut\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"machine\\\":\\\"21\\\",\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5200,\\\"handle_qty\\\":5050,\\\"cost\\\":1596625,\\\"act\\\":1,\\\"total\\\":1596625}\",\"peel\":\"{\\\"machine\\\":\\\"39\\\",\\\"model_price\\\":0,\\\"work_price\\\":20,\\\"shape_price\\\":20000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":222000}\",\"mill\":\"{\\\"machine\\\":\\\"7\\\",\\\"model_price\\\":0,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"qty_pro\\\":10100,\\\"factor\\\":2,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":3130000}\",\"note\":null,\"handle_elevate\":null,\"type\":\"carton\",\"product\":83,\"total_cost\":\"52771400\",\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:39:18\",\"updated_at\":\"2023-10-21 08:39:18\"}', 1, '2023-10-21 08:39:18', '2023-10-21 08:39:18');
INSERT INTO `n_log_actions` VALUES (562, 'supplies', 'insert', 156, 1, 554, '{\"name\":52,\"product_qty\":10000,\"nqty\":\"2\",\"base_supp_qty\":5000,\"compent_percent\":\"100\",\"compent_plus\":100,\"supp_qty\":5200,\"size\":\"{\\\"length\\\":\\\"52.5\\\",\\\"width\\\":\\\"91\\\",\\\"supply_type\\\":\\\"21\\\",\\\"supply_price\\\":\\\"121\\\",\\\"qttv_price\\\":1.925,\\\"supp_qty\\\":5200,\\\"act\\\":1,\\\"total\\\":47822775}\",\"cut\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"machine\\\":\\\"21\\\",\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5200,\\\"handle_qty\\\":5050,\\\"cost\\\":1596625,\\\"act\\\":1,\\\"total\\\":1596625}\",\"peel\":\"{\\\"machine\\\":\\\"39\\\",\\\"model_price\\\":0,\\\"work_price\\\":20,\\\"shape_price\\\":20000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":222000}\",\"mill\":\"{\\\"machine\\\":\\\"7\\\",\\\"model_price\\\":0,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"qty_pro\\\":10100,\\\"factor\\\":2,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":3130000}\",\"note\":null,\"handle_elevate\":null,\"type\":\"carton\",\"product\":83,\"total_cost\":\"52771400\",\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:39:18\",\"updated_at\":\"2023-10-21 08:39:18\"}', 1, '2023-10-21 08:39:18', '2023-10-21 08:39:18');
INSERT INTO `n_log_actions` VALUES (563, 'supplies', 'insert', 157, 1, 554, '{\"name\":50,\"product_qty\":10000,\"nqty\":\"2\",\"base_supp_qty\":5000,\"compent_percent\":\"100\",\"compent_plus\":100,\"supp_qty\":5200,\"size\":\"{\\\"length\\\":\\\"48\\\",\\\"width\\\":\\\"77.5\\\",\\\"supply_type\\\":\\\"21\\\",\\\"supply_price\\\":\\\"121\\\",\\\"qttv_price\\\":1.925,\\\"supp_qty\\\":5200,\\\"act\\\":1,\\\"total\\\":37237200}\",\"cut\":\"{\\\"machine\\\":\\\"18\\\",\\\"model_price\\\":0,\\\"work_price\\\":80,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5200,\\\"handle_qty\\\":5050,\\\"act\\\":1,\\\"total\\\":516000}\",\"elevate\":\"{\\\"machine\\\":\\\"21\\\",\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5200,\\\"handle_qty\\\":5050,\\\"cost\\\":1438000,\\\"act\\\":1,\\\"total\\\":1438000}\",\"peel\":\"{\\\"act\\\":0}\",\"mill\":\"{\\\"machine\\\":\\\"7\\\",\\\"model_price\\\":0,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"qty_pro\\\":10100,\\\"factor\\\":2,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":3130000}\",\"note\":null,\"handle_elevate\":null,\"type\":\"carton\",\"product\":83,\"total_cost\":\"42321200\",\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:39:18\",\"updated_at\":\"2023-10-21 08:39:18\"}', 1, '2023-10-21 08:39:18', '2023-10-21 08:39:18');
INSERT INTO `n_log_actions` VALUES (564, 'fill_finishes', 'insert', 54, 1, 554, '{\"product_qty\":\"10000\",\"fill\":\"{\\\"stage\\\":[{\\\"length\\\":\\\"51\\\",\\\"width\\\":\\\"56\\\",\\\"materal\\\":\\\"16\\\",\\\"machine\\\":\\\"48\\\",\\\"qttv_price\\\":0.6,\\\"cost\\\":22436000,\\\"work_price\\\":500,\\\"shape_price\\\":300000},{\\\"length\\\":\\\"51\\\",\\\"width\\\":\\\"56\\\",\\\"materal\\\":\\\"18\\\",\\\"machine\\\":\\\"48\\\",\\\"qttv_price\\\":0.6,\\\"cost\\\":22436000,\\\"work_price\\\":500,\\\"shape_price\\\":300000},{\\\"length\\\":\\\"20\\\",\\\"width\\\":\\\"80\\\",\\\"materal\\\":\\\"19\\\",\\\"machine\\\":\\\"48\\\",\\\"qttv_price\\\":0.6,\\\"cost\\\":14900000,\\\"work_price\\\":500,\\\"shape_price\\\":300000},{\\\"length\\\":\\\"19\\\",\\\"width\\\":\\\"79\\\",\\\"materal\\\":\\\"19\\\",\\\"machine\\\":\\\"48\\\",\\\"qttv_price\\\":0.6,\\\"cost\\\":14306000,\\\"work_price\\\":500,\\\"shape_price\\\":300000}],\\\"ext_price\\\":\\\"0\\\",\\\"qty_pro\\\":10000,\\\"handle_qty\\\":10050,\\\"fill_cost\\\":74078000,\\\"act\\\":1,\\\"total\\\":74078000}\",\"finish\":\"{\\\"stage\\\":[{\\\"materal\\\":\\\"53\\\",\\\"qttv_price\\\":500,\\\"cost\\\":5000000},{\\\"materal\\\":\\\"58\\\",\\\"qttv_price\\\":150,\\\"cost\\\":1500000},{\\\"materal\\\":\\\"58\\\",\\\"qttv_price\\\":150,\\\"cost\\\":1500000},{\\\"materal\\\":\\\"58\\\",\\\"qttv_price\\\":150,\\\"cost\\\":1500000},{\\\"materal\\\":\\\"54\\\",\\\"qttv_price\\\":150,\\\"cost\\\":1500000},{\\\"materal\\\":\\\"68\\\",\\\"qttv_price\\\":300,\\\"cost\\\":3000000}],\\\"ext_price\\\":\\\"0\\\",\\\"qty_pro\\\":10000,\\\"handle_qty\\\":10050,\\\"finish_cost\\\":14000000,\\\"act\\\":1,\\\"total\\\":14000000}\",\"magnet\":\"{\\\"type\\\":null,\\\"qty\\\":null,\\\"qttv_price\\\":0,\\\"magnet_perc\\\":1.05,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"note\":null,\"total_cost\":88078000,\"product\":83,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:39:18\",\"updated_at\":\"2023-10-21 08:39:18\"}', 1, '2023-10-21 08:39:18', '2023-10-21 08:39:18');
INSERT INTO `n_log_actions` VALUES (565, 'quotes', 'update_customer', 117, 1, 0, '{\"seri\":{\"old\":\"BG-000117\",\"new\":\"BG-000118\"}}', 1, '2023-10-21 08:39:21', '2023-10-21 08:39:21');
INSERT INTO `n_log_actions` VALUES (566, 'quotes', 'update_customer', 116, 1, 0, '{\"seri\":{\"old\":\"BG-000117\",\"new\":\"BG-000118\"}}', 1, '2023-10-21 08:44:53', '2023-10-21 08:44:53');
INSERT INTO `n_log_actions` VALUES (567, 'quotes', 'insert', 118, 1, 0, '{\"seri\":\"BG-000118\",\"status\":\"not_accepted\",\"name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"product_qty\":null,\"customer_id\":20,\"company_name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"contacter\":\"Mr Tu\\u1ea5n\",\"address\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"email\":\"kd1.intuandung@gmail.com\",\"phone\":\"0963303999\",\"telephone\":\"02438303888\",\"city\":null,\"profit\":\"0\",\"ship_price\":\"0\",\"total_cost\":\"403826147.5\",\"total_amount\":\"403826147.5\",\"note\":null,\"act\":1,\"src\":null,\"created_by\":1,\"created_at\":\"2023-10-21 08:49:37\",\"updated_at\":\"2023-10-21 08:49:37\"}', 1, '2023-10-21 08:49:37', '2023-10-21 08:49:37');
INSERT INTO `n_log_actions` VALUES (568, 'products', 'insert', 84, 1, 567, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 B HQT 2024 ( S\\u1eeda metailai v\\u1ec1 2800\\u0111\\/m )\",\"category\":1,\"product_style\":11,\"qty\":\"10000\",\"design\":1,\"length\":\"36\",\"width\":\"36\",\"height\":\"10\",\"quote_id\":118,\"total_cost\":\"403826147.5\",\"total_amount\":\"403826147.5\",\"custom_design_file\":null,\"sale_shape_file\":\"{\\\"id\\\":\\\"130\\\",\\\"dir\\\":\\\"storages\\/uploads\\\",\\\"path\\\":\\\"storage\\/app\\/public\\/uploads\\/1 T\\u00daI QU\\u00c0 T\\u1ebeT KT chu\\u1ea9n 2024 3 lo\\u1ea1i CHU\\u1ea8N NH\\u1ea4T 9999(7).cdr\\\",\\\"name\\\":\\\"1 T\\u00daI QU\\u00c0 T\\u1ebeT KT chu\\u1ea9n 2024 3 lo\\u1ea1i CHU\\u1ea8N NH\\u1ea4T 9999(7).cdr\\\"}\",\"tech_shape_file\":null,\"design_file\":null,\"design_shape_file\":null,\"handle_shape_file\":null,\"note\":null,\"act\":1,\"detail\":null,\"created_by\":1,\"created_at\":\"2023-10-21 08:49:37\",\"updated_at\":\"2023-10-21 08:49:37\"}', 1, '2023-10-21 08:49:37', '2023-10-21 08:49:37');
INSERT INTO `n_log_actions` VALUES (569, 'papers', 'insert', 164, 1, 568, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024\",\"product_qty\":10000,\"nqty\":1,\"base_supp_qty\":10050,\"compent_percent\":\"250\",\"compent_plus\":200,\"supp_qty\":10500,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"150\\\",\\\"length\\\":\\\"51\\\",\\\"width\\\":\\\"51\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":10500,\\\"act\\\":1,\\\"total\\\":8193150}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"4\\\",\\\"machine\\\":\\\"1\\\",\\\"note\\\":null,\\\"supp_qty\\\":9050,\\\"handle_qty\\\":10050,\\\"model_price\\\":66000,\\\"work_price\\\":35,\\\"shape_price\\\":110000,\\\"printer\\\":3,\\\"act\\\":1,\\\"total\\\":1971000}\",\"nilon\":\"{\\\"materal\\\":\\\"9\\\",\\\"face\\\":\\\"1\\\",\\\"machine\\\":\\\"8\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":50000,\\\"supp_qty\\\":10400,\\\"handle_qty\\\":10050,\\\"materal_price\\\":0.25,\\\"act\\\":1,\\\"total\\\":6812600}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"1000\\\",\\\"shape_price\\\":\\\"200000\\\",\\\"machine\\\":\\\"2\\\",\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"nqty\\\":1,\\\"act\\\":1,\\\"total\\\":10300000}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":10400,\\\"handle_qty\\\":10050,\\\"cost\\\":2050150,\\\"act\\\":1,\\\"total\\\":2050150}\",\"float\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":131000}\",\"cut\":null,\"fold\":null,\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":1,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"4600\\\",\\\"note\\\":\\\"4600\\\\u0110 g\\\\u1ed3m c\\\\u00e1c ph\\\\u1ee5 ki\\\\u1ec7n V\\\\u00c1CH + C\\\\u1ed4 CHAI + \\\\u0110\\\\u00cdT CHAI\\\",\\\"qty_pro\\\":10000,\\\"act\\\":1,\\\"total\\\":46000000}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"75457900\",\"product\":84,\"note\":null,\"main\":1,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:49:37\",\"updated_at\":\"2023-10-21 08:49:37\"}', 1, '2023-10-21 08:49:37', '2023-10-21 08:49:37');
INSERT INTO `n_log_actions` VALUES (570, 'papers', 'insert', 165, 1, 568, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024 ( T\\u1edc B\\u1ed2I \\u0110\\u00c1Y H\\u1ed8P )\",\"product_qty\":10000,\"nqty\":1,\"base_supp_qty\":10050,\"compent_percent\":\"250\",\"compent_plus\":200,\"supp_qty\":10500,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"120\\\",\\\"length\\\":\\\"51\\\",\\\"width\\\":\\\"51\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":10500,\\\"act\\\":1,\\\"total\\\":6554520}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"4\\\",\\\"machine\\\":\\\"1\\\",\\\"note\\\":null,\\\"supp_qty\\\":9050,\\\"handle_qty\\\":10050,\\\"model_price\\\":66000,\\\"work_price\\\":35,\\\"shape_price\\\":110000,\\\"printer\\\":3,\\\"act\\\":1,\\\"total\\\":1971000}\",\"nilon\":\"{\\\"materal\\\":\\\"9\\\",\\\"face\\\":\\\"1\\\",\\\"machine\\\":\\\"8\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":50000,\\\"supp_qty\\\":10400,\\\"handle_qty\\\":10050,\\\"materal_price\\\":0.25,\\\"act\\\":1,\\\"total\\\":6812600}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":10400,\\\"handle_qty\\\":10050,\\\"cost\\\":2050150,\\\"act\\\":1,\\\"total\\\":2050150}\",\"float\":null,\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":131000}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"17519270\",\"product\":84,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:49:37\",\"updated_at\":\"2023-10-21 08:49:37\"}', 1, '2023-10-21 08:49:37', '2023-10-21 08:49:37');
INSERT INTO `n_log_actions` VALUES (571, 'papers', 'insert', 166, 1, 568, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024 ( T\\u00daI GI\\u1ea4Y )\",\"product_qty\":10000,\"nqty\":1,\"base_supp_qty\":10050,\"compent_percent\":\"250\",\"compent_plus\":0,\"supp_qty\":10300,\"size\":\"{\\\"materal\\\":\\\"13\\\",\\\"qttv\\\":\\\"250\\\",\\\"length\\\":\\\"51\\\",\\\"width\\\":\\\"102\\\",\\\"materal_price\\\":0.00195,\\\"supp_qty\\\":10300,\\\"act\\\":1,\\\"total\\\":26120542.5}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"4\\\",\\\"machine\\\":\\\"1\\\",\\\"note\\\":null,\\\"supp_qty\\\":9050,\\\"handle_qty\\\":10050,\\\"model_price\\\":123600,\\\"work_price\\\":80,\\\"shape_price\\\":220000,\\\"printer\\\":5,\\\"act\\\":1,\\\"total\\\":4270400}\",\"nilon\":\"{\\\"materal\\\":\\\"9\\\",\\\"face\\\":\\\"1\\\",\\\"machine\\\":\\\"8\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":50000,\\\"supp_qty\\\":10200,\\\"handle_qty\\\":10050,\\\"materal_price\\\":0.25,\\\"act\\\":1,\\\"total\\\":13315100}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":10200,\\\"handle_qty\\\":10050,\\\"cost\\\":2410300,\\\"act\\\":1,\\\"total\\\":2410300}\",\"float\":null,\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":131000}\",\"cut\":null,\"fold\":null,\"box_paste\":null,\"bag_paste\":\"{\\\"machine\\\":\\\"52\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":2000,\\\"shape_price\\\":100000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":21080300}\",\"ext_cate\":3,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"67327642.5\",\"product\":84,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:49:37\",\"updated_at\":\"2023-10-21 08:49:37\"}', 1, '2023-10-21 08:49:37', '2023-10-21 08:49:37');
INSERT INTO `n_log_actions` VALUES (572, 'papers', 'insert', 167, 1, 568, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024 ( T\\u1edc B\\u1ed2I TH\\u00c0NH )\",\"product_qty\":10000,\"nqty\":2,\"base_supp_qty\":5050,\"compent_percent\":\"150\",\"compent_plus\":200,\"supp_qty\":5400,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"120\\\",\\\"length\\\":\\\"65\\\",\\\"width\\\":\\\"74.5\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":5400,\\\"act\\\":1,\\\"total\\\":6275880}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"2\\\",\\\"machine\\\":\\\"1\\\",\\\"note\\\":null,\\\"supp_qty\\\":4050,\\\"handle_qty\\\":5050,\\\"model_price\\\":123600,\\\"work_price\\\":80,\\\"shape_price\\\":220000,\\\"printer\\\":5,\\\"act\\\":1,\\\"total\\\":1335200}\",\"nilon\":\"{\\\"act\\\":0}\",\"metalai\":\"{\\\"materal\\\":\\\"1\\\",\\\"face\\\":\\\"1\\\",\\\"cover_materal\\\":\\\"3\\\",\\\"cover_face\\\":\\\"1\\\",\\\"machine\\\":\\\"16\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5400,\\\"handle_qty\\\":5050,\\\"cover_supp_qty\\\":5400,\\\"materal_price\\\":0.28,\\\"metalai_price\\\":7421860.000000001,\\\"materal_cover_price\\\":0.08,\\\"metalai_cover_price\\\":2153220,\\\"act\\\":1,\\\"total\\\":9575080}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":5050,\\\"nqty\\\":2,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5300,\\\"handle_qty\\\":5050,\\\"cost\\\":1621375,\\\"act\\\":1,\\\"total\\\":1621375}\",\"float\":null,\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":131000}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"18938535\",\"product\":84,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:49:37\",\"updated_at\":\"2023-10-21 08:49:37\"}', 1, '2023-10-21 08:49:37', '2023-10-21 08:49:37');
INSERT INTO `n_log_actions` VALUES (573, 'papers', 'insert', 168, 1, 568, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024 ( S\\u1eeda metailai v\\u1ec1 2800\\u0111\\/m ) gi\\u00e1 b\\u1ed3i 8000k ( T\\u1edc B\\u1ed2I M\\u1eb6T TH\\u00c9P )\",\"product_qty\":10000,\"nqty\":1,\"base_supp_qty\":10050,\"compent_percent\":\"250\",\"compent_plus\":0,\"supp_qty\":10300,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"120\\\",\\\"length\\\":\\\"45\\\",\\\"width\\\":\\\"45\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":10300,\\\"act\\\":1,\\\"total\\\":5005800}\",\"print\":\"{\\\"type\\\":\\\"0\\\",\\\"color\\\":\\\"4\\\",\\\"machine\\\":\\\"0\\\",\\\"note\\\":null,\\\"supp_qty\\\":9050,\\\"handle_qty\\\":10050,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":0,\\\"printer\\\":0,\\\"act\\\":0,\\\"total\\\":0}\",\"nilon\":\"{\\\"act\\\":0}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"act\\\":0}\",\"float\":null,\"peel\":\"{\\\"act\\\":0}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"5005800\",\"product\":84,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:49:37\",\"updated_at\":\"2023-10-21 08:49:37\"}', 1, '2023-10-21 08:49:37', '2023-10-21 08:49:37');
INSERT INTO `n_log_actions` VALUES (574, 'papers', 'insert', 169, 1, 568, '{\"name\":\"T\\u00ednh gi\\u00e1 M\\u00e3 A HQT 2024 ( S\\u1eeda metailai v\\u1ec1 2800\\u0111\\/m ) gi\\u00e1 b\\u1ed3i 8000k ( T\\u1edc B\\u1ed2I M\\u1eb6T TH\\u00c9P )\",\"product_qty\":10000,\"nqty\":1,\"base_supp_qty\":10050,\"compent_percent\":\"250\",\"compent_plus\":0,\"supp_qty\":10300,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"120\\\",\\\"length\\\":\\\"45\\\",\\\"width\\\":\\\"45\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":10300,\\\"act\\\":1,\\\"total\\\":5005800}\",\"print\":\"{\\\"type\\\":\\\"0\\\",\\\"color\\\":\\\"4\\\",\\\"machine\\\":\\\"0\\\",\\\"note\\\":null,\\\"supp_qty\\\":9050,\\\"handle_qty\\\":10050,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":0,\\\"printer\\\":0,\\\"act\\\":0,\\\"total\\\":0}\",\"nilon\":\"{\\\"act\\\":0}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"act\\\":0}\",\"float\":null,\"peel\":\"{\\\"act\\\":0}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"5005800\",\"product\":84,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:49:37\",\"updated_at\":\"2023-10-21 08:49:37\"}', 1, '2023-10-21 08:49:37', '2023-10-21 08:49:37');
INSERT INTO `n_log_actions` VALUES (575, 'supplies', 'insert', 158, 1, 568, '{\"name\":51,\"product_qty\":10000,\"nqty\":\"2\",\"base_supp_qty\":5000,\"compent_percent\":\"100\",\"compent_plus\":100,\"supp_qty\":5200,\"size\":\"{\\\"length\\\":\\\"46.5\\\",\\\"width\\\":\\\"91\\\",\\\"supply_type\\\":\\\"21\\\",\\\"supply_price\\\":\\\"121\\\",\\\"qttv_price\\\":1.925,\\\"supp_qty\\\":5200,\\\"act\\\":1,\\\"total\\\":42357315}\",\"cut\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"machine\\\":\\\"21\\\",\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5200,\\\"handle_qty\\\":5050,\\\"cost\\\":1514725,\\\"act\\\":1,\\\"total\\\":1514725}\",\"peel\":\"{\\\"machine\\\":\\\"39\\\",\\\"model_price\\\":0,\\\"work_price\\\":20,\\\"shape_price\\\":20000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":222000}\",\"mill\":\"{\\\"machine\\\":\\\"7\\\",\\\"model_price\\\":0,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"qty_pro\\\":10100,\\\"factor\\\":2,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":3130000}\",\"note\":null,\"handle_elevate\":null,\"type\":\"carton\",\"product\":84,\"total_cost\":\"47224040\",\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:49:37\",\"updated_at\":\"2023-10-21 08:49:37\"}', 1, '2023-10-21 08:49:37', '2023-10-21 08:49:37');
INSERT INTO `n_log_actions` VALUES (576, 'supplies', 'insert', 159, 1, 568, '{\"name\":52,\"product_qty\":10000,\"nqty\":\"2\",\"base_supp_qty\":5000,\"compent_percent\":\"100\",\"compent_plus\":100,\"supp_qty\":5200,\"size\":\"{\\\"length\\\":\\\"46.5\\\",\\\"width\\\":\\\"91\\\",\\\"supply_type\\\":\\\"21\\\",\\\"supply_price\\\":\\\"121\\\",\\\"qttv_price\\\":1.925,\\\"supp_qty\\\":5200,\\\"act\\\":1,\\\"total\\\":42357315}\",\"cut\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"machine\\\":\\\"21\\\",\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5200,\\\"handle_qty\\\":5050,\\\"cost\\\":1514725,\\\"act\\\":1,\\\"total\\\":1514725}\",\"peel\":\"{\\\"machine\\\":\\\"39\\\",\\\"model_price\\\":0,\\\"work_price\\\":20,\\\"shape_price\\\":20000,\\\"qty_pro\\\":10100,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":222000}\",\"mill\":\"{\\\"machine\\\":\\\"7\\\",\\\"model_price\\\":0,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"qty_pro\\\":10100,\\\"factor\\\":2,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":3130000}\",\"note\":null,\"handle_elevate\":null,\"type\":\"carton\",\"product\":84,\"total_cost\":\"47224040\",\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:49:37\",\"updated_at\":\"2023-10-21 08:49:37\"}', 1, '2023-10-21 08:49:37', '2023-10-21 08:49:37');
INSERT INTO `n_log_actions` VALUES (577, 'supplies', 'insert', 160, 1, 568, '{\"name\":50,\"product_qty\":10000,\"nqty\":\"2\",\"base_supp_qty\":5000,\"compent_percent\":\"100\",\"compent_plus\":100,\"supp_qty\":5200,\"size\":\"{\\\"length\\\":\\\"48\\\",\\\"width\\\":\\\"71.5\\\",\\\"supply_type\\\":\\\"21\\\",\\\"supply_price\\\":\\\"121\\\",\\\"qttv_price\\\":1.925,\\\"supp_qty\\\":5200,\\\"act\\\":1,\\\"total\\\":34354320}\",\"cut\":\"{\\\"machine\\\":\\\"18\\\",\\\"model_price\\\":0,\\\"work_price\\\":80,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5200,\\\"handle_qty\\\":5050,\\\"act\\\":1,\\\"total\\\":516000}\",\"elevate\":\"{\\\"machine\\\":\\\"21\\\",\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":5200,\\\"handle_qty\\\":5050,\\\"cost\\\":1394800,\\\"act\\\":1,\\\"total\\\":1394800}\",\"peel\":\"{\\\"act\\\":0}\",\"mill\":\"{\\\"machine\\\":\\\"7\\\",\\\"model_price\\\":0,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"qty_pro\\\":10100,\\\"factor\\\":2,\\\"handle_qty\\\":10050,\\\"act\\\":1,\\\"total\\\":3130000}\",\"note\":null,\"handle_elevate\":null,\"type\":\"carton\",\"product\":84,\"total_cost\":\"39395120\",\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:49:37\",\"updated_at\":\"2023-10-21 08:49:37\"}', 1, '2023-10-21 08:49:37', '2023-10-21 08:49:37');
INSERT INTO `n_log_actions` VALUES (578, 'fill_finishes', 'insert', 55, 1, 568, '{\"product_qty\":\"10000\",\"fill\":\"{\\\"stage\\\":[{\\\"length\\\":\\\"51\\\",\\\"width\\\":\\\"51\\\",\\\"materal\\\":\\\"16\\\",\\\"machine\\\":\\\"48\\\",\\\"qttv_price\\\":0.6,\\\"cost\\\":20906000,\\\"work_price\\\":500,\\\"shape_price\\\":300000},{\\\"length\\\":\\\"51\\\",\\\"width\\\":\\\"51\\\",\\\"materal\\\":\\\"18\\\",\\\"machine\\\":\\\"48\\\",\\\"qttv_price\\\":0.6,\\\"cost\\\":20906000,\\\"work_price\\\":500,\\\"shape_price\\\":300000},{\\\"length\\\":\\\"20\\\",\\\"width\\\":\\\"74\\\",\\\"materal\\\":\\\"19\\\",\\\"machine\\\":\\\"48\\\",\\\"qttv_price\\\":0.6,\\\"cost\\\":14180000,\\\"work_price\\\":500,\\\"shape_price\\\":300000},{\\\"length\\\":\\\"19\\\",\\\"width\\\":\\\"74\\\",\\\"materal\\\":\\\"19\\\",\\\"machine\\\":\\\"48\\\",\\\"qttv_price\\\":0.6,\\\"cost\\\":13736000,\\\"work_price\\\":500,\\\"shape_price\\\":300000}],\\\"ext_price\\\":\\\"0\\\",\\\"qty_pro\\\":10000,\\\"handle_qty\\\":10050,\\\"fill_cost\\\":69728000,\\\"act\\\":1,\\\"total\\\":69728000}\",\"finish\":\"{\\\"stage\\\":[{\\\"materal\\\":\\\"53\\\",\\\"qttv_price\\\":500,\\\"cost\\\":5000000},{\\\"materal\\\":\\\"58\\\",\\\"qttv_price\\\":150,\\\"cost\\\":1500000},{\\\"materal\\\":\\\"58\\\",\\\"qttv_price\\\":150,\\\"cost\\\":1500000},{\\\"materal\\\":\\\"58\\\",\\\"qttv_price\\\":150,\\\"cost\\\":1500000},{\\\"materal\\\":\\\"54\\\",\\\"qttv_price\\\":150,\\\"cost\\\":1500000}],\\\"ext_price\\\":\\\"0\\\",\\\"qty_pro\\\":10000,\\\"handle_qty\\\":10050,\\\"finish_cost\\\":11000000,\\\"act\\\":1,\\\"total\\\":11000000}\",\"magnet\":\"{\\\"type\\\":null,\\\"qty\\\":null,\\\"qttv_price\\\":0,\\\"magnet_perc\\\":1.05,\\\"qty_pro\\\":10000,\\\"act\\\":0,\\\"total\\\":0}\",\"note\":null,\"total_cost\":80728000,\"product\":84,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-21 08:49:37\",\"updated_at\":\"2023-10-21 08:49:37\"}', 1, '2023-10-21 08:49:37', '2023-10-21 08:49:37');
INSERT INTO `n_log_actions` VALUES (579, 'quotes', 'update_customer', 118, 1, 0, '{\"seri\":{\"old\":\"BG-000118\",\"new\":\"BG-000119\"}}', 1, '2023-10-21 08:49:41', '2023-10-21 08:49:41');
INSERT INTO `n_log_actions` VALUES (580, 'quotes', 'insert_customer', 119, 1, 0, '{\"name\":\"CTY CP TH\\u01af\\u01a0NG M\\u1ea0I D\\u01af\\u1ee2C PH\\u1ea8M BIGFAM\",\"contacter\":\"Ms Th\\u1ea3o\",\"phone\":\"0325544040\",\"telephone\":\"0325544040\",\"email\":\"zalo\",\"address\":\"T\\u00f2a R2 TTTM Royal City, 72A Nguy\\u1ec5n Tr\\u00e3i - Thanh Xu\\u00e2n - HN\",\"city\":\"351\",\"seri\":\"BG-000119\",\"customer_id\":\"1\",\"company_name\":\"CTY CP TH\\u01af\\u01a0NG M\\u1ea0I D\\u01af\\u1ee2C PH\\u1ea8M BIGFAM\",\"status\":\"not_accepted\",\"created_by\":1,\"created_at\":\"2023-10-21 14:29:16\",\"act\":1,\"updated_at\":\"2023-10-21 14:29:16\"}', 1, '2023-10-21 14:29:16', '2023-10-21 14:29:16');
INSERT INTO `n_log_actions` VALUES (581, 'quotes', 'insert_customer', 120, 1, 0, '{\"name\":\"C\\u00d4NG TY D\\u1ec6T MAY TH\\u00c0NH V\\u01af\\u1ee2NG\",\"contacter\":\"Ms H\\u1eb1ng\",\"phone\":\"0979359387\",\"telephone\":\"0979359387\",\"email\":\"zalo\",\"address\":\"Hoa s\\u01a1n - \\u1ee8ng h\\u00f2a - H\\u00e0 n\\u1ed9i\",\"city\":\"351\",\"seri\":\"BG-000120\",\"customer_id\":\"3\",\"company_name\":\"C\\u00d4NG TY D\\u1ec6T MAY TH\\u00c0NH V\\u01af\\u1ee2NG\",\"status\":\"not_accepted\",\"created_by\":1,\"created_at\":\"2023-10-25 08:47:59\",\"act\":1,\"updated_at\":\"2023-10-25 08:47:59\"}', 1, '2023-10-25 08:47:59', '2023-10-25 08:47:59');
INSERT INTO `n_log_actions` VALUES (586, 'quotes', 'update_customer', 120, 16, 0, '{\"seri\":{\"old\":\"BG-000120\",\"new\":\"BG-000122\"}}', 1, '2023-10-25 10:01:50', '2023-10-25 10:01:50');
INSERT INTO `n_log_actions` VALUES (588, 'quotes', 'insert_customer', 123, 1, 0, '{\"name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"contacter\":\"Mr Tu\\u1ea5n\",\"phone\":\"0963303999\",\"telephone\":\"02438303888\",\"email\":\"kd1.intuandung@gmail.com\",\"address\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"seri\":\"BG-000123\",\"customer_id\":\"20\",\"company_name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"status\":\"not_accepted\",\"created_by\":1,\"created_at\":\"2023-10-31 09:26:17\",\"act\":1,\"updated_at\":\"2023-10-31 09:26:17\"}', 1, '2023-10-31 09:26:17', '2023-10-31 09:26:17');
INSERT INTO `n_log_actions` VALUES (589, 'quotes', 'insert', 124, 1, 0, '{\"seri\":\"BG-000124\",\"status\":\"not_accepted\",\"name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"product_qty\":null,\"customer_id\":20,\"company_name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"contacter\":\"Mr Tu\\u1ea5n\",\"address\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"email\":\"kd1.intuandung@gmail.com\",\"phone\":\"0963303999\",\"telephone\":\"02438303888\",\"city\":null,\"profit\":\"8\",\"ship_price\":\"10000000\",\"total_cost\":\"924320083.596\",\"total_amount\":\"999065690.28368\",\"note\":null,\"act\":1,\"src\":null,\"created_by\":1,\"created_at\":\"2023-10-31 09:51:08\",\"updated_at\":\"2023-10-31 09:51:08\"}', 1, '2023-10-31 09:51:08', '2023-10-31 09:51:08');
INSERT INTO `n_log_actions` VALUES (590, 'products', 'insert', 89, 1, 589, '{\"name\":\"Bao gi\\u00e1 h\\u1ed9p kay + zales 9.5 x 6.9 x 2.7cm\",\"category\":1,\"product_style\":10,\"qty\":\"309330\",\"design\":1,\"length\":\"9.5\",\"width\":\"6.9\",\"height\":\"2.7\",\"quote_id\":124,\"total_cost\":\"924320083.596\",\"total_amount\":\"999065690.28368\",\"custom_design_file\":null,\"sale_shape_file\":\"{\\\"id\\\":\\\"134\\\",\\\"dir\\\":\\\"storages\\/uploads\\\",\\\"path\\\":\\\"storage\\/app\\/public\\/uploads\\/Tinh gi\\u00e1.cdr\\\",\\\"name\\\":\\\"Tinh gi\\u00e1.cdr\\\"}\",\"tech_shape_file\":null,\"design_file\":null,\"design_shape_file\":null,\"handle_shape_file\":null,\"note\":null,\"act\":1,\"detail\":null,\"created_by\":1,\"created_at\":\"2023-10-31 09:51:08\",\"updated_at\":\"2023-10-31 09:51:08\"}', 1, '2023-10-31 09:51:08', '2023-10-31 09:51:08');
INSERT INTO `n_log_actions` VALUES (591, 'papers', 'insert', 181, 1, 590, '{\"name\":\"Bao gi\\u00e1 h\\u1ed9p kay   zales 9.5 x 6.9 x 2.7cm\",\"product_qty\":309330,\"nqty\":20,\"base_supp_qty\":15517,\"compent_percent\":\"360\",\"compent_plus\":300,\"supp_qty\":16177,\"size\":\"{\\\"materal\\\":\\\"other\\\",\\\"note\\\":\\\"gi\\\\u1ea5y M\\\\u1ef9 thu\\\\u1eadt \\\\u0111en t\\\\u00ednh 50\\\",\\\"qttv\\\":\\\"120\\\",\\\"length\\\":\\\"79\\\",\\\"width\\\":\\\"54.5\\\",\\\"unit_price\\\":\\\"0.005\\\",\\\"materal_price\\\":0.005,\\\"supp_qty\\\":16177,\\\"act\\\":1,\\\"total\\\":41790044.1}\",\"print\":\"{\\\"type\\\":\\\"0\\\",\\\"color\\\":\\\"0\\\",\\\"machine\\\":\\\"0\\\",\\\"note\\\":null,\\\"supp_qty\\\":14517,\\\"handle_qty\\\":15517,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":0,\\\"printer\\\":0,\\\"act\\\":0,\\\"total\\\":0}\",\"nilon\":\"{\\\"act\\\":0}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":312424,\\\"handle_qty\\\":15517,\\\"nqty\\\":20,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"face\\\":\\\"1\\\",\\\"materal\\\":\\\"10\\\",\\\"machine\\\":\\\"10\\\",\\\"note\\\":null,\\\"model_price\\\":80,\\\"work_price\\\":600,\\\"shape_price\\\":200000,\\\"supp_qty\\\":16077,\\\"handle_qty\\\":15517,\\\"materal_price\\\":0,\\\"act\\\":1,\\\"total\\\":10190640}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":16077,\\\"handle_qty\\\":15517,\\\"cost\\\":3157375,\\\"act\\\":1,\\\"total\\\":3157375}\",\"float\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":312424,\\\"handle_qty\\\":15517,\\\"nqty\\\":20,\\\"act\\\":0,\\\"total\\\":0}\",\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":312424,\\\"handle_qty\\\":309380,\\\"act\\\":1,\\\"total\\\":3154240}\",\"cut\":null,\"fold\":null,\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":1,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":309330,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"58292299.1\",\"product\":89,\"note\":null,\"main\":1,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-31 09:51:08\",\"updated_at\":\"2023-10-31 09:51:08\"}', 1, '2023-10-31 09:51:08', '2023-10-31 09:51:08');
INSERT INTO `n_log_actions` VALUES (592, 'papers', 'insert', 182, 1, 590, '{\"name\":\"Bao gi\\u00e1 h\\u1ed9p kay + zales 9.5 x 6.9 x 2.7cm ( T\\u1edc B\\u1ed2I \\u0110\\u00c1Y H\\u1ed8P )\",\"product_qty\":309330,\"nqty\":12,\"base_supp_qty\":25828,\"compent_percent\":\"566\",\"compent_plus\":300,\"supp_qty\":26694,\"size\":\"{\\\"materal\\\":\\\"other\\\",\\\"note\\\":\\\"m\\\\u1ef9 thu\\\\u1ea5t \\\\u0111en\\\",\\\"qttv\\\":\\\"120\\\",\\\"length\\\":\\\"79\\\",\\\"width\\\":\\\"54.5\\\",\\\"unit_price\\\":\\\"0.005\\\",\\\"materal_price\\\":0.005,\\\"supp_qty\\\":26694,\\\"act\\\":1,\\\"total\\\":68958610.2}\",\"print\":\"{\\\"type\\\":\\\"0\\\",\\\"color\\\":\\\"0\\\",\\\"machine\\\":\\\"0\\\",\\\"note\\\":null,\\\"supp_qty\\\":24828,\\\"handle_qty\\\":25828,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":0,\\\"printer\\\":0,\\\"act\\\":0,\\\"total\\\":0}\",\"nilon\":\"{\\\"act\\\":0}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":312424,\\\"handle_qty\\\":25828,\\\"nqty\\\":12,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":26594,\\\"handle_qty\\\":25828,\\\"cost\\\":4734925,\\\"act\\\":1,\\\"total\\\":4734925}\",\"float\":null,\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":312424,\\\"handle_qty\\\":309380,\\\"act\\\":1,\\\"total\\\":3154240}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":309330,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"76847775.2\",\"product\":89,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-31 09:51:08\",\"updated_at\":\"2023-10-31 09:51:08\"}', 1, '2023-10-31 09:51:08', '2023-10-31 09:51:08');
INSERT INTO `n_log_actions` VALUES (593, 'papers', 'insert', 183, 1, 590, '{\"name\":\"Bao gi\\u00e1 h\\u1ed9p kay + zales 9.5 x 6.9 x 2.7cm ( T\\u1edc B\\u1ed2I N\\u1eaeP H\\u1ed8P )\",\"product_qty\":309330,\"nqty\":20,\"base_supp_qty\":15517,\"compent_percent\":\"360\",\"compent_plus\":300,\"supp_qty\":16177,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"120\\\",\\\"length\\\":\\\"62\\\",\\\"width\\\":\\\"40\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":16177,\\\"act\\\":1,\\\"total\\\":9628550.4}\",\"print\":\"{\\\"type\\\":\\\"0\\\",\\\"color\\\":\\\"0\\\",\\\"machine\\\":\\\"0\\\",\\\"note\\\":null,\\\"supp_qty\\\":14517,\\\"handle_qty\\\":15517,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":0,\\\"printer\\\":0,\\\"act\\\":0,\\\"total\\\":0}\",\"nilon\":\"{\\\"act\\\":0}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":312424,\\\"handle_qty\\\":15517,\\\"nqty\\\":20,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"act\\\":0}\",\"float\":null,\"peel\":\"{\\\"act\\\":0}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":309330,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"9628550.4\",\"product\":89,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-31 09:51:08\",\"updated_at\":\"2023-10-31 09:51:08\"}', 1, '2023-10-31 09:51:08', '2023-10-31 09:51:08');
INSERT INTO `n_log_actions` VALUES (594, 'papers', 'insert', 184, 1, 590, '{\"name\":\"Bao gi\\u00e1 h\\u1ed9p kay + zales 9.5 x 6.9 x 2.7cm ( T\\u1edc B\\u1ed2I \\u0110\\u00c1Y H\\u1ed8P )\",\"product_qty\":309330,\"nqty\":12,\"base_supp_qty\":25828,\"compent_percent\":\"566\",\"compent_plus\":200,\"supp_qty\":26594,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"120\\\",\\\"length\\\":\\\"62\\\",\\\"width\\\":\\\"38\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":26594,\\\"act\\\":1,\\\"total\\\":15037311.36}\",\"print\":\"{\\\"type\\\":\\\"0\\\",\\\"color\\\":\\\"0\\\",\\\"machine\\\":\\\"0\\\",\\\"note\\\":null,\\\"supp_qty\\\":24828,\\\"handle_qty\\\":25828,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":0,\\\"printer\\\":0,\\\"act\\\":0,\\\"total\\\":0}\",\"nilon\":\"{\\\"act\\\":0}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":312424,\\\"handle_qty\\\":25828,\\\"nqty\\\":12,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"act\\\":0}\",\"float\":null,\"peel\":\"{\\\"act\\\":0}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":309330,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"15037311.36\",\"product\":89,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-31 09:51:08\",\"updated_at\":\"2023-10-31 09:51:08\"}', 1, '2023-10-31 09:51:09', '2023-10-31 09:51:09');
INSERT INTO `n_log_actions` VALUES (595, 'supplies', 'insert', 165, 1, 590, '{\"name\":51,\"product_qty\":309330,\"nqty\":\"20\",\"base_supp_qty\":15467,\"compent_percent\":\"310\",\"compent_plus\":100,\"supp_qty\":15877,\"size\":\"{\\\"length\\\":\\\"41.5\\\",\\\"width\\\":\\\"64\\\",\\\"supply_type\\\":\\\"21\\\",\\\"supply_price\\\":\\\"105\\\",\\\"qttv_price\\\":0.616,\\\"supp_qty\\\":15877,\\\"act\\\":1,\\\"total\\\":25976296.192}\",\"cut\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"machine\\\":\\\"21\\\",\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":15877,\\\"handle_qty\\\":15517,\\\"cost\\\":2879950,\\\"act\\\":1,\\\"total\\\":2879950}\",\"peel\":\"{\\\"machine\\\":\\\"39\\\",\\\"model_price\\\":0,\\\"work_price\\\":20,\\\"shape_price\\\":20000,\\\"qty_pro\\\":312424,\\\"handle_qty\\\":309380,\\\"act\\\":1,\\\"total\\\":6268480}\",\"mill\":\"{\\\"act\\\":0}\",\"note\":null,\"handle_elevate\":null,\"type\":\"carton\",\"product\":89,\"total_cost\":\"35124726.192\",\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-31 09:51:09\",\"updated_at\":\"2023-10-31 09:51:09\"}', 1, '2023-10-31 09:51:09', '2023-10-31 09:51:09');
INSERT INTO `n_log_actions` VALUES (596, 'supplies', 'insert', 166, 1, 590, '{\"name\":52,\"product_qty\":309330,\"nqty\":\"12\",\"base_supp_qty\":25778,\"compent_percent\":\"516\",\"compent_plus\":100,\"supp_qty\":26394,\"size\":\"{\\\"length\\\":\\\"38.5\\\",\\\"width\\\":\\\"61\\\",\\\"supply_type\\\":\\\"21\\\",\\\"supply_price\\\":\\\"105\\\",\\\"qttv_price\\\":0.616,\\\"supp_qty\\\":26394,\\\"act\\\":1,\\\"total\\\":38183566.344}\",\"cut\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"machine\\\":\\\"21\\\",\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":26394,\\\"handle_qty\\\":25828,\\\"cost\\\":4411375,\\\"act\\\":1,\\\"total\\\":4411375}\",\"peel\":\"{\\\"machine\\\":\\\"39\\\",\\\"model_price\\\":0,\\\"work_price\\\":20,\\\"shape_price\\\":20000,\\\"qty_pro\\\":312424,\\\"handle_qty\\\":309380,\\\"act\\\":1,\\\"total\\\":6268480}\",\"mill\":\"{\\\"act\\\":0}\",\"note\":null,\"handle_elevate\":null,\"type\":\"carton\",\"product\":89,\"total_cost\":\"48863421.344\",\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-31 09:51:09\",\"updated_at\":\"2023-10-31 09:51:09\"}', 1, '2023-10-31 09:51:09', '2023-10-31 09:51:09');
INSERT INTO `n_log_actions` VALUES (597, 'fill_finishes', 'insert', 58, 1, 590, '{\"product_qty\":\"309330\",\"fill\":\"{\\\"stage\\\":[{\\\"length\\\":null,\\\"width\\\":null,\\\"machine\\\":null,\\\"qttv_price\\\":0,\\\"cost\\\":0}],\\\"ext_price\\\":\\\"2000\\\",\\\"qty_pro\\\":309330,\\\"handle_qty\\\":309380,\\\"fill_cost\\\":0,\\\"act\\\":1,\\\"total\\\":618660000}\",\"finish\":\"{\\\"ext_price\\\":\\\"200\\\",\\\"qty_pro\\\":309330,\\\"handle_qty\\\":309380,\\\"finish_cost\\\":0,\\\"act\\\":1,\\\"total\\\":61866000}\",\"magnet\":\"{\\\"type\\\":null,\\\"qty\\\":null,\\\"qttv_price\\\":0,\\\"magnet_perc\\\":1.05,\\\"qty_pro\\\":309330,\\\"act\\\":0,\\\"total\\\":0}\",\"note\":null,\"total_cost\":680526000,\"product\":89,\"act\":1,\"created_by\":1,\"created_at\":\"2023-10-31 09:51:09\",\"updated_at\":\"2023-10-31 09:51:09\"}', 1, '2023-10-31 09:51:09', '2023-10-31 09:51:09');
INSERT INTO `n_log_actions` VALUES (598, 'quotes', 'update_customer', 124, 1, 0, '{\"seri\":{\"old\":\"BG-000124\",\"new\":\"BG-000125\"},\"name\":{\"old\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"new\":\"CTY TNHH VIETBRAND\"},\"customer_id\":{\"old\":20,\"new\":4},\"company_name\":{\"old\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"new\":\"CTY TNHH VIETBRAND\"},\"contacter\":{\"old\":\"Mr Tu\\u1ea5n\",\"new\":\"Ph\\u01b0\\u01a1ng\"},\"address\":{\"old\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"new\":\"H\\u00e0 Nam\"},\"email\":{\"old\":\"kd1.intuandung@gmail.com\",\"new\":\"Phuongn@vietbrandco.vn\"},\"phone\":{\"old\":\"0963303999\",\"new\":\"0977070289\"},\"telephone\":{\"old\":\"02438303888\",\"new\":\"0977070289\"},\"city\":{\"old\":null,\"new\":9047}}', 1, '2023-10-31 09:51:20', '2023-10-31 09:51:20');
INSERT INTO `n_log_actions` VALUES (599, 'quotes', 'update_customer', 119, 16, 0, '{\"seri\":{\"old\":\"BG-000119\",\"new\":\"BG-000125\"}}', 1, '2023-10-31 18:51:44', '2023-10-31 18:51:44');
INSERT INTO `n_log_actions` VALUES (600, 'quotes', 'insert_customer', 125, 1, 0, '{\"name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"contacter\":\"Mr Tu\\u1ea5n\",\"phone\":\"0963303999\",\"telephone\":\"02438303888\",\"email\":\"kd1.intuandung@gmail.com\",\"address\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"city\":\"351\",\"seri\":\"BG-000125\",\"customer_id\":\"9\",\"company_name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"status\":\"not_accepted\",\"created_by\":1,\"created_at\":\"2023-11-01 16:09:28\",\"act\":1,\"updated_at\":\"2023-11-01 16:09:28\"}', 1, '2023-11-01 16:09:28', '2023-11-01 16:09:28');
INSERT INTO `n_log_actions` VALUES (601, 'materals', 'update', 1, 1, 0, '{\"price\":{\"old\":\"0.28\",\"new\":\"0.36\"}}', 1, '2023-11-01 16:10:10', '2023-11-01 16:10:10');
INSERT INTO `n_log_actions` VALUES (602, 'quotes', 'insert_customer', 126, 1, 0, '{\"name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"contacter\":\"Mr Tu\\u1ea5n\",\"phone\":\"0963303999\",\"telephone\":\"02438303888\",\"email\":\"kd1.intuandung@gmail.com\",\"address\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"city\":\"351\",\"seri\":\"BG-000126\",\"customer_id\":\"9\",\"company_name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"status\":\"not_accepted\",\"created_by\":1,\"created_at\":\"2023-11-01 16:10:22\",\"act\":1,\"updated_at\":\"2023-11-01 16:10:22\"}', 1, '2023-11-01 16:10:22', '2023-11-01 16:10:22');
INSERT INTO `n_log_actions` VALUES (603, 'quotes', 'insert', 127, 1, 0, '{\"seri\":\"BG-000127\",\"status\":\"not_accepted\",\"name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"product_qty\":null,\"customer_id\":9,\"company_name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"contacter\":\"Mr Tu\\u1ea5n\",\"address\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"email\":\"kd1.intuandung@gmail.com\",\"phone\":\"0963303999\",\"telephone\":\"02438303888\",\"city\":351,\"profit\":\"0\",\"ship_price\":\"5000000\",\"total_cost\":\"156692249.64\",\"total_amount\":\"161692249.64\",\"note\":null,\"act\":1,\"src\":null,\"created_by\":1,\"created_at\":\"2023-11-01 16:27:03\",\"updated_at\":\"2023-11-01 16:27:03\"}', 1, '2023-11-01 16:27:03', '2023-11-01 16:27:03');
INSERT INTO `n_log_actions` VALUES (604, 'products', 'insert', 91, 1, 603, '{\"name\":\"H\\u1ed9p 29 X 36 X 10.5cm C\\u1eaft CNC\",\"category\":1,\"product_style\":12,\"qty\":\"3000\",\"design\":1,\"length\":\"29\",\"width\":\"36\",\"height\":\"10.5\",\"quote_id\":127,\"total_cost\":\"156692249.64\",\"total_amount\":\"161692249.64\",\"custom_design_file\":null,\"sale_shape_file\":\"{\\\"id\\\":\\\"135\\\",\\\"dir\\\":\\\"storages\\/uploads\\\",\\\"path\\\":\\\"storage\\/app\\/public\\/uploads\\/HQT c\\u1eb7p x\\u00e1ch 2024.cdr\\\",\\\"name\\\":\\\"HQT c\\u1eb7p x\\u00e1ch 2024.cdr\\\"}\",\"tech_shape_file\":null,\"design_file\":null,\"design_shape_file\":null,\"handle_shape_file\":null,\"note\":null,\"act\":1,\"detail\":null,\"created_by\":1,\"created_at\":\"2023-11-01 16:27:03\",\"updated_at\":\"2023-11-01 16:27:03\"}', 1, '2023-11-01 16:27:03', '2023-11-01 16:27:03');
INSERT INTO `n_log_actions` VALUES (605, 'papers', 'insert', 189, 1, 604, '{\"name\":\"H\\u1ed9p 29 X 36 X 10.5cm C\\u1eaft CNC\",\"product_qty\":3000,\"nqty\":1,\"base_supp_qty\":3050,\"compent_percent\":\"110\",\"compent_plus\":150,\"supp_qty\":3310,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"150\\\",\\\"length\\\":\\\"86\\\",\\\"width\\\":\\\"47\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":3310,\\\"act\\\":1,\\\"total\\\":4013706}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"4\\\",\\\"machine\\\":\\\"1\\\",\\\"note\\\":null,\\\"supp_qty\\\":2050,\\\"handle_qty\\\":3050,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":0,\\\"printer\\\":0,\\\"act\\\":0,\\\"total\\\":0}\",\"nilon\":\"{\\\"materal\\\":\\\"9\\\",\\\"face\\\":\\\"1\\\",\\\"machine\\\":\\\"8\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":50000,\\\"supp_qty\\\":3210,\\\"handle_qty\\\":3050,\\\"materal_price\\\":0.25,\\\"act\\\":1,\\\"total\\\":3293705}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"1500\\\",\\\"shape_price\\\":\\\"500000\\\",\\\"machine\\\":\\\"2\\\",\\\"note\\\":null,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"nqty\\\":1,\\\"act\\\":1,\\\"total\\\":5045000}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":3210,\\\"handle_qty\\\":3050,\\\"cost\\\":1187800,\\\"act\\\":1,\\\"total\\\":1187800}\",\"float\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"act\\\":1,\\\"total\\\":60300}\",\"cut\":null,\"fold\":null,\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":1,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":3000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"13600511\",\"product\":91,\"note\":null,\"main\":1,\"act\":1,\"created_by\":1,\"created_at\":\"2023-11-01 16:27:03\",\"updated_at\":\"2023-11-01 16:27:03\"}', 1, '2023-11-01 16:27:03', '2023-11-01 16:27:03');
INSERT INTO `n_log_actions` VALUES (606, 'papers', 'insert', 190, 1, 604, '{\"name\":\"H\\u1ed9p 29 X 36 X 10.5cm C\\u1eaft CNC ( T\\u1edc B\\u1ed2I M\\u1eb6T TH\\u00c9P )\",\"product_qty\":3000,\"nqty\":1,\"base_supp_qty\":3050,\"compent_percent\":\"110\",\"compent_plus\":150,\"supp_qty\":3310,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"150\\\",\\\"length\\\":\\\"54.5\\\",\\\"width\\\":\\\"44\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":3310,\\\"act\\\":1,\\\"total\\\":2381214}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"2\\\",\\\"machine\\\":\\\"2\\\",\\\"note\\\":null,\\\"supp_qty\\\":2050,\\\"handle_qty\\\":3050,\\\"model_price\\\":123600,\\\"work_price\\\":500,\\\"shape_price\\\":600000,\\\"printer\\\":11,\\\"act\\\":1,\\\"total\\\":3497200}\",\"nilon\":\"{\\\"act\\\":0}\",\"metalai\":\"{\\\"materal\\\":\\\"1\\\",\\\"face\\\":\\\"1\\\",\\\"cover_materal\\\":\\\"3\\\",\\\"cover_face\\\":\\\"1\\\",\\\"machine\\\":\\\"16\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":100000,\\\"supp_qty\\\":3310,\\\"handle_qty\\\":3050,\\\"cover_supp_qty\\\":3310,\\\"materal_price\\\":0.36,\\\"metalai_price\\\":2957456.8,\\\"materal_cover_price\\\":0.08,\\\"metalai_cover_price\\\":715806.4,\\\"act\\\":1,\\\"total\\\":3673263.1999999997}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":3210,\\\"handle_qty\\\":3050,\\\"cost\\\":941200,\\\"act\\\":1,\\\"total\\\":941200}\",\"float\":null,\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"act\\\":1,\\\"total\\\":60300}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"4000\\\",\\\"prescript_price\\\":\\\"10000\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":\\\"4000 L\\\\u00c0 TH\\\\u00c0NH , V\\\\u00c1CH, 10000 l\\\\u00e0 c\\\\u1eaft cnc\\\",\\\"qty_pro\\\":3000,\\\"act\\\":1,\\\"total\\\":42000000}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"52553177.2\",\"product\":91,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-11-01 16:27:03\",\"updated_at\":\"2023-11-01 16:27:03\"}', 1, '2023-11-01 16:27:03', '2023-11-01 16:27:03');
INSERT INTO `n_log_actions` VALUES (607, 'papers', 'insert', 191, 1, 604, '{\"name\":\"H\\u1ed9p 29 X 36 X 10.5cm C\\u1eaft CNC ( T\\u1edc B\\u1ed2I TH\\u00c0NH )\",\"product_qty\":3000,\"nqty\":2,\"base_supp_qty\":1550,\"compent_percent\":\"80\",\"compent_plus\":100,\"supp_qty\":1730,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"150\\\",\\\"length\\\":\\\"65\\\",\\\"width\\\":\\\"68\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":1730,\\\"act\\\":1,\\\"total\\\":2293980}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"2\\\",\\\"machine\\\":\\\"2\\\",\\\"note\\\":null,\\\"supp_qty\\\":550,\\\"handle_qty\\\":1550,\\\"model_price\\\":123600,\\\"work_price\\\":500,\\\"shape_price\\\":600000,\\\"printer\\\":11,\\\"act\\\":1,\\\"total\\\":1997200}\",\"nilon\":\"{\\\"act\\\":0}\",\"metalai\":\"{\\\"materal\\\":\\\"1\\\",\\\"face\\\":\\\"1\\\",\\\"cover_materal\\\":\\\"3\\\",\\\"cover_face\\\":\\\"1\\\",\\\"machine\\\":\\\"16\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":100000,\\\"supp_qty\\\":1730,\\\"handle_qty\\\":1550,\\\"cover_supp_qty\\\":1730,\\\"materal_price\\\":0.36,\\\"metalai_price\\\":2852776,\\\"materal_cover_price\\\":0.08,\\\"metalai_cover_price\\\":676368,\\\"act\\\":1,\\\"total\\\":3529144}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":1550,\\\"nqty\\\":2,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":1630,\\\"handle_qty\\\":1550,\\\"cost\\\":1007500,\\\"act\\\":1,\\\"total\\\":1007500}\",\"float\":null,\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"act\\\":1,\\\"total\\\":60300}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":3000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"8888124\",\"product\":91,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-11-01 16:27:03\",\"updated_at\":\"2023-11-01 16:27:03\"}', 1, '2023-11-01 16:27:03', '2023-11-01 16:27:03');
INSERT INTO `n_log_actions` VALUES (608, 'papers', 'insert', 192, 1, 604, '{\"name\":\"H\\u1ed9p 29 X 36 X 10.5cm C\\u1eaft CNC ( T\\u1edc B\\u1ed2I \\u0110\\u00c1Y H\\u1ed8P )\",\"product_qty\":3000,\"nqty\":1,\"base_supp_qty\":3050,\"compent_percent\":\"110\",\"compent_plus\":100,\"supp_qty\":3260,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"120\\\",\\\"length\\\":\\\"47\\\",\\\"width\\\":\\\"54\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":3260,\\\"act\\\":1,\\\"total\\\":1985731.2}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"2\\\",\\\"machine\\\":\\\"2\\\",\\\"note\\\":null,\\\"supp_qty\\\":2050,\\\"handle_qty\\\":3050,\\\"model_price\\\":66000,\\\"work_price\\\":200,\\\"shape_price\\\":250000,\\\"printer\\\":8,\\\"act\\\":1,\\\"total\\\":1452000}\",\"nilon\":\"{\\\"act\\\":0}\",\"metalai\":\"{\\\"materal\\\":\\\"1\\\",\\\"face\\\":\\\"1\\\",\\\"cover_materal\\\":\\\"3\\\",\\\"cover_face\\\":\\\"1\\\",\\\"machine\\\":\\\"16\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":100000,\\\"supp_qty\\\":3260,\\\"handle_qty\\\":3050,\\\"cover_supp_qty\\\":3260,\\\"materal_price\\\":0.36,\\\"metalai_price\\\":3078596.8,\\\"materal_cover_price\\\":0.08,\\\"metalai_cover_price\\\":741606.4,\\\"act\\\":1,\\\"total\\\":3820203.1999999997}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"act\\\":0}\",\"float\":null,\"peel\":\"{\\\"act\\\":0}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":3000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"7257934.4\",\"product\":91,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-11-01 16:27:03\",\"updated_at\":\"2023-11-01 16:27:03\"}', 1, '2023-11-01 16:27:03', '2023-11-01 16:27:03');
INSERT INTO `n_log_actions` VALUES (609, 'supplies', 'insert', 169, 1, 604, '{\"name\":49,\"product_qty\":3000,\"nqty\":\"1\",\"base_supp_qty\":3000,\"compent_percent\":\"60\",\"compent_plus\":100,\"supp_qty\":3160,\"size\":\"{\\\"length\\\":\\\"80\\\",\\\"width\\\":\\\"44\\\",\\\"supply_type\\\":\\\"49\\\",\\\"supply_price\\\":\\\"219\\\",\\\"qttv_price\\\":1.6835,\\\"supp_qty\\\":3160,\\\"act\\\":1,\\\"total\\\":18725907.2}\",\"cut\":\"{\\\"machine\\\":\\\"18\\\",\\\"model_price\\\":0,\\\"work_price\\\":80,\\\"shape_price\\\":100000,\\\"supp_qty\\\":3160,\\\"handle_qty\\\":3050,\\\"act\\\":1,\\\"total\\\":352800}\",\"elevate\":\"{\\\"machine\\\":\\\"21\\\",\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":3160,\\\"handle_qty\\\":3050,\\\"cost\\\":1102000,\\\"act\\\":1,\\\"total\\\":1102000}\",\"peel\":\"{\\\"machine\\\":\\\"39\\\",\\\"model_price\\\":0,\\\"work_price\\\":20,\\\"shape_price\\\":20000,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"act\\\":1,\\\"total\\\":80600}\",\"mill\":\"{\\\"machine\\\":\\\"7\\\",\\\"model_price\\\":0,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"qty_pro\\\":3030,\\\"factor\\\":1,\\\"handle_qty\\\":3050,\\\"act\\\":1,\\\"total\\\":554500}\",\"note\":null,\"handle_elevate\":null,\"type\":\"carton\",\"product\":91,\"total_cost\":\"20815807.2\",\"act\":1,\"created_by\":1,\"created_at\":\"2023-11-01 16:27:03\",\"updated_at\":\"2023-11-01 16:27:03\"}', 1, '2023-11-01 16:27:03', '2023-11-01 16:27:03');
INSERT INTO `n_log_actions` VALUES (610, 'supplies', 'insert', 170, 1, 604, '{\"name\":52,\"product_qty\":3000,\"nqty\":\"1\",\"base_supp_qty\":3000,\"compent_percent\":\"60\",\"compent_plus\":100,\"supp_qty\":3160,\"size\":\"{\\\"length\\\":\\\"56\\\",\\\"width\\\":\\\"49\\\",\\\"supply_type\\\":\\\"49\\\",\\\"supply_price\\\":\\\"219\\\",\\\"qttv_price\\\":1.6835,\\\"supp_qty\\\":3160,\\\"act\\\":1,\\\"total\\\":14597695.840000002}\",\"cut\":\"{\\\"machine\\\":\\\"18\\\",\\\"model_price\\\":0,\\\"work_price\\\":80,\\\"shape_price\\\":100000,\\\"supp_qty\\\":3160,\\\"handle_qty\\\":3050,\\\"act\\\":1,\\\"total\\\":352800}\",\"elevate\":\"{\\\"machine\\\":\\\"21\\\",\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":3160,\\\"handle_qty\\\":3050,\\\"cost\\\":985600,\\\"act\\\":1,\\\"total\\\":985600}\",\"peel\":\"{\\\"machine\\\":\\\"39\\\",\\\"model_price\\\":0,\\\"work_price\\\":20,\\\"shape_price\\\":20000,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"act\\\":1,\\\"total\\\":80600}\",\"mill\":\"{\\\"act\\\":0}\",\"note\":null,\"handle_elevate\":null,\"type\":\"carton\",\"product\":91,\"total_cost\":\"16016695.84\",\"act\":1,\"created_by\":1,\"created_at\":\"2023-11-01 16:27:03\",\"updated_at\":\"2023-11-01 16:27:03\"}', 1, '2023-11-01 16:27:03', '2023-11-01 16:27:03');
INSERT INTO `n_log_actions` VALUES (611, 'fill_finishes', 'insert', 60, 1, 604, '{\"product_qty\":\"3000\",\"fill\":\"{\\\"stage\\\":[{\\\"length\\\":null,\\\"width\\\":null,\\\"machine\\\":null,\\\"qttv_price\\\":0,\\\"cost\\\":0}],\\\"ext_price\\\":\\\"8000\\\",\\\"qty_pro\\\":3000,\\\"handle_qty\\\":3050,\\\"fill_cost\\\":0,\\\"act\\\":1,\\\"total\\\":24000000}\",\"finish\":\"{\\\"ext_price\\\":\\\"2000\\\",\\\"qty_pro\\\":3000,\\\"handle_qty\\\":3050,\\\"finish_cost\\\":0,\\\"act\\\":1,\\\"total\\\":6000000}\",\"magnet\":\"{\\\"type\\\":\\\"32\\\",\\\"qty\\\":\\\"2\\\",\\\"qttv_price\\\":\\\"1200\\\",\\\"magnet_perc\\\":1.05,\\\"qty_pro\\\":3000,\\\"act\\\":1,\\\"total\\\":7560000}\",\"note\":null,\"total_cost\":37560000,\"product\":91,\"act\":1,\"created_by\":1,\"created_at\":\"2023-11-01 16:27:03\",\"updated_at\":\"2023-11-01 16:27:03\"}', 1, '2023-11-01 16:27:03', '2023-11-01 16:27:03');
INSERT INTO `n_log_actions` VALUES (612, 'quotes', 'update_customer', 127, 1, 0, '{\"seri\":{\"old\":\"BG-000127\",\"new\":\"BG-000128\"}}', 1, '2023-11-01 16:27:05', '2023-11-01 16:27:05');
INSERT INTO `n_log_actions` VALUES (613, 'quotes', 'update_customer', 126, 1, 0, '{\"seri\":{\"old\":\"BG-000126\",\"new\":\"BG-000128\"}}', 1, '2023-11-01 16:39:51', '2023-11-01 16:39:51');
INSERT INTO `n_log_actions` VALUES (614, 'quotes', 'insert', 128, 1, 0, '{\"seri\":\"BG-000128\",\"status\":\"not_accepted\",\"name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"product_qty\":null,\"customer_id\":9,\"company_name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"contacter\":\"Mr Tu\\u1ea5n\",\"address\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"email\":\"kd1.intuandung@gmail.com\",\"phone\":\"0963303999\",\"telephone\":\"02438303888\",\"city\":351,\"profit\":\"0\",\"ship_price\":\"5000000\",\"total_cost\":\"160229329.58\",\"total_amount\":\"165229329.58\",\"note\":null,\"act\":1,\"src\":null,\"created_by\":1,\"created_at\":\"2023-11-01 16:41:10\",\"updated_at\":\"2023-11-01 16:41:10\"}', 1, '2023-11-01 16:41:10', '2023-11-01 16:41:10');
INSERT INTO `n_log_actions` VALUES (615, 'products', 'insert', 92, 1, 614, '{\"name\":\"H\\u1ed9p 36 X 36 X 10.5cm C\\u1eaft CNC\",\"category\":1,\"product_style\":12,\"qty\":\"3000\",\"design\":1,\"length\":\"29\",\"width\":\"36\",\"height\":\"10.5\",\"quote_id\":128,\"total_cost\":\"160229329.58\",\"total_amount\":\"165229329.58\",\"custom_design_file\":null,\"sale_shape_file\":\"{\\\"id\\\":\\\"136\\\",\\\"dir\\\":\\\"storages\\/uploads\\\",\\\"path\\\":\\\"storage\\/app\\/public\\/uploads\\/HQT 36x36 cao c\\u1ea5p 2024(2).cdr\\\",\\\"name\\\":\\\"HQT 36x36 cao c\\u1ea5p 2024(2).cdr\\\"}\",\"tech_shape_file\":null,\"design_file\":null,\"design_shape_file\":null,\"handle_shape_file\":null,\"note\":null,\"act\":1,\"detail\":null,\"created_by\":1,\"created_at\":\"2023-11-01 16:41:10\",\"updated_at\":\"2023-11-01 16:41:10\"}', 1, '2023-11-01 16:41:10', '2023-11-01 16:41:10');
INSERT INTO `n_log_actions` VALUES (616, 'papers', 'insert', 193, 1, 615, '{\"name\":\"H\\u1ed9p 29 X 36 X 10.5cm C\\u1eaft CNC\",\"product_qty\":3000,\"nqty\":1,\"base_supp_qty\":3050,\"compent_percent\":\"110\",\"compent_plus\":150,\"supp_qty\":3310,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"150\\\",\\\"length\\\":\\\"97\\\",\\\"width\\\":\\\"43\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":3310,\\\"act\\\":1,\\\"total\\\":4141803}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"4\\\",\\\"machine\\\":\\\"1\\\",\\\"note\\\":null,\\\"supp_qty\\\":2050,\\\"handle_qty\\\":3050,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":0,\\\"printer\\\":0,\\\"act\\\":0,\\\"total\\\":0}\",\"nilon\":\"{\\\"materal\\\":\\\"9\\\",\\\"face\\\":\\\"1\\\",\\\"machine\\\":\\\"8\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":50000,\\\"supp_qty\\\":3210,\\\"handle_qty\\\":3050,\\\"materal_price\\\":0.25,\\\"act\\\":1,\\\"total\\\":3397227.5}\",\"metalai\":\"{\\\"act\\\":0}\",\"compress\":\"{\\\"price\\\":\\\"1500\\\",\\\"shape_price\\\":\\\"500000\\\",\\\"machine\\\":\\\"2\\\",\\\"note\\\":null,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"nqty\\\":1,\\\"act\\\":1,\\\"total\\\":5045000}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":3210,\\\"handle_qty\\\":3050,\\\"cost\\\":1207150,\\\"act\\\":1,\\\"total\\\":1207150}\",\"float\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"act\\\":1,\\\"total\\\":60300}\",\"cut\":null,\"fold\":null,\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":1,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":3000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"13851480.5\",\"product\":92,\"note\":null,\"main\":1,\"act\":1,\"created_by\":1,\"created_at\":\"2023-11-01 16:41:11\",\"updated_at\":\"2023-11-01 16:41:11\"}', 1, '2023-11-01 16:41:11', '2023-11-01 16:41:11');
INSERT INTO `n_log_actions` VALUES (617, 'papers', 'insert', 194, 1, 615, '{\"name\":\"H\\u1ed9p 29 X 36 X 10.5cm C\\u1eaft CNC ( T\\u1edc B\\u1ed2I M\\u1eb6T TH\\u00c9P )\",\"product_qty\":3000,\"nqty\":1,\"base_supp_qty\":3050,\"compent_percent\":\"110\",\"compent_plus\":150,\"supp_qty\":3310,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"150\\\",\\\"length\\\":\\\"60\\\",\\\"width\\\":\\\"37\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":3310,\\\"act\\\":1,\\\"total\\\":2204460}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"2\\\",\\\"machine\\\":\\\"2\\\",\\\"note\\\":null,\\\"supp_qty\\\":2050,\\\"handle_qty\\\":3050,\\\"model_price\\\":123600,\\\"work_price\\\":500,\\\"shape_price\\\":600000,\\\"printer\\\":11,\\\"act\\\":1,\\\"total\\\":3497200}\",\"nilon\":\"{\\\"act\\\":0}\",\"metalai\":\"{\\\"materal\\\":\\\"1\\\",\\\"face\\\":\\\"1\\\",\\\"cover_materal\\\":\\\"3\\\",\\\"cover_face\\\":\\\"1\\\",\\\"machine\\\":\\\"16\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":100000,\\\"supp_qty\\\":3310,\\\"handle_qty\\\":3050,\\\"cover_supp_qty\\\":3310,\\\"materal_price\\\":0.36,\\\"metalai_price\\\":2745352,\\\"materal_cover_price\\\":0.08,\\\"metalai_cover_price\\\":670096,\\\"act\\\":1,\\\"total\\\":3415448}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":3210,\\\"handle_qty\\\":3050,\\\"cost\\\":914500,\\\"act\\\":1,\\\"total\\\":914500}\",\"float\":null,\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"act\\\":1,\\\"total\\\":60300}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"4000\\\",\\\"prescript_price\\\":\\\"10000\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":\\\"4000 L\\\\u00c0 TH\\\\u00c0NH , V\\\\u00c1CH, 10000 l\\\\u00e0 c\\\\u1eaft cnc\\\",\\\"qty_pro\\\":3000,\\\"act\\\":1,\\\"total\\\":42000000}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"52091908\",\"product\":92,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-11-01 16:41:11\",\"updated_at\":\"2023-11-01 16:41:11\"}', 1, '2023-11-01 16:41:11', '2023-11-01 16:41:11');
INSERT INTO `n_log_actions` VALUES (618, 'papers', 'insert', 195, 1, 615, '{\"name\":\"H\\u1ed9p 29 X 36 X 10.5cm C\\u1eaft CNC ( T\\u1edc B\\u1ed2I TH\\u00c0NH )\",\"product_qty\":3000,\"nqty\":2,\"base_supp_qty\":1550,\"compent_percent\":\"80\",\"compent_plus\":100,\"supp_qty\":1730,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"150\\\",\\\"length\\\":\\\"65\\\",\\\"width\\\":\\\"75\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":1730,\\\"act\\\":1,\\\"total\\\":2530125}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"2\\\",\\\"machine\\\":\\\"2\\\",\\\"note\\\":null,\\\"supp_qty\\\":550,\\\"handle_qty\\\":1550,\\\"model_price\\\":123600,\\\"work_price\\\":500,\\\"shape_price\\\":600000,\\\"printer\\\":11,\\\"act\\\":1,\\\"total\\\":1997200}\",\"nilon\":\"{\\\"act\\\":0}\",\"metalai\":\"{\\\"materal\\\":\\\"1\\\",\\\"face\\\":\\\"1\\\",\\\"cover_materal\\\":\\\"3\\\",\\\"cover_face\\\":\\\"1\\\",\\\"machine\\\":\\\"16\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":100000,\\\"supp_qty\\\":1730,\\\"handle_qty\\\":1550,\\\"cover_supp_qty\\\":1730,\\\"materal_price\\\":0.36,\\\"metalai_price\\\":3136150,\\\"materal_cover_price\\\":0.08,\\\"metalai_cover_price\\\":735700,\\\"act\\\":1,\\\"total\\\":3871850}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":1550,\\\"nqty\\\":2,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"ext_price\\\":\\\"0\\\",\\\"machine\\\":\\\"4\\\",\\\"note\\\":null,\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":1630,\\\"handle_qty\\\":1550,\\\"cost\\\":1075750,\\\"act\\\":1,\\\"total\\\":1075750}\",\"float\":null,\"peel\":\"{\\\"machine\\\":\\\"12\\\",\\\"nqty\\\":\\\"1\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":10,\\\"shape_price\\\":30000,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"act\\\":1,\\\"total\\\":60300}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":3000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"9535225\",\"product\":92,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-11-01 16:41:11\",\"updated_at\":\"2023-11-01 16:41:11\"}', 1, '2023-11-01 16:41:11', '2023-11-01 16:41:11');
INSERT INTO `n_log_actions` VALUES (619, 'papers', 'insert', 196, 1, 615, '{\"name\":\"H\\u1ed9p 29 X 36 X 10.5cm C\\u1eaft CNC ( T\\u1edc B\\u1ed2I \\u0110\\u00c1Y H\\u1ed8P )\",\"product_qty\":3000,\"nqty\":1,\"base_supp_qty\":3050,\"compent_percent\":\"110\",\"compent_plus\":100,\"supp_qty\":3260,\"size\":\"{\\\"materal\\\":\\\"12\\\",\\\"qttv\\\":\\\"120\\\",\\\"length\\\":\\\"52\\\",\\\"width\\\":\\\"52\\\",\\\"materal_price\\\":0.002,\\\"supp_qty\\\":3260,\\\"act\\\":1,\\\"total\\\":2115609.6}\",\"print\":\"{\\\"type\\\":\\\"1\\\",\\\"color\\\":\\\"2\\\",\\\"machine\\\":\\\"2\\\",\\\"note\\\":null,\\\"supp_qty\\\":2050,\\\"handle_qty\\\":3050,\\\"model_price\\\":66000,\\\"work_price\\\":250,\\\"shape_price\\\":300000,\\\"printer\\\":9,\\\"act\\\":1,\\\"total\\\":1757000}\",\"nilon\":\"{\\\"act\\\":0}\",\"metalai\":\"{\\\"materal\\\":\\\"1\\\",\\\"face\\\":\\\"1\\\",\\\"cover_materal\\\":\\\"3\\\",\\\"cover_face\\\":\\\"1\\\",\\\"machine\\\":\\\"16\\\",\\\"note\\\":null,\\\"model_price\\\":0,\\\"work_price\\\":0,\\\"shape_price\\\":100000,\\\"supp_qty\\\":3260,\\\"handle_qty\\\":3050,\\\"cover_supp_qty\\\":3260,\\\"materal_price\\\":0.36,\\\"metalai_price\\\":3273414.4,\\\"materal_cover_price\\\":0.08,\\\"metalai_cover_price\\\":783571.2,\\\"act\\\":1,\\\"total\\\":4056985.5999999996}\",\"compress\":\"{\\\"price\\\":\\\"0\\\",\\\"shape_price\\\":\\\"0\\\",\\\"machine\\\":null,\\\"note\\\":null,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"nqty\\\":1,\\\"act\\\":0,\\\"total\\\":0}\",\"uv\":\"{\\\"act\\\":0}\",\"elevate\":\"{\\\"act\\\":0}\",\"float\":null,\"peel\":\"{\\\"act\\\":0}\",\"cut\":null,\"fold\":\"{\\\"act\\\":0}\",\"box_paste\":null,\"bag_paste\":null,\"ext_cate\":6,\"ext_price\":\"{\\\"temp_price\\\":\\\"0\\\",\\\"prescript_price\\\":\\\"0\\\",\\\"supp_price\\\":\\\"0\\\",\\\"note\\\":null,\\\"qty_pro\\\":3000,\\\"act\\\":0,\\\"total\\\":0}\",\"except_handle\":0,\"handle_elevate\":null,\"total_cost\":\"7929595.2\",\"product\":92,\"note\":null,\"main\":0,\"act\":1,\"created_by\":1,\"created_at\":\"2023-11-01 16:41:11\",\"updated_at\":\"2023-11-01 16:41:11\"}', 1, '2023-11-01 16:41:11', '2023-11-01 16:41:11');
INSERT INTO `n_log_actions` VALUES (620, 'supplies', 'insert', 171, 1, 615, '{\"name\":49,\"product_qty\":3000,\"nqty\":\"1\",\"base_supp_qty\":3000,\"compent_percent\":\"60\",\"compent_plus\":100,\"supp_qty\":3160,\"size\":\"{\\\"length\\\":\\\"94\\\",\\\"width\\\":\\\"38\\\",\\\"supply_type\\\":\\\"49\\\",\\\"supply_price\\\":\\\"219\\\",\\\"qttv_price\\\":1.6835,\\\"supp_qty\\\":3160,\\\"act\\\":1,\\\"total\\\":19002539.919999998}\",\"cut\":\"{\\\"machine\\\":\\\"18\\\",\\\"model_price\\\":0,\\\"work_price\\\":80,\\\"shape_price\\\":100000,\\\"supp_qty\\\":3160,\\\"handle_qty\\\":3050,\\\"act\\\":1,\\\"total\\\":352800}\",\"elevate\":\"{\\\"machine\\\":\\\"21\\\",\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":3160,\\\"handle_qty\\\":3050,\\\"cost\\\":1109800,\\\"act\\\":1,\\\"total\\\":1109800}\",\"peel\":\"{\\\"machine\\\":\\\"39\\\",\\\"model_price\\\":0,\\\"work_price\\\":20,\\\"shape_price\\\":20000,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"act\\\":1,\\\"total\\\":80600}\",\"mill\":\"{\\\"machine\\\":\\\"7\\\",\\\"model_price\\\":0,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"qty_pro\\\":3030,\\\"factor\\\":1,\\\"handle_qty\\\":3050,\\\"act\\\":1,\\\"total\\\":554500}\",\"note\":null,\"handle_elevate\":null,\"type\":\"carton\",\"product\":92,\"total_cost\":\"21100239.92\",\"act\":1,\"created_by\":1,\"created_at\":\"2023-11-01 16:41:11\",\"updated_at\":\"2023-11-01 16:41:11\"}', 1, '2023-11-01 16:41:11', '2023-11-01 16:41:11');
INSERT INTO `n_log_actions` VALUES (621, 'supplies', 'insert', 172, 1, 615, '{\"name\":52,\"product_qty\":3000,\"nqty\":\"1\",\"base_supp_qty\":3000,\"compent_percent\":\"60\",\"compent_plus\":100,\"supp_qty\":3160,\"size\":\"{\\\"length\\\":\\\"56\\\",\\\"width\\\":\\\"56\\\",\\\"supply_type\\\":\\\"49\\\",\\\"supply_price\\\":\\\"219\\\",\\\"qttv_price\\\":1.6835,\\\"supp_qty\\\":3160,\\\"act\\\":1,\\\"total\\\":16683080.96}\",\"cut\":\"{\\\"machine\\\":\\\"18\\\",\\\"model_price\\\":0,\\\"work_price\\\":80,\\\"shape_price\\\":100000,\\\"supp_qty\\\":3160,\\\"handle_qty\\\":3050,\\\"act\\\":1,\\\"total\\\":352800}\",\"elevate\":\"{\\\"machine\\\":\\\"21\\\",\\\"model_price\\\":150,\\\"work_price\\\":150,\\\"shape_price\\\":100000,\\\"supp_qty\\\":3160,\\\"handle_qty\\\":3050,\\\"cost\\\":1044400,\\\"act\\\":1,\\\"total\\\":1044400}\",\"peel\":\"{\\\"machine\\\":\\\"39\\\",\\\"model_price\\\":0,\\\"work_price\\\":20,\\\"shape_price\\\":20000,\\\"qty_pro\\\":3030,\\\"handle_qty\\\":3050,\\\"act\\\":1,\\\"total\\\":80600}\",\"mill\":\"{\\\"act\\\":0}\",\"note\":null,\"handle_elevate\":null,\"type\":\"carton\",\"product\":92,\"total_cost\":\"18160880.96\",\"act\":1,\"created_by\":1,\"created_at\":\"2023-11-01 16:41:11\",\"updated_at\":\"2023-11-01 16:41:11\"}', 1, '2023-11-01 16:41:11', '2023-11-01 16:41:11');
INSERT INTO `n_log_actions` VALUES (622, 'fill_finishes', 'insert', 61, 1, 615, '{\"product_qty\":\"3000\",\"fill\":\"{\\\"stage\\\":[{\\\"length\\\":null,\\\"width\\\":null,\\\"machine\\\":null,\\\"qttv_price\\\":0,\\\"cost\\\":0}],\\\"ext_price\\\":\\\"8000\\\",\\\"qty_pro\\\":3000,\\\"handle_qty\\\":3050,\\\"fill_cost\\\":0,\\\"act\\\":1,\\\"total\\\":24000000}\",\"finish\":\"{\\\"ext_price\\\":\\\"2000\\\",\\\"qty_pro\\\":3000,\\\"handle_qty\\\":3050,\\\"finish_cost\\\":0,\\\"act\\\":1,\\\"total\\\":6000000}\",\"magnet\":\"{\\\"type\\\":\\\"32\\\",\\\"qty\\\":\\\"2\\\",\\\"qttv_price\\\":\\\"1200\\\",\\\"magnet_perc\\\":1.05,\\\"qty_pro\\\":3000,\\\"act\\\":1,\\\"total\\\":7560000}\",\"note\":null,\"total_cost\":37560000,\"product\":92,\"act\":1,\"created_by\":1,\"created_at\":\"2023-11-01 16:41:11\",\"updated_at\":\"2023-11-01 16:41:11\"}', 1, '2023-11-01 16:41:11', '2023-11-01 16:41:11');
INSERT INTO `n_log_actions` VALUES (623, 'quotes', 'update_customer', 128, 1, 0, '{\"seri\":{\"old\":\"BG-000128\",\"new\":\"BG-000129\"}}', 1, '2023-11-01 16:41:14', '2023-11-01 16:41:14');
INSERT INTO `n_log_actions` VALUES (624, 'customers', 'insert', 21, 1, 0, '{\"name\":\"C\\u00d4NG TY HNA\",\"contacter\":\"Mr \\u0110\\u1ee9c\",\"phone\":\"0382700882\",\"telephone\":\"0382700882\",\"email\":\"zalo\",\"address\":\"171 Kim M\\u00e3 - HN\",\"city\":\"351\",\"tax_code\":null,\"status\":\"1\",\"note\":null,\"act\":\"1\",\"created_at\":\"02\\/11\\/2023 8:39\",\"updated_at\":\"02\\/11\\/2023 8:39\"}', 1, '2023-11-02 08:41:33', '2023-11-02 08:41:33');
INSERT INTO `n_log_actions` VALUES (625, 'quotes', 'insert_customer', 129, 1, 0, '{\"name\":\"C\\u00d4NG TY HNA\",\"contacter\":\"Mr \\u0110\\u1ee9c\",\"phone\":\"0382700882\",\"telephone\":\"0382700882\",\"email\":\"zalo\",\"address\":\"171 Kim M\\u00e3 - HN\",\"city\":\"351\",\"seri\":\"BG-000129\",\"customer_id\":\"21\",\"company_name\":\"C\\u00d4NG TY HNA\",\"status\":\"not_accepted\",\"created_by\":1,\"created_at\":\"2023-11-02 08:41:50\",\"act\":1,\"updated_at\":\"2023-11-02 08:41:50\"}', 1, '2023-11-02 08:41:50', '2023-11-02 08:41:50');
INSERT INTO `n_log_actions` VALUES (626, 'quotes', 'removeDataTable', 100, 16, 0, '{\"id\":100,\"seri\":\"BG-000100\",\"status\":\"not_accepted\",\"name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"product_qty\":null,\"customer_id\":19,\"company_name\":\"CTY CP IN & S\\u1ea2N XU\\u1ea4T BAO B\\u00cc TU\\u1ea4N DUNG\",\"contacter\":\"Mr Tu\\u1ea5n\",\"address\":\"L\\u00f4 D5-16 C\\u1ee5m L\\u00e0ng Ngh\\u1ec1 Tri\\u1ec1u kh\\u00fac - T\\u00e2n Tri\\u1ec1u - HN\",\"email\":\"kd1.intuandung@gmail.com\",\"phone\":\"0963303999\",\"telephone\":\"02438303888\",\"city\":null,\"profit\":null,\"ship_price\":null,\"total_cost\":null,\"total_amount\":null,\"note\":null,\"act\":1,\"src\":null,\"created_at\":\"2023-10-18 06:00:22\",\"updated_at\":\"2023-10-18 06:00:22\",\"created_by\":1}', 1, '2023-11-18 06:21:20', '2023-11-18 06:21:20');
INSERT INTO `n_log_actions` VALUES (627, 'orders', 'removeDataTable', 23, 16, 0, '{\"id\":23,\"code\":\"DH-000023\",\"name\":null,\"customer\":19,\"vat\":0,\"total_amount\":\"550686462\",\"advance\":\"0\",\"rest\":\"550686462\",\"rest_bill\":null,\"status\":\"not_accepted\",\"rest_note\":null,\"ship_note\":null,\"quote\":null,\"act\":1,\"created_at\":\"2023-10-14 16:27:56\",\"updated_at\":\"2023-10-14 16:27:56\",\"created_by\":1}', 1, '2023-11-18 06:21:41', '2023-11-18 06:21:41');
INSERT INTO `n_log_actions` VALUES (628, 'orders', 'removeDataTable', 22, 16, 0, '{\"id\":22,\"code\":\"DH-000022\",\"name\":null,\"customer\":19,\"vat\":0,\"total_amount\":\"207828826\",\"advance\":\"0\",\"rest\":\"207828826\",\"rest_bill\":null,\"status\":\"not_accepted\",\"rest_note\":null,\"ship_note\":null,\"quote\":null,\"act\":1,\"created_at\":\"2023-10-14 16:27:52\",\"updated_at\":\"2023-10-14 16:27:52\",\"created_by\":1}', 1, '2023-11-18 06:21:41', '2023-11-18 06:21:41');
INSERT INTO `n_log_actions` VALUES (629, 'c_designs', 'removeDataTable', 13, 16, 0, '{\"id\":13,\"code\":\"TK-DH-000008A\",\"name\":null,\"order\":8,\"product\":14,\"customer\":null,\"demo_expired\":null,\"expired\":null,\"note\":null,\"status\":\"not_accepted\",\"act\":1,\"created_by\":4,\"assign_by\":null,\"created_at\":\"2023-09-28 15:32:59\",\"updated_at\":\"2023-09-28 15:32:59\"}', 1, '2023-11-18 06:22:52', '2023-11-18 06:22:52');
INSERT INTO `n_log_actions` VALUES (630, 'c_designs', 'removeDataTable', 12, 16, 0, '{\"id\":12,\"code\":\"TK-DH-000008B\",\"name\":null,\"order\":8,\"product\":15,\"customer\":null,\"demo_expired\":null,\"expired\":null,\"note\":null,\"status\":\"not_accepted\",\"act\":1,\"created_by\":4,\"assign_by\":null,\"created_at\":\"2023-09-28 15:30:23\",\"updated_at\":\"2023-09-28 15:30:23\"}', 1, '2023-11-18 06:22:52', '2023-11-18 06:22:52');
INSERT INTO `n_log_actions` VALUES (631, 'c_designs', 'removeDataTable', 11, 16, 0, '{\"id\":11,\"code\":\"TK-DH-000008C\",\"name\":null,\"order\":8,\"product\":16,\"customer\":null,\"demo_expired\":null,\"expired\":null,\"note\":null,\"status\":\"not_accepted\",\"act\":1,\"created_by\":4,\"assign_by\":null,\"created_at\":\"2023-09-28 15:21:58\",\"updated_at\":\"2023-09-28 15:21:58\"}', 1, '2023-11-18 06:22:52', '2023-11-18 06:22:52');
INSERT INTO `n_log_actions` VALUES (632, 'c_supplies', 'removeDataTable', 8, 16, 0, '{\"id\":8,\"code\":\"XVT-000008\",\"size_type\":70,\"qty\":\"10300\",\"product\":53,\"supply\":98,\"supp_type\":\"paper\",\"note\":null,\"status\":\"handling\",\"act\":1,\"created_by\":6,\"created_at\":\"2023-10-07 08:50:16\",\"updated_at\":\"2023-10-07 08:50:16\"}', 1, '2023-11-18 06:23:03', '2023-11-18 06:23:03');
INSERT INTO `n_log_actions` VALUES (633, 'c_supplies', 'removeDataTable', 7, 16, 0, '{\"id\":7,\"code\":\"XVT-000007\",\"size_type\":75,\"qty\":\"10400\",\"product\":52,\"supply\":94,\"supp_type\":\"paper\",\"note\":null,\"status\":\"handling\",\"act\":1,\"created_by\":6,\"created_at\":\"2023-10-07 08:43:56\",\"updated_at\":\"2023-10-07 08:43:56\"}', 1, '2023-11-18 06:23:03', '2023-11-18 06:23:03');
INSERT INTO `n_log_actions` VALUES (634, 'c_supplies', 'removeDataTable', 6, 16, 0, '{\"id\":6,\"code\":\"XVT-000006\",\"size_type\":73,\"qty\":\"10400\",\"product\":54,\"supply\":99,\"supp_type\":\"paper\",\"note\":null,\"status\":\"handling\",\"act\":1,\"created_by\":6,\"created_at\":\"2023-10-07 08:30:31\",\"updated_at\":\"2023-10-07 08:30:31\"}', 1, '2023-11-18 06:23:03', '2023-11-18 06:23:03');

-- ----------------------------
-- Table structure for n_modules
-- ----------------------------
DROP TABLE IF EXISTS `n_modules`;
CREATE TABLE `n_modules`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `table_map` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `link` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parent` int(10) NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `background_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `menu` tinyint(4) NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `ord` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `map_indx`(`table_map`) USING BTREE,
  INDEX `parent_index`(`parent`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of n_modules
-- ----------------------------
INSERT INTO `n_modules` VALUES (1, 'p_quotes', NULL, 'Báo giá', 'javascript:void(0)', NULL, 'money', NULL, 1, 1, 0, '2022-06-22 15:00:34', '2022-06-22 15:00:34');
INSERT INTO `n_modules` VALUES (2, 'customers', 'customers', 'Khách hàng', 'view/customers', 1, NULL, NULL, 1, 1, 0, '2022-06-21 14:45:35', '2022-06-21 14:45:35');
INSERT INTO `n_modules` VALUES (3, 'quotes', 'quotes', 'Báo giá', 'view/quotes', 1, NULL, NULL, 1, 1, 0, '2022-10-10 16:34:44', '2022-10-10 16:34:44');
INSERT INTO `n_modules` VALUES (5, 'p_users', NULL, 'Bảo mật', 'javascript:void(0)', NULL, 'key', NULL, 1, 1, 3, '2022-10-11 20:10:00', '2022-10-11 20:10:00');
INSERT INTO `n_modules` VALUES (6, 'n_users', 'n_users', 'Tài khoản', 'view/n_users', 5, NULL, NULL, 1, 1, 0, '2022-10-10 22:19:09', '2022-10-10 22:19:09');
INSERT INTO `n_modules` VALUES (7, 'n_group_users', 'n_group_users', 'Nhóm quyền', 'view/n_group_users', 5, NULL, NULL, 1, 1, 0, '2022-06-22 14:07:39', '2022-06-22 14:07:43');
INSERT INTO `n_modules` VALUES (8, 'n_roles', 'n_roles', 'Phân quyền', 'grant-permissions', 5, NULL, NULL, 1, 1, 0, '2022-07-19 19:11:42', '2022-07-19 19:11:42');
INSERT INTO `n_modules` VALUES (9, 'p_configs', NULL, 'Chi phí', 'javascript:void(0)', NULL, 'credit-card', NULL, 1, 1, 2, '2022-10-11 20:09:58', '2022-10-11 20:09:58');
INSERT INTO `n_modules` VALUES (10, 'q_configs', 'q_configs', 'Thông tin chung', 'view/q_configs', 9, NULL, NULL, 1, 1, 0, '2022-06-29 22:56:00', '2022-06-29 22:56:00');
INSERT INTO `n_modules` VALUES (11, 'q_papers', 'q_papers', 'Tờ in', 'view/q_papers', 3, NULL, NULL, 0, 1, 0, '2022-06-30 16:41:30', '2022-06-30 16:41:30');
INSERT INTO `n_modules` VALUES (12, 'q_devices', 'q_devices', 'ĐG thiết bị máy', 'view/q_devices', 9, NULL, NULL, 1, 1, 0, '2022-10-10 22:18:56', '2022-10-10 22:18:56');
INSERT INTO `n_modules` VALUES (13, 'q_printer_devices', 'q_printer_devices', 'ĐG máy in', 'view/q_printer_devices', 9, NULL, NULL, 1, 1, 0, '2022-10-10 16:35:40', '2022-10-10 16:35:40');
INSERT INTO `n_modules` VALUES (14, 'q_laminate_materals', 'q_laminate_materals', 'Chất liệu cán màng', 'view/q_laminate_materals', 9, NULL, NULL, 1, 1, 0, '2022-06-30 23:31:34', '2022-06-30 23:31:34');
INSERT INTO `n_modules` VALUES (15, 'q_supply_prices', 'q_supply_prices', 'Định lượng vật tư', 'view/q_supply_prices', 9, NULL, NULL, 1, 1, 0, '2022-10-10 16:35:18', '2022-10-10 16:35:18');
INSERT INTO `n_modules` VALUES (16, 'q_supplies', 'q_supplies', 'Vật tư', 'view/q_supplies', 9, NULL, NULL, 1, 1, 0, '2022-10-10 16:35:22', '2022-10-10 16:35:22');
INSERT INTO `n_modules` VALUES (17, 'p_orders', NULL, 'Đơn hàng', 'javascript:void(0)', NULL, 'file-text', NULL, 1, 1, 1, '2022-10-11 20:09:53', '2022-10-11 20:09:53');
INSERT INTO `n_modules` VALUES (18, 'orders', 'orders', 'Đơn hàng của tôi', 'view/orders', 17, NULL, NULL, 1, 1, 0, '2022-10-11 21:28:12', '2022-10-11 21:28:12');
INSERT INTO `n_modules` VALUES (19, 'p_substances', 'p_substances', 'Chất liệu giấy', 'view/p_substances', 9, NULL, NULL, 1, 1, 0, '2022-10-31 23:17:50', '2022-10-31 23:17:50');
INSERT INTO `n_modules` VALUES (20, 'product_categories', 'product_categories', 'Danh mục SP', 'view/product_categories', 9, NULL, NULL, 1, 1, 0, '2022-10-31 23:17:50', '2022-10-31 23:17:50');
INSERT INTO `n_modules` VALUES (21, 'products', 'products', 'Danh sách SP', 'view/products', 17, NULL, NULL, 0, 0, 0, '2022-10-11 21:28:12', '2022-10-11 21:28:12');
INSERT INTO `n_modules` VALUES (22, 'c_designs', 'c_designs', 'Lệnh Thiết kế', 'view/c_designs', 17, NULL, NULL, 0, 1, 0, '2022-12-13 22:07:55', '2022-12-13 22:07:55');
INSERT INTO `n_modules` VALUES (23, 'c_processes', 'c_processes', 'Lệnh Sản xuất', 'view/c_processes', 17, NULL, NULL, 0, 1, 0, '2022-12-13 22:07:54', '2022-12-13 22:07:54');

-- ----------------------------
-- Table structure for n_regions
-- ----------------------------
DROP TABLE IF EXISTS `n_regions`;
CREATE TABLE `n_regions`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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

-- ----------------------------
-- Table structure for n_roles
-- ----------------------------
DROP TABLE IF EXISTS `n_roles`;
CREATE TABLE `n_roles`  (
  `role_id` int(10) NOT NULL AUTO_INCREMENT,
  `module_id` int(10) NULL DEFAULT NULL,
  `n_group_user_id` int(10) NULL DEFAULT NULL,
  `json_data_role` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`) USING BTREE,
  INDEX `foreign_indx`(`module_id`, `n_group_user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 73 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of n_roles
-- ----------------------------
INSERT INTO `n_roles` VALUES (1, 2, 1, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (2, 3, 1, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (3, 6, 1, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (4, 7, 1, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (5, 8, 1, '{\"view\":1,\"update\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (6, 10, 1, '{\"view\":1,\"update\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (7, 11, 1, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (8, 12, 1, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (9, 13, 1, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (10, 14, 1, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (11, 15, 1, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (12, 16, 1, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (13, 18, 1, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (14, 19, 1, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (15, 20, 1, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (16, 21, 1, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (17, 22, 1, '{\"accept\":1,\"receive\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (18, 23, 1, '{\"accept\":1,\"receive\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (19, 2, 43, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (20, 3, 43, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (21, 6, 43, '{\"view\":\"1\",\"insert\":\"1\",\"update\":\"1\",\"remove\":\"1\",\"view_my\":\"1\",\"update_my\":\"1\",\"remove_my\":\"1\"}', '2023-02-23 07:08:32', '2023-02-23 00:08:32', NULL);
INSERT INTO `n_roles` VALUES (22, 7, 43, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (23, 8, 43, '{\"view\":1,\"update\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (24, 10, 43, '{\"view\":1,\"update\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (25, 11, 43, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (26, 12, 43, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (27, 13, 43, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (28, 14, 43, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (29, 15, 43, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (30, 16, 43, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (31, 18, 43, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (32, 19, 43, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (33, 20, 43, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (34, 21, 43, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (35, 22, 43, '{\"accept\":1,\"receive\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (36, 23, 43, '{\"accept\":1,\"receive\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (37, 2, 44, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (38, 3, 44, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (39, 6, 44, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (40, 7, 44, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (41, 8, 44, '{\"view\":1,\"update\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (42, 10, 44, '{\"view\":1,\"update\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (43, 11, 44, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (44, 12, 44, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (45, 13, 44, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (46, 14, 44, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (47, 15, 44, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (48, 16, 44, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (49, 18, 44, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (50, 19, 44, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (51, 20, 44, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (52, 21, 44, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (53, 22, 44, '{\"accept\":1,\"receive\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (54, 23, 44, '{\"accept\":1,\"receive\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (55, 2, 45, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (56, 3, 45, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (57, 6, 45, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (58, 7, 45, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (59, 8, 45, '{\"view\":1,\"update\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (60, 10, 45, '{\"view\":1,\"update\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (61, 11, 45, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (62, 12, 45, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (63, 13, 45, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (64, 14, 45, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (65, 15, 45, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (66, 16, 45, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (67, 18, 45, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (68, 19, 45, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (69, 20, 45, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (70, 21, 45, '{\"view\":1,\"insert\":1,\"update\":1,\"remove\":1,\"view_my\":1,\"update_my\":1,\"remove_my\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (71, 22, 45, '{\"accept\":1,\"receive\":1}', NULL, NULL, NULL);
INSERT INTO `n_roles` VALUES (72, 23, 45, '{\"accept\":1,\"receive\":1}', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for n_tables
-- ----------------------------
DROP TABLE IF EXISTS `n_tables`;
CREATE TABLE `n_tables`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `admin_paginate` int(10) NULL DEFAULT NULL,
  `view_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ext_action` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `insert` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `update` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `remove` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `copy` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `indx`(`id`, `name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of n_tables
-- ----------------------------
INSERT INTO `n_tables` VALUES (1, 'n_users', 'Nhân viên', NULL, 10, 'view', NULL, '1', '1', '1', '1', '2023-05-23 14:43:41', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (2, 'n_group_users', 'Nhóm quyền', NULL, 10, 'view', NULL, '1', '1', '1', '1', '2023-04-23 11:30:46', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (3, 'n_roles', 'Phân quyền', NULL, 10, 'view', NULL, '1', '1', '1', '1', '2023-04-23 11:30:46', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (4, 'files', 'Kho Lưu trữ', NULL, 24, 'media', NULL, '1', '1', '1', '1', '2023-04-23 11:30:46', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (5, 'quote_configs', 'Thông tin chung & Giá thành', NULL, 100, 'config', NULL, '1', '1', '1', '1', '2023-05-09 16:15:02', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (6, 'customers', 'Khách hàng', NULL, 10, 'view', NULL, '1', '1', '1', '1', '2023-04-23 11:30:46', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (7, 'quotes', 'Báo giá', NULL, 10, 'view', '[\r\n	{\r\n		\"icon\":\"plus\",\r\n		\"note\":\"Thêm đơn hàng\", \r\n		\"link\":\"insert/orders?quote=\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"accepted\"}\r\n		]\r\n	},\r\n	{\r\n		\"icon\":\"check\",\r\n		\"note\":\"Khách đã chốt giá\", \r\n		\"link\":\"apply-quote/\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"not_accepted\"}\r\n		]\r\n	}\r\n]', '1', '1', '1', '1', '2023-05-19 14:09:25', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (8, 'q_papers', 'Tờ in', NULL, 10, 'view', NULL, '1', '1', '1', '1', '2023-04-23 11:30:46', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (9, 'devices', 'Thiết bị & Chi phí', '{\r\n	\"link\":\"config-device-price/supply_types?type=devices\", \r\n	\"note\":\"Danh sách thiết bị máy theo vật tư\"\r\n}', 10, 'view', NULL, '1', '1', '1', '1', '2023-04-23 11:30:46', '2023-08-30 04:55:37');
INSERT INTO `n_tables` VALUES (10, 'materals', 'Chất liệu vật tư', NULL, 10, 'view', NULL, '1', '1', '1', '1', '2023-04-28 10:32:23', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (11, 'printers', 'Máy in & chi phí', NULL, 10, 'view', NULL, '1', '1', '1', '1', '2023-04-28 00:18:55', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (13, 'supply_types', 'Vật tư tham gia sx', NULL, 10, 'view', '[\r\n	{\r\n	\"icon\":\"list-ul\",\r\n	\"note\":\"Đơn giá định lượng\", \r\n	\"link\":\"view/supply_prices?default_data={%22supply_id%22:%22<id>%22}\",\r\n	\"condition\":[\r\n			{\"key\":\"is_name\", \"value\":\"0\"}\r\n		]\r\n	}\r\n]', '1', '1', '1', '1', '2023-07-17 19:30:41', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (14, 'supply_prices', 'Đơn giá vật tư', NULL, 20, 'view', NULL, '1', '1', '1', '1', '2023-04-28 10:33:01', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (18, 'orders', 'Đơn hàng', NULL, 20, 'view', '[\r\n	{\r\n	\"icon\":\"list-ul\",\r\n	\"note\":\"DS sản phẩm\", \r\n	\"link\":\"view/products?default_data={%22order%22:%22<id>%22}\"\r\n	}\r\n]', '0', '1', '1', '1', '2023-06-21 13:22:33', '2023-09-15 21:19:43');
INSERT INTO `n_tables` VALUES (19, 'p_substances', 'Chất liệu giấy in', NULL, 20, 'view', NULL, '1', '1', '1', '1', '2023-04-23 11:30:46', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (20, 'product_categories', 'Nhóm sản phẩm', '', 20, 'view', '[\r\n	{\r\n	\"icon\":\"list-ul\",\r\n	\"note\":\"Kiểu hộp\", \r\n	\"link\":\"view/product_styles?default_data={%22category%22:%22<id>%22}\"\r\n	}\r\n]', '0', '1', '0', '0', '2023-04-23 11:30:46', '2023-09-25 20:54:00');
INSERT INTO `n_tables` VALUES (21, 'products', 'Đơn sản phẩm', NULL, 20, 'view', '[\r\n	{\r\n	\"icon\":\"spinner\",\r\n	\"note\":\"Vật tư sản xuất\", \r\n	\"link\":\"list-supply-process?product=\"\r\n	}\r\n]', '0', '1', '0', '1', '2023-04-23 11:30:46', '2023-09-21 10:54:38');
INSERT INTO `n_tables` VALUES (22, 'c_designs', 'Lệnh thiết kế', NULL, 20, 'view', '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"level-down\",\"note\":\"Nhận lệnh\", \r\n		\"class\":\"__receive_command\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"not_accepted\"}\r\n		]\r\n	}\r\n]', '0', '1', '1', '0', '2023-06-30 17:43:12', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (23, 'c_supplies', 'Yêu cầu Xuất vật tư', NULL, 20, 'view', '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"share\",\"note\":\"Xác nhận xuất vật tư\", \r\n		\"class\":\"__confirm_ex_supp\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"handling\"}\r\n		]\r\n	}\r\n]', '0', '0', '1', '0', '2023-07-14 03:17:55', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (24, 'n_log_actions', 'Lịch sử thao tác', NULL, 10, 'history', NULL, '', '', '1', '', '2023-05-23 14:43:41', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (25, 'w_users', 'Công nhân', '{\r\n	\"link\":\"list-worker-by-device/machine\", \r\n	\"note\":\"DS tổ máy\"\r\n}', 10, 'view', '', '1', '1', '1', '1', '2023-05-23 14:43:41', '2023-09-11 11:17:39');
INSERT INTO `n_tables` VALUES (26, 'paper_extends', 'Tên phụ giấy in', NULL, 10, 'view', '', '1', '1', '1', '1', '2023-07-17 19:30:41', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (27, 'supply_warehouses', 'Kho vật tư (carton, cao su, mút xốp, mica,...)', '{\r\n	\"link\":\"warehouse-management\", \r\n	\"note\":\"Quản lí kho vật tư\"\r\n}', 10, 'view', '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"undo\",\"note\":\"Xác nhận nhập kho vật tư\", \r\n		\"class\":\"__confirm_im_supp\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"waiting\"}\r\n		]\r\n	}\r\n]', '1', '1', '1', '1', '2023-07-14 03:17:55', '2023-08-16 19:43:11');
INSERT INTO `n_tables` VALUES (28, 'print_warehouses', 'Kho vật tư (giấy in)', '{\r\n	\"link\":\"warehouse-management\", \r\n	\"note\":\"Quản lí kho vật tư\"\r\n}', 10, 'view', '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"undo\",\"note\":\"Xác nhận nhập kho vật tư\", \r\n		\"class\":\"__confirm_im_supp\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"waiting\"}\r\n		]\r\n	}\r\n]', '1', '1', '1', '1', '2023-07-14 03:17:55', '2023-11-16 00:44:11');
INSERT INTO `n_tables` VALUES (29, 'other_warehouses', 'Kho vật tư (nam châm)', '{\r\n	\"link\":\"warehouse-management\", \r\n	\"note\":\"Quản lí kho vật tư\"\r\n}', 10, 'view', '', '1', '1', '1', '1', '2023-07-14 03:17:55', '2023-09-11 11:17:42');
INSERT INTO `n_tables` VALUES (30, 'square_warehouses', 'Kho vật tư (vật tư màng, nhung, vải lụa)', '{\r\n	\"link\":\"warehouse-management\", \r\n	\"note\":\"Quản lí kho vật tư\"\r\n}', 10, 'view', '', '1', '1', '1', '1', '2023-07-14 03:17:55', '2023-09-11 18:44:57');
INSERT INTO `n_tables` VALUES (32, 'w_salaries', 'Bảng chấm công - công nhân', '', 10, 'view', '', '0', '0', '1', '0', '2023-07-14 03:17:55', '2023-08-17 16:35:47');
INSERT INTO `n_tables` VALUES (33, 'supply_names', 'Tên phụ vật tư', NULL, 10, 'view', '', '1', '1', '1', '1', '2023-07-17 19:30:41', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (34, 'papers', 'Vật tư giấy', NULL, 20, 'view', '', '0', '1', '0', '0', '2023-06-21 13:22:33', '2023-09-16 05:48:43');
INSERT INTO `n_tables` VALUES (35, 'supplies', 'Vật tư hộp cứng', NULL, 20, 'view', '', '0', '1', '0', '0', '2023-06-21 13:22:33', '2023-09-15 21:19:43');
INSERT INTO `n_tables` VALUES (36, 'fill_finishes', 'Bồi & hoàn thiện', NULL, 20, 'view', '', '0', '1', '0', '0', '2023-06-21 13:22:33', '2023-09-17 10:54:34');
INSERT INTO `n_tables` VALUES (37, 'product_styles', 'Kiểu hộp', '{\r\n	\"link\":\"view/product_categories\", \r\n	\"note\":\"Nhóm sản phẩm\"\r\n}', 20, 'view', '', '1', '1', '1', '1', '2023-06-21 13:22:33', '2023-09-20 15:05:49');
INSERT INTO `n_tables` VALUES (38, 'warehouse_providers', 'Nhà cung cấp vật tư', NULL, 10, 'view', '', '1', '1', '1', '1', '2023-07-17 19:30:41', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (39, 'supply_buyings', 'Yêu cầu mua vật tư', NULL, 10, 'view', '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"check-circle-o\",\r\n		\"note\":\"Duyệt mua vật tư\", \r\n		\"class\":\"__confirm_buying\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"not_accepted\"}\r\n		]\r\n	},\r\n	{\r\n		\"type\":2,\r\n		\"detailonly\":1,\r\n		\"icon\":\"check-square-o\",\"note\":\"Xác nhận đã mua\", \r\n		\"class\":\"__confirm_bought\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"accepted\"}\r\n		]\r\n	},\r\n	{\r\n		\"type\":2,\r\n		\"detailonly\":1,\r\n		\"icon\":\"check-square\",\"note\":\"Xác nhận nhập kho\", \r\n		\"class\":\"__confirm_warehouse_imported\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"bought\"}\r\n		]\r\n	}\r\n]', '1', '1', '1', '1', '2023-07-17 19:30:41', '2023-11-17 00:17:48');

-- ----------------------------
-- Table structure for n_users
-- ----------------------------
DROP TABLE IF EXISTS `n_users`;
CREATE TABLE `n_users`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `group_user` int(10) NULL DEFAULT NULL,
  `super_admin` tinyint(4) NULL DEFAULT 0,
  `dev` tinyint(4) NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of n_users
-- ----------------------------
INSERT INTO `n_users` VALUES (1, 'NghiemTuan', 'cba46d1d20406eb6d12420463a291668', 'Nghiêm Thanh Tuấn', 'kd1.intuandung@gmail.com', '0963.303.999', 1, 0, 1, 'giám đốc', 1, '2023-07-14 02:02:00', '2023-09-24 08:44:00', 1);
INSERT INTO `n_users` VALUES (2, 'kinhdoanh', 'e10adc3949ba59abbe56e057f20f883e', 'kinhdoanh', 'sale@gmail.com', '0123456789', 2, 0, NULL, 'test nhan vien kinh doanh', 1, '2023-07-14 02:02:00', '2023-08-04 13:20:13', 1);
INSERT INTO `n_users` VALUES (3, 'thietke1', 'e10adc3949ba59abbe56e057f20f883e', 'thietke - Mr Hùng', 'design@gmail.com', '0987654321', 4, 0, NULL, 'test design', 1, '2023-07-14 02:02:00', '2023-09-28 11:02:56', 1);
INSERT INTO `n_users` VALUES (4, 'kythuatduyetlenh1', 'e10adc3949ba59abbe56e057f20f883e', 'kythuatduyetlenh - Mr Dũng', 'sanxuatitd@gmail.com', '0234567912', 3, 0, NULL, 'Technical apply order group tests', 1, '2023-07-14 02:02:00', '2023-09-23 15:13:04', 1);
INSERT INTO `n_users` VALUES (5, 'kythuatsx1', 'e10adc3949ba59abbe56e057f20f883e', 'kythuatsx - Mr Dũng', 'techhanle@gmail.com', '0123456789', 5, 0, NULL, NULL, 1, '2023-07-14 02:02:00', '2023-09-23 15:14:06', 1);
INSERT INTO `n_users` VALUES (6, 'kehoach1', 'e10adc3949ba59abbe56e057f20f883e', 'kehoach - Ms Hường', 'baobituandung@intuandung.vn', '0234567819', 6, 0, NULL, 'Test ke hoach san xuat', 1, '2023-07-14 02:02:00', '2023-09-23 15:15:54', 1);
INSERT INTO `n_users` VALUES (7, 'khovattu', 'e10adc3949ba59abbe56e057f20f883e', 'Test kho vật tư', 'khovattu', '2345098123', 7, 0, NULL, 'test', 1, '2023-07-14 02:02:00', '2023-09-25 16:24:03', 1);
INSERT INTO `n_users` VALUES (10, 'HoangDung', '59aa841f18386f5c6a7c99e541ae022d', 'Hoàng Dung', 'intuandung2000@gmail.com', '0969303888', 1, 0, NULL, NULL, 1, '2023-09-23 14:24:46', '2023-10-07 08:28:33', 1);
INSERT INTO `n_users` VALUES (11, 'kythuatduyetlenh2', 'e10adc3949ba59abbe56e057f20f883e', 'kythuatduyetlenh - Mr Thông', 'sanxuatitd@gmail.com', '0234567912', 3, 0, NULL, 'Technical apply order group tests', 1, '2023-09-23 15:13:27', '2023-09-23 15:13:27', 10);
INSERT INTO `n_users` VALUES (12, 'kythuatsx2', 'e10adc3949ba59abbe56e057f20f883e', 'kythuatsx - Mr Thông', 'techhanle@gmail.com', '0123456789', 5, 0, NULL, NULL, 1, '2023-09-23 15:14:41', '2023-09-23 15:14:41', 10);
INSERT INTO `n_users` VALUES (13, 'khovattu2', 'e10adc3949ba59abbe56e057f20f883e', 'KHO VẬT TƯ - Ms MAI', 'kd1.intuandung@gmail.com', '0963303999', 7, 0, NULL, NULL, 1, '2023-09-29 15:18:49', '2023-09-29 15:18:49', 1);
INSERT INTO `n_users` VALUES (14, 'phongmuahang', 'e10adc3949ba59abbe56e057f20f883e', 'PHÒNG MUA HÀNG - Ms HUYỀN', 'kd1.intuandung@gmail.com', '0963303999', 8, 0, NULL, NULL, 1, '2023-09-29 15:20:35', '2023-09-29 15:20:35', 1);
INSERT INTO `n_users` VALUES (15, 'phongkhuonmau', 'e10adc3949ba59abbe56e057f20f883e', 'PHÒNG KHUÔN MẪU', 'in88.vn@gmail.com', '0963303999', 9, 0, NULL, NULL, 1, '2023-09-29 15:21:33', '2023-10-06 06:50:57', 1);
INSERT INTO `n_users` VALUES (16, 'dev', 'e10adc3949ba59abbe56e057f20f883e', 'khanh', '', '0123456789', 1, 0, NULL, 'khanh', 1, '2023-07-14 02:02:00', '2023-11-16 01:15:52', 1);
INSERT INTO `n_users` VALUES (17, 'duyetmua', 'e10adc3949ba59abbe56e057f20f883e', 'Duyệt Mua', 'duyetmua', '0123456789', 8, 0, NULL, 'Duyệt yêu cầu mua hàng', 1, '2023-11-16 01:20:31', '2023-11-16 01:20:31', 16);
INSERT INTO `n_users` VALUES (18, 'muahang', 'e10adc3949ba59abbe56e057f20f883e', 'Mua hàng', 'muahang', '0987', 10, 0, NULL, 'Phòng mua vật tư', 1, '2023-11-16 03:40:59', '2023-11-16 03:40:59', 16);

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `customer` int(10) NULL DEFAULT NULL,
  `vat` tinyint(4) NULL DEFAULT NULL,
  `total_amount` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `advance` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `rest` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `rest_bill` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `rest_note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ship_note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `quote` int(10) NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx`(`created_by`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for other_warehouses
-- ----------------------------
DROP TABLE IF EXISTS `other_warehouses`;
CREATE TABLE `other_warehouses`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `qty` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `supp_price` int(10) NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of other_warehouses
-- ----------------------------
INSERT INTO `other_warehouses` VALUES (31, 'Nam châm nhỏ loại 1', '100000', 'magnet', 17, NULL, 'imported', 1, '2023-08-16 15:33:36', '2023-08-16 15:33:36', 1);

-- ----------------------------
-- Table structure for p_substances
-- ----------------------------
DROP TABLE IF EXISTS `p_substances`;
CREATE TABLE `p_substances`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `index`(`id`, `name`, `act`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for paper_extends
-- ----------------------------
DROP TABLE IF EXISTS `paper_extends`;
CREATE TABLE `paper_extends`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã nhóm',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Tên nhóm',
  `category` int(10) NULL DEFAULT NULL COMMENT 'Cha',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Ghi chú',
  `act` tinyint(4) NULL DEFAULT NULL,
  `ord` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NOT NULL,
  `is_name` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name_index`(`name`) USING BTREE,
  INDEX `type_index`(`category`) USING BTREE,
  INDEX `act_indx`(`act`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of paper_extends
-- ----------------------------
INSERT INTO `paper_extends` VALUES (1, 'TỜ BỒI THÀNH', 6, NULL, 1, NULL, '2023-07-26 07:51:00', '2023-09-14 19:49:42', 1, 1);
INSERT INTO `paper_extends` VALUES (2, 'TỜ BỒI KHAY ĐỊNH HÌNH', 6, NULL, 1, NULL, '2023-07-26 07:51:00', '2023-09-14 19:49:35', 1, 1);
INSERT INTO `paper_extends` VALUES (3, 'TỜ BỒI MẶT THÉP', 6, NULL, 1, NULL, '2023-07-26 07:52:00', '2023-07-27 15:57:22', 1, 1);
INSERT INTO `paper_extends` VALUES (4, 'TỜ BỒI NẮP HỘP', 6, NULL, 1, NULL, '2023-07-26 07:52:00', '2023-07-27 15:57:07', 1, 1);
INSERT INTO `paper_extends` VALUES (5, 'TỜ BỒI ĐÁY HỘP', 6, NULL, 1, NULL, '2023-07-26 07:52:00', '2023-07-27 15:56:54', 1, 1);
INSERT INTO `paper_extends` VALUES (6, 'TEM CUỘN', 4, NULL, 1, NULL, '0000-00-00 00:00:00', '2023-07-27 15:55:59', 1, 1);
INSERT INTO `paper_extends` VALUES (7, 'TOA IN GHÉP', 6, NULL, 1, NULL, '2023-07-26 07:53:00', '2023-07-27 15:55:47', 1, 1);
INSERT INTO `paper_extends` VALUES (56, 'HỘP GIẤY', 2, NULL, 1, NULL, '2023-07-27 18:15:17', '2023-09-14 19:48:54', 1, 1);
INSERT INTO `paper_extends` VALUES (57, 'TÚI GIẤY', 3, NULL, 1, NULL, '2023-08-30 09:25:34', '2023-08-30 09:25:34', 1, NULL);
INSERT INTO `paper_extends` VALUES (58, 'KHAY GIẤY ĐỊNH HÌNH', 2, NULL, 1, NULL, '2023-09-14 19:49:07', '2023-09-14 19:49:07', 1, NULL);

-- ----------------------------
-- Table structure for paper_lots
-- ----------------------------
DROP TABLE IF EXISTS `paper_lots`;
CREATE TABLE `paper_lots`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `index`(`id`, `name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for papers
-- ----------------------------
DROP TABLE IF EXISTS `papers`;
CREATE TABLE `papers`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `product_qty` bigint(20) NULL DEFAULT NULL,
  `nqty` int(10) NULL DEFAULT NULL,
  `base_supp_qty` bigint(20) NULL DEFAULT NULL,
  `compent_percent` decimal(10, 0) NULL DEFAULT NULL,
  `compent_plus` bigint(20) NULL DEFAULT NULL,
  `supp_qty` bigint(20) NULL DEFAULT NULL,
  `size` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `print` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `nilon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `metalai` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `compress` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `uv` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `elevate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `float` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `peel` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cut` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `fold` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `box_paste` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `bag_paste` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ext_cate` int(10) NULL DEFAULT NULL,
  `ext_price` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `except_handle` tinyint(4) NULL DEFAULT NULL,
  `handle_elevate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `total_cost` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `product` int(10) NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `main` tinyint(4) NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `quote_indx`(`product`) USING BTREE,
  INDEX `main_index`(`main`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 198 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of papers
-- ----------------------------
INSERT INTO `papers` VALUES (35, NULL, 'Bộ (hộp tem toa) Olymcouta', 5000, 4, 1250, 13, 0, 1263, '{\"materal\":\"13\",\"qttv\":\"400\",\"length\":\"43\",\"width\":\"49\",\"materal_price\":0.00195,\"supp_qty\":1263,\"act\":1,\"total\":2075689.98}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":250,\"handle_qty\":1250,\"model_price\":66000,\"work_price\":32,\"shape_price\":100000,\"printer\":2,\"act\":1,\"total\":696000}', '{\"materal\":\"8\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":1163,\"handle_qty\":1250,\"materal_price\":0.23,\"act\":1,\"total\":613601.43}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":5050,\"handle_qty\":1250,\"nqty\":4,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"float\":{\"price\":\"50\",\"shape_price\":\"80000\",\"qty_pro\":5050,\"nqty\":4,\"float_cost\":572500},\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":1163,\"handle_qty\":1250,\"cost\":590500,\"act\":1,\"total\":1163000}', NULL, '{\"act\":0}', NULL, NULL, '{\"machine\":\"6\",\"note\":null,\"model_price\":0,\"work_price\":50,\"shape_price\":100000,\"qty_pro\":5050,\"handle_qty\":5050,\"act\":1,\"total\":352500}', NULL, 2, '{\"temp_price\":\"450\",\"prescript_price\":\"120\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":5000,\"act\":1,\"total\":2850000}', 0, NULL, '7750791.41', 20, NULL, 1, 1, NULL, '2023-10-06 11:52:12', '2023-10-06 11:52:12', 10);
INSERT INTO `papers` VALUES (36, NULL, 'test', 11, 1, 11, 1, 0, 12, '{\"materal\":null,\"qttv\":\"11\",\"length\":\"11\",\"width\":\"11\",\"materal_price\":0,\"supp_qty\":112,\"act\":0,\"total\":0}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 1, NULL, '0', 21, NULL, 1, 1, NULL, '2023-09-28 10:22:58', '2023-09-28 10:22:58', 10);
INSERT INTO `papers` VALUES (118, NULL, 'Bộ (hộp tem toa) Olymcouta', 5000, 4, 1250, 13, 100, 1363, '{\"materal\":\"13\",\"qttv\":\"400\",\"length\":\"43\",\"width\":\"49\",\"materal_price\":0.00195,\"supp_qty\":1363,\"act\":1,\"total\":2240035.98}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":250,\"handle_qty\":1250,\"model_price\":66000,\"work_price\":32,\"shape_price\":100000,\"printer\":2,\"act\":1,\"total\":696000}', '{\"materal\":\"8\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":1263,\"handle_qty\":1250,\"materal_price\":0.23,\"act\":1,\"total\":662062.43}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":5050,\"handle_qty\":1250,\"nqty\":4,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"float\":{\"price\":\"50\",\"shape_price\":\"80000\",\"qty_pro\":5050,\"nqty\":4,\"float_cost\":572500},\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":1263,\"handle_qty\":1250,\"cost\":605500,\"act\":1,\"total\":1178000}', NULL, '{\"act\":0}', NULL, NULL, '{\"machine\":\"6\",\"note\":null,\"model_price\":0,\"work_price\":50,\"shape_price\":100000,\"qty_pro\":5050,\"handle_qty\":5050,\"act\":1,\"total\":352500}', NULL, 2, '{\"temp_price\":\"450\",\"prescript_price\":\"120\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":5000,\"act\":1,\"total\":2850000}', 0, NULL, '7978598.41', 61, NULL, 1, 1, NULL, '2023-10-09 14:10:19', '2023-10-09 14:10:19', 10);
INSERT INTO `papers` VALUES (119, NULL, 'Bộ (hộp+tem+toa) Olymcouta ( TEM CUỘN )', 5000, 1, 5000, 50, 0, 5050, '{\"materal\":\"34\",\"qttv\":\"0\",\"length\":\"0\",\"width\":\"0\",\"materal_price\":0.0033,\"supp_qty\":5050,\"act\":0,\"total\":0}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 1, NULL, '0', 61, NULL, 0, 1, NULL, '2023-10-09 14:10:20', '2023-10-09 14:10:20', 10);
INSERT INTO `papers` VALUES (120, NULL, 'toa Olymcouta ( TOA IN GHÉP )', 5000, 1, 5000, 50, 0, 5050, '{\"materal\":\"12\",\"qttv\":\"0\",\"length\":\"0\",\"width\":\"0\",\"materal_price\":0.002,\"supp_qty\":5050,\"act\":0,\"total\":0}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, 1, NULL, '0', 61, NULL, 0, 1, NULL, '2023-10-09 14:10:20', '2023-10-09 14:10:20', 10);
INSERT INTO `papers` VALUES (121, NULL, 'Bộ ( Hộp   tem toa) Thymo glucan', 3500, 2, 1800, 68, 0, 1868, '{\"materal\":\"13\",\"qttv\":\"400\",\"length\":\"41\",\"width\":\"43\",\"materal_price\":0.0019,\"supp_qty\":1868,\"act\":1,\"total\":2502895.84}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":850,\"handle_qty\":1768,\"model_price\":66000,\"work_price\":32,\"shape_price\":100000,\"printer\":2,\"act\":1,\"total\":772800}', '{\"materal\":\"8\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":1768,\"handle_qty\":1768,\"materal_price\":0.23,\"act\":1,\"total\":766906.3200000001}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":3535,\"handle_qty\":1768,\"nqty\":2,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"float\":{\"price\":\"30\",\"shape_price\":\"70000\",\"qty_pro\":3535,\"nqty\":2,\"float_cost\":246050},\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":1768,\"handle_qty\":1768,\"cost\":629650,\"act\":1,\"total\":875700}', NULL, '{\"machine\":\"12\",\"nqty\":2,\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":3535,\"handle_qty\":3535,\"act\":1,\"total\":100700}', NULL, NULL, '{\"machine\":\"6\",\"note\":null,\"model_price\":0,\"work_price\":50,\"shape_price\":100000,\"qty_pro\":3535,\"handle_qty\":3535,\"act\":1,\"total\":276750}', NULL, 2, '{\"temp_price\":\"400\",\"prescript_price\":\"120\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":3500,\"act\":1,\"total\":1820000}', 0, NULL, '7115752.16', 62, NULL, 1, 1, NULL, '2023-10-09 14:10:25', '2023-10-09 14:10:25', 10);
INSERT INTO `papers` VALUES (122, NULL, 'Bộ ( Hộp + tem+toa) Thymo glucan ( TEM CUỘN )', 70000, 1, 70050, 750, 0, 70800, '{\"materal\":\"34\",\"qttv\":\"0\",\"length\":\"0\",\"width\":\"0\",\"materal_price\":0.0032,\"supp_qty\":70800,\"act\":0,\"total\":0}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 1, NULL, '0', 62, NULL, 0, 1, NULL, '2023-10-09 14:10:25', '2023-10-09 14:10:25', 10);
INSERT INTO `papers` VALUES (123, NULL, 'toa Thymo glucan ( TOA IN GHÉP )', 3500, 1, 3550, 85, 0, 3635, '{\"materal\":\"12\",\"qttv\":\"80\",\"length\":\"0\",\"width\":\"0\",\"materal_price\":0.00195,\"supp_qty\":3635,\"act\":0,\"total\":0}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, 1, NULL, '0', 62, NULL, 0, 1, NULL, '2023-10-09 14:10:25', '2023-10-09 14:10:25', 10);
INSERT INTO `papers` VALUES (124, NULL, 'Hộp giấy INSUVA   Toa   Tích điểm   Cẩm nang', 6700, 3, 2284, 95, 100, 2479, '{\"materal\":\"13\",\"qttv\":\"400\",\"length\":\"30\",\"width\":\"68\",\"materal_price\":0.00195,\"supp_qty\":2479,\"act\":1,\"total\":3944584.8}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":\"IN THEO M\\u1eaaU M\\u00c0U\",\"supp_qty\":1284,\"handle_qty\":2284,\"model_price\":66000,\"work_price\":35,\"shape_price\":110000,\"printer\":3,\"act\":1,\"total\":883760}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":2379,\"handle_qty\":2284,\"materal_price\":0.25,\"act\":1,\"total\":1263290}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":6767,\"handle_qty\":2284,\"nqty\":3,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"float\":{\"price\":\"50\",\"shape_price\":\"100000\",\"qty_pro\":6767,\"nqty\":3,\"float_cost\":638350},\"note\":\"Th\\u00fac n\\u1ed5i ch\\u1eef INSUVA 2 m\\u1eb7t ch\\u00ednh\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":2379,\"handle_qty\":2284,\"cost\":762850,\"act\":1,\"total\":1401200}', NULL, '{\"machine\":\"12\",\"nqty\":3,\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":6767,\"handle_qty\":6750,\"act\":1,\"total\":233010}', NULL, NULL, '{\"machine\":\"6\",\"note\":null,\"model_price\":0,\"work_price\":50,\"shape_price\":100000,\"qty_pro\":6767,\"handle_qty\":6750,\"act\":1,\"total\":438350}', NULL, 2, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"150\",\"note\":\"Ti\\u00e8n th\\u1ebb t\\u00edch \\u0111i\\u1ec3m 10 x 20\",\"qty_pro\":6700,\"act\":1,\"total\":1005000}', 0, NULL, '9169194.8', 63, NULL, 1, 1, NULL, '2023-10-09 14:13:20', '2023-10-09 14:13:20', 10);
INSERT INTO `papers` VALUES (125, NULL, 'Hộp giấy INSUVA + Toa + Cẩm nang ( TOA IN GHÉP )', 6700, 4, NULL, 0, 0, 1675, '{\"materal\":\"12\",\"qttv\":\"80\",\"length\":\"43\",\"width\":\"62\",\"materal_price\":0.002,\"supp_qty\":1675,\"act\":1,\"total\":714488}', '{\"type\":\"2\",\"color\":\"4\",\"machine\":\"1\",\"note\":\"in xong ch\\u1ec9 x\\u00e9n theo \\u1ed1c\",\"supp_qty\":-950,\"handle_qty\":50,\"model_price\":66000,\"work_price\":32,\"shape_price\":100000,\"printer\":2,\"act\":1,\"total\":420800}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":6767,\"handle_qty\":50,\"nqty\":4,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":6700,\"act\":0,\"total\":0}', 0, NULL, '1135288', 63, NULL, 0, 1, NULL, '2023-10-09 14:13:20', '2023-10-09 14:13:20', 10);
INSERT INTO `papers` VALUES (126, NULL, 'Thẻ Tích điểm ( TOA IN GHÉP )', 6700, 1, NULL, 0, 0, 6700, '{\"materal\":\"12\",\"qttv\":\"80\",\"length\":\"1\",\"width\":\"1\",\"materal_price\":0.002,\"supp_qty\":6700,\"act\":1,\"total\":1072}', '{\"type\":\"0\",\"color\":\"0\",\"machine\":\"0\",\"note\":null,\"supp_qty\":5750,\"handle_qty\":6767,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":6767,\"handle_qty\":6767,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":6700,\"act\":0,\"total\":0}', 1, NULL, '0', 63, NULL, 0, 1, NULL, '2023-10-09 14:13:20', '2023-10-09 14:13:20', 10);
INSERT INTO `papers` VALUES (138, NULL, '2024 BG khay thuyền phổ thông', 10000, 1, 10050, 250, 100, 10400, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"51\",\"width\":\"62\",\"materal_price\":0.002,\"supp_qty\":10400,\"act\":1,\"total\":7892352}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":66000,\"work_price\":35,\"shape_price\":110000,\"printer\":3,\"act\":1,\"total\":1971000}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":10300,\"handle_qty\":10050,\"materal_price\":0.25,\"act\":1,\"total\":8192150}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":10300,\"handle_qty\":10050,\"cost\":2119300,\"act\":1,\"total\":2119300}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":131000}', NULL, NULL, NULL, NULL, 1, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '20305802', 73, NULL, 1, 1, NULL, '2023-10-19 14:38:58', '2023-10-19 14:38:58', 1);
INSERT INTO `papers` VALUES (139, NULL, '2024 Trụ tròn đường kính 32 x cao12cm', 10000, 4, 2550, 100, 100, 2750, '{\"materal\":\"13\",\"qttv\":\"230\",\"length\":\"50\",\"width\":\"79\",\"materal_price\":0.00195,\"supp_qty\":2750,\"act\":1,\"total\":4871831.25}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":1550,\"handle_qty\":2550,\"model_price\":123600,\"work_price\":50,\"shape_price\":180000,\"printer\":4,\"act\":1,\"total\":1524400}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":2650,\"handle_qty\":2550,\"materal_price\":0.25,\"act\":1,\"total\":2666875}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":2550,\"nqty\":4,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"11260\",\"note\":\"g\\u1ed3m t\\u1ea5t c\\u1ea3 v\\u1eadt t\\u01b0 + 4000 c\\u00f4ng b\\u1ed3i v\\u00e0 ho\\u00e0n thi\\u1ec7n\",\"qty_pro\":10000,\"act\":1,\"total\":112600000}', 0, NULL, '121663106.25', 74, NULL, 1, 1, NULL, '2023-10-18 06:54:42', '2023-10-18 06:54:42', 1);
INSERT INTO `papers` VALUES (140, NULL, '2024 PHỤ KIỆN ĐÁY CHAI RƯỢU   CỔ CHAI', 100000, 14, 7193, 193, 100, 7486, '{\"materal\":\"13\",\"qttv\":\"400\",\"length\":\"65\",\"width\":\"58\",\"materal_price\":0.00195,\"supp_qty\":7486,\"act\":1,\"total\":22013331.599999998}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"2\",\"note\":null,\"supp_qty\":6193,\"handle_qty\":7193,\"model_price\":123600,\"work_price\":500,\"shape_price\":600000,\"printer\":11,\"act\":1,\"total\":7640200}', '{\"act\":0}', '{\"materal\":null,\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":7486,\"handle_qty\":7193,\"cover_supp_qty\":7486,\"materal_price\":0,\"metalai_price\":100000,\"materal_cover_price\":0.08,\"metalai_cover_price\":2327617.6,\"act\":1,\"total\":2427617.6}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":101000,\"handle_qty\":7193,\"nqty\":14,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":7386,\"handle_qty\":7193,\"cost\":1773400,\"act\":1,\"total\":1773400}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":101000,\"handle_qty\":7193,\"nqty\":14,\"act\":0,\"total\":0}', '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":101000,\"handle_qty\":100050,\"act\":1,\"total\":1040000}', NULL, NULL, NULL, NULL, 1, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":100000,\"act\":0,\"total\":0}', 0, NULL, '34894549.2', 75, NULL, 1, 1, NULL, '2023-10-18 07:12:54', '2023-10-18 07:12:54', 1);
INSERT INTO `papers` VALUES (141, NULL, '2024 PHỤ KIỆN ĐÁY CHAI RƯỢU + CỔ CHAI ( KHAY GIẤY ĐỊNH HÌNH )', 100000, 14, 7193, 193, 200, 7586, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"65\",\"width\":\"51\",\"materal_price\":0.002,\"supp_qty\":7586,\"act\":1,\"total\":6035421.600000001}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"2\",\"note\":null,\"supp_qty\":6193,\"handle_qty\":7193,\"model_price\":123600,\"work_price\":500,\"shape_price\":600000,\"printer\":11,\"act\":1,\"total\":7640200}', '{\"act\":0}', '{\"materal\":null,\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":7586,\"handle_qty\":7193,\"cover_supp_qty\":7586,\"materal_price\":0,\"metalai_price\":100000,\"materal_cover_price\":0.08,\"metalai_cover_price\":2085287.2,\"act\":1,\"total\":2185287.2}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":101000,\"handle_qty\":7193,\"nqty\":14,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":7486,\"handle_qty\":7193,\"cost\":1720150,\"act\":1,\"total\":1720150}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":101000,\"handle_qty\":100050,\"act\":1,\"total\":1040000}', NULL, NULL, '{\"act\":0}', NULL, 2, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":100000,\"act\":0,\"total\":0}', 0, NULL, '18621058.8', 75, NULL, 0, 1, NULL, '2023-10-18 07:12:54', '2023-10-18 07:12:54', 1);
INSERT INTO `papers` VALUES (142, NULL, 'Hộp cứng A502770 PARAMOUNT', 13000, 2, 6550, 180, 100, 6830, '{\"materal\":\"other\",\"note\":\"gi\\u1ea5y M\\u1ef9 thu\\u1eadt vietbrand cung c\\u1ea5p\",\"qttv\":\"120\",\"length\":\"24\",\"width\":\"46\",\"unit_price\":\"0\",\"materal_price\":0,\"supp_qty\":6830,\"act\":0,\"total\":0}', '{\"type\":\"0\",\"color\":\"4\",\"machine\":\"0\",\"note\":null,\"supp_qty\":5550,\"handle_qty\":6550,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":13130,\"handle_qty\":6550,\"nqty\":2,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":6730,\"handle_qty\":6550,\"cost\":1275100,\"act\":1,\"total\":1275100}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":13130,\"handle_qty\":6550,\"nqty\":2,\"act\":0,\"total\":0}', '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":13130,\"handle_qty\":13050,\"act\":1,\"total\":161300}', NULL, NULL, NULL, NULL, 1, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":13000,\"act\":0,\"total\":0}', 0, NULL, '1436400', 76, NULL, 1, 1, NULL, '2023-10-21 06:41:23', '2023-10-21 06:41:23', 1);
INSERT INTO `papers` VALUES (143, NULL, 'Hộp cứng A502770 PARAMOUNT  ( TỜ BỒI ĐÁY HỘP )', 13000, 2, 6550, 180, 100, 6830, '{\"materal\":\"other\",\"note\":\"gi\\u1ea5y m\\u1ef9 thu\\u1eadt do vietbrand cung c\\u1ea5p\",\"qttv\":\"120\",\"length\":\"44\",\"width\":\"22\",\"unit_price\":\"0\",\"materal_price\":0,\"supp_qty\":6830,\"act\":0,\"total\":0}', '{\"type\":\"0\",\"color\":\"4\",\"machine\":\"0\",\"note\":null,\"supp_qty\":5550,\"handle_qty\":6550,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":13130,\"handle_qty\":6550,\"nqty\":2,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":6730,\"handle_qty\":6550,\"cost\":1254700,\"act\":1,\"total\":1254700}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":13130,\"handle_qty\":13050,\"act\":1,\"total\":161300}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":13000,\"act\":0,\"total\":0}', 0, NULL, '1416000', 76, NULL, 0, 1, NULL, '2023-10-21 06:41:23', '2023-10-21 06:41:23', 1);
INSERT INTO `papers` VALUES (144, NULL, 'Hộp cứng A742791 PARAMOUNT', 3500, 2, 1800, 85, 100, 1985, '{\"materal\":\"other\",\"note\":\"gi\\u1ea5y vietbrand cung c\\u1ea5p\",\"qttv\":\"120\",\"length\":\"34\",\"width\":\"58\",\"unit_price\":\"0\",\"materal_price\":0,\"supp_qty\":1985,\"act\":0,\"total\":0}', '{\"type\":\"0\",\"color\":\"4\",\"machine\":\"0\",\"note\":null,\"supp_qty\":800,\"handle_qty\":1800,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":3535,\"handle_qty\":1800,\"nqty\":2,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":1885,\"handle_qty\":1800,\"cost\":678550,\"act\":1,\"total\":678550}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":3535,\"handle_qty\":1800,\"nqty\":2,\"act\":0,\"total\":0}', '{\"machine\":\"12\",\"nqty\":4,\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":3535,\"handle_qty\":3550,\"act\":1,\"total\":171400}', NULL, NULL, NULL, NULL, 1, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":3500,\"act\":0,\"total\":0}', 0, NULL, '849950', 77, NULL, 1, 1, NULL, '2023-10-21 06:57:41', '2023-10-21 06:57:41', 1);
INSERT INTO `papers` VALUES (145, NULL, 'Tính giá CỔ CHAI RƯỢU HQT 2024', 100000, 14, 7193, 193, 100, 7486, '{\"materal\":\"13\",\"qttv\":\"400\",\"length\":\"58\",\"width\":\"62\",\"materal_price\":0.00195,\"supp_qty\":7486,\"act\":1,\"total\":20997331.68}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"2\",\"note\":null,\"supp_qty\":6193,\"handle_qty\":7193,\"model_price\":123600,\"work_price\":500,\"shape_price\":600000,\"printer\":11,\"act\":1,\"total\":7640200}', '{\"act\":0}', '{\"materal\":\"1\",\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":7486,\"handle_qty\":7193,\"cover_supp_qty\":7486,\"materal_price\":0.36,\"metalai_price\":9791076.16,\"materal_cover_price\":0.08,\"metalai_cover_price\":2224804.48,\"act\":1,\"total\":12015880.64}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":101000,\"handle_qty\":7193,\"nqty\":14,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":7386,\"handle_qty\":7193,\"cost\":1747300,\"act\":1,\"total\":1747300}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":101000,\"handle_qty\":100050,\"act\":1,\"total\":1040000}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":100000,\"act\":0,\"total\":0}', 0, NULL, '43440712.32', 78, NULL, 1, 1, NULL, '2023-10-21 07:45:42', '2023-10-21 07:45:42', 1);
INSERT INTO `papers` VALUES (146, NULL, 'Tính giá ĐÁY CHAI RƯỢU HQT 2024', 100000, 14, 7193, 193, 200, 7586, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"51\",\"width\":\"65\",\"materal_price\":0.002,\"supp_qty\":7586,\"act\":1,\"total\":6035421.600000001}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"2\",\"note\":null,\"supp_qty\":6193,\"handle_qty\":7193,\"model_price\":66000,\"work_price\":250,\"shape_price\":300000,\"printer\":9,\"act\":1,\"total\":3828500}', '{\"act\":0}', '{\"materal\":\"1\",\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":7586,\"handle_qty\":7193,\"cover_supp_qty\":7586,\"materal_price\":0.36,\"metalai_price\":9153132.399999999,\"materal_cover_price\":0.08,\"metalai_cover_price\":2085287.2,\"act\":1,\"total\":11238419.599999998}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":101000,\"handle_qty\":7193,\"nqty\":14,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":101000,\"handle_qty\":7193,\"nqty\":14,\"act\":0,\"total\":0}', '{\"act\":0}', NULL, NULL, NULL, NULL, 1, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":100000,\"act\":0,\"total\":0}', 0, NULL, '21102341.2', 79, NULL, 1, 1, NULL, '2023-10-21 07:56:21', '2023-10-21 07:56:21', 1);
INSERT INTO `papers` VALUES (147, NULL, 'Tính giá VÁCH CHUNG NGĂN CHAI RƯỢU HQT 2024', 100000, 4, 25050, 550, 200, 25800, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"54\",\"width\":\"79\",\"materal_price\":0.002,\"supp_qty\":25800,\"act\":1,\"total\":26415072}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"2\",\"note\":null,\"supp_qty\":24050,\"handle_qty\":25050,\"model_price\":123600,\"work_price\":300,\"shape_price\":500000,\"printer\":10,\"act\":1,\"total\":15677200}', '{\"act\":0}', '{\"materal\":\"1\",\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":25800,\"handle_qty\":25050,\"cover_supp_qty\":25800,\"materal_price\":0.36,\"metalai_price\":39722608,\"materal_cover_price\":0.08,\"metalai_cover_price\":8870896,\"act\":1,\"total\":48593504}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":101000,\"handle_qty\":25050,\"nqty\":4,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":101000,\"handle_qty\":25050,\"nqty\":4,\"act\":0,\"total\":0}', '{\"act\":0}', NULL, NULL, NULL, NULL, 1, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":100000,\"act\":0,\"total\":0}', 0, NULL, '90685776', 80, NULL, 1, 1, NULL, '2023-10-21 08:01:37', '2023-10-21 08:01:37', 1);
INSERT INTO `papers` VALUES (148, NULL, 'Tính giá Mã A HQT 2024', 10000, 1, 10050, 250, 200, 10500, '{\"materal\":\"12\",\"qttv\":\"150\",\"length\":\"51\",\"width\":\"56\",\"materal_price\":0.002,\"supp_qty\":10500,\"act\":1,\"total\":8996400}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":66000,\"work_price\":35,\"shape_price\":110000,\"printer\":3,\"act\":1,\"total\":1971000}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":10400,\"handle_qty\":10050,\"materal_price\":0.25,\"act\":1,\"total\":7475600}', '{\"act\":0}', '{\"price\":\"1000\",\"shape_price\":\"200000\",\"machine\":\"2\",\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":1,\"total\":10300000}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":10400,\"handle_qty\":10050,\"cost\":2088400,\"act\":1,\"total\":2088400}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":131000}', NULL, NULL, NULL, NULL, 1, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '30962400', 81, NULL, 1, 1, NULL, '2023-10-21 08:18:05', '2023-10-21 08:18:05', 1);
INSERT INTO `papers` VALUES (149, NULL, 'Tính giá Mã A HQT 2024 ( TỜ BỒI ĐÁY HỘP )', 10000, 1, 10050, 250, 200, 10500, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"51\",\"width\":\"56\",\"materal_price\":0.002,\"supp_qty\":10500,\"act\":1,\"total\":7197120}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":66000,\"work_price\":35,\"shape_price\":110000,\"printer\":3,\"act\":1,\"total\":1971000}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":10400,\"handle_qty\":10050,\"materal_price\":0.25,\"act\":1,\"total\":7475600}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":10400,\"handle_qty\":10050,\"cost\":2088400,\"act\":1,\"total\":2088400}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":131000}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '18863120', 81, NULL, 0, 1, NULL, '2023-10-21 08:18:05', '2023-10-21 08:18:05', 1);
INSERT INTO `papers` VALUES (150, NULL, 'Tính giá Mã A HQT 2024 ( TÚI GIẤY )', 10000, 1, 10050, 250, 0, 10300, '{\"materal\":\"13\",\"qttv\":\"250\",\"length\":\"57\",\"width\":\"102\",\"materal_price\":0.00195,\"supp_qty\":10300,\"act\":1,\"total\":29193547.5}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":123600,\"work_price\":80,\"shape_price\":220000,\"printer\":5,\"act\":1,\"total\":4270400}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":10200,\"handle_qty\":10050,\"materal_price\":0.25,\"act\":1,\"total\":14875700}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":10200,\"handle_qty\":10050,\"cost\":2502100,\"act\":1,\"total\":2502100}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":131000}', NULL, NULL, NULL, '{\"machine\":\"52\",\"note\":null,\"model_price\":150,\"work_price\":2000,\"shape_price\":100000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":21172100}', 3, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '72144847.5', 81, NULL, 0, 1, NULL, '2023-10-21 08:18:05', '2023-10-21 08:18:05', 1);
INSERT INTO `papers` VALUES (151, NULL, 'Tính giá Mã A HQT 2024 ( TỜ BỒI THÀNH )', 10000, 2, 5050, 150, 200, 5400, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"65\",\"width\":\"80\",\"materal_price\":0.002,\"supp_qty\":5400,\"act\":1,\"total\":6739200}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"2\",\"note\":null,\"supp_qty\":4050,\"handle_qty\":5050,\"model_price\":123600,\"work_price\":500,\"shape_price\":600000,\"printer\":11,\"act\":1,\"total\":5497200}', '{\"act\":0}', '{\"materal\":\"1\",\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":5400,\"handle_qty\":5050,\"cover_supp_qty\":5400,\"materal_price\":0.36,\"metalai_price\":10208800,\"materal_cover_price\":0.08,\"metalai_cover_price\":2304800,\"act\":1,\"total\":12513600}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":5050,\"nqty\":2,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":5300,\"handle_qty\":5050,\"cost\":1675000,\"act\":1,\"total\":1675000}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":131000}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '26556000', 81, NULL, 0, 1, NULL, '2023-10-21 08:18:05', '2023-10-21 08:18:05', 1);
INSERT INTO `papers` VALUES (152, NULL, 'Tính giá Mã A HQT 2024', 10000, 1, 10050, 250, 200, 10500, '{\"materal\":\"12\",\"qttv\":\"150\",\"length\":\"51\",\"width\":\"56\",\"materal_price\":0.002,\"supp_qty\":10500,\"act\":1,\"total\":8996400}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":66000,\"work_price\":35,\"shape_price\":110000,\"printer\":3,\"act\":1,\"total\":1971000}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":10400,\"handle_qty\":10050,\"materal_price\":0.25,\"act\":1,\"total\":7475600}', '{\"act\":0}', '{\"price\":\"1000\",\"shape_price\":\"200000\",\"machine\":\"2\",\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":1,\"total\":10300000}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":10400,\"handle_qty\":10050,\"cost\":2088400,\"act\":1,\"total\":2088400}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":131000}', NULL, NULL, NULL, NULL, 1, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"4600\",\"note\":\"4600\\u0110 g\\u1ed3m c\\u00e1c ph\\u1ee5 ki\\u1ec7n V\\u00c1CH + C\\u1ed4 CHAI + \\u0110\\u00cdT CHAI\",\"qty_pro\":10000,\"act\":1,\"total\":46000000}', 0, NULL, '76962400', 82, NULL, 1, 1, NULL, '2023-10-21 08:45:30', '2023-10-21 08:45:30', 1);
INSERT INTO `papers` VALUES (153, NULL, 'Tính giá Mã A HQT 2024 ( TỜ BỒI ĐÁY HỘP )', 10000, 1, 10050, 250, 200, 10500, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"51\",\"width\":\"56\",\"materal_price\":0.002,\"supp_qty\":10500,\"act\":1,\"total\":7197120}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":66000,\"work_price\":35,\"shape_price\":110000,\"printer\":3,\"act\":1,\"total\":1971000}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":10400,\"handle_qty\":10050,\"materal_price\":0.25,\"act\":1,\"total\":7475600}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":10400,\"handle_qty\":10050,\"cost\":2088400,\"act\":1,\"total\":2088400}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":131000}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '18863120', 82, NULL, 0, 1, NULL, '2023-10-21 08:45:30', '2023-10-21 08:45:30', 1);
INSERT INTO `papers` VALUES (154, NULL, 'Tính giá Mã A HQT 2024 ( TÚI GIẤY )', 10000, 1, 10050, 250, 0, 10300, '{\"materal\":\"13\",\"qttv\":\"250\",\"length\":\"57\",\"width\":\"102\",\"materal_price\":0.00195,\"supp_qty\":10300,\"act\":1,\"total\":29193547.5}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":123600,\"work_price\":80,\"shape_price\":220000,\"printer\":5,\"act\":1,\"total\":4270400}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":10200,\"handle_qty\":10050,\"materal_price\":0.25,\"act\":1,\"total\":14875700}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":10200,\"handle_qty\":10050,\"cost\":2502100,\"act\":1,\"total\":2502100}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":131000}', NULL, NULL, NULL, '{\"machine\":\"52\",\"note\":null,\"model_price\":150,\"work_price\":2000,\"shape_price\":100000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":21172100}', 3, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '72144847.5', 82, NULL, 0, 1, NULL, '2023-10-21 08:45:30', '2023-10-21 08:45:30', 1);
INSERT INTO `papers` VALUES (155, NULL, 'Tính giá Mã A HQT 2024 ( TỜ BỒI THÀNH )', 10000, 2, 5050, 150, 200, 5400, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"65\",\"width\":\"80\",\"materal_price\":0.002,\"supp_qty\":5400,\"act\":1,\"total\":6739200}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"1\",\"note\":null,\"supp_qty\":4050,\"handle_qty\":5050,\"model_price\":123600,\"work_price\":80,\"shape_price\":220000,\"printer\":5,\"act\":1,\"total\":1335200}', '{\"act\":0}', '{\"materal\":\"1\",\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":5400,\"handle_qty\":5050,\"cover_supp_qty\":5400,\"materal_price\":0.28,\"metalai_price\":7962400.000000001,\"materal_cover_price\":0.08,\"metalai_cover_price\":2304800,\"act\":1,\"total\":10267200}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":5050,\"nqty\":2,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":5300,\"handle_qty\":5050,\"cost\":1675000,\"act\":1,\"total\":1675000}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":131000}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '20147600', 82, NULL, 0, 1, NULL, '2023-10-21 08:45:30', '2023-10-21 08:45:30', 1);
INSERT INTO `papers` VALUES (156, NULL, 'Tính giá Mã A HQT 2024 ( Sửa metailai về 2800đ/m ) giá bồi 8000k ( TỜ BỒI MẶT THÉP )', 10000, 1, 10050, 250, 0, 10300, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"45\",\"width\":\"51\",\"materal_price\":0.002,\"supp_qty\":10300,\"act\":1,\"total\":5673240}', '{\"type\":\"0\",\"color\":\"4\",\"machine\":\"0\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '5673240', 82, NULL, 0, 1, NULL, '2023-10-21 08:45:30', '2023-10-21 08:45:30', 1);
INSERT INTO `papers` VALUES (157, NULL, 'Tính giá Mã A HQT 2024 ( Sửa metailai về 2800đ/m ) giá bồi 8000k ( TỜ BỒI MẶT THÉP )', 10000, 1, 10050, 250, 0, 10300, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"45\",\"width\":\"51\",\"materal_price\":0.002,\"supp_qty\":10300,\"act\":1,\"total\":5673240}', '{\"type\":\"0\",\"color\":\"4\",\"machine\":\"0\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '5673240', 82, NULL, 0, 1, NULL, '2023-10-21 08:45:30', '2023-10-21 08:45:30', 1);
INSERT INTO `papers` VALUES (158, NULL, 'Tính giá Mã A HQT 2024', 10000, 1, 10050, 250, 200, 10500, '{\"materal\":\"12\",\"qttv\":\"150\",\"length\":\"51\",\"width\":\"51\",\"materal_price\":0.002,\"supp_qty\":10500,\"act\":1,\"total\":8193150}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":66000,\"work_price\":35,\"shape_price\":110000,\"printer\":3,\"act\":1,\"total\":1971000}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":10400,\"handle_qty\":10050,\"materal_price\":0.25,\"act\":1,\"total\":6812600}', '{\"act\":0}', '{\"price\":\"1000\",\"shape_price\":\"200000\",\"machine\":\"2\",\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":1,\"total\":10300000}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":10400,\"handle_qty\":10050,\"cost\":2050150,\"act\":1,\"total\":2050150}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":131000}', NULL, NULL, NULL, NULL, 1, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"4600\",\"note\":\"4600\\u0110 g\\u1ed3m c\\u00e1c ph\\u1ee5 ki\\u1ec7n V\\u00c1CH + C\\u1ed4 CHAI + \\u0110\\u00cdT CHAI\",\"qty_pro\":10000,\"act\":1,\"total\":46000000}', 0, NULL, '75457900', 83, NULL, 1, 1, NULL, '2023-10-21 08:44:25', '2023-10-21 08:44:25', 1);
INSERT INTO `papers` VALUES (159, NULL, 'Tính giá Mã A HQT 2024 ( TỜ BỒI ĐÁY HỘP )', 10000, 1, 10050, 250, 200, 10500, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"51\",\"width\":\"51\",\"materal_price\":0.002,\"supp_qty\":10500,\"act\":1,\"total\":6554520}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":66000,\"work_price\":35,\"shape_price\":110000,\"printer\":3,\"act\":1,\"total\":1971000}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":10400,\"handle_qty\":10050,\"materal_price\":0.25,\"act\":1,\"total\":6812600}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":10400,\"handle_qty\":10050,\"cost\":2050150,\"act\":1,\"total\":2050150}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":131000}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '17519270', 83, NULL, 0, 1, NULL, '2023-10-21 08:44:25', '2023-10-21 08:44:25', 1);
INSERT INTO `papers` VALUES (160, NULL, 'Tính giá Mã A HQT 2024 ( TÚI GIẤY )', 10000, 1, 10050, 250, 0, 10300, '{\"materal\":\"13\",\"qttv\":\"250\",\"length\":\"51\",\"width\":\"102\",\"materal_price\":0.00195,\"supp_qty\":10300,\"act\":1,\"total\":26120542.5}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":123600,\"work_price\":80,\"shape_price\":220000,\"printer\":5,\"act\":1,\"total\":4270400}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":10200,\"handle_qty\":10050,\"materal_price\":0.25,\"act\":1,\"total\":13315100}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":10200,\"handle_qty\":10050,\"cost\":2410300,\"act\":1,\"total\":2410300}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":131000}', NULL, NULL, NULL, '{\"machine\":\"52\",\"note\":null,\"model_price\":150,\"work_price\":2000,\"shape_price\":100000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":21080300}', 3, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '67327642.5', 83, NULL, 0, 1, NULL, '2023-10-21 08:44:25', '2023-10-21 08:44:25', 1);
INSERT INTO `papers` VALUES (161, NULL, 'Tính giá Mã A HQT 2024 ( TỜ BỒI THÀNH )', 10000, 2, 5050, 150, 200, 5400, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"65\",\"width\":\"74.5\",\"materal_price\":0.002,\"supp_qty\":5400,\"act\":1,\"total\":6275880}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"1\",\"note\":null,\"supp_qty\":4050,\"handle_qty\":5050,\"model_price\":123600,\"work_price\":80,\"shape_price\":220000,\"printer\":5,\"act\":1,\"total\":1335200}', '{\"act\":0}', '{\"materal\":\"1\",\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":5400,\"handle_qty\":5050,\"cover_supp_qty\":5400,\"materal_price\":0.28,\"metalai_price\":7421860.000000001,\"materal_cover_price\":0.08,\"metalai_cover_price\":2153220,\"act\":1,\"total\":9575080}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":5050,\"nqty\":2,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":5300,\"handle_qty\":5050,\"cost\":1621375,\"act\":1,\"total\":1621375}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":131000}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '18938535', 83, NULL, 0, 1, NULL, '2023-10-21 08:44:25', '2023-10-21 08:44:25', 1);
INSERT INTO `papers` VALUES (162, NULL, 'Tính giá Mã A HQT 2024 ( Sửa metailai về 2800đ/m ) giá bồi 8000k ( TỜ BỒI MẶT THÉP )', 10000, 1, 10050, 250, 0, 10300, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"45\",\"width\":\"45\",\"materal_price\":0.002,\"supp_qty\":10300,\"act\":1,\"total\":5005800}', '{\"type\":\"0\",\"color\":\"4\",\"machine\":\"0\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '5005800', 83, NULL, 0, 1, NULL, '2023-10-21 08:44:25', '2023-10-21 08:44:25', 1);
INSERT INTO `papers` VALUES (163, NULL, 'Tính giá Mã A HQT 2024 ( Sửa metailai về 2800đ/m ) giá bồi 8000k ( TỜ BỒI MẶT THÉP )', 10000, 1, 10050, 250, 0, 10300, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"45\",\"width\":\"45\",\"materal_price\":0.002,\"supp_qty\":10300,\"act\":1,\"total\":5005800}', '{\"type\":\"0\",\"color\":\"4\",\"machine\":\"0\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '5005800', 83, NULL, 0, 1, NULL, '2023-10-21 08:44:25', '2023-10-21 08:44:25', 1);
INSERT INTO `papers` VALUES (164, NULL, 'Tính giá Mã A HQT 2024', 10000, 1, 10050, 250, 200, 10500, '{\"materal\":\"12\",\"qttv\":\"150\",\"length\":\"44\",\"width\":\"50\",\"materal_price\":0.002,\"supp_qty\":10500,\"act\":1,\"total\":6930000}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":66000,\"work_price\":32,\"shape_price\":100000,\"printer\":2,\"act\":1,\"total\":1822400}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":10400,\"handle_qty\":10050,\"materal_price\":0.25,\"act\":1,\"total\":5770000}', '{\"act\":0}', '{\"price\":\"1000\",\"shape_price\":\"200000\",\"machine\":\"2\",\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":1,\"total\":10300000}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":10400,\"handle_qty\":10050,\"cost\":1990000,\"act\":1,\"total\":1990000}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":131000}', NULL, NULL, NULL, NULL, 1, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"4600\",\"note\":\"4600\\u0110 g\\u1ed3m c\\u00e1c ph\\u1ee5 ki\\u1ec7n V\\u00c1CH + C\\u1ed4 CHAI + \\u0110\\u00cdT CHAI\",\"qty_pro\":10000,\"act\":1,\"total\":46000000}', 0, NULL, '72943400', 84, NULL, 1, 1, NULL, '2023-10-21 08:55:53', '2023-10-21 08:55:53', 1);
INSERT INTO `papers` VALUES (165, NULL, 'Tính giá Mã A HQT 2024 ( TỜ BỒI ĐÁY HỘP )', 10000, 1, 10050, 250, 200, 10500, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"42\",\"width\":\"50\",\"materal_price\":0.002,\"supp_qty\":10500,\"act\":1,\"total\":5292000}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":66000,\"work_price\":32,\"shape_price\":100000,\"printer\":2,\"act\":1,\"total\":1822400}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":10400,\"handle_qty\":10050,\"materal_price\":0.25,\"act\":1,\"total\":5510000}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":10400,\"handle_qty\":10050,\"cost\":1975000,\"act\":1,\"total\":1975000}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":131000}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '14730400', 84, NULL, 0, 1, NULL, '2023-10-21 08:55:53', '2023-10-21 08:55:53', 1);
INSERT INTO `papers` VALUES (166, NULL, 'Tính giá Mã A HQT 2024 ( TÚI GIẤY )', 10000, 1, 10050, 250, 0, 10300, '{\"materal\":\"13\",\"qttv\":\"250\",\"length\":\"44\",\"width\":\"102\",\"materal_price\":0.00195,\"supp_qty\":10300,\"act\":1,\"total\":22535370}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":123600,\"work_price\":80,\"shape_price\":220000,\"printer\":5,\"act\":1,\"total\":4270400}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":10200,\"handle_qty\":10050,\"materal_price\":0.25,\"act\":1,\"total\":11494400}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":10200,\"handle_qty\":10050,\"cost\":2303200,\"act\":1,\"total\":2303200}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":131000}', NULL, NULL, NULL, '{\"machine\":\"52\",\"note\":null,\"model_price\":150,\"work_price\":2000,\"shape_price\":100000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":20973200}', 3, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '61707570', 84, NULL, 0, 1, NULL, '2023-10-21 08:55:53', '2023-10-21 08:55:53', 1);
INSERT INTO `papers` VALUES (167, NULL, 'Tính giá Mã A HQT 2024 ( TỜ BỒI THÀNH )', 10000, 2, 5050, 150, 200, 5400, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"65\",\"width\":\"67\",\"materal_price\":0.002,\"supp_qty\":5400,\"act\":1,\"total\":5644080}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"1\",\"note\":null,\"supp_qty\":4050,\"handle_qty\":5050,\"model_price\":123600,\"work_price\":80,\"shape_price\":220000,\"printer\":5,\"act\":1,\"total\":1335200}', '{\"act\":0}', '{\"materal\":\"1\",\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":5400,\"handle_qty\":5050,\"cover_supp_qty\":5400,\"materal_price\":0.28,\"metalai_price\":6684760.000000001,\"materal_cover_price\":0.08,\"metalai_cover_price\":1946520.0000000002,\"act\":1,\"total\":8631280.000000002}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":5050,\"nqty\":2,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":5300,\"handle_qty\":5050,\"cost\":1548250,\"act\":1,\"total\":1548250}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":131000}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '17289810', 84, NULL, 0, 1, NULL, '2023-10-21 08:55:53', '2023-10-21 08:55:53', 1);
INSERT INTO `papers` VALUES (168, NULL, 'Tính giá Mã A HQT 2024 ( Sửa metailai về 2800đ/m ) giá bồi 8000k ( TỜ BỒI MẶT THÉP )', 10000, 1, 10050, 250, 0, 10300, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"38\",\"width\":\"45\",\"materal_price\":0.002,\"supp_qty\":10300,\"act\":1,\"total\":4227120}', '{\"type\":\"0\",\"color\":\"4\",\"machine\":\"0\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '4227120', 84, NULL, 0, 1, NULL, '2023-10-21 08:55:53', '2023-10-21 08:55:53', 1);
INSERT INTO `papers` VALUES (169, NULL, 'Tính giá Mã A HQT 2024 ( Sửa metailai về 2800đ/m ) giá bồi 8000k ( TỜ BỒI MẶT THÉP )', 10000, 1, 10050, 250, 0, 10300, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"38\",\"width\":\"45\",\"materal_price\":0.002,\"supp_qty\":10300,\"act\":1,\"total\":4227120}', '{\"type\":\"0\",\"color\":\"4\",\"machine\":\"0\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10100,\"handle_qty\":10050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":10000,\"act\":0,\"total\":0}', 0, NULL, '4227120', 84, NULL, 0, 1, NULL, '2023-10-21 08:55:53', '2023-10-21 08:55:53', 1);
INSERT INTO `papers` VALUES (170, NULL, 'Hộp cứng SILYMARIN X7   Cẩm nang   Toa', 5000, 2, 2550, 100, 200, 2850, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"65\",\"width\":\"44\",\"materal_price\":0.002,\"supp_qty\":2850,\"act\":1,\"total\":1956240}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":1550,\"handle_qty\":2550,\"model_price\":123600,\"work_price\":80,\"shape_price\":220000,\"printer\":5,\"act\":1,\"total\":1870400}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":2750,\"handle_qty\":2550,\"materal_price\":0.25,\"act\":1,\"total\":2016250}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":5050,\"handle_qty\":2550,\"nqty\":2,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":2750,\"handle_qty\":2550,\"cost\":941500,\"act\":1,\"total\":941500}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":5050,\"handle_qty\":2550,\"nqty\":2,\"act\":0,\"total\":0}', '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":5050,\"handle_qty\":5050,\"act\":1,\"total\":80500}', NULL, NULL, NULL, NULL, 1, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":5000,\"act\":0,\"total\":0}', 0, NULL, '6864890', 85, NULL, 1, 1, NULL, '2023-10-31 18:51:48', '2023-10-31 18:51:48', 16);
INSERT INTO `papers` VALUES (171, NULL, 'Hộp cứng SILYMARIN X7 + Cẩm nang + Toa ( TỜ BỒI THÀNH )', 5000, 2, 2550, 100, 200, 2850, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"32.5\",\"width\":\"54.5\",\"materal_price\":0.002,\"supp_qty\":2850,\"act\":1,\"total\":1211535}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":1550,\"handle_qty\":2550,\"model_price\":66000,\"work_price\":32,\"shape_price\":100000,\"printer\":2,\"act\":1,\"total\":862400}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":2750,\"handle_qty\":2550,\"materal_price\":0.25,\"act\":1,\"total\":1267734.375}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":5050,\"handle_qty\":2550,\"nqty\":2,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":2750,\"handle_qty\":2550,\"cost\":778187.5,\"act\":1,\"total\":778187.5}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":5050,\"handle_qty\":5050,\"act\":1,\"total\":80500}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":5000,\"act\":0,\"total\":0}', 0, NULL, '4200356.875', 85, NULL, 0, 1, NULL, '2023-10-31 18:51:48', '2023-10-31 18:51:48', 16);
INSERT INTO `papers` VALUES (172, NULL, 'Hộp cứng SILYMARIN X7 + Cẩm nang + Toa ( TỜ BỒI MẶT THÉP )', 5000, 4, 1300, 75, 100, 1475, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"51\",\"width\":\"56\",\"materal_price\":0.002,\"supp_qty\":1475,\"act\":1,\"total\":1011024}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":300,\"handle_qty\":1300,\"model_price\":66000,\"work_price\":35,\"shape_price\":110000,\"printer\":3,\"act\":1,\"total\":746000}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":1375,\"handle_qty\":1300,\"materal_price\":0.25,\"act\":1,\"total\":1031750}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":5050,\"handle_qty\":1300,\"nqty\":4,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":5000,\"act\":0,\"total\":0}', 0, NULL, '2788774', 85, NULL, 0, 1, NULL, '2023-10-31 18:51:48', '2023-10-31 18:51:48', 16);
INSERT INTO `papers` VALUES (173, NULL, 'Hộp cứng SILYMARIN X7 + Cẩm nang + Toa ( KHAY GIẤY ĐỊNH HÌNH )', 5000, 3, 1717, 84, 0, 1801, '{\"materal\":\"13\",\"qttv\":\"400\",\"length\":null,\"width\":null,\"materal_price\":0.00195,\"supp_qty\":1801,\"act\":0,\"total\":0}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":717,\"handle_qty\":1717,\"model_price\":66000,\"work_price\":32,\"shape_price\":100000,\"printer\":1,\"act\":1,\"total\":755776}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":1701,\"handle_qty\":1717,\"materal_price\":0.25,\"act\":1,\"total\":50000}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":5050,\"handle_qty\":1717,\"nqty\":3,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":1701,\"handle_qty\":1717,\"cost\":355150,\"act\":1,\"total\":355150}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":5050,\"handle_qty\":5050,\"act\":1,\"total\":80500}', NULL, NULL, '{\"act\":0}', NULL, 2, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":5000,\"act\":0,\"total\":0}', 0, NULL, '1241426', 85, NULL, 0, 1, NULL, '2023-10-31 18:51:48', '2023-10-31 18:51:48', 16);
INSERT INTO `papers` VALUES (174, NULL, 'Hộp cứng SILYMARIN X7 + Cẩm nang + Toa ( TOA IN GHÉP )', 5000, 4, 1300, 75, 0, 1375, '{\"materal\":\"12\",\"qttv\":\"100\",\"length\":\"43\",\"width\":\"62\",\"materal_price\":0.002,\"supp_qty\":1375,\"act\":1,\"total\":733150}', '{\"type\":\"2\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":300,\"handle_qty\":1300,\"model_price\":66000,\"work_price\":32,\"shape_price\":100000,\"printer\":2,\"act\":1,\"total\":740800}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":5050,\"handle_qty\":1300,\"nqty\":4,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":5000,\"act\":0,\"total\":0}', 0, NULL, '1473950', 85, NULL, 0, 1, NULL, '2023-10-31 18:51:48', '2023-10-31 18:51:48', 16);
INSERT INTO `papers` VALUES (175, NULL, 'HDSD Tiếng hàn quốc', 10200, 8, 1325, 76, 0, 1401, '{\"materal\":\"12\",\"qttv\":\"100\",\"length\":\"43\",\"width\":\"62\",\"materal_price\":0.002,\"supp_qty\":1401,\"act\":1,\"total\":747013.2000000001}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":325,\"handle_qty\":1325,\"model_price\":66000,\"work_price\":32,\"shape_price\":100000,\"printer\":2,\"act\":1,\"total\":705600}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":10302,\"handle_qty\":1325,\"nqty\":8,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"10\",\"note\":null,\"qty_pro\":10200,\"act\":1,\"total\":102000}', 0, NULL, '1554613.2', 86, NULL, 1, 1, NULL, '2023-10-25 10:37:02', '2023-10-25 10:37:02', 16);
INSERT INTO `papers` VALUES (177, NULL, 'Bao giá hộp kay   zales 9.5 x 6.9 x 2.7cm', 309330, 20, 15517, 360, 300, 16177, '{\"materal\":\"other\",\"note\":\"gi\\u1ea5y M\\u1ef9 thu\\u1eadt \\u0111en t\\u00ednh 50\",\"qttv\":\"120\",\"length\":\"79\",\"width\":\"54.5\",\"unit_price\":\"0.005\",\"materal_price\":0.005,\"supp_qty\":16177,\"act\":1,\"total\":41790044.1}', '{\"type\":\"0\",\"color\":\"0\",\"machine\":\"0\",\"note\":null,\"supp_qty\":14517,\"handle_qty\":15517,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":312424,\"handle_qty\":15517,\"nqty\":20,\"act\":0,\"total\":0}', '{\"face\":\"1\",\"materal\":\"10\",\"machine\":\"10\",\"note\":null,\"model_price\":80,\"work_price\":600,\"shape_price\":200000,\"supp_qty\":16077,\"handle_qty\":15517,\"materal_price\":0,\"act\":1,\"total\":10190640}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":16077,\"handle_qty\":15517,\"cost\":3157375,\"act\":1,\"total\":3157375}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":312424,\"handle_qty\":15517,\"nqty\":20,\"act\":0,\"total\":0}', '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":312424,\"handle_qty\":309380,\"act\":1,\"total\":3154240}', NULL, NULL, NULL, NULL, 1, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":309330,\"act\":0,\"total\":0}', 0, NULL, '58292299.1', 88, NULL, 1, 1, NULL, '2023-10-31 09:45:39', '2023-10-31 09:45:39', 1);
INSERT INTO `papers` VALUES (178, NULL, 'Bao giá hộp kay + zales 9.5 x 6.9 x 2.7cm ( TỜ BỒI ĐÁY HỘP )', 309330, 12, 25828, 566, 300, 26694, '{\"materal\":\"other\",\"note\":\"m\\u1ef9 thu\\u1ea5t \\u0111en\",\"qttv\":\"120\",\"length\":\"79\",\"width\":\"54.5\",\"unit_price\":\"0.005\",\"materal_price\":0.005,\"supp_qty\":26694,\"act\":1,\"total\":68958610.2}', '{\"type\":\"0\",\"color\":\"0\",\"machine\":\"0\",\"note\":null,\"supp_qty\":24828,\"handle_qty\":25828,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":312424,\"handle_qty\":25828,\"nqty\":12,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":26594,\"handle_qty\":25828,\"cost\":4734925,\"act\":1,\"total\":4734925}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":312424,\"handle_qty\":309380,\"act\":1,\"total\":3154240}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":309330,\"act\":0,\"total\":0}', 0, NULL, '76847775.2', 88, NULL, 0, 1, NULL, '2023-10-31 09:45:39', '2023-10-31 09:45:39', 1);
INSERT INTO `papers` VALUES (179, NULL, 'Bao giá hộp kay + zales 9.5 x 6.9 x 2.7cm ( TỜ BỒI NẮP HỘP )', 309330, 20, 15517, 360, 300, 16177, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"62\",\"width\":\"40\",\"materal_price\":0.002,\"supp_qty\":16177,\"act\":1,\"total\":9628550.4}', '{\"type\":\"0\",\"color\":\"0\",\"machine\":\"0\",\"note\":null,\"supp_qty\":14517,\"handle_qty\":15517,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":312424,\"handle_qty\":15517,\"nqty\":20,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":309330,\"act\":0,\"total\":0}', 0, NULL, '9628550.4', 88, NULL, 0, 1, NULL, '2023-10-31 09:45:39', '2023-10-31 09:45:39', 1);
INSERT INTO `papers` VALUES (180, NULL, 'Bao giá hộp kay + zales 9.5 x 6.9 x 2.7cm ( TỜ BỒI ĐÁY HỘP )', 309330, 12, 25828, 566, 200, 26594, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"62\",\"width\":\"38\",\"materal_price\":0.002,\"supp_qty\":26594,\"act\":1,\"total\":15037311.36}', '{\"type\":\"0\",\"color\":\"0\",\"machine\":\"0\",\"note\":null,\"supp_qty\":24828,\"handle_qty\":25828,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":312424,\"handle_qty\":25828,\"nqty\":12,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":309330,\"act\":0,\"total\":0}', 0, NULL, '15037311.36', 88, NULL, 0, 1, NULL, '2023-10-31 09:45:39', '2023-10-31 09:45:39', 1);
INSERT INTO `papers` VALUES (181, NULL, 'Bao giá hộp kay   zales 9.5 x 6.9 x 2.7cm', 309330, 20, 15517, 360, 300, 16177, '{\"materal\":\"other\",\"note\":\"gi\\u1ea5y M\\u1ef9 thu\\u1eadt \\u0111en t\\u00ednh 50\",\"qttv\":\"120\",\"length\":\"79\",\"width\":\"54.5\",\"unit_price\":\"0.005\",\"materal_price\":0.005,\"supp_qty\":16177,\"act\":1,\"total\":41790044.1}', '{\"type\":\"0\",\"color\":\"0\",\"machine\":\"0\",\"note\":null,\"supp_qty\":14517,\"handle_qty\":15517,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":312424,\"handle_qty\":15517,\"nqty\":20,\"act\":0,\"total\":0}', '{\"face\":\"1\",\"materal\":\"10\",\"machine\":\"10\",\"note\":null,\"model_price\":80,\"work_price\":600,\"shape_price\":200000,\"supp_qty\":16077,\"handle_qty\":15517,\"materal_price\":0,\"act\":1,\"total\":10190640}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":16077,\"handle_qty\":15517,\"cost\":3157375,\"act\":1,\"total\":3157375}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":312424,\"handle_qty\":15517,\"nqty\":20,\"act\":0,\"total\":0}', '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":312424,\"handle_qty\":309380,\"act\":1,\"total\":3154240}', NULL, NULL, NULL, NULL, 1, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":309330,\"act\":0,\"total\":0}', 0, NULL, '58292299.1', 89, NULL, 1, 1, NULL, '2023-10-31 09:51:08', '2023-10-31 09:51:08', 1);
INSERT INTO `papers` VALUES (182, NULL, 'Bao giá hộp kay + zales 9.5 x 6.9 x 2.7cm ( TỜ BỒI ĐÁY HỘP )', 309330, 12, 25828, 566, 300, 26694, '{\"materal\":\"other\",\"note\":\"m\\u1ef9 thu\\u1ea5t \\u0111en\",\"qttv\":\"120\",\"length\":\"79\",\"width\":\"54.5\",\"unit_price\":\"0.005\",\"materal_price\":0.005,\"supp_qty\":26694,\"act\":1,\"total\":68958610.2}', '{\"type\":\"0\",\"color\":\"0\",\"machine\":\"0\",\"note\":null,\"supp_qty\":24828,\"handle_qty\":25828,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":312424,\"handle_qty\":25828,\"nqty\":12,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":26594,\"handle_qty\":25828,\"cost\":4734925,\"act\":1,\"total\":4734925}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":312424,\"handle_qty\":309380,\"act\":1,\"total\":3154240}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":309330,\"act\":0,\"total\":0}', 0, NULL, '76847775.2', 89, NULL, 0, 1, NULL, '2023-10-31 09:51:08', '2023-10-31 09:51:08', 1);
INSERT INTO `papers` VALUES (183, NULL, 'Bao giá hộp kay + zales 9.5 x 6.9 x 2.7cm ( TỜ BỒI NẮP HỘP )', 309330, 20, 15517, 360, 300, 16177, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"62\",\"width\":\"40\",\"materal_price\":0.002,\"supp_qty\":16177,\"act\":1,\"total\":9628550.4}', '{\"type\":\"0\",\"color\":\"0\",\"machine\":\"0\",\"note\":null,\"supp_qty\":14517,\"handle_qty\":15517,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":312424,\"handle_qty\":15517,\"nqty\":20,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":309330,\"act\":0,\"total\":0}', 0, NULL, '9628550.4', 89, NULL, 0, 1, NULL, '2023-10-31 09:51:08', '2023-10-31 09:51:08', 1);
INSERT INTO `papers` VALUES (184, NULL, 'Bao giá hộp kay + zales 9.5 x 6.9 x 2.7cm ( TỜ BỒI ĐÁY HỘP )', 309330, 12, 25828, 566, 200, 26594, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"62\",\"width\":\"38\",\"materal_price\":0.002,\"supp_qty\":26594,\"act\":1,\"total\":15037311.36}', '{\"type\":\"0\",\"color\":\"0\",\"machine\":\"0\",\"note\":null,\"supp_qty\":24828,\"handle_qty\":25828,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":312424,\"handle_qty\":25828,\"nqty\":12,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":309330,\"act\":0,\"total\":0}', 0, NULL, '15037311.36', 89, NULL, 0, 1, NULL, '2023-10-31 09:51:08', '2023-10-31 09:51:08', 1);
INSERT INTO `papers` VALUES (185, NULL, 'Hộp 29 X 36 X 10.5cm Cắt CNC', 3000, 1, 3050, 110, 150, 3310, '{\"materal\":\"12\",\"qttv\":\"150\",\"length\":\"86\",\"width\":\"47\",\"materal_price\":0.002,\"supp_qty\":3310,\"act\":1,\"total\":4013706}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":2050,\"handle_qty\":3050,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":3210,\"handle_qty\":3050,\"materal_price\":0.25,\"act\":1,\"total\":3293705}', '{\"act\":0}', '{\"price\":\"1500\",\"shape_price\":\"500000\",\"machine\":\"2\",\"note\":null,\"qty_pro\":3030,\"handle_qty\":3050,\"nqty\":1,\"act\":1,\"total\":5045000}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":3210,\"handle_qty\":3050,\"cost\":1187800,\"act\":1,\"total\":1187800}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":3030,\"handle_qty\":3050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":3030,\"handle_qty\":3050,\"act\":1,\"total\":60300}', NULL, NULL, NULL, NULL, 1, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":3000,\"act\":0,\"total\":0}', 0, NULL, '13600511', 90, NULL, 1, 1, NULL, '2023-11-01 16:22:02', '2023-11-01 16:22:02', 1);
INSERT INTO `papers` VALUES (186, NULL, 'Hộp 29 X 36 X 10.5cm Cắt CNC ( TỜ BỒI MẶT THÉP )', 3000, 1, 3050, 110, 150, 3310, '{\"materal\":\"12\",\"qttv\":\"150\",\"length\":\"54.5\",\"width\":\"44\",\"materal_price\":0.002,\"supp_qty\":3310,\"act\":1,\"total\":2381214}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"2\",\"note\":null,\"supp_qty\":2050,\"handle_qty\":3050,\"model_price\":123600,\"work_price\":500,\"shape_price\":600000,\"printer\":11,\"act\":1,\"total\":3497200}', '{\"act\":0}', '{\"materal\":\"1\",\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":3310,\"handle_qty\":3050,\"cover_supp_qty\":3310,\"materal_price\":0.36,\"metalai_price\":2957456.8,\"materal_cover_price\":0.08,\"metalai_cover_price\":715806.4,\"act\":1,\"total\":3673263.1999999997}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":3030,\"handle_qty\":3050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":3210,\"handle_qty\":3050,\"cost\":941200,\"act\":1,\"total\":941200}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":3030,\"handle_qty\":3050,\"act\":1,\"total\":60300}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"4000\",\"prescript_price\":\"10000\",\"supp_price\":\"0\",\"note\":\"4000 L\\u00c0 TH\\u00c0NH , V\\u00c1CH, 10000 l\\u00e0 c\\u1eaft cnc\",\"qty_pro\":3000,\"act\":1,\"total\":42000000}', 0, NULL, '52553177.2', 90, NULL, 0, 1, NULL, '2023-11-01 16:22:02', '2023-11-01 16:22:02', 1);
INSERT INTO `papers` VALUES (187, NULL, 'Hộp 29 X 36 X 10.5cm Cắt CNC ( TỜ BỒI THÀNH )', 3000, 2, 1550, 80, 100, 1730, '{\"materal\":\"12\",\"qttv\":\"150\",\"length\":\"65\",\"width\":\"68\",\"materal_price\":0.002,\"supp_qty\":1730,\"act\":1,\"total\":2293980}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"2\",\"note\":null,\"supp_qty\":550,\"handle_qty\":1550,\"model_price\":123600,\"work_price\":500,\"shape_price\":600000,\"printer\":11,\"act\":1,\"total\":1997200}', '{\"act\":0}', '{\"materal\":\"1\",\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":1730,\"handle_qty\":1550,\"cover_supp_qty\":1730,\"materal_price\":0.36,\"metalai_price\":2852776,\"materal_cover_price\":0.08,\"metalai_cover_price\":676368,\"act\":1,\"total\":3529144}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":3030,\"handle_qty\":1550,\"nqty\":2,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":1630,\"handle_qty\":1550,\"cost\":1007500,\"act\":1,\"total\":1007500}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":3030,\"handle_qty\":3050,\"act\":1,\"total\":60300}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":3000,\"act\":0,\"total\":0}', 0, NULL, '8888124', 90, NULL, 0, 1, NULL, '2023-11-01 16:22:02', '2023-11-01 16:22:02', 1);
INSERT INTO `papers` VALUES (188, NULL, 'Hộp 29 X 36 X 10.5cm Cắt CNC ( TỜ BỒI ĐÁY HỘP )', 3000, 1, 3050, 110, 100, 3260, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"47\",\"width\":\"54\",\"materal_price\":0.002,\"supp_qty\":3260,\"act\":1,\"total\":1985731.2}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"2\",\"note\":null,\"supp_qty\":2050,\"handle_qty\":3050,\"model_price\":66000,\"work_price\":200,\"shape_price\":250000,\"printer\":8,\"act\":1,\"total\":1452000}', '{\"act\":0}', '{\"materal\":\"1\",\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":3260,\"handle_qty\":3050,\"cover_supp_qty\":3260,\"materal_price\":0.36,\"metalai_price\":3078596.8,\"materal_cover_price\":0.08,\"metalai_cover_price\":741606.4,\"act\":1,\"total\":3820203.1999999997}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":3030,\"handle_qty\":3050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":3000,\"act\":0,\"total\":0}', 0, NULL, '7257934.4', 90, NULL, 0, 1, NULL, '2023-11-01 16:22:02', '2023-11-01 16:22:02', 1);
INSERT INTO `papers` VALUES (189, NULL, 'Hộp 29 X 36 X 10.5cm Cắt CNC', 3000, 1, 3050, 110, 150, 3310, '{\"materal\":\"12\",\"qttv\":\"150\",\"length\":\"97\",\"width\":\"43\",\"materal_price\":0.002,\"supp_qty\":3310,\"act\":1,\"total\":4141803}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":2050,\"handle_qty\":3050,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":3210,\"handle_qty\":3050,\"materal_price\":0.25,\"act\":1,\"total\":3397227.5}', '{\"act\":0}', '{\"price\":\"1500\",\"shape_price\":\"500000\",\"machine\":\"2\",\"note\":null,\"qty_pro\":3030,\"handle_qty\":3050,\"nqty\":1,\"act\":1,\"total\":5045000}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":3210,\"handle_qty\":3050,\"cost\":1207150,\"act\":1,\"total\":1207150}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":3030,\"handle_qty\":3050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":3030,\"handle_qty\":3050,\"act\":1,\"total\":60300}', NULL, NULL, NULL, NULL, 1, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":3000,\"act\":0,\"total\":0}', 0, NULL, '13851480.5', 91, NULL, 1, 1, NULL, '2023-11-01 16:38:57', '2023-11-01 16:38:57', 1);
INSERT INTO `papers` VALUES (190, NULL, 'Hộp 29 X 36 X 10.5cm Cắt CNC ( TỜ BỒI MẶT THÉP )', 3000, 1, 3050, 110, 150, 3310, '{\"materal\":\"12\",\"qttv\":\"150\",\"length\":\"60\",\"width\":\"37\",\"materal_price\":0.002,\"supp_qty\":3310,\"act\":1,\"total\":2204460}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"2\",\"note\":null,\"supp_qty\":2050,\"handle_qty\":3050,\"model_price\":123600,\"work_price\":500,\"shape_price\":600000,\"printer\":11,\"act\":1,\"total\":3497200}', '{\"act\":0}', '{\"materal\":\"1\",\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":3310,\"handle_qty\":3050,\"cover_supp_qty\":3310,\"materal_price\":0.36,\"metalai_price\":2745352,\"materal_cover_price\":0.08,\"metalai_cover_price\":670096,\"act\":1,\"total\":3415448}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":3030,\"handle_qty\":3050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":3210,\"handle_qty\":3050,\"cost\":914500,\"act\":1,\"total\":914500}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":3030,\"handle_qty\":3050,\"act\":1,\"total\":60300}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"4000\",\"prescript_price\":\"10000\",\"supp_price\":\"0\",\"note\":\"4000 L\\u00c0 TH\\u00c0NH , V\\u00c1CH, 10000 l\\u00e0 c\\u1eaft cnc\",\"qty_pro\":3000,\"act\":1,\"total\":42000000}', 0, NULL, '52091908', 91, NULL, 0, 1, NULL, '2023-11-01 16:38:57', '2023-11-01 16:38:57', 1);
INSERT INTO `papers` VALUES (191, NULL, 'Hộp 29 X 36 X 10.5cm Cắt CNC ( TỜ BỒI THÀNH )', 3000, 2, 1550, 80, 100, 1730, '{\"materal\":\"12\",\"qttv\":\"150\",\"length\":\"65\",\"width\":\"75\",\"materal_price\":0.002,\"supp_qty\":1730,\"act\":1,\"total\":2530125}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"2\",\"note\":null,\"supp_qty\":550,\"handle_qty\":1550,\"model_price\":123600,\"work_price\":500,\"shape_price\":600000,\"printer\":11,\"act\":1,\"total\":1997200}', '{\"act\":0}', '{\"materal\":\"1\",\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":1730,\"handle_qty\":1550,\"cover_supp_qty\":1730,\"materal_price\":0.36,\"metalai_price\":3136150,\"materal_cover_price\":0.08,\"metalai_cover_price\":735700,\"act\":1,\"total\":3871850}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":3030,\"handle_qty\":1550,\"nqty\":2,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":1630,\"handle_qty\":1550,\"cost\":1075750,\"act\":1,\"total\":1075750}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":3030,\"handle_qty\":3050,\"act\":1,\"total\":60300}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":3000,\"act\":0,\"total\":0}', 0, NULL, '9535225', 91, NULL, 0, 1, NULL, '2023-11-01 16:38:57', '2023-11-01 16:38:57', 1);
INSERT INTO `papers` VALUES (192, NULL, 'Hộp 29 X 36 X 10.5cm Cắt CNC ( TỜ BỒI ĐÁY HỘP )', 3000, 1, 3050, 110, 100, 3260, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"52\",\"width\":\"52\",\"materal_price\":0.002,\"supp_qty\":3260,\"act\":1,\"total\":2115609.6}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"2\",\"note\":null,\"supp_qty\":2050,\"handle_qty\":3050,\"model_price\":66000,\"work_price\":250,\"shape_price\":300000,\"printer\":9,\"act\":1,\"total\":1757000}', '{\"act\":0}', '{\"materal\":\"1\",\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":3260,\"handle_qty\":3050,\"cover_supp_qty\":3260,\"materal_price\":0.36,\"metalai_price\":3273414.4,\"materal_cover_price\":0.08,\"metalai_cover_price\":783571.2,\"act\":1,\"total\":4056985.5999999996}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":3030,\"handle_qty\":3050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":3000,\"act\":0,\"total\":0}', 0, NULL, '7929595.2', 91, NULL, 0, 1, NULL, '2023-11-01 16:38:57', '2023-11-01 16:38:57', 1);
INSERT INTO `papers` VALUES (193, NULL, 'Hộp 29 X 36 X 10.5cm Cắt CNC', 3000, 1, 3050, 110, 150, 3310, '{\"materal\":\"12\",\"qttv\":\"150\",\"length\":\"97\",\"width\":\"47\",\"materal_price\":0.002,\"supp_qty\":3310,\"act\":1,\"total\":4527087}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":2050,\"handle_qty\":3050,\"model_price\":0,\"work_price\":0,\"shape_price\":0,\"printer\":0,\"act\":0,\"total\":0}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":3210,\"handle_qty\":3050,\"materal_price\":0.25,\"act\":1,\"total\":3708597.5}', '{\"act\":0}', '{\"price\":\"1500\",\"shape_price\":\"500000\",\"machine\":\"2\",\"note\":null,\"qty_pro\":3030,\"handle_qty\":3050,\"nqty\":1,\"act\":1,\"total\":5045000}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":3210,\"handle_qty\":3050,\"cost\":1265350,\"act\":1,\"total\":1265350}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":3030,\"handle_qty\":3050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":3030,\"handle_qty\":3050,\"act\":1,\"total\":60300}', NULL, NULL, NULL, NULL, 1, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":3000,\"act\":0,\"total\":0}', 0, NULL, '14606334.5', 92, NULL, 1, 1, NULL, '2023-11-01 16:44:08', '2023-11-01 16:44:08', 1);
INSERT INTO `papers` VALUES (194, NULL, 'Hộp 29 X 36 X 10.5cm Cắt CNC ( TỜ BỒI MẶT THÉP )', 3000, 1, 3050, 110, 150, 3310, '{\"materal\":\"12\",\"qttv\":\"150\",\"length\":\"62\",\"width\":\"44\",\"materal_price\":0.002,\"supp_qty\":3310,\"act\":1,\"total\":2708904}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"2\",\"note\":null,\"supp_qty\":2050,\"handle_qty\":3050,\"model_price\":123600,\"work_price\":500,\"shape_price\":600000,\"printer\":11,\"act\":1,\"total\":3497200}', '{\"act\":0}', '{\"materal\":\"1\",\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":3310,\"handle_qty\":3050,\"cover_supp_qty\":3310,\"materal_price\":0.36,\"metalai_price\":3350684.8,\"materal_cover_price\":0.08,\"metalai_cover_price\":800550.4,\"act\":1,\"total\":4151235.1999999997}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":3030,\"handle_qty\":3050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":3210,\"handle_qty\":3050,\"cost\":990700,\"act\":1,\"total\":990700}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":3030,\"handle_qty\":3050,\"act\":1,\"total\":60300}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"4000\",\"prescript_price\":\"10000\",\"supp_price\":\"0\",\"note\":\"4000 L\\u00c0 TH\\u00c0NH , V\\u00c1CH, 10000 l\\u00e0 c\\u1eaft cnc\",\"qty_pro\":3000,\"act\":1,\"total\":42000000}', 0, NULL, '53408339.2', 92, NULL, 0, 1, NULL, '2023-11-01 16:44:08', '2023-11-01 16:44:08', 1);
INSERT INTO `papers` VALUES (195, NULL, 'Hộp 29 X 36 X 10.5cm Cắt CNC ( TỜ BỒI THÀNH )', 3000, 2, 1550, 80, 100, 1730, '{\"materal\":\"12\",\"qttv\":\"150\",\"length\":\"65\",\"width\":\"81\",\"materal_price\":0.002,\"supp_qty\":1730,\"act\":1,\"total\":2732535}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"2\",\"note\":null,\"supp_qty\":550,\"handle_qty\":1550,\"model_price\":123600,\"work_price\":500,\"shape_price\":600000,\"printer\":11,\"act\":1,\"total\":1997200}', '{\"act\":0}', '{\"materal\":\"1\",\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":1730,\"handle_qty\":1550,\"cover_supp_qty\":1730,\"materal_price\":0.36,\"metalai_price\":3379041.9999999995,\"materal_cover_price\":0.08,\"metalai_cover_price\":786556,\"act\":1,\"total\":4165597.9999999995}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":3030,\"handle_qty\":1550,\"nqty\":2,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":1630,\"handle_qty\":1550,\"cost\":1134250,\"act\":1,\"total\":1134250}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":3030,\"handle_qty\":3050,\"act\":1,\"total\":60300}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":3000,\"act\":0,\"total\":0}', 0, NULL, '10089883', 92, NULL, 0, 1, NULL, '2023-11-01 16:44:08', '2023-11-01 16:44:08', 1);
INSERT INTO `papers` VALUES (196, NULL, 'Hộp 29 X 36 X 10.5cm Cắt CNC ( TỜ BỒI ĐÁY HỘP )', 3000, 1, 3050, 110, 100, 3260, '{\"materal\":\"12\",\"qttv\":\"120\",\"length\":\"52\",\"width\":\"56\",\"materal_price\":0.002,\"supp_qty\":3260,\"act\":1,\"total\":2278348.8000000003}', '{\"type\":\"1\",\"color\":\"2\",\"machine\":\"2\",\"note\":null,\"supp_qty\":2050,\"handle_qty\":3050,\"model_price\":66000,\"work_price\":250,\"shape_price\":300000,\"printer\":9,\"act\":1,\"total\":1757000}', '{\"act\":0}', '{\"materal\":\"1\",\"face\":\"1\",\"cover_materal\":\"3\",\"cover_face\":\"1\",\"machine\":\"16\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":100000,\"supp_qty\":3260,\"handle_qty\":3050,\"cover_supp_qty\":3260,\"materal_price\":0.36,\"metalai_price\":3517523.1999999997,\"materal_cover_price\":0.08,\"metalai_cover_price\":836153.6,\"act\":1,\"total\":4353676.8}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":3030,\"handle_qty\":3050,\"nqty\":1,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"act\":0}', NULL, '{\"act\":0}', NULL, '{\"act\":0}', NULL, NULL, 6, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":3000,\"act\":0,\"total\":0}', 0, NULL, '8389025.6', 92, NULL, 0, 1, NULL, '2023-11-01 16:44:08', '2023-11-01 16:44:08', 1);
INSERT INTO `papers` VALUES (197, NULL, '3 Loại Hộp giấy 10.5 x 15 x 4.5cm ( 3 x 10.000 = 30.000 sp )', 30000, 3, 10050, 250, 0, 10300, '{\"materal\":\"13\",\"qttv\":\"300\",\"length\":\"32.5\",\"width\":\"71\",\"materal_price\":0.00195,\"supp_qty\":10300,\"act\":1,\"total\":13903841.25}', '{\"type\":\"1\",\"color\":\"4\",\"machine\":\"1\",\"note\":null,\"supp_qty\":9050,\"handle_qty\":10050,\"model_price\":66000,\"work_price\":35,\"shape_price\":110000,\"printer\":3,\"act\":1,\"total\":1971000}', '{\"materal\":\"9\",\"face\":\"1\",\"machine\":\"8\",\"note\":null,\"model_price\":0,\"work_price\":0,\"shape_price\":50000,\"supp_qty\":10200,\"handle_qty\":10050,\"materal_price\":0.25,\"act\":1,\"total\":5934125}', '{\"act\":0}', '{\"price\":\"0\",\"shape_price\":\"0\",\"machine\":null,\"note\":null,\"qty_pro\":30300,\"handle_qty\":10050,\"nqty\":3,\"act\":0,\"total\":0}', '{\"act\":0}', '{\"ext_price\":\"0\",\"machine\":\"4\",\"note\":null,\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":10200,\"handle_qty\":10050,\"cost\":1976125,\"act\":1,\"total\":1976125}', NULL, '{\"machine\":\"12\",\"nqty\":\"1\",\"note\":null,\"model_price\":0,\"work_price\":10,\"shape_price\":30000,\"qty_pro\":30300,\"handle_qty\":30050,\"act\":1,\"total\":333000}', NULL, NULL, '{\"machine\":\"6\",\"note\":null,\"model_price\":0,\"work_price\":50,\"shape_price\":100000,\"qty_pro\":30300,\"handle_qty\":30050,\"act\":1,\"total\":1615000}', NULL, 2, '{\"temp_price\":\"0\",\"prescript_price\":\"0\",\"supp_price\":\"0\",\"note\":null,\"qty_pro\":30000,\"act\":0,\"total\":0}', 0, NULL, '25733091.25', 93, NULL, 1, 1, NULL, '2023-11-02 08:44:18', '2023-11-02 08:44:18', 1);

-- ----------------------------
-- Table structure for print_notes
-- ----------------------------
DROP TABLE IF EXISTS `print_notes`;
CREATE TABLE `print_notes`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `index`(`id`, `name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of print_notes
-- ----------------------------
INSERT INTO `print_notes` VALUES (1, 'In theo màn hình Dell ultra', 1, 1, '2023-05-22 10:29:05', '2023-05-22 10:29:05');
INSERT INTO `print_notes` VALUES (2, 'In theo mẫu đã in trước', 1, 1, '2023-05-22 10:29:05', '2023-05-22 10:29:05');
INSERT INTO `print_notes` VALUES (3, 'In theo mẫu khách hàng gửi', 1, 1, '2023-05-22 10:29:05', '2023-05-22 10:29:05');
INSERT INTO `print_notes` VALUES (4, 'Khách hàng duyệt màu', 1, 1, '2023-05-22 10:29:05', '2023-05-22 10:29:05');

-- ----------------------------
-- Table structure for print_techs
-- ----------------------------
DROP TABLE IF EXISTS `print_techs`;
CREATE TABLE `print_techs`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `index`(`id`, `name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of print_techs
-- ----------------------------
INSERT INTO `print_techs` VALUES (1, 'In offset', 1, 1, '2023-03-11 15:10:23', '2023-03-11 15:10:25');
INSERT INTO `print_techs` VALUES (2, 'In UV Offset', 1, 1, '2023-03-11 15:10:23', '2023-03-11 15:10:25');
INSERT INTO `print_techs` VALUES (3, 'In Label', 1, 1, '2023-03-11 15:10:23', '2023-03-11 15:10:25');
INSERT INTO `print_techs` VALUES (4, 'offset & UV offset', 1, 1, '2023-03-11 15:25:31', '2023-03-11 15:25:33');

-- ----------------------------
-- Table structure for print_warehouses
-- ----------------------------
DROP TABLE IF EXISTS `print_warehouses`;
CREATE TABLE `print_warehouses`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `length` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `width` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `qtv` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `qty` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `supp_price` int(10) NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `source` tinyint(4) NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 78 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of print_warehouses
-- ----------------------------
INSERT INTO `print_warehouses` VALUES (45, 'C', '51', '48.6', '120', '60000', 'paper', 12, 'imported', NULL, NULL, 1, '2023-09-23 15:55:00', '2023-09-23 17:57:56', 10);
INSERT INTO `print_warehouses` VALUES (46, 'C', '50.3', '55.5', '148', '66000', 'paper', 12, 'imported', NULL, NULL, 1, '2023-09-23 17:47:30', '2023-09-23 17:47:30', 1);
INSERT INTO `print_warehouses` VALUES (47, 'C', '50.3', '51', '150', '46500', 'paper', 12, 'imported', NULL, NULL, 1, '2023-09-23 17:47:56', '2023-09-23 19:17:10', 1);
INSERT INTO `print_warehouses` VALUES (51, 'C', '51', '55.5', '150', '75360', 'paper', 12, 'imported', NULL, NULL, 1, '2023-09-23 17:56:45', '2023-09-24 15:37:34', 1);
INSERT INTO `print_warehouses` VALUES (52, 'C', '51', '56', '150', '5200', 'paper', 12, 'imported', NULL, NULL, 1, '2023-09-23 18:00:00', '2023-09-23 18:00:00', 1);
INSERT INTO `print_warehouses` VALUES (53, 'C', '51', '51', '150', '5200', 'paper', 12, 'imported', NULL, NULL, 1, '2023-09-23 18:00:10', '2023-09-23 18:00:10', 1);
INSERT INTO `print_warehouses` VALUES (54, 'C', '51', '44', '150', '5200', 'paper', 12, 'imported', NULL, NULL, 1, '2023-09-23 18:00:26', '2023-09-23 18:00:26', 1);
INSERT INTO `print_warehouses` VALUES (59, 'c150', '10', '30', '150', '2500', 'paper', 12, 'waiting', 2, NULL, 1, '2023-09-24 10:59:53', '2023-09-24 10:59:53', 6);
INSERT INTO `print_warehouses` VALUES (64, 'C', '51', '48.5', '120', '60000', 'paper', 12, 'imported', NULL, NULL, 1, '2023-09-24 15:38:40', '2023-09-24 15:38:40', 1);
INSERT INTO `print_warehouses` VALUES (65, 'C', '50.3', '55.5', '150', '66000', 'paper', 12, 'imported', NULL, NULL, 1, '2023-09-24 15:39:19', '2023-09-24 15:39:37', 1);
INSERT INTO `print_warehouses` VALUES (66, 'C', '50.3', '51', '150', '46500', 'paper', 12, 'imported', NULL, NULL, 1, '2023-09-24 15:39:59', '2023-09-24 15:39:59', 1);
INSERT INTO `print_warehouses` VALUES (70, 'I250 TÚI MÃ B', '102', '51', '250', '120000', 'paper', 13, 'imported', NULL, NULL, 1, '2023-10-06 09:18:42', '2023-10-06 09:18:42', 7);
INSERT INTO `print_warehouses` VALUES (71, 'I250 TÚI MÃ A', '102', '57', '250', '130760', 'paper', 13, 'imported', NULL, NULL, 1, '2023-10-06 09:06:34', '2023-10-06 09:06:34', 7);
INSERT INTO `print_warehouses` VALUES (72, 'I250 TÚI MÃ C', '102', '44', '250', '120000', 'paper', 13, 'imported', NULL, NULL, 1, '2023-10-06 09:03:17', '2023-10-06 09:03:17', 7);
INSERT INTO `print_warehouses` VALUES (73, 'C120 NẮP MÃ C', '50', '44', '120', '87020', 'paper', 12, 'imported', NULL, NULL, 1, '2023-10-01 12:17:28', '2023-10-01 12:17:28', 1);
INSERT INTO `print_warehouses` VALUES (74, 'C120 ĐÁY MÃ C', '50', '42', '120', '87020', 'paper', 12, 'imported', NULL, NULL, 1, '2023-10-01 12:18:21', '2023-10-01 12:18:21', 1);
INSERT INTO `print_warehouses` VALUES (75, 'C120 ĐÁY MÃ A', '54.5', '48.5', '120', '74300', 'paper', 12, 'imported', NULL, NULL, 1, '2023-10-01 12:19:43', '2023-10-01 12:19:43', 1);
INSERT INTO `print_warehouses` VALUES (77, 'C120 khay thuyền', '62', '50.5', '120', '50000', 'paper', 12, 'imported', NULL, NULL, 1, '2023-10-06 09:30:05', '2023-10-06 09:30:05', 7);

-- ----------------------------
-- Table structure for printers
-- ----------------------------
DROP TABLE IF EXISTS `printers`;
CREATE TABLE `printers`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã nhóm',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Tên nhóm',
  `print_length` float(10, 0) NULL DEFAULT NULL,
  `print_width` float(10, 0) NULL DEFAULT NULL,
  `model_price` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `work_price` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '0',
  `shape_price` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '0',
  `w_work_price` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `w_shape_price` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Ghi chú',
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `device` tinyint(4) NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `ord` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of printers
-- ----------------------------
INSERT INTO `printers` VALUES (1, 'Máy in offset 36x52', 36, 52, '66000', '32', '100000', '15', '24000', NULL, 1, '2023-09-01 00:00:00', '2023-10-06 12:48:21', 1, 1, NULL);
INSERT INTO `printers` VALUES (2, 'Máy in offset 47x65', 47, 65, '66000', '32', '100000', '15', '24000', NULL, 1, '2023-09-01 00:00:00', '2023-09-13 00:38:06', 1, 1, NULL);
INSERT INTO `printers` VALUES (3, 'Máy in offset 52x72', 52, 72, '66000', '35', '110000', '15', '24000', NULL, 1, '2023-09-01 00:00:00', '2023-09-13 00:37:46', 1, 1, NULL);
INSERT INTO `printers` VALUES (4, 'Máy in offset 54x79', 55, 80, '123600', '50', '180000', '20', '30000', NULL, 1, '2023-09-01 00:00:00', '2023-10-06 12:49:18', 1, 1, NULL);
INSERT INTO `printers` VALUES (5, 'Máy in offset 72x102', 72, 102, '123600', '80', '220000', '30', '40000', NULL, 1, '2023-09-01 00:00:00', '2023-10-06 12:49:33', 1, 0, NULL);
INSERT INTO `printers` VALUES (6, 'Máy in offset 79x109', 79, 109, '158000', '120', '300000', '0', '0', NULL, 1, '2023-09-01 00:00:00', '2023-09-13 00:36:28', 1, 0, NULL);
INSERT INTO `printers` VALUES (7, 'Máy in uv 36x52', 36, 52, '66000', '180', '250000', '45', '50000', NULL, 1, '2023-09-01 00:00:00', '2023-09-14 19:03:29', 2, 0, NULL);
INSERT INTO `printers` VALUES (8, 'Máy in uv 47x65', 47, 65, '66000', '200', '250000', '45', '50000', NULL, 1, '2023-09-01 00:00:00', '2023-09-14 19:03:04', 2, 0, NULL);
INSERT INTO `printers` VALUES (9, 'Máy in uv 52x72', 52, 72, '66000', '250', '300000', '45', '50000', NULL, 1, '2023-09-01 00:00:00', '2023-09-14 19:02:21', 2, 1, NULL);
INSERT INTO `printers` VALUES (10, 'Máy in uv 54x79', 54, 79, '123600', '300', '500000', '60', '70000', NULL, 1, '2023-09-01 00:00:00', '2023-10-06 12:51:14', 2, 1, NULL);
INSERT INTO `printers` VALUES (11, 'Máy in uv 72x102', 72, 102, '123600', '500', '600000', '100', '100000', NULL, 1, '2023-09-01 00:00:00', '2023-10-06 12:50:54', 2, 0, NULL);

-- ----------------------------
-- Table structure for product_categories
-- ----------------------------
DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE `product_categories`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `design_factor` decimal(10, 0) NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `index`(`id`, `name`, `design_factor`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_categories
-- ----------------------------
INSERT INTO `product_categories` VALUES (1, 'Hộp cứng', 0, 1, 1, '2022-11-02 11:34:00', '2022-11-02 11:34:00');
INSERT INTO `product_categories` VALUES (2, 'Hộp giấy', 0, 1, 1, '2022-11-02 23:34:00', '2022-11-02 23:34:00');
INSERT INTO `product_categories` VALUES (3, 'Túi giấy', 0, 1, 1, '2022-11-02 23:34:00', '2022-11-02 23:34:00');
INSERT INTO `product_categories` VALUES (4, 'Tem rời dán tay', 0, 1, 1, '2022-11-02 23:34:00', '2023-07-26 15:33:29');
INSERT INTO `product_categories` VALUES (5, 'Mác giấy', 0, 1, 1, '2022-11-02 23:34:00', '2023-07-26 17:04:54');
INSERT INTO `product_categories` VALUES (6, 'Toa - Tờ rơi - Tờ gấp', 0, 1, 1, '2022-11-02 23:34:00', '2023-07-26 15:33:29');

-- ----------------------------
-- Table structure for product_styles
-- ----------------------------
DROP TABLE IF EXISTS `product_styles`;
CREATE TABLE `product_styles`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `category` int(10) NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `index`(`id`, `name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_styles
-- ----------------------------
INSERT INTO `product_styles` VALUES (10, 'Hộp âm dương', 1, 1, 1, '2023-09-20 15:01:31', '2023-09-20 15:04:21');
INSERT INTO `product_styles` VALUES (11, 'Hộp âm dương có thành', 1, 1, 1, '2023-09-20 15:04:09', '2023-09-20 15:04:09');
INSERT INTO `product_styles` VALUES (12, 'Hộp nam châm', 1, 1, 1, '2023-09-20 15:04:34', '2023-09-20 15:04:34');
INSERT INTO `product_styles` VALUES (13, 'CÀI ĐÁY', 2, 1, 1, '2023-09-21 23:28:50', '2023-09-21 23:28:50');
INSERT INTO `product_styles` VALUES (14, 'KHÓA ĐÁY', 2, 1, 1, '2023-09-21 23:29:05', '2023-09-21 23:29:05');
INSERT INTO `product_styles` VALUES (15, 'RÁN MÓC ĐÁY', 2, 1, 1, '2023-09-21 23:29:19', '2023-09-21 23:29:19');
INSERT INTO `product_styles` VALUES (16, 'Khay Thuyền', 1, 1, 1, '2023-10-04 08:48:19', '2023-10-04 08:48:19');
INSERT INTO `product_styles` VALUES (17, 'KHAY GỖ MDF', 1, 1, 1, '2023-10-05 21:39:00', '2023-10-05 21:39:00');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `category` int(10) NULL DEFAULT NULL,
  `product_style` int(10) NULL DEFAULT NULL,
  `qty` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `design` int(10) NULL DEFAULT NULL,
  `length` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `width` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `height` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `quote_id` int(10) NULL DEFAULT NULL,
  `order` int(10) NULL DEFAULT NULL,
  `total_cost` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `total_amount` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `custom_design_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `sale_shape_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `tech_shape_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `design_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `design_shape_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `handle_shape_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `order_created` tinyint(4) NULL DEFAULT NULL,
  `detail` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 94 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (61, NULL, 'Bộ (hộp+tem+toa) Olymcouta', 2, NULL, '5000', 3, '6', '5.5', '13', NULL, NULL, NULL, '9459746.1238', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '');
INSERT INTO `products` VALUES (62, NULL, 'Bộ ( Hộp + tem+toa) Thymo glucan', 2, NULL, '3500', 3, '13', '65', '11', NULL, NULL, NULL, '8220614.984', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '');
INSERT INTO `products` VALUES (63, NULL, 'Hộp giấy INSUVA + Toa + Tích điểm + Cẩm nang', 2, NULL, '6700', 1, '16', '10.5', '3.3', NULL, NULL, NULL, '10516572.456', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '');
INSERT INTO `products` VALUES (73, NULL, '2024 BG khay thuyền phổ thông', 1, 16, '10000', 1, '15', '26', '15', 101, NULL, '109118785.5', '109118785.5', NULL, '{\"id\":\"121\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/Nền màu xanh.jpg\",\"name\":\"Nền màu xanh.jpg\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-10-18 06:13:46', '2023-10-19 14:44:00', 1, NULL, NULL);
INSERT INTO `products` VALUES (74, NULL, '2024 Trụ tròn đường kính 32 x cao12cm', 6, NULL, '10000', 1, NULL, NULL, NULL, 102, NULL, '121663106.25', '121663106.25', NULL, '{\"id\":\"122\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/Nền màu xanh(1).jpg\",\"name\":\"Nền màu xanh(1).jpg\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-10-18 06:54:41', '2023-10-18 06:54:41', 1, NULL, NULL);
INSERT INTO `products` VALUES (75, NULL, '2024 PHỤ KIỆN ĐÁY CHAI RƯỢU + CỔ CHAI', 1, 10, '100000', 1, '1', '1', '1', 106, NULL, '139662235.15', '139662235.15', NULL, '{\"id\":\"123\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/Nền màu xanh(2).jpg\",\"name\":\"Nền màu xanh(2).jpg\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-10-18 07:12:16', '2023-10-18 07:12:54', 1, NULL, NULL);
INSERT INTO `products` VALUES (76, NULL, 'Hộp cứng A502770 PARAMOUNT', 1, 10, '13000', 1, '78', '80', '58', 110, NULL, '46588845.9', '51347730.49', NULL, '{\"id\":\"125\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/A5-A9.cdr\",\"name\":\"A5-A9.cdr\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-10-21 06:38:56', '2023-10-21 07:07:19', 1, NULL, NULL);
INSERT INTO `products` VALUES (77, NULL, 'Hộp cứng A742791 PARAMOUNT', 1, 10, '3500', 1, '23.8', '6', '3', 111, NULL, '14050807.72', '17060969.264', NULL, '{\"id\":\"126\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/A5-A9(1).cdr\",\"name\":\"A5-A9(1).cdr\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-10-21 06:53:49', '2023-10-21 07:00:30', 1, NULL, NULL);
INSERT INTO `products` VALUES (78, NULL, 'Tính giá CỔ CHAI RƯỢU HQT 2024', 6, NULL, '100000', 1, '58', NULL, '62', 112, NULL, '43440712.32', '43440712.32', NULL, '{\"id\":\"127\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(4).cdr\",\"name\":\"1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(4).cdr\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-10-21 07:45:42', '2023-10-21 07:50:51', 1, NULL, NULL);
INSERT INTO `products` VALUES (79, NULL, 'Tính giá ĐÁY CHAI RƯỢU HQT 2024', 1, 10, '100000', 1, '1', '1', '1', 113, NULL, '100476981.2', '100476981.2', NULL, '{\"id\":\"128\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(5).cdr\",\"name\":\"1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(5).cdr\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-10-21 07:56:21', '2023-10-21 07:56:21', 1, NULL, NULL);
INSERT INTO `products` VALUES (80, NULL, 'Tính giá VÁCH CHUNG NGĂN CHAI RƯỢU HQT 2024', 1, 10, '100000', 1, '1', '1', '1', 114, NULL, '320790947.2', '320790947.2', NULL, '{\"id\":\"129\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(6).cdr\",\"name\":\"1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(6).cdr\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-10-21 08:01:37', '2023-10-21 08:04:30', 1, NULL, NULL);
INSERT INTO `products` VALUES (81, NULL, 'Tính giá Mã A HQT 2024', 1, 11, '10000', 1, '36', '42', '10', 115, NULL, '421298807.5', '421298807.5', NULL, '{\"id\":\"130\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(7).cdr\",\"name\":\"1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(7).cdr\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-10-21 08:18:05', '2023-10-21 08:24:17', 1, NULL, NULL);
INSERT INTO `products` VALUES (82, NULL, 'Tính giá Mã A HQT 2024 ( Sửa metailai về 2800đ/m )', 1, 11, '10000', 1, '36', '42', '10', 116, NULL, '432406447.5', '432406447.5', NULL, '{\"id\":\"130\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(7).cdr\",\"name\":\"1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(7).cdr\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-10-21 08:31:07', '2023-10-21 08:45:29', 1, NULL, NULL);
INSERT INTO `products` VALUES (83, NULL, 'Tính giá Mã B HQT 2024 ( Sửa metailai về 2800đ/m )', 1, 11, '10000', 1, '36', '36', '10', 117, NULL, '403826147.5', '403826147.5', NULL, '{\"id\":\"130\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(7).cdr\",\"name\":\"1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(7).cdr\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-10-21 08:39:17', '2023-10-21 08:49:17', 1, NULL, NULL);
INSERT INTO `products` VALUES (84, NULL, 'Tính giá Mã C HQT 2024 ( Sửa metailai về 2800đ/m )', 1, 11, '10000', 1, '36', '36', '10', 118, NULL, '363475020', '363475020', NULL, '{\"id\":\"130\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(7).cdr\",\"name\":\"1 TÚI QUÀ TẾT KT chuẩn 2024 3 loại CHUẨN NHẤT 9999(7).cdr\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-10-21 08:49:37', '2023-10-21 08:55:53', 1, NULL, NULL);
INSERT INTO `products` VALUES (85, NULL, 'Hộp cứng SILYMARIN X7 + Cẩm nang + Toa', 1, 12, '5000', 1, '18.5', '14.5', '5.5', 119, NULL, '54263679.751', '62628231.71365', NULL, '{\"id\":\"131\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/Hộp cứng Bigfam.cdr\",\"name\":\"Hộp cứng Bigfam.cdr\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-10-21 14:41:39', '2023-10-31 18:51:48', 1, NULL, NULL);
INSERT INTO `products` VALUES (86, NULL, 'HDSD Tiếng hàn quốc', 6, NULL, '10200', 1, '14.5', NULL, '20.5', 120, NULL, '1554613.2', '1885535.84', NULL, '{\"id\":\"132\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/khăn mat.pdf\",\"name\":\"khăn mat.pdf\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-10-25 08:50:39', '2023-10-25 10:37:02', 1, NULL, NULL);
INSERT INTO `products` VALUES (88, NULL, 'Bao giá hộp kay + zales 9.5 x 6.9 x 2.7cm', 1, 10, '309330', 1, '9.5', '6.9', '2.7', 123, NULL, '924320083.596', '999065690.28368', NULL, '{\"id\":\"134\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/Tinh giá.cdr\",\"name\":\"Tinh giá.cdr\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-10-31 09:37:38', '2023-10-31 09:45:39', 1, NULL, NULL);
INSERT INTO `products` VALUES (89, NULL, 'Bao giá hộp kay + zales 9.5 x 6.9 x 2.7cm', 1, 10, '309330', 1, '9.5', '6.9', '2.7', 124, NULL, '924320083.596', '999065690.28368', NULL, '{\"id\":\"134\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/Tinh giá.cdr\",\"name\":\"Tinh giá.cdr\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-10-31 09:51:08', '2023-10-31 09:51:23', 1, NULL, NULL);
INSERT INTO `products` VALUES (90, NULL, 'Hộp 29 X 36 X 10.5cm Cắt CNC', 1, 12, '3000', 1, '29', '36', '10.5', 126, NULL, '156692249.64', '161692249.64', NULL, '{\"id\":\"135\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/HQT cặp xách 2024.cdr\",\"name\":\"HQT cặp xách 2024.cdr\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-11-01 16:22:02', '2023-11-01 16:39:53', 1, NULL, NULL);
INSERT INTO `products` VALUES (91, NULL, 'Hộp 36 X 36 X 10.5cm Cắt CNC', 1, 12, '3000', 1, '29', '36', '10.5', 127, NULL, '160229329.58', '165229329.58', NULL, '{\"id\":\"136\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/HQT 36x36 cao cấp 2024(2).cdr\",\"name\":\"HQT 36x36 cao cấp 2024(2).cdr\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-11-01 16:27:03', '2023-11-01 16:38:57', 1, NULL, NULL);
INSERT INTO `products` VALUES (92, NULL, 'Hộp 42 X 36 X 10.5cm Cắt CNC', 1, 12, '3000', 1, '29', '36', '10.5', 128, NULL, '168237577.18', '173237577.18', NULL, '{\"id\":\"137\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/HQT 36x42 cao cấp 2024.cdr\",\"name\":\"HQT 36x42 cao cấp 2024.cdr\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-11-01 16:41:10', '2023-11-01 16:46:30', 1, NULL, NULL);
INSERT INTO `products` VALUES (93, NULL, '3 Loại Hộp giấy 10.5 x 15 x 4.5cm ( 3 x 10.000 = 30.000 sp )', 2, 13, '30000', 1, '10.5', '4.5', '15', 129, NULL, '25733091.25', '29668054.9375', NULL, '{\"id\":\"138\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/Khuôn ĐỨC HNA.cdr\",\"name\":\"Khuôn ĐỨC HNA.cdr\"}', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-11-02 08:44:18', '2023-11-02 08:45:08', 1, NULL, NULL);

-- ----------------------------
-- Table structure for quote_configs
-- ----------------------------
DROP TABLE IF EXISTS `quote_configs`;
CREATE TABLE `quote_configs`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyword` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `act` tinyint(1) NULL DEFAULT 0,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ord` int(10) NULL DEFAULT NULL COMMENT 'Sắp xếp',
  `other_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `required` tinyint(4) NULL DEFAULT NULL,
  `region` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`, `keyword`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of quote_configs
-- ----------------------------
INSERT INTO `quote_configs` VALUES (1, 'office_add', 'OFFICE_ADD', 'Lô D5-16 Cụm Làng Nghề Triều Khúc - HN', 1, 'text', 'Địa chỉ văn phòng', 2, NULL, 0, '1', '2023-05-09 17:09:41', '2023-10-14 16:40:38', 0);
INSERT INTO `quote_configs` VALUES (2, 'office_phone', 'OFFICE_PHONE', '38.303.666 - 38.303.888', 1, 'text', 'SĐT văn phòng', 2, NULL, 0, '1', '2023-05-09 17:09:41', '2023-05-09 17:09:41', 0);
INSERT INTO `quote_configs` VALUES (3, 'site', 'SITE', 'baobituandung.com', 1, 'text', 'Website', 2, NULL, 0, '1', '2023-05-09 17:09:42', '2023-10-14 16:29:56', 0);
INSERT INTO `quote_configs` VALUES (4, 'fact_add', 'FACT_ADD', 'KCN Hoa Sơn - Ứng Hòa - TP Hà Nội', 1, 'text', 'Địa chỉ nhà xưởng', 2, NULL, 0, '1', '2023-05-09 17:09:43', '2023-05-09 17:09:43', 0);
INSERT INTO `quote_configs` VALUES (5, 'fact_phone', 'FACT_PHONE', '38.303.777', 1, 'text', 'SĐT nhà xưởng', 2, NULL, 0, '1', '2023-05-09 17:09:44', '2023-05-09 17:09:44', 0);
INSERT INTO `quote_configs` VALUES (6, 'quote_wish', 'QUOTE_WISH', 'Cty CP in & SX bao bì Tuấn Dung xin gửi báo giá theo yêu cầu của quý khách. </br> \r\n          Chúc quý khách Mạnh Khỏe – Hạnh Phúc – An Khang Thịnh Vượng!', 1, 'textarea', 'Lời chúc', 2, NULL, 0, '1', '2023-05-09 17:09:44', '2023-05-09 17:09:44', 0);
INSERT INTO `quote_configs` VALUES (7, 'dvt', 'DVT', 'Sản phẩm', 1, 'text', 'Đơn vị tính', 2, NULL, 0, '1', '2023-05-09 17:09:45', '2023-05-09 17:09:45', 0);
INSERT INTO `quote_configs` VALUES (8, 'attention', 'ATTENTION', '<p style=\"text-align: left;\">1. Giao h&agrave;ng tận nơi theo y&ecirc;u cầu của qu&yacute; kh&aacute;ch</p>\r\n<p class=\"font-italic mb-1\">2. Đơn gi&aacute; chưa bao gồm 10% VAT.</p>\r\n<p class=\"font-italic mb-1\">3&nbsp; B&aacute;o gi&aacute; c&oacute; hiệu lực trong v&ograve;ng 30 ng&agrave;y.</p>\r\n<p class=\"font-italic mb-1\"><strong>4. Xin Q&uacute;y kh&aacute;ch Lưu &yacute;:</strong></p>\r\n<p class=\"font-italic mb-1\"><strong>* Thời gian thực hiện sản xuất đối với hộp giấy mềm l&agrave; từ 5-8&nbsp;ng&agrave;y, T&ugrave;y theo y&ecirc;u cầu của kh&aacute;ch h&agrave;ng &amp; Thời điểm đặt h&agrave;ng hiện tại</strong></p>\r\n<p class=\"font-italic mb-1\"><strong>* Thời gian thực hiện sản xuất đối với hộp Cứng&nbsp;l&agrave; từ&nbsp;7-15&nbsp;ng&agrave;y, T&ugrave;y theo y&ecirc;u cầu của kh&aacute;ch h&agrave;ng &amp; Thời điểm đặt h&agrave;ng hiện tại</strong></p>\r\n<p class=\"font-italic mb-1\">5. Phương thức thanh to&aacute;n: Theo thỏa thuận 2 b&ecirc;n</p>\r\n<div class=\"font-italic ml-md-3\">\r\n<p class=\"font-italic mb-1\"><span style=\"color: #ff0000;\"><strong>&nbsp;</strong></span></p>\r\n</div>', 1, 'editor', 'Lưu ý khách hàng', 2, NULL, 0, '1', '2023-05-09 17:09:46', '2023-05-09 17:09:46', 0);
INSERT INTO `quote_configs` VALUES (9, 'quote_percent', 'QUOTE_PERCENT', '10', 1, 'text', '% Lợi nhận báo giá', 1, NULL, 0, '1', '2023-05-09 17:09:48', '2023-05-09 17:09:48', 0);
INSERT INTO `quote_configs` VALUES (10, 'office_tel', 'OFFICE_TEL', '0969.303.888 Ms Dung', 1, 'text', 'SĐT văn phòng', 2, NULL, 0, '1', '2023-05-09 17:09:49', '2023-05-09 17:09:49', 0);
INSERT INTO `quote_configs` VALUES (11, 'fact_tel', 'FACT_TEL', '0963.303.999 Mr Tuấn', 1, 'text', 'SĐT nhà xưởng', 2, NULL, 0, '1', '2023-05-09 17:09:56', '2023-05-09 17:09:56', 0);
INSERT INTO `quote_configs` VALUES (12, 'apla_price_fac', 'APLA_PRICE_FACTOR', '0.1', 1, 'text', 'ĐG lượt in áp la', 0, NULL, 0, '14', '2023-05-09 17:32:17', '2023-10-01 08:43:55', 0);
INSERT INTO `quote_configs` VALUES (13, 'apla_price_plus', 'APLA_PRICE_PLUS', '100000', 1, 'text', 'ĐG khuôn in áp la', 0, NULL, 0, '14', '2023-05-09 17:32:57', '2023-05-09 17:32:57', 0);
INSERT INTO `quote_configs` VALUES (14, 'compen_percent', 'COMPEN_PERCENT', '2', 1, 'text', 'Bù hao giấy in (%)', 1, NULL, 0, '11', '2023-05-09 19:03:02', '2023-09-28 12:09:20', 0);
INSERT INTO `quote_configs` VALUES (15, 'carton_compen_percent', 'CARTON_COMPEN_PERCENT', '2', 1, 'text', 'Bù hao vật tư carton (%)', 2, NULL, 0, '11', '2023-05-09 19:03:01', '2023-09-30 20:31:08', 0);
INSERT INTO `quote_configs` VALUES (16, 'compen_percent_pro', 'COMPEN_PERCENT_PRO', '1', 1, 'text', 'Bù hao sản phẩm (%)', 0, NULL, 0, '11', '2023-05-09 19:03:00', '2023-09-24 08:41:45', 0);
INSERT INTO `quote_configs` VALUES (17, 'plus_direct', 'PLUS_DIRECT', '50', 1, 'text', 'Tờ in cộng thẳng', 8, NULL, 0, '11', '2023-05-09 19:02:59', '2023-09-28 04:19:02', 0);
INSERT INTO `quote_configs` VALUES (18, 'plus_paper_metalai', 'PLUS_PAPER_METALAI', '100', 1, 'text', 'Bù hao giấy in khi cán metalai', 11, NULL, 0, '11', '2023-05-09 19:02:58', '2023-09-24 08:42:04', 0);
INSERT INTO `quote_configs` VALUES (19, 'print_subtract_paper', 'PRINT_SUBTRACT_PAPER', '1000', 1, 'text', 'Trừ vật tư giấy trước in', 9, NULL, 0, '11', '2023-05-09 19:02:56', '2023-09-24 08:41:55', 0);
INSERT INTO `quote_configs` VALUES (20, 'plus_paper_device', 'PLUS_PAPER_DEVICE', '50', 1, 'text', 'Bù hao máy in', 10, NULL, 0, '11', '2023-05-10 10:36:53', '2023-09-24 08:41:57', 0);
INSERT INTO `quote_configs` VALUES (21, 'magnet_perc', 'MAGNET_PERC', '1.05', 1, 'text', 'Hệ số nam châm', 0, NULL, 0, '14', '2023-05-09 18:54:04', '2023-09-30 17:35:12', 0);
INSERT INTO `quote_configs` VALUES (22, 'vat_perc', 'VAT_PERC', '8', 1, 'text', 'VAT (%)', 1, NULL, 0, '1', '2023-05-09 17:09:48', '2023-05-09 17:09:48', 0);
INSERT INTO `quote_configs` VALUES (23, 'rubber_compen_percent', 'RUBBER_COMPEN_PERCENT', '1', 1, 'text', 'Bù hao vật tư cao su non (%)', 3, NULL, 0, '11', '2023-05-09 19:03:01', '2023-09-24 08:40:44', 0);
INSERT INTO `quote_configs` VALUES (24, 'styro_compen_percent', 'STYRO_COMPEN_PERCENT', '1', 1, 'text', 'Bù hao vật tư mút phẳng (%)', 4, NULL, 0, '11', '2023-05-09 19:03:01', '2023-09-24 15:52:37', 0);
INSERT INTO `quote_configs` VALUES (25, 'decal_compen_percent', 'DECAL_COMPEN_PERCENT', '1', 1, 'text', 'Bù hao vật tư đề can nhung (%)', 5, NULL, 0, '11', '2023-05-09 19:03:01', '2023-09-24 15:52:48', 0);
INSERT INTO `quote_configs` VALUES (26, 'silk_compen_percent', 'SILK_COMPEN_PERCENT', '1', 1, 'text', 'Bù hao vật tư vải lụa (%)', 6, NULL, 0, '11', '2023-05-09 19:03:01', '2023-09-24 15:54:04', 0);
INSERT INTO `quote_configs` VALUES (27, 'mica_compen_percent', 'MICA_COMPEN_PERCENT', '1', 1, 'text', 'Bù hao vật tư mica (%)', 7, NULL, 0, '11', '2023-05-09 19:03:01', '2023-09-24 15:54:08', 0);
INSERT INTO `quote_configs` VALUES (28, 'plus_to_percent', 'PLUS_TO_PERCENT', '50', 1, 'text', 'Tờ in cộng thêm vào % BH', 8, NULL, 0, '11', '2023-05-09 19:02:59', '2023-09-28 04:09:01', 0);
INSERT INTO `quote_configs` VALUES (29, 'plus_to_device_worker', 'PLUS_TO_DEVICE_WORKER', '50', 1, 'text', 'Bù hao máy in', 10, NULL, 0, '11', '2023-05-10 10:36:53', '2023-09-24 08:41:57', 0);
INSERT INTO `quote_configs` VALUES (30, 'office_email', 'OFFICE_EMAIL', 'intuandung2000@gmail.com', 1, 'text', 'SĐT văn phòng', 2, NULL, 0, '1', '2023-05-09 17:09:41', '2023-05-09 17:09:41', 0);

-- ----------------------------
-- Table structure for quotes
-- ----------------------------
DROP TABLE IF EXISTS `quotes`;
CREATE TABLE `quotes`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `seri` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `product_qty` bigint(20) NULL DEFAULT NULL,
  `customer_id` int(10) NULL DEFAULT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `contacter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `telephone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `city` int(10) NULL DEFAULT NULL,
  `profit` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ship_price` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `total_cost` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `total_amount` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `src` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `_index`(`seri`, `name`, `customer_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 130 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of quotes
-- ----------------------------
INSERT INTO `quotes` VALUES (101, 'BG-000108', 'not_accepted', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', NULL, 19, 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', 'kd1.intuandung@gmail.com', '0963303999', '02438303888', NULL, '0', '1500000', '109118785.5', '110618785.5', NULL, 1, NULL, '2023-10-18 06:06:43', '2023-10-19 14:41:52', 1);
INSERT INTO `quotes` VALUES (102, 'BG-000102', 'not_accepted', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', NULL, 19, 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', 'kd1.intuandung@gmail.com', '0963303999', '02438303888', NULL, '0', '2000000', '121663106.25', '123663106.25', NULL, 1, NULL, '2023-10-18 06:36:17', '2023-10-18 06:54:56', 1);
INSERT INTO `quotes` VALUES (106, 'BG-000108', 'not_accepted', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', NULL, 19, 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', 'kd1.intuandung@gmail.com', '0963303999', '02438303888', NULL, '0', '0', '139662235.15', '139662235.15', NULL, 1, NULL, '2023-10-18 07:06:51', '2023-10-19 15:10:39', 1);
INSERT INTO `quotes` VALUES (110, 'BG-000112', 'not_accepted', 'CTY TNHH VIETBRAND', NULL, 4, 'CTY TNHH VIETBRAND', 'Phương', 'Hà Nam', 'Phuongn@vietbrandco.vn', '0977070289', '0977070289', 9047, '10', '1000000', '46588845.9', '51347730.49', NULL, 1, NULL, '2023-10-21 06:30:45', '2023-10-21 07:07:17', 1);
INSERT INTO `quotes` VALUES (111, 'BG-000112', 'not_accepted', 'CTY TNHH VIETBRAND', NULL, 4, 'CTY TNHH VIETBRAND', 'Phương', 'Hà Nam', 'Phuongn@vietbrandco.vn', '0977070289', '0977070289', 9047, '25', '1000000', '14050807.72', '17813509.65', NULL, 1, NULL, '2023-10-21 06:48:26', '2023-10-21 07:00:26', 1);
INSERT INTO `quotes` VALUES (112, 'BG-000113', 'not_accepted', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', NULL, 9, 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', 'kd1.intuandung@gmail.com', '0963303999', '02438303888', 351, '0', '0', '43440712.32', '43440712.32', NULL, 1, NULL, '2023-10-21 07:39:25', '2023-10-21 07:50:54', 1);
INSERT INTO `quotes` VALUES (113, 'BG-000113', 'not_accepted', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', NULL, 20, 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', 'kd1.intuandung@gmail.com', '0963303999', '02438303888', NULL, '0', '0', '100476981.2', '100476981.2', NULL, 1, NULL, '2023-10-21 07:51:27', '2023-10-21 07:56:33', 1);
INSERT INTO `quotes` VALUES (114, 'BG-000114', 'not_accepted', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', NULL, 20, 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', 'kd1.intuandung@gmail.com', '0963303999', '02438303888', NULL, '0', '0', '320790947.2', '320790947.2', NULL, 1, NULL, '2023-10-21 07:58:00', '2023-10-21 08:03:57', 1);
INSERT INTO `quotes` VALUES (115, 'BG-000115', 'not_accepted', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', NULL, 20, 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', 'kd1.intuandung@gmail.com', '0963303999', '02438303888', NULL, '0', '0', '421298807.5', '421298807.5', NULL, 1, NULL, '2023-10-21 08:07:21', '2023-10-21 08:22:45', 1);
INSERT INTO `quotes` VALUES (116, 'BG-000118', 'not_accepted', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', NULL, 20, 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', 'kd1.intuandung@gmail.com', '0963303999', '02438303888', NULL, '0', '0', '432406447.5', '432406447.5', NULL, 1, NULL, '2023-10-21 08:31:07', '2023-10-21 08:45:33', 1);
INSERT INTO `quotes` VALUES (117, 'BG-000118', 'not_accepted', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', NULL, 20, 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', 'kd1.intuandung@gmail.com', '0963303999', '02438303888', NULL, '0', '0', '403826147.5', '403826147.5', NULL, 1, NULL, '2023-10-21 08:39:17', '2023-10-21 08:49:19', 1);
INSERT INTO `quotes` VALUES (118, 'BG-000119', 'not_accepted', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', NULL, 20, 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', 'kd1.intuandung@gmail.com', '0963303999', '02438303888', NULL, '0', '0', '363475020', '363475020', NULL, 1, NULL, '2023-10-21 08:49:37', '2023-10-21 08:55:59', 1);
INSERT INTO `quotes` VALUES (119, 'BG-000125', 'not_accepted', 'CTY CP THƯƠNG MẠI DƯỢC PHẨM BIGFAM', NULL, 1, 'CTY CP THƯƠNG MẠI DƯỢC PHẨM BIGFAM', 'Ms Thảo', 'Tòa R2 TTTM Royal City, 72A Nguyễn Trãi - Thanh Xuân - HN', 'zalo', '0325544040', '0325544040', 351, '15', '1500000', '54263679.751', '62628231.71365', NULL, 1, NULL, '2023-10-21 14:29:16', '2023-10-31 18:51:54', 1);
INSERT INTO `quotes` VALUES (120, 'BG-000122', 'not_accepted', 'CÔNG TY DỆT MAY THÀNH VƯỢNG', NULL, 3, 'CÔNG TY DỆT MAY THÀNH VƯỢNG', 'Ms Hằng', 'Hoa sơn - Ứng hòa - Hà nội', 'zalo', '0979359387', '0979359387', 351, '20', '100000', '1554613.2', '1885535.84', NULL, 1, NULL, '2023-10-25 08:47:59', '2023-10-25 10:37:15', 1);
INSERT INTO `quotes` VALUES (123, 'BG-000123', 'not_accepted', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', NULL, 20, 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', 'kd1.intuandung@gmail.com', '0963303999', '02438303888', NULL, '8', '10000000', '924320083.596', '999065690.28368', NULL, 1, NULL, '2023-10-31 09:26:17', '2023-10-31 09:45:43', 1);
INSERT INTO `quotes` VALUES (124, 'BG-000125', 'not_accepted', 'CTY TNHH VIETBRAND', NULL, 4, 'CTY TNHH VIETBRAND', 'Phương', 'Hà Nam', 'Phuongn@vietbrandco.vn', '0977070289', '0977070289', 9047, '8', '10000000', '924320083.596', '999065690.28368', NULL, 1, NULL, '2023-10-31 09:51:08', '2023-10-31 09:51:27', 1);
INSERT INTO `quotes` VALUES (125, 'BG-000125', 'not_accepted', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', NULL, 9, 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', 'kd1.intuandung@gmail.com', '0963303999', '02438303888', 351, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-11-01 16:09:28', '2023-11-01 16:09:28', 1);
INSERT INTO `quotes` VALUES (126, 'BG-000128', 'not_accepted', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', NULL, 9, 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', 'kd1.intuandung@gmail.com', '0963303999', '02438303888', 351, '0', '5000000', '156692249.64', '161692249.64', NULL, 1, NULL, '2023-11-01 16:10:22', '2023-11-01 16:39:56', 1);
INSERT INTO `quotes` VALUES (127, 'BG-000128', 'not_accepted', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', NULL, 9, 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', 'kd1.intuandung@gmail.com', '0963303999', '02438303888', 351, '0', '5000000', '160229329.58', '165229329.58', NULL, 1, NULL, '2023-11-01 16:27:03', '2023-11-01 16:39:05', 1);
INSERT INTO `quotes` VALUES (128, 'BG-000129', 'not_accepted', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', NULL, 9, 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Mr Tuấn', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', 'kd1.intuandung@gmail.com', '0963303999', '02438303888', 351, '0', '5000000', '168237577.18', '173237577.18', NULL, 1, NULL, '2023-11-01 16:41:10', '2023-11-01 17:00:59', 1);
INSERT INTO `quotes` VALUES (129, 'BG-000129', 'not_accepted', 'CÔNG TY HNA', NULL, 21, 'CÔNG TY HNA', 'Mr Đức', '171 Kim Mã - HN', 'zalo', '0382700882', '0382700882', 351, '15', '500000', '25733091.25', '29668054.9375', NULL, 1, NULL, '2023-11-02 08:41:50', '2023-11-02 08:45:16', 1);

-- ----------------------------
-- Table structure for square_warehouses
-- ----------------------------
DROP TABLE IF EXISTS `square_warehouses`;
CREATE TABLE `square_warehouses`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `width` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `qty` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `supp_price` int(10) NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of square_warehouses
-- ----------------------------
INSERT INTO `square_warehouses` VALUES (1, 'Màng nilon mờ', '70', '39143', 'nilon', 9, 'imported', NULL, 1, '2023-09-23 16:18:36', '2023-09-29 14:11:58', 1);
INSERT INTO `square_warehouses` VALUES (2, 'Nilon mờ ( đã gọi )', '71.5', '100000', 'nilon', 9, 'imported', NULL, 1, '2023-09-24 16:08:00', '2023-09-24 16:08:46', 1);
INSERT INTO `square_warehouses` VALUES (3, 'mang nilon test', '11', '1111', 'nilon', 9, 'imported', NULL, 1, '2023-09-25 23:37:00', '2023-09-25 23:37:00', 7);
INSERT INTO `square_warehouses` VALUES (4, 'nilon mờ ( test )', '100', '20000', 'nilon', 9, 'imported', NULL, 1, '2023-09-29 15:37:23', '2023-09-29 15:37:23', 7);
INSERT INTO `square_warehouses` VALUES (5, 'màng mờ', '50.5', '530000', 'nilon', 9, 'imported', NULL, 1, '2023-10-07 08:29:35', '2023-10-07 08:29:35', 7);
INSERT INTO `square_warehouses` VALUES (6, 'màng mờ', '101', '530000', 'nilon', 9, 'imported', NULL, 1, '2023-10-07 08:49:10', '2023-10-07 08:49:10', 7);

-- ----------------------------
-- Table structure for supplies
-- ----------------------------
DROP TABLE IF EXISTS `supplies`;
CREATE TABLE `supplies`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` int(10) NULL DEFAULT NULL,
  `product_qty` bigint(20) NULL DEFAULT NULL,
  `nqty` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `base_supp_qty` bigint(20) NULL DEFAULT NULL,
  `compent_percent` decimal(10, 0) NULL DEFAULT NULL,
  `compent_plus` bigint(20) NULL DEFAULT NULL,
  `supp_qty` bigint(20) NULL DEFAULT NULL,
  `size` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cut` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `elevate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `peel` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `mill` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `handle_elevate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `product` int(10) NULL DEFAULT NULL,
  `total_cost` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `quote_index`(`product`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 173 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supplies
-- ----------------------------
INSERT INTO `supplies` VALUES (139, NULL, 49, 10000, '2', 5000, 100, 50, 5150, '{\"length\":\"59\",\"width\":\"91\",\"supply_type\":\"21\",\"supply_price\":\"119\",\"qttv_price\":1.54,\"supp_qty\":5150,\"act\":1,\"total\":42581539}', '{\"act\":0}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":5150,\"handle_qty\":5050,\"cost\":1677850,\"act\":1,\"total\":1677850}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":222000}', '{\"act\":0}', NULL, NULL, 'carton', NULL, 73, '44481389', 1, '2023-10-19 14:38:58', '2023-10-19 14:38:58', 1);
INSERT INTO `supplies` VALUES (140, NULL, 54, 10000, '5', 2000, 40, 50, 2090, '{\"length\":\"46\",\"width\":\"60\",\"supply_type\":\"50\",\"supply_price\":\"224\",\"qttv_price\":0.65,\"supp_qty\":2090,\"act\":1,\"total\":3749460}', '{\"act\":0}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":2090,\"handle_qty\":2050,\"cost\":827500,\"act\":1,\"total\":827500}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":222000}', '{\"act\":0}', '2 chân chống', NULL, 'carton', NULL, 73, '4798960', 1, '2023-10-19 14:38:58', '2023-10-19 14:38:58', 1);
INSERT INTO `supplies` VALUES (141, NULL, 54, 10000, '6', 1667, 34, 50, 1751, '{\"length\":\"66\",\"width\":\"55\",\"supply_type\":\"50\",\"supply_price\":\"224\",\"qttv_price\":0.65,\"supp_qty\":1751,\"act\":1,\"total\":4131484.5}', '{\"act\":0}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":1751,\"handle_qty\":1717,\"cost\":907150,\"act\":1,\"total\":907150}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":222000}', '{\"act\":0}', NULL, NULL, 'carton', NULL, 73, '5260634.5', 1, '2023-10-19 14:38:58', '2023-10-19 14:38:58', 1);
INSERT INTO `supplies` VALUES (142, NULL, 49, 100000, '7', 14286, 286, 0, 14572, '{\"length\":\"63\",\"width\":\"25.5\",\"supply_type\":\"21\",\"supply_price\":\"121\",\"qttv_price\":1.925,\"supp_qty\":14572,\"act\":1,\"total\":45064092.150000006}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":14572,\"handle_qty\":14336,\"act\":1,\"total\":1265760}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":14572,\"handle_qty\":14336,\"cost\":2526775,\"act\":1,\"total\":2526775}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":101000,\"handle_qty\":100050,\"act\":1,\"total\":2040000}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":101000,\"factor\":1,\"handle_qty\":100050,\"act\":1,\"total\":15250000}', NULL, NULL, 'carton', NULL, 75, '66146627.15', 1, '2023-10-18 07:12:54', '2023-10-18 07:12:54', 1);
INSERT INTO `supplies` VALUES (143, NULL, 51, 13000, '4', 3250, 65, 100, 3415, '{\"length\":\"37\",\"width\":\"38\",\"supply_type\":\"5\",\"supply_price\":\"123\",\"qttv_price\":1.31,\"supp_qty\":3415,\"act\":1,\"total\":6289951.9}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":3415,\"handle_qty\":3300,\"act\":1,\"total\":373200}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":3415,\"handle_qty\":3300,\"cost\":823150,\"act\":1,\"total\":823150}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":13130,\"handle_qty\":13050,\"act\":1,\"total\":282600}', '{\"act\":0}', NULL, NULL, 'carton', NULL, 76, '7768901.9', 1, '2023-10-21 06:41:23', '2023-10-21 06:41:23', 1);
INSERT INTO `supplies` VALUES (144, NULL, 52, 13000, '4', 3250, 65, 100, 3415, '{\"length\":\"40\",\"width\":\"39\",\"supply_type\":\"5\",\"supply_price\":\"123\",\"qttv_price\":1.31,\"supp_qty\":3415,\"act\":1,\"total\":6978894.000000001}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":3415,\"handle_qty\":3300,\"act\":1,\"total\":373200}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":3415,\"handle_qty\":3300,\"cost\":846250,\"act\":1,\"total\":846250}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":13130,\"handle_qty\":13050,\"act\":1,\"total\":282600}', '{\"act\":0}', NULL, NULL, 'carton', NULL, 76, '8480944', 1, '2023-10-21 06:41:23', '2023-10-21 06:41:23', 1);
INSERT INTO `supplies` VALUES (145, NULL, 51, 3500, '2', 1750, 35, 50, 1835, '{\"length\":\"22\",\"width\":\"29\",\"supply_type\":\"5\",\"supply_price\":\"124\",\"qttv_price\":1.464,\"supp_qty\":1835,\"act\":1,\"total\":1713948.72}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":1835,\"handle_qty\":1800,\"act\":1,\"total\":246800}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":1835,\"handle_qty\":1800,\"cost\":470950,\"act\":1,\"total\":470950}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":3535,\"handle_qty\":3550,\"act\":1,\"total\":90700}', '{\"act\":0}', NULL, NULL, 'carton', NULL, 77, '2522398.72', 1, '2023-10-21 06:57:41', '2023-10-21 06:57:41', 1);
INSERT INTO `supplies` VALUES (146, NULL, 52, 3500, '2', 1750, 35, 50, 1835, '{\"length\":\"25\",\"width\":\"31\",\"supply_type\":\"5\",\"supply_price\":\"124\",\"qttv_price\":1.464,\"supp_qty\":1835,\"act\":1,\"total\":2081990.9999999998}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":1835,\"handle_qty\":1800,\"act\":1,\"total\":246800}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":1835,\"handle_qty\":1800,\"cost\":491500,\"act\":1,\"total\":491500}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":3535,\"handle_qty\":3550,\"act\":1,\"total\":90700}', '{\"act\":0}', NULL, NULL, 'carton', NULL, 77, '2910991', 1, '2023-10-21 06:57:41', '2023-10-21 06:57:41', 1);
INSERT INTO `supplies` VALUES (147, NULL, 49, 100000, '7', 14286, 286, 100, 14672, '{\"length\":\"25\",\"width\":\"62\",\"supply_type\":\"21\",\"supply_price\":\"121\",\"qttv_price\":1.925,\"supp_qty\":14672,\"act\":1,\"total\":43777580}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":14672,\"handle_qty\":14336,\"act\":1,\"total\":1273760}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":14672,\"handle_qty\":14336,\"cost\":2533300,\"act\":1,\"total\":2533300}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":101000,\"handle_qty\":100050,\"act\":1,\"total\":2040000}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":101000,\"factor\":1,\"handle_qty\":100050,\"act\":1,\"total\":15250000}', NULL, NULL, 'carton', NULL, 79, '64874640', 1, '2023-10-21 07:56:21', '2023-10-21 07:56:21', 1);
INSERT INTO `supplies` VALUES (148, NULL, 49, 100000, '6', 16667, 334, 100, 17101, '{\"length\":\"54\",\"width\":\"56\",\"supply_type\":\"21\",\"supply_price\":\"121\",\"qttv_price\":1.925,\"supp_qty\":17101,\"act\":1,\"total\":99548341.2}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":17101,\"handle_qty\":16717,\"act\":1,\"total\":1468080}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":17101,\"handle_qty\":16717,\"cost\":3118750,\"act\":1,\"total\":3118750}', '{\"act\":0}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":101000,\"factor\":1,\"handle_qty\":100050,\"act\":1,\"total\":15250000}', NULL, NULL, 'carton', NULL, 80, '119385171.2', 1, '2023-10-21 08:01:37', '2023-10-21 08:01:37', 1);
INSERT INTO `supplies` VALUES (149, NULL, 51, 10000, '2', 5000, 100, 100, 5200, '{\"length\":\"52.5\",\"width\":\"91\",\"supply_type\":\"5\",\"supply_price\":\"129\",\"qttv_price\":2.465,\"supp_qty\":5200,\"act\":1,\"total\":61237994.99999999}', '{\"act\":0}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":5200,\"handle_qty\":5050,\"cost\":1596625,\"act\":1,\"total\":1596625}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":222000}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":10100,\"factor\":2,\"handle_qty\":10050,\"act\":1,\"total\":3130000}', NULL, NULL, 'carton', NULL, 81, '66186620', 1, '2023-10-21 08:18:05', '2023-10-21 08:18:05', 1);
INSERT INTO `supplies` VALUES (150, NULL, 51, 10000, '2', 5000, 100, 100, 5200, '{\"length\":\"52.5\",\"width\":\"91\",\"supply_type\":\"5\",\"supply_price\":\"129\",\"qttv_price\":2.465,\"supp_qty\":5200,\"act\":1,\"total\":61237994.99999999}', '{\"act\":0}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":5200,\"handle_qty\":5050,\"cost\":1596625,\"act\":1,\"total\":1596625}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":222000}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":10100,\"factor\":2,\"handle_qty\":10050,\"act\":1,\"total\":3130000}', NULL, NULL, 'carton', NULL, 81, '66186620', 1, '2023-10-21 08:18:06', '2023-10-21 08:18:06', 1);
INSERT INTO `supplies` VALUES (151, NULL, 50, 10000, '2', 5000, 100, 100, 5200, '{\"length\":\"48\",\"width\":\"77.5\",\"supply_type\":\"21\",\"supply_price\":\"121\",\"qttv_price\":1.925,\"supp_qty\":5200,\"act\":1,\"total\":37237200}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":5200,\"handle_qty\":5050,\"act\":1,\"total\":516000}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":5200,\"handle_qty\":5050,\"cost\":1438000,\"act\":1,\"total\":1438000}', '{\"act\":0}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":10100,\"factor\":2,\"handle_qty\":10050,\"act\":1,\"total\":3130000}', NULL, NULL, 'carton', NULL, 81, '42321200', 1, '2023-10-21 08:18:06', '2023-10-21 08:18:06', 1);
INSERT INTO `supplies` VALUES (152, NULL, 51, 10000, '2', 5000, 100, 100, 5200, '{\"length\":\"52.5\",\"width\":\"91\",\"supply_type\":\"21\",\"supply_price\":\"121\",\"qttv_price\":1.925,\"supp_qty\":5200,\"act\":1,\"total\":47822775}', '{\"act\":0}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":5200,\"handle_qty\":5050,\"cost\":1596625,\"act\":1,\"total\":1596625}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":222000}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":10100,\"factor\":2,\"handle_qty\":10050,\"act\":1,\"total\":3130000}', NULL, NULL, 'carton', NULL, 82, '52771400', 1, '2023-10-21 08:45:30', '2023-10-21 08:45:30', 1);
INSERT INTO `supplies` VALUES (153, NULL, 52, 10000, '2', 5000, 100, 100, 5200, '{\"length\":\"52.5\",\"width\":\"91\",\"supply_type\":\"21\",\"supply_price\":\"121\",\"qttv_price\":1.925,\"supp_qty\":5200,\"act\":1,\"total\":47822775}', '{\"act\":0}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":5200,\"handle_qty\":5050,\"cost\":1596625,\"act\":1,\"total\":1596625}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":222000}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":10100,\"factor\":2,\"handle_qty\":10050,\"act\":1,\"total\":3130000}', NULL, NULL, 'carton', NULL, 82, '52771400', 1, '2023-10-21 08:45:30', '2023-10-21 08:45:30', 1);
INSERT INTO `supplies` VALUES (154, NULL, 50, 10000, '2', 5000, 100, 100, 5200, '{\"length\":\"48\",\"width\":\"77.5\",\"supply_type\":\"21\",\"supply_price\":\"121\",\"qttv_price\":1.925,\"supp_qty\":5200,\"act\":1,\"total\":37237200}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":5200,\"handle_qty\":5050,\"act\":1,\"total\":516000}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":5200,\"handle_qty\":5050,\"cost\":1438000,\"act\":1,\"total\":1438000}', '{\"act\":0}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":10100,\"factor\":2,\"handle_qty\":10050,\"act\":1,\"total\":3130000}', NULL, NULL, 'carton', NULL, 82, '42321200', 1, '2023-10-21 08:45:30', '2023-10-21 08:45:30', 1);
INSERT INTO `supplies` VALUES (155, NULL, 51, 10000, '2', 5000, 100, 100, 5200, '{\"length\":\"46.5\",\"width\":\"91\",\"supply_type\":\"21\",\"supply_price\":\"121\",\"qttv_price\":1.925,\"supp_qty\":5200,\"act\":1,\"total\":42357315}', '{\"act\":0}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":5200,\"handle_qty\":5050,\"cost\":1514725,\"act\":1,\"total\":1514725}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":222000}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":10100,\"factor\":2,\"handle_qty\":10050,\"act\":1,\"total\":3130000}', NULL, NULL, 'carton', NULL, 83, '47224040', 1, '2023-10-21 08:44:25', '2023-10-21 08:44:25', 1);
INSERT INTO `supplies` VALUES (156, NULL, 52, 10000, '2', 5000, 100, 100, 5200, '{\"length\":\"46.5\",\"width\":\"91\",\"supply_type\":\"21\",\"supply_price\":\"121\",\"qttv_price\":1.925,\"supp_qty\":5200,\"act\":1,\"total\":42357315}', '{\"act\":0}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":5200,\"handle_qty\":5050,\"cost\":1514725,\"act\":1,\"total\":1514725}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":222000}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":10100,\"factor\":2,\"handle_qty\":10050,\"act\":1,\"total\":3130000}', NULL, NULL, 'carton', NULL, 83, '47224040', 1, '2023-10-21 08:44:25', '2023-10-21 08:44:25', 1);
INSERT INTO `supplies` VALUES (157, NULL, 50, 10000, '2', 5000, 100, 100, 5200, '{\"length\":\"48\",\"width\":\"71.5\",\"supply_type\":\"21\",\"supply_price\":\"121\",\"qttv_price\":1.925,\"supp_qty\":5200,\"act\":1,\"total\":34354320}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":5200,\"handle_qty\":5050,\"act\":1,\"total\":516000}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":5200,\"handle_qty\":5050,\"cost\":1394800,\"act\":1,\"total\":1394800}', '{\"act\":0}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":10100,\"factor\":2,\"handle_qty\":10050,\"act\":1,\"total\":3130000}', NULL, NULL, 'carton', NULL, 83, '39395120', 1, '2023-10-21 08:44:25', '2023-10-21 08:44:25', 1);
INSERT INTO `supplies` VALUES (158, NULL, 51, 10000, '2', 5000, 100, 100, 5200, '{\"length\":\"39.5\",\"width\":\"91\",\"supply_type\":\"21\",\"supply_price\":\"121\",\"qttv_price\":1.925,\"supp_qty\":5200,\"act\":1,\"total\":35980945}', '{\"act\":0}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":5200,\"handle_qty\":5050,\"cost\":1419175,\"act\":1,\"total\":1419175}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":222000}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":10100,\"factor\":2,\"handle_qty\":10050,\"act\":1,\"total\":3130000}', NULL, NULL, 'carton', NULL, 84, '40752120', 1, '2023-10-21 08:55:53', '2023-10-21 08:55:53', 1);
INSERT INTO `supplies` VALUES (159, NULL, 52, 10000, '2', 5000, 100, 100, 5200, '{\"length\":\"39.5\",\"width\":\"91\",\"supply_type\":\"21\",\"supply_price\":\"121\",\"qttv_price\":1.925,\"supp_qty\":5200,\"act\":1,\"total\":35980945}', '{\"act\":0}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":5200,\"handle_qty\":5050,\"cost\":1419175,\"act\":1,\"total\":1419175}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":10100,\"handle_qty\":10050,\"act\":1,\"total\":222000}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":10100,\"factor\":2,\"handle_qty\":10050,\"act\":1,\"total\":3130000}', NULL, NULL, 'carton', NULL, 84, '40752120', 1, '2023-10-21 08:55:53', '2023-10-21 08:55:53', 1);
INSERT INTO `supplies` VALUES (160, NULL, 50, 10000, '2', 5000, 100, 100, 5200, '{\"length\":\"48\",\"width\":\"64.5\",\"supply_type\":\"21\",\"supply_price\":\"121\",\"qttv_price\":1.925,\"supp_qty\":5200,\"act\":1,\"total\":30990960}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":5200,\"handle_qty\":5050,\"act\":1,\"total\":516000}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":5200,\"handle_qty\":5050,\"cost\":1344400,\"act\":1,\"total\":1344400}', '{\"act\":0}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":10100,\"factor\":2,\"handle_qty\":10050,\"act\":1,\"total\":3130000}', NULL, NULL, 'carton', NULL, 84, '35981360', 1, '2023-10-21 08:55:53', '2023-10-21 08:55:53', 1);
INSERT INTO `supplies` VALUES (161, NULL, 49, 5000, '3', 1667, 34, 20, 1721, '{\"length\":\"41\",\"width\":\"56\",\"supply_type\":\"21\",\"supply_price\":\"118\",\"qttv_price\":1.386,\"supp_qty\":1721,\"act\":1,\"total\":5476662.575999999}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":1721,\"handle_qty\":1717,\"act\":1,\"total\":237680}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":1721,\"handle_qty\":1717,\"cost\":702550,\"act\":1,\"total\":702550}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":5050,\"handle_qty\":5050,\"act\":1,\"total\":121000}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":5050,\"factor\":1,\"handle_qty\":5050,\"act\":1,\"total\":857500}', NULL, NULL, 'carton', NULL, 85, '7395392.576', 1, '2023-10-31 18:51:48', '2023-10-31 18:51:48', 16);
INSERT INTO `supplies` VALUES (162, NULL, 50, 5000, '2', 2500, 50, 0, 2550, '{\"length\":\"29\",\"width\":\"49\",\"supply_type\":\"21\",\"supply_price\":\"118\",\"qttv_price\":1.386,\"supp_qty\":2550,\"act\":1,\"total\":5022240.3}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":2550,\"handle_qty\":2550,\"act\":1,\"total\":304000}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":2550,\"handle_qty\":2550,\"cost\":695650,\"act\":1,\"total\":695650}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":5050,\"handle_qty\":5050,\"act\":1,\"total\":121000}', '{\"act\":0}', NULL, NULL, 'carton', NULL, 85, '6142890.3', 1, '2023-10-31 18:51:48', '2023-10-31 18:51:48', 16);
INSERT INTO `supplies` VALUES (163, NULL, 51, 309330, '20', 15467, 310, 100, 15877, '{\"length\":\"41.5\",\"width\":\"64\",\"supply_type\":\"21\",\"supply_price\":\"105\",\"qttv_price\":0.616,\"supp_qty\":15877,\"act\":1,\"total\":25976296.192}', '{\"act\":0}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":15877,\"handle_qty\":15517,\"cost\":2879950,\"act\":1,\"total\":2879950}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":312424,\"handle_qty\":309380,\"act\":1,\"total\":6268480}', '{\"act\":0}', NULL, NULL, 'carton', NULL, 88, '35124726.192', 1, '2023-10-31 09:45:39', '2023-10-31 09:45:39', 1);
INSERT INTO `supplies` VALUES (164, NULL, 52, 309330, '12', 25778, 516, 100, 26394, '{\"length\":\"38.5\",\"width\":\"61\",\"supply_type\":\"21\",\"supply_price\":\"105\",\"qttv_price\":0.616,\"supp_qty\":26394,\"act\":1,\"total\":38183566.344}', '{\"act\":0}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":26394,\"handle_qty\":25828,\"cost\":4411375,\"act\":1,\"total\":4411375}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":312424,\"handle_qty\":309380,\"act\":1,\"total\":6268480}', '{\"act\":0}', NULL, NULL, 'carton', NULL, 88, '48863421.344', 1, '2023-10-31 09:45:39', '2023-10-31 09:45:39', 1);
INSERT INTO `supplies` VALUES (165, NULL, 51, 309330, '20', 15467, 310, 100, 15877, '{\"length\":\"41.5\",\"width\":\"64\",\"supply_type\":\"21\",\"supply_price\":\"105\",\"qttv_price\":0.616,\"supp_qty\":15877,\"act\":1,\"total\":25976296.192}', '{\"act\":0}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":15877,\"handle_qty\":15517,\"cost\":2879950,\"act\":1,\"total\":2879950}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":312424,\"handle_qty\":309380,\"act\":1,\"total\":6268480}', '{\"act\":0}', NULL, NULL, 'carton', NULL, 89, '35124726.192', 1, '2023-10-31 09:51:09', '2023-10-31 09:51:09', 1);
INSERT INTO `supplies` VALUES (166, NULL, 52, 309330, '12', 25778, 516, 100, 26394, '{\"length\":\"38.5\",\"width\":\"61\",\"supply_type\":\"21\",\"supply_price\":\"105\",\"qttv_price\":0.616,\"supp_qty\":26394,\"act\":1,\"total\":38183566.344}', '{\"act\":0}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":26394,\"handle_qty\":25828,\"cost\":4411375,\"act\":1,\"total\":4411375}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":312424,\"handle_qty\":309380,\"act\":1,\"total\":6268480}', '{\"act\":0}', NULL, NULL, 'carton', NULL, 89, '48863421.344', 1, '2023-10-31 09:51:09', '2023-10-31 09:51:09', 1);
INSERT INTO `supplies` VALUES (167, NULL, 49, 3000, '1', 3000, 60, 100, 3160, '{\"length\":\"80\",\"width\":\"44\",\"supply_type\":\"49\",\"supply_price\":\"219\",\"qttv_price\":1.6835,\"supp_qty\":3160,\"act\":1,\"total\":18725907.2}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":3160,\"handle_qty\":3050,\"act\":1,\"total\":352800}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":3160,\"handle_qty\":3050,\"cost\":1102000,\"act\":1,\"total\":1102000}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":3030,\"handle_qty\":3050,\"act\":1,\"total\":80600}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":3030,\"factor\":1,\"handle_qty\":3050,\"act\":1,\"total\":554500}', NULL, NULL, 'carton', NULL, 90, '20815807.2', 1, '2023-11-01 16:22:02', '2023-11-01 16:22:02', 1);
INSERT INTO `supplies` VALUES (168, NULL, 52, 3000, '1', 3000, 60, 100, 3160, '{\"length\":\"56\",\"width\":\"49\",\"supply_type\":\"49\",\"supply_price\":\"219\",\"qttv_price\":1.6835,\"supp_qty\":3160,\"act\":1,\"total\":14597695.840000002}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":3160,\"handle_qty\":3050,\"act\":1,\"total\":352800}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":3160,\"handle_qty\":3050,\"cost\":985600,\"act\":1,\"total\":985600}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":3030,\"handle_qty\":3050,\"act\":1,\"total\":80600}', '{\"act\":0}', NULL, NULL, 'carton', NULL, 90, '16016695.84', 1, '2023-11-01 16:22:02', '2023-11-01 16:22:02', 1);
INSERT INTO `supplies` VALUES (169, NULL, 49, 3000, '1', 3000, 60, 100, 3160, '{\"length\":\"94\",\"width\":\"38\",\"supply_type\":\"49\",\"supply_price\":\"219\",\"qttv_price\":1.6835,\"supp_qty\":3160,\"act\":1,\"total\":19002539.919999998}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":3160,\"handle_qty\":3050,\"act\":1,\"total\":352800}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":3160,\"handle_qty\":3050,\"cost\":1109800,\"act\":1,\"total\":1109800}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":3030,\"handle_qty\":3050,\"act\":1,\"total\":80600}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":3030,\"factor\":1,\"handle_qty\":3050,\"act\":1,\"total\":554500}', NULL, NULL, 'carton', NULL, 91, '21100239.92', 1, '2023-11-01 16:38:57', '2023-11-01 16:38:57', 1);
INSERT INTO `supplies` VALUES (170, NULL, 52, 3000, '1', 3000, 60, 100, 3160, '{\"length\":\"56\",\"width\":\"56\",\"supply_type\":\"49\",\"supply_price\":\"219\",\"qttv_price\":1.6835,\"supp_qty\":3160,\"act\":1,\"total\":16683080.96}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":3160,\"handle_qty\":3050,\"act\":1,\"total\":352800}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":3160,\"handle_qty\":3050,\"cost\":1044400,\"act\":1,\"total\":1044400}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":3030,\"handle_qty\":3050,\"act\":1,\"total\":80600}', '{\"act\":0}', NULL, NULL, 'carton', NULL, 91, '18160880.96', 1, '2023-11-01 16:38:57', '2023-11-01 16:38:57', 1);
INSERT INTO `supplies` VALUES (171, NULL, 49, 3000, '1', 3000, 60, 100, 3160, '{\"length\":\"94\",\"width\":\"44\",\"supply_type\":\"49\",\"supply_price\":\"219\",\"qttv_price\":1.6835,\"supp_qty\":3160,\"act\":1,\"total\":22002940.96}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":3160,\"handle_qty\":3050,\"act\":1,\"total\":352800}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":3160,\"handle_qty\":3050,\"cost\":1194400,\"act\":1,\"total\":1194400}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":3030,\"handle_qty\":3050,\"act\":1,\"total\":80600}', '{\"machine\":\"7\",\"model_price\":0,\"work_price\":150,\"shape_price\":100000,\"qty_pro\":3030,\"factor\":1,\"handle_qty\":3050,\"act\":1,\"total\":554500}', NULL, NULL, 'carton', NULL, 92, '24185240.96', 1, '2023-11-01 16:44:08', '2023-11-01 16:44:08', 1);
INSERT INTO `supplies` VALUES (172, NULL, 52, 3000, '1', 3000, 60, 100, 3160, '{\"length\":\"62\",\"width\":\"56\",\"supply_type\":\"49\",\"supply_price\":\"219\",\"qttv_price\":1.6835,\"supp_qty\":3160,\"act\":1,\"total\":18470553.92}', '{\"machine\":\"18\",\"model_price\":0,\"work_price\":80,\"shape_price\":100000,\"supp_qty\":3160,\"handle_qty\":3050,\"act\":1,\"total\":352800}', '{\"machine\":\"21\",\"model_price\":150,\"work_price\":150,\"shape_price\":100000,\"supp_qty\":3160,\"handle_qty\":3050,\"cost\":1094800,\"act\":1,\"total\":1094800}', '{\"machine\":\"39\",\"model_price\":0,\"work_price\":20,\"shape_price\":20000,\"qty_pro\":3030,\"handle_qty\":3050,\"act\":1,\"total\":80600}', '{\"act\":0}', NULL, NULL, 'carton', NULL, 92, '19998753.92', 1, '2023-11-01 16:44:08', '2023-11-01 16:44:08', 1);

-- ----------------------------
-- Table structure for supply_buyings
-- ----------------------------
DROP TABLE IF EXISTS `supply_buyings`;
CREATE TABLE `supply_buyings`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `provider` int(10) NULL DEFAULT NULL,
  `supply` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `payment_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `total` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bill` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `applied_by` int(10) NULL DEFAULT NULL,
  `bought_by` int(10) NULL DEFAULT NULL,
  `submited_by` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supply_buyings
-- ----------------------------
INSERT INTO `supply_buyings` VALUES (14, 'CT-00000017', 'Yêu cầu mua vật tư 1', 54, '[{\"supp_type\":\"paper\",\"qty\":\"10000\"},{\"supp_type\":\"nilon\",\"qty\":\"20000\"}]', 'accepted', 'not_payment', NULL, NULL, 'Mua bổ xung cho đơn hàng 1', 1, 6, 17, NULL, NULL, '2023-11-15 06:08:11', '2023-11-16 03:15:44');
INSERT INTO `supply_buyings` VALUES (15, 'CT-00000017', 'Yêu cầu mua vật tư 1', 50, '[{\"supp_type\":\"paper\",\"qty\":\"10000\"},{\"supp_type\":\"paper\",\"size_type\":\"46\",\"qty\":\"20000\"}]', 'accepted', 'not_payment', NULL, NULL, 'Mua bổ xung cho đơn hàng 1', 1, 6, 17, NULL, NULL, '2023-11-15 05:56:28', '2023-11-16 03:15:40');
INSERT INTO `supply_buyings` VALUES (16, 'CT-00000017', 'Yêu cầu mua vật tư 1', 50, '[{\"supp_type\":\"paper\",\"size_type\":\"45\",\"qty\":\"10000\",\"total\":1000000,\"price\":100},{\"supp_type\":\"paper\",\"size_type\":\"46\",\"qty\":\"20000\",\"total\":4000000,\"price\":200},{\"supp_type\":\"nilon\",\"size_type\":\"5\",\"qty\":\"3000\",\"total\":900000,\"price\":300}]', 'submited', 'not_payment', '5900000', '{\"id\":\"134\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/chi-tiet-don-hang.php\",\"name\":\"chi-tiet-don-hang.php\"}', 'Mua bổ xung cho đơn hàng 1', 1, 6, 17, 18, 7, '2023-11-15 22:10:37', '2023-11-17 03:05:11');

-- ----------------------------
-- Table structure for supply_names
-- ----------------------------
DROP TABLE IF EXISTS `supply_names`;
CREATE TABLE `supply_names`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã nhóm',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Tên nhóm',
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Cha',
  `factor` bigint(20) NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Ghi chú',
  `act` tinyint(4) NULL DEFAULT NULL,
  `ord` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name_index`(`name`) USING BTREE,
  INDEX `type_index`(`type`) USING BTREE,
  INDEX `act_indx`(`act`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 56 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supply_names
-- ----------------------------
INSERT INTO `supply_names` VALUES (49, 'CARTON BÌA', 'carton', 1, 'chỉ là tên vật tư cho lệnh sản xuất', 1, NULL, '2023-07-20 10:21:00', '2023-09-15 02:05:25', 1);
INSERT INTO `supply_names` VALUES (50, 'Carton THÀNH', 'carton', 2, 'chỉ là tên vật tư cho lệnh sản xuất', 1, NULL, '2023-07-20 10:21:00', '2023-09-15 02:49:21', 1);
INSERT INTO `supply_names` VALUES (51, 'Carton NẮP', 'carton', 2, 'chỉ là tên vật tư cho lệnh sản xuất', 1, NULL, '2023-07-20 10:21:00', '2023-09-15 04:25:55', 1);
INSERT INTO `supply_names` VALUES (52, 'CARTON ĐÁY', 'carton', 2, 'chỉ là tên vật tư cho lệnh sản xuất', 1, NULL, '2023-07-20 10:21:00', '2023-09-15 04:25:44', 1);
INSERT INTO `supply_names` VALUES (53, 'CARTON GHÉP NẮP + ĐÁY', 'carton', 4, 'chỉ là tên vật tư cho lệnh sản xuất', 1, NULL, '2023-07-20 10:21:00', '2023-09-15 04:25:31', 1);
INSERT INTO `supply_names` VALUES (54, 'CARTON KHAY ĐỊNH HÌNH', 'carton', 2, 'chỉ là tên vật tư cho lệnh sản xuất', 1, NULL, '2023-07-20 10:21:00', '2023-09-15 04:25:10', 1);
INSERT INTO `supply_names` VALUES (55, 'SÓNG E 3 lớp', 'carton', 2, 'chỉ là tên vật tư cho lệnh sản xuất', 1, NULL, '2023-10-06 08:09:30', '2023-10-06 08:09:30', 1);

-- ----------------------------
-- Table structure for supply_prices
-- ----------------------------
DROP TABLE IF EXISTS `supply_prices`;
CREATE TABLE `supply_prices`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã nhóm',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Tên nhóm',
  `price` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `supply_id` int(11) NULL DEFAULT NULL COMMENT 'Cha',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Ghi chú',
  `act` tinyint(4) NULL DEFAULT NULL,
  `ord` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `type_index`(`type`) USING BTREE,
  INDEX `carton_foam_index`(`supply_id`) USING BTREE,
  INDEX `name_index`(`name`) USING BTREE,
  INDEX `act_indx`(`act`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 225 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supply_prices
-- ----------------------------
INSERT INTO `supply_prices` VALUES (9, '1.0cm', '40000', 'rubber', 6, 'Tính theo m2 là 1.25 x 2.5 = 3.125m2 ( tính ra là 40.000đ/m2 )', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (10, '1.5cm', '60000', 'rubber', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (11, '2.0cm', '80000', 'rubber', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (12, '2.5cm', '100000', 'rubber', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (13, '3.0cm', '120000', 'rubber', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (14, '3.5cm', '140000', 'rubber', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (15, '4.0cm', '160000', 'rubber', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (16, '4.5cm', '180000', 'rubber', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (17, '5.0cm', '200000', 'rubber', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (61, 'Mút phẳng K21-0.3cm', '0.63', 'styrofoam', 10, 'giá nhà đại thành 18k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 02:33:28', 0);
INSERT INTO `supply_prices` VALUES (64, 'Mút phẳng K30-0.3cm', '0.9', 'styrofoam', 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 02:42:41', 0);
INSERT INTO `supply_prices` VALUES (67, 'Mút phẳng K40-0.3cm', '1.14', 'styrofoam', 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 02:48:14', 0);
INSERT INTO `supply_prices` VALUES (68, '0.5cm', '60000', 'styrofoam', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (69, '0.8cm', '60000', 'styrofoam', 6, '', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (72, '1 cm', '6', 'styrofoam', 7, '60.000đ/m2 ( Cao su non 35k/m2 + Nhung 25k/m2 )', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1);
INSERT INTO `supply_prices` VALUES (105, 'Carton 0.8ly', '0.6160', NULL, 21, 'Định lượng 700mgr quy đổi ra ly = 1ly, Vd dụ carton 1.8ly thì quy ra CT là 1.8 x 700 = 1260mgr, tương tự như cái khác 2ly x 700 = 1400mgr ( GIÁ NHÀ MAK đưa ra tháng 7 là 10.5/ tấn, giá lấy khách hàng là 11/ tấn để bù trừ băng lề )', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 0);
INSERT INTO `supply_prices` VALUES (106, 'Carton 0.8ly', '1.156', NULL, 5, 'Định lượng 700mgr quy đổi ra ly = 1ly, Vd dụ carton 1.8ly thì quy ra CT là 1.8 x 700 = 1260mgr, tương tự như cái khác 2ly x 700 = 1400mgr ( GIÁ NHÀ MAK đưa ra tháng 7 là 10.5/ tấn, giá lấy khách hàng là 11/ tấn để bù trừ băng lề ) + 5400 gồm giấy + công b', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:39:25', 0);
INSERT INTO `supply_prices` VALUES (115, 'Carton 1ly', '0.77', NULL, 21, 'Định lượng 700mgr quy đổi ra ly = 1ly, Vd dụ carton 1.8ly thì quy ra CT là 1.8 x 700 = 1260mgr, tương tự như cái khác 2ly x 700 = 1400mgr ( GIÁ NHÀ MAK đưa ra tháng 7 là 10.5/ tấn, giá lấy khách hàng là 11/ tấn để bù trừ băng lề )', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1);
INSERT INTO `supply_prices` VALUES (116, 'Carton 1.2ly', '0.9240', NULL, 21, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1);
INSERT INTO `supply_prices` VALUES (117, 'Carton 1.5ly', '1.155', NULL, 21, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1);
INSERT INTO `supply_prices` VALUES (118, 'Carton 1.8ly', '1.3860', NULL, 21, 'Định lượng 700mgr quy đổi ra ly = 1ly, Vd dụ carton 1.8ly thì quy ra CT là 1.8 x 700 = 1260mgr, tương tự như cái khác 2ly x 700 = 1400mgr ( GIÁ NHÀ MAK đưa ra tháng 7 là 10.5/ tấn, giá lấy khách hàng là 11/ tấn để bù trừ băng lề )', 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1);
INSERT INTO `supply_prices` VALUES (119, 'Carton 2ly', '1.54', NULL, 21, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1);
INSERT INTO `supply_prices` VALUES (120, 'Carton 2.2ly', '1.694', NULL, 21, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1);
INSERT INTO `supply_prices` VALUES (121, 'Carton 2.5ly', '1.925', NULL, 21, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1);
INSERT INTO `supply_prices` VALUES (122, 'Carton 3ly', '2.31', NULL, 21, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1);
INSERT INTO `supply_prices` VALUES (123, 'Carton 1ly', '1.31', NULL, 5, 'Định lượng 700mgr quy đổi ra ly = 1ly, Vd dụ carton 1.8ly thì quy ra CT là 1.8 x 700 = 1260mgr, tương tự như cái khác 2ly x 700 = 1400mgr ( GIÁ NHÀ MAK đưa ra tháng 7 là 10.5/ tấn, giá lấy khách hàng là 11/ tấn để bù trừ băng lề ) + 5400 gồm giấy + công b', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:39:53', 1);
INSERT INTO `supply_prices` VALUES (124, 'Carton 1.2ly', '1.464', NULL, 5, 'Định lượng 700mgr quy đổi ra ly = 1ly, Vd dụ carton 1.8ly thì quy ra CT là 1.8 x 700 = 1260mgr, tương tự như cái khác 2ly x 700 = 1400mgr ( GIÁ NHÀ MAK đưa ra tháng 7 là 10.5/ tấn, giá lấy khách hàng là 11/ tấn để bù trừ băng lề ) + 5400 gồm giấy + công b', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:40:23', 1);
INSERT INTO `supply_prices` VALUES (125, 'Carton 1.5ly', '1.695', NULL, 5, 'Định lượng 700mgr quy đổi ra ly = 1ly, Vd dụ carton 1.8ly thì quy ra CT là 1.8 x 700 = 1260mgr, tương tự như cái khác 2ly x 700 = 1400mgr ( GIÁ NHÀ MAK đưa ra tháng 7 là 10.5/ tấn, giá lấy khách hàng là 11/ tấn để bù trừ băng lề ) + 5400 gồm giấy + công b', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:40:59', 1);
INSERT INTO `supply_prices` VALUES (126, 'Carton 1.8ly', '1.926', NULL, 5, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:42:42', 1);
INSERT INTO `supply_prices` VALUES (127, 'Carton 2ly', '2.08', NULL, 5, 'Định lượng 700mgr quy đổi ra ly = 1ly, Vd dụ carton 1.8ly thì quy ra CT là 1.8 x 700 = 1260mgr, tương tự như cái khác 2ly x 700 = 1400mgr ( GIÁ NHÀ MAK đưa ra tháng 7 là 10.5/ tấn, giá lấy khách hàng là 11/ tấn để bù trừ băng lề ) + 5400 gồm giấy + công b', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:43:16', 1);
INSERT INTO `supply_prices` VALUES (128, 'Carton 2.2ly', '2.234', NULL, 5, 'Định lượng 700mgr quy đổi ra ly = 1ly, Vd dụ carton 1.8ly thì quy ra CT là 1.8 x 700 = 1260mgr, tương tự như cái khác 2ly x 700 = 1400mgr ( GIÁ NHÀ MAK đưa ra tháng 7 là 10.5/ tấn, giá lấy khách hàng là 11/ tấn để bù trừ băng lề ) + 5400 gồm giấy + công b', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:43:53', 1);
INSERT INTO `supply_prices` VALUES (129, 'Carton 2.5ly', '2.465', NULL, 5, 'Định lượng 700mgr quy đổi ra ly = 1ly, Vd dụ carton 1.8ly thì quy ra CT là 1.8 x 700 = 1260mgr, tương tự như cái khác 2ly x 700 = 1400mgr ( GIÁ NHÀ MAK đưa ra tháng 7 là 10.5/ tấn, giá lấy khách hàng là 11/ tấn để bù trừ băng lề ) + 5400 gồm giấy + công b', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:44:57', 1);
INSERT INTO `supply_prices` VALUES (131, 'Carton 3ly', '2.85', NULL, 5, 'Định lượng 700mgr quy đổi ra ly = 1ly, Vd dụ carton 1.8ly thì quy ra CT là 1.8 x 700 = 1260mgr, tương tự như cái khác 2ly x 700 = 1400mgr ( GIÁ NHÀ MAK đưa ra tháng 7 là 10.5/ tấn, giá lấy khách hàng là 11/ tấn để bù trừ băng lề ) + 5400 gồm giấy + công b', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:44:45', 1);
INSERT INTO `supply_prices` VALUES (154, 'Cao su non bồi nhung 0.8cm', '1', NULL, 22, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1);
INSERT INTO `supply_prices` VALUES (155, 'Cao su non bồi nhung 1cm', '14.6', NULL, 23, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1);
INSERT INTO `supply_prices` VALUES (156, 'CAO SU NON TRẮNG 0.3cm', '1.2', NULL, 28, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:52:37', 1);
INSERT INTO `supply_prices` VALUES (157, 'CAO SU NON 0.3cm', '1.2', NULL, 29, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2 \r\n6: Bù hoa 5% lề = 38.400 x 5% = 40.300 lấy 40.000đ/m2', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:49:50', 1);
INSERT INTO `supply_prices` VALUES (158, 'CAO SU NON 0.5cm', '2', NULL, 29, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2 \r\n6: Bù hoa 5% lề = 38.400 x 5% = 40.300 lấy 40.000đ/m2', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:49:56', 1);
INSERT INTO `supply_prices` VALUES (159, 'CAO SU NON 0.8cm', '3.2', NULL, 29, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2 \r\n6: Bù hoa 5% lề = 38.400 x 5% = 40.300 lấy 40.000đ/m2', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:50:03', 1);
INSERT INTO `supply_prices` VALUES (160, 'CAO SU NON 1cm', '4', NULL, 29, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2  \r\n6: Bù hoa 5% lề = 38.400 x 5% = 40.300 lấy 40.000đ/m2', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:50:10', 1);
INSERT INTO `supply_prices` VALUES (161, 'CAO SU NON 1.2cm', '4.8', NULL, 29, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2 \r\n6: Bù hoa 5% lề = 38.400 x 5% = 40.300 lấy 40.000đ/m2', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:50:16', 1);
INSERT INTO `supply_prices` VALUES (162, 'CAO SU NON 1.5cm', '6', NULL, 29, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 38.400đ/m2\r\n6: Bù hoa 5% lề = 38.400 x 5% = 40.300 lấy 40.000đ/m2', 1, NULL, '2023-07-20 10:21:00', '2023-09-14 21:34:42', 1);
INSERT INTO `supply_prices` VALUES (163, 'CAO SU NON 1.8cm', '7.2', NULL, 29, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2 \r\n6: Bù hoa 5% lề = 38.400 x 5% = 40.300 lấy 40.000đ/m2', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:50:23', 1);
INSERT INTO `supply_prices` VALUES (164, 'CAO SU NON 2cm', '9', NULL, 29, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2 \r\n6: Bù hoa 5% lề = 38.400 x 5% = 40.300 lấy 40.000đ/m2', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:50:30', 1);
INSERT INTO `supply_prices` VALUES (165, 'CAO SU NON 2.5cm', '11.2', NULL, 29, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2 \r\n6: Bù hoa 5% lề = 38.400 x 5% = 40.300 lấy 40.000đ/m2', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:50:37', 1);
INSERT INTO `supply_prices` VALUES (166, 'CAO SU NON 3cm', '13.5', NULL, 29, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2 \r\n6: Bù hoa 5% lề = 38.400 x 5% = 40.300 lấy 40.000đ/m2', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:50:43', 1);
INSERT INTO `supply_prices` VALUES (167, 'CAO SU NON 3.5cm', '15.7', NULL, 29, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:50:50', 1);
INSERT INTO `supply_prices` VALUES (168, 'CAO SU NON 4cm', '18', NULL, 29, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:50:56', 1);
INSERT INTO `supply_prices` VALUES (172, 'Mica1 DL 0.5', '200', NULL, 37, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1);
INSERT INTO `supply_prices` VALUES (173, 'CAO SU NON TRẮNG 0.5cm', '2', NULL, 28, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2', 1, NULL, '2023-08-30 10:56:35', '2023-09-16 01:52:47', 1);
INSERT INTO `supply_prices` VALUES (174, 'CAO SU NON TRẮNG 0.8cm', '3.2', NULL, 28, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2', 1, NULL, '2023-08-30 10:57:03', '2023-09-16 01:52:57', 1);
INSERT INTO `supply_prices` VALUES (175, 'CAO SU NON TRẮNG 1cm', '4', NULL, 28, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2', 1, NULL, '2023-08-30 10:58:31', '2023-09-16 01:53:10', 1);
INSERT INTO `supply_prices` VALUES (176, 'CAO SU NON TRẮNG 1.2cm', '4.8', NULL, 28, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2', 1, NULL, '2023-08-30 10:58:54', '2023-09-16 01:53:21', 1);
INSERT INTO `supply_prices` VALUES (177, 'CAO SU NON TRẮNG 1.5cm', '6', NULL, 28, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2', 1, NULL, '2023-08-30 10:59:24', '2023-09-16 01:53:33', 1);
INSERT INTO `supply_prices` VALUES (178, 'CAO SU NON TRẮNG 1.8cm', '7.2', NULL, 28, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2', 1, NULL, '2023-08-30 10:59:43', '2023-09-16 01:53:46', 1);
INSERT INTO `supply_prices` VALUES (179, 'CAO SU NON TRẮNG 2cm', '9', NULL, 28, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2', 1, NULL, '2023-08-30 11:00:02', '2023-09-16 01:53:57', 1);
INSERT INTO `supply_prices` VALUES (180, 'CAO SU NON TRẮNG 2.5cm', '11.25', NULL, 28, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2', 1, NULL, '2023-08-30 11:38:49', '2023-09-16 01:54:15', 1);
INSERT INTO `supply_prices` VALUES (181, 'CAO SU NON TRẮNG 3cm', '13.5', NULL, 28, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2', 1, NULL, '2023-08-30 11:39:05', '2023-09-16 01:54:31', 1);
INSERT INTO `supply_prices` VALUES (182, 'CAO SU NON TRẮNG 3.5cm', '15.7', NULL, 28, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2', 1, NULL, '2023-08-30 11:39:24', '2023-09-16 01:54:47', 1);
INSERT INTO `supply_prices` VALUES (183, 'CAO SU NON TRẮNG 4cm', '18', NULL, 28, '1: Tấm cao sun đen & trắng đại thành bán 1.25 x 2.5m = 110k 2: Bù hao bằng lề =  10k\r\n3: Tính khách hàng = 120k/ tấm khổ 1.25 x 2.5m\r\n4: Quy đổi ra m2 là 1.25 x 2.5 = 3,125m2\r\n5: 1m2 = 40.000đ/m2', 1, NULL, '2023-08-30 11:40:41', '2023-09-16 01:55:01', 1);
INSERT INTO `supply_prices` VALUES (184, 'Mút phẳng K21-0.5cm', '1.05', NULL, 10, 'giá nhà đại thành 18k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:34:50', '2023-09-16 02:34:50', 1);
INSERT INTO `supply_prices` VALUES (185, 'Mút phẳng K21-0.8cm', '1.68', NULL, 10, 'giá nhà đại thành 18k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:35:23', '2023-09-16 02:35:23', 1);
INSERT INTO `supply_prices` VALUES (186, 'Mút phẳng K21-1cm', '2.1', NULL, 10, 'giá nhà đại thành 18k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:35:55', '2023-09-16 02:35:55', 1);
INSERT INTO `supply_prices` VALUES (187, 'Mút phẳng K21-1.2cm', '2.52', NULL, 10, 'giá nhà đại thành 18k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:36:22', '2023-09-16 02:36:22', 1);
INSERT INTO `supply_prices` VALUES (188, 'Mút phẳng K21-1.5cm', '3.15', NULL, 10, 'giá nhà đại thành 18k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:36:39', '2023-09-16 02:36:39', 1);
INSERT INTO `supply_prices` VALUES (190, 'Mút phẳng K21-1.8cm', '3.78', NULL, 10, 'giá nhà đại thành 18k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:37:14', '2023-09-16 02:37:14', 1);
INSERT INTO `supply_prices` VALUES (191, 'Mút phẳng K21-2cm', '5.2', NULL, 10, 'giá nhà đại thành 18k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:37:31', '2023-09-16 02:37:31', 1);
INSERT INTO `supply_prices` VALUES (192, 'Mút phẳng K21-2.5cm', '6.5', NULL, 10, 'giá nhà đại thành 18k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:38:07', '2023-09-16 02:38:07', 1);
INSERT INTO `supply_prices` VALUES (193, 'Mút phẳng K21-3cm', '7.8', NULL, 10, 'giá nhà đại thành 18k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:38:21', '2023-09-16 02:38:21', 1);
INSERT INTO `supply_prices` VALUES (194, 'Mút phẳng K21-3.5cm', '9.1', NULL, 10, 'giá nhà đại thành 18k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:38:34', '2023-09-16 02:38:34', 1);
INSERT INTO `supply_prices` VALUES (195, 'Mút phẳng K21-4cm', '10.04', NULL, 10, 'giá nhà đại thành 18k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:39:09', '2023-09-16 02:39:09', 1);
INSERT INTO `supply_prices` VALUES (196, 'Mút phẳng K30-0.5cm', '1.5', NULL, 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:43:20', '2023-09-16 02:43:20', 1);
INSERT INTO `supply_prices` VALUES (197, 'Mút phẳng K30-0.8cm', '2.4', NULL, 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:43:32', '2023-09-16 02:43:32', 1);
INSERT INTO `supply_prices` VALUES (198, 'Mút phẳng K30-1cm', '3', NULL, 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:43:44', '2023-09-16 02:43:44', 1);
INSERT INTO `supply_prices` VALUES (199, 'Mút phẳng K30-1.2cm', '3.6', NULL, 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:44:04', '2023-09-16 02:44:04', 1);
INSERT INTO `supply_prices` VALUES (200, 'Mút phẳng K30-1.5cm', '4.5', NULL, 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:44:22', '2023-09-16 02:44:22', 1);
INSERT INTO `supply_prices` VALUES (201, 'Mút phẳng K30-1.8cm', '5.4', NULL, 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:44:37', '2023-09-16 02:44:37', 1);
INSERT INTO `supply_prices` VALUES (202, 'Mút phẳng K30-2cm', '7', NULL, 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:44:51', '2023-09-16 02:44:51', 1);
INSERT INTO `supply_prices` VALUES (203, 'Mút phẳng K30-2.5cm', '87.5', NULL, 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:45:07', '2023-09-16 02:45:07', 1);
INSERT INTO `supply_prices` VALUES (204, 'Mút phẳng K30-3cm', '10.05', NULL, 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:45:49', '2023-09-16 02:45:49', 1);
INSERT INTO `supply_prices` VALUES (205, 'Mút phẳng K30-3.5cm', '12.25', NULL, 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:46:10', '2023-09-16 02:46:10', 1);
INSERT INTO `supply_prices` VALUES (206, 'Mút phẳng K30-4cm', '14', NULL, 9, 'giá nhà đại thành 25k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:46:24', '2023-09-16 02:46:24', 1);
INSERT INTO `supply_prices` VALUES (207, 'Mút phẳng K40-0.5cm', '19', NULL, 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:48:52', '2023-09-16 02:48:52', 1);
INSERT INTO `supply_prices` VALUES (208, 'Mút phẳng K40-0.8cm', '3.04', NULL, 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:49:21', '2023-09-16 02:49:21', 1);
INSERT INTO `supply_prices` VALUES (209, 'Mút phẳng K40-1cm', '3.8', NULL, 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:49:36', '2023-09-16 02:49:36', 1);
INSERT INTO `supply_prices` VALUES (210, 'Mút phẳng K40-1.2cm', '4.56', NULL, 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:49:55', '2023-09-16 02:49:55', 1);
INSERT INTO `supply_prices` VALUES (211, 'Mút phẳng K40-1.5cm', '5.7', NULL, 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:50:14', '2023-09-16 02:50:14', 1);
INSERT INTO `supply_prices` VALUES (212, 'Mút phẳng K40-1.8cm', '6.84', NULL, 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:50:33', '2023-09-16 02:50:33', 1);
INSERT INTO `supply_prices` VALUES (213, 'Mút phẳng K40-2cm', '8.6', NULL, 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:50:46', '2023-09-16 02:50:46', 1);
INSERT INTO `supply_prices` VALUES (214, 'Mút phẳng K40-2.5cm', '10.75', NULL, 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:51:00', '2023-09-16 02:51:00', 1);
INSERT INTO `supply_prices` VALUES (215, 'Mút phẳng K40-3cm', '12.9', NULL, 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:51:13', '2023-09-16 02:51:13', 1);
INSERT INTO `supply_prices` VALUES (216, 'Mút phẳng K40-3.5cm', '15.05', NULL, 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:51:30', '2023-09-16 02:51:30', 1);
INSERT INTO `supply_prices` VALUES (217, 'Mút phẳng K40-4cm', '17.2', NULL, 8, 'giá nhà đại thành 32k/1m2/ dầy 1cm ( Nhân thêm 20% phía hao hut )', 1, NULL, '2023-09-16 02:51:45', '2023-09-16 02:51:45', 1);
INSERT INTO `supply_prices` VALUES (218, 'MDF 1.9ly', '1.55', NULL, 49, 'Khổ 1.22 x 2.44 = 42.000đ', 1, NULL, '2023-10-04 09:55:53', '2023-10-05 21:13:00', 1);
INSERT INTO `supply_prices` VALUES (219, 'MDF 2.3ly', '1.6835', NULL, 49, 'Khổ 1.22 x 2.44 = 47.500đ', 1, NULL, '2023-10-04 10:03:21', '2023-10-05 21:13:14', 1);
INSERT INTO `supply_prices` VALUES (220, 'MDF 3ly', '2.155', NULL, 49, 'Khổ 1.22 x 2.44 = 60000đ', 1, NULL, '2023-10-04 10:08:33', '2023-10-05 21:13:33', 1);
INSERT INTO `supply_prices` VALUES (221, 'MDF 5ly', '3.4345', NULL, 49, 'Khổ 1.22 x 2.44 = 96000đ', 1, NULL, '2023-10-04 10:09:12', '2023-10-05 21:13:55', 1);
INSERT INTO `supply_prices` VALUES (222, 'MDF 8ly', '4.512', NULL, 49, 'Khổ 1.22 x 2.44 = 96000đ', 1, NULL, '2023-10-05 21:14:28', '2023-10-05 21:14:28', 1);
INSERT INTO `supply_prices` VALUES (223, 'MDF 10ly', '5.0500', NULL, 49, 'Khổ 1.22 x 2.44 = 96000đ', 1, NULL, '2023-10-05 21:14:41', '2023-10-05 21:14:41', 1);
INSERT INTO `supply_prices` VALUES (224, 'SÓNG E 3 lớp loại cứng', '0.65', NULL, 50, 'Nhà phương anh bán 6200đ/m2', 1, NULL, '2023-10-06 08:13:51', '2023-10-06 08:13:51', 1);

-- ----------------------------
-- Table structure for supply_types
-- ----------------------------
DROP TABLE IF EXISTS `supply_types`;
CREATE TABLE `supply_types`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã nhóm',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Tên nhóm',
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Cha',
  `factor` bigint(20) NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Ghi chú',
  `act` tinyint(4) NULL DEFAULT NULL,
  `ord` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NOT NULL,
  `is_name` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name_index`(`name`) USING BTREE,
  INDEX `type_index`(`type`) USING BTREE,
  INDEX `act_indx`(`act`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supply_types
-- ----------------------------
INSERT INTO `supply_types` VALUES (5, 'CARTON NÂU- TRẮNG C120', 'carton', 2, '1 Mặt nâu + 1 mặt bồi C trắng', 1, NULL, '2023-07-20 10:21:00', '2023-09-16 01:35:57', 1, 0);
INSERT INTO `supply_types` VALUES (8, 'Mút phẳng K40', 'styrofoam', 0, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 0);
INSERT INTO `supply_types` VALUES (9, 'Mút phẳng K30', 'styrofoam', 0, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 0);
INSERT INTO `supply_types` VALUES (10, 'Mút phẳng K21', 'styrofoam', 0, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 0);
INSERT INTO `supply_types` VALUES (21, 'CARTON MẶT NÂU - MỘC', 'carton', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-09-14 20:41:01', 1, 0);
INSERT INTO `supply_types` VALUES (28, 'CAO SU NON MÀU TRẮNG', 'rubber', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-08-30 11:35:14', 1, 0);
INSERT INTO `supply_types` VALUES (29, 'CAO SU NON MÀU ĐEN', 'rubber', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-08-30 09:33:39', 1, 0);
INSERT INTO `supply_types` VALUES (37, 'Mica 1', 'mica', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 0);
INSERT INTO `supply_types` VALUES (38, 'KHAY ĐỊNH HÌNH', 'paper', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 1);
INSERT INTO `supply_types` VALUES (39, 'TỜ BỒI THÀNH', 'paper', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 1);
INSERT INTO `supply_types` VALUES (40, 'TỜ BỒI KHAY', 'paper', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 1);
INSERT INTO `supply_types` VALUES (41, 'TỜ BỒI MẶT THÉP', 'paper', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 1);
INSERT INTO `supply_types` VALUES (42, 'TỜ BỒI NẮP HỘP', 'paper', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 1);
INSERT INTO `supply_types` VALUES (43, 'TỜ BỒI ĐÁY HỘP', 'paper', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 1);
INSERT INTO `supply_types` VALUES (44, 'TEM CUỘN', 'paper', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 1);
INSERT INTO `supply_types` VALUES (45, 'TOA IN GHÉP', 'paper', NULL, NULL, 1, NULL, '2023-07-20 10:21:00', '2023-07-20 10:21:00', 1, 1);
INSERT INTO `supply_types` VALUES (48, 'CARTON PHỤ KIỆN', 'carton', NULL, NULL, 1, NULL, '2023-08-30 09:32:57', '2023-08-30 09:32:57', 1, 1);
INSERT INTO `supply_types` VALUES (49, 'GỖ MDF', 'carton', NULL, NULL, 1, NULL, '2023-10-04 09:51:17', '2023-10-04 09:51:17', 1, 0);
INSERT INTO `supply_types` VALUES (50, 'SÓNG E 3 lớp', 'carton', NULL, NULL, 1, NULL, '2023-10-06 08:12:28', '2023-10-06 08:12:28', 1, 0);

-- ----------------------------
-- Table structure for supply_warehouses
-- ----------------------------
DROP TABLE IF EXISTS `supply_warehouses`;
CREATE TABLE `supply_warehouses`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `length` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `width` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `qty` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `supp_type` int(10) NULL DEFAULT NULL,
  `supp_price` int(10) NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `source` tinyint(4) NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `confirm_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `confirm_by` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supply_warehouses
-- ----------------------------
INSERT INTO `supply_warehouses` VALUES (1, 'Carton', '90.6', '51.5', '20636', 'carton', 21, 121, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-09-24 15:45:21', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (5, 'Cao su non DL 0.8mm KT 30x20', '30', '20', '1000000', 'rubber', 28, 156, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-08-07 23:26:08', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (6, 'Cao su non DL 0.8mm KT 50x25', '50', '25', '1000000', 'rubber', 28, 156, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-08-07 23:25:46', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (7, 'Đề can nhung cao cấp KT 60x50', '60', '50', '1000000', 'decal', 46, 92, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-08-07 23:24:41', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (8, 'Đề can nhung cao cấp KT 100 x 50', '100', '50', '1000000', 'decal', 46, 92, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-08-07 23:24:27', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (10, 'Lụa vàng KT 100 x 50', '100', '50', '1000000', 'silk', 47, 75, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-08-07 23:24:16', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (11, 'Lụa vàng KT 30 x 30', '30', '30', '1000000', 'silk', 47, 75, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-08-07 23:24:03', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (13, 'Mút phẳng K21 ĐL 0.5mm KT 50 x 40', '50', '40', '1000000', 'styrofoam', 10, 60, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-07-11 02:25:07', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (14, 'Mút phẳng K21 ĐL 0.5mm KT 50 x 30', '50', '30', '1000000', 'styrofoam', 10, 60, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-07-11 02:25:07', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (15, 'Mút phẳng K21 ĐL 0.5mm KT 100 x 50', '100', '50', '1000000', 'styrofoam', 10, 60, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-07-11 02:25:07', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (17, 'Vật tư mica KT 100 x 50', '100', '50', '1000000', 'mica', 37, 172, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-08-07 23:23:40', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (18, 'Vật tư mica KT 30 x 30', '30', '30', '1000000', 'mica', 37, 172, 'imported', 1, NULL, 1, '2023-07-11 02:25:04', '2023-08-07 16:56:55', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (25, 'Mút phẳng K30 ĐL 1cm KT 100 x 50', '100', '50', '1000000', 'styrofoam', 9, 37, 'imported', NULL, NULL, 1, '2023-08-21 18:16:10', '2023-08-21 18:16:10', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (29, 'Carton', '90.6', '52.5', '4000', 'carton', 21, 121, 'imported', NULL, NULL, 1, '2023-09-24 15:45:53', '2023-09-24 15:47:05', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (30, 'Carton', '90.6', '46.5', '50360', 'carton', 21, 121, 'imported', NULL, NULL, 1, '2023-09-24 15:46:41', '2023-09-24 15:46:41', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (31, 'Carton', '48', '77.5', '14560', 'carton', 21, 121, 'imported', NULL, NULL, 1, '2023-09-24 15:48:15', '2023-09-24 15:48:15', NULL, 1, NULL);
INSERT INTO `supply_warehouses` VALUES (32, 'Carton nháp', '100', '120', '14560', 'carton', 21, 117, 'imported', NULL, NULL, 1, '2023-09-24 16:11:07', '2023-09-24 16:11:07', NULL, 1, NULL);

-- ----------------------------
-- Table structure for w_salaries
-- ----------------------------
DROP TABLE IF EXISTS `w_salaries`;
CREATE TABLE `w_salaries`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `command` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `product` int(10) NULL DEFAULT NULL,
  `table_supply` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `supply` int(10) NULL DEFAULT NULL,
  `qty` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `factor` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `work_price` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `shape_price` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `handle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `total` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `machine_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `worker` int(10) NULL DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `submited_at` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(1) NULL DEFAULT NULL,
  `fill_materal` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `fill_handle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 55 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of w_salaries
-- ----------------------------
INSERT INTO `w_salaries` VALUES (2, 'Test INSUVA ( TEST ) ( TOA IN GHÉP )', 'DH-000001AB', 2, 'papers', 5, '1692', '1', NULL, NULL, '[{\"name\":\"ki\\u1ec3u in\",\"value\":\"In n\\u00f3 tr\\u1edf n\\u00f3\"},{\"name\":\"m\\u00e0u in\",\"value\":4},{\"name\":\"C\\u00f4ng ngh\\u1ec7 in\",\"value\":\"In offset\"}]', NULL, 'print', '1', NULL, 'not_accepted', NULL, 1, NULL, '2023-09-23 15:49:34', '2023-09-23 15:49:34', 6, NULL, NULL);
INSERT INTO `w_salaries` VALUES (3, 'Test INSUVA ( TEST )', 'DH-000001AA', 2, 'papers', 4, '2257', '1', NULL, NULL, '[{\"name\":\"Ch\\u1ea5t li\\u1ec7u c\\u00e1n\",\"value\":\"C\\u00e1n m\\u1edd\"},{\"name\":\"S\\u1ed1 m\\u1eb7t c\\u00e1n\",\"value\":\"1\"},{\"name\":\"M\\u00e1y c\\u00e1n\",\"value\":\"M\\u00c1Y C\\u00c1N NHI\\u1ec6T\"}]', NULL, 'nilon', 'semi_auto', NULL, 'not_accepted', NULL, 1, NULL, '2023-09-23 16:33:58', '2023-09-23 16:33:58', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (7, 'Tests 4-10 Hộp cứng(CARTON BÌA)', 'DH-000018AC', 36, 'supplies', 68, '10100', '1', NULL, NULL, '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"T\\u1ef0 \\u0110\\u1ed8NG\"}]', NULL, 'mill', 'auto', NULL, 'not_accepted', NULL, 1, NULL, '2023-10-04 06:57:32', '2023-10-04 06:57:32', 6, NULL, NULL);
INSERT INTO `w_salaries` VALUES (8, 'Tests 4-10 Hộp cứng(CHI PHÍ BỒI ĐÁY)', 'DH-000018ADA', 36, 'fill_finishes', 14, '10000', '1', NULL, NULL, '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"M\\u00c1Y B\\u1ed2I\"}]', NULL, 'fill', 'semi_auto', NULL, 'not_accepted', NULL, 1, NULL, '2023-10-04 06:57:32', '2023-10-04 06:57:32', 6, '18', '{\"length\":\"51\",\"width\":\"62\",\"materal\":\"18\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":24272000,\"work_price\":500,\"shape_price\":300000}');
INSERT INTO `w_salaries` VALUES (9, 'Tests 4-10 Hộp cứng(CHI PHÍ BỒI THÀNH)', 'DH-000018ADB', 36, 'fill_finishes', 14, '10000', '1', NULL, NULL, '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"M\\u00c1Y B\\u1ed2I\"}]', NULL, 'fill', 'semi_auto', NULL, 'not_accepted', NULL, 1, NULL, '2023-10-04 06:57:32', '2023-10-04 06:57:32', 6, '19', '{\"length\":\"23\",\"width\":\"51\",\"materal\":\"19\",\"machine\":\"48\",\"qttv_price\":0.6,\"cost\":12338000,\"work_price\":500,\"shape_price\":300000}');
INSERT INTO `w_salaries` VALUES (10, 'Tests 4-10 Hộp cứng', 'DH-000018AA', 36, 'papers', 73, '10300', '1', NULL, NULL, '[{\"name\":\"Ch\\u1ea5t li\\u1ec7u c\\u00e1n\",\"value\":\"C\\u00e1n m\\u1edd\"},{\"name\":\"S\\u1ed1 m\\u1eb7t c\\u00e1n\",\"value\":\"1\"},{\"name\":\"M\\u00e1y c\\u00e1n\",\"value\":\"M\\u00c1Y C\\u00c1N NHI\\u1ec6T\"}]', NULL, 'nilon', 'semi_auto', NULL, 'not_accepted', NULL, 1, NULL, '2023-10-04 07:03:15', '2023-10-04 07:03:15', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (11, 'Tests 4-10 Hộp cứng  ( TỜ BỒI KHAY ĐỊNH HÌNH )', 'DH-000018AB', 36, 'papers', 74, '10300', '1', NULL, NULL, '[{\"name\":\"Ch\\u1ea5t li\\u1ec7u c\\u00e1n\",\"value\":\"C\\u00e1n m\\u1edd\"},{\"name\":\"S\\u1ed1 m\\u1eb7t c\\u00e1n\",\"value\":\"1\"},{\"name\":\"M\\u00e1y c\\u00e1n\",\"value\":\"M\\u00c1Y C\\u00c1N NHI\\u1ec6T\"}]', NULL, 'nilon', 'semi_auto', NULL, 'not_accepted', NULL, 1, NULL, '2023-10-04 07:03:59', '2023-10-04 07:03:59', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (12, '2024 Hộp Qùa Tết Mã TD-C01C 29 x 36 x 10cm + Túi', 'DH-000019AA', 54, 'papers', 99, '5000', '1', '15', '24000', '[{\"name\":\"ki\\u1ec3u in\",\"value\":\"In 1 m\\u1eb7t\"},{\"name\":\"m\\u00e0u in\",\"value\":4},{\"name\":\"C\\u00f4ng ngh\\u1ec7 in\",\"value\":\"In offset\"}]', '171000', 'print', '1', 10, 'submited', NULL, 1, '2023-10-07 08:35:25', '2023-10-07 08:31:11', '2023-10-07 08:35:25', 6, NULL, NULL);
INSERT INTO `w_salaries` VALUES (13, '2024 Hộp Qùa Tết Mã TD-C01B 36 x 36 x 10cm + Túi ( TỜ BỒI ĐÁY HỘP )', 'DH-000019AB', 54, 'papers', 100, '10050', '1', '15', '24000', '[{\"name\":\"ki\\u1ec3u in\",\"value\":\"In 1 m\\u1eb7t\"},{\"name\":\"m\\u00e0u in\",\"value\":4},{\"name\":\"C\\u00f4ng ngh\\u1ec7 in\",\"value\":\"In offset\"}]', '246750', 'print', '1', 10, 'submited', NULL, 1, '2023-10-07 08:36:07', '2023-10-07 08:31:11', '2023-10-07 08:36:07', 6, NULL, NULL);
INSERT INTO `w_salaries` VALUES (14, '2024 Hộp Qùa Tết Mã TD-C01B 36 x 36 x 10cm + Túi ( TÚI GIẤY )', 'DH-000019AC', 54, 'papers', 101, '10050', '1', '30', '40000', '[{\"name\":\"ki\\u1ec3u in\",\"value\":\"In 1 m\\u1eb7t\"},{\"name\":\"m\\u00e0u in\",\"value\":4},{\"name\":\"C\\u00f4ng ngh\\u1ec7 in\",\"value\":\"In offset\"}]', '461500', 'print', '1', 10, 'submited', NULL, 1, '2023-10-07 08:36:33', '2023-10-07 08:31:11', '2023-10-07 08:36:33', 6, NULL, NULL);
INSERT INTO `w_salaries` VALUES (21, '2024 Hộp Qùa Tết Mã TD-C01C 29 x 36 x 10cm + Túi', 'DH-000019AA', 54, 'papers', 99, '5000', '1', '40', '25000', '[{\"name\":\"Ch\\u1ea5t li\\u1ec7u c\\u00e1n\",\"value\":\"C\\u00e1n m\\u1edd\"},{\"name\":\"S\\u1ed1 m\\u1eb7t c\\u00e1n\",\"value\":\"1\"},{\"name\":\"M\\u00e1y c\\u00e1n\",\"value\":\"M\\u00c1Y C\\u00c1N NHI\\u1ec6T\"}]', '225000', 'nilon', 'semi_auto', 13, 'submited', NULL, 1, '2023-10-07 08:37:59', '2023-10-07 08:35:25', '2023-10-07 08:37:59', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (22, NULL, 'DH-000019AA', 54, 'papers', 99, '5050', NULL, '15', '24000', '[{\"name\":\"ki\\u1ec3u in\",\"value\":\"In 1 m\\u1eb7t\"},{\"name\":\"m\\u00e0u in\",\"value\":4},{\"name\":\"C\\u00f4ng ngh\\u1ec7 in\",\"value\":\"In offset\"}]', '171750', 'print', '1', 10, 'submited', NULL, 1, '2023-10-07 08:38:15', '2023-10-07 08:35:25', '2023-10-07 08:38:15', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (23, '2024 Hộp Qùa Tết Mã TD-C01B 36 x 36 x 10cm + Túi ( TỜ BỒI ĐÁY HỘP )', 'DH-000019AB', 54, 'papers', 100, '10050', '1', '40', '25000', '[{\"name\":\"Ch\\u1ea5t li\\u1ec7u c\\u00e1n\",\"value\":\"C\\u00e1n m\\u1edd\"},{\"name\":\"S\\u1ed1 m\\u1eb7t c\\u00e1n\",\"value\":\"1\"},{\"name\":\"M\\u00e1y c\\u00e1n\",\"value\":\"M\\u00c1Y C\\u00c1N NHI\\u1ec6T\"}]', '427000', 'nilon', 'semi_auto', 13, 'submited', NULL, 1, '2023-10-07 08:39:33', '2023-10-07 08:36:08', '2023-10-07 08:39:33', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (24, '2024 Hộp Qùa Tết Mã TD-C01B 36 x 36 x 10cm + Túi ( TÚI GIẤY )', 'DH-000019AC', 54, 'papers', 101, '10050', '1', '40', '25000', '[{\"name\":\"Ch\\u1ea5t li\\u1ec7u c\\u00e1n\",\"value\":\"C\\u00e1n m\\u1edd\"},{\"name\":\"S\\u1ed1 m\\u1eb7t c\\u00e1n\",\"value\":\"1\"},{\"name\":\"M\\u00e1y c\\u00e1n\",\"value\":\"M\\u00c1Y C\\u00c1N NHI\\u1ec6T\"}]', '427000', 'nilon', 'semi_auto', 13, 'submited', NULL, 1, '2023-10-07 08:41:13', '2023-10-07 08:36:33', '2023-10-07 08:41:13', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (25, '2024 Hộp Qùa Tết Mã TD-C01C 29 x 36 x 10cm + Túi', 'DH-000019AA', 54, 'papers', 99, '5000', '1', '25', '50000', '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"T\\u1ef0 \\u0110\\u1ed8NG\"}]', '175000', 'compress', 'auto', 41, 'submited', NULL, 1, '2023-10-07 08:39:23', '2023-10-07 08:37:59', '2023-10-07 08:39:23', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (26, '2024 Hộp Qùa Tết Mã TD-C01C 29 x 36 x 10cm + Túi', 'DH-000019AA', 54, 'papers', 99, '5050', '1', '40', '25000', '[{\"name\":\"Ch\\u1ea5t li\\u1ec7u c\\u00e1n\",\"value\":\"C\\u00e1n m\\u1edd\"},{\"name\":\"S\\u1ed1 m\\u1eb7t c\\u00e1n\",\"value\":\"1\"},{\"name\":\"M\\u00e1y c\\u00e1n\",\"value\":\"M\\u00c1Y C\\u00c1N NHI\\u1ec6T\"}]', '227000', 'nilon', 'semi_auto', 13, 'submited', NULL, 1, '2023-10-07 08:41:29', '2023-10-07 08:38:15', '2023-10-07 08:41:29', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (27, '2024 Hộp Qùa Tết Mã TD-C01C 29 x 36 x 10cm + Túi', 'DH-000019AA', 54, 'papers', 99, '4000', '1', '50', '50000', '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"B\\u00c1N T\\u1ef0 \\u0110\\u1ed8NG\"}]', '250000', 'elevate', 'semi_auto', 33, 'submited', NULL, 1, '2023-10-07 09:06:31', '2023-10-07 08:39:23', '2023-10-07 09:06:31', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (28, '2024 Hộp Qùa Tết Mã TD-C01B 36 x 36 x 10cm + Túi ( TỜ BỒI ĐÁY HỘP )', 'DH-000019AB', 54, 'papers', 100, '10050', '1', '50', '50000', '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"B\\u00c1N T\\u1ef0 \\u0110\\u1ed8NG\"}]', '552500', 'elevate', 'semi_auto', 24, 'submited', NULL, 1, '2023-10-07 09:08:38', '2023-10-07 08:39:33', '2023-10-07 09:08:38', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (29, '2024 Hộp Qùa Tết Mã TD-C01B 36 x 36 x 10cm + Túi ( TÚI GIẤY )', 'DH-000019AC', 54, 'papers', 101, '10050', '1', '50', '50000', '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"B\\u00c1N T\\u1ef0 \\u0110\\u1ed8NG\"}]', '552500', 'elevate', 'semi_auto', 24, 'submited', NULL, 1, '2023-10-07 09:13:22', '2023-10-07 08:41:13', '2023-10-07 09:13:22', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (30, '2024 Hộp Qùa Tết Mã TD-C01C 29 x 36 x 10cm + Túi', 'DH-000019AA', 54, 'papers', 99, '5050', '1', '25', '50000', '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"T\\u1ef0 \\u0110\\u1ed8NG\"}]', '176250', 'compress', 'auto', 41, 'submited', NULL, 1, '2023-10-07 08:42:03', '2023-10-07 08:41:29', '2023-10-07 08:42:03', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (31, '2024 Hộp Qùa Tết Mã TD-C01A 36 x 42 x 10cm   Túi', 'DH-000021AA', 52, 'papers', 93, '10050', '1', '15', '24000', '[{\"name\":\"ki\\u1ec3u in\",\"value\":\"In 1 m\\u1eb7t\"},{\"name\":\"m\\u00e0u in\",\"value\":4},{\"name\":\"C\\u00f4ng ngh\\u1ec7 in\",\"value\":\"In offset\"}]', '246750', 'print', '1', 10, 'submited', NULL, 1, '2023-10-07 08:46:15', '2023-10-07 08:44:12', '2023-10-07 08:46:15', 6, NULL, NULL);
INSERT INTO `w_salaries` VALUES (32, '2024 Hộp Qùa Tết Mã TD-C01A 36 x 42 x 10cm + Túi ( TỜ BỒI ĐÁY HỘP )', 'DH-000021AB', 52, 'papers', 94, '10050', '1', '15', '24000', '[{\"name\":\"ki\\u1ec3u in\",\"value\":\"In 1 m\\u1eb7t\"},{\"name\":\"m\\u00e0u in\",\"value\":4},{\"name\":\"C\\u00f4ng ngh\\u1ec7 in\",\"value\":\"In offset\"}]', '246750', 'print', '1', 10, 'submited', NULL, 1, '2023-10-07 08:46:41', '2023-10-07 08:44:12', '2023-10-07 08:46:41', 6, NULL, NULL);
INSERT INTO `w_salaries` VALUES (33, '2024 Hộp Qùa Tết Mã TD-C01A 36 x 42 x 10cm + Túi ( TÚI GIẤY )', 'DH-000021AC', 52, 'papers', 95, '10050', '1', '30', '40000', '[{\"name\":\"ki\\u1ec3u in\",\"value\":\"In 1 m\\u1eb7t\"},{\"name\":\"m\\u00e0u in\",\"value\":4},{\"name\":\"C\\u00f4ng ngh\\u1ec7 in\",\"value\":\"In offset\"}]', '461500', 'print', '1', 10, 'submited', NULL, 1, '2023-10-07 08:45:51', '2023-10-07 08:44:12', '2023-10-07 08:45:51', 6, NULL, NULL);
INSERT INTO `w_salaries` VALUES (40, '2024 Hộp Qùa Tết Mã TD-C01A 36 x 42 x 10cm + Túi ( TÚI GIẤY )', 'DH-000021AC', 52, 'papers', 95, '10050', '1', '40', '25000', '[{\"name\":\"Ch\\u1ea5t li\\u1ec7u c\\u00e1n\",\"value\":\"C\\u00e1n m\\u1edd\"},{\"name\":\"S\\u1ed1 m\\u1eb7t c\\u00e1n\",\"value\":\"1\"},{\"name\":\"M\\u00e1y c\\u00e1n\",\"value\":\"M\\u00c1Y C\\u00c1N NHI\\u1ec6T\"}]', '427000', 'nilon', 'semi_auto', 13, 'submited', NULL, 1, '2023-10-07 08:47:11', '2023-10-07 08:45:51', '2023-10-07 08:47:11', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (41, '2024 Hộp Qùa Tết Mã TD-C01A 36 x 42 x 10cm   Túi', 'DH-000021AA', 52, 'papers', 93, '10050', '1', '40', '25000', '[{\"name\":\"Ch\\u1ea5t li\\u1ec7u c\\u00e1n\",\"value\":\"C\\u00e1n m\\u1edd\"},{\"name\":\"S\\u1ed1 m\\u1eb7t c\\u00e1n\",\"value\":\"1\"},{\"name\":\"M\\u00e1y c\\u00e1n\",\"value\":\"M\\u00c1Y C\\u00c1N NHI\\u1ec6T\"}]', '427000', 'nilon', 'semi_auto', 13, 'submited', NULL, 1, '2023-10-07 08:47:31', '2023-10-07 08:46:15', '2023-10-07 08:47:31', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (42, '2024 Hộp Qùa Tết Mã TD-C01A 36 x 42 x 10cm + Túi ( TỜ BỒI ĐÁY HỘP )', 'DH-000021AB', 52, 'papers', 94, '10050', '1', '40', '25000', '[{\"name\":\"Ch\\u1ea5t li\\u1ec7u c\\u00e1n\",\"value\":\"C\\u00e1n m\\u1edd\"},{\"name\":\"S\\u1ed1 m\\u1eb7t c\\u00e1n\",\"value\":\"1\"},{\"name\":\"M\\u00e1y c\\u00e1n\",\"value\":\"M\\u00c1Y C\\u00c1N NHI\\u1ec6T\"}]', '427000', 'nilon', 'semi_auto', 13, 'submited', NULL, 1, '2023-10-07 08:47:52', '2023-10-07 08:46:41', '2023-10-07 08:47:52', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (43, '2024 Hộp Qùa Tết Mã TD-C01A 36 x 42 x 10cm + Túi ( TÚI GIẤY )', 'DH-000021AC', 52, 'papers', 95, '10050', '1', '50', '50000', '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"B\\u00c1N T\\u1ef0 \\u0110\\u1ed8NG\"}]', '552500', 'elevate', 'semi_auto', 24, 'submited', NULL, 1, '2023-10-07 09:13:29', '2023-10-07 08:47:11', '2023-10-07 09:13:29', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (44, '2024 Hộp Qùa Tết Mã TD-C01A 36 x 42 x 10cm   Túi', 'DH-000021AA', 52, 'papers', 93, '10050', '1', '25', '50000', '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"T\\u1ef0 \\u0110\\u1ed8NG\"}]', '301250', 'compress', 'auto', 16, 'submited', NULL, 1, '2023-10-07 08:48:02', '2023-10-07 08:47:31', '2023-10-07 08:48:02', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (45, '2024 Hộp Qùa Tết Mã TD-C01A 36 x 42 x 10cm + Túi ( TỜ BỒI ĐÁY HỘP )', 'DH-000021AB', 52, 'papers', 94, '10050', '1', '50', '50000', '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"B\\u00c1N T\\u1ef0 \\u0110\\u1ed8NG\"}]', '552500', 'elevate', 'semi_auto', 24, 'submited', NULL, 1, '2023-10-07 09:13:37', '2023-10-07 08:47:52', '2023-10-07 09:13:37', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (46, '2024 Hộp Qùa Tết Mã TD-C01A 36 x 42 x 10cm   Túi', 'DH-000021AA', 52, 'papers', 93, '10050', '1', '50', '50000', '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"B\\u00c1N T\\u1ef0 \\u0110\\u1ed8NG\"}]', '552500', 'elevate', 'semi_auto', 24, 'submited', NULL, 1, '2023-10-07 09:13:42', '2023-10-07 08:48:02', '2023-10-07 09:13:42', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (47, '2024 Hộp Qùa Tết Mã TD-C01C 29 x 36 x 10cm + Túi', 'DH-000019AA', 54, 'papers', 99, '10050', '1', '5', '0', '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"B\\u00d3C L\\u1ec0\"}]', '50250', 'peel', 'semi_auto', 23, 'submited', NULL, 1, '2023-10-07 09:17:35', '2023-10-07 09:06:31', '2023-10-07 09:17:35', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (48, NULL, 'DH-000019AA', 54, 'papers', 99, '6050', '1', '50', '50000', '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"B\\u00c1N T\\u1ef0 \\u0110\\u1ed8NG\"}]', '352500', 'elevate', 'semi_auto', 24, 'submited', NULL, 1, '2023-10-07 09:13:50', '2023-10-07 09:06:31', '2023-10-07 09:13:50', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (49, '2024 Hộp Qùa Tết Mã TD-C01B 36 x 36 x 10cm + Túi ( TỜ BỒI ĐÁY HỘP )', 'DH-000019AB', 54, 'papers', 100, '10050', '1', '5', '0', '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"B\\u00d3C L\\u1ec0\"}]', '50250', 'peel', 'semi_auto', 23, 'submited', NULL, 1, '2023-10-07 09:19:23', '2023-10-07 09:08:38', '2023-10-07 09:19:23', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (51, '2024 Hộp Qùa Tết Mã TD-C01A 36 x 42 x 10cm + Túi ( TÚI GIẤY )', 'DH-000021AC', 52, 'papers', 95, '10050', '1', '5', '0', '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"B\\u00d3C L\\u1ec0\"}]', '50250', 'peel', 'semi_auto', 23, 'submited', NULL, 1, '2023-10-07 09:19:50', '2023-10-07 09:13:29', '2023-10-07 09:19:50', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (52, '2024 Hộp Qùa Tết Mã TD-C01A 36 x 42 x 10cm + Túi ( TỜ BỒI ĐÁY HỘP )', 'DH-000021AB', 52, 'papers', 94, '10050', '1', '5', '0', '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"B\\u00d3C L\\u1ec0\"}]', '50250', 'peel', 'semi_auto', 23, 'submited', NULL, 1, '2023-10-07 09:20:01', '2023-10-07 09:13:37', '2023-10-07 09:20:01', NULL, NULL, NULL);
INSERT INTO `w_salaries` VALUES (53, '2024 Hộp Qùa Tết Mã TD-C01A 36 x 42 x 10cm   Túi', 'DH-000021AA', 52, 'papers', 93, '10050', '1', '5', '0', '[{\"name\":\"Thi\\u1ebft b\\u1ecb m\\u00e1y\",\"value\":\"B\\u00d3C L\\u1ec0\"}]', '50250', 'peel', 'semi_auto', 45, 'submited', NULL, 1, '2023-10-07 09:21:08', '2023-10-07 09:13:42', '2023-10-07 09:21:08', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for w_users
-- ----------------------------
DROP TABLE IF EXISTS `w_users`;
CREATE TABLE `w_users`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `device` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 67 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of w_users
-- ----------------------------
INSERT INTO `w_users` VALUES (10, 'mayin1-52', 'e10adc3949ba59abbe56e057f20f883e', 'Mr Quý - Đích', '0963303999', 'print', '1', NULL, 1, '2023-07-27 23:54:44', '2023-10-01 13:50:35', 1);
INSERT INTO `w_users` VALUES (13, 'maycan1', 'e10adc3949ba59abbe56e057f20f883e', 'Ms Bình - Ms Thanh', '0963303999', 'nilon', 'semi_auto', NULL, 1, '2023-09-10 21:08:12', '2023-10-01 14:28:16', 1);
INSERT INTO `w_users` VALUES (15, 'maycantrangkim', 'e10adc3949ba59abbe56e057f20f883e', 'THUÊ NGOÀI', '11', 'metalai', 'semi_auto', NULL, 1, '2023-09-11 11:19:44', '2023-10-01 14:13:15', 1);
INSERT INTO `w_users` VALUES (16, 'epnhutd1', 'e10adc3949ba59abbe56e057f20f883e', 'Mr Thắng', '11', 'compress', 'auto', NULL, 1, '2023-09-11 23:38:00', '2023-10-01 14:24:23', 1);
INSERT INTO `w_users` VALUES (18, 'inuvtd', 'e10adc3949ba59abbe56e057f20f883e', 'Mr Thành', '11', 'uv', 'auto', NULL, 0, '2023-09-11 23:56:24', '2023-10-01 14:26:49', 1);
INSERT INTO `w_users` VALUES (19, 'maybetd', 'e10adc3949ba59abbe56e057f20f883e', 'Mr An', '11', 'elevate', 'auto', NULL, 0, '2023-09-12 00:02:39', '2023-10-01 14:31:51', 1);
INSERT INTO `w_users` VALUES (20, 'floatbtd', 'e10adc3949ba59abbe56e057f20f883e', 'Cong nhan thuc noi ban td', '11', 'float', 'semi_auto', NULL, 1, '2023-09-12 10:33:53', '2023-09-12 10:33:53', 1);
INSERT INTO `w_users` VALUES (21, 'maythucnoi', 'e10adc3949ba59abbe56e057f20f883e', 'Mr Thành', '11', 'float', 'auto', NULL, 1, '2023-09-12 10:34:44', '2023-09-12 22:14:25', 1);
INSERT INTO `w_users` VALUES (22, 'bocletd', 'e10adc3949ba59abbe56e057f20f883e', 'Ms Lan', '11', 'peel', 'auto', NULL, 1, '2023-09-12 10:38:04', '2023-09-15 01:02:41', 1);
INSERT INTO `w_users` VALUES (23, 'bocle1', 'e10adc3949ba59abbe56e057f20f883e', 'Ms Lan', '111', 'peel', 'semi_auto', NULL, 1, '2023-09-12 10:39:39', '2023-10-01 15:06:48', 1);
INSERT INTO `w_users` VALUES (24, 'maybe1', 'e10adc3949ba59abbe56e057f20f883e', 'Mr Tuấn Anh - Mr Mạnh', '111', 'elevate', 'semi_auto', NULL, 1, '2023-09-12 15:56:23', '2023-10-01 14:50:55', 1);
INSERT INTO `w_users` VALUES (25, 'maycan', 'e10adc3949ba59abbe56e057f20f883e', 'Thu', '123', 'nilon', 'auto', NULL, 0, '2023-09-12 21:14:18', '2023-10-01 13:58:16', 1);
INSERT INTO `w_users` VALUES (26, 'inluoiuv', 'e10adc3949ba59abbe56e057f20f883e', 'Mr Thành', '123', 'uv', 'semi_auto', NULL, 1, '2023-09-12 21:49:07', '2023-10-01 14:31:05', 1);
INSERT INTO `w_users` VALUES (27, 'mayran1', 'e10adc3949ba59abbe56e057f20f883e', 'Ms Lan', '123', 'box_paste', 'auto', NULL, 1, '2023-09-14 22:02:45', '2023-10-01 15:35:32', 1);
INSERT INTO `w_users` VALUES (28, 'rantui1', 'e10adc3949ba59abbe56e057f20f883e', 'Ms HẰNG', '123', 'bag_paste', 'semi_auto', NULL, 1, '2023-09-14 22:03:58', '2023-10-05 11:21:13', 1);
INSERT INTO `w_users` VALUES (29, 'mayxen1', 'e10adc3949ba59abbe56e057f20f883e', 'Mr Thành', '123456', 'cut', 'semi_auto', NULL, 1, '2023-09-14 22:05:27', '2023-10-05 11:26:42', 1);
INSERT INTO `w_users` VALUES (30, 'maygap', 'e10adc3949ba59abbe56e057f20f883e', 'Ms Kiều', '12', 'fold', 'auto', NULL, 1, '2023-09-14 22:06:28', '2023-09-14 22:06:28', 1);
INSERT INTO `w_users` VALUES (31, 'boihop1', 'e10adc3949ba59abbe56e057f20f883e', 'Ms NGA', '123', 'fill', 'semi_auto', NULL, 1, '2023-09-14 22:07:32', '2023-10-05 16:04:16', 1);
INSERT INTO `w_users` VALUES (32, 'hoanthien1', 'e10adc3949ba59abbe56e057f20f883e', 'Ms', '123', 'finish', 'semi_auto', NULL, 1, '2023-09-14 22:09:17', '2023-10-05 16:16:36', 1);
INSERT INTO `w_users` VALUES (33, 'maybe2', 'e10adc3949ba59abbe56e057f20f883e', 'Mr Đức - Mr Đại', '222', 'elevate', 'semi_auto', NULL, 1, '2023-09-15 00:49:13', '2023-10-01 14:51:04', 1);
INSERT INTO `w_users` VALUES (34, 'mayphay1', 'e10adc3949ba59abbe56e057f20f883e', 'Mr ĐẠI', '123', 'mill', 'auto', NULL, 1, '2023-09-15 01:45:12', '2023-10-05 11:34:49', 1);
INSERT INTO `w_users` VALUES (35, 'boitd', 'e10adc3949ba59abbe56e057f20f883e', 'Boi Td', '11', 'fill', 'auto', NULL, 1, '2023-09-15 23:12:08', '2023-09-15 23:12:08', 1);
INSERT INTO `w_users` VALUES (36, 'mayin1-102', 'e10adc3949ba59abbe56e057f20f883e', 'Mr Quý - Hồng', '0963303999', 'print', '1', NULL, 1, '2023-10-01 13:51:47', '2023-10-01 13:51:47', 1);
INSERT INTO `w_users` VALUES (37, 'mayinuv1-52', 'e10adc3949ba59abbe56e057f20f883e', 'Mr Quý - Đích', '0963303999', 'print', '2', NULL, 1, '2023-10-01 13:54:44', '2023-10-01 13:54:56', 1);
INSERT INTO `w_users` VALUES (38, 'mayinuv1-102', 'e10adc3949ba59abbe56e057f20f883e', 'Mr Quý - Hồng', '0963303999', 'print', '2', NULL, 1, '2023-10-01 13:55:21', '2023-10-01 13:55:21', 1);
INSERT INTO `w_users` VALUES (39, 'maycan2', 'e10adc3949ba59abbe56e057f20f883e', 'Ms Yến - Ms Hiền', '0963303999', 'nilon', 'semi_auto', NULL, 1, '2023-10-01 14:11:20', '2023-10-01 14:28:10', 1);
INSERT INTO `w_users` VALUES (40, 'epnhubtd1', 'e10adc3949ba59abbe56e057f20f883e', 'Ca1: Ms Bình', '11', 'compress', 'semi_auto', NULL, 1, '2023-10-01 14:18:08', '2023-10-01 14:26:18', 1);
INSERT INTO `w_users` VALUES (41, 'epnhutd2', 'e10adc3949ba59abbe56e057f20f883e', 'Ms Hạnh', '11', 'compress', 'auto', NULL, 1, '2023-10-01 14:24:43', '2023-10-01 14:24:43', 1);
INSERT INTO `w_users` VALUES (42, 'maybe3', 'e10adc3949ba59abbe56e057f20f883e', 'Mr Thành - Mr Hiệp', '333', 'elevate', 'semi_auto', NULL, 1, '2023-10-01 14:39:08', '2023-10-01 14:51:25', 1);
INSERT INTO `w_users` VALUES (43, 'maybe4', 'e10adc3949ba59abbe56e057f20f883e', 'Ms Thảo - Ms', '444', 'elevate', 'semi_auto', NULL, 1, '2023-10-01 14:40:05', '2023-10-01 14:51:56', 1);
INSERT INTO `w_users` VALUES (44, 'maybe5', 'e10adc3949ba59abbe56e057f20f883e', 'Mr An', '555', 'elevate', 'semi_auto', NULL, 1, '2023-10-01 14:40:50', '2023-10-01 14:52:08', 1);
INSERT INTO `w_users` VALUES (45, 'bocle2', 'e10adc3949ba59abbe56e057f20f883e', 'Ms Thương', '222', 'peel', 'semi_auto', NULL, 1, '2023-10-01 15:07:23', '2023-10-01 15:07:23', 1);
INSERT INTO `w_users` VALUES (46, 'bocle3', 'e10adc3949ba59abbe56e057f20f883e', 'Ms Loan', '333', 'peel', 'semi_auto', NULL, 1, '2023-10-01 15:07:44', '2023-10-01 15:14:26', 1);
INSERT INTO `w_users` VALUES (47, 'bocle4', 'e10adc3949ba59abbe56e057f20f883e', 'Ms', '444', 'peel', 'semi_auto', NULL, 0, '2023-10-01 15:09:08', '2023-10-01 15:09:35', 1);
INSERT INTO `w_users` VALUES (48, 'bocle5', 'e10adc3949ba59abbe56e057f20f883e', 'Ms', '555', 'peel', 'semi_auto', NULL, 0, '2023-10-01 15:09:22', '2023-10-01 15:09:42', 1);
INSERT INTO `w_users` VALUES (49, 'mayran2', 'e10adc3949ba59abbe56e057f20f883e', 'Ms Lan', '123', 'box_paste', 'auto', NULL, 0, '2023-10-01 15:36:00', '2023-10-01 15:36:00', 1);
INSERT INTO `w_users` VALUES (50, 'rantui2', 'e10adc3949ba59abbe56e057f20f883e', 'Ms HẰNG', '123', 'bag_paste', 'semi_auto', NULL, 1, '2023-10-05 11:21:00', '2023-10-05 11:21:00', 1);
INSERT INTO `w_users` VALUES (51, 'hogiadinh1', 'e10adc3949ba59abbe56e057f20f883e', 'Ms HẰNG', '123', 'bag_paste', 'semi_auto', NULL, 1, '2023-10-05 11:21:40', '2023-10-05 11:21:40', 1);
INSERT INTO `w_users` VALUES (52, 'hogiadinh2', 'e10adc3949ba59abbe56e057f20f883e', 'Ms HẰNG', '123', 'bag_paste', 'semi_auto', NULL, 1, '2023-10-05 11:22:01', '2023-10-05 11:22:01', 1);
INSERT INTO `w_users` VALUES (53, 'hogiadinh3', 'e10adc3949ba59abbe56e057f20f883e', 'Ms HẰNG', '123', 'bag_paste', 'semi_auto', NULL, 1, '2023-10-05 11:22:11', '2023-10-05 11:22:11', 1);
INSERT INTO `w_users` VALUES (55, 'mayxen2', 'e10adc3949ba59abbe56e057f20f883e', 'Mr Thành', '123456', 'cut', 'semi_auto', NULL, 1, '2023-10-05 11:26:53', '2023-10-05 11:26:53', 1);
INSERT INTO `w_users` VALUES (56, 'mayphay2', 'e10adc3949ba59abbe56e057f20f883e', 'Mr ĐẠI', '123', 'mill', 'auto', NULL, 1, '2023-10-05 11:35:00', '2023-10-05 11:35:00', 1);
INSERT INTO `w_users` VALUES (57, 'boihop2', 'e10adc3949ba59abbe56e057f20f883e', 'Ms HƯƠNG', '123', 'fill', 'semi_auto', NULL, 1, '2023-10-05 16:02:13', '2023-10-05 16:04:27', 1);
INSERT INTO `w_users` VALUES (58, 'boihop3', 'e10adc3949ba59abbe56e057f20f883e', 'Ms HÀ', '123', 'fill', 'semi_auto', NULL, 1, '2023-10-05 16:02:22', '2023-10-05 16:04:45', 1);
INSERT INTO `w_users` VALUES (59, 'boihop4', 'e10adc3949ba59abbe56e057f20f883e', 'Ms', '123', 'fill', 'semi_auto', NULL, 1, '2023-10-05 16:02:34', '2023-10-05 16:12:16', 1);
INSERT INTO `w_users` VALUES (60, 'boihop5', 'e10adc3949ba59abbe56e057f20f883e', 'Ms THƠM', '123', 'fill', 'semi_auto', NULL, 1, '2023-10-05 16:02:45', '2023-10-05 16:04:55', 1);
INSERT INTO `w_users` VALUES (61, 'boihop6', 'e10adc3949ba59abbe56e057f20f883e', 'Ms', '123', 'fill', 'semi_auto', NULL, 1, '2023-10-05 16:03:03', '2023-10-05 16:06:16', 1);
INSERT INTO `w_users` VALUES (62, 'boihop7', 'e10adc3949ba59abbe56e057f20f883e', 'Ms', '123', 'fill', 'semi_auto', NULL, 1, '2023-10-05 16:03:22', '2023-10-05 16:06:11', 1);
INSERT INTO `w_users` VALUES (63, 'boihop8', 'e10adc3949ba59abbe56e057f20f883e', 'Ms', '123', 'fill', 'semi_auto', NULL, 1, '2023-10-05 16:03:32', '2023-10-05 16:06:04', 1);
INSERT INTO `w_users` VALUES (64, 'hoanthien2', 'e10adc3949ba59abbe56e057f20f883e', 'Ms', '123', 'finish', 'semi_auto', NULL, 1, '2023-10-05 16:14:03', '2023-10-05 16:15:44', 1);
INSERT INTO `w_users` VALUES (65, 'hoanthien3', 'e10adc3949ba59abbe56e057f20f883e', 'Ms', '123', 'finish', 'semi_auto', NULL, 1, '2023-10-05 16:14:31', '2023-10-05 16:15:56', 1);
INSERT INTO `w_users` VALUES (66, 'hoanthien4', 'e10adc3949ba59abbe56e057f20f883e', 'Ms', '123', 'finish', 'semi_auto', NULL, 1, '2023-10-05 16:15:21', '2023-10-05 16:16:05', 1);

-- ----------------------------
-- Table structure for warehouse_histories
-- ----------------------------
DROP TABLE IF EXISTS `warehouse_histories`;
CREATE TABLE `warehouse_histories`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `action` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `table` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `target` int(10) NULL DEFAULT NULL,
  `qty` bigint(20) NULL DEFAULT NULL,
  `provider` int(10) NULL DEFAULT NULL,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  `bill` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `old_qty` bigint(20) NULL DEFAULT NULL,
  `new_qty` bigint(20) NULL DEFAULT NULL,
  `act` tinyint(4) NULL DEFAULT NULL,
  `product` int(10) NULL DEFAULT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of warehouse_histories
-- ----------------------------
INSERT INTO `warehouse_histories` VALUES (2, 'take_out', 'square_warehouses', NULL, 2, 50500, NULL, NULL, NULL, 100000, 49500, NULL, 13, 7, '2023-09-29 13:58:40', '2023-09-29 07:02:27');
INSERT INTO `warehouse_histories` VALUES (3, 'take_out', 'square_warehouses', NULL, 1, 10857, NULL, NULL, NULL, 50000, 39143, NULL, 9, 7, '2023-09-29 14:11:58', NULL);
INSERT INTO `warehouse_histories` VALUES (5, 'insert', 'square_warehouses', 'nilon', 4, 20000, 50, 56000.00, '{\"path\":\"uploads/files/log[bill]/7_1.jpg\",\"name\":\"7_1\"}', 0, 20000, NULL, NULL, 7, '2023-09-29 15:37:23', NULL);
INSERT INTO `warehouse_histories` VALUES (7, 'insert', 'print_warehouses', 'paper', 70, 100000, 50, 16.50, '{\"id\":\"68\",\"dir\":\"uploads/files/log[bill]\",\"path\":\"uploads/files/log[bill]/z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_2.jpg\",\"name\":\"z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_2\"}', 0, 100000, NULL, NULL, 1, '2023-10-01 11:22:57', NULL);
INSERT INTO `warehouse_histories` VALUES (8, 'insert', 'print_warehouses', 'paper', 71, 100000, 50, 16.50, '{\"id\":\"69\",\"dir\":\"uploads/files/log[bill]\",\"path\":\"uploads/files/log[bill]/z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_3.jpg\",\"name\":\"z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_3\"}', 0, 100000, NULL, NULL, 1, '2023-10-01 11:23:43', NULL);
INSERT INTO `warehouse_histories` VALUES (9, 'insert', 'print_warehouses', 'paper', 72, 60000, 50, 16.50, '{\"id\":\"70\",\"dir\":\"uploads/files/log[bill]\",\"path\":\"uploads/files/log[bill]/z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_4.jpg\",\"name\":\"z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_4\"}', 0, 60000, NULL, NULL, 1, '2023-10-01 11:24:42', NULL);
INSERT INTO `warehouse_histories` VALUES (10, 'insert', 'print_warehouses', 'paper', 73, 87020, 50, 18.00, '{\"id\":\"71\",\"dir\":\"uploads/files/log[bill]\",\"path\":\"uploads/files/log[bill]/z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_5.jpg\",\"name\":\"z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_5\"}', 0, 87020, NULL, NULL, 1, '2023-10-01 12:17:28', NULL);
INSERT INTO `warehouse_histories` VALUES (11, 'insert', 'print_warehouses', 'paper', 74, 87020, 50, 18.00, '{\"id\":\"72\",\"dir\":\"uploads/files/log[bill]\",\"path\":\"uploads/files/log[bill]/z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_6.jpg\",\"name\":\"z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_6\"}', 0, 87020, NULL, NULL, 1, '2023-10-01 12:18:21', NULL);
INSERT INTO `warehouse_histories` VALUES (12, 'insert', 'print_warehouses', 'paper', 75, 74300, 50, 18.00, '{\"id\":\"73\",\"dir\":\"uploads/files/log[bill]\",\"path\":\"uploads/files/log[bill]/z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_7.jpg\",\"name\":\"z4733599205103_b3f925dda987872bbe9dd21e2f8f924e_7\"}', 0, 74300, NULL, NULL, 1, '2023-10-01 12:19:43', NULL);
INSERT INTO `warehouse_histories` VALUES (13, 'update', 'print_warehouses', 'paper', 72, 13200, 50, 16500.00, '{\"id\":\"89\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/z4740902657631_c709f1fad82bab43b1410bc080d11b3e309\",\"name\":\"z4740902657631_c709f1fad82bab43b1410bc080d11b3e309\"}', 60000, 73200, NULL, NULL, 7, '2023-10-06 09:01:44', NULL);
INSERT INTO `warehouse_histories` VALUES (14, 'update', 'print_warehouses', 'paper', 72, 46800, 50, 16500.00, '{\"id\":\"90\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/z4754814908091_e354e8304c3fa35b01885cc2ce469068.3.10\",\"name\":\"z4754814908091_e354e8304c3fa35b01885cc2ce469068.3.10\"}', 73200, 120000, NULL, NULL, 7, '2023-10-06 09:03:17', NULL);
INSERT INTO `warehouse_histories` VALUES (15, 'update', 'print_warehouses', 'paper', 71, 3600, 50, 16500.00, '{\"id\":\"91\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/z4754814908091_e354e8304c3fa35b01885cc2ce469068.3.10(1)\",\"name\":\"z4754814908091_e354e8304c3fa35b01885cc2ce469068.3.10(1)\"}', 100000, 103600, NULL, NULL, 7, '2023-10-06 09:04:59', NULL);
INSERT INTO `warehouse_histories` VALUES (16, 'update', 'print_warehouses', 'paper', 71, 27160, 50, 16500.00, '{\"id\":\"92\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/z4757664944281_8905b34b8c31e8fed9a5094c1605ba3c.6.10\",\"name\":\"z4757664944281_8905b34b8c31e8fed9a5094c1605ba3c.6.10\"}', 103600, 130760, NULL, NULL, 7, '2023-10-06 09:06:34', NULL);
INSERT INTO `warehouse_histories` VALUES (17, 'update', 'print_warehouses', 'paper', 70, 20000, 50, 16500.00, '{\"id\":\"93\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/z4757706903407_2b6e350b72256de66a8dd153f82eaf83.9.9\",\"name\":\"z4757706903407_2b6e350b72256de66a8dd153f82eaf83.9.9\"}', 100000, 120000, NULL, NULL, 7, '2023-10-06 09:18:42', NULL);
INSERT INTO `warehouse_histories` VALUES (19, 'insert', 'print_warehouses', 'paper', 77, 50000, 50, 18500.00, '{\"id\":\"95\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/z4757664944281_8905b34b8c31e8fed9a5094c1605ba3c.6.10(2)\",\"name\":\"z4757664944281_8905b34b8c31e8fed9a5094c1605ba3c.6.10(2)\"}', 0, 50000, NULL, NULL, 7, '2023-10-06 09:30:05', NULL);
INSERT INTO `warehouse_histories` VALUES (20, 'insert', 'square_warehouses', 'nilon', 5, 530000, 54, 73000.00, '{\"id\":\"110\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/z4760701989751_6f54d1003e109c981cf6a00cea345769mang505\",\"name\":\"z4760701989751_6f54d1003e109c981cf6a00cea345769mang505\"}', 0, 530000, NULL, NULL, 7, '2023-10-07 08:29:35', NULL);
INSERT INTO `warehouse_histories` VALUES (21, 'insert', 'square_warehouses', 'nilon', 6, 530000, 54, 73000.00, '{\"id\":\"111\",\"dir\":\"storages/uploads\",\"path\":\"storage/app/public/uploads/z4760701989751_6f54d1003e109c981cf6a00cea345769mang505(1)\",\"name\":\"z4760701989751_6f54d1003e109c981cf6a00cea345769mang505(1)\"}', 0, 530000, NULL, NULL, 7, '2023-10-07 08:49:10', NULL);

-- ----------------------------
-- Table structure for warehouse_providers
-- ----------------------------
DROP TABLE IF EXISTS `warehouse_providers`;
CREATE TABLE `warehouse_providers`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã nhóm',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Tên nhóm',
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Cha',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Ghi chú',
  `act` tinyint(4) NULL DEFAULT NULL,
  `ord` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name_index`(`name`) USING BTREE,
  INDEX `type_index`(`type`) USING BTREE,
  INDEX `act_indx`(`act`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 55 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of warehouse_providers
-- ----------------------------
INSERT INTO `warehouse_providers` VALUES (49, 'GIẤY ANH ĐẠT', NULL, NULL, 1, NULL, '2023-09-25 20:55:27', '2023-09-29 15:49:01', 10);
INSERT INTO `warehouse_providers` VALUES (50, 'GIẤY VẠN PHÚ GIA', NULL, NULL, 1, NULL, '2023-09-25 20:55:48', '2023-09-29 15:49:15', 10);
INSERT INTO `warehouse_providers` VALUES (51, 'GIẤY NGỌC VIỆT', NULL, NULL, 1, NULL, '2023-09-25 20:55:57', '2023-09-29 15:49:26', 10);
INSERT INTO `warehouse_providers` VALUES (52, 'CAO SU NON ĐẠI THÀNH', NULL, NULL, 1, NULL, '2023-09-29 15:50:29', '2023-09-29 15:50:29', 1);
INSERT INTO `warehouse_providers` VALUES (53, 'VŨ GIA', NULL, NULL, 1, NULL, '2023-09-29 15:50:41', '2023-09-29 15:50:41', 1);
INSERT INTO `warehouse_providers` VALUES (54, 'PHƯƠNG ANH', NULL, NULL, 1, NULL, '2023-09-29 15:51:00', '2023-09-29 15:51:00', 1);

SET FOREIGN_KEY_CHECKS = 1;
