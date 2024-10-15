-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 04:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
-- Table structure for table `detail_resep`
--

CREATE TABLE `detail_resep` (
  `ID_Detail_Resep` int(11) NOT NULL,
  `ID_Resep` int(11) DEFAULT NULL,
  `ID_Obat` int(11) DEFAULT NULL,
  `Jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_resep`
--

INSERT INTO `detail_resep` (`ID_Detail_Resep`, `ID_Resep`, `ID_Obat`, `Jumlah`) VALUES
(1, 1, 1, 10),
(3, 2, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
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
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`ID_Dokter`, `NPI`, `Nama_Dokter`, `Jenis_Kelamin`, `Tanggal_Lahir`, `No_Telepon`, `Email`, `Alamat`, `Spesialisasi`, `Status_Lisensi`, `Tanggal_Lisensi`, `Nama_Institusi`) VALUES
(1, 'D123456', 'Dr. Sinta Karina', 'Perempuan', '1980-05-12', '081234567890', 'sinta.karina@klinik.com', 'Jl. Mawar No. 10, Jakarta', 'Umum', 'Aktif', '2021-07-01', 'Universitas Indonesia'),
(2, 'D654321', 'Dr. Bimo Nugroho', 'Laki-laki', '1975-08-23', '081987654321', 'bimo.nugroho@klinik.com', 'Jl. Melati No. 5, Bandung', 'Spesialis Penyakit Dalam', 'Aktif', '2020-09-15', 'Universitas Gadjah Mada');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
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
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`ID_Karyawan`, `Nama`, `No_Telepon`, `Jabatan`, `username`, `password`) VALUES
(1, 'Andi Prasety', '081234123456', 'Apoteker', 'andi', 'Andi123'),
(2, 'Budi Santoso', '081234987654', 'Kasir', 'budi', 'Budi123'),
(3, 'Citra Dewi', '081234112233', 'Asisten Apoteker', 'citra', 'Citra123');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
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
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`ID_Obat`, `Nama_Obat`, `Code`, `Formulasi`, `Tanggal_Kadaluarsa`, `Stok`, `ID_Supplier`, `Status`, `Package`, `Harga_Beli`, `Harga_Jual`) VALUES
(1, 'Paracetamol', 'P001', 'Tablet', '2025-12-31', 100, 1, 'Tersedia', 'Strip', 1500.00, 5000.00),
(2, 'Amoxicillin', 'A001', 'Kapsul', '2024-11-30', 200, 2, 'Tersedia', 'Botol', 2500.00, 5000.00);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
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
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`ID_Pasien`, `ID_Eksternal`, `Nama_Lengkap`, `Nama_Panggilan`, `Jenis_Kelamin`, `Tanggal_Lahir`, `Ras`, `Alamat`, `Kode_Negara`, `No_Telp`, `Bahasa_Utama`, `Status_Pernikahan`, `No_Rekening`, `Kewarganegaraan`, `Indikator_Meninggal`) VALUES
(1, 'P001', 'Ali Maulana', 'Ali', 'Laki-laki', '1990-02-15', 'Asia', 'Jl. Merdeka No. 123, Jakarta', 'ID', '081234567890', 'Indonesia', 'Menikah', '1234567890', 'Indonesia', 0),
(2, 'P002', 'Siti Fatimah', 'Siti', 'Perempuan', '1985-11-20', 'Asia', 'Jl. Proklamasi No. 456, Bandung', 'ID', '081987654321', 'Indonesia', 'Menikah', '0987654321', 'Indonesia', 0);

-- --------------------------------------------------------

