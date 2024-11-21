-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 07:45 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_resep`
--

INSERT INTO `detail_resep` (`ID_Detail_Resep`, `ID_Resep`, `ID_Obat`, `Jumlah`) VALUES
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
  `Alamat` text,
  `Spesialisasi` varchar(50) DEFAULT NULL,
  `Status_Lisensi` varchar(20) DEFAULT NULL,
  `Tanggal_Lisensi` date DEFAULT NULL,
  `Nama_Institusi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`ID_Dokter`, `NPI`, `Nama_Dokter`, `Jenis_Kelamin`, `Tanggal_Lahir`, `No_Telepon`, `Email`, `Alamat`, `Spesialisasi`, `Status_Lisensi`, `Tanggal_Lisensi`, `Nama_Institusi`) VALUES
(1, 'D123456', 'Dr. Sinta Karina', 'Perempuan', '1980-05-12', '081234567890', 'sinta.karina@klinik.com', 'Jl. Mawar No. 10, Jakarta', 'Umum', 'Aktif', '2021-07-01', 'Universitas Indonesia'),
(2, 'D654321', 'Dr. Bimo Nugroho', 'Laki-laki', '1975-08-23', '081987654321', 'bimo.nugroho@klinik.com', 'Jl. Melati No. 5, Bandung', 'Spesialis Penyakit Dalam', 'Aktif', '2020-09-15', 'Universitas Gadjah Mada'),
(3, 'D789123', 'Dr. Andika Putra', 'Laki-laki', '1982-04-15', '081345678901', 'andika.putra@klinik.com', 'Jl. Kenanga No. 12, Surabaya', 'Spesialis Bedah', 'Aktif', '2019-05-20', 'Universitas Airlangga'),
(4, 'D321987', 'Dr. Fitri Rahayu', 'Perempuan', '1985-06-27', '081234123456', 'fitri.rahayu@klinik.com', 'Jl. Anggrek No. 3, Yogyakarta', 'Spesialis Anak', 'Aktif', '2018-03-12', 'Universitas Gadjah Mada'),
(5, 'D456789', 'Dr. Ridwan Hakim', 'Laki-laki', '1978-09-09', '081789123456', 'ridwan.hakim@klinik.com', 'Jl. Flamboyan No. 8, Semarang', 'Umum', 'Aktif', '2020-11-05', 'Universitas Diponegoro'),
(6, 'D987654', 'Dr. Siti Zubaidah', 'Perempuan', '1983-01-14', '081234678912', 'siti.zubaidah@klinik.com', 'Jl. Cemara No. 6, Palembang', 'Spesialis Gizi', 'Aktif', '2021-01-28', 'Universitas Sriwijaya'),
(7, 'D543210', 'Dr. Fajar Mahendra', 'Laki-laki', '1981-12-05', '081432198765', 'fajar.mahendra@klinik.com', 'Jl. Cempaka No. 20, Medan', 'Spesialis Jantung', 'Aktif', '2017-08-16', 'Universitas Sumatera Utara'),
(8, 'D567890', 'Dr. Putri Amalia', 'Perempuan', '1987-03-17', '081567890123', 'putri.amalia@klinik.com', 'Jl. Dahlia No. 7, Denpasar', 'Umum', 'Aktif', '2019-04-30', 'Universitas Udayana'),
(9, 'D876543', 'Dr. Ahmad Ramadhan', 'Laki-laki', '1986-07-20', '081234567321', 'ahmad.ramadhan@klinik.com', 'Jl. Seruni No. 11, Makassar', 'Spesialis Saraf', 'Aktif', '2022-06-15', 'Universitas Hasanuddin'),
(10, 'D654987', 'Dr. Sri Wulandari', 'Perempuan', '1984-02-22', '081789654321', 'sri.wulandari@klinik.com', 'Jl. Bougenville No. 4, Malang', 'Spesialis THT', 'Aktif', '2018-10-25', 'Universitas Brawijaya'),
(11, 'D123654', 'Dr. Hendra Wijaya', 'Laki-laki', '1979-11-02', '081432198123', 'hendra.wijaya@klinik.com', 'Jl. Melur No. 15, Pontianak', 'Umum', 'Aktif', '2020-02-18', 'Universitas Tanjungpura'),
(12, 'D789654', 'Dr. Farida Salim', 'Perempuan', '1988-09-30', '081987654321', 'farida.salim@klinik.com', 'Jl. Teratai No. 9, Pekanbaru', 'Spesialis Mata', 'Aktif', '2021-12-05', 'Universitas Riau'),
(13, 'D321654', 'Dr. Doni Pratama', 'Laki-laki', '1985-05-11', '081345678123', 'doni.pratama@klinik.com', 'Jl. Kamboja No. 14, Padang', 'Spesialis Kulit', 'Aktif', '2022-09-10', 'Universitas Andalas'),
(14, 'D654321', 'Dr. Maya Sari', 'Perempuan', '1981-07-25', '081567432198', 'maya.sari@klinik.com', 'Jl. Angsana No. 21, Banjarmasin', 'Spesialis Paru', 'Aktif', '2021-11-20', 'Universitas Lambung Mangkurat'),
(15, 'D987321', 'Dr. Faisal Hakim', 'Laki-laki', '1980-08-19', '081234987654', 'faisal.hakim@klinik.com', 'Jl. Pinus No. 19, Samarinda', 'Spesialis Urologi', 'Aktif', '2020-07-14', 'Universitas Mulawarman'),
(16, 'D123789', 'Dr. Nina Kartika', 'Perempuan', '1986-06-14', '081321456789', 'nina.kartika@klinik.com', 'Jl. Sawo No. 22, Bogor', 'Spesialis Rehabilitasi', 'Aktif', '2019-01-11', 'Universitas Pakuan'),
(17, 'D789321', 'Dr. Budi Santoso', 'Laki-laki', '1977-10-30', '081987654987', 'budi.santoso@klinik.com', 'Jl. Kapuk No. 18, Manado', 'Spesialis Bedah Saraf', 'Aktif', '2021-05-07', 'Universitas Sam Ratulangi'),
(18, 'D654789', 'Dr. Indah Permata', 'Perempuan', '1983-04-03', '081234198765', 'indah.permata@klinik.com', 'Jl. Merpati No. 26, Balikpapan', 'Spesialis Gigi', 'Aktif', '2020-03-15', 'Universitas Mulawarman'),
(19, 'D321123', 'Dr. Anton Wijaya', 'Laki-laki', '1984-12-09', '081432567890', 'anton.wijaya@klinik.com', 'Jl. Elang No. 8, Palu', 'Umum', 'Aktif', '2019-09-30', 'Universitas Tadulako'),
(20, 'D987123', 'Dr. Lestari Handayani', 'Perempuan', '1982-02-28', '081765432198', 'lestari.handayani@klinik.com', 'Jl. Cendana No. 5, Ambon', 'Spesialis Anestesi', 'Aktif', '2021-07-19', 'Universitas Pattimura'),
(21, 'D567123', 'Dr. Guntur Prakoso', 'Laki-laki', '1980-03-15', '081234765432', 'guntur.prakoso@klinik.com', 'Jl. Mawar No. 13, Jayapura', 'Umum', 'Aktif', '2018-06-22', 'Universitas Cenderawasih');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`ID_Obat`, `Nama_Obat`, `Code`, `Formulasi`, `Tanggal_Kadaluarsa`, `Stok`, `ID_Supplier`, `Status`, `Package`, `Harga_Beli`, `Harga_Jual`) VALUES
(2, 'Amoxicillin', 'A001', 'Kapsul', '2024-11-30', 190, 2, 'Tersedia', 'Botol', '2500.00', '5000.00'),
(8, 'Ibuprofen', 'I001', 'Kapsul', '2024-10-16', 150, 2, 'Kadaluarsa', 'Dus', '2000.00', '4000.00'),
(9, 'Aspirin', 'A002', 'Tablet', '2026-03-10', 96, 3, 'Tersedia', 'Strip', '1200.00', '2400.00'),
(11, 'Loratadine', 'L001', 'Tablet', '2026-12-25', 78, 2, 'Tersedia', 'Botol', '1400.00', '2800.00'),
(12, 'Omeprazole', 'O001', 'Kapsul', '2025-11-20', 300, 3, 'Tersedia', 'Strip', '1700.00', '3400.00'),
(15, 'Levothyroxine', 'L002', 'Tablet', '2026-08-15', 130, 2, 'Tersedia', 'Strip', '1600.00', '3200.00'),
(16, 'Metformin', 'M001', 'Tablet', '2025-07-05', 200, 3, 'Tersedia', 'Dus', '1100.00', '2200.00'),
(19, 'Lisinopril', 'L003', 'Tablet', '2026-11-30', 300, 2, 'Tersedia', 'Dus', '1900.00', '3800.00'),
(20, 'Furosemide', 'F001', 'Tablet', '2025-10-15', 150, 3, 'Tersedia', 'Botol', '1700.00', '3400.00'),
(21, 'Metoprolol', 'M002', 'Tablet', '2024-10-17', 110, 1, 'Kadaluarsa', 'Strip', '1300.00', '2600.00'),
(23, 'Losartan', 'L004', 'Tablet', '2026-07-05', 250, 2, 'Habis', 'Botol', '1800.00', '3600.00'),
(24, 'Diclofenac', 'D001', 'Kapsul', '2025-06-15', 200, 1, 'Tersedia', 'Strip', '2000.00', '4000.00'),
(25, 'Ranitidine', 'R001', 'Tablet', '2026-05-30', 180, 3, 'Tersedia', 'Dus', '1600.00', '3200.00'),
(27, 'Sertraline', 'S002', 'Tablet', '2027-03-10', 130, 2, 'Tersedia', 'Strip', '1700.00', '3400.00'),
(28, 'Citalopram', 'C002', 'Tablet', '2026-02-15', 90, 1, 'Tersedia', 'Dus', '1500.00', '3000.00'),
(29, 'Metronidazole', 'M003', 'Tablet', '2025-01-01', 300, 3, 'Tersedia', 'Botol', '1100.00', '2200.00'),
(31, 'Tramadol', 'T001', 'Tablet', '2026-12-10', 210, 1, 'Tersedia', 'Dus', '1900.00', '3800.00'),
(32, 'Codeine', 'C004', 'Tablet', '2025-12-30', 150, 2, 'Tersedia', 'Botol', '1500.00', '3000.00'),
(33, 'Prednisone', 'P002', 'Tablet', '2027-06-15', 300, 3, 'Tersedia', 'Strip', '2200.00', '4400.00'),
(35, 'Lansoprazole', 'L005', 'Tablet', '2025-08-20', 200, 2, 'Habis', 'Botol', '1600.00', '3200.00'),
(36, 'Celecoxib', 'C005', 'Kapsul', '2027-01-05', 175, 1, 'Tersedia', 'Strip', '2000.00', '4000.00'),
(37, 'Duloxetine', 'D003', 'Kapsul', '2026-12-25', 130, 3, 'Tersedia', 'Dus', '1900.00', '3800.00'),
(39, 'Tadalafil', 'T002', 'Tablet', '2027-03-15', 220, 2, 'Tersedia', 'Strip', '1400.00', '2800.00'),
(40, 'Finasteride', 'F004', 'Tablet', '2025-04-05', 300, 1, 'Tersedia', 'Dus', '1600.00', '3200.00'),
(41, 'Risperidone', 'R002', 'Tablet', '2026-05-30', 190, 3, 'Tersedia', 'Botol', '1200.00', '2400.00'),
(43, 'Aripiprazole', 'A006', 'Tablet', '2026-08-20', 210, 2, 'Habis', 'Dus', '1700.00', '3400.00'),
(44, 'Zolpidem', 'Z001', 'Tablet', '2025-12-15', 80, 1, 'Tersedia', 'Botol', '1300.00', '2600.00'),
(45, 'Lithium', 'L006', 'Tablet', '2027-05-10', 120, 3, 'Tersedia', 'Strip', '1600.00', '3200.00'),
(47, 'Bupropion', 'B001', 'Tablet', '2027-04-10', 150, 2, 'Tersedia', 'Botol', '1400.00', '2800.00'),
(48, 'Buspirone', 'B002', 'Tablet', '2025-03-20', 90, 1, 'Tersedia', 'Strip', '1500.00', '3000.00'),
(49, 'Varenicline', 'V002', 'Tablet', '2026-02-05', 200, 3, 'Tersedia', 'Dus', '1700.00', '3400.00'),
(51, 'Rivastigmine', 'R003', 'Kapsul', '2027-11-01', 80, 2, 'Tersedia', 'Strip', '1800.00', '3600.00'),
(52, 'Memantine', 'M005', 'Tablet', '2026-12-12', 250, 1, 'Tersedia', 'Dus', '1500.00', '3000.00'),
(53, 'Dopamine', 'D004', 'Kapsul', '2025-09-09', 150, 3, 'Tersedia', 'Botol', '1700.00', '3400.00'),
(55, 'Oxytocin', 'O002', 'Kapsul', '2025-07-22', 200, 2, 'Tersedia', 'Dus', '1400.00', '2800.00'),
(56, 'Insulin', 'I002', 'Kapsul', '2027-05-30', 90, 1, 'Habis', 'Botol', '1900.00', '3800.00'),
(57, 'Ketorolac', 'K002', 'Tablet', '2026-04-05', 20, 3, 'Tersedia', 'Strip', '1700.00', '3400.00'),
(59, 'Colchicine', 'C007', 'Tablet', '2026-02-10', 90, 2, 'Tersedia', 'Botol', '1500.00', '3000.00'),
(60, 'Hydrochlorothiazide', 'H001', 'Tablet', '2025-01-15', 300, 1, 'Habis', 'Strip', '1100.00', '2200.00');

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
  `Alamat` text,
  `Kode_Negara` varchar(10) DEFAULT NULL,
  `No_Telp` varchar(20) DEFAULT NULL,
  `Bahasa_Utama` varchar(20) DEFAULT NULL,
  `Status_Pernikahan` varchar(20) DEFAULT NULL,
  `No_Rekening` varchar(30) DEFAULT NULL,
  `Kewarganegaraan` varchar(20) DEFAULT NULL,
  `Indikator_Meninggal` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`ID_Pasien`, `ID_Eksternal`, `Nama_Lengkap`, `Nama_Panggilan`, `Jenis_Kelamin`, `Tanggal_Lahir`, `Ras`, `Alamat`, `Kode_Negara`, `No_Telp`, `Bahasa_Utama`, `Status_Pernikahan`, `No_Rekening`, `Kewarganegaraan`, `Indikator_Meninggal`) VALUES
