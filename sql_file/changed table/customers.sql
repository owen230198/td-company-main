/*
 Navicat Premium Data Transfer

 Source Server         : owen
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : td_company

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 19/06/2024 15:16:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tax_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` int(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name_index`(`name`) USING BTREE,
  INDEX `infor_index`(`address`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 63 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, 'KH-00000001', 'CTY CP THƯƠNG MẠI DƯỢC PHẨM BIGFAM', 'Tòa R2 TTTM Royal City, 72A Nguyễn Trãi - Thanh Xuân - HN', '351', NULL, NULL, '1', 1, '2023-09-23 11:10:31', '2024-05-19 18:24:48', 1);
INSERT INTO `customers` VALUES (3, 'KH-00000003', 'CÔNG TY DỆT MAY THÀNH VƯỢNG', 'Hoa sơn - Ứng hòa - Hà nội', '351', NULL, NULL, '1', 1, '2023-09-23 13:39:43', '2024-05-19 18:24:48', 1);
INSERT INTO `customers` VALUES (4, 'KH-00000004', 'CTY TNHH VIETBRAND', 'Hà Nam', '9047', NULL, NULL, '1', 1, '2023-09-23 13:42:14', '2024-05-19 18:24:48', 1);
INSERT INTO `customers` VALUES (5, 'KH-00000005', 'CTY DƯỢC PHẨM DIAMOND PHÁP', 'KCN Đồng Văn - Hà Nam', '9047', NULL, NULL, '1', 1, '2023-09-23 14:16:26', '2024-05-19 18:24:48', 1);
INSERT INTO `customers` VALUES (6, 'KH-00000006', 'CTY TNHH IN & SẢN XUẤT BAO BÌ NGHỆ AN', 'TP Vinh - Nghệ An', '4230', NULL, NULL, '1', 1, '2023-09-23 14:18:56', '2024-05-19 18:24:48', 1);
INSERT INTO `customers` VALUES (7, 'KH-00000007', 'CÔNG TY CỔ PHẦN DƯỢC PHẨM CENOVA', 'TP Nam Định', '7474', NULL, NULL, '1', 1, '2023-09-23 14:22:24', '2024-05-19 18:24:48', 1);
INSERT INTO `customers` VALUES (8, 'KH-00000008', 'CTY HATACHI', 'Trung Kính - HN', '351', NULL, NULL, '1', 1, '2023-09-23 14:32:18', '2024-05-19 18:24:49', 1);
INSERT INTO `customers` VALUES (9, 'KH-00000009', 'CTY CP IN & SẢN XUẤT BAO BÌ TUẤN DUNG', 'Lô D5-16 Cụm Làng Nghề Triều khúc - Tân Triều - HN', '351', NULL, NULL, '1', 1, '2023-09-23 14:34:33', '2024-05-19 18:24:49', 1);
INSERT INTO `customers` VALUES (10, 'KH-00000010', 'Công ty TNHH phát triển y tế USA', 'NV1 Số 38 Tổng Cục V Tân Triều Thanh Trì TP.Hà Nội', '351', NULL, NULL, '1', 1, '2023-09-26 14:37:54', '2024-05-19 18:24:49', 10);
INSERT INTO `customers` VALUES (11, 'KH-00000011', 'CÔNG TY TNHH ĐẦU TƯ XUẤT NHẬP KHẨU VÀ THƯƠNG MẠI THÀNH ĐỨC', 'Số 3B, Ngách 144/4, Phố Quan Nhân, Phường Nhân Chính, Quận Thanh Xuân, Thành phố Hà Nội', '7474', NULL, 'TP Ninh bình 0988373219', '1', 1, '2023-09-26 16:14:25', '2024-05-19 18:24:49', 10);
INSERT INTO `customers` VALUES (12, 'KH-00000012', 'CÔNG TY DƯỢC PHẨM HADIPHACO', 'Số 65 ngõ 173/192 Lê Trọng Tấn, Định Công, Hoàng Mai, HN', '351', NULL, NULL, '1', 1, '2023-09-26 16:51:54', '2024-05-19 18:24:49', 10);
INSERT INTO `customers` VALUES (13, 'KH-00000013', 'Công ty TNHH dược phẩm Blue pharma', 'Số nhà 22, ngách 50/37 Đường Khuyến Lương, Trần phú', '351', NULL, NULL, '1', 1, '2023-09-26 16:59:34', '2024-05-19 18:24:49', 10);
INSERT INTO `customers` VALUES (14, 'KH-00000014', 'CÔNG TY CP DƯỢC MỸ PHẨM OLYMPUS', 'Ngõ 77 Bùi Xương Trạch - Thanh Xuân - HN', '351', NULL, NULL, '1', 1, '2023-09-28 10:01:06', '2024-05-19 18:24:49', 10);
INSERT INTO `customers` VALUES (15, 'KH-00000015', 'CÔNG TY TNHH ĐẦU TƯ THƯƠNG MẠI THẢO DƯỢC GLOBAL PHARMA', 'Số 63 ngõ 172/92 Lê trọng Tấn, Định Công, Hoàng Mai, HN', '351', NULL, NULL, '1', 1, '2023-09-28 11:16:29', '2024-05-19 18:24:49', 10);
INSERT INTO `customers` VALUES (16, 'KH-00000016', 'CÔNG TY TNHH ECOPHAR VIỆT NAM', 'Số 12, ngõ 4 Đường Đào Nguyên, Châu Quì, Gia Lâm, HN', '351', NULL, NULL, '1', 1, '2023-09-28 11:32:08', '2024-05-19 18:24:49', 10);
INSERT INTO `customers` VALUES (17, 'KH-00000017', 'CÔNG TY TNHH DƯỢC PHẨM MAILISA GROUP', 'Nhà LK2, lô 3, khu đô thị 379, đường Phan Bá Vành', '5922', NULL, NULL, '1', 1, '2023-09-30 14:11:20', '2024-05-19 18:24:49', 10);
INSERT INTO `customers` VALUES (18, 'KH-00000018', 'Công ty cổ phần LáArt', 'Số 66 Nguyễn Thái Học, Ba Đình, Hn', '351', NULL, NULL, '2', 1, '2023-10-09 14:57:14', '2024-05-19 18:24:49', 10);
INSERT INTO `customers` VALUES (21, 'KH-00000021', 'CÔNG TY HNA', '171 Kim Mã - HN', '351', NULL, NULL, '1', 1, '2023-11-02 08:41:33', '2024-05-19 18:24:49', 1);
INSERT INTO `customers` VALUES (22, 'KH-00000022', 'CÔNG TY TNHH DƯỢC PHẨM ĐĂNG NHI (C4805)', 'Tổ 1B Phường Tân Lập, Thành phố Thái Nguyên', '7106', NULL, NULL, '0', 1, '2024-02-29 10:10:42', '2024-02-29 10:10:42', 10);
INSERT INTO `customers` VALUES (23, 'KH-00000023', 'CÔNG TY TNHH TRIBAN VIỆT NAM', 'Thôn Thượng - Phùng xá - Mỹ Đức - Hà nội', '351', NULL, 'Giao hàng hỏi giang', '1', 1, '2024-02-29 15:03:21', '2024-02-29 15:03:21', 1);
INSERT INTO `customers` VALUES (24, 'KH-00000024', 'CÔNG TY CP DƯỢC PHẨM ANZ', 'Xa la - hà động', '351', NULL, NULL, '1', 1, '2024-03-18 10:23:20', '2024-03-18 10:23:20', 1);
INSERT INTO `customers` VALUES (25, 'KH-00000025', 'CÔNG TY CP DƯỢC PHẨM ANZ', 'Xa la - hà động', NULL, NULL, NULL, '0', 1, '2024-03-21 11:56:40', '2024-03-21 11:56:40', 1);
INSERT INTO `customers` VALUES (26, 'KH-00000026', 'CÔNG TY CỔ PHẦN HOÀNG ANH AGRITECH', 'Vĩnh Phúc', '6854', NULL, NULL, '1', 1, '2024-04-01 14:45:03', '2024-04-01 14:45:03', 1);
INSERT INTO `customers` VALUES (27, 'KH-00000027', 'CÔNG TY CỔ PHẦN LỤA NHA XÁ', 'HOÀNG ĐẠO THUÝ', '351', NULL, NULL, '1', 1, '2024-04-08 06:47:34', '2024-04-08 06:47:34', 1);
INSERT INTO `customers` VALUES (28, 'KH-00000028', 'CÔNG TY CP SMILEE VIỆT NAM', 'Kho số 15, ngách 22 ngõ 177 Cầu Diễn, Hà Nội Liên hệ: Anh Nam – 0902.202.126', '351', NULL, NULL, '1', 1, '2024-04-10 10:57:11', '2024-04-10 10:57:11', 10);
INSERT INTO `customers` VALUES (29, 'KH-00000029', 'CTY CP SẢN PHẨM THIÊN NHIÊN TÂM VIỆT', 'số 9 ngách 112/33 Phố Định Công Thượng - Hoàng Mai - HN', '351', NULL, NULL, '1', 1, '2024-04-11 16:33:08', '2024-04-11 16:33:08', 1);
INSERT INTO `customers` VALUES (30, 'KH-00000030', 'CÔNG TY CP SX DƯỢC LIỆU TRUNG ƯƠNG 28', 'Thạch Thất', '351', NULL, NULL, '1', 1, '2024-04-12 14:05:05', '2024-04-12 14:05:05', 1);
INSERT INTO `customers` VALUES (31, 'KH-00000031', 'Cty TNHH TM Dược Phẩm Viễn Dương', '43 Tuệ Tĩnh, phường An Tảo, TP Hưng Yên, tỉnh Hưng Yên.', '5385', NULL, NULL, '1', 1, '2024-04-23 16:28:43', '2024-04-23 16:28:43', 1);
INSERT INTO `customers` VALUES (32, 'KH-00000032', 'CÔNG TY TNHH THƯƠNG MẠI AN KHANG PHARCO', 'Tầng 1 số nhà 211 Trần Thái Tông, Phường Trần Hưng Đạo, Tp Thái Bình', '5922', NULL, NULL, '1', 1, '2024-04-24 06:08:25', '2024-05-19 18:24:49', 10);
INSERT INTO `customers` VALUES (33, 'KH-00000033', 'Công ty TNHH dược phẩm USHT Viêt Nam', 'Số 67, ngõ 126 đường Khuất Duy Tiến, Thanh Xuân, Hà Nội', '351', NULL, NULL, '1', 1, '2024-04-24 06:33:27', '2024-05-19 18:24:49', 10);
INSERT INTO `customers` VALUES (36, 'KH-00000036', 'CÔNG TY TNHH DƯỢC PHẨM TÂM THÁI', 'Xóm An Thái, Xã Hóa Thượng, Thái Nguyên', '7106', NULL, NULL, '1', 1, '2024-04-25 09:05:55', '2024-05-19 18:24:49', 10);
INSERT INTO `customers` VALUES (38, 'KH-00000038', 'CÔNG TY TNHH THẢO DƯỢC HƯNG PHÁT', 'Số nhà 25 ngõ 36 Phương Trạc, Vĩnh Ngọc, Gia Lâm, HN', '351', NULL, NULL, '1', 1, '2024-05-06 11:42:13', '2024-05-19 18:24:49', 10);
INSERT INTO `customers` VALUES (39, 'KH-00000039', 'CÔNG TY CỔ PHẦN ĐẦU TƯ SÂM VIỆT NAM', '184 Trương Hán Siêu, phường Duy Tân, TP Kon Tum', '9731', NULL, NULL, '1', 1, '2024-05-06 12:59:33', '2024-05-19 18:24:49', 10);
INSERT INTO `customers` VALUES (40, 'KH-00000040', 'CÔNG TY CP DƯỢC PHẨM MEDIFA', '149 Phố Trung Kiên - Tây Tựu - Từ Liêm - HN', '351', NULL, NULL, '1', 1, '2024-05-06 13:21:25', '2024-05-19 18:24:50', 10);
INSERT INTO `customers` VALUES (41, 'KH-00000041', 'CÔNG TY TNHH DƯỢC PHẨM TÂN MẠNH PHÁT', 'Số nhà 48 Tổ 9 P Phúc Lợi - Long Biên - HN', '351', NULL, NULL, '1', 1, '2024-05-13 11:44:28', '2024-05-19 18:24:50', 10);
INSERT INTO `customers` VALUES (42, 'KH-00000042', 'SHOP XUÂN GIANG', '812 Lê Thanh Nghị - TP Hải Dương', '4737', NULL, NULL, '1', 1, '2024-05-19 10:31:19', '2024-05-19 18:24:50', 10);
INSERT INTO `customers` VALUES (43, 'KH-00000043', 'Thời trang Đỗ Trịnh Hoài Nam', 'Tầng 2, số 324 Xuân Đỉnh, Bắc Từ Liêm HN', '351', NULL, NULL, '1', 1, '2024-05-19 11:19:06', '2024-05-21 14:03:41', 10);
INSERT INTO `customers` VALUES (44, 'KH00000044', 'CÔNG TY TNHH THẢO DƯỢC SAO BIỂN', 'Thôn Đình Dù, Xã Đình Dù, Văn Lâm, Hưng Yên', '5385', NULL, NULL, '1', 1, '2024-05-20 11:00:47', '2024-05-20 11:00:47', 10);
INSERT INTO `customers` VALUES (45, 'KH00000045', 'Cong ty TNHH Dược Phẩm Sao Mộc', '192 Đức Giang , phường Thượng Thanh , Long Biên, HN', '351', NULL, NULL, '1', 1, '2024-05-20 11:12:53', '2024-05-20 11:12:53', 10);
INSERT INTO `customers` VALUES (46, 'KH-00000046', 'CÔNG TY CP DƯỢC PHẨM TRUNG HƯƠNG HADUPHA', 'KCN 1A Cụm CN Quất Động - Thường Tín', '351', NULL, NULL, '2', 1, '2024-05-21 13:39:42', '2024-05-21 13:39:42', 10);
INSERT INTO `customers` VALUES (47, 'KH-00000047', 'CÔNG TY TNHH NDY GLOBAL', 'Xóm 7, thôn đoan nữa , xã an mỹ, huyện mỹ đức, hà nội', '351', NULL, NULL, '1', 1, '2024-05-22 07:20:48', '2024-05-22 07:20:48', 1);
INSERT INTO `customers` VALUES (48, 'KH-00000048', 'CÔNG TY CỔ PHẦN DƯỢC PHẨM OSHII', 'Thôn 6, Xã Phú Cát, Huyện Quốc Oai, Thành phố Hà Nội, Việt Nam', '351', NULL, NULL, '1', 1, '2024-05-23 14:11:35', '2024-05-23 14:11:35', 10);
INSERT INTO `customers` VALUES (49, 'KH-00000049', 'Công ty TNHH Nam Dược Bảo Tâm An', 'Khu 1 thị trấn thác bà huyện yên bình tỉnh yên bái', '10679', NULL, NULL, '1', 1, '2024-05-29 17:02:08', '2024-05-29 17:02:54', 1);
INSERT INTO `customers` VALUES (50, 'KH-00000050', 'TRUNG TÂM VĂN HÓA HUYỆN ỨNG HÒA', 'Thị Trấn Vân Đình - ứng Hòa - HN', '351', NULL, NULL, '1', 1, '2024-06-04 16:50:56', '2024-06-04 16:50:56', 1);
INSERT INTO `customers` VALUES (51, 'KH-00000051', 'CÔNG TY TNHH DƯỢC HUNMED', 'số 1 liền kề 12, khu đô thị xa la', '351', NULL, NULL, '0', 1, '2024-06-07 11:53:46', '2024-06-07 11:53:46', 2);
INSERT INTO `customers` VALUES (52, 'KH-00000052', 'CTY YẾN SÀO ANH NGUYỄN', '101 Dương Quảng Hàm - Quan Hoa - Cầu giấy', '351', NULL, NULL, '0', 1, '2024-06-07 14:56:22', '2024-06-07 14:56:22', 27);
INSERT INTO `customers` VALUES (54, 'KH-00000054', 'CÔNG TY TNHH SẢN XUẤT VÀ THƯƠNG MẠI DƯỢC PHẨM MIKOPHAR GROUP', 'KĐT An Hưng - Dương Nội', '351', NULL, NULL, '1', 1, '2024-06-12 09:31:02', '2024-06-12 09:31:02', 10);
INSERT INTO `customers` VALUES (55, 'KH-00000055', 'CÔNG TY CỔ PHẦN THƯƠNG MẠI DƯỢC THẢO THIÊN TÂM', 'Ngã Tư Chám , Định Trung, Vĩnh Yên', '6854', NULL, NULL, '1', 1, '2024-06-12 11:17:19', '2024-06-12 11:17:19', 10);
INSERT INTO `customers` VALUES (56, 'KH-00000056', 'CÔNG TY CP DƯỢC PHẨM XANH SK NATURAL', 'Lô CN1D cụm Quất Động mở rộng, Xã Nguyễn Trãi, Thường Tín', '351', NULL, NULL, '2', 1, '2024-06-12 13:37:19', '2024-06-12 13:37:19', 10);
INSERT INTO `customers` VALUES (57, 'KH-00000057', 'CÔNG TY TNHH IN TRUNG KIÊN', 'Lô D5-6 Cụm Làng nghề Triều Khúc - Tân Triều - Thanh Trì -HN', '351', NULL, NULL, '0', 1, '2024-06-13 15:59:58', '2024-06-13 15:59:58', 27);
INSERT INTO `customers` VALUES (58, 'KH-00000058', 'CÔNG TY CỔ PHẦN DƯỢC PHẨM TRUNG ƯƠNG AROVA', 'TECCO, Số 11 - TT06, Khu Đô Thị Mới, Thanh Trì, Hà Nội', '351', NULL, NULL, '0', 1, '2024-06-14 14:01:14', '2024-06-14 14:01:14', 2);
INSERT INTO `customers` VALUES (59, 'KH-00000059', NULL, NULL, '351', NULL, NULL, '0', 1, '2024-06-17 16:24:16', '2024-06-17 16:24:16', 2);
INSERT INTO `customers` VALUES (60, 'KH-00000060', NULL, NULL, '351', NULL, NULL, '0', 1, '2024-06-17 16:29:31', '2024-06-17 16:29:31', 2);
INSERT INTO `customers` VALUES (61, 'KH-00000061', NULL, NULL, '351', NULL, NULL, '0', 1, '2024-06-17 16:30:58', '2024-06-17 16:30:58', 2);
INSERT INTO `customers` VALUES (62, 'KH-00000062', 'Công ty in tại Nghê An', 'Thành phố Vinh', '4230', NULL, NULL, '0', 1, '2024-06-18 17:26:08', '2024-06-18 17:26:08', 2);

SET FOREIGN_KEY_CHECKS = 1;
