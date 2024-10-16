-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Okt 2024 pada 09.19
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apoteku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_resep`
--

CREATE TABLE `detail_resep` (
  `ID_Detail_Resep` int(11) NOT NULL,
  `ID_Resep` int(11) DEFAULT NULL,
  `ID_Obat` int(11) DEFAULT NULL,
  `Jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_resep`
--

INSERT INTO `detail_resep` (`ID_Detail_Resep`, `ID_Resep`, `ID_Obat`, `Jumlah`) VALUES
(1, 1, 1, 10),
(2, 1, 3, 5),
(3, 2, 2, 7),
(4, 2, 3, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `ID_Dokter` int(11) NOT NULL,
  `NPI` varchar(20) DEFAULT NULL,
  `Nama_Dokter` varchar(100) NOT NULL,
  `Jenis_Kelamin` varchar(10) DEFAULT NULL,
  `Tanggal_Lahir` date DEFAULT NULL,
  `No_Telepon` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Alamat` text DEFAULT NULL,
  `Spesialisasi` varchar(50) DEFAULT NULL,
  `Status_Lisensi` varchar(20) DEFAULT NULL,
  `Tanggal_Lisensi` date DEFAULT NULL,
  `Nama_Institusi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`ID_Dokter`, `NPI`, `Nama_Dokter`, `Jenis_Kelamin`, `Tanggal_Lahir`, `No_Telepon`, `Email`, `Alamat`, `Spesialisasi`, `Status_Lisensi`, `Tanggal_Lisensi`, `Nama_Institusi`) VALUES
(1, 'D123456', 'Dr. Sinta Karina', 'Perempuan', '1980-05-12', '081234567890', 'sinta.karina@klinik.com', 'Jl. Mawar No. 10, Jakarta', 'Umum', 'Aktif', '2021-07-01', 'Universitas Indonesia'),
(2, 'D654321', 'Dr. Bimo Nugroho', 'Laki-laki', '1975-08-23', '081987654321', 'bimo.nugroho@klinik.com', 'Jl. Melati No. 5, Bandung', 'Spesialis Penyakit Dalam', 'Aktif', '2020-09-15', 'Universitas Gadjah Mada');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `ID_Karyawan` int(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `No_Telepon` varchar(20) DEFAULT NULL,
  `Jabatan` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`ID_Karyawan`, `Nama`, `No_Telepon`, `Jabatan`, `username`, `password`) VALUES
(1, 'Andi Prasetyo', '081234123456', 'Apoteker', 'andi', 'Andi123'),
(2, 'Budi Santoso', '081234987654', 'Kasir', 'budi', 'Budi123'),
(3, 'Citra Dewi', '081234112233', 'Asisten Apoteker', 'citra', 'Citra123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `ID_Obat` int(11) NOT NULL,
  `Nama_Obat` varchar(100) NOT NULL,
  `Code` varchar(20) DEFAULT NULL,
  `Formulasi` varchar(50) DEFAULT NULL,
  `Tanggal_Kadaluarsa` date DEFAULT NULL,
  `Stok` int(11) DEFAULT NULL,
  `ID_Supplier` int(11) DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL,
  `Package` varchar(20) DEFAULT NULL,
  `Harga_Beli` decimal(10,2) DEFAULT NULL,
  `Harga_Jual` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`ID_Obat`, `Nama_Obat`, `Code`, `Formulasi`, `Tanggal_Kadaluarsa`, `Stok`, `ID_Supplier`, `Status`, `Package`, `Harga_Beli`, `Harga_Jual`) VALUES
(1, 'Paracetamol', 'P001', 'Tablet', '2025-12-31', 100, 1, 'Tersedia', 'Strip', 1500.00, 3000.00),
(2, 'Amoxicillin', 'A001', 'Kapsul', '2024-11-30', 200, 2, 'Tersedia', 'Botol', 2500.00, 5000.00),
(3, 'Vitamin C', 'V001', 'Tablet', '2026-06-30', 300, 3, 'Tersedia', 'Strip', 1000.00, 2000.00),
(4, 'Amoxicillin', 'A001', 'Kapsul', '2026-11-30', 200, 2, 'Tersedia', 'Botol', 2500.00, 5000.00),
(5, 'Paracetamol', 'P001', 'Tablet', '2027-12-31', 100, 1, 'Tersedia', 'Strip', 1500.00, 3000.00),
(6, 'Vitamin C', 'V001', 'Tablet', '2028-06-30', 300, 3, 'Tersedia', 'Strip', 1000.00, 2000.00),
(7, 'Ibuprofen', 'I001', 'Kapsul', '2025-05-20', 150, 2, 'Tersedia', 'Dus', 2000.00, 4000.00),
(8, 'Naproxen', 'N001', 'Tablet', '2025-04-15', 250, 4, 'Tersedia', 'Botol', 1800.00, 3600.00),
(9, 'Aspirin', 'A002', 'Tablet', '2026-03-10', 120, 3, 'Tersedia', 'Strip', 1200.00, 2400.00),
(10, 'Cetirizine', 'C001', 'Kapsul', '2027-01-05', 200, 1, 'Tersedia', 'Dus', 1600.00, 3200.00),
(11, 'Loratadine', 'L001', 'Tablet', '2026-12-25', 90, 2, 'Tersedia', 'Botol', 1400.00, 2800.00),
(12, 'Omeprazole', 'O001', 'Kapsul', '2025-11-20', 300, 3, 'Tersedia', 'Strip', 1700.00, 3400.00),
(13, 'Simvastatin', 'S001', 'Tablet', '2026-10-10', 180, 1, 'Tersedia', 'Dus', 1500.00, 3000.00),
(14, 'Atorvastatin', 'A003', 'Tablet', '2027-09-01', 75, 4, 'Habis', 'Botol', 2200.00, 4400.00),
(15, 'Levothyroxine', 'L002', 'Tablet', '2026-08-15', 130, 2, 'Tersedia', 'Strip', 1600.00, 3200.00),
(16, 'Metformin', 'M001', 'Tablet', '2025-07-05', 200, 3, 'Tersedia', 'Dus', 1100.00, 2200.00),
(17, 'Amoxicillin-Clavulanate', 'A004', 'Kapsul', '2027-06-10', 180, 1, 'Tersedia', 'Botol', 1800.00, 3600.00),
(18, 'Gabapentin', 'G001', 'Kapsul', '2025-12-01', 90, 4, 'Habis', 'Strip', 2000.00, 4000.00),
(19, 'Lisinopril', 'L003', 'Tablet', '2026-11-30', 300, 2, 'Tersedia', 'Dus', 1900.00, 3800.00),
(20, 'Furosemide', 'F001', 'Tablet', '2025-10-15', 150, 3, 'Tersedia', 'Botol', 1700.00, 3400.00),
(21, 'Metoprolol', 'M002', 'Tablet', '2026-09-20', 110, 1, 'Tersedia', 'Strip', 1300.00, 2600.00),
(22, 'Amlodipine', 'A005', 'Kapsul', '2027-08-01', 95, 4, 'Tersedia', 'Dus', 1600.00, 3200.00),
(23, 'Losartan', 'L004', 'Tablet', '2026-07-05', 250, 2, 'Habis', 'Botol', 1800.00, 3600.00),
(24, 'Diclofenac', 'D001', 'Kapsul', '2025-06-15', 200, 1, 'Tersedia', 'Strip', 2000.00, 4000.00),
(25, 'Ranitidine', 'R001', 'Tablet', '2026-05-30', 180, 3, 'Tersedia', 'Dus', 1600.00, 3200.00),
(26, 'Fluoxetine', 'F002', 'Kapsul', '2025-04-25', 220, 4, 'Tersedia', 'Botol', 1400.00, 2800.00),
(27, 'Sertraline', 'S002', 'Tablet', '2027-03-10', 130, 2, 'Tersedia', 'Strip', 1700.00, 3400.00),
(28, 'Citalopram', 'C002', 'Tablet', '2026-02-15', 90, 1, 'Tersedia', 'Dus', 1500.00, 3000.00),
(29, 'Metronidazole', 'M003', 'Tablet', '2025-01-01', 300, 3, 'Tersedia', 'Botol', 1100.00, 2200.00),
(30, 'Clindamycin', 'C003', 'Kapsul', '2027-11-20', 80, 4, 'Habis', 'Strip', 1300.00, 2600.00),
(31, 'Tramadol', 'T001', 'Tablet', '2026-12-10', 210, 1, 'Tersedia', 'Dus', 1900.00, 3800.00),
(32, 'Codeine', 'C004', 'Tablet', '2025-12-30', 150, 2, 'Tersedia', 'Botol', 1500.00, 3000.00),
(33, 'Prednisone', 'P002', 'Tablet', '2027-06-15', 300, 3, 'Tersedia', 'Strip', 2200.00, 4400.00),
(34, 'Dexamethasone', 'D002', 'Kapsul', '2026-07-01', 90, 4, 'Tersedia', 'Dus', 1800.00, 3600.00),
(35, 'Lansoprazole', 'L005', 'Tablet', '2025-08-20', 200, 2, 'Habis', 'Botol', 1600.00, 3200.00),
(36, 'Celecoxib', 'C005', 'Kapsul', '2027-01-05', 175, 1, 'Tersedia', 'Strip', 2000.00, 4000.00),
(37, 'Duloxetine', 'D003', 'Kapsul', '2026-12-25', 130, 3, 'Tersedia', 'Dus', 1900.00, 3800.00),
(38, 'Sildenafil', 'S003', 'Tablet', '2025-10-10', 180, 4, 'Tersedia', 'Botol', 1700.00, 3400.00),
(39, 'Tadalafil', 'T002', 'Tablet', '2027-03-15', 220, 2, 'Tersedia', 'Strip', 1400.00, 2800.00),
(40, 'Finasteride', 'F004', 'Tablet', '2025-04-05', 300, 1, 'Tersedia', 'Dus', 1600.00, 3200.00),
(41, 'Risperidone', 'R002', 'Tablet', '2026-05-30', 190, 3, 'Tersedia', 'Botol', 1200.00, 2400.00),
(42, 'Quetiapine', 'Q001', 'Tablet', '2027-07-25', 100, 4, 'Tersedia', 'Strip', 1500.00, 3000.00),
(43, 'Aripiprazole', 'A006', 'Tablet', '2026-08-20', 210, 2, 'Habis', 'Dus', 1700.00, 3400.00),
(44, 'Zolpidem', 'Z001', 'Tablet', '2025-12-15', 80, 1, 'Tersedia', 'Botol', 1300.00, 2600.00),
(45, 'Lithium', 'L006', 'Tablet', '2027-05-10', 120, 3, 'Tersedia', 'Strip', 1600.00, 3200.00),
(46, 'Clozapine', 'C006', 'Tablet', '2026-06-25', 300, 4, 'Habis', 'Dus', 1800.00, 3600.00),
(47, 'Bupropion', 'B001', 'Tablet', '2027-04-10', 150, 2, 'Tersedia', 'Botol', 1400.00, 2800.00),
(48, 'Buspirone', 'B002', 'Tablet', '2025-03-20', 90, 1, 'Tersedia', 'Strip', 1500.00, 3000.00),
(49, 'Varenicline', 'V002', 'Tablet', '2026-02-05', 200, 3, 'Tersedia', 'Dus', 1700.00, 3400.00),
(50, 'Mirtazapine', 'M004', 'Tablet', '2025-01-15', 300, 4, 'Habis', 'Botol', 1900.00, 3800.00),
(51, 'Rivastigmine', 'R003', 'Kapsul', '2027-11-01', 80, 2, 'Tersedia', 'Strip', 1800.00, 3600.00),
(52, 'Memantine', 'M005', 'Tablet', '2026-12-12', 250, 1, 'Tersedia', 'Dus', 1500.00, 3000.00),
(53, 'Dopamine', 'D004', 'Kapsul', '2025-09-09', 150, 3, 'Tersedia', 'Botol', 1700.00, 3400.00),
(54, 'Serotonin', 'S004', 'Tablet', '2026-08-17', 300, 4, 'Tersedia', 'Strip', 1600.00, 3200.00),
(55, 'Oxytocin', 'O002', 'Kapsul', '2025-07-22', 200, 2, 'Tersedia', 'Dus', 1400.00, 2800.00),
(56, 'Insulin', 'I002', 'Kapsul', '2027-05-30', 90, 1, 'Habis', 'Botol', 1900.00, 3800.00),
(57, 'Ketorolac', 'K002', 'Tablet', '2026-04-05', 120, 3, 'Tersedia', 'Strip', 1700.00, 3400.00),
(58, 'Amiodarone', 'A007', 'Kapsul', '2027-03-12', 200, 4, 'Tersedia', 'Dus', 1600.00, 3200.00),
(59, 'Colchicine', 'C007', 'Tablet', '2026-02-10', 90, 2, 'Tersedia', 'Botol', 1500.00, 3000.00),
(60, 'Hydrochlorothiazide', 'H001', 'Tablet', '2025-01-15', 300, 1, 'Habis', 'Strip', 1100.00, 2200.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `ID_Pasien` int(11) NOT NULL,
  `ID_Eksternal` varchar(20) DEFAULT NULL,
  `Nama_Lengkap` varchar(100) NOT NULL,
  `Nama_Panggilan` varchar(50) DEFAULT NULL,
  `Jenis_Kelamin` varchar(10) DEFAULT NULL,
  `Tanggal_Lahir` date DEFAULT NULL,
  `Ras` varchar(50) DEFAULT NULL,
  `Alamat` text DEFAULT NULL,
  `Kode_Negara` varchar(10) DEFAULT NULL,
  `No_Telp` varchar(20) DEFAULT NULL,
  `Bahasa_Utama` varchar(20) DEFAULT NULL,
  `Status_Pernikahan` varchar(20) DEFAULT NULL,
  `No_Rekening` varchar(30) DEFAULT NULL,
  `Kewarganegaraan` varchar(20) DEFAULT NULL,
  `Indikator_Meninggal` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`ID_Pasien`, `ID_Eksternal`, `Nama_Lengkap`, `Nama_Panggilan`, `Jenis_Kelamin`, `Tanggal_Lahir`, `Ras`, `Alamat`, `Kode_Negara`, `No_Telp`, `Bahasa_Utama`, `Status_Pernikahan`, `No_Rekening`, `Kewarganegaraan`, `Indikator_Meninggal`) VALUES
(1, 'P001', 'Ali Maulana', 'Ali', 'Laki-laki', '1990-02-15', 'Asia', 'Jl. Merdeka No. 123, Jakarta', 'ID', '081234567890', 'Indonesia', 'Menikah', '1234567890', 'Indonesia', 0),
(2, 'P002', 'Siti Fatimah', 'Siti', 'Perempuan', '1985-11-20', 'Asia', 'Jl. Proklamasi No. 456, Bandung', 'ID', '081987654321', 'Indonesia', 'Menikah', '0987654321', 'Indonesia', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep`
--

