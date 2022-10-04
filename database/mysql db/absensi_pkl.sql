-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Okt 2022 pada 11.59
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_pkl`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absens`
--

CREATE TABLE `absens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `absens`
--

INSERT INTO `absens` (`id`, `user_id`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Datang', 1, '2022-10-03 04:00:00', '2022-10-02 21:00:54'),
(2, 1, 'Pulang', 0, '2022-10-03 10:00:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `catatans`
--

CREATE TABLE `catatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kegiatan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `catatans`
--

INSERT INTO `catatans` (`id`, `catatan`, `user_id`, `kegiatan_id`, `created_at`, `updated_at`) VALUES
(1, 'tidak ada', 1, 1, '2022-10-02 22:12:21', '2022-10-02 22:17:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan_harians`
--

CREATE TABLE `kegiatan_harians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `projek_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kegiatan_harians`
--

INSERT INTO `kegiatan_harians` (`id`, `kegiatan`, `user_id`, `projek_id`, `created_at`, `updated_at`) VALUES
(1, 'Menambahkan dan mengumpulkan frontend komponen', 1, 2, '2022-10-02 21:36:49', '2022-10-02 21:42:02'),
(2, 'Membuat form semua field', 1, 2, '2022-10-03 22:56:36', '2022-10-03 22:56:36'),
(3, 'menyiapkan komponen dan dpendensi', 1, 3, '2022-10-03 22:56:56', '2022-10-03 22:56:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `projeks`
--

CREATE TABLE `projeks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_projek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `projeks`
--

INSERT INTO `projeks` (`id`, `nama_projek`, `deskripsi`, `keterangan`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Dinas Pertanian - Web Aplikasi Jalan Pertanian', 'Manajemen pembangunan infrastruktur dan perawatan Dinas Pertanian Batu', 'fixing frontend', 1, 1, '2022-10-02 20:59:13', '2022-10-02 20:59:19'),
(2, 'HIPPAM Gresik', 'Manajemen pembangunan dan perawatan infrastruktur daerah air minum bersih di Gresik', 'build and fixing frontend', 0, 1, '2022-10-02 21:00:01', '2022-10-02 21:00:01'),
(3, 'SIM Harian PKL', 'Manajemen harian kegiatan PKL', 'full stack', 0, 1, '2022-10-02 21:00:27', '2022-10-02 21:00:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `kode`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'ADM', 'Admin', '2022-10-03 06:54:04', NULL),
(2, 'USR', 'User', '2022-10-02 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nursukma', 'nursukma', 'nursukma@gmail.com', NULL, '$2y$10$fBtdizti15rNpeKC/LlWSOnE7uj9UoOfS3zYfnOF/KoxOP2CDyytO', 1, NULL, '2022-10-03 03:52:02', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absens`
--
ALTER TABLE `absens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_absens` (`user_id`);

--
-- Indeks untuk tabel `catatans`
--
ALTER TABLE `catatans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_catatans` (`user_id`),
  ADD KEY `fk_kegiatans_catatans` (`kegiatan_id`);

--
-- Indeks untuk tabel `kegiatan_harians`
--
ALTER TABLE `kegiatan_harians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_kegiatans` (`user_id`);

--
-- Indeks untuk tabel `projeks`
--
ALTER TABLE `projeks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_projeks` (`user_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `fk_roles_users` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absens`
--
ALTER TABLE `absens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `catatans`
--
ALTER TABLE `catatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kegiatan_harians`
--
ALTER TABLE `kegiatan_harians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `projeks`
--
ALTER TABLE `projeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absens`
--
ALTER TABLE `absens`
  ADD CONSTRAINT `fk_users_absens` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `catatans`
--
ALTER TABLE `catatans`
  ADD CONSTRAINT `fk_kegiatans_catatans` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan_harians` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_catatans` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kegiatan_harians`
--
ALTER TABLE `kegiatan_harians`
  ADD CONSTRAINT `fk_users_kegiatans` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `projeks`
--
ALTER TABLE `projeks`
  ADD CONSTRAINT `fk_users_projeks` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_roles_users` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Event
--
CREATE DEFINER=`root`@`localhost` EVENT `absens_pulang` ON SCHEDULE EVERY 1 DAY STARTS '2022-10-05 17:00:00' ON COMPLETION PRESERVE ENABLE DO BEGIN
        IF DAYOFWEEK(curdate()) between 2 and 6 then
  			INSERT INTO absens(user_id,status,keterangan,created_at)
  			values(1,0,"Pulang",NOW());
        END IF;
    END$$

CREATE DEFINER=`root`@`localhost` EVENT `absens_datang` ON SCHEDULE EVERY 1 DAY STARTS '2022-10-05 10:00:00' ON COMPLETION PRESERVE ENABLE DO BEGIN
        IF DAYOFWEEK(curdate()) between 2 and 6 then
  			INSERT INTO absens(user_id,status,keterangan,created_at)
  			values(1,0,"Datang",NOW());
        END IF;
    END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
