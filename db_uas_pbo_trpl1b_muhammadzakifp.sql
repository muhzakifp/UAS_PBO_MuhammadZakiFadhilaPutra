-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2026 at 02:53 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_trpl1b_muhammadzakifp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_karyawan`
--

CREATE TABLE `tabel_karyawan` (
  `id_karyawan` int NOT NULL,
  `nama_karyawan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departemen` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari_kerja_masuk` int NOT NULL,
  `gaji_dasar_per_hari` int NOT NULL,
  `jenis_karyawan` enum('Kontrak','Tetap','Magang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `durasi_kontrak_bulan` int DEFAULT NULL,
  `agensi_penyalur` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tunjangan_kesehatan` int DEFAULT NULL,
  `opsi_saham_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uang_saku_bulanan` int DEFAULT NULL,
  `sertifikat_kampus_merdeka` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tabel_karyawan`
--

INSERT INTO `tabel_karyawan` (`id_karyawan`, `nama_karyawan`, `departemen`, `hari_kerja_masuk`, `gaji_dasar_per_hari`, `jenis_karyawan`, `durasi_kontrak_bulan`, `agensi_penyalur`, `tunjangan_kesehatan`, `opsi_saham_id`, `uang_saku_bulanan`, `sertifikat_kampus_merdeka`) VALUES
(1, 'Andi Wijaya', 'IT Support', 22, 150000, 'Kontrak', 12, 'PT Outsourcing Maju', NULL, NULL, NULL, NULL),
(2, 'Budi Santoso', 'Security', 20, 120000, 'Kontrak', 6, 'PT Garda Bangsa', NULL, NULL, NULL, NULL),
(3, 'Cici Amelia', 'Marketing', 24, 160000, 'Kontrak', 12, 'PT Kreatif Talent', NULL, NULL, NULL, NULL),
(4, 'Dedi Kurnia', 'Logistik', 21, 130000, 'Kontrak', 6, 'PT Outsourcing Maju', NULL, NULL, NULL, NULL),
(5, 'Eka Putri', 'Customer Service', 23, 140000, 'Kontrak', 24, 'PT Talent Nusantara', NULL, NULL, NULL, NULL),
(6, 'Fahmi Idris', 'GA', 19, 130000, 'Kontrak', 12, 'PT Garda Bangsa', NULL, NULL, NULL, NULL),
(7, 'Gita Permata', 'Sales', 25, 150000, 'Kontrak', 6, 'PT Kreatif Talent', NULL, NULL, NULL, NULL),
(8, 'Hendra Wijaya', 'Software Engineering', 22, 350000, 'Tetap', NULL, NULL, 500000, 'ESOP-TECH-001', NULL, NULL),
(9, 'Indah Lestari', 'Human Resources', 21, 300000, 'Tetap', NULL, NULL, 450000, 'ESOP-HR-002', NULL, NULL),
(10, 'Joko Susilo', 'Finance', 23, 320000, 'Tetap', NULL, NULL, 500000, 'ESOP-FIN-003', NULL, NULL),
(11, 'Kurniawati', 'Legal', 20, 310000, 'Tetap', NULL, NULL, 450000, 'ESOP-LEG-004', NULL, NULL),
(12, 'Laksana Adi', 'Product Management', 22, 400000, 'Tetap', NULL, NULL, 600000, 'ESOP-PROD-005', NULL, NULL),
(13, 'Mita Utami', 'Data Analyst', 24, 360000, 'Tetap', NULL, NULL, 500000, 'ESOP-DATA-006', NULL, NULL),
(14, 'Nugroho', 'DevOps', 21, 380000, 'Tetap', NULL, NULL, 550000, 'ESOP-OPS-007', NULL, NULL),
(15, 'Oki Ramadhan', 'Mobile Developer', 20, 50000, 'Magang', NULL, NULL, NULL, NULL, 1500000, 'MSIB-BATCH6-01'),
(16, 'Putri Alyaa', 'UI/UX Designer', 22, 50000, 'Magang', NULL, NULL, NULL, NULL, 1500000, 'MSIB-BATCH6-02'),
(17, 'Qomaruddin', 'QA Engineer', 18, 45000, 'Magang', NULL, NULL, NULL, NULL, 1200000, 'Non-Kampus-Merdeka'),
(18, 'Riska Amelia', 'Content Writer', 21, 45000, 'Magang', NULL, NULL, NULL, NULL, 1200000, 'MSIB-BATCH6-03'),
(19, 'Sultan Malik', 'Public Relations', 19, 50000, 'Magang', NULL, NULL, NULL, NULL, 1500000, 'MSIB-BATCH6-04'),
(20, 'Tania Salsabila', 'Cyber Security', 23, 55000, 'Magang', NULL, NULL, NULL, NULL, 1800000, 'MSIB-BATCH6-05'),
(21, 'Utomo Putra', 'Hardware Engineer', 20, 50000, 'Magang', NULL, NULL, NULL, NULL, 1500000, 'Non-Kampus-Merdeka');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  MODIFY `id_karyawan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