CREATE TABLE `resep` (
  `ID_Resep` int(11) NOT NULL,
  `ID_Pasien` int(11) DEFAULT NULL,
  `ID_Karyawan` int(11) DEFAULT NULL,
  `ID_Dokter` int(11) DEFAULT NULL,
  `Tanggal_Resep` date DEFAULT NULL,
  `Catatan_Resep` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `resep`
--

INSERT INTO `resep` (`ID_Resep`, `ID_Pasien`, `ID_Karyawan`, `ID_Dokter`, `Tanggal_Resep`, `Catatan_Resep`) VALUES
(1, 1, 1, 1, '2024-10-01', 'Minum obat setiap 8 jam sekali'),
(2, 2, 3, 2, '2024-10-05', 'Obat diminum setelah makan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `ID_Supplier` int(11) NOT NULL,
  `Nama_Supplier` varchar(100) NOT NULL,
  `Kontak` varchar(50) DEFAULT NULL,
  `Alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`ID_Supplier`, `Nama_Supplier`, `Kontak`, `Alamat`) VALUES
(1, 'PT Obat Sehat', '081234567890', 'Jl. Sehat No. 123, Jakarta'),
(2, 'PT Sumber Obat', '081987654321', 'Jl. Kesehatan No. 456, Bandung'),
(3, 'PT Obat Mandiri', '081223344556', 'Jl. Mandiri No. 789, Surabaya'),
(4, 'PT.Anugrah Argon Medica	', '07616700121', 'Jl.SM.Amin No.169 A-F RT 01 RW 17 Kel.Simpang Baru Kec.Tampan Pekanbaru	'),
(5, 'PT Enseval Putra Megatrading	', '07616704288	', 'Jl.Garuda Sakti Km 8 Karya Indah Tapung Kab.Kampar	');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `ID_Transaksi` int(11) NOT NULL,
  `ID_Karyawan` int(11) DEFAULT NULL,
  `ID_Pasien` int(11) DEFAULT NULL,
  `Tanggal_Transaksi` datetime DEFAULT NULL,
  `Total_Harga` decimal(10,2) DEFAULT NULL,
  `Total_Bayar` decimal(10,2) DEFAULT NULL,
  `Kembali` decimal(10,2) GENERATED ALWAYS AS (`Total_Bayar` - `Total_Harga`) VIRTUAL,
  `Sumber_Pembayaran` varchar(50) DEFAULT NULL,
  `ID_Resep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`ID_Transaksi`, `ID_Karyawan`, `ID_Pasien`, `Tanggal_Transaksi`, `Total_Harga`, `Total_Bayar`, `Sumber_Pembayaran`, `ID_Resep`) VALUES
(5, 1, 1, '2024-10-03 00:00:00', 75000.00, 100000.00, 'BPJS', 1),
(6, 1, 1, '2024-10-03 00:00:00', 32.00, NULL, 'dsd', 1),
(7, 1, 1, '2024-10-03 00:00:00', 32.00, NULL, 'dsd', 1),
(8, 1, 1, '2024-10-03 00:00:00', 32.00, NULL, 'dsd', 1),
(9, 1, NULL, '2024-10-03 00:00:00', 32.00, NULL, 'dsd', 1),
(10, 1, NULL, '2024-10-03 00:00:00', 32.00, NULL, 'dsd', 1),
(11, 1, 1, '2024-10-16 00:00:00', 270000.00, 300000.00, 'Cash', NULL),
(12, 1, 1, '2024-10-16 00:00:00', 270000.00, 300000.00, 'Cash', NULL),
(13, 3, 2, '2024-11-11 00:00:00', 145000.00, 150000.00, 'Cash', NULL),
(14, 1, 1, '2024-10-16 00:00:00', 58000.00, 60000.00, 'BPJS', NULL),
(89699401, 1, 1, '2024-10-16 00:00:00', 9000.00, 10000.00, 'BPJS', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_resep`
--
ALTER TABLE `detail_resep`
  ADD PRIMARY KEY (`ID_Detail_Resep`),
  ADD KEY `ID_Resep` (`ID_Resep`),
  ADD KEY `ID_Obat` (`ID_Obat`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`ID_Dokter`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`ID_Karyawan`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`ID_Obat`),
  ADD KEY `ID_Supplier` (`ID_Supplier`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`ID_Pasien`);

--
-- Indeks untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`ID_Resep`),
  ADD KEY `ID_Pasien` (`ID_Pasien`),
  ADD KEY `ID_Karyawan` (`ID_Karyawan`),
  ADD KEY `ID_Dokter` (`ID_Dokter`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`ID_Supplier`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`ID_Transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_resep`
--
ALTER TABLE `detail_resep`
  MODIFY `ID_Detail_Resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `ID_Dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `ID_Karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `ID_Obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `ID_Pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `resep`
--
ALTER TABLE `resep`
  MODIFY `ID_Resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `ID_Supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `ID_Transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89699402;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_resep`
--
ALTER TABLE `detail_resep`
  ADD CONSTRAINT `detail_resep_ibfk_1` FOREIGN KEY (`ID_Resep`) REFERENCES `resep` (`ID_Resep`),
  ADD CONSTRAINT `detail_resep_ibfk_2` FOREIGN KEY (`ID_Obat`) REFERENCES `obat` (`ID_Obat`);

--
-- Ketidakleluasaan untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `obat_ibfk_1` FOREIGN KEY (`ID_Supplier`) REFERENCES `supplier` (`ID_Supplier`);

--
-- Ketidakleluasaan untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`ID_Pasien`) REFERENCES `pasien` (`ID_Pasien`),
  ADD CONSTRAINT `resep_ibfk_2` FOREIGN KEY (`ID_Karyawan`) REFERENCES `karyawan` (`ID_Karyawan`),
  ADD CONSTRAINT `resep_ibfk_3` FOREIGN KEY (`ID_Dokter`) REFERENCES `dokter` (`ID_Dokter`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
