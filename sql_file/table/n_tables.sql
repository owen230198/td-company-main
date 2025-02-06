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

 Date: 07/02/2025 00:56:33
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
  `ext_fucn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `insert` tinyint NULL DEFAULT NULL,
  `update` tinyint NULL DEFAULT NULL,
  `remove` tinyint NULL DEFAULT NULL,
  `copy` tinyint NULL DEFAULT NULL,
  `import` tinyint NULL DEFAULT NULL,
  `export` tinyint NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `indx`(`id` ASC, `name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 54 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of n_tables
-- ----------------------------
INSERT INTO `n_tables` VALUES (1, 'n_users', 'Nhân viên', NULL, 10, 'view', NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, '2023-05-23 14:43:41', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (2, 'n_group_users', 'Nhóm quyền', NULL, 10, 'view', NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, '2023-04-23 11:30:46', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (3, 'n_roles', 'Phân quyền', NULL, 10, 'view', '', NULL, NULL, 1, 1, 1, 1, NULL, NULL, '2023-04-23 11:30:46', '2024-04-26 05:36:37');
INSERT INTO `n_tables` VALUES (4, 'files', 'Kho Lưu trữ', NULL, 24, 'media', NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, '2023-04-23 11:30:46', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (5, 'quote_configs', 'Thông tin chung & Giá thành', NULL, 100, 'config', NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, '2023-05-09 16:15:02', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (6, 'customers', 'Khách hàng', NULL, 10, 'view', NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, '2023-04-23 11:30:46', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (7, 'quotes', 'Báo giá', NULL, 10, 'view', NULL, '[\n	{\n		\"icon\":\"plus\",\n		\"note\":\"Thêm đơn hàng\", \n		\"link\":\"insert/orders?quote=\",\n		\"condition\":[\n			{\"key\":\"status\", \"value\":\"accepted\"}\n		]\n	},\n	{\n		\"icon\":\"check\",\n		\"note\":\"Khách đã chốt giá\", \n		\"link\":\"apply-quote/\",\n		\"condition\":[\n			{\"key\":\"status\", \"value\":\"not_accepted\"}\n		]\n	},\n	{\n		\"icon\":\"info\",\n		\"note\":\"File báo giá\", \n		\"link\":\"quote-file-export/\"\n	}\n]', NULL, 1, 1, 1, 2, NULL, NULL, '2023-05-19 14:09:25', '2024-08-29 22:44:48');
INSERT INTO `n_tables` VALUES (8, 'q_papers', 'Tờ in', NULL, 10, 'view', NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, '2023-04-23 11:30:46', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (9, 'devices', 'Thiết bị & Chi phí', '{\r\n	\"link\":\"config-device-price/supply_types?type=devices\", \r\n	\"note\":\"Danh sách thiết bị máy theo vật tư\"\r\n}', 10, 'view', NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, '2023-04-23 11:30:46', '2023-08-30 04:55:37');
INSERT INTO `n_tables` VALUES (10, 'materals', 'Chất liệu vật tư', NULL, 10, 'view', NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, '2023-04-28 10:32:23', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (11, 'printers', 'Máy in & chi phí', NULL, 10, 'view', NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, '2023-04-28 00:18:55', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (13, 'supply_types', 'Vật tư tham gia sx', NULL, 10, 'view', NULL, '[\r\n	{\r\n	\"icon\":\"list-ul\",\r\n	\"note\":\"Đơn giá định lượng\", \r\n	\"link\":\"view/supply_prices?default_data=%7B%22supply_id%22%3A%22<id>%22%7D\"\r\n	}\r\n]', NULL, 1, 1, 1, 1, NULL, NULL, '2023-07-17 19:30:41', '2025-01-21 19:52:29');
INSERT INTO `n_tables` VALUES (14, 'supply_prices', 'Đơn giá vật tư', NULL, 20, 'view', NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, '2023-04-28 10:33:01', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (18, 'orders', 'Đơn hàng', NULL, 20, 'view', NULL, '[\n	{\n	\"type\":2,\n	\"class\":\"load_view_popup\",\n	\"icon\":\"list-ul\",\n	\"note\":\"DS sản phẩm\", \n	\"link\":\"view/products?default_data=%7B%22order%22%3A%22<id>%22%7D&nosidebar=1\"\n	},\n	{\n		\"icon\":\"print\",\n		\"note\":\"In đơn\", \n		\"blank\":1,\n		\"link\":\"print-data/orders/<id>\"\n	}\n]', NULL, 0, 1, 1, 2, 1, 1, '2023-06-21 13:22:33', '2024-12-03 16:11:38');
INSERT INTO `n_tables` VALUES (19, 'base_receipts', 'Phiếu chuyển kho', NULL, 50, 'view', NULL, '[\r\n	{\r\n	\"type\":2,\r\n	\"class\":\"load_view_popup\",\r\n	\"icon\":\"list-ol\",\r\n	\"note\":\"Danh sách sản phẩm\", \r\n	\"link\":\"view/move_warehouses?default_data=%7B%22parent%22%3A%22<id>%22%7D&nosidebar=1\"\r\n	}\r\n]', NULL, 0, 1, 1, 0, NULL, 1, '2023-04-23 11:30:46', '2024-11-04 16:03:36');
INSERT INTO `n_tables` VALUES (20, 'product_categories', 'Nhóm sản phẩm', '', 20, 'view', NULL, '[\r\n	{\r\n	\"icon\":\"list-ul\",\r\n	\"note\":\"Kiểu hộp\", \r\n	\"link\":\"view/product_styles?default_data=%7B%22category%22%3A%22<id>%22%7D\"\r\n	}\r\n]', NULL, 0, 1, 0, 0, NULL, NULL, '2023-04-23 11:30:46', '2024-04-15 05:56:48');
INSERT INTO `n_tables` VALUES (21, 'products', 'Sản xuất sản phẩm', NULL, 20, 'view', NULL, '[\r\n	{\r\n		\"icon\":\"print\",\r\n		\"note\":\"In lệnh\",\r\n		\"link\":\"print-data/products/<id>\",\r\n		\"blank\":1\r\n	},\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"spinner\",\r\n		\"note\":\"Vật tư sản xuất\", \r\n		\"class\":\"__product_list_supp_process\"\r\n	}\r\n]', NULL, 0, 1, 1, 2, NULL, NULL, '2023-04-23 11:30:46', '2024-09-25 23:08:18');
INSERT INTO `n_tables` VALUES (22, 'c_designs', 'Lệnh thiết kế', NULL, 20, 'view', NULL, '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"level-down\",\"note\":\"Nhận lệnh\", \r\n		\"class\":\"__receive_command\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"not_accepted\"}\r\n		]\r\n	}\r\n]', NULL, 0, 1, 1, 0, NULL, NULL, '2023-06-30 17:43:12', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (23, 'c_supplies', 'Phiếu xuất vật tư', NULL, 10, 'view', NULL, '[\n	{\n		\"type\":2,\n		\"detailonly\":1,\n		\"icon\":\"share\",\"note\":\"Xác nhận xuất vật tư\", \n		\"class\":\"__confirm_ex_supp\",\n		\"datas\":[\"supp_type\"],\n		\"condition\":[\n			{\"key\":\"status\", \"value\":\"handling\"}\n		]\n	}\n]', NULL, 1, 1, 1, 0, NULL, NULL, '2023-07-14 03:17:55', '2024-07-28 21:36:04');
INSERT INTO `n_tables` VALUES (24, 'n_log_actions', 'Lịch sử thao tác', NULL, 100, 'history', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, '2023-05-23 14:43:41', '2024-10-22 22:39:23');
INSERT INTO `n_tables` VALUES (25, 'w_users', 'Công nhân', '{\r\n	\"link\":\"list-worker-by-device/machine\", \r\n	\"note\":\"DS tổ máy\"\r\n}', 10, 'view', NULL, '', NULL, 1, 1, 1, 1, NULL, NULL, '2023-05-23 14:43:41', '2023-09-11 11:17:39');
INSERT INTO `n_tables` VALUES (26, 'paper_extends', 'Tên phụ giấy in', NULL, 10, 'view', NULL, '', NULL, 1, 1, 1, 1, NULL, NULL, '2023-07-17 19:30:41', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (27, 'supply_warehouses', 'Kho vật tư (carton, cao su, mút xốp, mica,...)', '{\r\n	\"link\":\"warehouse-management\", \r\n	\"note\":\"Quản lí kho vật tư\"\r\n}', 10, 'view', NULL, '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"undo\",\"note\":\"Xác nhận nhập kho vật tư\", \r\n		\"class\":\"__confirm_im_supp\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"waiting\"}\r\n		]\r\n	}\r\n]', NULL, 1, 1, 1, 1, 1, 1, '2023-07-14 03:17:55', '2024-07-12 18:24:25');
INSERT INTO `n_tables` VALUES (28, 'print_warehouses', 'Kho vật tư (giấy in)', '{\r\n	\"link\":\"warehouse-management\", \r\n	\"note\":\"Quản lí kho vật tư\"\r\n}', 10, 'ingredients.print_warehouses.view', 'ingredients.print_warehouses.form_search', '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"undo\",\"note\":\"Xác nhận nhập kho vật tư\", \r\n		\"class\":\"__confirm_im_supp\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"waiting\"}\r\n		]\r\n	}\r\n]', NULL, 1, 1, 1, 1, 0, 1, '2023-07-14 03:17:55', '2024-07-10 00:02:02');
INSERT INTO `n_tables` VALUES (29, 'other_warehouses', 'Kho vật tư (nam châm)', '{\r\n	\"link\":\"warehouse-management\", \r\n	\"note\":\"Quản lí kho vật tư\"\r\n}', 10, 'view', NULL, '', NULL, 1, 1, 1, 1, NULL, NULL, '2023-07-14 03:17:55', '2023-09-11 11:17:42');
INSERT INTO `n_tables` VALUES (30, 'square_warehouses', 'Kho vật tư (vật tư màng, nhung, vải lụa)', '{\r\n	\"link\":\"warehouse-management\", \r\n	\"note\":\"Quản lí kho vật tư\"\r\n}', 10, 'view', NULL, '', NULL, 1, 1, 1, 1, 1, 1, '2023-07-14 03:17:55', '2024-07-12 18:23:43');
INSERT INTO `n_tables` VALUES (32, 'w_salaries', 'Bảng lương chấm công - công nhân', '', 10, 'view', NULL, '', NULL, 0, 0, 1, 0, NULL, 1, '2023-07-14 03:17:55', '2024-06-20 17:49:17');
INSERT INTO `n_tables` VALUES (33, 'supply_names', 'Tên phụ vật tư', NULL, 10, 'view', NULL, '', NULL, 1, 1, 1, 1, NULL, NULL, '2023-07-17 19:30:41', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (34, 'papers', 'Vật tư giấy', NULL, 20, 'view', NULL, '', NULL, 0, 0, 0, 0, NULL, NULL, '2023-06-21 13:22:33', '2025-02-06 23:36:57');
INSERT INTO `n_tables` VALUES (35, 'supplies', 'Vật tư hộp cứng', NULL, 20, 'view', NULL, '', NULL, 0, 0, 0, 0, NULL, NULL, '2023-06-21 13:22:33', '2025-02-06 23:36:45');
INSERT INTO `n_tables` VALUES (36, 'fill_finishes', 'Bồi & hoàn thiện', NULL, 20, 'view', NULL, '', NULL, 0, 0, 0, 0, NULL, NULL, '2023-06-21 13:22:33', '2025-02-06 23:36:53');
INSERT INTO `n_tables` VALUES (37, 'product_styles', 'Kiểu hộp', '{\r\n	\"link\":\"view/product_categories\", \r\n	\"note\":\"Nhóm sản phẩm\"\r\n}', 20, 'view', NULL, '', NULL, 1, 1, 1, 1, NULL, NULL, '2023-06-21 13:22:33', '2023-09-20 15:05:49');
INSERT INTO `n_tables` VALUES (38, 'warehouse_providers', 'Nhà cung cấp vật tư', NULL, 10, 'view', NULL, '', NULL, 1, 1, 1, 1, NULL, NULL, '2023-07-17 19:30:41', '2023-08-16 19:42:34');
INSERT INTO `n_tables` VALUES (39, 'supply_buyings', 'Chứng từ mua vật tư', NULL, 10, 'view', NULL, '[\n	{\n		\"type\":2,\n		\"detailonly\":1,\n		\"icon\":\"check-square-o\",\"note\":\"Xác nhận đã liên hệ NCC\", \n		\"class\":\"__confirm_bought\",\n		\"datas\":[\"status\"],\n		\"condition\":[\n			{\"key\":\"status\", \"value\":\"processing\"}\n		]\n	},\n	{\n		\"type\":2,\n		\"detailonly\":1,\n		\"icon\":\"check-circle-o\",\n		\"note\":\"Duyệt mua vật tư\", \n		\"class\":\"__confirm_bought\",\n		\"datas\":[\"status\"],\n		\"condition\":[\n			{\"key\":\"status\", \"value\":\"not_accepted\"}\n		]\n	},\n	{\n		\"type\":2,\n		\"detailonly\":1,\n		\"icon\":\"check-square-o\",\"note\":\"Xác nhận đã mua\", \n		\"class\":\"__confirm_bought\",\n		\"datas\":[\"status\"],\n		\"condition\":[\n			{\"key\":\"status\", \"value\":\"accepted\"}\n		]\n	},\n	{\n		\"type\":2,\n		\"detailonly\":1,\n		\"icon\":\"check-square\",\"note\":\"Xác nhận nhập kho\", \n		\"class\":\"__confirm_warehouse_imported\",\n		\"condition\":[\n			{\"key\":\"status\", \"value\":\"bought\"}\n		]\n	}\n]', NULL, 1, 1, 1, 1, NULL, NULL, '2023-07-17 19:30:41', '2024-07-26 16:40:14');
INSERT INTO `n_tables` VALUES (40, 'c_expertises', 'Yêu cầu nhập kho thành phẩm', NULL, 10, 'view', NULL, '[\n	{\n		\"type\":2,\n		\"icon\":\"reply-all\",\n		\"note\":\"Duyệt nhập kho sản phẩm\", \n		\"class\":\"__confirm_product_warehouse\",\n		\"condition\":[\n			{\"key\":\"status\", \"value\":\"not_accepted\"}\n		]\n	}\n]', NULL, 0, 0, 1, 0, NULL, NULL, '2023-07-17 19:30:41', '2024-08-14 04:34:14');
INSERT INTO `n_tables` VALUES (41, 'product_warehouses', 'Kho thành phẩm', NULL, 20, 'view', NULL, '[\n	{\n		\"type\":2,\n		\"icon\":\"retweet\",\n		\"note\":\"Chuyển kho\", \n		\"class\":\"load_view_popup\",\n		\"link\":\"ajax-respone/productMoveWarehouse?id=<id>\",\n		\"size_popup\":\"medium_popup\"\n	}\n]', '[\n	{\n		\"type\":2,\n		\"icon\":\"recycle\",\n		\"note\":\"Chuyển kho\", \n		\"class\":\"load_view_popup\",\n		\"link\":\"ajax-respone/multipleProductMoveWarehouse\",\n		\"size_popup\":\"\"\n	}\n]', 0, 1, 1, 1, 1, NULL, '2023-04-23 11:30:46', '2024-10-24 22:23:49');
INSERT INTO `n_tables` VALUES (42, 'partners', 'Đối tác sản xuất', NULL, 10, 'view', NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, '2023-04-23 11:30:46', '2023-08-16 19:42:33');
INSERT INTO `n_tables` VALUES (43, 'after_prints', 'KCS sau in', NULL, 10, 'view', NULL, '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"check-square-o\",\r\n		\"size_popup\":\"medium_popup\",\r\n		\"note\":\"Duyệt chấm công cho công nhân\", \r\n		\"class\":\"load_view_popup\",\r\n		\"link\":\"after-print-kcs/<id>?nosidebar=1\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"processing\"}\r\n		]\r\n	}\r\n]', NULL, 0, 0, 1, 0, NULL, NULL, '2023-07-17 19:30:41', '2025-02-05 22:30:26');
INSERT INTO `n_tables` VALUES (44, 'c_reworks', 'Yêu cầu sản xuất lại', NULL, 10, 'view', '', '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"check-square-o\",\r\n		\"note\":\"Khởi tạo lại đơn\", \r\n		\"class\":\"__confirm_rework\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"not_accepted\"}\r\n		]\r\n	},\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"circle-thin\",\r\n		\"note\":\"Không cần thiết sản xuất lại\", \r\n		\"class\":\"__not_need_rework\",\r\n		\"datas\":[\"name\", \"qty\"],\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"not_accepted\"}\r\n		]\r\n	}\r\n]', NULL, 0, 0, 1, 0, NULL, NULL, '2023-07-17 19:30:41', '2024-04-25 14:53:53');
INSERT INTO `n_tables` VALUES (45, 'warehouse_histories', 'Nguyên vật liệu (Xuất, nhập, tồn)', '', 10, 'view', NULL, '', NULL, 0, 0, 1, 0, NULL, NULL, '2023-07-14 03:17:55', '2023-08-16 19:43:11');
INSERT INTO `n_tables` VALUES (46, 'represents', 'Người liên hệ', NULL, 10, 'view', NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, '2023-04-23 11:30:46', '2024-06-17 12:06:36');
INSERT INTO `n_tables` VALUES (47, 'extend_warehouses', 'Vật tư khác', '{\r\n	\"link\":\"warehouse-management\", \r\n	\"note\":\"Quản lí kho vật tư\"\r\n}', 10, 'view', NULL, '', NULL, 1, 1, 1, 1, 1, 1, '2023-07-14 03:17:55', '2024-07-10 00:01:58');
INSERT INTO `n_tables` VALUES (48, 'supply_extends', 'Các loại vật tư khác', '', 10, 'view', NULL, '', NULL, 1, 1, 1, 1, 0, 1, '2023-07-14 03:17:55', '2024-07-11 22:15:43');
INSERT INTO `n_tables` VALUES (49, 'c_orders', 'Chứng từ bán hàng', '', 50, 'view', '', '[\n	{\n		\"type\":2,\n		\"detailonly\":1,\n		\"icon\":\"hand-o-right\",\n		\"note\":\"Xác nhận xuất hàng\", \n		\"class\":\"__confirm_ex_selling\",\n		\"condition\":[\n			{\"key\":\"status\", \"value\":\"not_accepted\"},\n			{\"key\":\"type\", \"value\":\"sell\"}\n		]\n	},\n	{\n		\"icon\":\"print\",\n		\"note\":\"In lệnh\",\n		\"link\":\"print-data/c_orders/<id>\",\n		\"blank\":1,\n		\"condition\":[\n			{\"key\":\"type\", \"value\":\"sell\"}\n		]\n	}\n]', NULL, 1, 1, 1, 1, 1, 1, '2023-07-14 03:17:55', '2025-01-10 19:53:35');
INSERT INTO `n_tables` VALUES (50, 'c_products', 'KCS thành phẩm', NULL, 10, 'view', NULL, '[\r\n	{\r\n		\"type\":2,\r\n		\"icon\":\"calendar-check-o\",\r\n		\"note\":\"Yêu cầu nhập kho\",\r\n		\"class\":\"__product_takein_req\",\r\n		\"condition\":[\r\n			{\"key\":\"status\", \"value\":\"processing\"}\r\n		]\r\n	}\r\n]', NULL, 0, 1, 1, 2, NULL, NULL, '2023-04-23 11:30:46', '2024-09-25 23:12:25');
INSERT INTO `n_tables` VALUES (51, 'move_warehouses', 'Sản phẩm chuyển kho', NULL, 100, 'view', NULL, '', NULL, 0, 0, 1, 0, NULL, NULL, '2023-07-17 19:30:41', '2024-04-15 05:52:58');
INSERT INTO `n_tables` VALUES (52, 'c_payments', 'Đề xuất chi', '', 10, 'view', '', '[ 	{ 		\"type\":2, 		\"icon\":\"check\", 		\"note\":\"Xác nhận chi\", 		\"class\":\"__confirm_cpayment\", 		\"condition\":[ 			{\"con\":\"or\",\"key\":\"status\",\"value\":\"processing\"}, 			{\"con\":\"or\",\"key\":\"status\",\"value\":\"not_accepted\"} 		] 	} ]', NULL, 1, 1, 1, 1, 0, 1, '2023-07-14 03:17:55', '2024-12-13 00:17:56');
INSERT INTO `n_tables` VALUES (53, 'buying_items', 'Vật tư cần mua', '', 10, 'view', '', '[\n	{\n		\"type\":2,\n		\"detailonly\":1,\n		\"icon\":\"check-square-o\",\"note\":\"Xác nhận đã liên hệ NCC\", \n		\"class\":\"__confirm_bought\",\n		\"datas\":[\"status\"],\n		\"condition\":[\n			{\"key\":\"status\", \"value\":\"processing\"}\n		]\n	},\n	{\n		\"type\":2,\n		\"detailonly\":1,\n		\"icon\":\"check-circle-o\",\n		\"note\":\"Duyệt mua vật tư\", \n		\"class\":\"__confirm_bought\",\n		\"datas\":[\"status\"],\n		\"condition\":[\n			{\"key\":\"status\", \"value\":\"not_accepted\"}\n		]\n	},\n	{\n		\"type\":2,\n		\"detailonly\":1,\n		\"icon\":\"check-square-o\",\"note\":\"Xác nhận đã mua\", \n		\"class\":\"__confirm_bought\",\n		\"datas\":[\"status\"],\n		\"condition\":[\n			{\"key\":\"status\", \"value\":\"accepted\"}\n		]\n	},\n	{\n		\"type\":2,\n		\"detailonly\":1,\n		\"icon\":\"check-square\",\"note\":\"Xác nhận nhập kho\", \n		\"class\":\"__confirm_warehouse_imported\",\n		\"condition\":[\n			{\"key\":\"status\", \"value\":\"bought\"}\n		]\n	}\n]', NULL, 0, 1, 1, 0, 0, 0, '2023-07-14 03:17:55', '2025-01-18 09:25:52');

SET FOREIGN_KEY_CHECKS = 1;
