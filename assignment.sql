-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 14, 2025 at 06:12 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `name`, `price`, `image`, `description`, `created_at`, `updated_at`) VALUES
(8, 'Sunset Dolphin Cruise', 300, 'activities/bODQzvFdBEB6YR6PQEYwYGBTztnJ3FZWpFZWjqXK.jpg', 'A breathtaking boat excursion where guests can witness playful dolphins while enjoying the golden hues of the sunset across the ocean horizon.', '2025-12-05 14:37:51', '2025-12-05 14:37:51'),
(9, 'Guided Snorkeling', 200, 'activities/zlQeopcuW2Ilc4Xnz76AOddDoMrXWJ0wS3AyQenG.jpg', 'Explore vibrant coral reefs and marine life with a trained guide. Suitable for beginners and seasoned swimmers looking for an unforgettable underwater experience.', '2025-12-05 14:42:05', '2025-12-05 14:42:05'),
(10, 'Canoe Ride', 50, 'activities/h1EzYoCyzSo197xqAAl8CDWqMsGG5RShtbvoERYd.jpg', 'Enjoy a peaceful paddle around the island in a  canoe. A relaxing activity that lets you explore the lagoon at your own pace.', '2025-12-05 14:45:08', '2025-12-05 14:45:08'),
(12, '234', 7, 'activities/AXDT0MtxgoBBte4CUHjhLrZfAr53ydnJNrSERBbq.jpg', '34234', '2025-12-11 18:28:14', '2025-12-11 18:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `activity_bookings`
--

DROP TABLE IF EXISTS `activity_bookings`;
CREATE TABLE IF NOT EXISTS `activity_bookings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `activity_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'booked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_bookings_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_bookings`
--

INSERT INTO `activity_bookings` (`id`, `user_id`, `activity_name`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'Jet Ski Ride', '2025-11-28', 'cancelled', '2025-11-27 18:48:45', '2025-11-27 18:50:09'),
(2, 2, 'Sunset Dolphin Cruise', '2025-12-27', 'cancelled', '2025-12-05 18:55:09', '2025-12-05 19:30:42'),
(3, 2, 'Guided Snorkeling', '2025-12-17', 'cancelled', '2025-12-05 18:55:26', '2025-12-06 01:33:55'),
(4, 11, 'Guided Snorkeling', '2025-12-17', 'cancelled', '2025-12-06 12:41:13', '2025-12-06 13:09:55'),
(5, 2, '234', '2025-12-26', 'cancelled', '2025-12-11 18:31:46', '2025-12-11 18:32:04'),
(6, 7, '234', '2025-12-28', 'cancelled', '2025-12-11 18:32:59', '2025-12-11 18:33:06'),
(7, 13, 'Guided Snorkeling', '2025-12-13', 'booked', '2025-12-11 18:59:49', '2025-12-11 18:59:49'),
(8, 17, '234', '2025-12-29', 'booked', '2025-12-12 22:44:58', '2025-12-12 22:44:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ferry_ids`
--

DROP TABLE IF EXISTS `ferry_ids`;
CREATE TABLE IF NOT EXISTS `ferry_ids` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ferry_ids_code_unique` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ferry_ids`
--

INSERT INTO `ferry_ids` (`id`, `code`, `created_at`, `updated_at`) VALUES
(1, 'FID0001', '2025-12-12 22:15:06', '2025-12-12 22:15:06'),
(2, 'FID0002', '2025-12-12 22:15:08', '2025-12-12 22:15:08'),
(3, 'FID0003', '2025-12-12 22:15:08', '2025-12-12 22:15:08'),
(4, 'FID0004', '2025-12-12 22:15:09', '2025-12-12 22:15:09'),
(5, 'FID0005', '2025-12-12 22:46:58', '2025-12-12 22:46:58'),
(6, 'FID0006', '2025-12-12 22:46:59', '2025-12-12 22:46:59'),
(7, 'FID0007', '2025-12-12 22:46:59', '2025-12-12 22:46:59'),
(8, 'FID0008', '2025-12-12 22:47:00', '2025-12-12 22:47:00'),
(9, 'FID0009', '2025-12-12 22:47:02', '2025-12-12 22:47:02'),
(10, 'FID0010', '2025-12-12 22:47:03', '2025-12-12 22:47:03'),
(11, 'FID0011', '2025-12-12 22:49:02', '2025-12-12 22:49:02');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

DROP TABLE IF EXISTS `hotels`;
CREATE TABLE IF NOT EXISTS `hotels` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_10_21_084824_create_hotels_table', 1),
(6, '2025_11_18_062630_create_password_reset_tokens_table', 1),
(7, '2025_11_21_225128_create_room_bookings_table', 1),
(8, '2025_11_21_230248_create_activity_bookings_table', 1),
(9, '2025_11_21_230334_create_spa_bookings_table', 1),
(10, '2025_11_29_154621_create_rooms_table', 2),
(11, '2025_11_29_154825_create_activities_table', 2),
(12, '2025_11_29_154851_create_spa_items_table', 2),
(13, '2025_11_30_164105_create_spa_services_table', 3),
(14, '2025_12_01_185229_add_image_to_rooms_table', 3),
(15, '2025_12_04_094924_add_staff_fields_to_users_table', 4),
(16, '2025_12_04_114805_add_image_path_to_activities_table', 5),
(17, '2025_12_04_120914_rename_image_path_column_in_activities_table', 6),
(19, '2025_12_05_154954_add_guests_to_room_bookings_table', 7),
(20, '2025_12_05_162910_add_people_to_spa_bookings_table', 8),
(21, '2025_12_12_160245_create_ferry_ids_table', 9),
(22, '2025_12_12_160319_add_ferry_code_to_users_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `capacity` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `price`, `capacity`, `description`, `image`, `created_at`, `updated_at`) VALUES
(7, 'Oceanfront Serenity Suite', 500, 3, 'A luxurious ocean-facing suite featuring floor-to-ceiling windows, a private balcony, and handcrafted wooden interiors. Designed for guests who seek peaceful mornings and breathtaking sunsets.', 'rooms/CSwJ2gvurjNjwjAGDuaVZGMzYCrWbKgEgpXiN8Ku.jpg', '2025-12-05 14:15:22', '2025-12-05 14:15:22'),
(9, 'Garden Deluxe Room', 650, 3, 'A cozy and elegant room overlooking lush tropical gardens. Equipped with premium bedding, ambient lighting, and a minimalist design that creates a soothing environment.', 'rooms/X9GE4eHo0Bh3DxASJEkbzXqzyLTgQcWxNmjYd5eu.jpg', '2025-12-05 14:20:16', '2025-12-05 14:20:16'),
(11, 'Family Comfort Villa', 850, 6, 'A spacious villa ideal for families, complete with a living area, modern furnishings, and direct access to outdoor recreational spaces. Perfect for longer stays and group travelers.', 'rooms/CPkS6yZ78CF2M4qihOjvqefHXorA99V5LsjtqGgK.jpg', '2025-12-05 14:22:50', '2025-12-05 14:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `room_bookings`
--

DROP TABLE IF EXISTS `room_bookings`;
CREATE TABLE IF NOT EXISTS `room_bookings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `room_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `guests` int NOT NULL DEFAULT '1',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'booked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `room_bookings_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_bookings`
--

INSERT INTO `room_bookings` (`id`, `user_id`, `room_name`, `check_in`, `check_out`, `guests`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Deluxe Room', '2025-11-28', '2025-11-29', 1, 'cancelled', '2025-11-27 12:48:30', '2025-12-06 01:34:51'),
(2, 4, 'Deluxe Room', '2025-11-27', '2025-11-28', 1, 'cancelled', '2025-11-27 18:44:36', '2025-12-04 16:35:10'),
(3, 2, 'Oceanfront Serenity Suite', '2025-12-26', '2026-01-03', 1, 'cancelled', '2025-12-05 18:36:01', '2025-12-05 19:27:33'),
(4, 2, 'Oceanfront Serenity Suite', '2025-12-06', '2025-12-25', 3, 'cancelled', '2025-12-06 01:18:56', '2025-12-06 01:19:13'),
(5, 2, 'room test', '2025-12-17', '2025-12-27', 2, 'cancelled', '2025-12-06 02:29:04', '2025-12-06 02:29:54'),
(6, 2, 'Oceanfront Serenity Suite', '2025-12-19', '2025-12-31', 2, 'booked', '2025-12-06 09:55:09', '2025-12-06 09:55:09'),
(7, 11, 'Oceanfront Serenity Suite', '2025-12-27', '2025-12-30', 2, 'cancelled', '2025-12-06 12:40:58', '2025-12-06 13:09:58'),
(8, 11, 'Oceanfront Serenity Suite', '2025-12-27', '2025-12-30', 2, 'cancelled', '2025-12-06 13:10:24', '2025-12-11 03:46:08'),
(9, 7, 'Oceanfront Serenity Suite', '2025-12-13', '2025-12-14', 2, 'booked', '2025-12-06 15:25:17', '2025-12-06 15:25:17'),
(10, 7, 'Oceanfront Serenity Suite', '2026-01-01', '2026-01-10', 3, 'cancelled', '2025-12-11 03:47:33', '2025-12-11 18:07:42'),
(11, 7, 'Oceanfront Serenity Suite', '2025-12-27', '2025-12-30', 3, 'booked', '2025-12-11 18:11:30', '2025-12-11 18:11:30'),
(12, 13, 'Family Comfort Villa', '2025-12-12', '2025-12-14', 4, 'booked', '2025-12-11 18:58:12', '2025-12-11 18:58:12'),
(13, 2, 'Oceanfront Serenity Suite', '2026-01-01', '2026-01-03', 2, 'booked', '2025-12-11 19:06:49', '2025-12-11 19:06:49'),
(14, 17, 'Oceanfront Serenity Suite', '2025-12-27', '2025-12-29', 2, 'booked', '2025-12-12 22:44:40', '2025-12-12 22:44:40');

-- --------------------------------------------------------

--
-- Table structure for table `spa_bookings`
--

DROP TABLE IF EXISTS `spa_bookings`;
CREATE TABLE IF NOT EXISTS `spa_bookings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `treatment_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `people` int NOT NULL DEFAULT '1',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'booked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spa_bookings_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spa_bookings`
--

INSERT INTO `spa_bookings` (`id`, `user_id`, `treatment_name`, `date`, `people`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Relaxing Massage', '2025-11-28', 1, 'cancelled', '2025-11-27 12:48:53', '2025-12-04 16:35:12'),
(2, 2, '123132', '2025-12-04', 1, 'cancelled', '2025-12-04 16:45:15', '2025-12-05 19:31:36'),
(3, 2, 'Island Signature Massage', '2025-12-17', 1, 'cancelled', '2025-12-05 18:42:56', '2025-12-05 19:27:28'),
(4, 2, 'Island Signature Massage', '2025-12-17', 1, 'cancelled', '2025-12-05 18:52:33', '2025-12-06 01:33:50'),
(5, 2, 'Hot Stone Therapy', '2025-12-26', 1, 'cancelled', '2025-12-05 18:52:40', '2025-12-05 19:29:19'),
(6, 7, 'Island Signature Massage', '2025-12-28', 1, 'booked', '2025-12-11 18:13:36', '2025-12-11 18:13:36'),
(7, 13, 'Hot Stone Therapy', '2025-12-12', 1, 'booked', '2025-12-11 18:59:19', '2025-12-11 18:59:19'),
(8, 13, 'Hot Stone Therapy', '2025-12-12', 1, 'booked', '2025-12-11 19:00:24', '2025-12-11 19:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `spa_items`
--

DROP TABLE IF EXISTS `spa_items`;
CREATE TABLE IF NOT EXISTS `spa_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spa_services`
--

DROP TABLE IF EXISTS `spa_services`;
CREATE TABLE IF NOT EXISTS `spa_services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(8,2) NOT NULL,
  `image_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spa_services`
--

INSERT INTO `spa_services` (`id`, `name`, `description`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(4, 'Island Signature Massage', 'A deeply relaxing full-body massage using locally infused oils to relieve tension and rejuvenate your muscles. A perfect blend of island tradition and modern wellness.', 150.00, 'spa/qpQ4LWUeTB80jcq949CWN5Y8DqADPImFSAtGnxUX.jpg', '2025-12-05 14:30:03', '2025-12-05 14:30:03'),
(5, 'Coconut Hydration Facial', 'A refreshing facial treatment using pure coconut extracts to restore hydration, brighten the skin, and bring out a natural, youthful glow.', 200.00, 'spa/gN5PKwvuyUg6hBTWEJiXMZQ9nmwuaPQPSQyHUkEO.jpg', '2025-12-05 14:30:54', '2025-12-05 14:30:54'),
(7, 'Hot Stone Therapy', 'A therapeutic wellness treatment that uses heated stones to release muscle tightness, improve circulation, and provide deep relaxation throughout the body.', 250.00, 'spa/ZbxQmOYpNoKUTvcH4G4N07QZRRyJ9uASKoVlHe5A.jpg', '2025-12-05 14:35:01', '2025-12-05 14:35:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `ferry_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `ferry_code`, `dob`, `gender`, `nationality`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'sageasta', 'sage@123.com', NULL, '$2y$10$eW12NG9eAoKzBXAHHViMM.QVAMkrMEUu6lozCLeFvD3sHWBZHRkem', 'customer', NULL, NULL, NULL, NULL, NULL, '2025-12-04 14:28:18', '2025-12-04 14:28:18'),
(2, 'zayaan', 'zayaan@gmail.com', NULL, '$2y$10$1Cgs7XWCxZ.YPD9PF3/cI.dg3pkFQZ7Xn.LhFNaxXz6illyxROxYq', 'customer', NULL, NULL, NULL, NULL, NULL, '2025-11-27 06:32:03', '2025-11-27 06:32:03'),
(3, 'zayaan2', 'zayaan2@gmail.com', NULL, '$2y$10$85NFII3h2sc5ftkW5EiphOX3RIGRUIYTiITpoav3nvwNZZUHnq38q', 'customer', NULL, NULL, NULL, NULL, NULL, '2025-11-27 12:47:57', '2025-11-27 12:47:57'),
(4, 'zayaan ali', 'zayaan3@gmail.com', NULL, '$2y$10$CRbcfErfAGB3cwy5TR5o6.BE1Jlbges656kb4zJbizYrzEFGlpNSC', 'customer', NULL, NULL, NULL, NULL, NULL, '2025-11-27 18:43:29', '2025-11-27 18:43:29'),
(6, 'Admin', 'admin@mello.com', NULL, '$2y$10$C5VS61zhatyMtthvsq6Zjere3K7ZKD2ZfWYuKG8Smzal2yyZEJbWe', 'admin', NULL, NULL, NULL, NULL, NULL, '2025-11-30 00:58:08', '2025-11-30 00:58:08'),
(13, 'zayaanali', 'zayaan123@gmail.com', NULL, '$2y$10$kQvm4qKc3PrV18Q50Pot9.aoqu4AewbgXTolNmFL9rGrX6gfNYfYW', 'customer', NULL, NULL, NULL, NULL, NULL, '2025-12-11 18:57:29', '2025-12-11 18:57:29'),
(11, 'Alex alex', 'alex@123.com', NULL, '$2y$10$G0xne70cXVazDj31nh2jOe8OPAoS2/MRqZLp3neKzn.opE8mgkhma', 'customer', NULL, NULL, NULL, NULL, NULL, '2025-12-06 12:40:33', '2025-12-06 12:40:33'),
(12, 'zauya', 'zauya@mail.com', NULL, '$2y$10$RL3Bhjh5vPHS.ArVFbO5weajYMwp9O0563GtSAKp7aHkJNIAmts9K', 'staff', NULL, '2005-01-05', 'Female', 'Maldives', NULL, '2025-12-11 12:35:37', '2025-12-11 12:35:37'),
(14, 'Aishath Zauyaa Ali', 'zauya123@gmail.com', NULL, '$2y$10$rjiYHyOIlLoN35v4jI9Z0.2IttWgQpBvmmh/yQOKtoSS9bqTGr1Ei', 'customer', NULL, NULL, NULL, NULL, NULL, '2025-12-11 19:02:04', '2025-12-11 19:02:04'),
(15, 'maeesh', 'maeesh@gmail.com', NULL, '$2y$10$b4gcGJ.6pDedq3CqUS.6hO.56T1Ecpq75torvBH./mg6RWWD3mdE6', 'staff', NULL, '1999-10-13', 'Male', 'Maldives', NULL, '2025-12-11 19:04:40', '2025-12-11 19:04:40'),
(16, 'zayaanaliali', 'zayaanaliali@gmail.com', NULL, '$2y$10$NjG4.MuDcRDojBHz4N4uzeQeR4lSj13ck95HtvObA6QM2TOkzivoK', 'customer', NULL, NULL, NULL, NULL, NULL, '2025-12-12 22:16:12', '2025-12-12 22:16:12'),
(17, 'customer1', 'customer1@gmail.com', NULL, '$2y$10$AA7V3k1TyKzonXg2iaDBCeTQ/PmX44eQPwycvgW0AN84KjsgJyPKm', 'customer', 'FID0001', NULL, NULL, NULL, NULL, '2025-12-12 22:43:01', '2025-12-12 22:43:01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
