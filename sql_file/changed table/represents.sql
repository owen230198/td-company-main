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

 Date: 17/06/2024 00:21:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for represents
-- ----------------------------
DROP TABLE IF EXISTS `represents`;
CREATE TABLE `represents`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `telephone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `customer` int(0) NULL DEFAULT NULL,
  `sale` json NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` int(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name_index`(`name`) USING BTREE,
  INDEX `infor_index`(`email`, `phone`) USING BTREE,
  INDEX `idx_sale`() USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of represents
-- ----------------------------
INSERT INTO `represents` VALUES (1, 'Ms Thảo', '0325544040', '0325544040', 'zalo', 1, '[1]', NULL, 1, '2023-09-23 11:10:31', '2024-05-19 18:24:48', 1);
INSERT INTO `represents` VALUES (2, 'Ms Thảo', '0325544040', '0325544040', 'zalo', 1, '[1]', NULL, 1, '2023-09-23 11:10:31', '2024-05-19 18:24:48', 1);
INSERT INTO `represents` VALUES (3, 'Ms Hằng', '0979359387', '0979359387', 'zalo', 3, '[1]', NULL, 1, '2023-09-23 13:39:43', '2024-05-19 18:24:48', 1);
INSERT INTO `represents` VALUES (4, 'Phương', '0977070289', '0977070289', 'Phuongn@vietbrandco.vn', 4, '[1]', NULL, 1, '2023-09-23 13:42:14', '2024-05-19 18:24:48', 1);
INSERT INTO `represents` VALUES (5, 'Ms Hải', '0917129458', '0917129458', 'zalo', 5, '[1]', NULL, 1, '2023-09-23 14:16:26', '2024-05-19 18:24:48', 1);
INSERT INTO `represents` VALUES (6, 'Mr Dũng', '0912188628', '0912188628', 'zalo', 6, '[1]', NULL, 1, '2023-09-23 14:18:56', '2024-05-19 18:24:48', 1);
INSERT INTO `represents` VALUES (7, 'Mr Hải', '0914755299', '0914755299', 'zalo', 7, '[1]', NULL, 1, '2023-09-23 14:22:24', '2024-05-19 18:24:48', 1);
INSERT INTO `represents` VALUES (8, 'Mr Phúc', '0358866868', '0358866868', 'zalo', 8, '[1]', NULL, 1, '2023-09-23 14:32:18', '2024-05-19 18:24:49', 1);
INSERT INTO `represents` VALUES (9, 'Mr Tuấn', '0963303999', '02438303888', 'kd1.intuandung@gmail.com', 9, '[1]', NULL, 1, '2023-09-23 14:34:33', '2024-05-19 18:24:49', 1);
INSERT INTO `represents` VALUES (10, 'Ms Dịu', '0983 580 635', '0983 580 635', 'chưa có', 10, '[10]', NULL, 1, '2023-09-26 14:37:54', '2024-05-19 18:24:49', 10);
INSERT INTO `represents` VALUES (11, 'Anh Cương', '0988373219', '0988373219', 'zalo', 11, '[10]', 'TP Ninh bình 0988373219', 1, '2023-09-26 16:14:25', '2024-05-19 18:24:49', 10);
INSERT INTO `represents` VALUES (12, 'Mr Hải', '0968 754 654', '0968 754 654', 'duocphamhadiphaco@gmail.com', 12, '[10]', NULL, 1, '2023-09-26 16:51:54', '2024-05-19 18:24:49', 10);
INSERT INTO `represents` VALUES (13, 'Mr Hải', '0968754654', '0968754654', 'zalo', 13, '[10]', NULL, 1, '2023-09-26 16:59:34', '2024-05-19 18:24:49', 10);
INSERT INTO `represents` VALUES (14, 'Mr Tú', '0966969622', '0966969622', 'zalo', 14, '[10]', NULL, 1, '2023-09-28 10:01:06', '2024-05-19 18:24:49', 10);
INSERT INTO `represents` VALUES (15, 'Mr Dự', '0982123263', '0982123263', 'globalpharma88@gmail.com', 15, '[10]', NULL, 1, '2023-09-28 11:16:29', '2024-05-19 18:24:49', 10);
INSERT INTO `represents` VALUES (16, 'Mr Cường', '0987608052', '0987608052', 'zalo', 16, '[10]', NULL, 1, '2023-09-28 11:32:08', '2024-05-19 18:24:49', 10);
INSERT INTO `represents` VALUES (17, 'Chị Phương', '0908737986', '0908737986', 'mainguyendv@gmail.com', 17, '[10]', NULL, 1, '2023-09-30 14:11:20', '2024-05-19 18:24:49', 10);
INSERT INTO `represents` VALUES (18, 'Lê Bắc', '0373375882', '0373375882', 'zalo', 18, '[10]', NULL, 1, '2023-10-09 14:57:14', '2024-05-19 18:24:49', 10);
INSERT INTO `represents` VALUES (19, 'Mr Đức', '0382700882', '0382700882', 'zalo', 21, '[1]', NULL, 1, '2023-11-02 08:41:33', '2024-05-19 18:24:49', 1);
INSERT INTO `represents` VALUES (20, 'A Đông', '0989310396', '0989310396', 'zalo', 22, '[10]', NULL, 1, '2024-02-29 10:10:42', '2024-02-29 10:10:42', 10);
INSERT INTO `represents` VALUES (21, 'Ms Giang', '0346946032', '0346946032', 'zalo', 23, '[1]', 'Giao hàng hỏi giang', 1, '2024-02-29 15:03:21', '2024-02-29 15:03:21', 1);
INSERT INTO `represents` VALUES (22, 'Chi Chanh', '0976582885', '0976582885', 'zalo', 24, '[1]', NULL, 1, '2024-03-18 10:23:20', '2024-03-18 10:23:20', 1);
INSERT INTO `represents` VALUES (23, 'Chi Chanh', '0976582885', '0976582885', 'zalo', 25, '[1]', NULL, 1, '2024-03-21 11:56:40', '2024-03-21 11:56:40', 1);
INSERT INTO `represents` VALUES (24, 'Mr Ngọc', '0816.279.777', '0816.279.777', 'zalo', 26, '[1]', NULL, 1, '2024-04-01 14:45:03', '2024-04-01 14:45:03', 1);
INSERT INTO `represents` VALUES (25, 'Mr Phú', '0943549019', '0943549019', 'LUANHAXA.VN@GMAIL.COM', 27, '[1]', NULL, 1, '2024-04-08 06:47:34', '2024-04-08 06:47:34', 1);
INSERT INTO `represents` VALUES (26, 'Miss Thúy', '0966085620', '0966085620', 'zalo', 28, '[10]', NULL, 1, '2024-04-10 10:57:11', '2024-04-10 10:57:11', 10);
INSERT INTO `represents` VALUES (27, 'Ms Thu', '0982841999', '0982841999', 'buithudl@gmail.com', 29, '[1]', NULL, 1, '2024-04-11 16:33:08', '2024-04-11 16:33:08', 1);
INSERT INTO `represents` VALUES (28, 'Ms Phương', '0974105232', '0974105232', 'pmp28.jsc@gmail.com', 30, '[1]', NULL, 1, '2024-04-12 14:05:05', '2024-04-12 14:05:05', 1);
INSERT INTO `represents` VALUES (29, 'Mr Chính', '0977641981', '0977641981', 'ZALO', 31, '[1]', NULL, 1, '2024-04-23 16:28:43', '2024-04-23 16:28:43', 1);
INSERT INTO `represents` VALUES (30, 'A Thọ', '0988328388', '0988328388', 'dinhthotb@gmail.com', 32, '[10]', NULL, 1, '2024-04-24 06:08:25', '2024-05-19 18:24:49', 10);
INSERT INTO `represents` VALUES (31, 'Chị Huyền', '0915 178 788', '0915 178 788', 'huyenus@gmail.com', 33, '[10]', NULL, 1, '2024-04-24 06:33:27', '2024-05-19 18:24:49', 10);
INSERT INTO `represents` VALUES (32, 'Anh Thái', '0396327952 (Mr Thái)', '036 2331985 (Ms Lệ)', 'zalo', 36, '[10]', NULL, 1, '2024-04-25 09:05:55', '2024-05-19 18:24:49', 10);
INSERT INTO `represents` VALUES (33, 'Anh Hoành', '0813902225', '0813902225', 'zalo', 38, '[10]', NULL, 1, '2024-05-06 11:42:13', '2024-05-19 18:24:49', 10);
INSERT INTO `represents` VALUES (34, 'C Loan', '0905064579', '0905064579', 'zalo', 39, '[10]', NULL, 1, '2024-05-06 12:59:33', '2024-05-19 18:24:49', 10);
INSERT INTO `represents` VALUES (35, 'A Quý', '‭0918870111', '‭0918870111', 'zalo', 40, '[10]', NULL, 1, '2024-05-06 13:21:25', '2024-05-19 18:24:50', 10);
INSERT INTO `represents` VALUES (36, 'A Mạnh', '0964137393', '0964137393', 'zalo', 41, '[10]', NULL, 1, '2024-05-13 11:44:28', '2024-05-19 18:24:50', 10);
INSERT INTO `represents` VALUES (37, 'Chị Giang', '0986970999', '0986970999', 'zalo', 42, '[10]', NULL, 1, '2024-05-19 10:31:19', '2024-05-19 18:24:50', 10);
INSERT INTO `represents` VALUES (38, 'Chị Huế', '0397869354 (Ms Huế)', '0969651339', 'zalo', 43, '[10]', NULL, 1, '2024-05-19 11:19:06', '2024-05-21 14:03:41', 10);
INSERT INTO `represents` VALUES (39, 'Anh Nam', '0966242160', '0966242160', 'zalo', 44, '[10]', NULL, 1, '2024-05-20 11:00:47', '2024-05-20 11:00:47', 10);
INSERT INTO `represents` VALUES (40, 'Chị Trang', '0918.921.368', '0918.921.368', 'zalo', 45, '[10]', NULL, 1, '2024-05-20 11:12:53', '2024-05-20 11:12:53', 10);
INSERT INTO `represents` VALUES (41, 'Ms Hạnh', 'chưa có c', 'chưa có', 'zalo', 46, '[10]', NULL, 1, '2024-05-21 13:39:42', '2024-05-21 13:39:42', 10);
INSERT INTO `represents` VALUES (42, 'Mr Duy', '0898223372', '0898223372', 'zalo', 47, '[1]', NULL, 1, '2024-05-22 07:20:48', '2024-05-22 07:20:48', 1);
INSERT INTO `represents` VALUES (43, 'A Hòa', '0918210284', 'zalo', 'duchoaicic@gmail.com', 48, '[10]', NULL, 1, '2024-05-23 14:11:35', '2024-05-23 14:11:35', 10);
INSERT INTO `represents` VALUES (44, 'Mr Tuấn', '0888358888', '0989366899', 'zalo', 49, '[1]', NULL, 1, '2024-05-29 17:02:08', '2024-05-29 17:02:54', 1);
INSERT INTO `represents` VALUES (45, 'Mr Lào', '0989062718', '0989062718', 'Zalo', 50, '[1]', NULL, 1, '2024-06-04 16:50:56', '2024-06-04 16:50:56', 1);
INSERT INTO `represents` VALUES (46, 'Ms Linh', '098 7132764', '098 7132764', 'zalo', 51, '[2]', NULL, 1, '2024-06-07 11:53:46', '2024-06-07 11:53:46', 2);
INSERT INTO `represents` VALUES (47, 'Ms Anh Nguyễn', '0918195558', '0918195558', 'zalo', 52, '[27]', NULL, 1, '2024-06-07 14:56:22', '2024-06-07 14:56:22', 27);

SET FOREIGN_KEY_CHECKS = 1;
