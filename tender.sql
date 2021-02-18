-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 28, 2021 at 04:14 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tender`
--

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

DROP TABLE IF EXISTS `bid`;
CREATE TABLE IF NOT EXISTS `bid` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tender_id` int DEFAULT '0',
  `bidder_id` int DEFAULT '0',
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discription` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`id`, `tender_id`, `bidder_id`, `price`, `discription`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 45, 1, '100', 'test', '2021-01-11 13:57:34', '2021-01-11 13:57:34', NULL),
(5, 45, 1, '400', 'tsadfdsest', '2021-01-11 14:41:25', '2021-01-12 12:25:38', NULL),
(6, 45, 1, '30011', 'testsadfsdf', '2021-01-12 12:34:00', '2021-01-12 12:34:00', NULL),
(7, 45, 1, '300113321', 'testsadfsdf ffds', '2021-01-12 12:35:00', '2021-01-12 12:36:30', NULL),
(8, 45, 1, '400', 'test', '2021-01-15 06:51:50', '2021-01-15 06:51:50', NULL),
(9, 45, 1, '4033', 'harshdeep', '2021-01-15 06:54:06', '2021-01-15 06:54:06', NULL),
(10, 1, 1, '500000', 'harsdee32', '2021-01-15 07:00:54', '2021-01-15 08:27:08', NULL),
(11, 1, 1, '500054', 'harsdee32234', '2021-01-15 08:28:50', '2021-01-15 08:28:50', NULL),
(12, 3, 3, '500', 'This is testing bid.', '2021-01-27 01:31:43', '2021-01-27 01:31:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bidder_managers`
--

DROP TABLE IF EXISTS `bidder_managers`;
CREATE TABLE IF NOT EXISTS `bidder_managers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_reg_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_contact_person` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bidder_managers_email_unique` (`email`),
  UNIQUE KEY `bidder_managers_mobile_unique` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_customers`
--

DROP TABLE IF EXISTS `crm_customers`;
CREATE TABLE IF NOT EXISTS `crm_customers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status_fk_2825637` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_documents`
--

DROP TABLE IF EXISTS `crm_documents`;
CREATE TABLE IF NOT EXISTS `crm_documents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_fk_2825654` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_notes`
--

