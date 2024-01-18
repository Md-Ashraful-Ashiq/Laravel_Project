-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2024 at 10:10 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vbot`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `login_time` timestamp NULL DEFAULT NULL,
  `logout_time` timestamp NULL DEFAULT NULL,
  `total_login_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `user_id`, `login_time`, `logout_time`, `total_login_time`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-12-15 01:22:44', '2023-12-15 01:22:58', '00:00:14', '2023-12-15 01:22:44', '2023-12-15 01:22:58'),
(2, 1, '2023-12-15 01:23:24', '2023-12-15 01:23:45', '00:00:21', '2023-12-15 01:23:24', '2023-12-15 01:23:45'),
(3, 1, '2023-12-15 01:27:40', '2023-12-15 01:28:17', '00:00:37', '2023-12-15 01:27:40', '2023-12-15 01:28:17'),
(4, 3, '2023-12-15 01:28:40', '2023-12-15 01:29:00', '00:00:20', '2023-12-15 01:28:40', '2023-12-15 01:29:00'),
(6, 1, '2023-12-16 02:25:36', '2023-12-16 02:27:53', '00:01:37', '2023-12-16 02:25:36', '2023-12-16 02:27:53'),
(7, 1, '2023-12-16 02:27:58', '2023-12-16 02:28:34', '00:00:36', '2023-12-16 02:27:58', '2023-12-16 02:28:34'),
(13, 1, '2023-12-18 09:19:18', '2023-12-18 09:19:37', '00:00:19', '2023-12-18 09:19:18', '2023-12-18 09:19:37'),
(14, 3, '2023-12-18 09:19:45', '2023-12-18 09:20:20', '00:00:35', '2023-12-18 09:19:45', '2023-12-18 09:20:20'),
(15, 1, '2023-12-18 19:02:15', '2023-12-18 19:05:48', '00:02:13', '2023-12-18 19:02:15', '2023-12-18 19:05:48'),
(16, 1, '2023-12-18 19:05:53', '2023-12-18 19:05:55', '00:00:02', '2023-12-18 19:05:53', '2023-12-18 19:05:55'),
(17, 3, '2023-12-18 19:05:59', '2023-12-18 19:06:03', '00:00:04', '2023-12-18 19:05:59', '2023-12-18 19:06:03'),
(19, 2, '2023-12-18 19:09:20', '2023-12-18 19:09:24', '00:00:04', '2023-12-18 19:09:20', '2023-12-18 19:09:24'),
(20, 3, '2023-12-18 19:09:32', '2023-12-18 19:09:47', '00:00:15', '2023-12-18 19:09:32', '2023-12-18 19:09:47'),
(21, 1, '2023-12-18 19:10:32', '2023-12-18 19:10:45', '00:00:13', '2023-12-18 19:10:32', '2023-12-18 19:10:45'),
(22, 1, '2023-12-18 19:33:47', '2023-12-18 19:42:58', '00:05:51', '2023-12-18 19:33:47', '2023-12-18 19:42:58'),
(29, 1, '2023-12-20 23:50:27', '2023-12-20 23:50:47', '00:00:20', '2023-12-20 23:50:27', '2023-12-20 23:50:47'),
(31, 1, '2023-12-21 01:57:55', '2023-12-21 01:57:57', '00:00:02', '2023-12-21 01:57:55', '2023-12-21 01:57:57'),
(32, 1, '2023-12-21 01:58:28', '2023-12-21 01:58:45', '00:00:17', '2023-12-21 01:58:28', '2023-12-21 01:58:45'),
(34, 1, '2023-12-21 02:26:25', '2023-12-21 02:26:45', '00:00:20', '2023-12-21 02:26:25', '2023-12-21 02:26:45'),
(35, 1, '2023-12-21 18:46:59', '2023-12-21 18:47:56', '00:00:57', '2023-12-21 18:46:59', '2023-12-21 18:47:56'),
(36, 1, '2023-12-25 22:15:24', NULL, NULL, '2023-12-25 22:15:24', '2023-12-25 22:15:24'),
(37, 1, '2023-12-26 01:29:44', NULL, NULL, '2023-12-26 01:29:44', '2023-12-26 01:29:44'),
(38, 1, '2023-12-27 17:43:29', NULL, NULL, '2023-12-27 17:43:29', '2023-12-27 17:43:29'),
(39, 1, '2024-01-03 00:32:14', '2024-01-03 00:34:04', '00:01:10', '2024-01-03 00:32:14', '2024-01-03 00:34:04'),
(40, 1, '2024-01-03 01:55:02', '2024-01-03 01:55:41', '00:00:39', '2024-01-03 01:55:02', '2024-01-03 01:55:41'),
(41, 1, '2024-01-03 02:11:50', NULL, NULL, '2024-01-03 02:11:50', '2024-01-03 02:11:50'),
(42, 1, '2024-01-03 08:20:25', NULL, NULL, '2024-01-03 08:20:25', '2024-01-03 08:20:25'),
(43, 1, '2024-01-06 13:22:19', '2024-01-06 13:35:43', '00:08:04', '2024-01-06 13:22:19', '2024-01-06 13:35:43'),
(44, 4, '2024-01-06 13:36:53', '2024-01-06 13:37:30', '00:00:37', '2024-01-06 13:36:53', '2024-01-06 13:37:30'),
(45, 1, '2024-01-07 23:57:37', NULL, NULL, '2024-01-07 23:57:37', '2024-01-07 23:57:37'),
(46, 1, '2024-01-10 17:43:19', NULL, NULL, '2024-01-10 17:43:19', '2024-01-10 17:43:19'),
(47, 1, '2024-01-15 01:51:44', NULL, NULL, '2024-01-15 01:51:44', '2024-01-15 01:51:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2023_10_23_180955_create_roles_table', 2),
(7, '2023_10_25_083003_create_roles_table', 3),
(8, '2023_11_01_045450_add_admin_settings_to_roles_table', 3),
(9, '2023_11_08_091625_create_role_user_table', 3),
(10, '2023_11_09_013931_add_role_id_to_users', 4),
(52, '2014_10_12_000000_create_users_table', 5),
(53, '2014_10_12_100000_create_password_resets_table', 5),
(54, '2019_08_19_000000_create_failed_jobs_table', 5),
(55, '2023_12_12_175833_create_login_history_table', 5),
(56, '2023_12_20_040121_create_user_activities_table', 6),
(57, '2023_12_27_065714_add_is_operation_enabled_to_roles_table', 7),
(58, '2024_01_04_065533_add_is_audit_enabled_to_roles_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roleName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `is_settings_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `is_operation_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `is_audit_enabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `roleName`, `created_at`, `updated_at`, `is_admin_enabled`, `is_settings_enabled`, `is_operation_enabled`, `is_audit_enabled`) VALUES
(1, 'superuser', '2023-11-08 01:29:36', '2023-11-08 01:29:36', 1, 1, 0, 0),
(2, 'Ashiq', '2023-11-08 01:29:54', '2023-11-08 01:29:54', 1, 0, 0, 0),
(3, 'Sabbir', '2023-11-08 01:44:09', '2023-11-08 01:44:09', 0, 1, 0, 0),
(223, 'Superuser_Ashraf', '2023-12-28 01:53:06', '2023-12-28 01:53:06', 1, 1, 0, 0),
(226, 'sadekin', '2024-01-02 21:18:23', '2024-01-02 21:18:23', 1, 0, 1, 0),
(267, 'bvvbvvb', '2024-01-04 02:18:54', '2024-01-04 02:18:54', 0, 0, 0, 1),
(269, 'Rabib', '2024-01-07 19:04:25', '2024-01-07 19:04:25', 1, 1, 1, 1),
(277, 'ronye', '2024-01-11 02:10:55', '2024-01-11 02:10:55', 1, 1, 0, 1),
(280, 'zxaqwe', '2024-01-11 02:23:56', '2024-01-11 02:23:56', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Ashraful', 'ashrafulashiq36@gmail.com', NULL, '$2y$10$2pJR.p9RhB7hcGWN3yBEqOvH9RHBLlP5XoHJJjn38DNxKrhFiHCEK', NULL, 1, '2023-12-15 01:20:28', '2023-12-15 01:20:28'),
(2, 'Syikin', 'syikin@gmail.com', NULL, '$2y$10$Wbn5UA/cFmYaRprQSGe4FeGRPSstpet9WGkpEXriJ2BjIKkgZLFgG', NULL, 1, '2023-12-15 01:24:09', '2023-12-15 01:24:09'),
(3, 'Rosli', 'rosli@gmail.com', NULL, '$2y$10$KvjNN1ORiV8mSbf6sYRxe.ffD9IMSSP3RD4DaxEOlmbR16QwwAIfS', NULL, 2, '2023-12-15 01:25:10', '2023-12-15 01:25:10'),
(4, 'zunayed', 'zunayed@gmail.com', NULL, '$2y$10$G2VvBInSTRRYljyX3t9yreeTqZYye2.FK8H7en3rtD8qNCH4Brroi', NULL, 226, '2024-01-06 13:35:29', '2024-01-06 13:35:29'),
(5, 'labib', 'labib@gmail.com', NULL, '$2y$10$ST6IQJfto55Sq2xHcl0/lusHBPGaI5uzA010jEgmVYcnjQsvYjk6y', NULL, 267, '2024-01-06 13:37:59', '2024-01-06 13:37:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE `user_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `activity` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_activities`
--

INSERT INTO `user_activities` (`id`, `user_id`, `activity`, `created_at`, `updated_at`) VALUES
(1, 1, 'Created a new role', '2023-12-20 23:16:38', '2023-12-20 23:16:38'),
(2, 2, 'Deleted a role', '2023-12-20 23:17:37', '2023-12-20 23:17:37'),
(3, 2, 'Deleted a role', '2023-12-20 23:17:41', '2023-12-20 23:17:41'),
(4, 1, 'Deleted a role', '2023-12-20 23:59:18', '2023-12-20 23:59:18'),
(5, 1, 'Deleted a role', '2023-12-21 00:14:26', '2023-12-21 00:14:26'),
(6, 1, 'Created a new role', '2023-12-21 18:47:36', '2023-12-21 18:47:36'),
(7, 1, 'Deleted a role', '2023-12-25 22:16:53', '2023-12-25 22:16:53'),
(8, 1, 'Created a new role', '2023-12-26 01:23:19', '2023-12-26 01:23:19'),
(9, 1, 'Deleted a role', '2023-12-26 01:23:25', '2023-12-26 01:23:25'),
(10, 1, 'Created a new role', '2023-12-26 22:24:33', '2023-12-26 22:24:33'),
(11, 1, 'Deleted a role', '2023-12-26 22:24:52', '2023-12-26 22:24:52'),
(12, 1, 'Created a new role', '2023-12-26 22:25:09', '2023-12-26 22:25:09'),
(13, 1, 'Deleted a role', '2023-12-26 22:58:05', '2023-12-26 22:58:05'),
(14, 1, 'Created a new role', '2023-12-26 22:58:13', '2023-12-26 22:58:13'),
(15, 1, 'Created a new role', '2023-12-26 23:31:29', '2023-12-26 23:31:29'),
(16, 1, 'Deleted a role', '2023-12-27 17:44:13', '2023-12-27 17:44:13'),
(17, 1, 'Created a new role', '2023-12-27 18:06:21', '2023-12-27 18:06:21'),
(18, 1, 'Deleted a role', '2023-12-27 18:06:31', '2023-12-27 18:06:31'),
(19, 1, 'Deleted a role', '2023-12-27 18:06:37', '2023-12-27 18:06:37'),
(20, 1, 'Created a new role', '2023-12-27 18:28:35', '2023-12-27 18:28:35'),
(21, 1, 'Created a new role', '2023-12-27 18:35:45', '2023-12-27 18:35:45'),
(22, 1, 'Created a new role', '2023-12-27 18:36:59', '2023-12-27 18:36:59'),
(23, 1, 'Created a new role', '2023-12-27 19:34:00', '2023-12-27 19:34:00'),
(24, 1, 'Created a new role', '2023-12-27 19:55:57', '2023-12-27 19:55:57'),
(25, 1, 'Deleted a role', '2023-12-27 19:56:07', '2023-12-27 19:56:07'),
(26, 1, 'Deleted a role', '2023-12-28 00:56:46', '2023-12-28 00:56:46'),
(27, 1, 'Deleted a role', '2023-12-28 00:56:52', '2023-12-28 00:56:52'),
(28, 1, 'Deleted a role', '2023-12-28 00:56:59', '2023-12-28 00:56:59'),
(29, 1, 'Created a new role', '2023-12-28 00:58:55', '2023-12-28 00:58:55'),
(30, 1, 'Deleted a role', '2023-12-28 00:59:14', '2023-12-28 00:59:14'),
(31, 1, 'Created a new role', '2023-12-28 00:59:33', '2023-12-28 00:59:33'),
(32, 1, 'Deleted a role', '2023-12-28 01:08:15', '2023-12-28 01:08:15'),
(33, 1, 'Created a new role', '2023-12-28 01:11:22', '2023-12-28 01:11:22'),
(34, 1, 'Deleted a role', '2023-12-28 01:11:36', '2023-12-28 01:11:36'),
(35, 1, 'Created a new role', '2023-12-28 01:12:06', '2023-12-28 01:12:06'),
(36, 1, 'Deleted a role', '2023-12-28 01:12:20', '2023-12-28 01:12:20'),
(37, 1, 'Created a new role', '2023-12-28 01:13:40', '2023-12-28 01:13:40'),
(38, 1, 'Deleted a role', '2023-12-28 01:14:09', '2023-12-28 01:14:09'),
(39, 1, 'Deleted a role', '2023-12-28 01:14:15', '2023-12-28 01:14:15'),
(40, 1, 'Deleted a role', '2023-12-28 01:14:19', '2023-12-28 01:14:19'),
(41, 1, 'Created a new role', '2023-12-28 01:20:10', '2023-12-28 01:20:10'),
(42, 1, 'Deleted a role', '2023-12-28 01:20:14', '2023-12-28 01:20:14'),
(43, 1, 'Created a new role', '2023-12-28 01:22:24', '2023-12-28 01:22:24'),
(44, 1, 'Deleted a role', '2023-12-28 01:22:31', '2023-12-28 01:22:31'),
(45, 1, 'Deleted a role', '2023-12-28 01:23:32', '2023-12-28 01:23:32'),
(46, 1, 'Created a new role', '2023-12-28 01:29:34', '2023-12-28 01:29:34'),
(47, 1, 'Created a new role', '2023-12-28 01:29:56', '2023-12-28 01:29:56'),
(48, 1, 'Created a new role', '2023-12-28 01:30:03', '2023-12-28 01:30:03'),
(49, 1, 'Deleted a role', '2023-12-28 01:30:06', '2023-12-28 01:30:06'),
(50, 1, 'Deleted a role', '2023-12-28 01:30:09', '2023-12-28 01:30:09'),
(51, 1, 'Deleted a role', '2023-12-28 01:30:13', '2023-12-28 01:30:13'),
(52, 1, 'Created a new role', '2023-12-28 01:35:59', '2023-12-28 01:35:59'),
(53, 1, 'Created a new role', '2023-12-28 01:36:03', '2023-12-28 01:36:03'),
(54, 1, 'Deleted a role', '2023-12-28 01:36:11', '2023-12-28 01:36:11'),
(55, 1, 'Deleted a role', '2023-12-28 01:36:23', '2023-12-28 01:36:23'),
(56, 1, 'Created a new role', '2023-12-28 01:37:17', '2023-12-28 01:37:17'),
(57, 1, 'Deleted a role', '2023-12-28 01:37:22', '2023-12-28 01:37:22'),
(58, 1, 'Created a new role', '2023-12-28 01:38:11', '2023-12-28 01:38:11'),
(59, 1, 'Created a new role', '2023-12-28 01:38:15', '2023-12-28 01:38:15'),
(60, 1, 'Deleted a role', '2023-12-28 01:38:19', '2023-12-28 01:38:19'),
(61, 1, 'Deleted a role', '2023-12-28 01:52:42', '2023-12-28 01:52:42'),
(62, 1, 'Created a new role', '2023-12-28 01:53:06', '2023-12-28 01:53:06'),
(63, 1, 'Created a new role', '2023-12-28 01:53:31', '2023-12-28 01:53:31'),
(64, 1, 'Created a new role', '2023-12-28 01:57:40', '2023-12-28 01:57:40'),
(65, 1, 'Deleted a role', '2023-12-28 01:58:08', '2023-12-28 01:58:08'),
(66, 1, 'Deleted a role', '2023-12-28 01:58:15', '2023-12-28 01:58:15'),
(67, 1, 'Created a new role', '2024-01-02 21:18:23', '2024-01-02 21:18:23'),
(68, 1, 'Created a new role', '2024-01-03 22:57:46', '2024-01-03 22:57:46'),
(69, 1, 'Created a new role', '2024-01-03 23:00:49', '2024-01-03 23:00:49'),
(70, 1, 'Created a new role', '2024-01-03 23:01:05', '2024-01-03 23:01:05'),
(71, 1, 'Created a new role', '2024-01-03 23:05:40', '2024-01-03 23:05:40'),
(72, 1, 'Created a new role', '2024-01-03 23:06:10', '2024-01-03 23:06:10'),
(73, 1, 'Deleted a role', '2024-01-03 23:06:24', '2024-01-03 23:06:24'),
(74, 1, 'Deleted a role', '2024-01-03 23:06:28', '2024-01-03 23:06:28'),
(75, 1, 'Deleted a role', '2024-01-03 23:06:31', '2024-01-03 23:06:31'),
(76, 1, 'Deleted a role', '2024-01-03 23:06:38', '2024-01-03 23:06:38'),
(77, 1, 'Created a new role', '2024-01-03 23:06:48', '2024-01-03 23:06:48'),
(78, 1, 'Deleted a role', '2024-01-03 23:09:56', '2024-01-03 23:09:56'),
(79, 1, 'Created a new role', '2024-01-03 23:10:23', '2024-01-03 23:10:23'),
(80, 1, 'Created a new role', '2024-01-03 23:10:43', '2024-01-03 23:10:43'),
(81, 1, 'Created a new role', '2024-01-03 23:14:01', '2024-01-03 23:14:01'),
(82, 1, 'Created a new role', '2024-01-03 23:14:31', '2024-01-03 23:14:31'),
(83, 1, 'Created a new role', '2024-01-03 23:16:12', '2024-01-03 23:16:12'),
(84, 1, 'Deleted a role', '2024-01-03 23:22:55', '2024-01-03 23:22:55'),
(85, 1, 'Deleted a role', '2024-01-03 23:22:59', '2024-01-03 23:22:59'),
(86, 1, 'Deleted a role', '2024-01-03 23:23:21', '2024-01-03 23:23:21'),
(87, 1, 'Created a new role', '2024-01-03 23:23:43', '2024-01-03 23:23:43'),
(88, 1, 'Created a new role', '2024-01-03 23:23:57', '2024-01-03 23:23:57'),
(89, 1, 'Deleted a role', '2024-01-03 23:41:29', '2024-01-03 23:41:29'),
(90, 1, 'Deleted a role', '2024-01-03 23:42:19', '2024-01-03 23:42:19'),
(91, 1, 'Created a new role', '2024-01-03 23:43:24', '2024-01-03 23:43:24'),
(92, 1, 'Deleted a role', '2024-01-03 23:57:25', '2024-01-03 23:57:25'),
(93, 1, 'Deleted a role', '2024-01-03 23:58:01', '2024-01-03 23:58:01'),
(94, 1, 'Deleted a role', '2024-01-03 23:58:21', '2024-01-03 23:58:21'),
(95, 1, 'Created a new role', '2024-01-04 00:03:09', '2024-01-04 00:03:09'),
(96, 1, 'Created a new role', '2024-01-04 00:03:19', '2024-01-04 00:03:19'),
(97, 1, 'Created a new role', '2024-01-04 00:03:27', '2024-01-04 00:03:27'),
(98, 1, 'Deleted a role', '2024-01-04 00:03:35', '2024-01-04 00:03:35'),
(99, 1, 'Deleted a role', '2024-01-04 00:03:38', '2024-01-04 00:03:38'),
(100, 1, 'Deleted a role', '2024-01-04 00:03:42', '2024-01-04 00:03:42'),
(101, 1, 'Created a new role', '2024-01-04 00:04:28', '2024-01-04 00:04:28'),
(102, 1, 'Created a new role', '2024-01-04 00:05:45', '2024-01-04 00:05:45'),
(103, 1, 'Created a new role', '2024-01-04 00:06:08', '2024-01-04 00:06:08'),
(104, 1, 'Created a new role', '2024-01-04 00:16:21', '2024-01-04 00:16:21'),
(105, 1, 'Created a new role', '2024-01-04 00:16:36', '2024-01-04 00:16:36'),
(106, 1, 'Created a new role', '2024-01-04 00:24:25', '2024-01-04 00:24:25'),
(107, 1, 'Created a new role', '2024-01-04 00:24:34', '2024-01-04 00:24:34'),
(108, 1, 'Created a new role', '2024-01-04 00:40:26', '2024-01-04 00:40:26'),
(109, 1, 'Deleted a role', '2024-01-04 00:40:44', '2024-01-04 00:40:44'),
(110, 1, 'Deleted a role', '2024-01-04 00:40:47', '2024-01-04 00:40:47'),
(111, 1, 'Deleted a role', '2024-01-04 00:40:50', '2024-01-04 00:40:50'),
(112, 1, 'Deleted a role', '2024-01-04 00:40:52', '2024-01-04 00:40:52'),
(113, 1, 'Deleted a role', '2024-01-04 00:40:56', '2024-01-04 00:40:56'),
(114, 1, 'Deleted a role', '2024-01-04 00:41:00', '2024-01-04 00:41:00'),
(115, 1, 'Deleted a role', '2024-01-04 00:41:03', '2024-01-04 00:41:03'),
(116, 1, 'Deleted a role', '2024-01-04 00:41:06', '2024-01-04 00:41:06'),
(117, 1, 'Created a new role', '2024-01-04 00:41:48', '2024-01-04 00:41:48'),
(118, 1, 'Created a new role', '2024-01-04 00:42:02', '2024-01-04 00:42:02'),
(119, 1, 'Created a new role', '2024-01-04 00:42:26', '2024-01-04 00:42:26'),
(120, 1, 'Created a new role', '2024-01-04 00:43:11', '2024-01-04 00:43:11'),
(121, 1, 'Created a new role', '2024-01-04 00:50:15', '2024-01-04 00:50:15'),
(122, 1, 'Deleted a role', '2024-01-04 00:52:35', '2024-01-04 00:52:35'),
(123, 1, 'Created a new role', '2024-01-04 00:52:49', '2024-01-04 00:52:49'),
(124, 1, 'Created a new role', '2024-01-04 00:53:07', '2024-01-04 00:53:07'),
(125, 1, 'Created a new role', '2024-01-04 00:53:30', '2024-01-04 00:53:30'),
(126, 1, 'Deleted a role', '2024-01-04 01:08:35', '2024-01-04 01:08:35'),
(127, 1, 'Deleted a role', '2024-01-04 01:18:51', '2024-01-04 01:18:51'),
(128, 1, 'Deleted a role', '2024-01-04 01:18:54', '2024-01-04 01:18:54'),
(129, 1, 'Deleted a role', '2024-01-04 01:18:57', '2024-01-04 01:18:57'),
(130, 1, 'Deleted a role', '2024-01-04 01:19:00', '2024-01-04 01:19:00'),
(131, 1, 'Deleted a role', '2024-01-04 01:19:04', '2024-01-04 01:19:04'),
(132, 1, 'Created a new role', '2024-01-04 01:19:14', '2024-01-04 01:19:14'),
(133, 1, 'Created a new role', '2024-01-04 01:19:59', '2024-01-04 01:19:59'),
(134, 1, 'Deleted a role', '2024-01-04 01:21:54', '2024-01-04 01:21:54'),
(135, 1, 'Created a new role', '2024-01-04 01:22:01', '2024-01-04 01:22:01'),
(136, 1, 'Created a new role', '2024-01-04 01:22:13', '2024-01-04 01:22:13'),
(137, 1, 'Created a new role', '2024-01-04 01:22:49', '2024-01-04 01:22:49'),
(138, 1, 'Created a new role', '2024-01-04 01:37:04', '2024-01-04 01:37:04'),
(139, 1, 'Created a new role', '2024-01-04 01:48:18', '2024-01-04 01:48:18'),
(140, 1, 'Created a new role', '2024-01-04 01:51:24', '2024-01-04 01:51:24'),
(141, 1, 'Created a new role', '2024-01-04 01:53:07', '2024-01-04 01:53:07'),
(142, 1, 'Deleted a role', '2024-01-04 02:01:55', '2024-01-04 02:01:55'),
(143, 1, 'Deleted a role', '2024-01-04 02:03:08', '2024-01-04 02:03:08'),
(144, 1, 'Deleted a role', '2024-01-04 02:03:11', '2024-01-04 02:03:11'),
(145, 1, 'Deleted a role', '2024-01-04 02:03:14', '2024-01-04 02:03:14'),
(146, 1, 'Deleted a role', '2024-01-04 02:03:21', '2024-01-04 02:03:21'),
(147, 1, 'Deleted a role', '2024-01-04 02:03:53', '2024-01-04 02:03:53'),
(148, 1, 'Deleted a role', '2024-01-04 02:03:59', '2024-01-04 02:03:59'),
(149, 1, 'Deleted a role', '2024-01-04 02:04:04', '2024-01-04 02:04:04'),
(150, 1, 'Created a new role', '2024-01-04 02:18:54', '2024-01-04 02:18:54'),
(151, 1, 'Created a new role', '2024-01-07 05:21:26', '2024-01-07 05:21:26'),
(152, 1, 'Created a new role', '2024-01-07 19:04:25', '2024-01-07 19:04:25'),
(153, 1, 'Created a new role', '2024-01-08 21:46:29', '2024-01-08 21:46:29'),
(154, 1, 'Created a new role', '2024-01-08 21:55:54', '2024-01-08 21:55:54'),
(155, 1, 'Created a new role', '2024-01-08 22:02:29', '2024-01-08 22:02:29'),
(156, 1, 'Deleted a role', '2024-01-08 22:02:40', '2024-01-08 22:02:40'),
(157, 1, 'Deleted a role', '2024-01-08 22:02:45', '2024-01-08 22:02:45'),
(158, 1, 'Deleted a role', '2024-01-08 22:06:06', '2024-01-08 22:06:06'),
(159, 1, 'Created a new role', '2024-01-08 22:13:35', '2024-01-08 22:13:35'),
(160, 1, 'Created a new role', '2024-01-08 22:14:25', '2024-01-08 22:14:25'),
(161, 1, 'Created a new role', '2024-01-08 22:14:57', '2024-01-08 22:14:57'),
(162, 1, 'Deleted a role', '2024-01-08 22:15:11', '2024-01-08 22:15:11'),
(163, 1, 'Deleted a role', '2024-01-08 22:15:15', '2024-01-08 22:15:15'),
(164, 1, 'Deleted a role', '2024-01-08 22:15:21', '2024-01-08 22:15:21'),
(165, 2, 'Created a new role', '2024-01-10 20:16:55', '2024-01-10 20:16:55'),
(166, 2, 'Created a new role', '2024-01-10 20:16:59', '2024-01-10 20:16:59'),
(167, 1, 'Created a new role', '2024-01-11 02:07:02', '2024-01-11 02:07:02'),
(168, 1, 'Created a new role', '2024-01-11 02:08:16', '2024-01-11 02:08:16'),
(169, 1, 'Deleted a role', '2024-01-11 02:08:28', '2024-01-11 02:08:28'),
(170, 1, 'Created a new role', '2024-01-11 02:09:40', '2024-01-11 02:09:40'),
(171, 1, 'Deleted a role', '2024-01-11 02:10:30', '2024-01-11 02:10:30'),
(172, 1, 'Created a new role', '2024-01-11 02:10:55', '2024-01-11 02:10:55'),
(173, 1, 'Created a new role', '2024-01-11 02:12:29', '2024-01-11 02:12:29'),
(174, 1, 'Deleted a role', '2024-01-11 02:20:39', '2024-01-11 02:20:39'),
(175, 1, 'Created a new role', '2024-01-11 02:21:23', '2024-01-11 02:21:23'),
(176, 1, 'Deleted a role', '2024-01-11 02:23:16', '2024-01-11 02:23:16'),
(177, 1, 'Created a new role', '2024-01-11 02:23:56', '2024-01-11 02:23:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_history_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_activities_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_history`
--
ALTER TABLE `login_history`
  ADD CONSTRAINT `login_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD CONSTRAINT `user_activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
