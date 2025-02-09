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

 Date: 09/02/2025 11:20:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` tinyint NULL DEFAULT NULL,
  `qty` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `made_by` int NULL DEFAULT NULL,
  `category` int NULL DEFAULT NULL,
  `product_style` int NULL DEFAULT NULL,
  `design` int NULL DEFAULT NULL,
  `length` float NULL DEFAULT NULL,
  `width` float NULL DEFAULT NULL,
  `height` float NULL DEFAULT NULL,
  `quote_id` int NULL DEFAULT NULL,
  `order` int NULL DEFAULT NULL,
  `total_cost` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `profit` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ship_price` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `base_total` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `total_amount` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `custom_design_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `sale_shape_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `tech_shape_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `design_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `design_shape_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `handle_shape_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `act` tinyint NULL DEFAULT NULL,
  `order_created` tinyint NULL DEFAULT NULL,
  `detail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `product_warehouse` int NULL DEFAULT NULL,
  `delivery` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `parent` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

SET FOREIGN_KEY_CHECKS = 1;
