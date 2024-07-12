/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : td_company

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 13/07/2024 02:05:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for n_tables
-- ----------------------------
DROP TABLE IF EXISTS `n_tables`;
CREATE TABLE `n_tables`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `admin_paginate` int NULL DEFAULT NULL,
  `view_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `search_view` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ext_action` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `insert` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `update` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `remove` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `copy` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `import` tinyint NULL DEFAULT NULL,
  `export` tinyint NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `indx`(`id` ASC, `name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of n_tables
-- ----------------------------
INSERT INTO `n_tables` VALUES (1, 'n_users', 'Nhân viên', NULL, 10, 'view', NULL, NULL, '1', '1', '1', '1', NULL, NULL, '2023-05-23 14:43:41', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (2, 'n_group_users', 'Nhóm quyền', NULL, 10, 'view', NULL, NULL, '1', '1', '1', '1', NULL, NULL, '2023-04-23 11:30:46', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (3, 'n_roles', 'Phân quyền', NULL, 10, 'view', '', NULL, '1', '1', '1', '1', NULL, NULL, '2023-04-23 11:30:46', '2024-04-26 05:36:37');
INSERT INTO `n_tables` VALUES (4, 'files', 'Kho Lưu trữ', NULL, 24, 'media', NULL, NULL, '1', '1', '1', '1', NULL, NULL, '2023-04-23 11:30:46', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (5, 'quote_configs', 'Thông tin chung & Giá thành', NULL, 100, 'config', NULL, NULL, '1', '1', '1', '1', NULL, NULL, '2023-05-09 16:15:02', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (6, 'customers', 'Khách hàng', NULL, 10, 'view', NULL, NULL, '1', '1', '1', '1', NULL, NULL, '2023-04-23 11:30:46', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (7, 'quotes', 'Báo giá', NULL, 10, 'view', NULL, '[\n	{\n		\"icon\":\"plus\",\n		\"note\":\"Thêm đơn hàng\", \n		\"link\":\"insert/orders?quote=\",\n		\"condition\":[\n			{\"key\":\"status\", \"value\":\"accepted\"}\n		]\n	},\n	{\n		\"icon\":\"check\",\n		\"note\":\"Khách đã chốt giá\", \n		\"link\":\"apply-quote/\",\n		\"condition\":[\n			{\"key\":\"status\", \"value\":\"not_accepted\"}\n		]\n	},\n	{\n		\"icon\":\"info\",\n		\"note\":\"File báo giá\", \n		\"link\":\"quote-file-export/\"\n	}\n]', '1', '1', '1', '1', NULL, NULL, '2023-05-19 14:09:25', '2024-02-29 14:23:47');
INSERT INTO `n_tables` VALUES (8, 'q_papers', 'Tờ in', NULL, 10, 'view', NULL, NULL, '1', '1', '1', '1', NULL, NULL, '2023-04-23 11:30:46', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (9, 'devices', 'Thiết bị & Chi phí', '{\r\n	\"link\":\"config-device-price/supply_types?type=devices\", \r\n	\"note\":\"Danh sách thiết bị máy theo vật tư\"\r\n}', 10, 'view', NULL, NULL, '1', '1', '1', '1', NULL, NULL, '2023-04-23 11:30:46', '2023-08-30 04:55:37');
INSERT INTO `n_tables` VALUES (10, 'materals', 'Chất liệu vật tư', NULL, 10, 'view', NULL, NULL, '1', '1', '1', '1', NULL, NULL, '2023-04-28 10:32:23', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (11, 'printers', 'Máy in & chi phí', NULL, 10, 'view', NULL, NULL, '1', '1', '1', '1', NULL, NULL, '2023-04-28 00:18:55', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (13, 'supply_types', 'Vật tư tham gia sx', NULL, 10, 'view', NULL, '[\r\n	{\r\n	\"icon\":\"list-ul\",\r\n	\"note\":\"Đơn giá định lượng\", \r\n	\"link\":\"view/supply_prices?default_data=%7B%22supply_id%22%3A%22<id>%22%7D\",\r\n	\"condition\":[\r\n			{\"key\":\"is_name\", \"value\":\"0\"}\r\n		]\r\n	}\r\n]', '1', '1', '1', '1', NULL, NULL, '2023-07-17 19:30:41', '2024-04-15 05:52:58');
INSERT INTO `n_tables` VALUES (14, 'supply_prices', 'Đơn giá vật tư', NULL, 20, 'view', NULL, NULL, '1', '1', '1', '1', NULL, NULL, '2023-04-28 10:33:01', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (18, 'orders', 'Đơn hàng', NULL, 20, 'view', NULL, '[\r\n	{\r\n	\"icon\":\"list-ul\",\r\n	\"note\":\"DS sản phẩm\", \r\n	\"link\":\"view/products?default_data=%7B%22order%22%3A%22<id>%22%7D\"\r\n	}\r\n]', '0', '1', '1', '1', NULL, NULL, '2023-06-21 13:22:33', '2024-04-15 05:55:32');
INSERT INTO `n_tables` VALUES (19, 'p_substances', 'Chất liệu giấy in', NULL, 20, 'view', NULL, NULL, '1', '1', '1', '1', NULL, NULL, '2023-04-23 11:30:46', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (20, 'product_categories', 'Nhóm sản phẩm', '', 20, 'view', NULL, '[\r\n	{\r\n	\"icon\":\"list-ul\",\r\n	\"note\":\"Kiểu hộp\", \r\n	\"link\":\"view/product_styles?default_data=%7B%22category%22%3A%22<id>%22%7D\"\r\n	}\r\n]', '0', '1', '0', '0', NULL, NULL, '2023-04-23 11:30:46', '2024-04-15 05:56:48');
INSERT INTO `n_tables` VALUES (21, 'products', 'Sản xuất sản phẩm', NULL, 20, 'view', NULL, '[\n	{\n		\"icon\":\"print\",\n		\"note\":\"In lệnh\",\n		\"link\":\"print-data/products/<id>\",\n		\"blank\":1\n	},\n	{\n		\"type\":2,\n		\"icon\":\"spinner\",\n		\"note\":\"Vật tư sản xuất\", \n		\"class\":\"__product_list_supp_process\"\n	},\n	{\n		\"type\":2,\n		\"icon\":\"calendar-check-o\",\n		\"note\":\"Yêu cầu nhập kho\",\n		\"class\":\"__product_takein_req\",\n		\"condition\":[\n			{\"key\":\"status\", \"value\":\"submited\"}\n		]\n	},\n	{\n		\"icon\":\"recycle\",\n		\"note\":\"Yêu cầu sản xuất lại\",\n		\"link\":\"product-require-rework/<id>\",\n		\"condition\":[\n			{\"key\":\"status\", \"value\":\"need_rework\"}\n		]\n	}\n]', '0', '1', '1', '1', NULL, NULL, '2023-04-23 11:30:46', '2024-05-24 10:13:46');
INSERT INTO `n_tables` VALUES (22, 'c_designs', 'Lệnh thiết kế', NULL, 20, 'view', NULL, '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"level-down\",\"note\":\"Nhận lệnh\", \r\n		\"class\":\"__receive_command\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"not_accepted\"}\r\n		]\r\n	}\r\n]', '0', '1', '1', '0', NULL, NULL, '2023-06-30 17:43:12', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (23, 'c_supplies', 'Yêu cầu Xuất vật tư', NULL, 20, 'view', NULL, '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"share\",\"note\":\"Xác nhận xuất vật tư\", \r\n		\"class\":\"__confirm_ex_supp\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"handling\"}\r\n		]\r\n	}\r\n]', '0', '0', '1', '0', NULL, NULL, '2023-07-14 03:17:55', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (24, 'n_log_actions', 'Lịch sử thao tác', NULL, 10, 'history', NULL, NULL, '', '', '1', '', NULL, NULL, '2023-05-23 14:43:41', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (25, 'w_users', 'Công nhân', '{\r\n	\"link\":\"list-worker-by-device/machine\", \r\n	\"note\":\"DS tổ máy\"\r\n}', 10, 'view', NULL, '', '1', '1', '1', '1', NULL, NULL, '2023-05-23 14:43:41', '2023-09-11 11:17:39');
INSERT INTO `n_tables` VALUES (26, 'paper_extends', 'Tên phụ giấy in', NULL, 10, 'view', NULL, '', '1', '1', '1', '1', NULL, NULL, '2023-07-17 19:30:41', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (27, 'supply_warehouses', 'Kho vật tư (carton, cao su, mút xốp, mica,...)', '{\r\n	\"link\":\"warehouse-management\", \r\n	\"note\":\"Quản lí kho vật tư\"\r\n}', 10, 'view', NULL, '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"undo\",\"note\":\"Xác nhận nhập kho vật tư\", \r\n		\"class\":\"__confirm_im_supp\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"waiting\"}\r\n		]\r\n	}\r\n]', '1', '1', '1', '1', 1, 1, '2023-07-14 03:17:55', '2024-07-12 18:24:25');
INSERT INTO `n_tables` VALUES (28, 'print_warehouses', 'Kho vật tư (giấy in)', '{\r\n	\"link\":\"warehouse-management\", \r\n	\"note\":\"Quản lí kho vật tư\"\r\n}', 10, 'ingredients.print_warehouses.view', 'ingredients.print_warehouses.form_search', '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"undo\",\"note\":\"Xác nhận nhập kho vật tư\", \r\n		\"class\":\"__confirm_im_supp\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"waiting\"}\r\n		]\r\n	}\r\n]', '1', '1', '1', '1', 0, 1, '2023-07-14 03:17:55', '2024-07-10 00:02:02');
INSERT INTO `n_tables` VALUES (29, 'other_warehouses', 'Kho vật tư (nam châm)', '{\r\n	\"link\":\"warehouse-management\", \r\n	\"note\":\"Quản lí kho vật tư\"\r\n}', 10, 'view', NULL, '', '1', '1', '1', '1', NULL, NULL, '2023-07-14 03:17:55', '2023-09-11 11:17:42');
INSERT INTO `n_tables` VALUES (30, 'square_warehouses', 'Kho vật tư (vật tư màng, nhung, vải lụa)', '{\r\n	\"link\":\"warehouse-management\", \r\n	\"note\":\"Quản lí kho vật tư\"\r\n}', 10, 'view', NULL, '', '1', '1', '1', '1', 1, 1, '2023-07-14 03:17:55', '2024-07-12 18:23:43');
INSERT INTO `n_tables` VALUES (32, 'w_salaries', 'Bảng lương chấm công - công nhân', '', 10, 'view', NULL, '', '0', '0', '1', '0', NULL, 1, '2023-07-14 03:17:55', '2024-06-20 17:49:17');
INSERT INTO `n_tables` VALUES (33, 'supply_names', 'Tên phụ vật tư', NULL, 10, 'view', NULL, '', '1', '1', '1', '1', NULL, NULL, '2023-07-17 19:30:41', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (34, 'papers', 'Vật tư giấy', NULL, 20, 'view', NULL, '', '0', '1', '0', '0', NULL, NULL, '2023-06-21 13:22:33', '2023-12-25 20:49:44');
INSERT INTO `n_tables` VALUES (35, 'supplies', 'Vật tư hộp cứng', NULL, 20, 'view', NULL, '', '0', '1', '0', '0', NULL, NULL, '2023-06-21 13:22:33', '2023-12-25 20:49:41');
INSERT INTO `n_tables` VALUES (36, 'fill_finishes', 'Bồi & hoàn thiện', NULL, 20, 'view', NULL, '', '0', '1', '0', '0', NULL, NULL, '2023-06-21 13:22:33', '2023-12-25 20:49:40');
INSERT INTO `n_tables` VALUES (37, 'product_styles', 'Kiểu hộp', '{\r\n	\"link\":\"view/product_categories\", \r\n	\"note\":\"Nhóm sản phẩm\"\r\n}', 20, 'view', NULL, '', '1', '1', '1', '1', NULL, NULL, '2023-06-21 13:22:33', '2023-09-20 15:05:49');
INSERT INTO `n_tables` VALUES (38, 'warehouse_providers', 'Nhà cung cấp vật tư', NULL, 10, 'view', NULL, '', '1', '1', '1', '1', NULL, NULL, '2023-07-17 19:30:41', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (39, 'supply_buyings', 'Yêu cầu mua vật tư', NULL, 10, 'view', NULL, '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"check-circle-o\",\r\n		\"note\":\"Duyệt mua vật tư\", \r\n		\"class\":\"__confirm_buying\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"not_accepted\"}\r\n		]\r\n	},\r\n	{\r\n		\"type\":2,\r\n		\"detailonly\":1,\r\n		\"icon\":\"check-square-o\",\"note\":\"Xác nhận đã mua\", \r\n		\"class\":\"__confirm_bought\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"accepted\"}\r\n		]\r\n	},\r\n	{\r\n		\"type\":2,\r\n		\"detailonly\":1,\r\n		\"icon\":\"check-square\",\"note\":\"Xác nhận nhập kho\", \r\n		\"class\":\"__confirm_warehouse_imported\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"bought\"}\r\n		]\r\n	}\r\n]', '1', '1', '1', '1', NULL, NULL, '2023-07-17 19:30:41', '2023-11-17 00:17:48');
INSERT INTO `n_tables` VALUES (40, 'c_expertises', 'Yêu cầu nhập kho thành phẩm', NULL, 10, 'view', NULL, '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"share\",\r\n		\"note\":\"Duyệt nhập kho sản phẩm\", \r\n		\"class\":\"__confirm_product_warehouse\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"not_accepted\"}\r\n		]\r\n	}\r\n]', '0', '0', '1', '0', NULL, NULL, '2023-07-17 19:30:41', '2024-01-03 06:55:06');
INSERT INTO `n_tables` VALUES (41, 'product_warehouses', 'Kho thành phẩm', NULL, 20, 'view', NULL, '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"history\",\r\n		\"note\":\"Lịch sử xuất nhập\", \r\n		\"class\":\"__product_warehouse_history\"\r\n	}\r\n]', '0', '1', '0', '1', NULL, NULL, '2023-04-23 11:30:46', '2024-01-03 23:20:48');
INSERT INTO `n_tables` VALUES (42, 'partners', 'Đối tác sản xuất', NULL, 10, 'view', NULL, NULL, '1', '1', '1', '1', NULL, NULL, '2023-04-23 11:30:46', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (43, 'after_prints', 'KCS sau in', NULL, 10, 'view', NULL, '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"check-square-o\",\r\n		\"note\":\"Duyệt chấm công cho công nhân\", \r\n		\"class\":\"__confirm_worker_salary\",\r\n		\"datas\":[\"qty\", \"name\"],\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"processing\"}\r\n		]\r\n	}\r\n]', '0', '0', '1', '0', NULL, NULL, '2023-07-17 19:30:41', '2024-03-26 23:24:47');
INSERT INTO `n_tables` VALUES (44, 'c_reworks', 'Yêu cầu sản xuất lại', NULL, 10, 'view', '', '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"check-square-o\",\r\n		\"note\":\"Khởi tạo lại đơn\", \r\n		\"class\":\"__confirm_rework\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"not_accepted\"}\r\n		]\r\n	},\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"circle-thin\",\r\n		\"note\":\"Không cần thiết sản xuất lại\", \r\n		\"class\":\"__not_need_rework\",\r\n		\"datas\":[\"name\", \"qty\"],\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"not_accepted\"}\r\n		]\r\n	}\r\n]', '0', '0', '1', '0', NULL, NULL, '2023-07-17 19:30:41', '2024-04-25 14:53:53');
INSERT INTO `n_tables` VALUES (45, 'warehouse_histories', 'Nguyên vật liệu (Xuất, nhập, tồn)', '', 10, 'view', NULL, '', '0', '0', '1', '0', NULL, NULL, '2023-07-14 03:17:55', '2023-08-16 19:43:11');
INSERT INTO `n_tables` VALUES (46, 'represents', 'Người liên hệ', NULL, 10, 'view', NULL, NULL, '1', '1', '1', '1', NULL, NULL, '2023-04-23 11:30:46', '2024-06-17 12:06:36');
INSERT INTO `n_tables` VALUES (47, 'extend_warehouses', 'Vật tư khác', '{\r\n	\"link\":\"warehouse-management\", \r\n	\"note\":\"Quản lí kho vật tư\"\r\n}', 10, 'view', NULL, '', '1', '1', '1', '1', 1, 1, '2023-07-14 03:17:55', '2024-07-10 00:01:58');
INSERT INTO `n_tables` VALUES (48, 'supply_extends', 'Các loại vật tư khác', '', 10, 'view', NULL, '', '1', '1', '1', '1', 0, 1, '2023-07-14 03:17:55', '2024-07-11 22:15:43');

SET FOREIGN_KEY_CHECKS = 1;
