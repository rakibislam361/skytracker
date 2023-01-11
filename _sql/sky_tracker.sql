-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 01, 2023 at 11:29 AM
-- Server version: 8.0.27
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sky_tracker`
--


--
-- Dumping data for table `activity_log`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `area` enum('frontend','backend') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('info','danger','warning','success') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'info',
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `starts_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `area`, `type`, `message`, `enabled`, `starts_at`, `ends_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'info', 'This is a <strong>Global</strong> announcement that will show on both the frontend and backend. <em>See <strong>AnnouncementSeeder</strong> for more usage examples.</em>', 1, NULL, NULL, '2022-11-22 04:13:10', '2022-11-22 04:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `active` timestamp NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `top` tinyint(1) DEFAULT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  UNIQUE KEY `cache_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'contact',
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `infos`
--

DROP TABLE IF EXISTS `infos`;
CREATE TABLE IF NOT EXISTS `infos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `infos`
--

INSERT INTO `infos` (`id`, `title`, `link`, `image`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'dds', NULL, '1672563199.jpg', 'dsdds', 1, NULL, '2023-01-01 03:14:12'),
(2, 'dcd', NULL, '1672564464.png', 'dfdf', 1, '2023-01-01 03:14:24', '2023-01-01 03:14:24');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2020_02_25_034148_create_permission_tables', 1),
(6, '2020_05_25_021239_create_announcements_table', 1),
(7, '2020_05_29_020244_create_password_histories_table', 1),
(8, '2020_07_06_215139_create_activity_log_table', 1),
(9, '2021_04_05_153840_create_two_factor_authentications_table', 1),
(10, '2021_11_11_182655_create_products_table', 1),
(11, '2021_11_11_184511_create_review_table', 1),
(12, '2021_11_11_184525_create_settings_table', 1),
(13, '2021_11_13_174257_create_pages_table', 1),
(14, '2021_11_13_174606_create_contact_table', 1),
(15, '2021_11_21_162813_create_warehouses_table', 1),
(16, '2021_11_21_163149_create_statuses_table', 1),
(17, '2021_11_21_163304_create_shippings_table', 1),
(18, '2021_11_21_163408_create_brands_table', 1),
(19, '2021_11_21_163538_create_cache_table', 1),
(20, '2022_11_21_115335_create_orders_table', 1),
(21, '2022_11_21_115408_create_order_item_variations_table', 1),
(22, '2022_11_21_115442_create_order_item_table', 1),
(23, '2022_11_30_054320_apicall', 2),
(24, '2023_01_01_054551_create_notices_table', 2),
(25, '2023_01_01_061129_create_infos_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(9, 'App\\Domains\\Auth\\Models\\User', 3),
(10, 'App\\Domains\\Auth\\Models\\User', 3),
(11, 'App\\Domains\\Auth\\Models\\User', 4),
(12, 'App\\Domains\\Auth\\Models\\User', 5),
(13, 'App\\Domains\\Auth\\Models\\User', 5),
(12, 'App\\Domains\\Auth\\Models\\User', 6),
(13, 'App\\Domains\\Auth\\Models\\User', 6),
(14, 'App\\Domains\\Auth\\Models\\User', 6);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Domains\\Auth\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

DROP TABLE IF EXISTS `notices`;
CREATE TABLE IF NOT EXISTS `notices` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `is_active` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `link`, `image`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(5, 'demoup', NULL, '1672564302.jpg', 'demo', 1, '2023-01-01 03:08:39', '2023-01-01 03:11:42'),
(6, 'try', NULL, '1672564119.png', 'try', 1, '2023-01-01 03:08:39', '2023-01-01 03:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `needToPay` double DEFAULT NULL,
  `dueForProducts` double DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
CREATE TABLE IF NOT EXISTS `order_item` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_item_number` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantityRanges` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shipped_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_rate` int DEFAULT NULL,
  `approxWeight` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chinaLocalDelivery` double DEFAULT NULL,
  `order_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual_weight` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `product_value` double DEFAULT NULL,
  `first_payment` double DEFAULT NULL,
  `shipping_charge` double DEFAULT NULL,
  `courier_bill` double DEFAULT NULL,
  `out_of_stock` double DEFAULT NULL,
  `missing` double DEFAULT NULL,
  `adjustment` double DEFAULT NULL,
  `refunded` double DEFAULT NULL,
  `last_payment` double DEFAULT NULL,
  `due_payment` double DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `order_item_variations`
--

DROP TABLE IF EXISTS `order_item_variations`;
CREATE TABLE IF NOT EXISTS `order_item_variations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_item_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `itemCode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attributes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `subTotal` double DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_time` timestamp NULL DEFAULT NULL,
  `post_format` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'standard',
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb_status` tinyint(1) NOT NULL DEFAULT '1',
  `update_by` int DEFAULT NULL,
  `user_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `password_histories`