--
-- Table structure for table `resep`
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
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`ID_Resep`, `ID_Pasien`, `ID_Karyawan`, `ID_Dokter`, `Tanggal_Resep`, `Catatan_Resep`) VALUES
(1, 1, 1, 1, '2024-10-01', 'Minum obat setiap 8 jam sekali'),
(2, 2, 3, 2, '2024-10-05', 'Obat diminum setelah makan');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `ID_Supplier` int(11) NOT NULL,
  `Nama_Supplier` varchar(100) NOT NULL,
  `Kontak` varchar(50) DEFAULT NULL,
  `Alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`ID_Supplier`, `Nama_Supplier`, `Kontak`, `Alamat`) VALUES
(1, 'PT Obat Sehat', '081234567890', 'Jl. Sehat No. 123, Jakarta'),
(2, 'PT Sumber Obat', '081987654321', 'Jl. Kesehatan No. 456, Bandung'),
(3, 'PT Obat Mandiri', '081223344556', 'Jl. Mandiri No. 789, Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
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
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`ID_Transaksi`, `ID_Karyawan`, `ID_Pasien`, `Tanggal_Transaksi`, `Total_Harga`, `Total_Bayar`, `Sumber_Pembayaran`, `ID_Resep`) VALUES
(5, 1, 1, '2024-10-03 00:00:00', 75000.00, 100000.00, 'BPJS', 1),
(6, 1, 1, '2024-10-03 00:00:00', 32.00, NULL, 'dsd', 1),
(7, 1, 1, '2024-10-03 00:00:00', 32.00, NULL, 'dsd', 1),
(8, 1, 1, '2024-10-03 00:00:00', 32.00, NULL, 'dsd', 1),
(9, 1, NULL, '2024-10-03 00:00:00', 32.00, NULL, 'dsd', 1),
(10, 1, NULL, '2024-10-03 00:00:00', 32.00, NULL, 'dsd', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_resep`
--
ALTER TABLE `detail_resep`
  ADD PRIMARY KEY (`ID_Detail_Resep`),
  ADD KEY `ID_Resep` (`ID_Resep`),
  ADD KEY `ID_Obat` (`ID_Obat`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`ID_Dokter`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`ID_Karyawan`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`ID_Obat`),
  ADD KEY `ID_Supplier` (`ID_Supplier`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`ID_Pasien`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`ID_Resep`),
  ADD KEY `ID_Pasien` (`ID_Pasien`),
  ADD KEY `ID_Karyawan` (`ID_Karyawan`),
  ADD KEY `ID_Dokter` (`ID_Dokter`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`ID_Supplier`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`ID_Transaksi`),
  ADD KEY `ID_Karyawan` (`ID_Karyawan`),
  ADD KEY `ID_Resep` (`ID_Resep`),
  ADD KEY `fk_transaksi_pasien` (`ID_Pasien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_resep`
--
ALTER TABLE `detail_resep`
  MODIFY `ID_Detail_Resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `ID_Dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `ID_Karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `ID_Obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `ID_Pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `ID_Resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `ID_Supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `ID_Transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_resep`
--
ALTER TABLE `detail_resep`
  ADD CONSTRAINT `detail_resep_ibfk_1` FOREIGN KEY (`ID_Resep`) REFERENCES `resep` (`ID_Resep`),
  ADD CONSTRAINT `detail_resep_ibfk_2` FOREIGN KEY (`ID_Obat`) REFERENCES `obat` (`ID_Obat`);

--
-- Constraints for table `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `obat_ibfk_1` FOREIGN KEY (`ID_Supplier`) REFERENCES `supplier` (`ID_Supplier`);

--
-- Constraints for table `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`ID_Pasien`) REFERENCES `pasien` (`ID_Pasien`),
  ADD CONSTRAINT `resep_ibfk_2` FOREIGN KEY (`ID_Karyawan`) REFERENCES `karyawan` (`ID_Karyawan`),
  ADD CONSTRAINT `resep_ibfk_3` FOREIGN KEY (`ID_Dokter`) REFERENCES `dokter` (`ID_Dokter`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_pasien` FOREIGN KEY (`ID_Pasien`) REFERENCES `pasien` (`ID_Pasien`),
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`ID_Karyawan`) REFERENCES `karyawan` (`ID_Karyawan`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`ID_Resep`) REFERENCES `resep` (`ID_Resep`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
