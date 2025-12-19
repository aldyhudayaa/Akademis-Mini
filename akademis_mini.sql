-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 18, 2025 at 04:16 PM
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
-- Database: `akademis_mini`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` varchar(15) NOT NULL,
  `nama_dosen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nama_dosen`) VALUES
('01', 'Pak Aldy'),
('02', 'Pak Robo');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int NOT NULL,
  `id_mk` varchar(15) NOT NULL,
  `id_dosen` varchar(15) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `semester` varchar(5) NOT NULL,
  `ruangan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_mk`, `id_dosen`, `hari`, `jam_mulai`, `jam_selesai`, `semester`, `ruangan`) VALUES
(6, '02', '01', 'Selasa', '11:11:00', '12:12:00', '3', '204');

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `id_krs` int NOT NULL,
  `nim` varchar(15) NOT NULL,
  `id_jadwal` int NOT NULL,
  `nilai` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`id_krs`, `nim`, `id_jadwal`, `nilai`) VALUES
(10, '2405181048', 6, 'E');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `krs` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `krs`) VALUES
('2405181003', 'NAIZUL FAHMI NASUTION', NULL),
('2405181008', 'KHALILAH MEDYANA SYIFA', NULL),
('2405181013', 'JONATHAN CHRISTIAN SIANTURI', NULL),
('2405181018', 'TATIA WARDAH NASUTION', NULL),
('2405181023', 'NADDYA DAMANIK', NULL),
('2405181028', 'MUHAMMAD AUZAN QISTHI', NULL),
('2405181033', 'BUNGA ALYA MUKHBITA', NULL),
('2405181038', 'MUHAMMAD ARKAN NABAWI', NULL),
('2405181041', 'Muhammad Alamsyah Lubis', NULL),
('2405181043', 'LEO MARCHO SARAGIH', NULL),
('2405181048', 'MUHAMMAD ALDY HUDAYA', NULL),
('2405181053', 'NUR LIZA AZMI', NULL),
('2405181058', 'DAMAR PUTRA SYAFWAN', NULL),
('2405181063', 'JESSICA RACHEL BR MALAU', NULL),
('2405181068', 'RIDWAN AHMAD AL-KHOIR NASUTION', NULL),
('2405181078', 'DAFI GIBEA SINAGA', NULL),
('2405181083', 'BOBBY TRIPUTRA MAJID', NULL),
('2405181088', 'ERNESTO KEVIN LUMBAN TOBING', NULL),
('2405181093', 'ALIF ADITYA', NULL),
('2405181098', 'RAKHA AHMAD BAIHAQY HARAHAP', NULL),
('2405181103', 'NAJMI KHAIRURIZQA', NULL),
('2405181108', 'ABLE SUKI ROSEVELT SITINJAK', NULL),
('2405181113', 'JOHANNES WALLACE AGUNG RAMBE PURBA', NULL),
('2405181118', 'RASSID RISDA SULPA', NULL),
('2405181123', 'RICHARD NAEL SIREGAR', NULL),
('2405181128', 'ANITA ANGEL GRESSYA SIBARANI', NULL),
('2405181133', 'ANDREAS RIVALDO PARDEDE', NULL),
('2405181138', 'SATTAR FARI MUNTAZAR', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mk`
--

CREATE TABLE `mk` (
  `id_mk` varchar(15) NOT NULL,
  `nama_mk` varchar(50) DEFAULT NULL,
  `sks` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mk`
--

INSERT INTO `mk` (`id_mk`, `nama_mk`, `sks`) VALUES
('02', 'Algoritma & Pemrograman', 3),
('A03', 'Praktik Basis Data', 3),
('SIM01', 'Sistem Informasi Manajemen', 5),
('T01', 'Teori Graf', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `level` enum('admin','mahasiswa','dosen') DEFAULT 'mahasiswa',
  `nim` varchar(15) DEFAULT NULL,
  `id_dosen` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `level`, `nim`, `id_dosen`, `created_at`) VALUES
(1, 'admin', 'admin', 'Administrator', 'admin', NULL, NULL, '2025-12-10 18:03:58'),
(2, 'aldy', 'aldy123', 'Aldy Hudaya', 'admin', NULL, NULL, '2025-12-10 18:03:58'),
(3, 'dafi', 'dafi123', 'Dafi', 'admin', NULL, NULL, '2025-12-10 18:03:58'),
(5, 'dosen', 'dosen', 'Pak Aldy', 'dosen', NULL, '01', '2025-12-18 13:34:56'),
(6, '2405181048', '2405181048', 'Muhammad Aldy Hudaya', 'mahasiswa', '2405181048', NULL, '2025-12-18 15:30:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `fk_jadwal_mk` (`id_mk`),
  ADD KEY `fk_jadwal_dosen` (`id_dosen`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id_krs`),
  ADD KEY `fk_krs_mhs` (`nim`),
  ADD KEY `fk_krs_jadwal` (`id_jadwal`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `mk`
--
ALTER TABLE `mk`
  ADD PRIMARY KEY (`id_mk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_users_mahasiswa` (`nim`),
  ADD KEY `fk_users_dosen` (`id_dosen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `id_krs` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `fk_jadwal_dosen` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwal_mk` FOREIGN KEY (`id_mk`) REFERENCES `mk` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `fk_krs_jadwal` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_krs_mhs` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_dosen` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_mahasiswa` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
