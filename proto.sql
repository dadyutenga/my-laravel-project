-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 12:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proto`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('superadmin','admin') NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `role`, `is_active`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@example.com', '$2y$10$jRz7WhCh5oleU30RUG6ZreP8Fk89xU9jyZgSSgMP5q8HmwWOPkhT2', 'superadmin', 1, NULL, 'uOBk9W0F22UOFNWyGfWy2zJbyyaDlYWyJsIy0GUYZfDcomRYsta4oLkZ3P0q', '2025-05-10 12:09:38', '2025-05-10 12:09:38'),
(2, 'Regular Admin', 'admin@example.com', '$2y$10$Yn7p8HkweElxD2b85AFLu.fv23RvcB7oJf4qCsX9YbLtz3m/fw7Iu', 'admin', 1, NULL, NULL, '2025-05-10 12:09:38', '2025-05-10 12:09:38');

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `balozi`
--

CREATE TABLE `balozi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mwenyekiti_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `national_id` varchar(255) DEFAULT NULL,
  `street_village` varchar(255) NOT NULL,
  `shina` varchar(255) DEFAULT NULL,
  `shina_number` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_synced_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `balozi_auths`
--

CREATE TABLE `balozi_auths` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `balozi_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kaya_maskini`
--

CREATE TABLE `kaya_maskini` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `household_count` int(11) NOT NULL,
  `household_members` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maendeleo_ya_siku`
--

CREATE TABLE `maendeleo_ya_siku` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tarehe` date NOT NULL,
  `maelezo` text NOT NULL,
  `maoni` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahitaji_maalumu`
--

CREATE TABLE `mahitaji_maalumu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `nida_number` varchar(255) NOT NULL,
  `pdf_file_path` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `malalamiko`
--

CREATE TABLE `malalamiko` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `mtaa` varchar(255) NOT NULL,
  `jinsia` varchar(255) NOT NULL,
  `malalamiko` text NOT NULL,
  `status` enum('pending','resolved') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mapendekezo`
--

CREATE TABLE `mapendekezo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `maelezo` text NOT NULL,
  `maeneo` text NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_09_create_admins_table', 1),