DROP TABLE IF EXISTS `crm_notes`;
CREATE TABLE IF NOT EXISTS `crm_notes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `note` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_fk_2825648` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_statuses`
--

DROP TABLE IF EXISTS `crm_statuses`;
CREATE TABLE IF NOT EXISTS `crm_statuses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crm_statuses`
--

INSERT INTO `crm_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lead', '2020-12-19 12:08:24', '2020-12-19 12:08:24', NULL),
(2, 'Customer', '2020-12-19 12:08:24', '2020-12-19 12:08:24', NULL),
(3, 'Partner', '2020-12-19 12:08:24', '2020-12-19 12:08:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

DROP TABLE IF EXISTS `materials`;
CREATE TABLE IF NOT EXISTS `materials` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `parent`, `category_name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Steel Material', NULL, '2020-12-28 12:50:53', '2020-12-28 12:50:53', NULL),
(2, NULL, 'Cement', NULL, '2020-12-28 12:51:19', '2020-12-28 12:51:19', NULL),
(3, NULL, 'Tiles', NULL, '2020-12-28 12:51:32', '2020-12-28 12:51:32', NULL),
(4, NULL, 'Granite granites', NULL, '2020-12-28 12:51:43', '2020-12-28 12:51:43', NULL),
(5, NULL, 'iron', NULL, '2020-12-28 12:51:53', '2020-12-28 12:51:53', NULL),
(6, NULL, 'Colour', NULL, '2020-12-28 12:52:00', '2020-12-28 12:52:00', NULL),
(7, '2', 'Ambuja', 'ambuja cement', '2020-12-28 13:00:27', '2020-12-28 13:00:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `collection_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2020_12_20_000001_create_media_table', 1),
(6, '2020_12_20_000002_create_permissions_table', 1),
(7, '2020_12_20_000003_create_bidder_managers_table', 1),
(8, '2020_12_20_000004_create_tender_categories_table', 1),
(9, '2020_12_20_000005_create_user_alerts_table', 1),
(10, '2020_12_20_000006_create_crm_documents_table', 1),
(11, '2020_12_20_000007_create_crm_notes_table', 1),
(12, '2020_12_20_000008_create_crm_customers_table', 1),
(13, '2020_12_20_000009_create_crm_statuses_table', 1),
(14, '2020_12_20_000011_create_roles_table', 1),
(15, '2020_12_20_000012_create_role_user_pivot_table', 1),
(16, '2020_12_20_000013_create_user_user_alert_pivot_table', 1),
(17, '2020_12_20_000014_create_permission_role_pivot_table', 1),
(18, '2020_12_20_000015_add_relationship_fields_to_crm_customers_table', 1),
(19, '2020_12_20_000016_add_relationship_fields_to_crm_notes_table', 1),
(20, '2020_12_20_000017_add_relationship_fields_to_crm_documents_table', 1),
(21, '2020_12_20_000018_add_approval_fields', 1),
(22, '2020_12_28_000007_create_materials_table', 2),
(24, '2021_01_02_074507_create_tender_map_category_table', 3),
(31, '2021_01_02_080734_create_tender_map_document_table', 6),
(33, '2021_01_11_175626_create_bid_table', 7),
(34, '2021_01_02_074523_create_tender_map_materials_table', 8),
(35, '2021_01_02_071954_create_tender_table', 9),
(36, '2021_01_26_154214_create_tender_invitations_table', 10);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_management_access', NULL, NULL, NULL),
(2, 'permission_create', NULL, NULL, NULL),
(3, 'permission_edit', NULL, NULL, NULL),
(4, 'permission_show', NULL, NULL, NULL),
(5, 'permission_delete', NULL, NULL, NULL),
(6, 'permission_access', NULL, NULL, NULL),
(7, 'role_create', NULL, NULL, NULL),
(8, 'role_edit', NULL, NULL, NULL),
(9, 'role_show', NULL, NULL, NULL),
(10, 'role_delete', NULL, NULL, NULL),
(11, 'role_access', NULL, NULL, NULL),
(12, 'user_create', NULL, NULL, NULL),
(13, 'user_edit', NULL, NULL, NULL),
(14, 'user_show', NULL, NULL, NULL),
(15, 'user_delete', NULL, NULL, NULL),
(16, 'user_access', NULL, NULL, NULL),
(17, 'user_alert_create', NULL, NULL, NULL),
(18, 'user_alert_show', NULL, NULL, NULL),
(19, 'user_alert_delete', NULL, NULL, NULL),
(20, 'user_alert_access', NULL, NULL, NULL),
(21, 'tender_category_create', NULL, NULL, NULL),
(22, 'tender_category_edit', NULL, NULL, NULL),
(23, 'tender_category_show', NULL, NULL, NULL),
(24, 'tender_category_delete', NULL, NULL, NULL),
(25, 'tender_category_access', NULL, NULL, NULL),
(26, 'bidder_manager_create', NULL, NULL, NULL),
(27, 'bidder_manager_edit', NULL, NULL, NULL),
(28, 'bidder_manager_show', NULL, NULL, NULL),
(29, 'bidder_manager_delete', NULL, NULL, NULL),
(30, 'bidder_manager_access', NULL, NULL, NULL),
(31, 'material_create', NULL, NULL, NULL),
(32, 'material_edit', NULL, NULL, NULL),
(33, 'material_show', NULL, NULL, NULL),
(34, 'material_delete', NULL, NULL, NULL),
(35, 'material_access', NULL, NULL, NULL),
(36, 'profile_password_edit', NULL, NULL, NULL),
(37, 'tender_invitation', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  KEY `role_id_fk_2825589` (`role_id`),
  KEY `permission_id_fk_2825589` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 36),
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 36),
(1, 37);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, NULL, NULL, NULL),
(2, 'Bidder', NULL, NULL, NULL, NULL),
(3, 'Organization Tender Admin', NULL, NULL, NULL, NULL),
(4, 'Tender Board Secretary', NULL, NULL, NULL, NULL),
(5, 'QC Group', NULL, NULL, NULL, NULL),
(6, 'Special Verification', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  KEY `user_id_fk_2825598` (`user_id`),
  KEY `role_id_fk_2825598` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 2),