(1, 'P001', 'Ali Maulana', 'Ali', 'Laki-laki', '1990-02-15', 'Asia', 'Jl. Merdeka No. 123, Jakarta', 'ID', '081234567890', 'Indonesia', 'Menikah', '1234567890', 'Indonesia', 0),
(2, 'P002', 'Siti Fatimah', 'Siti', 'Perempuan', '1985-11-20', 'Asia', 'Jl. Proklamasi No. 456, Bandung', 'ID', '081987654321', 'Indonesia', 'Menikah', '0987654321', 'Indonesia', 0),
(3, 'P003', 'Budi Santoso', 'Budi', 'Laki-laki', '1991-06-25', 'Asia', 'Jl. Anggrek No. 1, Surabaya', 'ID', '081234567891', 'Indonesia', 'Belum Menikah', '2345678901', 'Indonesia', 0),
(4, 'P004', 'Dewi Lestari', 'Dewi', 'Perempuan', '1988-12-10', 'Asia', 'Jl. Melati No. 10, Semarang', 'ID', '081987654322', 'Indonesia', 'Menikah', '3456789012', 'Indonesia', 0),
(5, 'P005', 'Faisal Hakim', 'Faisal', 'Laki-laki', '1993-05-15', 'Asia', 'Jl. Mawar No. 5, Medan', 'ID', '081234567892', 'Indonesia', 'Belum Menikah', '4567890123', 'Indonesia', 0),
(6, 'P006', 'Sari Wijaya', 'Sari', 'Perempuan', '1989-07-20', 'Asia', 'Jl. Kenanga No. 7, Makassar', 'ID', '081987654323', 'Indonesia', 'Menikah', '5678901234', 'Indonesia', 0),
(7, 'P007', 'Indra Pratama', 'Indra', 'Laki-laki', '1987-04-13', 'Asia', 'Jl. Dahlia No. 12, Palembang', 'ID', '081234567893', 'Indonesia', 'Menikah', '6789012345', 'Indonesia', 0),
(8, 'P008', 'Putri Amalia', 'Putri', 'Perempuan', '1990-08-02', 'Asia', 'Jl. Seruni No. 15, Yogyakarta', 'ID', '081987654324', 'Indonesia', 'Menikah', '7890123456', 'Indonesia', 0),
(9, 'P009', 'Rizki Maulana', 'Rizki', 'Laki-laki', '1992-09-11', 'Asia', 'Jl. Merpati No. 9, Bandung', 'ID', '081234567894', 'Indonesia', 'Belum Menikah', '8901234567', 'Indonesia', 0),
(10, 'P010', 'Lestari Wulandari', 'Lestari', 'Perempuan', '1991-03-27', 'Asia', 'Jl. Flamboyan No. 17, Jakarta', 'ID', '081987654325', 'Indonesia', 'Menikah', '9012345678', 'Indonesia', 0),
(11, 'P011', 'Doni Pratama', 'Doni', 'Laki-laki', '1994-05-30', 'Asia', 'Jl. Cemara No. 6, Surabaya', 'ID', '081234567895', 'Indonesia', 'Belum Menikah', '0123456789', 'Indonesia', 0),
(12, 'P012', 'Farida Salim', 'Farida', 'Perempuan', '1986-02-18', 'Asia', 'Jl. Melur No. 2, Bandung', 'ID', '081987654326', 'Indonesia', 'Menikah', '1123456789', 'Indonesia', 0),
(13, 'P013', 'Andi Maulana', 'Andi', 'Laki-laki', '1985-11-25', 'Asia', 'Jl. Teratai No. 22, Denpasar', 'ID', '081234567896', 'Indonesia', 'Menikah', '2123456789', 'Indonesia', 0),
(14, 'P014', 'Fitri Handayani', 'Fitri', 'Perempuan', '1989-07-01', 'Asia', 'Jl. Bougenville No. 8, Malang', 'ID', '081987654327', 'Indonesia', 'Menikah', '3123456789', 'Indonesia', 0),
(15, 'P015', 'Agus Susanto', 'Agus', 'Laki-laki', '1993-01-14', 'Asia', 'Jl. Pinus No. 13, Pontianak', 'ID', '081234567897', 'Indonesia', 'Belum Menikah', '4123456789', 'Indonesia', 0),
(16, 'P016', 'Sri Wulandari', 'Sri', 'Perempuan', '1988-08-25', 'Asia', 'Jl. Kamboja No. 3, Pekanbaru', 'ID', '081987654328', 'Indonesia', 'Menikah', '5123456789', 'Indonesia', 0),
(17, 'P017', 'Rahmat Hidayat', 'Rahmat', 'Laki-laki', '1991-12-05', 'Asia', 'Jl. Cendana No. 4, Padang', 'ID', '081234567898', 'Indonesia', 'Menikah', '6123456789', 'Indonesia', 0),
(18, 'P018', 'Lina Setiawan', 'Lina', 'Perempuan', '1987-06-12', 'Asia', 'Jl. Angsana No. 7, Samarinda', 'ID', '081987654329', 'Indonesia', 'Menikah', '7123456789', 'Indonesia', 0),
(19, 'P019', 'Fajar Mahendra', 'Fajar', 'Laki-laki', '1992-03-19', 'Asia', 'Jl. Kapuk No. 11, Balikpapan', 'ID', '081234567899', 'Indonesia', 'Belum Menikah', '8123456789', 'Indonesia', 0),
(20, 'P020', 'Maya Kartika', 'Maya', 'Perempuan', '1990-10-22', 'Asia', 'Jl. Mawar No. 9, Manado', 'ID', '081987654330', 'Indonesia', 'Menikah', '9123456789', 'Indonesia', 0),
(21, 'P021', 'Samsul Arif', 'Samsul', 'Laki-laki', '1986-05-25', 'Asia', 'Jl. Sawo No. 18, Bogor', 'ID', '081234567900', 'Indonesia', 'Menikah', '1012345678', 'Indonesia', 0),
(22, 'P022', 'Dina Anggraeni', 'Dina', 'Perempuan', '1991-08-09', 'Asia', 'Jl. Elang No. 15, Makassar', 'ID', '081987654331', 'Indonesia', 'Menikah', '2012345678', 'Indonesia', 0),
(23, 'P023', 'Hendra Wijaya', 'Hendra', 'Laki-laki', '1985-04-15', 'Asia', 'Jl. Flamboyan No. 12, Surabaya', 'ID', '081234567901', 'Indonesia', 'Menikah', '3012345678', 'Indonesia', 0),
(24, 'P024', 'Tina Nurhasanah', 'Tina', 'Perempuan', '1990-11-25', 'Asia', 'Jl. Dahlia No. 9, Bandung', 'ID', '081987654332', 'Indonesia', 'Menikah', '4012345678', 'Indonesia', 0),
(25, 'P025', 'Riko Santoso', 'Riko', 'Laki-laki', '1993-03-20', 'Asia', 'Jl. Seruni No. 11, Jakarta', 'ID', '081234567902', 'Indonesia', 'Belum Menikah', '5012345678', 'Indonesia', 0),
(26, 'P026', 'Nurul Hidayah', 'Nurul', 'Perempuan', '1987-02-10', 'Asia', 'Jl. Melati No. 18, Semarang', 'ID', '081987654333', 'Indonesia', 'Menikah', '6012345678', 'Indonesia', 0),
(27, 'P027', 'Arief Budiman', 'Arief', 'Laki-laki', '1989-01-08', 'Asia', 'Jl. Mawar No. 6, Medan', 'ID', '081234567903', 'Indonesia', 'Belum Menikah', '7012345678', 'Indonesia', 0),
(28, 'P028', 'Eka Putri', 'Eka', 'Perempuan', '1991-12-15', 'Asia', 'Jl. Melur No. 19, Makassar', 'ID', '081987654334', 'Indonesia', 'Menikah', '8012345678', 'Indonesia', 0),
(29, 'P029', 'Rudi Setiawan', 'Rudi', 'Laki-laki', '1990-06-29', 'Asia', 'Jl. Kenanga No. 8, Palembang', 'ID', '081234567904', 'Indonesia', 'Belum Menikah', '9012345678', 'Indonesia', 0),
(30, 'P030', 'Dewi Andini', 'Dewi', 'Perempuan', '1986-09-18', 'Asia', 'Jl. Cempaka No. 10, Yogyakarta', 'ID', '081987654335', 'Indonesia', 'Menikah', '0112345679', 'Indonesia', 0),
(31, 'P031', 'Bayu Saputra', 'Bayu', 'Laki-laki', '1988-02-25', 'Asia', 'Jl. Melati No. 21, Denpasar', 'ID', '081234567905', 'Indonesia', 'Belum Menikah', '0212345679', 'Indonesia', 0),
(32, 'P032', 'Ratna Wulandari', 'Ratna', 'Perempuan', '1992-07-22', 'Asia', 'Jl. Seruni No. 14, Jakarta', 'ID', '081987654336', 'Indonesia', 'Menikah', '0312345679', 'Indonesia', 0),
(33, 'P033', 'Haris Maulana', 'Haris', 'Laki-laki', '1987-05-03', 'Asia', 'Jl. Flamboyan No. 16, Surabaya', 'ID', '081234567906', 'Indonesia', 'Menikah', '0412345679', 'Indonesia', 0),
(34, 'P034', 'Lina Pratami', 'Lina', 'Perempuan', '1985-11-11', 'Asia', 'Jl. Melur No. 7, Bandung', 'ID', '081987654337', 'Indonesia', 'Menikah', '0512345679', 'Indonesia', 0),
(35, 'P035', 'Yuda Santoso', 'Yuda', 'Laki-laki', '1990-04-12', 'Asia', 'Jl. Teratai No. 4, Makassar', 'ID', '081234567907', 'Indonesia', 'Belum Menikah', '0612345679', 'Indonesia', 0),
(36, 'P036', 'Fitri Anggraeni', 'Fitri', 'Perempuan', '1988-07-25', 'Asia', 'Jl. Flamboyan No. 19, Medan', 'ID', '081987654338', 'Indonesia', 'Menikah', '0712345679', 'Indonesia', 0),
(37, 'P037', 'Joko Susanto', 'Joko', 'Laki-laki', '1991-01-17', 'Asia', 'Jl. Cemara No. 14, Yogyakarta', 'ID', '081234567908', 'Indonesia', 'Belum Menikah', '0812345679', 'Indonesia', 0),
(38, 'P038', 'Sinta Wulandari', 'Sinta', 'Perempuan', '1992-08-30', 'Asia', 'Jl. Kenanga No. 11, Jakarta', 'ID', '081987654339', 'Indonesia', 'Menikah', '0912345679', 'Indonesia', 0),
(39, 'P039', 'Dika Prasetya', 'Dika', 'Laki-laki', '1987-12-10', 'Asia', 'Jl. Seruni No. 16, Bandung', 'ID', '081234567909', 'Indonesia', 'Menikah', '1012345679', 'Indonesia', 0),
(40, 'P040', 'Maya Putri', 'Maya', 'Perempuan', '1991-03-15', 'Asia', 'Jl. Mawar No. 13, Makassar', 'ID', '081987654340', 'Indonesia', 'Menikah', '1112345679', 'Indonesia', 0),
(41, 'P041', 'Agung Setiawan', 'Agung', 'Laki-laki', '1988-09-19', 'Asia', 'Jl. Anggrek No. 3, Surabaya', 'ID', '081234567910', 'Indonesia', 'Menikah', '1212345679', 'Indonesia', 0),
(42, 'P042', 'Lestari Pramudita', 'Lestari', 'Perempuan', '1992-05-05', 'Asia', 'Jl. Melati No. 22, Yogyakarta', 'ID', '081987654341', 'Indonesia', 'Menikah', '1312345679', 'Indonesia', 0),
(43, 'P043', 'Wahyudi Ramadhan', 'Wahyudi', 'Laki-laki', '1986-03-29', 'Asia', 'Jl. Flamboyan No. 2, Bandung', 'ID', '081234567911', 'Indonesia', 'Menikah', '1412345679', 'Indonesia', 0),
(44, 'P044', 'Titi Herawati', 'Titi', 'Perempuan', '1990-07-11', 'Asia', 'Jl. Mawar No. 8, Makassar', 'ID', '081987654342', 'Indonesia', 'Menikah', '1512345679', 'Indonesia', 0),
(45, 'P045', 'Rizal Irwan', 'Rizal', 'Laki-laki', '1993-04-17', 'Asia', 'Jl. Kenanga No. 5, Palembang', 'ID', '081234567912', 'Indonesia', 'Belum Menikah', '1612345679', 'Indonesia', 0),
(46, 'P046', 'Sinta Ningsih', 'Sinta', 'Perempuan', '1989-09-14', 'Asia', 'Jl. Melur No. 4, Surabaya', 'ID', '081987654343', 'Indonesia', 'Menikah', '1712345679', 'Indonesia', 0),
(47, 'P047', 'Bagus Rachman', 'Bagus', 'Laki-laki', '1987-05-03', 'Asia', 'Jl. Teratai No. 2, Makassar', 'ID', '081234567913', 'Indonesia', 'Belum Menikah', '1812345679', 'Indonesia', 0),
(48, 'P048', 'Rani Cahyani', 'Rani', 'Perempuan', '1992-12-08', 'Asia', 'Jl. Bougenville No. 9, Yogyakarta', 'ID', '081987654344', 'Indonesia', 'Menikah', '1912345679', 'Indonesia', 0),
(49, 'P049', 'Yuniar Kusuma', 'Yuniar', 'Perempuan', '1990-11-02', 'Asia', 'Jl. Seruni No. 13, Surabaya', 'ID', '081234567914', 'Indonesia', 'Menikah', '2012345679', 'Indonesia', 0),
(50, 'P050', 'Endra Jatmiko', 'Endra', 'Laki-laki', '1994-07-29', 'Asia', 'Jl. Flamboyan No. 17, Jakarta', 'ID', '081987654345', 'Indonesia', 'Belum Menikah', '2112345679', 'Indonesia', 0),
(51, 'P051', 'Dewi Mariana', 'Dewi', 'Perempuan', '1988-01-13', 'Asia', 'Jl. Angsana No. 19, Makassar', 'ID', '081234567915', 'Indonesia', 'Menikah', '2212345679', 'Indonesia', 0),
(52, 'P052', 'Fadil Ramli', 'Fadil', 'Laki-laki', '1986-05-30', 'Asia', 'Jl. Teratai No. 11, Denpasar', 'ID', '081987654346', 'Indonesia', 'Menikah', '2312345679', 'Indonesia', 0),
(53, 'P053', 'Nina Mardiana', 'Nina', 'Perempuan', '1991-10-01', 'Asia', 'Jl. Mawar No. 2, Surabaya', 'ID', '081234567916', 'Indonesia', 'Menikah', '2412345679', 'Indonesia', 0),
(54, 'P054', 'Haris Yulianto', 'Haris', 'Laki-laki', '1993-02-18', 'Asia', 'Jl. Kenanga No. 21, Yogyakarta', 'ID', '081987654347', 'Indonesia', 'Belum Menikah', '2512345679', 'Indonesia', 0),
(55, 'P055', 'Vita Suryani', 'Vita', 'Perempuan', '1990-09-25', 'Asia', 'Jl. Elang No. 4, Semarang', 'ID', '081234567917', 'Indonesia', 'Menikah', '2612345679', 'Indonesia', 0),
(56, 'P056', 'Taufik Hidayat', 'Taufik', 'Laki-laki', '1987-08-19', 'Asia', 'Jl. Melati No. 18, Bandung', 'ID', '081987654348', 'Indonesia', 'Menikah', '2712345679', 'Indonesia', 0),
(57, 'P057', 'Winda Oktavia', 'Winda', 'Perempuan', '1992-01-04', 'Asia', 'Jl. Flamboyan No. 6, Makassar', 'ID', '081234567918', 'Indonesia', 'Menikah', '2812345679', 'Indonesia', 0),
(58, 'P058', 'Novianto Setiawan', 'Novianto', 'Laki-laki', '1991-03-01', 'Asia', 'Jl. Anggrek No. 7, Surabaya', 'ID', '081987654349', 'Indonesia', 'Belum Menikah', '2912345679', 'Indonesia', 0),
(59, 'P059', 'Mira Wijayanti', 'Mira', 'Perempuan', '1986-12-05', 'Asia', 'Jl. Cendana No. 13, Yogyakarta', 'ID', '081234567919', 'Indonesia', 'Menikah', '3012345679', 'Indonesia', 0),
(60, 'P060', 'Anwar Arifin', 'Anwar', 'Laki-laki', '1990-11-11', 'Asia', 'Jl. Kenanga No. 17, Denpasar', 'ID', '081987654350', 'Indonesia', 'Belum Menikah', '3112345679', 'Indonesia', 0),
(61, 'P061', 'Rochman Hidayat', 'Rochman', 'Laki-laki', '1988-04-02', 'Asia', 'Jl. Dahlia No. 22, Semarang', 'ID', '081234567920', 'Indonesia', 'Menikah', '3212345679', 'Indonesia', 0),
(62, 'P062', 'Arum Puspita', 'Arum', 'Perempuan', '1992-09-17', 'Asia', 'Jl. Mawar No. 14, Surabaya', 'ID', '081987654351', 'Indonesia', 'Menikah', '3312345679', 'Indonesia', 0),
(63, 'P063', 'Irwan Safutra', 'Irwan', 'Laki-laki', '1990-02-03', 'Asia', 'Jl. Elang No. 20, Bandung', 'ID', '081234567921', 'Indonesia', 'Belum Menikah', '3412345679', 'Indonesia', 0),
(64, 'P064', 'Hana Rismayanti', 'Hana', 'Perempuan', '1987-07-11', 'Asia', 'Jl. Kenanga No. 9, Yogyakarta', 'ID', '081987654352', 'Indonesia', 'Menikah', '3512345679', 'Indonesia', 0),
(65, 'P065', 'Satria Pratama', 'Satria', 'Laki-laki', '1991-12-27', 'Asia', 'Jl. Bougenville No. 5, Medan', 'ID', '081234567922', 'Indonesia', 'Menikah', '3612345679', 'Indonesia', 0),
(66, 'P066', 'Desi Yuliana', 'Desi', 'Perempuan', '1993-06-18', 'Asia', 'Jl. Angsana No. 12, Surabaya', 'ID', '081987654353', 'Indonesia', 'Menikah', '3712345679', 'Indonesia', 0),
(67, 'P067', 'Gilang Mahendra', 'Gilang', 'Laki-laki', '1988-08-07', 'Asia', 'Jl. Melati No. 9, Jakarta', 'ID', '081234567923', 'Indonesia', 'Belum Menikah', '3812345679', 'Indonesia', 0),
(68, 'P068', 'Nina Hapsari', 'Nina', 'Perempuan', '1991-05-19', 'Asia', 'Jl. Cempaka No. 16, Medan', 'ID', '081987654354', 'Indonesia', 'Menikah', '3912345679', 'Indonesia', 0),
(69, 'P069', 'Damar Saputra', 'Damar', 'Laki-laki', '1990-06-22', 'Asia', 'Jl. Bougenville No. 13, Bandung', 'ID', '081234567924', 'Indonesia', 'Menikah', '4012345679', 'Indonesia', 0),
(70, 'P070', 'Citra Fadila', 'Citra', 'Perempuan', '1992-03-04', 'Asia', 'Jl. Teratai No. 9, Makassar', 'ID', '081987654355', 'Indonesia', 'Menikah', '4112345679', 'Indonesia', 0);

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
  `Catatan_Resep` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `Alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`ID_Supplier`, `Nama_Supplier`, `Kontak`, `Alamat`) VALUES
(1, 'PT Obat Sehat', '081234567890', 'Jl. Sehat No. 123, Jakarta'),
(2, 'PT Sumber Obat', '081987654321', 'Jl. Kesehatan No. 456, Bandung'),
(3, 'PT Obat Mandiri', '081223344556', 'Jl. Mandiri No. 789, Suraba'),
(12, 'PT. Kimia', '0823122334', 'Jl.Sukolilo');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `ID_Transaksi` int(11) NOT NULL,
  `ID_Pasien` varchar(52) DEFAULT NULL,
  `ID_Dokter` varchar(52) DEFAULT NULL,
  `ID_Karyawan` int(11) DEFAULT NULL,
  `Tanggal_Transaksi` datetime DEFAULT NULL,
  `Total_Harga` decimal(10,2) DEFAULT NULL,
  `Total_Bayar` decimal(10,2) DEFAULT NULL,
  `Kembali` decimal(10,2) AS (`Total_Bayar` - `Total_Harga`) VIRTUAL,
  `Sumber_Pembayaran` varchar(50) DEFAULT NULL,
  `Detail_Resep` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`ID_Transaksi`, `ID_Pasien`, `ID_Dokter`, `ID_Karyawan`, `Tanggal_Transaksi`, `Total_Harga`, `Total_Bayar`, `Sumber_Pembayaran`, `Detail_Resep`) VALUES
(65, 'Ahmad Fauzan', 'Dr. Dani Kurniawa', 1, '2024-11-12 00:00:00', '20000.00', '100000.00', 'Cash', ''),
(66, 'Ahmad Fauzan', 'Dr. Dani Kurniawa', 1, '2024-11-12 00:00:00', '30000.00', '50000.00', 'Cash', ''),
(67, 'Yogi Indigo', 'Dr. Yuli Astuti', 1, '2024-11-12 00:00:00', '13000.00', '15000.00', 'BPJS', ''),
(68, 'Adit_as', 'Dr. Chika Amelia', 1, '2024-11-12 00:00:00', '950000.00', '1000000.00', 'Cash', ''),
(69, 'Ahmad Fauzan', 'Dr. Dani Kurniawa', 1, '2024-11-12 00:00:00', '36000.00', '50000.00', 'Cash', ''),
(70, 'Ahmad Fauzan', 'Dr. Dani Kurniawa', 1, '2024-11-12 00:00:00', '36000.00', '50000.00', 'Cash', ''),
(71, 'Ahmad Fauzan', 'Dr. Dani Kurniawa', 1, '2024-11-12 00:00:00', '50000.00', '100000.00', 'Cash', ''),
(72, 'Ahmad Fauzan', 'Dr. Dani Kurniawa', 1, '2024-11-12 00:00:00', '25000.00', '50000.00', 'Cash', ''),
(73, 'Ahmad Fauzan', 'Error: Data dokter tidak tersedia.', 1, '2024-11-12 00:00:00', '8400.00', '10000.00', 'Cash', ''),
(74, 'Ahmad Fauzan', 'Error: Data dokter tidak tersedia.', 1, '2024-11-12 00:00:00', '8400.00', '10000.00', 'Cash', ''),
(75, 'Ahmad Fauzan', 'Error: Data dokter tidak tersedia.', 1, '2024-11-12 00:00:00', '15000.00', '20000.00', 'Cash', ''),
(76, 'Ahmad Fauzan', 'Dr. Dani Kurniawa', 1, '2024-11-12 00:00:00', '15000.00', '20000.00', 'Cash', ''),
(77, 'Ahmad Fauzan', 'Dr. Dani Kurniawa', 1, '2024-11-12 00:00:00', '15000.00', '20000.00', 'Cash', ''),
(78, 'Ahmad Fauzan', 'Dr. Dani Kurniawa', 1, '2024-11-12 00:00:00', '20000.00', '30000.00', 'Cash', ''),
(79, 'Ahmad Fauzan', 'Dr. Dani Kurniawa', 1, '2024-11-12 00:00:00', '20000.00', '30000.00', 'Cash', ''),
(80, 'Bagus Alfian', 'Dr. Hari Wijaya', 2, '2024-11-12 00:00:00', '13600.00', '15000.00', 'Cash', ''),
(81, 'Ahmad Fauzan', 'Dr. Dani Kurniawa', 1, '2024-11-12 00:00:00', '8400.00', '10000.00', 'Cash', ''),
(82, 'P001', 'D001', 101, NULL, '40.00', '50.00', 'Cash', ''),
(83, 'P002', 'D002', 102, NULL, '45.00', '50.00', 'Transfer', ''),
(84, 'Ahmad Fauzan', 'Dr. Dani Kurniawa', 1, '2024-11-13 00:00:00', '10000.00', '343434.00', 'Cash', ''),
(85, 'Ahmad Fauzan', 'Dr. Dani Kurniawa', 1, '2024-11-13 00:00:00', '10000.00', '343434.00', 'Cash', ''),
(86, 'Ahmad Fauzan', 'Dr. Dani Kurniawa', 1, '2024-11-13 00:00:00', '20000.00', '22222.00', 'Cash', ''),
(87, 'Ahmad Fauzan', 'Dr. Dani Kurniawa', 1, '2024-11-13 00:00:00', '20000.00', '22222.00', 'Cash', ''),
(88, 'Ahmad Fauzan', 'Dr. Dani Kurniawa', 1, '2024-11-13 00:00:00', '20000.00', '22222.00', 'Cash', ''),
(89, 'Ahmad Fauzan', 'Error: Data dokter tidak tersedia.', 1, '2024-11-13 00:00:00', '25000.00', '50000.00', 'Cash', ''),
(90, 'Ahmad Fauzan', 'Error: Data dokter tidak tersedia.', 1, '2024-11-13 00:00:00', '20000.00', '50000.00', 'Cash', ''),
(91, 'Ahmad Fauzan', 'Error: Data dokter tidak tersedia.', 1, '2024-11-13 00:00:00', '20000.00', '50000.00', 'Cash', ''),
(92, 'Yogi Indigo', 'Dr. Hari Wijaya', 2, '2024-11-13 00:00:00', '20000.00', '30000.00', 'Cash', 'Amoxicillin | Tersedia: Setelah makan 3 x 1\r\n');

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
  ADD KEY `ID_Karyawan` (`ID_Karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_resep`
--
ALTER TABLE `detail_resep`
  MODIFY `ID_Detail_Resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `ID_Dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `ID_Karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `ID_Obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `ID_Pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `ID_Resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `ID_Supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `ID_Transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