(6, '2025_04_29_152026_create_admin_details_table', 1),
(7, '2025_04_30_142703_create_mwenyekitis_table', 1),
(8, '2025_04_30_142752_create_mwenyekiti_auths_table', 1),
(9, '2025_04_30_142801_create_balozis_table', 1),
(10, '2025_04_30_142805_create_balozi_auths_table', 1),
(11, '2025_04_30_142829_create_watus_table', 1),
(12, '2025_04_30_142839_create_watu_auths_table', 1),
(13, '2025_04_30_142848_create_services_table', 1),
(14, '2025_04_30_142857_create_mtaa_meetings_table', 1),
(15, '2025_04_30_142904_create_kaya_maskinis_table', 1),
(16, '2025_04_30_142913_create_maendeleo_ya_sikus_table', 1),
(17, '2025_04_30_142923_create_mahitaji_maalumus_table', 1),
(18, '2025_04_30_142932_create_malalamikos_table', 1),
(19, '2025_04_30_142941_create_mapendekezos_table', 1),
(20, '2025_04_30_142950_create_udhaminis_table', 1),
(21, '2025_05_02_215526_add_region_to_mwenyekiti_table', 1),
(22, 'xxxx_xx_xx_add_role_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mtaa_meetings`
--

CREATE TABLE `mtaa_meetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_sw` varchar(255) NOT NULL,
  `agenda` text NOT NULL,
  `meeting_date` date NOT NULL,
  `mtaa` varchar(255) NOT NULL,
  `organizer_id` bigint(20) UNSIGNED NOT NULL,
  `outcome` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mwenyekiti`
--

CREATE TABLE `mwenyekiti` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `national_id` varchar(255) DEFAULT NULL,
  `ward` varchar(255) NOT NULL,
  `mtaa` varchar(255) NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_synced_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mwenyekiti`
--

INSERT INTO `mwenyekiti` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `phone`, `date_of_birth`, `gender`, `national_id`, `ward`, `mtaa`, `region`, `photo`, `is_active`, `last_synced_at`, `created_at`, `updated_at`) VALUES
(1, 'Dadi', 'Nasser', 'Utenga', 'dady@admin.com', '0680185784', '2025-05-27', 'male', '23333333333333333333', 'Kimara', 'KimaraB', 'Dar es Salaam', 'mwenyekiti/photos/lWS7EdYe4xMpY8yg0q3DpRLgiMtWbrlazeJGj2XU.jpg', 1, NULL, '2025-05-11 13:28:14', '2025-05-11 13:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `mwenyekiti_auths`
--

CREATE TABLE `mwenyekiti_auths` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mwenyekiti_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mwenyekiti_auths`
--

INSERT INTO `mwenyekiti_auths` (`id`, `mwenyekiti_id`, `username`, `password`, `remember_token`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dadi89', '$2y$10$9jIwito0NBQS37kWHKmMUuq820TfPDkHum8nXwOK0kuffoE.GcJ9O', NULL, 1, '2025-05-11 13:31:46', '2025-05-11 13:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_sw` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','in_progress','completed') NOT NULL DEFAULT 'pending',
  `mtaa` varchar(255) NOT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `udhamini`
--

CREATE TABLE `udhamini` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `jinsia` varchar(255) NOT NULL,
  `mtaa` varchar(255) NOT NULL,
  `simu` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nida` varchar(255) NOT NULL,
  `sababu` text NOT NULL,
  `muelekeo` text NOT NULL,
  `tarehe` date NOT NULL,
  `picha` longtext DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `watu`
--

CREATE TABLE `watu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `education_level` varchar(255) DEFAULT NULL,
  `income_range` varchar(255) DEFAULT NULL,
  `health_status` varchar(255) DEFAULT NULL,
  `nida_number` varchar(255) DEFAULT NULL,
  `house_no` varchar(255) NOT NULL,
  `mtaa` varchar(255) NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `ward` varchar(255) DEFAULT NULL,
  `balozi_id` bigint(20) UNSIGNED NOT NULL,
  `household_count` int(11) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_synced_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `watu_auths`
--

CREATE TABLE `watu_auths` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `watu_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_details_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `balozi`
--
ALTER TABLE `balozi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `balozi_phone_unique` (`phone`),
  ADD UNIQUE KEY `balozi_email_unique` (`email`),
  ADD KEY `balozi_mwenyekiti_id_foreign` (`mwenyekiti_id`);

--
-- Indexes for table `balozi_auths`
--
ALTER TABLE `balozi_auths`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `balozi_auths_balozi_id_unique` (`balozi_id`),
  ADD UNIQUE KEY `balozi_auths_username_unique` (`username`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kaya_maskini`
--
ALTER TABLE `kaya_maskini`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kaya_maskini_created_by_foreign` (`created_by`);

--
-- Indexes for table `maendeleo_ya_siku`
--
ALTER TABLE `maendeleo_ya_siku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maendeleo_ya_siku_created_by_foreign` (`created_by`);

--
-- Indexes for table `mahitaji_maalumu`
--
ALTER TABLE `mahitaji_maalumu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahitaji_maalumu_created_by_foreign` (`created_by`);

--
-- Indexes for table `malalamiko`
--
ALTER TABLE `malalamiko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapendekezo`
--
ALTER TABLE `mapendekezo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mapendekezo_created_by_foreign` (`created_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mtaa_meetings`
--
ALTER TABLE `mtaa_meetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mtaa_meetings_organizer_id_foreign` (`organizer_id`);

--
-- Indexes for table `mwenyekiti`
--
ALTER TABLE `mwenyekiti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mwenyekiti_phone_unique` (`phone`),
  ADD UNIQUE KEY `mwenyekiti_email_unique` (`email`);

--
-- Indexes for table `mwenyekiti_auths`
--
ALTER TABLE `mwenyekiti_auths`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mwenyekiti_auths_mwenyekiti_id_unique` (`mwenyekiti_id`),
  ADD UNIQUE KEY `mwenyekiti_auths_username_unique` (`username`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_assigned_to_foreign` (`assigned_to`),
  ADD KEY `services_created_by_foreign` (`created_by`);

--
-- Indexes for table `udhamini`
--
ALTER TABLE `udhamini`
  ADD PRIMARY KEY (`id`),
  ADD KEY `udhamini_created_by_foreign` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `watu`
--
ALTER TABLE `watu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `watu_phone_number_unique` (`phone_number`),
  ADD UNIQUE KEY `watu_email_unique` (`email`),
  ADD KEY `watu_balozi_id_foreign` (`balozi_id`),
  ADD KEY `watu_created_by_foreign` (`created_by`);

--
-- Indexes for table `watu_auths`
--
ALTER TABLE `watu_auths`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `watu_auths_watu_id_unique` (`watu_id`),
  ADD UNIQUE KEY `watu_auths_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `balozi`
--
ALTER TABLE `balozi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `balozi_auths`
--
ALTER TABLE `balozi_auths`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kaya_maskini`
--
ALTER TABLE `kaya_maskini`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maendeleo_ya_siku`
--
ALTER TABLE `maendeleo_ya_siku`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahitaji_maalumu`
--
ALTER TABLE `mahitaji_maalumu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `malalamiko`
--
ALTER TABLE `malalamiko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mapendekezo`
--
ALTER TABLE `mapendekezo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `mtaa_meetings`
--
ALTER TABLE `mtaa_meetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mwenyekiti`
--
ALTER TABLE `mwenyekiti`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mwenyekiti_auths`
--
ALTER TABLE `mwenyekiti_auths`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `udhamini`
--
ALTER TABLE `udhamini`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `watu`
--
ALTER TABLE `watu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `watu_auths`
--
ALTER TABLE `watu_auths`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD CONSTRAINT `admin_details_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `balozi`
--
ALTER TABLE `balozi`
  ADD CONSTRAINT `balozi_mwenyekiti_id_foreign` FOREIGN KEY (`mwenyekiti_id`) REFERENCES `mwenyekiti` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `balozi_auths`
--
ALTER TABLE `balozi_auths`
  ADD CONSTRAINT `balozi_auths_balozi_id_foreign` FOREIGN KEY (`balozi_id`) REFERENCES `balozi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kaya_maskini`
--
ALTER TABLE `kaya_maskini`
  ADD CONSTRAINT `kaya_maskini_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `balozi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `maendeleo_ya_siku`
--
ALTER TABLE `maendeleo_ya_siku`
  ADD CONSTRAINT `maendeleo_ya_siku_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `balozi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mahitaji_maalumu`
--
ALTER TABLE `mahitaji_maalumu`
  ADD CONSTRAINT `mahitaji_maalumu_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `balozi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mapendekezo`
--
ALTER TABLE `mapendekezo`
  ADD CONSTRAINT `mapendekezo_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `mwenyekiti` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mtaa_meetings`
--
ALTER TABLE `mtaa_meetings`
  ADD CONSTRAINT `mtaa_meetings_organizer_id_foreign` FOREIGN KEY (`organizer_id`) REFERENCES `mwenyekiti` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mwenyekiti_auths`
--
ALTER TABLE `mwenyekiti_auths`
  ADD CONSTRAINT `mwenyekiti_auths_mwenyekiti_id_foreign` FOREIGN KEY (`mwenyekiti_id`) REFERENCES `mwenyekiti` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `mwenyekiti` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `services_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `watu` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `udhamini`
--
ALTER TABLE `udhamini`
  ADD CONSTRAINT `udhamini_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `mwenyekiti` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `watu`
--
ALTER TABLE `watu`
  ADD CONSTRAINT `watu_balozi_id_foreign` FOREIGN KEY (`balozi_id`) REFERENCES `balozi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `watu_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `balozi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `watu_auths`
--
ALTER TABLE `watu_auths`
  ADD CONSTRAINT `watu_auths_watu_id_foreign` FOREIGN KEY (`watu_id`) REFERENCES `watu` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
