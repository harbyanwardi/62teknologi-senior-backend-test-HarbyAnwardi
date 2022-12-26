-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Des 2022 pada 03.39
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enamdua_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `businesses`
--

CREATE TABLE `businesses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` double NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_closed` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 0,
  `review_count` int(11) NOT NULL DEFAULT 0,
  `transaction_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `businesses`
--

INSERT INTO `businesses` (`id`, `name`, `alias`, `phone`, `distance`, `image_url`, `is_closed`, `price`, `rating`, `review_count`, `transaction_url`, `url`, `created_at`, `updated_at`) VALUES
(8, 'Pizza Bangor', 'pizza-bangor', '+628987843362', 4992.437696561, '63a46e753a058.png', 'true', 20000, 4, 200, 'restaurant_reservation', NULL, '2022-12-22 07:49:25', '2022-12-22 07:49:25'),
(12, 'Pizza Bangor', 'pizza-bangor', '+628987843362', 4992.437696561, '63a51cbe2022c.png', 'true', 30000, 4, 200, 'restaurant_reservation', NULL, '2022-12-22 20:13:02', '2022-12-22 20:13:02'),
(13, 'Banana Bangor', 'banana-bangor', '+628987843362', 4992.437696561, '63a56926024b7.png', 'true', 40000, 4, 200, 'restaurant_reservation', NULL, '2022-12-23 01:39:02', '2022-12-23 01:39:02'),
(14, 'Banana Bangor', 'banana-bangor', '+628987843362', 4992.437696561, '63a56be2a8efa.png', 'true', 50000, 4, 200, 'restaurant_reservation', NULL, '2022-12-23 01:50:42', '2022-12-23 01:50:42'),
(15, 'Banana Bangor', 'banana-bangor', '+628987843362', 4992.437696561, '63a56c8fe6cab.png', 'true', 60000, 4, 200, 'restaurant_reservation', NULL, '2022-12-23 01:53:35', '2022-12-23 01:53:35'),
(16, 'KFC Bangor', 'kfc-bangor', '+628987843362', 4992.437696561, '63a8ed2fc86df.png', 'true', 50000, 5, 200, 'restaurant_reservation', NULL, '2022-12-25 17:39:12', '2022-12-25 17:39:12'),
(17, 'Ayam Bangor', 'ayam-bangor', '+628987843362', 4992.437696561, '63a8ed4a66ec2.png', 'true', 20000, 5, 200, 'restaurant_reservation', NULL, '2022-12-25 17:39:38', '2022-12-25 17:39:38'),
(18, 'Sabana Bangor', 'sabana-bangor', '+628987843362', 4992.437696561, '63a8ed6413157.png', 'true', 20000, 5, 200, 'restaurant_reservation', NULL, '2022-12-25 17:40:04', '2022-12-25 17:40:04'),
(19, 'Dkriuk Bangor', 'dkriuk-bangor', '+628987843362', 4992.437696561, '63a8ed6aaf6b0.png', 'true', 20000, 5, 200, 'restaurant_reservation', NULL, '2022-12-25 17:40:10', '2022-12-25 17:40:10'),
(20, 'Nikita Bangor', 'nikita-bangor', '+628987843362', 4992.437696561, '63a8ed85954ad.png', 'true', 10000, 5, 200, 'restaurant_reservation', NULL, '2022-12-25 17:40:37', '2022-12-25 17:40:37'),
(21, 'MCD Bangor', 'mcd-bangor', '+628987843362', 4992.437696561, '63a8edc73e9d3.png', 'true', 10000, 5, 200, 'restaurant_reservation', NULL, '2022-12-25 17:41:43', '2022-12-25 17:41:43'),
(22, 'CFC Bangor', 'cfc-bangor', '+628987843362', 4992.437696561, '63a8edcd4f98f.png', 'true', 10000, 5, 200, 'restaurant_reservation', NULL, '2022-12-25 17:41:49', '2022-12-25 17:41:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `businesses_categories`
--

CREATE TABLE `businesses_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `businesses_categories`
--

INSERT INTO `businesses_categories` (`id`, `alias`, `title`, `created_at`, `updated_at`) VALUES
(1, 'pizza', 'Pizza', NULL, NULL),
(2, 'food', 'Food', NULL, NULL),
(3, 'drink', 'Drink', NULL, NULL),
(4, 'snack', 'Snack', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `businesses_coordinates`
--

CREATE TABLE `businesses_coordinates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `businesses_coordinates`
--

INSERT INTO `businesses_coordinates` (`id`, `business_id`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(5, 12, 41.787338256836, -123.05155181885, '2022-12-22 20:13:02', '2022-12-22 20:13:02'),
(6, 13, 41.787338256836, -123.05155181885, '2022-12-23 01:39:02', '2022-12-23 01:39:02'),
(7, 14, 41.787338256836, -123.05155181885, '2022-12-23 01:50:42', '2022-12-23 01:50:42'),
(8, 15, 41.787338256836, -123.05155181885, '2022-12-23 01:53:36', '2022-12-23 01:53:36'),
(9, 16, 41.787338256836, -123.05155181885, '2022-12-25 17:39:12', '2022-12-25 17:39:12'),
(10, 17, 41.787338256836, -123.05155181885, '2022-12-25 17:39:38', '2022-12-25 17:39:38'),
(11, 18, 41.787338256836, -123.05155181885, '2022-12-25 17:40:04', '2022-12-25 17:40:04'),
(12, 19, 41.787338256836, -123.05155181885, '2022-12-25 17:40:10', '2022-12-25 17:40:10'),
(13, 20, 41.787338256836, -123.05155181885, '2022-12-25 17:40:37', '2022-12-25 17:40:37'),
(14, 21, 41.787338256836, -123.05155181885, '2022-12-25 17:41:43', '2022-12-25 17:41:43'),
(15, 22, 41.787338256836, -123.05155181885, '2022-12-25 17:41:49', '2022-12-25 17:41:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `businesses_locations`
--

CREATE TABLE `businesses_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `businesses_locations`
--

INSERT INTO `businesses_locations` (`id`, `business_id`, `address1`, `address2`, `address3`, `city`, `country`, `state`, `zip_code`, `created_at`, `updated_at`) VALUES
(4, 12, 'jalan apel', 'A 10 Nomor 2', NULL, 'Bekasi', 'INA', 'Jawa Barat', '17520', '2022-12-22 20:13:02', '2022-12-22 20:13:02'),
(5, 13, 'jalan apel', 'A 10 Nomor 2', NULL, 'Bekasi', 'INA', 'Jawa Barat', '17520', '2022-12-23 01:39:02', '2022-12-23 01:39:02'),
(6, 14, 'jalan apel', 'A 10 Nomor 2', NULL, 'Bekasi', 'INA', 'Jawa Barat', '17520', '2022-12-23 01:50:42', '2022-12-23 01:50:42'),
(7, 15, 'jalan apel', 'A 10 Nomor 2', NULL, 'Bekasi', 'INA', 'Jawa Barat', '17520', '2022-12-23 01:53:36', '2022-12-23 01:53:36'),
(8, 16, 'jalan apel', 'A 10 Nomor 2', NULL, 'Bekasi', 'INA', 'Jawa Barat', '17520', '2022-12-25 17:39:12', '2022-12-25 17:39:12'),
(9, 17, 'jalan apel', 'A 10 Nomor 2', NULL, 'Bekasi', 'INA', 'Jawa Barat', '17520', '2022-12-25 17:39:38', '2022-12-25 17:39:38'),
(10, 18, 'jalan apel', 'A 10 Nomor 2', NULL, 'Bekasi', 'INA', 'Jawa Barat', '17520', '2022-12-25 17:40:04', '2022-12-25 17:40:04'),
(11, 19, 'jalan apel', 'A 10 Nomor 2', NULL, 'Bekasi', 'INA', 'Jawa Barat', '17520', '2022-12-25 17:40:10', '2022-12-25 17:40:10'),
(12, 20, 'jalan apel', 'A 10 Nomor 2', NULL, 'Bekasi', 'INA', 'Jawa Barat', '17520', '2022-12-25 17:40:37', '2022-12-25 17:40:37'),
(13, 21, 'jalan apel', 'A 10 Nomor 2', NULL, 'Bekasi', 'INA', 'Jawa Barat', '17520', '2022-12-25 17:41:43', '2022-12-25 17:41:43'),
(14, 22, 'jalan apel', 'A 10 Nomor 2', NULL, 'Bekasi', 'INA', 'Jawa Barat', '17520', '2022-12-25 17:41:49', '2022-12-25 17:41:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `business_category_relation`
--

CREATE TABLE `business_category_relation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `business_category_relation`
--

INSERT INTO `business_category_relation` (`id`, `business_id`, `category_id`, `created_at`, `updated_at`) VALUES
(18, 12, 2, '2022-12-22 20:13:02', '2022-12-22 20:13:02'),
(19, 12, 1, '2022-12-22 20:13:02', '2022-12-22 20:13:02'),
(20, 13, 2, '2022-12-23 01:39:02', '2022-12-23 01:39:02'),
(21, 13, 1, '2022-12-23 01:39:02', '2022-12-23 01:39:02'),
(22, 14, 2, '2022-12-23 01:50:42', '2022-12-23 01:50:42'),
(23, 14, 1, '2022-12-23 01:50:42', '2022-12-23 01:50:42'),
(24, 15, 2, '2022-12-23 01:53:36', '2022-12-23 01:53:36'),
(25, 15, 1, '2022-12-23 01:53:36', '2022-12-23 01:53:36'),
(26, 16, 2, '2022-12-25 17:39:12', '2022-12-25 17:39:12'),
(27, 16, 1, '2022-12-25 17:39:12', '2022-12-25 17:39:12'),
(28, 17, 1, '2022-12-25 17:39:38', '2022-12-25 17:39:38'),
(29, 17, 2, '2022-12-25 17:39:38', '2022-12-25 17:39:38'),
(30, 18, 1, '2022-12-25 17:40:04', '2022-12-25 17:40:04'),
(31, 18, 2, '2022-12-25 17:40:04', '2022-12-25 17:40:04'),
(32, 19, 1, '2022-12-25 17:40:10', '2022-12-25 17:40:10'),
(33, 19, 2, '2022-12-25 17:40:10', '2022-12-25 17:40:10'),
(34, 20, 1, '2022-12-25 17:40:37', '2022-12-25 17:40:37'),
(35, 20, 2, '2022-12-25 17:40:37', '2022-12-25 17:40:37'),
(36, 21, 1, '2022-12-25 17:41:43', '2022-12-25 17:41:43'),
(37, 21, 2, '2022-12-25 17:41:43', '2022-12-25 17:41:43'),
(38, 22, 1, '2022-12-25 17:41:49', '2022-12-25 17:41:49'),
(39, 22, 2, '2022-12-25 17:41:49', '2022-12-25 17:41:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(17, '2022_12_21_054531_create_businesses_table', 1),
(18, '2022_12_21_055320_create_businesses_categories_table', 1),
(19, '2022_12_21_055416_create_businesses_coordinates_table', 1),
(20, '2022_12_21_055633_create_businesses_locations_table', 1),
(21, '2022_12_21_080151_create_table_business_category_relation', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `businesses_categories`
--
ALTER TABLE `businesses_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `businesses_coordinates`
--
ALTER TABLE `businesses_coordinates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `businesses_coordinates_business_id_foreign` (`business_id`);

--
-- Indeks untuk tabel `businesses_locations`
--
ALTER TABLE `businesses_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `businesses_locations_business_id_foreign` (`business_id`);

--
-- Indeks untuk tabel `business_category_relation`
--
ALTER TABLE `business_category_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_category_relation_business_id_foreign` (`business_id`),
  ADD KEY `business_category_relation_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `businesses`
--
ALTER TABLE `businesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `businesses_categories`
--
ALTER TABLE `businesses_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `businesses_coordinates`
--
ALTER TABLE `businesses_coordinates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `businesses_locations`
--
ALTER TABLE `businesses_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `business_category_relation`
--
ALTER TABLE `business_category_relation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `businesses_coordinates`
--
ALTER TABLE `businesses_coordinates`
  ADD CONSTRAINT `businesses_coordinates_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `businesses_locations`
--
ALTER TABLE `businesses_locations`
  ADD CONSTRAINT `businesses_locations_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `business_category_relation`
--
ALTER TABLE `business_category_relation`
  ADD CONSTRAINT `business_category_relation_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `business_category_relation_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `businesses_categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
