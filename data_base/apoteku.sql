-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Okt 2024 pada 03.21
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
  `Jabatan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`ID_Karyawan`, `Nama`, `No_Telepon`, `Jabatan`) VALUES
(1, 'Andi Prasetyo', '081234123456', 'Apoteker'),
(2, 'Budi Santoso', '081234987654', 'Kasir'),
(3, 'Citra Dewi', '081234112233', 'Asisten Apoteker');

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
  `Harga_Obat` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`ID_Obat`, `Nama_Obat`, `Code`, `Formulasi`, `Tanggal_Kadaluarsa`, `Stok`, `ID_Supplier`, `Status`, `Package`, `Harga_Obat`) VALUES
(1, 'Paracetamol', 'P001', 'Tablet', '2025-12-31', 100, 1, 'Tersedia', 'Strip', 1500.00),
(2, 'Amoxicillin', 'A001', 'Kapsul', '2024-11-30', 200, 2, 'Tersedia', 'Botol', 2500.00),
(3, 'Vitamin C', 'V001', 'Tablet', '2026-06-30', 300, 3, 'Tersedia', 'Strip', 1000.00);

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
(3, 'PT Obat Mandiri', '081223344556', 'Jl. Mandiri No. 789, Surabaya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `ID_Transaksi` int(11) NOT NULL,
  `ID_Karyawan` int(11) DEFAULT NULL,
  `Tanggal_Waktu` datetime DEFAULT NULL,
  `Kode_Jenis_Layanan` varchar(20) DEFAULT NULL,
  `Kode_Provider_CPT` varchar(20) DEFAULT NULL,
  `Total_Harga_Obat` decimal(10,2) DEFAULT NULL,
  `Metode_Pembayaran` varchar(50) DEFAULT NULL,
  `Sumber_Pembayaran` varchar(50) DEFAULT NULL,
  `ID_Resep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`ID_Transaksi`, `ID_Karyawan`, `Tanggal_Waktu`, `Kode_Jenis_Layanan`, `Kode_Provider_CPT`, `Total_Harga_Obat`, `Metode_Pembayaran`, `Sumber_Pembayaran`, `ID_Resep`) VALUES
(1, 2, '2024-10-01 14:30:00', 'L001', 'CPT001', 17500.00, 'Cash', 'Pribadi', 1),
(2, 2, '2024-10-05 10:15:00', 'L002', 'CPT002', 24500.00, 'Debit', 'BPJS', 2);

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
  ADD PRIMARY KEY (`ID_Transaksi`),
  ADD KEY `ID_Karyawan` (`ID_Karyawan`),
  ADD KEY `ID_Resep` (`ID_Resep`);

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
  MODIFY `ID_Karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `ID_Obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `ID_Supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `ID_Transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`ID_Karyawan`) REFERENCES `karyawan` (`ID_Karyawan`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`ID_Resep`) REFERENCES `resep` (`ID_Resep`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
