-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Bulan Mei 2026 pada 14.58
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_jurnal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensis`
--

CREATE TABLE `absensis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jurnal_id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Hadir','Sakit','Izin','Alpa') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `absensis`
--

INSERT INTO `absensis` (`id`, `jurnal_id`, `siswa_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 2, 20, 'Alpa', '2026-05-19 22:31:54', '2026-05-19 22:31:54'),
(4, 2, 21, 'Alpa', '2026-05-19 22:31:54', '2026-05-19 22:31:54'),
(7, 5, 1, 'Alpa', '2026-05-20 04:20:54', '2026-05-20 04:20:54'),
(8, 5, 2, 'Alpa', '2026-05-20 04:20:54', '2026-05-20 04:20:54'),
(9, 5, 3, 'Alpa', '2026-05-20 04:20:54', '2026-05-20 04:20:54'),
(10, 7, 1, 'Alpa', '2026-05-20 04:53:37', '2026-05-20 04:53:37'),
(11, 7, 2, 'Alpa', '2026-05-20 04:53:37', '2026-05-20 04:53:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnals`
--

CREATE TABLE `jurnals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `mapel_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `jam_pelajaran` varchar(255) NOT NULL,
  `pertemuan_ke` int(11) NOT NULL,
  `materi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jurnals`
--

INSERT INTO `jurnals` (`id`, `tanggal`, `user_id`, `mapel_id`, `kelas_id`, `jam_pelajaran`, `pertemuan_ke`, `materi`, `created_at`, `updated_at`) VALUES
(2, '2026-05-20', 1, 1, 1, '1-4', 1, NULL, '2026-05-19 22:31:54', '2026-05-19 22:31:54'),
(5, '2026-05-20', 1, 1, 1, '1-4', 1, 'haha', '2026-05-20 04:20:54', '2026-05-20 04:20:54'),
(7, '2026-05-20', 1, 1, 1, '1-4', 1, NULL, '2026-05-20 04:53:37', '2026-05-20 04:53:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `created_at`, `updated_at`) VALUES
(1, 'XI RPL 2', '2026-05-19 06:36:08', '2026-05-19 06:36:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapels`
--

CREATE TABLE `mapels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_mapel` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mapels`
--

INSERT INTO `mapels` (`id`, `nama_mapel`, `created_at`, `updated_at`) VALUES
(1, 'Pemrograman Web', '2026-05-19 06:36:08', '2026-05-19 06:36:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2026_05_07_014957_create_kelas_table', 1),
(3, '2026_05_07_015035_create_mapels_table', 1),
(4, '2026_05_07_015058_create_siswas_table', 1),
(5, '2026_05_07_015154_create_jurnals_table', 1),
(6, '2026_05_07_024353_create_absensis_table', 1),
(7, '2026_05_07_031816_make_materi_nullable_in_jurnals_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FsZLQWGgrCGghjD3wLHqUqeELVOCMKauPQexKgBh', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTUdzRUhGY2VId3hBejhnbjRMQWlKczJPcU5mc2RCMUJpSGhQOGd2NSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1779281809);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswas`
--

CREATE TABLE `siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `no_absen` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswas`
--

INSERT INTO `siswas` (`id`, `kelas_id`, `nama_siswa`, `no_absen`, `created_at`, `updated_at`) VALUES
(1, 1, 'Alfonda Frederick Karmacenna Ritonga', 1, NULL, NULL),
(2, 1, 'Anak Agung Kompyang Agung Ardhinata Sanjaya', 2, NULL, NULL),
(3, 1, 'Anak Agung Laksmi Bintang Indryani', 3, NULL, NULL),
(4, 1, 'Anak Agung Ngurah Agung Kusuma Yoga', 4, NULL, NULL),
(5, 1, 'Anindhita Anjani Putri Kusumadjaya', 5, NULL, NULL),
(6, 1, 'Dewa Putu Kresna Putra Pratama', 6, NULL, NULL),
(7, 1, 'Dieva Nayzila Putri', 7, NULL, NULL),
(8, 1, 'Dimas Kurniawan Haqiqi', 8, NULL, NULL),
(9, 1, 'Falihah Nailatusy Syarafah', 9, NULL, NULL),
(10, 1, 'Gede Prabha Dananjaya', 10, NULL, NULL),
(11, 1, 'Gede Putra Wijaya', 11, NULL, NULL),
(12, 1, 'I Gede Dharma Sumanditha Yasa', 12, NULL, NULL),
(13, 1, 'I Gede Sastra Wiguna', 13, NULL, NULL),
(14, 1, 'I Gusti Agung Made Damma AriKusuma', 14, NULL, NULL),
(15, 1, 'I Gusti Ayu Ari Marcella Setiawan', 15, NULL, NULL),
(16, 1, 'I Kadek Ready Udiyana Priananda', 16, NULL, NULL),
(17, 1, 'I Ketut Margayu Sinartha', 17, NULL, NULL),
(18, 1, 'Komang Agus Anggara Dipa', 18, NULL, NULL),
(19, 1, 'I Komang Arya Putra Widnyana', 19, NULL, NULL),
(20, 1, 'I Komang Widi Astawa Jaya', 20, NULL, NULL),
(21, 1, 'I Made Adiputra Sedana', 21, NULL, NULL),
(22, 1, 'I Made Danuyasa', 22, NULL, NULL),
(23, 1, 'I Made Okta Dwi Samiartha', 23, NULL, NULL),
(24, 1, 'I Nyoman Arta Suputra', 24, NULL, NULL),
(25, 1, 'I Putu Bagas Wikananda', 25, NULL, NULL),
(26, 1, 'I Putu Egik Krisnanta', 26, NULL, NULL),
(27, 1, 'I Putu Radisthyana Paramarta', 27, NULL, NULL),
(28, 1, 'I Wayan Trijata Ananda Putra', 28, NULL, NULL),
(29, 1, 'Ida Ayu Anggie Aristya Nareswari', 29, NULL, NULL),
(30, 1, 'Ida Bagus Mas Candra Wibawa', 30, NULL, NULL),
(31, 1, 'Ida Bagus Putu Sanjaya', 31, NULL, NULL),
(32, 1, 'Kadek Agus Arya Pranata', 32, NULL, NULL),
(33, 1, 'Kadek Jaya Pratama Tanuwibawa', 33, NULL, NULL),
(34, 1, 'M. Rafi Anwar', 34, NULL, NULL),
(35, 1, 'Moch Ilham Fathurohman Iswahyudi', 35, NULL, NULL),
(36, 1, 'Nadilla Udayani', 36, NULL, NULL),
(37, 1, 'Ni Kadek Sri Devi Dharmaning Putri', 37, NULL, NULL),
(38, 1, 'Ni Made Dinda Putri Surandina', 38, NULL, NULL),
(39, 1, 'Ni Putu Srie Cahya Wulandari', 39, NULL, NULL),
(40, 1, 'Pande Putu JanmaJyestha Khuswanta', 40, NULL, NULL),
(41, 1, 'Putu Meyta Saskya Putri', 41, NULL, NULL),
(42, 1, 'Rizky Ramadhan', 42, NULL, NULL),
(43, 1, 'Surya Nur Hardiwan Saputra', 43, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '', NULL, '1234', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensis`
--
ALTER TABLE `absensis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensis_jurnal_id_foreign` (`jurnal_id`),
  ADD KEY `absensis_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `jurnals`
--
ALTER TABLE `jurnals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurnals_user_id_foreign` (`user_id`),
  ADD KEY `jurnals_mapel_id_foreign` (`mapel_id`),
  ADD KEY `jurnals_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mapels`
--
ALTER TABLE `mapels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswas_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensis`
--
ALTER TABLE `absensis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `jurnals`
--
ALTER TABLE `jurnals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mapels`
--
ALTER TABLE `mapels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensis`
--
ALTER TABLE `absensis`
  ADD CONSTRAINT `absensis_jurnal_id_foreign` FOREIGN KEY (`jurnal_id`) REFERENCES `jurnals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensis_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jurnals`
--
ALTER TABLE `jurnals`
  ADD CONSTRAINT `jurnals_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `jurnals_mapel_id_foreign` FOREIGN KEY (`mapel_id`) REFERENCES `mapels` (`id`),
  ADD CONSTRAINT `jurnals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD CONSTRAINT `siswas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