(1, 1),
(2, 2),
(3, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tender`
--

DROP TABLE IF EXISTS `tender`;
CREATE TABLE IF NOT EXISTS `tender` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tender_reference_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tender_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tender_discription` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `open_date` datetime NOT NULL,
  `close_date` datetime NOT NULL,
  `status` int NOT NULL,
  `type` int NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tender_tender_reference_no_unique` (`tender_reference_no`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tender`
--

INSERT INTO `tender` (`id`, `tender_reference_no`, `tender_title`, `tender_discription`, `category_id`, `open_date`, `close_date`, `status`, `type`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '300245', 'test', 'fdsfsd', '1', '2021-01-15 00:00:00', '2021-01-15 00:00:00', 0, 0, 1, '2021-01-15 06:34:53', '2021-01-15 08:24:48', NULL),
(2, 'tender1', 'tender1', 'This is a testing tender created by the developer for testing purposes.', '3', '2021-01-26 00:00:00', '2021-01-31 00:00:00', 1, 0, 1, '2021-01-26 10:38:41', '2021-01-26 10:42:44', NULL),
(3, 'tender2', 'tender2', 'This is a testing tender created by the developer for testing purposes.', '3', '2021-01-26 00:00:00', '2021-01-31 00:00:00', 1, 0, 1, '2021-01-26 10:38:41', '2021-01-26 10:39:53', NULL),
(5, 'tender3', 'tender3', 'asdkjasjdklajsd', '3', '2021-01-27 10:48:00', '2021-01-27 10:48:00', 1, 1, 1, '2021-01-27 05:18:04', '2021-01-27 05:18:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tender_categories`
--

DROP TABLE IF EXISTS `tender_categories`;
CREATE TABLE IF NOT EXISTS `tender_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` int DEFAULT NULL,
  `category_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tender_categories_category_code_unique` (`category_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tender_categories`
--

INSERT INTO `tender_categories` (`id`, `parent_id`, `category_code`, `category_name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, '001B', 'Building', NULL, '2020-12-24 12:31:47', '2020-12-24 12:31:47', NULL),
(2, 1, '002', 'Floring', NULL, '2020-12-24 12:42:37', '2020-12-24 12:42:37', NULL),
(3, NULL, 'fgh', 'main', NULL, '2020-12-26 03:40:18', '2020-12-26 03:40:18', NULL),
(4, 3, '6655', 'sub', NULL, '2020-12-26 03:40:42', '2020-12-26 03:40:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tender_invitations`
--

DROP TABLE IF EXISTS `tender_invitations`;
CREATE TABLE IF NOT EXISTS `tender_invitations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tender_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tender_invitations_tender_id_foreign` (`tender_id`),
  KEY `tender_invitations_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tender_invitations`
--

INSERT INTO `tender_invitations` (`id`, `tender_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 3, NULL, '2021-01-27 01:03:42', '2021-01-27 01:03:42'),
(2, 3, 3, NULL, '2021-01-27 01:04:24', '2021-01-27 01:04:24'),
(3, 3, 3, NULL, '2021-01-27 01:22:54', '2021-01-27 01:22:54'),
(4, 3, 3, NULL, '2021-01-27 01:23:13', '2021-01-27 01:23:13'),
(5, 3, 3, NULL, '2021-01-27 01:23:45', '2021-01-27 01:23:45'),
(6, 3, 3, NULL, '2021-01-27 01:33:59', '2021-01-27 01:33:59'),
(7, 3, 2, NULL, '2021-01-27 01:34:05', '2021-01-27 01:34:05'),
(8, 2, 3, NULL, '2021-01-27 01:34:10', '2021-01-27 01:34:10'),
(9, 2, 2, NULL, '2021-01-27 01:34:15', '2021-01-27 01:34:15'),
(10, 3, 3, NULL, '2021-01-27 01:54:09', '2021-01-27 01:54:09'),
(11, 3, 3, NULL, '2021-01-27 01:55:30', '2021-01-27 01:55:30'),
(12, 3, 2, NULL, '2021-01-27 01:55:36', '2021-01-27 01:55:36'),
(13, 2, 3, NULL, '2021-01-27 01:55:41', '2021-01-27 01:55:41'),
(14, 2, 2, NULL, '2021-01-27 01:55:47', '2021-01-27 01:55:47'),
(15, 3, 3, NULL, '2021-01-27 02:10:40', '2021-01-27 02:10:40'),
(16, 3, 3, NULL, '2021-01-27 02:59:51', '2021-01-27 02:59:51'),
(17, 3, 3, NULL, '2021-01-27 03:00:03', '2021-01-27 03:00:03'),
(18, 3, 3, NULL, '2021-01-27 03:01:13', '2021-01-27 03:01:13'),
(19, 3, 3, NULL, '2021-01-27 03:01:21', '2021-01-27 03:01:21'),
(20, 3, 3, NULL, '2021-01-27 03:06:54', '2021-01-27 03:06:54'),
(21, 3, 3, NULL, '2021-01-27 04:10:39', '2021-01-27 04:10:39'),
(22, 3, 3, NULL, '2021-01-27 04:14:19', '2021-01-27 04:14:19'),
(23, 3, 3, NULL, '2021-01-27 04:16:08', '2021-01-27 04:16:08'),
(24, 3, 3, NULL, '2021-01-27 04:17:36', '2021-01-27 04:17:36'),
(25, 3, 3, NULL, '2021-01-27 04:53:50', '2021-01-27 04:53:50'),
(26, 3, 3, NULL, '2021-01-27 04:57:46', '2021-01-27 04:57:46'),
(27, 3, 3, NULL, '2021-01-27 04:58:32', '2021-01-27 04:58:32'),
(28, 3, 3, NULL, '2021-01-27 05:02:36', '2021-01-27 05:02:36'),
(29, 3, 3, NULL, '2021-01-27 05:10:46', '2021-01-27 05:10:46'),
(30, 3, 3, NULL, '2021-01-27 05:11:34', '2021-01-27 05:11:34'),
(31, 3, 3, NULL, '2021-01-27 05:20:32', '2021-01-27 05:20:32'),
(32, 3, 3, NULL, '2021-01-27 05:21:16', '2021-01-27 05:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `tender_map_category`
--

DROP TABLE IF EXISTS `tender_map_category`;
CREATE TABLE IF NOT EXISTS `tender_map_category` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tender_id` int NOT NULL,
  `tender_category_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tender_map_document`
--

DROP TABLE IF EXISTS `tender_map_document`;
CREATE TABLE IF NOT EXISTS `tender_map_document` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tender_id` int DEFAULT '0',
  `bidder_id` int DEFAULT '0',
  `document` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_orignal_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tender_map_document_document_unique` (`document`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tender_map_document`
--

INSERT INTO `tender_map_document` (`id`, `tender_id`, `bidder_id`, `document`, `document_orignal_name`, `document_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 45, 0, '161026758913363945775ffabbc54cc11.docx', '1. Anniversary Cake Red Little Heart With Name.docx', 1, '2021-01-10 03:03:09', '2021-01-10 03:03:09', NULL),
(2, 45, 0, '16102675893821952165ffabbc57298a.docx', 'GJ10W6706 FEE BILL.docx', 1, '2021-01-10 03:03:09', '2021-01-10 03:03:09', NULL),
(3, 45, 0, '16102675898818654175ffabbc579eba.docx', 'privacy-policy of mynameonpics.com.docx', 1, '2021-01-10 03:03:09', '2021-01-10 03:03:09', NULL),
(5, 45, 4, '161039325410835103005ffca6a620f26.docx', 'GJ10W6706 FEE BILL.docx', 0, '2021-01-11 13:57:34', '2021-01-11 13:57:34', NULL),
(6, 45, 4, '16103932546117005735ffca6a63e005.docx', 'On Page Suggestion of mynameonpics.com.docx', 0, '2021-01-11 13:57:34', '2021-01-13 13:31:39', '2021-01-13 13:31:39'),
(7, 45, 4, '161039325414854743265ffca6a65bc9c.docx', 'privacy-policy of mynameonpics.com.docx', 0, '2021-01-11 13:57:34', '2021-01-11 13:57:34', NULL),
(8, 45, 5, '161039588516114258345ffcb0ed28851.docx', 'I Love You new.docx', 0, '2021-01-11 14:41:25', '2021-01-11 14:41:25', NULL),
(9, 45, 5, '161047285213745487815ffddd94ac7c6.docx', 'GJ10W6706 FEE BILL.docx', 0, '2021-01-12 12:04:12', '2021-01-12 12:04:12', NULL),
(10, 45, NULL, '16104729872004762635ffdde1b4ee2e.docx', 'GJ10W6706 FEE BILL.docx', 0, '2021-01-12 12:06:27', '2021-01-12 12:06:27', NULL),
(11, 45, NULL, '16104730129653727385ffdde34dcd6d.docx', 'GJ10W6706 FEE BILL.docx', 0, '2021-01-12 12:06:52', '2021-01-12 12:06:52', NULL),
(12, 45, NULL, '161047413820105772425ffde29aca810.docx', '1. I love you card with name.docx', 0, '2021-01-12 12:25:38', '2021-01-13 13:31:04', '2021-01-13 13:31:04'),
(13, 45, 6, '1610474640434913425ffde490984ca.docx', 'GJ10W6706 FEE BILL.docx', 0, '2021-01-12 12:34:00', '2021-01-13 13:29:16', '2021-01-13 13:29:16'),
(14, 45, 7, '161047470018066189435ffde4ccb0099.docx', 'GJ10W6706 FEE BILL.docx', 0, '2021-01-12 12:35:00', '2021-01-13 12:46:55', '2021-01-13 12:46:55'),
(15, 46, 0, '161047891514883948145ffdf5437271a.docx', 'GJ10W6706 FEE BILL.docx', 1, '2021-01-12 13:45:15', '2021-01-12 13:45:15', NULL),
(16, 46, 0, '16104791322638029485ffdf61cebe3a.docx', 'On Page Suggestion of mynameonpics.com (3).docx', 1, '2021-01-12 13:48:52', '2021-01-12 13:48:52', NULL),
(17, 46, 0, '161047916520607565405ffdf63da6c41.docx', 'htaccess of mynameonpics.com.docx', 1, '2021-01-12 13:49:25', '2021-01-13 12:26:47', '2021-01-13 12:26:47'),
(18, 1, 0, '1610712293279094682600184e5395d6.docx', '1. I love you card with name.docx', 1, '2021-01-15 06:34:53', '2021-01-15 08:24:14', '2021-01-15 08:24:14'),
(19, 1, 0, '1610712293101471070600184e54bace.docx', 'GJ10W6706 FEE BILL.docx', 1, '2021-01-15 06:34:53', '2021-01-15 08:24:07', '2021-01-15 08:24:07'),
(20, 45, 8, '16107133102115050580600188deeae71.docx', '1. I love you card with name.docx', 0, '2021-01-15 06:51:50', '2021-01-15 06:51:50', NULL),
(21, 45, 9, '1610713446711212169600189666be4c.docx', 'GJ10W6706 FEE BILL.docx', 0, '2021-01-15 06:54:06', '2021-01-15 06:54:06', NULL),
(22, 1, 10, '1610713854146621583760018afe5f3bd.docx', 'GJ10W6706 FEE BILL.docx', 0, '2021-01-15 07:00:54', '2021-01-15 08:24:02', '2021-01-15 08:24:02'),
(23, 1, 0, '1610718888168715645460019ea867d48.docx', 'GJ10W6706 FEE BILL.docx', 1, '2021-01-15 08:24:48', '2021-01-15 08:24:48', NULL),
(24, 1, NULL, '16107190288161385760019f3415016.docx', 'On Page Suggestion of mynameonpics.com (1).docx', 0, '2021-01-15 08:27:08', '2021-01-15 08:27:08', NULL),
(25, 1, 11, '161071913020276719760019f9af1d65.docx', 'On Page Suggestion of mynameonpics.com (2).docx', 0, '2021-01-15 08:28:50', '2021-01-15 08:28:50', NULL),
(26, 2, 0, '161167732148296235960103e89c3df7.pdf', 'Marcom Analyzer.pdf', 1, '2021-01-26 10:38:41', '2021-01-26 10:38:41', NULL),
(27, 3, 12, '1611730904198706040660110fd80c3ee.pdf', 'Marcom Analyzer.pdf', 0, '2021-01-27 01:31:44', '2021-01-27 01:31:44', NULL),
(28, 5, 0, '16117444841730938226601144e44ca4b.pdf', 'sample.pdf', 1, '2021-01-27 05:18:04', '2021-01-27 05:18:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tender_map_materials`
--

DROP TABLE IF EXISTS `tender_map_materials`;
CREATE TABLE IF NOT EXISTS `tender_map_materials` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tender_id` int NOT NULL,
  `tender_materials_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tender_map_materials`
--

INSERT INTO `tender_map_materials` (`id`, `tender_id`, `tender_materials_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 46, 7, '2021-01-12 13:45:15', '2021-01-12 13:45:15', NULL),
(2, 1, 7, '2021-01-15 06:34:53', '2021-01-15 06:34:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved` tinyint(1) DEFAULT '0',
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_reg_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_contact_person` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `contact_no_1`, `contact_no_2`, `status`, `email_verified_at`, `remember_token`, `approved`, `mobile`, `otp`, `supplier_name`, `company_reg_number`, `company_contact_person`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@admin.com', '', '$2y$10$.Gxi6Brq0ZFn1Af4fB4Beeh7kUtM1RG60g82gJ.pcq1GsLP2m8KC6', '', '', NULL, NULL, 'nT0wVXicQQd3ilw8YSGXsSHfKrrdfbXbcoAl1IdNcqePAkrxzKETeTOiR0g3', 1, '1234567899', NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-28 10:30:23', NULL),
(2, NULL, 'test@grr.la', NULL, '$2y$10$YpV0b5Y2E5gk/GhWzQ8LjOkb4S2xKY2ZJX6Xe0q4FuUY81W2vxQwa', NULL, NULL, '1', NULL, NULL, 0, '12323213', NULL, 'aasdf', 'sssdf', 'sdd', 'sdsdf', '2020-12-24 12:45:52', '2020-12-24 12:45:52', NULL),
(3, NULL, 'test1@grr.la', NULL, '$2y$10$OfrdBYmpnI/DpUDpJJQ38OFIsRbJXl9ELiRkyo2GJIdgpTczs9amu', NULL, NULL, '1', NULL, NULL, 1, '8320050692', NULL, 'Betainfotech', 'LKO05487', 'Dilip', 'surat', '2020-12-28 13:29:33', '2021-01-27 23:51:26', NULL),
(4, NULL, 'test2@grr.la', NULL, '$2y$10$eBqeVyMqenCkaELtE6GhD.eP3TxaEilHqsON9TZSDl7DeiIkPYDdi', NULL, NULL, '1', NULL, NULL, 1, '9898656532', NULL, 'vivek', 'VIK0021', 'Palak Softtech', 'rajkot', '2020-12-28 13:38:47', '2020-12-28 13:38:47', NULL),
(5, 'Jitendra Prajapati', 'bider@grr.la', NULL, '$2y$10$KYL.MMh.OrPTapLCYDoNTuvtXeuR7YFY2HaWgEc2abFWHV7duFqGG', NULL, NULL, '1', NULL, NULL, 1, '9173527938', NULL, NULL, NULL, NULL, 'Navsari', '2021-01-27 22:25:50', '2021-01-27 22:25:50', NULL),
(6, NULL, 'bider1@grr.la', NULL, '$2y$10$PIet/K9NFzq75He.qxby9elsNr6YfbDkSsWEIxQpTUDEHaJKqBVNi', NULL, NULL, '1', NULL, NULL, 1, '1234567891', NULL, 'Jitendra Prajapati', '12346abc', 'dinesh', 'Navsari', '2021-01-27 22:48:35', '2021-01-27 23:02:02', NULL),
(7, 'Rahul Radadiya', 'Rahulradadiya33@gmail.com', NULL, '$2y$10$XIaRbKYUAxnFEJi52kMqVejTi9G3YlBYodQZVCwus.oyykDKKmEWy', NULL, NULL, NULL, NULL, NULL, 1, '9998891514', NULL, 'Rahul', 'Rahul', 'Rahul', '386 Riddhi Siddhi residency', '2021-01-27 23:31:03', '2021-01-28 10:29:38', NULL),
(8, 'Dilip', 'dilip@gmail.com', 'dilip', '$2y$10$eBqeVyMqenCkaELtE6GhD.eP3TxaEilHqsON9TZSDl7DeiIkPYDdi', NULL, NULL, '1', NULL, NULL, 1, '9429730066', NULL, 'vivek', 'VIK0021', 'Palak Softtech', 'rajkot', '2020-12-28 13:38:47', '2021-01-28 10:36:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_alerts`
--

DROP TABLE IF EXISTS `user_alerts`;
CREATE TABLE IF NOT EXISTS `user_alerts` (
  `id` bigint UNSIGNED NOT NULL,
  `alert_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alert_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_user_alert`
--

DROP TABLE IF EXISTS `user_user_alert`;
CREATE TABLE IF NOT EXISTS `user_user_alert` (
  `user_alert_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  KEY `user_alert_id_fk_2825686` (`user_alert_id`),
  KEY `user_id_fk_2825686` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
