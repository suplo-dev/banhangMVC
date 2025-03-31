USE hhstore;
/*
 Navicat Premium Data Transfer

 Source Server         : hhstore
 Source Server Type    : MySQL
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : hhstore

 Target Server Type    : MySQL
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 31/03/2025 22:30:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for banners
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
                           `id` int(11) NOT NULL AUTO_INCREMENT,
                           `title` varchar(100) DEFAULT NULL,
                           `image` varchar(255) DEFAULT NULL,
                           `link` varchar(255) DEFAULT NULL,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of banners
-- ----------------------------
BEGIN;
INSERT INTO `banners` (`id`, `title`, `image`, `link`) VALUES (1, 'Sale Laptop', 'assets/images/banner1.jpg', '#');
INSERT INTO `banners` (`id`, `title`, `image`, `link`) VALUES (4, 'Test', 'assets/images/banner2.jpg', '#');
COMMIT;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `name` varchar(100) DEFAULT NULL,
                              `parent_id` int(11) DEFAULT 0,
                              `show_home` tinyint(4) DEFAULT 0,
                              `created_at` datetime DEFAULT NULL,
                              `updated_at` datetime DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
BEGIN;
INSERT INTO `categories` (`id`, `name`, `parent_id`, `show_home`, `created_at`, `updated_at`) VALUES (1, 'Laptoppp', 0, 2, NULL, NULL);
INSERT INTO `categories` (`id`, `name`, `parent_id`, `show_home`, `created_at`, `updated_at`) VALUES (2, 'Linh kiện', 0, 2, NULL, NULL);
INSERT INTO `categories` (`id`, `name`, `parent_id`, `show_home`, `created_at`, `updated_at`) VALUES (3, 'Phụ kiện', 0, 2, NULL, NULL);
INSERT INTO `categories` (`id`, `name`, `parent_id`, `show_home`, `created_at`, `updated_at`) VALUES (4, 'Macbook', 1, 1, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for files
-- ----------------------------
DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `product_id` int(11) NOT NULL,
                         `file_url` varchar(255) NOT NULL,
                         `deleted_at` datetime DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         KEY `product_id` (`product_id`),
                         CONSTRAINT `files_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of files
-- ----------------------------
BEGIN;
INSERT INTO `files` (`id`, `product_id`, `file_url`, `deleted_at`) VALUES (1, 20, 'uploads/1742653730_product1.jpg', NULL);
INSERT INTO `files` (`id`, `product_id`, `file_url`, `deleted_at`) VALUES (2, 20, 'uploads/1742653730_product2.jpg', NULL);
INSERT INTO `files` (`id`, `product_id`, `file_url`, `deleted_at`) VALUES (3, 20, 'uploads/1742653730_product3.jpg', NULL);
INSERT INTO `files` (`id`, `product_id`, `file_url`, `deleted_at`) VALUES (4, 20, 'uploads/1742653730_product4.jpg', NULL);
INSERT INTO `files` (`id`, `product_id`, `file_url`, `deleted_at`) VALUES (5, 20, 'uploads/1742655233_Canvas-16X24_inch.png', NULL);
COMMIT;

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `title` varchar(255) DEFAULT NULL,
                        `content` text DEFAULT NULL,
                        `image` varchar(255) DEFAULT NULL,
                        `created_at` datetime DEFAULT current_timestamp(),
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of news
-- ----------------------------
BEGIN;
INSERT INTO `news` (`id`, `title`, `content`, `image`, `created_at`) VALUES (1, 'Khuyến mãi tháng 3', 'Nội dung chi tiết khuyến mãi...', 'public/assets/images/news1.jpg', '2025-03-22 15:17:46');
COMMIT;

-- ----------------------------
-- Table structure for order_items
-- ----------------------------
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
                               `id` int(11) NOT NULL AUTO_INCREMENT,
                               `order_id` int(11) DEFAULT NULL,
                               `product_id` int(11) DEFAULT NULL,
                               `quantity` int(11) DEFAULT NULL,
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of order_items
-- ----------------------------
BEGIN;
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (1, 1, 2, 1);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (2, 1, 3, 2);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (3, 1, 5, 1);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (4, 1, 20, 2);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (5, 3, 20, 1);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (6, 5, 1, 1);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (7, NULL, 20, 2);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (8, NULL, 18, 2);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (9, NULL, 7, 1);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (10, NULL, 1, 6);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (11, NULL, 2, 1);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (12, NULL, 19, 7);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (13, NULL, 5, 12);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (14, NULL, 1, 1);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (15, NULL, 19, 3);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (16, NULL, 3, 6);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (17, NULL, 4, 6);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (18, NULL, 9, 1);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (19, NULL, 20, 1);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (20, 65, 1, 5);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (21, 65, 2, 2);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (22, 65, 3, 2);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (23, 66, 2, 1);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES (24, 66, 8, 1);
COMMIT;

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
                          `id` int(11) NOT NULL AUTO_INCREMENT,
                          `customer_name` varchar(100) DEFAULT NULL,
                          `address` varchar(255) DEFAULT NULL,
                          `total_amount` int(11) DEFAULT NULL,
                          `phone` varchar(10) DEFAULT NULL,
                          `user_id` int(11) DEFAULT NULL,
                          `created_at` datetime DEFAULT NULL,
                          `status` enum('Chờ xác nhận','Đang giao','Hoàn thành','Đã huỷ') DEFAULT 'Chờ xác nhận',
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of orders
-- ----------------------------
BEGIN;
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (1, 'Hà', 'Hà Nội', 190000000, '0947664672', 4, '2025-03-26 10:00:56', 'Hoàn thành');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (2, 'Hà', 'Hà Nội', 0, '0947664672', 4, '2025-03-26 10:00:56', 'Đang giao');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (3, 'Hà', 'Hà Nội', 35000000, '0947664671', 4, '2025-03-26 10:00:56', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (4, 'Hà', 'Hà Nội', 0, '0947664671', 4, '2025-03-26 10:00:56', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (5, 'Hà', 'Hà Nội', 30000000, '0947664674', 4, '2025-03-26 10:00:56', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (33, 'admin', 'hà nội', 0, '0947664670', NULL, NULL, 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (34, 'admin', 'hà nội', 0, '0947664670', NULL, NULL, 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (35, 'admin', 'hà nội', 0, '0947664670', NULL, NULL, 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (36, 'admin', 'hà nội', 0, '0947664670', NULL, NULL, 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (37, 'admin', 'hà nội', 0, '0947664670', NULL, NULL, 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (38, 'admin', 'hà nội', 0, '0947664670', NULL, NULL, 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (39, 'admin', 'hà nội', 0, '0947664670', NULL, '2025-03-30 00:34:49', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (40, 'admin', 'hà nội', 0, '0947664670', 1, '2025-03-30 00:35:26', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (41, 'admin', '123', 0, '0947664670', 1, '2025-03-30 00:37:46', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (42, 'admin', '123', 0, '0947664670', 1, '2025-03-30 00:38:28', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (43, 'admin', '123', 0, '0947664670', 1, '2025-03-30 00:39:04', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (44, 'admin', '123', 0, '0947664670', 1, '2025-03-30 00:39:07', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (45, 'admin', '123', 0, '0947664670', 1, '2025-03-30 00:39:46', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (46, 'admin', '123', 0, '0947664670', 1, '2025-03-30 00:40:00', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (47, 'admin', '123', 0, '0947664670', 1, '2025-03-30 00:40:05', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (48, 'admin', '123', 0, '0947664670', 1, '2025-03-30 00:40:22', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (49, 'admin', '123', 0, '0947664670', 1, '2025-03-30 00:40:49', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (50, 'admin', '123', 0, '0947664670', 1, '2025-03-30 00:42:54', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (51, 'admin', '13', 0, '0947664670', 1, '2025-03-30 01:21:19', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (52, 'admin', '123', 0, '0947664670', 1, '2025-03-30 01:22:05', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (53, 'admin', '123', 0, '0947664670', 1, '2025-03-30 01:24:08', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (54, 'admin', '231', 0, '0947664670', 1, '2025-03-30 01:26:07', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (55, 'admin', '231', 0, '0947664670', 1, '2025-03-30 01:26:24', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (56, 'admin', '123', 0, '0947664670', 1, '2025-03-30 01:27:09', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (57, 'admin', '123', 0, '0947664670', 1, '2025-03-30 01:27:52', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (58, 'admin', '123', 0, '0947664670', 1, '2025-03-30 01:28:34', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (59, 'admin', '123', 0, '0947664670', 1, '2025-03-30 01:29:41', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (60, 'admin', '123', 0, '0947664670', 1, '2025-03-30 01:30:30', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (61, 'admin', '123', 0, '0947664670', 1, '2025-03-30 12:59:10', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (62, 'admin', '123', 0, '0947664670', 1, '2025-03-30 13:04:03', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (63, 'admin', '123', 65000000, '0947664670', 1, '2025-03-30 13:09:38', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (64, 'admin', '123', 0, '0947664670', 1, '2025-03-30 13:10:15', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (65, 'admin', '456', 270000000, '0947664670', 1, '2025-03-30 13:10:45', 'Chờ xác nhận');
INSERT INTO `orders` (`id`, `customer_name`, `address`, `total_amount`, `phone`, `user_id`, `created_at`, `status`) VALUES (66, 'tên', 'testtttt', 60000000, '0912321123', 0, '2025-03-31 18:00:25', 'Chờ xác nhận');
COMMIT;

-- ----------------------------
-- Table structure for password_reset
-- ----------------------------
DROP TABLE IF EXISTS `password_reset`;
CREATE TABLE `password_reset` (
                                  `id` int(11) NOT NULL AUTO_INCREMENT,
                                  `user_id` int(11) NOT NULL,
                                  `token` varchar(255) NOT NULL,
                                  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                                  `expires_at` TIMESTAMP NOT NULL DEFAULT (NOW() + INTERVAL 365 DAY),
                                  PRIMARY KEY (`id`),
                                  KEY `user_id` (`user_id`),
                                  CONSTRAINT `password_reset_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of password_reset
-- ----------------------------
BEGIN;
INSERT INTO `password_reset` (`id`, `user_id`, `token`, `created_at`, `expires_at`) VALUES (1, 4, 'b0a63f1417e52aeb32811b19025c7cb945c8e03dff2936dbac53d48393c82dfa8906260fd29c2fc686ee2ca8af77a0535585', '2025-03-30 15:08:08', '2025-03-30 11:08:08');
INSERT INTO `password_reset` (`id`, `user_id`, `token`, `created_at`, `expires_at`) VALUES (2, 4, 'c3fafa72ff6f80988d48c653b5c76a791facd967ef6304e76a6a3523b224858f7cb2b844e6dda8146b4abf9deb2bc719baa4', '2025-03-30 15:08:09', '2025-03-30 11:08:09');
INSERT INTO `password_reset` (`id`, `user_id`, `token`, `created_at`, `expires_at`) VALUES (3, 4, '1c157af8d6c4b5645ac85840df5dab6c02b7cce614d4f4678c1924df668c5452310be6bade124663ff1f55883819f9c10b9a', '2025-03-30 15:09:30', '2025-03-30 11:09:30');
COMMIT;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(100) DEFAULT NULL,
                            `slug` varchar(255) DEFAULT NULL,
                            `thumb_url` varchar(255) DEFAULT NULL,
                            `price` int(11) DEFAULT NULL,
                            `description` text DEFAULT NULL,
                            `category_id` int(11) DEFAULT NULL,
                            `created_at` datetime DEFAULT NULL,
                            `updated_at` datetime DEFAULT NULL,
                            `deleted_at` varchar(255) DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of products
-- ----------------------------
BEGIN;
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'Macbook M1 1TB', 'macbook-m1-1tb', 'https://i0.wp.com/vuatao.vn/wp-content/uploads/2021/06/macbook-air-m1-2020-8-core-gpu-gold-thumb-650x650-1.png?fit=650%2C650&ssl=1', 30000000, 'Laptop cao cấp', 4, NULL, NULL, NULL);
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'Macbook M1 8GB', 'macbook-m1-1tb', 'https://i0.wp.com/vuatao.vn/wp-content/uploads/2021/06/macbook-air-m1-2020-8-core-gpu-gold-thumb-650x650-1.png?fit=650%2C650&ssl=1', 30000000, 'Laptop cao cấp', 1, NULL, NULL, NULL);
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 'Macbook M1 24GB', 'macbook-m1-1tb', 'https://i0.wp.com/vuatao.vn/wp-content/uploads/2021/06/macbook-air-m1-2020-8-core-gpu-gold-thumb-650x650-1.png?fit=650%2C650&ssl=1', 30000000, 'Laptop cao cấp', 1, NULL, NULL, NULL);
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 'Macbook M1 16GB', 'macbook-m1-1tb', 'https://i0.wp.com/vuatao.vn/wp-content/uploads/2021/06/macbook-air-m1-2020-8-core-gpu-gold-thumb-650x650-1.png?fit=650%2C650&ssl=1', 30000000, 'Laptop cao cấp', 1, NULL, NULL, NULL);
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 'Macbook M1 16GB', 'macbook-m1-1tb', 'https://i0.wp.com/vuatao.vn/wp-content/uploads/2021/06/macbook-air-m1-2020-8-core-gpu-gold-thumb-650x650-1.png?fit=650%2C650&ssl=1', 30000000, 'Laptop cao cấp', 1, NULL, NULL, NULL);
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 'Macbook M1 16GB', 'macbook-m1-1tb', 'https://i0.wp.com/vuatao.vn/wp-content/uploads/2021/06/macbook-air-m1-2020-8-core-gpu-gold-thumb-650x650-1.png?fit=650%2C650&ssl=1', 30000000, 'Laptop cao cấp', 4, NULL, NULL, NULL);
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 'Macbook M1 256GB', 'macbook-m1-1tb', 'https://i0.wp.com/vuatao.vn/wp-content/uploads/2021/06/macbook-air-m1-2020-8-core-gpu-gold-thumb-650x650-1.png?fit=650%2C650&ssl=1', 30000000, 'Laptop cao cấp', 4, NULL, NULL, NULL);
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 'Macbook M1 16GB', 'macbook-m1-1tb', 'https://i0.wp.com/vuatao.vn/wp-content/uploads/2021/06/macbook-air-m1-2020-8-core-gpu-gold-thumb-650x650-1.png?fit=650%2C650&ssl=1', 30000000, 'Laptop cao cấp', 4, NULL, NULL, NULL);
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 'Macbook M1 16GB', 'macbook-m1-1tb', 'https://i0.wp.com/vuatao.vn/wp-content/uploads/2021/06/macbook-air-m1-2020-8-core-gpu-gold-thumb-650x650-1.png?fit=650%2C650&ssl=1', 30000000, 'Laptop cao cấp', 4, NULL, NULL, NULL);
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (10, 'Macbook M1 16GB', 'macbook-m1-1tb', 'https://i0.wp.com/vuatao.vn/wp-content/uploads/2021/06/macbook-air-m1-2020-8-core-gpu-gold-thumb-650x650-1.png?fit=650%2C650&ssl=1', 30000000, 'Laptop cao cấp', 4, NULL, NULL, NULL);
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (11, 'Macbook M4', 'macbook-m1-1tb', 'uploads/1742652928_product1.jpg', 25000000, '<p><strong>MacBook M4 16GB</strong> – Một lựa chọn lý tưởng cho những ai cần hiệu suất mạnh mẽ và thiết kế sang trọng. Trang bị bộ vi xử lý <strong>Apple M4</strong> với hiệu suất vượt trội, MacBook M4 mang đến khả năng xử lý mượt mà các ứng dụng nặng, đồng thời tiết kiệm năng lượng vượt trội, giúp bạn làm việc hiệu quả trong thời gian dài mà không lo hết pin.</p><p>Với <strong>16GB RAM</strong>, MacBook M4 mang đến khả năng đa nhiệm mạnh mẽ, cho phép bạn mở nhiều ứng dụng cùng lúc mà không gặp phải độ trễ hay giật lag. Từ việc chỉnh sửa video 4K, chạy các phần mềm đồ họa chuyên sâu đến lập trình hay chơi game, chiếc MacBook này sẽ đáp ứng mọi nhu cầu công việc và giải trí của bạn.</p><p>Màn hình <strong>Retina</strong> sắc nét, màu sắc trung thực, cùng với <strong>True Tone</strong> giúp hình ảnh luôn rõ ràng và dễ chịu cho mắt, dù bạn làm việc trong môi trường ánh sáng mạnh hay yếu. Bên cạnh đó, hệ điều hành <strong>macOS</strong> tối ưu hóa hiệu suất và bảo mật, mang đến trải nghiệm người dùng mượt mà và an toàn.</p><p>Với thiết kế mỏng nhẹ, sang trọng, và các tính năng đột phá như <strong>Touch ID</strong> và <strong>Magic Keyboard</strong>, MacBook M4 không chỉ là công cụ làm việc mà còn là một người bạn đồng hành đáng tin cậy cho mọi chuyên gia.</p>', 1, NULL, NULL, '2025-03-22 22:16:30');
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (12, 'Macbook M4', 'macbook-m1-1tb', 'uploads/1742652986_product1.jpg', 25000000, '<p><strong>MacBook M4 16GB</strong> – Một lựa chọn lý tưởng cho những ai cần hiệu suất mạnh mẽ và thiết kế sang trọng. Trang bị bộ vi xử lý <strong>Apple M4</strong> với hiệu suất vượt trội, MacBook M4 mang đến khả năng xử lý mượt mà các ứng dụng nặng, đồng thời tiết kiệm năng lượng vượt trội, giúp bạn làm việc hiệu quả trong thời gian dài mà không lo hết pin.</p><p>Với <strong>16GB RAM</strong>, MacBook M4 mang đến khả năng đa nhiệm mạnh mẽ, cho phép bạn mở nhiều ứng dụng cùng lúc mà không gặp phải độ trễ hay giật lag. Từ việc chỉnh sửa video 4K, chạy các phần mềm đồ họa chuyên sâu đến lập trình hay chơi game, chiếc MacBook này sẽ đáp ứng mọi nhu cầu công việc và giải trí của bạn.</p><p>Màn hình <strong>Retina</strong> sắc nét, màu sắc trung thực, cùng với <strong>True Tone</strong> giúp hình ảnh luôn rõ ràng và dễ chịu cho mắt, dù bạn làm việc trong môi trường ánh sáng mạnh hay yếu. Bên cạnh đó, hệ điều hành <strong>macOS</strong> tối ưu hóa hiệu suất và bảo mật, mang đến trải nghiệm người dùng mượt mà và an toàn.</p><p>Với thiết kế mỏng nhẹ, sang trọng, và các tính năng đột phá như <strong>Touch ID</strong> và <strong>Magic Keyboard</strong>, MacBook M4 không chỉ là công cụ làm việc mà còn là một người bạn đồng hành đáng tin cậy cho mọi chuyên gia.</p>', 1, NULL, NULL, '2025-03-22 22:19:27');
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (13, 'Macbook M4', 'macbook-m1-1tb', 'uploads/1742652994_product1.jpg', 25000000, '<p><strong>MacBook M4 16GB</strong> – Một lựa chọn lý tưởng cho những ai cần hiệu suất mạnh mẽ và thiết kế sang trọng. Trang bị bộ vi xử lý <strong>Apple M4</strong> với hiệu suất vượt trội, MacBook M4 mang đến khả năng xử lý mượt mà các ứng dụng nặng, đồng thời tiết kiệm năng lượng vượt trội, giúp bạn làm việc hiệu quả trong thời gian dài mà không lo hết pin.</p><p>Với <strong>16GB RAM</strong>, MacBook M4 mang đến khả năng đa nhiệm mạnh mẽ, cho phép bạn mở nhiều ứng dụng cùng lúc mà không gặp phải độ trễ hay giật lag. Từ việc chỉnh sửa video 4K, chạy các phần mềm đồ họa chuyên sâu đến lập trình hay chơi game, chiếc MacBook này sẽ đáp ứng mọi nhu cầu công việc và giải trí của bạn.</p><p>Màn hình <strong>Retina</strong> sắc nét, màu sắc trung thực, cùng với <strong>True Tone</strong> giúp hình ảnh luôn rõ ràng và dễ chịu cho mắt, dù bạn làm việc trong môi trường ánh sáng mạnh hay yếu. Bên cạnh đó, hệ điều hành <strong>macOS</strong> tối ưu hóa hiệu suất và bảo mật, mang đến trải nghiệm người dùng mượt mà và an toàn.</p><p>Với thiết kế mỏng nhẹ, sang trọng, và các tính năng đột phá như <strong>Touch ID</strong> và <strong>Magic Keyboard</strong>, MacBook M4 không chỉ là công cụ làm việc mà còn là một người bạn đồng hành đáng tin cậy cho mọi chuyên gia.</p>', 1, NULL, NULL, '2025-03-22 22:19:32');
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (14, 'Macbook M4', 'macbook-m1-1tb', 'uploads/1742653354_product1.jpg', 25000000, '<p><strong>MacBook M4 16GB</strong> – Một lựa chọn lý tưởng cho những ai cần hiệu suất mạnh mẽ và thiết kế sang trọng. Trang bị bộ vi xử lý <strong>Apple M4</strong> với hiệu suất vượt trội, MacBook M4 mang đến khả năng xử lý mượt mà các ứng dụng nặng, đồng thời tiết kiệm năng lượng vượt trội, giúp bạn làm việc hiệu quả trong thời gian dài mà không lo hết pin.</p><p>Với <strong>16GB RAM</strong>, MacBook M4 mang đến khả năng đa nhiệm mạnh mẽ, cho phép bạn mở nhiều ứng dụng cùng lúc mà không gặp phải độ trễ hay giật lag. Từ việc chỉnh sửa video 4K, chạy các phần mềm đồ họa chuyên sâu đến lập trình hay chơi game, chiếc MacBook này sẽ đáp ứng mọi nhu cầu công việc và giải trí của bạn.</p><p>Màn hình <strong>Retina</strong> sắc nét, màu sắc trung thực, cùng với <strong>True Tone</strong> giúp hình ảnh luôn rõ ràng và dễ chịu cho mắt, dù bạn làm việc trong môi trường ánh sáng mạnh hay yếu. Bên cạnh đó, hệ điều hành <strong>macOS</strong> tối ưu hóa hiệu suất và bảo mật, mang đến trải nghiệm người dùng mượt mà và an toàn.</p><p>Với thiết kế mỏng nhẹ, sang trọng, và các tính năng đột phá như <strong>Touch ID</strong> và <strong>Magic Keyboard</strong>, MacBook M4 không chỉ là công cụ làm việc mà còn là một người bạn đồng hành đáng tin cậy cho mọi chuyên gia.</p>', 1, NULL, NULL, '2025-03-22 22:19:36');
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (15, 'Macbook M4', 'macbook-m1-1tb', 'uploads/1742653562_product1.jpg', 25000000, '<p><strong>MacBook M4 16GB</strong> – Một lựa chọn lý tưởng cho những ai cần hiệu suất mạnh mẽ và thiết kế sang trọng. Trang bị bộ vi xử lý <strong>Apple M4</strong> với hiệu suất vượt trội, MacBook M4 mang đến khả năng xử lý mượt mà các ứng dụng nặng, đồng thời tiết kiệm năng lượng vượt trội, giúp bạn làm việc hiệu quả trong thời gian dài mà không lo hết pin.</p><p>Với <strong>16GB RAM</strong>, MacBook M4 mang đến khả năng đa nhiệm mạnh mẽ, cho phép bạn mở nhiều ứng dụng cùng lúc mà không gặp phải độ trễ hay giật lag. Từ việc chỉnh sửa video 4K, chạy các phần mềm đồ họa chuyên sâu đến lập trình hay chơi game, chiếc MacBook này sẽ đáp ứng mọi nhu cầu công việc và giải trí của bạn.</p><p>Màn hình <strong>Retina</strong> sắc nét, màu sắc trung thực, cùng với <strong>True Tone</strong> giúp hình ảnh luôn rõ ràng và dễ chịu cho mắt, dù bạn làm việc trong môi trường ánh sáng mạnh hay yếu. Bên cạnh đó, hệ điều hành <strong>macOS</strong> tối ưu hóa hiệu suất và bảo mật, mang đến trải nghiệm người dùng mượt mà và an toàn.</p><p>Với thiết kế mỏng nhẹ, sang trọng, và các tính năng đột phá như <strong>Touch ID</strong> và <strong>Magic Keyboard</strong>, MacBook M4 không chỉ là công cụ làm việc mà còn là một người bạn đồng hành đáng tin cậy cho mọi chuyên gia.</p>', 1, NULL, NULL, '2025-03-22 22:19:40');
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (16, 'Macbook M4', 'macbook-m1-1tb', 'uploads/1742653578_product1.jpg', 25000000, '<p><strong>MacBook M4 16GB</strong> – Một lựa chọn lý tưởng cho những ai cần hiệu suất mạnh mẽ và thiết kế sang trọng. Trang bị bộ vi xử lý <strong>Apple M4</strong> với hiệu suất vượt trội, MacBook M4 mang đến khả năng xử lý mượt mà các ứng dụng nặng, đồng thời tiết kiệm năng lượng vượt trội, giúp bạn làm việc hiệu quả trong thời gian dài mà không lo hết pin.</p><p>Với <strong>16GB RAM</strong>, MacBook M4 mang đến khả năng đa nhiệm mạnh mẽ, cho phép bạn mở nhiều ứng dụng cùng lúc mà không gặp phải độ trễ hay giật lag. Từ việc chỉnh sửa video 4K, chạy các phần mềm đồ họa chuyên sâu đến lập trình hay chơi game, chiếc MacBook này sẽ đáp ứng mọi nhu cầu công việc và giải trí của bạn.</p><p>Màn hình <strong>Retina</strong> sắc nét, màu sắc trung thực, cùng với <strong>True Tone</strong> giúp hình ảnh luôn rõ ràng và dễ chịu cho mắt, dù bạn làm việc trong môi trường ánh sáng mạnh hay yếu. Bên cạnh đó, hệ điều hành <strong>macOS</strong> tối ưu hóa hiệu suất và bảo mật, mang đến trải nghiệm người dùng mượt mà và an toàn.</p><p>Với thiết kế mỏng nhẹ, sang trọng, và các tính năng đột phá như <strong>Touch ID</strong> và <strong>Magic Keyboard</strong>, MacBook M4 không chỉ là công cụ làm việc mà còn là một người bạn đồng hành đáng tin cậy cho mọi chuyên gia.</p>', 1, NULL, NULL, '2025-03-22 22:19:45');
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (17, 'Macbook M4', 'macbook-m1-1tb', 'uploads/1742653611_product1.jpg', 25000000, '<p><strong>MacBook M4 16GB</strong> – Một lựa chọn lý tưởng cho những ai cần hiệu suất mạnh mẽ và thiết kế sang trọng. Trang bị bộ vi xử lý <strong>Apple M4</strong> với hiệu suất vượt trội, MacBook M4 mang đến khả năng xử lý mượt mà các ứng dụng nặng, đồng thời tiết kiệm năng lượng vượt trội, giúp bạn làm việc hiệu quả trong thời gian dài mà không lo hết pin.</p><p>Với <strong>16GB RAM</strong>, MacBook M4 mang đến khả năng đa nhiệm mạnh mẽ, cho phép bạn mở nhiều ứng dụng cùng lúc mà không gặp phải độ trễ hay giật lag. Từ việc chỉnh sửa video 4K, chạy các phần mềm đồ họa chuyên sâu đến lập trình hay chơi game, chiếc MacBook này sẽ đáp ứng mọi nhu cầu công việc và giải trí của bạn.</p><p>Màn hình <strong>Retina</strong> sắc nét, màu sắc trung thực, cùng với <strong>True Tone</strong> giúp hình ảnh luôn rõ ràng và dễ chịu cho mắt, dù bạn làm việc trong môi trường ánh sáng mạnh hay yếu. Bên cạnh đó, hệ điều hành <strong>macOS</strong> tối ưu hóa hiệu suất và bảo mật, mang đến trải nghiệm người dùng mượt mà và an toàn.</p><p>Với thiết kế mỏng nhẹ, sang trọng, và các tính năng đột phá như <strong>Touch ID</strong> và <strong>Magic Keyboard</strong>, MacBook M4 không chỉ là công cụ làm việc mà còn là một người bạn đồng hành đáng tin cậy cho mọi chuyên gia.</p>', 1, NULL, NULL, '2025-03-22 22:19:49');
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (18, 'Macbook M4', 'macbook-m1-1tb', 'uploads/1742653650_product1.jpg', 25000000, '<p><strong>MacBook M4 16GB</strong> – Một lựa chọn lý tưởng cho những ai cần hiệu suất mạnh mẽ và thiết kế sang trọng. Trang bị bộ vi xử lý <strong>Apple M4</strong> với hiệu suất vượt trội, MacBook M4 mang đến khả năng xử lý mượt mà các ứng dụng nặng, đồng thời tiết kiệm năng lượng vượt trội, giúp bạn làm việc hiệu quả trong thời gian dài mà không lo hết pin.</p><p>Với <strong>16GB RAM</strong>, MacBook M4 mang đến khả năng đa nhiệm mạnh mẽ, cho phép bạn mở nhiều ứng dụng cùng lúc mà không gặp phải độ trễ hay giật lag. Từ việc chỉnh sửa video 4K, chạy các phần mềm đồ họa chuyên sâu đến lập trình hay chơi game, chiếc MacBook này sẽ đáp ứng mọi nhu cầu công việc và giải trí của bạn.</p><p>Màn hình <strong>Retina</strong> sắc nét, màu sắc trung thực, cùng với <strong>True Tone</strong> giúp hình ảnh luôn rõ ràng và dễ chịu cho mắt, dù bạn làm việc trong môi trường ánh sáng mạnh hay yếu. Bên cạnh đó, hệ điều hành <strong>macOS</strong> tối ưu hóa hiệu suất và bảo mật, mang đến trải nghiệm người dùng mượt mà và an toàn.</p><p>Với thiết kế mỏng nhẹ, sang trọng, và các tính năng đột phá như <strong>Touch ID</strong> và <strong>Magic Keyboard</strong>, MacBook M4 không chỉ là công cụ làm việc mà còn là một người bạn đồng hành đáng tin cậy cho mọi chuyên gia.</p>', 1, NULL, NULL, NULL);
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (19, 'Macbook M4', 'macbook-m1-1tb', 'uploads/1742653722_product1.jpg', 25000000, '<p><strong>MacBook M4 16GB</strong> – Một lựa chọn lý tưởng cho những ai cần hiệu suất mạnh mẽ và thiết kế sang trọng. Trang bị bộ vi xử lý <strong>Apple M4</strong> với hiệu suất vượt trội, MacBook M4 mang đến khả năng xử lý mượt mà các ứng dụng nặng, đồng thời tiết kiệm năng lượng vượt trội, giúp bạn làm việc hiệu quả trong thời gian dài mà không lo hết pin.</p><p>Với <strong>16GB RAM</strong>, MacBook M4 mang đến khả năng đa nhiệm mạnh mẽ, cho phép bạn mở nhiều ứng dụng cùng lúc mà không gặp phải độ trễ hay giật lag. Từ việc chỉnh sửa video 4K, chạy các phần mềm đồ họa chuyên sâu đến lập trình hay chơi game, chiếc MacBook này sẽ đáp ứng mọi nhu cầu công việc và giải trí của bạn.</p><p>Màn hình <strong>Retina</strong> sắc nét, màu sắc trung thực, cùng với <strong>True Tone</strong> giúp hình ảnh luôn rõ ràng và dễ chịu cho mắt, dù bạn làm việc trong môi trường ánh sáng mạnh hay yếu. Bên cạnh đó, hệ điều hành <strong>macOS</strong> tối ưu hóa hiệu suất và bảo mật, mang đến trải nghiệm người dùng mượt mà và an toàn.</p><p>Với thiết kế mỏng nhẹ, sang trọng, và các tính năng đột phá như <strong>Touch ID</strong> và <strong>Magic Keyboard</strong>, MacBook M4 không chỉ là công cụ làm việc mà còn là một người bạn đồng hành đáng tin cậy cho mọi chuyên gia.</p>', 1, NULL, NULL, NULL);
INSERT INTO `products` (`id`, `name`, `slug`, `thumb_url`, `price`, `description`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (20, 'Macbook M4 36GB', 'macbook-m4-36gb', 'uploads/1742653722_product1.jpg', 35000000, '<p><strong>MacBook M4 16GB</strong> – Một lựa chọn lý tưởng cho những ai cần hiệu suất mạnh mẽ và thiết kế sang trọng. Trang bị bộ vi xử lý <strong>Apple M4</strong> với hiệu suất vượt trội, MacBook M4 mang đến khả năng xử lý mượt mà các ứng dụng nặng, đồng thời tiết kiệm năng lượng vượt trội, giúp bạn làm việc hiệu quả trong thời gian dài mà không lo hết pin.</p><p>Với <strong>16GB RAM</strong>, MacBook M4 mang đến khả năng đa nhiệm mạnh mẽ, cho phép bạn mở nhiều ứng dụng cùng lúc mà không gặp phải độ trễ hay giật lag. Từ việc chỉnh sửa video 4K, chạy các phần mềm đồ họa chuyên sâu đến lập trình hay chơi game, chiếc MacBook này sẽ đáp ứng mọi nhu cầu công việc và giải trí của bạn.</p><p>Màn hình <strong>Retina</strong> sắc nét, màu sắc trung thực, cùng với <strong>True Tone</strong> giúp hình ảnh luôn rõ ràng và dễ chịu cho mắt, dù bạn làm việc trong môi trường ánh sáng mạnh hay yếu. Bên cạnh đó, hệ điều hành <strong>macOS</strong> tối ưu hóa hiệu suất và bảo mật, mang đến trải nghiệm người dùng mượt mà và an toàn.</p><p>Với thiết kế mỏng nhẹ, sang trọng, và các tính năng đột phá như <strong>Touch ID</strong> và <strong>Magic Keyboard</strong>, MacBook M4 không chỉ là công cụ làm việc mà còn là một người bạn đồng hành đáng tin cậy cho mọi chuyên gia.</p>', 4, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `username` varchar(50) DEFAULT NULL,
                         `password` varchar(255) DEFAULT NULL,
                         `email` varchar(100) DEFAULT NULL,
                         `role` varchar(10) DEFAULT 'user',
                         `phone` varchar(10) DEFAULT NULL,
                         `address` varchar(255) DEFAULT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `phone`, `address`) VALUES (1, 'admin', '$2y$10$ySrXXe1kSqFkiKmo8.NT6eQj.K1IKy9NpzOx8lK2WlVlTBLvaZCsy', 'admin@example.com', 'admin', '0947664670', NULL);
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `phone`, `address`) VALUES (2, 'user2', '$2y$10$ySrXXe1kSqFkiKmo8.NT6eQj.K1IKy9NpzOx8lK2WlVlTBLvaZCsy', 'admin@example.com', 'customer', '0947664672', NULL);
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `phone`, `address`) VALUES (3, 'user3', '$2y$10$ySrXXe1kSqFkiKmo8.NT6eQj.K1IKy9NpzOx8lK2WlVlTBLvaZCsy', 'admin@example.com', 'customer', '0947664673', NULL);
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `phone`, `address`) VALUES (4, 'user', '$2y$10$ZKRR6.qGiXMYa..aD8N0pOkNrJTFqTKxHOSxXb23ALoklNJbKgACy', 'vinhvt@senprints.com', 'user', '0947664671', 'Hà Nội');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
