-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2023 at 08:58 AM
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
(37, 1, '2023-12-26 01:29:44', NULL, NULL, '2023-12-26 01:29:44', '2023-12-26 01:29:44');

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
(57, '2023_12_27_065714_add_is_operation_enabled_to_roles_table', 7);

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
  `is_operation_enabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `roleName`, `created_at`, `updated_at`, `is_admin_enabled`, `is_settings_enabled`, `is_operation_enabled`) VALUES
(1, 'superuser', '2023-11-08 01:29:36', '2023-11-08 01:29:36', 1, 1, 0),
(2, 'Ashiq', '2023-11-08 01:29:54', '2023-11-08 01:29:54', 1, 0, 0),
(3, 'Sabbir', '2023-11-08 01:44:09', '2023-11-08 01:44:09', 0, 1, 0),
(5, 'Saaakin', '2023-11-13 22:09:13', '2023-11-13 22:09:13', 1, 1, 0),
(100, 'Role11', '2023-11-29 12:21:11', '2023-11-29 12:21:11', 1, 1, 0),
(101, 'Superuser_Ashraf', '2023-11-29 12:21:38', '2023-11-29 12:21:38', 1, 0, 0),
(200, 'zxzxzxa', '2023-12-26 22:58:13', '2023-12-26 22:58:13', 1, 0, 0),
(201, 'hfgjhgjgh', '2023-12-26 23:31:29', '2023-12-26 23:31:29', 1, 0, 0);

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
(3, 'Rosli', 'rosli@gmail.com', NULL, '$2y$10$KvjNN1ORiV8mSbf6sYRxe.ffD9IMSSP3RD4DaxEOlmbR16QwwAIfS', NULL, 2, '2023-12-15 01:25:10', '2023-12-15 01:25:10');

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
(15, 1, 'Created a new role', '2023-12-26 23:31:29', '2023-12-26 23:31:29');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