--

DROP TABLE IF EXISTS `password_histories`;
CREATE TABLE IF NOT EXISTS `password_histories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `password_histories`
--

INSERT INTO `password_histories` (`id`, `model_type`, `model_id`, `password`, `created_at`, `updated_at`) VALUES
(1, 'App\\Domains\\Auth\\Models\\User', 1, '$2y$10$t715EaQmLZkXYJu4r5RaDuFBMnN3cdshL6Ttsrfk5dYPZs.1Dr9HW', '2022-11-22 04:13:10', '2022-11-22 04:13:10'),
(2, 'App\\Domains\\Auth\\Models\\User', 2, '$2y$10$vy1/eQBZEF3BmhudR4cpwOR2MiU7FQiNcDzagXBPqoyHoq79vCDHK', '2022-11-22 04:13:10', '2022-11-22 04:13:10'),
(3, 'App\\Domains\\Auth\\Models\\User', 3, '$2y$10$x35f7D4o5DZ8H20srWRAD.v2NWGmL7TBXNfh2JHyQD5shg7xSLrX.', '2022-11-22 05:01:58', '2022-11-22 05:01:58'),
(4, 'App\\Domains\\Auth\\Models\\User', 4, '$2y$10$84i8zpZxaoVldzDsUfF66.H7VnIUZCPj3s68snCN1sjRbaN.hfqVe', '2022-11-22 05:04:33', '2022-11-22 05:04:33'),
(5, 'App\\Domains\\Auth\\Models\\User', 5, '$2y$10$gstvCQPOFC13VDJuVuf97eChmsI0ccVo0wfncA.bcnM5xJ.f6ewre', '2022-11-22 05:05:32', '2022-11-22 05:05:32'),
(6, 'App\\Domains\\Auth\\Models\\User', 6, '$2y$10$nro5v68/NbT.eGYvWcPKoOB7Qv/Vpe4WCiyeDzpPnQQL2e/.9x3R2', '2022-11-22 05:06:30', '2022-11-22 05:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `sort` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_parent_id_foreign` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `type`, `guard_name`, `name`, `description`, `parent_id`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', 'admin.access.user', 'All User Permissions', NULL, 1, '2022-11-22 04:13:10', '2022-11-22 04:13:10'),
(2, 'admin', 'web', 'admin.access.user.list', 'View Users', 1, 1, '2022-11-22 04:13:10', '2022-11-22 04:13:10'),
(3, 'admin', 'web', 'admin.access.user.deactivate', 'Deactivate Users', 1, 2, '2022-11-22 04:13:10', '2022-11-22 04:13:10'),
(4, 'admin', 'web', 'admin.access.user.reactivate', 'Reactivate Users', 1, 3, '2022-11-22 04:13:10', '2022-11-22 04:13:10'),
(5, 'admin', 'web', 'admin.access.user.clear-session', 'Clear User Sessions', 1, 4, '2022-11-22 04:13:10', '2022-11-22 04:13:10'),
(6, 'admin', 'web', 'admin.access.user.impersonate', 'Impersonate Users', 1, 5, '2022-11-22 04:13:10', '2022-11-22 04:13:10'),
(7, 'admin', 'web', 'admin.access.user.change-password', 'Change User Passwords', 1, 6, '2022-11-22 04:13:10', '2022-11-22 04:13:10'),
(8, 'admin', 'web', 'admin.order', 'All Order Permissions', NULL, 1, '2022-11-22 04:13:10', '2022-11-22 04:13:10'),
(9, 'admin', 'web', 'admin.order.order_rmb.edit', 'Edit Order Rmb', 8, 1, '2022-11-22 04:13:10', '2022-11-22 04:13:10'),
(10, 'admin', 'web', 'admin.order.localdelivery.edit', 'Edit Local Delivery', 8, 1, '2022-11-22 04:13:10', '2022-11-22 04:13:10'),
(11, 'admin', 'web', 'admin.order.purchase.edit', 'Actual Cost(Purchase Cost)', 8, 1, '2022-11-22 04:13:10', '2022-11-22 04:13:10'),
(12, 'admin', 'web', 'admin.order.status.edit', 'Edit Status', 8, 1, '2022-11-22 04:13:10', '2022-11-22 04:13:10'),
(13, 'admin', 'web', 'admin.order.carton.edit', 'Edit Carton Information', 8, 1, '2022-11-22 04:13:10', '2022-11-22 04:13:10'),
(14, 'admin', 'web', 'admin.order.rate.edit', 'Edit Rate', 8, 1, '2022-11-22 04:13:10', '2022-11-22 04:13:10'),
(15, 'admin', 'web', 'admin.settings', 'Settings Permissions', NULL, 1, '2022-11-22 04:13:10', '2022-11-22 04:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `active` timestamp NULL DEFAULT NULL,
  `productName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_id` bigint UNSIGNED DEFAULT NULL,
  `warehouse_id` bigint UNSIGNED DEFAULT NULL,
  `invoice` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `shipping_id` bigint UNSIGNED DEFAULT NULL,
  `barcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_invoice_unique` (`invoice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `type`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', 'web', '2022-11-22 04:13:10', '2022-11-22 04:13:10'),
(2, 'user', 'Customer', 'web', '2022-11-22 04:13:10', '2022-11-22 04:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `active` timestamp NOT NULL DEFAULT '2022-11-22 04:13:10',
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_value_unique` (`key`,`value`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `active`, `key`, `value`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2022-11-22 04:13:10', 'frontend_logo_menu', 'storage/setting/logo/logo.png', 1, '2022-12-31 22:51:02', '2022-12-31 23:20:00'),
(2, '2022-11-22 04:13:10', 'banner_text_header', 'FIND THE best door to door RATE', 1, '2022-12-31 23:05:19', '2022-12-31 23:05:19'),
(3, '2022-11-22 04:13:10', 'banner_text_bottom', 'SHIPPING TO AND FROM ANYWHERE IN THE WORLD', 1, '2022-12-31 23:05:19', '2022-12-31 23:05:19'),
(4, '2022-11-22 04:13:10', 'banner_image', 'storage/setting/logo/slider-golve.png', 1, '2022-12-31 23:12:32', '2022-12-31 23:23:11'),
(5, '2022-11-22 04:13:10', 'admin_logo', 'storage/setting/logo/slider-golve.png', 1, '2022-12-31 23:15:48', '2022-12-31 23:15:48'),
(6, '2022-11-22 04:13:10', 'banner_image_back', 'storage/setting/logo/slider-slider_img03.jpg', 1, '2022-12-31 23:34:18', '2022-12-31 23:34:18'),
(7, '2022-11-22 04:13:10', 'about_image_1', 'storage/setting/logo/bulk.05d5deb6.jpg', 1, '2023-01-01 03:51:49', '2023-01-01 03:51:49'),
(8, '2022-11-22 04:13:10', 'about_text_header', 'About Skytrack', 1, '2023-01-01 03:51:49', '2023-01-01 03:53:15'),
(9, '2022-11-22 04:13:10', 'about_text_bottom', 'Express delivery is an innovative service', 1, '2023-01-01 03:51:49', '2023-01-01 03:53:15'),
(10, '2022-11-22 04:13:10', 'about_text_details', 'Express delivery is an innovative service is effective logistics solution for the delivery of small cargo. This service is useful for companies of various effective logistics scale.', 1, '2023-01-01 03:51:49', '2023-01-01 03:53:15'),
(11, '2022-11-22 04:13:10', 'about_image_title_1', 'Bulk Shipment', 1, '2023-01-01 03:51:49', '2023-01-01 03:51:49'),
(12, '2022-11-22 04:13:10', 'about_image_title_2', 'Fast Delivery', 1, '2023-01-01 03:51:49', '2023-01-01 04:01:13'),
(13, '2022-11-22 04:13:10', 'about_image_title_4', 'Our Warehouses', 1, '2023-01-01 03:51:49', '2023-01-01 03:53:15'),
(14, '2022-11-22 04:13:10', 'about_image_title_5', 'Load/Unload', 1, '2023-01-01 03:51:49', '2023-01-01 03:53:15'),
(15, '2022-11-22 04:13:10', 'about_image_title_6', 'Care Solution', 1, '2023-01-01 03:51:49', '2023-01-01 03:53:15'),
(16, '2022-11-22 04:13:10', 'about_image_2', 'storage/setting/logo/bulk.05d5deb6.jpg', 1, '2023-01-01 03:53:14', '2023-01-01 03:53:14'),
(17, '2022-11-22 04:13:10', 'about_image_3', 'storage/setting/logo/bulk.05d5deb6.jpg', 1, '2023-01-01 03:53:14', '2023-01-01 03:53:14'),
(18, '2022-11-22 04:13:10', 'about_image_4', 'storage/setting/logo/bulk.05d5deb6.jpg', 1, '2023-01-01 03:53:14', '2023-01-01 03:53:14'),
(19, '2022-11-22 04:13:10', 'about_image_5', 'storage/setting/logo/bulk.05d5deb6.jpg', 1, '2023-01-01 03:53:15', '2023-01-01 03:53:15'),
(20, '2022-11-22 04:13:10', 'about_image_6', 'storage/setting/logo/bulk.05d5deb6.jpg', 1, '2023-01-01 03:53:15', '2023-01-01 03:53:15'),
(21, '2022-11-22 04:13:10', 'about_image_title_3', 'Cash on delivery', 1, '2023-01-01 04:01:13', '2023-01-01 04:01:13'),
(22, '2022-11-22 04:13:10', 'site_name', NULL, 1, '2023-01-01 04:03:18', '2023-01-01 04:03:18'),
(23, '2022-11-22 04:13:10', 'site_url', NULL, 1, '2023-01-01 04:03:18', '2023-01-01 04:03:18'),
(24, '2022-11-22 04:13:10', 'meta_title', NULL, 1, '2023-01-01 04:03:18', '2023-01-01 04:03:18'),
(25, '2022-11-22 04:13:10', 'meta_description', NULL, 1, '2023-01-01 04:03:18', '2023-01-01 04:03:18'),
(26, '2022-11-22 04:13:10', 'office_phone', '09613828606', 1, '2023-01-01 04:03:18', '2023-01-01 04:11:04'),
(27, '2022-11-22 04:13:10', 'office_email', 'info@skytrackbd.com', 1, '2023-01-01 04:03:18', '2023-01-01 04:11:04'),
(28, '2022-11-22 04:13:10', 'office_address', 'House#42, Road-3/A, Dhanmondi,\r\nDhaka-1209, Bangladesh', 1, '2023-01-01 04:03:18', '2023-01-01 04:12:30'),
(29, '2022-11-22 04:13:10', 'footer_description', NULL, 1, '2023-01-01 04:03:18', '2023-01-01 04:03:18'),
(30, '2022-11-22 04:13:10', 'copyright_text', 'Copyright© Sky Track | All Rights Reserved', 1, '2023-01-01 04:03:18', '2023-01-01 04:03:18'),
(31, '2022-11-22 04:13:10', 'g_map_iframe_url', NULL, 1, '2023-01-01 04:03:18', '2023-01-01 04:03:18'),
(32, '2022-11-22 04:13:10', 'facebook', 'https://www.facebook.com/skybuybd', 1, '2023-01-01 04:07:02', '2023-01-01 04:07:02'),
(33, '2022-11-22 04:13:10', 'twitter', 'https://www.facebook.com/skybuybd', 1, '2023-01-01 04:07:02', '2023-01-01 04:07:02'),
(34, '2022-11-22 04:13:10', 'linkedin', 'https://www.facebook.com/skybuybd', 1, '2023-01-01 04:07:02', '2023-01-01 04:07:02'),
(35, '2022-11-22 04:13:10', 'youtube', 'https://www.youtube.com/channel/UCpAD9qfHckZQaL55xrTdyoA', 1, '2023-01-01 04:07:02', '2023-01-01 04:07:02'),
(36, '2022-11-22 04:13:10', 'instagram', 'bdskybuy', 1, '2023-01-01 04:07:02', '2023-01-01 04:07:02'),
(37, '2022-11-22 04:13:10', 'frontend_logo_footer', 'storage/setting/logo/logo-w_logo.png', 1, '2023-01-01 04:12:58', '2023-01-01 04:12:58'),
(38, '2022-11-22 04:13:10', 'work_image_1', 'storage/setting/logo/icon-ds_icon01.png', 1, '2023-01-01 04:34:49', '2023-01-01 04:34:49'),
(39, '2022-11-22 04:13:10', 'work_image_2', 'storage/setting/logo/icon-ds_icon01.png', 1, '2023-01-01 04:34:49', '2023-01-01 04:34:49'),
(40, '2022-11-22 04:13:10', 'work_image_3', 'storage/setting/logo/icon-ds_icon01.png', 1, '2023-01-01 04:34:49', '2023-01-01 04:34:49'),
(41, '2022-11-22 04:13:10', 'work_text_header', 'How Sky Track Works', 1, '2023-01-01 04:34:49', '2023-01-01 04:34:49'),
(42, '2022-11-22 04:13:10', 'work_image_title_1', 'Create Booking', 1, '2023-01-01 04:34:49', '2023-01-01 04:34:49'),
(43, '2022-11-22 04:13:10', 'work_image_title_2', 'Track Your Booking', 1, '2023-01-01 04:34:49', '2023-01-01 04:34:49'),
(44, '2022-11-22 04:13:10', 'work_image_title_3', 'Get Your Shipment Delivered', 1, '2023-01-01 04:34:49', '2023-01-01 04:34:49'),
(45, '2022-11-22 04:13:10', 'work_image_bottom_1', 'Express delivery innovative service logistic delivery', 1, '2023-01-01 04:34:49', '2023-01-01 04:34:49'),
(46, '2022-11-22 04:13:10', 'work_image_bottom_2', 'Express delivery innovative service logistic delivery', 1, '2023-01-01 04:34:49', '2023-01-01 04:34:49'),
(47, '2022-11-22 04:13:10', 'work_image_bottom_3', 'Express delivery innovative service logistic delivery', 1, '2023-01-01 04:34:49', '2023-01-01 04:34:49'),
(48, '2022-11-22 04:13:10', 'bottombanner_image', 'storage/setting/logo/bg-video_bg.jpg', 1, '2023-01-01 05:24:26', '2023-01-01 05:24:26'),
(49, '2022-11-22 04:13:10', 'bottombanner_text_header', 'Our Chalanges', 1, '2023-01-01 05:24:26', '2023-01-01 05:24:26'),
(50, '2022-11-22 04:13:10', 'bottombanner_text_bottom', 'never break our promise', 1, '2023-01-01 05:24:26', '2023-01-01 05:24:26'),
(51, '2022-11-22 04:13:10', 'bottom_bg_color', '#4e148c', 1, '2023-01-01 05:24:26', '2023-01-01 05:24:26'),
(52, '2022-11-22 04:13:10', 'bottom_video_link', 'https://www.youtube.com/watch?v=iWKu6WNFf9M', 1, '2023-01-01 05:24:26', '2023-01-01 05:24:26');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

DROP TABLE IF EXISTS `shippings`;
CREATE TABLE IF NOT EXISTS `shippings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `two_factor_authentications`
--

DROP TABLE IF EXISTS `two_factor_authentications`;
CREATE TABLE IF NOT EXISTS `two_factor_authentications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `authenticatable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `authenticatable_id` bigint UNSIGNED NOT NULL,
  `shared_secret` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled_at` timestamp NULL DEFAULT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `digits` tinyint UNSIGNED NOT NULL DEFAULT '6',
  `seconds` tinyint UNSIGNED NOT NULL DEFAULT '30',
  `window` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `algorithm` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sha1',
  `recovery_codes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `recovery_codes_generated_at` timestamp NULL DEFAULT NULL,
  `safe_devices` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `2fa_auth_type_auth_id_index` (`authenticatable_type`,`authenticatable_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_id` int DEFAULT NULL,
  `billing_id` int DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_changed_at` timestamp NULL DEFAULT NULL,
  `active` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `timezone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_be_logged_out` tinyint(1) NOT NULL DEFAULT '0',
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `name`, `phone`, `email`, `shipping_id`, `billing_id`, `email_verified_at`, `password`, `password_changed_at`, `active`, `timezone`, `last_login_at`, `last_login_ip`, `to_be_logged_out`, `provider`, `provider_id`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'Super Admin', '01515234363', 'admin@admin.com', NULL, NULL, '2022-11-22 04:13:10', '$2y$10$fO77NORwdtIrv8pLt.NUh.n72B.J7tzoSlkvWK3LWz0nwmkhREJCy', NULL, 1, 'America/New_York', '2022-12-31 19:58:23', '127.0.0.1', 0, NULL, NULL, NULL, '2022-11-22 04:13:10', '2022-12-31 19:58:23', NULL),
(2, 'user', 'Test User', NULL, 'user@user.com', NULL, NULL, '2022-11-22 04:13:10', '$2y$10$vy1/eQBZEF3BmhudR4cpwOR2MiU7FQiNcDzagXBPqoyHoq79vCDHK', NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2022-11-22 04:13:10', '2022-11-22 04:13:10', NULL),
(3, 'admin', 'BD Purchase Officer', NULL, 'bdofficer@gmail.com', NULL, NULL, '2022-11-22 05:01:58', '$2y$10$x35f7D4o5DZ8H20srWRAD.v2NWGmL7TBXNfh2JHyQD5shg7xSLrX.', NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2022-11-22 05:01:58', '2022-11-22 05:01:58', NULL),
(4, 'admin', 'China Purchase Officer', NULL, 'chinapurchase@gmail.com', NULL, NULL, '2022-11-22 05:04:33', '$2y$10$84i8zpZxaoVldzDsUfF66.H7VnIUZCPj3s68snCN1sjRbaN.hfqVe', NULL, 1, 'America/New_York', '2022-11-22 05:08:32', '127.0.0.1', 0, NULL, NULL, NULL, '2022-11-22 05:04:33', '2022-11-22 05:08:32', NULL),
(5, 'admin', 'China Warehouse Officer', NULL, 'chinawarehouse@gmail.com', NULL, NULL, '2022-11-22 05:05:32', '$2y$10$gstvCQPOFC13VDJuVuf97eChmsI0ccVo0wfncA.bcnM5xJ.f6ewre', NULL, 1, 'America/New_York', '2022-11-22 05:08:03', '127.0.0.1', 0, NULL, NULL, NULL, '2022-11-22 05:05:32', '2022-11-22 05:08:03', NULL),
(6, 'admin', 'BD Logistic Officer', NULL, 'bdlogistic@gmail.com', NULL, NULL, '2022-11-22 05:06:30', '$2y$10$nro5v68/NbT.eGYvWcPKoOB7Qv/Vpe4WCiyeDzpPnQQL2e/.9x3R2', NULL, 1, 'America/New_York', '2022-11-22 05:06:50', '127.0.0.1', 0, NULL, NULL, NULL, '2022-11-22 05:06:30', '2022-11-22 05:06:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

DROP TABLE IF EXISTS `warehouses`;
CREATE TABLE IF NOT EXISTS `warehouses` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
